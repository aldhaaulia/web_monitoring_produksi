<?php

$sess_data = $this->session->userdata('auth');
$id_akun  = $sess_data['id_akun'];
$nama_user  = $sess_data['nama'];
$role  = $sess_data['role'];

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url('dashboard'); ?>" class="brand-link">
		<span class="brand-text font-weight-light">PT. KEMALA CIPTA SELARAS</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url('assets/backend'); ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="<?= base_url('dashboard'); ?>" class="d-block"><?= $nama_user; ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				<li class="nav-item">
					<a href="<?= base_url('dashboard'); ?>" class="nav-link">
						<i class="nav-icon fas fa-th"></i>
						<p> Dashboard </p>
					</a>
				</li>
				<?php if ($role == '1' || $role == '2' || $role == '3') : ?>
					<li class="nav-item">
						<a href="<?= base_url('kelolapo'); ?>" class="nav-link">
							<i class="nav-icon fas fa-file-invoice"></i>
							<p> Kelola PO </p>
						</a>
					</li>
				<?php endif; ?>

				<?php if ($role == '1' || $role == '2' || $role == '3') : ?>
					<li class="nav-item">
						<a href="<?= base_url('monitoring'); ?>" class="nav-link">
							<i class="nav-icon fas fa-file-invoice"></i>
							<p> Monitoring Kegiatan Produksi </p>
						</a>
					</li>
				<?php endif; ?>

				<?php if ($role == '1' || $role == '4') : ?>
					<li class="nav-item">
						<a href="<?= base_url('laporan'); ?>" class="nav-link">
							<i class="nav-icon fas fa-file-invoice"></i>
							<p> Laporan Kegiatan Produksi </p>
						</a>
					</li>
				<?php endif; ?>

				<?php if ($role == '1') : ?>
					<li class="nav-item">
						<a href="<?= base_url('user'); ?>" class="nav-link">
							<i class="nav-icon fas fa-users"></i>
							<p> Management User </p>
						</a>
					</li>
				<?php endif; ?>

			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>