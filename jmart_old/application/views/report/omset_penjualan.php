<!DOCTYPE html>
<html lang="en">

<head>
    <title>.:: REPORT ::.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        .totals-row td {
            border-right: none !important;
            border-left: none !important;
        }


        td {
            white-space: nowrap;
        }

        .items-table td,
        #notes {
            white-space: normal;
        }

        .totals-row td strong,
        .items-table th {
            white-space: nowrap;
        }
    </style>
    <style type="text/css">
        .is_logo {
            display: none;
        }
    </style>
</head>

<body>
    <div id="editor" class="edit-mode-wrap" style="margin-top: 20px">
        <style type="text/css">
            .is_logo {
                display: none;
            }
        </style>
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
            }

            body {
                background: #fff;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
                line-height: 20px;
            }

            #extra {
                text-align: right;
                font-size: 22px;
                font-weight: 700
            }

            .invoice-wrap {
                width: 700px;
                margin: 0 auto;
                background: #FFF;
                color: #000
            }

            .invoice-inner {
                margin: 0 15px;
                padding: 20px 0
            }

            .invoice-address {
                border-top: 3px double #000000;
                margin: 25px 0;
                padding-top: 25px;
            }

            .bussines-name {
                font-size: 18px;
                font-weight: 100
            }

            .invoice-name {
                font-size: 22px;
                font-weight: 700
            }

            .listing-table th {
                background-color: #e5e5e5;
                border-bottom: 1px solid #555555;
                border-top: 1px solid #555555;
                font-weight: bold;
                text-align: left;
                padding: 6px 4px
            }

            .listing-table td {
                border-bottom: 1px solid #555555;
                text-align: left;
                padding: 5px 6px;
                vertical-align: top
            }

            .total-table td {
                border-left: 1px solid #555555;
            }

            .row-items {
                margin: 5px 0;
                display: block
            }

            .notes-block {
                margin: 50px 0 0 0
            }

            /*tables*/
            table td {
                vertical-align: top
            }

            .items-table {
                border: 1px solid #555555;
                border-collapse: collapse;
                width: 100%
            }

            .items-table td,
            .items-table th {
                border: 1px solid #555555;
                padding: 4px 5px;
                text-align: left
            }

            .items-table th {
                background: #f5f5f5;
            }

            .totals-row .wide-cell {
                border: 1px solid #fff;
                border-right: 1px solid #555555;
                border-top: 1px solid #555555
            }
        </style>
        <div class="invoice-wrap">
            <div class="invoice-inner">
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td valign="top" align="right">
                                <div class="business_info">
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td><span class="editable-area" id="business_info">
                                                        <p style="font-size: 18pt;"><?= date('H:i') . " " . date('d/M/Y') ?></p>
                                                    </span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            <td valign="top" align="right">
                                <p class="editable-text" id="extra"><span style="font-size: 16pt;">OMSET PENJUALAN</span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="invoice-address">
                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tbody>
                            <tr>
                                <td style="font-size: 20px;color:#0275d8;font-weight:bold" align="center">Penjualan - Rangkuman</td>
                            </tr>
                            <tr>
                                <?php
                                // Tanggal awal dan akhir dari rentang waktu
                                $startDate = date('l, j F Y', strtotime($startDate));
                                $endDate = date('l, F j Y', strtotime($endDate));
                                ?>
                                <td style="font-size: 14px; color:#d9534f; font-weight:bold" align="center"><?= $startDate . ' - ' . $endDate; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="items-list">
                    <?php
                    // Inisialisasi totalSales dan totalSaldo
                    $totalSales = 0;
                    $totalSaldo = 0;
                    ?>
                    <table class="table table-bordered table-condensed table-striped items-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No Pesanan</th>
                                <th>Tanggal Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Mata Uang</th>
                                <th>Total Penjualan</th>
                                <th>Metode Bayar</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($penjualan as $key => $value) : ?>
                                <tr>
                                    <td scope="row" align="center"><?php echo $key + 1; ?></td>
                                    <td scope="row"><?php echo $value->id_pesanan; ?></td>
                                    <td scope="row"><?php echo date('d/m/Y', strtotime($value->tgl_pesanan)) ?></td>
                                    <td scope="row"><?php echo $value->nama_member; ?></td>
                                    <td scope="row"><?php echo "IDR"; ?></td>
                                    <td scope="row"><?= $value->grand_total + $value->ongkos_kirim ?></td>
                                    <td scope="row" style="text-transform: capitalize;">
                                        <?= $value->metode_bayar ?>
                                    </td>
                                    <td scope="row">
                                        <?php
                                        echo $value->status_pembayaran == "Menunggu Pembayaran" ? "0" : $value->grand_total + $value->ongkos_kirim;
                                        // Akumulasi totalSales dan totalSaldo
                                        $totalSales += ($value->grand_total + $value->ongkos_kirim);
                                        $totalSaldo += ($value->status_pembayaran == "Menunggu Pembayaran" ? 0 : $value->grand_total + $value->ongkos_kirim);
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr style="background: #f5f5f5;">
                                <td colspan="5" style="text-align: center;font-weight:bold">TOTAL</td>
                                <td colspan="1"><?= number_format($totalSales) ?></td>
                                <td colspan="1"></td>
                                <td colspan="1"><?= number_format($totalSaldo) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <style>
        body {
            background: #EBEBEB;
        }

        .invoice-wrap {
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        #mobile-preview-close a {
            position: fixed;
            left: 20px;
            bottom: 30px;
            background-color: #fff;
            font-weight: 600;
            outline: 0 !important;
            line-height: 1.5;
            border-radius: 3px;
            font-size: 14px;
            padding: 7px 10px;
            border: 1px solid #fff;
            text-decoration: none;
        }

        #mobile-preview-close img {
            width: 20px;
            height: auto;
        }

        #mobile-preview-close a:nth-child(2) {
            left: 190px;
            background: #f5f5f5;
            border: 1px solid #9f9f9f;
            color: #555 !important;
        }

        #mobile-preview-close a:nth-child(2) img {
            height: auto;
            position: relative;
            top: 2px;
        }

        .invoice-wrap {
            padding: 20px;
        }


        @media print {
            #mobile-preview-close a {
                display: none
            }

            body {
                background: none;
            }

            .invoice-wrap {
                box-shadow: none;
                margin-bottom: 0px;
            }

        }
    </style>
</body>

</html>