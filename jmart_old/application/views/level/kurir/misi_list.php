<?php $this->load->view('layouts/kurir/head'); ?>
<style>
    ul.timeline {
        list-style-type: none;
        position: relative;
        padding-left: 40px;
    }

    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 2;
    }

    ul.timeline>li {
        margin: 20px 20px 20px 20px;
        padding-left: 10px;
    }

    ul.timeline>li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 2;
    }

    .navbar__left {
        width: 4rem;
        z-index: 2;
    }

    .title {
        font-weight: 700;
        margin-bottom: 0;
        color: #2C406E;
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

    .notification-list .list-items {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        margin: 0 -15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .notification-list>ul li {
        position: relative;
    }

    .pull_delete {
        position: relative;
        min-width: calc(100% + 90px) !important;
    }

    .media {
        display: flex;
        align-items: center;
    }

    .media-60 {
        width: 60px;
        min-width: 60px;
        height: 60px;
    }

    .m-r10 {
        margin-right: 10px;
    }

    .notification-list .list-items .media img {
        border-radius: 20px;
    }

    .media img {
        width: 100%;
        min-width: 100%;
        height: 100%;
        object-fit: cover;
    }

    img {
        border-style: none;
        height: auto;
        max-width: 100%;
        vertical-align: middle;
    }

    .notification-list .list-items .list-content .title {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .title {
        color: #000;
        font-weight: bold;
    }

    .dz-total-area.fixed {
        width: 100%;
        background-color: #FFFAF3;
    }

    .dz-total-area {
        padding: 15px 15px 15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .dz-total-area .total-prize {
        display: flex;
        gap: 6px;
        margin-bottom: 5px;
    }

    .dz-total-area .total-prize>li {
        font-size: 18px;
    }

    .dz-total-area .total-prize .prize {
        font-weight: 700;
    }

    .dz-total-area .dz-text {
        display: flex;
        align-items: center;
        font-size: 15px;
        font-weight: 500;
        color: #159E42;
        gap: 6px;
    }
</style>
<?php $this->load->view('layouts/kurir/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
    <div class="container">
        <div class="navbar__left">
            <a href="<?= base_url('home') ?>">
                <svg class="navbar__left__icon fw-bold text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);cursor:pointer;z-index: 2;">
                    <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
                </svg>
            </a>
        </div>

        <div class="nav-bar__center">
            <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;text-align:center !important;vertical-align:middle">Daftar Misi</h1>
        </div>
    </div>
</nav>

<div class="terms-tab-wrapper shadow">
    <div class="container">
        <ul class="nav row row--no terms-tab">
            <li class="nav-item col-6">
                <a class="nav-link active" id="Donasi-tab" data-toggle="tab" href="<?= base_url('misi/list') ?>" role="tab" aria-controls="home" aria-selected="true">Dalam Misi</a>
            </li>
            <li class="nav-item col-6">
                <a class="nav-link" id="Donasi-tab" data-toggle="tab" href="<?= base_url('misi/pending') ?>" role="tab" aria-controls="home" aria-selected="true">Belum Discan</a>
            </li>
        </ul>
    </div>
</div>

<section class="mt-3 mb-4">
    <div class="row">
        <div class="dz-list notification-list">
            <ul style="background-color:#FFFAF3">
                <?php foreach ($list as $key => $value) : ?>
                    <?php
                    $items = $this->db->select('*')->from('tb_pesanan_detail')->where('id_pesanan', $value['id_pesanan'])->get()->num_rows();
                    ?>
                    <a href="<?= base_url('misi/detail/' . $value['id_pesanan']) ?>" style="text-decoration: none;color:black">
                        <li class="list-items pull_delete" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#detailPesananModal<?= $value['id_pesanan'] ?>">
                            <div class=" media">
                                <div class="media-60 m-r10">
                                    <img src="<?= base_url('public/template/upload/user/' . $value['avatar']) ?>" alt="">
                                </div>
                                <div class="list-content">
                                    <h5 class="title"> <?= $value['nama_member'] . " <span class=\"text-success\">(" . $items . " barang)</span>" ?></h5>
                                    <span class="date"><?= date('d F Y H:i:s', strtotime($value['tgl_pesanan'])) ?></span>
                                </div>
                            </div>
                            <i class="pd_btn"></i>
                        </li>
                    </a>
                <?php endforeach ?>
            </ul>
            <?php if (count($list) <= 0) : ?>
                <div class="empty">
                    <div class="empty-action">
                        <div class="text-center">
                            <img src="https://i.imgur.com/dCdflKN.png" width="100" height="100" class="img-fluid">
                            <h3 class="mb-0"><strong>Empty</strong></h3>
                            <h4 class="mb-1">Tidak ada Misi saat ini</h4>
                            <a href="<?= base_url('home') ?>" class="btn btn-primary cart-btn-transform m-3" data-abc="true">Kembali ke Home</a>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>

<div class="row">
    <br><br><br><br>
</div>
<?php $this->load->view('layouts/kurir/menu'); ?>
<?php $this->load->view('layouts/kurir/footer'); ?>
</body>

</html>