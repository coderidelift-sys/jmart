<!doctype html>
<!--
   * Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
   * @version 1.0.0-beta20
   * @link https://tabler.io
   * Copyright 2018-2023 The Tabler Authors
   * Copyright 2018-2023 codecalm.net Paweł Kuna
   * Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
   -->
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
   <meta http-equiv="X-UA-Compatible" content="ie=edge" />
   <title>JMART APP</title>
   <!-- CSS files -->
   <link rel="icon" href="<?= base_url('') ?>public/template/img/favicon/favicon.ico" type="image/x-icon" />
   <link href="<?= base_url('') ?>public/template/css/tabler.min.css?1692870487" rel="stylesheet" />
   <link href="<?= base_url('') ?>public/template/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
   <link href="<?= base_url('') ?>public/template/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
   <link href="<?= base_url('') ?>public/template/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
   <link href="<?= base_url('') ?>public/template/css/demo.min.css?1692870487" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
   <style>
      @import url('https://rsms.me/inter/inter.css');

      :root {
         --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }

      body {
         font-feature-settings: "cv03", "cv04", "cv11";
      }

      .navbar-brand-text {
         margin-left: 1rem !important;
         padding-top: 0.5rem !important;
      }

      .navbar-dark {
         background: #1e293b;
         color: rgba(255, 255, 255, 0.7);
      }

      .navbar-dark .navbar-nav .nav-link {
         color: rgba(255, 255, 255, 0.7);
      }

      .navbar-dark .navbar-nav .nav-link:hover,
      .navbar-dark .navbar-nav .nav-link:focus {
         color: #ffffff;
      }

      @media (min-width: 768px) {

         .navbar-expand-md.navbar-dark .nav-item.active .nav-link,
         .navbar-expand-md .navbar-dark .nav-item.active .nav-link {
            background-color: rgba(0, 0, 0, 0.1);
         }
      }
   </style>
   <script>
      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;

      var pusher = new Pusher('fe22024f3d888f7e4ae0', {
         cluster: 'ap1'
      });

      var channel = pusher.subscribe('my-channel');
      channel.bind('my-event-3', function(data) {
         var dataPesanan = data.pesanan;
         $.ajax({
            url: '<?= base_url('home/count_pending') ?>', // Sesuaikan dengan URL Controller Anda
            type: 'GET',
            dataType: 'json',
            success: function(response) {
               // Ganti isi modal body dengan konten yang diberikan
               var detailPesananHTML = '';
               dataPesanan.forEach(function(pesanan) {
                  // Membuat elemen HTML untuk setiap pesanan
                  detailPesananHTML += `
                            <div class="d-flex justify-content-between">
                                <span class="font-weight-bold">${pesanan.nama_barang} (Qty:${pesanan.jumlah_jual})</span>
                                <span class="text-muted">${pesanan.harga_saat_ini}</span>
                            </div>
                        `;
               });

               $('#exampleModal .modal-body').html(`
                        <div class="modal-body" style="background-color: #fff; border-color: #fff;">
                            <div class="px-4 py-2">
                                <h5 class="text-uppercase">
                                    <span class="fs-6 text-danger">${response.pendingOrders} Pesanan Pending</span> <br>
                                    ${data.user.nama_member}
                                </h5>
                                <h4 style="color: #004cb9;" class="mt-5 theme-color mb-5">Terimakasih atas orderan Anda</h4>

                                <span style="color: #004cb9;" class="theme-color">Payment Summary</span>
                                <div class="mb-3">
                                    <hr class="new1" style="border-top: 2px dashed black; margin: 0.4rem 0;">
                                </div>

                                ${detailPesananHTML}
                                <div class="d-flex justify-content-between mt-3">
                                    <span class="font-weight-bold">Subtotal</span>
                                    <span style="color: #004cb9;" class="font-weight-bold theme-color">${data.user.grand_total - data.user.ongkos_kirim}</span>
                                </div>
                                <div class="d-flex justify-content-between mt-0">
                                    <span class="font-weight-bold">Ongkos Kirim</span>
                                    <span style="color: #004cb9;" class="font-weight-bold theme-color">${data.user.ongkos_kirim}</span>
                                </div>
                                <div class="d-flex justify-content-between mt-0">
                                    <span class="font-weight-bold">Total</span>
                                    <span style="color: #004cb9;" class="font-weight-bold theme-color">${data.user.grand_total}</span>
                                </div>
                                <div class="text-center mt-5">
                                    <button data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                    <button onclick="location.href='<?= base_url('penjualan') ?>'" class="btn btn-primary">Proses Pesanan</button>
                                </div>
                            </div>
                        </div>
                    `);

               // Tampilkan modal
               $('#exampleModal').modal('show');

            },
            error: function(error) {
               console.error('Gagal mengambil data jumlah pending.');
            }
         });
      });
   </script>

   <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-body" style="background-color: #fff;border-color: #fff;"></div>
         </div>
      </div>
   </div>
