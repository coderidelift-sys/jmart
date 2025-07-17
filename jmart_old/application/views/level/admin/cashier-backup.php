<?php $this->load->view('layouts/admin/head') ?>
<!-- Tautan ke jQuery UI CSS dari Google Hosted Libraries -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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

    .product-thumb {
        border: 1px solid #ddd;
        margin-bottom: 15px;
    }

    .product-thumb .image {
        text-align: center;
        margin-bottom: 15px;
    }

    .product-thumb .description {
        padding: 15px;
    }

    .price {
        color: #444;
        margin-top: -15px;
    }

    .product-thumb .button-group {
        display: flex;
        border-top: 1px solid #ddd;
        background-color: #eee;
    }

    .product-thumb .button-group button {
        flex: 33%;
        border-radius: 0;
        display: inline-block;
        border: none;
        background-color: #eee;
        color: #888;
        line-height: 38px;
        font-weight: 700;
        text-align: center;
        text-transform: uppercase;
    }

    .product-thumb .button-group button:hover {
        color: #444;
        background-color: #ddd;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<?php $this->load->view('layouts/admin/header') ?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    POS
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-4">
                <div class="card" style="margin-top: -15px;">
                    <div class="card-body">
                        <div class="input-group w-100 mb-2">
                            <span class="input-group-text">
                                INV
                            </span>
                            <input type="text" class="form-control" placeholder="YP12749301" style="font-weight: bold;background-color: #f4f4f4; border: 1px solid #ddd; cursor: default; border-radius: 0px !important;" disabled>
                        </div>
                        <div class="input-group w-100 mb-2">
                            <select name="id_customer" id="id_customer" class="form-select" required="required" style="background-color: #f4f4f4; border: 1px solid #ddd; cursor: default; border-radius: 0px !important;">
                                <option value="" selected="selected">Pilih Customer</option>
                                <?php foreach ($anggota as $key => $value) : ?>
                                    <option value="<?= $value['id_user'] ?>"><?= $value['nama_member'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <button class="btn btn-secondary" type="button" style="background-color: #eee; border: 1px solid #ccc; color: #555;">
                                <i class="fas fa-key" style="font-size: 1.2em; color: #428bca;"></i>
                            </button>
                            <button class="btn btn-secondary" type="button" style="background-color: #eee; border: 1px solid #ccc; color: #555;">
                                <i class="fa fa-eye" style="font-size: 1.2em; color: #428bca;"></i>
                            </button>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa fa-barcode"></i>
                            </span>
                            <input class="form-control ui-autocomplete" type="text" id="search" name="search" placeholder="Search Code / Product Name...">
                            <span class="input-group-text bg-success" style="cursor: pointer;">
                                <i class="fa fa-file-import text-white"></i>
                            </span>
                        </div>
                        <div id="search-results"></div>

                        <!-- TABLE -->
                        <div style="max-height: 350px; overflow-y: auto;">
                            <table class="table items table-striped table-bordered table-condensed table-hover mt-2 w-100" id="list_barang">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th style="width: 5%; text-align: center;">
                                            <i class="fa fa-trash"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <!-- TABEL SUMMARY -->
                        <table id="totalTable" style="width:100%; padding:5px; color:#000; background: #FFF;" class="mb-3">
                            <tr>
                                <td style="padding: 5px 10px;border-top: 1px solid #DDD;">Items</td>
                                <td class="text-right" style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
                                    <span id="titems">0</span>
                                </td>
                                <td style="padding: 5px 10px;border-top: 1px solid #DDD;">
                                    Discount
                                    <a href="javascript::void" id="ppdiscount" tabindex="-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td class="text-right" style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
                                    <span id="total">0.00</span>
                                </td>
                            </tr>
                            <tr class="bg-success text-white">
                                <td style="padding: 5px 10px; font-weight: bold;" colspan="2">
                                    Rp.
                                </td>
                                <td class="text-right" style="padding:5px 10px 5px 10px; font-size: 30px;font-weight:bold;" colspan="2">
                                    <span id="gtotal"></span>
                                </td>
                            </tr>
                        </table>

                        <!-- BUTTON END -->
                        <div id="botbuttons" class="col-12 text-center">
                            <div class="row">
                                <div class="col">
                                    <select name="kasir_cache" id="kasir_cache" class="form-select" required="required" style="background-color: #f4f4f4; border: 1px solid #ddd; cursor: default; border-radius: 0px !important;height:50px" onchange="setLocalStorageValue('kasir_cache', 'selectedKasir')">
                                        <option disabled selected="selected">Pilih Kasir</option>
                                        <?php foreach ($kasir as $key => $value) : ?>
                                            <option value="<?= $value['id_user'] ?>"><?= $value['nama_member'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-auto">
                                    <div class="btn-group btn-block w-100 v-100" role="group">
                                        <button id="lanjutkanModalBtn" class="btn btn-primary btn-block" id="payment" style="border-radius: 0px !important;height:50px">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                                            </svg>
                                            Lanjutkan
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card" style="margin-top: -15px;">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <div class="well well-sm" style="padding: 9px;border: 1px solid #ddd;background-color: #f6f6f6;box-shadow: none;border-radius: 0;">
                                <div class="form-group" style="margin-bottom:0;">
                                    <div class="input-group wide-tip">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="padding-left: 10px; padding-right: 10px;">
                                                <i class="fa fa-barcode addIcon fa-2x"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="add_item" value="" class="form-control ui-autocomplete-input input-lg" id="add_item" placeholder="Cari Preview Barang" autocomplete="off" tabindex="1">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-plus-circle addIcon fa-2x" id="addIcon"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <div class="product-thumb">
                                    <div class="image">
                                        <a href="https://demo.opencart.com/index.php?route=product/product&amp;language=en-gb&amp;product_id=40">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfYYAytkq_OibpSjm9iYP_hsbkvhUOqGjJew&usqp=CAU" class="img-fluid card-product">
                                        </a>
                                    </div>
                                    <div class="content" style="margin-top: -20px;">
                                        <div class="description">
                                            <h4><a href="">Frestea Teh Hijau Madu 500 ml</a></h4>
                                            <div class="price">
                                                <span class="text-success fw-bold d-block">Rp. 15,000</span>
                                                <span class="text-muted">Sisa 100 Pcs</span>
                                            </div>
                                        </div>
                                        <div class="button-group">
                                            <button type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Add to Cart" aria-label="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                                            <button type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Compare this Product" aria-label="Compare this Product"><i class="fas fa-info"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-thumb">
                                    <div class="image">
                                        <a href="https://c.alfagift.id/product/1/1_A7145990001037_20210821213759411_small.jpg">
                                            <img src="https://c.alfagift.id/product/1/1_A7145990001037_20210821213759411_small.jpg" class="img-fluid card-product">
                                        </a>
                                    </div>
                                    <div class="content" style="margin-top: -20px;">
                                        <div class="description">
                                            <h4><a href="">Sedaap Mie Instant Goreng 5 x 90 g</a></h4>
                                            <div class="price">
                                                <span class="text-success fw-bold d-block">Rp. 15,000</span>
                                                <span class="text-muted">Sisa 100 Pcs</span>
                                            </div>
                                        </div>
                                        <div class="button-group">
                                            <button type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Add to Cart" aria-label="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                                            <button type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Compare this Product" aria-label="Compare this Product"><i class="fas fa-info"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-thumb">
                                    <div class="image">
                                        <a href="https://c.alfagift.id/product/1/1_A7408030002168_20200618140614763_small.jpg">
                                            <img src="https://c.alfagift.id/product/1/1_A7408030002168_20200618140614763_small.jpg" class="img-fluid card-product">
                                        </a>
                                    </div>
                                    <div class="content" style="margin-top: -20px;">
                                        <div class="description">
                                            <h4><a href="">Paroti Roti Sisir Mentega 140 g</a></h4>
                                            <div class="price">
                                                <span class="text-success fw-bold d-block">Rp. 15,000</span>
                                                <span class="text-muted">Sisa 100 Pcs</span>
                                            </div>
                                        </div>
                                        <div class="button-group">
                                            <button type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Add to Cart" aria-label="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                                            <button type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Compare this Product" aria-label="Compare this Product"><i class="fas fa-info"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-thumb">
                                    <div class="image">
                                        <a href="https://c.alfagift.id/product/1/1_A7408030002168_20200618140614763_small.jpg">
                                            <img src="https://c.alfagift.id/product/1/1_A7408030002168_20200618140614763_small.jpg" class="img-fluid card-product">
                                        </a>
                                    </div>
                                    <div class="content" style="margin-top: -20px;">
                                        <div class="description">
                                            <h4><a href="">Paroti Roti Sisir Mentega 140 g</a></h4>
                                            <div class="price">
                                                <span class="text-success fw-bold d-block">Rp. 15,000</span>
                                                <span class="text-muted">Sisa 100 Pcs</span>
                                            </div>
                                        </div>
                                        <div class="button-group">
                                            <button type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Add to Cart" aria-label="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                                            <button type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Compare this Product" aria-label="Compare this Product"><i class="fas fa-info"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <ul class="pagination ">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M15 6l-6 6l6 6"></path>
                                    </svg>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M9 6l6 6l-6 6"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
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
<!-- END -->

<!-- MODAL -->
<div class="modal fade" id="lanjutkanModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title" id="payModalLabel">Konfirmasi Penjualan</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-10 col-sm-9">
                        <div class="form-group mb-2">
                            <label class="fw-bold mb-1" for="">Tanggal Penjualan</label>
                            <input style="border-radius: 0px" type="datetime-local" id="tgl_penjualan" class="form-control" value="<?= date('Y-m-d\TH:i:s') ?>">
                        </div>
                        <div class="rounded" style="border: 1px solid #ddd;background-color: #f6f6f6;box-shadow: none;border-radius: 0px !important;padding: 9px;">
                            <div class="row p-1">
                                <div class="col-sm-6">
                                    <label class="fw-bold mb-1" for="">Total Membayar</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input id="total-membayar" type="text" class="form-control" placeholder="Total Membayar" aria-label="Total Membayar" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-sm-offset-1">
                                    <label class="fw-bold mb-1" for="">Metode Pembayaran</label>
                                    <div class="form-group">
                                        <select style="border-radius:0px" name="metode_pembayaran" id="metode_pembayaran" class="form-control">
                                            <option value="Cash">Cash</option>
                                            <option value="Autodebet">Autodebit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2" style="border-radius: 10px;">
                            <table id="totalTable" style="width:100%; padding:5px; color:#000; background: #FFF;" class="mb-3">
                                <tr class="bg-success text-white">
                                    <td style="padding: 5px 10px; font-weight: bold;" colspan="2">
                                        Total Harga
                                    </td>
                                    <td class="text-right" style="padding:5px 10px 5px 10px; font-size: 30px;font-weight:bold;" colspan="2">
                                        <span id="keseluruhan"></span>
                                    </td>
                                </tr>
                                <tr class="bg-secondary text-white">
                                    <td style="padding: 5px 10px; font-weight: bold;" colspan="2">
                                        Kembalian
                                    </td>
                                    <td class="text-right" style="padding:5px 10px 5px 10px; font-size: 30px;font-weight:bold;" colspan="2">
                                        <span id="balance">Rp. 0,00</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3 text-center">
                        <span style="font-size: 1.2em; font-weight: bold;">Quick Cash</span>
                        <div class="btn-group btn-group-vertical" style="width: 100% !important;">
                            <button style="margin-left: calc(var(--tblr-border-width) * -1);" data-nominal="100000" type="button" class="btn btn-md btn-warning quick-payable">100,000</button>
                            <button data-nominal="50000" type="button" class="btn btn-md btn-warning quick-payable">50,000</button>
                            <button data-nominal="20000" type="button" class="btn btn-md btn-warning quick-payable">20,000</button>
                            <button data-nominal="10000" type="button" class="btn btn-md btn-warning quick-payable">10,000</button>
                            <button data-nominal="5000" type="button" class="btn btn-md btn-warning quick-payable">5,000</button>
                            <button data-nominal="2000" type="button" class="btn btn-md btn-warning quick-payable">2,000</button>
                            <button data-nominal="1000" type="button" class="btn btn-md btn-warning quick-payable">1,000</button>
                            <button data-nominal="500" type="button" class="btn btn-md btn-warning quick-payable">500</button>
                            <button data-nominal="0" type="button" class="btn btn-md btn-danger reset-total">Clear</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-block btn-md btn-primary w-100" id="submit-sale" tabindex="-1">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- END -->
<?php $this->load->view('layouts/admin/footer') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
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

    setSelectValueFromLocalStorage("kasir_cache", "selectedKasir");

    function hapusItem(idKeranjang) {
        if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('kasir/hapus_list/') ?>" + idKeranjang,
                success: function(data) {
                    $('#list_barang').DataTable().ajax.reload();
                },
                error: function() {
                    // Handle kesalahan jika diperlukan
                }
            });
        }
    }

    $(document).ready(function() {
        $("#submit-sale").on("click", function() {
            var id_pelanggan = $("#id_customer").val();
            var tgl = $("#tgl_penjualan").val();
            var metode = $("#metode_pembayaran").val();
            var totalMembayar = parseInt($("#total-membayar").val()) || 0;
            var totalHarga = $("#keseluruhan").text().replace(/\D/g, '');
            var balance = $("#balance").text().replace(/\D/g, '');

            if (metode === "Cash" && totalMembayar < totalHarga) {
                alert("Total membayar tidak mencukupi. Silakan periksa kembali.");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('kasir/simpanData'); ?>",
                    data: {
                        id: id_pelanggan,
                        tgl_pesanan: tgl,
                        jenis_order: "ambil_sendiri",
                        status_pembayaran: "Lunas",
                        metode: metode,
                        status_pesanan: "Selesai",
                        grand_total: totalHarga,
                        total_bayar: totalMembayar,
                        kembalian: balance
                    },
                    success: function(response) {
                        var hasil = JSON.parse(response);
                        alert(hasil.pesan);
                        $('#lanjutkanModal').modal('hide');
                        location.reload();
                    }
                });
            }
        });

        $("#total-membayar").on("input", function() {
            var nilaiBaru = parseInt($(this).val());
            var nilaiKeseluruhan = $("#keseluruhan").text().replace(/\D/g, '');

            // Konversi ke angka (integer)
            if (nilaiKeseluruhan !== '') {
                nilaiKeseluruhan = parseInt(nilaiKeseluruhan);
            } else {
                nilaiKeseluruhan = 0;
            }

            var hasilPengurangan = nilaiBaru - nilaiKeseluruhan;
            $("#balance").text("Rp. " + hasilPengurangan.toLocaleString("id-ID"));
        });


        $(".quick-payable").click(function() {
            var nominal = $(this).data("nominal");
            var currentValue = parseInt($("#total-membayar").val()) || 0;
            var nilaiKeseluruhan = $("#keseluruhan").text().replace(/\D/g, '');

            if (nilaiKeseluruhan !== '') {
                nilaiKeseluruhan = parseInt(nilaiKeseluruhan);
            } else {
                nilaiKeseluruhan = 0;
            }

            var newValue = currentValue + nominal;
            var hasilPengurangan = newValue - nilaiKeseluruhan;
            $("#total-membayar").val(newValue);
            $("#balance").text("Rp. " + hasilPengurangan.toLocaleString("id-ID"));
        });

        $(".reset-total").click(function() {
            // Mereset nilai input "Total Membayar" menjadi 0
            $("#total-membayar").val(0);
            $("#balance").text("Rp. 0,00");
        });

        $("#lanjutkanModalBtn").click(function() {
            // Mendapatkan nilai dari localStorage
            var selectedKasir = localStorage.getItem("selectedKasir");
            var selectedCustomer = $("#id_customer").val();

            // Memeriksa apakah localStorage tidak kosong dan tidak sama dengan "Pilih Kasir"
            if (selectedKasir && selectedKasir !== "Pilih Kasir" && selectedCustomer && selectedCustomer !== "") {
                // Tampilkan modal
                $('#lanjutkanModal').modal('show');
            } else {
                // Tampilkan alert
                alert("Pilih kasir dan pelanggan terlebih dahulu!");
            }
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
                    $('#list_barang').DataTable().ajax.reload();
                    $('#myModal').modal('hide');
                },
                error: function() {
                    // Menampilkan pesan error jika terjadi kesalahan
                    alert("Terjadi kesalahan saat menyimpan data.");
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

                        // Mengganti isi elemen dengan ID 'gtotal' dengan total yang diambil dari controller
                        $('#gtotal').text(total);
                        $('#titems').text(items);
                        $('#keseluruhan').text("Rp. " + total);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                    }
                });
            },
        });

        $('#search').autocomplete({
            source: function(request, response) {
                var searchTerm = request.term.trim(); // Hapus spasi ekstra di awal dan akhir

                if (searchTerm === '') {
                    // Tampilkan alert jika input kosong
                    $('#search-results').empty();
                    return;
                }

                $.ajax({
                    url: '<?php echo site_url("Kasir/searchProduct"); ?>',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        $('#search-results').empty();

                        // Iterasi melalui data hasil pencarian dan tambahkan sebagai elemen HTML sesuai dengan format yang diinginkan
                        $.each(data, function(index, item) {
                            if (index < 5) { // Hanya tampilkan 4 item pertama
                                var resultHTML = '<div class="row search-result-item p-2">';
                                resultHTML += '<div class="col">';
                                resultHTML += '<div class="font-weight-medium">' + item.nama_barang + '</div>';
                                resultHTML += '<div class="text-secondary">' + 'Rp. ' + item.harga_jual_barang + ' | Sisa. ' + item.stock_brg + '</div>';
                                resultHTML += '</div>';
                                resultHTML += '</div>';
                                resultHTML += '<hr style=\'margin-top:-1px;margin-bottom:-1px\'>';

                                // Tambahkan hasil pencarian ke dalam div dengan id "search-results"
                                $('#search-results').append(resultHTML);

                                // Tambahkan event click pada setiap item
                                $('#search-results .search-result-item').eq(index).click(function() {
                                    var id_brg = item.id_brg;

                                    $.ajax({
                                        url: '<?= base_url('kasir/keranjang') ?>',
                                        type: 'POST',
                                        data: {
                                            id: id_brg
                                        },
                                        success: function(response) {
                                            $('#search').val('');
                                            $('#search-results').empty();
                                            $('#list_barang').DataTable().ajax.reload();
                                        },
                                        error: function() {
                                            alert('Terjadi kesalahan saat mengirim data.');
                                        }
                                    });
                                });
                            }
                        });

                        // Tampilkan hasil pencarian
                        $('#search-results').show();
                    }
                });
            },
            minLength: 0 // Jumlah karakter minimum sebelum permintaan pencarian dikirim
        });

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
    });
</script>
</body>

</html>