<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css" />
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<h2 class="page-title">
					Ubah Sandi
				</h2>
			</div>
		</div>
	</div>
</div>

<div class="page-body">
	<div class="container-xl">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Ganti Kata Sandi</h3>
					</div>
					<div class="row g-0">
						<div class="col-3 d-none d-md-block border-end">
							<div class="card-body">
								<div class="list-group list-group-transparent">
									<a href="<?= base_url('profile') ?>" class="list-group-item list-group-item-action d-flex align-items-center ">
										<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
											<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
											<path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
											<path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
										</svg>
										&nbsp; Perbarui Profil
									</a>
									<a href="<?= base_url('sandi') ?>" class="list-group-item list-group-item-action d-flex align-items-center  active ">
										<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-lock text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
											<path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"></path>
											<circle cx="12" cy="11" r="1"></circle>
											<line x1="12" y1="12" x2="12" y2="14.5"></line>
										</svg>
										&nbsp; Perbarui Kata Sandi
									</a>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-8">
							<div class="row">
								<div class="col-12">
									<div class="card-body pt-4 pb-4" style="min-height: 520px">
										<form id="form-password" method="post">
											<div class="row">
												<div class="col-12">
													<div class="mb-4">
														<label class="form-label required">Kata Sandi Saat Ini</label>
														<input type="password" name="password" id="password" class="form-control" maxlength="16" required autocomplete="current-password">
														<small id="password-feedback" class="text-danger d-none"></small>
													</div>
												</div>
												<div class="col-md-6">
													<div class="mb-4">
														<label class="form-label required">Kata Sandi Baru</label>
														<input type="password" name="new_password" id="new-password" class="form-control" maxlength="16" required autocomplete="new-password">
														<small id="new-password-feedback" class="text-danger d-none"></small>
													</div>
												</div>
												<div class="col-md-6">
													<div class="mb-4">
														<label class="form-label required">Konfirmasi Kata Sandi Baru</label>
														<input type="password" name="password_confirmation" id="confirm-password" class="form-control" maxlength="16" required autocomplete="new-password">
														<small id="confirm-password-feedback" class="text-danger d-none">Konfirmasi kata sandi tidak cocok.</small>
													</div>
												</div>
											</div>

											<div class="mb-3">
												<button type="button" id="toggle-password" class="btn btn-light">
													<i class="icon icon-tabler icon-tabler-eye"></i> Tampilkan Sandi
												</button>
											</div>

											<div class="row">
												<div class="col-md-6">
													<div class="d-grid">
														<button type="submit" id="btn-submit" class="btn btn-primary">
															<i class="icon icon-tabler icon-tabler-circle-check me-1"></i>
															Simpan Perubahan
														</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('layouts/admin/footer'); ?>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('toggle-password').addEventListener('click', function () {
   const inputs = ['password', 'new-password', 'confirm-password'];
   inputs.forEach(id => {
      const input = document.getElementById(id);
      input.type = input.type === 'password' ? 'text' : 'password';
   });
   this.innerHTML = this.innerHTML.includes('Tampilkan') ? 
      '<i class="icon icon-tabler icon-tabler-eye-off"></i> Sembunyikan Sandi' :
      '<i class="icon icon-tabler icon-tabler-eye"></i> Tampilkan Sandi';
});
</script>
<script>
$('#form-password').on('submit', function(e) {
	e.preventDefault();

	const formData = $(this).serialize(); // ambil semua input

	$.ajax({
		url: '<?= base_url("akun/ubah_katasandi") ?>',
		type: 'POST',
		data: formData,
		dataType: 'json',
		beforeSend: function () {
			$('#btn-submit').attr('disabled', true).text('Menyimpan...');
			$('.text-danger').addClass('d-none').text('');
		},
		success: function(res) {
			$('#btn-submit').attr('disabled', false).text('Simpan Perubahan');

			if (res.status === 'success') {
				toastr.success(res.message, 'Berhasil');
				$('#form-password')[0].reset(); // reset form
			} else {
				toastr.error(res.message, 'Gagal');

				// Jika error form spesifik
				if (res.errors) {
					if (res.errors.current) {
						$('#password-feedback').removeClass('d-none').text(res.errors.current);
					}
					if (res.errors.new) {
						$('#new-password-feedback').removeClass('d-none').text(res.errors.new);
					}
					if (res.errors.confirm) {
						$('#confirm-password-feedback').removeClass('d-none').text(res.errors.confirm);
					}
				}
			}
		},
		error: function() {
			$('#btn-submit').attr('disabled', false).text('Simpan Perubahan');
			toastr.error('Terjadi kesalahan saat mengubah kata sandi.', 'Gagal');
		}
	});
});
</script>
</body>

</html>
