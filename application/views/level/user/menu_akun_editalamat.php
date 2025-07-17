<?php $this->load->view('layouts/user/head'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.fullscreen/dist/leaflet.fullscreen.css">
<script src="https://leaflet.github.io/Leaflet.fullscreen/dist/Leaflet.fullscreen.min.js"></script>
<style>
	.navbar__left {
		width: 4rem;
		z-index: 2;
	}

	.avatar {
		border-radius: 50%;
		object-fit: cover;
	}

	.avatar--large {
		width: 7.6rem;
		height: 7.6rem;
	}

	.input {
		margin-top: 0.4rem;
		font-size: 1.1rem;
		padding: 0;
		outline: none;
		width: 100%;
		color: #474645;
		border: none;
		margin-bottom: 0.8rem;
		border-bottom: 0.1rem solid #e8e8e8;
	}

	input[type="checkbox"] {
		/* Sembunyikan tampilan asli */
		appearance: none;
		-webkit-appearance: none;
		-moz-appearance: none;
		/* Bentuk dan ukuran */
		width: 20px;
		height: 20px;
		border-radius: 50%;
		/* Gaya ketika dipilih */
		outline: none;
		/* Gambar latar belakang ketika dipilih */
		background-color: #ffffff;
		background-clip: content-box;
		margin-top: 10px;
		cursor: pointer;
	}

	.choices {
		margin-bottom: 10px !important;
	}

	.leaflet-container {
		height: 400px;
		width: 600px;
		max-width: 100%;
		max-height: 100%;
	}
</style>
<?php $this->load->view('layouts/user/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
	<div class="container nav-bar__on-container">
		<div class="navbar__left">
			<a href="<?= base_url('akun') ?>">
				<svg class="navbar__left__icon fw-bold text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);cursor:pointer;z-index: 2;">
					<path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
				</svg>
			</a>
		</div>
		<div class="nav-bar__center">
			<h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Update Alamat</h1>
		</div>
	</div>
</nav>
<section class="mt-4 mb-4">
	<div class="container">
		<?php if ($jumlah <= 0) : ?>
			<div class="misc-wrapper mt-3 text-center">
				<h3 class="mb-2 mx-2">Alamat Tidak Ditemukan</h3>
				<p class="mb-4 mx-2">Silahkan menambahkan alamat terlebih dahulu sebelum melajutkan belanja.</p>
				<a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary justify-content-center text-white text-center">Tambah Alamat</a>
				<div class="mt-3">
					<img src="<?= base_url() ?>public/template/img/illustrations/undraw_page_not_found_re_e9o6.svg" alt="page-misc-error-light" width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png" data-app-light-img="illustrations/page-misc-error-light.png">
				</div>
			</div>
		<?php else : ?>
			<div class="card mt-4">
				<div class="card-header">
					<h6 class="card-title">Set Alamat Utama</h6>
				</div>
				<div class="card-body">
					<?php foreach ($alamat as $key => $a) : ?>
						<div class="row">
							<div class="col-1">
								<div class="icheck-primary">
									<input <?= $main['id_alamat_user'] == $a['id_alamat_user'] ? "checked" : "" ?> name="checkbox-main" data-id="<?= $a['id_alamat_user'] ?>" type="radio" id="penanda<?= $key ?>" class="checkbox-main" />
									<label for="penanda<?= $key ?>"></label>
								</div>
							</div>
							<div class="col-9">
								<?= $a['nama_penerima'] ?> | <?= $a['kontak_penerima'] ?><br>
								<span>
									<?= $a['nama_desa'] ?> (<?= $a['detail_lainnya'] ?>)<br>
									<?= $a['nama_kecamatan'] ?>, <?= $a['nama_kabupaten'] ?>,<br>
									<?= $a['nama_provinsi'] ?>, <?= $a['kode_pos'] ?>
								</span>
							</div>
							<div class="col-2">
								<a data-bs-toggle="modal" data-bs-target="#edit<?= $a['id_alamat_user'] ?>" href="#" class="text-danger fw-bold"> Ubah</a>
							</div>
						</div>
						<hr>
					<?php endforeach ?>
					<div class="row d-flex justify-content-center" style="margin: 0;">
						<a data-bs-toggle="modal" data-bs-target="#tambah" href="#" class="text-center"><i class='bx bx-plus'></i> Tambah Alamat Baru</a>
					</div>
				</div>
			</div>
		<?php endif ?>
	</div>
</section>

<div class="row">
	<br><br><br><br>
</div>
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Alamat Baru</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url('akun/alamat_tambah') ?>" method="POST">
				<div class="modal-body" style=" max-height: calc(100vh - 200px);overflow-y: auto;">
					<div class="mb-3">
						<label class="form-label" for="basic-default-fullname">Kontak</label>
						<input style="border-radius: 2.5px;" type="text" class="form-control" id="nama_penerima" name="nama_penerima" placeholder="Nama Lengkap" required>
						<input style="border-radius: 2.5px;" type="text" class="form-control mt-2" id="kontak_penerima" name="kontak_penerima" placeholder="No. HP" required>
						<input type="hidden" id="maps_coordinate" name="maps_coordinate">
					</div>
					<div class="mb-3">
						<label class="form-label" for="basic-default-fullname">Alamat</label>
						<select required name="select_provinsi" id="select_provinsi" class="form-select" style="margin-bottom: 0px !important;">
							<option disabled selected>Pilih Provinsi</option>
							<?php foreach ($provinsi as $key => $prov) : ?>
								<option value="<?= $prov['id_provinsi'] ?>"><?= $prov['nama_provinsi'] ?></option>
							<?php endforeach ?>
						</select>
						<select required name="select_kabupaten" id="select_kabupaten" class="">
							<option selected disabled>Pilih Kabupaten</option>
						</select>
						<select required name="select_kecamatan" id="select_kecamatan" class="form-select">
							<option selected disabled>Pilih Kecamatan</option>
						</select>
						<select required name="select_desa" id="select_desa" class="form-select">
							<option selected disabled>Pilih Desa</option>
						</select>
						<textarea style="border-radius: 2.5px;" name="detail_lainnya" id="detail_lainnya" class="form-control" placeholder="Detail Lainnya"></textarea>
					</div>
					<div class="mb-3">
						<div id="map" style="width: 100%;"></div>
					</div>
					<div class="mb-3">
						<div class="row mb-3 d-flex">
							<label style="font-family: 'Segoe UI', sans-serif;" class="col-sm-7 col-7 col-form-label" for="basic-default-name">Atur Sebagai Alamat Utama</label>
							<div class="col-sm-5 col-5 text-end justify-content-end">
								<div class="form-check form-switch ">
									<input name="set_default" id="set_default" style="height: 20px;width: 35px;float: right;border-radius:2.5px" class="form-check-input" type="checkbox" role="switch">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary" onclick="simpanAlamat()">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>

<form id="form-hapus-alamat" method="post" style="display:none;"></form>
<?php foreach ($alamat as $key => $al) : ?>
	<div class="modal fade" id="edit<?= $al['id_alamat_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Alamat</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="<?= base_url('akun/update_alamat/' . $al['id_alamat_user']) ?>" method="POST">
					<div class="modal-body" style=" max-height: calc(100vh - 200px);overflow-y: auto;">
						<div class="mb-3">
							<label class="form-label" for="basic-default-fullname">Kontak</label>
							<input value="<?= $al['nama_penerima'] ?>" style="border-radius: 2.5px;" type="text" class="form-control" id="nama_penerima_edit<?= $al['id_alamat_user'] ?>" name="nama_penerima" placeholder="Nama Lengkap" required>
							<input value="<?= $al['kontak_penerima'] ?>" style="border-radius: 2.5px;" type="text" class="form-control mt-2" id="kontak_penerima_edit<?= $al['id_alamat_user'] ?>" name="kontak_penerima" placeholder="No. HP" required>
						</div>
						<div class="mb-3">
							<label class="form-label" for="basic-default-fullname">Alamat</label>
							<select disabled name="select_provinsi" id="select_provinsi_edit<?= $al['id_alamat_user'] ?>" class="form-select">
								<option disabled>Pilih Provinsi</option>
								<?php foreach ($provinsi as $prov) : ?>
									<option value="<?= $prov['id_provinsi'] ?>" <?= $al['id_provinsi'] == $prov['id_provinsi'] ? 'selected' : '' ?>><?= $prov['nama_provinsi'] ?></option>
								<?php endforeach ?>
							</select>
							<select disabled name="select_kabupaten" id="select_kabupaten_edit<?= $al['id_alamat_user'] ?>" class="form-select mt-2">
								<option disabled>Pilih Kabupaten</option>
							</select>
							<select disabled name="select_kecamatan" id="select_kecamatan_edit<?= $al['id_alamat_user'] ?>" class="form-select mt-2">
								<option disabled>Pilih Kecamatan</option>
							</select>
							<select disabled name="select_desa" id="select_desa_edit<?= $al['id_alamat_user'] ?>" class="form-select mt-2">
								<option disabled>Pilih Desa</option>
							</select>
							<textarea style="border-radius: 2.5px;" name="detail_lainnya" id="detail_lainnya_edit<?= $al['id_alamat_user'] ?>" class="form-control mt-2" placeholder="Detail Lainnya"><?= $al['detail_lainnya'] ?></textarea>
						</div>
						<div class="mb-3">
							<div id="map_edit<?= $al['id_alamat_user'] ?>" style="height: 300px; margin-bottom: 15px;"></div>
							<input type="hidden" id="maps_coordinate_edit<?= $al['id_alamat_user'] ?>" name="maps_coordinate_edit" value="<?= $al['koordinat'] ?>">
						</div>
						<div class="mb-3">
							<div class="row mb-3 d-flex">
								<label style="font-family: 'Segoe UI', sans-serif;" class="col-sm-7 col-7 col-form-label" for="basic-default-name">Atur Sebagai Alamat Utama</label>
								<div class="col-sm-5 col-5 text-end justify-content-end">
									<div class="form-check form-switch ">
										<input <?= $al['set_default'] == "Main" ? "checked" : "" ?> name="set_default" id="set_default_edit<?= $al['id_alamat_user'] ?>" style="height: 20px;width: 35px;float: right;border-radius:2.5px;border:1px solid #5bc0de" class="form-check-input" type="checkbox" role="switch">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
						<button type="button" class="btn btn-danger btn-hapus-alamat" data-id="<?= $al['id_alamat_user'] ?>">Hapus</button>
						<button type="submit" class="btn btn-warning">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		// Dynamic select untuk edit
		$(document).ready(function() {
			// Inisialisasi Choices.js untuk semua select di modal edit
			let choices_provinsi_edit<?= $al['id_alamat_user'] ?> = new Choices(document.getElementById('select_provinsi_edit<?= $al['id_alamat_user'] ?>'));
			let choices_kabupaten_edit<?= $al['id_alamat_user'] ?> = new Choices(document.getElementById('select_kabupaten_edit<?= $al['id_alamat_user'] ?>'));
			let choices_kecamatan_edit<?= $al['id_alamat_user'] ?> = new Choices(document.getElementById('select_kecamatan_edit<?= $al['id_alamat_user'] ?>'));
			let choices_desa_edit<?= $al['id_alamat_user'] ?> = new Choices(document.getElementById('select_desa_edit<?= $al['id_alamat_user'] ?>'));

			function loadKabupatenEdit(id_alamat, id_prov, id_kab) {
				$.ajax({
					url: "<?= base_url('akun/get_kabupaten'); ?>",
					method: "POST",
					data: {
						prov_id: id_prov
					},
					dataType: "JSON",
					success: function(data) {
						var opsi = [];
						data.forEach(function(item) {
							opsi.push({
								value: item.id_kabupaten,
								label: item.nama_kabupaten,
								selected: item.id_kabupaten == id_kab
							});
						});
						choices_kabupaten_edit<?= $al['id_alamat_user'] ?>.setChoices(opsi, 'value', 'label', true);
					}
				});
			}

			function loadKecamatanEdit(id_alamat, id_kab, id_kec) {
				$.ajax({
					url: "<?= base_url('akun/get_kecamatan'); ?>",
					method: "POST",
					data: {
						kab_id: id_kab
					},
					dataType: "JSON",
					success: function(data) {
						var opsi = [];
						data.forEach(function(item) {
							opsi.push({
								value: item.id_kecamatan,
								label: item.nama_kecamatan,
								selected: item.id_kecamatan == id_kec
							});
						});
						choices_kecamatan_edit<?= $al['id_alamat_user'] ?>.setChoices(opsi, 'value', 'label', true);
					}
				});
			}

			function loadDesaEdit(id_alamat, id_kec, id_desa) {
				$.ajax({
					url: "<?= base_url('akun/get_desa'); ?>",
					method: "POST",
					data: {
						kec_id: id_kec
					},
					dataType: "JSON",
					success: function(data) {
						var opsi = [];
						data.forEach(function(item) {
							opsi.push({
								value: item.id_desa,
								label: item.nama_desa,
								selected: item.id_desa == id_desa
							});
						});
						choices_desa_edit<?= $al['id_alamat_user'] ?>.setChoices(opsi, 'value', 'label', true);
					}
				});
			}
			// Inisialisasi select edit saat modal dibuka
			$('#edit<?= $al['id_alamat_user'] ?>').on('shown.bs.modal', function() {
				loadKabupatenEdit('<?= $al['id_alamat_user'] ?>', '<?= $al['id_provinsi'] ?>', '<?= $al['id_kabupaten'] ?>');
				loadKecamatanEdit('<?= $al['id_alamat_user'] ?>', '<?= $al['id_kabupaten'] ?>', '<?= $al['id_kecamatan'] ?>');
				loadDesaEdit('<?= $al['id_alamat_user'] ?>', '<?= $al['id_kecamatan'] ?>', '<?= $al['id_desa'] ?>');

				if ("geolocation" in navigator) {
					navigator.geolocation.getCurrentPosition(function(position) {
						const lat = position.coords.latitude;
						const lng = position.coords.longitude;
						const map = L.map('map_edit<?= $al['id_alamat_user'] ?>').setView([lat, lng], 17);
						const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
							maxZoom: 19,
							attribution: '&copy; <a href=\"http://www.openstreetmap.org/copyright\">OpenStreetMap</a>'
						}).addTo(map);
						map.addControl(new L.Control.Fullscreen());
						let marker = L.marker([lat, lng]).addTo(map);
						$('#maps_coordinate_edit<?= $al['id_alamat_user'] ?>').val(lat + ', ' + lng);
						setTimeout(function() {
							map.invalidateSize();
						}, 300);
						map.on('click', function(e) {
							marker.setLatLng(e.latlng);
							$('#maps_coordinate_edit<?= $al['id_alamat_user'] ?>').val(e.latlng.lat + ', ' + e.latlng.lng);
						});
					}, function(error) {
						const lat = -7.250445;
						const lng = 112.768845;
						const map = L.map('map_edit<?= $al['id_alamat_user'] ?>').setView([lat, lng], 13);
						const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
							maxZoom: 19,
							attribution: '&copy; <a href=\"http://www.openstreetmap.org/copyright\">OpenStreetMap</a>'
						}).addTo(map);
						map.addControl(new L.Control.Fullscreen());
						let marker = L.marker([lat, lng]).addTo(map);
						$('#maps_coordinate_edit<?= $al['id_alamat_user'] ?>').val(lat + ', ' + lng);
						setTimeout(function() {
							map.invalidateSize();
						}, 300);
						map.on('click', function(e) {
							marker.setLatLng(e.latlng);
							$('#maps_coordinate_edit<?= $al['id_alamat_user'] ?>').val(e.latlng.lat + ', ' + e.latlng.lng);
						});
					});
				} else {
					const lat = -7.250445;
					const lng = 112.768845;
					const map = L.map('map_edit<?= $al['id_alamat_user'] ?>').setView([lat, lng], 13);
					const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
						maxZoom: 19,
						attribution: '&copy; <a href=\"http://www.openstreetmap.org/copyright\">OpenStreetMap</a>'
					}).addTo(map);
					map.addControl(new L.Control.Fullscreen());
					let marker = L.marker([lat, lng]).addTo(map);
					$('#maps_coordinate_edit<?= $al['id_alamat_user'] ?>').val(lat + ', ' + lng);
					setTimeout(function() {
						map.invalidateSize();
					}, 300);
					map.on('click', function(e) {
						marker.setLatLng(e.latlng);
						$('#maps_coordinate_edit<?= $al['id_alamat_user'] ?>').val(e.latlng.lat + ', ' + e.latlng.lng);
					});
				}
			});
			// Event change untuk select edit
			$(`#select_provinsi_edit<?= $al['id_alamat_user'] ?>`).on('change', function() {
				loadKabupatenEdit('<?= $al['id_alamat_user'] ?>', this.value, '');
				choices_kecamatan_edit<?= $al['id_alamat_user'] ?>.clearStore();
				choices_desa_edit<?= $al['id_alamat_user'] ?>.clearStore();
			});
			$(`#select_kabupaten_edit<?= $al['id_alamat_user'] ?>`).on('change', function() {
				loadKecamatanEdit('<?= $al['id_alamat_user'] ?>', this.value, '');
				choices_desa_edit<?= $al['id_alamat_user'] ?>.clearStore();
			});
			$(`#select_kecamatan_edit<?= $al['id_alamat_user'] ?>`).on('change', function() {
				loadDesaEdit('<?= $al['id_alamat_user'] ?>', this.value, '');
			});
		});
	</script>
