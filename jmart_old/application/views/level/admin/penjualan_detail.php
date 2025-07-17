<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    .sa-page-meta {
        border-bottom: 1px solid #2125291a;
        border-top: 1px solid #2125291a;
        font-size: .875rem;
        line-height: 1.25rem;
        padding: 0.5625rem 1rem;
    }

    .sa-page-meta__body {
        overflow: hidden;
    }

    .sa-page-meta__list {
        display: flex;
        flex-wrap: wrap;
        margin-top: -0.25rem;
        margin-left: -1.5625rem;
    }

    .sa-page-meta__item {
        margin-top: 0.25rem;
        position: relative;
        margin-left: 1.5625rem;
    }

    .sa-page-meta__item:before {
        left: -0.8125rem;
        background: #21252933;
        content: "";
        display: block;
        height: calc(100% - 0.375rem);
        position: absolute;
        top: 0.1875rem;
        width: 0.0625rem;
    }

    .steps .step {
        display: block;
        width: 100%;
        text-align: center;
    }

    @media (max-width: 991.98px) {
        .steps .step .step-icon-wrap {
            height: 50px;
        }
    }

    .steps .step .step-icon-wrap {
        display: block;
        position: relative;
        width: 100%;
        height: 80px;
        text-align: center;
    }

    .steps .step .step-title {
        margin-top: 16px;
        margin-bottom: 0;
        color: #606975;
        font-size: 14px;
        font-weight: 500;
    }

    .steps .step.completed .step-icon {
        border-color: #88aaf3;
        background-color: #88aaf3;
        color: #fff;
    }

    @media (max-width: 991.98px) {
        .steps .step .step-icon {
            width: 50px;
            height: 50px;
            font-size: 26px;
            line-height: 50px;
            border-radius: 18px;
        }
    }

    .steps .step .step-icon {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        border: 1px solid #e1e7ec;
        border-radius: 30px;
        background-color: #f5f5f5;
        color: #374250;
        font-size: 38px;
        line-height: 81px;
        z-index: 5;
    }

    .steps .step.completed .step-icon-wrap::before {
        background-color: #88aaf3;
    }

    .steps .step.completed .step-icon-wrap::after {
        background-color: #88aaf3;
    }

    .steps .step .step-icon-wrap::before {
        display: block;
        position: absolute;
        top: 50%;
        width: 50%;
        height: 3px;
        margin-top: -1px;
        background-color: #e1e7ec;
        content: "";
        z-index: 1;
        left: 0;
    }

    .steps .step .step-icon-wrap::after {
        display: block;
        position: absolute;
        top: 50%;
        width: 50%;
        height: 3px;
        margin-top: -1px;
        background-color: #e1e7ec;
        content: "";
        z-index: 1;
        right: 0;
    }
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Invoice
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <button type="button" class="btn btn-secondary" onclick="location.href='<?= base_url('penjualan') ?>'">
                    <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                        <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
                    </svg>
                    &nbsp;&nbsp;Kembali
                </button>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p class="h3">JMART</p>
                                <address>
                                    Tanggal Order : <?= date('d/M/Y H:i:s', strtotime($pesanan['tgl_pesanan'])) ?><br>
                                    Jenis Order : <?= ucwords(str_replace('_', ' ', $pesanan['jenis_order'])) ?><br>
                                    Metode Bayar : <?= ucwords(str_replace('_', ' ', $pesanan['metode_bayar'])) ?><br>
                                    Status Pembayaran : <?= ucwords(str_replace('_', ' ', $pesanan['status_pembayaran'])) ?>
                                </address>
                            </div>
                            <div class="col-6 text-end">
                                <p class="h3">Customer</p>
                                <address>
                                    <?= $pesanan['nama_member'] ?><br>
                                    <?= $pesanan['nomor_induk'] ?><br>
                                    <?= $pesanan['wa_member'] ?><br>
                                    <?= $pesanan['email_member'] ?>
                                </address>
                            </div>
                            <div class="col-12 my-5">
                                <h1>Invoice #<?= $pesanan['id_pesanan'] ?></h1>
                            </div>
                        </div>
                        <table class="table table-transparent table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 1%"></th>
                                    <th>Product</th>
                                    <th class="text-center" style="width: 1%">Qnt</th>
                                    <th class="text-end" style="width: 1%">Unit</th>
                                    <th class="text-end" style="width: 1%">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $key + 1 ?></td>
                                        <td>
                                            <p class="strong mb-1"><?= $value['nama_barang'] ?></p>
                                            <div class="text-secondary"><?= $value['nama_kategori_brg'] ?></div>
                                        </td>
                                        <td class="text-center">
                                            <?= $value['jumlah_jual'] ?>
                                        </td>
                                        <td class="text-end text-nowrap">Rp. <?= number_format($value['harga_saat_ini']) ?></td>
                                        <td class="text-end text-nowrap">Rp. <?= number_format($value['harga_saat_ini'] * $value['jumlah_jual']) ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td colspan="4" class="strong text-end">Subtotal</td>
                                    <td class="text-end"><?= "Rp. " . number_format($pesanan['grand_total'] - $pesanan['ongkos_kirim']) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="strong text-end">Ongkos Kirim</td>
                                    <td class="text-end">Rp. <?= number_format($pesanan['ongkos_kirim']) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="strong text-end">Grand Total</td>
                                    <td class="text-end">Rp. <?= number_format($pesanan['grand_total']) ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="text-secondary text-center mt-5">Thank you very much for doing business with us. We look forward to working with
                            you again!</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header bg-dark text-white text-center justify-content-center">
                        <span class="text-uppercase">Tracking Order No - </span>
                        <span class="text-medium">&nbsp;<?= $id ?></span>
                    </div>
                    <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2" style="background:#f5f5f5 !important">
                        <div class="w-100 text-center py-1 px-2"><span class="text-medium">Dikirim oleh:</span> Kurir JMART</div>
                        <div class="w-100 text-center py-1 px-2"><span class="text-medium">Status:</span>
                            <?= $pesanan['status_pesanan'] ?></div>
                        <div class="w-100 text-center py-1 px-2"><span class="text-medium">Tanggal Pesanan:</span> <?= date('d-m-Y H:i:s', strtotime($pesanan['tgl_pesanan'])) ?></div>
                    </div>
                    <div class="card-body">
                        <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                            <div class="step completed">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="fa fa-clock"></i></div>
                                </div>
                                <h4 class="step-title">Pesanan Dibuat</h4>
                                <p><?= date('d/F/Y H:i:s', strtotime($pesanan['tgl_pesanan'])) ?></p>
                            </div>
                            <?php
                            $cek_dikemas = $this->db->select('*')->from('tb_pesanan_tracking')->where('status_tracking', 'Pesanan Disiapkan')->where('id_pesanan', $id)->get()->row_array();
                            ?>
                            <div class="step <?= isset($cek_dikemas) ? "completed" : "" ?>">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="fa fa-gift"></i></div>
                                </div>
                                <h4 class="step-title">Pesanan Dikemas</h4>

                                <?php if (isset($cek_dikemas)) : ?>
                                    <p><?= date('d/F/Y H:i:s', strtotime($cek_dikemas['updated_at'])) ?></p>
                                <?php else : ?>
                                    <p>None</p>
                                <?php endif ?>
                            </div>
                            <?php
                            $cek_dikirimkan = $this->db->select('*')->from('tb_pesanan_tracking')->where('status_tracking', 'Pesanan Dikirimkan')->where('id_pesanan', $id)->get()->row_array();
                            ?>
                            <div class="step <?= isset($cek_dikirimkan) ? "completed" : "" ?>">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="fa fa-car"></i></div>
                                </div>
                                <h4 class="step-title">Pesanan Dikirimkan</h4>
                                <?php if (isset($cek_dikirimkan)) : ?>
                                    <p><?= date('d/F/Y H:i:s', strtotime($cek_dikirimkan['updated_at'])) ?></p>
                                <?php else : ?>
                                    <p>None</p>
                                <?php endif ?>
                            </div>
                            <?php
                            $cek_selesai = $this->db->select('*')->from('tb_pesanan_tracking')->where('status_tracking', 'Pesanan Selesai')->where('id_pesanan', $id)->get()->row_array();
                            ?>
                            <div class="step <?= isset($cek_selesai) ? "completed" : "" ?>">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="fa fa-check"></i></div>
                                </div>
                                <h4 class="step-title">Pesanan Selesai</h4>
                                <?php if (isset($cek_selesai)) : ?>
                                    <p><?= date('d/F/Y H:i:s', strtotime($cek_selesai['updated_at'])) ?></p>
                                <?php else : ?>
                                    <p>None</p>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layouts/admin/footer'); ?>
</body>

</html>