<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.4.1/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div id="loading" style="display: none;"></div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-status-top bg-primary"></div>
                    <form id="filter-form" action="javascript:void(0)">
                        <div class="card-body">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="M19 7h-1V2H6v5H5c-1.654 0-3 1.346-3 3v7c0 1.103.897 2 2 2h2v3h12v-3h2c1.103 0 2-.897 2-2v-7c0-1.654-1.346-3-3-3zM8 4h8v3H8V4zm8 16H8v-4h8v4zm4-3h-2v-3H6v3H4v-7c0-.551.449-1 1-1h14c.552 0 1 .449 1 1v7z"></path>
                                    <path d="M14 10h4v2h-4z"></path>
                                </svg>
                                Laporan Pembelian By Periode
                            </h3>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="start-date" name="start-date" placeholder="Tanggal Mulai">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tanggal Berakhir</label>
                                    <input type="date" class="form-control" id="end-date" name="end-date" placeholder="Tanggal Berakhir">
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">
                                        Pilih Supplier
                                    </label>
                                    <select style="width: 100%;" name="select_supplier" id="select_supplier" class="form-control">
                                        <option value="">** Pilih Supplier</option>
                                        <?php foreach ($supplier as $key => $value) : ?>
                                            <option value="<?= $value['id_supplier'] ?>"><?= $value['nama_supplier'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <button type="button" id="reloadDs" class="btn btn-primary">
                                    Terapkan Filter
                                </button>
                                <button type="button" id="btn-pdf" class="btn btn-danger ms-2">
                                    Download PDF
                                </button>
                                <button type="button" id="btn-excel" class="btn btn-success ms-2">
                                    Download Excel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- 
                <div class="accordion bg-white mb-3">
                    <div class="accordion-item">
                        <div class="accordion-header">
                            <h2 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#tab-filter" aria-expanded="false" style="cursor: pointer">
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
                                            <label class="form-label">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="start-date" name="start-date" placeholder="Tanggal Mulai">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Tanggal Berakhir</label>
                                            <input type="date" class="form-control" id="end-date" name="end-date" placeholder="Tanggal Berakhir">
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label class="form-label">
                                                Pilih Supplier
                                            </label>
                                            <select style="width: 100%;" name="select_supplier" id="select_supplier" class="form-control">
                                                <option value="">** Pilih Supplier</option>
                                                <?php foreach ($supplier as $key => $value) : ?>
                                                    <option value="<?= $value['id_supplier'] ?>"><?= $value['nama_supplier'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" id="reloadDs" class="btn btn-primary">
                                                Terapkan Filter
                                            </button>
                                            <button type="button" id="btn-pdf" class="btn btn-danger ms-2">
                                                Download PDF
                                            </button>
                                            <button type="button" id="btn-excel" class="btn btn-success ms-2">
                                                Download Excel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                 -->
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-status-top bg-warning"></div>
                    <div class="card-body pt-0">
                        <div class="row mt-2">
                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap" style="width:100% !important" id="example2">
                                    <thead>
                                        <tr class="bg-gradient-info">
                                            <th class="text-center text-uppercase">No</th>
                                            <th class="text-center text-uppercase">Tanggal Pesan</th>
                                            <th class="text-center text-uppercase">Tanggal Terima</th>
                                            <th class="text-center text-uppercase" width="20%">Supplier</th>
                                            <th class="text-center text-uppercase" width="20%">Jumlah</th>
                                            <th class="text-right text-uppercase" width="20%">Total Harga</th>
                                            <th class="text-right text-uppercase" width="20%">Dibayarkan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gradient-dark">
                                            <td style="text-align: right !important;" colspan="6" class="fw-bold text-uppercase text-start">Total Biaya Pembelian</td>
                                            <td style="text-align: right !important;"><span id="biaya_pembelian"></span></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right !important;" colspan="6" class="fw-bold text-uppercase text-start">Total Hutang</td>
                                            <td style="text-align: right !important;"><span id="biaya_belumbayar"></span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/admin/footer'); ?>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(function() {
        $('#select_supplier').select2({});
        $(".modal").on('shown.bs.modal', function() {
            $(this).find("input:visible:first").focus();
        });

        config = {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
        }

        flatpickr("#start-date", {});
        flatpickr("#end-date", {});

        $('#example2').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('laporan/pembelian_periode_json'); ?>",
                "type": "POST",
                data: function(d) {
                    d.start_date = $('#start-date').val();
                    d.end_date = $('#end-date').val();
                    d.supplier = $('#select_supplier').val();
                },
                "dataSrc": function(json) {
                    // Mengisi nilai total harga ke elemen yang sesuai
                    $("#biaya_pembelian").text(json.totalHargaSemua);
                    $("#biaya_belumbayar").text(json.totalHargaSemuaBelumLunas);

                    // Mengembalikan data untuk DataTable
                    return json.data;
                },
            },
            columns: [{
                    data: "0",
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: "1"
                },
                {
                    data: "2",
                    className: "text-left"
                },
                {
                    data: "3",
                    className: "text-left"
                },
                {
                    data: "4",
                    className: "text-center"
                },
                {
                    data: "5",
                    className: "text-end"
                },
                {
                    data: "6",
                    className: "text-end"
                },
            ],
        });

        $("#reloadDs").on("click", function() {
            $('#example2').DataTable().ajax.reload();
        });

        $('#btn-pdf').click(function() {
            var startDate = $('#start-date').val();
            var endDate = $('#end-date').val();
            var supplier = $('#select_supplier').val();

            // Tampilkan elemen loading
            $('#loading').show();

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: '<?php echo base_url("laporan/pembelian_periode_pdf"); ?>',
                method: 'POST',
                data: {
                    start: startDate,
                    end: endDate,
                    supplier: supplier
                },
                xhrFields: {
                    responseType: 'blob' // Set respons menjadi blob
                },
                success: function(response, status, xhr) {
                    // Sembunyikan elemen loading saat respons diterima
                    $('#loading').hide();
                    // Cek apakah respons adalah blob
                    if (response instanceof Blob) {
                        // Buat URL objek untuk blob
                        var url = window.URL.createObjectURL(response);
                        // Buat elemen link untuk mendownload file
                        var link = document.createElement('a');
                        link.href = url;
                        link.download = 'laporan_pembelian.pdf'; // Atur nama file
                        // Klik pada link untuk memicu unduhan
                        link.click();
                        // Hapus URL objek setelah unduhan selesai
                        window.URL.revokeObjectURL(url);
                    } else {
                        // Jika respons bukan blob, tampilkan pesan kesalahan
                        alert('Terjadi kesalahan saat mengunduh file.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Sembunyikan elemen loading jika terjadi kesalahan
                    $('#loading').hide();
                }
            });
        });


        $('#btn-excel').click(function() {
            var startDate = $('#start-date').val();
            var endDate = $('#end-date').val();
            var supplier = $('#select_supplier').val();

            // Tampilkan elemen loading
            $('#loading').show();

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: '<?php echo base_url("laporan/pembelian_periode_excel"); ?>',
                method: 'POST',
                data: {
                    start: startDate,
                    end: endDate,
                    supplier: supplier
                },
                xhrFields: {
                    responseType: 'blob' // Set responseType ke 'blob' untuk menerima binary large objects (blob)
                },
                success: function(response, status, xhr) {
                    // Sembunyikan elemen loading saat respons diterima
                    $('#loading').hide();
                    // Cek apakah respons adalah blob
                    if (response instanceof Blob) {
                        // Buat URL objek untuk blob
                        var url = window.URL.createObjectURL(response);
                        // Buat elemen link untuk mendownload file
                        var link = document.createElement('a');
                        link.href = url;
                        link.download = 'periode_report.xlsx'; // Atur nama file
                        // Klik pada link untuk memicu unduhan
                        link.click();
                        // Hapus URL objek setelah unduhan selesai
                        window.URL.revokeObjectURL(url);
                    } else {
                        // Jika respons bukan blob, tampilkan pesan kesalahan
                        alert('Terjadi kesalahan saat mengunduh file.');
                    }
                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan kesalahan jika terjadi kesalahan pada permintaan AJAX
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat mengunduh file.');
                    // Sembunyikan elemen loading jika terjadi kesalahan
                    $('#loading').hide();
                }
            });
        });
    });
</script>
</body>

</html>