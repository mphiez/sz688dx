<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
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

</head>
<body class="hold-transition register-page"  style="background-size: 1500px;background-image: url(<?=base_url()?>assets/view.jpg);">
<div class="register-box" style="margin: 3% auto;
}">
  
  

  
  <div class="register-box-body">
	<div class="register-logo">
		<a href="<?=base_url()?>index2.html"><img src="<?=base_url()?>assets/banner.jpg" width="80%" height="80%"></a>
	</div>
    <p class="login-box-msg">Register a new membership</p>
	<form action="#" method="post" id="acc-submit">
	
		<input type="hidden" id="csrf" value="<?php echo($csrf); ?>">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="User name" id="user_name">
        <span class="fa fa-key form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Full name" id="fullname">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Company Name" id="company">
        <span class="fa fa-hospital-o form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <textarea class="form-control" placeholder="Address" id="address"></textarea>
        <span class="glyphicon glyphicon-home form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" id="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" id="repassword">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox">
            <label>
              <input type="checkbox" id="terms"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" id="acc-save" class="btn btn-primary btn-block btn-flat"><i></i> Register</button>
        </div>
        <!-- /.col -->
      </div>
	</form>

    <a href="<?php echo base_url()?>" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

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
  
	$(document).ready(function(){
        
        $("#acc-save").click(function(e){
			save();
        });
        
		function save(){
			var btn = $("#acc-save");
			if(btn.hasClass('disabled')){
                return false;
            }
			
			if($('#user_name').val() == ''){
				alert('Silahkan isi username');
				return false;
			}else if($('#fullname').val() == ''){
				alert('Silahkan isi nama lengkap');
				return false;
			}else if($('#company').val() == ''){
				alert('Silahkan isi perusahaan');
				return false;
			}else if($('#address').val() == ''){
				alert('Silahkan isi alamat');
				return false;
			}else if($('#email').val() == ''){
				alert('Silahkan isi email');
				return false;
			}else if($('#password').val() == ''){
				alert('Silahkan isi password');
				return false;
			}else if($('#repassword').val()==''){
				alert('Silahkan isi kembali password');
				return false;
			}else if($('#password').val() != $('#repassword').val()){
				alert('Password tidak sama');
				return false;
			}
			

			var data = {
				"username": $("#user_name").val(),
				"fullname": $("#fullname").val(),
				"company": $("#company").val(),
				"address": $("#address").val(),
				"password": $("#password").val(),
				"email": $("#email").val(),
				"csrf": $("#csrf").val()
			};
			$.ajax({
				url: '<?php echo base_url(); ?>index.php/register/save',
				type: "POST",
				data: {
					guid : 0,
					code : 0,
					data : JSON.stringify(data)
				},
				beforeSend:function() {
					btn.find('i').addClass('fa fa-circle-o-notch fa-spin');
					btn.addClass('disabled');
				},
				success: function(result) {
					var result = JSON.parse(result);
					if(result.code == 0){
						alert('Registrasi berhasil !');
						location.replace("<?php echo base_url()?>");
						btn.find('i').removeClass('fa fa-circle-o-notch fa-spin');
						btn.removeClass('disabled');
					} else {
						alert('Registrasi gagal !');
						btn.find('i').removeClass('fa fa-circle-o-notch fa-spin');
						btn.removeClass('disabled');
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert('Conection Error');
					btn.find('i').removeClass('fa fa-circle-o-notch fa-spin');
					btn.removeClass('disabled');
				}
			});
		};
	});
</script>
</body>
</html>
