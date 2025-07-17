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
          Data Kategori Barang
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
              Tambah Kategori
            </h3>
          </div>
          <div class="card-body">
            <form id="form-simpan" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label fw-bold required">Nama Kategori</label>
                <div>
                  <input required type="text" class="form-control" aria-describedby="emailHelp" placeholder="Nama Kategori" id="nama_kategori" id="nama_kategori">
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold required">Gambar Kategori</label>
                <div>
                  <input type="file" class="form-control" aria-describedby="emailHelp" placeholder="Icon Kategori" id="icon_kategori" name="icon_kategori">
                </div>
              </div>
              <div class="row">
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
              <table class="table table-sm table-hover" id="dataKategori" style="width: 100%;">
                <thead>
                  <tr>
                    <th class="text-center" width="7">No</th>
                    <th class="text-center">#</th>
                    <th class="text-left">Nama Kategori</th>
                    <th class="text-left">Digunakan Pada</th>
                    <th class="text-center" width="20">Action</th>
                  </tr>
                  <tr>
                    <th class="align-middle text-center">
                      #
                    </th>
                    <th class="align-middle text-center">
                      #
                    </th>
                    <th>
                      <input type="text" class="form-control" placeholder="Nama Kategori" id="nama_kategori_filter">
                    </th>
                    <th class="align-middle text-left">
                      #
                    </th>
                    <th class="align-middle text-center">
                      #
                    </th>
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

<div class="modal fade" id="ubahKategoriModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content" style="background:#fafbfc !important">
      <form id="formUbahKategori" method="POST" onsubmit="return simpanPerubahanKategori();" enctype="multipart/form-data">
        <div class="modal-body pt-4 pb-2 px-4">
          <div class="text-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="45" height="45" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
            </svg>
            <h2 id="modal-title" class="mt-2">Edit Kategori</h2>
          </div>
          <div class="mb-3">
            <label for="namaKategori" class="form-label">Nama Kategori</label>
            <input type="hidden" id="idKategoriModal" name="id_kategori">
            <input type="hidden" id="iconKategoriOldModal" name="gambar_lama">
            <input type="text" class="form-control" id="namaKategoriModal" name="nama_kategori">
          </div>
          <div class="mb-3">
            <label for="namaKategori" class="form-label">Gambar Kategori</label>
            <input type="file" class="form-control" id="iconKategoriModal" name="icon_kategori">
          </div>
        </div>
        <div class="modal-footer" style="border-top: 0 solid #e6e7e9 !important">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <button type="button" class="btn w-100" data-bs-dismiss="modal">
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

