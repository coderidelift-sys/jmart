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

    .order-product-box {
        display: block;
        /* background-color: rgba(240, 240, 241, 1); */
        background-color: white;
        border-radius: 8px;
        padding: 12px;
    }

    .order-product-box .horizontal-product-box {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        gap: 10px;
        padding: 0;
        padding-bottom: 12px;
    }

    .horizontal-product-box {
        background: rgba(var(--light-bg), 1);
        border-radius: 8px;
        padding: 10px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        gap: 10px;
    }

    .order-product-box .horizontal-product-box .horizontal-product-img {
        width: 68px;
        height: 68px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        background-color: rgba(240, 240, 241, 1);
        border-radius: 8px;
    }

    .horizontal-product-box .horizontal-product-img {
        width: 80px;
        height: 80px;
        padding: 12px 18px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        background: rgba(255, 255, 255, 1);
        border-radius: 8px;
    }

    .order-product-box .horizontal-product-box .horizontal-product-details {
        width: calc(100% - 45px - 15px);
    }

    .horizontal-product-box .horizontal-product-details {
        width: calc(100% - 80px - 10px);
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .gap-2 {
        gap: 0.5rem !important;
    }

    .order-product-box .horizontal-product-box .horizontal-product-details h4 {
        font-weight: 500;
        line-height: 1.2;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .horizontal-product-box .horizontal-product-details h4 {
        font-weight: 500;
        line-height: 1.2;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        color: rgba(18, 38, 54, 1);
    }

    .order-product-box .horizontal-product-box .horizontal-product-details .product-status {
        color: rgba(25, 135, 84, 1);
        background-color: rgba(25, 135, 84, 0.12);
        padding: 4px 8px;
        border-radius: 4px;
    }

    .order-product-box .horizontal-product-box .horizontal-product-details h5 {
        font-weight: 400;
        line-height: 1;
        color: rgba(155, 163, 170, 1);
        margin-top: 5px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .order-product-box .horizontal-product-box .horizontal-product-details .view-details {
        color: rgba(240, 73, 73, 1);
    }

    .order-product-box .order-details {
        padding-top: 12px;
        border-top: 1px solid rgba(0, 0, 0, 0.07);
    }

    .theme-form .upload-image {
        width: 100px;
        height: 100px;
        background-color: rgba(246, 246, 247, 1);
        -webkit-backdrop-filter: blur(2px);
        backdrop-filter: blur(2px);
        border-radius: 6px;
        color: rgba(255, 255, 255, 1);
        border: 1px dashed rgba(155, 163, 170, 1);
        overflow: hidden;
        margin-top: 12px;
    }

    .theme-form .upload-image .upload-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
        color: rgba(var(--light-text), 1);
    }

    .bintang {
        font-size: 30px;
        cursor: pointer;
    }

    .bintang-terpilih {
        color: gold;
    }
</style>
<?php $this->load->view('layouts/user/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
    <div class="container nav-bar__on-container" style="display: flex;">
        <div class="navbar__left">
            <a href="<?= base_url('pesanan') ?>">
                <svg class="navbar__left__icon fw-bold text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);cursor:pointer;z-index: 2;">
                    <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
                </svg>
            </a>
        </div>
        <div class="nav-bar__center">
            <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Riwayat Pesanan Saya</h1>
        </div>
    </div>
</nav>
<div class="terms-tab-wrapper shadow">
    <div class="container">
        <ul class="nav row row--no terms-tab overflow-auto">
            <li class="nav-item col-3">
                <a class="nav-link" id="Donasi-tab" data-toggle="tab" href="<?= base_url('pesanan/pending') ?>" role="tab" aria-controls="home" aria-selected="true">Pending</a>
            </li>
            <li class="nav-item col-3">
                <a class="nav-link" id="Campaign-tab" data-toggle="tab" href="<?= base_url('pesanan/dikemas') ?>" role="tab" aria-controls="profile" aria-selected="false">Dikemas</a>
            </li>
            <li class="nav-item col-3">
                <a class="nav-link" id="Campaign-tab" data-toggle="tab" href="<?= base_url('pesanan/dikirim') ?>" role="tab" aria-controls="profile" aria-selected="false">Dikirim</a>
            </li>
            <li class="nav-item col-3">
                <a class="nav-link active" id="Campaign-tab" data-toggle="tab" href="<?= base_url('pesanan/selesai') ?>" role="tab" aria-controls="profile" aria-selected="false">Selesai</a>
            </li>
        </ul>
    </div>
</div>

<section class="mt-4 mb-4">
    <div class="container">
        <div class="row">
            <?php foreach ($selesai as $key => $value) : ?>
                <?php
                $all = $this->db->select('*')->from('tb_pesanan_detail')->where('id_pesanan', $value['id_pesanan'])->get()->num_rows();

                $sum = $this->db->select('SUM(harga_saat_ini * jumlah_jual) as total_harga')->from('tb_pesanan_detail')->where('id_pesanan', $value['id_pesanan'])->get()->row();

                $data = $this->db->select('*')->from('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg')->where('id_pesanan', $value['id_pesanan'])->get()->row_array();

                $gambar = $data['gambar_barang'] == "https://dodolan.jogjakota.go.id/assets/media/default/default-product.png" ? "<img style='\border-radius: 3px;height: 50px;' src='" . $data['gambar_barang'] . "'>" : "<img style='\border-radius: 3px;height: 50px;' src='" . base_url('public/template/upload/barang/' . $data['gambar_barang']) . "'>";
                ?>
                <div class="col-12 mb-3">
                    <div class="order-product-box">
                        <div class="horizontal-product-box">
                            <a href="<?= base_url('pesanan/tracking/' . $value['id_pesanan']) ?>" class="horizontal-product-img">
                                <?= $gambar ?>
                            </a>
                            <div class="horizontal-product-details">
                                <div class="d-flex align-items-center justify-content-between gap-2">
                                    <h4 style="font-size: 14px;margin-bottom: 0;"><?= $data['nama_barang'] ?></h4>

                                    <h6 style="font-size: 12px;line-height: 1.2;margin-bottom: 0;" class="product-status">Selesai</h6>
                                </div>
                                <h5 style="font-size: 13px;line-height: 1.2;margin-bottom: 0;">Qty:<?= $all ?></h5>
                                <h5 onclick="location.href='<?= base_url('pesanan/detail/' . $value['id_pesanan']) ?>'" style="font-size: 13px;line-height: 1.2;margin-bottom: 0;cursor:pointer" class="view-details">View Details</h5>
                            </div>
                        </div>
                        <div class="order-details d-block">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 style="font-size: 13px;line-height: 1.2;margin-bottom: 0;" class="theme-color">Order : <span class="light-text"><?= date('d/M/Y H:i:s', strtotime($value['tgl_pesanan'])) ?></span></h5>

                                <?php
                                $cek_review = $this->db->select('id_pesanan')->from('tb_rating')->where('id_pesanan', $value['id_pesanan'])->get()->num_rows();

                                if ($cek_review <= 0) {
                                    echo "<h5 style=\"font-size: 13px;line-height: 1.2;margin-bottom: 0;cursor:pointer\" data-bs-toggle=\"modal\" data-bs-target=\"#my-review$value[id_pesanan]\">+ Write Review</h5>";
                                } else {
                                    echo "<h5 style=\"font-size: 13px;line-height: 1.2;margin-bottom: 0;color:green\">Sudah Direview</h5>";
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <?php if (empty($selesai)) : ?>
                <div class="page page-center">
                    <div class="container-tight py-4">
                        <div class="empty">
                            <div class="empty-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1)">
                                    <path d="M19 4h-3V2h-2v2h-4V2H8v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-7 10H7v-2h5v2zm5-4H7V8h10v2z"></path>
                                </svg>
                            </div>
                            <p class="empty-subtitle text-secondary">
                                Belum Ada Pesanan
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>

<div class="row">
    <br><br><br><br>
</div>

<?php foreach ($selesai as $key => $dt) : ?>
    <?php
    $barang_pesan = $this->db->select('*')->from('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->where('id_pesanan', $dt['id_pesanan'])->get()->result_array();
    ?>
    <div class="modal fade" id="my-review<?= $dt['id_pesanan'] ?>" tabindex="-1" aria-labelledby="offcanvasBottomLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="offcanvasBottomLabel">Create Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_review" class="theme-form" action="<?= base_url('pesanan/rating') ?>" method="POST">
                        <div class="row">
                            <?php foreach ($barang_pesan as $barang) : ?>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <label for="review" class="form-label"><?php echo $barang['nama_barang']; ?></label>
                                        <!-- <input type="hidden" name="id_brg[]" value="<?php echo $barang['id_brg']; ?>"> -->
                                        <div class="rating-sec d-flex align-items-center justify-content-start gap-1 border-0 p-0">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <div class="bintang" id="<?php echo $barang['id_brg'] . '-star-' . $i; ?>" data-product="<?php echo $barang['nama_barang']; ?>">&#9733;</div>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                    <label for="email" class="form-label">Upload Gambar</label>
                                    <input accept=".png,.jpg,.jpeg,.svg" name="file" type="file" multiple class="form-control" />
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                    <label for="reviewText" class="form-label">Review</label>
                                    <input type="hidden" class="form-control" name="id_pesanan" id="id_pesanan" value="<?= $dt['id_pesanan'] ?>">
                                    <textarea class="form-control" placeholder="Write Your Review Here" id="reviewText" name="reviewText" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-white mt-2">Submit your Review</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>


<?php $this->load->view('layouts/user/menu'); ?>
<?php $this->load->view('layouts/user/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Sertakan Dropzone.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">
<script>
    $(document).ready(function() {
        // Menggunakan atribut data-product untuk mengidentifikasi produk
        const ratings = [];
        $(".bintang").click(function() {
            const id = $(this).attr("id"); // Mengambil ID bintang
            const product = $(this).data("product"); // Mengambil nama produk

            // Hapus kelas 'bintang-terpilih' dari semua bintang dengan nama produk yang sama
            $(`.bintang[data-product="${product}"]`).removeClass("bintang-terpilih");

            // Tambahkan kelas 'bintang-terpilih' ke bintang yang diklik dan semua bintang sebelumnya
            $(`#${id}`).addClass("bintang-terpilih");
            $(`#${id}`).prevAll(".bintang").addClass("bintang-terpilih");

            // Menghitung jumlah bintang terpilih (rating)
            const jumlahRating = $(`.bintang[data-product="${product}"].bintang-terpilih`).length;

            const ratingData = {
                id_brg: id,
                rating: jumlahRating
            };

            ratings.push(ratingData);
        });

        $("#form_review").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?= base_url('pesanan/rating'); ?>", // Ganti dengan URL yang sesuai
                data: {
                    id_pesanan: $("#id_pesanan").val(),
                    ratings: ratings,
                    review: $("#reviewText").val()
                },
                success: function(response) {
                    alert("Data rating berhasil dikirim.");
                },
				beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                error: function() {
                    alert("Terjadi kesalahan saat mengirim data rating.");
                }
            });
        });
    });
</script>
</body>

</html>
