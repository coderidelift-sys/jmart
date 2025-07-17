<?php $this->load->view('layouts/user/head'); ?>
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

    .avatar-container {
        position: relative;
        display: inline-block;
    }

    .avatar {
        display: block;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        width: 85px;
        height: 85px;
    }

    .border-effect {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 4px solid gold;
        /* Warna border emas */
        border-radius: 50%;
        box-sizing: border-box;
        pointer-events: none;
    }

    .transparent-border {
        position: absolute;
        top: 4px;
        /* Sesuaikan jarak dengan border utama yang Anda inginkan */
        left: 4px;
        /* Sesuaikan jarak dengan border utama yang Anda inginkan */
        width: calc(100% - 8px);
        /* Sesuaikan sesuai dengan jarak yang Anda inginkan */
        height: calc(100% - 8px);
        /* Sesuaikan sesuai dengan jarak yang Anda inginkan */
        border: 2px solid rgba(255, 215, 0, 0.5);
        /* Warna border kedua emas dengan transparansi */
        border-radius: 50%;
        box-sizing: border-box;
        pointer-events: none;
    }
</style>
<?php $this->load->view('layouts/user/header'); ?>
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
                <div class="avatar-container">
					<?php
					$avatarPath = 'public/template/upload/user/';
					$defaultAvatar = 'default.png'; // fallback default
					$avatarFile = isset($user['avatar']) && file_exists(FCPATH . $avatarPath . $user['avatar']) && !empty($user['avatar'])
						? $user['avatar']
						: $defaultAvatar;

					$avatarUrl = base_url($avatarPath . $avatarFile);
					$fallbackUrl = base_url($avatarPath . $defaultAvatar);
					?>

					<img src="<?= $avatarUrl ?>"
						class="avatar avatar--large profile-kad__avatar shadow"
						onerror="this.onerror=null;this.src='<?= $fallbackUrl ?>'"
						loading="lazy"
						decoding="async"
						width="100"
						height="100">
                    <div class="border-effect"></div>
                </div>
                <a href="<?= base_url('akun/edit') ?>" class="btn btn-primary float-end">Edit Profil</a>
            </div>
            <div class="card-body">
                <span class="text-primary fw-bold"><?= $user['nama_member'] ?></span>
                <p class="">Bergabung pada : <?= date('d/m/Y H:i:s', strtotime($user['created_at'])) ?></p>
            </div>
        </div>
		<?php if (empty($alamat)): ?>
			<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
				<strong>Perhatian!</strong> Anda belum menambahkan alamat, isi alamat Anda di <a href="<?= base_url('akun/alamat') ?>">sini</a>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php endif; ?>
		<?php if (!$has_update_password): ?>
			<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
				<strong>Perhatian!</strong> Anda belum mengganti kata sandi, ganti kata sandi Anda di <a href="<?= base_url('akun/edit') ?>">sini</a>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php endif; ?>
        <div class="card mt-3" style="position: relative;">
            <div class="card-header" style="justify-content: space-between;">
                <img src="<?= base_url('public/template/img/illustrations/maps.png') ?>" style="height: 50px;">
                <a href="<?= base_url('akun/alamat') ?>" class="btn btn-primary float-end">Edit Alamat</a>
            </div>
            <div class="card-body">
                <span class="dblock fsize-m-2 mar-bottom--x-half mar-top--x-half">
                    <?php if (!empty($alamat)) : ?>
                        <?= $alamat['nama_desa'] ?>, <?= $alamat['nama_kecamatan'] ?>, <?= $alamat['nama_kabupaten'] ?>, <?= $alamat['nama_provinsi'] ?>, ID | <?= $alamat['kode_pos'] ?>
                    <?php else : ?>
                        Alamat Belum Ditambahkan!
                    <?php endif ?>
                </span>
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

<?php $this->load->view('layouts/user/menu'); ?>
<?php $this->load->view('layouts/user/footer'); ?>
</body>

</html>
