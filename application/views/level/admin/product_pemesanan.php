<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
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

  /* .select2-container .select2-selection--single .select2-selection__rendered {
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
  } */

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

  .disabled-link {
    pointer-events: none;
    cursor: not-allowed;
    color: grey;
  }
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Data Pemesanan Barang
        </h2>
      </div>
    </div>
    <div class="row align-items-center mt-3">
      <div class="col">
        <div class="btn-group">
          <a href="<?= base_url('product/pemesanan/add') ?>" class="btn btn-primary me-1" title="Kelola Tagihan">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M12 5l0 14"></path>
              <path d="M5 12l14 0"></path>
            </svg>
            Tambah
          </a>
          <a href="#" class="btn btn-secondary me-1" title="Lihat Diskon Tagihan">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
              <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3"></path>
            </svg>
            Import
          </a>
          <a href="#" class="btn btn-success" title="Lihat Diskon Tagihan">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-spreadsheet" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
              <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
              <path d="M8 11h8v7h-8z"></path>
              <path d="M8 15h8"></path>
              <path d="M11 11v7"></path>
            </svg>
            Export
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-xl">
    <div class="row mb-3">
      <div class="col-sm-12 col-md-3 mb-2">
        <div class="card bg-secondary">
          <div class="card-stamp">
            <div class="card-stamp-icon bg-white text-secondary">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="3" y="5" width="18" height="14" rx="3"></rect>
                <line x1="3" y1="10" x2="21" y2="10"></line>
                <line x1="7" y1="15" x2="7.01" y2="15"></line>
                <line x1="11" y1="15" x2="13" y2="15"></line>
              </svg>
            </div>
          </div>
          <div class="card-body">
            Total Pemesanan
            <h2>
              <?= $this->db->count_all('tb_pemesanan'); ?>
            </h2>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-3 mb-2">
        <div class="card bg-azure text-white">
          <div class="card-stamp">
            <div class="card-stamp-icon bg-white text-red">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="3" y="5" width="18" height="14" rx="3"></rect>
                <line x1="3" y1="10" x2="21" y2="10"></line>
                <line x1="7" y1="15" x2="7.01" y2="15"></line>
                <line x1="11" y1="15" x2="13" y2="15"></line>
              </svg>
            </div>
          </div>
          <div class="card-body">
            Dalam Proses Pemesanan
            <h2><?= $this->db->where('status_pemesanan', 'Open')->count_all_results('tb_pemesanan') ?></h2>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-3 mb-2">
        <div class="card bg-red text-white">
          <div class="card-stamp">
            <div class="card-stamp-icon bg-white text-azure">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="3" y="5" width="18" height="14" rx="3"></rect>
                <line x1="3" y1="10" x2="21" y2="10"></line>
                <line x1="7" y1="15" x2="7.01" y2="15"></line>
                <line x1="11" y1="15" x2="13" y2="15"></line>
              </svg>
            </div>
          </div>
          <div class="card-body">
            Belum Lunas
            <h2><?= $this->db->where('status_pembayaran', 'Belum Lunas')->count_all_results('tb_pemesanan') ?></h2>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-3 mb-2">
        <div class="card bg-warning text-white">
          <div class="card-stamp">
            <div class="card-stamp-icon bg-white text-green">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="3" y="5" width="18" height="14" rx="3"></rect>
                <line x1="3" y1="10" x2="21" y2="10"></line>
                <line x1="7" y1="15" x2="7.01" y2="15"></line>
                <line x1="11" y1="15" x2="13" y2="15"></line>
              </svg>
            </div>
          </div>
          <div class="card-body">
            Pemesanan Bulan Ini
            <h2><?= $this->db->where('MONTH(created_by)', date('m'))->where('YEAR(created_by)', date('Y'))->count_all_results('tb_pemesanan') ?></h2>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="accordion bg-white mb-3">
          <div class="accordion-item">
            <div class="accordion-header">
              <h2 class="accordion-button" data-bs-toggle="collapse" data-bs-target="#tab-filter" aria-expanded="true" style="cursor: pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M5.5 5h13a1 1 0 0 1 .5 1.5l-5 5.5l0 7l-4 -3l0 -4l-5 -5.5a1 1 0 0 1 .5 -1.5"></path>
                </svg>
                Filter Data
              </h2>
            </div>
            <div id="tab-filter" class="accordion-collapse collapse">
              <div class="accordion-body pt-0">
                <form id="filter-form" action="javascript:void(0)">
                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <label class="form-label">Status Pesanan</label>
                      <select style="width: 100% !important;" name="status_pemesanan_filter" id="status_pemesanan_filter" class="form-select js-example-basic-single">
                        <option value="">Pilih Status</option>
                        <option value="Open">Belum Diterima</option>
                        <option value="Received">Sudah Diterima</option>
                      </select>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label">Status Pembayaran</label>
                      <select style="width: 100% !important;" name="status_pembayaran_filter" id="status_pembayaran_filter" class="form-select js-example-basic-single">
                        <option value="" selected>Pilih Status</option>
                        <option value="Belum Lunas">Belum Lunas</option>
                        <option value="Lunas">Lunas</option>
                      </select>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label">Supplier</label>
                      <select style="width:100% !important" name="nama_supplier_filter" id="nama_supplier_filter" class="form-select js-example-basic-single">
                        <option value="" selected>Pilih Pemasok</option>
                        <?php foreach ($supplier as $key => $value) : ?>
                          <option value="<?= $value['id_supplier'] ?>"><?= $value['nama_supplier'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-status-top bg-info"></div>
          <div class="card-body p-3">
            <div class="table-responsive" style="min-height: 500px;">
              <table class="table table-hover" id="dataPemesanan" style="width: 100%;">
                <thead>
                  <tr>
                    <th width="7">No</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Diterima</th>
                    <th>Pemasok</th>
                    <th>Jumlah</th>
                    <th>Status Transaksi</th>
                    <th>Status Pembayaran</th>
                    <th width="20">Action</th>
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

<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formUbahStatus" method="POST" onsubmit="return simpanPerubahanStatus();">
        <div class="modal-body pt-4 pb-2 px-4">
          <div class="text-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="45" height="45" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
            </svg>
            <h2 id="modal-title" class="mt-2">Edit Status Pembayaran</h2>
          </div>
          <div class="form-group">
            <label for="selectPembayaranModal">Pilih Status Pembayaran:</label>
            <input type="hidden" id="idPemesananModal">
            <select class="form-select" id="selectPembayaranModal" name="selectPembayaranModal">
							<option value="">Pilih Status</option>
              <option value="Lunas">Lunas</option>
              <option value="Belum Lunas">Belum Lunas</option>
            </select>
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
                <button type="submit" id="btn-submit" class="btn btn-primary w-100" data-loading>
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


<div class="modal fade" id="deletePemesananModal" tabindex="-1" aria-modal="true" role="dialog" aria-hidden="true">
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
        <div class="text-secondary">Data pemesanan yang sudah selesai tidak dapat dilakukan penghapusan. Harap konfirmasi kepada Super Administrator!!</div>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.js-example-basic-single').select2({
      theme: 'bootstrap-5'
    });

    $('#dataPemesanan').DataTable({
      ordering: true,
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?php echo base_url('product/json_pemesanan'); ?>",
        "type": "POST",
        data: function(d) {
          d.nama_supplier = $('#nama_supplier_filter').val();
          d.status_pemesanan = $('#status_pemesanan_filter').val();
          d.status_pembayaran = $('#status_pembayaran_filter').val();
        }
      },
      columns: [{
          data: "0",
          className: "text-center"
        },
        {
          data: "1",
          className: "text-left dt-nowrap align-middle"
        },
        {
          data: "2",
          className: "text-left dt-nowrap align-middle"
        },
        {
          data: "3",
          className: "text-left dt-nowrap"
        },
        {
          data: "4",
          className: "text-center"
        },
        {
          data: "5",
          className: "text-center align-middle"
        },
        {
          data: "6",
          className: "text-center align-middle"
        }, {
          data: "7",
          className: "text-center"
        }
      ]
    });

    $('#nama_supplier_filter').on('input', function() {
      $('#dataPemesanan').DataTable().ajax.reload();
    });

    $('#status_pemesanan_filter').on('change', function() {
      $('#dataPemesanan').DataTable().ajax.reload();
    });

    $('#status_pembayaran_filter').on('change', function() {
      $('#dataPemesanan').DataTable().ajax.reload();
    });
  });

  function ubahStatus(link) {
    var id = link.getAttribute("data-id");
    var pembayaran = link.getAttribute("data-pembayaran");

    $('#idPemesananModal').val(id);
    $('#selectPembayaranModal').val(pembayaran);

    $('#statusModal').modal('show');
  }

  function simpanPerubahanStatus() {
    var idPemesanan = $('#idPemesananModal').val();
    var selectPembayaranBaru = $('#selectPembayaranModal').val();

    // Menggunakan Ajax untuk mengirim data perubahan ke server
    $.ajax({
      url: '<?= base_url('product/ubah_pemesanan') ?>', // Gantilah URL_API_ANDA dengan URL API yang sesuai
      type: 'POST',
      dataType: 'json',
      data: {
        id_pemesanan: idPemesanan,
        pembayaran: selectPembayaranBaru,
      },
      success: function(response) {
        if (response.status === 'success') {
          $('#dataPemesanan').DataTable().ajax.reload();
          toastr.success('Status Berhasil diubah.');
          $('#statusModal').modal('hide');
        } else {
          alert('Gagal menghapus data pemesanan.');
        }
      },
			beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

      error: function() {
        alert('Terjadi kesalahan saat mengubah data satuan.');
      },
    });

    // Mengembalikan false untuk mencegah form dikirim ulang
    return false;
  }

  function deletePemesanan(link) {
    var idPemesanan = link.getAttribute("data-id");

    // Menampilkan modal konfirmasi penghapusan
    $('#deletePemesananModal').modal('show');

    // Menghapus event handler sebelum menambahkan yang baru
    $('#btn-delete-submit').off('click').on('click', function() {
      // Menutup modal
      $('#deletePemesananModal').modal('hide');

      // Ajax untuk menghapus data Kategori
      $.ajax({
        url: "<?php echo base_url('product/delete_pemesanan/'); ?>" + idPemesanan,
        type: "POST",
        dataType: "json",
        success: function(response) {
          if (response.status === "success") {
            $('#dataPemesanan').DataTable().ajax.reload();
            toastr.success('Pemesanan Berhasil dibatalkan.');
          } else {
            toastr.error(response.message);
          }
        },
				beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
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
