<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Tambah Produk
                </h2>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <a href="<?= base_url('product') ?>" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<form action="<?= base_url('product/simpan') ?>" method="POST" autocomplete="off" enctype="multipart/form-data" id="form-product">
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <?php if ($this->session->flashdata('success_message')) : ?>
                        <div class="alert alert-success"><?= $this->session->flashdata('success_message') ?></div>
                    <?php endif ?>

                    <?php if ($this->session->flashdata('error_message')) : ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('error_message') ?></div>
                    <?php endif ?>
                    <div class="card pb-4" style="margin-top: -5px !important;">
                        <div class="card-body">
                            <div class="container mt-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ec-vendor-upload-detail">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                                    <input type="text" class="form-control slug-title" id="nama_produk" name="nama_produk">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Kategori</label>
                                                    <select name="select_kategori" id="select_kategori" class="form-select">
                                                        <option value="" selected disabled>Pilih Kategori</option>
                                                        <?php foreach ($kategori as $key => $kt) : ?>
                                                            <option value="<?= $kt['id_kategori_brg'] ?>"><?= $kt['nama_kategori_brg'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="barcode" class="col-12 col-form-label">Barcode</label>
                                                    <div class="col-12">
                                                        <input id="barcode" name="barcode" class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="stock_brg" class="col-12 col-form-label">Stock Awal</label>
                                                    <div class="col-12">
                                                        <input id="stock_brg" name="stock_brg" class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="select_satuan" class="col-12 col-form-label">Satuan</label>
                                                    <div class="col-12">
                                                        <select name="select_satuan" id="select_satuan" class="form-select">
                                                            <option value="" selected disabled>Pilih Satuan</option>
                                                            <?php foreach ($satuan as $key => $st) : ?>
                                                                <option value="<?= $st['id_satuan'] ?>"><?= $st['nama_satuan'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="alert_quantity" class="form-label">Alert Jumlah</label>
                                                    <input id="alert_quantity" name="alert_quantity" class="form-control" type="text">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="select_supplier" class="form-label">Pilih Supplier</label>
                                                    <select name="select_supplier" id="select_supplier" class="form-select">
                                                        <option value="" selected disabled>Pilih Supplier</option>
                                                        <?php foreach ($supplier as $key => $sp) : ?>
                                                            <option value="<?= $sp['id_supplier'] ?>"><?= $sp['nama_supplier'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="description" class="form-label">Deskripsi Singkat</label>
                                                    <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Upload Gambar</label>
                                                    <input name="fileUpload" class="form-control" type="file" id="formFile" onchange="preview()" accept=".png,.jpg,.jpeg">
                                                    <button type="button" onclick="clearImage()" class="btn btn-danger mt-3">Hapus Foto</button>
                                                </div>
                                                <div class="col-md-6">
                                                    <img id="frame" src="" class="img-fluid" />
                                                </div>
                                            </div>
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
                    <div class="card pb-4">
                        <div class="card-body">
                            <div class="container mt-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="border-0 text-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td><label for="hpp">HPP <span class="text-danger">*</span></label></td>
                                                        <td></td>
                                                        <td><label for="markup_barang">Markup (%)</label></td>
                                                        <td></td>
                                                        <td><label for="retail_price">Harga Jual <span class="text-danger">*</span></label></td>
                                                        <td></td>
                                                        <td><label for="ref_tax_id">Pajak</label></td>
                                                        <td></td>
                                                        <td><label for="retail_price_aft_tax">Harga Jual <span class="text-danger">*</span></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="step_two">
                                                            <input type="text" class="form-control input-formatted-currency" id="hpp" name="hpp_barang">
                                                        </td>
                                                        <td class="center" width="40">
                                                            <svg style="margin-left: 7px;" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M18 6l-12 12"></path>
                                                                <path d="M6 6l12 12"></path>
                                                            </svg>
                                                        </td>
                                                        <td class="step_three">
                                                            <input type="text" class="form-control" id="markup_barang" name="markup_barang">
                                                        </td>
                                                        <td class="center" width="40">
                                                            <svg style="margin-left: 7px;" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-equal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M5 10h14"></path>
                                                                <path d="M5 14h14"></path>
                                                            </svg>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control input-formatted-currency" id="harga_jual_barang" name="harga_jual_barang">
                                                        </td>
                                                        <td class="center" width="40">
                                                            <svg style="margin-left: 10px;" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M12 5l0 14"></path>
                                                                <path d="M5 12l14 0"></path>
                                                            </svg>
                                                        </td>
                                                        <td>
                                                            <select class="form-control select2" name="ppn_barang" id="ppn">
                                                                <option value="" selected disabled>**</option>
                                                                <option value="N">Tidak PPN</option>
                                                                <option value="Y">PPN</option>
                                                            </select>
                                                        </td>
                                                        <td class="text-right" width="40" style="padding-right: 10px;">
                                                            <svg style="margin-left: 7px;" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-equal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M5 10h14"></path>
                                                                <path d="M5 14h14"></path>
                                                            </svg>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control input-formatted-currency" name="total_jual" id="total_jual">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="ket-input">Tidak termasuk pajak</div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <div class="ket-input">Tidak termasuk pajak</div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <div class="ket-input">Termasuk pajak</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer justify-content-center align-items-center" style="border-top: 0 solid #e6e7e9 !important">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="d-grid">
                                        <button type="submit" id="btn-submit" class="btn btn-primary btn-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="btn-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="12" r="9"></circle>
                                                <path d="M9 12l2 2l4 -4"></path>
                                            </svg>
                                            <span id="btn-icon"></span>
                                            <span id="btn-text">Simpan Data</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $this->load->view('layouts/admin/footer'); ?>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.6.0/dist/autoNumeric.min.js"></script>

<script>
    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

    function clearImage() {
        document.getElementById('formFile').value = null;
        frame.src = "";
    }

    var kategori = new Choices(document.getElementById('select_kategori'));
    var supplier = new Choices(document.getElementById('select_supplier'));
    var satuan = new Choices(document.getElementById('select_satuan'));

    function roundToNearest(value, nearest) {
        if (isNaN(value)) return 0; // Pastikan tidak ada nilai NaN
        return Math.round(value / nearest) * nearest;
    }

    $(document).ready(function() {
		// Inisialisasi awal hanya sekali
		const autoNumericElements = AutoNumeric.multiple('.input-formatted-currency', {
			digitGroupSeparator: '.',
			decimalCharacter: ',',
			decimalPlaces: 0,
			currencySymbol: 'Rp ',
			currencySymbolPlacement: 'p',
		});

        $("#hpp").on("input", function() {
            var hppValue = AutoNumeric.getAutoNumericElement(this).getNumber() || 0; // Pastikan nilai valid
            var markup = parseFloat($("#markup_barang").val()) || 0;

            if (!isNaN(hppValue)) {
                var hargaJual = roundToNearest(hppValue * (1 + markup / 100), 500); // Kalkulasi harga jual
				AutoNumeric.getAutoNumericElement("#harga_jual_barang").set(hargaJual);
				AutoNumeric.getAutoNumericElement("#total_jual").set(hargaJual); // Update total jual
            }
        });

        $("#markup_barang").on("input", function() {
            var markup = parseFloat($(this).val()) || 0; // Pastikan nilai valid
            var hpp = AutoNumeric.getAutoNumericElement("#hpp").getNumber() || 0;

            if (!isNaN(hpp)) {
                var hargaJual = roundToNearest(hpp * (1 + markup / 100), 500); // Kalkulasi harga jual
                AutoNumeric.getAutoNumericElement("#harga_jual_barang").set(hargaJual);
				AutoNumeric.getAutoNumericElement("#total_jual").set(hargaJual);
            }
        });

        $("#ppn").change(function() {
            var ppnOption = $(this).val();
            var markup = parseFloat($("#markup_barang").val()) || 0;
            var hpp = AutoNumeric.getAutoNumericElement("#hpp").getNumber() || 0;

            if (!isNaN(hpp)) {
				var hargaJual = roundToNearest(hpp * (1 + markup / 100), 500);

                if (ppnOption === "Y") {
                    hargaJual += hargaJual * 0.10; // Tambahkan PPN 10%
                }

				AutoNumeric.getAutoNumericElement("#total_jual").set(hargaJual);
            }
        });

		$("#form-product").on("submit", function (e) {
			$(".input-formatted-currency").each(function () {
				const anElement = AutoNumeric.getAutoNumericElement(this);
				if (anElement) {
				const rawValue = anElement.getNumber(); // ambil angka asli
					$(this).val(rawValue); // set ke input sebelum disubmit
				}
			});
		});
    });
</script>
</body>

</html>
