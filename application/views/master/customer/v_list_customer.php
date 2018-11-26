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
					
					<div class="col-md-4">
						<div class="form-group">
							<label>Cabang</label>
							<?php $admin = cek_admin();?>
							<select class="form-control" class="" id="cabang" onchange="return load()">
									
								<?php
									if($admin == ''){
										?>
											<option value="all">- Semua Cabang - </option>
										<?php
									}
									foreach($cabang as $row){
										if($admin == ''){
											?>
												<option value="<?php echo $row->cabang?>"><?php echo $row->nm_cabang?></option>
											<?php
										}else if($row->cabang == $this->session->userdata('pn_wilayah')){
											?>
												<option value="<?php echo $row->cabang?>"><?php echo $row->nm_cabang?></option>
											<?php
										}
										
									}
								?>
								
							</select>
						</div>
					</div>
					
					<div class="col-md-4" style="padding-top:25px">
						<div class="form-group">
							<button class="btn btn-warning" onclick="return add()"><i class="fa fa-plus"></i> Tambah Customer</button>
						</div>
					</div>
					<div class="col-md-12">
						<div class="box-body table no-padding">
						  <table class="table table-bordered table-hover dataTable" id="example">
							<thead>
								<tr>
								  <th>ID Customer</th>
								  <th>Nama Customer</th>
								  <th>Alamat</th>
								  <th>Kontak</th>
								  <th>Email</th>
								  <th>Status</th>
								  <th>Action</th>
								</tr>
							</thead>
							<tbody id=>
								
							</tbody>
						  </table>
						  <div id="show_supp"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	<div id="modal-update" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Update Data</h4>
		  </div>
		  <div class="modal-body">
			<div class="row" id="body_update">
				<div class="col-md-12">
					<div class="form-group row">
						<label class="col-sm-4">Nama Customer</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm" value="" id="cust_name_old">
							<input type="hidden" class="form-control form-control-sm" value="" id="id_old">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Alamat</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm " value="" id="alamat_old">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Email</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm " value="" id="email_old">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Nomor telpon</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm " value="" id="hp_old">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Instansi / Perusahaan</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm " value="" id="instasi_old">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Saldo</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm money" value="" id="saldo_old">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Status</label>
						<div class="col-sm-8">
							<select class="form-control" id="status_old">
								<option value="0">Used</option>
								<option value="1">Not Used</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		  </div>
		  <div class="modal-footer" id="field_update">
			<button class="btn btn-success" onclick="return do_update()" id="btn_update">Simpan</button><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  </div>
		</div>
	  </div>
	</div>
	<div id="modal-add" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Tambah Data Customer</h4>
		  </div>
		  <div class="modal-body">
			<div class="row" id="body_add">
				<div class="col-md-12">
					<div class="form-group row">
						<label class="col-sm-4">Nama Customer</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm" value="" id="cust_name">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Alamat</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm " value="" id="alamat">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Email</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm " value="" id="email">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Nomor telpon</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm " value="" id="hp">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Instansi / Perusahaan</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm " value="" id="instansi">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Saldo</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm money" value="" id="saldo">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Status</label>
						<div class="col-sm-8">
							<select class="form-control" id="status">
								<option value="0">Used</option>
								<option value="1">Not Used</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		  </div>
		  <div class="modal-footer" id="field_add">
			<button class="btn btn-success" onclick="return do_add()" id="btn_add">Simpan</button><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  </div>
		</div>
	  </div>
	</div>
	</section>
<?php $this->load->view('footer');?>
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
load();
function load(){	
	console.log($('#cabang').val());
	$("#example").dataTable({
			"processing": true,
			"ajax": {
				"url": "<?php echo base_url()?>index.php/master/get_customer",
				"type": "POST",
				data: {cabang : $('#cabang').val()},
			},
			"destroy": true,
			"oLanguage": {
				"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
			},
			"aoColumns": [
				{ "data": "id_customer"},
				{ "data": "nama_customer"},
				{ "data": "alamat"},
				{ "data": "nomor_telfon"},
				{ "data": "email"},
				{
					render: function (data, type, row, meta) {
						if(row.status == '0'){
							return "Aktif";
						}else{
							return "Non-Aktif";
						}
					}
				},
				{
					render: function (data, type, row, meta) {
						return '<button class="btn btn-warning btn-sm" onclick="return edit(&#39;'+row.id+'&#39;)"><i class="fa fa-pencil"></i> Update</button>';
					}
				}
			],
			"order": [[ 0, "asc" ]],
		});
}

