<?php $this->load->view('layouts/kasir/head') ?>
<style>
   .dropdown-item:hover,
   .dropdown-item:focus {
      color: inherit;
      text-decoration: none;
      background-color: rgba(98, 105, 118, 0.04);
   }
</style>
<?php $this->load->view('layouts/kasir/header') ?>
<!-- Page header -->
<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <div class="page-pretitle">
               Overview
            </div>
            <h2 class="page-title">
               Penjualan Hari Ini
            </h2>
         </div>
      </div>
   </div>
</div>
<!-- Page body -->
<div class="page-body">
   <div class="container-xl">
      <div class="row row-deck row-cards">
         <div class="col-sm-6 col-lg-3">
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
                  <div class="h1 mb-3">10</div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
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
                  <div class="h1 mb-3">Rp. 363,000</div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-center">
                     <div class="subheader">Active Since</div>
                  </div>
                  <div class="h1 mb-3">365 days ago</div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex align-items-center">
                     <div class="subheader text-danger">Transaksi Pending</div>
                  </div>
                  <div class="h1 mb-3 text-danger">4</div>
               </div>
            </div>
         </div>
      </div>
      <div class="row mt-1 mb-4">
         <div class="col-sm-12 mt-1 col-md-6 d-flex">
            <div class="card w-100">
               <div class="card-body">
                  <h3 class="card-title">
                     Grafik Transaksi Pembayaran
                     <span style="float: right;">Last 7 days</span>
                  </h3>
                  <div class="row">
                     <div class="col">
                        <div id="chart-active-users-2"></div>
                     </div>
                     <div class="col-md-auto">
                        <div class="divide-y divide-y-fill">
                           <div class="px-3">
                              <div class="text-secondary">
                                 <span class="status-dot bg-success"></span> Pendapatan
                              </div>
                              <div class="h2">11,425</div>
                           </div>
                           <div class="px-3">
                              <div class="text-secondary">
                                 <span class="status-dot bg-primary"></span> Laba Kotor
                              </div>
                              <div class="h2">6,458</div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12 mt-1 col-md-6">
            <div class="card w-100">
               <div class="row row-bordered g-0">
                  <div class="col-md-12">
                     <div class="card-header">
                        <h5 class="card-title mb-0">Analisis Pendapatan</h5>
                        <div class="ms-auto">
                           Last 7 days
                        </div>
                     </div>
                     <div class="card-body" style="position: relative;">
                        <div class="today-salesx d-flex" style="margin: 0 auto !important;;justify-content: space-between;-ms-flex-align: center;align-items: center;border-radius: 5px;border: 0px solid #c3d2c6;overflow: hidden;">
                           <div class="col-3">
                              <div class="t-icon bg-success" style="height: 51px;width: 51px;border-radius: 51px;display: flex;align-items: center;justify-content: center;"><i class="fa fa-shopping-cart  text-white fs-3"></i></div>
                           </div>
                           <div class="col-9">
                              <div class="row text-right">
                                 <div class="today-sale-value" style="display: inline-block;margin: 0 !important;line-height: normal;font-size: 26px;font-weight: 700;color: #000;z-index: 9;">
                                    <i>Rp.</i>
                                    <span id="ttl_trans_today">28.190 K</span>
                                 </div>
                                 <span class="value down" style="position: relative;color: #e00000;padding-right: 15px;">-38% dari minggu kemarin</span>
                                 <div class="stat-value">
                                    <span class="v-yesterday" style="font-size: 13px;">
                                       Rp. <span style="font-size: 20px;">4.027 K</span> Rata-rata per hari
                                    </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card mt-2 w-100">
               <div class="row row-bordered g-0">
                  <div class="col-md-12">
                     <div class="card-header">
                        <h5 class="card-title mb-0">Analisis Laba Kotor</h5>
                        <div class="ms-auto">
                           Last 7 days
                        </div>
                     </div>
                     <div class="card-body" style="position: relative;">
                        <div class="today-salesx d-flex" style="margin: 0 auto !important;;justify-content: space-between;-ms-flex-align: center;align-items: center;border-radius: 5px;border: 0px solid #c3d2c6;overflow: hidden;">
                           <div class="col-3">
                              <div class="t-icon bg-primary" style="height: 51px;width: 51px;border-radius: 51px;display: flex;align-items: center;justify-content: center;">
                                 <i class="fa fa-dollar-sign  text-white fs-3"></i>
                              </div>
                           </div>
                           <div class="col-9">
                              <div class="row text-right">
                                 <div class="today-sale-value" style="display: inline-block;margin: 0 !important;line-height: normal;font-size: 26px;font-weight: 700;color: #000;z-index: 9;">
                                    <i>Rp.</i>
                                    <span id="ttl_trans_today">28.190 K</span>
                                 </div>
                                 <span class="value down" style="position: relative;color: #e00000;padding-right: 15px;">-38% dari minggu kemarin</span>
                                 <div class="stat-value">
                                    <span class="v-yesterday" style="font-size: 13px;">
                                       Rp. <span style="font-size: 20px;">4.027 K</span> Rata-rata per hari
                                    </span>
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
<?php $this->load->view('layouts/kasir/footer') ?>
</body>

</html>