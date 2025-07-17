<?php $this->load->view('layouts/admin/head') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.css">
<style>
   .dropdown-item:hover,
   .dropdown-item:focus {
      color: inherit;
      text-decoration: none;
      background-color: rgba(98, 105, 118, 0.04);
   }

   .blue {
      color: #428bca !important;
   }

   .small-box {
      border: 1px solid rgb(218, 225, 228);
      margin-bottom: 10px;
   }

   .small-box:hover {
      border: 1px solid rgb(65, 160, 217);
   }

   .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
   }

   .padding1010 {
      padding: 10px !important;
   }

   .w-50px {
      width: 70px !important;
   }

   #jenisOrder {
      width: 100%;
   }
</style>
<?php $this->load->view('layouts/admin/header') ?>
<!-- Page header -->
<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <div class="page-pretitle">
               Overview
            </div>
            <h2 class="page-title">
               Dashboard
            </h2>
         </div>
      </div>
   </div>
</div>
<!-- Page body -->
<div class="page-body">
   <div class="container-xl">
      <div class="row mb-3 g-2 align-items-center">
         <div class="col-12">
            <div class="card card-md">
               <div class="card-body">
                  <p class="display-6 mb-2">
                     Selamat Datang!
                  </p>
                  <p class="text-muted mb-0">
                     Admin Operator, Anda masuk aplikasi sebagai akun petugas admin
                  </p>
               </div>
            </div>
         </div>
      </div>
      <div class="row mb-3 row-deck row-cards">
         <div class="col-12 col-lg-3">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-center">
                     <div class="subheader">Total Transaksi</div>
                     <div class="ms-auto lh-1">
                        <span class="text-green d-inline-flex align-items-center lh-1">
                           7% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M3 17l6 -6l4 4l8 -8"></path>
                              <path d="M14 7l7 0l0 7"></path>
                           </svg>
                        </span>
                     </div>
                  </div>
                  <div class="h1 mb-3"><?= $total_transaksi ?></div>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-3">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-center">
                     <div class="subheader">Total Penjualan</div>
                     <div class="ms-auto lh-1">
                        <span class="text-green d-inline-flex align-items-center lh-1">
                           7% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M3 17l6 -6l4 4l8 -8"></path>
                              <path d="M14 7l7 0l0 7"></path>
                           </svg>
                        </span>
                     </div>
                  </div>
                  <div class="h1 mb-3">Rp. <?= $ttl_harga == NULL ? 0 : $ttl_harga ?></div>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-3">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-center">
                     <div class="subheader">Penjualan Kemarin</div>
                     <div class="ms-auto lh-1">
                        <span class="text-green d-inline-flex align-items-center lh-1">
                           7% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M3 17l6 -6l4 4l8 -8"></path>
                              <path d="M14 7l7 0l0 7"></path>
                           </svg>
                        </span>
                     </div>
                  </div>
                  <div class="h1 mb-3">Rp. <?= $total_harga_kemarin == NULL ? 0 : $total_harga_kemarin ?></div>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-3">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-center">
                     <div class="subheader">Total Products</div>
                  </div>
                  <div class="h1 mb-3"><?= $total_barang ?></div>
               </div>
            </div>
         </div>
      </div>
      <div class="row row-deck row-cards mb-3">
         <div class="col-12">
            <div class="row row-cards">
               <div class="d-flex col-sm-12 col-md-3">
                  <div class="card bg-orange" style="min-height: 260px">
                     <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-orange">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tags" width="40" height="40" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M7.859 6h-2.834a2.025 2.025 0 0 0 -2.025 2.025v2.834c0 .537 .213 1.052 .593 1.432l6.116 6.116a2.025 2.025 0 0 0 2.864 0l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-6.117 -6.116a2.025 2.025 0 0 0 -1.431 -.593z"></path>
                              <path d="M17.573 18.407l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-7.117 -7.116"></path>
                              <path d="M6 9h-.01"></path>
                           </svg>
                        </div>
                     </div>
                     <div class="card-body">
                        <h3 class="card-title text-white">
                           Transaksi
                        </h3>
                        <div class="list-group list-group-flush">
                           <div class="list-group-item px-0 text-white">
                              <div class="d-flex">
                                 <div class="flex-fill">
                                    <strong>Periode Bulan Lalu</strong>
                                    <br>
                                    <small>
                                       (<?= $monthLalu ?>)
                                    </small>
                                 </div>
                                 <div class="flex-fill text-end strong">
                                    <?= $penjualan->total_bulan_lalu ?>
                                 </div>
                              </div>
                           </div>
                           <div class="list-group-item px-0 text-white">
                              <div class="d-flex">
                                 <div class="flex-fill">
                                    <strong>Periode Bulan Ini</strong>
                                    <br>
                                    <small>
                                       (<?= $monthSekarang ?>)
                                    </small>
                                 </div>
                                 <div class="flex-fill text-end strong">
                                    <?= $penjualan->total_bulan_ini ?>
                                 </div>
                              </div>
                           </div>
                           <div class="list-group-item px-0 text-white">
                              <div class="d-flex">
                                 <div class="flex-fill strong">
                                    Total Keseluruhan
                                 </div>
                                 <div class="flex-fill text-end strong">
                                    <?= $penjualan->total_semua ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="d-flex col-sm-12 col-md-3">
                  <div class="card bg-azure" style="min-height: 260px">
                     <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-azure">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins" width="40" height="40" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z"></path>
                              <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4"></path>
                              <path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z"></path>
                              <path d="M3 6v10c0 .888 .772 1.45 2 2"></path>
                              <path d="M3 11c0 .888 .772 1.45 2 2"></path>
                           </svg>
                        </div>
                     </div>
                     <div class="card-body">
                        <h3 class="card-title text-white">
                           Penjualan
                        </h3>
                        <div class="list-group list-group-flush">
                           <div class="list-group-item px-0 text-white">
                              <div class="d-flex">
                                 <div class="flex-fill">
                                    <strong>Total Bulan Lalu</strong>
                                    <br>
                                    <small>
                                       (<?= $monthLalu ?>)
                                    </small>
                                 </div>
                                 <div class="flex-fill text-end strong">
                                    Rp. <?= number_format($rp->total_bulan_lalu) ?>
                                 </div>
                              </div>
                           </div>
                           <div class="list-group-item px-0 text-white">
                              <div class="d-flex">
                                 <div class="flex-fill">
                                    <strong>Total Bulan Ini</strong>
                                    <br>
                                    <small>
                                       (<?= $monthSekarang ?>)
                                    </small>
                                 </div>
                                 <div class="flex-fill text-end strong">
                                    Rp. <?= number_format($rp->total_bulan_ini) ?>
                                 </div>
                              </div>
                           </div>
                           <div class="list-group-item px-0 text-white">
                              <div class="d-flex">
                                 <div class="flex-fill strong">
                                    Total Saat Ini
                                 </div>
                                 <div class="flex-fill text-end strong">
                                    Rp. <?= number_format($rp->total_semua) ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="d-flex col-sm-12 col-md-3">
                  <div class="card bg-lime" style="min-height: 260px">
                     <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-lime">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2"></path>
                              <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5"></path>
                           </svg>
                        </div>
                     </div>
                     <div class="card-body">
                        <h3 class="card-title text-white">
                           Penjualan Lunas
                        </h3>
                        <div class="list-group list-group-flush">
                           <div class="list-group-item px-0 text-white">
                              <div class="d-flex">
                                 <div class="flex-fill">
                                    <strong>Periode Bulan Lalu</strong>
                                    <br>
                                    <small>
                                       (<?= $monthLalu ?>)
                                    </small>
                                 </div>
                                 <div class="flex-fill text-end strong">
                                    Rp. <?= number_format($rp_lunas->total_bulan_lalu) ?>
                                 </div>
                              </div>
                           </div>
                           <div class="list-group-item px-0 text-white">
                              <div class="d-flex">
                                 <div class="flex-fill">
                                    <strong>Periode Bulan Ini</strong>
                                    <br>
                                    <small>
                                       (<?= $monthSekarang ?>)
                                    </small>
                                 </div>
                                 <div class="flex-fill text-end strong">
                                    Rp. <?= number_format($rp_lunas->total_bulan_ini) ?>
                                 </div>
                              </div>
                           </div>
                           <div class="list-group-item px-0 text-white">
                              <div class="d-flex">
                                 <div class="flex-fill strong">
                                    Total Keseluruhan
                                 </div>
                                 <div class="flex-fill text-end strong">
                                    Rp. <?= number_format($rp_lunas->total_semua) ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="d-flex col-sm-12 col-md-3">
                  <div class="card bg-danger" style="min-height: 260px">
                     <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-blue">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-dollar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                              <path d="M12 3v3m0 12v3"></path>
                           </svg>
                        </div>
                     </div>
                     <div class="card-body">
                        <h3 class="card-title text-white">
                           Autodebit
                        </h3>
                        <div class="list-group list-group-flush">
                           <div class="list-group-item px-0 text-white">
                              <div class="d-flex">
                                 <div class="flex-fill">
                                    <strong>Total Bulan Lalu</strong>
                                    <br>
                                    <small>
                                       (<?= $monthLalu ?>)
                                    </small>
                                 </div>
                                 <div class="flex-fill text-end strong">
                                    Rp. <?= number_format($autodebit->total_bulan_lalu) ?>
                                 </div>
                              </div>
                           </div>
                           <div class="list-group-item px-0 text-white">
                              <div class="d-flex">
                                 <div class="flex-fill">
                                    <strong>Total Bulan Ini</strong>
                                    <br>
                                    <small>
                                       (<?= $monthSekarang ?>)
                                    </small>
                                 </div>
                                 <div class="flex-fill text-end strong">
                                    Rp. <?= number_format($autodebit->total_bulan_ini) ?>
                                 </div>
                              </div>
                           </div>
                           <div class="list-group-item px-0 text-white">
                              <div class="d-flex">
                                 <div class="flex-fill strong">
                                    Total Keseluruhan
                                 </div>
                                 <div class="flex-fill text-end strong">
                                    Rp. <?= number_format($autodebit->total_semua) ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="page-header d-print-none" style="margin:0.1rem 0 0 !important">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <div class="page-pretitle">
               Overview
            </div>
            <h2 class="page-title">
               Penjualan Bulan Ini
            </h2>
         </div>
      </div>
   </div>
