<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Monitoring Produksi | Halaman Registrasi</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('assets/backend'); ?>/plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?= base_url('assets/backend'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/backend'); ?>/dist/css/adminlte.min.css">

	<link rel="stylesheet" href="<?= base_url('assets/backend'); ?>/plugins/sweetalert2/sweetalert2.min.css">
</head>

<body class="hold-transition register-page">

<div class="modal fade" id="mdl_box" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Informasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Unduh Berkas Pendaftaran</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-primary" id="btn_unduh">Unduh</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

	<div class="register-box">
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="#" class="h1">Monitoring Produksi</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Registrasi Akun</p>

				<form id="frm_register" method="post">

					<div class="input-group mb-3">
						<input type="text" class="form-control" name="full_name" placeholder="Nama Lengkap" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>

					<div class="input-group mb-3">
						<input type="email" class="form-control" name="email" placeholder="Email" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>

					<div class="input-group mb-3">
						<input type="password" class="form-control" name="pass" placeholder="Password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>

					<div class="input-group mb-3">
						<input type="password" class="form-control" name="pass_confirm" placeholder="Retype password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>

					<div class="row">
						<!-- /.col -->
						<div class="col-12">
							<button type="button" class="btn btn-primary btn-block" id="btn_register">Register</button>
						</div>
						<!-- /.col -->
					</div>
				</form>

				<br>
				<a href="<?= base_url('login'); ?>" class="text-center">Sudah memiliki akun?</a>

			</div>
			<!-- /.form-box -->
		</div><!-- /.card -->
	</div>
	<!-- /.register-box -->

	<!-- jQuery -->
	<script src="<?= base_url('assets/backend'); ?>/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url('assets/backend'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url('assets/backend'); ?>/dist/js/adminlte.min.js"></script>
	<script src="<?= base_url('assets/backend'); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>

<script>
	var Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});


	$('#btn_unduh').on('click', function(e) {
		window.location.href = '<?= base_url(); ?>' + "register/unduh/biodata";
		return false;
	});

	$('#btn_register').on('click', function(e) {
		e.preventDefault();
		var link = '<?= base_url() . 'register/proses_daftar'; ?>';

		var form = $('#frm_register');
		var data = form.serializeArray();
		var formHtml = form[0];
		var NewData = new FormData(formHtml);

		$.ajax({
			url: link,
			type: "POST",
			data: NewData,
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false
		}).done(function(response) {
			if (response.success) {
				// redirect
				// window.location.reload();

				Toast.fire({
					icon: 'success',
					title: response.msg
				});

				popup();
			} else {
				Toast.fire({
					icon: 'error',
					title: response.msg
				});
			}
		});
	});

	function popup(){
		var mdl = $('#mdl_box');
		mdl.modal('show');
	}

</script>
