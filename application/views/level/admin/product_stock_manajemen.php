<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
                    <a href="<?= base_url('product') ?>" class="btn btn-primary me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                        </svg>
                        Kembali
                    </a>
                    <button class="btn btn-primary dropdown-toggle text-uppercase" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical" width="40" height="40" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                        </svg>Aksi
                    </button>
                    <ul class="dropdown-menu bg-secondary">
                        <li>
                            <a href="#" class="dropdown-item small text-white">
                                Export Excel
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item small text-white delete" data-id="77">
                                Export PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card mb-3">
                    <div class="card-header border-0 pb-0">
                        <h4 class="card-title text-muted text-uppercase">
                            Detail Informasi Produk
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-lg-3 col-md-4 col-xs-4 align-middle">
                                            Nama Barang
                                        </th>
                                        <td colspan="4">
                                            <?= $barang['nama_barang'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">
                                            Nama Kategori Barang
                                        </th>
                                        <td colspan="4">
                                            <?= $barang['nama_kategori_brg'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">
                                            Barcode

                                        </th>
                                        <td colspan="4">
                                            <?= $barang['barcode'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">
                                            Stok Barang
                                        </th>
                                        <td colspan="4">
                                            <?= $barang['stock_brg'] . " " . $barang['nama_satuan'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">
                                            Deskripsi Singkat
                                        </th>
                                        <td colspan="4">
                                            <?= $barang['description'] == "" ? "Tidak ada deskripsi" : $barang['description'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" rowspan="2">
                                            Rincian Harga
                                        </th>
                                        <th class="align-middle">
                                            HPP Barang
                                        </th>
                                        <th class="col-3 align-middle">
                                            Markup Barang
                                        </th>
                                        <th class="align-middle">
                                            PPN
                                        </th>
                                        <th class="align-middle">
                                            Harga Jual Barang
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            Rp. <?= number_format($barang['hpp_barang']) ?>
                                        </td>
                                        <td>
                                            <?= $barang['markup_barang'] ?>%
                                        </td>
                                        <td>
                                            <?= $barang['ppn_barang'] == "Y" ? "10" : "0" ?>%
                                        </td>
                                        <td>
                                            Rp. <?= number_format($barang['harga_jual_barang']) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" rowspan="2">
                                            Rincian Promosi
                                        </th>
                                        <th colspan="2" class="align-middle">
                                            Promo Aktif?
                                        </th>
                                        <th colspan="1" class="align-middle">
                                            Persentase Promo
                                        </th>
                                        <th colspan="1" class="align-middle">
                                            Harga Promo
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <?= $barang['promo_brg'] == "On" ? "<span class=\"badge bg-success-lt\">Aktif</span>" : "<span class=\"badge bg-orange-lt\">Tidak</span>" ?>
                                        </td>
                                        <td colspan="1">
                                            <?= $barang['promo_brg'] == "On" ? "<span class='text-success fw-bold'>" . number_format(($barang['harga_jual_barang'] - $barang['harga_promo']) / ($barang['harga_jual_barang']), 2) * 100 . "%</span>" : "" ?>
                                        </td>
                                        <td colspan="1">
                                            <?= $barang['promo_brg'] == "On" ? "<span class='text-success fw-bold'>Rp. " . number_format($barang['harga_promo']) . "</span>" : "" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" rowspan="12">
                                            Gambar
                                        </th>
                                        <th colspan="4" class="align-middle">
                                            Gambar
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <?php
                                            $gambarSrc = $barang['gambar_barang'] == "https://dodolan.jogjakota.go.id/assets/media/default/default-product.png"
                                                ? $barang['gambar_barang']
                                                : base_url('public/template/upload/barang/' . $barang['gambar_barang']);

                                            $gambar = "<img src='" . $gambarSrc . "' style='border: 1px solid #ddd; padding: 5px; height: 100px;'>";
                                            echo $gambar;
                                            ?>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <form action="" class="form-inline">
            <div class="row align-items-center">
                <div class="form-group mb-2 col-auto">
                    <label for="staticEmail2" class="sr-only">Tipe Manajemen</label>
                    <select style="width:230px !important;border-radius:0px !important" required name="tipe_filter" id="tipe_filter" class="form-control">
                        <option value="">--- Pilih Tipe Manajemen ---</option>
                        <option value="stock_awal">Stock Awal</option>
                        <option value="stock_masuk">Stock Masuk</option>
                        <option value="stock_keluar">Stock Keluar</option>
                        <option value="stock_rusak">Stock Rusak</option>
                        <option value="stock_opname">Stock Hilang</option>
                    </select>
                </div>
                <div class="form-group mb-2 col-auto">
                    <label for="staticEmail2" class="sr-only">Unit Kerja</label>
                    <?php
                    $current_month = date('m'); // Ambil bulan sekarang dalam format angka (01-12)

                    // Daftar nama bulan
                    $month_names = [
                        '00' => "...",
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
                    ?>

                    <!-- Tampilkan opsi dropdown -->
                    <select style="width:250px !important;border-radius:0px !important" required name="cmbBulan" id="cmbBulan" class="form-control">
                        <?php
                        foreach ($month_names as $month_num => $month_name) {
                            echo '<option value="' . $month_num . '"';
                            if ($month_num == $current_month) {
                                echo ' selected';
                            }
                            echo '>' . $month_name . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-2 p-1 mr-1 col-auto">
                    <label for="inputPassword2" class="sr-only">Password</label>
                    <?php
                    $current_year = date('Y');
                    ?>
                    <select style="width:100px !important;border-radius:0px !important" required name="cmbTahun" id="cmbTahun" class="form-control">
                        <option value="" selected>Pilih Tahun</option>
                        <?php for ($year = $current_year; $year >= $current_year - 4; $year--) : ?>
                            <option value="<?php echo $year; ?>" <?php echo ($year == $current_year) ? 'selected' : ''; ?>><?php echo $year; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-auto">
                    <button id="btn-filter" style="border-radius: 3px !important;" type="button" class="btn btn-info mb-2">Filter Data</button>
                    <button id="btn-excel" style="border-radius: 3px !important;" type="button" class="btn btn-success mb-2">Cetak Excel</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-status-top bg-info"></div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-sm text-nowrap" id="dataRiwayat" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Keterangan</th>
                                                <th>Tanggal</th>
                                                <th>Jumlah</th>
                                                <th>Tipe</th>
                                                <th>Stock Sebelum</th>
                                                <th>Stock Saat Ini</th>
												<th>Harga Modal</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layouts/admin/footer'); ?>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('#dataRiwayat').DataTable({
        ordering: true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('product/stockintegrasi_json'); ?>",
            "type": "POST",
            data: function(d) {
                d.id = <?= $barang['id_brg'] ?>;
                d.filter = $("#tipe_filter").val();
                d.bulan = $("#cmbBulan").val();
                d.tahun = $("#cmbTahun").val();
            }
        },
        columns: [{
                data: "0",
                className: "text-center"
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
                className: "text-center align-middle"
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
            },
			{
				data: "7",
				className: "text-center align-middle",
			}
        ]
    });

    $('#btn-filter').click(function() {
        $('#dataRiwayat').DataTable().ajax.reload();
    });

    $('#btn-excel').click(function() {
        var id = <?= $barang['id_brg'] ?>;
        var filter = $("#tipe_filter").val();
        var bulan = $("#cmbBulan").val();
        var tahun = $("#cmbTahun").val();

        var url = "<?php echo base_url('product/export_stockintegrasi_excel'); ?>";
        window.location.href = url + "?id=" + id + "&filter=" + filter + "&bulan=" + bulan + "&tahun=" + tahun;
    });

</script>
</body>

</html>