</div>

<div class="page-body">
   <div class="container-xl">
      <div class="row mt-1 mb-4">
         <div class="col-12 col-lg-12 d-flex">
            <div class="card w-100 mb-2">
               <div class="card-body">
                  <h3 class="card-title">
                     Grafik Jumlah Pembayaran
                     <span style="float: right;">Bulan Ini</span>
                  </h3>
                  <div class="row">
                     <div class="col">
                        <div id="chart-transaksi"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row mt-1 mb-4">
         <div class="col-12 col-lg-6 d-flex">
            <div class="card w-100 mb-2">
               <div class="card-body w-100 mb-2">
                  <div class="card-title">
                     Penjualan Berdasarkan Kategori
                  </div>
                  <div id="category-chart" class="chart-lg"></div>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-6 d-flex">
            <div class="card w-100 mb-2">
               <div class="card-body w-100 mb-2">
                  <div class="card-title">
                     Penjualan Berdasarkan Kasir
                  </div>
                  <div id="chartKasir" class="chart-lg"></div>
               </div>
            </div>
         </div>
      </div>
      <div class="row mt-1 mb-4">
         <div class="col-12 col-lg-6 d-flex">
            <div class="card w-100 mb-2">
               <div class="card-body">
                  <div class="card-title">
                     Product Paling Laris
                  </div>
                  <div class="table-responsive">
                     <!--begin::Table-->
                     <table class="table table-striped align-middle">
                        <!--begin::Table head-->
                        <thead>
                           <tr class="fs-7 fw-bold text-gray-500">
                              <th class="ps-0 w-50px">ITEM</th>
                              <th class="min-w-125px"></th>
                              <th>Permintaan</th>
                              <th class="text-end min-w-100px">Terjual</th>
                           </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                           <?php if (!empty($produk_terlaris)) : ?>
                              <?php foreach ($produk_terlaris as $key => $value) : ?>
                                 <tr>
                                    <td>
                                       <img src="<?= base_url('public/template/upload/barang/' . $value['gambar_barang']) ?>" class="w-50px ms-n1" alt="">
                                    </td>
                                    <td class="ps-0">
                                       <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-5 text-start pe-0"><?= $value['nama_barang'] ?></a>
                                       <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Barcode: <?= $value['barcode'] ?></span>
                                    </td>
                                    <td>
                                       <span class="text-gray-800 fw-bold d-block fs-5 ps-0 text-center">x<?= $value['jumlah_penjualan'] ?></span>
                                    </td>
                                    <td>
                                       <span class="text-gray-800 fw-bold d-block fs-5 ps-0 text-center">x<?= $value['total_terjual'] ?> | (<?= number_format($value['stock_brg']) . " Stok Tersedia" ?>)</span>
                                    </td>
                                 </tr>
                              <?php endforeach; ?>
                           <?php else : ?>
                              <!-- Tampilkan pesan jika tidak ada data -->
                              <tr>
                                 <td colspan="4" class="text-center">
                                    <span class="text-gray-500 fw-semibold fs-6">Tidak ada data produk terlaris.</span>
                                 </td>
                              </tr>
                           <?php endif; ?>
                        </tbody>
                        <!--end::Table body-->
                     </table>
                     <!--end::Table-->
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-6 d-flex">
            <div class="card w-100 mb-2">
               <div class="card-body">
                  <div class="card-title">
                     Product Paling Laris (Bulan Ini)
                  </div>
                  <div class="table-responsive">
                     <!--begin::Table-->
                     <table class="table table-striped align-middle">
                        <!--begin::Table head-->
                        <thead>
                           <tr class="fs-7 fw-bold text-gray-500">
                              <th class="ps-0 w-50px">ITEM</th>
                              <th class="min-w-125px"></th>
                              <th>Permintaan</th>
                              <th class="text-end min-w-100px">Terjual</th>
                           </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                           <?php if (!empty($produk_terlaris_b)) : ?>
                              <?php foreach ($produk_terlaris_b as $key => $value) : ?>
                                 <tr>
                                    <td>
                                       <img src="<?= base_url('public/template/upload/barang/' . $value['gambar_barang']) ?>" class="w-50px ms-n1" alt="">
                                    </td>
                                    <td class="ps-0">
                                       <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-5 text-start pe-0"><?= $value['nama_barang'] ?></a>
                                       <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Barcode: <?= $value['barcode'] ?></span>
                                    </td>
                                    <td>
                                       <span class="text-gray-800 fw-bold d-block fs-5 ps-0 text-center">x<?= $value['jumlah_penjualan'] ?></span>
                                    </td>
                                    <td>
                                       <span class="text-gray-800 fw-bold d-block fs-5 ps-0 text-center">x<?= $value['total_terjual'] ?> | (<?= number_format($value['stock_brg']) . " Stok Tersedia" ?>)</span>
                                    </td>
                                 </tr>
                              <?php endforeach; ?>
                           <?php else : ?>
                              <!-- Tampilkan pesan jika tidak ada data -->
                              <tr>
                                 <td colspan="4" class="text-center">
                                    <span class="text-gray-500 fw-semibold fs-6">Tidak ada data produk terlaris.</span>
                                 </td>
                              </tr>
                           <?php endif; ?>
                        </tbody>
                        <!--end::Table body-->
                     </table>
                     <!--end::Table-->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row mt-1 mb-4">
         <div class="col-12 col-lg-6 d-flex">
            <div class="card w-100 mb-2">
               <div class="card-body">
                  <div class="card-title">
                     Jenis Pesanan
                  </div>
                  <div id="jenisOrder"></div>
               </div>
            </div>
         </div>

         <div class="col-12 col-lg-6 d-flex">
            <div class="card w-100 mb-2">
               <div class="card-body">
                  <div class="card-title">
                     Status Pesanan
                  </div>
                  <div id="statusPesananChart"></div>
               </div>
            </div>
         </div>
      </div>
      <div class="row mt-1 mb-4">
         <div class="col-12 col-lg-6 d-flex">
            <div class="card w-100 mb-2">
               <div class="card-body">
                  <div class="card-title">
                     Metode Bayar
                  </div>
                  <div id="metodeChart"></div>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-6 d-flex">
            <div class="card w-100 mb-2">
               <div class="card-body">
                  <div class="card-title">
                     Status Pembayaran
                  </div>
                  <div id="statusBayarChart"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- 
      <div class="row mt-1 mb-4">
         <div class="col-12 col-lg-4 d-flex">
            <div class="card w-100 mb-2">
               <div class="card-header">
                  <div class="card-title">
                     Aktivitas Login Terbaru
                  </div>
               </div>
               <div class="card-body card-body-scrollable card-body-scrollable-shadow" style="height: 25rem">
                  <div class="divide-y">
                     <div>
                        <div class="row">
                           <div class="col-auto">
                              <span class="avatar">A</span>
                           </div>
                           <div class="col">
                              <div class="text-muted">
                                 <strong>Admin Operator</strong> Berhasil masuk ke aplikasi sebagai petugas
                              </div>
                              <div class="text-muted">
                                 <small><i class="fa fa-clock me-1"></i>
                                    23/12/2023 16:45</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="row">
                           <div class="col-auto">
                              <span class="avatar">P</span>
                           </div>
                           <div class="col">
                              <div class="text-muted">
                                 <strong>Puti Wani Aryani</strong> Berhasil masuk ke aplikasi sebagai siswa
                              </div>
                              <div class="text-muted">
                                 <small><i class="fa fa-clock me-1"></i>
                                    23/12/2023 16:01</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="row">
                           <div class="col-auto">
                              <span class="avatar">S</span>
                           </div>
                           <div class="col">
                              <div class="text-muted">
                                 <strong>Septiana Nugraha</strong> Berhasil masuk ke aplikasi sebagai petugas
                              </div>
                              <div class="text-muted">
                                 <small><i class="fa fa-clock me-1"></i>
                                    23/12/2023 12:34</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="row">
                           <div class="col-auto">
                              <span class="avatar">A</span>
                           </div>
                           <div class="col">
                              <div class="text-muted">
                                 <strong>Admin Operator</strong> Berhasil masuk ke aplikasi sebagai petugas
                              </div>
                              <div class="text-muted">
                                 <small><i class="fa fa-clock me-1"></i>
                                    23/12/2023 11:26</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="row">
                           <div class="col-auto">
                              <span class="avatar">A</span>
                           </div>
                           <div class="col">
                              <div class="text-muted">
                                 <strong>Admin Operator</strong> Berhasil masuk ke aplikasi sebagai petugas
                              </div>
                              <div class="text-muted">
                                 <small><i class="fa fa-clock me-1"></i>
                                    23/12/2023 09:28</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="row">
                           <div class="col-auto">
                              <span class="avatar">A</span>
                           </div>
                           <div class="col">
                              <div class="text-muted">
                                 <strong>Admin Operator</strong> Berhasil masuk ke aplikasi sebagai petugas
                              </div>
                              <div class="text-muted">
                                 <small><i class="fa fa-clock me-1"></i>
                                    23/12/2023 09:19</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="row">
                           <div class="col-auto">
                              <span class="avatar">S</span>
                           </div>
                           <div class="col">
                              <div class="text-muted">
                                 <strong>Septiana Nugraha</strong> Berhasil masuk ke aplikasi sebagai petugas
                              </div>
                              <div class="text-muted">
                                 <small><i class="fa fa-clock me-1"></i>
                                    23/12/2023 08:06</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="row">
                           <div class="col-auto">
                              <span class="avatar">A</span>
                           </div>
                           <div class="col">
                              <div class="text-muted">
                                 <strong>Admin Operator</strong> Berhasil masuk ke aplikasi sebagai petugas
                              </div>
                              <div class="text-muted">
                                 <small><i class="fa fa-clock me-1"></i>
                                    22/12/2023 18:56</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="row">
                           <div class="col-auto">
                              <span class="avatar">A</span>
                           </div>
                           <div class="col">
                              <div class="text-muted">
                                 <strong>Admin Operator</strong> Berhasil masuk ke aplikasi sebagai petugas
                              </div>
                              <div class="text-muted">
                                 <small><i class="fa fa-clock me-1"></i>
                                    22/12/2023 15:10</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="row">
                           <div class="col-auto">
                              <span class="avatar">S</span>
                           </div>
                           <div class="col">
                              <div class="text-muted">
                                 <strong>Septiana Nugraha</strong> Berhasil masuk ke aplikasi sebagai petugas
                              </div>
                              <div class="text-muted">
                                 <small><i class="fa fa-clock me-1"></i>
                                    22/12/2023 13:38</small>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-8 d-flex">
            <div class="card w-100 mb-2">
               <div class="card-body">
                  <h3 class="card-title">
                     Grafik Aktivitas Sistem
                     <span style="float: right;">Tahun Ini</span>
                  </h3>
                  <div class="row">
                     <div class="col">
                        <div id="chart-completion-tasks-4"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
       -->
   </div>
