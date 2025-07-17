<?php $this->load->view('layouts/user/head'); ?>
<style>
	.info-list:not(:last-child)>div {
		margin-bottom: 1.6rem;
	}

	.info-list>div {
		margin-top: 0.4rem;
	}

	.fcolor-default2 {
		color: #999999 !important;
	}

	.fsize-p-2 {
		font-size: 1rem;
	}

	.navbar__left {
		width: 4rem;
		z-index: 2;
	}

	.avatar {
		border-radius: 5%;
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
			<h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Update Profile</h1>
		</div>
	</div>
</nav>

<section class="mt-1 mb-4">
	<div class="container">
		<div class="container text-center justify-content-center align-center mt-4">
			<?php
			$avatarPath = 'public/template/upload/user/';
			$avatarFile = isset($user['avatar']) && file_exists(FCPATH . $avatarPath . $user['avatar']) && !empty($user['avatar'])
				? $user['avatar']
				: 'default.png';

			$avatarUrl = base_url($avatarPath . $avatarFile);
			?>

			<img src="<?= $avatarUrl ?>"
				class="avatar avatar--large shadow"
				id="uploadImg"
				alt="Foto Profil Pengguna"
				loading="lazy"
				decoding="async"
				width="100"
				height="100">
		</div>
		<div class="card mt-3">
			<div class="card-body">
				<form method="POST" id="updateBiodata" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label" style="text-align: left !important;">Nomor WA <i>[Ex. 628xxxx]</i></label>
						<input style="z-index: 0;" name="wa_member" type="text" id="wa_member" class="input phone-mask" placeholder="No Whatsapp" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2" value="<?= $user['wa_member'] ?>">
					</div>
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Nomor Induk (Denied to edit)</label>
						<input name="nomor_induk" type="text" class="input" id="nomor_induk" placeholder="Nomor Induk Karyawan" aria-label="Nomor Induk Karyawan" aria-describedby="basic-icon-default-fullname2" value="<?= $user['nomor_induk'] ?>" readonly>
					</div>
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
						<input id="nama_member" name="nama_member" type="text" class="input" placeholder="Nama Lengkap" aria-label="Nama Lengkap" aria-describedby="basic-icon-default-fullname2" value="<?= $user['nama_member'] ?>">
					</div>
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Departemen</label>
						<input id="dept" name="dept" type="text" class="input" placeholder="Ex: MA" aria-label="Departemen" aria-describedby="basic-icon-default-fullname2" value="<?= $user['dept'] ?>">
					</div>
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Username</label>
						<input id="username" name="username" type="text" id="basic-icon-default-company" class="input" placeholder="Username" aria-label="Username" aria-describedby="basic-icon-default-company2" value="<?= $user['username'] ?>">
					</div>
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Email</label>
						<input id="email_member" name="email_member" type="text" id="basic-icon-default-email" class="input" placeholder="Email" aria-label="Email" aria-describedby="basic-icon-default-email2" value="<?= $user['email_member'] ?>">
					</div>
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Ganti Foto?</label>
						<div class="input-group input-group-merge">
							<input type="hidden" name="previous_avatar" value="<?= $user['avatar'] ?>">
							<input type="file" name="avatar" id="avatarInput" class="input" placeholder="Ganti Profile" aria-label="Ganti Profile" aria-describedby="basic-icon-default-company2">
						</div>
					</div>
					<button type="submit" id="simpan_perubahan" class="btn btn-primary w-100">Simpan Perubahan</button>
					<button data-bs-toggle="modal" data-bs-target="#ganti_password" type="button" class="btn btn-secondary mt-2 w-100"><i class="fa fa-key"></i> Ganti Password</button>
				</form>
			</div>
		</div>
	</div>
</section>

<div class="row">
	<br><br><br><br>
</div>

<div class="modal fade" id="ganti_password">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #f0f8ff;border-bottom: 1px solid #dee1e4;padding: 1em;color: #555;">
				<h5 class="modal-title">Ganti Password</h5>
			</div>
			<form id="changePW" method="POST">
				<div class="modal-body">
					<div class="mb-3">
						<div class="input-group input-group-merge">
							<label class="form-label" for="basic-icon-default-fullname">Password Baru</label>
							<div class="input-group input-group-merge">
								<span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-key"></i></span>
								<input required id="password_baru" name="password_baru" type="text" class="form-control" placeholder="Password Baru" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
							</div>
						</div>
					</div>
					<div class="mb-3">
						<div class="input-group input-group-merge">
							<label class="form-label" for="basic-icon-default-fullname">Konfirmasi Password</label>
							<div class="input-group input-group-merge">
								<span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-key"></i></span>
								<input required id="konfirmasi_password_baru" name="konfirmasi_password_baru" type="text" class="form-control" placeholder="Konfirmasi Password" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="border-top: 1px solid #dee1e4;padding: 14px 24px;background-color: #f6f7f9;">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Ganti Password</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->load->view('layouts/user/menu'); ?>
<?php $this->load->view('layouts/user/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$('#changePW').submit(function(event) {
		event.preventDefault(); // Prevent the default form submission behavior
		// Get the form data
		var formData = $(this).serialize();

		// Perform the AJAX request
		$.ajax({
			type: 'POST',
			url: '<?= base_url("akun/ganti_password") ?>',
			data: formData,
			beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

			success: function(response) {
				if (response.status == "success") {
					Swal.fire({
						title: 'Berhasil!',
						text: response.message,
						type: 'success',
						customClass: {
							confirmButton: 'btn btn-success'
						},
						buttonsStyling: false
					})
					$('#ganti_password').modal('hide');
				} else {
					Swal.fire({
						title: 'Failed!',
						text: response.message,
						type: 'error',
						customClass: {
							confirmButton: 'btn btn-danger'
						},
						buttonsStyling: false
					})
				}
			},
			error: function(request, status, error) {
				console.log(error);
				
			},
		});
	});

	$('#updateBiodata').submit(function(event) {
		event.preventDefault(); // Prevent the default form submission behavior
		// Get the form data
		var formData = $(this).serialize();

		// Perform the AJAX request
		$.ajax({
			type: 'POST',
			url: '<?= base_url("akun/update") ?>',
			data: formData,
			beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

			success: function(response) {
				if (response.status == "success") {
					Swal.fire({
						title: 'Berhasil!',
						text: response.message,
						type: 'success',
						customClass: {
							confirmButton: 'btn btn-success'
						},
						buttonsStyling: false
					}).then(function() {
						// Setelah pengguna mengklik tombol "OK," muat ulang halaman
						location.reload();
					});
				} else {
					Swal.fire({
						title: 'Failed!',
						text: response.message,
						type: 'error',
						customClass: {
							confirmButton: 'btn btn-danger'
						},
						buttonsStyling: false
					})
				}
			},
			error: function(request, status, error) {
				alert(request.responseText);
			},
		});
	});

	$("#avatarInput").change(function() {
		var formData = new FormData();
		formData.append("previous_avatar", $("input[name='previous_avatar']").val());
		formData.append("avatar", $("#avatarInput")[0].files[0]);

		$("#simpan_perubahan").click(function() {
			$.ajax({
				url: "<?php echo base_url('akun/ubah_foto'); ?>", // Ganti dengan URL controller Anda
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

				success: function(response) {
					// Handle respons dari server
					console.log(response);
				},
				error: function(xhr, textStatus, errorThrown) {
					// Handle kesalahan
					console.error(errorThrown);
				}
			});
		});
	});
</script>
</body>

</html>
