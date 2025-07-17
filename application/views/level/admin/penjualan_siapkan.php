<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<!-- STYLE DISINI -->
<style>
    hr:not([size]) {
        height: 1px;
    }

    hr {
        margin: 1rem 0;
        color: inherit;
        background-color: currentColor;
        border: 0;
        opacity: .25;
    }

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
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #EFF3F8;
    }

    .dataTables_wrapper .row:last-child {
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
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <form id="ValidasiForm" type="POST">
                <div class="form-group mb-1">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-2">
                                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                <input required type="text" class="form-control" style="border-radius: 0px !important;" placeholder="Scan Barcode" id="scan_barcode" name="scan_barcode">
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success">Scan Barcode</button>
                            <button type="button" class="btn btn-success">On Camera</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12 col-lg-9 d-flex">
                    <div class="card w-100">
                        <!-- card header -->
                        <div class="card-header border-bottom-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <!-- heading -->
                                    <h4 class="mb-1">Order ID: #<?= $pesanan['id_pesanan'] ?></h4>
                                    <span>
                                        Order Date: <?= date('d/M/Y H:i:s', strtotime($pesanan['tgl_pesanan'])) ?>
                                        <span class="badge bg-success-soft ms-2"><?= $pesanan['status_pesanan'] ?></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Table -->
                            <table id="tabel-detail" class="table mb-0 text-nowrap">
                                <!-- Table Head -->
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Sub Total</th>
                                        <th>Status Verified</th>
                                    </tr>
                                </thead>
                                <!-- tbody -->
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold" style="text-align: right !important;">Sub Total</td>
                                        <td style="text-align: left !important;" colspan="2" id="subtotal"><?= "Rp. " . number_format($pesanan['grand_total'] - $pesanan['ongkos_kirim']) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold">Ongkos Kirim</td>
                                        <td colspan="2" id="ongkos_kirim"><?= "Rp. " . number_format($pesanan['ongkos_kirim']) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold">Total Harga</td>
                                        <td colspan="2" id="total_harga"><?= "Rp. " . number_format($pesanan['grand_total']) ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-12 col-lg-3">
                    <div class="card w-100">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0">Customer</h4>
                                <a href="#">View Profile</a>
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- img -->
                                <img width="50" src="<?= base_url('public/template/upload/user/' . $pesanan['avatar']) ?>" class="avatar-lg rounded-circle" alt="">
                                <div class="ms-3">
                                    <!-- title -->
                                    <h4 class="mb-0"><?= $pesanan['nama_member'] ?></h4>
                                    <div>
                                        <span>Customer since <?= date('d/M/Y H:i:s', strtotime($pesanan['created_at'])) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card body -->
                        <div class="card-body border-top">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- text -->
                                <h4 class="mb-0">Contact</h4>
                                <a href="#">Edit</a>
                            </div>
                            <div>
                                <!-- text -->
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fe fe-mail fs-4"></i>
                                    <a href="#" class="ms-2"><?= $pesanan['email_member'] ?></a>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fe fe-phone fs-4"></i>
                                    <span class="ms-2"><?= $pesanan['wa_member'] ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- card body -->
                        <div class="card-body border-top">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a onclick="showConfirmation()" id="pesanan_disiapkan" class="btn btn-success me-1 disabled" title="Pesanan Disipapkan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 12l5 5l10 -10"></path>
                                        <path d="M2 12l5 5m5 -5l5 -5"></path>
                                    </svg>
                                    Proccess
                                </a>
                                <button onclick="window.close();" class="btn btn-danger btn-outline">
                                    <i class="fa fa-times"></i>&nbsp;&nbsp;Tutup
                                </button>
                            </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        var id = <?= $id ?>;
        var form = $("#ValidasiForm");
        $('#tabel-detail').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('penjualan/ajax_get_detail/'); ?>" + id,
                "type": "POST"
            },
            "columns": [{
                    "data": "numbering",
                    "className": "text-center"
                },
                {
                    "data": "gambar_barang",
                    "className": "text-center",
                },
                {
                    "data": "nama_barang",
                    "className": "text-left text-wrap",
                    "render": function(data, type, row) {
                        return data + "<br><i class='text-muted'>" + row.barcode + "</i>";
                    }
                },
                {
                    "data": "harga_saat_ini",
                    "className": "text-right dt-nowrap",
                    "render": function(data, type, row) {
                        return "Rp. " + data;
                    }
                },
                {
                    "data": "jumlah_jual",
                    "className": "text-center",
                },
                {
                    "data": "sub_total_harga",
                    "className": "text-end dt-nowrap",
                },
                {
                    "data": "status_verified",
                    "className": "text-center",
                    "render": function(data, type, row) {
                        if (data === "0") {
                            return '<i class="fa fa-times text-danger"></i>';
                        } else {
                            return '<i class="fa fa-check text-success"></i>';
                        }
                    }
                },
                // Tambahkan kolom lain sesuai dengan data yang ingin ditampilkan
            ],
            "drawCallback": function(settings) {
                $.ajax({
                    url: "<?php echo base_url('penjualan/status/'); ?>" + id,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == true) {
                            $("#pesanan_disiapkan").removeClass("disabled");
                        } else {
                            $("#pesanan_disiapkan").addClass("disabled");
                        }
                    },
					beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                    }
                });
            }
        });

        form.submit(function(event) {
            event.preventDefault();
            var formData = form.serialize();

            $.ajax({
                type: "POST",
                url: "<?= base_url('penjualan/validasi_pesanan') ?>", // Ganti dengan URL yang sesuai
                data: formData,
                success: function(response) {
                    if (response.success == true) {
                        toastr.success(response.msg, '', {
                            timeOut: 5000
                        });
                        $('#tabel-detail').DataTable().ajax.reload();
                        $("#scan_barcode").val("");
                    } else {
                        toastr.error(response.msg, '', {
                            timeOut: 5000
                        });
                    }
                },
				beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                error: function() {
                    // Penanganan kesalahan jika permintaan AJAX gagal
                    alert("Permintaan AJAX gagal.");
                }
            });
        });
    });

    function showConfirmation() {
        Swal.fire({
            title: 'Perhatian!!',
            text: 'Anda yakin barang sudah benar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('penjualan/disiapkan/' . $id) ?>',
                    success: function(response) {
                        // Handle the response
                        if (response.status == "success") {

							// Hapus notifikasi berdasarkan ID pesanan
							let notif = JSON.parse(sessionStorage.getItem('order_notifications')) || [];
							notif = notif.filter(item => item.id_pesanan != '<?= $id ?>'); // filter out
							sessionStorage.setItem('order_notifications', JSON.stringify(notif));

							// Refresh tampilan badge dan list
							if (typeof updateNotifBadge === 'function') updateNotifBadge();
							if (typeof updateNotifList === 'function') updateNotifList();

                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success'
                            });

                            setTimeout(() => {
                                window.location.href = '<?= base_url('penjualan') ?>';
                            }, 2000);
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error'
                            });
                        }
                        // Optionally, you can redirect or perform other actions
                    },
					beforeSend: function () {
						if (typeof showLoading === 'function') showLoading();
					},
					complete: function () {
						if (typeof hideLoading === 'function') hideLoading();
					},

                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while processing the request.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }
</script>
</body>

</html>