</div>
<?php $this->load->view('layouts/admin/footer') ?>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.js"></script>


<!-- CHART TRANSAKSI (1)  -->
<script>
   let chartLabel;

   if (typeof window.orientation !== 'undefined') {
      chartLabel = false;
   } else {
      chartLabel = true;
   }

   const revenueChart = {
      label: <?php echo json_encode($dates); ?>,
      data: {
         count: <?php echo json_encode($orderCounts); ?>,
         amount: <?php echo json_encode($totalAmounts); ?>,
      }
   };

   document.addEventListener("DOMContentLoaded", function() {
      window.ApexCharts && (new ApexCharts(document.getElementById('chart-transaksi'), {
         chart: {
            type: 'area',
            fontFamily: 'inherit',
            height: 350,
            parentHeightOffset: 0,
            toolbar: {
               show: false
            },
            animations: {
               enabled: false
            },
            stacked: true,
         },
         series: [{
            name: 'Nominal',
            data: revenueChart.data.amount
         }, {
            name: 'Jumlah Transaksi',
            data: revenueChart.data.count
         }],
         labels: revenueChart.label,
         plotOptions: {
            bar: {
               columnWidth: '50%',
            }
         },
         dataLabels: {
            enabled: false
         },
         grid: {
            padding: {
               top: -20,
               right: 0,
               left: -4,
               bottom: -4
            },
            strokeDashArray: 4,
            xaxis: {
               lines: {
                  show: true
               }
            },
         },
         stroke: {
            width: [2, 1],
            dashArray: [1, 1],
            lineCap: 'round',
            curve: 'smooth',
         },
         xaxis: {
            labels: {
               show: chartLabel,
               padding: 0,
            },
            tooltip: {
               enabled: false
            },
            axisBorder: {
               show: false,
            },
         },
         yaxis: {
            labels: {
               padding: 4
            },
         },
         legend: {
            show: false
         },
         colors: ['#01e396', '#17a2b8'],
      })).render();
   });
