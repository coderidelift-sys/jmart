<?php $this->load->view('layouts/admin/head'); ?>
<style>
    .table thead th,
    .markdown>table thead th {
        color: #626976;
        background: #f2f3f4;
        font-size: 0.625rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        line-height: 1.6;
        color: #626976;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        white-space: nowrap;
    }

    .img-thumbnail {
        background-color: #f5f7fb;
        border: 1px solid #cbd5e1;
        border-radius: 10%;
        width: 100px !important;
    }
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Detail Produk
                </h2>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <div class="btn-group">
                    <a href="<?= base_url('product') ?>" class="btn btn-primary me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                        </svg>
                        Kembali
                    </a>
                    <button class="btn btn-primary dropdown-toggle text-uppercase" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical" width="40" height="40" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                        </svg>Aksi
                    </button>
                    <ul class="dropdown-menu bg-secondary">
                        <li>
                            <a href="<?= base_url('product/edit/' . $barang['id_brg']) ?>" class="dropdown-item small text-white">
                                Edit Detail
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item small text-white delete" data-id="77">
                                Hapus
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <!-- Column -->
            <div class="col-sm-12 col-md-12">
                <div class="card mb-3">
                    <div class="card-header border-0 pb-0">
                        <h4 class="card-title text-muted text-uppercase">
                            Detail Informasi Produk
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-lg-3 col-md-4 col-xs-4 align-middle">
                                            Nama Barang
                                        </th>
                                        <td colspan="4">
                                            <?= $barang['nama_barang'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">
                                            Nama Kategori Barang
                                        </th>
                                        <td colspan="4">
                                            <?= $barang['nama_kategori_brg'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">
                                            Barcode

                                        </th>
                                        <td colspan="4">
                                            <?= $barang['barcode'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">
                                            Stok Barang
                                        </th>
                                        <td colspan="4">
                                            <?= $barang['stock_brg'] . " " . $barang['nama_satuan'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">
                                            Deskripsi Singkat
                                        </th>
                                        <td colspan="4">
                                            <?= $barang['description'] == "" ? "Tidak ada deskripsi" : $barang['description'] ?>
                                        </td>
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
                                        <td>
                                            Rp. <?= number_format($barang['hpp_barang']) ?>
                                        </td>
                                        <td>
                                            <?= $barang['markup_barang'] ?>%
                                        </td>
                                        <td>
                                            <?= $barang['ppn_barang'] == "Y" ? "10" : "0" ?>%
                                        </td>
                                        <td>
                                            Rp. <?= number_format($barang['harga_jual_barang']) ?>
                                        </td>
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
                                            <?= $barang['promo_brg'] == "On" ? "<span class=\"badge bg-success-lt\">Aktif</span>" : "<span class=\"badge bg-orange-lt\">Tidak</span>" ?>
                                        </td>
                                        <td colspan="1">
                                            <?= $barang['promo_brg'] == "On" ? "<span class='text-success fw-bold'>" . number_format(($barang['harga_jual_barang'] - $barang['harga_promo']) / ($barang['harga_jual_barang']), 2) * 100 . "%</span>" : "" ?>
                                        </td>
                                        <td colspan="1">
                                            <?= $barang['promo_brg'] == "On" ? "<span class='text-success fw-bold'>Rp. " . number_format($barang['harga_promo']) . "</span>" : "" ?>
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
                                            <?php
                                            $gambarSrc = $barang['gambar_barang'] == "https://dodolan.jogjakota.go.id/assets/media/default/default-product.png"
                                                ? $barang['gambar_barang']
                                                : base_url('public/template/upload/barang/' . $barang['gambar_barang']);

                                            $gambar = "<img src='" . $gambarSrc . "' style='border: 1px solid #ddd; padding: 5px; height: 100px;'>";
                                            echo $gambar;
                                            ?>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
</div>
<?php $this->load->view('layouts/admin/footer'); ?>
</body>

</html>