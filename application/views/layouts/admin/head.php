<!doctype html>
<!--
   * Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
   * @version 1.0.0-beta20
   * @link https://tabler.io
   * Copyright 2018-2023 The Tabler Authors
   * Copyright 2018-2023 codecalm.net Paweł Kuna
   * Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
   -->
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>JMART APP</title>
	<!-- CSS files -->
	<link rel="icon" href="<?= base_url('') ?>public/template/img/favicon/favicon.ico" type="image/x-icon" />
	<link href="<?= base_url('') ?>public/template/css/tabler.min.css?1692870487" rel="stylesheet" />
	<link href="<?= base_url('') ?>public/template/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
	<link href="<?= base_url('') ?>public/template/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
	<link href="<?= base_url('') ?>public/template/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
	<link href="<?= base_url('') ?>public/template/css/demo.min.css?1692870487" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
	<style>
		@import url('https://rsms.me/inter/inter.css');

		:root {
			--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
		}

		body {
			font-feature-settings: "cv03", "cv04", "cv11";
		}

		.navbar-brand-text {
			margin-left: 1rem !important;
			padding-top: 0.5rem !important;
		}

		.navbar-dark {
			background: #1e293b;
			color: rgba(255, 255, 255, 0.7);
		}

		.navbar-dark .navbar-nav .nav-link {
			color: rgba(255, 255, 255, 0.7);
		}

		.navbar-dark .navbar-nav .nav-link:hover,
		.navbar-dark .navbar-nav .nav-link:focus {
			color: #ffffff;
		}

		@media (min-width: 768px) {

			.navbar-expand-md.navbar-dark .nav-item.active .nav-link,
			.navbar-expand-md .navbar-dark .nav-item.active .nav-link {
				background-color: rgba(0, 0, 0, 0.1);
			}
		}

		/* Notifikasi Dropdown & Toast */
		#notif-list .notif-item {
			cursor: pointer;
			transition: background 0.2s;
			border-radius: 6px;
			padding: 10px 12px;
			margin-bottom: 2px;
			display: flex;
			flex-direction: column;
			gap: 2px;
		}

		#notif-list .notif-item:hover {
			background: #f1f5fa;
		}

		#notif-list .notif-title {
			font-weight: 600;
			color: #1e293b;
			font-size: 1em;
		}

		#notif-list .notif-desc {
			color: #64748b;
			font-size: 0.95em;
		}

		#notif-list .notif-time {
			color: #94a3b8;
			font-size: 0.85em;
			margin-top: 2px;
		}

		/* Badge jenis order styling */
		#notif-list .badge {
			font-size: 0.75em !important;
			padding: 0.25em 0.5em !important;
			border-radius: 4px !important;
		}

		.toast .badge {
			font-size: 0.75em !important;
			padding: 0.25em 0.5em !important;
			border-radius: 4px !important;
		}

		@media (max-width: 600px) {
			#notif-list {
				min-width: 180px !important;
				font-size: 0.95em;
			}

			.toast {
				min-width: 180px !important;
				font-size: 0.95em;
			}
		}

		.toast {
			display: none;
			opacity: 0;
			transition: opacity 0.3s;
		}

		.toast.show {
			display: block !important;
			opacity: 1;
		}
	</style>
	<script>
		// Logging hanya untuk development
		Pusher.logToConsole = false;

		const BASE_URL = "<?= base_url('') ?>";

		const pusher = new Pusher('fe22024f3d888f7e4ae0', {
			cluster: 'ap1'
		});
		const channel = pusher.subscribe('my-channel');

		// ===== Helpers =====
		const getOrderNotifications = () => {
			try {
				return JSON.parse(sessionStorage.getItem('order_notifications')) || [];
			} catch {
				return [];
			}
		};

		const setOrderNotifications = (arr) => {
			sessionStorage.setItem('order_notifications', JSON.stringify(arr));
		};

		const updateNotifBadge = () => {
			const notif = getOrderNotifications();
			const badge = document.getElementById('notif-badge');
			if (badge) {
				badge.textContent = notif.length ? notif.length : '';
				badge.style.display = notif.length ? 'inline-block' : 'none';
			}
		};

		// Helper function untuk mendapatkan label jenis order
		const getJenisOrderLabel = (jenisOrder) => {
			switch(jenisOrder) {
				case 'ambil_sendiri':
					return '<span class="badge bg-info text-white">Ambil Sendiri</span>';
				case 'dianterin':
					return '<span class="badge bg-warning text-white">Dianterin</span>';
				case 'dianterin_pt':
					return '<span class="badge bg-danger text-white">Dianterin PT</span>';
				default:
					return '<span class="badge bg-secondary text-white">Unknown</span>';
			}
		};

		const updateNotifList = () => {
			const notif = getOrderNotifications();
			const list = document.getElementById('notif-list');
			if (!list) return;

			list.innerHTML = notif.length ?
				notif.map(item => `
            <li class='notif-item' onclick="window.location.href='${BASE_URL}penjualan/siapkan/${item.id_pesanan}'">
               <span class='notif-title'>${item.nama_member} <span class='badge bg-success text-white ms-1'>Baru</span></span>
               <span class='notif-desc'>${item.nama_barang} (Qty:${item.jumlah_jual})</span>
               <div class='mt-1'>${getJenisOrderLabel(item.jenis_order || 'ambil_sendiri')}</div>
               <span class='notif-time'>${item.waktu}</span>
            </li>`).join('') :
				`<li class="dropdown-item text-center">Belum ada orderan masuk</li>`;
		};

		const showOrderToast = (order) => {
			const toast = document.getElementById('order-toast');
			const toastBody = document.getElementById('order-toast-body');
			if (toast && toastBody) {
				toastBody.innerHTML = `
            <b>${order.nama_member}</b> memesan <b>${order.nama_barang}</b> (Qty:${order.jumlah_jual})<br>
            <div class='mt-1'>${getJenisOrderLabel(order.jenis_order || 'ambil_sendiri')}</div>
            <a href='${BASE_URL}penjualan/siapkan/${order.id_pesanan}' class='btn btn-sm btn-light mt-2'>Lihat Pesanan</a>`;
				toast.classList.add('show');
				setTimeout(() => toast.classList.remove('show'), 4000);
			}
		};

		// ===== Pusher Event Listener =====
		channel.bind('my-event-dev-2', ({
			pesanan: pesananList,
			user
		}) => {
			let notif = getOrderNotifications();

			// Hanya simpan pesanan Pending
			pesananList.forEach(p => {
				if (user.status_pesanan?.toLowerCase() === 'pending') {
					const order = {
						id_pesanan: user.id_pesanan,
						nama_member: user.nama_member,
						nama_barang: p.nama_barang,
						jumlah_jual: p.jumlah_jual,
						jenis_order: user.jenis_order || 'ambil_sendiri', // Default jika tidak ada
						waktu: new Date().toLocaleString(),
						grand_total: user.grand_total
					};
					
					notif.unshift(order);
					showOrderToast(order);
				}
			});

			// Filter hanya pending
			const pendingNotif = notif.filter(n => n.status_pesanan?.toLowerCase() === 'pending' || !n.status_pesanan);

			setOrderNotifications(pendingNotif);
			updateNotifBadge();
			updateNotifList();
		});

		// ===== Init saat halaman load =====
		document.addEventListener('DOMContentLoaded', () => {
			updateNotifBadge();
			updateNotifList();
		});
	</script>


	<!-- Toast Notifikasi -->
	<div id="order-toast" class="toast align-items-center text-bg-primary border-0 position-fixed top-0 end-0 m-4 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 9999; min-width: 300px;">
		<div class="d-flex">
			<div class="toast-body w-100 text-white" id="order-toast-body"></div>
		</div>
	</div>