</script>
<!-- END CHART 1  -->

<!-- CHART KATEGORi (2) -->
<script>
   // @formatter:off
   const ordersData = <?= json_encode($orders_by_category); ?>;

   const chartData = {
      labels: ordersData.map(item => item.nama_kategori_brg),
      data: ordersData.map(item => item.order_count),
   };

   document.addEventListener("DOMContentLoaded", function() {
      // Check if ApexCharts is defined
      if (window.ApexCharts) {
         // Create and render the chart
         const chart = new ApexCharts(document.getElementById('category-chart'), {
            chart: {
               type: "area", // Change to area
               fontFamily: 'inherit',
               height: 240,
               parentHeightOffset: 0,
               toolbar: {
                  show: false,
               },
               animations: {
                  enabled: false
               },
            },
            plotOptions: {
               area: {
                  horizontal: false, // Change to vertical
                  columnWidth: '50%',
               }
            },
            dataLabels: {
               enabled: false,
            },
            fill: {
               opacity: 1,
            },
            labels: chartData.labels,
            series: [{
               name: 'Order Count', // Change to 'Jumlah Pesanan'
               data: chartData.data,
            }],
            tooltip: {
               theme: 'dark'
            },
            grid: {
               padding: {
                  top: -20,
                  right: 0,
                  left: -4,
                  bottom: -4
               },
               strokeDashArray: 4,
            },
            xaxis: {
               labels: {
                  padding: 0,
               },
               tooltip: {
                  enabled: false
               },
               axisBorder: {
                  show: false,
               },
               type: 'category',
            },
            yaxis: {
               labels: {
                  padding: 4
               },
            },
            colors: ['#01e396', '#17a2b8'],
            legend: {
               show: false,
            },
         });
         chart.render();
      } else {
         console.error('ApexCharts library not found.');
      }
   });

   // @formatter:on
