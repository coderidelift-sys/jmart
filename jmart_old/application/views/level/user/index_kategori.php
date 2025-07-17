<?php $this->load->view('layouts/user/head'); ?>
<style>
	.navbar__left {
		width: 4rem;
		z-index: 2;
	}

	.terms-tab-wrapper {
		background-color: #fff;
	}

	.terms-tab-wrapper .terms-tab .nav-item .nav-link {
		text-align: center;
		font-weight: bold;
		color: #999999;
		padding: 0;
		height: 3.4rem;
		line-height: 3.4rem;
		border-bottom: 0;
		transition: .2s ease-in-out;
	}

	.terms-tab-wrapper .terms-tab .nav-item .nav-link.active {
		color: #2F5596;
		border-bottom: 0.4rem solid #2F5596;
	}

	.product-box {
		position: relative;
		border-radius: 8px;
		overflow: hidden;
		padding: 10px;
		background-color: rgba(235, 235, 236, 1);
	}

	.product-box .product-box-img {
		position: relative;
		display: block;
	}

	.product-box .product-box-img .img {
		position: relative;
		width: 100%;
		height: 146px;
		-o-object-fit: contain;
		object-fit: contain;
		border-radius: 8px;
		padding: 15px;
		background-color: rgba(255, 255, 255, 1);
	}

	.product-box .product-box-img .cart-box {
		position: absolute;
		bottom: -15px;
		right: 0;
		background-color: rgba(255, 255, 255, 1);
		border-radius: 100%;
		width: 36px;
		height: 36px;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
	}

	.product-box .product-box-img .cart-box .cart-bag {
		background-color: #DFE8E3;
		border-radius: 100%;
		width: 32px;
		height: 32px;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
	}

	.product-box .product-box-detail h6 {
		color: rgba(18, 38, 54, 1);
		font-weight: 500;
		line-height: 1.5;
		margin-top: 15px;
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
	}

	.gap-3 {
		gap: 1rem !important;
	}

	.product-box .product-box-detail h5 {
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
		margin-top: 6px;
		font-size: 12px;
		font-weight: 400;
		color: rgba(var(--light-text), 1);
	}

	.product-box .product-box-detail h3 {
		color: rgba(18, 38, 54, 1);
	}

	.product-box .like-btn {
		position: absolute;
		top: 15px;
		right: 15px;
		line-height: 1;
		z-index: 1;
		border-radius: 10%;
		background-color: #ea4c62 !important;
		color: white;
		-webkit-box-shadow: 0px 2px 8px rgba(18, 38, 54, 0.1);
		box-shadow: 0px 2px 8px rgba(18, 38, 54, 0.1);
		padding: 6px;
		height: 24px;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
	}

	.fw-semibold {
		font-weight: 600 !important;
	}

	.loading-overlay {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(255, 255, 255, 0.8);
		display: flex;
		align-items: center;
		justify-content: center;
		z-index: 9999;
	}

	.loading-spinner {
		text-align: center;
	}

	.loading-spinner i {
		font-size: 24px;
		margin-bottom: 10px;
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
			<h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;"><?= $header ?></h1>
		</div>
	</div>
</nav>
<div class="terms-tab-wrapper shadow">
	<div class="container">
		<ul class="nav row row--no terms-tab">
			<li class="nav-item col-4">
				<a class="nav-link" id="Donasi-tab" data-toggle="tab" href="#AA" role="tab" aria-controls="home" aria-selected="true">Promo</a>
			</li>
			<li class="nav-item col-4">
				<a class="nav-link" id="Campaign-tab" data-toggle="tab" href="#AA" role="tab" aria-controls="profile" aria-selected="false">Tinggi <i class='bx bxs-up-arrow-alt'></i></a>
			</li>
			<li class="nav-item col-4">
				<a class="nav-link" id="Campaign-tab" data-toggle="tab" href="#AA" role="tab" aria-controls="profile" aria-selected="false">Rendah <i class='bx bxs-down-arrow-alt'></i></a>
			</li>
		</ul>
	</div>
</div>

<div id="loading" class="loading-overlay" style="display: none;">
	<div class="loading-spinner">
		<i class="fa fa-spinner fa-spin"></i>
		Loading...
	</div>
</div>

<section class="mt-2 mb-4">
	<div class="container">
		<div class="row">
			<div id="barang-container" class="row"></div>
		</div>
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
		var page = 1; // Halaman awal
		var isLoading = false; // Status untuk memeriksa apakah sedang dalam proses pengambilan data
		var id = "<?= $id ?>";
		// Fungsi untuk memuat barang dengan AJAX
		function loadBarang() {
			if (isLoading) {
				return; // Jangan lakukan pengambilan data jika sedang dalam proses pengambilan data sebelumnya
			}

			isLoading = true;

			$.ajax({
				url: '<?= base_url('home/load_kategori') ?>', // Ganti dengan URL ke fungsi controller Anda
				type: 'GET',
				data: {
					page: page,
					id: id
				},
				dataType: 'json',
				beforeSend: function() {
					$('#loading').show();
				},
				success: function(response) {
					// Jika data berhasil diambil
					if (response.barang.length > 0) {
						// Loop melalui hasil respons dan tampilkan barang
						$.each(response.barang, function(index, value) {
							var html = `
                    <div class="col-6 col-lg-6 col-md-6 col-sm-6 d-flex">
                        <div class="card w-100 my-2 shadow-2-strong">
                            <img src="<?= base_url('public/template/upload/barang/') ?>${value.gambar_barang}" class="card-img-top mt-3" style="height:120px;width:auto;object-fit:contain;">
                            <div class="card-body d-flex flex-column">
                                <p class="card-text mb-0 fs-5 ellipsis" style="font-weight: 400;">${value.nama_barang}</p>`;

							if (value.promo_brg == 'On') {
								html += `
                                <h4 class="fw-bold mb-1 me-1">RP. ${value.harga_promo}</h4>
                                <div class="d-flex mb-0">
                                    <p class="fs-5 mb-1"><span class="badge bg-danger text-white me-2">${((value.harga_jual_barang - value.harga_promo) / value.harga_jual_barang * 100).toFixed(2)}%</span></p>
                                    <p class="fs-5 text-muted mb-1"><del>Rp. ${value.harga_jual_barang}</del></p>
                                </div>`;
							} else {
								html += `<h4 class="fw-bold mb-1 me-1">RP. ${value.harga_jual_barang}</h4>`;
							}

							html += `
                                <p class="mb-2 fs-5 text-dark" style="font-weight: 500;">
                                    ${value.jumlah_jual} Terjual | ${value.stock_brg} Stok Tersedia
                                </p>
                                <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                                    <a onclick="add_keranjang(${value.id_brg})" data-idproduk="${value.id_brg}" href="javascript:void(0)" class="btn btn-primary shadow-0 me-1">+ Keranjang</a>
                                </div>
                            </div>
                        </div>
                    </div>`;

							// Tambahkan HTML barang ke kontainer
							$('#barang-container').append(html);
						});

						page++; // Pindah ke halaman berikutnya
					}
				},
				complete: function() {
					isLoading = false;
					$("#loading").hide();
					// Setelah selesai pengambilan data, atur status menjadi false
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		}


		// Panggil fungsi untuk memuat barang pada saat halaman dimuat
		loadBarang();

		// Fungsi untuk menangani event scroll
		$(window).scroll(function() {
			// Jika user telah mencapai bagian bawah halaman
			if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
				// Panggil fungsi untuk memuat barang lagi
				loadBarang();
			}
		});
	});

	function add_keranjang(idProduk) {
		// var data = {
		// 	idProduk: idProduk
		// };

		// $.ajax({
		// 	url: '<?= base_url('keranjang/add') ?>', // Ganti dengan URL endpoint Anda
		// 	type: 'POST', // Metode HTTP yang digunakan (POST, GET, dll.)
		// 	data: data, // Data yang dikirim ke server
		// 	success: function(response) {
		// 		if (response.success == true) {
		// 			Swal.fire({
		// 				title: 'Success!',
		// 				text: response.msg,
		// 				type: 'success',
		// 				customClass: {
		// 					confirmButton: 'btn btn-success'
		// 				},
		// 				buttonsStyling: false
		// 			});
		// 		} else {
		// 			Swal.fire({
		// 				title: 'Error!',
		// 				text: response.msg,
		// 				type: 'error',
		// 				customClass: {
		// 					confirmButton: 'btn btn-danger'
		// 				},
		// 				buttonsStyling: false
		// 			});
		// 		}
		// 	},
		// 	error: function(request, status, error) {
		// 		alert(request.responseText);
		// 	},
		// });

		var data = {
         idProduk
      };

		// ajax untuk menghitung total data di keranjang
		function showAlert(title, text, icon, buttonClass) {
			Swal.fire({
				title,
				text,
				icon, // Ganti 'type' dengan 'icon'
				customClass: {
					confirmButton: buttonClass
				},
				buttonsStyling: false
			});
		}

		$.ajax({
			url: '<?= base_url('keranjang/add_keranjang') ?>',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(response) {
				if (response.success) {
					showAlert('Success!', response.msg, 'success', 'btn btn-success');

					// Hitung ulang jumlah keranjang
					$.ajax({
						url: '<?= base_url('keranjang/count_keranjang') ?>',
						type: 'GET',
						dataType: 'json',
						success: function(countResponse) {
							if (countResponse.success) {
								$('.count-keranjang').text(countResponse.count);
							}
						}
					});
				} else {
					showAlert('Error!', response.msg, 'error', 'btn btn-danger');
				}
			},
			error: function(xhr) {
				alert(xhr.responseText);
			}
		});

	}
</script>
</body>

</html>
