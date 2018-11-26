<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ForestCode - Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="shortcut icon" href="<?=base_url()?>assets/icon.ico" type="image/x-icon" /> 
  <link rel="stylesheet" href="<?=base_url()?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>dist/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
	label {
		font-weight: unset;
	}
  </style>
</head>
<body class="hold-transition login-page"  style="background-image: url(<?=base_url()?>assets/hijau.jpg);">
<div class="login-box" style='background-color:white;'>
  <div class="login-logo" style="padding:20px 0px 0px 0px;margin-bottom:0px;">
    <a href="<?=base_url()?>index2.html"><img src="<?=base_url()?>assets/banner.jpg" width="80%" height="80%"></a>
	<div style="padding:0px 10% 0px 10%;">
	<label style="font-weight: 1;font-size:12px" class="pull-left">Nice Laundry V.1.0</label>
	<label style="font-weight: 1;font-size:12px" class="pull-right">Powered By Forest-Code.com</label>
	</div>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body content" style='background: white; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(white, #d1dd12); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(white, #d1dd12); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(white, #d1dd12); /* For Firefox 3.6 to 15 */
    background: linear-gradient(white, #d1dd12); /* Standard syntax */'>
    <p class="login-box-msg"><h3>Login Here</h3></p>

    <form action="<?=base_url()?>index.php/login/login_check_laundry" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name='pn_name' placeholder="User Name">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name='pn_pass' class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="#" style="color:white">I forgot my password</a><br>
    <a href="register.html" class="text-center" style="color:white">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?=base_url()?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url()?>bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url()?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
