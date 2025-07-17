<?php $this->load->view('layouts/user/head'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>public/template/vendor/libs/sweetalert2/sweetalert2.css" />
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

   .navbar__left {
      width: 4rem;
      z-index: 2;
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
      background-clip: border-box;
   }

   .avatar {
      border-radius: 50%;
      object-fit: cover;
   }

   .minus_qty,
   .plus_qty {
      background-color: #fff;
      color: #005da6;
      text-align: center;
   }

   .qty_barang {
      font-size: 16px;
      border-radius: 0;
      text-align: center;
      color: #333;
      width: auto;
      max-width: 70px;
   }
</style>
<?php $this->load->view('layouts/user/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
   <div class="container nav-bar__on-container">
      <div class="navbar__left">
         <a href="<?= base_url('keranjang') ?>">
            <svg class="navbar__left__icon fw-bold text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);cursor:pointer;z-index: 2;">
               <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
            </svg>
         </a>
      </div>
      <div class="nav-bar__center">
         <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Proses Keranjang</h1>
      </div>
   </div>
</nav>
<section class="mt-3 mb-3">
   <div class="container">
      <div class="card mb-3 mt-2">
         <div class="card-header pb-0 d-flex justify-content-between">
            <h4 class="title text-primary">Alamat Pengiriman</h4>
            <h4 class="fw-bold text-primary"><a href="<?= base_url('akun/alamat') ?>" class="fsize-m-2">Edit</a></h4>
         </div>
         <div class="card-body pt-0">
            <table style="border-collapse: collapse;" class="border-0 mt-3">
               <tr>
                  <td width="80"><strong>Nama</strong></td>
                  <td width="15">:</td>
                  <td class="fs-4"><?= $alamat['nama_penerima'] ?></td>
               </tr>
               <tr>
                  <td><strong>Email</strong></td>
                  <td>:</td>
                  <td class="fs-4"><?= $email['email_member'] ?></td>
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
      </div>
   </div>
</section>

<section class="mt-3 mb-3">
   <div class="container">
      <div class="card mb-3 mt-2">
         <div class="card-header pb-0">
            <h4 class="fw-bold text-primary">Ringkasan Pesanan</h4>
         </div>
         <div class="card-body pt-0">
            <div class="table-responsive">
               <table class="table mb-3">
                  <thead>
                     <tr>
                        <th class="fw-bold" width="80px">Gambar</th>
                        <th class="fw-bold">Nama Barang</th>
                        <th class="text-center fw-bold">Jumlah</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($keranjang as $key => $tmp) : ?>
                        <tr>
                           <td>
                              <img width="62" height="62" style="padding: 5px;" style='border-radius: 3px;' src="<?= base_url('public/template/upload/barang/' . $tmp['gambar_barang']) ?>">
                           </td>
                           <td style="font-size: 14px;">
                              <?php
                              // Cek apakah grosir aktif
                              if ($tmp['grosir_brg'] == "On" && $tmp['jumlah'] >= $tmp['rentang_awal'] && $tmp['jumlah'] <= $tmp['rentang_akhir']) {
                                 $harga_saat_ini = $tmp['harga_grosir']; // Gunakan harga grosir
                                 $keterangan_grosir = "<br><small class='text-muted'>Harga grosir aktif untuk pembelian di atas " . $tmp['rentang_awal'] . " unit.</small>";
                              } else {
                                 // Gunakan harga promo jika promo aktif, jika tidak gunakan harga jual
                                 $harga_saat_ini = $tmp['promo_brg'] == "On" ? $tmp['harga_promo'] : $tmp['harga_jual_barang'];
                                 $keterangan_grosir = ""; // Tidak ada keterangan grosir
                              }

                              // Tampilkan harga
                              if ($tmp['promo_brg'] == "On") {
                                 echo "<span class='fw-bold text-primary'>" . $tmp['nama_barang'] . "</span><br>";
                                 echo "<span class='text-success fw-bold'>Rp. " . number_format($harga_saat_ini) . "</span> ";
                                 echo "| <del style=\"color: #BFC9DA !important;font-weight: 400 !important;\">Rp. " . number_format($tmp['harga_jual_barang']) . "</del>";
                              } else {
                                 echo "<span class='fw-bold text-primary'>" . $tmp['nama_barang'] . "</span><br>";
                                 echo "<span class='text-success fw-bold'>Rp. " . number_format($harga_saat_ini) . "</span>";
                              }
                              // Tampilkan keterangan grosir jika ada
                              echo $keterangan_grosir;
                              ?>
                           </td>
                           <td class="text-center"><br>x<?= $tmp['jumlah'] ?></td>
                        </tr>
                     <?php endforeach ?>
                  </tbody>
                  <tfoot>
                     <tr>
                        <td></td>
                        <td style="font-size: 14px;">
                           <?php
                           echo "Total Harga: Rp. <span id='temp_harga'>" . number_format($total['total_harga']) . "</span>";
                           ?>
                        </td>
                        <td></td>
                     </tr>
                  </tfoot>
               </table>
            </div>
         </div>
      </div>
      <div class="card">
         <div class="card-body">
            <div class="form-group row">
               <label for="nama" class="col-sm-4 control-label fw-bold">Jenis Order</label>
               <div class="col-sm-8">
                  <select required name="jenis_order" id="jenis_order" class="form-select mb-2 w-100" style="border-radius: 0px;">
                     <option value="">Pilih Jenis Order</option>
                     <option value="ambil_sendiri">Ambil Sendiri</option>
                     <option value="dianterin">Dianterin ke Alamat</option>
                     <option value="dianterin_pt">Dianterin ke PT</option>
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="nama" class="col-sm-4 control-label fw-bold">Metode Bayar</label>
               <div class="col-sm-8">
                  <select required name="metode_bayar" id="metode_bayar" class="form-select mb-2" style="border-radius: 0px;">
                     <option value="">Pilih Metode Pembayaran</option>
                     <option value="cash">Cash</option>
                     <option value="transfer">Transfer</option>
                     <option value="autodebet">Autodebet</option>
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="nama" class="col-sm-4 control-label fw-bold">Ongkos Kirim</label>
               <div class="col-sm-8">
                  <input id="ongkos_kirim" name="ongkos_kirim" style="text-align: right !important;border-radius: 0px;" disabled type="text" class="form-control float-end mb-2" value="Rp. 0">
               </div>
            </div>
            <div class="form-group row">
               <label for="nama" class="col-sm-4 control-label fw-bold">Total Biaya</label>
               <div class="col-sm-8">
                  <input id="total_biaya" name="total_biaya" style="text-align: right;border-radius: 0px;" disabled type="text" class="form-control mb-2" value="<?= "Rp. " . number_format($total['total_harga']) ?>" placeholder="<?= "Rp. " . number_format($total['total_harga']) ?>">
               </div>
            </div>
            <div class="form-group row">
               <label for="nama" class="col-sm-4 control-label fw-bold">Keterangan</label>
               <div class="col-sm-8">
                  <textarea style="border-radius:0px" name="keterangan_pesanan" id="keterangan_pesanan" class="form-control" placeholder="Catatan"></textarea>
               </div>
            </div>
            <div class="button mt-2">
               <button style="border-radius: 0px;" id="btn-pesanan" class="btn btn-primary w-100 btn-block" disabled>Buat Pesanan</button>
               <button style="border-radius: 0px;display:none" id="pay-button" class="btn btn-primary w-100 btn-block mt-2" disabled>Konfirmasi Pembayaran</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://app-sandbox.duitku.com/lib/js/duitku.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $(document).ready(function() {
      const metodeBayar = $('#metode_bayar');
      const jenisOrder = $('#jenis_order');
      const btnPesanan = $('#btn-pesanan');
      const btnPayout = $('#pay-button');

      metodeBayar.on('change', function() {
         if (jenisOrder.val() === '') {
            btnPesanan.prop('disabled', true);
            btnPayout.prop('disabled', true);
         } else if (metodeBayar.val() === 'cash') {
            btnPesanan.prop('disabled', false);
            btnPayout.prop('disabled', true);
         } else if (metodeBayar.val() === 'autodebet') {
            btnPesanan.prop('disabled', false);
            btnPayout.prop('disabled', true);
         } else if (metodeBayar.val() === 'transfer') {
            btnPesanan.prop('disabled', false);
            btnPayout.prop('disabled', false);
         } else {
            btnPesanan.prop('disabled', true);
            btnPayout.prop('disabled', true);
         }
      });

      jenisOrder.on('change', function() {
         if (jenisOrder.val() === 'ambil_sendiri') {
            var temp = parseFloat($("#temp_harga").text().replace(",", ""));
            $("#ongkos_kirim").val("Rp. 0");
            $("#total_biaya").val("Rp. " + temp);
         } else if (jenisOrder.val() === 'dianterin') {
            $.ajax({
               url: '<?= base_url('') ?>keranjang/ambilOngkosKirim', // Ganti 'URL_Anda' dengan URL yang benar
               type: 'GET',
               dataType: 'json',
               success: function(response) {
                  if (response.success) {
                     var total = parseFloat($("#total_biaya").val().replace("Rp. ", "").replace(",", ""));
                     var ongkosKirim = parseFloat(response.data.ongkos_kirim.replace("Rp. ", "").replace(",", ""));
                     var hasilJumlah = total + ongkosKirim;
                     $("#ongkos_kirim").val("Rp. " + response.data.ongkos_kirim);
                     $("#total_biaya").val("Rp. " + hasilJumlah);
                  } else {
                     console.error('Gagal mengambil data dari server.');
                  }
               },
               error: function(xhr, status, error) {
                  console.error('Terjadi kesalahan AJAX: ' + error);
               }
            });
         } else {
            var temp = parseFloat($("#temp_harga").text().replace(",", ""));
            $("#ongkos_kirim").val("Rp. 0");
            $("#total_biaya").val("Rp. " + temp);
         }

         if (jenisOrder.val() === '') {
            btnPesanan.prop('disabled', true);
            btnPayout.prop('disabled', true);
         } else if (jenisOrder.val() !== '' && metodeBayar.val() === 'cash') {
            btnPesanan.prop('disabled', false);
            btnPayout.prop('disabled', true);
         } else if (jenisOrder.val() !== '' && metodeBayar.val() === 'autodebet') {
            btnPesanan.prop('disabled', false);
            btnPayout.prop('disabled', true);
         } else if (jenisOrder.val() !== '' && metodeBayar.val() === 'transfer') {
            btnPesanan.prop('disabled', true);
            btnPayout.prop('disabled', false);
         }
      });


      $('#btn-pesanan').click(function() {
         var keranjangData = <?php echo json_encode($keranjang); ?>;
         var jenis = $("#jenis_order").val();
         var metode = $("#metode_bayar").val();
         var ongkos = $("#ongkos_kirim").val();
         var total = $("#total_biaya").val();
         var keterangan = $("#keterangan_pesanan").val();

         if (jenis === "") {
            alert("Harap pilih jenis order sebelum melanjutkan!");
            return;
         }

         if (metode === "") {
            alert("Harap pilih metode bayar sebelum melanjutkan!");
            return;
         }

         // Menggunakan SweetAlert2 untuk konfirmasi
         Swal.fire({
            title: "Konfirmasi!! Anda yakin ingin membuat pesanan?",
            showCancelButton: true,
            confirmButtonText: "Buat Pesanan",
            cancelButtonText: "Batalkan",
            customClass: {
               confirmButton: 'btn btn-primary',
               cancelButton: 'btn btn-secondary'
            },
         }).then((result) => {
            if (result.isConfirmed) {
               // Jika pengguna mengonfirmasi, kirim permintaan AJAX ke server
               $.ajax({
                  url: "<?= base_url('pesanan/create') ?>",
                  type: "POST",
                  data: {
                     keranjang: keranjangData,
                     keterangan: keterangan,
                     metode: metode,
                     jenis: jenis,
                     ongkos: ongkos,
                     total: total,
                  },
                  success: function(response) {
                     if (response.success == true) {
                        Swal.fire({
                           title: 'Success!',
                           text: response.msg,
                           type: 'success',
                           customClass: {
                              confirmButton: 'btn btn-primary'
                           },
                           buttonsStyling: false
                        }).then((result) => {
                           if (result.isConfirmed) {
                              window.location.href = '<?= base_url('pesanan') ?>';
                           }
                        });
                     } else {
                        Swal.fire({
                           title: 'Error!',
                           text: response.msg,
                           type: 'error',
                           customClass: {
                              confirmButton: 'btn btn-danger'
                           },
                           buttonsStyling: false
                        });
                     }
                  },
                  error: function(xhr, status, error) {
                     console.error("Terjadi kesalahan: " + error);
                  }
               });
            }
         });
      });

      $('#pay-button').click(function() {
         var jenis = $("#jenis_order").val();
         var metode = $("#metode_bayar").val();
         var total_harga_str = "<?= number_format($total['total_harga']) ?>";
         var total_harga_str_clean = total_harga_str.replace(/[^0-9]/g, '');
         var total_harga_int = parseInt(total_harga_str_clean);
         var keranjangData = <?php echo json_encode($keranjang); ?>;

         if (jenis === "") {
            alert("Harap pilih jenis order sebelum melanjutkan!");
            return; // Hentikan eksekusi fungsi jika metodeBayar kosong
         }

         if (metode === "") {
            alert("Harap pilih metode bayar sebelum melanjutkan!");
            return; // Hentikan eksekusi fungsi jika metodeBayar kosong
         }

         $.ajax({
            type: "POST",
            data: {
               id: generateInvoiceNumber(),
               total_harga: total_harga_int,
               user: "<?= $user ?>",
               keranjang: keranjangData,
               jenis: jenis,
               metode: metode
            },
            url: '<?= base_url('create_invoice') ?>',
            dataType: "json",
            cache: false,
            success: function(result) {
               console.log(result.reference);
               console.log(result);
               checkout.process(result.reference, {
                  successEvent: function(result) {
                     alert('Payment Success');
                     window.location.href = "<?= base_url('pesanan') ?>";
                  },
                  pendingEvent: function(result) {
                     // Add Your Action
                     alert('Payment Pending');
                     window.location.href = "<?= base_url('pesanan') ?>";
                  },
                  errorEvent: function(result) {
                     // Add Your Action
                     console.log('error');
                     console.log(result);
                     alert('Payment Error');
                  },
                  closeEvent: function(result) {
                     // Add Your Action
                     console.log('customer closed the popup without finishing the payment');
                     console.log(result);
                     alert('customer closed the popup without finishing the payment');
                  }
               });
            },
            error: function(request, status, error) {
               alert(request.responseText);
            },
         });
      });

      function generateInvoiceNumber() {
         const date = new Date();
         const year = date.getFullYear().toString().substr(-2);
         const month = (date.getMonth() + 1).toString().padStart(2, '0');
         const day = date.getDate().toString().padStart(2, '0');
         const randomDigits = Math.floor(Math.random() * 1000).toString().padStart(4, '0');
         const invoiceNumber = `${year}${month}${day}${randomDigits}`;

         return invoiceNumber;
      }
   });
</script>
</body>

</html>