</script>
<!-- END CHART 2 -->

<!-- CHART KASIR (3) -->
<script>
   const orderKasir = <?= json_encode($order_by_cashier); ?>;

   const chartData2 = {
      labels: orderKasir.map(item => item.nama_kasir),
      data: orderKasir.map(item => item.total_penjualan),
   };

   document.addEventListener("DOMContentLoaded", function() {
      window.ApexCharts && (new ApexCharts(document.getElementById('chartKasir'), {
         chart: {
            type: "area", // Change to area
            fontFamily: 'inherit',
            height: 240,
            toolbar: {
               show: false,
            },
            animations: {
               enabled: false
            },
         },
         plotOptions: {
            area: {
               horizontal: true, // Change to horizontal
               columnWidth: '50%',
            }
         },
         dataLabels: {
            enabled: false,
         },
         fill: {
            opacity: 1,
         },
         labels: chartData2.labels,
         series: [{
            name: "Order Count", // Change to "Jumlah Pesanan"
            data: chartData2.data
         }],
         tooltip: {
            theme: 'dark'
         },
         grid: {
            padding: {
               top: -20,
               right: 0,
               left: -4,
               bottom: -4
            },
            strokeDashArray: 4,
         },
         xaxis: {
            labels: {
               padding: 0,
               rotate: -45, // Angle labels to -45 degrees
               style: {
                  fontSize: '12px', // Adjust font size if needed
               }
            },
            tooltip: {
               enabled: false
            },
            axisBorder: {
               show: false,
            },
            type: 'category', // Keep it as 'category'
         },
         colors: ['#01e396', '#17a2b8'],
         legend: {
            show: false,
         },
      })).render();
   });
