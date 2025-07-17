<?php $this->load->view('layouts/user/head'); ?>
<style>
	.order-calculations .w-px-150 {
		min-width: 150px;
		display: inline-block;
	}


	.content {
		margin: 20px 15px 0px 15px;
	}
</style>
<?php $this->load->view('layouts/user/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
	<div class="container nav-bar__on-container" style="display: flex;">
		<div class="navbar__left" style="z-index: 10;">
			<a href="<?= base_url('pesanan/pending') ?>">
				<svg class="navbar__left__icon fw-bold text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);cursor:pointer;z-index: 2;">
					<path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
				</svg>
			</a>
		</div>
		<div class="nav-bar__center">
			<h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Rincian Pesanan</h1>
		</div>
	</div>
</nav>

<div class="header-landing">
	<div class="card" style="background-color: #26aa99;border-radius: 0px !important;">
		<div class="card-body text-white text-left">
			<?php if ($detail['status_pesanan'] == "Pending") : ?>
				<div class="row">
					<div class="col-9">
						<span class="fw-bold fs-2 d-block">Pesanan Pending</span>
						<span class="dblock fsize-m-2 mar-top--x-2">
							Pesanan Anda sedang dalam proses verifikasi. Kami akan segera meninjau dan mengonfirmasi pesanan Anda..
						</span>
					</div>
					<div class="col-3 text-center">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
							<path d="M15.566 11.021A7.016 7.016 0 0 0 19 5V4h1V2H4v2h1v1a7.016 7.016 0 0 0 3.434 6.021c.354.208.566.545.566.9v.158c0 .354-.212.69-.566.9A7.016 7.016 0 0 0 5 19v1H4v2h16v-2h-1v-1a7.014 7.014 0 0 0-3.433-6.02c-.355-.21-.567-.547-.567-.901v-.158c0-.355.212-.692.566-.9zM17 19v1H7v-1a5.01 5.01 0 0 1 2.45-4.299A3.111 3.111 0 0 0 10.834 13h2.332c.23.691.704 1.3 1.385 1.702A5.008 5.008 0 0 1 17 19z"></path>
						</svg>
					</div>
				</div>
			<?php elseif ($detail['status_pesanan'] == "Dikemas") : ?>
				<div class="row">
					<div class="col-9">
						<span class="fw-bold fs-2 d-block">Pesanan Dikemas</span>
						<span class="dblock fsize-m-2 mar-top--x-2">
							Pesanan Anda telah berhasil diverifikasi dan saat ini dalam proses pengemasan. Kami sedang menyiapkan barang Anda untuk pengiriman..
						</span>
					</div>
					<div class="col-3 text-center">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
							<path d="M21.993 7.95a.96.96 0 0 0-.029-.214c-.007-.025-.021-.049-.03-.074-.021-.057-.04-.113-.07-.165-.016-.027-.038-.049-.057-.075-.032-.045-.063-.091-.102-.13-.023-.022-.053-.04-.078-.061-.039-.032-.075-.067-.12-.094-.004-.003-.009-.003-.014-.006l-.008-.006-8.979-4.99a1.002 1.002 0 0 0-.97-.001l-9.021 4.99c-.003.003-.006.007-.011.01l-.01.004c-.035.02-.061.049-.094.073-.036.027-.074.051-.106.082-.03.031-.053.067-.079.102-.027.035-.057.066-.079.104-.026.043-.04.092-.059.139-.014.033-.032.064-.041.1a.975.975 0 0 0-.029.21c-.001.017-.007.032-.007.05V16c0 .363.197.698.515.874l8.978 4.987.001.001.002.001.02.011c.043.024.09.037.135.054.032.013.063.03.097.039a1.013 1.013 0 0 0 .506 0c.033-.009.064-.026.097-.039.045-.017.092-.029.135-.054l.02-.011.002-.001.001-.001 8.978-4.987c.316-.176.513-.511.513-.874V7.998c0-.017-.006-.031-.007-.048zm-10.021 3.922L5.058 8.005 7.82 6.477l6.834 3.905-2.682 1.49zm.048-7.719L18.941 8l-2.244 1.247-6.83-3.903 2.153-1.191zM13 19.301l.002-5.679L16 11.944V15l2-1v-3.175l2-1.119v5.705l-7 3.89z"></path>
						</svg>
					</div>
				</div>
			<?php elseif ($detail['status_pesanan'] == "Dikirim") : ?>
				<div class="row">
					<div class="col-9">
						<span class="fw-bold fs-2 d-block">Pesanan Dikirimkan</span>
						<span class="dblock fsize-m-2 mar-top--x-2">
							Pesanan Anda telah dikemas dan dikirimkan. Anda dapat melacak status pengiriman Anda menggunakan nomor pelacakan yang telah kami berikan.
						</span>
					</div>
					<div class="col-3 text-center">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
							<path d="m20.772 10.155-1.368-4.104A2.995 2.995 0 0 0 16.559 4H7.441a2.995 2.995 0 0 0-2.845 2.051l-1.368 4.104A2 2 0 0 0 2 12v5c0 .738.404 1.376 1 1.723V21a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2h12v2a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2.277A1.99 1.99 0 0 0 22 17v-5a2 2 0 0 0-1.228-1.845zM7.441 6h9.117c.431 0 .813.274.949.684L18.613 10H5.387l1.105-3.316A1 1 0 0 1 7.441 6zM5.5 16a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 5.5 16zm13 0a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 18.5 16z"></path>
						</svg>
					</div>
				</div>
			<?php elseif ($detail['status_pesanan'] == "Selesai") : ?>
				<div class="row">
					<div class="col-9">
						<span class="fw-bold fs-2 d-block">Pesanan Selesai</span>
						<span class="dblock fsize-m-2 mar-top--x-2">
							Selamat! Pesanan Anda telah tiba dengan aman. Terimakasih terlah berbelanja di toko kami.
						</span>
					</div>
					<div class="col-3 text-center">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
							<path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path>
						</svg>
					</div>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>

<div class="container mt-3">
	<div class="card" style="box-shadow: none !important;">
		<div class="content border-bottom fw-bol pb-1 d-flex justify-content-between">
			<div class="fw-bold text-info">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(66, 153, 225, 1);">
					<path d="m20.772 10.155-1.368-4.104A2.995 2.995 0 0 0 16.559 4H7.441a2.995 2.995 0 0 0-2.845 2.051l-1.368 4.104A2 2 0 0 0 2 12v5c0 .738.404 1.376 1 1.723V21a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2h12v2a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2.277A1.99 1.99 0 0 0 22 17v-5a2 2 0 0 0-1.228-1.845zM7.441 6h9.117c.431 0 .813.274.949.684L18.613 10H5.387l1.105-3.316A1 1 0 0 1 7.441 6zM5.5 16a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 5.5 16zm13 0a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 18.5 16z"></path>
				</svg>
				Informasi Pengiriman
			</div>
			<a class="fw-bold text-primary" href="<?= base_url('pesanan/tracking/' . $id) ?>">
				Lacak
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: blue;">
					<path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path>
				</svg>
			</a>
		</div>
		<div class="card-body pb-3">
			Regular <br>
			Kurir JMART - <?= $id ?>
			<div class="row mt-3">
				<div class="col-md-12">
					<?php foreach ($lacak as $key => $value) : ?>
						<div class="row">
							<div class="col-md-1">
								<span class="fa fa-check text-success"></span>
							</div>
							<div class="col-md-10 fw-bold text-success"><?= $value['status_tracking'] ?> Oleh <?= $value['level'] ?></div>
						</div>
						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-10 text-justify small">
								<?= date('d/F/Y H:i', strtotime($value['updated_at_tracking'])) ?>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container mt-3">
	<div class="card" style="box-shadow: none !important;">
		<div class="content pb-1 border-bottom fw-bold text-info">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(66, 153, 225, 1);">
				<circle cx="12" cy="12" r="4"></circle>
				<path d="M13 4.069V2h-2v2.069A8.01 8.01 0 0 0 4.069 11H2v2h2.069A8.008 8.008 0 0 0 11 19.931V22h2v-2.069A8.007 8.007 0 0 0 19.931 13H22v-2h-2.069A8.008 8.008 0 0 0 13 4.069zM12 18c-3.309 0-6-2.691-6-6s2.691-6 6-6 6 2.691 6 6-2.691 6-6 6z"></path>
			</svg> Alamat Pengiriman
		</div>
		<div class="card-body pb-3">
			<div class="">
				<div tabindex="0"><strong class="text-info">Nama Penerima &nbsp;&nbsp;:</strong> <?= $alamat['nama_penerima'] ?></div>
				<div>
					<span tabindex="0"><strong class="text-info">Kontak Penerima :</strong> <?= $alamat['kontak_penerima'] ?></span><br>
					<span tabindex="0"><strong class="
					text-info">Alamat Penerima :</strong> <?= $alamat['nama_desa'] ?> (<?= $alamat['detail_lainnya'] ?>), <?= $alamat['nama_kabupaten'] ?>, <?= $alamat['nama_kecamatan'] ?>, <?= $alamat['nama_provinsi'] ?>, Indonesia</span>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="mt-3 mb-4">
	<div class="container">
		<div class="card" style="box-shadow: none !important;border-radius: 0px !important;">
			<div class="content pb-1 border-bottom fw-bold text-info">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(66, 153, 225, 1);">
					<path d="M19 4h-3V2h-2v2h-4V2H8v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-7 10H7v-2h5v2zm5-4H7V8h10v2z"></path>
				</svg> Detail Pesanan Anda
			</div>
			<div class="card-body">
				<div class="card-datatable table-responsive">
					<table class="datatables-order-details table">
						<thead>
							<tr>
								<th></th>
								<th class="w-50">Produk</th>
								<th class="text-end">Total</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$total = 0;
							$totalSubHarga = 0;
							$totalDiskon = 0;
							foreach ($pesanan as $key => $value) : ?>
								<?php
								$total = $total + ($value['harga_jual_barang'] *  $value['jumlah_jual']);
								$harga = (int) $value['harga_jual_barang'];
								$jumlah = (int) $value['jumlah_jual'];
								$subtotal = $harga * $jumlah;
								$totalSubHarga += $subtotal;

								$diskon = 0;
								if ($value['promo_brg'] === 'On') {
									$diskon = ($harga - (int)$value['harga_promo']) * $jumlah;
									$totalDiskon += $diskon;
								}
								?>
								<tr>
									<td class="text-center mx-auto">
										<img height="50px" src="<?= base_url('public/template/upload/barang/' . $value['gambar_barang']) ?>" alt="">
									</td>
									<td>
										<span class="text-dark fw-bold"><?= $value['nama_barang'] ?></span><br>
										<?= "Rp. " . number_format($harga) . " x" . $jumlah ?>
									</td>
									<td class="text-orange text-end fw-bold">
										<?= "Rp. " . number_format($harga *  $jumlah) ?>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
					<div class="d-flex justify-content-end align-items-center m-3 mb-2 p-1">
						<div class="order-calculations">
							<div class="d-flex justify-content-between mb-2">
								<span class="w-px-150 fw-bold">Subtotal</span>
								<span class="text-heading">Rp. <?= number_format($totalSubHarga) ?></span>
							</div>
							<div class="d-flex justify-content-between mb-2">
								<span class="w-px-150 fw-bold">Diskon</span>
								<span class="text-heading">Rp. <?= number_format($totalDiskon) ?></span>
							</div>
							<div class="d-flex justify-content-between mb-2">
								<span class="w-px-150 fw-bold">Ongkir</span>
								<span class="text-heading">Rp. <?= number_format($detail['ongkos_kirim']) ?></span>
							</div>
							<div class="d-flex justify-content-between">
								<span class="w-px-150 fw-bold">Total</span>
								<span class="text-heading">Rp. <?= number_format($detail['grand_total']) ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer border-top">
				<div class="justify-content-between text-center d-flex">
					<span class="text-dark fw-bold">
						Bukti Transaksi
					</span>
					<!-- Link Download -->
					<a href="#" class="text-danger fw-bold float-end" onclick="confirmDownload('<?= base_url('pesanan/cetak/' . $value['id_pesanan']) ?>')">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="red">
							<path d="M8.267 14.68c-.184 0-.308.018-.372.036v1.178c.076.018.171.023.302.023.479 0 .774-.242.774-.651 0-.366-.254-.586-.704-.586zm3.487.012c-.2 0-.33.018-.407.036v2.61c.077.018.201.018.313.018.817.006 1.349-.444 1.349-1.396.006-.83-.479-1.268-1.255-1.268z"></path>
							<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM9.498 16.19c-.309.29-.765.42-1.296.42a2.23 2.23 0 0 1-.308-.018v1.426H7v-3.936A7.558 7.558 0 0 1 8.219 14c.557 0 .953.106 1.22.319.254.202.426.533.426.923-.001.392-.131.723-.367.948zm3.807 1.355c-.42.349-1.059.515-1.84.515-.468 0-.799-.03-1.024-.06v-3.917A7.947 7.947 0 0 1 11.66 14c.757 0 1.249.136 1.633.426.415.308.675.799.675 1.504 0 .763-.279 1.29-.663 1.615zM17 14.77h-1.532v.911H16.9v.734h-1.432v1.604h-.906V14.03H17v.74zM14 9h-1V4l5 5h-4z"></path>
						</svg>
						Download
					</a>

					<!-- SweetAlert Script (include if not already) -->
					<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

					<!-- Confirmation Script -->
					<script>
						function confirmDownload(url) {
							event.preventDefault(); // Prevent default action
							Swal.fire({
								title: 'Download?',
								text: "Apakah Anda yakin ingin mendownload file ini?",
								icon: 'question',
								showCancelButton: true,
								confirmButtonText: 'Ya, download!',
								cancelButtonText: 'Tidak',
								reverseButtons: true
							}).then((result) => {
								if (result.isConfirmed) {
									window.location.href = url;
								}
							});
						}
					</script>
				</div>
			</div>
		</div>
		<div class="card mt-3" style="box-shadow: none !important;border-radius: 0px !important;">
			<div class="content pb-1 border-bottom fw-bold text-info">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(66, 153, 225, 1);">
					<path d="M20 3H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm-9 14H5v-2h6v2zm8-4H5v-2h14v2zm0-4H5V7h14v2z"></path>
				</svg> Informasi Lanjutan
			</div>
			<div class="card-body">
				<div class="d-flex justify-content-between mb-2">
					<span class="w-px-150 fw-bold">No Pesanan</span>
					<span class="text-heading fw-bold">
						<?= $id ?> <span style="cursor: pointer;" onclick="return alert('Berhasil Disalin!')" class="text-primary">SALIN</span>
					</span>
				</div>
				<div class="d-flex justify-content-between mb-2">
					<span class="w-px-150 fw-bold">Waktu Pesanan</span>
					<span class="text-heading fw-bold">
						<?= date('d-m-Y H:i', strtotime($detail['tgl_pesanan'])) ?>
					</span>
				</div>
				<div class="d-flex justify-content-between mb-2">
					<span class="w-px-150 fw-bold">Metode Pembayaran</span>
					<span class="text-heading">
						<?php if ($detail['metode_bayar'] == "cash") : ?>
							<span class="text-success fw-bold">CASH</span>
						<?php elseif ($detail['metode_bayar'] == "transfer") : ?>
							<span class="text-orange fw-bold">TRANSFER</span>
						<?php elseif ($detail['metode_bayar'] == "autodebet") : ?>
							<span class="text-danger fw-bold">AUTODEBET</span>
						<?php endif ?>
					</span>
				</div>
				<div class="d-flex justify-content-between mb-2">
					<span class="w-px-150 fw-bold">Jenis Order</span>
					<span class="text-heading">
						<?php if ($detail['jenis_order'] == "ambil_sendiri") : ?>
							<span class="text-success fw-bold">AMBIL SENDIRI</span>
						<?php elseif ($detail['jenis_order'] == "dianterin") : ?>
							<span class="text-orange fw-bold">DIANTERIN</span>
						<?php elseif ($detail['jenis_order'] == "dianterin_pt") : ?>
							<span class="text-danger fw-bold">DIANTERIN KE PT</span>
						<?php endif ?>
					</span>
				</div>
				<div class="text-start mb-2">
					<span class="fw-bold">Keterangan: </span><br>
					<span class=" text-dark">
						<?= $detail['keterangan_pesanan'] ?>
					</span>
				</div>
			</div>
		</div>
		<a href="#" class="d-block btn btn-primary text-center justify-content-center mt-3">Beli Lagi</a>
	</div>
</section>

<div class="row">
	<br><br><br><br>
</div>

<?php $this->load->view('layouts/user/menu'); ?>
<?php $this->load->view('layouts/user/footer'); ?>
</body>

</html>
