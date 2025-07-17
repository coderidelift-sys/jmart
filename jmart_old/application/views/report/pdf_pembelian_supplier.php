<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .bg-gradient-info {
            background-color: #4e73df;
            color: #fff;
        }

        .bg-gradient-dark {
            background-color: #343a40;
            color: #fff;
        }

        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2 style="text-align: center;">Periode: <?= !empty($start) ? date('d/F/Y', strtotime($start)) : '' ?> s/d <?= !empty($end) ? date('d/F/Y', strtotime($end)) : '' ?></h2>

    <table>
        <thead>
            <tr class="bg-gradient-info">
                <th class="text-center">No</th>
                <th class="text-center">ID Transaksi</th>
                <th class="text-center">Tanggal Terima</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Barcode</th>
                <th class="text-center">QTY</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_harga_semua = 0;
            $total_harga_semua_belum_lunas = 0;
            foreach ($pembelian as $key => $barang) : ?>
                <?php
                // Menghitung total harga untuk semua status pembayaran
                $query_semua = $this->db->select('SUM(harga_pesan * jumlah_pesan) as total_harga')
                    ->where('tb_pemesanan_detail.id_brg', $barang['id_brg'])
                    ->get('tb_pemesanan_detail');
                $total_harga = $query_semua->row()->total_harga ?? 0;
                $total_harga_semua += $total_harga;

                // Menghitung total harga untuk status pembayaran "Belum Lunas"
                $query_belum_lunas = $this->db->select('SUM(harga_pesan * jumlah_pesan) as total_harga')
                    ->join("tb_pemesanan", 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan')
                    ->where('tb_pemesanan_detail.id_brg', $barang['id_brg'])
                    ->where('status_pembayaran', 'Belum Lunas')
                    ->get('tb_pemesanan_detail');
                $total_harga_belum_lunas = $query_belum_lunas->row()->total_harga ?? 0;
                $total_harga_semua_belum_lunas += $total_harga_belum_lunas;
                ?>
                <tr>
                    <td class="text-center"><?= $key + 1 ?></td>
                    <td><?= $barang['id_pemesanan'] ?></td>
                    <td><?= date('d/M/Y', strtotime($barang['tgl_diterima'])) ?></td>
                    <td><?= $barang['nama_barang'] ?></td>
                    <td><?= $barang['barcode'] ?></td>
                    <td><?= $barang['jumlah_pesan'] ?></td>
                    <td><?= $barang['harga_pesan'] ?></td>
                    <td><?= $barang['jumlah_pesan'] * $barang['harga_pesan'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="fw-bold">Total Biaya Pembelian</td>
                <td class="text-right"><?= "Rp. " . number_format($total_harga_semua) ?></td>
            </tr>
            <tr>
                <td colspan="7" class="fw-bold">Total Hutang</td>
                <td class="text-right"><?= "Rp. " .  number_format($total_harga_semua_belum_lunas) ?></td>
            </tr>
        </tfoot>
    </table>


</body>

</html>