<?php $this->load->view('layouts/admin/head'); ?>
<style>
	/* CSS untuk mengatur tampilan gambar */
	.image-container {
		display: flex;
		flex-wrap: wrap;
	}

	.image-item {
		width: 10%;
		/* Setiap gambar akan mendapatkan 10% lebar */
		margin: 1%;
		/* Sedikit jarak antara gambar */
		position: relative;
	}

	.image-delete {
		position: absolute;
		top: 0;
		right: 0;
		background-color: red;
		/* Latar belakang warna merah */
		color: white;
		/* Warna teks putih */
		padding: 2px 5px;
		cursor: pointer;
	}

	.blue {
		color: #428bca !important;
	}
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<!-- CONTAIN DISINI -->
<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<h2 class="page-title">
					Import Barang
				</h2>
			</div>
		</div>
	</div>
</div>
<div class="page-body">
	<div class="container-xl">
		<div class="row mb-3">
			<div class="col-md-6">
				<?php if ($this->session->flashdata('error_rows')): ?>
					<div class="alert alert-warning">
						<strong>Data yang tidak bisa disimpan:</strong>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode</th>
									<th>Barcode</th>
									<th>Nama</th>
									<th>Kategori</th>
									<th>Supplier</th>
									<th>Satuan</th>
									<th>Alasan Error</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($this->session->flashdata('error_rows') as $i => $row): ?>
									<tr>
										<td><?= $i + 1 ?></td>
										<td><?= htmlspecialchars($row[1] ?? '-') ?></td>
										<td><?= htmlspecialchars($row[3] ?? '-') ?></td>
										<td><?= htmlspecialchars($row[2] ?? '-') ?></td>
										<td><?= htmlspecialchars($row[4] ?? '-') ?></td>
										<td><?= htmlspecialchars($row[5] ?? '-') ?></td>
										<td><?= htmlspecialchars($row[10] ?? '-') ?></td>
										<td><?= htmlspecialchars($row['error_reason'] ?? '-') ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>


				<?php if ($this->session->flashdata('success_message')) : ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('success_message') ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif ?>

				<?php if ($this->session->flashdata('error_message')) : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('error_message') ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif ?>

				<div class="card" style="margin-top: -5px !important;">
					<div class="card-header text-center" style="padding: 0.5rem 1rem;margin-bottom: 0;background: #f7f7f8;border-bottom: 1px solid rgba(0, 0, 0, .125);border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;">
						<h2 style="font-size: 16px;line-height: 16px;font-weight: 700;font-family: ubuntu,sans-serif;float: left;padding: 10px 0;margin: 0 0 0 20px;" class="blue"><i style="border-right: 1px solid #dbdee0;padding: 12px 0;height: 40px;width: 40px;display: inline-block;text-align: center;margin: -10px 20px -10px -20px;font-size: 16px;" class="fa fa-upload"></i>Import Barang</h2>
					</div>
					<div class="card-body">
						<form action="<?= base_url('product/simpan_import') ?>" method="POST" enctype="multipart/form-data">
							<div class="form-group mb-3">
								<label for="path_absolute" class="form-label required">Path Absolute</label>
								<input name="path_absolute" id="path_absolute" type="text" class="form-control" style="flex: 1;" placeholder="Masukan Path Absolute Anda">
							</div>
							<div class="form-group mb-3">
								<label for="file_excel" class="form-label required">Import Excel</label>
								<input name="file_excel" id="file_excel" type="file" class="form-control" style="flex: 1;" accept=".xls,.xlsx,.csv">
							</div>
							<div class="form-group mb-3">
								<button type="submit" class="btn w-100 btn-primary">Unggah Data</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-12">
				<div class="card mt-3">
					<div class="card-header" style="padding: 0.5rem 1rem;margin-bottom: 0;background: #f7f7f8;border-bottom: 1px solid rgba(0, 0, 0, .125);border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;">
						<h2 style="font-size: 16px;line-height: 16px;font-weight: 700;font-family: ubuntu,sans-serif;float: left;padding: 10px 0;margin: 0 0 0 20px;" class="blue"><i style="border-right: 1px solid #dbdee0;padding: 12px 0;height: 40px;width: 40px;display: inline-block;text-align: center;margin: -10px 20px -10px -20px;font-size: 16px;" class="fa fa-chart-bar"></i>Syarat dan Ketentuan</h2>
					</div>
					<div class="card-body">
						<p class="text-secondary">
							<img src="https://tmuk00294.foliopos.com/v2/assets/img/import-product-template.jpg" alt="">
						</p>
						<div class="text-center justify-content-center">
							<button onclick="location.href='<?= base_url('public/template/upload/barang/sample.xls') ?>'" class="btn btn-primary">
								<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
									<path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
									<path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3"></path>
								</svg>
								Unduh Template
							</button>
						</div>
						<div class="card-title mt-2">Cara penggunaan template "Import Produk"</div>
						<ol>
							<li>Download Template yang telah disediakan.</li>
							<li>Buatkan Satu Folder Khusus untuk menampung data barang</li>
							<span>
								<img src="<?= base_url('public/template/upload/sample/sample1.jpg') ?>" alt="" srcset="">
							</span>
							<small class="d-block text-center">Gambar 1 Buat Folder</small>
							<li>Simpan Semua Daftar Gambar yang mau ditambahkan</li>
							<li>Tambahkan Data barang yang mau diimport dan sesuaikan dengan field yang ada pada template</li>
							<span>
								<img src="<?= base_url('public/template/upload/sample/sample2.jpg') ?>" alt="" srcset="">
							</span>
							<small class="d-block text-center">Gambar 2 Download File dan Gambar</small>
							<li>Tambahkan Isian Field yang ingin di import, serta pada bagian gambar tambahkan hyperlink ke gambar terkait, atau dengan menekan Ctrl+K</li>
							<span>
								<img src="<?= base_url('public/template/upload/sample/sample5.jpg') ?>" alt="" srcset="">
							</span>
							<small class="d-block text-center">Gambar 3 Field Uploads</small>
							<li>Copy Path dari Folder Anda sebagai Path Absolut</li>
							<span>
								<img src="<?= base_url('public/template/upload/sample/sample3.jpg') ?>" alt="" srcset="">
							</span>
							<small class="d-block text-center">Gambar 4 Copy Path Absoulte</small>
							<li>Pastekan ke Halaman Import</li>
							<span>
								<img src="<?= base_url('public/template/upload/sample/sample4.jpg') ?>" alt="" srcset="">
							</span>
							<small class="d-block text-center">Gambar 5 Pastekan ke Halaman Import</small>
							<li>Import dan Tunggu Proses Hingga Selesai.</li>
							<li><strong>Syarat dan Ketentuan:</strong><br>Jika path absoulte yang anda masukkan tidak ditemukan, maka gambar akan di generate secara default. Jadi harap test upload file sample dulu.</li>
						</ol>
					</div>
					<div class="card-footer"></div>
				</div>

			</div>
		</div>
	</div>
</div>
<?php $this->load->view('layouts/admin/footer'); ?>
</body>

</html>
