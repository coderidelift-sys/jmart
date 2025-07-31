<?php
$segment = $this->uri->segment(1);
$user = $this->session->userdata('id_user');
$count_keranjang = $this->db->select('*')->from('tb_keranjang')->where('id_user', $user)->count_all_results();
?>

<footer class="footer-nav">
	<div class="container">
		<div class="row">
			<div class="col-2">
				<a href="<?= base_url('home') ?>" class="footer-nav__link <?= $segment == 'home' ? '_active' : '' ?>">
					<i class="fa fa-home" style="font-size: 24px;margin-top: 10px;margin-bottom: 0px;"></i>
					<span style="font-size: 12px;">Home</span>
				</a>
			</div>
			<div class="col-2">
				<a href="<?= base_url('keranjang') ?>" class="footer-nav__link <?= $segment == 'keranjang' ? '_active' : '' ?>">
					<i class="fa fa-shopping-cart" style="font-size: 24px;margin-top: 10px;margin-bottom: 0px;">
						<span class="badge bg-danger text-white count-keranjang" style="position: absolute;z-index: 2;top: 10px;font-weight: 600;width: 19px;height: 19px;border-radius: 20%;padding: 3px 4px;font-size: 12px;"><?= $count_keranjang ?></span>
					</i>
					<span style="font-size: 12px;" class="text-nowrap">
						Keranjang
					</span>
				</a>
			</div>
			<div class="col-2">
				<a href="<?= base_url('promo') ?>" class="footer-nav__link <?= $segment == 'promo' ? '_active' : '' ?>">
					<i class="fa fa-certificate" style="font-size: 24px;margin-top: 10px;margin-bottom: 0px;"></i>
					<span style="font-size: 12px;">Promo</span>
				</a>
			</div>
			<div class="col-2">
				<a href="<?= base_url('pesanan') ?>" class="footer-nav__link <?= $segment == 'pesanan' ? '_active' : '' ?>">
					<i class="fa fa-list" style="font-size: 24px;margin-top: 10px;margin-bottom: 0px;"></i>
					<span style="font-size: 12px;">Pesanan</span>
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
