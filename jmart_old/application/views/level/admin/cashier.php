<?php $this->load->view('layouts/admin/head') ?>
<!-- Tautan ke jQuery UI CSS dari Google Hosted Libraries -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<style>
    .table>thead:first-child>tr:first-child>th,
    .table>thead:first-child>tr:first-child>td,
    .table-striped thead tr.primary:nth-child(odd) th {
        background-color: #428bca;
        color: #fff;
        border-color: #357ebd;
        border-top: 1px solid #357ebd;
        text-align: center;
    }

    .card-product {
        border-radius: 20px;
        height: 100px !important;
        width: 100px !important;
        padding: 10px;
        /* Anda dapat mengganti nilai width sesuai dengan yang Anda inginkan */
    }

    @-webkit-keyframes rainbow {
        0% {
            background-position: 0% 82%
        }

        50% {
            background-position: 100% 19%
        }

        100% {
            background-position: 0% 82%
        }
    }

    @-moz-keyframes rainbow {
        0% {
            background-position: 0% 82%
        }

        50% {
            background-position: 100% 19%
        }

        100% {
            background-position: 0% 82%
        }
    }

    @-o-keyframes rainbow {
        0% {
            background-position: 0% 82%
        }

        50% {
            background-position: 100% 19%
        }

        100% {
            background-position: 0% 82%
        }
    }

    @keyframes rainbow {
        0% {
            background-position: 0% 82%
        }

        50% {
            background-position: 100% 19%
        }

        100% {
            background-position: 0% 82%
        }
    }

    .input-numeric-container {
        background: #fff;
        padding: 1em;
    }

    .input-numeric {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid silver;
        outline-color: #4CAF50;
        text-align: center;
    }

    .table-numeric {
        width: 100%;
        border-collapse: collapse;
    }

    .table-numeric td {
        vertical-align: top;
        text-align: center;
        border: 0;
    }

    .table-numeric button {
        position: relative;
        cursor: pointer;
        display: block;
        width: 100%;
        box-sizing: border-box;
        padding: 0.6em 0.3em;
        font-size: 1em;
        border-radius: 0.1em;
        outline: none;
        user-select: none;
    }

    .table-numeric button:active {
        top: 2px;
    }

    .key {
        background: #fff;
        border: 1px solid #d8d6d6;
        border: 1px solid #ccc;
        font-weight: 700;
        color: #1c94c4;
    }

    .remove {
        background: #fff;
        border: 1px solid #d8d6d6;
        border: 1px solid #ccc;
        font-weight: 700;
        color: #1c94c4;
    }

    [data-numeric="hidden"] .table-numeric {
        display: none;
    }

    .col-50 {
        flex: 0 1 calc(25% - 15px);
        margin-bottom: 2px;
        padding: 0px;
        margin-right: 1px;
        clear: both;
        margin-top: 1px;
    }

    #search-results {
        list-style: none;
        padding: 0;
        margin-top: 10px;
        max-height: 200px;
        overflow-y: auto;
    }

    #search-results li {
        background-color: #f5f5f5;
        /* Warna latar belakang untuk setiap elemen li */
        padding: 5px 10px;
        /* Padding untuk elemen li */
        margin-bottom: 5px;
        /* Memberikan margin bawah antara elemen li */
        border: 1px solid #ddd;
        /* Garis pinggir untuk setiap elemen li */
        border-radius: 4px;
        /* Membuat sudut elemen li sedikit melengkung */
    }

    #search-results li:hover {
        background-color: #e0e0e0;
        /* Warna latar belakang saat elemen dihover */
        cursor: pointer;
        /* Mengganti kursor saat elemen dihover */
    }

    /* CSS untuk efek hover */
    .search-result-item {
        transition: background-color 0.3s;
        /* Transisi perubahan warna latar belakang */
        cursor: pointer;
        /* Menampilkan kursor tangan saat dihover */
    }

    .search-result-item:hover {
        background-color: #F0F0F0;
        /* Warna latar belakang saat dihover */
    }

    .dataTables_paginate {
        display: none;
    }

    .card img {
        width: 100px;
        height: 100px;
    }

    .label {
        position: absolute;
        top: 0px;
        left: 0px;
        background-color: #007bff;
        color: #fff;
        padding: 5px 10px;
        border-radius: 0px;
    }

    .harga-barang {
        text-align: left;
        color: #000;
        margin-top: 5px;
        font-weight: 700;
    }

    .checkout-container {
        border-top: 1px solid #d4dee5;
        border-top: 1px solid #d4dee5;
        box-sizing: border-box;
        width: 100%;
    }

    .checkout-container>button {
        background-color: initial;
        border: 0;
        height: 100%;
        width: 100%;
    }

    .checkout-container>button>p {
        align-items: center;
        background-color: #2797e8;
        background-color: #2797e8;
        border-radius: 8px;
        color: #fff;
        display: flex;
        font-family: Poppins;
        font-size: 18px;
        font-weight: 400;
        height: 100%;
        justify-content: center;
        line-height: 24px;
        text-align: center;
        width: 100%;
    }

    /* Default style saat tombol tidak dihover */
    .btn.btn-outline-primary .fa.fa-trash {
        color: #6c757d;
    }

    /* Style saat tombol dihover */
    .btn.btn-outline-primary:hover .fa.fa-trash {
        color: #fff;
    }

    a.active {
        border-bottom: 2px solid #55c57a;
    }

    .nav-link {
        color: rgb(110, 110, 110);
        font-weight: 500;
    }

    .nav-link:hover {
        color: #55c57a;
    }

    .nav-pills .nav-link.active {
        color: black;
        background-color: white;
        border-radius: 0.5rem 0.5rem 0 0;
        font-weight: 600;
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .loading-spinner {
        text-align: center;
    }

    .loading-spinner i {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .cart-totals {
        border-radius: 15px;
        -webkit-box-shadow: 5px 5px 15px rgb(0 0 0 / 5%);
        box-shadow: 5px 5px 15px rgb(0 0 0 / 5%);
        padding: 30px 40px;
    }

    .text-brand {
        color: #3BB77E !important;
    }

    .table-bordered {
        border: 1px solid #ddd;
    }
</style>
<?php $this->load->view('layouts/admin/header') ?>
<div id="loading" class="loading-overlay" style="display: none;">
    <div class="loading-spinner">
        <i class="fas fa-spinner fa-spin"></i>
        Loading...
    </div>
</div>
<audio id="beepSound" preload="auto" src="<?= base_url('public/template/upload/audio/simpan.mp3') ?>"></audio>
<audio id="removeSound" preload="auto" src="<?= base_url('public/template/upload/audio/hapus.mp3') ?>"></audio>
<audio id="wrongSound" preload="auto" src="<?= base_url('public/template/upload/audio/tetot.mp3') ?>"></audio>
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12 col-lg-5 d-flex">
            <div class="card w-100" style="background-color: transparent !important;border:none !important">
                <div class="card-header" style="background-color: white !important;border:1px solid rgba(4, 32, 69, 0.14)">
                    <h5 class="card-title">Preview Barang</h5>
                </div>
                <div class="card-body p-0" style="background-color: transparent !important;">
                    <div id="result" class="mt-2"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex">
            <div class="card w-100" style="background-color: transparent !important;border:none !important">
                <div class="card-header" style="background-color: white !important;border:1px solid rgba(4, 32, 69, 0.14)">
                    <h5 class="card-title">Detail Pesanan</h5>
                </div>
                <div class="card-body p-0">
                    <div class="input-group mb-2 mt-2" style="border-radius:0px !important">
                        <span class="input-group-text">
                            <i class="fa fa-barcode"></i>
                        </span>
                        <input style="border-radius:0px !important;cursor:pointer !important" class="form-control ui-autocomplete" type="text" id="search" name="search" placeholder="Search Code / Product Name..." autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div style="max-height: 390px; overflow-y: auto;">
                                <table class="table items table-striped table-bordered table-condensed table-hover mt-2 w-100" id="list_barang">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th style="width: 5%; text-align: center;">
                                                <i style="cursor: pointer;opacity:0.6" class="fa fa-trash"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- STARTS -->

                    <!-- END -->
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card w-100" style="background-color: transparent !important;border:none !important">
                <div class="card-header" style="background-color: white !important;border:1px solid rgba(4, 32, 69, 0.14)">
                    <h5 class="card-title">Keterangan</h5>
                </div>
                <div class="card-body p-3 mt-1" style="background-color: white !important;border:1px solid rgba(4, 32, 69, 0.14)">
                    <div class="p-md-2 ml-30">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6 class="text-muted mb-0" style="font-size: 14px;">Total Barang</h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand text-end mb-0" style="font-size: 22px;">
                                                <span id="titems">0</span>
                                            </h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="text-muted" style="font-size: 14px;">Total Harga</h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand text-end" style="font-size: 22px;">
                                                Rp. <span id="gtotal"></span>
                                            </h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-start">
                            <a id="modalClick" data-bs-toggle="modal" data-bs-target="#checkOutModal" href="#" class="btn btn-primary mb-2 w-100 text-start">Proceed To CheckOut&nbsp;&nbsp;<i class="fa fa-save"></i></a>
                            <a id="deleteButton" href="javascript::void" class="btn btn-danger w-100 text-start">Cancel Order&nbsp;&nbsp;<i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class=" modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background: linear-gradient(to right, #489ce2, #4299e1, #2181d0) !important;">
                <h5 class="modal-title" id="exampleModalLabel">Update Jumlah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="button_update_list">
                    <div class="input-numeric-container">
                        <div>
                            <p style="margin-top: -10px;">
                                <b>Nama:</b> <span id="nama_barang_modal"></span><br>
                                <b>Barcode:</b> <span id="barcode_barang_modal"></span>
                            </p>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-white" type="button" id="minusBtn">-</button>
                            <input type="hidden" id="id_keranjang_modal" name="id_keranjang_modal">
                            <input style="border:1px solid #dadfe5" name="input_numeric_modal" id="input_numeric_modal" class="form-control input-numeric" type="number" autofocus>
                            <button class="btn btn-white" type="button" id="plusBtn">+</button>
                        </div>
                        <table class="table-numeric">
                            <tbody>
                                <tr>
                                    <td> <button type="button" class="key" data-key="1"> 1 </button> </td>
                                    <td> <button type="button" class="key" data-key="2"> 2 </button> </td>
                                    <td> <button type="button" class="key" data-key="3"> 3 </button></td>
                                    <td colspan="2">
                                        <button type="button" class="remove" style="background-color: #f0ad4e;border-color: #eea236;color: #fff;">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l14 0"></path>
                                                <path d="M5 12l4 4"></path>
                                                <path d="M5 12l4 -4"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td> <button type="button" class="key" data-key="4"> 4 </button> </td>
                                    <td> <button type="button" class="key" data-key="5"> 5 </button> </td>
                                    <td> <button type="button" class="key" data-key="6"> 6 </button> </td>
                                    <td> <button type="button" class="" disabled="disabled"> . </button> </td>
                                    <td> <button type="button" class="key"> Clear </button> </td>
                                </tr>
                                <tr>
                                    <td> <button type="button" class="key" data-key="7"> 7 </button> </td>
                                    <td> <button type="button" class="key" data-key="8"> 8 </button> </td>
                                    <td> <button type="button" class="key" data-key="9"> 9 </button> </td>
                                    <td> <button type="button" class="key" data-key="0"> 0 </button> </td>
                                    <td> <button type="button" class="" disabled="disabled"> % </button> </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <button type="submit" class="btn btn-success"> Accept </button>
                                    </td>
                                    <td colspan="2">
                                        <button data-bs-dismiss="modal" type="button" class="btn btn-danger"> Cancel </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="checkOutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-white text-dark">
                <h5 class="modal-title" id="exampleModalLabel">Proses Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                <div class="modal-body" style="margin-top: -20px;">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <select style="border-radius: 0px;height:50px" name="id_customer" id="id_customer" class="form-select" required="required">
                                <option value="">Walk In Customer</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <input style="border-radius: 0px;height:50px" type="text" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $transaction_number ?>" readonly>
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <input style="border-radius: 0px;height:50px" type="datetime-local" id="tgl_penjualan" class="form-control" value="<?= date('Y-m-d\TH:i:s') ?>">
                        </div>
                    </div>
                    <hr class="mt-3 mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenisOrder" class="form-label fw-bold">Jenis Order:</label>
                                <div class="form-check">
                                    <input style="width: 25px;height: 25px;box-sizing: border-box;padding: 0;border-radius:5px !important" class="form-check-input" type="checkbox" name="jenisOrder" id="cash" value="Cash">
                                    <label class="form-check-label" for="cash">Cash</label>
                                </div>
                                <div class="form-check">
                                    <input style="width: 25px;height: 25px;box-sizing: border-box;padding: 0;border-radius:5px !important" class="form-check-input" type="checkbox" name="jenisOrder" id="autodebit" value="Autodebet">
                                    <label class="form-check-label" for="autodebit">Autodebit</label>
                                </div>
                                <div class="form-check">
                                    <input style="width: 25px;height: 25px;box-sizing: border-box;padding: 0;border-radius:5px !important" class="form-check-input" type="checkbox" name="jenisOrder" id="transfer" value="Transfer">
                                    <label class="form-check-label" for="transfer">Transfer</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="statusPembayaran" class="form-label fw-bold">Status Pembayaran:</label>
                                <div class="form-check">
                                    <input readonly style="width: 25px;height: 25px;box-sizing: border-box;padding: 0;border-radius:5px !important;" class="form-check-input" type="checkbox" name="statusPembayaran" id="lunas" value="Lunas">
                                    <label class="form-check-label" for="lunas">Lunas</label>
                                </div>
                                <div class="form-check">
                                    <input readonly style="width: 25px;height: 25px;box-sizing: border-box;padding: 0;border-radius:5px !important;" class="form-check-input" type="checkbox" name="statusPembayaran" id="belumLunas" value="Menunggu Pembayaran">
                                    <label class="form-check-label" for="belumLunas">Belum Lunas</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="fw-bold form-label" for="">Pilih Kasir</label>
                            <select required name="kasir_cache" id="kasir_cache" class="form-select" required="required" onchange="setLocalStorageValue('kasir_cache', 'selectedKasir')">
                                <option value="" disabled selected="selected">Pilih Kasir</option>
                                <?php foreach ($kasir as $key => $value) : ?>
                                    <option value="<?= $value['id_kasir'] ?>"><?= $value['nama_kasir'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold form-label" for="">Discount</label>
                            <input disabled type="text" id="discount" class="form-control" value="" placeholder="Discount">
                        </div>
                    </div>
                    <hr class="mt-3 mb-3">
                    <div class="row mb-50 align-items-center">
                        <div class="col text-sm fw-500">Total Items:</div>
                        <div class="col-auto text-sm fw-500" id="titems2">0.00</div>
                    </div>
                    <div class="row mb-50 align-items-center">
                        <div class="col text-sm fw-500">Sub Total:</div>
                        <div class="col-auto  text-sm fw-500" id="divSubTotal">0.00</div>
                    </div>
                    <div class="row mb-50 align-items-center">
                        <div class="col text-sm fw-500">Discount:</div>
                        <div class="col-auto  text-sm fw-500" id="divDiscountAmountInTable">0.00</div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col text-sm fw-600">Total Semua:</div>
                        <div class="col-auto text-sm fw-600" id="keseluruhan"></div>
                    </div>
                    <hr class="mt-3 mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" for="">Total Pembayaran</label>
                            <div class="input-group" style="width: 100% !important;">
                                <span class="input-group-text text-success fw-bold fs-4" id="basic-addon1">Rp. </span>
                                <input style="border-radius: 0px;height:40px;border-color: #ced4da;font-size:20px" min="1" id="total-membayar" type="text" class="form-control text-success fw-bold" placeholder="Nominal" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" for="">Kembalian</label>
                            <div class="input-group" style="width: 100% !important;">
                                <span class="input-group-text text-danger fw-bold fs-4" id="basic-addon1">Rp. </span>
                                <input style="border-radius: 0px;height:40px;font-size:20px" readonly id="kembalian" type="number" class="form-control text-danger fw-bold" placeholder="Kembalian" aria-label="Kembalian" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <hr class="mt-3 mb-3">
                    <div class="row" style="margin-bottom: -20px;">
                        <div class="col-12">
                            <label class="form-label">Notes/Remarks</label>
                            <textarea rows="3" class="form-control" placeholder="Enter Notes" id="OrderNotes" name="OrderNotes"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" style="border-radius: 5px !important;" data-bs-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" style="border-radius: 5px !important;" id="submit-sale">Simpan & Print</button>
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

<!-- END -->
<?php $this->load->view('layouts/admin/footer') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // var choices_kasir = new Choices(document.getElementById('kasir_cache'));
    // var choices_customer = new Choices(document.getElementById('id_customer'));
    // var choices_pembayaran = new Choices(document.getElementById('metode_pembayaran'));

    $(document).ready(function() {
        // Menggunakan jQuery untuk menangani perubahan pada inputan jenis order
        $('input[name="jenisOrder"]').change(function() {
			// Mendapatkan nilai inputan jenis order yang dipilih
            var jenisOrder = $('input[name="jenisOrder"]:checked').val();
			var totalBayar = parseInt($("#keseluruhan").text().replace(/\D/g, '')).toLocaleString('id-ID') || 0;

            if (jenisOrder === "Cash") {
				$("#total-membayar").prop('readonly', false).val("");
				$('#lunas').prop('checked', true).prop('disabled', true);
				$('#belumLunas').prop('checked', false).prop('disabled', true);
			} else if (jenisOrder === "Autodebet") {
				$("#total-membayar").prop('readonly', true).val(totalBayar);
				$('#lunas').prop('checked', false).prop('disabled', true);
				$('#belumLunas').prop('checked', true).prop('disabled', true);
        		$('#kembalian').val("");
			} else if (jenisOrder === "Transfer") {
				$("#total-membayar").prop('readonly', true).val(totalBayar);
				$('#lunas').prop('checked', true).prop('disabled', true);
				$('#belumLunas').prop('checked', false).prop('disabled', true);
        		$('#kembalian').val("");
			} else {
				// Optional: Jika jenisOrder kosong atau tidak sesuai
				$('#lunas').prop('disabled', false).prop('checked', false);
				$('#belumLunas').prop('disabled', false).prop('checked', false);
			}
        });
    });

    $('#modalClick').click(function() {
        $('#total-membayar').val("");
        $('#kembalian').val("");
    });

    function BuktiTransaksi(id, totalSubHarga, totalDiskon) {
        var url = "<?php echo base_url('penjualan/get_bukti_transaksi/'); ?>" + id;

        fetch(url)
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Respons tidak ok: ' + response.status);
                }
                return response.json();
            })
            .then(function(data) {
                var tambahanHtml = `
                <div id="print_invoice" class="pb-body">
                    <table border="0" class="struk-pay" id="struk" style="width: 350px !important; font-size: 14px !important;">
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
                        <td colspan="2" class="text-end"><span class="kasir_name detail_cashier">${data[0].nama_kasir}</span></td>
                     </tr>
                     <tr>
                        <td style="width: 30%;"> Alat Kasir</td>
                        <td>:</td>
                        <td colspan="2" class="text-end"><span class="detail_cashier">ADMIN</span></td>
                     </tr>

                     <tr id="customer_data">
                        <td style="width: 30%;"> Anggota </td>
                        <td>:</td>
                        <td colspan="2" class="text-end"><span id="customer_name">${data[0].nama_member !== null ? data[0].nama_member + ' - ' + data[0].nomor_induk : 'Walk In Customer'}</span></td>
                     </tr>
                      <tr>
                        <td style="width: 30%;"> Note</td>
                        <td>:</td>
                        <td colspan="2" class="text-end"><span class="detail_cashier">${data[0].keterangan_pesanan}</span></td>
                     </tr>
					 <tr>
                        <td style="width: 30%;"> Metode Byr</td>
                        <td>:</td>
                        <td colspan="2" class="text-end"><span class="detail_cashier">${data[0].metode_bayar}</span></td>
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
                        ${new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(data[i].jumlah_jual * data[i].harga_saat_ini)} </span>
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
                        <td class="line-ttl-product" colspan="3"><span class="ttl-product">Subtotal (${data[0].total_rows} items)</span></td>
                        <td class="line-ttl-product" align="right" width="30%"><span class="number ttl-product">${new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(totalSubHarga)}</span></td>
                     </tr>

                     <tr style="height: 10px">
                        <td></td>
                     </tr>
                     <tr>
                        <td class="line-ttl-product" colspan="3"><span class="ttl-product">Total Diskon</span></td>
                        <td class="line-ttl-product" align="right" width="30%">
                           <span class="ttl-product">${new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(totalDiskon)}</span>
                        </td>
                     </tr>
                     <tr style="height: 10px">
                        <td></td>
                     </tr>
                     <tr>
                        <td class="line-ttl-product" colspan="3"><strong class="ttl-product">Total</strong></td>
                        <td class="line-ttl-product" align="right" width="30%">
                           <strong class="ttl-product">${new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(data[0].grand_total)}</strong>
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
                        <td class="line-ttl-product" align="right" width="30%">${new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(data[0].total_bayar)}</td>
                     </tr>
                     <tr class="highline" style="height: 23px;">
                        <td class="line-ttl-product" colspan="4">
                           <hr>
                        </td>
                     </tr>
                    <tr>
                        <td class="line-ttl-product" colspan="3"><strong class="footer-ttl-product">Kembalian</strong></td>
                        <td class="line-ttl-product" align="right" width="30%"><strong class="footer-ttl-product">${new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(data[0].kembalian)}</strong></td>
                     </tr>
                     <tr style="height: 23px;">
                        <td class="line-ttl-product" colspan="10">
                           <hr>
                        </td>
                     </tr>
                     <tr>
                        <td class="line-ttl-product" colspan="3"><strong class="footer-ttl-product">Transaksi Bulan Ini</strong></td>
                        <td class="line-ttl-product" align="right" width="30%"><strong class="footer-ttl-product">${new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(data[0].total_bulan_ini)}</strong></td>
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


    $('#checkOutModal').on('shown.bs.modal', function() {
        $('#kasir_cache').select2({
            theme: 'bootstrap-5'
        });

        $('#id_customer').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#checkOutModal'),
            ajax: {
                url: '<?= base_url('kasir/getAnggota'); ?>', // URL endpoint ke controller Anggota
                dataType: 'json',
                delay: 250, // Delay sebelum mengirimkan permintaan
                data: function(params) {
                    return {
                        q: params.term, // Nilai inputan pencarian
                        page: params.page || 1 // Nomor halaman
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id_user,
                                text: item.nomor_induk + ' - ' + item.nama_member
                            };
                        })
                    };
                },
                cache: true
            },
            placeholder: 'Walk In Customer',
            minimumInputLength: 0 // Jumlah karakter minimum sebelum pencarian dimulai
        });

        $('#status_pembayaran').select2({
            theme: 'bootstrap-5'
        });
    });


    function playBeep() {
        var beep = document.getElementById("beepSound");
        beep.play();
    }

    function removeBeep() {
        var beep2 = document.getElementById("removeSound");
        beep2.play();
    }

    function wrongBeep() {
        var beep2 = document.getElementById("wrongSound");
        beep2.play();
    }

    function simpanData(id_barang) {
        $.ajax({
            url: '<?= base_url('kasir/keranjang') ?>',
            type: 'POST',
            data: {
                id: id_barang
            },
            success: function(response) {
                if (response.status == "success") {
                    playBeep();
                    toastr.success(response.message, '', {
                        timeOut: 2000,
                    });
                    $('#list_barang').DataTable().ajax.reload();
                } else {
                    wrongBeep();
                    toastr.error(response.message, '', {
                        timeOut: 2000
                    });
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat mengirim data.');
            }
        });
    }

    function simpanData2(label) {
        $.ajax({
            url: '<?= base_url('kasir/keranjang2') ?>',
            type: 'POST',
            data: {
                barang: label
            },
            success: function(response) {
                // Jika response berupa string, parse ke JSON
                var res = (typeof response === 'string') ? JSON.parse(response) : response;
                if (res.status === 'success') {
                    playBeep();
                    toastr.success(res.message, '', {
                        timeOut: 2000
                    });
                    $('#list_barang').DataTable().ajax.reload();
                    $('#search').val("");
                    load_data();
                } else {
                    wrongBeep();
                    toastr.error(res.message, '', {
                        timeOut: 2000
                    });
                }
            },
            beforeSend: function () {
                if (typeof showLoading === 'function') showLoading();
            },
            complete: function () {
                if (typeof hideLoading === 'function') hideLoading();
            },
            error: function() {
                alert('Terjadi kesalahan saat mengirim data.');
            }
        });
    }

    $("#button_update_list").submit(function(event) {
        event.preventDefault();
        var idKeranjang = $("#id_keranjang_modal").val();
        var nilaiInputNumeric = $("#input_numeric_modal").val();

        var data = {
            id_keranjang: idKeranjang,
            jumlah: nilaiInputNumeric
        };

        $.ajax({
            url: "<?php echo base_url('kasir/update_list/'); ?>" + idKeranjang,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(response) {
                if (response.status == "success") {
                    playBeep();
                    $('#list_barang').DataTable().ajax.reload();
                    $('#myModal').modal('hide');
                } else {
                    wrongBeep();
                    toastr.error(response.message, '', {
                        timeOut: 2000
                    });
                }
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $(document).on("click", "#modal_update", function() {
        // Menggunakan AJAX untuk mengambil data dari server
        var dataId = $(this).data("id");

        $.ajax({
            url: "<?= base_url('kasir/getData') ?>",
            type: "POST",
            dataType: "json",
            data: {
                id: dataId
            }, // Kirim data-id ke server jika diperlukan
            success: function(data) {
                // Di sini Anda dapat memanipulasi data yang diterima dari server
                $('#myModal').modal('show');
                $("#id_keranjang_modal").val(data.id_keranjang);

                $("#nama_barang_modal").text(data.nama_barang);
                $("#barcode_barang_modal").text(data.barcode);
                $("#input_numeric_modal").val(data.jumlah);
            },
            error: function() {
                alert("Terjadi kesalahan saat mengambil data.");
            }
        });
    });

    $('#list_barang').DataTable({
        ordering: false,
        "processing": true,
        "serverSide": true,
        "searching": false,
        lengthChange: false,
        info: false,
        pageLength: 100,
        "ajax": {
            "url": "<?php echo base_url('kasir/json'); ?>",
            "type": "POST",
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
            },
        },
        "columns": [{
                "data": "product",
                "className": "text-left align-middle",
            },
            {
                "data": "action",
                "className": "text-center align-middle"
            },
        ],
        "drawCallback": function(settings) {
            $.ajax({
                url: "<?php echo base_url('kasir/hitungTotal'); ?>",
                dataType: "json",
                success: function(data) {
                    var total = data.total;
                    var items = data.item;
                    var diskon = data.diskon;
                    var subtotal = data.subtotal;

                    // Mengganti isi elemen dengan ID 'gtotal' dengan total yang diambil dari controller
                    $('#gtotal').text(total);
                    $('#gtotal2').text(total);
                    $('#titems').text(items);
                    $('#titems2').text(items);
                    $('#keseluruhan').text("Rp. " + total);
                    $('#divSubTotal').text("Rp. " + subtotal);
                    $('#divDiscountAmountInTable').text("Rp. " + diskon);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                }
            });
        },
    });

    $("#minusBtn").click(function() {
        var currentVal = parseInt($("#input_numeric_modal").val());
        if (currentVal > 1) {
            $("#input_numeric_modal").val(currentVal - 1);
        }
    });

    $("#plusBtn").click(function() {
        var currentVal = parseInt($("#input_numeric_modal").val());
        $("#input_numeric_modal").val(currentVal + 1);
    });

    function hapusItem(idKeranjang) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus item ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('kasir/hapus_list/') ?>" + idKeranjang,
                    success: function(data) {
                        removeBeep();
                        $('#list_barang').DataTable().ajax.reload();
                    },
                    error: function() {
                        // Handle kesalahan jika diperlukan
                    }
                });
            }
        });
    }

    function setLocalStorageValue(elementId, storageKey) {
        var selectElement = document.getElementById(elementId);
        var selectedValue = selectElement.value;

        // Menghapus nilai localStorage sebelumnya
        localStorage.removeItem(storageKey);

        // Menyimpan nilai yang dipilih ke localStorage
        localStorage.setItem(storageKey, selectedValue);
    }

    function setSelectValueFromLocalStorage(elementId, storageKey) {
        var selectElement = document.getElementById(elementId);
        var savedValue = localStorage.getItem(storageKey);

        // Jika ada nilai tersimpan di localStorage, atur nilai opsi yang dipilih
        if (savedValue) {
            selectElement.value = savedValue;
        }
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }

    setSelectValueFromLocalStorage("kasir_cache", "selectedKasir");

    $(document).on("click", ".key", function() {
        var number = $(this).attr("data-key");
        var nilaiSaatIni = $(".input-numeric").val();
        $(".input-numeric").val(nilaiSaatIni + number);
    });

    $(".remove").click(function() {
        var inputElement = $(".input-numeric");
        var nilaiSaatIni = inputElement.val();

        if (nilaiSaatIni.length > 0) {
            var nilaiBaru = nilaiSaatIni.slice(0, -1); // Menghapus satu karakter terakhir
            inputElement.val(nilaiBaru);
        }
    });

    $("#total-membayar").on("input", function() {
        var currentValue = $("#total-membayar").val();
        var Hrgdibayar = currentValue.replace(/\D/g, '');
        var nilaiKeseluruhan = parseInt($("#keseluruhan").text().replace(/\D/g, ''));

        var totHvG = Hrgdibayar - nilaiKeseluruhan;

        if (totHvG < 1000) {
            var totTot = (totHvG).toFixed();
        } else {
            var totTot = (totHvG / 1000).toFixed(3);
        }

        $("#kembalian").val(totTot);
    });

    var rupiah1 = document.getElementById('total-membayar');
    rupiah1.addEventListener('keyup', function(e) {
        rupiah1.value = formatRupiah(this.value, '');
    });

    $('#deleteButton').click(function() {
        // Munculkan dialog konfirmasi menggunakan SweetAlert2
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus semua data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            // Jika pengguna menekan tombol "Ya, hapus!"
            if (result.isConfirmed) {
                // Menggunakan Ajax untuk memanggil method deleteAllData di sisi server
                $.ajax({
                    url: '<?= base_url('kasir/hapus_keranjang') ?>', // Ganti dengan URL yang sesuai
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            removeBeep();
                            $('#list_barang').DataTable().ajax.reload();
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Gagal menghapus data.',
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Kesalahan!',
                            'Terjadi kesalahan saat menghubungi server.',
                            'error'
                        );
                    }
                });
            }
        });
    });

    $("#submit-sale").on("click", function() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('kasir/cek_keranjang'); ?>", // Ubah dengan URL yang sesuai
            dataType: "json",
            success: function(response) {
                if (response.jumlah_barang > 0) {
                    proceedSale();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Minimal satu barang belanja harus ada sebelum melanjutkan!',
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // Handle kesalahan jika diperlukan
                console.log(xhr.status);
            }
        });
    });

    function proceedSale() {
        var id_pelanggan = $("#id_customer").val();
        var tgl = $("#tgl_penjualan").val();
        var metode = [];
        var totalMembayar = parseFloat($("#total-membayar").val().replace(/\./g, '')) || 0;
        var totalHarga = $("#keseluruhan").text().replace(/\D/g, '');
        var totalDiskon = $("#divDiscountAmountInTable").text().replace(/\D/g, '');
        var totalSubHarga = $("#divSubTotal").text().replace(/\D/g, '');
        var balance = parseFloat($("#kembalian").val().replace(/\./g, '')) || 0;
        var kasir = $("#kasir_cache").val();
        var note = $("#OrderNotes").val();
        var status = [];

        // // PUSH NILAI METODE
        document.querySelectorAll('input[name="jenisOrder"]:checked').forEach(function(checkbox) {
            metode.push(checkbox.value);
        });

        // PUSH NILAI STATUS PEMBAYARAN
        document.querySelectorAll('input[name="statusPembayaran"]:checked').forEach(function(checkbox) {
            status.push(checkbox.value);
        });

        var inputTotalMembayar = document.getElementById("total-membayar");
        var totalMembayar = parseFloat(inputTotalMembayar.value.trim().replace(/\./g, ''));

        if (metode.length === 0) {
            wrongBeep();
            toastr.error('Silahkan memilih Metode Pembayaran', '', {
                timeOut: 2000
            });
        } else if (isNaN(totalMembayar)) {
            wrongBeep();
            toastr.error('Total membayar tidak valid.', '', {
                timeOut: 2000
            });
        } else if (metode.includes("Cash") && totalMembayar < totalHarga) {
            wrongBeep();
            toastr.error('Total membayar tidak mencukupi. Silakan periksa kembali.', '', {
                timeOut: 2000
            });
        } else {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin melanjutkan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjutkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('kasir/simpanData'); ?>",
                        data: {
                            transaksi: $("#id_transaksi").val(),
                            id: id_pelanggan,
                            kasir: kasir,
                            tgl_pesanan: tgl,
                            jenis_order: "ambil_sendiri",
                            status_pembayaran: status[status.length - 1],
                            metode: metode[metode.length - 1],
                            status_pesanan: "Selesai",
                            grand_total: totalHarga,
                            total_bayar: totalMembayar,
                            kembalian: balance < 0 ? 0 : balance,
                            note: note
                        },
                        success: function(response) {
                            var hasil = JSON.parse(response);
                            toastr.success(hasil.pesan, '', {
                                timeOut: 2000
                            });
                            $('#lanjutkanModal').modal('hide');
                            // location.reload();
                            BuktiTransaksi(hasil.last_insert_id, totalSubHarga, totalDiskon); // Memanggil fungsi dengan ID 4
                            setTimeout(function() {
                                // Ambil isi dari modal-body
                                var modalContent = $("#modalBukti").html();

                                // Buat jendela popup untuk mencetak
                                var popupWin = window.open('', '_blank', 'width=600,height=600');
                                popupWin.document.open();
                                popupWin.document.write('<html><head><title>Cetak</title><style>@media print { body { font-family: Arial, sans-serif; } /* Tambahkan aturan font-family lainnya jika diperlukan */ }</style></head><body>' + modalContent + '</body></html>');

                                // Menambahkan event listener untuk menangani penutupan popup
                                popupWin.onunload = function() {
                                    // Reload halaman saat popup ditutup
                                    location.reload();
                                };

                                popupWin.jqprint();
                                popupWin.close();
                            }, 500); // Waktu tunggu 500ms, disesuaikan sesuai kebutuhan Anda
                        }
                    });
                }
            });
        }
    }

    load_data();

    function load_data(query, page) {
        $.ajax({
            url: "<?= base_url('kasir/load_barang') ?>",
            method: "POST",
            data: {
                query: query,
                page: page
            },
            success: function(data) {
                $('#result').html(data);
            },
        })
    }

    $(document).on('click', '.halaman', function() {
        var page = $(this).attr("id");
        load_data('', page);
    });

    $('#search').keyup(function() {
        var search = $(this).val();

        if (event.keyCode === 13) { // Tombol "Enter" memiliki kode 13
            simpanData2(search);
        } else {
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        }
    });
</script>
<script>
    // Check if 'kasir_cache' exists in localStorage
    var selectedKasir = localStorage.getItem('selectedKasir');

    if (selectedKasir) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('kasir/getNamaKasirById/') ?>' + selectedKasir,
            success: function(response) {
                document.getElementById('kasir_select_value').innerText = response;
                document.getElementById('kasir_selected_value').innerText = response;
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    } else {
        document.getElementById('kasir_select_value').innerText = "No Set";
    }
</script>
<script>
    // Fungsi untuk mengatur perilaku checkbox
    function handleCheckboxChange(checkboxes) {
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    checkboxes.forEach((otherCheckbox) => {
                        if (otherCheckbox !== this) {
                            otherCheckbox.checked = false;
                        }
                    });
                }
            });
        });
    }

    // Memilih semua input checkbox dengan nama "jenisOrder"
    const jenisOrderCheckboxes = document.querySelectorAll('input[name="jenisOrder"]');
    // Memanggil fungsi untuk mengatur perilaku checkbox "jenisOrder"
    handleCheckboxChange(jenisOrderCheckboxes);

    // Memilih semua input checkbox dengan nama "statusPembayaran"
    const statusPembayaranCheckboxes = document.querySelectorAll('input[name="statusPembayaran"]');
    // Memanggil fungsi untuk mengatur perilaku checkbox "statusPembayaran"
    handleCheckboxChange(statusPembayaranCheckboxes);
</script>

<script>
    // Fungsi untuk memeriksa jumlah opsi dan memilih otomatis jika hanya ada satu opsi
    function autoSelectSingleOption() {
        var selectElement = document.getElementById('kasir_cache');
        var options = selectElement.options;

        // Hitung jumlah opsi yang valid (tidak termasuk opsi pertama yang disabled)
        var validOptionsCount = 0;
        for (var i = 0; i < options.length; i++) {
            if (!options[i].disabled) {
                validOptionsCount++;
            }
        }

        // Jika hanya ada satu opsi valid, pilih opsi tersebut
        if (validOptionsCount === 1) {
            for (var i = 0; i < options.length; i++) {
                if (!options[i].disabled) {
                    selectElement.value = options[i].value;
                    break;
                }
            }
        }
    }

    // Panggil fungsi untuk memeriksa dan memilih otomatis
    autoSelectSingleOption();
</script>

</body>

</html>