function delete_record(id){
	var r = confirm("Delete Record ?");
	if (r == true) {
		$.ajax({
			url: '<?php echo base_url()?>index.php/master/delete_customer',
			beforeSend: function( xhr ) {
				document.getElementById('field_update').innerHTML = '<button class="btn btn-success" id="btn_update"><i class="fa fa-refresh"></i>Simpan</button>';
			},
			method: 'POST',
			data: {
				id_customer : id
			},
			success:function(datax){
				if(datax.code == 0){
					alert('Delete Success');
				}else{
					alert('Delete Failer');
				}
				document.getElementById('field_update').innerHTML = '<button class="btn btn-success" onclick="return do_update()" id="btn_update">Simpan</button>';
				load();
		   }
		});
	}
}

function edit(id){
	$.ajax({
		url: '<?php echo base_url()?>index.php/master/get_customer',
		method: 'POST',
		data: {
			id : id
		},
		success:function(datax){
			var datax = JSON.parse(datax);
			console.log(datax.data);
			if(datax.code == 0){
				$.each(datax.data, function(i, item){
					$('#cust_name_old').val(item.nama_customer);
					$('#id_old').val(item.id_customer);
					$('#hp_old').val(item.nomor_telfon);
					$('#email_old').val(item.email);
					$('#alamat_old').val(item.alamat);
					$('#status_old').val(item.status);
					$('#saldo_old').val(item.saldo);
					$('#instansi_old').val(item.instansi);
				});
				
			}else{
				$('#cust_name_old').val();
				$('#id_old').val();
				$('#hp_old').val();
				$('#email_old').val();
				$('#alamat_old').val();
				$('#status_old').val();
			}
	   }
	});
	$('#modal-update').modal();
}

function add(){
	$('#modal-add').modal();
}

function do_update(){
	if($('#cust_name_old').val() == ''){
		alert("Account ID harus diisi");
		return false;
	}else if($('#alamat_old').val() == ''){
		alert("Account Name harus diisi");
		return false;
	}else if($('#hp_old').val() == ''){
		alert("Account Name harus diisi");
		return false;
	}else if($('#email_old').val() == ''){
		alert("Account Name harus diisi");
		return false;
	}else if($('#status_old').val() == ''){
		alert("Pilih status");
		return false;
	}
	$.ajax({
	    url: '<?php echo base_url()?>index.php/master/update_customer',
		beforeSend: function( xhr ) {
			document.getElementById('field_update').innerHTML = '<button class="btn btn-success" id="btn_update"><i class="fa fa-refresh"></i>Simpan</button>';
		},
	    method: 'POST',
	    data: {
			nama_customer : $('#cust_name_old').val(),
			alamat : $('#alamat_old').val(),
			nomor_telfon : $('#hp_old').val(),
			email : $('#email_old').val(),
			status : $('#status_old').val(),
			id_customer : $('#id_old').val(),
			saldo : $('#saldo_old').val(),
			instansi : $('#instansi_old').val(),
		},
		success:function(datax){
			var datax = JSON.parse(datax);
			if(datax['code'] == 0){
				alert('Berhasil Simpan Customer');
				$('#modal-update').modal();
			}else{
				alert('Gagal Simpan Customer');
			}
			document.getElementById('field_update').innerHTML = '<button class="btn btn-success" onclick="return do_update()" id="btn_update">Simpan</button><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>';
			load();
	   }
	});
}

function do_add(){
	if($('#cust_name').val() == ''){
		alert("Account ID harus diisi");
		return false;
	}else if($('#alamat').val() == ''){
		alert("Account Name harus diisi");
		return false;
	}else if($('#hp').val() == ''){
		alert("Account Name harus diisi");
		return false;
	}else if($('#email').val() == ''){
		alert("Account Name harus diisi");
		return false;
	}else if($('#status').val() == ''){
		alert("Pilih status");
		return false;
	}
	$.ajax({
	    url: '<?php echo base_url()?>index.php/master/add_customer',
		beforeSend: function( xhr ) {
			document.getElementById('field_update').innerHTML = '<button class="btn btn-success" id="btn_update"><i class="fa fa-refresh"></i>Simpan</button>';
		},
	    method: 'POST',
	    data: {
			nama_customer : $('#cust_name').val(),
			alamat : $('#alamat').val(),
			nomor_telfon : $('#hp').val(),
			email : $('#email').val(),
			status : $('#status').val(),
			saldo : $('#saldo').val(),
			instansi : $('#instansi').val(),
		},
		success:function(datax){
			var datax = JSON.parse(datax);
			if(datax['code'] == 0){
				alert('Berhasil Simpan Customer');
				$('#modal-add').modal();
			}else{
				alert('Gagal Simpan Customer');
			}
			document.getElementById('field_update').innerHTML = '<button class="btn btn-success" onclick="return do_update()" id="btn_update">Simpan</button><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>';
			load();
	   }
	});
}

</script>