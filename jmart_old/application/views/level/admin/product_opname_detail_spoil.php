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
					<a href="<?= base_url('product/opname') ?>" class="btn btn-primary me-1">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
						</svg>
						Kembali
					</a>
				</div>
				<?php if ($open == TRUE) : ?>
					<div class="btn-group">
						<a href="<?= base_url('product/opname/ubah/' . $id) ?>" class="btn btn-warning me-1">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
								<path stroke="none" d="M0 0h24v24H0z" fill="none" />
								<path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
								<path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
								<path d="M16 5l3 3" />
							</svg>
							Ubah
						</a>
					</div>
				<?php endif ?>
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
							Lihat Detail Barang Rusak
						</h3>
					</div>
					<div class="card-body">
						<div class="row g-3">
							<div class="col-md-6">
								<div class="mb-3 row">
									<label class="col-3 col-form-label required">Nama Opname</label>
									<div class="col">
										<textarea readonly name="nama_opname" id="nama_opname" class="form-control" rows="3" placeholder="Masukan Nama Opname"><?= $detail['nama_opname'] ?></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3 row">
									<label class="col-3 col-form-label required">Catatan</label>
									<div class="col">
										<textarea readonly name="catatan_opname" id="catatan_opname" class="form-control" rows="3" placeholder="Masukan Catatan"><?= $detail['catatan_opname'] ?></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="row g-3">
							<div class="col-md-6">
								<div class="mb-3 row">
									<label class="col-3 col-form-label required">Pilih Status</label>
									<div class="col">
										<select readonly disabled name="tipe_opname" id="tipe_opname" class="form-control" required>
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
										<input readonly name="tgl_opname" id="tgl_opname" type="datetime-local" class="form-control" value="<?php echo date('Y-m-d\TH:i:s', strtotime($detail['tgl_opname'])); ?>">
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
							<table class="table table-hover" id="dataProduk" style="width: 100%;">
								<thead>
									<tr>
										<th>No</th>
										<th>Produk</th>
										<th>Barcode</th>
										<th>Stock Aplikasi</th>
										<th>Barang Rusak</th>
										<th>Stock Fisik</th>
										<th>Kerugian (Rp.)</th>
									</tr>
								</thead>
								<tbody>
									<?php $total_kerugian = 0;
									foreach ($produk as $key => $value) : $kerugian = $value['jumlah_rusak'] * $value['harga_saat_ini'];
										$total_kerugian += $kerugian; ?>
										<tr>
											<td><?= $key + 1 ?></td>
											<td><?= $value['nama_barang'] ?></td>
											<td><?= $value['barcode'] ?></td>
											<td><?= $value['stock_aplikasi'] ?></td>
											<td><?= $value['jumlah_rusak'] ?></td>
											<td><?= $value['stock_aplikasi'] - $value['jumlah_rusak'] ?></td>
											<td>
												<?= "Rp. -" .  number_format($kerugian) ?>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="6" class="fw-bold text-end">Total</td>
										<td colspan="1"><?= "Rp. -" .  number_format($total_kerugian) ?></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('layouts/admin/footer'); ?>
<!-- jQuery dan DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

<!-- Choices.js dan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables Buttons -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
	$('#dataProduk').DataTable({
		ordering: false,
		dom: 'Bfrtip',
		buttons: [{
				extend: 'excelHtml5',
				title: 'List Produk' // Judul file Excel
			}, {
				extend: 'csvHtml5',
				title: 'List Produk',
				customize: function(csv) {
					// Ambil data dari elemen form untuk header
					var namaOpname = $('#nama_opname').val();
					var catatanOpname = $('#catatan_opname').val();
					var statusOpname = $('#tipe_opname option:selected').text();
					var tglOpname = $('#tgl_opname').val();

					// Format tanggal ke format Indonesia (DD/MM/YYYY HH:mm)
					var formattedTglOpname = new Date(tglOpname).toLocaleString('id-ID', {
						day: '2-digit',
						month: '2-digit',
						year: 'numeric',
						hour: '2-digit',
						minute: '2-digit'
					});

					// Menambahkan informasi tambahan sebelum data tabel CSV
					var extraInfo = [
						'Nama Opname: ' + namaOpname,
						'Catatan: ' + catatanOpname,
						'Status: ' + statusOpname,
						'Tanggal Opname: ' + formattedTglOpname,
						'' // Baris kosong
					];

					// Gabungkan informasi tambahan dengan CSV data
					return extraInfo.join('\n') + '\n' + csv;
				}
			},
			{
				extend: 'print',
				title: 'List Produk',
				customize: function(win) {
					var body = $(win.document.body);

					// Ambil data dari elemen form untuk header
					var namaOpname = $('#nama_opname').val();
					var catatanOpname = $('#catatan_opname').val();
					var statusOpname = $('#tipe_opname option:selected').text();
					var tglOpname = $('#tgl_opname').val();

					// Format tanggal ke format Indonesia (DD/MM/YYYY HH:mm)
					var formattedTglOpname = new Date(tglOpname).toLocaleString('id-ID', {
						day: '2-digit',
						month: '2-digit',
						year: 'numeric',
						hour: '2-digit',
						minute: '2-digit'
					});

					// Tambahkan informasi tambahan sebelum tabel
					body.prepend('<h3>Nama Opname: ' + namaOpname + '</h3>');
					body.prepend('<h3>Catatan: ' + catatanOpname + '</h3>');
					body.prepend('<h3>Status: ' + statusOpname + '</h3>');
					body.prepend('<h3>Tanggal Opname: ' + formattedTglOpname + '</h3>');

					// Menambahkan gaya CSS agar informasi lebih jelas terlihat
					body.find('h3').css({
						'font-weight': 'bold',
						'margin-top': '20px'
					});
				}
			}
		]
	});
</script>

</body>

</html>