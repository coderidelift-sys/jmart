<?php $this->load->view('layouts/user/head'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css" />
<style>
	@font-face {
		font-family: 'gotham_fonts';
		src: url('<?= base_url('') ?>public/fonts/GothamBook.ttf');
	}

	.navbar {
		width: 100%;
		height: 4rem;
		color: #fff;
		z-index: 1;
	}

	.nav-bar__center__title {
		position: absolute;
		font-size: 1.1rem;
		font-weight: normal;
		text-align: center;
		width: 100%;
		margin: 0;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.footer-nav {
		position: fixed;
		bottom: 0;
		background-color: #fff;
		width: 100%;
		z-index: 32;
		height: 60;
	}

	.footer-nav__link {
		text-align: center;
		padding: 0.8rem 0;
		display: block;
		color: #474645;
	}

	.footer-nav__link i {
		display: block;
		font-size: 2.8rem;
		margin-bottom: 0.5rem;
	}

	.footer-nav__link._active {
		color: #2F5596;
	}

	a:focus,
	a:hover {
		text-decoration: none;
		color: #2F5596;
	}

	.greeting-cs {
		background-color: #00b0d1;
		border-radius: 50%;
		width: 40px;
		height: 40px;
	}

	.row--5 {
		margin-left: -0.5rem !important;
		margin-right: -0.5rem !important;
	}

	.row--5>* {
		padding-left: 0.5rem !important;
		padding-right: 0.5rem !important;
	}

	.container {
		padding-right: 1.6rem;
		padding-left: 1.6rem;
	}

	@media (min-width: 576px) {
		.container {
			max-width: 540px;
		}
	}

	.card {
		border-radius: 0.25rem;
		border: 1px solid rgba(0, 0, 0, .125);
		background-color: #fff;
		flex-direction: column;
		background-clip: border-box;
	}

	.avatar {
		border-radius: 50%;
		object-fit: cover;
	}

	.minus_qty,
	.plus_qty {
		background-color: #fff;
		color: #005da6;
		text-align: center;
	}

	.qty_barang {
		font-size: 16px;
		border-radius: 0;
		text-align: center;
		color: #333;
		width: auto;
		max-width: 70px;
	}

	.item-list ul li {
		border-bottom: 1px solid #E8EFF3;
		padding: 0 15px;
		margin: 18px -15px;
	}

	.item-list.style-2 .item-content {
		justify-content: unset;
		align-items: start;
	}

	.item-list .item-content {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.item-list.style-2 .item-content .item-media {
		margin-right: 20px;
		margin-left: 0;
		margin-bottom: 10px;
		position: relative;
	}

	.item-list .item-content .item-media {
		margin-left: 0px;
		margin-bottom: 10px;
		position: relative;
	}

	.media {
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.media-60 {
		width: 62px;
		min-width: 62px;
		height: 62px;
	}

	.item-list.style-2 .item-content .item-media img {
		border-radius: 8px;
	}

	.item-list .item-content .item-media img {
		border-radius: 8px;
	}

	.media img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	img {
		border-style: none;
		height: auto;
		max-width: 100%;
		vertical-align: middle;
	}

	.item-list.style-2 .item-content .item-inner {
		width: 100%;
	}

	.item-list .item-content .item-inner {
		flex: 1;
	}

	.item-list.style-2 .item-content .item-inner .item-title-row {
		margin-bottom: 10px;
	}

	.item-list .item-content .item-inner .item-title-row {
		margin-bottom: 10px;
	}

	.item-list.style-2 .item-content .item-inner .item-title-row .item-subtitle {
		font-size: 0.875rem;
	}

	.item-list .item-content .item-inner .item-title-row .item-subtitle {
		font-size: 0.875rem;
	}

	.item-list.style-2 .item-content .item-inner .item-footer {
		display: flex;
		align-items: center;
		margin-bottom: 15px;
		justify-content: space-between;
	}

	.item-list .item-content .item-inner .item-footer {
		display: flex;
		align-items: center;
		margin-bottom: 15px;
		justify-content: space-between;
	}

	.item-list.style-2 .item-content .item-inner .item-footer h6,
	.item-list.style-2 .item-content .item-inner .item-footer .h6 {
		margin-bottom: 0;
	}

	del {
		color: #BFC9DA !important;
	}

	.view-title ul li {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 2px 0;
	}

	.view-title ul li span {
		display: block;
		font-size: 0.875rem;
		font-weight: 700;
	}

	.remove-item {
		border-radius: 50%;
		color: rgba(255, 82, 82, 1);
		text-align: center;
		cursor: pointer;
		margin-right: 15px;
		padding: 5px;
	}
</style>
<?php $this->load->view('layouts/user/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
	<div class="container">
		<div class="nav-bar__left">
			<h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Keranjang</h1>
		</div>
	</div>
</nav>

<section class="mt-4 mb-4">
	<div class="container">
		<!-- <div class="card mt-2">
         <div class="card-body pb-1 pt-1 pl-0 pr-0">
            <div class="row p-2">
               <div class="col-1 d-flex align-items-center justify-content-center text-center">
                  <div class="icheck-primary" style="padding-left: 30px;">
                     <input name="pilih_semua" type="checkbox" id="pilih_semua" class="" />
                     <label for="pilih_semua"></label>
                  </div>
               </div>
               <div class="col-8 d-flex align-items-center">
                  <div style="flex:1">
                     Pilih Semua
                  </div>
               </div>
               <div class="col-3 d-flex align-items-center justify-content-end">
                  <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i> Hapus</button>
               </div>
            </div>
         </div>
      </div> -->
		<?php
		if ($this->session->flashdata('error') != '') {
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
			echo $this->session->flashdata('error') . " " . anchor(base_url('akun/alamat'), 'Cek alamat Anda di sini');
			echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
			echo '</div>';
		}
		?>

		<?php
		if ($this->session->flashdata('error2') != '') {
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
			echo $this->session->flashdata('error2') . " " . anchor(base_url('akun/edit'), 'Ubah biodata di sini');
			echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
			echo '</div>';
		}
		?>


		<?php
		if ($this->session->flashdata('success_register') != '') {
			echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
			echo $this->session->flashdata('success_register');
			echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
			echo '</div>';
		}
		?>
		<?php if (!empty($keranjang)) : ?>
			<div class="load-data">
				<div class="item-list" style="border: 1px solid rgba(0, 0, 0, .125);background-color:white">
					<!-- Tombol: Ceklis & Hapus dalam satu row -->
					<div class="d-flex justify-content-between align-items-center mb-3">
						<button type="button" class="btn btn-sm btn-success btn-ceklis-semua">Ceklis Semua</button>
						<button type="button" class="btn btn-sm btn-danger btn-hapus-semua">Hapus Semua</button>
					</div>

					<ul style="list-style: none;">
						<!-- <li id="barang0">
							<div class="item-content float-right">
								<div class="icheck-primary">
									<b class="btn btn-sm btn-danger">Hapus Semua</b>
								</div>
							</div>
						</li> -->
						<?php foreach ($keranjang as $key => $tmp) : ?>
							<li id="barang<?= $tmp['id_keranjang'] ?>">
								<div class="item-content">
									<div class="icheck-primary">
										<input value="<?= $tmp['id_keranjang'] ?>" name="id_produk[]" type="checkbox" id="penanda<?= $key ?>" data-key="<?= $key ?>" class="checkbox-produk" />
										<label for="penanda<?= $key ?>"></label>
									</div>
									<div class="item-media media media-60" style="margin-right: 10px;">
									<img 
										src="<?= base_url('public/template/upload/barang/' . $tmp['gambar_barang']) ?>" 
										alt="<?= htmlspecialchars($tmp['nama_barang'] ?? 'Gambar Barang', ENT_QUOTES) ?>" 
										class="img-fluid rounded" 
										style="border-radius: 3px; max-width: 100%; height: auto;" 
										loading="lazy" 
										decoding="async"
										onerror="this.onerror=null;this.src='<?= base_url('public/template/upload/barang/default.png') ?>';"
										/>
									</div>
									<div class=" item-inner">
										<div class="item-title-row">
											<div class="row align-items-center">
												<div class="col">
													<h4 style="font-family: Lato, sans-serif; font-weight: 600; color: #4f658b;" class="item-title">
														<a href="<?= base_url('home/barang/' . $tmp['id_brg']) ?>"><?= $tmp['nama_barang'] ?></a>
													</h4>
												</div>
												<div class="col-auto">
													<span class="remove-item" data-id="<?= $tmp['id_keranjang'] ?>"><i class="fa fa-times" style="font-size: 20px;"></i></span>
												</div>
											</div>
										</div>
										<div class="item-subtitle" style="margin-top: -25px;"><?= $tmp['nama_kategori_brg'] ?></div>
										<div class="item-footer">
											<?php if ($tmp["promo_brg"] == "On") : ?>
												<div class="d-flex align-items-center">
													<h4 class="fw-bold text-success" data-id_minus="<?= $key ?>" id="harga_saat_ini<?= $key ?>">Rp. <?= number_format($tmp['harga_promo']) ?></h4>
													&nbsp;&nbsp;
													<del class="off-text">
														<h5 style="color: #BFC9DA !important;font-weight: 400 !important;">Rp. <?= number_format($tmp['harga_jual_barang']) ?></h5>
													</del>
												</div>
												<?php if ($tmp['grosir_brg'] == "On") : ?>
													<small class="text-muted">Anda akan mendapatkan harga grosir Rp. <?= number_format($tmp['harga_grosir']) ?> untuk pembelian di atas <?= $tmp['rentang_awal'] ?> unit.</small>
												<?php endif; ?>
											<?php else : ?>
												<div class="d-flex align-items-center">
													<h4 class="fw-bold text-success" data-id_minus="<?= $key ?>" id="harga_saat_ini<?= $key ?>">Rp. <?= number_format($tmp['harga_jual_barang']) ?></h4>
													&nbsp;&nbsp;
												</div>
												<?php if ($tmp['grosir_brg'] == "On") : ?>
													<small class="text-muted">Anda akan mendapatkan harga grosir Rp. <?= number_format($tmp['harga_grosir']) ?> untuk pembelian di atas <?= $tmp['rentang_awal'] ?> unit.</small>
												<?php endif; ?>
											<?php endif; ?>
										</div>
										<div class="d-flex align-items-center qty-adjusment mb-4" style="margin-top: -20px;">
											<div class="input-group input-group-sm" style="box-shadow: none !important;">
												<span class="input-group-text">
													<svg style="cursor: pointer;" class="bx bx-minus minus_qty" data-keranjang="<?= $tmp['id_keranjang'] ?>" data-id="<?= $key ?>" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
														<path d="M5 11h14v2H5z"></path>
													</svg>
												</span>
												<input data-id="<?= $key ?>" data-keranjang="<?= $tmp['id_keranjang'] ?>" value="<?= $tmp['jumlah'] ?>" min="1" type="text" class="form-control qty_barang" id="qty_barang<?= $key ?>">
												<input type="hidden" id="harga_normal<?= $key ?>" value="<?= ($tmp['promo_brg'] == "On") ? $tmp['harga_promo'] : $tmp['harga_jual_barang'] ?>">
												<span class="input-group-text">
													<svg style="cursor: pointer;" class="bx bx-plus plus_qty" data-keranjang="<?= $tmp['id_keranjang'] ?>" data-id="<?= $key ?>" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
														<path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path>
													</svg>
												</span>
											</div>
										</div>
									</div>
								</div>
							</li>
						<?php endforeach ?>
					</ul>
				</div>


				<div class="card mt-2 mb-3 view-title">
					<div class="card-body">
						<p class="text-primary fw-bold">Ringkasan Pesanan</p>
						<ul>
							<li>
								<span>Jumlah Produk</span>
								<span id="selected-count">0 Produk</span>
							</li>
							<li>
								<span>Total Biaya</span>
								<span id="selected-rp">Rp. 0</span>
							</li>
						</ul>
						<button id="btn-checkout" class="btn btn-primary w-100 btn-block" data-loading>Checkout</button>
					</div>
				</div>
			</div>
		<?php else : ?>
			<ul class="list list-inline">

				<div class="empty">
					<div class="empty-header">404</div>
					<p class="empty-title">Oops… Belum Ada Barang di Keranjang Nih</p>
					<div class="empty-action">
						<a href="<?= base_url('home') ?>" class="btn btn-primary">
							<!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
								<path d="M5 22h14c1.103 0 2-.897 2-2V9a1 1 0 0 0-1-1h-3V7c0-2.757-2.243-5-5-5S7 4.243 7 7v1H4a1 1 0 0 0-1 1v11c0 1.103.897 2 2 2zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v1H9V7zm-4 3h2v2h2v-2h6v2h2v-2h2l.002 10H5V10z"></path>
							</svg>
							&nbsp;&nbsp;Mulai Belanja
						</a>
					</div>
				</div>
			</ul>
		<?php endif ?>
	</div>
</section>

<div class="row">
	<br><br><br><br>
</div>

<?php $this->load->view('layouts/user/menu'); ?>
<?php $this->load->view('layouts/user/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$(document).ready(function() {
		let totalProduk = 0;
		let totalHarga = 0;

		$('.checkbox-produk').on('click', function() {
			const key = $(this).data('key');
			const hargaNormal = parseFloat($('#harga_normal' + key).val());
			const qty = parseInt($('#qty_barang' + key).val());

			if ($(this).prop('checked')) {
				totalProduk++;
				totalHarga += hargaNormal * qty;
			} else {
				totalProduk--;
				totalHarga -= hargaNormal * qty;
			}
			$('#selected-rp').text("Rp. " + totalHarga.toLocaleString('id-ID', {
				minimumFractionDigits: 0, // atau 2 jika ingin selalu 2 desimal
				maximumFractionDigits: 2
			}));
			$('#selected-count').text(totalProduk + ' Produk');

			const allChecked = $('.checkbox-produk:checked').length === $('.checkbox-produk').length;
			$('#pilih_semua').prop('checked', allChecked);
		});

		$('.plus_qty').on('click', function() {
			const keranjangId = $(this).data('keranjang');
			const key = $(this).data('id');
			const qtyElement = $('#qty_barang' + key);
			const hargaNormal = parseInt($('#harga_normal' + key).val());

			let qty = parseInt(qtyElement.val());
			qty++;
			qtyElement.val(qty);

			const checkbox = $('#penanda' + key);
			if (checkbox.prop('checked')) {
				let totalRpText = $('#selected-rp').text();
				let totalRp = parseInt(totalRpText.replace(/[^\d]/g, ''));
				totalRp += hargaNormal;

				$('#selected-rp').text("Rp. " + totalRp.toLocaleString('id-ID', {
					minimumFractionDigits: 0, // atau 2 jika ingin selalu 2 desimal
					maximumFractionDigits: 2
				}));
			}

			$.ajax({
				url: '<?= base_url('keranjang/update_jumlah') ?>', // Ganti URL_ANDA dengan URL controller CI3 Anda
				method: 'post',
				data: {
					id_keranjang: keranjangId,
					qty_barang: qty
				},
				beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

				success: function(response) {
					// Response dari controller akan dihandle di sini
					// Misalnya, Anda dapat melakukan sesuatu berdasarkan response dari server
					if (response.success) {
						console.log('Update jumlah berhasil');
					} else {
						Swal.fire({
							title: 'Error!',
							text: response.msg,
							icon: 'error',
							customClass: {
								confirmButton: 'btn btn-danger'
							},
							buttonsStyling: false
						});

						qtyElement.val(qty - 1); // Kembalikan ke jumlah sebelumnya jika gagal
					}
				},
				error: function() {
					console.log('Error: Gagal mengirim request Ajax.');
				}
			});
		});

		$('.minus_qty').on('click', function() {
			const keranjangId = $(this).data('keranjang');
			const key = $(this).data('id');
			const qtyElement = $('#qty_barang' + key);
			const hargaNormal = $('#harga_normal' + key).val();

			let qty = parseInt(qtyElement.val());
			if (qty > 1) {
				qty--;
				qtyElement.val(qty);

				const checkbox = $('#penanda' + key);
				if (checkbox.prop('checked')) {
					let totalRpText = $('#selected-rp').text();
					let totalRp = parseInt(totalRpText.replace(/[^\d]/g, ''));
					totalRp -= hargaNormal;

					$('#selected-rp').text("Rp. " + totalRp.toLocaleString('id-ID', {
						minimumFractionDigits: 0, // atau 2 jika ingin selalu 2 desimal
						maximumFractionDigits: 2
					}));
				}
			}

			$.ajax({
				url: '<?= base_url('keranjang/update_jumlah') ?>', // Ganti URL_ANDA dengan URL controller CI3 Anda
				method: 'post',
				data: {
					id_keranjang: keranjangId,
					qty_barang: qty
				},
				beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

				success: function(response) {
					console.log(response);
				},
				error: function() {
					console.log('Error: Gagal mengirim request Ajax.');
				}
			});
		});

		$('.qty_barang').on('input', function() {
			const keranjangId = $(this).data('keranjang');
			const key = $(this).data('id');
			const qtyElement = $('#qty_barang' + key);
			let qty = parseInt(qtyElement.val());
			let prevQty = qty;

			$.ajax({
				url: '<?= base_url('keranjang/update_jumlah') ?>', // Ganti URL_ANDA dengan URL controller CI3 Anda
				method: 'post',
				data: {
					id_keranjang: keranjangId,
					qty_barang: qty
				},
				success: function(response) {
					if (response.success) {
						console.log('Update jumlah berhasil');
					} else {
						Swal.fire({
							title: 'Error!',
							text: response.msg,
							icon: 'error',
							customClass: {
								confirmButton: 'btn btn-danger'
							},
							buttonsStyling: false
						});

						qtyElement.val(prevQty); // Kembalikan ke jumlah sebelumnya jika gagal
					}
				},
				error: function() {
					console.log('Error: Gagal mengirim permintaan Ajax.');
				}
			});
		});

		$('#btn-checkout').click(function() {
			var selectedProducts = [];

			$('input[name="id_produk[]"]:checked').each(function() {
				selectedProducts.push($(this).val());
			});

			// Jika tidak ada checkbox yang dicentang
			if (selectedProducts.length === 0) {
				Swal.fire({
					title: 'Error!',
					text: "Silakan pilih minimal satu produk sebelum checkout.",
					type: 'error',
					customClass: {
						confirmButton: 'btn btn-danger'
					},
					buttonsStyling: false
				});
				return;
			}

			var url = "<?= base_url('') ?>keranjang/proses?selectedProducts=" + selectedProducts.join(',');
			window.location.href = url;
		});

		$(".remove-item").click(function() {
			var idToRemove = $(this).data("id");

			// Use SweetAlert for confirmation
			Swal.fire({
				title: 'Apakah Anda yakin ingin menghapus item ini?',
				showCancelButton: true,
				confirmButtonText: 'Ya, Hapus',
				cancelButtonText: 'Batal', // Disable default styling
				customClass: {
					confirmButton: 'btn btn-danger', // Add Bootstrap class for the confirm button
					cancelButton: 'btn btn-secondary'
				}
			}).then((result) => {
				if (result.isConfirmed) {
					// User clicked "Ya, Hapus"
					$.ajax({
						url: "<?= base_url('keranjang/hapus') ?>",
						type: "POST",
						data: {
							id: idToRemove
						},
						success: function(response) {
							$("#barang" + idToRemove).remove();

							// Check the count of items, if there are none, reload the page
							if ($(".cart-item").length === 0) {
								location.reload();
							}
						},
						beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

						error: function(xhr, status, error) {
							console.error(error);
						}
					});
				}
			});
		});

		$(".btn-hapus-semua").click(function() {
			Swal.fire({
				title: 'Apakah Anda yakin ingin menghapus semua item?',
				showCancelButton: true,
				confirmButtonText: 'Ya, Hapus',
				cancelButtonText: 'Batal',
				// buttonsStyling: false, // Disable default styling
				customClass: {
					confirmButton: 'btn btn-danger', // Add Bootstrap class for the confirm button
					cancelButton: 'btn btn-secondary'
				}
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: "<?= base_url('keranjang/hapus_semua') ?>",
						type: "POST",
						success: function(response) {
							// Show success message
							Swal.fire({
								title: 'Berhasil!',
								text: response.msg,
								icon: 'success',
								customClass: {
									confirmButton: 'btn btn-success'
								},
								buttonsStyling: false
							});

							setTimeout(() => {
								window.location.reload();
							}, 2000);
						},
						beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

						error: function(xhr, status, error) {
							console.error(error);
						}
					});
				}
			});
		});

		document.querySelector('.btn-ceklis-semua').addEventListener('click', function () {
			const allCheckboxes = document.querySelectorAll('.checkbox-produk');
			const isAllChecked = Array.from(allCheckboxes).every(cb => cb.checked);
			allCheckboxes.forEach(cb => cb.checked = !isAllChecked);

			totalProduk = 0;
			totalHarga = 0;

			if (!isAllChecked) {
				allCheckboxes.forEach(cb => {
					const key = cb.dataset.key;
					const hargaNormal = parseFloat($('#harga_normal' + key).val());
					const qty = parseInt($('#qty_barang' + key).val());
					totalProduk++;
					totalHarga += hargaNormal * qty;
				});
			}

			$('#selected-rp').text("Rp. " + totalHarga.toLocaleString('id-ID', {
				minimumFractionDigits: 0, // atau 2 jika ingin selalu 2 desimal
				maximumFractionDigits: 2
			}));
			$('#selected-count').text(totalProduk + ' Produk');
			$('#pilih_semua').prop('checked', !isAllChecked);

			// Update the count of selected products
			if (totalProduk === 0) {
				$('#selected-count').text('0 Produk');
				$('#selected-rp').text('Rp. 0');
			}
		});
	});
</script>
</body>

</html>
