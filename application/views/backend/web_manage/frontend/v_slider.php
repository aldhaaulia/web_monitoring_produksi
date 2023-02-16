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
					<h1 class="m-0">Slider</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Web Management</a></li>
						<li class="breadcrumb-item"><a href="#">Frontend</a></li>
						<li class="breadcrumb-item active">Slider</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Modal -->
	<div class="modal fade" id="md_add" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Tambah Data</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<form class="form" method="post" id="frm_add">
						<input type="hidden" name="input_id" id="input_id">

						<div class="form-group">
							<label for="input_title">Title</label>
							<input type="text" name="input_title" id="input_title" class="form-control">
						</div>

						<div class="form-group">
							<label for="input_subtitle">Subitle</label>
							<input type="text" name="input_subtitle" id="input_subtitle" class="form-control">
						</div>

						<div class="form-group">
							<label for="input_desc">Desc</label>
							<input type="text" name="input_desc" id="input_desc" class="form-control">
						</div>

						<div class="form-group">
							<label for="file_image">Image</label>
							<input type="file" name="file_image" id="file_image" class="form-control">
						</div>

					</form>

				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-primary" id="btn_add_save">Simpan</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /. Modal -->

	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-lg-12">

					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title">List Berkas</h5>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" title="Tambah Data" onclick="popUpMdl();"> <i class="fas fa-plus"></i> </button>
							</div>
						</div>
						<div class="card-body">

							<div class="table-responsive">
								<table class="table" id="tbl_slider" style="width: 100%;">
									<thead>
										<tr>
											<th style="text-align: center;">No.</th>
											<th style="text-align: center;">Title</th>
											<th style="text-align: center;">Subtitle</th>
											<th style="text-align: center;">Desc</th>
											<th style="text-align: center;">Image</th>
											<th style="text-align: center;">Status</th>
											<th style="text-align: center;">Action</th>
										</tr>
									</thead>
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

<script>
	var Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});

	var tbl_slider = $('#tbl_slider').DataTable({
		initComplete: function() {
			var api = this.api();
			$('#tbl_slider input')
				.off('.DT')
				.on('input.DT', function() {
					api.search(this.value).draw();
				});
		},
		oLanguage: {
			sProcessing: "loading..."
		},
		"processing": true,
		"serverSide": true,
		"destroy": true,
		ajax: {
			url: base_url + 'backend/web_manage/slider_list',
			type: "POST",
			data: function(data) {
				//   data.table = tableData;
			}
		},
		"columns": [{
				"data": null,
				"width": "10%",
				"sortable": false,
				render: function(data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
			{
				data: "title"
			},
			{
				data: "subtitle"
			},
			{
				data: "desc"
			},
			{
				data: "image"
			},
			{
				data: "status"
			},
			{
				data: "act"
			}
		],
		columnDefs: [{
			"className": "dt-center",
			"targets": [0, 4, 5, 6]
		}, ]
	});

	function save() {

		var link_ = base_url + 'backend/web_manage/slider_save';
		var mdl = $('#md_add');
		var form = $('#frm_add');
		var data = form.serializeArray();
		var formHtml = form[0];
		var NewData = new FormData(formHtml);

		// NewData.append('id', data.id);

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

				tbl_slider.ajax.reload();
				mdl.modal('hide');
			} else {
				Toast.fire({
					icon: 'error',
					title: response.msg
				});
			}
		});

		return false;
	}


	function popUpMdl(data = '') {
		var mdl = $('#md_add');

		var modal_title = mdl.find('.modal-title');

		var input_id = $('#input_id');

		if (data.id) {
			input_id.val(data.id);
			modal_title.text('Ubah Data');
		} else {
			modal_title.text('Tambah Data');
		}



		mdl.modal('show');

	}

	function set_status(data) {
		if (data) {
			var link_ = base_url + 'backend/web_manage/slider_update';
			var NewData = new FormData();
			NewData.append('id', data.id);
			NewData.append('status', data.status);

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

					tbl_slider.ajax.reload();

				} else {
					Toast.fire({
						icon: 'error',
						title: response.msg
					});
				}
			});
		}
		return false;
	}

	async function getData(id) {
		var link_ = base_url + 'backend/web_manage/slider_getByid';
		var NewData = new FormData();
		var data;
		NewData.append('id', id);

		return $.ajax({
			url: link_,
			type: "POST",
			data: NewData,
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false
		}).then(function(response) {
			if (response.success) {
				data =  response.data;
				return data;
			}
		});
	}

	$('#md_add').on('show.bs.modal', async function(e) {
		var input_id = $('#input_id');
		var input_title = $('#input_title');
		var input_subtitle = $('#input_subtitle');
		var input_desc = $('#input_desc');

		var id_val = input_id.val();

		if (id_val != '') {

			var temp_data = await getData(id_val);

			console.log(temp_data);

			if (temp_data) {

				input_title.val(temp_data.title);
				input_subtitle.val(temp_data.subtitle);
				input_desc.val(temp_data.desc);
			}
		} else {
			input_title.val("");
			input_subtitle.val("");
			input_desc.val("");
		}

	});

	$('#md_add').on('hide.bs.modal', function(e) {

		var input_title = $('#input_title');
		var input_subtitle = $('#input_subtitle');
		var input_desc = $('#input_desc');

		input_title.val("");
		input_subtitle.val("");
		input_desc.val("");

	});

	$('#btn_add_save').on('click', function(e) {
		save();
	});
</script>
