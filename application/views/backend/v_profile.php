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
					<h1 class="m-0">Profile</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Profile</li>
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
							<h5 class="card-title">Data Profile</h5>
						</div>
						<div class="card-body">

							<form class="form-horizontal" id="frm_profile">

								<div class="form-group row">
									<label for="input_name" class="col-sm-2 col-form-label">Nama Lengkap</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="input_name" name="input_name" placeholder="Nama Lengkap" value="<?= $profile['nama'] ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="input_tempat_lahir" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>

									<div class="col-8 row">
										<div class="col-sm-4">
											<input type="text" class="form-control" id="input_tempat_lahir" name="input_tempat_lahir" placeholder="Tempat Lahir" value="<?= $profile['tempat_lahir']; ?>" readonly>
										</div>
										<div class="col-sm-3">
											<input type="date" class="form-control" id="input_tanggal_lahir" name="input_tanggal_lahir" placeholder="Tanggal Lahir" value="<?= $profile['tgl_lahir']; ?>" readonly>
										</div>
									</div>

								</div>

								<div class="form-group row">
									<label for="input_nik" class="col-sm-2 col-form-label">NIK</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="input_nik" placeholder="NIK" value="<?= $profile['nik']; ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="input_alamat" class="col-sm-2 col-form-label">Alamat</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="input_alamat" name="input_alamat" placeholder="Alamat" value="<?= $profile['alamat']; ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="input_email" class="col-sm-2 col-form-label">Email</label>
									<div class="col-sm-8">
										<input type="email" class="form-control" id="input_email" placeholder="Email" value="<?= $profile['email']; ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="input_no_telp" class="col-sm-2 col-form-label">No Telepon</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="input_no_telp" name="input_no_telp" placeholder="No Telepon" value="<?= $profile['no_telp']; ?>" readonly>
									</div>
								</div>

							</form>

						</div>

						<div class="card-footer">
							<button type="button" class="btn btn-primary" id="btn_edit">Edit</button>
							<button type="button" class="btn btn-success" id="btn_save" hidden>Save</button>
						</div>

					</div><!-- /.card -->
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


	function set_editable(is_edit = false) {
		var btn_txt = $('#btn_edit').text();
		var btn_save = $('#btn_save');

		var input_name = $('#input_name');
		var input_tempat_lahir = $('#input_tempat_lahir');
		var input_tanggal_lahir = $('#input_tanggal_lahir');
		var input_nik = $('#input_nik');
		var input_alamat = $('#input_alamat');
		var input_email = $('#input_email');
		var input_no_telp = $('#input_no_telp');

		if (is_edit) {
			input_name.prop('readonly', false);
			input_tempat_lahir.prop('readonly', false);
			input_tanggal_lahir.prop('readonly', false);
			input_alamat.prop('readonly', false);
			input_no_telp.prop('readonly', false);
			if (input_nik.val() == '') {
				input_nik.prop('readonly', false);
			}
			// input_email.prop('readonly', false);
			btn_save.prop('hidden', false);
			btn_txt = 'Cancel';
			$('#btn_edit').removeClass('btn-primary');
			$('#btn_edit').addClass('btn-danger');
		} else {
			input_name.prop('readonly', true);
			input_tempat_lahir.prop('readonly', true);
			input_tanggal_lahir.prop('readonly', true);
			input_alamat.prop('readonly', true);
			input_no_telp.prop('readonly', true);
			// if (input_nik.val() != '') {
				input_nik.prop('readonly', true);
			// }
			// input_email.prop('readonly', true);
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
		var link_profile = '<?= base_url() . 'backend/profile/update'; ?>';

		var form = $('#frm_profile');
		var data = form.serializeArray();
		var formHtml = form[0];
		var NewData = new FormData(formHtml);

		var input_nik = $('#input_nik');

		if(!input_nik.prop('readonly')){
			NewData.append('input_nik', input_nik.val());
		}

		$.ajax({
			url: link_profile,
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

				set_editable(false);

			} else {
				Toast.fire({
					icon: 'error',
					title: response.msg
				});
			}
		});
	});
</script>
