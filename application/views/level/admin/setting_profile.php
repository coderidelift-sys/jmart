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
                    Setting Profil
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
                        <h3 class="card-title">Perbarui Profil</h3>
                    </div>
                    <div class="row g-0">
                        <div class="col-3 d-none d-md-block border-end">
                            <div class="card-body">
                                <div class="list-group list-group-transparent">
                                    <a href="<?= base_url('profile') ?>" class="list-group-item list-group-item-action d-flex align-items-center  active ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                                        </svg>
                                        &nbsp; Perbarui Profil
                                    </a>
                                    <a href="<?= base_url('sandi') ?>" class="list-group-item list-group-item-action d-flex align-items-center ">
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
                                <div class="col-12 pt-3">
                                    <div class="card-body pt-3 pb-4" style="min-height: 520px">
										<form id="form-profile" enctype="multipart/form-data" method="post">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="mb-4">
                                                        <label class="form-label">
                                                            Username
                                                        </label>
                                                        <input value="<?= $profile['username'] ?>" type="text" class="form-control" disabled="" value="Petugas Admin">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="mb-4">
                                                        <label class="form-label">
                                                            Nomor Induk
                                                        </label>
                                                        <input type="text" class="form-control" disabled="" value="<?= $profile['nomor_induk'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="mb-4">
                                                        <label class="form-label required">
                                                            Nama Lengkap
                                                        </label>
                                                        <input value="<?= $profile['nama_member'] ?>" type="text" name="account_fullname" id="account-fullname" class="form-control" autocomplete="off" value="Admin Operator">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="mb-4">
                                                        <label class="form-label required">
                                                            Alamat Email
                                                        </label>
                                                        <input type="email" name="account_email" id="account-email" class="form-control" maxlength="64" autocomplete="off" value="<?= $profile['email_member'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="mb-4">
                                                        <label class="form-label">
                                                            Nomor Telepon
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                +62
                                                            </span>
                                                            <input type="text" name="account_phone" id="account-phone" class="form-control" maxlength="16" autocomplete="off" value="<?= $profile['wa_member'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
												<?php
													$avatarFolder = 'public/template/upload/user/';
													$avatarFile = !empty($profile['avatar']) && file_exists(FCPATH . $avatarFolder . $profile['avatar'])
														? $profile['avatar']
														: 'default.png';

													$avatar = base_url($avatarFolder . $avatarFile);
												?>

												<div class="col-sm-12 col-md-6">
													<div class="mb-4">
														<label for="load-photo" class="form-label">Foto Profil</label>
														<input type="hidden" name="account_photo_existing" id="account-photo-existing" value="<?= htmlspecialchars($profile['avatar'] ?? '') ?>">

														<div class="mb-2">
															<img src="<?= $avatar ?>" id="preview-image" class="avatar avatar-xl img-zoom" draggable="false" alt="Foto Profil">
														</div>

														<button type="button" id="btn-remove-image" class="btn btn-danger btn-sm mb-2" style="min-width: 112px; display: none;">
															Hapus Foto
														</button>

														<input type="file" id="load-photo" class="form-control" accept=".png, .jpg, .jpeg" name="account_photo">
													</div>
												</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary btn-block">
                                                            <svg xmlns="http://www.w3.org/2000/svg" id="btn-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <circle cx="12" cy="12" r="9"></circle>
                                                                <path d="M9 12l2 2l4 -4"></path>
                                                            </svg>
                                                            <span id="btn-icon"></span>
                                                            <span id="btn-text">Simpan Perubahan</span>
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
$('#form-profile').on('submit', function(e) {
    e.preventDefault(); // stop form default submit

    var formData = new FormData(this);

    $.ajax({
        url: '<?= base_url("akun/profile_update") ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
            $('#btn-text').text('Menyimpan...');
            $('#btn-svg').addClass('spinner-border spinner-border-sm');
        },
        success: function(res) {
            $('#btn-text').text('Simpan Perubahan');
            $('#btn-svg').removeClass('spinner-border spinner-border-sm');

            if (res.status === 'success') {
                toastr.success(res.message, "Berhasil");
                // Optionally reload profile data
                setTimeout(() => location.reload(), 1000);
            } else {
                toastr.error(res.message, "Gagal");
            }
        },
        error: function(xhr) {
            $('#btn-text').text('Simpan Perubahan');
            $('#btn-svg').removeClass('spinner-border spinner-border-sm');
            toastr.error('Terjadi kesalahan saat menyimpan data.', 'Gagal');
        }
    });
});
</script>

</body>

</html>
