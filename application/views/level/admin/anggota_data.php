<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<style>
    .bg-gradient-info {
        background: #17a2b8 linear-gradient(180deg, #3ab0c3, #17a2b8) repeat-x !important;
        color: #fff;
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

    #loading {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 9999;
    }

    #loading::after {
        content: 'Loading...';
        display: block;
        text-align: center;
        color: #333;
        font-weight: bold;
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

    .bg-lime {
        color: #ffffff !important;
        background: #74b816 !important;
    }

    h6 {
        font-size: 1rem;
        margin-bottom: .5rem;
        font-weight: 500;
        line-height: 1.2;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 0.5rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, .125);
    }

    hr {
        box-sizing: content-box;
        height: 0;
        overflow: visible;
    }

    #loading {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 9999;
    }

    #loading::after {
        content: 'Loading...';
        display: block;
        text-align: center;
        color: #333;
        font-weight: bold;
    }
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div id="loading" style="display: none;"></div>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Data Anggota
                </h2>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <div class="btn-group">
                    <a data-bs-toggle="modal" data-bs-target="#tambahUserModal" href="#" class="btn btn-primary me-1" title="Kelola Tagihan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Tambah
                    </a>
                    <a data-bs-toggle="modal" data-bs-target="#excelUploadModal" href="javascript::void" class="btn btn-secondary me-1" title="Lihat Diskon Tagihan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3"></path>
                        </svg>
                        Import
                    </a>
                    <a href="#" class="btn btn-success me-1" title="Lihat Diskon Tagihan" onclick="confirmExport()">
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
        <div class="row">
            <div class="col-sm-12">

                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>

                <?php
                // Ambil flash data jumlahSukses dan jumlahError
                $jumlahSukses = $this->session->flashdata('jumlahSukses');
                $jumlahError = $this->session->flashdata('jumlahError');

                // Tampilkan alert jika ada flash data jumlahSukses atau jumlahError
                if ($jumlahSukses !== null || $jumlahError !== null) {
                    echo '<div class="alert alert-dismissible';

                    // Tentukan kelas warna berdasarkan jumlahSukses atau jumlahError
                    if ($jumlahSukses !== null) {
                        echo ' alert-success">';
                        echo 'Jumlah sukses: ' . $jumlahSukses . '. ';
                    } else {
                        // Tambahkan kelas warna alert-danger jika terdapat jumlahError
                        echo ' alert-danger">';
                    }

                    if ($jumlahError !== null) {
                        echo 'Jumlah error: ' . $jumlahError . '. ';
                    }

                    // Tambahkan tombol close
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                ?>
                <div class="card">
                    <div class="card-status-top bg-info"></div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataAnggota" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="7" class="fw-bold">No</th>
                                        <th class="fw-bold">Nama Member</th>
                                        <th class="fw-bold">WA</th>
                                        <th class="fw-bold">NIK</th>
                                        <th class="fw-bold">Foto Profil</th>
                                        <th class="fw-bold">Status</th>
                                        <th class="fw-bold">Total Belanja</th>
                                        <th class="fw-bold">Total Autodebit</th>
                                        <th class="fw-bold"># Rentang Tanggal #</th>
                                        <th class="fw-bold">Action</th>
                                    </tr>
                                    <tr>
                                        <th class="align-middle text-center">
                                            #
                                        </th>
                                        <th>
                                            <input style="border-radius: 0px !important;" type="text" class="form-control" placeholder="Nama Member" id="nama_member_filter">
                                        </th>
                                        <th>
                                            <input style="border-radius: 0px !important;" type="text" class="form-control" placeholder="No. HP" id="wa_member_filter">
                                        </th>
                                        <th>
                                            <input style="border-radius: 0px !important;" type="text" class="form-control" placeholder="Nomor Induk" id="nomor_induk_filter">
                                        </th>
                                        <th class="align-middle text-center">
                                            #
                                        </th>
                                        <th class="align-middle text-center">
                                            <select style="border-radius: 0px !important;" name="filter" id="filter" class="form-select">
                                                <option value="">-- Filter --</option>
                                                <option value="Y">Aktif</option>
                                                <option value="N">Tidak</option>
                                            </select>
                                        </th>
                                        <th class="align-middle text-center">
                                            <select style="border-radius: 0px !important;" id="select_tahun" class="form-select">
                                                <?php
                                                $tahun_ini = date('Y');
                                                for ($i = $tahun_ini; $i >= $tahun_ini - 4; $i--) {
                                                    echo "<option value='$i'";
                                                    if ($i == $tahun_ini) {
                                                        echo " selected"; // Menandai tahun ini sebagai opsi yang aktif
                                                    }
                                                    echo ">$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </th>
                                        <th class="align-middle text-left">
                                            #
                                        </th>
                                        <th class="align-middle text-left">
                                            <input type="text" class="form-control" id="tanggal_range" name="tanggal_range" placeholder="Pilih Rentang Tanggal" style="width:200px">
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

<!-- Modal -->
<div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background:#fafbfc !important">
            <form id="tambahUserForm" enctype="multipart/form-data">
                <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <div class="text-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="45" height="45" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
                        </svg>
                        <h2 id="modal-title" class="mt-2">Tambah Anggota</h2>
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required placeholder="Masukkan username...">
                        <small>** Inputan Harus Unik / Berbeda dengan yang lain!</small>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password...">
                        <small>* Password Default 123</small>
                    </div>

                    <!-- Nama Member -->
                    <div class="mb-3">
                        <label for="nama_member" class="form-label">Nama Member</label>
                        <input type="text" class="form-control" id="nama_member" name="nama_member" required placeholder="Masukkan nama member...">
                    </div>

                    <!-- Email Member -->
                    <div class="mb-3">
                        <label for="email_member" class="form-label">Email Member</label>
                        <input type="email" class="form-control" id="email_member" name="email_member" required placeholder="Masukkan email member...">
                    </div>

                    <!-- WA Member -->
                    <div class="mb-3">
                        <label for="wa_member" class="form-label">WhatsApp Member</label>
                        <input type="tel" class="form-control" id="wa_member" name="wa_member" placeholder="Masukkan nomor WhatsApp member...">
                    </div>

                    <!-- Nomor Induk -->
                    <div class="mb-3">
                        <label for="nomor_induk" class="form-label">Nomor Induk</label>
                        <input type="text" class="form-control" id="nomor_induk" name="nomor_induk" placeholder="Masukkan nomor induk...">
                    </div>

                    <!-- Departemen (Dept) -->
                    <div class="mb-3">
                        <label for="dept" class="form-label">Departemen</label>
                        <input type="text" class="form-control" id="dept" name="dept" placeholder="Masukkan departemen...">
                    </div>

                    <!-- Level -->
					 <input type="hidden" name="level" value="User">
                    <!-- <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <input type="text" class="form-control" id="level" name="level" placeholder="Masukkan level...">
                    </div> -->

                    <!-- Tanggal Lahir -->
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Pilih tanggal lahir...">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" placeholder="Pilih jenis kelamin...">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Avatar -->
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" placeholder="Pilih avatar...">
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
                                <button type="submit" class="btn btn-success w-100" data-loading>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="btn-delete-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <path d="M9 12l2 2l4 -4"></path>
                                    </svg>
                                    <span id="btn-delete-icon" class="spinner-border spinner-border-sm me-2" style="display: none"></span>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL -->

<!-- MODAL IMPORT -->
<div class="modal fade" id="excelUploadModal" tabindex="-1" aria-labelledby="excelUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('anggota/import_data') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="45" height="45" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
                        </svg>
                        <h2 id="modal-title" class="mt-2">Import Anggota</h2>
                    </div>
                    <div class="mb-3">
                        <label for="excelFile" class="form-label">Choose Excel File</label>
                        <input type="file" class="form-control" id="excelFile" name="excelFile" accept=".xlsx, .xls">
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
                                <button type="submit" class="btn btn-success w-100" data-loading>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="btn-delete-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <path d="M9 12l2 2l4 -4"></path>
                                    </svg>
                                    <span id="btn-delete-icon" class="spinner-border spinner-border-sm me-2" style="display: none"></span>
                                    Import Anggota
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END -->

<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="myModalLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background:#fafbfc !important">
            <div class="modal-body pt-4 pb-2 px-4" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                <div class="text-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="45" height="45" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
                    </svg>
                    <h2 id="modal-title" class="mt-2">Preview Anggota</h2>
                </div>
                <div id="kontenPreview">

                </div>
            </div>
            <div class="modal-footer" style="border-top: 0 solid #e6e7e9 !important">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">
                                Batalkan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUbah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-update-user">
                <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <div class="text-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="45" height="45" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
                        </svg>
                        <h2 id="modal-title" class="mt-2">Ubah Anggota</h2>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="hidden" id="id_edit" name="id_user" value="">
                        <input type="text" class="form-control" id="username_edit" name="username" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" id="password_edit" name="password" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Member</label>
                        <input type="text" class="form-control" id="nama_member_edit" name="nama_member" placeholder="Nama Member">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Member</label>
                        <input type="email" class="form-control" id="email_member_edit" name="email_member" placeholder="Email Member">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="text" class="form-control" id="wa_member_edit" name="wa_member" placeholder="Nomor WhatsApp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Induk</label>
                        <input type="text" class="form-control" id="nomor_induk_edit" name="nomor_induk" placeholder="Nomor Induk">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Departemen</label>
                        <input type="text" class="form-control" id="dept_edit" name="dept" placeholder="Departemen">
                    </div>
					<input type="hidden" name="level" value="User">
                    <!-- <div class="mb-3">
                        <label class="form-label">Level</label>
                        <input type="text" class="form-control" id="level_edit" name="level" placeholder="Level">
                    </div> -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir_edit" name="tgl_lahir">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin_edit" name="jenis_kelamin">
                            <option value="Male">Laki-laki</option>
                            <option value="Female">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti Avatar</label>
                        <input type="file" class="form-control" id="avatar_edit" name="avatar">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Registrasi</label>
                        <select name="status_registrasi" id="status_registrasi_edit" class="form-select">
                            <option value="Y">Aktif</option>
                            <option value="N">Tidak Aktif</option>
                        </select>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-danger text-center">Status Akun</label>
                        <select name="status_akun" id="status_akun_edit" class="form-select">
                            <option value="Y">Tidak Diblokir</option>
                            <option value="N">Diblokir</option>
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
                                <button type="submit" class="btn btn-success w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="btn-delete-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <path d="M9 12l2 2l4 -4"></path>
                                    </svg>
                                    <span id="btn-delete-icon" class="spinner-border spinner-border-sm me-2" style="display: none"></span>
                                    Update Perubahan
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
    $(document).ready(function() {


        // Mengubah warna latar belakang saat opsi diubah
        $('#status_akun_edit').change(function() {
            updateBackground();
        });


        $('#tambahUserForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?= base_url('anggota/simpan_data') ?>',
                type: 'POST',
                data: $(this).serialize(),
				beforeSend: function() {
					showLoading();
				},
				complete: function() {
					hideLoading();
				},
                success: function(response) {
                    $('#tambahUserModal').modal('hide');
                    $('#tambahUserForm')[0].reset();
                    $('#dataAnggota').DataTable().ajax.reload();
                },
                error: function(error) {
                    alert('Error:', error);
                }
            });
        });

        $('#form-update-user').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?php echo base_url('anggota/update_data'); ?>',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    response = JSON.parse(response);
					
                    if (response.success) {
                        $('#modalUbah').modal('hide');
                        $('#dataAnggota').DataTable().ajax.reload();
                    } else {
                        alert('Gagal memperbarui data');
                    }
                },
				beforeSend: function() {
					showLoading();
				},
				complete: function() {
					hideLoading();
				},
                error: function() {
                    alert('Terjadi kesalahan, coba lagi nanti');
                }
            });
        });

        $('#dataAnggota').DataTable({
            ordering: false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('anggota/json'); ?>",
                "type": "POST",
                data: function(d) {
                    d.nama_member = $('#nama_member_filter').val();
                    d.wa_member = $('#wa_member_filter').val();
                    d.nomor_induk = $('#nomor_induk_filter').val();
                    d.filter = $('#filter').val();
                    d.tahun = $('#select_tahun').val();
                    d.tanggal_range = $('#tanggal_range').val()
                },
                "error": function(xhr, status, error) {
                    alert(xhr.responseText);
                    // Tampilkan pesan error pada console browser
                    alert("Terjadi kesalahan saat melakukan request: " + error);
                    // Tampilkan pesan error pada alert
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
                    className: "text-center align-middle"
                },
                {
                    data: "6",
                    className: "text-left align-middle text-nowrap"
                },
                {
                    data: "7",
                    className: "text-left align-middle text-nowrap"
                },
                {
                    data: "8",
                    className: "text-left align-middle"
                },
                {
                    data: "9",
                    className: "text-center align-middle"
                },
            ]
        });

        $('#nama_member_filter').on('input', function() {
            $('#dataAnggota').DataTable().ajax.reload();
        });

        $('#wa_member_filter').on('input', function() {
            $('#dataAnggota').DataTable().ajax.reload();
        });

        $('#nomor_induk_filter').on('input', function() {
            $('#dataAnggota').DataTable().ajax.reload();
        });

        $('#filter').on('input', function() {
            $('#dataAnggota').DataTable().ajax.reload();
        });

        $('#select_tahun').on('change', function() {
            $('#dataAnggota').DataTable().ajax.reload();
        });
    });

    function updateBackground() {
        var selectedStatus = $('#status_akun_edit').val();
        var backgroundColor = (selectedStatus == 'Y') ? '#5cb85c' : '#d9534f'; // Warna dari btn-danger dan btn-success
        var textColor = 'white'; // Warna teks diatur menjadi putih
        $('#status_akun_edit').css({
            'background-color': backgroundColor,
            'color': textColor
        });
    }

    function deleteAnggota(link) {
        var idUser = link.getAttribute("data-id");

        // Konfirmasi penghapusan dengan dialog konfirmasi JavaScript (Opsional)
        var confirmation = confirm("Apakah Anda yakin ingin menghapus kasir ini?");
        if (confirmation) {
            $.ajax({
                url: "<?php echo base_url('anggota/delete/'); ?>" + idUser,
                type: "POST",
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        $('#dataAnggota').DataTable().ajax.reload();
                        toastr.success('Anggota Berhasil dihapus.');
                    } else {
                        toastr.error(response.message);
                    }
                },
				beforeSend: function() {
					showLoading();
				},
				complete: function() {
					hideLoading();
				},
                error: function(xhr, status, error) {
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }
    }

    function lihatDetail(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('anggota/check'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response.status == 'success') {
                    var user = response.data;
                    var statusRegistrasi = (user.status_registrasi && user.status_registrasi == 'Y') ? 'Sudah Daftar' : 'Belum Daftar';
                    var statusAkun = (user.status_akun && user.status_akun == 'Y') ? 'Aktif' : 'Diblokir';
                    var html = '<div class="table-responsive">' +
                        '<table class="table table-bordered">' +
                        '<thead>' +
                        '<tr>' +
                        '<th class="col-lg-3 col-md-4 col-xs-4 align-middle">Nama Member</th>' +
                        '<td colspan="4">' + (user.nama_member ? user.nama_member : '-') + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th class="align-middle">Email Member</th>' +
                        '<td colspan="4">' + (user.email_member ? user.email_member : '-') + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th class="align-middle">WhatsApp Member</th>' +
                        '<td colspan="4">' + (user.wa_member ? user.wa_member : '-') + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th class="align-middle">Nomor Induk</th>' +
                        '<td colspan="4">' + (user.nomor_induk ? user.nomor_induk : '-') + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th class="align-middle">Departemen</th>' +
                        '<td colspan="4">' + (user.dept ? user.dept : '-') + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th class="align-middle">Level</th>' +
                        '<td colspan="4">' + (user.level ? user.level : '-') + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th class="align-middle">Tanggal Lahir</th>' +
                        '<td colspan="4">' + (user.tgl_lahir ? user.tgl_lahir : '-') + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th class="align-middle">Jenis Kelamin</th>' +
                        '<td colspan="4">' + (user.jenis_kelamin ? user.jenis_kelamin : '-') + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th class="align-middle">Status Registrasi</th>' +
                        '<td colspan="4">' + (statusRegistrasi) + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th class="align-middle">Status Akun</th>' +
                        '<td colspan="4">' + (statusAkun) + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th class="align-middle">Created At</th>' +
                        '<td colspan="4">' + (user.created_at ? user.created_at : '-') + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th class="align-middle">Avatar</th>' +
                        '<td colspan="4"><img src="<?php echo base_url('public/template/upload/user/'); ?>' + (user.avatar ? user.avatar : '-') + '" class="avatar avatar-md img-zoom"></td>' +
                        '</tr>' +
                        '</thead>' +
                        '</table>' +
                        '</div>';

                    $("#kontenPreview").html(html);
                    $("#modalDetail").modal('show');
                } else {
                    alert('User tidak ditemukan');
                }
            },
			beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

        });
    }

    function ubahAnggota(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('anggota/check'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.status == 'success') {
                    var user = response.data;
                    $("#id_edit").val(user.id_user);
                    $("#username_edit").val(user.username);
                    $("#password_edit").val('');
                    $("#nama_member_edit").val(user.nama_member);
                    $("#email_member_edit").val(user.email_member);
                    $("#wa_member_edit").val(user.wa_member);
                    $("#nomor_induk_edit").val(user.nomor_induk);
                    $("#dept_edit").val(user.dept);
                    // $("#level_edit").val(user.level);
                    $("#tgl_lahir_edit").val(user.tgl_lahir);
                    $("#jenis_kelamin_edit").val(user.jenis_kelamin);
                    $("#avatar_edit").val('');
                    $("#status_registrasi_edit").val(user.status_registrasi);
                    $("#status_akun_edit").val(user.status_akun);
                    updateBackground();
                    $("#modalUbah").modal('show');
                } else {
                    alert('User tidak ditemukan');
                }
            },
			beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

        });
    }

    function resetPassword(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Password akan direset ke default",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('anggota/reset_password/') ?>" + id,
                    type: 'POST',
                    error: function() {
                        alert('Ada yang salah');
                    },
					beforeSend: function() {
						showLoading();
					},
					complete: function() {
						hideLoading();
					},
                    success: function(data) {
                        Swal.fire('Berhasil!', 'Password berhasil direset ke default.', 'success')
                    }
                });
            }
        });
    }

    var today = moment();
    var startDefault, endDefault;

    // Jika tanggal sekarang lebih besar dari 15, set start date ke 16 bulan ini dan end date ke 15 bulan depan
    if (today.date() > 15) {
        startDefault = moment().date(16).startOf('day');
        endDefault = moment().add(1, 'month').date(15).endOf('day');
    } else { // Jika tanggal sekarang kurang dari 15, set start date ke 16 bulan lalu dan end date ke 15 bulan ini
        startDefault = moment().subtract(1, 'month').date(16).startOf('day');
        endDefault = moment().date(15).endOf('day');
    }

    // Inisialisasi Date Range Picker
    $('#tanggal_range').daterangepicker({
        autoApply: true,
        locale: {
            format: 'DD/MM/YYYY',
            separator: ' - ',
            applyLabel: 'Pilih',
            cancelLabel: 'Batal',
            daysOfWeek: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sa'],
            monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
        },
        startDate: startDefault,
        endDate: endDefault,
        ranges: {
            '7 Hari Terakhir': [moment().subtract(7, 'days'), moment()],
            '30 Hari Terakhir': [moment().subtract(30, 'days'), moment()],
            'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
            'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    $('#tanggal_range').on('apply.daterangepicker', function(ev, picker) {
        $('#dataAnggota').DataTable().ajax.reload();
    });

    function confirmExport() {
        Swal.fire({
            title: 'Anda yakin ingin mengexport data dalam rentang tanggal ' + $('#tanggal_range').val() + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, export!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('anggota/autodebet'); ?>",
                    data: {
                        tanggal_range: $('#tanggal_range').val()
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response, status, xhr) {
                        var filename = "";
                        var disposition = xhr.getResponseHeader('Content-Disposition');
                        if (disposition && disposition.indexOf('attachment') !== -1) {
                            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                            var matches = filenameRegex.exec(disposition);
                            if (matches != null && matches[1]) {
                                filename = matches[1].replace(/['"]/g, '');
                            }
                        }

                        if (response.size > 0) {
                            var url = window.URL.createObjectURL(response);
                            var link = document.createElement('a');
                            link.href = url;
                            link.download = filename;
                            link.click();
                            window.URL.revokeObjectURL(url);
                        } else {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan: File yang dihasilkan kosong.',
                                'error'
                            );
                        }
                    },
					beforeSend: function() {
						showLoading();
					},
					complete: function() {
						hideLoading();
					},
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseText;
                        console.log(errorMessage);
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat mengunduh file: ' + errorMessage,
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
</body>

</html>