</script>
<!-- END CHART 3 -->

<!-- CHART JENIS ORDER (4) -->
<script>
   document.addEventListener("DOMContentLoaded", function() {
      window.ApexCharts && (new ApexCharts(document.getElementById('jenisOrder'), {
         chart: {
            type: "pie", // Change to pie chart
            fontFamily: 'inherit',
            height: 240,
            width: '100%', // Set width to 100%
            sparkline: {
               enabled: true
            },
            animations: {
               enabled: false
            },
         },
         fill: {
            opacity: 1,
         },
         series: <?= json_encode($jenis_order_chart['series']); ?>,
         labels: <?= json_encode($jenis_order_chart['labels']); ?>,
         tooltip: {
            theme: 'dark'
         },
         grid: {
            strokeDashArray: 4,
         },
         legend: {
            show: true,
            position: 'bottom',
            offsetY: 12,
            markers: {
               width: 10,
               height: 10,
               radius: 100,
            },
            itemMargin: {
               horizontal: 8,
               vertical: 8
            },
         },
         tooltip: {
            fillSeriesColor: false
         },
      })).render();
   });
</script>
<!-- END CHART 4 -->

<!-- CHART STATUS PESANAN (5) -->
<script>
   document.addEventListener("DOMContentLoaded", function() {
      window.ApexCharts && (new ApexCharts(document.getElementById('statusPesananChart'), {
         chart: {
            type: "pie",
            fontFamily: 'inherit',
            height: 240,
            sparkline: {
               enabled: true
            },
            animations: {
               enabled: false
            },
         },
         fill: {
            opacity: 1,
         },
         series: <?= json_encode($status_pesanan_chart['series']); ?>,
         labels: <?= json_encode($status_pesanan_chart['labels']); ?>,
         tooltip: {
            theme: 'dark'
         },
         grid: {
            strokeDashArray: 4,
         },
         // colors: [tabler.getColor("primary"), tabler.getColor("primary", 0.8), tabler.getColor("primary", 0.6), tabler.getColor("gray-300")],
         legend: {
            show: true,
            position: 'bottom',
            offsetY: 12,
            markers: {
               width: 10,
               height: 10,
               radius: 100,
            },
            itemMargin: {
               horizontal: 8,
               vertical: 8
            },
         },
         tooltip: {
            fillSeriesColor: false
         },
      })).render();
   });
