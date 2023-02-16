<?php

$this->load->view('Backend/Parts/header');
$this->load->view('Backend/Parts/navbar_main');
$this->load->view('Backend/Parts/sidebar');

?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Dashboard</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Content Wrapper. Contains page content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-lg-12">

					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title">List Table</h5>
						</div>
						<div class="card-body">

							<div class="table-responsive">
								<table class="table" id="tbl_dashboard" style="width: 100%;">
									<thead>
										<tr>
											<th style="text-align: center;">No.</th>
											<th style="text-align: center;">Customer Name</th>
											<th style="text-align: center;">Project ID</th>
											<th style="text-align: center;">Progress</th>
											<th style="text-align: center;">Aksi</th>
										</tr>
									</thead>

									<tbody>
										<?php $no = 1;
										foreach ($project as $data) : ?>
											<tr>
												<td style="text-align: center;"><?php echo $no; ?>.</td>
												<td style="text-align: center;"><?php echo $data['nama_cust'] ?></td>
												<td style="text-align: center;"><?php echo $data['kd_proj'] ?></td>
												<td style="text-align: center;">
													<div class="progress">
														<div class="progress-bar" role="progressbar" style="width: <?= $data['progres'] ?>%" aria-valuenow="<?= $data['progres'] ?>" aria-valuemin="0" aria-valuemax="100"><?= $data['progres'] ?>%</div>
													</div>
												</td>
												<td style="text-align: center;">
													<!-- <button type="button" class="btn btn-success">Detail</button> -->
													<?= anchor('dashboard/get_ById/' . $data['id_project'], 'Detail', ['class' => 'btn btn-success']); ?>
												</td>
											</tr>
										<?php $no++;
										endforeach; ?>
									</tbody>
								</table>
							</div>

						</div>
					</div>

				</div>

			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Backend/Parts/footer'); ?>