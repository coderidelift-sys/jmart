<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.4.1/css/all.min.css" />
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Data Laporan
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-3">
                <label class="form-selectgroup-item w-100">
                    <input type="radio" name="report_type" id="bill-recap" class="form-selectgroup-input" value="tagihan" checked="">
                    <span class="form-selectgroup-label bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tags text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7.859 6h-2.834a2.025 2.025 0 0 0 -2.025 2.025v2.834c0 .537 .213 1.052 .593 1.432l6.116 6.116a2.025 2.025 0 0 0 2.864 0l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-6.117 -6.116a2.025 2.025 0 0 0 -1.431 -.593z"></path>
                            <path d="M17.573 18.407l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-7.117 -7.116"></path>
                            <path d="M6 9h-.01"></path>
                        </svg>
                        &nbsp;<br>Omset Penjualan
                    </span>
                </label>
            </div>
            <div class="col-3">
                <label class="form-selectgroup-item w-100">
                    <input type="radio" name="report_type" id="payment-recap" class="form-selectgroup-input" value="pembayaran">
                    <span class="form-selectgroup-label bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-dollar text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                            <path d="M12 3v3m0 12v3"></path>
                        </svg>
                        &nbsp;<br>Tagihan Autodebit
                    </span>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card pt-3 mt-3">
                    <form action="<?= base_url('laporan/omset_penjualan') ?>" method="POST">
                        <div class="card-body">
                            <div class="row mb-4 select-bill-period">
                                <div class="col-6">
                                    <div id="select-report-period" class="mb-2">
                                        <label class="form-label required">
                                            Periode Laporan
                                        </label>
                                        <input style="cursor: pointer;" autocomplete="off" required type="text" name="report_period" id="report-period" class="form-control" data-mask="0000-00-00 - 0000-00-00" data-mask-visible="true" placeholder="YYYY-MM-DD - YYYY-MM-DD">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4 select-bill-period">
                                <div class="col-6">
                                    <div id="select-report-period" class="mb-2">
                                        <label class="form-label required">
                                            Pilih Kasir
                                        </label>
                                        <select name="kasir" id="kasir" class="form-select">
                                            <option value="">-- Pilih Kasir ---</option>
                                            <?php foreach ($kasir as $key => $value) : ?>
                                                <option value="<?= $value['id_kasir'] ?>"><?= $value['nama_kasir'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="form-label">
                                    Format Laporan
                                </label>
                                <div class="row">
                                    <div class="col-3">
                                        <label class="form-selectgroup-item w-100">
                                            <input type="radio" name="report_format" class="form-selectgroup-input" value="PDF" checked="">
                                            <span class="form-selectgroup-label bg-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pdf text-red" width="40" height="40" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 8v8h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-2z"></path>
                                                    <path d="M3 12h2a2 2 0 1 0 0 -4h-2v8"></path>
                                                    <path d="M17 12h3"></path>
                                                    <path d="M21 8h-4v8"></path>
                                                </svg>
                                                &nbsp;Berkas PDF
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-selectgroup-item w-100">
                                            <input type="radio" name="report_format" class="form-selectgroup-input" value="EXCEL">
                                            <span class="form-selectgroup-label bg-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-spreadsheet text-teal" width="40" height="40" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                    <path d="M8 11h8v7h-8z"></path>
                                                    <path d="M8 15h8"></path>
                                                    <path d="M11 11v7"></path>
                                                </svg>
                                                &nbsp;Berkas Excel
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid my-2 col-6">
                                <button type="submit" id="btn-submit" class="btn btn-primary btn-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="btn-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <path d="M9 12l2 2l4 -4"></path>
                                    </svg>
                                    <span id="btn-icon"></span>
                                    <span id="btn-text text-left">Cetak Berkas Laporan</span>
                                </button>
                            </div>
                            <div class="d-grid col-6">
                                <button type="button" id="btn-preview" class="btn btn-primary btn-block">
                                    <svg lass="icon icon-tabler icon-tabler-circle-check" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                        <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                                        <path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path>
                                    </svg>
                                    <span id="btn-icon"></span>
                                    <span id="btn-text text-left">&nbsp;Preview</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/admin/footer'); ?>
<script src="https://live.aplikasi-spa.com/assets/plugins/litepicker/litepicker.js"></script>
<script src="https://live.aplikasi-spa.com/assets/plugins/litepicker/ranges.js"></script>
<script>
    new Litepicker({
        element: document.getElementById('report-period'),
        plugins: ['ranges'],
        resetButton: true,
        buttonText: {
            previousMonth: `<i class="fa fa-chevron-left"></i>`,
            nextMonth: `<i class="fa fa-chevron-right"></i>`,
            reset: `<i class="fa fa-history"></i>`,
        },
    });
</script>
</body>

</html>