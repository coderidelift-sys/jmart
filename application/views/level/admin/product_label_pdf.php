<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Label Rak</title>
	<style>
		@page {
			/* size: 5cm 3cm; */
			/* optional but reinforces size in HTML */
			margin: 0;
		}

		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
		}

		.label {
			width: 5cm;
			height: 3cm;
			box-sizing: border-box;
			padding: 4mm;
			background-color: #d7e76b;
			border: 1px solid #000;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
		}

		.row {
			display: flex;
			flex-wrap: nowrap;
			align-items: center;
			width: 100%;
		}

		.row.top {
			font-size: 7pt;
			font-weight: bold;
			margin-bottom: 1mm;
		}

		.row.top .code {
			margin-right: 4px;
			white-space: nowrap;
		}

		.row.top .name {
			flex: 1;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		.row.bottom {
			border-top: 1px solid #000;
			padding-top: 2mm;
			height: 1.3cm;
			display: flex;
			align-items: center;
		}

		.col {
			box-sizing: border-box;
			height: 100%;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.barcode-col {
			width: 60%;
			border-right: 1px solid #000;
			font-size: 7pt;
			font-family: 'Courier New', monospace;
		}

		.price-col {
			width: 40%;
			font-weight: bold;
			font-size: 9pt;
			text-align: center;
			line-height: 1;
		}
	</style>
</head>

<body>
	<div class="label">
		<div class="row top">
			<div class="code">[8801097130111]</div>
			<div class="name">OLATE STRW CAN 240 ML</div>
		</div>
		<div class="row bottom">
			<div class="col barcode-col">8801097130111</div>
			<div class="col price-col">Rp 10.000</div>
		</div>
	</div>
</body>

</html>
