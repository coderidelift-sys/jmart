<?php $this->load->view('layouts/user/head'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
<style>
	.category-slider {
		background-color: #fff;
		border-radius: 10px;
		padding: 10px;
		overflow: hidden;
	}

	.shadow-n {
		box-shadow: 0 1px 3px rgb(214 221 237 / 50%), 0 1px 2px rgb(214 221 237 / 50%);
	}

	.swiper-container {
		width: 100%;
		margin: 0 auto;
		overflow: hidden;
	}

	.swiper-slide {
		text-align: center;
		padding: 20px;
		background-color: #f1f1f1;
		color: #333;
		white-space: nowrap;
	}

	.tagihan-card {
		border: 1px solid rgba(0, 0, 0, .125);
		box-shadow: 0 2px 4px 0 rgb(71 70 69 / 40%) !important;
		padding: 15px;
		margin-bottom: 20px;
		background-color: white;
	}

	.tagihan-title {
		font-size: 18px;
		margin-bottom: 10px;
	}

	.tagihan-info {
		font-size: 14px;
		color: #888;
	}

	.tagihan-amount {
		font-size: 20px;
		font-weight: bold;
		margin-top: 10px;
		color: red;
	}

	.content {
		margin: 20px 15px 0px 15px;
	}

	.gradient-green {
		background-image: linear-gradient(to bottom, #A0D468, #8CC152);
	}
</style>
<?php $this->load->view('layouts/user/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
	<div class="container">
		<div class="nav-bar__left">
			<h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Pesanan</h1>
		</div>
	</div>
</nav>

<section class="mt-4 mb-4">
	<div class="container">
		<div class="card">
			<div class="content fw-bold d-flex justify-content-between">
				<div>
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: blue;">
						<path d="M19 4h-3V2h-2v2h-4V2H8v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zM5 20V7h14V6l.002 14H5z"></path>
						<path d="M7 9h10v2H7zm0 4h5v2H7z"></path>
					</svg>
					Pesanan Anda
				</div>
				<a href="<?= base_url('pesanan/pending') ?>" class="text-end">
					Lihat Riwayat Pesanan
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: blue;">
						<path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path>
					</svg>
				</a>
			</div>
			<div class="card-body">
				<div class="swiper-container">
					<div class="swiper-wrapper mb-3">
						<a href="<?= base_url('pesanan/pending') ?>" class="swiper-slide">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
								<path d="M15.566 11.021A7.016 7.016 0 0 0 19 5V4h1V2H4v2h1v1a7.016 7.016 0 0 0 3.434 6.021c.354.208.566.545.566.9v.158c0 .354-.212.69-.566.9A7.016 7.016 0 0 0 5 19v1H4v2h16v-2h-1v-1a7.014 7.014 0 0 0-3.433-6.02c-.355-.21-.567-.547-.567-.901v-.158c0-.355.212-.692.566-.9zM17 19v1H7v-1a5.01 5.01 0 0 1 2.45-4.299A3.111 3.111 0 0 0 10.834 13h2.332c.23.691.704 1.3 1.385 1.702A5.008 5.008 0 0 1 17 19z"></path>
							</svg>
							<br>
							<span style="font-size: 12px;">Pending <br><span class="badge bg-danger text-white"><?= $count_pending ?></span></span>
						</a>
						<a href="<?= base_url('pesanan/dikemas') ?>" class="swiper-slide">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
								<path d="M21.993 7.95a.96.96 0 0 0-.029-.214c-.007-.025-.021-.049-.03-.074-.021-.057-.04-.113-.07-.165-.016-.027-.038-.049-.057-.075-.032-.045-.063-.091-.102-.13-.023-.022-.053-.04-.078-.061-.039-.032-.075-.067-.12-.094-.004-.003-.009-.003-.014-.006l-.008-.006-8.979-4.99a1.002 1.002 0 0 0-.97-.001l-9.021 4.99c-.003.003-.006.007-.011.01l-.01.004c-.035.02-.061.049-.094.073-.036.027-.074.051-.106.082-.03.031-.053.067-.079.102-.027.035-.057.066-.079.104-.026.043-.04.092-.059.139-.014.033-.032.064-.041.1a.975.975 0 0 0-.029.21c-.001.017-.007.032-.007.05V16c0 .363.197.698.515.874l8.978 4.987.001.001.002.001.02.011c.043.024.09.037.135.054.032.013.063.03.097.039a1.013 1.013 0 0 0 .506 0c.033-.009.064-.026.097-.039.045-.017.092-.029.135-.054l.02-.011.002-.001.001-.001 8.978-4.987c.316-.176.513-.511.513-.874V7.998c0-.017-.006-.031-.007-.048zm-10.021 3.922L5.058 8.005 7.82 6.477l6.834 3.905-2.682 1.49zm.048-7.719L18.941 8l-2.244 1.247-6.83-3.903 2.153-1.191zM13 19.301l.002-5.679L16 11.944V15l2-1v-3.175l2-1.119v5.705l-7 3.89z"></path>
							</svg>
							<br>
							<span style="font-size: 12px;">Dikemas <br><span class="badge bg-warning text-white"><?= $count_dikemas ?></span></span>
						</a>
						<a href="<?= base_url('pesanan/dikirim') ?>" class="swiper-slide">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
								<path d="m20.772 10.155-1.368-4.104A2.995 2.995 0 0 0 16.559 4H7.441a2.995 2.995 0 0 0-2.845 2.051l-1.368 4.104A2 2 0 0 0 2 12v5c0 .738.404 1.376 1 1.723V21a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2h12v2a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2.277A1.99 1.99 0 0 0 22 17v-5a2 2 0 0 0-1.228-1.845zM7.441 6h9.117c.431 0 .813.274.949.684L18.613 10H5.387l1.105-3.316A1 1 0 0 1 7.441 6zM5.5 16a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 5.5 16zm13 0a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 18.5 16z"></path>
							</svg>
							<br>
							<span style="font-size: 12px;">Dikirim <br><span class="badge bg-primary text-white"><?= $count_dikirim ?></span></span>
						</a>
						<a href="<?= base_url('pesanan/selesai') ?>" class="swiper-slide">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
								<path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path>
							</svg>
							<br>
							<span style="font-size: 12px;">Selesai <br><span class="badge bg-success text-white"><?= $count_selesai ?></span></span>
						</a>
						<a href="<?= base_url('pesanan/autodebit') ?>" class="swiper-slide">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
								<path d="M15.999 8.5h2c0-2.837-2.755-4.131-5-4.429V2h-2v2.071c-2.245.298-5 1.592-5 4.429 0 2.706 2.666 4.113 5 4.43v4.97c-1.448-.251-3-1.024-3-2.4h-2c0 2.589 2.425 4.119 5 4.436V22h2v-2.07c2.245-.298 5-1.593 5-4.43s-2.755-4.131-5-4.429V6.1c1.33.239 3 .941 3 2.4zm-8 0c0-1.459 1.67-2.161 3-2.4v4.799c-1.371-.253-3-1.002-3-2.399zm8 7c0 1.459-1.67 2.161-3 2.4v-4.8c1.33.239 3 .941 3 2.4z"></path>
							</svg>
							<br>
							<span style="font-size: 12px;">Autodebit <br><span class="badge bg-purple text-white"><?= $count_autodebit ?></span></span>
						</a>
						<a href="#" class="swiper-slide">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
								<path d="M19 4h-3V2h-2v2h-4V2H8v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zM5 20V7h14V6l.002 14H5z"></path>
								<path d="M7 9h10v2H7zm0 4h5v2H7z"></path>
							</svg>
							<br>
							<span style="font-size: 12px;">Rating <br><span class="text-white">
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" style="fill: yellow;">
										<path d="M21.947 9.179a1.001 1.001 0 0 0-.868-.676l-5.701-.453-2.467-5.461a.998.998 0 0 0-1.822-.001L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.213 4.107-1.49 6.452a1 1 0 0 0 1.53 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082c.297-.268.406-.686.278-1.065z"></path>
									</svg>
								</span>
							</span>
						</a>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-6">
				<div class="card ps-3 text-uppercase pt-4">
					<h3 class="text-dark fa-3x"><?= $count_bulan_ini ?></h3>
					<h5 class="text-dark pb-3">Belanja Bulan Ini</h5>
					<p style="font-size: 20px;font-weight: bold;" class="text-danger text-capitalize font-11 opacity-70 mb-2"> Rp. <?= number_format($rupiah_bulan_ini->total_grand_total) ?></p>
				</div>
			</div>
			<div class="col-6">
				<div class="card ps-3 text-uppercase pt-4">
					<h3 class="text-dark fa-3x"><?= count($pesanan) ?></h3>
					<h5 class="text-dark pb-3">Total Belanja</h5>
					<p style="font-size: 20px;font-weight: bold;" class="text-danger text-capitalize font-11 opacity-70 mb-2"> Rp. <?= number_format($rupiah_semua->total_grand_total) ?></p>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-6 d-flex">
				<div class="card ps-3 text-uppercase pt-4 w-100">
					<!-- <div class="d-flex justify-content-between align-items-center mb-2">
						<a href="?offset=<?= $offset - 1 ?>" class="btn btn-sm btn-outline-primary">
							&laquo;
						</a>

						<?php if (!$is_last_period): ?>
							<a href="?offset=<?= $offset + 1 ?>" class="btn btn-sm btn-outline-primary" style="margin-right: 1rem;">
								&raquo;
							</a>
						<?php endif; ?>
					</div> -->

					<h5 class="text-dark mb-0">Autodebit Bulan <?= $bulan_tahun ?></h5>
					<small class="pb-3">
						<?= date('d/m/Y', strtotime($start_date)) . ' - ' . date('d/m/Y', strtotime($end_date)); ?>
					</small>
					<p style="font-size: 20px;font-weight: bold;" class="text-danger text-capitalize font-11 opacity-70 mb-2">
						Rp. <?= number_format($autodebit_bulan_ini) ?>
					</p>
				</div>
			</div>
			<div class="col-6 d-flex">
				<div class="card ps-3 text-uppercase pt-4 w-100">
					<!-- <h3 class="text-dark fa-3x"><?= count($pesanan) ?></h3> -->
					<h5 class="text-dark pb-3">Total Autodebit</h5>
					<p style="font-size: 20px;font-weight: bold;" class="text-danger text-capitalize font-11 opacity-70 mb-2"> Rp. <?= number_format($autodebit) ?></p>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-12 mb-3">
				<form class="form-inline" action="<?= base_url('pesanan') ?>" method="get">
					<div class="form-group mr-2">
						<label for="tahun" class="fw-bold mr-2">Filter Tahun:</label>
						<div class="row w-100">
							<div class="col-8">
								<select name="tahun" id="tahun" class="form-control w-100">
									<?php for ($i = date('Y'); $i >= date('Y') - 2; $i--) : ?>
										<option value="<?= $i ?>" <?= $i == $this->input->get('tahun') ? 'selected' : '' ?>><?= $i ?></option>
									<?php endfor; ?>
								</select>
							</div>
							<div class="col-4">
								<button type="submit" class="btn btn-primary w-100">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
										<path d="M21 3H5a1 1 0 0 0-1 1v2.59c0 .523.213 1.037.583 1.407L10 13.414V21a1.001 1.001 0 0 0 1.447.895l4-2c.339-.17.553-.516.553-.895v-5.586l5.417-5.417c.37-.37.583-.884.583-1.407V4a1 1 0 0 0-1-1zm-6.707 9.293A.996.996 0 0 0 14 13v5.382l-2 1V13a.996.996 0 0 0-.293-.707L6 6.59V5h14.001l.002 1.583-5.71 5.71z"></path>
									</svg>
									&nbsp;&nbsp;Filter Tahun
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-12">
				<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
			</div>
		</div>
	</div>
</section>

<div class="row">
	<br><br><br><br>
</div>

<?php $this->load->view('layouts/user/menu'); ?>
<?php $this->load->view('layouts/user/footer'); ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
	Highcharts.chart('container', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Grafik Belanja per Bulan'
		},
		xAxis: {
			categories: [
				'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
				'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
			],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Total Belanja (IDR)'
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y:.1f} IDR</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		series: [{
			name: 'Total Belanja Tahun <?= $this->input->get('tahun') ? $this->input->get('tahun') : date('Y') ?>',
			data: [
				<?php foreach ($penjualan as $data) : ?>
					<?= $data ?>,
				<?php endforeach; ?>
			]
		}]
	});
</script>
<script>
	var swiper = new Swiper('.swiper-container', {
		slidesPerView: 3, // Jumlah slide yang akan ditampilkan
		spaceBetween: 10, // Jarak antara slide
		pagination: {
			el: '.swiper-pagination', // Navigasi paginasi
			clickable: true, // Mengaktifkan navigasi klik pada paginasi
		},
	});
</script>
</body>

</html>
