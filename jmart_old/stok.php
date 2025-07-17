<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "koperasi";
$batchSize = 1000; // Sesuaikan ukuran batch sesuai kebutuhan Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk menambahkan kolom jika belum ada
function addColumnIfNotExists($conn, $tableName, $columnName, $columnType)
{
    $sqlCheckColumn = "SHOW COLUMNS FROM $tableName LIKE '$columnName'";
    $result = $conn->query($sqlCheckColumn);

    if ($result->num_rows == 0) {
        // Kolom belum ada, tambahkan kolom
        $sqlAddColumn = "ALTER TABLE $tableName ADD COLUMN $columnName $columnType";

        if ($conn->query($sqlAddColumn) === TRUE) {
            echo "Kolom $columnName berhasil ditambahkan.\n";
        } else {
            echo "Error adding column $columnName: " . $conn->error . "\n";
        }
    } else {
        // Kolom sudah ada, lewati penambahan
        echo "Kolom $columnName sudah ada, melewati penambahan.\n";
    }
}

// Fungsi untuk memasukkan batch data
function insertBatch($conn, $batchData, $stockData, $stockAwalField)
{
    $placeholders = rtrim(str_repeat('(?, ?), ', count($batchData)), ', ');
    $sqlInsertBatch = "INSERT INTO stock_list (id_brg, $stockAwalField) VALUES " . $placeholders;
    $stmtInsertBatch = $conn->prepare($sqlInsertBatch);

    $types = str_repeat('ii', count($batchData));
    $params = [];
    foreach ($batchData as $index => $id_brg) {
        $params[] = $id_brg;
        $params[] = $stockData[$index];
    }

    $stmtInsertBatch->bind_param($types, ...$params);

    if ($stmtInsertBatch->execute()) {
        echo "Batch berhasil dimasukkan.\n";
    } else {
        echo "Error inserting batch: " . $stmtInsertBatch->error . "\n";
    }

    $stmtInsertBatch->close();
}

// Langkah 1: Buat tabel stock_list jika belum ada
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS stock_list (
    id_stock_list INT AUTO_INCREMENT PRIMARY KEY,
    id_brg INT NOT NULL
)";

if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Tabel stock_list berhasil dibuat atau sudah ada.\n";
} else {
    echo "Error creating table: " . $conn->error;
}

// Tambahkan kolom id_stock_list dan id_brg jika belum ada
addColumnIfNotExists($conn, 'stock_list', 'id_stock_list', 'INT AUTO_INCREMENT PRIMARY KEY');
addColumnIfNotExists($conn, 'stock_list', 'id_brg', 'INT NOT NULL');

// Tambahkan kolom stock_awal untuk bulan dan tahun saat ini
$bulanTahun = strtolower(date('F_Y'));
$stockAwalField = "stock_awal_$bulanTahun";
addColumnIfNotExists($conn, 'stock_list', $stockAwalField, 'INT DEFAULT NULL');

// Langkah 2: Tambahkan data dari tb_barang ke stock_list
$sqlGetBarang = "SELECT id_brg, stock_brg FROM tb_barang";
$resultBarang = $conn->query($sqlGetBarang);

if ($resultBarang->num_rows > 0) {
    // Mulai transaksi
    $conn->begin_transaction();

    try {
        $batchData = [];
        $stockData = [];

        while ($row = $resultBarang->fetch_assoc()) {
            $id_brg = $row['id_brg'];
            $stock_brg = $row['stock_brg'];

            // Periksa apakah id_brg sudah ada di stock_list
            $sqlCheckStockList = "SELECT id_stock_list FROM stock_list WHERE id_brg = ?";
            $stmtCheckStockList = $conn->prepare($sqlCheckStockList);
            $stmtCheckStockList->bind_param("i", $id_brg);
            $stmtCheckStockList->execute();
            $stmtCheckStockList->store_result();

            if ($stmtCheckStockList->num_rows == 0) {
                // Tambahkan id_brg dan stock_brg ke dalam batch untuk dimasukkan
                $batchData[] = $id_brg;
                $stockData[] = $stock_brg;
            }

            $stmtCheckStockList->close();

            // Jika ukuran batch tercapai, masukkan batch
            if (count($batchData) >= $batchSize) {
                insertBatch($conn, $batchData, $stockData, $stockAwalField);
                $batchData = []; // Bersihkan data batch
                $stockData = []; // Bersihkan data stock
            }
        }

        // Masukkan sisa data dalam batchData
        if (!empty($batchData)) {
            insertBatch($conn, $batchData, $stockData, $stockAwalField);
        }

        // Commit transaksi
        $conn->commit();
        echo "Transaksi berhasil di-commit.\n";
    } catch (Exception $e) {
        // Rollback transaksi jika ada kesalahan
        $conn->rollback();
        echo "Transaksi di-rollback: " . $e->getMessage() . "\n";
    }
} else {
    echo "Tidak ada record ditemukan di tb_barang.\n";
}

// Langkah 3: Periksa apakah sekarang tanggal 1, jika ya tambahkan kolom baru
$currentDate = new DateTime();
$isFirstOfMonth = $currentDate->format('j') == 1;

if ($isFirstOfMonth) {
    // Tambahkan kolom stock_akhir bulan lalu dan stock_awal bulan ini
    $prevMonth = new DateTime('first day of last month');
    $prevMonthYear = strtolower($prevMonth->format('F_Y'));
    $stockAkhirField = "stok_akhir_$prevMonthYear";
    $stockAwalField = "stok_awal_" . strtolower($currentDate->format('F_Y'));

    addColumnIfNotExists($conn, 'stock_list', $stockAkhirField, 'INT DEFAULT NULL');
    addColumnIfNotExists($conn, 'stock_list', $stockAwalField, 'INT DEFAULT NULL');

    // Update nilai stock_akhir bulan lalu dan stock_awal bulan ini
    $sqlUpdateStock = "UPDATE stock_list SET $stockAkhirField = $stockAwalField, $stockAwalField = $stockAwalField";
    if ($conn->query($sqlUpdateStock) === TRUE) {
        echo "Kolom stock_akhir dan stock_awal berhasil diperbarui.\n";
    } else {
        echo "Error updating stock_akhir and stock_awal columns: " . $conn->error;
    }
}

$conn->close();
