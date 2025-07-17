<?php $this->load->view('layouts/user/head'); ?>
<style>
    .navbar {
        width: 100%;
        height: 4rem;
        color: #fff;
        z-index: 1;
    }

    .nav-bar__center__title {
        position: absolute;
        font-size: 1.1rem;
        font-weight: normal;
        text-align: center;
        width: 100%;
        margin: 0;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .navbar__left {
        width: 4rem;
        z-index: 2;
    }

    .terms-tab-wrapper {
        background-color: #fff;
    }

    .terms-tab-wrapper .terms-tab .nav-item .nav-link {
        text-align: center;
        font-weight: bold;
        color: #999999;
        padding: 0;
        height: 3.4rem;
        line-height: 3.4rem;
        border-bottom: 0;
        transition: .2s ease-in-out;
    }

    .terms-tab-wrapper .terms-tab .nav-item .nav-link.active {
        color: #2F5596;
        border-bottom: 0.4rem solid #2F5596;
    }

    .no-padding {
        margin: 0;
        /* Menghapus margin bawaan */
    }

    .order-product-box {
        display: block;
        /* background-color: rgba(240, 240, 241, 1); */
        background-color: white;
        border-radius: 8px;
        padding: 12px;
    }

    .order-product-box .horizontal-product-box {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        gap: 10px;
        padding: 0;
        padding-bottom: 12px;
    }

    .horizontal-product-box {
        background: rgba(var(--light-bg), 1);
        border-radius: 8px;
        padding: 10px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        gap: 10px;
    }

    .order-product-box .horizontal-product-box .horizontal-product-img {
        width: 68px;
        height: 68px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        background-color: rgba(240, 240, 241, 1);
        border-radius: 8px;
    }

    .horizontal-product-box .horizontal-product-img {
        width: 80px;
        height: 80px;
        padding: 12px 18px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        background: rgba(255, 255, 255, 1);
        border-radius: 8px;
    }

    .order-product-box .horizontal-product-box .horizontal-product-details {
        width: calc(100% - 45px - 15px);
    }

    .horizontal-product-box .horizontal-product-details {
        width: calc(100% - 80px - 10px);
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .gap-2 {
        gap: 0.5rem !important;
    }

    .order-product-box .horizontal-product-box .horizontal-product-details h4 {
        font-weight: 500;
        line-height: 1.2;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .horizontal-product-box .horizontal-product-details h4 {
        font-weight: 500;
        line-height: 1.2;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        color: rgba(18, 38, 54, 1);
    }

    .order-product-box .horizontal-product-box .horizontal-product-details .product-status {
        color: rgba(25, 135, 84, 1);
        background-color: rgba(25, 135, 84, 0.12);
        padding: 4px 8px;
        border-radius: 4px;
    }

    .order-product-box .horizontal-product-box .horizontal-product-details h5 {
        font-weight: 400;
        line-height: 1;
        color: rgba(155, 163, 170, 1);
        margin-top: 5px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .order-product-box .horizontal-product-box .horizontal-product-details .view-details {
        color: rgba(240, 73, 73, 1);
    }

    .order-product-box .order-details {
        padding-top: 12px;
        border-top: 1px solid rgba(0, 0, 0, 0.07);
    }

    .theme-form .upload-image {
        width: 100px;
        height: 100px;
        background-color: rgba(246, 246, 247, 1);
        -webkit-backdrop-filter: blur(2px);
        backdrop-filter: blur(2px);
        border-radius: 6px;
        color: rgba(255, 255, 255, 1);
        border: 1px dashed rgba(155, 163, 170, 1);
        overflow: hidden;
        margin-top: 12px;
    }

    .theme-form .upload-image .upload-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
        color: rgba(var(--light-text), 1);
    }

    .bintang {
        font-size: 30px;
        cursor: pointer;
    }

    .bintang-terpilih {
        color: gold;
    }
</style>
<?php $this->load->view('layouts/user/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
    <div class="container nav-bar__on-container" style="display: flex;">
        <div class="navbar__left">
            <a href="<?= base_url('pesanan') ?>">
                <svg class="navbar__left__icon fw-bold text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);cursor:pointer;z-index: 2;">
                    <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
                </svg>
            </a>
        </div>
        <div class="nav-bar__center">
            <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Riwayat Autodebit</h1>
        </div>
    </div>
</nav>
<div class="terms-tab-wrapper shadow">
    <div class="container">
        <ul class="nav row row--no terms-tab overflow-auto">
            <li class="nav-item col-6">
                <a class="nav-link" id="Donasi-tab" data-toggle="tab" href="<?= base_url('pesanan/autodebit') ?>" role="tab" aria-controls="home" aria-selected="true">Belum Lunas</a>
            </li>
            <li class="nav-item col-6">
                <a class="nav-link active" id="Campaign-tab" data-toggle="tab" href="<?= base_url('pesanan/autodebit/lunas') ?>" role="tab" aria-controls="profile" aria-selected="false">Lunas</a>
            </li>
        </ul>
    </div>
</div>

<section class="mt-4 mb-4">
    <div class="container">
        <?php foreach ($autodebit as $key => $value) : ?>
            <?php
            $all = $this->db->select('*')->from('tb_pesanan_detail')->where('id_pesanan', $value['id_pesanan'])->get()->num_rows();

            $sum = $this->db->select('SUM(harga_saat_ini * jumlah_jual) as total_harga')->from('tb_pesanan_detail')->where('id_pesanan', $value['id_pesanan'])->get()->row();

            $data = $this->db->select('*')->from('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg')->where('id_pesanan', $value['id_pesanan'])->get()->row_array();
            ?>
            <div class="col-12 mb-3">
                <div class="order-product-box">
                    <div class="horizontal-product-box">
                        <a href="<?= base_url('pesanan/tracking/' . $value['id_pesanan']) ?>" class="horizontal-product-img">
                            <img style="height: 50px;" class="img-fluid img" src="<?= base_url('public/template/upload/barang/' . $data['gambar_barang']) ?>" alt="p3">
                        </a>
                        <div class="horizontal-product-details">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <h4 style="font-size: 14px;margin-bottom: 0;"><?= $data['nama_barang'] ?></h4>

                                <h6 style="font-size: 12px;line-height: 1.2;margin-bottom: 0;" class="product-status bg-success text-white">Lunas</h6>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <h5 onclick="location.href='<?= base_url('pesanan/detail/' . $value['id_pesanan']) ?>'" style="font-size: 13px; line-height: 1.2; margin-bottom: 0; cursor:pointer" class="view-details">View Details</h5>
                                </div>
                                <div class="col-auto">
                                    <h5 onclick="location.href='<?= base_url('pesanan/tracking/' . $value['id_pesanan']) ?>'" style="font-size: 13px; line-height: 1.2; margin-bottom: 0; cursor:pointer" class="view-details text-success">Lacak Pesanan</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-details d-block">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="opacity-70" style="font-size: 13px;line-height: 1.2;margin-bottom: 10px;">Qty: <?= $all ?> produk</h5>
                            <?php
                            $grand = $this->db->select('*')->from('tb_pesanan')->where('id_pesanan', $value['id_pesanan'])->get()->row_array();
                            ?>
                            <h5 class="opacity-70 text-primary" style="font-size: 13px;line-height: 1.2;margin-bottom: 10px;">Rp. <?= number_format($grand['grand_total']) ?></h5>
                        </div>
                    </div>
                    <div class="order-details d-block">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 style="font-size: 13px;line-height: 1.2;margin-bottom: 0;" class="theme-color">Order : <span class="light-text"><?= date('d/M/Y H:i:s', strtotime($value['tgl_pesanan'])) ?></span></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        <?php if (empty($autodebit)) : ?>
            <div class="page page-center">
                <div class="container-tight py-4">
                    <div class="empty">
                        <div class="empty-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1)">
                                <path d="M19 4h-3V2h-2v2h-4V2H8v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-7 10H7v-2h5v2zm5-4H7V8h10v2z"></path>
                            </svg>
                        </div>
                        <p class="empty-subtitle text-secondary">
                            Belum Ada Autodebit
                        </p>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</section>

<div class="row">
    <br><br><br><br>
</div>

<?php $this->load->view('layouts/user/menu'); ?>
<?php $this->load->view('layouts/user/footer'); ?>
</body>

</html>