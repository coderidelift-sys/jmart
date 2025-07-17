<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="<?= base_url('') ?>public/template/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
<link rel="stylesheet" href="<?= base_url('') ?>public/template/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
<style>
   .dataTables_filter input[type="search"] {
      width: auto;
      /* Sesuaikan ukuran yang diinginkan */
      height: 40px;
      /* Sesuaikan ukuran yang diinginkan */
      text-align: center;
      margin: auto;
   }

   .dataTables_length select {
      height: 40px;
      width: auto !important;
   }

   /* Menghapus tulisan "Show" pada DataTables length */
   .dataTables_length>label {
      font-size: 0;
      /* Mengubah ukuran font menjadi 0 */
   }

   /* Menampilkan kembali elemen select */
   .dataTables_length select {
      font-size: 12px;
      /* Mengatur ukuran font untuk elemen select */
   }

   .dataTables_filter {
      text-align: center;
   }

   .submission-action {
      display: block;
      position: relative;
      width: 28px;
      height: 28px;
      border: 0;
      border-radius: 50%;
      background-color: #d7d7da;
      color: #fff;
      text-align: center;
      vertical-align: middle;
      cursor: pointer;
      margin-right: 5px;
   }

   .submission-action.active {
      background-color: #8dc63f;
   }
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
   <div class="row">
      <div class="col-12">
         <h4 class="py-1">Data Pesanan</h4>
      </div>
   </div>
   <div class="card mb-3">
      <div class="card-widget-separator-wrapper">
         <div class="card-body card-widget-separator">
            <div class="row gy-4 gy-sm-1">
               <div class="col-sm-6 col-lg-3">
                  <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                     <div>
                        <h3 class="mb-2">56</h3>
                        <p class="mb-0">Pending Payment</p>
                     </div>
                     <div class="avatar me-sm-4">
                        <span class="avatar-initial rounded bg-label-secondary">
                           <i class="bx bx-calendar bx-sm"></i>
                        </span>
                     </div>
                  </div>
                  <hr class="d-none d-sm-block d-lg-none me-4">
               </div>
               <div class="col-sm-6 col-lg-3">
                  <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                     <div>
                        <h3 class="mb-2">12,689</h3>
                        <p class="mb-0">Completed</p>
                     </div>
                     <div class="avatar me-lg-4">
                        <span class="avatar-initial rounded bg-label-secondary">
                           <i class="bx bx-check-double bx-sm"></i>
                        </span>
                     </div>
                  </div>
                  <hr class="d-none d-sm-block d-lg-none">
               </div>
               <div class="col-sm-6 col-lg-3">
                  <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                     <div>
                        <h3 class="mb-2">124</h3>
                        <p class="mb-0">Refunded</p>
                     </div>
                     <div class="avatar me-sm-4">
                        <span class="avatar-initial rounded bg-label-secondary">
                           <i class="bx bx-wallet bx-sm"></i>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-3">
                  <div class="d-flex justify-content-between align-items-start">
                     <div>
                        <h3 class="mb-2">32</h3>
                        <p class="mb-0">Failed</p>
                     </div>
                     <div class="avatar">
                        <span class="avatar-initial rounded bg-label-secondary">
                           <i class="bx bx-error-alt bx-sm"></i>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="card">
      <div class="card-header">
         <div class="row">
            <div class="col-3">
               <h5 class="card-title">Filter</h5>
            </div>
            <div class="col-9 text-end">
               <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-export me-sm-1"></i> Export</button>
                  <ul class="dropdown-menu" style="">
                     <li><a class="dropdown-item" href="javascript:void(0);">PDF</a></li>
                     <li><a class="dropdown-item" href="javascript:void(0);">Excel</a></li>
                  </ul>
               </div>
               <button type="button" class="btn btn-primary"><i class="bx bx-filter me-sm-1"></i> Filter</button>
            </div>
         </div>
      </div>
      <div class="card-datatable table-responsive">
         <table class="datatables-basic table border-top" id="dataPesanan">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Order</th>
                  <th>Date</th>
                  <th>Customers</th>
                  <th>Payment</th>
                  <th>Status</th>
                  <th>Follow Up</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($pesanan as $key => $value) : ?>
                  <tr>
                     <td>
                        <i data-bs-toggle="modal" data-bs-target="#pesanan" class="bx bx-plus-circle text-primary fw-light fs-4" style="cursor: pointer;"></i>
                     </td>
                     <td>#<span class="text-primary"><?= substr($value['id_pesanan'], 0, 8) ?></span></td>
                     <td><?= date('d/F/Y H:i:s', strtotime($value['tgl_pesanan'])) ?></td>
                     <td>
                        <div class="d-flex justify-content-start align-items-center order-name text-nowrap">
                           <div class="avatar-wrapper">
                              <div class="avatar me-2"><img src="<?= base_url('') ?>public/template/img/avatars/7.png" alt="Avatar" class="rounded-circle"></div>
                           </div>
                           <div class="d-flex flex-column">
                              <h6 class="m-0"><a href="pages-profile-user.html" class="text-body"><?= $value['nama_member'] ?></a></h6>
                              <small class="text-muted"><?= $value['wa_member'] ?></small>
                           </div>
                        </div>
                     </td>
                     <td>
                        <h6 class="mb-0 w-px-100 text-warning"><i class="bx bxs-circle fs-tiny me-2"></i>Pending</h6>
                     </td>
                     <td>
                        <span class="badge px-2 bg-label-success" text-capitalized="">Selesai</span>
                     </td>
                     <td>
                        <div class="d-flex align-items-center text-nowrap">
                           <button type="button" class="submission-action submission-action-welcome  has-tooltip tombolWelcome" data-original-title="null">
                              W
                           </button>
                           <button type="button" class="submission-action submission-action-welcome  has-tooltip tombolFollow1" data-original-title="null">
                              1
                           </button>
                           <button type="button" class="submission-action submission-action-welcome  has-tooltip tombolFollow2" data-original-title="null">
                              2
                           </button>
                           <button type="button" class="submission-action submission-action-welcome  has-tooltip tombolFollow3" data-original-title="null">
                              3
                           </button>
                        </div>
                     </td>
                  </tr>
               <?php endforeach ?>
            </tbody>
         </table>
      </div>
   </div>
   <!--/ DataTable with Buttons -->
