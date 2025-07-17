<?php $this->load->view('layouts/kurir/head'); ?>
<style>
   .title {
      color: #2F2F2F;
   }

   h6,
   .h6 {
      font-size: 1rem;
   }

   .h5,
   h5 {
      font-size: 1.125rem;
   }

   .avatar-md {
      height: 5rem;
      width: 5rem;
   }

   .dz-order {
      background-color: #FFF;
      padding: 15px 15px;
      box-shadow: 0 2px 4px 0 rgb(71 70 69 / 40%) !important;
      margin-bottom: 15px;
      border-radius: 0.25rem;
      background-clip: border-box;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
      /* Efek transisi untuk perubahan warna latar belakang */
   }

   /* .dz-order:hover {
      background-color: #f0f0f0;
   } */

   .dz-order .order-info,
   .dz-order .order-detail {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 15px;
   }

   .pe-2 {
      padding-right: 0.5rem !important;
   }

   .dz-order .productId {
      font-size: 12px;
      color: #A131AD;
      font-weight: bold;
   }

   .media-70 {
      width: 70px;
      min-width: 70px;
      height: 70px;
   }

   .dz-order .order-info,
   .dz-order .order-detail {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 15px;
   }

   .gap-5 {
      gap: 3rem !important;
   }

   .dz-order .quantity {
      font-size: 14px;
      font-weight: 700;
      color: #2F2F2F;
   }

   .price {
      margin-bottom: 0;
      color: #0D775E;
      font-weight: 700;
   }

   .dz-order .status {
      display: flex;
      align-items: center;
   }

   .dz-order .status .btn {
      padding: 12px 18px;
      font-size: 14px;
      white-space: nowrap;
      font-weight: 500;
   }

   .light.btn-success {
      background-color: #e4f8ee;
      border-color: #e4f8ee;
      color: #43CD8B;
   }

   .link-p {
      display: block;
      min-height: 250px;
      height: auto;
      width: 100%;
      max-width: 100%;
      margin-right: auto;
      margin-left: auto;
   }

   .mb-xxl {
      margin-bottom: calc(75px + (100 - 75) * ((100vw - 320px) / (1920)));
   }

   .order-detail .banner-box {
      padding: 15px;
      background-color: #0baf9a;
      border-radius: 7px;
   }

   .media {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
   }

   .order-detail .banner-box .media img {
      width: 40px;
      height: 40px;
   }

   .order-detail .item-section .item-wrap .media .count {
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
   }

   .order-detail .item-section .item-wrap .media .count>span {
      background-color: #0baf9a;
      width: calc(26px + (32 - 26) * ((100vw - 320px) / (1920 - 320)));
      height: calc(26px + (32 - 26) * ((100vw - 320px) / (1920 - 320)));
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      color: #fff;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
      -ms-flex-direction: column;
      flex-direction: column;
      border-radius: 5px;
   }

   @media only screen and (max-width: 375px) {
      .order-detail .item-section .item-wrap .media .media-body h4 {
         width: 136px;
         font-weight: 600;
      }
   }

   .order-detail .item-section .item-wrap .media .media-body h4 {
      margin-top: -5px;
      font-weight: 600;
      overflow: hidden;
      margin-bottom: 0px;
      margin-left: 20px;
   }

   .order-detail .item-section .item-wrap .media .media-body span {
      display: block;
      margin-bottom: -2px;
   }

   .order-detail .item-section .item-wrap .media>span {
      margin-left: auto;
   }

   .order-detail .item-section .item-wrap .media:not(:first-of-type) {
      border-top: 1px solid #f1f1f1;
   }

   .order-detail .item-section .item-wrap .media {
      padding: 15px;
   }

   .content-color {
      color: #777;
   }

   .order-detail .order-summary ul li {
      padding: 2px 0;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      -webkit-box-pack: justify;
      -ms-flex-pack: justify;
      justify-content: space-between;
   }

   .order-history .order-box {
      background-color: white;
      padding: 15px;
      border-radius: 10px;
   }

   .order-history .order-box .media {
      -webkit-box-pack: justify;
      -ms-flex-pack: justify;
      justify-content: space-between;
   }

   .order-history .order-box .media .media-body img {
      width: calc(75px + (100 - 75) * ((100vw - 320px) / (1920 - 320)));
      height: calc(75px + (100 - 75) * ((100vw - 320px) / (1920 - 320)));
      border-radius: 10px;
   }

   .order-history .order-box .bottom-content {
      margin-top: 15px;
      padding-top: 10px;
      border-top: 1px solid #f1f1f1;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      -webkit-box-pack: justify;
      -ms-flex-pack: justify;
      justify-content: space-between;
   }

   .order-history .order-box .bottom-content .rating {
      display: none;
   }

   .rating {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      gap: 4px;
   }

   .order-history .order-box .media .content-box h2 {
      font-weight: 600;
      margin-bottom: 3px;
   }

   .order-history .order-box .media .content-box p {
      margin-bottom: 3px;
      width: calc(180px + (245 - 180) * ((100vw - 320px) / (1920 - 320)));
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
   }

   .title-color {
      color: #222;
   }

   .font-sm {
      font-size: calc(14px + (16 - 14) * ((100vw - 320px) / (1920 - 320))) !important;
   }

   .content-color {
      color: #777;
   }

   .font-xs {
      font-size: calc(13px + (14 - 13) * ((100vw - 320px) / (1920 - 320))) !important;
   }
