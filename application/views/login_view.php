<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin | Log in</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet"
		href="<?php echo base_url(); ?>assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet"
		href="<?php echo base_url(); ?>assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/dist/css/AdminLTE.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/plugins/iCheck/square/blue.css">

</head>

<body class="hold-transition login-page" style="background : url (../img/gi.jpg)">
	<div class="login-box">
		<div class="login-logo">
		<h1 style="color:Black;">Garuda Indonesia</h1>
		</div>

		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">
				Please Sign In
			</p>
			<form action="<?php echo base_url('login/auth'); ?>" method="post">
				<?php echo $this->session->flashdata('msg');?>
				<div class="form-group has-feedback">
					<input type="text" class="form-control" placeholder="Username" name="username" required>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Password" name="password" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
        <div class="row">
				<!-- <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div> --> <br>
				<div class="col-xs-offset-4 col-xs-4">
					<button type="submit" class="btn btn-primary btn-block">Sign In</button>
				</div>
      </div>
			</form>
		</div>
	</div>

  <script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url(); ?>assets/AdminLTE/plugins/jQueryUI/jquery-ui.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url(); ?>assets/AdminLTE//bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/AdminLTE/dist/js/adminlte.min.js"></script>
</body>

</html>
