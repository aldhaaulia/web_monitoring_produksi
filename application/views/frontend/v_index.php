<?php

$this->load->view('frontend/parts/header');
$this->load->view('frontend/parts/navbar');

?>

<style>
	.step-wizard {
		background-color: #111f35;
		background-image: linear-gradient(19deg, #111f35 0%, #b721ff 100%);
		height: 100vh;
		width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.step-wizard-list {
		background: #fff;
		box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
		color: #333;
		list-style-type: none;
		border-radius: 10px;
		display: flex;
		padding: 20px 10px;
		position: relative;
		z-index: 10;
	}

	.step-wizard-item {
		padding: 0 20px;
		flex-basis: 0;
		-webkit-box-flex: 1;
		-ms-flex-positive: 1;
		flex-grow: 1;
		max-width: 100%;
		display: flex;
		flex-direction: column;
		text-align: center;
		min-width: 170px;
		position: relative;
	}

	.step-wizard-item+.step-wizard-item:after {
		content: "";
		position: absolute;
		left: 0;
		top: 19px;
		background: #111f35;
		width: 100%;
		height: 2px;
		transform: translateX(-50%);
		z-index: -10;
	}

	.progress-count {
		height: 40px;
		width: 40px;
		display: flex;
		align-items: center;
		justify-content: center;
		border-radius: 50%;
		font-weight: 600;
		margin: 0 auto;
		position: relative;
		z-index: 10;
		color: transparent;
	}

	.progress-count:after {
		content: "";
		height: 40px;
		width: 40px;
		background: #111f35;
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
		border-radius: 50%;
		z-index: -10;
	}

	.progress-count:before {
		content: "";
		height: 10px;
		width: 20px;
		border-left: 3px solid #fff;
		border-bottom: 3px solid #fff;
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -60%) rotate(-45deg);
		transform-origin: center center;
	}

	.progress-label {
		font-size: 14px;
		font-weight: 600;
		margin-top: 10px;
	}

	.current-item .progress-count:before,
	.current-item~.step-wizard-item .progress-count:before {
		display: none;
	}

	.current-item~.step-wizard-item .progress-count:after {
		height: 10px;
		width: 10px;
	}

	.current-item~.step-wizard-item .progress-label {
		opacity: 0.5;
	}

	.current-item .progress-count:after {
		background: #fff;
		border: 2px solid #111f35;
	}

	.current-item .progress-count {
		color: #111f35;
	}
</style>

<main>
	<!--? slider Area Start-->
	<div class="slider-area ">
		<div class="slider-active">
			<!-- Single Slider -->
			<div id="home" class="single-slider slider-height d-flex align-items-center">
				<div class="container">
					<div class="row">
						<div class="col-xl-9 col-lg-9">
							<div class="hero__caption">
								<h1>The details are <span>not the details,</span> they make the design</h1>
							</div>
							<!--Hero form -->
							<form class="search-box" id="search_box">
								<div class="input-form">
									<input id="proj_code" name="proj_code" type="text" placeholder="Search Project ID">
								</div>
								<div class="search-form">
									<!-- <button type="button" id="btn_search">search</button> -->
									<button type="button" id="btn_search" class="submit-btn">search</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- slider Area End-->

	<!--? Detail Area Start -->
	<div id="detail" class="contact-form-area pb-50 ">
		<div class="container">
			<!-- Detail Start -->
			<div class="col-lg-16 pt-70">

				<div class="card ">
					<div class="card-header">
						<h5 class="card-title">Monitoring</h5>
					</div>
					<div class="card-body">
						<form class="form" method="post" id="frm_monitoring">

							<div class="form-group row">
								<label for="project_id" class="col-sm-2 col-form-label">Project ID</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="project_id" name="project_id" placeholder="Project ID" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="customer_name" class="col-sm-2 col-form-label">Customer Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Customer Name" readonly>
								</div>
							</div>

							<div class="form-group row">
								<label for="project_date" class="col-sm-2 col-form-label">Project Due Date</label>
								<div class="col-md-3">
									<input type="text" class="form-control" id="project_date" name="project_date" placeholder="Project Date" readonly>
								</div>
							</div>
						</form>

					</div>
				</div>

				<div class="card card-primary card-outline">
					<div class="card-header">
						<h5 class="card-title">Detail Project</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table" id="tbl_monitoring" style="width: 100%;">
								<thead>
									<tr>
										<th style="text-align: center;">No.</th>
										<th style="text-align: center;">Jenis Barang</th>
										<th style="text-align: center;">Nama Barang</th>
										<th style="text-align: center;">Status Produksi</th>
										<th style="text-align: center;">Detail</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>

					</div>
				</div>

			</div>
			<!-- Detail End -->
		</div>
	</div>
	<!-- Detail Area End -->
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Project</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<ul class="step-wizard-list">
						<li id="step1" class="step-wizard-item">
							<span class="progress-count">1</span>
							<span class="progress-label">Pengukuran</span>
						</li>
						<li id="step2" class="step-wizard-item ">
							<span class="progress-count">2</span>
							<span class="progress-label">Cuting</span>
						</li>
						<li id="step3" class="step-wizard-item">
							<span class="progress-count">3</span>
							<span class="progress-label">Perakitan</span>
						</li>
						<li id="step4" class="step-wizard-item">
							<span class="progress-count">4</span>
							<span class="progress-label">Finishing</span>
						</li>
						<li id="step5" class="step-wizard-item">
							<span class="progress-count">5</span>
							<span class="progress-label">Pengecekan</span>
						</li>
						<li id="step6" class="step-wizard-item">
							<span class="progress-count">6</span>
							<span class="progress-label">Selesai</span>
						</li>
					</ul>

					<div class="row mt-30">
						<div class="col-sm-7">
							<div class="form-group row">
								<label for="jns_brg" class="col-sm-4 col-form-label">Jenis Barang</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="jns_brg" name="jns_brg" placeholder="Jenis Barang" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="nm_brg" class="col-sm-4 col-form-label">Nama Barang</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="nm_brg" name="nm_brg" placeholder="Nama Barang" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="ukuran" class="col-sm-4 col-form-label">Ukuran</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="Ukuran" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="warna" class="col-sm-4 col-form-label">Warna</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="warna" name="warna" placeholder="Warna" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
								<div class="col-sm-7">
									<textarea type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" readonly></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="tgl_pesan" class="col-sm-4 col-form-label">Tanggal Pemesanan</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="tgl_pesan" name="tgl_pesan" placeholder="Tanggal Pemesanan" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="tgl_update" class="col-sm-4 col-form-label">Tanggal Pembaruan</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="tgl_update" name="tgl_update" placeholder="Tanggal Pembaruan" readonly>
								</div>
							</div>
						</div>

						<div class="col-sm-5">
							<div class="card card-primary card-outline">
								<div class="card-header">
									<h4>Dokumentasi Terkini</h4>
								</div>
								<div class="card-body">
									<h1 id="fotoNull">Tidak ada</h1>
									<img id="viewIMG" src="<?= base_url('assets/backend/uploads/'); ?>poto_1659073789.6476.png" height="100%">
								</div>
							</div>
						</div>
					</div>

					<div class="card card-primary card-outline mt-10">
						<div class="card-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group row">
										<label for="sts_prod" class="col-sm-4 col-form-label">Status Produksi</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" id="sts_prod" name="sts_prod" placeholder="Status Produksi" readonly>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group row">
										<label for="sts_check" class="col-sm-4 col-form-label">Pengecekan</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" id="sts_check" name="sts_check" placeholder="Pengecekan" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="submit-btn" data-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('frontend/parts/footer'); ?>

<script>
	$(document).ready(function() {
		$("#detail").hide();
		$('#viewIMG').hide();
		$('#fotoNull').hide();
	});

	$('#btn_search').click(function() {
		var link_Save = '<?= base_url() . 'frontend/C_Landing/get_proj' ?>';
		var cd_proj = $('#proj_code').val();

		$.ajax({
			url: link_Save,
			type: 'post',
			dataType: 'json',
			data: {
				proj_code: cd_proj
			},
			success: function(result) {
				if (result.success) {
					var data_proj = result.data;

					console.log(data_proj);
					$('#project_id').val(data_proj.kd_proj);
					$('#customer_name').val(data_proj.nama_cust);
					$('#project_date').val(data_proj.date);
					$("#detail").show();

					$('html, body').animate({
						scrollTop: $("#detail").offset().top
					}, 1000);

					getDetail(data_proj.id_project);
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Gagal',
						text: result.msg,
					});
				}
			}
		});
	});

	function getDetail(id) {
		var table = $('#tbl_monitoring');
		var table_body = table.find('tbody');
		var id_proj = id;

		$.ajax({
			url: '<?= base_url() . 'frontend/C_Landing/get_ProjDtl'; ?>',
			type: 'post',
			dataType: 'json',
			data: {
				id: id_proj
			},
			success: function(result) {
				table_body.html('');
				if (result.success) {
					let data_dtl = result.data;

					$.each(data_dtl, function(i, data) {
						table_body.append(`
						<tr>
							<td style="text-align: center;">` + data.no + `</td>
							<td style="text-align: center;">` + data.jenis_barang + `</td>
							<td style="text-align: center;">` + data.nama_barang + `</td>
							<td style="text-align: center;">` + data.status_produksi + `</td>
							<td style="text-align: center;">
								<button id='detail_btn' data-toggle="modal" data-target="#exampleModal" data-item="` + data.id_proj_dtl + `" type="button" class="submit-btn">detail</button>
							</td>
						</tr>
						`)
					});
				}
			}
		});
	}

	$(document).on("click", "#detail_btn", function() {
		var link_Save = '<?= base_url() . 'frontend/C_Landing/get_DtlById' ?>';
		var id = $(this).data('item');
		console.log(id);

		$.ajax({
			url: link_Save,
			type: 'post',
			dataType: 'json',
			data: {
				id: id,
			},
			success: function(result) {
				if (result.success) {
					var data_dtl = result.data;

					console.log(data_dtl);
					$('#jns_brg').val(data_dtl.jenis_barang);
					$('#nm_brg').val(data_dtl.nama_barang);
					$('#ukuran').val(data_dtl.ukuran);
					$('#warna').val(data_dtl.warna);
					$('#keterangan').val(data_dtl.keterangan);
					$('#tgl_pesan').val(data_dtl.date_create);
					$('#tgl_update').val(data_dtl.date_project);
					$('#sts_prod').val(data_dtl.status_produksi);
					$('#sts_check').val(data_dtl.stat);

					var prod = data_dtl.stat_produksi;
					var cek = data_dtl.stat_pengecekan;

					$("#step1").removeClass("current-item");
					$("#step2").removeClass("current-item");
					$("#step3").removeClass("current-item");
					$("#step4").removeClass("current-item");
					$("#step5").removeClass("current-item");
					$("#step6").removeClass("current-item");

					if (prod == 2) {
						$("#step1").addClass("current-item");
					} else if (prod == 3) {
						$("#step2").addClass("current-item");
					} else if (prod == 4) {
						$("#step3").addClass("current-item");
					} else if (prod == 5) {
						$("#step4").addClass("current-item");
					} else if (prod == 6) {
						if (cek == 0) {
							$("#step5").addClass("current-item");
						} else if (cek == 1) {
							$("#step6").removeClass("current-item");
						} else if (cek == 2) {
							$("#step6").addClass("current-item");
						}
					}

					var doc_poto = data_dtl.file_poto;

					if (!(doc_poto == '-')) {
						$('#fotoNull').hide();
						$('#viewIMG').show();
						$('#viewIMG').attr('src', '<?= base_url('assets/backend/uploads/'); ?>' + doc_poto)
					} else {
						$('#viewIMG').hide();
						$('#fotoNull').show();

					}
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Gagal',
						text: result.msg,
					});
				}
			}
		});
	});
</script>