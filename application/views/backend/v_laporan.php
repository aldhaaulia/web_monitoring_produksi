<?php

$this->load->view('Backend/Parts/header');
$this->load->view('Backend/Parts/navbar_main');
$this->load->view('Backend/Parts/sidebar');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Laporan Kegiatan</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="">Home</a></li>
						<li class="breadcrumb-item active">Laporan Kegiatan</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title">Laporan Kegiatan</h5>
						</div>
						<div class="card-body">
							<form class="form" method="post" id="frm_laporan">

								<div class="form-group row">
									<label for="from_date" class="col-sm-2 col-form-label">From Date</label>
									<div class="col-md-3">
										<input type="date" class="form-control" id="from_date" name="from_date" placeholder="From Date">
									</div>
								</div>

								<div class="form-group row">
									<label for="to_date" class="col-sm-2 col-form-label">To Date</label>
									<div class="col-md-3">
										<input type="date" class="form-control" id="to_date" name="to_date" placeholder="To Date">
									</div>
								</div>

							</form>

						</div>

						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-primary" id="btn_search">Search</button>
						</div>

					</div><!-- /.card -->
				</div>

			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->

	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-lg-12">

					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title">Laporan</h5>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table" id="tbl_laporan" style="width: 100%;">
									<thead>
										<tr>
											<th style="text-align: center;">No.</th>
											<th style="text-align: center;">Customer Name</th>
											<th style="text-align: center;">Project Id</th>
											<th style="text-align: center;">Project Date</th>
											<th style="text-align: center;">Deadline</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>

							<div class="modal-footer justify-content-between">
								<!-- <button type="button" class="btn btn-primary" id="btn_print">Cetak Laporan</button> -->
								<form action="<?php echo site_url('dashboard/cetaklaporan') ?>" class="form" method="post" id="frm_cetak">
									<input type="hidden" class="form-control" id="cetak_from_date" name="from_date" placeholder="From Date">

									<input type="hidden" class="form-control" id="cetak_to_date" name="to_date" placeholder="To Date">

									<input id="cetak_laporan" class="btn btn-primary" type="submit" name="btn" value="Cetak Laporan" />
								</form>
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
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('Backend/Parts/footer'); ?>

<script>
	$(document).ready(function() {
		$("#cetak_laporan").hide();
	});
	$('#btn_search').click(function() {
		var link = '<?= base_url() . 'dashboard/getLaporan' ?>';

		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();

		// console.log(from_date + ' & ' + to_date)

		var is_valid = false;

		if (from_date != '' && to_date != '') {
			is_valid = true;
		} else {
			is_valid = false;
		}

		if (is_valid) {
			var table = $('#tbl_laporan');
			var table_body = table.find('tbody');

			$.ajax({
				url: link,
				type: "POST",
				data: {
					from_date: from_date,
					to_date: to_date
				},
				dataType: "JSON",
				success: function(result) {
					table_body.html('');
					if (result.success) {
						let data_dtl = result.data;

						$('#cetak_from_date').val(from_date);
						$('#cetak_to_date').val(to_date);
						$("#cetak_laporan").show();

						$.each(data_dtl, function(i, data) {
							table_body.append(`
						<tr>
						<td style="text-align: center;">` + data.no + `</td>
						<td style="text-align: center;">` + data.nama_cust + `</td>
						<td style="text-align: center;">` + data.kd_proj + `</td>
						<td style="text-align: center;">` + data.tgl_create + `</td>
						<td style="text-align: center;">` + data.date_project + `</td>
						</tr>`)
						});
					}
				}
			});
		}

	});

	// $('#btn_print').click(function() {
	// 	var link = '<?= base_url() . 'dashboard/cetaklaporan' ?>';

	// 	var from_date = $('#from_date').val();
	// 	var to_date = $('#to_date').val();

	// 	var is_valid = false;

	// 	if (from_date != '' && to_date != '') {
	// 		is_valid = true;
	// 	} else {
	// 		is_valid = false;
	// 	}

	// 	if (is_valid) {
	// 		$.ajax({
	// 			url: link,
	// 			type: "POST",
	// 			data: {
	// 				from_date: from_date,
	// 				to_date: to_date
	// 			},
	// 			dataType: "JSON",
	// 		}).done(function(response) {
	// 			var $a = $("<a>");
	// 			$a.attr("href", link);
	// 			$("body").append($a);
	// 			// $a.attr("download");
	// 			$a[0].click();
	// 			$a.remove();
	// 		});
	// 	}

	// });
</script>