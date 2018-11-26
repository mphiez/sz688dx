<?php $this->load->view('header');?>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Daftar Akun</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
        <div class="col-xs-12">
			
			<div class="box">
				<div class="box-header">
					
					<button class="btn btn-info btn-sm" onclick="return add()">
						<i class="fa fa-book"></i>
						Add New
					</button>
					<br>
					<br>
					<div class="box-body table no-padding">
					  <table class="table table-bordered table-hover dataTable" id="example">
						<thead>
							<tr>
							  <th>ID Account</th>
							  <th>Account Name</th>
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
						<label class="col-sm-4">Account ID</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm" value="" id="account_num_old" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Account Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm" value="" id="account_name_old">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Account Status</label>
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
			<h4 class="modal-title modal-success">Tambah Data</h4>
		  </div>
		  <div class="modal-body">
			<div class="row" id="body_add">
				<div class="col-md-12">
					<div class="form-group row">
						<label class="col-sm-4">Account ID</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm" value="" id="account_num">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Account Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm" value="" id="account_name">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Saldo Awal</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm money" value="0" id="saldo_awal">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">Account Status</label>
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
	</div>
<?php $this->load->view('footer');?>
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
load();
function load(){	
	$("#example").dataTable({
			"processing": true,
			"ajax": {
				"url": "<?php echo base_url()?>index.php/master/get_account",
				"type": "POST",
				data: {},
			},
			"destroy": true,
			"oLanguage": {
				"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
			},
			"aoColumns": [
				{ "data": "account_num"},
				{ "data": "account_name"},
				{ "data": "status"},
				{
					render: function (data, type, row, meta) {
						return '<button class="btn btn-warning btn-sm" onclick="return edit(&#39;'+row.account_num+'&#39;,&#39;'+row.account_name+'&#39;,&#39;'+row.status+'&#39;)"><i class="fa fa-pencil"></i> Update</button>';
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
			url: '<?php echo base_url()?>index.php/master/delete_account',
			beforeSend: function( xhr ) {
				document.getElementById('field_update').innerHTML = '<button class="btn btn-success" id="btn_update"><i class="fa fa-refresh"></i>Simpan</button>';
			},
			method: 'POST',
			data: {
				account_num : id
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

function edit(id, name, status){
	$('#account_name_old').val(name);
	$('#account_num_old').val(id);
	$('#status').val(status);
	$('#modal-update').modal();
}

function add(){
	$('#modal-add').modal();
}

function do_update(){
	if($('#account_num_old').val() == ''){
		alert("Account ID harus diisi");
		return false;
	}else if($('#account_name_old').val() == ''){
		alert("Account Name harus diisi");
		return false;
	}else if($('#status_old').val() == ''){
		alert("Pilih status");
		return false;
	}
	$.ajax({
	    url: '<?php echo base_url()?>index.php/master/update_account',
		beforeSend: function( xhr ) {
			document.getElementById('field_update').innerHTML = '<button class="btn btn-success" id="btn_update"><i class="fa fa-refresh"></i>Simpan</button>';
		},
	    method: 'POST',
	    data: {
			account_num : $('#account_num_old').val(),
			account_name : $('#account_name_old').val(),
			status : $('#status_old').val(),
		},
		success:function(datax){
			var datax = JSON.parse(datax);
			if(datax['code'] == 0){
				alert('Berhasil Update Account');
				$('#modal-update').modal();
			}else{
				alert('Gagal Update Account');
			}
			document.getElementById('field_update').innerHTML = '<button class="btn btn-success" onclick="return do_update()" id="btn_update">Simpan</button><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>';
			load();
	   }
	});
}

function do_add(){
	if($('#account_num').val() == ''){
		alert("Account ID harus diisi");
		return false;
	}else if($('#account_name').val() == ''){
		alert("Account ID harus diisi");
		return false;
	}else if($('#saldo_awal').val() == ''){
		alert("Account ID harus diisi");
		return false;
	}else if($('#status').val() == ''){
		alert("Account ID harus diisi");
		return false;
	}
	$.ajax({
	    url: '<?php echo base_url()?>index.php/master/add_account',
		beforeSend: function( xhr ) {
			document.getElementById('field_add').innerHTML = '<button class="btn btn-success" id="btn_add"><i class="fa fa-refresh"></i>Simpan</button>';
		},
	    method: 'POST',
	    data: {
			account_num : $('#account_num').val(),
			account_name : $('#account_name').val(),
			status : $('#status').val(),
			saldo : $('#saldo_awal').val(),
		},
		success:function(datax){
			var datax = JSON.parse(datax);
			if(datax.code == 0){
				alert('Berhasil Tambah Account');
				$('#modal-add').modal();
			}else if(datax.code == 1){
				alert('Gagal Tambah Account');
			}else if(datax.code == 2){
				alert('Account ID sudah ada');
			}
			document.getElementById('field_add').innerHTML = '<button class="btn btn-success" onclick="return do_add()" id="btn_add">Simpan</button><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>';
			load();
	   }
	});
}

</script>