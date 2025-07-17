<?php $this->load->helper('nominal_helper') ?>
<?php $this->load->view('layouts/admin/head'); ?>
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
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Detail Pemesanan
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
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Pesanan Pembelian Produk</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-3">Pemasok</div>
                                    <div class="col-1">:</div>
                                    <div class="col-8"><?= $pemesanan['nama_supplier'] ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Alamat</div>
                                    <div class="col-1">:</div>
                                    <div class="col-8">-</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Telepon</div>
                                    <div class="col-1">:</div>
                                    <div class="col-8"><?= $pemesanan['kontak_supplier'] ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-3">No. Rekening</div>
                                    <div class="col-1">:</div>
                                    <div class="col-8"><?= $pemesanan['norek_supplier'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-3">Dibuat</div>
                                    <div class="col-1">:</div>
                                    <div class="col-8"><?= date('d/M/Y H:i:s', strtotime(($pemesanan['tgl_pesan']))) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Dipesan</div>
                                    <div class="col-1">:</div>
                                    <div class="col-8"><?= date('d/M/Y H:i:s', strtotime(($pemesanan['tgl_pesan']))) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Dikirim</div>
                                    <div class="col-1">:</div>
                                    <?php
                                    if (empty($pemesanan['tgl_kirim']) || strtotime($pemesanan['tgl_kirim']) === false || $pemesanan['tgl_kirim'] === '0000-00-00 00:00:00') {
                                        echo "<div class='col-8'>Belum Dikirim</div>";
                                    } else {
                                        $formatted_date = date('d/M/Y H:i:s', strtotime($pemesanan['tgl_kirim']));
                                        echo "<div class='col-8'>$formatted_date</div>";
                                    }
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-3">Dikirim Ke</div>
                                    <div class="col-1">:</div>
                                    <div class="col-8">Main Store</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Alamat</div>
                                    <div class="col-1">:</div>
                                    <div class="col-8">Perum Griya Kondang Asri Blok BB 1 No. 3 RT.19 RW.007Kel. Kondang Jaya, Karawang TImur </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-3">Status</div>
                                    <div class="col-1">:</div>
                                    <div class="col-8"><?= $pemesanan['status_pemesanan'] ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Penerima</div>
                                    <div class="col-1">:</div>
                                    <div class="col-8"><?= $pemesanan['nama_kasir'] ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Diterima</div>
                                    <div class="col-1">:</div>
                                    <div class="col-8"><?= date('d/M/Y H:i:s', strtotime(($pemesanan['tgl_diterima']))) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-status-top bg-info"></div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataProduk" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="no">No</th>
                                        <th class="center">Produk</th>
                                        <th class="center">Barcode</th>
                                        <th class="center">Harga Beli (Rp.)</th>
                                        <th class="center">Jumlah</th>
                                        <th class="center">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="new_stock_control">
                                    <?php
                                    $subtotal = 0; // inisialisasi variabel subtotal
                                    foreach ($produk as $key => $value) :
                                        $subtotal += $value['jumlah_pesan'] * $value['harga_pesan']; // menghitung subtotal
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1 ?></td>
                                            <td><?= $value['nama_barang'] ?></td>
                                            <td class="center"><?= $value['barcode'] ?></td>
                                            <td class="text-right">Rp. <?= number_format($value['harga_pesan']) ?></td>
                                            <td class="text-right"><?= $value['jumlah_pesan'] ?></td>
                                            <td class="text-right">Rp. <?= number_format($value['jumlah_pesan'] * $value['harga_pesan']) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-end" colspan="5"><b>TOTAL</b></td>
                                        <td class="text-right">Rp. <?= number_format($subtotal) ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layouts/admin/footer'); ?>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#dataProduk').DataTable({
        ordering: false,
    });
</script>
</body>

</html>