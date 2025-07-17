<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan By Barang</title>
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
                <th class="text-center text-uppercase">No</th>
                <th class="text-center text-uppercase">ID Transaksi</th>
                <th class="text-center text-uppercase">Tanggal</th>
                <th class="text-center text-uppercase">Nama Barang</th>
                <th class="text-center text-uppercase">Barcode</th>
                <th class="text-center text-uppercase">QTY</th>
                <th class="text-center text-uppercase">HPP</th>
                <th class="text-center text-uppercase">Harga</th>
                <th class="text-center text-uppercase">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_harga_semua = 0;
            $total_harga_semua_belum_lunas = 0;
            foreach ($pesanan as $key => $value) : ?>
                <?php
                $query_semua = $this->db->select('SUM(harga_saat_ini * jumlah_jual) as total_harga')
                    ->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan')
                    ->where('tb_pesanan.id_pesanan', $value['id_pesanan'])
                    ->get('tb_pesanan_detail');
                $total_harga = $query_semua->row()->total_harga ?? 0;
                $total_harga_semua += $total_harga;

                $query_semua = $this->db->select('SUM(harga_saat_ini * jumlah_jual) as total_harga')
                    ->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan')
                    ->where('tb_pesanan.id_pesanan', $value['id_pesanan'])
                    ->where('tb_pesanan.status_pembayaran', 'Menunggu Pembayaran')
                    ->get('tb_pesanan_detail');
                $total_harga2 = $query_semua->row()->total_harga ?? 0;
                $total_harga_semua_belum_lunas += $total_harga2;
                ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value['id_pesanan']; ?></td>
                    <td><?= date('d/M/Y', strtotime($value['tgl_pesanan'])); ?></td>
                    <td><?= $value['nama_barang']; ?></td>
                    <td><?= $value['barcode']; ?></td>
                    <td><?= $value['jumlah_jual']; ?></td>
                    <td><?= $value['hpp_barang']; ?></td>
                    <td><?= $value['harga_saat_ini']; ?></td>
                    <td><?= $value['jumlah_jual'] * $value['harga_saat_ini']; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td style="text-align: right !important;" colspan="8" class="fw-bold text-uppercase text-start">Total Penjualan</td>
                <td colspan="1" style="text-align: left !important;"><span id="biaya_pembelian"><?= "Rp. " . number_format($total_harga_semua); ?></span></td>
            </tr>
            <tr>
                <td style="text-align: right !important;" colspan="8" class="fw-bold text-uppercase text-start">Total Autodebet</td>
                <td colspan="1" style="text-align: left !important;"><span id="biaya_belumbayar"><?= "Rp. " . number_format($total_harga_semua); ?></span></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
