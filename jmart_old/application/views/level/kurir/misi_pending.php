<?php $this->load->view('layouts/kurir/head'); ?>
<style>
    .navbar__left {
        width: 4rem;
        z-index: 2;
    }

    .title {
        font-weight: 700;
        margin-bottom: 0;
        color: #2C406E;
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

    .notification-list .list-items {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        margin: 0 -15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .notification-list>ul li {
        position: relative;
    }

    .pull_delete {
        position: relative;
        min-width: calc(100% + 90px) !important;
    }

    .media {
        display: flex;
        align-items: center;
    }

    .media-60 {
        width: 60px;
        min-width: 60px;
        height: 60px;
    }

    .m-r10 {
        margin-right: 10px;
    }

    .notification-list .list-items .media img {
        border-radius: 20px;
    }

    .media img {
        width: 100%;
        min-width: 100%;
        height: 100%;
        object-fit: cover;
    }

    img {
        border-style: none;
        height: auto;
        max-width: 100%;
        vertical-align: middle;
    }

    .notification-list .list-items .list-content .title {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .title {
        color: #000;
        font-weight: bold;
    }

    .dz-total-area.fixed {
        width: 100%;
        background-color: #FFFAF3;
    }

    .dz-total-area {
        padding: 15px 15px 15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .dz-total-area .total-prize {
        display: flex;
        gap: 6px;
        margin-bottom: 5px;
    }

    .dz-total-area .total-prize>li {
        font-size: 18px;
    }

    .dz-total-area .total-prize .prize {
        font-weight: 700;
    }

    .dz-total-area .dz-text {
        display: flex;
        align-items: center;
        font-size: 15px;
        font-weight: 500;
        color: #159E42;
        gap: 6px;
    }

    .table tbody td.item img {
        width: 30px;
        height: 30px;
        object-fit: contain;
        margin-right: 10px;
    }

    .table tbody td.item {
        font-family: 'Dancing Script', cursive;
        font-weight: 900;
        text-align: left;
    }
</style>
<?php $this->load->view('layouts/kurir/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
    <div class="container">
        <div class="navbar__left">
            <a href="<?= base_url('home') ?>">
                <svg class="navbar__left__icon fw-bold text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);cursor:pointer;z-index: 2;">
                    <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
                </svg>
            </a>
        </div>

        <div class="nav-bar__center">
            <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;text-align:center !important;vertical-align:middle">Daftar Misi</h1>
        </div>
    </div>
</nav>

<div class="terms-tab-wrapper shadow">
    <div class="container">
        <ul class="nav row row--no terms-tab">
            <li class="nav-item col-6">
                <a class="nav-link" id="Donasi-tab" data-toggle="tab" href="<?= base_url('misi/list') ?>" role="tab" aria-controls="home" aria-selected="true">Dalam Misi</a>
            </li>
            <li class="nav-item col-6">
                <a class="nav-link active" id="Donasi-tab" data-toggle="tab" href="<?= base_url('misi/pending') ?>" role="tab" aria-controls="home" aria-selected="true">Belum Discan</a>
            </li>
        </ul>
    </div>
</div>

<section class="mt-3 mb-4">
    <div class="row">
        <div class="dz-list notification-list">
            <ul style="background-color:#FFFAF3">
                <?php foreach ($pending as $key => $value) : ?>
                    <?php
                    $items = $this->db->select('*')->from('tb_pesanan_detail')->where('id_pesanan', $value['id_pesanan'])->get()->num_rows();
                    ?>
                    <li class="list-items pull_delete" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#detailPesananModal<?= $value['id_pesanan'] ?>">
                        <div class=" media">
                            <div class="media-60 m-r10">
                                <img src="<?= base_url('public/template/upload/user/' . $value['avatar']) ?>" alt="">
                            </div>
                            <div class="list-content">
                                <h5 class="title"> <?= $value['nama_member'] . " <span class=\"text-success\">(" . $items . " barang)</span>" ?></h5>
                                <span class="date"><?= date('d F Y H:i:s', strtotime($value['tgl_pesanan'])) ?></span>
                            </div>
                        </div>
                        <i class="pd_btn"></i>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <?php if (count($pending) <= 0) : ?>
            <div class="empty">
                <div class="empty-action">
                    <div class="text-center">
                        <img src="https://i.imgur.com/dCdflKN.png" width="100" height="100" class="img-fluid">
                        <h3 class="mb-0"><strong>Empty</strong></h3>
                        <h4 class="mb-1">Tidak ada pesanan Baru saat ini</h4>
                        <a href="<?= base_url('home') ?>" class="btn btn-primary cart-btn-transform m-3" data-abc="true">Kembali ke Home</a>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</section>

<div class="row">
    <br><br><br><br>
</div>

<?php foreach ($pending as $key => $value) : ?>
    <div class="modal fade" id="detailPesananModal<?= $value['id_pesanan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content" style="background:#fafbfc !important">
                <div class="modal-body pt-4 pb-2 px-4" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <div class="text-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-info-square-rounded-filled text-info" width="45" height="45" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor"></path>
                        </svg>
                        <h2 id="modal-title" class="mt-2">Detail Pesanan</h2>
                    </div>
                    <div class="dz-total-area fixed">
                        <ul class="total-prize mb-0" style="list-style: none;padding-left: 0rem;">
                            <li class="name">Subtotal</li>
                            <li class="prize">Rp. <?= number_format($value['grand_total']) ?></li>
                        </ul>
                        <ul class="total-prize mb-0" style="list-style: none;padding-left: 0rem;">
                            <li class="name">Ongkos Kirim</li>
                            <li class="prize">Rp. <?= number_format($value['ongkos_kirim']) ?></li>
                        </ul>
                        <ul class="total-prize mb-0" style="list-style: none;padding-left: 0rem;">
                            <li class="name">Total Semua</li>
                            <li class="prize">Rp. <?= number_format($value['grand_total'] + $value['ongkos_kirim']) ?></li>
                        </ul>
                    </div>
                    <div class="table-responsive">
                        <table class="table activitites" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-uppercase header">Item</th>
                                    <th scope="col" class="text-uppercase">Jumlah</th>
                                    <th scope="col" class="text-uppercase">Harga Satuan</th>
                                    <th scope="col" class="text-uppercase">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $brg = $this->db->select('*')->from('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->where('id_pesanan', $value['id_pesanan'])->get()->result_array();
                                ?>
                                <?php foreach ($brg as $key => $b) : ?>
                                    <?php
                                    $gambar = $b['gambar_barang'] == "default.png" ? "<img width=\"auto\" height=\"50\" style='\border-radius: 3px;' src='" . base_url('public/template/upload/barang/' . $b['gambar_barang']) . "'>" : "<img width=\"auto\" height=\"50\" style='\border-radius: 3px;' src='" . base_url('public/template/upload/barang/' . $b['gambar_barang']) . "'>";
                                    ?>
                                    <tr>
                                        <td class="item">
                                            <div class="d-flex">
                                                <?= $gambar ?>
                                                <div class="pl-2">
                                                    <?= $b['nama_barang'] ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $b['jumlah_jual'] ?></td>
                                        <td><?= $b['harga_saat_ini'] ?></td>
                                        <td class="font-weight-bold">
                                            <?= $b['harga_saat_ini'] * $b['jumlah_jual'] ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0 solid #e6e7e9 !important">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                    Batalkan
                                </button>
                            </div>
                            <div class="col">
                                <button data-id_pesanan="<?= $value['id_pesanan'] ?>" type="button" id="btn-submit" class="btn btn-primary btn-validasi w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="btn-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <path d="M9 12l2 2l4 -4"></path>
                                    </svg>
                                    <span id="btn-icon"></span>
                                    <span id="btn-text">Siap Dikirimkan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?php $this->load->view('layouts/kurir/menu'); ?>
<?php $this->load->view('layouts/kurir/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Menangkap klik pada tombol
        $('.btn-validasi').on('click', function() {
            // Mendapatkan ID pesanan dari atribut data
            var id_pesanan = $(this).data('id_pesanan');

            // Kirim AJAX ke server
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('misi/validasi'); ?>",
                type: "POST",
                data: {
                    id: id_pesanan
                },
                success: function(response) {
                    if (response.success == true) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.msg,
                            icon: 'success',
                            confirmButtonText: 'Close'
                        }).then(() => {
                            setTimeout(function() {
                                location.reload(); // ini akan memuat ulang halaman setelah 2 detik
                            }, 2000);
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Tangani kesalahan jika ada
                    console.error('Terjadi kesalahan:', error);
                }
            });
        });
    });
</script>
</body>

</html>