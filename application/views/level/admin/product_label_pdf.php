<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Cetak Label <?= htmlspecialchars($products[0]['nama_barang']) ?></title>
	<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
	<style>
		body {
			font-family: Arial, sans-serif;
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: flex-start;
			gap: 1mm;
			padding: 5mm;
			margin: 0;
		}

		.label {
			width: 50mm;
			height: 32mm;
			border: 1px dashed black;
			padding: 3mm;
			box-sizing: border-box;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			align-items: center;
			page-break-inside: avoid;
		}

		.label-title {
			font-weight: bold;
			font-size: 14px;
			line-height: 1.2;
			overflow-wrap: break-word;
			word-break: break-word;
			max-height: 25px;
			overflow: hidden;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			text-align: center;
		}

		.price-table {
			width: 100%;
			display: flex;
			justify-content: space-between;
			font-size: 11px;
			border-top: 1px solid black;
			border-bottom: 1px solid black;
			margin: 3px 0;
		}

		.price-cell {
			width: 50%;
			text-align: center;
		}

		.price-cell h4 {
			margin: 0;
			font-size: 10px;
		}

		.price-cell .price {
			font-weight: bold;
			font-size: 12px;
		}

		.barcode svg {
			width: 100%;
			height: 30px;
		}

		@media print {
			@page {
				size: 70mm 70mm;
				margin: 0;
			}
			body {
				padding: 5mm;
				gap: 5mm;
			}
		}
	</style>
</head>

<body>
	<?php foreach ($products as $index => $item): ?>
		<div class="label">
			<div class="label-title" id="name-<?= $index ?>" data-index="<?= $index ?>">
				<?= htmlspecialchars($item['nama_barang']) ?>
			</div>
			<div class="price-table">
				<div class="price-cell">
					<h4>Pcs</h4>
					<div class="price">Rp. <?= number_format($item['harga_jual_barang'], 0, ',', '.') ?></div>
				</div>
				<div class="price-cell">
					<h4>Grosir</h4>
					<div class="price">Rp. <?= number_format($item['harga_grosir'], 0, ',', '.') ?></div>
				</div>
			</div>
			<div class="barcode">
				<svg id="barcode-<?= $index ?>" data-code="<?= $item['barcode'] ?>"></svg>
			</div>
		</div>
	<?php endforeach; ?>

	<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
	<!-- jQuery print plugin -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.print/1.6.0/jquery.print.min.js"></script>
	<script>
		$(document).ready(function() {
			$('body').print({
				mode: 'popup',
				popClose: true,
				popCloseDuration: 1000,
				popCloseEasing: 'ease-in-out',
				popCloseDelay: 1000,
				popCloseEasing: 'ease-in-out',
			});
		});
	</script>

	<script>
		document.addEventListener('DOMContentLoaded', () => {
			document.querySelectorAll('svg[id^="barcode-"]').forEach(svg => {
				const code = svg.dataset.code;
				JsBarcode(svg, code, {
					format: "CODE128",
					lineColor: "#000",
					width: 1.5,
					height: 30,
					displayValue: false
				});
			});

			document.querySelectorAll('.label-title').forEach(el => {
				let maxHeight = el.offsetHeight;
				let fontSize = parseInt(window.getComputedStyle(el).fontSize);
				while (el.scrollHeight > maxHeight && fontSize > 9) {
					fontSize -= 1;
					el.style.fontSize = fontSize + "px";
				}
			});
		});
	</script>

</body>

</html>