<div class="modal fade" id="deleteKategoriModal" tabindex="-1" aria-modal="true" role="dialog" aria-hidden="true">
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
        <div class="text-secondary">Data kategori yang sudah pernah digunakan tidak dapat dilakukan penghapusan. Harap konfirmasi kepada Super Administrator!!</div>
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
    $('#dataKategori').DataTable({
      ordering: true,
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?php echo base_url('kategori/json'); ?>",
        "type": "POST",
        data: function(d) {
          d.nama_kategori = $('#nama_kategori_filter').val();
        }
      },
      columns: [{
          data: "0",
          className: "align-middle text-center"
        },
        {
          data: "1",
          className: "align-middle text-center"
        },
        {
          data: "2",
          className: "align-middle text-left"
        },
        {
          data: "3",
          className: "align-middle text-left"
        },
        {
          data: "4",
          className: "align-middle text-center"
        }
      ]
    });

    $("#form-simpan").submit(function(e) {
      e.preventDefault();

      // Buat objek FormData untuk mengirim data
      var formData = new FormData();

      // Ambil data dari input
      var namaKategori = $("#nama_kategori").val();
      formData.append("nama_kategori", namaKategori);

      var iconKategori = $("#icon_kategori")[0].files[0];

      // Periksa jika iconKategori tidak kosong
      if (iconKategori !== undefined) {
        formData.append("icon_kategori", iconKategori);
      }

      // Kirim data ke controller dengan AJAX
      $.ajax({
        url: "<?php echo base_url('kategori/simpan'); ?>",
        type: "POST",
        data: formData,
        contentType: false, // Diperlukan untuk FormData
        processData: false, // Diperlukan untuk FormData
        dataType: "json",
        success: function(response) {
          if (response.status === "success") {
            $('#dataKategori').DataTable().ajax.reload();
            $("#nama_kategori").val("");
            $("#icon_kategori").val("");
            toastr.success('Kategori Berhasil ditambahkan.'); // Menampilkan notifikasi success
          } else {
            toastr.error(response.message); // Menampilkan notifikasi error
          }
        }
      });
    });

    $('#nama_kategori_filter').on('input', function() {
      $('#dataKategori').DataTable().ajax.reload();
    });
  });

  function ubahKategori(link) {
    var id = link.getAttribute("data-id");
    var nama = link.getAttribute("data-nama");
    var icon = link.getAttribute("data-icon");

    $('#idKategoriModal').val(id); // Mengisi idKategori (input hidden)
    $('#namaKategoriModal').val(nama);
    $('#iconKategoriOldModal').val(icon);

    $('#ubahKategoriModal').modal('show');
  }

  function simpanPerubahanKategori() {
    var idKategori = $('#idKategoriModal').val();
    var namaKategoriBaru = $('#namaKategoriModal').val();
    var iconKategoriBaru = $("#iconKategoriModal")[0].files[0];
    var gambarLama = $("#iconKategoriOldModal").val();

    // Buat objek FormData untuk mengirim data formulir, termasuk file gambar
    var formData = new FormData();
    formData.append('id_kategori', idKategori);
    formData.append('nama_kategori', namaKategoriBaru);
    formData.append('icon_kategori', iconKategoriBaru);
    formData.append('gambar_lama', gambarLama);

    // Menggunakan Ajax untuk mengirim data perubahan ke server
    $.ajax({
      url: '<?= base_url('kategori/ubah') ?>', // Gantilah URL_API_ANDA dengan URL API yang sesuai
      type: 'POST',
      dataType: 'json',
      data: formData,
      contentType: false, // Diperlukan untuk FormData
      processData: false, // Diperlukan untuk FormData
      success: function(response) {
        if (response.status === 'success') {
          $('#dataKategori').DataTable().ajax.reload();
          toastr.success('Kategori Berhasil diubah.');
          $('#ubahKategoriModal').modal('hide');
        } else {
          toastr.error(response.message);
        }
      },
      error: function(xhr, status, error) {
        alert(xhr.responseText);
      },
    });

    // Mengembalikan false untuk mencegah form dikirim ulang
    return false;
  }

  function deleteKategori(link) {
    var idKategori = link.getAttribute("data-id");

    // Menampilkan modal konfirmasi penghapusan
    $('#deleteKategoriModal').modal('show');

    // Menghapus event handler sebelum menambahkan yang baru
    $('#btn-delete-submit').off('click').on('click', function() {
      // Menutup modal
      $('#deleteKategoriModal').modal('hide');

      // Ajax untuk menghapus data Kategori
      $.ajax({
        url: "<?php echo base_url('kategori/delete/'); ?>" + idKategori,
        type: "POST",
        dataType: "json",
        success: function(response) {
          if (response.status === "success") {
            $('#dataKategori').DataTable().ajax.reload();
            toastr.success('Kategori Berhasil dihapus.');
          } else {
            toastr.error(response.message);
          }
        },
        error: function(xhr, status, error) {
          toastr.error("Tidak dapat melakukan penghapusan data ini.");
        }
      });
    });

    // Menangani klik pada tombol batal di dalam modal
    $('#btn-delete-abort').on('click', function() {
      // Menutup modal
      $('#deleteKategoriModal').modal('hide');
    });
  }
</script>
</body>

</html>