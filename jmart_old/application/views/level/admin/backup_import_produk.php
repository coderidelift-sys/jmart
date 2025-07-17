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
                    Import Product
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row mb-3">
            <div class="col-md-12 col-lg-12">
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
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#tabs-home-ex2" class="nav-link active" data-bs-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                        <path d="M11 15h2V9h3l-4-5-4 5h3z"></path>
                                        <path d="M20 18H4v-7H2v7c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2v-7h-2v7z"></path>
                                    </svg> Import Barang</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-profile-ex2" class="nav-link" data-bs-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                        <path d="M4 5h13v7h2V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-2H4V5z"></path>
                                        <path d="m8 11-3 4h11l-4-6-3 4z"></path>
                                        <path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"></path>
                                    </svg> Import Gambar</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tabs-home-ex2">
                                <h4>Import Barang</h4>
                                <div class="text-center justify-content-center">
                                    <form action="<?= base_url('product/simpan_import') ?>" method="POST" enctype="multipart/form-data">
                                        <div class="col-6 mb-3 d-flex">
                                            <input name="file_excel" id="file_excel" type="file" class="form-control" style="flex: 1;" accept=".xls,.xlsx,.csv">
                                            <button type="submit" class="btn btn-primary ms-2">Unggah Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-profile-ex2">
                                <h4>Import Gambar</h4>
                                <div class="text-center justify-content-center">
                                    <form action="<?= base_url('product/simpan_gambar') ?>" method="post" id="imageUploadForm" enctype="multipart/form-data">
                                        <div class="col-6 mb-3 d-flex">
                                            <input type="file" class="form-control" style="flex: 1;" id="imageInput" name="imageInput[]" accept=".jpg,.jpeg" multiple>
                                            <button type="submit" class="btn btn-primary ms-2">Unggah Gambar</button>
                                        </div>
                                    </form>

                                    <div id="imagePreview" class="image-container">
                                        <!-- Container untuk menampilkan gambar terpilih -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header" style="padding: 0.5rem 1rem;margin-bottom: 0;background: #f7f7f8;border-bottom: 1px solid rgba(0, 0, 0, .125);border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;">
                        <h2 style="font-size: 16px;line-height: 16px;font-weight: 700;font-family: ubuntu,sans-serif;float: left;padding: 10px 0;margin: 0 0 0 20px;" class="blue"><i style="border-right: 1px solid #dbdee0;padding: 12px 0;height: 40px;width: 40px;display: inline-block;text-align: center;margin: -10px 20px -10px -20px;font-size: 16px;" class="fa fa-chart-bar"></i>Syarat dan Ketentuan</h2>
                    </div>
                    <div class="card-body">
                        <p class="text-secondary">
                            <img src="https://tmuk00294.foliopos.com/v2/assets/img/import-product-template.jpg" alt="">
                        </p>
                        <div class="text-center justify-content-center">
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3"></path>
                                </svg>
                                Unduh Template
                            </button>
                        </div>
                        <div class="card-title mt-2">Cara penggunaan template "Import Produk"</div>
                        <ol class="mb-2">
                            <li class="mb-15">Isi kolom-kolom yang wajib diisi, yang berwarna merah muda, yaitu:
                                <ol type="i">
                                    <li>Nama Produk </li>
                                    <li>HPP (Harga Pokok Penjualan)</li>
                                    <li>Harga Jual Sebelum Pajak</li>
                                    <li>Harga Jual Setelah Pajak</li>
                                </ol>
                            </li>
                            <li class="mb-15">Kolom yang berwarna abu-abu tidak wajib diisi, yaitu:
                                <ol type="i">
                                    <li>Kategori </li>
                                    <li>Pajak (Isi angka dan tanda %. Contoh: 10%)</li>
                                    <li>Stok</li>
                                    <li>Pemasok </li>
                                </ol>
                            </li>
                            <li class="mb-15">Jika produk Anda mempunyai barcode:
                                <ol type="i">
                                    <li>Isi kolom barcode dengan angka, huruf atau kombinasi keduanya</li>
                                    <li>Isian barcode harus unik</li>
                                </ol>
                            </li>
                            <li class="mb-15">Jika produk Anda mempunyai varian:
                                <ol type="i">
                                    <li>Anda dapat mengisi kolom Ukuran atau Warna</li>
                                    <li>Isi mulai dari varian yang terkecil hingga terbesar, contohnya; S, M, L, XL</li>
                                </ol>
                            </li>
                            <li>Jika usaha Anda merupakan Minimarket,
                                <ol type="i">
                                    <li>Jangan gunakan (kosongkan) kolom Ukuran dan Warna</li>
                                    <li>Masukkan nama produk beserta ukurannya di kolom Nama Produk</li>
                                    <li>Contoh 1: Aqua 300ml, Aqua 600ml dan Aqua 1000ml</li>
                                    <li>Contoh 2: Bebelac 400gr Rasa Madu, Bebelac 400gr, Rasa Vanilla</li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layouts/admin/footer'); ?>
<script>
    document.getElementById("imageInput").addEventListener("change", function() {
        var previewContainer = document.getElementById("imagePreview");

        var files = this.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function(e) {
                var imageItem = document.createElement("div");
                imageItem.classList.add("image-item");

                var img = document.createElement("img");
                img.src = e.target.result;

                var deleteButton = document.createElement("div");
                deleteButton.classList.add("image-delete");
                deleteButton.textContent = "Hapus";

                deleteButton.addEventListener("click", function() {
                    imageItem.remove(); // Hapus gambar dari tampilan
                });

                imageItem.appendChild(img);
                imageItem.appendChild(deleteButton);
                previewContainer.appendChild(imageItem);
            };

            reader.readAsDataURL(file);
        }
    });
</script>
</body>

</html>