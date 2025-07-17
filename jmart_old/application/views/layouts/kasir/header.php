</head>

<body>
   <script src="<?= base_url('') ?>public/template/js/demo-theme.min.js?1692870487"></script>
   <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none" style="background: linear-gradient(to right, #489ce2, #4299e1, #2181d0) !important">
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
            <div class="navbar-nav flex-row order-md-last d-none d-md-block">
               <div class="nav-item dropdown">
                  <a href="#" class="nav-link d-flex lh-1 p-0 dropdown-toggle text-white" data-bs-toggle="dropdown" aria-label="Open user menu">
                     <span class="avatar avatar-sm" style="background-image: url(https://demo.aplikasi-spa.com/media/images/account/photo.png)"></span>
                     <div class="d-none d-xl-block ps-2 pe-1">
                        <div style="color: #ffffff!important;font-weight: bold;">Muhammad Rifki Kardawi</div>
                        <div style="color: #ffffff!important" class="mt-1 small text-secondary">Kasir</div>
                     </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                     <a href="#" class="dropdown-item">Status</a>
                     <a href="./profile.html" class="dropdown-item">Profile</a>
                     <a href="#" class="dropdown-item">Feedback</a>
                     <div class="dropdown-divider"></div>
                     <a href="./settings.html" class="dropdown-item">Settings</a>
                     <a href="<?= base_url('login/logout') ?>" class="dropdown-item">Logout</a>
                  </div>
               </div>
            </div>
            <div class="navbar-nav flex-row order-md-last d-md-none">
            </div>
         </div>
      </header>
      <?php $this->load->view('layouts/kasir/menu'); ?>
      <div class="page-wrapper">