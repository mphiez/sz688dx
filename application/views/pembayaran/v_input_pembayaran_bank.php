<?php $this->load->view('header');?>
	<style>
		.input-group-addon{
			cursor:pointer;
		}
		.fa-trash:hover{
			color:red;
		}
		.table > tbody > tr > td {
			padding: 3px !important;
		}
		.form-control {
			padding: 6px 6px;
		}
	</style>
	<section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$judul?></li>
      </ol>
    </section>
	<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header" style="padding:0px">
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<div class="col-md-12">
					<h2>
						<?=$judul?>
					</h2>
					<hr>
				</div>
				<form enctype="multipart/form-data" id="submit">
					<div class="col-md-12">
						<table class="table table-hover table-strips">
							<thead>
								<tr>
									<th width="13%">Tanggal</th>
									<th width="15%">No. Bukti</th>
									<th width="19%">Keterangan</th>
									<th width="19%">Akun Bank</th>
									<th width="19%">Jenis Pembayaran</th>
									<th width="15%">Jumlah (Rp.)</th>
								</tr>
							</thead>
							<tbody id="produk">
								<tr id="produk_1">
									<td>
										<div class="input-group">
											<div class="input-group-addon" onclick="return delete_produk(1)">
												<i class="fa fa-trash"></i>
											</div>
											<input type="text" id="tanggal_1" class="form-control date">
											<input type="hidden" id="counter" class="form-control" value="2">
										</div>
									</td>
									<td><input type="text" id="no_bukti_1" class="form-control"></td>
									<td><textarea style="height: 33px;" id="deskripsi_1" class="form-control"></textarea></td>
									<td>
										<select class="form-control chosen-select1" id="akun_bank_1">
											<option value="">Pilih Bank</option>
											<?php 
											foreach($bank as $row){
											?>
												<option value="<?php echo $row->account_num?>"><?php echo $row->account_name?></option>
											<?php
											}
											?>
										</select>
									</td>
									<td>
										<select class="form-control chosen-select1" id="akun_debet_1">
											<option value="">Pilih Akun</option>
											<?php 
											foreach($account_list as $row){
											?>
												<option value="<?php echo $row->account_num?>"><?php echo $row->account_name?></option>
											<?php
											}
											?>
										</select>
									</td>
									<td><input type="text" id="debet_1" class="form-control money"></td>
								</tr>
								<tr id="produk_2">
									<td>
										<div class="input-group">
											<div class="input-group-addon" onclick="return delete_produk(2)">
												<i class="fa fa-trash"></i>
											</div>
											<input type="text" id="tanggal_2" class="form-control date">
										</div>
									</td>
									<td><input type="text" id="no_bukti_2" class="form-control"></td>
									<td><textarea style="height: 33px;" id="deskripsi_2" class="form-control"></textarea></td>
									<td>
										<select class="form-control chosen-select1" id="akun_bank_2">
											<option value="">Pilih Bank</option>
											<?php 
											foreach($bank as $row){
											?>
												<option value="<?php echo $row->account_num?>"><?php echo $row->account_name?></option>
											<?php
											}
											?>
										</select>
									</td>
									<td>
										<select class="form-control chosen-select1" id="akun_debet_2">
											<option value="">Pilih Akun</option>
											<?php 
											foreach($account_list as $row){
											?>
												<option value="<?php echo $row->account_num?>"><?php echo $row->account_name?></option>
											<?php
											}
											?>
										</select>
									</td>
									<td><input type="text" id="debet_2" class="form-control money"></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="7">
										<button type="button" class="btn btn-success" onclick="return add_product()"><i class="fa fa-plus"></i> Tambah Jurnal</button>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="col-md-12 ">
					<hr>
						<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
						<br>
						<br>
						<br>
						<br>
					</div>
				</form>
            </div>
        </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<script>
	$('.chosen-select1').chosen({no_results_text: "Oops, nothing found!"});
	$('.date').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		
	});
	$('#submit').submit(function(e){
		var counter = $('#counter').val();
		var transaksi = new Array();
		for(i=1;i<=counter;i++){
			var temp = {
				tanggal		:$('#tanggal_'+i).val(),
				no_bukti	:$('#no_bukti_'+i).val(),
				deskripsi	:$('#deskripsi_'+i).val(),
				akun_debet	:$('#akun_debet_'+i).val(),
				debet		:$('#debet_'+i).val(),
				akun_bank	:$('#akun_bank_'+i).val()
			}
			if($('#tanggal_'+i).val() == '' && ($('#akun_debet_'+i).val() != '' || $('#akun_bank_'+i).val() != '') && ($('#debet_'+i).val() != '' || $('#akun_bank_'+i).val() != '')){
				alert('Tanggal tidak boleh kosong!');
				return false;
			}else if($('#deskripsi_'+i).val() == '' && ($('#akun_debet_'+i).val() != '' || $('#akun_bank_'+i).val() != '') && ($('#debet_'+i).val() != '' || $('#akun_bank_'+i).val() != '')){
				alert('Keterangan tidak boleh kosong!');
				return false;
			}else if(($('#akun_bank_'+i).val() == '') && ($('#debet_'+i).val() != '' || $('#akun_debet_'+i).val() != '')){
				alert('Akun Bank tidak boleh kosong !');
				return false;
			}else if(($('#akun_debet_'+i).val() == '') && ($('#debet_'+i).val() != '' || $('#akun_bank_'+i).val() != '')){
				alert('Jenis Transaksi tidak boleh kosong !');
				return false;
			}else if(($('#debet_'+i).val() == '') && ($('#akun_debet_'+i).val() != '' || $('#akun_bank_'+i).val() != '')){
				alert('Nominal tidak boleh kosong !');
				return false;
			}else if($('#deskripsi_'+i).val() != '' && $('#akun_debet_'+i).val() != '' && $('#debet_'+i).val() != '' && $('#akun_bank_'+i).val() != ''){
				transaksi.push(temp);
			}
		}
		
		if(transaksi.length > 0){
			$.ajax({
				url: '<?php echo base_url()?>index.php/pembayaran/save_pembayaran_bank',
				type: "POST",
				data: {
					transaksi 			: transaksi
				},
				success: function(datax) {
					var datax = JSON.parse(datax);
					if(datax.code == 0){
						alert('Simpan berhasil !');
						location.replace('<?php echo base_url()?>index.php/pembayaran/bank');
					}else if(datax.code == 1){
						alert('Simpan gagal !');
					}
				}
			});
		}else{
			alert('Tidak ada transaksi !');
		}
		return false;
	});
	
	function add_product(){
		var num = $('#counter').val();
		num++;
		$('#produk').append('<tr id="produk_'+num+'">'+
									'<td>'+
										'<div class="input-group">'+
											'<div class="input-group-addon" onclick="return delete_produk('+num+')">'+
												'<i class="fa fa-trash"></i>'+
											'</div>'+
											'<input type="text" id="tanggal_'+num+'" class="form-control date">'+
										'</div>'+
									'</td>'+
									'<td><input type="text" id="no_bukti_'+num+'" class="form-control"></td>'+
									'<td><textarea style="height: 33px;" id="deskripsi_'+num+'" class="form-control"></textarea></td>'+
									'<td>'+
										'<select class="form-control chosen-select1" id="akun_bank_'+num+'">'+
											'<option value="">Pilih Bank</option>'+
											<?php 
											foreach($bank as $row){
											?>
												'<option value="<?php echo $row->account_num?>"><?php echo $row->account_name?></option>'+
											<?php
											}
											?>
										'</select>'+
									'</td>'+
									'<td>'+
										'<select class="form-control chosen-select1" id="akun_debet_'+num+'">'+
											'<option value="">Pilih Akun</option>'+
											<?php 
											foreach($account_list as $row){
											?>
												'<option value="<?php echo $row->account_num?>"><?php echo $row->account_name?></option>'+
											<?php
											}
											?>
										'</select>'+
									'</td>'+
									'<td><input type="text" id="debet_'+num+'" onkeyup="return change_kredit('+num+')" class="form-control money"></td>'+
								'</tr>');
		$('.chosen-select1').chosen({no_results_text: "Oops, nothing found!"});
		$('.date').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true,
			
		});
		$('#counter').val(num);
	}
	
	function change_kredit(x){
		var dsada = $('#debet_'+x).val();
		$('#kredit_'+x).val(dsada);
	}
	
	function change_debit(x){
		var dsada = $('#kredit_'+x).val();
		$('#debet_'+x).val(dsada);
	}
	
	function delete_produk(x){
		document.getElementById('produk_'+x+'').style.display = "none";
		$('#tanggal_'+x).val('');
		$('#no_bukti_'+x).val('');
		$('#akun_bank_'+x).val('');
		//var jumlah = harga;
		$('#deskripsi_'+x).val('');
		$('#akun_debet_'+x).val('');
		$('#debet_'+x).val('');
	}
</script>
