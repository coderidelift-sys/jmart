<html mozNoMarginBoxes mozDisallowSelectionPrint>

<head>
    <title><?= $judul; ?></title>

    <style typa="text/css">
        html {
            font-family: "verdana, arial";
        }

        .content {
            width: 120mm;
            font-size: 12px;
            padding: 5px;
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 5px;
            padding-bottom: 10px;
            border-bottom: 1px dashed;
        }

        table {
            width: 100%;
            font-size: 12px;
        }

        .thanks {
            padding-top: 10px;
            font-size: 11px;
            text-align: center;
            border-top: 1px dashed;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }

        table tr td {
            vertical-align: text-top;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="title">
            <b>PT Damases Sejahtera Cabang Semarang</b>
            <br>
            <small>Taman Sawunggaling Block C3, Padangsari, Banyumanik, Semarang</small><br>
            <small>Telp. (+62) 858-1000-9857</small>
        </div>


        <div class="head">
            <table cellspacong="0" cellpadding="0">
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td style="width:120px"><?= "Tanggal" ?>, <?= "WAKTU"; ?></td>
                    <td>Kasir</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:right"><?= "Kasir" ?></td>
                </tr>
                <tr>
                    <td>Invoice</td>
                    <td>:</td>
                    <td><?= "Invoice" ?></td>
                    <td>Pelanggan</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:right"><?= "Pelanggan"; ?></td>
                </tr>
            </table>
        </div>

        <div class="transaction">
            <table class="transaction-table" cellspacong="0" cellpadding="0">
                <tr>
                    <td style="min-width: 130px">Kode Barang</td>
                    <td style="min-width: 130px">Nama Barang</td>
                    <td style="text-align:center;">Harga</td>
                    <td style="text-align:right;">Jml</td>
                    <td style="text-align:right;">Satuan</td>
                    <td style="text-align:right;">Total</td>
                </tr>

                <tr>
                    <td colspan="6" style="border-bottom:1px dashed; padding-top:5px;"></td>
                </tr>
                <!-- <?php foreach ($detail_transaksi as $d) { ?> -->
                <tr>
                    <td>Barang</td>
                    <td>Barang</td>
                    <td>Barang</td>
                    <td>Barang</td>
                    <td>Barang</td>
                    <td>Barang</td>
                </tr>
                <!-- <?php } ?> -->

                <tr>
                    <td colspan="5" style="border-top:1px dashed; text-align:right; padding: 5px 0"><b>Total Belanja</b></td>
                    <td style="border-top:1px dashed; text-align:right; padding: 5px 0"><b><?= "Total" ?></b></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right;"><b>Tunai</b></td>
                    <td style="text-align:right;"><b><?= "Bayar" ?></b></td>
                </tr>
                <tr>
                    <td colspan="5" style="border-top:1px dashed; text-align:right; padding: 5px 0"><b>Kembalian</b></td>
                    <td style="border-top:1px dashed; text-align:right; padding: 5px 0"><b><?= "Kembalian" ?></b></td>
                </tr>
                <tr>
                    <td style="text-align:left;"><b>"Total Item" Items Barang</b></td>
                </tr>

            </table>
        </div>
        <div class="thanks">
            <b>Terima Kasih.</b>
        </div>
    </div>
</body>

</html>