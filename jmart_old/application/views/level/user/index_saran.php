<?php $this->load->view('layouts/user/head'); ?>
<style>
	.navbar__left {
		width: 4rem;
		z-index: 2;
	}
</style>
<?php $this->load->view('layouts/user/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
	<div class="container nav-bar__on-container">
		<div class="navbar__left">
			<a href="<?= base_url('home') ?>">
				<svg class="navbar__left__icon fw-bold text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);cursor:pointer;z-index: 2;">
					<path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
				</svg>
			</a>
		</div>
		<div class="nav-bar__center">
			<h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Kritik dan Saran</h1>
		</div>
	</div>
</nav>

<section class="mt-4 mb-4">
	<div class="container">
		<?php
		// Periksa apakah ada flash data dengan key 'success_message'
		if ($this->session->flashdata('success_message')) {
			// Jika ada, tampilkan pesan menggunakan JavaScript alert
			$pesan = $this->session->flashdata('success_message');
			echo "<script>alert('$pesan');</script>";
		}
		?>
		<div class="card" style="background-image: url('public/template/img/illustrations/path-card.svg');background-position: bottom right;background-repeat: no-repeat;">
			<div class="card-body">
				<h4>Form Penyampaian Kritik dan Saran</h4>
				<form method="POST" action="<?= base_url('home/plus_saran2') ?>">
					<div class="mb-3">
						<label class="form-label" for="basic-icon-default-fullname">Member ID</label>
						<input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
						<input type="hidden" name="nama_user" value="<?= $user['nama_member'] ?>">
						<input type="hidden" id="wa_member" name="wa_member" value="6285277961769">
						<span class="fw-light"><?= $user['nomor_induk'] ?></span>
					</div>
					<div class="mb-3">
						<label class="form-label" for="basic-icon-default-company">Perihal <span style="color: red !important;font-weight: bold;"><sup>*</sup></span></label>
						<div class="input-group input-group-merge">
							<span id="basic-icon-default-company2" class="input-group-text">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
									<path d="M21 2H6a2 2 0 0 0-2 2v3H2v2h2v2H2v2h2v2H2v2h2v3a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zm-8 2.999c1.648 0 3 1.351 3 3A3.012 3.012 0 0 1 13 11c-1.647 0-3-1.353-3-3.001 0-1.649 1.353-3 3-3zM19 18H7v-.75c0-2.219 2.705-4.5 6-4.5s6 2.281 6 4.5V18z"></path>
								</svg>
							</span>
							<select required name="perihal" id="perihal" class="form-select">
								<option value="">Tolong Pilih Perihal</option>
								<option value="Beranda">Beranda</option>
								<option value="Keranjang">Keranjang</option>
								<option value="Promo">Promo</option>
								<option value="Pesanan">Pesanan</option>
								<option value="Akun">Akun</option>
								<option value="Lainnya">Lainnya</option>
							</select>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label" for="basic-default-message">Kritik dan Saran <span style="color: red !important;font-weight: bold;"><sup>*</sup></span></label>
						<textarea rows="10" id="basic-default-message" class="form-control" id="kritik_saran" name="kritik_saran" placeholder="Ex : Tolong dong di keranjang buat opsi untuk kode voucher agar bisa mendapatkan diskon!"></textarea>
					</div>
					<div class="mb-3">
						<label class="form-label" for="basic-icon-default-fullname">Waktu</label><br>
						<span class="fw-light fs-6"><?= date('d-m-Y H:i:s') ?></span>
					</div>
					<div class="mb-3">
						<span style="color: red !important;font-weight: bold;"><sup>**</sup></span> Kritik dan Saran dari Anda akan terkirim langsung kepada Pimpinan J-Mart serta dijamin kerahasiaannya.
					</div>
					<br>
					<button id="btn-wa" type="submit" class="btn btn-primary">Submit</button>
					<button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-success">List Kritik/Saran Anda</button>
				</form>
			</div>
		</div>
	</div>
</section>

<div class="row">
	<br><br><br><br>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Kritik dan Saran</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" style="height: 60vh;overflow-y: auto;">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Member ID</th>
								<th scope="col">Perihal</th>
								<th scope="col">Kritik dan Saran</th>
								<th scope="col">Waktu</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($saran as $key => $value) : ?>
								<tr>
									<td><?= $value['nomor_induk'] ?></td>
									<td><?= $value['perihal'] ?></td>
									<td><?= $value['kritik_saran'] ?></td>
									<td>
										<?php
										$tanggal_string = $value['created_at'];
										$tanggal_format = date('d/m/y H:i:s', strtotime($tanggal_string));
										echo $tanggal_format;
										?>
									</td>
								</tr>
							<?php endforeach ?>
							<!-- Tambahkan baris tabel lainnya sesuai data yang ingin ditampilkan -->
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('layouts/user/menu'); ?>
<?php $this->load->view('layouts/user/footer'); ?>
</body>

</html>