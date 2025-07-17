<?php
$currentTime = time();
$nextHourTime = $currentTime + (60 * 60);
$roundedTime = ceil($nextHourTime / (60 * 60)) * (60 * 60);
$formattedTime = date("Y-m-d\TH:i", $roundedTime);
?>

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
        padding: 0.5rem 1rem;
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

    .img-thumbnail {
        background-color: #f5f7fb;
        border: 1px solid #cbd5e1;
        border-radius: 10%;
        width: 80px !important;
    }
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Laporan Inventori
                </h2>
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
                        <div class="d-flex row mb-4">
                            <div class="col-sm-12 col-md-3">
                                <p class="lead mb-1">
                                    Hari, Tanggal
                                </p>
                                <h3 class="m-0">
                                    <span id="live-date"></span>
                                </h3>
                            </div>
                            <div class="col-sm-12 col-md-3 text-end">
                                <p class="lead mb-1">
                                    Waktu
                                </p>
                                <h3 class="m-0">
                                    <span id="live-time"></span>
                                </h3>
                            </div>
                        </div>
                        <form action="<?= base_url('laporan/inventory_proses') ?>" method="get">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label">Dari Periode</label>
                                    <div class="row">
                                        <div class="col">
                                            <select name="bulan" id="begin-bill-period-month" class="form-select">
                                                <?php
                                                $months = [
                                                    '00' => '...',
                                                    '01' => 'Januari',
                                                    '02' => 'Februari',
                                                    '03' => 'Maret',
                                                    '04' => 'April',
                                                    '05' => 'Mei',
                                                    '06' => 'Juni',
                                                    '07' => 'Juli',
                                                    '08' => 'Agustus',
                                                    '09' => 'September',
                                                    '10' => 'Oktober',
                                                    '11' => 'November',
                                                    '12' => 'Desember'
                                                ];
                                                $currentMonth = date('m');
                                                foreach ($months as $num => $name) {
                                                    $selected = ($num == $currentMonth) ? 'selected' : '';
                                                    echo "<option value=\"$num\" $selected>$name</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="tahun" id="begin-bill-period-year" class="form-select">
                                                <?php
                                                $currentYear = date('Y');
                                                for ($i = $currentYear; $i >= $currentYear - 4; $i--) {
                                                    $selected = ($i == $currentYear) ? 'selected' : '';
                                                    echo "<option value=\"$i\" $selected>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="" class="form-label">Pilih Format</label>
                                    <select required name="export" id="export-format" class="form-select">
                                        <option value="">Pilih Format Cetak</option>
                                        <option value="pdf">PDF</option>
                                        <option value="excel">Excel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="d-grid my-4">
                                        <button type="submit" id="btn-submit" class="btn btn-primary btn-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="btn-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="12" r="9"></circle>
                                                <path d="M9 12l2 2l4 -4"></path>
                                            </svg>
                                            <span id="btn-icon"></span>
                                            <span id="btn-text">Cetak Berkas Laporan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

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
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateTime() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            const dayName = days[now.getDay()];
            const day = String(now.getDate()).padStart(2, '0');
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            const dateString = `${dayName}, ${day} ${monthName} ${year}`;
            const timeString = `${hours}:${minutes}:${seconds}`;

            document.getElementById('live-date').innerText = dateString;
            document.getElementById('live-time').innerText = timeString;
        }

        setInterval(updateTime, 1000);
        updateTime(); // Update immediately on load
    });
</script>
</body>

</html>