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

    #dataProduk_wrapper .row:first-child {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #EFF3F8;
    }

    #dataProduk_wrapper .row:last-child {
        border-bottom: 1px solid #e0e0e0;
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #EFF3F8;
    }

    .dataTables_wrapper .row {
        margin: 0 !important;
    }

    div.dataTables_wrapper div.dataTables_length label {
        font-weight: normal;
        text-align: left;
        white-space: nowrap;
    }

    div.dataTables_wrapper div.dataTables_filter input {
        margin-left: 0.5em;
        display: inline-block;
        width: auto;
    }

    .form-control-sm {
        width: 125px;
        height: 25px;
        line-height: 25px;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        padding-right: 40px;
    }

    .form-select-sm {
        width: 125px;
        height: 25px;
        line-height: 25px;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        padding-right: 40px;
    }

    .table-header {
        background-color: #307ECC;
        color: #FFF;
        font-size: 14px;
        line-height: 50px;
        padding-left: 12px;
        margin-bottom: 1px;
    }

    div.dataTables_wrapper div.dataTables_filter input {
        margin-bottom: 0 !important;
        margin: 0 8px;
    }

    div.dataTables_wrapper div.dataTables_length label {
        margin-bottom: 0 !important;
        margin: 0 8px;
    }

    div.dataTables_wrapper div.dataTables_info {
        margin-bottom: 0 !important;
        margin: 0 8px;
    }

    div.dataTables_wrapper div.dataTables_paginate {
        margin-bottom: 0 !important;
        margin: 0 8px;
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
                    Detail Produk
                </h2>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <div class="btn-group">
                    <a href="<?= base_url('product/opname/detail/' . $id) ?>" class="btn btn-primary me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                        </svg>
                        Kembali
                    </a>
                    <a id="confirmBtn" href="<?= base_url('product/opname/simpan_spoil/' . $id) ?>" class="btn btn-success me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                            <path d="M5 21h14a2 2 0 0 0 2-2V8l-5-5H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zM7 5h4v2h2V5h2v4H7V5zm0 8h10v6H7v-6z"></path>
                        </svg>
                        &nbsp;&nbsp;Simpan dan Selesai
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="ribbon ribbon-top bg-info"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                            <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                            <path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path>
                        </svg>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title text-primary fw-bold">
                            Ubah Barang Rusak
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">Nama Opname</label>
                                    <div class="col">
                                        <textarea name="nama_opname" id="nama_opname" class="form-control" rows="3" placeholder="Masukan Nama Opname"><?= $detail['nama_opname'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">Catatan</label>
                                    <div class="col">
                                        <textarea name="catatan_opname" id="catatan_opname" class="form-control" rows="3" placeholder="Masukan Catatan"><?= $detail['catatan_opname'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">Pilih Status</label>
                                    <div class="col">
                                        <select name="tipe_opname" id="tipe_opname" class="form-control" required disabled>
                                            <option value="">-- Pilih Status --</option>
                                            <option <?= $detail['tipe_opname'] == "Stock Opname" ? "selected" : ""  ?> value="Stock Opname">Stock Opname</option>
                                            <option <?= $detail['tipe_opname'] == "Spoil / Barang Rusak" ? "selected" : ""  ?> value="Spoil / Barang Rusak">Spoil / Barang Rusak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">Tanggal Opname</label>
                                    <div class="col">
                                        <input name="tgl_opname" id="tgl_opname" type="datetime-local" class="form-control" value="<?php echo date('Y-m-d\TH:i:s', strtotime($detail['tgl_opname'])); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-status-top bg-info"></div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <form id="ValidasiForm" type="POST" autocomplete="off" style="margin-bottom: 0px !important;">
                                <div class="form-group">
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <select id="barang" class="form-select" style="width: 100%;">
                                                    <option value="" selected disabled>-- Pilih Barang --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-auto" style="display: none;">
                                            <button style="border-radius: 2px !important;" type="submit" class="btn btn-success">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered table-hover" id="dataProduk" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Barcode</th>
                                        <th>Kategori</th>
                                        <th>Stock Aplikasi</th>
                                        <th>Barang Rusak</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#dataProduk').DataTable({
        "processing": true, // Menampilkan pesan "Processing..." selama data sedang dimuat.
        "serverSide": true, // Aktifkan mode server-side.
        ordering: false,
        "ajax": {
            "url": "<?= base_url('product/opname/json_temp_rusak') ?>",
            "type": "POST",
            "data": function(d) {
                d.id_opname = <?= $id ?>;
                return d;
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
            },
        },
        "columns": [
            // Gantilah 'data' dengan nama atribut yang sesuai dari respons JSON Anda.
            {
                "data": null,
                "className": "text-center align-middle",
                "render": renderNumbering
            },
            {
                "data": "1",
                "className": "text-left align-middle"
            },
            {
                "data": "2",
                "className": "text-left align-middle"
            },
            {
                "data": "3",
                "className": "text-end align-middle fw-bold"
            },
            {
                "data": "4",
                "className": "text-end align-middle",
            },
            {
                "data": "5",
                render: function(data, type, row) {
                    // Buat elemen input dengan kelas "form-control text-end" dan tambahkan "disabled" sebagai atribut
                    var inputElement = $('<input>', {
                        'style': 'width:100% !important; border-radius:0px !important;',
                        'type': 'text',
                        'class': 'form-control text-end custom_input',
                        'value': data,
                        'min': '1',
                        'data-jumlah': data,
                        'autocomplete': 'off' // Tambahkan atribut autocomplete dengan nilai "off"
                    });

                    return inputElement[0].outerHTML;
                },
                "className": "text-center align-middle"
            },
            {
                "data": "6",
                "className": "text-center align-middle",
            },
            // Tambahkan kolom lain sesuai kebutuhan.
        ],
        "createdRow": function(row, data, dataIndex) {
            // alert(data);
            // Temukan elemen input dengan kelas "input_1" dalam baris
            var inputElement = $(row).find('.input_1');
            var customInputElement = $(row).find('.custom_input');

            customInputElement.on('input', function(event) {
                var idOpname = data[0];
                var stockRusak = customInputElement.val();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('product/opname/update_temp_rusak'); ?>',
                    data: {
                        id_opname: idOpname,
                        stock_rusak: stockRusak
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // toastr.success(response.message, '', {
                            //     timeOut: 5000
                            // });
                        } else {
                            toastr.error(response.message, '', {
                                timeOut: 5000
                            });
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan dalam permintaan AJAX');
                    }
                });
            });
        },
    });

    const barangSelect = new Choices('#barang', {
        searchEnabled: true, // Aktifkan fitur pencarian
        searchPlaceholderValue: 'Minimum 3 Character...',
        allowHTML: true,
        callbackOnCreateTemplates: function(template) {
            return {
                item: function(classNames, data) {
                    return template(`
                    <div class="${classNames.item}" data-value="${data.value}" data-id="${data.id}">
                        ${data.label}
                    </div>
                `);
                },
            };
        },
    });

    const searchInput = document.querySelector('.choices__input--cloned[placeholder="Minimum 3 Character..."]');

    searchInput.addEventListener('input', function(event) {
        // Ambil nilai yang dimasukkan oleh pengguna
        const inputValue = this.value;
        if (inputValue.length >= 3) {
            $.ajax({
                url: '<?php echo base_url('product/get_barang'); ?>',
                method: 'POST',
                data: {
                    q: inputValue
                },
                dataType: 'json',
                success: function(data) {
                    barangSelect.clearStore();
                    // Membuat array kosong untuk menyimpan opsi
                    var opsi = [];

                    // Melakukan iterasi pada data yang diterima dari AJAX
                    data.forEach(function(item) {
                        // Membuat objek opsi dengan nilai dan label dari data
                        var opsiItem = {
                            value: item.id_brg,
                            label: item.nama_barang
                        };

                        // Menambahkan objek opsi ke dalam array opsi
                        opsi.push(opsiItem);
                    });

                    barangSelect.setChoices(opsi, 'value', 'label');
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        } else {
            barangSelect.clearStore();
        }
    });

    let selectedValue = '';
    $('#barang').on('change', function(event) {
        barangSelect.clearStore();
        selectedValue = event.detail.value;

        setTimeout(function() {
            const choicesList = document.querySelector('#barang');
            if (choicesList) {
                choicesList.click();
            }
        }, 100);

        $('#ValidasiForm').submit();
    });

    $('#ValidasiForm').on('submit', function(event) {
        event.preventDefault();

        const nilaiBarang = selectedValue;

        if (nilaiBarang == "") {
            alert('Inputan tidak boleh kosong');
        } else {
            // Menggunakan AJAX untuk mengirim data ke server
            $.ajax({
                url: '<?= base_url('product/opname/input_rusak') ?>', // Ganti dengan URL yang sesuai
                method: 'POST',
                dataType: 'json',
                data: {
                    id_opname: <?= $id ?>,
                    id: nilaiBarang
                },
                success: function(response) {
                    if (response.success == true) {
                        toastr.success(response.msg, '', {
                            timeOut: 5000
                        });
                        $('#dataProduk').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.msg, '', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                },
            });
        }
    });


    function renderNumbering(data, type, row, meta) {
        // Ambil nomor urut dari indeks baris dan tambahkan 1
        var numbering = meta.row + 1;

        // Kembalikan nomor urut sebagai hasil render
        return numbering;
    }

    $("#confirmBtn").on("click", function(e) {
        e.preventDefault(); // Prevent the default anchor tag behavior

        // Display SweetAlert2 confirmation
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: 'Permintaan Tidak dapat dibatalkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user clicks "Yes, proceed!", initiate the AJAX request
                $.ajax({
                    type: 'POST', // or 'POST' depending on your server-side code
                    url: $(this).attr('href'), // Use the href attribute from the clicked anchor tag
                    success: function(response) {
                        Swal.fire('Success!', 'Data Berhasil Diupdate.', 'success');
                        setTimeout(function() {
                            window.location.href = '<?= base_url('product/opname') ?>';
                        }, 2000);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire('Error!', 'An error occurred while processing your request.', 'error');
                    }
                });
            }
        });
    });
</script>
<script>
    function hapusData(idToDelete) {
        // Konfirmasi penghapusan
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            // Menggunakan AJAX untuk menghapus data
            $.ajax({
                url: '<?php echo site_url('product/opname/delete_temp_spoil'); ?>/' + idToDelete,
                type: 'GET',
                success: function(data) {
                    $('#dataProduk').DataTable().ajax.reload();
                },
                error: function() {
                    alert('Gagal menghapus data.');
                }
            });
        }
    }
</script>
</body>

</html>