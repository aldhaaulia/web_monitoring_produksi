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
					<h1 class="m-0">Berkas</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Web Management</a></li>
						<li class="breadcrumb-item"><a href="#">Frontend</a></li>
						<li class="breadcrumb-item active">Berkas</li>
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
							<h5 class="card-title">Berkas</h5>
						</div>
						<div class="card-body">

							<form class="form" id="frm_berkas">
							<div class="form-group">
									<label for="input_review">Berkas direview</label>
									<input type="email" name="input_review" id="input_review" class="form-control" value="<?= $setting['berkas_status_review']; ?>" readonly>
								</div>

								<div class="form-group">
									<label for="input_approve">Berkas diterima</label>
									<input type="text" name="input_approve" id="input_approve" class="form-control" value="<?= $setting['berkas_status_approved']; ?>" readonly>
								</div>

								<div class="form-group">
									<label for="input_reject">Berkas ditolak</label>
									<input type="text" name="input_reject" id="input_reject" class="form-control" value="<?= $setting['berkas_status_rejected']; ?>" readonly>
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

		var link_ = base_url + 'backend/web_manage/berkas_save';
		var form = $('#frm_berkas');
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

		var input_review = $('#input_review');
		var input_approve = $('#input_approve');
		var input_reject = $('#input_reject');


		if (is_edit) {
			input_review.prop('readonly', false);
			input_approve.prop('readonly', false);
			input_reject.prop('readonly', false);

			btn_save.prop('hidden', false);
			btn_txt = 'Cancel';
			$('#btn_edit').removeClass('btn-primary');
			$('#btn_edit').addClass('btn-danger');
		} else {
			input_review.prop('readonly', true);
			input_approve.prop('readonly', true);
			input_reject.prop('readonly', true);

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
