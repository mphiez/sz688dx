<?php $this->load->view('header');?>
    <section class="content-header">
      <h1>
       <?=$judul?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$judul?></li>
      </ol>
    </section>
	<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$judul?></h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
			<form method='post' id="submit_btn" action="<?=base_url().'index.php/setup/proses_add_user';?>">
				<div class="form-group col-lg-6"  id="c_user_id">
                  <label class="control-label" for="inputSuccess">User Id</label>
                  <input type="text" class="form-control" id="user_id" name='pn_id' value="Automatic" readonly>
                </div>
				<div class="form-group col-lg-6"  id="c_user_name">
                  <label class="control-label" for="inputSuccess">User Name</label>
                  <input type="text" class="form-control" id="user_name" name='pn_uname' placeholder="Masukan user name " value="">
                </div>
				<div class="form-group col-lg-6"  id="c_name">
                  <label class="control-label" for="inputSuccess">Nama</label>
                  <input type="text" class="form-control" id="name" name='pn_name' placeholder="Masukan nama " value="">
                </div>
				<div class="form-group  col-lg-6">
                  <label class="control-label" for="inputSuccess"> Alamat</label>
                  <input type="text" class="form-control" id="alamat" name='alamat' placeholder="Masukan Alamat ..." value="">
                </div>
				<div class="form-group  col-lg-6">
                  <label class="control-label" for="inputSuccess"> Nomor Handphone</label>
                  <input type="text" class="form-control" id="hp" name='hp' placeholder="Masukan Nomor Handphone ..." value="">
                </div>
				<div class="form-group  col-lg-6">
                  <label class="control-label"> Email</label>
                  <input type="text" class="form-control" id="email" name='email' placeholder="Masukan Email ..." value="">
                </div>
				<div class="form-group col-lg-6">
                  <label class="control-label" for="inputSuccess">Marketing</label>
                  <select name="marketing" class="form-control">
					<option value="Y">Yes</option>
					<option value="N" selected>No</option>
				  </select>
                </div>
				<div class="form-group col-lg-6"  id="c_jabatan">
                  <label class="control-label" for="inputSuccess">Jabatan</label>
				  <select class="form-control" id="jabatan" name='pn_jabatan'>
					<?php
						echo "<option value=''>Pilih Jabatan</option>";
						foreach($list_jabatan as $row1){
							echo "<option value='".$row1->id."'>".$row1->nm_jabatan."</option>";
						}
					?>
				  </select>
                </div>
				<div class="form-group col-lg-6"  id="c_">
                  <label class="control-label" for="inputSuccess">Cabang</label>
				  <select class="form-control" id="cabang" name='pn_wilayah'>
					<?php
						foreach($list_cabang as $row2){
							if($row2->id){
								echo "<option value='".$row2->cabang."' selected>".$row2->nm_cabang."</option>";
							}else{
								echo "<option value='".$row2->cabang."'>".$row2->nm_cabang."</option>";
							}
						}
					?>
				  </select>
                </div>
				<div class="form-group col-lg-6"  id="c_">
                  <label class="control-label" for="inputSuccess">Akses</label>
				  <select class="form-control" id="inputSuccess" name='pn_akses'>
					<option value='0' selected>Non-Aktif</option>
					<option value='1' selected>Aktif</option>
				  </select>
                </div>
				<div class="form-group col-lg-6"  id="c_password">
                  <label class="control-label">Password</label>
                  <input type="password" class="form-control" id="password" name='pn_pass' placeholder="Masukan password " value="">
                </div>
				<div class="form-group col-lg-6"  id="c_password">
                  <label class="control-label" for="inputSuccess">Password</label>
                  <input type="password" class="form-control" id="re_password" name='re_pn_pass' placeholder="Masukan password " value="">
                </div>
				<div class="form-group btn-group col-lg-12"></div>
					<div class="form-group col-lg-12"  id="c_">
					<p type="submit" class='pull-right btn btn-success' onClick="return check();">Save</p>
					<a href="<?=base_url().'index.php/setup/setup_akses'?>"><button class="pull-right btn btn-default">Cancel</button></a>
				</div>
			</form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
	
<?php $this->load->view('footer');?>
<script>
function check(){
	if($("#user_id").val() == ''){
		alert('User ID tidak boleh kosong');
		document.getElementById("user_id").focus();
		return false;
	} else if($("#user_name").val() == ''){
		alert('Silahkan isi user name');
		document.getElementById("user_name").focus();
		return false;
	} else if($("#name").val() == ''){
		alert('Silahkan isi Nama');
		document.getElementById("name").focus();
		return false;
	} else if($("#email").val() == ''){
		alert('Silahkan isi email');
		document.getElementById("email").focus();
		return false;
	} else if($("#alamat").val() == ''){
		alert('Silahkan isi alamat');
		document.getElementById("alamat").focus();
		return false;
	} else if($("#hp").val() == ''){
		alert('Silahkan isi nomor handphone');
		document.getElementById("hp").focus();
		return false;
	}else if($("#jabatan").val() == ''){
		alert('Silahkan pilih jabatan');
		document.getElementById("jabatan").focus();
		return false;
	} else if($("#password").val() == ''){
		alert('Silahkan ketik ulang password');
		document.getElementById("password").focus();
		return false;
	} else if($("#password").val() != $("#re_password").val()){
		alert('Password tidak sama');
		document.getElementById("jabatan").focus();
		return false;
	}else{
		$.ajax({
			url: '<?php echo base_url()?>index.php/setup/check_user',
			method: 'POST',
			data: {
				username: $("#user_name").val()
			},
			success:function(datax){
				if(datax == 0){
					$('#submit_btn').submit();
				}else{
					alert('Username sudah digunakan !');
					return false;
				}
				
			}
		});
	}
}
</script>