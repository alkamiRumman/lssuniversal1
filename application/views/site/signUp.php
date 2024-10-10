<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= SHORTNAME ?> | Sign Up</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="icon" href="<?= base_url('images/favicon.png') ?>" type="image/x-icon"/>
	<link rel="stylesheet"
		  href="<?= base_url('assets/adminLte/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet"
		  href="<?= base_url('assets/adminLte/bower_components/font-awesome/css/font-awesome.min.css') ?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?= base_url('assets/adminLte/bower_components/Ionicons/css/ionicons.min.css') ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/adminLte/dist/css/AdminLTE.min.css') ?>">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?= base_url('assets/adminLte/plugins/iCheck/square/blue.css') ?>">
	<!-- Google Font -->
	<link rel="stylesheet"
		  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" type="text/css"
		  href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body class="hold-transition login-page"
	  style="background-image: url('<?= base_url('images/background.png') ?>'); background-size: cover; background-position: center center; background-repeat: no-repeat; min-height: 100vh; margin: 0; padding: 0;">
<div class="login-box">
	<div class="login-logo">
		<img src="<?= base_url('images/3.png') ?>" height="105" style="margin-top: 0">
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body" style="border: 2px solid #605CA8;border-radius: 25px;">
		<p class="login-box-msg">Register a new vendor account</p>

		<form action="<?= login_url('register') ?>" method="post">
			<div class="form-group has-feedback">
				<input type="text" name="name" class="form-control" placeholder="Full name" required>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="text" name="businessName" class="form-control" placeholder="Business name" required>
				<span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="email" class="form-control" name="username" id="username" placeholder="Business Email" required>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="password" id="password" minlength="3"
					   placeholder="Password" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" id="password1" class="form-control" placeholder="Retype password" required>
				<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
			</div>
			<a href="<?= login_url('index') ?>" class="text-center">I already have an account</a>
			<div class="row">
				<div class="col-xs-4 pull-right">
					<button id="submit" type="submit" style="background-color: black; color: white" class="btn btn-block btn-flat">
						Register
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<style>
	body {
		overflow-y: hidden !important;
		overflow-x: hidden !important;
		background-size: cover;
		background-position: center center;
		min-height: 100vh; /* Ensures the body takes up the full height of the viewport */
		margin: 0;
		padding: 0;
	}

	.login-box {
		margin-top: 2%;
		/*margin: auto;*/
	}
</style>

<script src="<?= base_url('assets/adminLte/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src=" <?= base_url('assets/adminLte/plugins/iCheck/icheck.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
	setTimeout(function () {
		$('.alert').hide('fast');
	}, 3000);
	toastr.options = {
		"debug": false,
		"positionClass": "toast-bottom-right",
		"onclick": null,
		"fadeIn": 300,
		"fadeOut": 1000,
		"timeOut": 5000,
		"extendedTimeOut": 1000
	}
	<?php if($this->session->flashdata('success')){ ?>
	toastr.success("<?php echo $this->session->flashdata('success'); ?>");
	<?php }else if($this->session->flashdata('danger')){  ?>
	toastr.error("<?php echo $this->session->flashdata('danger'); ?>");
	<?php }else if($this->session->flashdata('warning')){  ?>
	toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
	<?php }else if($this->session->flashdata('info')){  ?>
	toastr.info("<?php echo $this->session->flashdata('info'); ?>");
	<?php } ?>
	$(function () {
		var checkEmail = 0;
		$('#username').on('keyup', function () {
			var email = $('#username').val();
			if (email != '') {
				$.ajax({
					url: "<?php echo login_url('fetch_email'); ?>",
					method: "POST",
					data: {email: email},
					success: function (data) {
						if (data == 1) {
							checkEmail = 1;
						} else {
							checkEmail = 0;
						}
					}
				});
			}
		});

		var statusEdit = 0;
		$('#password, #password1').on('input', function () {
			var password = $('#password').val();
			if (password == $('#password1').val()) {
				statusEdit = 0;
			} else {
				statusEdit = 1;
			}
		});
		$('#submit').on('click', function (e) {
			if (statusEdit == 1) {
				toastr.warning('Password doesn\'t match!');
				e.preventDefault();
			}
			if (checkEmail == 1) {
				toastr.error('Email already exist!');
				e.preventDefault();
			}
		});
	});
</script>
</body>
</html>
