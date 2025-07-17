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
                <th class="text-center">Tanggal</th>
                <th class="text-center">Customer</th>
                <th class="text-center">NIK</th>
                <th class="text-center">Jenis Order</th>
                <th class="text-center">Metode Bayar</th>
                <th class="text-center">Ongkos Kirim</th>
                <th class="text-center">Total Penjualan</th>
                <th class="text-center">Status Pesanan</th>
                <th class="text-center">Status Pembayaran</th>
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
                    <td class="text-center"><?= $key + 1 ?></td>
                    <td><?= $value['id_pesanan'] ?></td>
                    <td><?= date('d/M/Y H:i:s', strtotime($value['tgl_pesanan'])) ?></td>
                    <td><?= $value['nama_member'] ?? 'Walk In Customer'; ?></td>
                    <td><?= $value['nomor_induk'] ?? '-'; ?></td>
                    <td><?= ucwords(str_replace('_', ' ', $value['jenis_order'])) ?></td>
                    <td><?= ucwords(str_replace('_', ' ', $value['metode_bayar'])) ?></td>
                    <td><?= $value['ongkos_kirim'] ?></td>
                    <td><?= $value['grand_total']; ?></td>
                    <td><?= $value['status_pesanan']; ?></td>
                    <td><?= $value['status_pembayaran']; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr class="bg-gradient-dark">
                <td style="text-align: right !important;" colspan="7" class="fw-bold text-uppercase text-start">Total Biaya Pembelian</td>
                <td colspan="4" style="text-align: left !important;"><span id="biaya_pembelian"><?= "Rp. " . number_format($total_harga_semua); ?></span></td>
            </tr>
            <tr>
                <td style="text-align: right !important;" colspan="7" class="fw-bold text-uppercase text-start">Total Autodebet</td>
                <td colspan="4" style="text-align: left !important;"><span id="biaya_belumbayar"><?= "Rp. " .  number_format($total_harga_semua_belum_lunas); ?></span></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
