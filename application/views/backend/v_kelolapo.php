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
					<h1 class="m-0">Kelola PO</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="">Home</a></li>
						<li class="breadcrumb-item active">Kelola PO</li>
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
							<h5 class="card-title">Kelola PO</h5>
						</div>
						<div class="card-body">

							<form class="form" method="post" id="frm_project">

								<input type="hidden" name="id_cust" id="id_cust">

								<div class="form-group row">
									<label for="project_id" class="col-sm-2 col-form-label">Project ID</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" id="project_id" name="project_id" placeholder="Project ID" value="<?= $proj_id ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="project_date" class="col-sm-2 col-form-label">Project Due Date</label>
									<div class="col-sm-5">
										<input type="date" class="form-control" id="project_date" name="project_date" placeholder="Project Due Date">
									</div>
								</div>

								<div class="form-group row">
									<label for="nama_cust" class="col-sm-2 col-form-label">Nama Customer</label>
									<div class="col-sm-3">
										<input class="form-control" id="nama_cust" placeholder="Ketik untuk cari Customer Name">
									</div>
									<button type="button" class="btn btn-primary col-sm-2" data-toggle="modal" data-target="#customerModal" id="new_cust">Tambah Customer Baru</button>
								</div>

								<div class="form-group row">
									<label for="input_jenis_pekerjaan" class="col-sm-2 col-form-label">Jenis Pekerjaan</label>
									<div class="col-sm-5">
										<select name="input_jenis_pekerjaan" id="input_jenis_pekerjaan" class="form-control" style="width:100%;">
											<option hidden>--Pilih Jenis Pekerjaan--</option>
											<option value="1">Workshop</option>
											<option value="2">Pekerjaan Lain</option>
										</select>
									</div>
								</div>
							</form>

							<hr>

							<form class="form" id="frm_detail">
								<input type="hidden" name="id_jns_brg" id="id_jns_brg">
								<input type="hidden" name="id_barang" id="id_barang">

								<div id="row_jns_brg" class="form-group row">
									<label for="jenis_barang" class="col-sm-2 col-form-label">Jenis Barang</label>
									<div class="col-sm-3">
										<input class="form-control" id="jns_barang" placeholder="Ketik untuk cari Jenis Barang">
									</div>

									<button type="button" class="btn btn-primary col-sm-2" data-toggle="modal" data-target="#jenisModal" id="new_cust">Tambah Jenis</button>
								</div>

								<div class="form-group row">
									<label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
									<div class="col-md-3">
										<input type="text" class="form-control" id="nama_barang" placeholder="Ketik untuk cari Nama Barang">
									</div>
									<button type="button" class="btn btn-primary col-sm-2" data-toggle="modal" data-target="#barangModal" id="new_cust">Tambah Barang</button>
								</div>

								<div id="row_ukur_brg" class="form-group row">
									<label for="ukuran_barang" class="col-sm-2 col-form-label">Ukuran Barang</label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="ukuran_barang" name="ukuran_barang" placeholder="Ukuran Barang">
									</div>
								</div>

								<div id="row_warna_brg" class="form-group row">
									<label for="warna_barang" class="col-sm-2 col-form-label">Warna Barang</label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="warna_barang" name="warna_barang" placeholder="Warna Barang">
									</div>
								</div>

								<div class="form-group row">
									<label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
									<div class="col-md-5">
										<textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
									</div>
								</div>

							</form>

						</div>

						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-primary col-sm-2" id="btn_add">Tambah</button>
						</div>

					</div><!-- /.card -->
				</div>

			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->

	<div id="list_PO" class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-lg-12">

					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title">List Kelola PO</h5>
						</div>
						<div class="card-body">
							<form id="frm_tbl">
								<div class="table-responsive">
									<table class="table" id="tbl_detail" style="width: 100%;">
										<thead>
											<tr>
												<th style="text-align: center;">No.</th>
												<th style="text-align: center;">Project ID</th>
												<th style="text-align: center;">Customer Name</th>
												<th style="text-align: center;">Project Date</th>
												<th style="text-align: center;">Jenis Barang</th>
												<th style="text-align: center;">Nama Barang</th>
												<th style="text-align: center;">Ukuran</th>
												<th style="text-align: center;">Warna</th>
												<th style="text-align: center;">Keterangan</th>
												<th style="text-align: center;">Action</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
								</div>
							</form>
						</div>
						<div class="card-footer">
							<button type="button" class="btn btn-success col-sm-2" id="btn_save">Simpan</button>
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

<!-- Customer Modal-->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="customerModalLabel">Tambah Data Customer</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<form id="frm_new_cust" action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nama Customer</label>
							<input class="form-control" id="nama_customer_new" type="text" name="nama_customer_new" />
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button id="new_cust_save" class="btn btn-primary" type="button" data-dismiss="modal">Simpan</button>
			</div>
		</div>
	</div>
</div>

<!-- Jenis Barang Modal-->
<div class="modal fade" id="jenisModal" tabindex="-1" role="dialog" aria-labelledby="jenisModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="jenisModalLabel">Tambah Jenis Barang</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<form id="frm_new_jns" action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Jenis Barang</label>
							<input class="form-control" id="jenis_new" type="text" name="jenis_new" />
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button id="new_jns_save" class="btn btn-primary" type="button" data-dismiss="modal">Simpan</button>
			</div>
		</div>
	</div>
