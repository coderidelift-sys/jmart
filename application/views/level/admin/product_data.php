<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
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

    .rating .star {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        gap: 3px;
        font-size: 10px;
    }

    .rating .star .starred {
        color: #F0C434;
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
        width: 100px !important;
    }
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Data Produk
                </h2>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <div class="btn-group">
                    <a href="<?= base_url('product/tambah') ?>" class="btn btn-primary me-1" title="Kelola Tagihan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Tambah
                    </a>
                    <a href="<?= base_url('product/import') ?>" class="btn btn-secondary me-1" title="Lihat Diskon Tagihan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3"></path>
                        </svg>
                        Import
                    </a>
                    <a id="export_btn" href="#" class="btn btn-success me-1" title="Lihat Diskon Tagihan">
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
        <div class="row mb-2">
            <div class="col-sm-12 col-md-3 mb-2">
                <div class="card bg-blue">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-green">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-archive" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" />
                                <path d="M10 12l4 0" />
                            </svg>
                        </div>
                    </div>
                    <div class="card-body text-white">
                        Total Produk
                        <h2>
                            <?= number_format($total_produk) ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 mb-2">
                <div class="card bg-azure">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-lime">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-archive" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" />
                                <path d="M10 12l4 0" />
                            </svg>
                        </div>
                    </div>
                    <div class="card-body text-white">
                        Total Produk dalam Promo
                        <h2>
                            <?= number_format($total_promo) ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 mb-2">
                <div class="card bg-azure">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-red">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-archive" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" />
                                <path d="M10 12l4 0" />
                            </svg>
                        </div>
                    </div>
                    <div class="card-body text-white">
                        <?php
                        $string = "Total Stock Dibawah 5";
                        echo $string;
                        ?>
                        <h2>
                            <?= number_format($total_alert) ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 mb-2">
                <div class="card bg-cyan">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-archive" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" />
                                <path d="M10 12l4 0" />
                            </svg>
                        </div>
                    </div>
                    <div class="card-body text-white">
                        Total Produk tanpa Gambar
                        <h2>
                            <?= number_format($total_nogambar) ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-status-top bg-info"></div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataBarang" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="7">No</th>
                                        <th>#</th>
                                        <th>Produk</th>
                                        <th>Kategori</th>
                                        <th>Supplier</th>
                                        <th style="text-align: left;">HPP</th>
                                        <th style="text-align: left;">Harga Jual</th>
                                        <th>Stock</th>
                                        <th width="20">Action</th>
                                    </tr>
                                    <tr>
                                        <th class="align-middle text-center">
                                            #
                                        </th>
                                        <th class="align-middle text-center">
                                            #
                                        </th>
                                        <th>
                                            <input type="text" class="form-control" placeholder="Nama Barang / Barcode" id="nama_barang_filter">
                                        </th>
                                        <th>
                                            <select class="form-control" name="nama_kategori_filter" id="nama_kategori_filter">
                                                <option value="" selected>** Filter Kategori</option>
                                                <?php foreach ($kategori as $key => $value) : ?>
                                                    <option value="<?= $value['id_kategori_brg'] ?>"><?= $value['nama_kategori_brg'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </th>
                                        <th class="align-middle text-left">
                                            <select class="form-control" name="nama_supplier_filter" id="nama_supplier_filter">
                                                <option value="" selected>** Filter Supplier</option>
                                                <?php foreach ($supplier as $key => $value) : ?>
                                                    <option value="<?= $value['id_supplier'] ?>"><?= $value['nama_supplier'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </th>
                                        <th class="align-middle text-left">
                                            #
                                        </th>
                                        <th class="align-middle text-left">
                                            #
                                        </th>
                                        <th class="align-middle text-center">
                                            <select name="stock_filter" id="stock_filter" class="form-select">
                                                <option value="">** Filter Stock</option>
                                                <option value="down">Stock Dibawah 10</option>
                                                <option value="up">Stock Diatas 10</option>
                                            </select>
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

<!-- START -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-modal="true" role="dialog" aria-hidden="true">
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
                <div class="text-secondary">Data produk yang sudah pernah digunakan tidak dapat dilakukan penghapusan. Harap konfirmasi kepada Super Administrator!!</div>
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
<!-- END -->
<?php $this->load->view('layouts/admin/footer'); ?>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataBarang').DataTable({
            "lengthMenu": [10, 25, 50, 100],
            ordering: false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('product/json'); ?>",
                "type": "POST",
                data: function(d) {
                    d.nama = $('#nama_barang_filter').val();
                    d.kategori = $('#nama_kategori_filter').val();
                    d.stock = $("#stock_filter").val();
                    d.supplier = $("#nama_supplier_filter").val();
                }
            },
            columns: [{
                    data: "0",
                    className: "text-center align-middle"
                },
                {
                    data: "1",
                    className: "text-center align-middle",
                    width: "45px"
                },
                {
                    data: "2"
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
                    className: "text-start align-middle dt-nowrap"
                },
                {
                    data: "6",
                    className: "text-start align-middle dt-nowrap"
                },
                {
                    data: "7",
                    className: "text-center align-middle dt-nowrap"
                },
                {
                    data: "8",
                    className: "text-center align-middle dt-nowrap"
                },
            ]
        });

        $('#nama_barang_filter').on('input', function() {
            $('#dataBarang').DataTable().ajax.reload();
        });

        $('#nama_kategori_filter').on('input', function() {
            $('#dataBarang').DataTable().ajax.reload();
        });

        $('#stock_filter').on('input', function() {
            $('#dataBarang').DataTable().ajax.reload();
        });

        $('#nama_supplier_filter').on('input', function() {
            $('#dataBarang').DataTable().ajax.reload();
        });

        $('#nama_kategori_filter').select2({
            placeholder: "** Filter Kategori", // Placeholder
            allowClear: true // Opsi untuk menghapus pilihan
        });

        $('#nama_supplier_filter').select2({
            placeholder: "** Filter Supplier", // Placeholder
            allowClear: true // Opsi untuk menghapus pilihan
        });
    });

    function deleteProduk(link) {
        var idProduk = link.getAttribute("data-id");

        // Menampilkan modal konfirmasi penghapusan
        $('#deleteProductModal').modal('show');

        // Menghapus event handler sebelum menambahkan yang baru
        $('#btn-delete-submit').off('click').on('click', function() {
            // Menutup modal
            $('#deleteProductModal').modal('hide');

            // Ajax untuk menghapus data Kasir
            $.ajax({
                url: "<?php echo base_url('product/delete/'); ?>" + idProduk,
                type: "POST",
                dataType: "json",
				beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                success: function(response) {
                    if (response.status === "success") {
                        $('#dataBarang').DataTable().ajax.reload();
                        toastr.success('Barang Berhasil dihapus.');
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
            $('#deleteProductModal').modal('hide');
        });
    }

    $('#export_btn').click(function() {
        var stock_filter = $('#stock_filter').val();

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin mengekspor data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Ekspor'
        }).then((result) => {
            if (result.isConfirmed) {
                exportData(document.querySelector('#stock_filter').value);
            }
        });
    });

    function exportData(stock_filter) {
        $.ajax({
            url: '<?= base_url('product/export') ?>',
            type: 'POST',
            data: {
                stock_filter: stock_filter
            },
            xhrFields: {
                responseType: 'blob' // Menyatakan bahwa respons yang diharapkan adalah dalam bentuk blob
            },
			beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

            success: function(blob, status, xhr) {
                // Logika untuk menangani respons dari server
                console.log(blob);

                // Membuat objek URL untuk blob
                var url = window.URL.createObjectURL(blob);

                // Membuat elemen link download
                var a = document.createElement('a');
                a.href = url;

                // Mengambil nama file dengan ekstensi .xlsx
                var fileName = xhr.getResponseHeader('Content-Disposition').split('filename=')[1];
                if (fileName) {
                    fileName = fileName.replace('"', '').replace('"', ''); // Menghapus tanda kutip (jika ada)
                    if (!fileName.endsWith('.xlsx')) {
                        fileName += '.xlsx'; // Menambahkan ekstensi .xlsx jika belum ada
                    }
                } else {
                    fileName = 'data_barang.xlsx'; // Nama file default
                }

                a.download = fileName;
                document.body.appendChild(a); // Menambahkan elemen link ke body

                // Memicu unduhan secara otomatis
                a.click();

                // Membersihkan objek URL
                window.URL.revokeObjectURL(url);

                // Menghapus elemen link dari body
                document.body.removeChild(a);
            },
            error: function(xhr, status, error) {
                // Logika untuk menangani error
                console.error(error);
            }
        });
    }
</script>
</body>

</html>
