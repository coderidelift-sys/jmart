<?php $this->load->view('layouts/user/head'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<style>
   .recomended-list {
      background-color: #2C406E;
      border-radius: 8px;
      overflow: hidden;
   }

   .recomended-list .image-box {
      position: relative;
   }

   .recomended-list .image-box img {
      min-width: 230px;
      height: 200px;
      width: 100%;
      /* object-fit: cover; */
      border-radius: 8px;
   }

   .recomended-list .image-box .form-check.bookmark {
      padding: 0;
   }

   .recomended-list .image-box .form-check {
      min-height: 0;
      margin-bottom: 0;
   }

   .recomended-list .image-box .form-check.bookmark .form-check-input {
      display: none;
   }

   .form-check .form-check-input {
      width: 20px;
      height: 20px;
      margin-top: 0.2rem;
   }

   .form-check-input[type="checkbox"] {
      border-radius: 0.25em;
   }

   .form-check .form-check-input {
      float: left;
      margin-left: -1.5em;
   }

   .form-check-input {
      width: 1em;
      height: 1em;
      margin-top: 0.3em;
      vertical-align: top;
      background-color: #f7f7f7;
      background-repeat: no-repeat;
      background-position: center;
      background-size: contain;
      border: 1px solid rgba(0, 0, 0, 0.25);
      appearance: none;
   }

   .recomended-list .image-box .form-check.bookmark .form-check-label {
      position: absolute;
      top: 10px;
      right: 10px;
      border-radius: 50%;
      text-align: center;
      width: 45px;
      height: 45px;
      line-height: 45px;
      background-color: #DFE8E3;
      box-shadow: 0px 12px 30px 0px rgb(48 48 48 / 8%);
      cursor: pointer;
   }

   .form-check .form-check-label {
      margin-left: 8px;
   }

   .recomended-list .text-content {
      padding: 10px 15px;
   }

   .recomended-list .text-content .title {
      font-weight: 600;
      color: #fff;
      line-height: 1.5;
   }

   .title {
      font-weight: 700;
      margin: 0;
      color: #2C406E;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
   }

   .recomended-list .image-box .form-check {
      min-height: 0;
      margin-bottom: 0;
   }

   .m-t10 {
      margin-top: 10px;
   }

   .swiper-container {
      width: 100%;
      margin: 0 auto;
      overflow: hidden;
   }

   .swiper-container1 {
      width: 100%;
      margin: 0 auto;
      overflow: hidden;
   }

   .categore-box.style-1 {
      display: block;
      padding: 6px 6px 12px;
      text-align: center;
   }

   .categore-box {
      border: 1px solid #E8EFF3;
      border-radius: 8px;
      background: #FFF;
   }

   .categore-box .icon-bx {
      height: 48px;
      width: 48px;
      border-radius: 8px;
      margin-bottom: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-left: auto;
      margin-right: auto;
   }

   .bg-pink {
      background-color: #ff4db8;
   }

   .categore-box.style-1 .title {
      display: block;
      color: #4f658b;
      font-size: 12px;
      /* white-space: nowrap; */
   }

   .item-box {
      display: flex;
      justify-content: space-between;
      background: #FFF;
      border-radius: 8px;
      overflow: hidden;
      margin: 20px 0;
      box-shadow: 3px 0px 25px -6px rgb(48 48 48 / 10%);
   }

   .item-box .item-media {
      overflow: hidden;
      min-width: 100px;
   }

   .item-box .item-content {
      width: 100%;
      padding: 7px 25px;
      background: #FFF;
      box-shadow: 0px 12px 30px 0px rgba(48, 48, 48, 0.14);
      border-radius: 8px;
      margin-left: -30px;
      display: flex;
      flex-direction: column;
      justify-content: space-evenly;
   }

   .item-box .item-content .item-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
   }

   .btn-outline-primary {
      color: #42A7E5;
      border-color: #42A7E5;
   }

   .author-notification .inner-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
   }

   .badge.counter {
      position: absolute;
      z-index: 2;
      right: -8px;
      top: -6px;
      font-weight: 600;
      width: 19px;
      height: 19px;
      border-radius: 50%;
      padding: 3px 4px;
      font-size: 12px;
   }

   .bg-warning,
   .badge-warning {
      background-color: #ffaf00 !important;
      color: #020310;
   }

   .horizontal-product-box {
      background: rgba(235, 235, 236, 1);
      border-radius: 8px;
      padding: 10px;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      gap: 10px;
   }

   .horizontal-product-box .horizontal-product-img {
      width: 100px;
      height: 100px;
      padding: 8px 14px;
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

   .horizontal-product-box .horizontal-product-details h4 {
      font-weight: 500;
      line-height: 1.2;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      color: rgba(18, 38, 54, 1);
   }

   .horizontal-product-box .horizontal-product-details h5 {
      font-weight: 400;
      line-height: 1;
      color: rgba(155, 163, 170, 1);
      margin-top: 5px;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
   }

   .theme-color {
      color: rgba(18, 38, 54, 1);
   }

   .horizontal-product-box .horizontal-product-details .cart-bag {
      background-color: #DFE8E3;
      border-radius: 100%;
      width: 45px;
      height: 45px;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
   }

   .horizontal-product-box .horizontal-product-details .save {
      color: rgba(240, 73, 73, 1);
   }
</style>
<?php $this->load->view('layouts/user/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
   <div class="container">
      <div class="nav-bar__left">
         <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Home</h1>
      </div>
   </div>
</nav>

<section class="mt-3 mb-1">
   <div class="container">
      <div class="mb-3">
         <div class="row g-2">
            <div class="author-notification">
               <div class="container inner-wrapper" style="max-width: 1024px;margin-left: auto;margin-right: auto;padding-left: 10px;padding-right: 15px;box-sizing: border-box;padding-top: 15px;padding-bottom: 15px;">
                  <div class="dz-info">
                     <span class="text-dark"><?= $now ?></span>
                     <h3 class="name mb-0"><?= $this->session->userdata('nama') ?> 👋</h3>
                  </div>
                  <a href="javascript:void(0);" class="position-relative me-2 notify-cart" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom2" aria-controls="offcanvasBottom">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                        <path d="M4 18h2v4.081L11.101 18H16c1.103 0 2-.897 2-2V8c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2z"></path>
                        <path d="M20 2H8c-1.103 0-2 .897-2 2h12c1.103 0 2 .897 2 2v8c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2z"></path>
                     </svg>
                     <span style="cursor: pointer;" onclick="location.href='#'" class="badge bg-danger text-white counter">0</span>
                  </a>
               </div>
            </div>
         </div>
         <div class="row d-flex g-2">
            <!-- data-bs-toggle="modal" data-bs-target="#fullScreenModal" -->
            <form class="col-12" action="<?= base_url('home') ?>" method="GET" data-bs-toggle="modal" data-bs-target="#fullScreenModal">
               <div class="mb-1">
                  <div class="input-icon">
                     <input autocomplete="off" type="text" id="cari" name="cari" class="form-control form-control-rounded" placeholder="Cari…" style="height: 48px;border: 1px solid #E8EFF3;padding: 10px 20px;font-size: 16px;font-weight: 500;color: var(--dark);transition: all 0.3s ease-in-out;background: #fff;border-radius: 5px !important" />
                     <span class="input-icon-addon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                           <path d="M20.5605 18.4395L16.7528 14.6318C17.5395 13.446 18 12.0262 18 10.5C18 6.3645 14.6355 3 10.5 3C6.3645 3 3 6.3645 3 10.5C3 14.6355 6.3645 18 10.5 18C12.0262 18 13.446 17.5395 14.6318 16.7528L18.4395 20.5605C19.0245 21.1462 19.9755 21.1462 20.5605 20.5605C21.1462 19.9748 21.1462 19.0252 20.5605 18.4395ZM5.25 10.5C5.25 7.605 7.605 5.25 10.5 5.25C13.395 5.25 15.75 7.605 15.75 10.5C15.75 13.395 13.395 15.75 10.5 15.75C7.605 15.75 5.25 13.395 5.25 10.5Z" fill="#B9B9B9"></path>
                        </svg>
                     </span>
                  </div>
               </div>
            </form>
         </div>

      </div>
   </div>
</section>

<style>
.custom-carousel {
   border-radius: 15px;
   overflow: hidden;
}
</style>

<section class="mt-3 mb-1">
   <div class="container">
      <div id="carouselExampleIndicators" class="carousel slide custom-carousel" data-bs-ride="true">
         <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
         </div>
         <div class="carousel-inner">
            <div class="carousel-item active" style="height:200px">
               <img src="https://cdn.rri.co.id/berita/55/1674526233-Ilustrasi-e-Commerce-2-by-Vibiz.jpg" class="gambar d-block w-100" alt="..." style="height:200px">
            </div>
            <div class="carousel-item" style="height:200px">
               <img src="https://idcloudhost.com/wp-content/uploads/2020/02/ecoomerce.jpg" class="gambar d-block w-100" alt="..." style="height:200px">
            </div>
            <div class="carousel-item" style="height:200px">
               <img src="https://hosteko.com/htk-blog/wp-content/uploads/2021/10/Pengertian-Jenis-Manfaat-dan-Contoh-ECommerce.png" class="gambar d-block w-100" alt="..." style="height:200px">
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
      <div class="swiper-container1">
         <div class="swiper-wrapper">
            <?php foreach ($kategori as $key => $kt) : ?>
               <a href="<?= base_url('home/kategori/' . $kt['id_kategori_brg']) ?>" class="swiper-slide categore-box style-1" style="text-decoration: none;outline: none;color: #42A7E5;-webkit-transition: all 0.5s;-ms-transition: all 0.5s;transition: all 0.5s;">
                  <div class="icon-bx">
                     <?php
                     $gambar = $kt['icon_kategori'] == "" ? "<img style='width: auto;border-radius: 3px;height: 35px;' src='" . base_url('public/template/upload/kategori/default.png') . "'>" : "<img style='width: auto;border-radius: 3px;height: 35px;' src='" . base_url('public/template/upload/kategori/' . $kt['icon_kategori']) . "'>";
                     echo $gambar;
                     ?>
                  </div>
                  <span class="title"><?= $kt['nama_kategori_brg'] ?></span>
               </a>
            <?php endforeach ?>
            <a href="#myModal" data-bs-toggle="modal" class="swiper-slide categore-box style-1" style="text-decoration: none;outline: none;color: #42A7E5;-webkit-transition: all 0.5s;-ms-transition: all 0.5s;transition: all 0.5s;">
               <div class="icon-bx">
                  <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);margin-top:10px">
                     <path d="M4 6h2v2H4zm0 5h2v2H4zm0 5h2v2H4zm16-8V6H8.023v2H18.8zM8 11h12v2H8zm0 5h12v2H8z"></path>
                  </svg>
               </div>
               <span class="title">Lihat Semua</span>
            </a>
         </div>
         <div class="swiper-pagination"></div>
      </div>
   </div>
</section>

<section class="mt-4 mb-3">
   <div class="container">
      <span class="dblock fw-bold fsize-p-2 mar-bottom--x-half">Lagi Promo Nih!!</span>
      <div class="" style="display: flex;align-items: center;margin-bottom:10px;justify-content: space-between;">
         <h3 class="title">Daftar Barang Promo</h3>
         <a href="<?= base_url('promo') ?>" class="fsize-m-2">Lihat Semua</a>
      </div>

      <div class="swiper-container">
         <div class="swiper-wrapper">
            <?php foreach ($barang as $key => $brg) : ?>
               <a href="<?= base_url('home/barang/' . $brg['id_brg']) ?>" class="swiper-slide">
                  <div class="recomended-list" style="margin-right: 20px;">
                     <div class="image-box">
                        <?php
                        $gambar = $brg['gambar_barang'] == "https://dodolan.jogjakota.go.id/assets/media/default/default-product.png" ? "<img style='\border-radius: 3px;' src='" . $brg['gambar_barang'] . "'>" : "<img style='\border-radius: 3px;' src='" . base_url('public/template/upload/barang/' . $brg['gambar_barang']) . "'>";
                        ?>
                        <div style="background-color: white !important;">
                           <?= $gambar ?>
                        </div>
                        <div class="form-check bookmark">
                           <input class="form-check-input" type="checkbox" id="flexCheckDefault1">
                           <label class="form-check-label add_keranjang" for="flexCheckDefault1" data-idproduk="<?= $brg['id_brg'] ?>">
                              <i class="fa fa-shopping-cart fw-bold text-primary"></i>
                           </label>
                        </div>
                     </div>
                     <div class="text-content">
                        <h3 class="title"><?= $brg['nama_barang'] ?></h3>
                        <del class="text-yellow">Rp. <?= number_format($brg['harga_jual_barang']) ?></del>
                        <div class="d-flex justify-content-between align-items-center m-t10">
                           <div class="d-flex justify-content-between align-items-center">
                              <span id="persen" class="badge ml-2 bg-danger text-white"><?= number_format((($brg['harga_jual_barang'] - $brg['harga_promo']) / ($brg['harga_jual_barang']) * 100), 2) ?>%</span>
                           </div>
                           <div>
                              <h4 class="mb-0 ms-2 text-white fw-bold">Rp. <?= number_format($brg['harga_promo']) ?></h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
            <?php endforeach ?>
         </div>
         <div class="swiper-pagination"></div>
      </div>
   </div>
</section>

<section class="mt-4 mb-3">
   <div class="container">
      <div class="d-flex mb-2">
         <h3 class="title">Trending this week 🔥</h3>
      </div>
      <div class="row my-2">
         <?php foreach ($barang as $key => $brg) : ?>
            <div class="col-12 mb-2">
               <div class="horizontal-product-box">
                  <a href="<?= base_url('home/barang/' . $brg['id_brg']) ?>" class="horizontal-product-img">
                     <?php
                     $gambar = $brg['gambar_barang'] == "https://dodolan.jogjakota.go.id/assets/media/default/default-product.png" ? "<img style='\border-radius: 3px;' src='" . $brg['gambar_barang'] . "'>" : "<img style='\border-radius: 3px;' src='" . base_url('public/template/upload/barang/' . $brg['gambar_barang']) . "'>";
                     ?>
                     <?= $gambar ?>
                  </a>
                  <div class="horizontal-product-details">
                     <div class="d-flex align-items-center justify-content-between">
                        <h4 class="fw-bold text-primary" style="font-size: 14px;margin-bottom: 0;"><?= $brg['nama_barang'] ?></h4>
                        <div class="rating d-flex align-items-center">
                           <img src="https://themes.pixelstrap.com/fuzzy/assets/images/svg/Star.svg" alt="star">

                           <h6 style="font-size: 16px;line-height: 1.2;margin-bottom: 0;" class="theme-color fw-normal">&nbsp;&nbsp;5.0</h6>
                        </div>
                     </div>
                     <?php
                     $query = $this->db->query("SELECT COUNT(*) as jumlah_jual FROM tb_pesanan_detail WHERE id_brg = ?", $brg['id_brg']);
                     $result = $query->row();
                     $jumlah_jual = $result->jumlah_jual;
                     ?>
                     <h5 class="fw-light text-primary" style="font-size: 13px;margin-bottom: 0;"><?= $brg['nama_kategori_brg'] ?> (<?= number_format($jumlah_jual) . " Terjual" ?>) | (<?= number_format($brg['stock_brg']) . " Stok Tersedia" ?>)</h5>

                     <div class="d-flex align-items-center justify-content-between mt-1">
                        <div class="d-flex align-items-center gap-2">
                           <h3 style="font-size: 15px;font-weight: 400;margin-bottom: 0;" class="fw-semibold">Rp. <?= number_format($brg['harga_jual_barang']) ?></h3>
                        </div>
                        <a href="javascript::void" class="cart-bag add_keranjang" data-idproduk="<?= $brg['id_brg'] ?>">
                           <i class="fa fa-shopping-cart fw-bold text-primary"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         <?php endforeach ?>
      </div>
      <a href="#" style="display: block;width: 100%;" class="btn btn-outline-primary btn-rounded btn-block">Lihat Semua</a>
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
            <a style="margin-top:-10px" href="<?= base_url('home/saran') ?>" class="btn btn-success"><i class='bx bxs-paper-plane'></i> Kritik Saran</a>
         </div>
      </div>
   </div>
</section>

<section class="mt-1 mb-4">
   <div class="container">
      <span class="mb-2 fs-3 fw-bold">5 Kritik Saran User JMART Terakhir</span>

      <div class="load-data overflow-auto">
         <?php foreach ($krisan as $key => $value) : ?>
            <div class="card mt-2 p-2">
               <div class="row">
                  <div class="col-1 text-center">
                     <?= $key + 1 ?>.
                  </div>
                  <div class="col-2">
                     <img src="<?= base_url('public/template/upload/user/default.jpg') ?>" class="avatar avatar--small mar-right--x-2 shadow">
                  </div>
                  <?php
                  $date = new DateTime($value['created_at']);

                  $dateString = $date->format('d/m/Y H:i:s');

                  // Mengonversi string menjadi objek DateTime dengan format yang sesuai
                  $date = DateTime::createFromFormat('d/m/Y H:i:s', $dateString);

                  // Memeriksa apakah objek DateTime berhasil dibuat
                  if ($date === false) {
                     echo "Format tanggal tidak valid.";
                  } else {
                     $now = new DateTime();
                     // Menghitung selisih waktu antara tanggal yang diberikan dan waktu saat ini
                     $interval = $now->diff($date);

                     // Mendapatkan informasi tentang selisih waktu dalam format yang diinginkan
                     $daysAgo = $interval->d;
                     $hoursAgo = $interval->h;
                     $minutesAgo = $interval->i;
                     $secondsAgo = $interval->s;

                     // Membuat teks yang sesuai dengan selisih waktu
                     $result = "";
                     if ($daysAgo > 0) {
                        $result .= $daysAgo . " hari, ";
                     }
                     if ($hoursAgo > 0) {
                        $result .= $hoursAgo . " jam, ";
                     }
                     if ($minutesAgo > 0) {
                        $result .= $minutesAgo . " menit, ";
                     }
                     $result .= $secondsAgo . " detik yang lalu";
                  }
                  ?>
                  <div class="col-9">
                     <div class="" style="flex:1">
                        <span class="fsize-p-2 text-primary fw-bold mar-bottom col-xs-12"><?= $value['nama_member'] ?></span>
                        <p class="fsize-m-4 text-secondary fw-bold mar-bottom col-xs-12"><?= $result ?> </p>
                        <span class="dblock fsize-m-2"><?= $value['kritik_saran'] ?></span>
                     </div>
                  </div>
               </div>
            </div>
         <?php endforeach ?>
      </div>
   </div>
</section>

<div class="modal fade" id="fullScreenModal" tabindex="-1" aria-labelledby="fullScreenModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="fullScreenModalLabel">Pencarian Barang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="<?= base_url('home') ?>" method="GET">
               <div class="input-group mb-3">
                  <input name="cari" id="search" placeholder="Cari Barang" type="text" class="form-control form-control-lg" autocomplete="off">
                  <button type="submit" class="input-group-text btn-success"><i class="bi bi-search me-2"></i> Search</button>
               </div>
            </form>
            <div class="list-group list-group-flush">
               <div id="search-results"></div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Data Kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
         </div>
         <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
            <div class="row">
               <div class="list-group">
                  <?php foreach ($kategori1 as $key => $kt) : ?>
                     <?php
                     $gambar = $kt['icon_kategori'] == "" ? "<img style='width: auto;border-radius: 3px;height: 45px;' src='" . base_url('public/template/upload/kategori/default.png') . "'>" : "<img style='width: auto;border-radius: 3px;height: 45px;' src='" . base_url('public/template/upload/kategori/' . $kt['icon_kategori']) . "'>";
                     ?>
                     <a href="<?= base_url('home/kategori/' . $kt['id_kategori_brg']) ?>" class="list-group-item list-group-item-action mb-3" style="padding: 0.25rem 1.25rem !important;font-weight:bold;color: #4f658b;" aria-current="true">
                        <?= $gambar ?> <?= $kt['nama_kategori_brg'] ?>
                     </a>
                  <?php endforeach ?>
               </div>
            </div>
         </div>
         <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup Modal</button>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <br><br><br><br>
</div>

<?php $this->load->view('layouts/user/menu'); ?>
<?php $this->load->view('layouts/user/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src=" https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   var swiper = new Swiper('.swiper-container', {
      slidesPerView: 2, // Jumlah slide yang akan ditampilkan
      spaceBetween: 1, // Jarak antara slide
   });

   var swiper = new Swiper('.swiper-container1', {
      slidesPerView: 3, // Jumlah slide yang akan ditampilkan
      spaceBetween: 3, // Jarak antara slide
   });

   document.addEventListener('DOMContentLoaded', function() {
      var myCarousel = new bootstrap.Carousel(document.getElementById('carouselExampleIndicators'), {
         interval: 1000 // Interval dalam milidetik (5000 ms = 5 detik)
      });
   });

   $('.add_keranjang').click(function() {
      // Mengambil data yang perlu ditambahkan ke database
      var idProduk = $(this).data('idproduk');
      var data = {
         idProduk
      };

		// ajax untuk menghitung total data di keranjang
		function showAlert(title, text, icon, buttonClass) {
			Swal.fire({
				title,
				text,
				icon, // Ganti 'type' dengan 'icon'
				customClass: {
					confirmButton: buttonClass
				},
				buttonsStyling: false
			});
		}

		$.ajax({
			url: '<?= base_url('keranjang/add_keranjang') ?>',
			type: 'POST',
			data: data,
			dataType: 'json',
			beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

			success: function(response) {
				if (response.success) {
					showAlert('Success!', response.msg, 'success', 'btn btn-success');

					// Hitung ulang jumlah keranjang
					$.ajax({
						url: '<?= base_url('keranjang/count_keranjang') ?>',
						type: 'GET',
						dataType: 'json',
						success: function(countResponse) {
							if (countResponse.success) {
								$('.count-keranjang').text(countResponse.count);
							}
						}
					});
				} else {
					showAlert('Error!', response.msg, 'error', 'btn btn-danger');
				}
			},
			error: function(xhr) {
				alert(xhr.responseText);
			}
		});
   });
</script>

<script>
   $(document).ready(function() {
      $('#fullScreenModal').on('shown.bs.modal', function() {
         $('#search').focus();
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
                  var base_url = "<?= base_url(); ?>";

                  $.each(data, function(index, item) {
                     if (index < 10) { // Hanya tampilkan 4 item pertama
                        var resultHTML = '<a href="' + base_url + '/home?cari=' + item.nama_barang +
                           '" class="list-group-item list-group-item-action" aria-current="true">';
                        resultHTML += item.nama_barang; // Replace with the appropriate title or text
                        resultHTML += '</a>';

                        // Tambahkan hasil pencarian ke dalam div dengan id "search-results"
                        $('#search-results').append(resultHTML);
                     }
                  });

                  // Tampilkan hasil pencarian
                  $('#search-results').show();
               }
            });
         },
         minLength: 0 // Jumlah karakter minimum sebelum permintaan pencarian dikirim
      });
   });
</script>

</body>

</html>
