<?php $this->load->view('layouts/user/head'); ?>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
<style>
    .navbar__left {
        width: 4rem;
        z-index: 2;
    }

    li {
        list-style: none;
    }

    .item-list ul li {
        border-bottom: 1px solid #E8EFF3;
        padding: 0 15px;
        margin: 10px -15px;
    }

    .item-list .item-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: -5px;
        margin-bottom: -5px;
    }

    .item-list .item-content .item-media {
        margin-left: 20px;
        margin-bottom: 10px;
        position: relative;
    }

    .media {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .media-90 {
        width: 90px;
        min-width: 90px;
        height: 90px;
    }

    .item-list .item-content .item-inner {
        flex: 1;
    }

    .item-list .item-content .item-inner .item-title-row {
        margin-bottom: 10px;
    }

    .item-list .item-content .item-inner .item-footer {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
        justify-content: space-between;
    }

    .item-list .item-content .item-media img {
        border-radius: 8px;
    }

    .media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-list .item-content .item-bookmark {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .item-list .item-content .item-inner .item-title-row .item-subtitle {
        font-size: 0.875rem;
    }

    h6,
    .h6 {
        font-size: 1rem;
    }

    .me-3 {
        margin-right: 1rem !important;
    }

    .item-list .item-content .item-inner .item-footer .fa-star {
        color: #FFA902;
        margin-right: 10px;
    }

    .fa-star:before {
        content: "\f005";
    }

    .item-list .item-content .item-inner .item-footer h6,
    .item-list .item-content .item-inner .item-footer .h6 {
        margin-bottom: 0;
    }

    h1,
    .h1,
    h2,
    .h2,
    h3,
    .h3,
    h4,
    .h4,
    h5,
    .h5,
    h6,
    .h6 {
        margin-top: 0;
        margin-bottom: 0.5rem;
        font-weight: 600;
        line-height: 1.2;
        color: #4f658b;
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
            <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Pencarian Barang</h1>
        </div>
    </div>
</nav>


<div id="loading" class="loading-overlay" style="display: none;">
    <div class="loading-spinner">
        <i class="fa fa-spinner fa-spin"></i>
        Loading...
    </div>
</div>

<section class="mt-3 mb-1">
    <div class="container">
        <div class="mb-3">
            <div class="row d-flex g-2">
                <form class="col-12" action="<?= base_url('home') ?>" method="GET">
                    <div class="mb-1">
                        <div class="input-icon">
                            <input type="text" value="<?= $_GET['cari'] ?>" id="cari" name="cari" class="form-control form-control-rounded" placeholder="Cari…" style="height: 48px;border: 1px solid #E8EFF3;padding: 10px 20px;font-size: 16px;font-weight: 500;color: var(--dark);transition: all 0.3s ease-in-out;background: #fff;border-radius: 5px !important" />
                            <span class="input-icon-addon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20.5605 18.4395L16.7528 14.6318C17.5395 13.446 18 12.0262 18 10.5C18 6.3645 14.6355 3 10.5 3C6.3645 3 3 6.3645 3 10.5C3 14.6355 6.3645 18 10.5 18C12.0262 18 13.446 17.5395 14.6318 16.7528L18.4395 20.5605C19.0245 21.1462 19.9755 21.1462 20.5605 20.5605C21.1462 19.9748 21.1462 19.0252 20.5605 18.4395ZM5.25 10.5C5.25 7.605 7.605 5.25 10.5 5.25C13.395 5.25 15.75 7.605 15.75 10.5C15.75 13.395 13.395 15.75 10.5 15.75C7.605 15.75 5.25 13.395 5.25 10.5Z" fill="#B9B9B9"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="mt-3 mb-1">
    <div class="container">
        <p style="margin-bottom: 10px !important;text-align:right"><b><?= count($barang_filter) ?></b> Barang Ditemukan untuk keyword <b><?= $_GET['cari'] ?></b></p>
        <div id="lazy-load-container"></div>
    </div>
</section>

<div class="row">
    <br><br><br><br>
</div>
<?php $this->load->view('layouts/user/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var page = 1; // Halaman awal untuk lazy load
    var loading = false; // Status memuat data

    function loadMoreData() {
        if (loading) return;
        loading = true;

        $.ajax({
            url: '<?php echo base_url('home/load_more_data/'); ?>' + '?page=' + page + '&cari=<?= $_GET['cari'] ?>',
            type: 'GET',
            dataType: 'html',
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(data) {
                if (data) {
                    $('#lazy-load-container').append(data);
                    page++;
                    loading = false;
                }
            },
            complete: function() {
                // Sembunyikan indikator loading di sini
                $("#loading").hide();
            },
            error: function() {
                loading = false;
            }
        });
    }

    loadMoreData();

    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $('#lazy-load-container').height() - 100) {
                loadMoreData();
            }
        });
    });

    function showAlert(idProduk) {
        var data = {
            idProduk: idProduk
        };

        $.ajax({
            url: '<?= base_url('keranjang/add') ?>', // Ganti dengan URL endpoint Anda
            type: 'POST', // Metode HTTP yang digunakan (POST, GET, dll.)
            data: data, // Data yang dikirim ke server
            success: function(response) {
                if (response.success == true) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.msg,
                        type: 'success',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
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
    }
</script>
</body>

</html>