<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
   <title>Dashboard User</title>
   <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
   <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5" />
   <!-- Canonical SEO -->
   <link rel="canonical" href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" />
   <!-- Favicon -->
   <link rel="icon" type="image/x-icon" href="<?= base_url('') ?>public/template/img/favicon/favicon.ico" />
   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
   <!-- Icons. Uncomment required icon fonts -->
   <link rel="stylesheet" href="<?= base_url('') ?>public/template/vendor/fonts/boxicons.css" />
   <!-- Core CSS -->
   <link rel="stylesheet" href="<?= base_url('') ?>public/template/vendor/css/core.css" class="template-customizer-core-css" />
   <link rel="stylesheet" href="<?= base_url('') ?>public/template/vendor/css/theme-default.css" class="template-customizer-theme-css" />
   <link rel="stylesheet" href="<?= base_url('') ?>public/template/css/demo.css" />
   <!-- Vendors CSS -->
   <link rel="stylesheet" href="<?= base_url('') ?>public/template/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
   <link rel="stylesheet" href="<?= base_url() ?>public/template/vendor/libs/sweetalert2/sweetalert2.css" />
   <!-- <link rel="manifest" href="<?= base_url() ?>public/manifest.json"> -->
   <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
   <!-- Page CSS -->
   <!-- Helpers -->
   <script src="<?= base_url('') ?>public/template/vendor/js/helpers.js"></script>
   <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
   <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
   <script src="<?= base_url('') ?>public/template/js/config.js"></script>
   <!-- Global site tag (gtag.js) - Google Analytics -->
   <script async="async" src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
   <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
         dataLayer.push(arguments);
      }
      gtag("js", new Date());
      gtag("config", "GA_MEASUREMENT_ID");
   </script>
   <!-- Custom notification for demo -->
   <!-- beautify ignore:end -->
   <style>
      @font-face {
         font-family: 'gotham_fonts';
         src: url('<?= base_url('') ?>public/fonts/GothamBook.ttf');
      }

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

      .footer-nav {
         position: fixed;
         bottom: 0;
         background-color: #fff;
         width: 100%;
         z-index: 32;
         height: 60;
      }

      .footer-nav__link {
         text-align: center;
         padding: 0.8rem 0;
         display: block;
         color: #474645;
      }

      .footer-nav__link i {
         display: block;
         font-size: 2.8rem;
         margin-bottom: 0.5rem;
      }

      .footer-nav__link._active {
         color: #2F5596;
      }

      a:focus,
      a:hover {
         text-decoration: none;
         color: #2F5596;
      }

      .greeting-cs {
         background-color: #00b0d1;
         border-radius: 50%;
         width: 40px;
         height: 40px;
      }

      .row--5 {
         margin-left: -0.5rem !important;
         margin-right: -0.5rem !important;
      }

      .row--5>* {
         padding-left: 0.5rem !important;
         padding-right: 0.5rem !important;
      }

      .container {
         padding-right: 1.6rem;
         padding-left: 1.6rem;
      }

      @media (min-width: 576px) {
         .container {
            max-width: 540px;
         }
      }

      .card {
         border-radius: 0.25rem;
         border: 1px solid rgba(0, 0, 0, .125);
         background-color: #fff;
         flex-direction: column;
         box-shadow: 0 2px 4px 0 rgb(71 70 69 / 40%) !important;
         background-clip: border-box;
      }

      .card-img-top {
         width: 100%;
         border-top-left-radius: calc(0.25rem - 1px);
         border-top-right-radius: calc(0.25rem - 1px);
      }

      .avatar {
         border-radius: 50%;
         object-fit: cover;
      }
   </style>
</head>

