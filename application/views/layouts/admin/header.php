</head>

<?php
$current_url = current_url();
$session = $this->session;
$nama = $session->userdata('nama');
$level = $session->userdata('level');
$id_user = $session->userdata('id_user');

$user = $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
$avatar = base_url('public/template/upload/user/default.png');
if ($user) {
	 $nama = $user['nama_member'];
	 $level = $user['level'];
	 $avatar = base_url('public/template/upload/user/' . $user['avatar']);
} else {
	 $nama = 'User';
	 $level = 'Guest';
}
?>

<body>
   <script src="<?= base_url('') ?>public/template/js/demo-theme.min.js?1692870487"></script>
	<div id="loading-screen" style="
    position: fixed;
    z-index: 9999;
    top: 0; left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(255,255,255,0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    transition: opacity 0.3s ease;
    visibility: hidden;
    opacity: 0;
">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<style>
	#loading-screen.show {
    visibility: visible !important;
    opacity: 1 !important;
}
</style>
<script>
    function showLoading() {
        document.getElementById('loading-screen').classList.add('show');
    }

    function hideLoading() {
        document.getElementById('loading-screen').classList.remove('show');
    }
</script>
   <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none" style="background: linear-gradient(to right, #216fcb, #3683de, #1b59a3) !important">
         <div class="container-xl">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal ms-2 pe-0 pe-md-3">
               <div class="d-flex justify-content-start align-items-center">
                  <div class="navbar-brand-image m-0 p-0 avatar avatar-md" style="background-color: transparent; background-image: url(<?= base_url() ?>public/template/img/favicon/logo-small.svg); border: none; box-shadow: none"></div>
                  <div class="navbar-brand-text">
                     <h1 class="d-none d-md-block d-lg-block" style="color: #ffffff!important">
                        Koperasi J-MART
                     </h1>
                     <h2 class="d-none d-md-block d-lg-block" style="font-weight: 400; color: #ffffff!important;margin-top: -20px;">
                        Aplikasi Order Online
                     </h2>
                     <h4 class="d-block d-md-none d-lg-none d-sm-block" style="color: #ffffff!important;">
                        Koperasi J-MART
                     </h4>
                     <h6 class="d-block d-md-none d-lg-none d-sm-block" style="font-weight: 400; color: #ffffff!important;margin-top: -20px;">
                        Aplikasi Order Online
                     </h6>
                  </div>
               </div>
            </div>
            <div class="navbar-nav flex-row order-md-last d-none d-md-flex align-items-center gap-2">
               <!-- Notifikasi Bell -->
               <div class="nav-item dropdown me-2">
                  <a href="#" class="nav-link lh-1 p-0 text-white position-relative d-flex align-items-center justify-content-center" data-bs-toggle="dropdown" aria-label="Notifikasi Orderan" style="height: 40px; width: 40px;">
                     <i class="fa fa-bell fa-lg"></i>
                     <span id="notif-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white" style="display:none; font-size:0.75em; min-width: 18px; min-height: 18px;">0</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow shadow-sm p-0" style="min-width: 320px; max-width: 95vw; max-height: 400px; overflow-y: auto; border-radius: 10px;">
                     <li class="px-3 pt-2 pb-1 fw-bold text-primary small">Notifikasi Orderan Masuk</li>
                     <div id="notif-list"></div>
                  </ul>
               </div>
               <!-- Akhir Notifikasi Bell -->
               <div class="nav-item dropdown">
                  <a href="#" class="nav-link d-flex lh-1 p-0 dropdown-toggle text-white align-items-center" data-bs-toggle="dropdown" aria-label="Open user menu">
                     <span class="avatar avatar-sm" style="background-image: url(<?= $avatar ?>)"></span>
                     <div class="d-none d-xl-block ps-2 pe-1">
                        <div style="color: #ffffff!important;font-weight: bold;"><?= $nama ?></div>
                        <div style="color: #ffffff!important" class="mt-1 small text-secondary"><?= $level ?></div>
                     </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                     <a href="<?= base_url('profile') ?>" class="dropdown-item">Detail Profile</a>
                     <a href="<?= base_url('sandi') ?>" class="dropdown-item">Kata Sandi</a>
                     <a href="javascript::void" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
                  </div>
               </div>
            </div>
            <div class="navbar-nav flex-row order-md-last d-md-none">
            </div>
         </div>
      </header>
      <?php $this->load->view('layouts/admin/menu'); ?>
      <div class="page-wrapper">