</div>
<div class="modal fade" id="pesanan" role="dialog" aria-modal="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Details of Muhammad Rifki Kardawi</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
            <table class="table">
               <tbody>
                  <tr data-dt-row="32" data-dt-column="2">
                     <td>order:</td>
                     <td><a href="app-ecommerce-order-details.html"><span class="fw-medium">#20230804</span></a></td>
                  </tr>
                  <tr data-dt-row="32" data-dt-column="3">
                     <td>date:</td>
                     <td><span class="text-nowrap">04/August/2023 21:08:51</span></td>
                  </tr>
                  <tr data-dt-row="32" data-dt-column="4">
                     <td>customers:</td>
                     <td>
                        <div class="d-flex justify-content-start align-items-center order-name text-nowrap">
                           <div class="avatar-wrapper">
                              <div class="avatar me-2"><img src="<?= base_url() ?>public/template/img/avatars/7.png" alt="Avatar" class="rounded-circle"></div>
                           </div>
                           <div class="d-flex flex-column">
                              <h6 class="m-0"><a href="pages-profile-user.html" class="text-body">Muhammad Rifki Kardawi</a></h6>
                              <small class="text-muted">628521729471</small>
                           </div>
                        </div>
                     </td>
                  </tr>
                  <tr data-dt-row="32" data-dt-column="5">
                     <td>payment:</td>
                     <td>
                        <h6 class="mb-0 w-px-100 text-warning"><i class="bx bxs-circle fs-tiny me-2"></i>Pending</h6>
                     </td>
                  </tr>
                  <tr data-dt-row="32" data-dt-column="6">
                     <td>status:</td>
                     <td><span class="badge px-2 bg-label-success" text-capitalized="">Selesai</span></td>
                  </tr>
                  <tr data-dt-row="32" data-dt-column="7">
                     <td>method:</td>
                     <td>
                        <div class="d-flex align-items-center text-nowrap">
                           Transfer [Bank Transfer, VA 12389459253]
                        </div>
                     </td>
                  </tr>
                  <tr data-dt-row="32" data-dt-column="8">
                     <td>Actions:</td>
                     <td>
                        <div class="d-flex justify-content-sm-left">
                           <button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                           <div class="dropdown-menu dropdown-menu-left m-0">
                              <a href="app-ecommerce-order-details.html" class="dropdown-item">Mark As Pending</a>
                              <a href="app-ecommerce-order-details.html" class="dropdown-item">Mark As Process</a>
                              <a href="app-ecommerce-order-details.html" class="dropdown-item">Mark As Complete</a>
                              <a href="app-ecommerce-order-details.html" class="dropdown-item">Mark As Refund</a>
                              <a href="app-ecommerce-order-details.html" class="dropdown-item">Mark As Cancel</a>
                              <a href="app-ecommerce-order-details.html" class="dropdown-item">Mark As Paid</a>
                           </div>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalWelcome">
   <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
         <div class="modal-header" style="background-color: #f0f8ff;border-bottom: 1px solid #dee1e4;padding: 1em;color: #555;">
            <h5 class="modal-title">Welcome</h5>
         </div>
         <div class="modal-body">
            <div>
               <div class="form-group">
                  <label class="mb-0">
                     <b>Name : </b><span>Muhammad Rifki Kardawi</span>
                  </label>
               </div>
               <div class="form-group">
                  <label>
                     <b>Phone Number</b>
                  </label>
                  <input type="text" class="form-control mt-2" value="628521729471">
               </div>
               <div class="form-group mt-2">
                  <label>
                     <b>Text</b>
                  </label>
                  <textarea rows="5" class="form-control">Selamat datang di Toko kami Muhammad Rifki Kardawi ☺️
                     Kami sudah terima pesanan anda dengan rincian sebagai berikut,
                     Produk: Mie Sedap 50g
                     Harga: Rp3.000
                     Ongkir: Rp5.000
                     Total: Rp8.000
                     Dikirim ke:
                     Nama: AHMAD ZAENUDIN
                     No HP: +628569494949
                     Alamat: Ggg
                     Kota: Kab. Karangasem
                     Kecamatan: Abang
                     Silahkan transfer senilai Rp58.516, ke salah satu rekening dibawah ini:
                     BCA
                     No. Rek: 1091362797
                     Atas Nama: Rahmat Hidayat
                  </textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer" style="border-top: 1px solid #dee1e4;padding: 14px 24px;background-color: #f6f7f9;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Follow Up</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalFollow1">
   <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
         <div class="modal-header" style="background-color: #f0f8ff;border-bottom: 1px solid #dee1e4;padding: 1em;color: #555;">
            <h5 class="modal-title">Welcome</h5>
         </div>
         <div class="modal-body">
            <div>
               <div class="form-group">
                  <label class="mb-0">
                     <b>Name : </b><span>AHMAD ZAENUDIN</span>
                  </label>
               </div>
               <div class="form-group">
                  <label>
                     <b>Phone Number</b>
                  </label>
                  <input type="text" class="form-control mt-2" value="08962712681">
               </div>
               <div class="form-group mt-2">
                  <label>
                     <b>Text</b>
                  </label>
                  <textarea rows="5" class="form-control">
                     Selamat siang AHMAD ZAENUDIN... Pesanan Anda sudah disiapkan ya... ☺🙏🏻
                  </textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer" style="border-top: 1px solid #dee1e4;padding: 14px 24px;background-color: #f6f7f9;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Follow Up</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalFollow2">
   <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
         <div class="modal-header" style="background-color: #f0f8ff;border-bottom: 1px solid #dee1e4;padding: 1em;color: #555;">
            <h5 class="modal-title">Welcome</h5>
         </div>
         <div class="modal-body">
            <div>
               <div class="form-group">
                  <label class="mb-0">
                     <b>Name : </b><span>AHMAD ZAENUDIN</span>
                  </label>
               </div>
               <div class="form-group">
                  <label>
                     <b>Phone Number</b>
                  </label>
                  <input type="text" class="form-control mt-2" value="08962712681">
               </div>
               <div class="form-group mt-2">
                  <label>
                     <b>Text</b>
                  </label>
                  <textarea rows="5" class="form-control">
                     Selamat siang AHMAD ZAENUDIN... Pesanan Anda sedang dikirimkan oleh kurir kami ya... ☺🙏🏻
                  </textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer" style="border-top: 1px solid #dee1e4;padding: 14px 24px;background-color: #f6f7f9;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Follow Up</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalFollow3">
   <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
         <div class="modal-header" style="background-color: #f0f8ff;border-bottom: 1px solid #dee1e4;padding: 1em;color: #555;">
            <h5 class="modal-title">Welcome</h5>
         </div>
         <div class="modal-body">
            <div>
               <div class="form-group">
                  <label class="mb-0">
                     <b>Name : </b><span>AHMAD ZAENUDIN</span>
                  </label>
               </div>
               <div class="form-group">
                  <label>
                     <b>Phone Number</b>
                  </label>
                  <input type="text" class="form-control mt-2" value="08962712681">
               </div>
               <div class="form-group mt-2">
                  <label>
                     <b>Text</b>
                  </label>
                  <textarea rows="5" class="form-control">Selamat siang AHMAD ZAENUDIN... Terimakasih sudah berbelanja di toko kami... ☺🙏🏻
                  </textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer" style="border-top: 1px solid #dee1e4;padding: 14px 24px;background-color: #f6f7f9;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Follow Up</button>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view('layouts/admin/footer'); ?>
<script src="<?= base_url('') ?>public/template/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script>
   $(document).ready(function() {
      $(".tombolWelcome").click(function() {
         $("#modalWelcome").modal('show');
      });

      $(".tombolFollow1").click(function() {
         $("#modalFollow1").modal('show');
      });

      $(".tombolFollow2").click(function() {
         $("#modalFollow2").modal('show');
      });

      $(".tombolFollow3").click(function() {
         $("#modalFollow3").modal('show');
      });

      $('#dataPesanan').DataTable({
         ordering: false,
         "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Cari Pesanan..."
         }
      });
   });
</script>
</body>

</html>