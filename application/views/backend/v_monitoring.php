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
					<h1 class="m-0">Monitoring</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="">Home</a></li>
						<li class="breadcrumb-item active">Monitoring</li>
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
							<h5 class="card-title">Monitoring</h5>
						</div>
						<div class="card-body">
							<form class="form" method="post" id="frm_monitoring">

								<div class="form-group row">
									<label for="project_id" class="col-sm-2 col-form-label">Project ID</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="project_id" name="project_id" placeholder="Project ID">
									</div>
								</div>

								<div class="form-group row">
									<label for="customer_id" class="col-sm-2 col-form-label">Customer ID</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="customer_id" name="customer_id" placeholder="Customer ID" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="customer_name" class="col-sm-2 col-form-label">Customer Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Customer Name" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="project_date" class="col-sm-2 col-form-label">Project Date</label>
									<div class="col-md-3">
										<input type="text" class="form-control" id="project_date" name="project_date" placeholder="Project Date" readonly>
									</div>
								</div>
							</form>
						</div>
					</div>

					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title">Monitoring</h5>
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
											<th style="text-align: center;">File Dokumentasi</th>
											<th style="text-align: center;">Pengecekan</th>
											<th style="text-align: center;">Tanggal Update</th>
											<th style="text-align: center;">Action</th>
										</tr>
									</thead>
									<tbody></tbody>
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

<!-- Edit Modal-->
<div class="modal fade" id="editDtlModal" tabindex="-1" role="dialog" aria-labelledby="editDtlModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editDtlModalLabel">Ubah Status Produksi</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<form id="frm_edtStat" action="" method="post" enctype="multipart/form-data">
						<input type="hidden" id="edt_id_project_dtl" name="id_project_dtl" value="" />
						<input type="hidden" id="edt_id_project" name="id_project" value="" />
						<div class="form-group">
							<label>Status Pekerjaan</label>
							<select class="form-control" name="stat_produksi" id="stat_produksi" required>
								<option value="" selected hidden id="selected_stat"></option>
								<?php foreach ($stat_kerja as $row) : ?>
									<option value="<?= $row['id']; ?>"><?= $row['jenis_pekerjaan']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div id="photo" class="form-group">
							<label>Upload Dokumentasi</label>
							<input type="file" class="form-control" id="foto" name="foto" placeholder="Lampiran">
							<div class="row">
								<span class="helper">*Ukuran gambar maksimal 2MB</span>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btn_save_edt" class="btn btn-primary" type="button">Simpan</button>
			</div>
		</div>
	</div>
</div>

<!-- Pengecekan Modal-->
<div class="modal fade" id="cekDtlModal" tabindex="-1" role="dialog" aria-labelledby="cekDtlModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="cekDtlModalLabel">Ubah Status Pengecekan</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<form id="frm_edtcek" action="" method="post" enctype="multipart/form-data">
						<input type="hidden" id="cek_id_project_dtl" name="id_project_dtl" value="" />
						<input type="hidden" id="cek_id_project" name="id_project" value="" />
						<div class="form-group">
							<label>Status Pengecekan</label>
							<select class="form-control" name="stat_pengecekan" id="stat_pengecekan" required>
								<option value="" selected hidden>--Pilih Salah Satu--</option>
								<option value="0">Belum Dicek</option>
								<option value="2">Perbaikan</option>
								<option value="1">Ok</option>
							</select>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btn_save_cek" class="btn btn-primary" type="button">Simpan</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Preview Berkas -->
<div class="modal fade" id="berkasModal" tabindex="-1" role="dialog" aria-labelledby="berkasModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="berkasModalLabel">Dokumentasi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="text-align : center">
				<img id="viewIMG" src="<?= base_url('assets/backend/uploads/'); ?>" width="100%" height="500">
			</div>
			<div class=" modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('Backend/Parts/footer'); ?>

