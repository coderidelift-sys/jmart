<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
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
          Data Desa
        </h2>
      </div>
    </div>
    <div class="row align-items-center mt-3">
      <div class="col-12 col-md-12">
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
              Tambah Desa
            </h3>
          </div>
          <form method="POST" id="form-simpan">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold required">Pilih Provinsi</label>
                    <select required name="select_provinsi" id="select_provinsi" class="form-select">
                      <option disabled selected>Pilih Provinsi</option>
                      <?php foreach ($provinsi as $key => $prov) : ?>
                        <option value="<?= $prov['id_provinsi'] ?>"><?= $prov['nama_provinsi'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold required">Pilih Kabupaten</label>
                    <select required name="select_kabupaten" id="select_kabupaten" class="form-select">
                      <option selected disabled>Pilih Kabupaten</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold required">Pilih Kecamatan</label>
                    <select required name="select_kecamatan" id="select_kecamatan" class="form-select">
                      <option selected disabled>Pilih Kecamatan</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold required">Nama Desa</label>
                    <input required type="text" name="nama_desa" id="nama_desa" class="form-control" placeholder="Nama Desa">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold required">Ongkos Kirim</label>
                    <input required type="text" id="ongkos_kirim" name="ongkos_kirim" class="form-control" placeholder="Ongkos Kirim">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold required">Action</label>
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
                  </div>
                </div>
              </div>
            </div>
          </form>
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
              <table class="table table-hover text-nowrap" id="dataDesa" style="width: 100%;">
                <thead>
                  <tr>
                    <th width="7">No</th>
                    <th>Provinsi</th>
                    <th>Kabupaten</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Ongkos Kirim</th>
                    <th width="20">Action</th>
                  </tr>
                  <tr>
                    <th class="align-middle text-center">
                      #
                    </th>
                    <th>
                      <input type="text" class="form-control" placeholder="Provinsi" id="nama_provinsi_filter">
                    </th>
                    <th>
                      <input type="text" class="form-control" placeholder="Kabupaten" id="nama_kabupaten_filter">
                    </th>
                    <th>
                      <input type="text" class="form-control" placeholder="Kecamatan" id="nama_kecamatan_filter">
                    </th>
                    <th>
                      <input type="text" class="form-control" placeholder="Desa" id="nama_desa_filter">
                    </th>
                    <th class="align-middle text-center">
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

<div class="modal fade" id="ubahDesaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content" style="background:#fafbfc !important">
      <form id="formUbahDesa" method="POST" onsubmit="return simpanPerubahanDesa();">
        <div class="modal-body pt-4 pb-2 px-4" style="max-height: calc(100vh - 200px);overflow-y: auto;">
          <div class="text-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="45" height="45" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
            </svg>
            <h2 id="modal-title" class="mt-2">Edit Desa</h2>
          </div>
          <div class="mb-3">
            <label for="namaProvinsiModal" class="form-label required">Nama Provinsi</label>
            <input type="hidden" id="idDesaModal" name="id_desa">
            <input type="text" class="form-control" id="namaProvinsiModal" name="nama_provinsi" disabled>
          </div>
          <div class="mb-3">
            <label for="namaKabupatenModal" class="form-label required">Nama Kabupaten</label>
            <input type="text" class="form-control" id="namaKabupatenModal" name="nama_kabupaten" disabled>
          </div>
          <div class="mb-3">
            <label for="namaKabupatenModal" class="form-label required">Nama Kecamatan</label>
            <input type="text" class="form-control" id="namaKecamatanModal" name="nama_kecamatan" disabled>
          </div>
          <div class="mb-3">
            <label for="namaKabupatenModal" class="form-label required">Nama Desa</label>
            <input type="text" class="form-control" id="namaDesaModal" name="nama_desa">
          </div>
          <div class="mb-3">
            <label for="namaKabupatenModal" class="form-label required">Ongkos Kirim</label>
            <input type="text" class="form-control" id="ongkosKirimModal" name="ongkos_kirim">
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

<div class="modal fade" id="deleteDesaModal" tabindex="-1" aria-modal="true" role="dialog" aria-hidden="true">
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
        <div class="text-secondary">Data desa yang sudah pernah digunakan tidak dapat dilakukan penghapusan. Harap konfirmasi kepada Super Administrator!!</div>
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
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script>
  $(document).ready(function() {
    var choices_provinsi = new Choices(document.getElementById('select_provinsi'));
    var choices_kabupaten = new Choices(document.getElementById('select_kabupaten'));
    var choices_kecamatan = new Choices(document.getElementById('select_kecamatan'));

    $("#select_provinsi").on('change', function() {
      var provinsiId = $(this).val();
      choices_kabupaten.clearStore();
      choices_kecamatan.clearStore();

      $.ajax({
        url: "<?php echo base_url('akun/get_kabupaten'); ?>",
        method: "POST",
        data: {
          prov_id: provinsiId
        },
        dataType: "JSON",
        success: function(data) {
          // Membuat array kosong untuk menyimpan opsi
          var opsi = [];

          // Melakukan iterasi pada data yang diterima dari AJAX
          data.forEach(function(item) {
            // Membuat objek opsi dengan nilai dan label dari data
            var opsiItem = {
              value: item.id_kabupaten,
              label: item.nama_kabupaten
            };

            // Menambahkan objek opsi ke dalam array opsi
            opsi.push(opsiItem);
          });

          choices_kabupaten.setChoices(opsi, 'value', 'label');
        },
        error: function(request, status, error) {
          alert(request.responseText);
        }
      });
    });

    $("#select_kabupaten").on('change', function() {
      var kabupatenId = $(this).val();
      choices_kecamatan.clearStore();

      $.ajax({
        url: "<?php echo base_url('akun/get_kecamatan'); ?>",
        method: "POST",
        data: {
          kab_id: kabupatenId
        },
        dataType: "JSON",
        success: function(data) {
          // Membuat array kosong untuk menyimpan opsi
          var opsi = [];

          // Melakukan iterasi pada data yang diterima dari AJAX
          data.forEach(function(item) {
            // Membuat objek opsi dengan nilai dan label dari data
            var opsiItem = {
              value: item.id_kecamatan,
              label: item.nama_kecamatan
            };

            // Menambahkan objek opsi ke dalam array opsi
            opsi.push(opsiItem);
          });

          choices_kecamatan.setChoices(opsi, 'value', 'label');
        },
        error: function(request, status, error) {
          alert(request.responseText);
        }
      });
    });

    $('#dataDesa').DataTable({
      ordering: true,
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?php echo base_url('desa/json'); ?>",
        "type": "POST",
        data: function(d) {
          d.nama_provinsi = $('#nama_provinsi_filter').val();
          d.nama_kabupaten = $('#nama_kabupaten_filter').val();
          d.nama_kecamatan = $('#nama_kecamatan_filter').val();
          d.nama_desa = $('#nama_desa_filter').val();
        }
      },
      columns: [{
          data: "0",
          className: "text-center align-middle"
        },
        {
          data: "1",
          className: "text-left align-middle"
        },
        {
          data: "2",
          className: "text-left align-middle"
        },
        {
          data: "3",
          className: "text-left align-middle"
        },
        {
          data: "4",
          className: "text-left align-middle"
        },
        {
          data: "5",
          className: "text-center align-middle"
        },
        {
          data: "6",
          className: "text-center align-middle"
        }
      ]
    });

    $('#form-simpan').submit(function(e) {
      e.preventDefault(); // Mencegah form dari pengiriman biasa
      var selectKecamatan = $('#select_kecamatan').val();
      var namaDesa = $('#nama_desa').val();
      var ongkos = $('#ongkos_kirim').val();

      // Kirim data ke controller dengan Ajax
      $.ajax({
        url: '<?= base_url('desa/simpan') ?>', // Gantilah 'URL_API_ANDA' sesuai dengan URL API Anda
        type: 'POST',
        data: {
          select_kecamatan: selectKecamatan,
          nama_desa: namaDesa,
          ongkos_kirim: ongkos
        },
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            $('#nama_desa').val('');
            $('#ongkos_kirim').val('');
            $('#dataDesa').DataTable().ajax.reload();
            toastr.success('Desa Berhasil ditambahkan.');
          } else {
            // Gagal menyimpan data, Anda dapat menambahkan logika atau tindakan lain di sini
            toastr.error(response.message);
          }
        }
      });
    });

    $('#nama_provinsi_filter').on('input', function() {
      $('#dataDesa').DataTable().ajax.reload();
    });

    $('#nama_kabupaten_filter').on('input', function() {
      $('#dataDesa').DataTable().ajax.reload();
    });

    $('#nama_kecamatan_filter').on('input', function() {
      $('#dataDesa').DataTable().ajax.reload();
    });

    $('#nama_desa_filter').on('input', function() {
      $('#dataDesa').DataTable().ajax.reload();
    });

    $('#resetInput').on('click', function() {
      $('#nama_desa').val(''); // Mengatur ulang nilai input namaProvinsi
      $('#ongkos_kirim').val(''); // Mengatur ulang nilai input namaProvinsi
    });
  });

  function ubahDesa(link) {
    var id = link.getAttribute("data-id");
    var nama = link.getAttribute("data-nama");
    var provinsi = link.getAttribute("data-provinsi");
    var kabupaten = link.getAttribute("data-kabupaten");
    var kecamatan = link.getAttribute("data-kecamatan");
    var ongkos = link.getAttribute("data-ongkos");

    $('#namaProvinsiModal').val(provinsi);
    $('#namaKabupatenModal').val(kabupaten);
    $('#namaKecamatanModal').val(kecamatan);

    $('#idDesaModal').val(id); // Mengisi idProvinsi (input hidden)
    $('#namaDesaModal').val(nama);
    $('#ongkosKirimModal').val(ongkos);

    $('#ubahDesaModal').modal('show');
  }

  function simpanPerubahanDesa() {
    var idDesa = $('#idDesaModal').val();
    var namaDesaBaru = $('#namaDesaModal').val();
    var ongkosKirimBaru = $('#ongkosKirimModal').val();

    // Menggunakan Ajax untuk mengirim data perubahan ke server
    $.ajax({
      url: '<?= base_url('desa/ubah') ?>', // Gantilah URL_API_ANDA dengan URL API yang sesuai
      type: 'POST',
      dataType: 'json',
      data: {
        id_desa: idDesa,
        nama_desa: namaDesaBaru,
        ongkos: ongkosKirimBaru
      },
      success: function(response) {
        if (response.status === 'success') {
          $('#dataDesa').DataTable().ajax.reload();
          toastr.success('Desa Berhasil diubah.');
          $('#ubahDesaModal').modal('hide');
        } else {
          toastr.error(response.message);
        }
      },
      error: function() {
        alert('Terjadi kesalahan saat mengubah data desa.');
      },
    });

    // Mengembalikan false untuk mencegah form dikirim ulang
    return false;
  }

  function deleteDesa(link) {
    var idDesa = link.getAttribute("data-id");

    // Menampilkan modal konfirmasi penghapusan
    $('#deleteDesaModal').modal('show');

    // Menghapus event handler sebelum menambahkan yang baru
    $('#btn-delete-submit').off('click').on('click', function() {
      // Menutup modal
      $('#deleteDesaModal').modal('hide');

      // Ajax untuk menghapus data Desa
      $.ajax({
        url: "<?php echo base_url('desa/delete/'); ?>" + idDesa,
        type: "POST",
        dataType: "json",
        success: function(response) {
          if (response.status === "success") {
            $('#dataDesa').DataTable().ajax.reload();
            toastr.success('Desa Berhasil dihapus.');
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
      $('#deleteDesaModal').modal('hide');
    });
  }
</script>

</html>