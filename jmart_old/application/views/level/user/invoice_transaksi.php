<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<title>Cetak Struk</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: sans-serif;
			font-size: 10pt;
			text-align: center;
		}

		.container {
			display: inline-block;
			text-align: left;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		hr {
			border: none;
			border-top: 1px dashed #000;
			margin: 5px 0;
		}

		.text-end {
			text-align: right;
		}

		.ttl-product,
		.footer-ttl-product {
			font-weight: bold;
		}

		.text-footer-struk {
			text-align: center;
			margin-top: 10px;
		}
	</style>
</head>

<body>
	<?php
	$totalSubHarga = 0;
	$totalDiskon = 0;
	$tanggalFormat = date('d/m/Y', strtotime($detail['tgl_pesanan']));
	$waktuFormat = date('H:i', strtotime($detail['tgl_pesanan']));
	?>
	<div class="container">
		<table>
			<tbody>
				<tr>
					<td colspan="4" style="text-align: center;"><strong>JMART</strong></td>
				</tr>
				<tr>
					<td colspan="2"><?= $tanggalFormat ?></td>
					<td colspan="2" class="text-end"><?= $waktuFormat ?></td>
				</tr>
				<tr>
					<td>No. Struk</td>
					<td>:</td>
					<td colspan="2" class="text-end"><?= $detail['id_pesanan'] ?></td>
				</tr>
				<tr>
					<td>Oleh</td>
					<td>:</td>
					<td colspan="2" class="text-end"><?= $pesanan[0]['nama_kasir'] ?? '-' ?></td>
				</tr>
				<tr>
					<td>Alat Kasir</td>
					<td>:</td>
					<td colspan="2" class="text-end">ADMIN</td>
				</tr>
				<tr>
					<td>Anggota</td>
					<td>:</td>
					<td colspan="2" class="text-end"><?= $detail['nama_member'] ?? 'Walk In Customer' ?></td>
				</tr>
				<tr>
					<td>Metode Byr</td>
					<td>:</td>
					<td colspan="2" class="text-end"><?= $detail['metode_bayar'] ?></td>
				</tr>
				<tr>
					<td colspan="4">
						<hr>
					</td>
				</tr>

				<?php foreach ($pesanan as $item): ?>
					<?php
					$harga = (int) $item['harga_saat_ini'];
					$jumlah = (int) $item['jumlah_jual'];
					$subtotal = $harga * $jumlah;
					$totalSubHarga += $subtotal;

					$diskon = 0;
					if ($item['promo_brg'] === 'On') {
						$diskon = ($harga - (int)$item['harga_promo']) * $jumlah;
						$totalDiskon += $diskon;
					}
					?>
					<tr>
						<td colspan="3"><?= $item['nama_barang'] ?><br>
							<span style="padding-left: 10px;"><?= $jumlah ?>x @<?= number_format($harga, 0, ',', '.') ?></span>
						</td>
						<td class="text-end"><?= number_format($subtotal, 0, ',', '.') ?></td>
					</tr>
				<?php endforeach; ?>

				<tr>
					<td colspan="4">
						<hr>
					</td>
				</tr>
				<tr>
					<td colspan="3">Subtotal (<?= count($pesanan) ?> items)</td>
					<td class="text-end"><?= number_format($totalSubHarga, 0, ',', '.') ?></td>
				</tr>
				<tr>
					<td colspan="3">Total Diskon</td>
					<td class="text-end"><?= number_format($totalDiskon, 0, ',', '.') ?></td>
				</tr>
				<tr>
					<td colspan="3"><strong>Total</strong></td>
					<td class="text-end"><strong><?= number_format($detail['grand_total'], 0, ',', '.') ?></strong></td>
				</tr>
				<tr>
					<td colspan="4">
						<hr>
					</td>
				</tr>
				<tr>
					<td colspan="3">Kredit</td>
					<td class="text-end">0</td>
				</tr>
				<tr>
					<td colspan="4">
						<hr>
					</td>
				</tr>
				<tr>
					<td colspan="3">Total Bayar</td>
					<td class="text-end"><?= number_format($detail['total_bayar'], 0, ',', '.') ?></td>
				</tr>
				<tr>
					<td colspan="4">
						<hr>
					</td>
				</tr>
				<tr>
					<td colspan="3"><strong>Kembalian</strong></td>
					<td class="text-end"><strong><?= number_format($detail['kembalian'], 0, ',', '.') ?></strong></td>
				</tr>
				<tr>
					<td colspan="4">
						<hr>
					</td>
				</tr>
				<tr>
					<td colspan="3"><strong>Transaksi Bulan Ini</strong></td>
					<td class="text-end"><strong><?= number_format($autodebit_bulan_ini ?? 0, 0, ',', '.') ?></strong></td>
				</tr>
				<tr>
					<td colspan="4">
						<hr>
					</td>
				</tr>
				<tr>
					<td colspan="4" class="text-footer-struk">
						Terima Kasih &amp; Selamat Belanja Kembali
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>

</html>
