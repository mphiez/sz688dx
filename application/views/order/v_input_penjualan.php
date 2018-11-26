<?php $this->load->view('header');?>
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet"> 
	<style>
		.new_rows{
			padding:30px 0px 30px 0px !important;
		}
		
		.ui-autocomplete{
			border-radius:5px;
			background-color:#f4fdff;
			border-color:#b9cce8;
			!important;
		}
		.newfont{
			font-family: 'Dancing Script', cursive;
		}
		
		.shorten-box {float:right; font-size:15px;padding: 5px 6px;background: #008c5f;color:#fff;border: 1px solid;border-radius: 3px;border-radius:3px;}
		.shorten-text {display:inline-block;position: relative;margin-right:8px;}
		#output{display:inline-block;}
		.output{display:inline-block;monospace;white-space:initial;word-spacing:normal;word-break:normal;hyphens:none;color:#000;cursor:pointer;background:#fff;border-radius:3px;line-height:1;padding:2px 5px;margin:0;box-shadow: inset 0px 0px 1px rgba(0,0,0,.0.8); }
		.output:focus,.output:active{outline:none}
	</style>
    <section class="content-header">
	  <div class="title">
		Transaksi
      <div>
    </section>
    <section class="content-header">
	  <h1>
       <?=$judul?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$judul?></li>
      </ol>
    </section>
	<section class="content">
		<div class="box box-default">
			<div class="box-body">
				<div class="row new_rows">
					<div class="col-md-4">
						<div class="form-group">
							<label>Pelanggan (Nama Perusahaan/Nama)</label>
							<input type="text" class="form-control" id="pelanggan" name="pelanggan" onkeyup="return myFunction()">
							<h4 style="display:none">Pelanggan : <b id="nama_perusahaan"></b></h4>
							<input type="hidden" class="form-control" id="id_pelanggan" name="id_pelanggan">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control" id="email" name="email">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label></label>
							<div class="box-header">
								<h3 class="box-title">Sisa Tagihan : <b id="text_tagihan"></b> </h3>
								<input class="form-control" type="hidden" readonly id="tagihan" name="tagihan" value="0">
							</div>
						</div>
					</div>
				</div>
				<div class="row new_rows">
					<div class="col-md-3">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Tanggal Transaksi</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input class="form-control datepickerx1" id="tanggal_transaksi" name="tanggal_transaksi" type="text">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Nomor Transaksi</label>
									<input type="text" id="no_trans" name="no_trans" class="form-control">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>No Ref Pelanggan</label>
									<input type="text" id="no_ref" name="no_ref" class="form-control" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Tanggal Jatuh Tempo</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input class="form-control datepickerx1" id="tanggal_tempo" name="tanggal_tempo" type="text">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Syarat Pembayaran</label>
									<input type="text" class="form-control" id="syarat" name="syarat">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Alamat Penagihan</label>
									<textarea class="form-control" id="alamat" name="alamat"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row new_rows">
					<div class="col-md-12">
						<input type="hidden" id="rows" value="0">
						<div class="col-md-12 column table-responsive" style="width: 100% !important;">
							<table class="table table-bordered table-hover dataTable">
								<thead>
									<tr>
										<th width="3%"></th>
										<th width="25%">Produk</th>
										<th width="10%">Deskripsi</th>
										<th width="10%">Kuantitas</th>
										<th width="10%">Satuan</th>
										<th width="10%">Harga</th>
										<th width="10%">Diskon</th>
										<th width="10%">Pajak</th>
										<th width="12%">Jumlah</th>
									</tr>
								</thead>
								<tbody id="tambah_data">
									<tr id="row_0">
										<td>
											<button class="btn btn-danger" onclick="return delete_row('row_0')"><i class="fa fa-remove"></i></button>
										</td>
										<td>
											<input class="form-control" type="text" id="nama_produk_0" name="nama_produk[]" onkeyup="return chose_product(0)">
											<input class="form-control" type="hidden" id="id_produk_0" name="id_produk[]">
										</td>
										<td>
											<textarea class="form-control" style="height:35px;" id="deskripsi" name="deskripsi[]"></textarea>
										</td>
										<td>
											<div class="input-group">
												<input class="form-control" type="text" id="qty" name="qty[]" onkeyup="return hanyaAngka(event)">
											</div>
										</td>
										<td>
											<input class="form-control" type="text" id="satuan" name="satuan[]">
										</td>
										<td>
											<input class="form-control" type="text" id="harga_produk_0" name="harga[]" onkeyup="return hanyaAngka(event)">
										</td>
										<td>
											<input class="form-control" type="text" id="diskon" name="diskon[]" onkeyup="return hanyaAngka(event)">
										</td>
										<td>
											<select class="form-control" id="pajak" name="pajak[]" onchange="return hitung()">
												<option value="">-Pajak-</option>
												<?php if($data_pajak > 0){foreach($data_pajak as $row){?>
													<option value="<?=$row->value?>"><?=$row->nama?></option>
												<?php }}?>
											</select>
											<input class="form-control" type="hidden" id="realPajak" name="realPajak[]">
										</td>
										<td>
											<input class="form-control" type="text" readonly id="total" name="total[]">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-8">
								<button class="btn btn-primary" id="tambah">Tambah Data</button>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row new_rows">
							<div class="col-md-4">
								<div class="col-md-12">
									<div class="form-group">
										<label>Pesan</label>
										<textarea class="form-control" id="pesan" name="pesan"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Jumlah Pembayaran</label>
										<input type="text" class="form-control" id="bayar" name="bayar" value="0">
									</div>
								</div>
							</div>
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<h4>Subtotal</h4>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<h4 id="subtotal">Rp. </h4>
											<input class="form-control" type="hidden" id="subtotalx" name="subtotalx">
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<h4>Diskon</h4>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<h4 id="t_diskon">Rp. </h4>
											<input class="form-control" type="hidden" id="diskonx" name="diskonx">
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<h4>PPN</h4>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<h4 id="t_pajak">Rp. </h4>
											<input class="form-control" type="hidden" id="ppnx" name="ppnx">
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<h4>Total</h4>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<h4 id="t_total">Rp. </h4>
											<input class="form-control" type="hidden" id="totalx" name="totalx">
										</div>
									</div>
									<div class="col-md-12">
									
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<h4>Total Tagihan</h4>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<h4 id="sisa_tagihan">Rp. </h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="form-group" style="float: center;text-align: center;">
								<button class="btn btn-success btn-lg" style="text-align:center" id="save">Save</button>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<div class="modal fade" id="myModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Simpan History Berhasil</h4>
      </div>
      <div class="modal-body">
		<div class="kontenInfo" id="kontenInfo">
			Sip gituh dong dicatet, biar ada historynya.. :D
		</div>
      </div>
      <div class="modal-footer">
		<a href="<?php echo base_url(); ?>index.php/pecel" class="btn btn-warning">Ok</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalInfofaied" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Simpan History Gagal</h4>
      </div>
      <div class="modal-body">
		<div class="kontenInfo" id="kontenInfo">
			Kolomnya Diisi Semua Makanya >:0
		</div>
      </div>
      <div class="modal-footer">
		<a href="<?php echo base_url(); ?>index.php/pecel" data-dismiss="modal" class="btn btn-warning">Ok</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modaldiskon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Daftar Diskon</h4>
      </div>
      <div class="modal-body">
		<div class="kontenInfo" id="kontendiskon">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Deskripsi</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input class="form-control" type="text">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Syarat Pembayaran</label>
						<input type="text" class="form-control">
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
		<a href="<?php echo base_url(); ?>index.php/pecel" data-dismiss="modal" class="btn btn-warning">Ok</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Customer Baru</h4>
      </div>
      <div class="modal-body">
		<div class="kontenInfo" id="formCreateCustomer">
			
		</div>
      </div>
      <div class="modal-footer">
		<button class="btn btn-warning" id="create_customer">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCreate2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Produk Baru</h4>
      </div>
      <div class="modal-body">
		<div class="kontenInfo" id="formCreateProduct">
			
		</div>
      </div>
      <div class="modal-footer">
		<button class="btn btn-warning" id="create_product">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalSukses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Simpan Penjualan Berhasil</h4>
      </div>
      <div class="modal-body">
		<div class="kontenInfo" id="">
			Simpan Penjualan Berhasil Silahkan Tekan tombol Close !
		</div>
      </div>
      <div class="modal-footer">
		<a href="<?=base_url()?>index.php/order/list_transaction" class="btn btn-warning" id="create_product">Close</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalGagal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Simpan Penjualan Gagal</h4>
      </div>
      <div class="modal-body">
		<div class="kontenInfo" id="">
			Simpan Penjualan Gagal Silahkan Tekan tombol Close, Untuk Mengulangi Kembali !
		</div>
      </div>
      <div class="modal-footer">
		<button data-dismiss="modal" class="btn btn-warning" id="create_product">Close</button>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('footer');?>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?=base_url()?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/js/bootstrap-clockpicker.min.js"></script>
<script>
	hitung();
	$('#tambah').click(function(){
		var rows = ($('#rows').val()*1) + (1*1);
		$('#rows').val(rows);
		$('#tambah_data').append('<tr id="'+rows+'">'+
									'<td>'+
										'<button class="btn btn-danger" onclick="return delete_row(&#39;'+rows+'&#39;)"><i class="fa fa-remove"></i></button>'+
									'</td>'+
									'<td>'+
										'<input class="form-control" type="text" id="nama_produk_'+rows+'" name="nama_produk[]" onkeyup="return chose_product('+rows+')">'+
											'<input class="form-control" type="hidden" id="id_produk_'+rows+'" name="id_produk[]">'+
									'</td>'+
									'<td>'+
										'<textarea class="form-control" style="height:35px;" id="deskripsi" name="deskripsi[]"></textarea>'+
									'</td>'+
									'<td>'+
										'<div class="input-group">'+
											'<input class="form-control" type="text" id="qty" name="qty[]" onkeyup="return hanyaAngka(event)">'+
										'</div>'+
									'</td>'+
									'<td>'+
										'<input class="form-control" type="text" id="satuan" name="satuan[]" onkeyup="return hanyaAngka(event)">'+
									'</td>'+
									'<td>'+
										'<input class="form-control" type="text" id="harga_produk_'+rows+'" name="harga[]" onkeyup="return hanyaAngka(event)">'+
									'</td>'+
									'<td>'+
										'<input class="form-control" type="text" id="diskon" name="diskon[]" onkeyup="return hanyaAngka(event)">'+
									'</td>'+
									'<td>'+
										'<select class="form-control" id="pajak" name="pajak[]" onchange="return hitung()">'+
											'<option value="">-Pajak-</option><?php if($data_pajak > 0){foreach($data_pajak as $row){?><option value="<?=$row->value?>"><?=$row->nama?></option><?php }}?>'+
										'</select>'+
										'<input class="form-control" type="hidden" id="realPajak" name="realPajak[]">'+
									'</td>'+
									'<td>'+
										'<input class="form-control" type="text" readonly id="total" name="total[]">'+
									'</td>'+
								'</tr>');
	});
	
	function hitung(){
		var temp1 = document.getElementsByName('qty[]');
		var temp2 = document.getElementsByName('harga[]');
		var temp3 = document.getElementsByName('pajak[]');
		var temp4 = document.getElementsByName('diskon[]');
		
		var subtotal = 0;
		var t_diskon = 0;
		var t_pajak = 0;
		var t_bayar = 0;
		
		for(i=0; i < temp1.length ; i++){
			var sub_total = temp1[i].value * temp2[i].value;
			t_diskon = t_diskon*1 + temp4[i].value*1;
			var pajak = (sub_total - temp4[i].value) * temp3[i].value;
			var bayar = sub_total - temp4[i].value + pajak;
			document.getElementsByName('realPajak[]')[i].value = pajak;
			document.getElementsByName('total[]')[i].value = bayar;
			subtotal = subtotal + sub_total;
			t_pajak = t_pajak + pajak;
			t_bayar = t_bayar + bayar;
		}
		
		document.getElementById('subtotal').innerHTML='Rp. '+to_rupiah(subtotal);
		document.getElementById('subtotalx').value=subtotal;
		document.getElementById('t_total').innerHTML='Rp. '+to_rupiah(t_bayar);
		document.getElementById('totalx').value=t_bayar;
		document.getElementById('t_pajak').innerHTML='Rp. '+to_rupiah(t_pajak);
		document.getElementById('ppnx').value=t_pajak;
		var sisa = ($('#tagihan').val()*1) +  (t_bayar*1);
		if(sisa < 0){
			sisa = 0;
		}
		document.getElementById('sisa_tagihan').innerHTML='Rp. '+to_rupiah(sisa);
		document.getElementById('t_diskon').innerHTML='Rp. '+to_rupiah(t_diskon);
		document.getElementById('diskonx').value=t_diskon;
	};
	
	function to_rupiah(strx){
		var str = strx+'';
		var angka = str.split(".");
		if(angka.length == 1){
			return convertToRupiah(str);
		}else{
			var temp = angka[1];
			return convertToRupiah(angka[0])+ ','+temp[0];
		}
	}
	
	function convertToRupiah(angka)
	{
		var rupiah = '';		
		var angkarev = angka.toString().split('').reverse().join('');
		for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
		return rupiah.split('',rupiah.length-1).reverse().join('');
	}

	/**
	 * Usage example:
	 * alert(convertToRupiah(10000000)); -> Rp. 10.000.000
	 */
	 
	function convertToAngka(rupiah)
	{
		return parseInt(rupiah.replace(/[^0-9]/g, ''), 10);
	}
	
	function hanyaAngka(evt) {
		hitung();
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
		return true;
	}
	
	function myFunction(){
		var value = $('#pelanggan').val();
		value = value.toUpperCase();
		$('#email').val('');
		$('#alamat').val('');
		$('#no_ref').val('');
		$('#id_pelanggan').val('');
		$('#tagihan').val('');
		if(value.length > 0) {
			$.ajax({
				url: '<?php echo base_url()?>index.php/order/load_list_customer',
				type: "POST",
				data: {key:value},
				success: function(datax) {
					var list = JSON.parse(datax);
					var pelanggan = list.data;
					$(function() {
						$( "#pelanggan" ).autocomplete({
							source: pelanggan,
							select: function( event , ui ) {
								var str = ui.item.label;
								if(str == 'Customer Tidak Ditemukan, Tambah Customer Baru Klik Disini'){
									$('#modalCreate').modal();
									$('#formCreateCustomer').empty();
									$.ajax({
										url: '<?php echo base_url()?>index.php/order/get_form_customer',
										type: "POST",
										data: {},
										success: function(data2) {
											$('#formCreateCustomer').append(data2);
										}
									});
								}else if(str.length > 5){
									var value = str.split(" - ");
									var pelanggan = value[0];
									$.ajax({
										url: '<?php echo base_url()?>index.php/order/load_data_customer',
										type: "POST",
										dataType: 'json',
										data: { id_pelanggan:pelanggan},
										success: function(data2) {
											var dPelanggan = data2.data;
											$.each(dPelanggan, function(i,item){
												document.getElementById('nama_perusahaan').innerHTML = item.nama_perusahaan;
												document.getElementById('text_tagihan').innerHTML = item.sisa_tagihan;
												$('#email').val(item.email1);
												$('#alamat').val(item.alamat);
												$('#no_ref').val(item.id);
												$('#id_pelanggan').val(item.id);
												$('#tagihan').val(item.sisa_tagihan);
												hitung();
											});
										}
									});
											
								}
							},
							response: function(event, ui) {
								if (!ui.content.length) {
									var noResult = { value:"",label:"Customer Tidak Ditemukan, Tambah Customer Baru Klik Disini" };
									ui.content.push(noResult);
								}
							}
						});
					});
				}
			});
		}
	}
	
	function chose_product(x){
		var value = $('#nama_produk_'+x+'').val();
		//console.log(value);
		value = value.toUpperCase();
		$('#id_produk_'+x+'').val('');
		$('#harga_produk_'+x+'').val('');
		if(value.length > 0) {
			$.ajax({
				url: '<?php echo base_url()?>index.php/order/load_list_product',
				type: "POST",
				data: {key:value},
				success: function(datax) {
					var list = JSON.parse(datax);
					var pelanggan = list.data;
					$(function() {
						$( '#nama_produk_'+x+'' ).autocomplete({
							source: pelanggan,
							select: function( event , ui ) {
								var str = ui.item.label;
								if(str == 'Produk Tidak Ditemukan, Tambah Produk Baru Klik Disini'){
									$('#modalCreate2').modal();
									$('#formCreateProduct').empty();
									$.get( "<?= base_url(); ?>index.php/master/add_stock_trans" , { option :"" } , function ( data ) {
										$( '#formCreateProduct' ) . html ( data ) ;
										$( '#formCreateProduct' ).append('<input type="hidden" id="id_temp_prod" value="'+x+'">');
									} ) ;
								}else if(str.length > 10){
									var value = str.split(" - ");
									var id_product = value[0];
									$.ajax({
										url: '<?php echo base_url()?>index.php/order/load_data_product',
										type: "POST",
										dataType: 'json',
										data: { id_product:id_product},
										success: function(data2) {
											var dPelanggan = data2.data;
											$.each(dPelanggan, function(i,item){
												$('#id_produk_'+x+'').val(item.id);
												$('#nama_produk_'+x+'').val(item.nm_barang);
												$('#harga_produk_'+x+'').val(item.harga);
											});
											hitung();
										}
									});
											
								}
							},
							response: function(event, ui) {
								if (!ui.content.length) {
									var noResult = { value:"",label:"Produk Tidak Ditemukan, Tambah Produk Baru Klik Disini" };
									ui.content.push(noResult);
								}
							}
						});
					});
				}
			});
		}
	}
	
	function delete_row(id){
		$('#'+id+'').remove();
		hitung();
	}
	
	$('#save').click(function(){
		if($('#id_pelanggan').val() == ''){
			document.getElementById("pelanggan").focus();
			alert('Silahkan Pilih Customer');
			return false;
		}else if($('#tanggal_transaksi').val() == ''){
			document.getElementById("pelanggan").focus();
			alert('Silahkan Pilih Tanggal Transaksi');
			return false;
		}else if($('#alamat').val() == ''){
			document.getElementById("pelanggan").focus();
			alert('Silahkan Pilih Alamat');
			return false;
		}else{			
			var header = {
				id_pelanggan : $('#id_pelanggan').val(),
				nama_pelanggan : $('#pelanggan').val(),
				tanggal_transaksi : $('#tanggal_transaksi').val(),
				tanggal_jatuh_tempo : $('#tanggal_tempo').val(),
				alamat_penagihan : $('#alamat').val(),
				nomor_transaksi : $('#no_trans').val(),
				syarat_pembayaran : $('#syarat').val(),
				no_refrensi : $('#no_ref').val(),
				pesan : $('#pesan').val(),
				subtotal : $('#subtotalx').val(),
				diskon : $('#diskonx').val(),
				ppn : $('#ppnx').val(),
				total : $('#totalx').val(),
				bayar : $('#bayar').val()
			}

			var temp0 = document.getElementsByName('id_produk[]');
			var temp1 = document.getElementsByName('qty[]');
			var temp2 = document.getElementsByName('harga[]');
			var temp3 = document.getElementsByName('realPajak[]');
			var temp4 = document.getElementsByName('diskon[]');
			var temp5 = document.getElementsByName('nama_produk[]');
			var temp6 = document.getElementsByName('satuan[]');
			var temp7 = document.getElementsByName('deskripsi[]');
			var temp8 = document.getElementsByName('total[]');
			
			var idList = new Array();
			var qtyList = new Array();
			var hargaList = new Array();
			var pajakList = new Array();
			var diskonList = new Array();
			var produkList = new Array();
			var satuanList = new Array();
			var deskripsiList = new Array();
			var totalList = new Array();
			
			for(i=0; i < temp1.length ; i++){
				if(temp1[i].value < 1 || temp2[i].value < 1 || temp5[i].value == ''){
					alert('Nama Produk, Kuantitas dan Harga tidak boleh kosong !');
					return false;
				}else{
					idList.push(temp0[i].value);
					qtyList.push(temp1[i].value);
					hargaList.push(temp2[i].value);
					pajakList.push(temp3[i].value);
					diskonList.push(temp4[i].value);
					produkList.push(temp5[i].value);
					satuanList.push(temp6[i].value);
					deskripsiList.push(temp7[i].value);
					totalList.push(temp8[i].value);
				}
			}		
			
			var detail = {
				id : idList,
				nama : produkList,
				deskripsi : deskripsiList,
				qty : qtyList,
				satuan : satuanList,
				harga : hargaList,
				diskon : diskonList,
				pajak : pajakList,
				total : totalList		
			}
			
			var param = {
				header : header,
				detail : detail,
				transaction : '<?php echo $trans;?>'
			}
			
			$.ajax({
				url: '<?php echo base_url()?>index.php/order/save',
				type: "POST",
				data: {data:param},
				success: function(data2) {
					var data = JSON.parse(data2);
					if(data.code == '0'){
						$('#modalSukses').modal('toggle');
					}else{
						$('#modalGagal').modal('toggle');
					}
				}
			});
		}
	});
	
	$('.datepickerx1').datepicker({
		//format: "dd-mm-yyyy",
		format: "yyyy-mm-dd",
		autoclose: true,
	});
	
	$('#create_customer').click(function(){
		if($("#pemesan").val() == ''){
			alert('silahkan isi nama contact person');
			document.getElementById("pria").focus();
			return false;
		}else if($("#telfon1").val() == ''){
			alert('silahkan isi nomor telfon 1');
			document.getElementById("telfon1").focus();
			return false;
		}else if($("#email1").val() == ''){
			alert('silahkan isi nomor email 1');
			document.getElementById("email1").focus();
			return false;
		}else if($("#alamat_cus").val() == ''){
			alert('silahkan isi nomor alamat');
			document.getElementById("alamat_cus").focus();
			return false;
		}else if($("#kota").val() == ''){
			alert('silahkan isi nomor kota');
			document.getElementById("kota").focus();
			return false;
		}else{
			$.ajax({
				url: '<?php echo base_url()?>index.php/master/proses_add_customer',
				type: "POST",
				data: {
					tgl_input:$('#tgl_input').val(),
					industri:$('#industri').val(),
					perusahaan:$('#perusahaan').val(),
					agama:$('#agama').val(),
					pemesan:$('#pemesan').val(),
					title:$('#title').val(),
					alamat:$('#alamat_cus').val(),
					kota:$('#kota').val(),
					kd_pos:$('#kd_pos').val(),
					telfon1:$('#telfon1').val(),
					email1:$('#email1').val(),
					nm_bank:$('#nm_bank').val(),
					no_account:$('#no_account').val(),
					cabang:$('#cabang').val(),
					sts_trv:$('#sts_trv').val(),
					npwp:$('#npwp').val(),
					sales:$('#sales').val(),
					sts_cus:$('#sts_cus').val(),
					no_ktp:$('#no_ktp').val(),
					direct:'Yes'
				},
				success: function(data2) {
					$('#modalCreate').modal('toggle');
					var email = $('#email1').val();
					var alamat = $('#alamat_cus').val();
					var perusahaan = $('#perusahaan').val();
					var pemesan = $('#pemesan').val();
					$('#email').val(email);
					$('#alamat').val(alamat);
					$('#pelanggan').val(data2+' - '+perusahaan+'('+pemesan+')');
					$('#no_ref').val(data2);
					$('#id_pelanggan').val(data2);
				}
			});
		}
	});
	
	$('#create_product').click(function(){
		if($("#nm_barang").val() == ''){
			alert('silahkan isi Nama Barang');
			document.getElementById("nm_barang").focus();
			return false;
		}else if($("#harga_prod").val() == ''){
			alert('silahkan isi Harga');
			document.getElementById("harga_prod").focus();
			return false;
		}else{
			if($('#filefoto').val() == ''){
				$.ajax({
					url: '<?php echo base_url()?>index.php/master/proses_add_stock',
					type: "POST",
					data: {
						nm_barang:$('#nm_barang').val(),
						supplier:$('#supplier').val(),
						asal:$('#asal').val(),
						detail:$('#detail').val(),
						harga:$('#harga_prod').val(),
						bagus:$('#bagus').val(),
						sedang:$('#sedang').val(),
						jelek:$('#jelek').val(),
						pn_wilayah:$('#pn_wilayah').val(),
						pn_akses:$('#pn_akses').val(),
						direct:'Yes'
					},
					success: function(data2) {
						$('#modalCreate2').modal('toggle');
						var nm_barang = $('#nm_barang').val();
						var harga = $('#harga_prod').val();
						$('#id_barang').val(data2);
						var id_select = $('#id_temp_prod').val();
						$('#harga_produk_'+id_select).val(harga);
						$('#nama_produk_'+id_select).val(data2+' - '+nm_barang);
					}
				});
			}else{
				var property = document.getElementById('filefoto').files[0];
				var image_name = property.name;
				var image_extension = image_name.split('.');
				if(jQuery.inArray(image_extension[1].toLowerCase(),["gif","png","jpg","jpeg"]) == -1){
					alert('Error Extension Image File !');
					return false;
				}
				var image_size = property.size;
				if(image_size > 2000000){
					alert('Image Size is very big !');
					return false;
				}
				var form_data = new FormData();
				form_data.append('file', property);
				$.ajax({
					url: '<?php echo base_url()?>index.php/master/proses_add_stock_trans',
					type: "POST",
					processData: false,
					contentType: false,
					data: form_data,
					success: function(data2) {
						hitung();
						$('#modalCreate2').modal('toggle');
						var nm_barang = $('#nm_barang').val();
						var harga = $('#harga_prod').val();
						$('#id_barang').val(data2);
						var id_select = $('#id_temp_prod').val();
						$('#harga_produk_'+id_select).val(harga);
						var ddd = data2+' - '+nm_barang;
						$('#nama_produk_'+id_select).val(ddd);
						console.log(data2+' - '+nm_barang);
						$.ajax({
							url: '<?php echo base_url()?>index.php/master/proses_add_stock_prop',
							type: "POST",
							data: {
								id : data2,
								nm_barang:$('#nm_barang').val(),
								supplier:$('#supplier').val(),
								asal:$('#asal').val(),
								detail:$('#detail').val(),
								harga:$('#harga_prod').val(),
								bagus:$('#bagus').val(),
								sedang:$('#sedang').val(),
								jelek:$('#jelek').val(),
								pn_wilayah:$('#pn_wilayah').val(),
								pn_akses:$('#pn_akses').val(),
								direct:'Yes'
							},
							success: function(datax) {
								
							}
						});
					}
				});
			}
		}
	});
	
	$('#tanggal_transaksi').change(function(){
		var trans = $('#tanggal_transaksi').val();
		var now = new Date(trans);
		now.setDate(now.getDate()+14);
		var month = now.getMonth()+1;
		if(month < 10){
			month = '0' + month;
		}
		var day = now.getDate();
		if(day < 10){
			day = '0' + day;
		}
		var year = now.getFullYear();
		//alert(month + "/" + day + "/" + year);
		$('#tanggal_tempo').val(year + "-" + month + "-" + day);
	});
</script>