<?php endforeach ?>
<?php $this->load->view('layouts/user/menu'); ?>
<?php $this->load->view('layouts/user/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	var choices_provinsi = new Choices(document.getElementById('select_provinsi'));
	var choices_kabupaten = new Choices(document.getElementById('select_kabupaten'));
	var choices_kecamatan = new Choices(document.getElementById('select_kecamatan'));
	var choices_desa = new Choices(document.getElementById('select_desa'));

	$("#select_provinsi").on('change', function() {
		var provinsiId = $(this).val();
		choices_kabupaten.clearStore();
		choices_kecamatan.clearStore();
		choices_desa.clearStore();

		$.ajax({
			url: "<?php echo base_url('akun/get_kabupaten'); ?>",
			method: "POST",
			data: {
				prov_id: provinsiId
			},
			dataType: "JSON",
			success: function(data) {
				// Membuat array kosong untuk menyimpan opsi
				var opsi = [];

				// Melakukan iterasi pada data yang diterima dari AJAX
				data.forEach(function(item) {
					// Membuat objek opsi dengan nilai dan label dari data
					var opsiItem = {
						value: item.id_kabupaten,
						label: item.nama_kabupaten
					};

					// Menambahkan objek opsi ke dalam array opsi
					opsi.push(opsiItem);
				});

				choices_kabupaten.setChoices(opsi, 'value', 'label');
			},
			error: function(request, status, error) {
				alert(request.responseText);
			}
		});
	});

	$("#select_kabupaten").on('change', function() {
		var kabupatenId = $(this).val();
		choices_kecamatan.clearStore();
		choices_desa.clearStore();

		$.ajax({
			url: "<?php echo base_url('akun/get_kecamatan'); ?>",
			method: "POST",
			data: {
				kab_id: kabupatenId
			},
			dataType: "JSON",
			success: function(data) {
				// Membuat array kosong untuk menyimpan opsi
				var opsi = [];

				// Melakukan iterasi pada data yang diterima dari AJAX
				data.forEach(function(item) {
					// Membuat objek opsi dengan nilai dan label dari data
					var opsiItem = {
						value: item.id_kecamatan,
						label: item.nama_kecamatan
					};

					// Menambahkan objek opsi ke dalam array opsi
					opsi.push(opsiItem);
				});

				choices_kecamatan.setChoices(opsi, 'value', 'label');
			},
			error: function(request, status, error) {
				alert(request.responseText);
			}
		});
	});

	$("#select_kecamatan").on('change', function() {
		var kecamatanId = $(this).val();
		choices_desa.clearStore();

		$.ajax({
			url: "<?php echo base_url('akun/get_desa'); ?>",
			method: "POST",
			data: {
				kec_id: kecamatanId
			},
			dataType: "JSON",
			success: function(data) {
				// Membuat array kosong untuk menyimpan opsi
				var opsi = [];

				// Melakukan iterasi pada data yang diterima dari AJAX
				data.forEach(function(item) {
					// Membuat objek opsi dengan nilai dan label dari data
					var opsiItem = {
						value: item.id_desa,
						label: item.nama_desa
					};

					// Menambahkan objek opsi ke dalam array opsi
					opsi.push(opsiItem);
				});

				choices_desa.setChoices(opsi, 'value', 'label');
			},
			error: function(request, status, error) {
				alert(request.responseText);
			}
		});
	});

	$(document).ready(function() {
		$(".checkbox-main").on("click", function() {
			var idAlamatUser = $(this).data("id");

			// Kirim permintaan AJAX ke server
			$.ajax({
				type: "POST",
				url: "<?= base_url('akun/set_alamat_main') ?>", // Gantilah 'url_anda' dengan URL yang sesuai
				data: {
					id_alamat_user: idAlamatUser
				},
				beforeSend: function() {
					if (typeof showLoading === 'function') showLoading();
				},
				complete: function() {
					if (typeof hideLoading === 'function') hideLoading();
				},

				success: function(response) {
					// Tindakan yang ingin Anda lakukan setelah pembaruan data berhasil
					console.log("Data berhasil diperbarui!");
				},
				error: function() {
					// Tindakan jika terjadi kesalahan dalam permintaan AJAX
					console.log("Terjadi kesalahan saat memperbarui data.");
				}
			});
		});
	});
</script>

<script>
	$('#tambah').on('shown.bs.modal', function() {
		if ("geolocation" in navigator) {
			navigator.geolocation.getCurrentPosition(function(position) {
				const lat = position.coords.latitude;
				const lng = position.coords.longitude;

				const map = L.map('map').setView([lat, lng], 13);
				const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
					maxZoom: 19,
					attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
				}).addTo(map);

				let marker = L.marker([lat, lng]).addTo(map);
				$('#maps_coordinate').val(lat + ', ' + lng);

				map.on('click', function(e) {
					marker.setLatLng(e.latlng);
					console.log(e.latlng);
					$('#maps_coordinate').val(e.latlng.lat + ', ' + e.latlng.lng);
				});
			}, function(error) {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'Lokasi wajib diaktifkan untuk menambahkan alamat!'
				}).then((result) => {
					$('#tambah').modal('hide');
				});
			});
		} else {
			alert('Geolocation tidak didukung oleh browser ini.');
		}
	});

	function simpanAlamat() {
		const coordinate = $('#maps_coordinate').val();
		console.log('Koordinat yang disimpan:', coordinate);
	}
</script>
</body>

</html>
