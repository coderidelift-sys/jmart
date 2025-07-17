<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css" />
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
                    Stock Opname
                </h2>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <div class="btn-group">
                    <a href="javascript::void" data-bs-toggle="modal" data-bs-target="#modalTambah" class="btn btn-primary me-1" title="Kelola Tagihan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Tambah
                    </a>
                    <a href="http://localhost/auth/product/import" class="btn btn-secondary me-1" title="Lihat Diskon Tagihan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3"></path>
                        </svg>
                        Import
                    </a>
                    <a href="#" class="btn btn-success me-1" title="Lihat Diskon Tagihan">
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
                        Total Stock Opname
                        <h2>
                            <?php
                            $total_opname = $this->db->count_all('tb_opname');
                            echo $total_opname;
                            ?>
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
                        Total Opname Fisik
                        <h2><?= $this->db->where('tipe_opname', 'Stock Opname')->count_all_results('tb_opname') ?></h2>
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
                        Total Opname Spoil
                        <h2><?= $this->db->where('tipe_opname', 'Spoil / Barang Rusak')->count_all_results('tb_opname') ?></h2>
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
                        Opname Belum Diproses
                        <h2><?= $this->db->where('status_opname', '0')->count_all_results('tb_opname') ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-status-top bg-info"></div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataStock" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Stock Opname</th>
                                        <th>Tanggal</th>
                                        <th>Tipe</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            <input type="text" name="nama_filter" id="nama_filter" class="form-control" placeholder="Nama Stock Opname">
                                        </th>
                                        <th>
                                            <input type="date" name="tanggal_filter" id="tanggal_filter" class="form-control" placeholder="Tanggal Opname">
                                        </th>
                                        <th>
                                            <select name="status_filter" id="status_filter" class="form-control">
                                                <option value="">-- Pilih Tipe Opname --</option>
                                                <option value="Stock Opname">Stock Opname</option>
                                                <option value="Spoil / Barang Rusak">Barang Rusak</option>
                                            </select>
                                        </th>
                                        <th>#</th>
                                        <th>
                                            <select class="form-control" name="offon" id="offon">
                                                <option value="">-- Pilih Status Opname --</option>
                                                <option value="0">Terbuka</option>
                                                <option value="1">Terkunci</option>
                                            </select>
                                        </th>
                                        <th>#</th>
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

<div class="modal" id="modalTambah">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="background:#fafbfc !important">
            <form action="<?= base_url('product/opname/simpan') ?>" method="POST" onsubmit="return confirm('Yakin ingin melanjutkan?')">
                <div class="modal-body pt-4 pb-2 px-4" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <div class="text-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="45" height="45" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
                        </svg>
                        <h2 id="modal-title" class="mt-2">Tambah Opname</h2>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="form-label required">Tanggal Opname</label>
                                <input required name="tgl_opname" id="tgl_opname" type="datetime-local" class="form-control" value="<?php echo date('Y-m-d\TH:i'); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <label class="form-label required">Nama Opname</label>
                                <textarea required name="nama_opname" id="nama_opname" class="form-control" rows="3" placeholder="Masukan Nama Opname"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <label class="form-label required">Pilih Status</label>
                                <select name="tipe_opname" id="tipe_opname" class="form-control" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Stock Opname">Stock Opname</option>
                                    <option value="Spoil / Barang Rusak">Spoil / Barang Rusak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <label class="form-label required">Catatan</label>
                                <textarea required name="catatan_opname" id="catatan_opname" class="form-control" rows="3" placeholder="Masukan Catatan"></textarea>
                            </div>
                        </div>
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

<?php $this->load->view('layouts/admin/footer'); ?>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#dataStock').DataTable({
        ordering: false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('product/opname/json'); ?>",
            "type": "POST",
            data: function(d) {
                d.nama = $('#nama_filter').val();
                d.tgl = $('#tanggal_filter').val();
                d.status = $('#status_filter').val();
                d.offon = $('#offon').val();
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
                className: "text-center align-middle"
            },
            {
                data: "5",
                className: "text-left align-middle"
            },
            {
                data: "6",
                className: "text-center align-middle"
            },
        ]
    });

    $('#nama_filter').on('input', function() {
        $('#dataStock').DataTable().ajax.reload();
    });

    $('#status_filter').on('change', function() {
        $('#dataStock').DataTable().ajax.reload();
    });

    $('#tanggal_filter').on('change', function() {
        $('#dataStock').DataTable().ajax.reload();
    });

    $('#offon').on('change', function() {
        $('#dataStock').DataTable().ajax.reload();
    });

    function confirmDelete(id) {
        // Tampilkan SweetAlert2 konfirmasi
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin ingin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            // Jika pengguna mengonfirmasi
            if (result.isConfirmed) {
                // Lakukan penghapusan menggunakan AJAX
                $.ajax({
                    url: "<?php echo base_url('product/opname/delete/'); ?>" + id,
                    type: "POST",
                    success: function(response) {
                        if (response.success == true) {
                            Swal.fire('Terhapus!', response.msg, 'success');
                            $('#dataStock').DataTable().ajax.reload();
                        } else {
                            Swal.fire('Error!', response.msg, 'error');
                        }
                    },
					beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                    error: function() {
                        Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
                    }
                });
            }
        });
    }
</script>
</body>

</html>