<script>
	$(document).ready(function() {
		$("#photo").hide();
		$(document).on("click", "#edtDtlProject", function() {
			var id_proj_dtl = $(this).data('item');
			var id_proj = $(this).data('proj');
			var stat = $(this).data('text');
			// console.log(id_akun);
			$('#edt_id_project_dtl').val(id_proj_dtl);
			$('#edt_id_project').val(id_proj);
			$('#selected_stat').text('--' + stat + '--');
		});
		$(document).on("click", "#edtCekProject", function() {
			var id_proj_dtl = $(this).data('item');
			var id_proj = $(this).data('proj');
			// console.log(id_akun);
			$('#cek_id_project_dtl').val(id_proj_dtl);
			$('#cek_id_project').val(id_proj);
		});
		$(document).on("click", "#edtCekProject", function() {
			var id_proj_dtl = $(this).data('item');
			var id_proj = $(this).data('proj');
			// console.log(id_akun);
			$('#cek_id_project_dtl').val(id_proj_dtl);
			$('#cek_id_project').val(id_proj);
		});
		$(document).on("click", "#imgView", function() {
			var file_photo = $(this).data('item');
			// console.log(id_akun);
			$('#viewIMG').attr('src', '<?= base_url('assets/backend/uploads/'); ?>' + file_photo)
		});
	});

	$("#stat_produksi").on('change', function() {
		var stat_prod = $('#stat_produksi').val();
		if (stat_prod == 4 || stat_prod == 5) {
			$("#photo").show();
		} else {
			$("#photo").hide();
		}
	});

	$("#project_id").autocomplete({
		// sugestion project_id
		// Create_by Putra

		// appendTo: (pluginOption.modal !== undefined ? "#" + pluginOption.modal : null), // to fix not showing when on modal
		minLength: 2,
		source: function(request, response) {
			$.ajax({
				url: '<?= base_url() . 'monitoring/search_proj'; ?>',
				type: 'post',
				dataType: "json",
				data: {
					q: request.term
				},
				success: function(data) {
					// console.log(data);
					response(data.data);
					// set limit item
					// default limit 10 items
					// var list_data = data;
					// var limit = (pluginOption.limit !== undefined ? pluginOption.limit : 10);
					// var result_data = list_data.slice(0, limit);
					// response(result_data);
				}
			});
		},
		select: function(event, ui) {
			var dataItems = ui.item;
			// console.log(dataItems);
			$("#project_id").val(dataItems.kd_proj);
			$("#customer_id").val(dataItems.kd_cust);
			$("#customer_name").val(dataItems.nama_cust);
			$("#project_date").val(dataItems.date_project);
			$("#user_dir").val(dataItems.dir);
			getDetail(dataItems.id_project);
			return false;
		}
	}).autocomplete("instance")._renderItem = function(ul, item) {
		return $("<li></li>").append(item.kd_proj + ' -- ' + item.nama_cust).appendTo(ul);
	};

	function getDetail(id) {
		var table = $('#tbl_monitoring');
		var table_body = table.find('tbody');
		var id_proj = id;

		$.ajax({
			url: '<?= base_url() . 'monitoring/get_ProjDtl'; ?>',
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
						<td style="text-align: center;">` + data.doc + `</td>
						<td style="text-align: center;">` + data.stat + `</td>
						<td style="text-align: center;">` + data.date_project + `</td>
						<td style="text-align: center;">` + data.act + `</td>
						</tr>`)
					});
				}
			}
		});
	}

	$('#btn_save_edt').click(function() {
		var link_Save = '<?= base_url() . 'dashboard/updateDtl' ?>';

		var new_stat_prod = $('#stat_produksi').val();
		var id_proj = $('#edt_id_project').val();


		var is_valid = false;

		if (new_stat_prod != '') {
			is_valid = true;
		} else {
			is_valid = false;
		}

		if (is_valid) {
			var form = $('#frm_edtStat');
			var data = form.serializeArray();
			console.log(data);
			var formHtml = form[0];
			var NewData = new FormData(formHtml);

			$.ajax({
				url: link_Save,
				type: "POST",
				data: NewData,
				dataType: "JSON",
				contentType: false,
				cache: false,
				processData: false
			}).done(function(response) {
				if (response.success) {
					Swal.fire({
						icon: 'success',
						title: 'Berhasil',
						text: response.msg,
					});
					$('#editDtlModal').modal('hide');
					getDetail(id_proj);
					// location.reload();
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Gagal',
						text: response.msg,
					});
				}
			});
		}

	});

	$('#btn_save_cek').click(function() {
		var link_Save = '<?= base_url() . 'dashboard/updateCek' ?>';

		var new_stat_cek = $('#stat_pengecekan').val();
		var id_proj = $('#cek_id_project').val();

		var is_valid = false;

		if (new_stat_cek != '') {
			is_valid = true;
		} else {
			is_valid = false;
		}


		if (is_valid) {

			var form = $('#frm_edtcek');
			var data = form.serializeArray();
			console.log(data);
			var formHtml = form[0];
			var NewData = new FormData(formHtml);

			$.ajax({
				url: link_Save,
				type: "POST",
				data: NewData,
				dataType: "JSON",
				contentType: false,
				cache: false,
				processData: false
			}).done(function(response) {
				if (response.success) {
					Swal.fire({
						icon: 'success',
						title: 'Berhasil',
						text: response.msg,
					});
					$('#cekDtlModal').modal('hide');
					getDetail(id_proj);
					// location.reload();
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Gagal',
						text: response.msg,
					});
				}
			});
		}

	});
</script>