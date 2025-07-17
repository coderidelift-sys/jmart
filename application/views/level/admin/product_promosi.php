<?php
$currentTime = time();
$nextHourTime = $currentTime + (60 * 60);
$roundedTime = ceil($nextHourTime / (60 * 60)) * (60 * 60);
$formattedTime = date("Y-m-d\TH:i", $roundedTime);
?>

<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css" />
<style>
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

    .select2-container .select2-selection--single .select2-selection__rendered {
        display: block;
        width: 100%;
        padding: 0.5625rem 0.75rem;
        font-family: var(--tblr-font-sans-serif);
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.4285714286;
        color: var(--tblr-body-color);
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: var(--tblr-bg-forms);
        background-clip: padding-box;
        border: var(--tblr-border-width) solid var(--tblr-border-color);
        border-radius: var(--tblr-border-radius);
        box-shadow: var(--tblr-box-shadow-input);
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: none;
        border-radius: 4px;
    }

    .dataTables_wrapper .row:first-child {
        padding-top: 20px;
        padding-bottom: 12px;
        padding-left: 50px;
        padding-right: 30px;
    }

    .dataTables_wrapper .row:last-child {
        padding-top: 20px;
        padding-bottom: 12px;
        padding-left: 50px;
        padding-right: 30px;
    }

    div.dataTables_wrapper div.dataTables_filter input {
        padding: 14px 6px;
    }

    div.dataTables_wrapper div.dataTables_length select {
        padding: 10px 6px;
        width: 70px;
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

    .card-header {
        padding: 0.5rem 1rem;
        margin-bottom: 0;
        background: #f7f7f8;
        border-bottom: 1px solid rgba(0, 0, 0, .125);
        border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
    }

    .card .card-header h2 {
        float: left;
        padding: 10px 0;
        margin: 0 0 0 20px;
    }

    .blue {
        color: #428bca !important;
    }

    .card .card-header h2 i {
        border-right: 1px solid #dbdee0;
        padding: 12px 0;
        height: 40px;
        width: 40px;
        display: inline-block;
        text-align: center;
        margin: -10px 20px -10px -20px;
        font-size: 16px;
    }

    .img-thumbnail {
        background-color: #f5f7fb;
        border: 1px solid #cbd5e1;
        border-radius: 10%;
        width: 80px !important;
    }
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Pengaturan Promosi
                </h2>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-6">
                <div class="card mb-2 w-100">
                    <div class="ribbon ribbon-top bg-info"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3" />
                            <path d="M4 6v6c0 1.657 3.582 3 8 3c1.075 0 2.1 -.08 3.037 -.224" />
                            <path d="M20 12v-6" />
                            <path d="M4 12v6c0 1.657 3.582 3 8 3c.166 0 .331 -.002 .495 -.006" />
                            <path d="M16 19h6" />
                            <path d="M19 16v6" />
                        </svg>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title text-primary fw-bold">
                            Tambah Produk
                        </h3>
                    </div>
                    <div class="card-body">
                        <form id="form-simpan" method="POST" autocomplete="off">
                            <div class="mb-3">
                                <label class="form-label required">Cari Barang</label>
                                <div>
                                    <select id="barang" name="barang" class="form-select" style="width: 100%;">
                                        <option value="" selected disabled>-- Pilih Barang --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" id="btn-submit" class="btn btn-primary w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="btn-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="12" r="9"></circle>
                                            <path d="M9 12l2 2l4 -4"></path>
                                        </svg>
                                        <span id="btn-icon"></span>
                                        <span id="btn-text">Proses Data</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" onclick="previewBarang()" class="btn btn-primary w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="btn-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                            <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                                            <path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path>
                                        </svg>
                                        <span id="btn-icon"></span>
                                        <span id="btn-text">Preview</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card mb-2 w-100">
                    <div class="ribbon ribbon-top bg-info"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                            <path d="M21 4H2v2h2.3l3.28 9a3 3 0 0 0 2.82 2H19v-2h-8.6a1 1 0 0 1-.94-.66L9 13h9.28a2 2 0 0 0 1.92-1.45L22 5.27A1 1 0 0 0 21.27 4 .84.84 0 0 0 21 4zm-2.75 7h-10L6.43 6h13.24z"></path>
                            <circle cx="10.5" cy="19.5" r="1.5"></circle>
                            <circle cx="16.5" cy="19.5" r="1.5"></circle>
                        </svg>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title text-primary fw-bold">
                            List Produk
                        </h3>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-sm" id="dataTemp">
                                <thead>
                                    <tr>
                                        <th width="20">No</th>
                                        <th>Produk</th>
                                        <th width="7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 justify-content-center text-end">
                                <button onclick="showTerms()" type="submit" id="btn-submit" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="btn-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                        <path d="M5 21h14a2 2 0 0 0 2-2V8l-5-5H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zM7 5h4v2h2V5h2v4H7V5zm0 8h10v6H7v-6z"></path>
                                    </svg>
                                    <span id="btn-icon"></span>
                                    <span id="btn-text">Proses Promo</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-status-top bg-info"></div>
                    <div class="card-body p-3">
                        <!-- Tombol Aksi -->
                        <div class="text-center mx-auto mb-3 d-flex justify-content-end">
                            <button onclick="ubahPromo(this)" class="btn btn-warning me-2">
                                <i class="fas fa-edit"></i> Edit Selected
                            </button>
                            <button onclick="deletePromo(this)" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete Selected
                            </button>
                        </div>

                        <!-- Tabel Responsif -->
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="dataPromosi" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center fw-bold" width="5%">No</th>
                                        <th class="text-center fw-bold" width="10%">Aksi</th>
                                        <th class="text-center fw-bold" width="10%">Image</th>
                                        <th class="text-left fw-bold">Produk</th>
                                        <th class="text-left fw-bold">Kategori</th>
                                        <th class="text-left fw-bold">Harga Jual</th>
                                        <th class="text-left fw-bold">Harga Promo</th>
                                        <th class="text-center fw-bold">Stok</th>
                                        <th class="text-left fw-bold">Masa Berlaku</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($promosi as $key => $value) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $key + 1 ?></td>
                                            <td class="text-center align-middle">
                                                <div class="icheck-primary">
                                                    <input value="<?= $value['id_brg'] ?>" name="name_promo[]" type="checkbox" id="someCheckboxId<?= $key ?>" />
                                                    <label for="someCheckboxId<?= $key ?>"></label>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <img style="height:40px;width:auto;border-radius:5px;border:1px solid #ddd" src="<?= base_url('public/template/upload/barang/' . $value['gambar_barang']) ?>" alt="<?= $value['nama_barang'] ?>" style="cursor: pointer">
                                            </td>
                                            <td class="align-middle text-left">
                                                <?= $value['nama_barang'] ?><br>
                                                <small class="text-muted">Barcode: <?= $value['barcode'] ?></small>
                                            </td>
                                            <td class="text-left align-middle">
                                                <?= $value['nama_kategori_brg'] ?>
                                            </td>
                                            <td class="text-left align-middle">
                                                <?= "Rp. " . number_format($value['harga_jual_barang']) ?>
                                            </td>
                                            <td class="text-left text-nowrap align-middle">
                                                <?php
                                                $persen = number_format((($value['harga_jual_barang'] - $value['harga_promo']) / $value['harga_jual_barang']) * 100, 0);
                                                ?>
                                                <span class="text-success">Rp. <?= number_format($value['harga_promo']) ?></span><br>
                                                <span class="text-info fw-bold">Hemat <?= $persen ?>%</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <?= $value['stock_brg'] . " " . $value['nama_satuan'] ?>
                                            </td>
                                            <td class="text-left align-middle">
                                                <?php
                                                $masa_berlaku_promo = $value['masa_berlaku_promo'];
                                                if ($masa_berlaku_promo !== null) {
                                                    $selisih_detik = strtotime($masa_berlaku_promo) - time();
                                                    echo date('d/M/Y H:i:s', strtotime($masa_berlaku_promo));

                                                    // Periksa apakah waktu telah berakhir
                                                    if ($selisih_detik < 0) {
                                                        echo "<br><span class='text-danger fw-bold'>Expired</span>";
                                                    } else {
                                                        echo "<br><span>Left: " . gmdate("H:i:s", $selisih_detik) . "</span>";
                                                    }
                                                } else {
                                                    echo '<span class="text-danger fw-bold">Belum di set</span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:#fafbfc !important">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="myModalLabel">Preview Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2 pb-2 px-4" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                <div class="text-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="36" height="36" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
                    </svg>
                </div>
                <div id="kontenPreview"></div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Promosi -->
<div class="modal fade" id="editPromosiModal" tabindex="-1" aria-labelledby="editPromosiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="editPromosiModalLabel">Proses Promosi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2 pb-2 px-3" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                <div class="text-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="36" height="36" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
                    </svg>
                </div>
                <div id="kontenPromosi"></div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                <button onclick="showConfirmation()" type="button" id="btn-promosi-submit" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check me-1" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M9 12l2 2l4 -4"></path>
                    </svg>
                    Simpan Semua
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Multiple -->
<div class="modal fade" id="editMultipleModal" tabindex="-1" aria-labelledby="editMultipleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="editMultipleModalLabel">Edit Promosi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2 pb-2 px-3" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                <div class="text-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="36" height="36" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
                    </svg>
                </div>
                <div id="kontenEditMultiple"></div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                <button onclick="showConfirmation2()" type="button" id="btn-promosi-submit" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check me-1" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M9 12l2 2l4 -4"></path>
                    </svg>
                    Simpan Semua
                </button>
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
<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.6.0/dist/autoNumeric.min.js"></script>


<script>
    $(document).ready(function() {
        $('#dataPromosi').DataTable({
            ordering: false,
        });

        $('#dataTemp').DataTable({
            "processing": true, // Menampilkan pesan "Processing..." selama data sedang dimuat.
            "serverSide": true, // Aktifkan mode server-side.
            "ordering": true,
            "searching": true,
            "lengthChange": true,
            "info": true,
            "paginate": true,
            "lengthMenu": [5, 10, 25, 50, 100], // Mengatur opsi untuk panjang data per halaman
            "pageLength": 5, // Menetapkan default panjang data per halaman
            "ajax": {
                "url": "<?= base_url('product/promosi_temp') ?>",
                "type": "POST",
                "error": function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                },
            },
            "columns": [
                // Gantilah 'data' dengan nama atribut yang sesuai dari respons JSON Anda.
                {
                    "data": null,
                    "className": "text-center align-middle",
                    "render": function(data, type, row, meta) {
                        // Menghasilkan nomor urut atau indeks
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "1",
                    "className": "text-left align-middle"
                },
                {
                    "data": "2",
                    "className": "text-center align-middle"
                },
            ],
        });

        const barangSelect = new Choices('#barang', {
            placeholder: '--Pilih Barang--',
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

        // Temukan elemen input pencarian di dalam kotak pencarian Choices.js
        // const searchInput = document.querySelector('.choices__input--cloned');
        const searchInput = document.querySelector('.choices__input--cloned[placeholder="Minimum 3 Character..."]');

        // Tambahkan event listener untuk memantau perubahan nilai pada input pencarian
        searchInput.addEventListener('input', function(event) {
            // Ambil nilai yang dimasukkan oleh pengguna
            const inputValue = this.value;
            if (inputValue.length >= 3) {
                $.ajax({
                    url: '<?php echo base_url('product/get_barang'); ?>',
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
                                value: item.id_brg,
                                label: '<b>' + item.barcode + '</b> - ' + item.nama_barang
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

        $('#form-simpan').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '<?= base_url('product/promosi_simpan') ?>', // Gantilah dengan URL tempat Anda menyimpan data
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // Menangani respons dari server
                    if (response.success == true) {
                        toastr.success(response.msg, '', {
                            timeOut: 3000
                        });
                        barangSelect.clearStore();
                        $('#dataTemp').DataTable().ajax.reload();

                        setTimeout(function() {
                            const choicesList = document.querySelector('#barang');
                            if (choicesList) {
                                choicesList.click();
                            }
                        }, 100);
                    } else {
                        toastr.error(response.msg, '', {
                            timeOut: 3000
                        });
                    }
                },
				beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                error: function(xhr, status, error) {
                    toastr.error('Mohon untuk memilih barang terlebih dahulu', '', {
                        timeOut: 3000
                    });
                }
            });
        });
    });

    function hapusData(idToDelete) {
        // Konfirmasi penghapusan
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            // Menggunakan AJAX untuk menghapus data
            $.ajax({
                url: '<?php echo site_url('product/promosi_delete_temp'); ?>/' + idToDelete,
                type: 'GET',
                success: function(data) {
                    $('#dataTemp').DataTable().ajax.reload();
                },
				beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                error: function() {
                    alert('Gagal menghapus data.');
                }
            });
        }
    }

    function showConfirmation() {
        var inputs = document.getElementsByName('hargaPromo[]');
        var isAllFilled = true;

        for (var i = 0; i < inputs.length; i++) {
            if (!inputs[i].value.trim()) {
                isAllFilled = false;
                break;
            }
        }

        if (!isAllFilled) {
            toastr.error('Mohon untuk melengkapi inputan', '', {
                timeOut: 3000
            });
        } else {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin melanjutkan?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mengambil nilai dari elemen input menggunakan jQuery
                    var idPromoValues = $('input[name="idPromo[]"]').map(function() {
                        return $(this).val();
                    }).get();

                    var hargaPromoValues = $('input[name="hargaPromo[]"]').map(function() {
						var an = AutoNumeric.getAutoNumericElement(this);
						return an ? an.getNumber() : null;
					}).get();

                    var masaBerlakuPromoValues = $('input[name="masaBerlakuPromo[]"]').map(function() {
                        return $(this).val();
                    }).get();

                    // Menyiapkan data yang akan dikirimkan
                    var data = {
                        idPromo: idPromoValues,
                        hargaPromo: hargaPromoValues,
                        masaBerlaku: masaBerlakuPromoValues
                    };

                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('product/promosi_save'); ?>',
                        data: data,
                        success: function(response) {
                            toastr.success(response.msg, '', {
                                timeOut: 2000
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                            $('#editPromosiModal').modal('hide');
                        },
						beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                        error: function(error) {
                            // Tambahkan logika atau tindakan jika terjadi kesalahan
                            alert(error);
                        }
                    });
                }
            });
        }
    }

    function showConfirmation2() {
        var inputs = document.getElementsByName('hargaPromoEdit[]');
        var isAllFilled = true;

        for (var i = 0; i < inputs.length; i++) {
            if (!inputs[i].value.trim()) {
                isAllFilled = false;
                break;
            }
        }

        if (!isAllFilled) {
            toastr.error('Mohon untuk melengkapi inputan', '', {
                timeOut: 3000
            });
        } else {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin melanjutkan?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mengambil nilai dari elemen input menggunakan jQuery
                    var idPromoValues = $('input[name="idPromoEdit[]"]').map(function() {
                        return $(this).val();
                    }).get();

					var hargaPromoValues = $('input[name="hargaPromoEdit[]"]').map(function() {
						var an = AutoNumeric.getAutoNumericElement(this);
						return an ? an.getNumber() : null;
					}).get();

                    var masaBerlakuPromoValues = $('input[name="masaBerlakuPromoEdit[]"]').map(function() {
                        return $(this).val();
                    }).get();

                    // Menyiapkan data yang akan dikirimkan
                    var data = {
                        idPromo: idPromoValues,
                        hargaPromo: hargaPromoValues,
                        masaBerlaku: masaBerlakuPromoValues
                    };

                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('product/promosi_update'); ?>',
                        data: data,
                        success: function(response) {
                            toastr.success(response.msg, '', {
                                timeOut: 2000
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                            $('#editPromosiModal').modal('hide');
                        },
						beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                        error: function(xhr, status, error) {
                            // Tangkap dan tampilkan pesan kesalahan
                            var errorMessage = xhr.status + ': ' + xhr.statusText + '\n' + error;
                            console.log('Terjadi kesalahan: ' + errorMessage);
                        }
                    });
                }
            });
        }
    }

    function showTerms() {
        $.ajax({
            url: '<?= base_url('product/promosi_count_tmp') ?>', // Gantilah dengan URL server side Anda untuk memeriksa count dari tabel
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.count <= 0) {
                    toastr.error('Barang tidak boleh kosong', '', {
                        timeOut: 3000
                    });
                } else {
                    // Tampilkan modal
                    $('#editPromosiModal').modal('show');
                    $('#kontenPromosi').empty();

                    var barang = response.barang;
                    var loop = ''; // Inisialisasi variabel loop di luar loop forEach

                    barang.forEach(function(item) {
                        loop += `
                            <thead>
                                <tr>
                                    <th class="text-success fw-bold" colspan="5" style="font-size: 12px;">
                                        ${item.nama_barang}
                                    </th>
                                </tr>
                                <tr>
                                    <th class="align-middle" rowspan="2">
                                        Rincian Barang
                                    </th>
                                    <th class="align-middle">
                                        HPP Barang
                                    </th>
                                    <th class="align-middle">
                                        Harga Jual Barang
                                    </th>
                                    <th class="align-middle">
                                        Set Harga Promo
                                    </th>
                                    <th class="align-middle">
                                        Masa Berlaku
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="1" class="text-center align-middle">
                                        ${item.hpp_barang}
                                    </td>
                                    <td colspan="1" class="text-center align-middle">
                                        ${item.harga_jual_barang}
                                    </td>
                                    <td colspan="1" class="text-center align-middle">
                                        <input type="hidden" name="idPromo[]" value="${item.id_brg}">
                                        <input required name="hargaPromo[]" type="text" min="1" class="form-control harga-promo-input" placeholder="Set Harga Promo (Dalam Rp.)">
                                    </td>
                                    <td colspan="1" class="text-center align-middle">
                                        <input required name="masaBerlakuPromo[]" id="masa_berlaku_promo_input" type="datetime-local" class="form-control" placeholder="Set Masa Berlaku Promo (Y-m-d H)" value="<?php echo $formattedTime; ?>">
                                    </td>
                                </tr>
                            </thead>
                        `;
                    });

                    var form = `
                        <div class="table-responsive">
                            <form id="editPromosiForm">
                                <table class="table table-bordered">
                                    ${loop}
                                </table>
                            </form>
                        </div>
                    `;

                    $('#kontenPromosi').append(form);

					if($('.harga-promo-input')) {
						AutoNumeric.multiple('.harga-promo-input', {
							digitGroupSeparator: '.',
							decimalCharacter: ',',
							decimalPlaces: 0,
							currencySymbol: 'Rp ',
							currencySymbolPlacement: 'p', // 'p' = prefix (di depan)
							unformatOnSubmit: true,
							modifyValueOnWheel: false,
						});
					}
                }
            },

			beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan Ajax: ' + status + ', ' + error);
            }
        });
    }

    function ubahPromo(element) {
        var selectedCheckboxes = $("input[name='name_promo[]']:checked");
        nilaiTerpilih = [];
        selectedCheckboxes.each(function() {
            nilaiTerpilih.push($(this).val());
        });

        if (selectedCheckboxes.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Silakan pilih minimal satu data sebelum mengedit',
                timer: 2000,
                timerProgressBar: true,
            });
            return;
        } else {
            $.ajax({
                url: '<?= base_url('product/editBySelected') ?>', // Gantilah dengan URL server side Anda untuk memeriksa count dari tabel
                method: 'POST',
                data: {
                    selectedItems: nilaiTerpilih
                },
                dataType: 'json',
                success: function(response) {
                    $('#editMultipleModal').modal('show');
                    $('#kontenEditMultiple').empty();

                    var barang = response;
                    var loop = ''; // Inisialisasi variabel loop di luar loop forEach

                    barang.forEach(function(item) {
                        loop += `
                            <thead>
                                <tr>
                                    <th class="text-success fw-bold" colspan="5" style="font-size: 12px;">
                                        ${item.nama_barang}
                                    </th>
                                </tr>
                                <tr>
                                    <th class="align-middle" rowspan="2">
                                        Rincian Barang
                                    </th>
                                    <th class="align-middle">
                                        HPP Barang
                                    </th>
                                    <th class="align-middle">
                                        Harga Jual Barang
                                    </th>
                                    <th class="align-middle">
                                        Set Harga Promo
                                    </th>
                                    <th class="align-middle">
                                        Masa Berlaku
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="1" class="text-center align-middle">
                                        ${item.hpp_barang}
                                    </td>
                                    <td colspan="1" class="text-center align-middle">
                                        ${item.harga_jual_barang}
                                    </td>
                                    <td colspan="1" class="text-center align-middle">
                                        <input type="hidden" name="idPromoEdit[]" value="${item.id_brg}">
                                        <input value="${item.harga_promo}" required name="hargaPromoEdit[]" type="text" min="1" class="form-control harga-promo-input-edit" placeholder="Set Harga Promo (Dalam Rp.)">
                                    </td>
                                    <td colspan="1" class="text-center align-middle">
                                        <input value="${(item.masa_berlaku_promo)}" required name="masaBerlakuPromoEdit[]" type="datetime-local" class="form-control" placeholder="Set Masa Berlaku Promo (Y-m-d H)">
                                    </td>
                                </tr>
                            </thead>
                        `;
                    });

                    var form = `
                        <div class="table-responsive">
                            <form id="editPromosiForm">
                                <table class="table table-bordered">
                                    ${loop}
                                </table>
                            </form>
                        </div>
                    `;

                    $('#kontenEditMultiple').append(form);

					if($('.harga-promo-input-edit')) {
						AutoNumeric.multiple('.harga-promo-input-edit', {
							digitGroupSeparator: '.',
							decimalCharacter: ',',
							decimalPlaces: 0,
							currencySymbol: 'Rp ',
							currencySymbolPlacement: 'p', // 'p' = prefix (di depan)
							unformatOnSubmit: true,
							modifyValueOnWheel: false,
						});
					}
                },
				beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan Ajax: ' + status + ', ' + error);
                }
            });
        }
    }

    function previewBarang() {
        var choicesList = document.querySelector('#barang');

        if (choicesList && choicesList.value) {
            var selectedValue = choicesList.value;

            $.ajax({
                url: '<?= base_url('product/getDataBarangById'); ?>',
                type: 'POST',
                data: {
                    id_brg: selectedValue
                },
                dataType: 'json',
                success: function(response) {
                    $('#previewModal').modal('show');
                    $('#kontenPreview').empty();

                    // Ambil elemen dengan ID kontenPreview
                    var kontenPreview = document.getElementById('kontenPreview');

                    // Tambahkan tabel yang telah Anda sediakan ke dalam elemen kontenPreview
                    kontenPreview.innerHTML = `
                    <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-lg-3 col-md-4 col-xs-4 align-middle">
                                            Nama Barang
                                        </th>
                                        <td colspan="4">${response.nama_barang}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">
                                            Nama Kategori Barang
                                        </th>
                                        <td colspan="4">${response.nama_kategori_brg}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">
                                            Barcode
                                        </th>
                                        <td colspan="4">${response.barcode}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">
                                            Stok Barang
                                        </th>
                                       <td colspan="4">${response.stock_brg} ${response.nama_satuan}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">
                                            Deskripsi Singkat
                                        </th>
                                        <td colspan="4">${response.description}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" rowspan="2">
                                            Rincian Harga
                                        </th>
                                        <th class="align-middle">
                                            HPP Barang
                                        </th>
                                        <th class="col-3 align-middle">
                                            Markup Barang
                                        </th>
                                        <th class="align-middle">
                                            PPN
                                        </th>
                                        <th class="align-middle">
                                            Harga Jual Barang
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>Rp. ${response.hpp_barang}</td>
                                        <td>${response.markup_barang} %</td>
                                        <td>${response.ppn_barang == 'Y' ? '10%' : '0%'}</td>
                                        <td>Rp. ${response.harga_jual_barang}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" rowspan="2">
                                            Rincian Promosi
                                        </th>
                                        <th colspan="2" class="align-middle">
                                            Promo Aktif?
                                        </th>
                                        <th colspan="1" class="align-middle">
                                            Persentase Promo
                                        </th>
                                        <th colspan="1" class="align-middle">
                                            Harga Promo
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                        ${response.promo_brg == 'On' ? '<span class="badge bg-success-lt">Aktif</span>' : '<span class="badge bg-danger-lt">NonAktif</span>'}
                                        </td>
                                        <td colspan="1" class="${response.promo_brg == 'On' ? 'text-success' : 'text-danger fw-bold'}">
                                        ${response.promo_brg == 'On' ? Math.floor(((response.harga_jual_barang - response.harga_promo) / response.harga_jual_barang) * 100) + '%' : 'Nonaktif'}
                                        </td>
                                        <td colspan="1" class="${response.promo_brg == 'On' ? 'text-success' : 'text-danger fw-bold'}">
                                        ${response.promo_brg == 'On' ? 'Rp. ' + response.harga_promo : 'Nonaktif'}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" rowspan="12">
                                            Rincian Promosi
                                        </th>
                                        <th colspan="4" class="align-middle">
                                            Gambar
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <img src="${response.gambar_barang === 'https://dodolan.jogjakota.go.id/assets/media/default/default-product.png' ? 'https://dodolan.jogjakota.go.id/assets/media/default/default-product.png' : '<?= base_url('public/template/upload/barang/') ?>' + response.gambar_barang}" style="border: 1px solid #ddd; padding: 5px; height: 100px;">
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    `;
                },
				beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                error: function(error) {
                    console.error('Error:', error);
                }
            });
        } else {
            toastr.error('Mohon Memilih Barang untuk direview', '', {
                timeOut: 2000
            });
        }
    }

    function deletePromo(element) {
        var selectedCheckboxes = $("input[name='name_promo[]']:checked");
        nilaiTerpilih = [];
        selectedCheckboxes.each(function() {
            nilaiTerpilih.push($(this).val());
        });
        if (selectedCheckboxes.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Silakan pilih minimal satu data sebelum menghapus',
                timer: 2000,
                timerProgressBar: true,
            });
            return;
        } else {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Loading ....',
                        timer: 2000,
                        timerProgressBar: true,
                    });

                    setTimeout(() => {
                        var url = "<?= base_url('product/promosi_delete_many') ?>";
                        var selectedItems = nilaiTerpilih.join(',');

                        // Menggunakan jQuery untuk kenyamanan dan kejelasan
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                selectedItems: selectedItems
                            },
                            success: function(response) {
                                window.location.reload();
                            },
							beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                            error: function(error) {
                                window.location.reload();
                            }
                        });
                    }, 2000);
                }
            });
        }
    }
</script>
</body>

</html>
