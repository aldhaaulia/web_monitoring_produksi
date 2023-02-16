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
					<h1 class="m-0">About</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Web Management</a></li>
						<li class="breadcrumb-item"><a href="#">Frontend</a></li>
						<li class="breadcrumb-item active">About</li>
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
							<h5 class="card-title">About</h5>
						</div>
						<div class="card-body">

							<form class="form" id="frm_about">
								<div class="form-group">
									<label for="input_title">Title</label>
									<input type="text" name="input_title" id="input_title" class="form-control" value="<?= $setting['about_school_title']; ?>" readonly>
								</div>

								<div class="form-group">
									<label for="input_desc">Desc</label>
									<textarea name="input_desc" id="input_desc" class="form-control" style="resize: vertical;" readonly><?= $setting['about_school_desc']; ?></textarea>
								</div>

								<div class="form-group">
									<label for="file_image">Image</label>

									<img class="img-fluid" src="<?= $setting['about_school_image']; ?>" alt="Image About" style="width:200px;">
									<br>

									<input type="file" name="file_image" id="file_image" class="form-control" readonly disabled>
								 </div>
							</form>

						</div>
						<div class="card-footer">
							<button type="button" class="btn btn-primary" id="btn_edit">Edit</button>
							<button type="button" class="btn btn-success" id="btn_save" hidden>Simpan</button>
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

	function save() {

		var link_ = base_url + 'backend/web_manage/about_save';
		var form = $('#frm_about');
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

		var input_title = $('#input_title');
		var input_desc = $('#input_desc');
		var file_image = $('#file_image');


		if (is_edit) {
			input_title.prop('readonly', false);
			input_desc.prop('readonly', false);
			file_image.prop('readonly', false);
			file_image.prop('disabled', false);

			btn_save.prop('hidden', false);
			btn_txt = 'Cancel';
			$('#btn_edit').removeClass('btn-primary');
			$('#btn_edit').addClass('btn-danger');
		} else {
			input_title.prop('readonly', true);
			input_desc.prop('readonly', true);
			file_image.prop('readonly', true);
			file_image.prop('disabled', true);

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
