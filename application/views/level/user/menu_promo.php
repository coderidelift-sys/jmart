<?php $this->load->view('layouts/user/head'); ?>
<style>
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

    .no-padding {
        margin: 0;
        /* Menghapus margin bawaan */
    }

    .ellipsis {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        /* number of lines to show */
        -webkit-box-orient: vertical;
        overflow: hidden;
        white-space: pre-line;
        /* Preserve newline characters */
    }
</style>
<?php $this->load->view('layouts/user/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
    <div class="container nav-bar__on-container" style="display: flex;">
        <div class="nav-bar__center">
            <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Promo</h1>
        </div>
    </div>
</nav>
<div class="terms-tab-wrapper shadow">
    <div class="container">
        <ul class="nav row row--no terms-tab">
            <li class="nav-item col-4">
                <a class="nav-link <?= isset($_GET['filter']) && $_GET['filter'] == "terbaru" ? "active" : "" ?>" id="Donasi-tab" data-toggle="tab" href="<?= base_url('promo?filter=terbaru') ?>" role="tab" aria-controls="home" aria-selected="true">Terbaru</a>
            </li>
            <li class="nav-item col-4">
                <a class="nav-link <?= isset($_GET['filter']) && $_GET['filter'] == "terlaris" ? "active" : "" ?>" id="Campaign-tab" data-toggle="tab" href="<?= base_url('promo?filter=terlaris') ?>" role="tab" aria-controls="profile" aria-selected="false">Terlaris <i class='bx bxs-up-arrow-alt'></i></a>
            </li>
            <?php
            $filter = isset($_GET['filter']) ? $_GET['filter'] : "tertinggi";
            $iconClass = ($filter === "tertinggi") ? "fa fa-arrow-up" : "fa fa-arrow-down";
            ?>
            <li class="nav-item col-4">
                <a class="nav-link <?= isset($_GET['filter']) && $_GET['filter'] == "tertinggi" ? "active" : "" ?><?= isset($_GET['filter']) && $_GET['filter'] == "terendah" ? "active" : "" ?>" id="harga" style="cursor: pointer;">Harga &nbsp;<i class='<?= $iconClass ?>'></i></a>
            </li>
        </ul>
    </div>
</div>

<section class="mt-2 mb-4">
    <div class="container">
        <div class="row">
            <?php foreach ($barang as $key => $value) : ?>
                <div class="col-6 col-lg-6 col-md-6 col-sm-6 d-flex">
                    <div class="card w-100 my-2 shadow-2-strong">
                        <img src="<?= base_url('public/template/upload/barang/' . $value['gambar_barang']) ?>" class="card-img-top mt-3" style="height:120px;width:auto;object-fit:contain;">
                        <div class="card-body d-flex flex-column">
                            <p class="card-text mb-0 fs-5 ellipsis" style="font-weight: 400;"><?= $value['nama_barang'] ?></p>
                            <h4 class="fw-bold mb-1 me-1">RP. <?= number_format($value['harga_promo']) ?></h4>
                            <div class="d-flex mb-0">
                                <p class="fs-5 mb-1"><span class="badge bg-danger text-white me-2"><?= number_format(($value['harga_jual_barang'] - $value['harga_promo']) / $value['harga_jual_barang'] * 100, 2) ?>%</span></p>
                                <p class="fs-5 text-muted mb-1"><del>Rp. <?= number_format($value['harga_jual_barang']) ?></del></p>
                            </div>
                            <?php
                            $query = $this->db->query("SELECT COUNT(*) as jumlah_jual FROM tb_pesanan_detail WHERE id_brg = ?", $value['id_brg']);
                            $result = $query->row();
                            $jumlah_jual = $result->jumlah_jual;
                            ?>
                            <p class="mb-2 fs-5 text-dark" style="font-weight: 500;">
                                <?= number_format($jumlah_jual) . " Terjual" ?> | (<?= number_format($value['stock_brg']) . " Stok Tersedia" ?>)
                            </p>
                            <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                                <a data-idproduk="<?= $value['id_brg'] ?>" href="javascript::void" class="btn btn-primary shadow-0 me-1 add_keranjang">+ Keranjang</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
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
    var anchorElement = document.querySelector("#harga");
    var urlParams = new URLSearchParams(window.location.search);
    var filter = urlParams.get('filter') || "tertinggi"; // Jika tidak ada filter, maka defaultnya "tertinggi"

    anchorElement.addEventListener("click", function() {
        // Toggle antara "tertinggi" dan "terendah" setiap kali elemen diklik
        filter = (filter === "tertinggi") ? "terendah" : "tertinggi";

        // Arahkan pengguna ke URL dengan parameter GET yang sesuai
        window.location.href = "<?= base_url('promo?filter=') ?>" + filter;
    });

    $('.add_keranjang').click(function() {
        // Mengambil data yang perlu ditambahkan ke database
        var idProduk = $(this).data('idproduk');
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
			beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

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
    });
</script>
</body>

</html>
