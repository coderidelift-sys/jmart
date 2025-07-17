<?php $this->load->view('layouts/admin/head'); ?>
<!-- STYLE DISINI -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<style>
    .bg-green {
        color: #ffffff !important;
        background: #2fb344 !important;
    }

    .bg-lime {
        color: #ffffff !important;
        background: #74b816 !important;
    }

    .bg-orange {
        color: #ffffff !important;
        background: #f76707 !important;
    }

    .bg-yellow {
        color: #ffffff !important;
        background: #f59f00 !important;
    }

    .bg-green {
        color: #ffffff !important;
        background: #2fb344 !important;
    }

    .bg-azure {
        color: #ffffff !important;
        background: #4299e1 !important;
    }

    .bg-red {
        color: #ffffff !important;
        background: #d63939 !important;
    }

    .bg-secondary {
        color: #ffffff !important;
        background: #626976 !important;
    }

    .card {
        --tblr-card-border-radius: 4px;
        box-shadow: rgb(30 41 59 / 4%) 0 2px 4px 0;
        border: 1px solid rgba(98, 105, 118, 0.16);
        background: var(--tblr-card-bg, #ffffff);
        border-radius: var(--tblr-card-border-radius);
        transition: transform 0.3s ease-out, opacity 0.3s ease-out, box-shadow 0.3s ease-out;
    }

    .page-link {
        position: relative;
        display: block;
        color: #626976;
        background-color: transparent;
        border: 0 solid #cbd5e1;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    #struk .highline,
    #struk .highline td,
    #struk .highline hr {
        margin: 0px;
        padding: 0px;
    }

    #struk hr {
        border-bottom: dashed 1px #000 !important;
    }

    #struk hr {
        border-bottom: dashed 1px #000 !important;
    }

    #struk hr {
        border-bottom: dashed 1px #757375;
        margin: 0px 0px 0px 0px;
        padding: 0px;
        line-height: 0;
    }

    hr {
        margin: 20px 0;
        border: 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #fff;
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

    .padding1010 {
        padding: 5px !important;
    }

    .quick-button {
        margin-bottom: -1px;
        padding: 30px 0 10px;
        font-size: 14px;
        display: block;
        text-align: center;
        cursor: pointer;
        position: relative;
        transition: all .3s ease;
        opacity: .9;
    }

    .quick-button:hover {
        text-decoration: none;
        opacity: 1;
    }

    .quick-button i {
        font-size: 32px;
    }

    .white {
        color: #fff !important;
    }

    .bmGreen {
        background: #16a085 !important;
    }

    .blightBlue {
        background: #5bc0de !important;
    }

    .bgrey {
        background: #b2b8bd !important;
    }

    .bdarkGreen {
        background: #78cd51 !important;
    }
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<!-- CONTAIN DISINI -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Data Penjualan
                </h2>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <div class="btn-group">
                    <a href="<?= base_url('kasir') ?>" class="btn btn-primary me-1" title="Kelola Tagihan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Tambah
                    </a>
                    <a href="#" class="btn btn-secondary me-1" title="Lihat Diskon Tagihan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3"></path>
                        </svg>
                        Import
                    </a>
                    <a href="#" class="btn btn-success" title="Lihat Diskon Tagihan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-spreadsheet" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                            <path d="M8 11h8v7h-8z"></path>
                            <path d="M8 15h8"></path>
                            <path d="M11 11v7"></path>
                        </svg>
                        Export
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row mb-3">
            <div class="col-sm-12 col-md-3 mb-2">
                <div class="card bg-secondary">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="3" y="5" width="18" height="14" rx="3"></rect>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                <line x1="7" y1="15" x2="7.01" y2="15"></line>
                                <line x1="11" y1="15" x2="13" y2="15"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="card-body">
                        Total Transaksi
                        <h2>
                            <?= $total ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 mb-2">
                <div class="card bg-red">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-red">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="3" y="5" width="18" height="14" rx="3"></rect>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                <line x1="7" y1="15" x2="7.01" y2="15"></line>
                                <line x1="11" y1="15" x2="13" y2="15"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="card-body">
                        Pending
                        <h2>
                            <?= $pending ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 mb-2">
                <div class="card bg-azure">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-azure">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="3" y="5" width="18" height="14" rx="3"></rect>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                <line x1="7" y1="15" x2="7.01" y2="15"></line>
                                <line x1="11" y1="15" x2="13" y2="15"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="card-body">
                        Pesanan Disiapkan
                        <h2>
                            <?= $dikemas ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 mb-2">
                <div class="card bg-green">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-green">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="3" y="5" width="18" height="14" rx="3"></rect>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                <line x1="7" y1="15" x2="7.01" y2="15"></line>
                                <line x1="11" y1="15" x2="13" y2="15"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="card-body">
                        Sedang Dikirim
                        <h2>
                            <?= $dikirim ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body pb-2">
                        <div class="row d-flex mb-4">
                            <div class="col-sm-12 col-md-2 col-form-label text-center">
                                <label class="form-label">
                                    Pilih Anggota
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-9">
                                <select id="select_anggota" class="form-select" style="width: 100%;">
                                    <option value="" selected disabled>-- Pilih Anggota --</option>
                                </select>
                            </div>
                        </div>
                        <div class="row d-flex text-center">
                            <div class="col">
                                <p class="mb-1 text-muted">
                                    Nama Lengkap
                                </p>
                                <p id="nama_lengkap_cari" class="lead strong">-</p>
                            </div>
                            <div class="col">
                                <p class="mb-1 text-muted">
                                    Jenis Kelamin
                                </p>
                                <p id="jenis_kelamin_cari" class="lead strong">-</p>
                            </div>
                            <div class="col">
                                <p class="mb-1 text-muted">
                                    Nomor Induk
                                </p>
                                <p id="nomor_induk_cari" class="lead strong">-</p>
                            </div>
                            <div class="col">
                                <p class="mb-1 text-muted">
                                    No HP
                                </p>
                                <p id="no_hp_cari" class="lead strong">-</p>
                            </div>
                            <div class="col">
                                <p class="mb-1 text-muted">
                                    Status
                                </p>
                                <p id="status_cari" class="lead strong">-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card table">
                    <div class="card-body p-0">
                        <div class="table-header">
                            Hasil untuk Data Penjualan
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover table-striped" id="example" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="padding: 15px;font-size:11px;background: repeat-x #F4F4F4;"><button class="table-sort">No</button></th>
                                        <th style="padding: 15px;font-size:11px;background: repeat-x #F4F4F4;"><button class="table-sort">Action</button></th>
                                        <th style="padding: 15px;font-size:11px;background: repeat-x #F4F4F4;"><button class="table-sort">ID Transaksi</button></th>
                                        <th style="padding: 15px;font-size:11px;background: repeat-x #F4F4F4;"><button class="table-sort">Date</button></th>
                                        <th style="padding: 15px;font-size:11px;background: repeat-x #F4F4F4;"><button class="table-sort">Customer</button></th>
                                        <th style="padding: 15px;font-size:11px;background: repeat-x #F4F4F4;"><button class="table-sort">Status</button></th>
                                        <th style="padding: 15px;font-size:11px;background: repeat-x #F4F4F4;"><button class="table-sort">Tipe</button></th>
                                        <th style="padding: 15px;font-size:11px;background: repeat-x #F4F4F4;"><button class="table-sort">Pembayaran</button></th>
                                        <th style="padding: 15px;font-size:11px;background: repeat-x #F4F4F4;"><button class="table-sort">Jenis</button></th>
                                        <th style="padding: 15px;font-size:11px;background: repeat-x #F4F4F4;"><button class="table-sort">Total</button></th>
                                    </tr>
                                    <tr>
                                        <th class="align-middle text-center">
                                            #
                                        </th>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            <input id="id_transaksi_filter" type="text" class="form-control" placeholder="ID Transaksi">
                                        </th>
                                        <th>
                                            <input id="tgl_transaksi_filter" type="date" class="form-control">
                                        </th>
                                        <th class="align-middle text-center">
                                            #
                                        </th>
                                        <th>
                                            <select name="status_pesanan_filter" id="status_pesanan_filter" class="form-select">
                                                <option value="">-- Pilih Status Pesanan --</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Disiapkan">Disiapkan</option>
                                                <option value="Dikirim">Dikirim</option>
                                                <option value="Selesai">Selesai</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="metode_filter" id="metode_filter" class="form-select">
                                                <option value="">-- Pilih Metode Bayar --</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Transfer">Transfer</option>
                                                <option value="Autodebet">Autodebit</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="status_pembayaran_filter" id="status_pembayaran_filter" class="form-select">
                                                <option value="">-- Pilih Status Pembayaran --</option>
                                                <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                                                <option value="Lunas">Lunas</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="jenis_order_filter" id="jenis_order_filter" class="form-select">
                                                <option value="">-- Pilih Jenis Order --</option>
                                                <option value="ambil_sendiri">Ambil Sendiri</option>
                                                <option value="dianterin">Dianterin</option>
                                                <option value="dianterin_pt">Dianterin ke PT</option>
                                            </select>
                                        </th>
                                        <th class="align-middle text-center">
                                            #
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="buktiTransaksiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: calc(90vh - 200px);overflow-y: auto;" id="modalBukti">
            </div>
            <div class="modal-footer d-flex">
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary-outline" id="send-email1" data-idx="_a83a14c1e50566a02b904f4046b74369"><span>Kirim</span></a>
                        <a class="btn btn-primary" id="cetak_bukti"><span>Cetak</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cetakInvoiceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cetak Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: calc(90vh - 200px);overflow-y: auto;" id="modalFaktur">
            </div>
            <div class="modal-footer d-flex">
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary-outline" id="send-email1" data-idx="_a83a14c1e50566a02b904f4046b74369"><span>Kirim</span></a>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary" id="cetak_invoice"><span>Cetak</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalQRCode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-qrcode" class="modal-body p-0" style="max-height: calc(90vh - 200px);overflow-y: auto;">
                <div class="container">
                    <div class="card mt-3">
                        <div class="card-header justify-content-between">
                            <strong>Invoice : 01/01/01/2018</strong>
                            <span class="float-end"> <strong>Status:</strong> Pending</span>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="" style="width: 50%;">
                                    <h4>To:</h4>
                                    <div> <strong>Bob Mart</strong> </div>
                                    <div>Attn: Daniel Marek</div>
                                    <div>43-190 Mikolow, Poland</div>
                                    <div>Email: marek@daniel.com</div>
                                    <div>Phone: +48 123 456 789</div>
                                </div>
                                <div style="width: 50%;">
                                    <div class="row justify-content-end" style="font-size: 0.9rem;">
                                        <div class="col-auto">
                                            <div id="qrcode" style="width: 84px !important;height:84px !important"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tabel-pemesanan"></div>
                            <div class="row">
                                <div class="col-lg-12 ml-auto">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <td class="left"><strong>Subtotal</strong></td>
                                                <td class="right"><span id="kr-subtotal"></span></td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Discount</strong></td>
                                                <td class="right">0</td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Total</strong></td>
                                                <td class="right"><strong id="kr_total"></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="cetak_qrcode">Cetak</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ubahTransaksiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proses Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" id="modalUbahBody">

            </div>
            <div class="modal-footer justify-content-center">
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/admin/footer'); ?>
<!-- SCRIPT DISINI -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="<?= base_url('public/template/js/') ?>imin-printer.min.js"></script>
<script>
    function modalUbah(id) {
        $("#ubahTransaksiModal").modal('hide');
        var url = "<?php echo base_url('penjualan/get_bukti_transaksi/'); ?>" + id;

        fetch(url)
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Respons tidak ok: ' + response.status);
                }
                return response.json();
            })
            .then(function(data) {
                $("#ubahTransaksiModal").modal('show');
                var status = data[0].status_pesanan;
                var tanggal = data[0].tgl_pesanan;
                var tgl_pesanan_format = new Date(tanggal).toISOString().split('T')[0];

                if (status == "Pending") {
                    var warna = "bgrey";
                } else {
                    var warna = "bdarkGreen";
                }
                var tambahanHtml4 = `
            <div class="card">
               <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                     <li class="nav-item">
                        <a href="#tabs-home-ex1" class="nav-link active" data-bs-toggle="tab">Proses</a>
                     </li>
                     <li class="nav-item">
                        <a href="#tabs-profile-ex1" class="nav-link" data-bs-toggle="tab">Ubah</a>
                     </li>
                  </ul>
               </div>
               <div class="card-body">
                  <div class="tab-content">
                     <div class="tab-pane active show" id="tabs-home-ex1">
                        <div class="row">
                           <div class="col-12 col-md-6 padding1010">
                              <a target="_blank" class="${warna} white quick-button small" href="<?= base_url('penjualan/siapkan/') ?>${id}" style="text-decoration: none;">
                                 <i class="fa fa-gift"></i>
                                 <p style="font-size:16px !important">Siapkan Pesanan</p>
                              </a>
                           </div>
                           <div class="col-12 col-md-6 padding1010">
                              <a target="_blank" class="blightBlue white quick-button small" href="<?= base_url('penjualan/detail/') ?>${id}" style="text-decoration: none;">
                                 <i class="fa fa-info"></i>
                                 <p style="font-size:16px !important">Lihat Detail</p>
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane" id="tabs-profile-ex1">
                        <form id="edit_trans" class="form-horizontal" method="POST">
                           <div class="form_edit_trans invis" style="display: block;">
                              <div class="row mb-3">
                                 <label for="sale_date" class="col-md-4 col-form-label">Tanggal Penjualan</label>
                                 <div class="col-md-8">
                                    <div class="input-group date">
                                       <input type="hidden" id="id_pesanan_ubah" value="${data[0].id_pesanan}">
                                       <input value="${tgl_pesanan_format}" type="date" id="sale_date" name="trans_date" class="form-control" readonly>
                                    </div>
                                 </div>
                              </div>
                              <div class="row mb-3">
                                 <label for="order_status" class="col-md-4 col-form-label">Status Pesanan</label>
                                 <div class="col-md-8">
                                    <select id="order_status" name="order_status" class="form-select">
                                    // OPTION PENDING
                                    ${data[0].status_pesanan === "Pending" ? '<option value="Pending">Pending</option>' : ''}
                                    
                                    // OPTION DIKEMAS
                                    ${data[0].status_pesanan === "Dikemas" && data[0].jenis_order === "dianterin" ? '<option value="Dikemas">Dikemas</option>' : ''}
                                    ${data[0].status_pesanan === "Dikemas" && data[0].jenis_order === "ambil_sendiri" ? '<option value="Dikemas">Dikemas</option><option value="Selesai">Selesai</option>' : ''}
                                    ${data[0].status_pesanan === "Dikemas" && data[0].jenis_order === "dianterin_pt" ? `<option value="Dikirim">Dikirim</option>` : ''}

                                    // OPTION DIKIRIM
                                    ${data[0].status_pesanan === "Dikirim" && data[0].jenis_order === "dianterin_pt" ? `
                                          <option value="Selesai">Selesai</option>
                                    ` : ''}

                                    // OPTION SELESAI
                                    ${data[0].status_pesanan === "Selesai" ? `
                                          <option value="Selesai">Selesai</option>
                                    ` : ''}
                                    </select>
                                 </div>
                              </div>
                              <div class="row mb-3">
                                 <label for="payment_status" class="col-md-4 col-form-label">Status Pembayaran</label>
                                 <div class="col-md-8">
                                    <select id="payment_status" name="payment_status" class="form-select">
                                       <option value="">-- Ubah Status Pembayaran --</option>
                                       <option value="Menunggu Pembayaran" ${data[0].status_pembayaran === 'Menunggu Pembayaran' ? 'selected' : ''}>Menunggu Pembayaran</option>
                                       <option value="Lunas" ${data[0].status_pembayaran === 'Lunas' ? 'selected' : ''}>Lunas</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row mb-3">
                                 <label for="note" class="col-md-4 col-form-label">Catatan</label>
                                 <div class="col-md-8">
                                    <textarea name="note" id="note" class="form-control" rows="3"></textarea>
                                 </div>
                              </div>
                              <div class="row mb-3">
                              <label for="note" class="col-md-4 col-form-label">Action</label>
                                 <div class="col-md-8">
                                    <button onclick="handleSubmit()" class="btn btn-primary submit_perubahan" type="button">Submit Perubahan</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            `;

                // Menambahkan elemen HTML tambahan ke dalam modal-body
                $("#modalUbahBody").html(tambahanHtml4);
            })
            .catch(function(error) {
                console.error('Terjadi kesalahan: ', error);
            });

        $("#ubahTransaksiModal").modal('show');
    }

    function myQRCode(id) {
        var url = "<?php echo base_url('penjualan/get_bukti_transaksi/'); ?>" + id;

        fetch(url)
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Respons tidak ok: ' + response.status);
                }
                return response.json();
            })
            .then(function(data) {
                $("#modalQRCode").modal('show');
                var inputan = data[0].id_pesanan;
                document.getElementById("qrcode").innerHTML = '';
                new QRCode(document.getElementById("qrcode"), inputan);

                var tambahanHtml3 = `
            <div class="table-responsive-sm">
               <table class="table table-sm table-striped">
                  <thead>
                     <tr>
                        <th class="center">#</th>
                        <th>Item</th>
                        <th class="right">Harga</th>
                        <th class="center">Qty</th>
                        <th class="right">Total</th>
                     </tr>
                  </thead>
                  <tbody>`;

                for (var i = 0; i < data.length; i++) {
                    tambahanHtml3 +=
                        `<tr>
                        <td class="text-center">${i+1}</td>
                        <td class="left strong">${data[i].nama_barang}</td>
                        <td class="right">${data[i].harga_saat_ini}</td>
                        <td class="center">${data[i].jumlah_jual}</td>
                        <td class="right">${data[i].harga_saat_ini * data[i].jumlah_jual}</td>
                     </tr>`;
                }

                tambahanHtml3 += `</tbody>
               </table>
            </div>
            `;

                document.getElementById("kr-subtotal").innerHTML = data[0].grand_total;
                document.getElementById("kr_total").innerHTML = data[0].grand_total;

                $("#tabel-pemesanan").html(tambahanHtml3);
            })
            .catch(function(error) {
                console.error('Terjadi kesalahan: ', error);
            });
    }

    function BuktiTransaksi(id) {
        var url = "<?php echo base_url('penjualan/get_bukti_transaksi/'); ?>" + id;

        fetch(url)
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Respons tidak ok: ' + response.status);
                }
                return response.json();
            })
            .then(function(data) {
                $("#buktiTransaksiModal").modal('show');

                var tambahanHtml = `
               <div id="print_invoice" class="pb-body">
                  <table border="0" class="struk-pay" id="struk" style="width: 350px !important; font-size: px !important;">
                      <tbody>
                     <tr id="logo_name">
                        <td colspan="5" align="center"><b class="judul">J-MART</b></td>
                     </tr>
                     <tr id="logo_space">
                        <td colspan="5">&nbsp;</td>
                     </tr>
                     <tr>
                        <td colspan="6" align="right" style="text-align: right;">Receipt Salinan</td>
                     </tr>
                     <tr>
                        <td colspan="6">
                           <hr>
                        </td>
                     </tr>`;
                var tglPesanan = new Date(data[0].tgl_pesanan);
                var tanggal = tglPesanan.getDate();
                var bulan = tglPesanan.getMonth() + 1;
                var tahun = tglPesanan.getFullYear();

                var jam = tglPesanan.getHours();
                var menit = tglPesanan.getMinutes();
                var detik = tglPesanan.getSeconds();

                var tanggalFormat = tanggal + '-' + bulan + '-' + tahun;
                var waktuFormat = jam + ':' + menit + ':' + detik;

                tambahanHtml += `<tr>
                        <td colspan="2">
                           <span id="trans_date" class="detail_cashier">${tanggalFormat}</span>
                        </td>
                        <td colspan="2" class="text-end">
                           <span id="trans_date" class="detail_cashier">${waktuFormat}</span>
                        </td>
                     </tr>
                     <tr style="margin-top: 20px !important;">
                        <td style="width: 30%;">No. Struk </td>
                        <td>:</td>
                        <td colspan="2" class="text-end">
                           <span>${data[0].id_pesanan}</span>
                        </td>
                     </tr>
                     <tr>
                        <td style="width: 30%;"> Oleh </td>
                        <td>:</td>
                        <td colspan="2" class="text-end"><span class="kasir_name detail_cashier">RICO</span></td>
                     </tr>
                     <tr>
                        <td style="width: 30%;"> Alat Kasir</td>
                        <td>:</td>
                        <td colspan="2" class="text-end"><span class="detail_cashier">ADMIN</span></td>
                     </tr>

                     <tr id="customer_data">
                        <td style="width: 30%;"> Anggota </td>
                        <td>:</td>
                        <td colspan="2" class="text-end"><span id="customer_name">${data[0].nama_member}</span></td>
                     </tr>
                     <tr class="highline" style="height: 23px;">
                        <td colspan="5">
                           <hr>
                        </td>
                     </tr>`;
                for (var i = 0; i < data.length; i++) {
                    tambahanHtml += `
               <tr>
                  <td class="tbl-product" colspan="3">
                     ${data[i].nama_barang} <br>
                     <indent style="padding: 15px !important;">
                        ${data[i].jumlah_jual}x @${data[i].harga_saat_ini} </indent>
                  </td>
                  <td align="right" style="vertical-align: top;">
                     <span class="number tbl-product">
                        ${data[i].jumlah_jual * data[i].harga_saat_ini} </span>
                  </td>
               </tr>
               `;
                }

                tambahanHtml += `
                     <tr class="highline" style="height: 23px;">
                        <td colspan="5">
                           <hr>
                        </td>
                     </tr>
                     <tr>
                        <td class="line-ttl-product" colspan="3"><span class="ttl-product">Subtotal (12 items,14 qty)</span></td>
                        <td class="line-ttl-product" align="right" width="30%"><span class="number ttl-product">${data[0].grand_total}</span></td>
                     </tr>

                     <tr style="height: 10px">
                        <td></td>
                     </tr>
                     <tr>
                        <td class="line-ttl-product" colspan="3"><span class="ttl-product">Total Diskon</span></td>
                        <td class="line-ttl-product" align="right" width="30%">
                           <span class="ttl-product">0</span>
                        </td>
                     </tr>
                     <tr style="height: 10px">
                        <td></td>
                     </tr>
                     <tr>
                        <td class="line-ttl-product" colspan="3"><strong class="ttl-product">Total</strong></td>
                        <td class="line-ttl-product" align="right" width="30%">
                           <strong class="ttl-product">${data[0].grand_total}</strong>
                        </td>
                     </tr>
                     <tr class="highline" style="height: 23px;">
                        <td class="line-ttl-product" colspan="4">
                           <hr>
                        </td>
                     </tr>
                     <tr class="bayar_hutang">
                        <td class="line-ttl-product" colspan="3"><span class="ttl-product">Kredit</span></td>
                        <td class="line-ttl-product" align="right" width="30%"><span class="ttl-product">0</span></td>
                     </tr>

                     <tr class="highline" style="height: 23px;">
                        <td class="line-ttl-product" colspan="4">
                           <hr>
                        </td>
                     </tr>
                     <tr>
                        <td class="line-ttl-product" colspan="3">Total Bayar</td>
                        <td class="line-ttl-product" align="right" width="30%">${data[0].total_bayar}</td>
                     </tr>
                     <tr class="highline" style="height: 23px;">
                        <td class="line-ttl-product" colspan="4">
                           <hr>
                        </td>
                     </tr>
                     <tr>
                        <td class="line-ttl-product" colspan="3"><strong class="footer-ttl-product">Kembalian</strong></td>
                        <td class="line-ttl-product" align="right" width="30%"><strong class="footer-ttl-product">${data[0].kembalian}</strong></td>
                     </tr>
                     <tr style="height: 23px;">
                        <td class="line-ttl-product" colspan="10">
                           <hr>
                        </td>
                     </tr>
                     <tr>
                        <td></td>
                     </tr>
                     <tr>
                        <td colspan="5"><span id="header_text_demo" class="text-footer-struk ">
                              <p style="text-align:center;">Terima Kasih &amp; Selamat Belanja Kembali<br>
                                 &nbsp;</p>
                           </span></td>
                     </tr>
                  </tbody>
                  </table>
               </div>
            `;

                // Menambahkan elemen HTML tambahan ke dalam modal-body
                $("#modalBukti").html(tambahanHtml);
            })
            .catch(function(error) {
                console.error('Terjadi kesalahan: ', error);
            });
    }


    function CetakInvoice(id) {
        var url = "<?php echo base_url('penjualan/get_bukti_transaksi/'); ?>" + id;

        fetch(url)
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Respons tidak ok: ' + response.status);
                }
                return response.json();
            })
            .then(function(data) {
                $("#cetakInvoiceModal").modal('show');

                var tambahanHtml2 = `
               <div id="print_invoice" class="pb-body print-new">
               <table width="700" cellpadding="0" cellspacing="0" align="center" border="0">
                  <tbody>
                     <tr>
                        <td valign="top">
                           <!-- B E G I N  H E A D E R -->
                           <table width="700" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color: #fff;margin-bottom: 15px;">
                              <tbody>
                                 <tr>
                                    <td style="padding: 0px 15px 0px 15px;">
                                       <table border="0" cellspacing="0" cellpadding="0" width="700">
                                          <tbody>
                                             <tr>
                                                <td width="60%">
                                                </td>
                                                <td>
                                                   <h1 style="font-size: 32px;font-weight: 800">FAKTUR</h1>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td width="60%">
                                                   <p style="font-size: 15px;line-height: 18px;">
                                                      <b style="line-height: 1.1 !important; font-size: 16px !important; text-transform: uppercase;">J-MART</b><br>
                                                   </p>
                                                </td>
                                                <td width="40%" valign="top">
                                                   <div class="delivered-to">
                                                      <p style="margin-bottom: 5px;"><b>Kepada :</b></p>
                                                      <p class="address-delive">
                                                         <b>${data[0].nama_member}</b>
                                                         <br>
                                                      </p>
                                                   </div>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <!-- E N D  H E A D E R -->
                           <!-- S T A R T  B O D Y -->
                           <table width="700" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#ffffff;">
                              <tbody>
                                 <tr>
                                    <td style="padding: 0 15px;">
                                       <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#F5F5F5" style="padding-top: 10px;padding-bottom: 10px;background: #F5F5F5">
                                          <tbody>
                                             <tr>
                                                <td colspan="3" style="padding: 5px 15px;"></td>
                                             </tr>
                                             <tr>
                                                <td style="font-size: 15px;padding: 3px 15px;" width="130">Tanggal Faktur</td>
                                                <td style="font-size: 15px;padding: 3px 0;" width="1">:</td>
                                                <td style="font-size: 15px;padding: 3px 15px;" width="600">${data[0].tgl_pesanan}</td>
                                             </tr>
                                             <tr>
                                                <td style="font-size: 15px;padding: 3px 15px;">No Faktur</td>
                                                <td style="font-size: 15px;padding: 3px 0;">:</td>
                                                <td style="font-size: 15px;padding: 3px 15px;">${data[0].id_pesanan}</td>
                                             </tr>
                                             <tr>
                                                <td style="font-size: 15px;padding: 3px 15px;">Metode Bayar</td>
                                                <td style="font-size: 15px;padding: 3px 0;">:</td>
                                                <td style="font-size: 15px;padding: 3px 15px;">${data[0].metode_bayar}</td>
                                             </tr>
                                             <tr>
                                                <td colspan="3" style="padding: 5px 15px;"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                                 <tr>
                                 <td style="padding: 15px 15px 5px 15px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-top: 0.5px solid #000;">
                                       <tbody>
                                          <tr>
                                             <th bgcolor="#F5FAF5" style="padding: 5px 15px;font-size: 15px;border-top:0.5px solid #000;border-right: 0.5px solid #000;border-left: 0.5px solid #000;" width="30">No</th>
                                             <th bgcolor="#F5FAF5" style="padding: 5px 15px;font-size: 15px;border-top:0.5px solid #000;border-right: 0.5px solid #000">Deskripsi Barang</th>
                                             <th bgcolor="#F5FAF5" style="padding: 5px 15px;font-size: 15px;border-top:0.5px solid #000;border-right: 0.5px solid #000" width="45">Jml</th>
                                             <th bgcolor="#F5FAF5" style="padding: 5px 15px;font-size: 15px;border-top:0.5px solid #000;border-right: 0.5px solid #000" width="60">Harga Satuan</th>
                                             <th bgcolor="#F5FAF5" style="padding: 5px 15px;font-size: 15px;border-top:0.5px solid #000;border-right: 0.5px solid #000" width="40">Disc %</th>
                                             <th bgcolor="#F5FAF5" style="padding: 5px 15px;font-size: 15px;border-top:0.5px solid #000;border-right: 0.5px solid #000">Jumlah</th>
                                          </tr>`;

                for (var i = 0; i < data.length; i++) {
                    tambahanHtml2 += `
            <tr>
               <td style="padding: 2px 10px;font-size: 15px;border-right: 0.5px solid #000;line-height: normal;border-left: 0.5px solid #000;" class="text-center p5" valign="top">
                  ${i+1} </td>
               <td style="padding: 2px 10px;font-size: 15px;border-right: 0.5px solid #000;line-height: normal" class="p5" valign="top">
                  ${data[i].nama_barang} <br>${data[i].barcode} </td>
               <td style="padding: 2px 10px;font-size: 15px;border-right: 0.5px solid #000;line-height: normal" class="text-center p5" valign="top">
                  ${data[i].jumlah_jual} </td>
               <td style="padding: 2px 10px;font-size: 15px;border-right: 0.5px solid #000;line-height: normal" class="text-right p5" valign="top">
                  ${data[i].harga_saat_ini} </td>
               <td style="padding: 2px 10px;font-size: 15px;border-right: 0.5px solid #000;line-height: normal" class="text-right p5" valign="top"></td>
               <td style="padding: 2px 10px;font-size: 15px;border-right: 0.5px solid #000;line-height: normal" class="text-right p5" valign="top">
                  ${data[i].jumlah_jual * data[i].harga_saat_ini} </td>
            </tr>
            `;
                }

                tambahanHtml2 += `<tr>
                           <td style="padding: 2px 10px;font-size: 15px;border-right: 0.5px solid #000;border-top: 0.5px solid #000;border-bottom: 0.5px solid #000;border-left: 0.5px solid #000;" colspan="3" rowspan="2" valign="top"><b>Catatan : </b></td>
                           <td style="padding: 0;font-size: 15px;border-top: 0.5px solid #000;border-right: 0.5px solid #000" colspan="3" class="p0p">
                              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                 <tbody>
                                    <tr>
                                       <td style="padding: 2px 10px;font-size: 15px;" width="70">Subtotal</td>
                                       <td style="padding: 2px 0;font-size: 15px;" width="1">:</td>
                                       <td style="padding: 2px 10px;font-size: 15px;" align="right">${data[0].grand_total}</td>
                                    </tr>
                                    <tr>
                                       <td bgcolor="#FAFAFA" style="padding: 2px 10px;font-size: 15px;" width="70">Total Diskon</td>
                                       <td bgcolor="#FAFAFA" style="padding: 2px 0;font-size: 15px;" width="1">:</td>
                                       <td bgcolor="#FAFAFA" style="padding: 2px 10px;font-size: 15px;" align="right"></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td style="padding: 0;font-size: 15px;border-top: 0.5px solid #000;border-bottom: 0.5px solid #000;border-right: 0.5px solid #000" colspan="3" class="p0p">
                              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                 <tbody>
                                    <tr>
                                       <td style="padding: 5px 10px;font-size: 15px;" width="70">DPP</td>
                                       <td style="padding: 5px 0;font-size: 15px;" width="1">:</td>
                                       <td style="padding: 5px 10px;font-size: 15px;" align="right"> ${data[0].grand_total}</td>
                                    </tr>
                                    <tr>
                                       <td bgcolor="#FAFAFA" style="padding: 5px 10px;font-size: 15px;" width="70">PPN</td>
                                       <td bgcolor="#FAFAFA" style="padding: 5px 0;font-size: 15px;" width="1">:</td>
                                       <td bgcolor="#FAFAFA" style="padding: 5px 10px;font-size: 15px;" align="right">0</td>
                                    </tr>
                                    <tr>
                                       <td style="padding: 5px 10px;font-size: 15px;" width="70">Biaya Kirim</td>
                                       <td style="padding: 5px 0;font-size: 15px;" width="1">:</td>
                                       <td style="padding: 5px 10px;font-size: 15px;" align="right">0</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td colspan="3" style="font-size: 15px;padding: 5px 10px;border-right: 0.5px solid #000;border-bottom: 0.5px solid #000;border-left: 0.5px solid #000;"><b>Terbilang : </b>Seratus Enam Puluh Delapan Ribu Lima Ratus Rupiah</td>
                           <td colspan="3" style="border-bottom: 0.5px solid #000;border-right: 0.5px solid #000" class="p0p">
                              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                 <tbody>
                                    <tr>
                                       <td bgcolor="#F5FAF5" style="padding: 5px 10px;font-size: 15px;" width="70">Total Invoice</td>
                                       <td bgcolor="#F5FAF5" style="padding: 5px 0;font-size: 15px;" width="1">:</td>
                                       <td bgcolor="#F5FAF5" style="padding: 5px 10px;font-size: 15px;" align="right">${data[0].grand_total}</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td colspan="3" style="padding-top: 10px;font-size: 15px;">
                              <table cellpadding="1" cellspacing="1" style="width:100%">
                                 <tbody>
                                    <tr>
                                       <td style="text-align:center">
                                          <p><strong>Disiapkan</strong></p>

                                          <p>​</p>

                                          <p>(..............................................................)&nbsp;</p>

                                          <p style="text-align:left">Tgl:</p>
                                       </td>
                                       <td style="text-align:center">
                                          <p><strong>Disetujui Oleh</strong></p>

                                          <p>&nbsp;</p>

                                          <p>(..............................................................)&nbsp;</p>

                                          <p style="text-align:left">Tgl:</p>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                           <td colspan="3" style="padding: 10px 0px 20px;font-size: 15px;" class="p0p">
                              <table border="0" width="100%" cellpadding="0" cellspacing="0" style="border: 0.5px solid #000;padding: 10px;">
                                 <tbody>
                                    <tr>
                                       <td class="account p0p">
                                          <table border="0" width="100%" cellpadding="0" cellspacing="0">
                                             <tbody>
                                                <tr>
                                                   <td colspan="3" style="padding: 5px 0;" class="payment-bank">
                                                      <p>Pembayaran melalui Rekening :</p>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            `;

                tambahanHtml2 += `
            <tr>
               <td colspan="10"><span id="footer_text_demo">
               <p style="text-align:center">Terima Kasih &amp; Selamat Belanja Kembali<br><span style="font-size:11px">Powered by www.foliopos.com</span></p>
               </span></td>
            </tr>
            </tbody>
            </table>
            <!-- E N D  B O D Y -->
            </td>
            </tr>
            </tbody>
            </table>
            </div>
            `;

                // Menambahkan elemen HTML tambahan ke dalam modal-body
                $("#modalFaktur").html(tambahanHtml2);
            })
            .catch(function(error) {
                console.error('Terjadi kesalahan: ', error);
            });
    }

    const barangSelect = new Choices('#select_anggota', {
        searchEnabled: true, // Aktifkan fitur pencarian
        searchPlaceholderValue: 'Minimum 3 Character...',
        allowHTML: true,
        callbackOnCreateTemplates: function(template) {
            return {
                item: function(classNames, data) {
                    return template(`
                    <div class="${classNames.item}" data-value="${data.value}" data-id="${data.id}">
                        ${data.label}
                    </div>
                `);
                },
            };
        },
    });

    const searchInput = document.querySelector('.choices__input--cloned[placeholder="Minimum 3 Character..."]');

    searchInput.addEventListener('input', function(event) {
        // Ambil nilai yang dimasukkan oleh pengguna
        const inputValue = this.value;
        if (inputValue.length >= 3) {
            $.ajax({
                url: '<?php echo base_url('penjualan/get_anggota'); ?>',
                method: 'POST',
                data: {
                    q: inputValue
                },
                dataType: 'json',
                success: function(data) {
                    barangSelect.clearStore();
                    // Membuat array kosong untuk menyimpan opsi
                    var opsi = [];

                    // Melakukan iterasi pada data yang diterima dari AJAX
                    data.forEach(function(item) {
                        // Membuat objek opsi dengan nilai dan label dari data
                        var opsiItem = {
                            value: item.id_user,
                            label: item.nomor_induk + " - " + item.nama_member
                        };

                        // Menambahkan objek opsi ke dalam array opsi
                        opsi.push(opsiItem);
                    });

                    barangSelect.setChoices(opsi, 'value', 'label');
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        } else {
            barangSelect.clearStore();
        }
    });
</script>
<script>
    $(document).ready(function() {
        $("#cetak_invoice").click(function() {
            // Ambil isi dari modal-body
            var modalContent = $("#modalFaktur").html();

            // Buat jendela popup untuk mencetak
            var popupWin = window.open('', '_blank', 'width=600,height=600');
            popupWin.document.open();
            popupWin.document.write('<html><head><title>Cetak</title></head><body>' + modalContent + '</body></html>');
            popupWin.document.close();
            popupWin.jqprint();
            popupWin.close();
        });

        $("#cetak_bukti").click(function() {
            // Ambil isi dari modal-body
            var modalContent = $("#modalBukti").html();

            var IminPrintInstance = IminPrinter();
            IminPrintInstance.connect().then(async (isConnect) => {

                if (isConnect) {
                    // 1. initPrinter
                    IminPrintInstance.initPrinter();
                    // 2. getPrinterStatus
                    const status = await IminPrintInstance.getPrinterStatus();
                    console.log('Printer status:' + JSON.stringify(status));
                    IminPrintInstance.printText(modalContent);
                } else {
                    console.log("Error");
                }
            })
        });

        $("#cetak_qrcode").click(function() {
            // Ambil isi dari modal-body
            var modalContent = $("#modal-qrcode").html();

            // Buat jendela popup untuk mencetak
            var popupWin = window.open('', '_blank', 'width=600,height=600');
            popupWin.document.open();
            popupWin.document.write('<html><head><title>Cetak</title></head><body>' + modalContent + '</body></html>');
            popupWin.document.close();
            popupWin.jqprint();
            popupWin.close();
        });

        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": "<?php echo base_url('penjualan/json'); ?>",
                "type": "POST",
                data: function(d) {
                    d.id = $('#id_transaksi_filter').val();
                    d.tgl = $('#tgl_transaksi_filter').val();
                    d.status = $('#status_pesanan_filter').val();
                    d.pembayaran = $('#status_pembayaran_filter').val();
                    d.jenis = $('#jenis_order_filter').val();
                    d.metode = $('#metode_filter').val();
                    d.anggota = $('#select_anggota').val();
                }
            },
            "columns": [{
                    "data": 0,
                    "className": "text-center align-middle",
                },
                {
                    "data": 1,
                    "className": "text-center align-middle"
                },
                {
                    "data": 2,
                    "className": "text-center align-middle"
                },
                {
                    "data": 3,
                    "className": "text-center align-middle dt-nowrap"
                },
                {
                    "data": 4,
                    "className": "text-left align-middle"
                },
                {
                    "data": 5,
                    "className": "text-center align-middle dt-nowrap",
                },
                {
                    "data": 6,
                    "className": "text-center align-middle",
                },
                {
                    "data": 7,
                    "className": "dt-nowrap text-center align-middle"
                },
                {
                    "data": 8,
                    "className": "text-center align-middle"
                },
                {
                    "data": 9,
                    "className": "dt-nowrap text-center align-middle"
                },
            ],
        });

        $('#select_anggota').on('change', function() {
            $.ajax({
                url: '<?php echo base_url('penjualan/get_anggota2'); ?>',
                method: 'POST',
                data: {
                    q: $('#select_anggota').val()
                },
                dataType: 'json',
                success: function(data) {
                    $('#example').DataTable().ajax.reload();
                    $('#nama_lengkap_cari').text(data.nama_member);
                    $('#jenis_kelamin_cari').text(data.jenis_kelamin);
                    $('#nomor_induk_cari').text(data.nomor_induk);
                    $('#no_hp_cari').text(data.wa_member);
                    $('#status_cari').text("Active");
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });

        });

        $('#id_transaksi_filter').on('input', function() {
            $('#example').DataTable().ajax.reload();
        });

        $('#tgl_transaksi_filter').on('input', function() {
            $('#example').DataTable().ajax.reload();
        });

        $('#status_pesanan_filter').on('input', function() {
            $('#example').DataTable().ajax.reload();
        });

        $('#status_pembayaran_filter').on('input', function() {
            $('#example').DataTable().ajax.reload();
        });

        $('#metode_filter').on('input', function() {
            $('#example').DataTable().ajax.reload();
        });

        $('#jenis_order_filter').on('input', function() {
            $('#example').DataTable().ajax.reload();
        });
    });

    function handleSubmit() {
        var id = $("#id_pesanan_ubah").val();
        var saleDateValue = $("#sale_date").val();
        var pesanan = $("#order_status").val();
        var pembayaran = $("#payment_status").val();

        $.ajax({
            url: '<?= base_url('penjualan/proses_ubah') ?>', // Adjust the URL based on your setup
            type: 'POST',
            data: {
                id_pesanan_ubah: id,
                tgl: saleDateValue,
                status: pesanan,
                pembayaran: pembayaran
            },
            dataType: 'json',
            success: function(response) {
                // Handle success
                if (response.status === 'success') {
                    $('#example').DataTable().ajax.reload();
                    $('#ubahTransaksiModal').modal('hide');
                    toastr.success(response.message, '', {
                        timeOut: 2000
                    });
                }
            },
            error: function(error) {
                // Handle error
                console.error('Error:', error);
                // You can show an error Toastr notification here if needed
            }
        });
        // Add your additional logic or AJAX calls here
    }
</script>
</body>

</html>