</script>
<!-- END CHART 5 -->

<!-- CHART METODE BAYAR (6) -->
<script>
   document.addEventListener("DOMContentLoaded", function() {
      window.ApexCharts && (new ApexCharts(document.getElementById('metodeChart'), {
         chart: {
            type: "pie",
            fontFamily: 'inherit',
            height: 240,
            sparkline: {
               enabled: true
            },
            animations: {
               enabled: false
            },
         },
         fill: {
            opacity: 1,
         },
         series: <?= json_encode($metode_bayar_chart['series']); ?>,
         labels: <?= json_encode($metode_bayar_chart['labels']); ?>,
         tooltip: {
            theme: 'dark'
         },
         grid: {
            strokeDashArray: 4,
         },
         // colors: [tabler.getColor("primary"), tabler.getColor("primary", 0.8), tabler.getColor("primary", 0.6), tabler.getColor("gray-300")],
         legend: {
            show: true,
            position: 'bottom',
            offsetY: 12,
            markers: {
               width: 10,
               height: 10,
               radius: 100,
            },
            itemMargin: {
               horizontal: 8,
               vertical: 8
            },
         },
         tooltip: {
            fillSeriesColor: false
         },
      })).render();
   });
</script>
<!-- END CHART 6 -->

<!-- CHART STATUS PEMBAYARAN (7) -->
<script>
   document.addEventListener("DOMContentLoaded", function() {
      window.ApexCharts && (new ApexCharts(document.getElementById('statusBayarChart'), {
         chart: {
            type: "pie",
            fontFamily: 'inherit',
            height: 240,
            sparkline: {
               enabled: true
            },
            animations: {
               enabled: false
            },
         },
         fill: {
            opacity: 1,
         },
         series: <?= json_encode($status_pembayaran_chart['series']); ?>,
         labels: <?= json_encode($status_pembayaran_chart['labels']); ?>,
         tooltip: {
            theme: 'dark'
         },
         grid: {
            strokeDashArray: 4,
         },
         // colors: [tabler.getColor("primary"), tabler.getColor("primary", 0.8), tabler.getColor("primary", 0.6), tabler.getColor("gray-300")],
         legend: {
            show: true,
            position: 'bottom',
            offsetY: 12,
            markers: {
               width: 10,
               height: 10,
               radius: 100,
            },
            itemMargin: {
               horizontal: 8,
               vertical: 8
            },
         },
         tooltip: {
            fillSeriesColor: false
         },
      })).render();
   });
</script>
<!-- END CHART 7 -->

<script>
   var options = {
      series: [{
         name: "Visitor",
         data: [
            87, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
         ]
      }],
      chart: {
         height: 350,
         type: 'line',
         zoom: {
            enabled: false
         }
      },
      dataLabels: {
         enabled: false
      },
      stroke: {
         curve: 'straight'
      },
      title: {
         text: '',
         align: 'left'
      },
      grid: {
         row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
         },
      },
      xaxis: {
         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      }
   };

   var chart4 = new ApexCharts(document.querySelector("#chart-completion-tasks-4"), options);
   chart4.render();
</script>
</body>

</html>