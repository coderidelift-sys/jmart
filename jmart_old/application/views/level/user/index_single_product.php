<?php $this->load->view('layouts/user/head'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css">
<style>
    .navbar__left {
        width: 4rem;
        z-index: 2;
    }

    /* CSS Untuk Swiper Container */
    .swiper-container {
        width: 100%;
        max-width: 600px;
        /* Sesuaikan lebar maksimum sesuai kebutuhan Anda */
        margin: 0 auto;
        position: relative;
    }

    /* CSS Untuk Swiper Slide */
    .swiper-slide {
        text-align: center;
        padding: 20px;
        background-color: #fff;
        transition: transform 0.3s;
    }

    /* CSS Untuk Elemen Hidden */
    .hidden {
        display: none;
    }

    /* CSS Untuk Paginasi Swiper (Opsional) */
    .swiper-pagination {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
    }

    /* Gaya Tambahan untuk Elemen Slide (Opsional) */
    .swiper-slide img {
        max-width: 100%;
        height: auto;
    }

    .product-description .sale-price {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #ea4c62;
    }

    .product-description .ratings i {
        color: #ffaf00;
        font-size: 12px;
    }

    .product-description .total-result-of-ratings span:first-child {
        line-height: 1;
        background-color: #ea4c62;
        padding: 3px 6px;
        color: #ffffff;
        display: inline-block;
        border-radius: 0.25rem;
        font-size: 12px;
        margin-right: 0.25rem;
        font-weight: 500;
    }

    .product-description .total-result-of-ratings span:last-child {
        color: #00b894;
        font-size: 12px;
        font-weight: 600;
    }

    .p-wishlist-share a {
        display: inline-block;
        color: #ea4c62;
        font-size: 1.5rem;
    }

    .cart-form .form-control {
        max-width: 50px;
        height: 35px;
        margin-right: 0.5rem;
        margin-left: 0.5rem;
        text-align: center;
        font-weight: 500;
        padding: 0.375rem 0.5rem;
    }

    .cart-form .quantity-button-handler {
        width: 35px;
        height: 35px;
        background-color: #fef8ff;
        border: 1px solid #ebebeb;
        color: #020310;
        line-height: 33px;
        font-size: 1.25rem;
        text-align: center;
        border-radius: 0.25rem;
        cursor: pointer;
        -webkit-transition-duration: 500ms;
        -o-transition-duration: 500ms;
        transition-duration: 500ms;
    }

    .single-user-review {
        border-bottom: 2px dashed #ebebeb;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
    }

    .single-user-review .user-thumbnail {
        margin-top: 0.5rem;
        -webkit-box-flex: 0;
        -ms-flex: 0 0 40px;
        flex: 0 0 40px;
        width: 40px;
        max-width: 40px;
        margin-right: 0.5rem;
    }

    .single-user-review .user-thumbnail img {
        border-radius: 50%;
    }

    .single-user-review .rating-comment .rating {
        font-size: 12px;
        color: #ffaf00;
    }

    .single-user-review .rating-comment .name-date {
        display: block;
        font-size: 12px;
    }

    .single-user-review .rating-comment .review-image {
        display: inline-block;
        margin-right: 0.5rem;
    }

    .single-user-review .rating-comment .review-image img {
        max-width: 50px;
    }

    .rounded-3 {
        border-radius: 0.5rem;
    }

    .product-card .wishlist-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 10;
        color: #ea4c62;
        font-size: 1rem;
        line-height: 1;
    }

    .product-card .badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        z-index: 10;
    }

    .product-card .product-thumbnail {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .product-card .product-title {
        font-size: 1rem;
        margin-bottom: 0.5rem;
        color: #020310;
        line-height: 1;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        -o-text-overflow: ellipsis;
        text-overflow: ellipsis;
    }

    .product-card .product-rating {
        color: #ffaf00;
        line-height: 1;
    }

    .product-card .btn {
        position: absolute;
        padding: 0;
        border-radius: 50%;
        margin-top: 10px;
        width: 30px;
        height: 30px;
        right: 1rem;
        bottom: 1rem;
        z-index: 99;
        font-size: 1rem;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .details-page .product-details {
        position: relative;
        padding-top: 20px;
    }

    .details-page .product-details .product-name {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .theme-color {
        color: rgba(18, 38, 54, 1);
    }

    .details-page .product-details .product-name h6 {
        -webkit-clip-path: polygon(100% 0, 100% 50%, 100% 100%, 0% 100%, 10% 50%, 0% 0%);
        clip-path: polygon(100% 0, 100% 50%, 100% 100%, 0% 100%, 10% 50%, 0% 0%);
        color: rgba(240, 73, 73, 1);
        background-color: rgba(240, 73, 73, 0.3);
        padding: 6px 6px 6px 12px;
    }

    .details-page .product-details .ratings .rating-stars {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    li {
        list-style: none;
        display: inline-block;
        font-size: 14px;
    }

    .details-page .product-details .ratings .rating-stars .stars {
        --Iconsax-Color: rgba(255, 193, 7, 1);
        --Iconsax-Size: 20px;
    }

    .details-page .product-details .ratings .reviews {
        font-weight: 400;
        margin-left: 8px;
        padding-left: 8px;
        color: rgba(155, 163, 170, 1);
        border-left: 1px solid rgba(155, 163, 170, 1);
        height: 1;
    }

    .gap-1 {
        gap: 0.25rem !important;
    }

    .details-page .product-details .product-price {
        margin: 15px 0;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .details-page .product-details .product-price h3 {
        font-size: calc(22px + 4 * (100vw - 320px) / 1600);
        font-weight: 600;
        color: rgba(18, 38, 54, 1);
    }

    .product-description .deskripsi {
        padding: 12px;
        margin-top: 0;
        text-align: justify;
        color: rgba(155, 163, 170, 1);
        background-color: rgba(255, 255, 255, 1);
        border-radius: 8px;
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
        height: 28px;
        width: 28px;
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

    .product-box .product-box-detail h4 {
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
            <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Product Details</h1>
        </div>
    </div>
</nav>

<section class="mt-4 mb-4">
    <div class="container details-page">
        <div class="mb-2 text-center mx-auto">
            <?php
            $gambar = $barang['gambar_barang'] == "https://dodolan.jogjakota.go.id/assets/media/default/default-product.png" ? "<img style='\border-radius: 3px;' src='" . $barang['gambar_barang'] . "'>" : "<img style='\border-radius: 3px;' src='" . base_url('public/template/upload/barang/' . $barang['gambar_barang']) . "'>";
            ?>
            <?= $gambar ?>
        </div>
        <div class="product-details" style="border-top: 2px dashed #ebebeb;">
            <div class="product-name">
                <h2 style="font-size: 16px;font-weight: 600;margin-bottom: 0;" class="theme-color"><?= $barang['nama_barang'] ?></h2>
            </div>
            <div class="ratings mt-1">
                <div class="d-flex align-items-center gap-1">
					<?php
						$query = $this->db->query("SELECT COUNT(*) as jumlah_jual FROM tb_pesanan_detail WHERE id_brg = ?", $barang['id_brg']);
						$result = $query->row();
						$jumlah_jual = $result->jumlah_jual;
					?>
                    <h4 style="font-size: 14px;margin-bottom: 0;"><?= number_format($jumlah_jual) ?> Sold</h4>
                </div>
            </div>
            <div class="product-price">
				<?php if (strtolower($barang['promo_brg']) == 'on'): ?>
					<h3 class="mb-0 text-danger">
						Rp. <?= number_format($barang['harga_promo']) ?>
						<del class="text-muted ms-2">Rp. <?= number_format($barang['harga_jual_barang']) ?></del>
					</h3>
				<?php else: ?>
					<h3 class="mb-0">Rp. <?= number_format($barang['harga_jual_barang']) ?></h3>
				<?php endif; ?>
			</div>
        </div>

        <!-- <div class="product-description">
            <p class="deskripsi">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam eius temporibus laboriosam explicabo blanditiis eligendi nesciunt magni delectus dolore dicta! Ratione soluta at error voluptatibus! Autem, ipsa! Nesciunt, doloremque facere.</p>
        </div> -->

        <div class="row product-description mt-2">
            <div class="col-12">
                <div class="cart-form-wrapper bg-white mb-3 py-3 w-100">
                    <div class="container">
                        <form class="cart-form" method="" style="position: relative;z-index: 1;display: -webkit-box;display: -ms-flexbox;display: flex;">
                            <div class="order-plus-minus d-flex align-items-center">
                                <div class="quantity-button-handler minus">-</div>
                                <input type="hidden" name="id_brg" value="<?= $barang['id_brg'] ?>">
                                <?php if (!empty($keranjang) >= 1) : ?>
                                    <input class="form-control cart-quantity-input" type="text" name="quantity" value="<?= $keranjang['jumlah'] ?>">
                                <?php else : ?>
                                    <input class="form-control cart-quantity-input" type="text" name="quantity" value="1">
                                <?php endif ?>
                                <div class="quantity-button-handler plus">+</div>
                            </div>
                            <button class="btn btn-danger ms-3" data-idproduk="<?= $barang['id_brg'] ?>">
                                <i class="fa fa-shopping-cart"></i>
                                &nbsp;&nbsp;Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>

                <div class="related-product-wrapper bg-white py-3 mb-3">
                    <div class="container">
                        <div class="section-heading d-flex align-items-center justify-content-between rtl-flex-d-row-r">
                            <h6 style="margin-bottom: 0 !important;color: #020310;line-height: 1;font-weight: 500;font-size: 1rem;">Related Products</h6>
                            <a style="font-size: 14px;line-height: 1;display: block;font-weight: 500;-webkit-box-shadow: none;box-shadow: none;border: 0;" class="btn p-0" href="javascript::void">View All</a>
                        </div>
                        <div class="owl-carousel mt-3">
                            <!-- Item Carousel -->
                            <div class="item">
                                <div class="product-box">
                                    <div class="product-box-img">
                                        <a href="javascript::void">
                                            <?= $gambar ?>
                                            <div class="cart-box">
                                                <a data-idproduk="<?= $barang['id_brg'] ?>" href="javascript::void" class="cart-bag add_keranjang">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- <div class="like-btn animate">
                                        -8.5%
                                    </div> -->
                                    <div class="product-box-detail">
                                        <h4 style="font-size: 14px;margin-bottom: 0;"><?= $barang['nama_barang'] ?></h4>
                                        <div class="d-flex justify-content-between gap-3">
                                            <h5 style="line-height: 1.2;margin-bottom: 0;"><?= $barang['nama_kategori_brg'] ?></h5>
                                            <h3 class="fw-semibold">RP. <?= number_format($barang['harga_jual_barang']) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rating-and-review-wrapper bg-white py-3 mb-3 dir-rtl">
                    <div class="container">
                        <h6 style="color: #020310;font-weight: 500;font-size: 1rem;">Ratings &amp; Reviews</h6>
                        <div class="rating-review-content">
                            <ul class="ps-0">
                                <!-- Single User Review -->
                                <li class="single-user-review d-flex">
                                    <div class="user-thumbnail"><img src="https://designing-world.com/suha-v3.0/img/bg-img/7.jpg" alt=""></div>
                                    <div class="rating-comment">
                                        <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                        <p class="comment mb-0">Very good product. It's just amazing!</p><span class="name-date">Designing World 12 Dec 2022</span><a class="review-image mt-2 border rounded" href="https://designing-world.com/suha-v3.0/img/product/3.png"><img class="rounded-3" src="https://designing-world.com/suha-v3.0/img/product/3.png" alt=""></a>
                                    </div>
                                </li>
                                <!-- Single User Review -->
                                <li class="single-user-review d-flex">
                                    <div class="user-thumbnail"><img src="https://designing-world.com/suha-v3.0/img/bg-img/8.jpg" alt=""></div>
                                    <div class="rating-comment">
                                        <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                        <p class="comment mb-0">Very excellent product. Love it.</p><span class="name-date">Designing World 8 Dec 2022</span><a class="review-image mt-2 border rounded" href="https://designing-world.com/suha-v3.0/img/product/4.png"><img class="rounded-3" src="https://designing-world.com/suha-v3.0/img/product/4.png" alt=""></a><a class="review-image mt-2 border rounded" href="https://designing-world.com/suha-v3.0/img/product/6.png"><img class="rounded-3" src="https://designing-world.com/suha-v3.0/img/product/6.png" alt=""></a>
                                    </div>
                                </li>
                                <!-- Single User Review -->
                                <li class="single-user-review d-flex">
                                    <div class="user-thumbnail"><img src="https://designing-world.com/suha-v3.0/img/bg-img/9.jpg" alt=""></div>
                                    <div class="rating-comment">
                                        <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                        <p class="comment mb-0">What a nice product it is. I am looking it's.</p><span class="name-date">Designing World 28 Nov 2022</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <br><br><br><br>
</div>
<?php $this->load->view('layouts/user/menu'); ?>
<?php $this->load->view('layouts/user/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1, // Jumlah slide yang akan ditampilkan
        spaceBetween: 10, // Jarak antara slide
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
        },
    });

    $(document).ready(function() {
        // Inisialisasi Owl Carousel
        $('.owl-carousel').owlCarousel({
            loop: true, // Mengaktifkan fitur looping
            margin: 10, // Jarak antara item
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2 // Tampil satu item pada layar yang sangat kecil
                },
            }
        });

        const quantityInput = $('.cart-quantity-input');
        const minusButton = $('.quantity-button-handler.minus');
        const plusButton = $('.quantity-button-handler.plus');

        minusButton.click(function() {
            let currentValue = parseInt(quantityInput.val());
            if (currentValue > 1) {
                currentValue--;
                quantityInput.val(currentValue);
            }
        });

        plusButton.click(function() {
            let currentValue = parseInt(quantityInput.val());
            currentValue++;
            quantityInput.val(currentValue);
        });

        $('.add_keranjang').click(function() {
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

        $('.cart-form').submit(function(e) {
            e.preventDefault();
            var FormData = $(this).serialize();

            $.ajax({
                url: '<?= base_url('keranjang/update') ?>', // Ganti dengan URL endpoint Anda
                type: 'POST', // Metode HTTP yang digunakan (POST, GET, dll.)
                data: FormData, // Data yang dikirim ke server
                success: function(response) {
                    if (response.success == true) {
                        Swal.fire({
							title: 'Success!',
							text: response.msg,
							icon: 'success',
							showCancelButton: true,
							confirmButtonText: 'Ya, lanjut belanja',
							cancelButtonText: 'Tutup',
							customClass: {
								confirmButton: 'btn btn-success ms-2',
								cancelButton: 'btn btn-secondary'
							}
						}).then((result) => {
							window.location.reload();
						});

                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            type: 'error',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });
                    }
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                },
            });
        });

    });
</script>

</body>

</html>
