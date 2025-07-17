<?php $this->load->view('layouts/user/head'); ?>
<style>
	.timeline {
		position: relative;
		height: 100%;
		width: 100%;
		padding: 0;
		list-style: none;
	}

	.timeline.timeline-dashed:before {
		border-style: dashed;
	}

	.timeline::before {
		position: absolute;
		top: 0;
		left: 0;
		z-index: 1;
		height: 100%;
		width: 1px;
		border: 0;
		border-left: 1px solid #d9dee3;
		content: "";
	}

	.timeline .timeline-item {
		position: relative;
		padding-left: 3rem;
	}

	.timeline .timeline-item .timeline-indicator {
		position: absolute;
		left: -0.6875rem;
		top: 0;
		z-index: 2;
		display: block;
		height: 1.5rem;
		width: 1.5rem;
		text-align: center;
		border-radius: 50%;
		border: 2px solid #696cff;
		background-color: #f5f5f9 !important;
	}

	.timeline .timeline-item .timeline-indicator i {
		color: #696cff;
		font-size: .85rem;
		vertical-align: baseline;
	}

	.timeline .timeline-indicator-success {
		border-color: #71dd37 !important;
	}

	.timeline .timeline-indicator-secondary {
		border-color: #d9dee3 !important;
	}

	.timeline .timeline-indicator-secondary i {
		color: #d9dee3 !important;
	}

	.timeline .timeline-indicator-success i {
		color: #71dd37 !important;
	}

	.timeline .timeline-item .timeline-event {
		position: relative;
		top: -1rem;
		width: 100%;
		min-height: 4rem;
		background-color: #fff;
		border-radius: 0.375rem;
		padding: 1.25rem 1.5rem;
	}

	.timeline .timeline-item-success .timeline-event {
		background-color: rgba(113, 221, 55, .1);
	}

	.timeline .timeline-item-secondary .timeline-event {
		background-color: rgba(113, 221, 55, .1);
	}

	.timeline .timeline-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		flex-direction: row;
	}

	.timeline .timeline-item-success .timeline-event:before {
		border-left-color: rgba(105, 108, 255, .1) !important;
		border-right-color: rgba(105, 108, 255, .1) !important;
	}

	.timeline .timeline-item .timeline-event:before {
		position: absolute;
		top: 0.75rem;
		left: 32px;
		right: 100%;
		width: 0;
		height: 0;
		border-top: 1rem solid rgba(0, 0, 0, 0);
		border-right: 1rem solid;
		border-left: 0 solid;
		border-bottom: 1rem solid rgba(0, 0, 0, 0);
		border-left-color: #fff;
		border-right-color: #fff;
		margin-left: -3rem;
		content: "";
	}

	.content {
		margin: 20px 15px 0px 15px;
	}
</style>
<?php $this->load->view('layouts/user/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
	<div class="container nav-bar__on-container" style="display: flex;">
		<div class="navbar__left" style="z-index: 10;">
			<a href="<?= base_url('pesanan/pending') ?>">
				<svg class="navbar__left__icon fw-bold text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);cursor:pointer;z-index: 2;">
					<path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
				</svg>
			</a>
		</div>
		<div class="nav-bar__center">
			<h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Lacak Pesanan Anda</h1>
		</div>
	</div>
</nav>

<section class="mt-4 mb-4">
	<div class="container">
		<div class="card">
			<div class="border-bottom pb-1 content fw-bold d-flex justify-content-between">
				<div class="text-info">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(66, 153, 225, 1);">
						<path d="m20.772 10.155-1.368-4.104A2.995 2.995 0 0 0 16.559 4H7.441a2.995 2.995 0 0 0-2.845 2.051l-1.368 4.104A2 2 0 0 0 2 12v5c0 .738.404 1.376 1 1.723V21a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2h12v2a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2.277A1.99 1.99 0 0 0 22 17v-5a2 2 0 0 0-1.228-1.845zM7.441 6h9.117c.431 0 .813.274.949.684L18.613 10H5.387l1.105-3.316A1 1 0 0 1 7.441 6zM5.5 16a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 5.5 16zm13 0a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 18.5 16z"></path>
					</svg>
					Lacak Pesanan Anda
				</div>
				<div>
					#<?= $id ?> <span onclick="return alert('Berhasil Disalin')" class="text-success" style="cursor: pointer;">SALIN</span>
				</div>
			</div>
			<div class="card-body">
				<ul class="timeline timeline-dashed mt-3">
					<?php foreach ($lacak as $key => $value) : ?>
						<li class="timeline-item timeline-item-success mb-4">
							<span class="timeline-indicator timeline-indicator-success">
								<i class='bx bx-check'></i>
							</span>
							<div class="timeline-event">
								<div class="timeline-header mb-sm-0 mb-3">
									<h4 class="mb-0"><?= $value['status_tracking'] ?></h4>
									<small class="text-muted"><?= date('d/F/Y H:i:s', strtotime($value['updated_at_tracking'])) ?></small>
								</div>
								<p>
									<?= $value['status_tracking'] ?> oleh <?= $value['level'] ?>
								</p>
							</div>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
</section>

<div class="row">
	<br><br><br><br>
</div>

<?php $this->load->view('layouts/user/menu'); ?>
<?php $this->load->view('layouts/user/footer'); ?>
</body>

</html>
