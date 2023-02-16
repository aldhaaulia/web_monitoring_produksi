<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PT. Kemala Cipta Selaras | Login</title>

	<!-- Favicon -->
	<link rel="icon" href="<?php echo base_url(); ?>assets/img/logo1.png" type="image/png">

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

<body class="hold-transition login-page">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a class="h1"><b>PT.</b> Kemala Cipta Selaras</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Sign In</p>

				<form id="frm_login" method="post">
					<div class="input-group mb-3">
						<input name="email" type="email" class="form-control" placeholder="Email" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input name="password" type="password" class="form-control" placeholder="Password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-12">
							<button type="button" class="btn btn-primary btn-block" onclick="login()">Sign In</button>
						</div>

						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->

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

	function login() {
		var link_login = '<?= base_url() . 'auth/login/proses_login'; ?>';

		var form = $('#frm_login');
		var data = form.serializeArray();
		var formHtml = form[0];
		var NewData = new FormData(formHtml);

		$.ajax({
			url: link_login,
			type: "POST",
			data: NewData,
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false
		}).done(function(response) {
			if (response.success) {
				// redirect
				window.location.reload();
			} else {
				Toast.fire({
					icon: 'error',
					title: response.msg
				});
			}
		});
	}
</script>