<body>
   <nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
      <div class="container">
         <div class="nav-bar__left">
            <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Home</h1>
         </div>
      </div>
   </nav>

   <section class="mt-3 mb-1">
      <div class="container">
         <div class="input-group input-group-merge">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input style="border-radius: 0.25rem;" type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" />
         </div>
      </div>
   </section>
   <section class="mt-3 mb-1">
      <div class="container">
         <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
               <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
               <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
               <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
               <div class="carousel-item active" style="width:100%;height:200px">
                  <img src="https://sedekahonline.com/uploads/camp_slider/20220602134904-2022-06-02camp_slider134902.jpg" class="gambar d-block w-100" alt="..." style="width:100%;height:200px">
               </div>
               <div class="carousel-item" style="width:100%;height:200px">
                  <img src="https://sedekahonline.com/uploads/camp_slider/20220525170938-2022-05-25camp_slider170935.jpg" class="gambar d-block w-100" alt="..." style="width:100%;height:200px">
               </div>
               <div class="carousel-item" style="width:100%;height:200px">
                  <img src="https://sedekahonline.com/uploads/camp_slider/20230216141936-2023-02-16camp_slider141931.jpg" class="gambar d-block w-100" alt="..." style="width:100%;height:200px">
               </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Next</span>
            </button>
         </div>
      </div>
   </section>

   <section class="mt-3 mb-3">
      <div class="container">
         <div class="align-center row row--5">
            <?php foreach ($kategori as $key => $kt) : ?>
               <div class="col-4 mt-2 p-0 m-0">
                  <a href="https://sedekahonline.com/campaign/kategori/15">
                     <div class="card" style="border-radius: 0.25rem;border: 1px solid rgba(0,0,0,.125);background-color: #fff;flex-direction: column;box-shadow: 0 2px 4px 0 rgb(71 70 69 / 40%) !important;background-clip: border-box;">
                        <img src="https://sedekahonline.com/cc-content/themes/cicool-so/asset/img/icons/fitur-2.svg" height="35px" class="card-img-top" alt="Gambar Kartu" style="margin-top:10px">
                        <div class="card-body text-center pb-0 pt-3" style="margin-top:-10px">
                           <h6 class="card-title text-dark" style="font-size:12px"><?= $kt['nama_kategori_brg'] ?></h6>
                        </div>
                     </div>
                  </a>
               </div>
            <?php endforeach ?>
            <div class="col-4 mt-2">
               <a href="https://sedekahonline.com/campaign/kategori/15">
                  <div class="card">
                     <img src="https://sedekahonline.com/cc-content/themes/cicool-so/asset/img/icons/fitur-2.svg" height="35px" class="card-img-top" alt="Gambar Kartu" style="margin-top:10px">
                     <div class="card-body text-center pb-0 pt-3" style="margin-top:-10px;">
                        <h5 class="card-title text-dark" style="font-size:12px">Lihat Semua</h5>
                     </div>
                  </div>
               </a>
            </div>
         </div>
      </div>
   </section>

   <section class="mt-4 mb-3">
      <div class="container">
         <span class="dblock fw-bold fsize-p-2 mar-bottom--x-half">Lagi Promo Nih!!</span>
         <div class="d-flex mb-2">
            <span class="fsize-m-2" style="flex: 1;">Daftar Barang Promo</span>
            <a href="https://sedekahonline.com/campaign/all_campaign" class="fsize-m-2">Lihat Semua</a>
         </div>
         <div class="">
            <div class="scrollable-row justify-content-between d-flex overflow-auto">
               <?php foreach ($barang as $key => $brg) : ?>
                  <div class="col-sm-5 col-md-5 col-5 d-flex" style="padding-right: 10px;">
                     <div class="card mb-2">
                        <div class="p-2 text-center position-relative">
                           <a href="https://sedekahonline.com/campaign/view/bangunanalaulia" class="">
                              <img src="<?= $brg['gambar_barang1'] ?>" alt="Gambar Barang" loading="lazy" style="height: 70px !important;">
                           </a>
                        </div>
                        <div class="card-body pl-0 pr-0">
                           <h6 class="card-title text-muted"><?= $brg['nama_brg'] ?></h6>
                           <div class="mt-2">
                              <p class="text-primary mb-0" style="margin-top: -10px;">
                                 <span class="fw-bold" style="font-size: 14px;">Rp. <?= number_format($brg['harga_promo']) ?></span>
                              </p>
                              <p class="text-primary mb-0">
                                 <span id="persen" class="badge ml-2 bg-danger text-white"><?= number_format((($brg['harga_jual'] - $brg['harga_promo']) / ($brg['harga_jual']) * 100), 2) ?>%</span>
                                 <del style="font-size: 12px;">Rp. <?= number_format($brg['harga_jual']) ?></del>
                              </p>
                           </div>
                           <div class="pt-2">
                              <div>
                                 <button data-idproduk="<?= $brg['id_brg'] ?>" class="btn btn-primary btn-sm p-2 add_keranjang"><i class="bx bx-plus"></i> Keranjang</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php endforeach ?>
            </div>
         </div>
      </div>
   </section>

   <section class="mt-4 mb-3">
      <div class="container">
         <div class="d-flex mb-2">
            <span class="fsize-m-2" style="flex: 1;">Rekomendasi Untuk Kamu</span>
            <a href="https://sedekahonline.com/campaign/all_campaign" class="fsize-m-2">Lihat Semua</a>
         </div>
         <div class="">
            <div class="scrollable-row justify-content-between d-flex overflow-auto">
               <?php foreach ($barang as $key => $brg) : ?>
                  <div class="col-sm-5 col-md-5 col-5 d-flex" style="padding-right: 10px;">
                     <div class="card mb-2">
                        <div class="p-2 text-center position-relative">
                           <a href="https://sedekahonline.com/campaign/view/bangunanalaulia" class="">
                              <img src="<?= $brg['gambar_barang1'] ?>" alt="Gambar Barang" loading="lazy" style="height: 70px !important;">
                           </a>
                        </div>
                        <div class="card-body pl-0 pr-0">
                           <h6 class="card-title text-muted"><?= $brg['nama_brg'] ?></h6>
                           <div class="mt-2">
                              <p class="text-primary mb-0" style="margin-top: -10px;">
                                 <span class="fw-bold" style="font-size: 14px;">Rp. <?= number_format($brg['harga_promo']) ?></span>
                              </p>
                           </div>
                           <div class="pt-2">
                              <div>
                                 <button data-idproduk="<?= $brg['id_brg'] ?>" class="btn btn-primary btn-sm p-2 add_keranjang"><i class="bx bx-plus"></i> Keranjang</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php endforeach ?>
            </div>
         </div>
      </div>
   </section>

   <section class="mt-1 mb-4">
      <div class="container">
         <div class="card">
            <div class="card-body text-center">
               <span class="text-center text-primary fw-bold">Ingin melaporkan Bug?</span>
               <p class="">
                  Silahkan memberikan kritik dan saran terhadap aplikasi!
               </p>
               <a style="margin-top:-10px" href="https://sedekahonline.com/sedekah_rutin" class="btn btn-success"><i class='bx bxs-paper-plane'></i> Kritik Saran</a>
            </div>
         </div>
      </div>
   </section>

   <section class="mt-1 mb-4">
      <div class="container">
         <span class="mb-2 fw-bold">5 Kritik Saran User JMART Terakhir</span>

         <div class="load-data overflow-auto">
            <div class="card mt-2 p-2">
               <div class="row">
                  <div class="col-1 text-center">
                     1.
                  </div>
                  <div class="col-2">
                     <img src="https://sedekahonline.com/cc-content/themes/cicool-so/asset/uploads/user/default.png" class="avatar avatar--small mar-right--x-2 shadow" onerror="this.src='https://sedekahonline.com/cc-content/themes/cicool-so/asset/uploads/user/default.png';">
                  </div>
                  <div class="col-9">
                     <div class="" style="flex:1">
                        <span class="fsize-p-2 fcolor-primary fw-bold mar-bottom col-xs-12">Annisa</span>
                        <p class="fsize-m-4 fcolor-primary fw-bold mar-bottom col-xs-12">42 menit yang lalu </p>
                        <span class="dblock fsize-m-2">Kritik Saran 1</span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card mt-2 p-2">
               <div class="row">
                  <div class="col-1">
                     2.
                  </div>
                  <div class="col-2">
                     <img src="https://sedekahonline.com/cc-content/themes/cicool-so/asset/uploads/user/default.png" class="avatar avatar--small mar-right--x-2 shadow" onerror="this.src='https://sedekahonline.com/cc-content/themes/cicool-so/asset/uploads/user/default.png';">
                  </div>
                  <div class="col-9">
                     <div class="" style="flex:1">
                        <span class="fsize-p-2 fcolor-primary fw-bold mar-bottom col-xs-12">Andi</span>
                        <p class="fsize-m-4 fcolor-primary fw-bold mar-bottom col-xs-12">48 menit yang lalu </p>
                        <span class="dblock fsize-m-2">Kritik Saran 2</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <div class="row">
      <br><br><br><br>
   </div>

   <footer class="footer-nav">
      <div class="container">
         <div class="row">
            <div class="col-2">
               <a href="https://sedekahonline.com/" class="footer-nav__link _active">
                  <i class="fa fa-home" style="font-size: 24px;margin-top: 10px;margin-bottom: 0px;"></i>
                  <span>Home</span>
               </a>
            </div>
            <div class="col-2">
               <a href="https://sedekahonline.com/history" class="footer-nav__link">
                  <i class="fa fa-shopping-cart" style="font-size: 24px;margin-top: 10px;margin-bottom: 0px;"></i>
                  <span>Keranjang</span>
               </a>
            </div>
            <div class="col-4">
               <a href="https://sedekahonline.com/greeting" class="footer-nav__link">
                  <span class="greeting-cs" style="text-align:center !important;display: inline-block !important;">
                     <div style="margin-top: 7px"><img src="https://sedekahonline.com/cc-content/themes/cicool-so/asset/img/icons/circle-logo.svg" class="img-greeting"></div>
                  </span>
               </a>
            </div>
            <div class="col-2">
               <a href="https://sedekahonline.com/dompet" class="footer-nav__link">
                  <i class="fa fa-list" style="font-size: 24px;margin-top: 10px;margin-bottom: 0px;"></i>
                  <span>Pesanan</span>
               </a>
            </div>
            <div class="col-2">
               <a href="https://sedekahonline.com/member" class="footer-nav__link">
                  <i class="fa fa-user" style="font-size: 24px;margin-top: 10px;margin-bottom: 0px;"></i>
                  <span>Profil</span>
               </a>
            </div>
         </div>
      </div>
   </footer>
   <script src="<?= base_url() ?>public/template/vendor/libs/jquery/jquery.js"></script>
   <script src="<?= base_url() ?>public/template/vendor/libs/popper/popper.js"></script>
   <script src="<?= base_url() ?>public/template/vendor/js/bootstrap.js"></script>
   <script src="<?= base_url() ?>public/template/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
   <script src="<?= base_url() ?>public/template/vendor/js/menu.js"></script>
   <script src="<?= base_url() ?>public/template/js/main.js"></script>
   <script async defer src="https://buttons.github.io/buttons.js"></script>
   <script src="<?= base_url() ?>public/template/vendor/libs/sweetalert2/sweetalert2.js" />
   <script>
      document.addEventListener('DOMContentLoaded', function() {
         var myCarousel = new bootstrap.Carousel(document.getElementById('carouselExampleIndicators'), {
            interval: 1000 // Interval dalam milidetik (5000 ms = 5 detik)
         });
      });
   </script>
</body>

</html>
