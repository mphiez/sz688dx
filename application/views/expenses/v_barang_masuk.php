<?php $this->load->view('header');?>
<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">

	<style>
		#modal-create{
			padding-right:0px !Important;
		}
		.fa-5x{
			color:lightblue;
		}
		
		.ui-autocomplete
		{
			position:absolute;
			cursor:default;
			z-index:4000 !important
		}
		
		.product_item{
			color: #fff;
			background: #3d8be3;
			border: 2px solid #7590d1;
			padding: 15px;
			border-radius: 50%;
		}
		
		.product_item_1{
			color: #fff;
			background: #337ab7;
			border: 2px solid lightgray;
			padding: 15px;
			border-radius: 50%;
		}
		
		.product_item_2{
			color: #fff;
			background: #5cb85c;
			border: 2px solid lightgray;
			padding: 15px;
			border-radius: 50%;
		}
		
		.product_item_3{
			color: #fff;
			background: #f0ad4e;
			border: 2px solid lightgray;
			padding: 15px;
			border-radius: 50%;
		}
		
		.product_item_4{
			color: #fff;
			background: #d9534f;
			border: 2px solid lightgray;
			padding: 15px;
			border-radius: 50%;
		}
		.desc{
			font-size:11px;
		}
		.chosen-drop .chosen-results li.no-results{
			cursor:pointer;
		}
		
		.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
			background-color: #fff !important;
			opacity: 1;
		}
		
		#tanggal_transaksi-error{
			display : none !important;
		}
		
		#tanggal_invoice-error{
			display : none !important;
		}
	</style>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pembayaran Produk Baru</h1>
			</div>
		</div>
        <div class="row">
			<form enctype="multipart/form-data" id="submit">
				<?php 
				if($header > 0){
					foreach($header as $row){
					$accn =  $row->akun_pembayaran;
				?>
				<div class="col-md-12">
					<div class="col-sm-6 col-md-3">
						<div class="form-group">
							<label>Nama Supplier</label>
							<input type="text" id="nama_pelanggan" readonly value="<?php echo $row->nama?>" name="nama_pelanggan" onkeyup="return cari_pelanggan()" class="form-control" placeholder="Masukan nama supplier">
							<input type="hidden" id="id_pelanggan" value="<?php echo $row->id_supplier?>">
							<input type="hidden" id="tipe_transaksi" value="0">
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group">
							<label>Email</label>
							<input type="text" id="email_pelanggan" readonly name="email_pelanggan" class="form-control" value="<?php echo $row->email?>">
						</div>
					</div>
					<div class="col-sm-12 col-md-3">
						<div class="form-group" >
							<label>No Referensi</label>
							<input type="text" id="no_referensi" readonly name="no_referensi" class="form-control" value="<?php echo $row->nomor_referensi?>">
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group">
							<label>Alamat Pembayaran</label>
							<textarea id="alamat_penagihan" readonly class="form-control" style="height: 33px;"><?php echo $row->alamat?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-sm-6 col-md-3">
						<div class="form-group" >
							<label class="col-md-12">Tanggal Masuk</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" id="tanggal_transaksi" readonly class="form-control date" value="<?php echo date('d/m/Y')?>">
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3" >
						<div class="form-group">
							<label  class="col-md-12">Nomor Pembelian</label>
							<input type="text" readonly id="nomor_transaksi" class="form-control" value="<?php echo $row->nomor_transaksi?>">
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group" >
							<label>Nomor invoice/Struk Pembelian</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" id="nomor_invoice" readonly class="form-control" value="<?php echo $row->nomor_invoice?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12" style="display:none">
					<div class="col-sm-6 col-md-3">
						<div class="form-group" >
							<label>Metode Pembayaran</label>
							<select id="metode_pembayaran" onchange="return tujuan()" class="form-control">
								<option value="cash">Cash</option>
								<option value="debit">Debit</option>
								<option value="credit">Credit</option>
								<option value="transfer">Transfer</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group" id="tujuan">
							<label>Akun Pengeluaran</label>
							<select id="tujuan_transfer" class="form-control" disabled>
								<option value="">Pilih Salah Satu</option>
								<?php 
									if($bank_list > 0){
										foreach($bank_list as $row){
											echo '<option value="'.$row->account_num.'">'.$row->account_name.'</option>';
										}
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group" id="tujuan">
							<label>Akun Tujuan</label>
							<input type="text" id="nm_account_jual" readonly class="form-control" value="<?php echo account_name($accn)?>">
							<input type="hidden" id="tujuan_transfer_jual" class="form-control" value="<?php echo $accn;?>">
						</div>
					</div>
					<div class="col-sm-6 col-md-3" style="display:none;">
						<div class="form-group">
							<label>Nomor Faktur Pajak</label>
							<input type="text" id="nomor_faktur" readonly class="form-control" placeholder="[Auto]">
						</div>
					</div>
				</div>
				<?php }}?>
				<div class="col-md-12" style="padding:0px;">
					<table class="table table-hover table-strips">
						<thead>
							<tr>
								<th width="20%">Id Barang</th>
								<th width="20%">Nama Barang</th>
								<th width="20%">Deskripsi</th>
								<th width="20%">Total</th>
							</tr>
						</thead>
						<tbody id="produk">
						
							<?php if ($detail > 0){
								$i=0;
								foreach($detail as $rows){
									$i++;
								?>
							<tr id="produk_<?php echo $i; ?>">
									
								<td><input type="text" id="id_barang_<?php echo $i; ?>" class="form-control" readonly value="<?php echo $rows->id_produk?>"></td>
								<td><input type="text" id="nama_barang_<?php echo $i; ?>" class="form-control" readonly value="<?php echo $rows->nama_produk?>"></td>
								<td><textarea style="height: 33px;" id="deskripsi_<?php echo $i; ?>" class="form-control"><?php echo ($rows->deskripsi)?></textarea></td>
								<td>
								<input type="text" id="total_<?php echo $i; ?>" class="form-control money" onkeyup="return check_qty(<?php echo $i?>)" value="<?php echo $rows->qty - $rows->sudah_masuk?>">
								<input type="hidden" id="total_max_<?php echo $i; ?>" class="form-control money" value="<?php echo $rows->qty - $rows->sudah_masuk?>">
								</td>
							</tr>
								<?php }
								
								?>
								<input type="hidden" value="<?php echo $i?>" id="counter">
								<?php
								}?>
							
						</tbody>
					</table>
				</div>
				<div class="col-md-12">
					<hr>
					
				</div>
				<div class="col-md-12" id="btn_save">
					
					<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
					
				</div>
				<div class="col-md-12">
					<br>
					<br>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('footer');?>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
	


	function show_hide(){
		$('#transaksi_toggle').slideToggle();
		if($('#id_carret').val() == 0){
			$('#id_carret').val(1);
			document.getElementById('show_hide_element').innerHTML = 'Sembunyikan Pengaturan <i class="fa fa-caret-up" style="border:2px solid lightgray;border-radius:50%;padding:1px 4px;background-color:#fff"></i>';
			
		}else{
			$('#id_carret').val(0);
			document.getElementById('show_hide_element').innerHTML = 'Tampilkan Pengaturan <i class="fa fa-caret-down" style="border:2px solid lightgray;border-radius:50%;padding:1px 4px;background-color:#fff"></i>';
		}
	}
	
	function curency(x=''){
		if(x == ''){
			x = 0;
		}
		return x.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
	}
	
	function decimal(x=''){
		if(x == ''){
			x = 0;
		}
		return x.toString().replace(/[^0-9.-]+/g,"");
	}
	
	$('.date').datepicker({
		dateFormat: "dd/mm/yy",
		autoclose: true,
	});
	
	$('#submit').submit(function(e){
		var counter = $('#counter').val();
		var datas = new Array();
		for(i=1;i<=counter;i++){
			var temp = {
				id_barang			: $('#id_barang_'+i).val(),
				nama_barang			: $('#nama_barang_'+i).val(),
				deskripsi           : $('#deskripsi_'+i).val(),
				qty					: $('#total_'+i).val(),
			}
			datas.push(temp);
		}
		
		
		document.getElementById('btn_save').innerHTML = '<span class="btn btn-success pull-right"><i class="fa fa-spinner"></i> Simpan</span>';
		$.ajax({
			url: '<?php echo base_url()?>index.php/expenses/save_barang',
			type: "POST",
			data: {
				created				: $('#created').val(),
				transaksi			: $('#nomor_transaksi').val(),	
				invoice				: $('#nomor_invoice').val(),
				tanggal_masuk		: $('#tanggal_transaksi').val(),
				data 				: datas
				
						
				
			},
			success: function(datax) {
				var datax = JSON.parse(datax);
				if(datax.code == 0){
					alert('Transaksi berhasil !');
				}else{
					alert('Simpan gagal !');
				}
				document.getElementById('btn_save').innerHTML = '<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>';
			}
		});
		return false;
	});
	
	function tujuan(){
		if($('#metode_pembayaran').val() == 'cash'){
			$('#tujuan_transfer').val('');
			$('#tujuan_transfer').attr('disabled','disabled');
			$('#top_inv').css('display','none');
		}else if($('#metode_pembayaran').val() == 'hutang'){
			$('#tujuan_transfer').val('');
			$('#tujuan_transfer').attr('disabled','disabled');
			$('#top_inv').css('display','');
		}else{
			$('#tujuan_transfer').removeAttr('disabled');
			$('#top_inv').css('display','none');
		}
	}
	
	function check_bayar(){
		var harusnya = decimal($('#sisa_bayar_harusnya').val()) *1;
		var bayar = decimal($('#sisa_bayar').val())*1;
		if(bayar > harusnya){
			alert('Pembayaran tidak boleh lebih besar dari sisa pembayaran !');
			$('#sisa_bayar').val(curency(harusnya));
		}
	}
	
	function check_qty(x){
		var qty = decimal($('#total_'+x).val()) *1;
		var max = decimal($('#total_max_'+x).val()) *1;
		var max_cur = $('#total_max_'+x).val();
		if(qty > max){
			alert('Kuantitas tidak boleh lebih besar dari jumlah yang seharusnya dikirim !');
			$('#total_'+x).val((max_cur));
		}
	}
	
	function delete_paket(x){
		$('#IDbarang_'+x).css('display','none');
		$('#nama_barang_'+x).val('');
		$('#deskripsi_'+x).val('');
		$('#total_'+x).val('');
	}
</script>