</style>
<?php $this->load->view('layouts/kurir/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
   <div class="container">
      <div class="nav-bar__left">
         <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Daftar Pesanan</h1>
      </div>
   </div>
</nav>
<section class="mt-3 mb-4">
   <div class="container">
      <div class="row">
         <div class="card">
            <div class="card-body pt-3 pb-0 pl-1 pr-1">
               <div id="bar-chart"></div>
            </div>
            <div class="card-footer"></div>
         </div>
      </div>
      <div class="row mt-3">
         <div class="card">
            <div class="card-body pt-3 pb-0 pl-1 pr-1">
               <div id="pie-chart"></div>
            </div>
            <div class="card-footer"></div>
         </div>
      </div>
      <div class="row mt-3">
         <h5 class="fw-bold card-title">Histori Pemesanan</h5>
         <div class="card">
            <div class="card-body p-0 pt-0 pb-0 pl-1 pr-1">
               <main class="main-wrap order-history mb-xxl">
                  <?php foreach ($pesanan as $key => $value) : ?>
                     <?php
                     $items = $this->db->select('*')->from('tb_pesanan_detail')->where('id_pesanan', $value->id_pesanan)->get()->num_rows();
                     ?>
                     <div style="cursor: pointer !important;" class="order-box border-bottom" data-bs-toggle="modal" data-bs-target="#orderDetailModal<?= $value->id_pesanan ?>">
                        <div class="media">
                           <a href="javascript::void" class="content-box">
                              <h2 class="font-sm title-color">ID: #<?= $value->id_pesanan ?> , Dt: <?= $value->tgl_diselesaikan ?></h2>
                              <p class="font-xs content-color fw-bold fs-6">
                                 <?= $value->nama_member ?>
                              </p>
                              <span class="content-color font-xs">Total: <span class="text-success fw-bold">Rp. <?= number_format($value->grand_total) ?></span>, Items: <span class="text-success fw-bold"><?= $items ?></span></span>
                           </a>
                           <div class="media-body">
                              <img src="https://themes.pixelstrap.com/fastkart-app/assets/images/map/map.jpg" alt="map">
                           </div>
                        </div>
                     </div>
                  <?php endforeach ?>
               </main>
            </div>
         </div>
      </div>
   </div>
</section>

<?php foreach ($pesanan as $key => $value) : ?>
   <div class="modal fade" id="orderDetailModal<?= $value->id_pesanan ?>" tabindex="-1" aria-labelledby="orderDetailModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Detail Pesanan</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
               <main class="main-wrap order-detail mb-xxl">
                  <!-- Banner Start -->
                  <section class="pt-0">
                     <div class="banner-box bg-custom">
                        <div class="row g-0 align-items-center">
                           <div class="col-md-3 col-3">
                              <img class="img-fluid" src="https://themes.pixelstrap.com/fastkart-app/assets/icons/svg/box.svg" alt="box" style="width: 100%; max-width: 70px;">
                           </div>
                           <div class="col-md-9 col-9">
                              <div class="media-body text-white">
                                 <span class="font-sm">Order ID: #<?= $value->id_pesanan ?></span>
                                 <h2>Order Selesai</h2>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>

                  <!-- Banner End -->

                  <!-- Item Section Start -->
                  <section class="item-section p-0">
                     <h3 class="text-success mt-3 fw-bold font-md">Items:</h3>

                     <div class="item-wrap">
                        <?php
                        $detail = $this->db->select('*')->from('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->where('id_pesanan', $value->id_pesanan)->get()->result_array();
                        ?>
                        <?php foreach ($detail as $key => $dtl) : ?>
                           <a href="javascript::void" class="media">
                              <div class="count">
                                 <span class="font-sm"><?= $dtl['jumlah_jual'] ?></span>
                              </div>
                              <div class="media-body">
                                 <h4 class="title-color font-sm"><?= $dtl['nama_barang'] ?></h4>
                                 <span class="content-color font-sm" style="margin-left: 20px;">
                                    <?= $dtl['harga_saat_ini'] ?>
                                 </span>
                              </div>
                              <span class="title-color font-md"><?= number_format($dtl['harga_saat_ini'] * $dtl['jumlah_jual']) ?></span>
                           </a>
                        <?php endforeach ?>
                     </div>
                  </section>
                  <!-- Item Section End -->

                  <!-- Order Summary Section Start -->
                  <section class="order-summary p-0">
                     <h3 class="text-success fw-bold mt-3 font-md">Payment Details</h3>
                     <!-- Product Summary Start -->
                     <ul>
                        <li>
                           <span>Sub Total</span>
                           <span><?= $value->grand_total - $value->ongkos_kirim ?></span>
                        </li>

                        <li>
                           <span>Ongkos Kirim</span>
                           <span class="font-theme"><?= $value->ongkos_kirim ?></span>
                        </li>

                        <li>
                           <span>Total Amount</span>
                           <span><?= $value->grand_total ?></span>
                        </li>
                     </ul>
                     <!-- Product Summary End -->
                  </section>
                  <!-- Order Summary Section End -->

                  <!-- Address Section Start -->
                  <?php
                  $alamat = $this->db->select('*')->from('tb_user_alamat')->join('tb_desa', 'tb_desa.id_desa = tb_user_alamat.id_desa')->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_desa.id_kecamatan')->join('tb_kabupaten', 'tb_kabupaten.id_kabupaten = tb_kecamatan.id_kabupaten')->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kabupaten.id_provinsi')->where('id_user', $value->id_user)->where('set_default', 'Main')->get()->row_array();
                  ?>
                  <section class="address-section p-0">
                     <h3 class="text-success mt-3 fw-bold font-md">Address</h3>

                     <div class="address">
                        <table style="border-collapse: collapse;" class="border-0 mt-3">
                           <tr>
                              <td width="80"><strong>Nama</strong></td>
                              <td width="15">:</td>
                              <td class="fs-4"><?= $alamat['nama_penerima'] ?></td>
                           </tr>
                           <tr>
                              <td><strong>Email</strong></td>
                              <td>:</td>
                              <td class="fs-4"><?= $value->email_member ?></td>
                           </tr>
                           <tr>
                              <td><strong>Kontak</strong></td>
                              <td>:</td>
                              <td class="fs-4"><?= $alamat['kontak_penerima'] ?></td>
                           </tr>
                           <tr>
                              <td><strong>Alamat</strong></td>
                              <td>:</td>
                              <td class="fs-4">
                                 <?= $alamat['nama_desa'] ?>, <?= $alamat['nama_kecamatan'] ?>, <?= $alamat['nama_kabupaten'] ?>, <?= $alamat['nama_provinsi'] ?>, ID | <?= $alamat['kode_pos'] ?>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </section>
                  <!-- Address Section End -->

                  <!-- Payment Method Section Start -->
                  <section class="payment-method p-0">
                     <h3 class="text-success mt-3 fw-bold font-md">Metode Pembayaran</h3>
                     <span class="font-sm title-color" style="text-transform: capitalize;"><?= $value->metode_bayar ?></span>
                  </section>
                  <!-- Payment Method Section End -->
               </main>
            </div>
         </div>
      </div>
   </div>

<?php endforeach ?>

<div class="row">
   <br><br><br><br>
</div>
<?php $this->load->view('layouts/kurir/menu'); ?>
<?php $this->load->view('layouts/kurir/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('public/template/libs/apexcharts/dist/apexcharts.min.js') ?>"></script>
<script>
   var currentDate = new Date();
   var totalSumPerDate = <?php echo $json_total_sum_per_date; ?>;
   var totalSums = [];
   for (var date in totalSumPerDate) {
      if (totalSumPerDate.hasOwnProperty(date)) {
         totalSums.push(totalSumPerDate[date]);
      }
   }
   var last12Days = [];
   for (var i = 6; i >= 0; i--) {
      var day = currentDate.getDate();
      var month = currentDate.getMonth() + 1; // Bulan dimulai dari 0, tambahkan 1 untuk mendapatkan bulan yang benar
      last12Days.unshift(day + " " + getMonthName(month)); // Tambahkan ke depan array
      currentDate.setDate(currentDate.getDate() - 1); // Pindah ke hari sebelumnya
   }

   function getMonthName(month) {
      var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
      return monthNames[month - 1];
   }

   var options = {
      series: [{
         name: 'Inflation',
         data: totalSums
      }],
      chart: {
         height: 200,
         type: 'bar',
      },
      plotOptions: {
         bar: {
            borderRadius: 10,
            dataLabels: {
               position: 'top', // top, center, bottom
            },
         }
      },
      dataLabels: {
         enabled: true,
         formatter: function(val) {
            return val + "%";
         },
         offsetY: -20,
         style: {
            fontSize: '12px',
            colors: ["#304758"]
         }
      },

      xaxis: {
         categories: last12Days,
         position: 'top',
         axisBorder: {
            show: false
         },
         axisTicks: {
            show: false
         },
         crosshairs: {
            fill: {
               type: 'gradient',
               gradient: {
                  colorFrom: '#D8E3F0',
                  colorTo: '#BED1E6',
                  stops: [0, 100],
                  opacityFrom: 0.4,
                  opacityTo: 0.5,
               }
            }
         },
         tooltip: {
            enabled: true,
         }
      },
      yaxis: {
         axisBorder: {
            show: false
         },
         axisTicks: {
            show: false,
         },
         labels: {
            show: false,
            formatter: function(val) {
               return val + "%";
            }
         }

      },
      title: {
         text: 'Jumlah Pesanan',
         floating: true,
         offsetY: 180,
         align: 'center',
         style: {
            color: '#444'
         }
      }
   };

   var chart = new ApexCharts(document.querySelector("#bar-chart"), options);
   chart.render();
</script>
<script>
   document.addEventListener("DOMContentLoaded", function() {
      window.ApexCharts && (new ApexCharts(document.getElementById('pie-chart'), {
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
         series: [<?= $pending ?>, <?= $dikemas ?>, <?= $misi ?>, <?= $selesai ?>],
         labels: ['Dalam Proses', 'Siap Dikirimkan', 'Dalam Misi', 'Selesai'],
         tooltip: {
            theme: 'dark'
         },
         grid: {
            strokeDashArray: 4,
         },
         legend: {
            show: true,
            position: 'bottom',
         },
         title: {
            text: 'Status Pesanan',
            align: 'center',
            style: {
               color: '#444'
            }
         },
         tooltip: {
            fillSeriesColor: false
         },
      })).render();
   });
</script>
</body>

</html>