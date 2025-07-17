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
                <th class="text-center">Tanggal Pesan</th>
                <th class="text-center">Tanggal Terima</th>
                <th>Supplier</th>
                <th>Jumlah</th>
                <th class="text-right">Total Harga</th>
                <th class="text-right">Dibayarkan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_harga_semua = 0;
            $total_harga_semua_belum_lunas = 0;
            foreach ($pembelian as $key => $pembelian) : ?>
                <?php
                $jumlah = $this->db->from('tb_pemesanan_detail')->where('id_pemesanan', $pembelian['id_pemesanan'])->count_all_results();

                // Menghitung total harga untuk semua status pembayaran
                $query_semua = $this->db->select('SUM(harga_pesan * jumlah_pesan) as total_harga')
                    ->where('id_pemesanan', $pembelian['id_pemesanan'])
                    ->get('tb_pemesanan_detail');
                $total_harga = $query_semua->row()->total_harga ?? 0;
                $total_harga_semua += $total_harga;

                // Menghitung total harga untuk status pembayaran "Belum Lunas"
                $query_belum_lunas = $this->db->select('SUM(harga_pesan * jumlah_pesan) as total_harga')
                    ->join("tb_pemesanan", 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan')
                    ->where('tb_pemesanan_detail.id_pemesanan', $pembelian['id_pemesanan'])
                    ->where('status_pembayaran', 'Belum Lunas')
                    ->get('tb_pemesanan_detail');
                $total_harga_belum_lunas = $query_belum_lunas->row()->total_harga ?? 0;
                $total_harga_semua_belum_lunas += $total_harga_belum_lunas;
                ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo date('d/F/Y', strtotime($pembelian['tgl_pesan'])) ?></td>
                    <td><?php echo date('d/F/Y', strtotime($pembelian['tgl_diterima'])) ?></td>
                    <td><?php echo $pembelian['nama_supplier']; ?></td>
                    <td><?php echo $jumlah ?></td>
                    <td class="text-right"><?php echo "Rp. " . number_format($total_harga) ?></td>
                    <td class="text-right"><?php echo $pembelian['status_pembayaran'] == "Lunas" ? "Rp. " . number_format($total_harga) : "Rp. " . number_format(0) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="fw-bold">Total Biaya Pembelian</td>
                <td class="text-right"><?= "Rp. " . number_format($total_harga_semua) ?></td>
            </tr>
            <tr>
                <td colspan="6" class="fw-bold">Total Hutang</td>
                <td class="text-right"><?= "Rp. " .  number_format($total_harga_semua_belum_lunas) ?></td>
            </tr>
        </tfoot>
    </table>


</body>

</html>