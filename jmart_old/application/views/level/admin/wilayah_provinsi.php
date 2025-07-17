<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
  .page-link {
    position: relative;
    display: block;
    color: #626976;
    background-color: transparent;
    border: 0 solid #cbd5e1;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }

  .bg-secondary {
    color: #ffffff !important;
    background: #626976 !important;
  }

  .select2-container .select2-selection--single .select2-selection__rendered {
    display: block;
    width: 100%;
    padding: 0.5625rem 0.75rem;
    font-family: var(--tblr-font-sans-serif);
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.4285714286;
    color: var(--tblr-body-color);
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: var(--tblr-bg-forms);
    background-clip: padding-box;
    border: var(--tblr-border-width) solid var(--tblr-border-color);
    border-radius: var(--tblr-border-radius);
    box-shadow: var(--tblr-box-shadow-input);
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
  }

  .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: none;
    border-radius: 4px;
  }

  .dataTables_wrapper .row:first-child {
    padding-top: 20px;
    padding-bottom: 12px;
    padding-left: 50px;
    padding-right: 30px;
  }

  .dataTables_wrapper .row:last-child {
    padding-top: 20px;
    padding-bottom: 12px;
    padding-left: 50px;
    padding-right: 30px;
  }

  div.dataTables_wrapper div.dataTables_filter input {
    padding: 14px 6px;
  }

  div.dataTables_wrapper div.dataTables_length select {
    padding: 10px 6px;
    width: 70px;
  }

  .active>.page-link,
  .page-link.active {
    z-index: 3;
    color: #fff;
    background-color: #337ab7;
    border-color: #337ab7;
    cursor: pointer;
  }

  .table>tbody>tr:hover {
    background-color: #F5F5F5;
  }

  .card .table {
    box-shadow: none !important;
  }

  .card-header {
    padding: 0.8rem 1.5rem;
    margin-bottom: 0;
    background: #f7f7f8;
    border-bottom: 1px solid rgba(0, 0, 0, .125);
    border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
  }

  .card .card-header h2 {
    float: left;
    padding: 10px 0;
    margin: 0 0 0 20px;
  }

  .blue {
    color: #428bca !important;
  }

  .card .card-header h2 i {
    border-right: 1px solid #dbdee0;
    padding: 12px 0;
    height: 40px;
    width: 40px;
    display: inline-block;
    text-align: center;
    margin: -10px 20px -10px -20px;
    font-size: 16px;
  }
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Data Provinsi
        </h2>
      </div>
    </div>
    <div class="row align-items-center mt-3">
      <div class="col-12 col-md-6">
        <div class="card">
          <div class="ribbon ribbon-top bg-info"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3" />
              <path d="M4 6v6c0 1.657 3.582 3 8 3c1.075 0 2.1 -.08 3.037 -.224" />
              <path d="M20 12v-6" />
              <path d="M4 12v6c0 1.657 3.582 3 8 3c.166 0 .331 -.002 .495 -.006" />
              <path d="M16 19h6" />
              <path d="M19 16v6" />
            </svg>
          </div>
          <div class="card-header">
            <h3 class="card-title text-primary fw-bold">
              Tambah Provinsi
            </h3>
          </div>
          <div class="card-body">
            <form id="form-simpan" method="POST" autocomplete="off">
              <div class="mb-3">
                <label class="form-label fw-bold required">Nama Provinsi</label>
                <div>
                  <input required type="text" class="form-control" aria-describedby="emailHelp" placeholder="Nama Provinsi" id="nama_provinsi">
                </div>
              </div>
              <div class="row text-start">
                <div class="col-6">
                  <button type="submit" id="btn-submit" class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" id="btn-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <circle cx="12" cy="12" r="9"></circle>
                      <path d="M9 12l2 2l4 -4"></path>
                    </svg>
                    <span id="btn-icon"></span>
                    <span id="btn-text">Simpan Data</span>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-xl">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-status-top bg-info"></div>
          <div class="card-body p-3">
            <div class="table-responsive">
              <table class="table table-hover" id="dataProvinsi" style="width: 100%;">
                <thead>
                  <tr>
                    <th style="padding: 15px !important" class="text-center fw-bold" width="7">No</th>
                    <th style="padding: 15px !important" class="text-left fw-bold">Nama Provinsi</th>
                    <th style="padding: 15px !important" class="text-center fw-bold" width="20">Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ubahProvinsiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content" style="background:#fafbfc !important">
      <form id="formUbahProvinsi" method="POST" onsubmit="return simpanPerubahanProvinsi();">
        <div class="modal-body pt-4 pb-2 px-4">
          <div class="text-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="45" height="45" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
            </svg>
            <h2 id="modal-title" class="mt-2">Edit Provinsi</h2>
          </div>
          <div class="mb-3">
            <label for="namaProvinsi" class="form-label required">Nama Provinsi</label>
            <input type="hidden" id="idProvinsiModal" name="id_provinsi">
            <input type="text" class="form-control" id="namaProvinsiModal" name="nama_provinsi">
          </div>
        </div>
        <div class="modal-footer" style="border-top: 0 solid #e6e7e9 !important">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <button type="button" class="btn btn-default w-100" data-bs-dismiss="modal">
                  Batalkan
                </button>
              </div>
              <div class="col">
                <button type="submit" id="btn-submit" class="btn btn-primary w-100">
                  <svg xmlns="http://www.w3.org/2000/svg" id="btn-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <path d="M9 12l2 2l4 -4"></path>
                  </svg>
                  <span id="btn-icon"></span>
                  <span id="btn-text">Update Perubahan</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteProvinsiModal" tabindex="-1" aria-modal="true" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-status bg-danger"></div>
      <div class="modal-body text-center py-4">
        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M12 9v4"></path>
          <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path>
          <path d="M12 16h.01"></path>
        </svg>
        <h3>Konfirmasi Penghapusan??</h3>
        <div class="text-secondary">Data provinsi yang sudah pernah digunakan tidak dapat dilakukan penghapusan. Harap konfirmasi kepada Super Administrator!!</div>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col">
              <a href="javascript::void" class="btn w-100" data-bs-dismiss="modal">
                Batalkan
              </a>
            </div>
            <div class="col">
              <a href="javascript::void" id="btn-delete-submit" class="btn btn-danger w-100" data-bs-dismiss="modal">
                <svg xmlns="http://www.w3.org/2000/svg" id="btn-delete-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <circle cx="12" cy="12" r="9"></circle>
                  <path d="M9 12l2 2l4 -4"></path>
                </svg>
                Hapus
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('layouts/admin/footer'); ?>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script>
  $(document).ready(function() {
    $('#dataProvinsi').DataTable({
      ordering: true,
      processing: true,
      serverSide: true,
      searching: true, // Aktifkan pencarian global
      ajax: {
        url: "<?php echo base_url('provinsi/json'); ?>",
        type: "POST",
        data: function(d) {
          d.nama_provinsi = $('#nama_provinsi_filter').val();
        }
      },
      columns: [{
          data: "0",
          className: "align-middle text-center"
        },
        {
          data: "1",
          className: "align-middle text-left"
        },
        {
          data: "2",
          className: "align-middle text-center"
        }
      ]
    });

    $('#nama_provinsi_filter').on('input', function() {
      $('#dataProvinsi').DataTable().ajax.reload();
    });

    $("#form-simpan").submit(function(e) {
      e.preventDefault();

      // Ambil data dari input
      var namaProvinsi = $("input[type='text']").val();

      // Kirim data ke controller dengan AJAX
      $.ajax({
        url: "<?php echo base_url('provinsi/simpan'); ?>",
        type: "POST",
        data: {
          nama_provinsi: namaProvinsi
        },
        dataType: "json",
        success: function(response) {
          if (response.status === "success") {
            $('#dataProvinsi').DataTable().ajax.reload();
            $("#nama_provinsi").val("");
            toastr.success('Provinsi Berhasil ditambahkan.'); // Menampilkan notifikasi success
          } else {
            toastr.error(response.message); // Menampilkan notifikasi error
          }
        }
      });
    });
  });

  function ubahProvinsi(link) {
    var id = link.getAttribute("data-id");
    var nama = link.getAttribute("data-nama");

    $('#idProvinsiModal').val(id); // Mengisi idProvinsi (input hidden)
    $('#namaProvinsiModal').val(nama);

    $('#ubahProvinsiModal').modal('show');
  }

  function simpanPerubahanProvinsi() {
    var idProvinsi = $('#idProvinsiModal').val();
    var namaProvinsiBaru = $('#namaProvinsiModal').val();

    // Menggunakan Ajax untuk mengirim data perubahan ke server
    $.ajax({
      url: '<?= base_url('provinsi/ubah/') ?>' + idProvinsi, // Gantilah URL_API_ANDA dengan URL API yang sesuai
      type: 'POST',
      dataType: 'json',
      data: {
        id_provinsi: idProvinsi,
        nama_provinsi: namaProvinsiBaru
      },
      success: function(response) {
        if (response.status === 'success') {
          $('#dataProvinsi').DataTable().ajax.reload();
          toastr.success('Provinsi Berhasil diubah.');
          $('#ubahProvinsiModal').modal('hide');
        } else {
          toastr.error(response.message);
        }
      },
      error: function() {
        alert('Terjadi kesalahan saat mengubah data provinsi.');
      },
    });

    // Mengembalikan false untuk mencegah form dikirim ulang
    return false;
  }

  function deleteProvinsi(link) {
    var idProvinsi = link.getAttribute("data-id");

    // Menampilkan modal konfirmasi penghapusan
    $('#deleteProvinsiModal').modal('show');

    // Menghapus event handler sebelum menambahkan yang baru
    $('#btn-delete-submit').off('click').on('click', function() {
      // Menutup modal
      $('#deleteProvinsiModal').modal('hide');

      // Ajax untuk menghapus data provinsi
      $.ajax({
        url: "<?php echo base_url('provinsi/delete/'); ?>" + idProvinsi,
        type: "POST",
        dataType: "json",
        success: function(response) {
          if (response.status === "success") {
            $('#dataProvinsi').DataTable().ajax.reload();
            toastr.success('Provinsi Berhasil dihapus.');
          } else {
            toastr.error(response.message);
          }
        },
        error: function(xhr, status, error) {
          // alert("Terjadi kesalahan: " + error);
          toastr.error("Tidak dapat melakukan penghapusan data ini.");
        }
      });
    });

    // Menangani klik pada tombol batal di dalam modal
    $('#btn-delete-abort').on('click', function() {
      // Menutup modal
      $('#deleteProvinsiModal').modal('hide');
    });
  }
</script>
</body>

</html>