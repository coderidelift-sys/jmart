<?php
$segment = $this->uri->segment(1);
?>

<footer class="footer-nav">
	<div class="container">
		<div class="row">
			<div class="col-2">
				<a href="<?= base_url('home') ?>" class="footer-nav__link 
               <?= $segment == 'home' ? '_active' : '' ?>
               <?= $segment == 'misi' ? '_active' : '' ?>
               ">
					<i class="fa fa-home" style="font-size: 24px;margin-top: 10px;margin-bottom: 0px;"></i>
					<span style="font-size: 12px;">Home</span>
				</a>
			</div>
			<div class="col-2">
				<a href="<?= base_url('pesanan_user') ?>" class="footer-nav__link <?= $segment == 'pesanan_user' ? '_active' : '' ?>">
					<i class="fa fa-shopping-cart" style="font-size: 24px;margin-top: 10px;margin-bottom: 0px;"></i>
					<span style="font-size: 12px;">Pesanan</span>
				</a>
			</div>
			<div class="col-4">
				<a href="<?= base_url('map') ?>" class="footer-nav__link <?= $segment == 'map' ? '_active' : '' ?>">
					<span class="greeting-cs bg-transparent" style="text-align:center !important;display: inline-block !important;">
						<i class="fa fa-map-marker" style="font-size: 24px;margin-top: 10px;margin-bottom: 0px;"></i>
						<span style="font-size: 12px;">Mapping</span>
					</span>
				</a>
			</div>
			<div class="col-2">
				<a href="<?= base_url('akun') ?>" class="footer-nav__link <?= $segment == 'akun' ? '_active' : '' ?>">
					<i class="fa fa-user" style="font-size: 24px;margin-top: 10px;margin-bottom: 0px;"></i>
					<span style="font-size: 12px;">Profil</span>
				</a>
			</div>
			<div class="col-2">
				<!-- Logout Link -->
				<a href="#" class="footer-nav__link" onclick="confirmLogout(event)">
					<i class="fa fa-sign-out" style="font-size: 24px; margin-top: 10px;"></i>
					<span style="font-size: 12px;">Logout</span>
				</a>

				<!-- SweetAlert2 CDN (pastikan hanya satu kali dimuat) -->
				<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

				<!-- SweetAlert2 Logout Function -->
				<script>
					function confirmLogout(event) {
						event.preventDefault(); // Cegah redirect langsung
						Swal.fire({
							title: 'Yakin ingin logout?',
							text: 'Anda akan keluar dari aplikasi.',
							icon: 'warning',
							showCancelButton: true,
							confirmButtonText: 'Ya, Logout',
							cancelButtonText: 'Batal',
							customClass: {
								confirmButton: 'btn btn-danger ms-3',
								cancelButton: 'btn btn-secondary'
							}
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = "<?= base_url('login/logout') ?>";
							}
						});
					}
				</script>
			</div>
		</div>
	</div>
</footer>
