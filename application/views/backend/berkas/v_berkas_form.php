<?php

$this->load->view('Backend/Parts/header');
$this->load->view('Backend/Parts/navbar_main');
$this->load->view('Backend/Parts/sidebar');

?>

<div class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-lg-12">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title">Kelola PO</h5>
						</div>
						<div class="card-body">

						<form class="form" method="post" id="frm_add">

								<div class="form-group row">
									<label for="input_customer_name" class="col-sm-2 col-form-label">Customer Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="input_no" name="input_customer_name" placeholder="Customer Name">
									</div>
								</div>

								<div class="form-group row">
									<label for="input_customer_id" class="col-sm-2 col-form-label">Customer ID</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="input_customer_id" name="input_customer_id" placeholder="Customer ID">
									</div>
								</div>

								<div class="form-group row">
									<label for="input_project_id" class="col-sm-2 col-form-label">Project ID</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="input_project_id" name="input_project_id" placeholder="Project ID">
									</div>
								</div>

								<div class="form-group row">
									<label for="input_project_date" class="col-sm-2 col-form-label">Project Date</label>
									<div class="col-md-3">
										<input type="date" class="form-control" id="input_project_date" name="input_project_date" placeholder="Project Date">
									</div>
								</div>

								<div class="form-group row">
									<label for="input_jenis_barang" class="col-sm-2 col-form-label">Jenis Barang</label>
									<div class="col-md-3">
										<input type="text" class="form-control" id="input_jenis_barang" name="input_jenis_barang" placeholder="Jenis Barang">
									</div>
								</div>

                                <div class="form-group row">
									<label for="input_nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
									<div class="col-md-3">
										<input type="text" class="form-control" id="input_nama_barang" name="input_nama_barang" placeholder="Nama Barang">
									</div>
								</div>

                                <div class="form-group row">
									<label for="input_ukuran_barang" class="col-sm-2 col-form-label">Ukuran Barang</label>
									<div class="col-md-3">
										<input type="text" class="form-control" id="input_ukuran_barang" name="input_ukuran_barang" placeholder="Ukuran Barang">
									</div>
								</div>

                                <div class="form-group row">
									<label for="input_warna_barang" class="col-sm-2 col-form-label">Warna Barang</label>
									<div class="col-md-3">
										<input type="text" class="form-control" id="input_nama_barang" name="input_warna_barang" placeholder="Warna Barang">
									</div>
								</div>

                                <div class="form-group row">
									<label for="input_keterangan" class="col-sm-2 col-form-label">Keterangan</label>
									<div class="col-md-3">
										<input type="text" class="form-control" id="input_keterangan" name="input_keterangan" placeholder="Keterangan">
									</div>
								</div>


							</form>

						</div>

						<div class="card-footer">
							<button type="button" class="btn btn-primary" id="btn_save">Save</button>
						</div>

					</div><!-- /.card -->
				</div>

			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Backend/Parts/footer'); ?>
