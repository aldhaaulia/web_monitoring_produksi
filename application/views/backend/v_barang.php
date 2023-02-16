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
					<h1 class="m-0">Barang</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">List Barang</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-lg-12">

					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title">Barang</h5>
						</div>
						<div class="card-body">

                            <form class="form" method="post" id="frm_barang">
								<div class="form-group">
									<label for="input_barang_id">Barang Id</label>
									<input type="text" name="input_barang_id" id="input_barang_id" class="form-control">
								</div>

								<div class="form-group">
									<label for="input_nama_barang">Nama Barang</label>
									<input type="text" name="input_nama_barang" id="input_nama_barang" class="form-control">
								</div>

                                <div class="form-group">
									<label for="input_jenis_barang">Jenis Barang</label>
									<input type="text" name="input_jenis_barang" id="input_jenis_barang" class="form-control">
								</div>

                                <div class="form-group">
									<label for="input_ukuran_barang">Ukuran Barang</label>
									<input type="text" name="input_ukuran_barang" id="input_ukuran_barang" class="form-control">
								</div>
							</form>

						</div>
						<div class="modal-footer justify-content-between">
							<button type="submit" class="btn btn-primary" id="btn_save">Add</button>
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

    var tbl_barang = $('#tbl_barang').DataTable({
		initComplete: function() {
			var api = this.api();
			$('#tbl_barang')
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
			url: base_url + 'backend/v_barang',
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
				data: "barang_id"
			},
			{
				data: "nama_barang"
			},
			{
				data: "jenis_barang"
			},
			{
				data: "ukuran_barang"
			},
		],
		columnDefs: [{
			"className": "dt-center",
			"targets": [0, 4, 5, 6]
		}, ]
	});

	function save() {

		var link_ = base_url + 'barang/save';
		var form = $('#frm_barang');
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
				window.location.reload();
			} else {
				Toast.fire({
					icon: 'error',
					title: response.msg
				});
			}
		});

		return false;
	}

	function set_editable(is_edit = false) {
		var btn_txt = $('#btn_edit').text();
		var btn_save = $('#btn_save');

		var input_barang_id = $('#input_barang_id');
		var input_barang_nama = $('#input_barang_nama');
        var input_jenis_barang = $('#input_jenis_barang');
		var input_ukuran_barang = $('#input_ukuran_barang');
		

		if (is_edit) {
            input_barang_id.prop(false);
            input_barang_nama.prop(false);
			input_jenis_barang.prop(false);
            input_ukuran_barang.prop(false);

			btn_save.prop('hidden', false);
			btn_txt = 'Cancel';
			$('#btn_edit').removeClass('btn-primary');
			$('#btn_edit').addClass('btn-danger');
		} else {
			input_barang_id.prop(true);
            input_barang_nama.prop(true);
			input_jenis_barang.prop(true);
            input_ukuran_barang.prop(true);

			btn_save.prop('hidden', true);
			btn_txt = 'Edit';
			$('#btn_edit').removeClass('btn-danger');
			$('#btn_edit').addClass('btn-primary');
		}

		$('#btn_edit').text(btn_txt);
	}

	$('#btn_edit').on('click', function(e) {
		var btn_txt = $(this).text();
		if (btn_txt == 'Edit') {
			set_editable(true);
		} else {
			set_editable(false);
		}
	});

	$('#btn_save').on('click', function(e) {
		save();
	});
</script>
