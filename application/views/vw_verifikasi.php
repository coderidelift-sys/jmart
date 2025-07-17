 <div class="page page-center">
 	<div class="container container-normal py-4">
 		<div class="row align-items-center g-4">
 			<div class="col-lg">
 				<div class="container-tight">
 					<div class="text-center mb-4">
 						<a href="<?= base_url('') ?>" class="navbar-brand navbar-brand-autodark"><img src="<?= base_url('public/template/img/favicon/jmart-removebg-preview.png') ?>" height="36" alt=""></a>
 					</div>
 					<div class="card card-md">
 						<form action="<?= base_url('') ?>register/kode" id="form-verifikasi" class="mb-3" method="POST">
 							<div class="card-body">
 								<?php
									if ($this->session->flashdata('success_register') != '') {
										echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
										echo $this->session->flashdata('success_register');
										echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
										echo '</div>';
									}
									?>

 								<?php
									if ($this->session->flashdata('error') != '') {
										echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
										echo $this->session->flashdata('error');
										echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
										echo '</div>';
									}
									?>
 								<h2 class="card-title text-center mb-4">Kode Verifikasi</h2>
 								<div class="mb-3">
 									<label for="kode_verifikasi" class="form-label">Kode Verifikasi</label>
 									<input type="hidden" name="access_key" id="access_key" value="<?= $id ?>">
 									<input oninput="checkLength(this)" required type="number" class="form-control" id="kode_verifikasi" name="kode_verifikasi" placeholder="Kode Verifikasi">
 								</div>
 								<div class="form-footer">
 									<button type="submit" class="btn btn-primary w-100">
 										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
 											<path d="M3.433 17.325 3.079 19.8a1 1 0 0 0 1.131 1.131l2.475-.354C7.06 20.524 8 18 8 18s.472.405.665.466c.412.13.813-.274.948-.684L10 16.01s.577.292.786.335c.266.055.524-.109.707-.293a.988.988 0 0 0 .241-.391L12 14.01s.675.187.906.214c.263.03.519-.104.707-.293l1.138-1.137a5.502 5.502 0 0 0 5.581-1.338 5.507 5.507 0 0 0 0-7.778 5.507 5.507 0 0 0-7.778 0 5.5 5.5 0 0 0-1.338 5.581l-7.501 7.5a.994.994 0 0 0-.282.566zM18.504 5.506a2.919 2.919 0 0 1 0 4.122l-4.122-4.122a2.919 2.919 0 0 1 4.122 0z"></path>
 										</svg>
 										&nbsp;&nbsp;Verifikasi Akun
 									</button>
 								</div>
 							</div>
 						</form>
 					</div>
 					<div class="text-center text-secondary mt-3">
 						Ingat Sekarang? <a href="<?= base_url('login') ?>" tabindex="-1">Silahkan Login</a>
 					</div>
 				</div>
 			</div>
 			<div class="col-lg d-none d-lg-block">
 				<img src="<?= base_url() ?>public/template/img/illustrations/2factor.svg" height="300" class="d-block mx-auto" alt="">
 			</div>
 		</div>
 	</div>
 </div>

 <script>
 	function checkLength(input) {
 		if (input.value.length > 6) {
 			input.value = input.value.slice(0, 6); // Memotong angka menjadi 6 digit pertama
 		}
 	}
 </script>