</div>

<!-- Nama Barang Modal-->
<div class="modal fade" id="barangModal" tabindex="-1" role="dialog" aria-labelledby="barangModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="barangModalLabel">Tambah Barang</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<form id="frm_new_brg" action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nama Barang</label>
							<input class="form-control" id="brg_new" type="text" name="brg_new" />
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button id="new_brg_save" class="btn btn-primary" type="button" data-dismiss="modal">Simpan</button>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('Backend/Parts/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>
	$(document).ready(function() {
		$("#frm_detail").hide();
		$("#list_PO").hide();
	});

	$("#input_jenis_pekerjaan").on('change', function() {
		var jns_pekerjaan = $('#input_jenis_pekerjaan').val();
		if (jns_pekerjaan == 1) {
			$("#frm_detail").show();
			$("#list_PO").show();

			$("#row_jns_brg").show();
			$("#row_ukur_brg").show();
			$("#row_warna_brg").show();

			$('#id_jns_brg').val('');
			$("#jns_barang").val('');
			$("#ukuran_barang").val('');
			$("#warna_barang").val('');
		} else {
			$("#frm_detail").show();
			$("#list_PO").show();

			$("#row_jns_brg").hide();
			$("#row_ukur_brg").hide();
			$("#row_warna_brg").hide();

			$('#id_jns_brg').val('0');
			$("#jns_barang").val('-');
			$("#ukuran_barang").val('-');
			$("#warna_barang").val('-');
		}
	});

	var Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});

	function add_detail() {
		var table = $('#tbl_detail');
		var table_body = table.find('tbody');
		var tbl_length = table_body.find('tr').length;
		var no = tbl_length + 1;
		var is_valid = false;

		var id_cust = $('#id_cust').val();
		var project_id = $('#project_id').val();
		var project_date = $('#project_date').val();
		var nama_cust = $('#nama_cust').val();

		// detail
		var id_jns_brg = $('#id_jns_brg').val();
		var id_barang = $('#id_barang').val();
		var jns_barang = $('#jns_barang').val();
		var nama_barang = $('#nama_barang').val();
		var ukuran_barang = $('#ukuran_barang').val();
		var warna_barang = $('#warna_barang').val();
		var keterangan = $('#keterangan').val();

		var txt = "";


		if (id_cust != '' && project_id != '' && project_date != '' && id_jns_brg != '' && id_barang != '' && jns_barang != '' && nama_barang != '' && ukuran_barang != '' && warna_barang != '' && keterangan != '') {
			is_valid = true;
		} else {
			is_valid = false;
		}


		if (is_valid) {

			txt += '<tr id="tr_' + no + '">';
			txt += '<td style="text-align: center;">' + no + '</td>';
			txt += '<td style="text-align: center;">' + project_id + '</td>';
			txt += '<td style="text-align: center;">' + nama_cust + '</td>';
			txt += '<td style="text-align: center;">' + project_date + '</td>';
			txt += '<td style="text-align: center;">' + jns_barang + '</td>';
			txt += '<td style="text-align: center;">' + nama_barang + '</td>';
			txt += '<td style="text-align: center;">' + ukuran_barang + '</td>';
			txt += '<td style="text-align: center;">' + warna_barang + '</td>';
			txt += '<td style="text-align: center;">' + keterangan + '</td>';
			txt += '<td style="text-align: center;">' + '<a class="btn btn-danger btn-flat" href="javascript:void(0);" title="Hapus" onclick="remove_detail(' + no + ')"> <i class="fas fa-times"></i></a>' + '</td>';
			txt += '<td hidden><input type="hidden" name="id_cust__' + no + '" value="' + id_cust + '">' + id_cust + '</td>';
			txt += '<td hidden><input type="hidden" name="project_id__' + no + '" value="' + project_id + '">' + project_id + '</td>';
			txt += '<td hidden><input type="hidden" name="project_date__' + no + '" value="' + project_date + '">' + project_date + '</td>';
			txt += '<td hidden><input type="hidden" name="id_jns_brg__' + no + '" value="' + id_jns_brg + '">' + id_jns_brg + '</td>';
			txt += '<td hidden><input type="hidden" name="id_barang__' + no + '" value="' + id_barang + '">' + id_barang + '</td>';
			txt += '<td hidden><input type="hidden" name="ukuran_barang__' + no + '" value="' + ukuran_barang + '">' + ukuran_barang + '</td>';
			txt += '<td hidden><input type="hidden" name="warna_barang__' + no + '" value="' + warna_barang + '">' + warna_barang + '</td>';
			txt += '<td hidden><input type="hidden" name="keterangan__' + no + '" value="' + keterangan + '">' + keterangan + '</td>';
			txt += '</tr>';

			table_body.append(txt);

			// reset form
			if (id_jns_brg == 0) {
				$('#id_jns_brg').val('0');
				$('#id_barang').val('');
				$("#jns_barang").val('-');
				$("#ukuran_barang").val('-');
				$("#warna_barang").val('-');
				$('#nama_barang').val('');
				$('#keterangan').val('');
			} else {
				$('#id_jns_brg').val('');
				$('#id_barang').val('');
				$('#jns_barang').val('');
				$('#nama_barang').val('');
				$('#ukuran_barang').val('');
				$('#warna_barang').val('');
				$('#keterangan').val('');
			}

			$('#project_date').attr('readonly', 'true');
			$('#nama_cust').attr('readonly', 'true');
			$('#input_jenis_pekerjaan').attr('readonly', 'true');
		} else {
			console.log('ADA FORM KOSONG');
		}


	}

	function remove_detail(id_row) {
		var table = $('#tbl_detail');
		var table_body = table.find('tbody');
		var row_table = table_body.find('#tr_' + id_row);

		if (row_table.length > 0) {
			row_table.remove();
		}

	}



	$("#nama_cust").autocomplete({
		// sugestion nama_cust
		// Create_by Putra

		// appendTo: (pluginOption.modal !== undefined ? "#" + pluginOption.modal : null), // to fix not showing when on modal
		minLength: 2,
		source: function(request, response) {
			$.ajax({
				url: '<?= base_url() . 'customer/search_Cust'; ?>',
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
			$("#nama_cust").val(dataItems.nama);
			$("#id_cust").val(dataItems.id);
			return false;
		}
	}).autocomplete("instance")._renderItem = function(ul, item) {
		return $("<li></li>").append(item.kd_cust + ' - ' + item.nama).appendTo(ul);
	};

	$("#nama_barang").autocomplete({
		// sugestion nama_barang
		// Create_by Putra

		// appendTo: (pluginOption.modal !== undefined ? "#" + pluginOption.modal : null), // to fix not showing when on modal
		minLength: 2,
		source: function(request, response) {
			$.ajax({
				url: '<?= base_url() . 'barang/search_Barang'; ?>',
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
			$("#nama_barang").val(dataItems.nama);
			$("#id_barang").val(dataItems.id);
			return false;
		}
	}).autocomplete("instance")._renderItem = function(ul, item) {
		return $("<li></li>").append(item.nama).appendTo(ul);
	};

	$("#jns_barang").autocomplete({
		// sugestion jns_barang
		// Create_by Putra

		// appendTo: (pluginOption.modal !== undefined ? "#" + pluginOption.modal : null), // to fix not showing when on modal
		minLength: 2,
		source: function(request, response) {
			$.ajax({
				url: '<?= base_url() . 'jenis_barang/search_Jns'; ?>',
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
			$("#jns_barang").val(dataItems.jenis_barang);
			$("#id_jns_brg").val(dataItems.id);
			return false;
		}
	}).autocomplete("instance")._renderItem = function(ul, item) {
		return $("<li></li>").append(item.jenis_barang).appendTo(ul);
	};

	$('#new_cust_save').click(function() {
		// simpan new_cust
		// Create_by Putra

		var link_Save = '<?= base_url() . 'Customer/save' ?>';

		var form = $('#frm_new_cust');
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
			} else {
				Swal.fire({
					icon: 'error',
					title: 'Gagal',
					text: response.msg,
				});
			}
		});
	});

	$('#new_jns_save').click(function() {
		// simpan new_jns
		// Create_by Putra

		var link_Save = '<?= base_url() . 'jenis_barang/save' ?>';

		var form = $('#frm_new_jns');
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
			} else {
				Swal.fire({
					icon: 'error',
					title: 'Gagal',
					text: response.msg,
				});
			}
		});
	});

	$('#new_brg_save').click(function() {
		// simpan barang
		// Create_by Putra

		var link_Save = '<?= base_url() . 'barang/save' ?>';

		var form = $('#frm_new_brg');
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
			} else {
				Swal.fire({
					icon: 'error',
					title: 'Gagal',
					text: response.msg,
				});
			}
		});
	});

	$('#btn_add').click(function() {
		// add detail item
		add_detail();

	});


	$('#btn_save').on('click', function(e) {
		var link_ = '<?= base_url() . 'kelolapo/save'; ?>';

		var form = $('#frm_project');
		var form_detail = $('#frm_tbl');

		var data = form.serializeArray();
		var data_detail = form_detail.serializeArray();
		var formHtml = form[0];
		var formHtml2 = form_detail[0];

		var NewData = new FormData(formHtml);
		var NewData2 = new FormData(formHtml2);

		// convert Formdata to JSON
		// var detail_object = {};
		// NewData2.forEach((value, key) => detail_object[key] = value);
		// var detail_json = JSON.stringify(detail_object);
		var detail_json = JSON.stringify(Object.fromEntries(NewData2));

		NewData.append('detail[]', detail_json);

		$.ajax({
			url: link_,
			type: "POST",
			data: NewData,
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false
		}).done(function(response) {

			if (response.success) {
				Toast.fire({
					icon: 'success',
					title: response.msg
				});

				window.location.href = '<?= base_url('dashboard'); ?>';

			} else {
				Toast.fire({
					icon: 'error',
					title: response.msg
				});
			}
		});
	});
</script>