<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Persediaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .alert {
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Laporan Persediaan <?= $bulan ?>-<?= $tahun ?></h2>

        <!-- <form action="" method="get">
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Pilih Periode</label>
                    <div class="row">
                        <div class="col-md-6">
                            <select name="bulan" id="bulan" class="form-control">
                                <?php
                                $months = [
                                    '01' => 'Januari',
                                    '02' => 'Februari',
                                    '03' => 'Maret',
                                    '04' => 'April',
                                    '05' => 'Mei',
                                    '06' => 'Juni',
                                    '07' => 'Juli',
                                    '08' => 'Agustus',
                                    '09' => 'September',
                                    '10' => 'Oktober',
                                    '11' => 'November',
                                    '12' => 'Desember'
                                ];
                                foreach ($months as $num => $name) {
                                    $selected = ($num == $bulan) ? 'selected' : '';
                                    echo "<option value=\"$num\" $selected>$name</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="tahun" id="tahun" class="form-control">
                                <?php
                                $currentYear = date('Y');
                                for ($i = $currentYear; $i >= $currentYear - 4; $i--) {
                                    $selected = ($i == $tahun) ? 'selected' : '';
                                    echo "<option value=\"$i\" $selected>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        Tampilkan Laporan
                    </button>
                </div>
            </div>
        </form> -->

        <?php if (isset($no_data) && $no_data) : ?>
            <div class="alert mt-4" role="alert">
                <?= $message ?? 'Tidak ada data tersedia untuk periode yang dipilih.' ?>
            </div>
        <?php elseif (!empty($inventori)) : ?>
            <div class="table-responsive mt-4">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Barcode</th>
                            <th>Stok Awal</th>
                            <th>Pembelian Bulan Ini</th>
                            <th>Total Stok Setelah Pembelian</th>
                            <th>Penjualan Bulan Ini</th>
                            <th>Total Spoil</th>
                            <th>Stok Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($check == false) : ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data tersedia untuk bulan <?= $bulan ?> tahun <?= $tahun ?></td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($inventori as $item) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($item->nama_barang) ?></td>
                                    <td><?= htmlspecialchars($item->barcode) ?></td>
                                    <td><?= $item->$stockAwalField ?></td>
                                    <td><?= $item->pembelian_bulan_ini ?></td>
                                    <td><?= $item->total_stok_setelah_pembelian ?></td>
                                    <td><?= $item->penjualan_bulan_ini ?></td>
                                    <td>
                                        <?php
                                        $totalSpoil = $this->db->select_sum('jumlah_rusak', 'total_spoil')
                                            ->from('tb_opname_rusak')
                                            ->join('tb_opname', 'tb_opname.id_opname = tb_opname_rusak.id_opname', 'left')
                                            ->where('id_brg', $item->id_brg)
                                            ->where('status_opname', "1")
                                            ->where('MONTH(tgl_opname)', $bulan) // Filter berdasarkan bulan
                                            ->where('YEAR(tgl_opname)', $tahun) // Filter berdasarkan tahun
                                            ->get()
                                            ->row();

                                        // Jika hasil tidak ditemukan, ganti dengan 0
                                        $totalSpoil = $totalSpoil->total_spoil ?? 0;
                                        echo $totalSpoil;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($item->$stockAkhirField == "-") {
                                            echo $item->total_stok_setelah_pembelian - $item->penjualan_bulan_ini - $totalSpoil;
                                        } else {
                                            echo $item->$stockAkhirField;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>