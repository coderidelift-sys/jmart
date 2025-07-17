<?php $this->load->view('layouts/kurir/head'); ?>
<style>
    .info-list:not(:last-child)>div {
        margin-bottom: 1.6rem;
    }

    .info-list>div {
        margin-top: 0.4rem;
    }

    .fcolor-default2 {
        color: #999999 !important;
    }

    .fsize-p-2 {
        font-size: 1rem;
    }
</style>
<?php $this->load->view('layouts/kurir/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
    <div class="container">
        <div class="nav-bar__left">
            <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Akun</h1>
        </div>
    </div>
</nav>

<section class="mt-4 mb-4">
    <div class="container">
        <div class="card" style="background-image: url('public/template/img/illustrations/path-card.svg');background-position: bottom right;background-repeat: no-repeat;">
            <div class="card-header" style="justify-content: space-between;">
                <img style="width: 5.6rem;height: 5.6rem;" src="<?= base_url('public/template/upload/user/' . $user['avatar']) ?>" class="avatar avatar--large profile-kad__avatar shadow" onerror="this.src='<?= base_url('public/template/upload/user/' . $user['avatar']) ?>'">
                <a href="<?= base_url('akun/edit') ?>" class="btn btn-primary float-end">Edit Profil</a>
            </div>
            <div class="card-body">
                <span class="text-primary fw-bold"><?= $user['nama_member'] ?></span>
                <p class="">Bergabung pada : <?= date('d/m/Y H:i:s', strtotime($user['created_at'])) ?></p>
            </div>
        </div>
    </div>
</section>

<section class="mt-1 mb-4">
    <div class="container">
        <span class="mb-2 fw-bold">Biodata Anda</span>
        <div class="card mt-2">
            <div class="card-body">
                <div class="info-list">
                    <span class="dblock fw-bold fsize-m-2 fcolor-default2">Nomor Whatsapp</span>
                    <div class="fsize-p-2"><?= $user['wa_member'] ?></div>
                </div>
                <div class="info-list">
                    <span class="dblock fw-bold fsize-m-2 fcolor-default2">Nomor Induk</span>
                    <div class="fsize-p-2"><?= $user['nomor_induk'] ?></div>
                </div>
                <div class="info-list">
                    <span class="dblock fw-bold fsize-m-2 fcolor-default2">Nama Lengkap</span>
                    <div class="fsize-p-2"><?= $user['nama_member'] ?></div>
                </div>
                <div class="info-list">
                    <span class="dblock fw-bold fsize-m-2 fcolor-default2">Username</span>
                    <div class="fsize-p-2"><?= $user['username'] ?></div>
                </div>
                <div class="info-list">
                    <span class="dblock fw-bold fsize-m-2 fcolor-default2">Email</span>
                    <div class="fsize-p-2"><?= $user['email_member'] ?></div>
                </div>
            </div>
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