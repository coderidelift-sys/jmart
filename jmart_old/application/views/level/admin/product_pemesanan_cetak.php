<?php $this->load->helper('nominal_helper') ?>
<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .card .card-body p.introtext {
        margin: -20px -20px 20px;
        padding: 10px;
        border-bottom: 1px solid #dbdee0;
        color: #8a6d3b;
        background-color: #fcf8e3;
        border-color: #faebcc;
    }

    .page-link {
        position: relative;
        display: block;
        color: #626976;
        background-color: transparent;
        border: 0 solid #cbd5e1;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .bg-secondary {
        color: #ffffff !important;
        background: #626976 !important;
    }

    .dataTables_wrapper .row:first-child {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #EFF3F8;
    }

    .dataTables_wrapper .row:last-child {
        border-bottom: 1px solid #e0e0e0;
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #EFF3F8;
    }

    .dataTables_wrapper .row {
        margin: 0 !important;
    }

    div.dataTables_wrapper div.dataTables_length label {
        font-weight: normal;
        text-align: left;
        white-space: nowrap;
    }

    div.dataTables_wrapper div.dataTables_filter input {
        margin-left: 0.5em;
        display: inline-block;
        width: auto;
    }

    .form-control-sm {
        width: 125px;
        height: 25px;
        line-height: 25px;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        padding-right: 40px;
    }

    .form-select-sm {
        width: 125px;
        height: 25px;
        line-height: 25px;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        padding-right: 40px;
    }

    .table-header {
        background-color: #307ECC;
        color: #FFF;
        font-size: 14px;
        line-height: 50px;
        padding-left: 12px;
        margin-bottom: 1px;
    }

    div.dataTables_wrapper div.dataTables_filter input {
        margin-bottom: 0 !important;
        margin: 0 8px;
    }

    div.dataTables_wrapper div.dataTables_length label {
        margin-bottom: 0 !important;
        margin: 0 8px;
    }

    div.dataTables_wrapper div.dataTables_info {
        margin-bottom: 0 !important;
        margin: 0 8px;
    }

    div.dataTables_wrapper div.dataTables_paginate {
        margin-bottom: 0 !important;
        margin: 0 8px;
    }

    .active>.page-link,
    .page-link.active {
        z-index: 3;
        color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
        cursor: pointer;
    }

    .table>tbody>tr:hover {
        background-color: #F5F5F5;
    }

    .card .table {
        box-shadow: none !important;
    }

    .card-body+.card-body {
        border-top: none !important;
    }

    #barang.choices-select {
        width: 100% !important;
    }

    .choices {
        width: 60%;
        background-color: white;
        border-radius: 0px
    }

    .sign-section {
        padding-bottom: 60px;
        border-bottom: 1px solid;
    }
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Cetak Pemesanan
                </h2>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <div class="btn-group">
                    <a href="<?= base_url('product/pemesanan') ?>" class="btn btn-primary me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                        </svg>
                        Kembali
                    </a>
                    <a href="<?= base_url('product/pemesanan') ?>" id="link_cetak" class="btn btn-secondary me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                            <path d="M19 7h-1V2H6v5H5c-1.654 0-3 1.346-3 3v7c0 1.103.897 2 2 2h2v3h12v-3h2c1.103 0 2-.897 2-2v-7c0-1.654-1.346-3-3-3zM8 4h8v3H8V4zm8 16H8v-4h8v4zm4-3h-2v-3H6v3H4v-7c0-.551.449-1 1-1h14c.552 0 1 .449 1 1v7z"></path>
                            <path d="M14 10h4v2h-4z"></path>
                        </svg>
                        &nbsp;&nbsp;Cetak Pemesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div style="display: flex; flex-direction: row; justify-content: center;" id="bagian_cetak">
            <div style="width: 100%;background:white">
                <div style="border-radius: .25rem; padding: 1.25rem;">
                    <div style="margin-bottom: 30px;">
                        <div style="width: 70%; float: left;">
                            <h3 style="font-size: 24.5px; margin-bottom: .75rem;">J-MART</h3>
                            <p style="margin-bottom: 0;">
                                Perum Griya Kondang Asri Blok BB 1 No. 3 RT.19 RW. Kel. Kondang Jaya, Karawang TImur <br>
                                Kabupaten Karawang, Jawa Barat, 41313<br>
                                85319144359
                            </p>
                        </div>
                        <div style="width: 30%; float: right;">
                            <h3 style="font-size: 24.5px; text-align: right; margin-bottom: .75rem;">Pesanan Pembelian</h3>
                            <table>
                                <tr>
                                    <td>Tanggal Buat</td>
                                    <td>:</td>
                                    <td><?= date('d/M/Y H:i:s', strtotime(($pemesanan['tgl_pesan']))) ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pesan</td>
                                    <td>:</td>
                                    <td><?= date('d/M/Y H:i:s', strtotime(($pemesanan['tgl_pesan']))) ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Kirim</td>
                                    <td>:</td>
                                    <td><?= date('d/M/Y H:i:s', strtotime(($pemesanan['tgl_kirim']))) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <div style="width: 70%; float: left;">
                            <br>
                            <p style="margin-bottom: 0;">
                                DIBELI DARI:<br>
                                <?= $pemesanan['nama_supplier'] ?><br>
                                <br>
                                <br>
                            </p>
                        </div>
                        <div style="width: 30%; float: right;">
                            <br>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>DIKIRIM KE:</td>
                                    </tr>
                                    <tr>
                                        <td>Main Store</td>
                                    </tr>
                                    <tr>
                                        <td>Perum Griya Kondang Asri Blok BB 1 No. 3 RT.19 RW.007 Kel. Kondang Jaya, Karawang TImur </td>
                                    </tr>
                                    <tr>
                                        <td>Kabupaten Karawang, Jawa Barat, 41313</td>
                                    </tr>
                                    <tr>
                                        <td>85319144359</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div>
                        <table class="margin-top:10px !important" style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="text-align: center; border: 1px solid #dee2e6;">No</th>
                                    <th style="text-align: center; border: 1px solid #dee2e6;">Produk</th>
                                    <th style="text-align: center; border: 1px solid #dee2e6;">Barcode</th>
                                    <th style="text-align: center; border: 1px solid #dee2e6;">Harga Beli (Rp.)</th>
                                    <th style="text-align: center; border: 1px solid #dee2e6;">Dipesan</th>
                                    <th style="text-align: center; border: 1px solid #dee2e6;">Total (Rp.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $subtotal = 0; // inisialisasi variabel subtotal
                                foreach ($produk as $key => $value) :
                                    $subtotal += $value['jumlah_pesan'] * $value['harga_pesan']; // menghitung subtotal
                                ?>
                                    <tr>
                                        <td style="text-align: center; border: 1px solid #dee2e6;"><?= $key + 1 ?></td>
                                        <td style="border: 1px solid #dee2e6;"><?= $value['nama_barang'] ?></td>
                                        <td style="text-align: center; border: 1px solid #dee2e6;"><?= $value['barcode'] ?></td>
                                        <td style="text-align: right; border: 1px solid #dee2e6;">Rp. <?= number_format($value['harga_pesan']) ?></td>
                                        <td style="text-align: right; border: 1px solid #dee2e6;"><?= $value['jumlah_pesan'] ?></td>
                                        <td style="text-align: right; border: 1px solid #dee2e6;">Rp. <?= number_format($value['jumlah_pesan'] * $value['harga_pesan']) ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td style="text-align: end; border: 1px solid #dee2e6;" colspan="5"><b>TOTAL</b></td>
                                    <td style="text-align: right; border: 1px solid #dee2e6;">Rp. <?= number_format($subtotal) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="display: flex; flex-direction: column; margin-top: 15px;">
                        <div style="text-align: center;">
                            <div style="font-size: 16px;">Terbilang:<br><b><?= terbilang($subtotal) . " Rupiah" ?></b></div>
                        </div>
                    </div>
                    <div style="display: flex; margin-top: 15px;">
                        <div style="flex: 1;">
                            <div style="font-size: 16px; text-align: center;">Disiapkan Oleh, </div>
                            <br>
                            <div class="sign-section"></div>
                        </div>
                        <div style="flex: 1; margin-left: auto;">
                            <div style="font-size: 16px; text-align: center;">Disetujui Oleh, </div>
                            <br>
                            <div class="sign-section"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $this->load->view('layouts/admin/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#link_cetak').on('click', function(event) {
            event.preventDefault(); // Mencegah tindakan default dari link (navigasi)

            // Mendapatkan isi dari div dengan id bagian_cetak
            var content = $('#bagian_cetak').html();

            // Membuat jendela baru untuk mencetak isi div
            var printWindow = window.open('', 'jqprint', 'width=800,height=600,orientation=landscape');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Cetak Pemesanan</title></head><body>' + content + '</body></html>');
            printWindow.document.close();

            // Mencetak jendela baru
            printWindow.print();
        });
    });
</script>
</body>

</html>