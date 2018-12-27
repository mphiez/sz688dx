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
				<h1 class="page-header">Pembelian Produk Baru</h1>
			</div>
		</div>
        <div class="row">
			<form enctype="multipart/form-data" id="submit">
				<div class="col-md-12">
					<div class="col-sm-6 col-md-3">
						<div class="form-group">
							<label>Nama Supplier</label>
							<input type="text" id="nama_pelanggan" onchange="return check_supplier()"  name="nama_pelanggan" onkeyup="return cari_pelanggan()" class="form-control" placeholder="Masukan nama supplier">
							<input type="hidden" id="id_pelanggan">
							<input type="hidden" id="tipe_transaksi" value="0">
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group">
							<label>Email</label>
							<input type="text" id="email_pelanggan" name="email_pelanggan" class="form-control">
						</div>
					</div>
					<div class="col-sm-12 col-md-3">
						<div class="form-group" >
							<label>No Referensi</label>
							<input type="text" id="no_referensi" name="no_referensi" class="form-control">
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group">
							<label>Alamat Pembayaran</label>
							<textarea id="alamat_penagihan" class="form-control" style="height: 33px;"></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-sm-6 col-md-3">
						<div class="form-group" >
							<label class="col-md-12">Tanggal Pembelian</label>
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
							<div class="input-group">
								<?php $id_transaksi = counter('c_expenses')?>
								<input type="text" readonly id="nomor_transaksi" class="form-control" placeholder="[Auto]" value="">
								<div class="input-group-addon">
									<input type="checkbox" id="transaksi_otomatis" checked onclick="return auto_transaksi()"> Auto
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group" >
							<label>Nomor invoice/Struk Pembelian</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" id="nomor_invoice" class="form-control" value="">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-sm-6 col-md-3">
						<div class="form-group" >
							<label>Metode Pembayaran</label>
							<select id="metode_pembayaran" onchange="return tujuan()" class="form-control">
								<option value="cash">Cash</option>
								<option value="debit">Debit</option>
								<option value="credit">Credit</option>
								<option value="transfer">Transfer</option>
								<option value="hutang">Hutang</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group" id="tujuan">
							<label>Tujuan</label>
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
					<div class="col-sm-6 col-md-3" id="top_inv" style="display:none;">
						<div class="form-group">
							<label>Term Of Payment (Hari)</label>
							<select id="top" class="form-control">
								<option value="10">NET 10</option>
								<option value="15">NET 15</option>
								<option value="30">NET 30</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group" id="tujuan">
							<label>Akun Pengeluaran</label>
							<select id="tujuan_transfer_jual" class="form-control">
								<?php 
									if($bank_list_sell > 0){
										foreach($bank_list_sell as $row){
											if($row->account_num == '5-1110'){
												echo '<option value="'.$row->account_num.'" selected>'.$row->account_name.'</option>';
											}else{
												echo '<option value="'.$row->account_num.'">'.$row->account_name.'</option>';
											}
											
										}
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-6 col-md-3" style="display:none;">
						<div class="form-group">
							<label>Nomor Faktur Pajak</label>
							<input type="text" id="nomor_faktur" class="form-control" placeholder="[Auto]">
						</div>
					</div>
				</div>
				<div class="col-md-12" style="padding:0px;">
					<table class="table table-hover table-strips">
						<thead>
							<tr>
								<th width="20%">Nama Produk</th>
								<th width="14%">Deskripsi</th>
								<th width="11%">Satuan</th>
								<th width="11%">Harga Beli Satuan</th>
								<th width="11%">Harga Jual Satuan</th>
								<th width="11%">Qty</th>
								<th width="11%">Minimum Stok</th>
								<th width="11%">Jumlah</th>
							</tr>
						</thead>
						<tbody id="produk">
							<tr id="produk_1">
								<td>
									<div class="input-group">
										<div class="input-group-addon" onclick="return delete_produk(1)">
											<i class="fa fa-trash"></i>
										</div>
										<input type="text" id="nama_produk_1" onkeyup="return cari_produk(1)" onchange="return hitung_all()" class="form-control">
										<input type="hidden" id="id_produk_1" class="form-control">
										<input type="hidden" id="counter" class="form-control" value="2">
									</div>
								</td>
								<td><textarea style="height: 33px;" id="deskripsi_1" class="form-control"></textarea></td>
								<td><input type="text" id="satuan_1" onkeyup="return hitung_all()" class="form-control"></td>
								<td><input type="text" id="harga_beli_1" onkeyup="return pricing(1)" class="form-control money"></td>
								<td><input type="text" id="harga_jual_1" onkeyup="return hitung_all()" class="form-control money"></td>
								<td><input type="text" id="qty_1" onkeyup="return hitung_all()" class="form-control money"></td>
								<td><input type="text" id="minimum_1" onkeyup="return hitung_all()" class="form-control money"></td>
								<td><input type="text" id="jumlah_1" readonly class="form-control"></td>
							</tr>
							<tr id="produk_2">
								<td>
									<div class="input-group">
										<div class="input-group-addon" onclick="return delete_produk(2)">
											<i class="fa fa-trash"></i>
										</div>
										<input type="text" id="nama_produk_2" onkeyup="return cari_produk(2)" onchange="return hitung_all()" class="form-control">
										<input type="hidden" id="id_produk_2" class="form-control">
									</div>
								</td>
								<td><textarea style="height: 33px;" id="deskripsi_2" class="form-control"></textarea></td>
								<td><input type="text" id="satuan_2" onkeyup="return hitung_all()" class="form-control"></td>
								<td><input type="text" id="harga_beli_2" onkeyup="return pricing(2)" class="form-control money"></td>
								<td><input type="text" id="harga_jual_2" onkeyup="return hitung_all()" class="form-control money"></td>
								<td><input type="text" id="qty_2" onkeyup="return hitung_all()" class="form-control money"></td>
								<td><input type="text" id="minimum_2" onkeyup="return hitung_all()" class="form-control money"></td>
								<td><input type="text" id="jumlah_2" readonly class="form-control"></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="7">
									<button type="button" class="btn btn-success" onclick="return add_product()"><i class="fa fa-plus"></i> Tambah Produk</button>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 col-sm-12">
						<div class="form-group">
							<span>Pesan</span>
							<div class="input-group">
								<textarea id="pesan" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<span>Lampiran</span>
							<div class="input-group">
								<input type="file" name="file"  id="image_file" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-12">
						
					</div>
					<div class="col-md-4 col-sm-12" style="padding-right: 10px;">
						<div class="form-group  pull-right">
							<span>Subtotal</span>
							<div class="input-group">
								<input type="text" id="subtotal" readonly class="form-control">
							</div>
						</div>
						<div class="form-group pull-right">
							<span>PPN</span>
							<div class="input-group">
								<input type="text" id="ppn" onkeyup="return hitung_all()" class="form-control money" >
							</div>
						</div>
						<div class="form-group pull-right">
							<span>Potongan</span>
							<div class="input-group">
								<input type="text" id="discount" onkeyup="return hitung_all()" class="form-control money" >
							</div>
						</div>
						<div class="form-group pull-right">
							<span>Total</span>
							<div class="input-group">
								<input type="text" id="total" readonly class="form-control">
							</div>
						</div>
					</div>
					<input type="hidden" id="invoice_status" value="0">
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
	<div id="modal-create" class="modal fade" tabindex="-1" role="dialog" style="padding-right:0px">
	  <div class="modal-dialog modal-lg pull-right" style="margin:0px;height: 100%;width:450px;background:white" role="document">
		<div class="modal-content"  style="height:100%">
		  <div class="modal-header" style="text-align:center;background:#3d8be3">
			<i class="fa fa-user fa-4x product_item" style="color:#3d8be3;padding:15px 22px;background:white"></i>
		  </div>
		  <div class="modal-body" style="max-height:400px">
			<div class="row" style="margin:10px 15px !important">
				<div class="form-group">
					<label>Nama Customer</label>
					<div>
						<input type="text" class="form-control form-control-sm" value="" id="cust_name_add">
					</div>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<div>
						<input type="text" class="form-control form-control-sm " value="" id="alamat_add">
					</div>
				</div>
				<div class="form-group">
					<label>Email</label>
					<div>
						<input type="text" class="form-control form-control-sm " value="" id="email_add">
					</div>
				</div>
				<div class="form-group">
					<label>Nomor telpon</label>
					<div>
						<input type="text" class="form-control form-control-sm " value="" id="hp_add">
					</div>
				</div>
				<div class="form-group">
					<label>Instansi / Perusahaan</label>
					<div>
						<input type="text" class="form-control form-control-sm " value="" id="instansi_add">
					</div>
				</div>
				<div class="form-group">
					<label>Saldo</label>
					<div>
						<input type="text" class="form-control form-control-sm money" value="" id="saldo_add">
					</div>
				</div>
				<div class="form-group" style="display:none">
					<label>Status</label>
					<div>
						<select class="form-control" id="status">
							<option value="0">Used</option>
							<option value="1">Not Used</option>
						</select>
					</div>
				</div>
			</div>
		  </div>
		  <div class="modal-footer" id="field_add" style="position: fixed;background:#337ab7;bottom: 0;right: 0;width: 100%;border-top: 1px solid lightgray;">
			<button class="btn btn-success" onclick="return do_add()" id="btn_add">Simpan</button><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  </div>
		</div>
	  </div>
	</div>
	<div id="modal-product" class="modal fade" tabindex="-1" role="dialog" style="padding-right:0px">
	  <div class="modal-dialog modal-lg pull-right" style="margin:0px;height: 100%;width:450px;background:white" role="document">
		<div class="modal-content" style="height:100%">
			<form enctype="multipart/form-data" id="submit_produk">
		  <div class="modal-header" style="height:10vh;background:#337ab7;color:white">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Tambah Supplier</h4>
		  </div>
		  <div class="modal-body" style="max-height:400px;max-height:80vh;overflow:scroll">
				<div class="row">
					<div class="col-md-12" id="panel5">
						<div class="col-md-12">
								<label class="col-md-6">Tambah Supplier Baru</label>
								<label class="col-md-6" id="hide_supplier"><a href="#" onclick="return hide_s_supplier(1)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label>Title</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="title_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Nama Supplier</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="nama_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Nama Perusahaan</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="nama_pt_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="alamat_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Catatan</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="note_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Email</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="email_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Nomor Telpon</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="phone_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Fax</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="fax_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Website</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="website_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Rata - Rata Order</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="rate_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Maksimum Order</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="maksimum_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Saldo Awal</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="balance_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Nomor Bisnis</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="bisnis_no_supplier">
									</div>
								</div>
							</div>
					</div>
				</div>
				<br>
				
		  </div>
		  <div class="modal-footer" id="btn_save_supplier" style="position: fixed;background: #337ab7;bottom: 0;right: 0;height:10vh;width: 100%;border-top: 1px solid lightgray;">
			<button  type="button"class="btn btn-success" id="s_save_type_item" onclick="return save_supplier(1)"><i class="fa fa-save"></i> Save</button><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  </div>
		  </form>
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
	function auto_transaksi(){
		if ($('#transaksi_otomatis').is(':checked')) {
			$('#nomor_transaksi').val('');
			$("#nomor_transaksi").attr("readonly", true); 
		}else{
			$('#nomor_transaksi').val('<?php echo $id_transaksi;?>');
			$("#nomor_transaksi").attr("readonly", false); 
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
	
	$(".chosen-select").chosen({no_results_text: "Tidak Ditemukan, klik di sini untuk menambahkan", width: "100%"}); 
	$(".chosen-select2").chosen({no_results_text: "Tidak Ditemukan, klik di sini untuk menambahkan", width: "100%"}); 
	
	function add_supplier(x){
		s_add_supplier(x);
	}
	
	$( "#submit" ).validate({
		rules: {
			nama_pelanggan: {
			  required: true
			},
			tujuan_transfer: {
			  required: $('#metode_pembayaran').val() != "cash" && $('#tujuan_transfer').val() == ""
			}
		},
		
		submitHandler: function(form) {
			form.submit();
		}
	});
	
	$('#tanggal_transaksi').change(function(){
		$('#tanggal_transaksi-error').css('display','none');
		$('#tanggal_transaksi').removeClass('error');
	});
	
	$('#tanggal_invoice').change(function(){
		$('#tanggal_invoice-error').css('display','none');
		$('#tanggal_invoice').removeClass('error');
	});
	
	$('#submit').submit(function(e){
		$('#tanggal_transaksi-error').css('display','none');
		$('#tanggal_transaksi').removeClass('error');
		
		$('#tanggal_invoice-error').css('display','none');
		$('#tanggal_invoice').removeClass('error');
		
		
		var counter = $('#counter').val();
		var transaksi = new Array();
		var transaksi_new = new Array();
		if($('#id_pelanggan').val() == ''){
			alert('Masukan supplier !');
			return false;
			
		}
		
		if($('#nomor_invoice').val() == ""){
			$('#nomor_invoice').focus();
			alert("Silahkan masukan nomor struk pembelian / invoice !");
			return false;
		}
		
		if($('#metode_pembayaran').val() != "cash" && $('#tujuan_transfer').val() == "" && $('#metode_pembayaran').val() != "hutang"){
			$('#tujuan_transfer').focus();
			alert("Silahkan pilih tujuan pembayaran !");
			return false;
		}
		
		
		
		
		
		for(i=1;i<=counter;i++){
			var temp = {
				nama_produk	:$('#nama_produk_'+i).val(),
				id_produk	:$('#id_produk_'+i).val(),
				deskripsi	:$('#deskripsi_'+i).val(),
				qty			:$('#qty_'+i).val(),
				satuan		:$('#satuan_'+i).val(),
				harga_satuan:$('#harga_beli_'+i).val(),
				harga_jual	:$('#harga_jual_'+i).val(),
				minimum		:$('#minimum_'+i).val(),
				pajak		:$('#pajak_'+i).val(),
				total		:$('#jumlah_'+i).val(),
			}
			if($('#nama_produk_'+i).val() != '' && ($('#qty_'+i).val() == '' || $('#harga_beli_'+i).val() == '')){
				alert('Silahkan isi kuantitas dan harga beli');
				return false;
			}
			if($('#nama_produk_'+i).val() != 0 && $('#qty_'+i).val() != ''  && $('#harga_beli_'+i).val() != '' ){
				transaksi.push(temp);
				
			}
		}
		
		
		
		if(transaksi.length > 0){
			document.getElementById('btn_save').innerHTML = '<span class="btn btn-success pull-right"><i class="fa fa-spinner"></i> Simpan</span>';
			$.ajax({
				url: '<?php echo base_url()?>index.php/expenses/save',
				type: "POST",
				data: {
					tipe_transaksi		: $('#tipe_transaksi').val(),
					discount			: $('#discount').val(),
					id_pelanggan		: $('#id_pelanggan').val(),
					nama_pelanggan		: $('#nama_pelanggan').val(),
					email_pelanggan		: $('#email_pelanggan').val(),
					no_referensi		: $('#no_referensi').val(),
					alamat_penagihan	: $('#alamat_penagihan').val(),
					tanggal_transaksi	: $('#tanggal_transaksi').val(),
					nomor_transaksi		: $('#nomor_transaksi').val(),
					metode_pembayaran	: $('#metode_pembayaran').val(),
					tujuan				: $('#tujuan_transfer').val(),
					account_sales		: $('#tujuan_transfer_jual').val(),
					top					: $('#top').val(),
					pesan				: $('#pesan').val(),
					lampiran			: $('#lampiran').val(),
					nomor_faktur		: $('#nomor_faktur').val(),
					nomor_invoice		: $('#nomor_invoice').val(),
					tujuan_transfer_jual: $('#tujuan_transfer_jual').val(),
					ppn					: $('#ppn').val(),
					subtotal			: $('#subtotal').val(),
					total				: $('#total').val(),
					transaksi 			: transaksi
				},
				success: function(datax) {
					var datax = JSON.parse(datax);
					if(datax.code == 0 && $('#image_file').val() != ''){
						var formData = new FormData();
						formData.append('file', $('input[type=file]')[0].files[0]);
						$.ajax({
							url:'<?php echo base_url()?>index.php/transaksi/save_bukti?id='+(datax.data),
							type:"post",
							data:  formData,
							processData:false,
							contentType:false,
							cache:false,
							async:false,
							success: function(data){
								alert('Transaksi berhasil');
								location.replace('<?php echo base_url()?>index.php/expenses/view');
							}
						});
					}else if(datax.code == 1){
						alert('Simpan gagal !');
					}else if(datax.code == 2){
						alert('Simpan gagal, Nomor Transaksi Sudah Digunakan !');
					}else{
						alert('Transaksi berhasil !');
						location.replace('<?php echo base_url()?>index.php/expenses/view');
					}
					document.getElementById('btn_save').innerHTML = '<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>';
				}
			});
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
										'<input type="text" id="nama_produk_'+num+'" onkeyup="return cari_produk('+num+')" onchange="return hitung_all()" class="form-control">'+
										'<input type="hidden" id="id_produk_'+num+'" class="form-control">'+
									'</div>'+
								'</td>'+
								'<td><textarea style="height: 33px;" id="deskripsi_'+num+'" class="form-control"></textarea></td>'+
								'<td><input type="text" id="satuan_'+num+'" onkeyup="return hitung_all()" class="form-control"></td>'+
								'<td><input type="text" id="harga_beli_'+num+'" onkeyup="return pricing('+num+')" class="form-control money"></td>'+
								'<td><input type="text" id="harga_jual_'+num+'" onkeyup="return hitung_all()" class="form-control money"></td>'+
								'<td><input type="text" id="qty_'+num+'" onkeyup="return hitung_all()" class="form-control money"></td>'+
								'<td><input type="text" id="minimum_'+num+'" onkeyup="return hitung_all()" class="form-control money"></td>'+
								'<td><input type="text" id="jumlah_'+num+'" readonly class="form-control"></td>'+
							'</tr>');
		$('#counter').val(num);
		$(".chosen-select").chosen({no_results_text: "Tidak Ditemukan, klik di sini untuk menambahkan", width: "100%"}); 
	}
	
	function pricing(x){
		var price = $('#harga_beli_'+x).val();
		$('#harga_jual_'+x).val(curency(price));
		
		hitung_all();
	}
	
	
	
	function tambah_paket(){
		var c = $('#counter2').val();
		c++;
		$('#produk_paket').append('<tr id="paket_'+c+'">'+
									'<td>'+
										'<div class="input-group">'+
											'<div class="input-group-addon" onclick="return delete_paket('+c+')">'+
												'<i class="fa fa-trash"></i>'+
											'</div>'+
											'<input type="text" class="form-control" id="nama_paket_'+c+'" onchange="check_produk('+c+')" onkeyup="return pilih_paket('+c+')">'+
											'<input type="hidden" class="form-control" id="id_paket_'+c+'">'+
										'</div>'+
									'</td>'+
									'<td>'+
										'<input type="text" class="form-control money" id="qty_paket_'+c+'" onkeyup="check_qty('+c+')">'+
									'</td>'+
								'</tr>');
		$('#counter2').val(c);
	}
	
	function check_produk(x){
		if($('#id_paket_'+x).val() == '' && $('#qty_paket_'+x).val() == ''){
			$('#nama_paket_'+x).val('');
			$('#id_paket_'+x).val('');
			$('#qty_paket_'+x).val('');
		}
	}
	
	function delete_paket(x){
		$('#paket_'+x).css('display','none');
		$('#nama_paket_'+x).val('');
		$('#id_paket_'+x).val('');
		$('#qty_paket_'+x).val('');
	}
	
	function pilih_paket(x){
		$('#id_paket_'+x).val('');
		$('#qty_paket_'+x).val('');
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/search_produk',
			type: "POST",
			data: {pn_name:$('#nama_paket_'+x).val(),type:'create_paket'},
			success: function(datax) {
				if($("#nama_produk_"+x).val() == ''){
					$('#nama_paket_'+x).val('');
					$('#id_paket_'+x).val('');
					$('#qty_paket_'+x).val('');
				}
				var datax = JSON.parse(datax);

					var list_name = new Array();
					$.each(datax.data, function(i, item){
						var nama_produk = item.nama_produk;
						var id_produk = item.id_produk;
						list_name.push(id_produk+' - '+nama_produk);
					});
					
					$("#nama_paket_"+x).autocomplete({
						source: list_name,
						select: function( event , ui ) {
							if(ui.item.label == 'Produk tidak ditemukan'){
								$('#nama_paket_'+x).val('');
								$('#id_paket_'+x).val('');
								$('#qty_paket_'+x).val('');
							}else{
								var str = (ui.item.label).split(' - ');
								var index = str[0];
								var id_produk = datax.user_list[index]['id_produk'];
								var nama_produk = datax.user_list[index]['nama_produk'];
								$('#nama_paket_'+x).val(nama_produk);
								$('#id_paket_'+x).val(id_produk);
								$('#qty_paket_'+x).val(1);
							}
						},
						response: function(event, ui) {
							if (!(ui.content.length)) {
									var noResult = { value:"",label:"Produk tidak ditemukan, Silahkan Tambah produk terlebih dahulu" };
									ui.content.push(noResult);
							}
						}
					});
					
					if(datax.code != '0'){
						$('#nama_paket_'+x).val('');
						$('#id_paket_'+x).val('');
						$('#qty_paket_'+x).val('');
					}
			}
		});
	}
	
	
	function check_qty(x){
		if((decimal($('#qty_paket_'+x).val())*1 < 1)){
			alert('Quantity minimal 1');
			$('#qty_paket_'+x).val(1);
		}
	}
	
	
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
		hitung_all();
	}
	
	function hitung_item(){
		var jum = $('#kuantitas_'+x).val();
		var harga = $('#harga_satuan_dec_'+x).val();
		var qty = jum;
		$('#kuantitas_'+x).val(qty);
		var total = qty * harga;
		$('#jumlah_'+x).val(curency(total));
		$('#jumlah_dec_'+x).val(total);
		hitung_all();
		
	}
	
	function delete_produk(x){
		document.getElementById('produk_'+x+'').style.display = "none";
		$('#id_produk_'+x).val('');
		$('#nama_produk_'+x).val('');
		$('#kuantitas_'+x).val('');
		$('#deskripsi_'+x).val('');
		$('#harga_beli_'+x).val('');
		$('#harga_jual_'+x).val('');
		$('#qty_'+x).val('');
		$('#minimum_'+x).val('');
		$('#jumlah_'+x).val('');
		$('#satuan_'+x).val('');
		hitung_all();
		hitung_all();
	}
	
	function check_supplier(){
		if($("#nama_pelanggan").val() != '' && $('#id_pelanggan').val() == ''){
			$("#nama_pelanggan").val('');
		}
	}
	
	function cari_pelanggan(x){
		var currentRequest = null;
		currentRequest = $.ajax({
			url: '<?php echo base_url()?>index.php/expenses/search_supplier',
			type: "POST",
			beforeSend : function()    {           
				if(currentRequest != null) {
					currentRequest.abort();
				}
			},
			data: {pn_name:$('#nama_pelanggan').val()},
			success: function(datax) {
				if($("#nama_pelanggan").val() == ''){
					$('#id_pelanggan').val('');
					$('#alamat_penagihan').val('');
					$('#email_pelanggan').val('');
				}
				var datax = JSON.parse(datax);
					var list_name = new Array();
					$.each(datax.data, function(i, item){
						var pn_id = item.id_supplier;
						var pn_name = item.nama;
						
						var temp_name = pn_id+' - '+pn_name;
						list_name.push(temp_name);
					});
					$("#nama_pelanggan").autocomplete({
						source: list_name,
						select: function( event , ui ) {
							if(ui.item.label == 'Tidak ditemukan, klik untuk menambah supplier'){
								$('#modal-product').modal();
								$('#id_pelanggan').val('');
								$('#alamat_penagihan').val('');
								$('#email_pelanggan').val('');
								$('#nama_supplier').val($("#nama_pelanggan").val());
								document.getElementById('modal-create').style="padding:right:0px !important";
							}else{
								var str = (ui.item.label).split(' -');
								var index = str[0];
								var user_id = datax.user_list[index]['id_supplier'];
								var user_name = datax.user_list[index]['nama'];
								var alamat = datax.user_list[index]['alamat'];
								var no_hp = datax.user_list[index]['nomor_telpon'];
								var email = datax.user_list[index]['email'];
								$('#id_pelanggan').val(user_id);
								$('#alamat_penagihan').val(alamat);
								$('#email_pelanggan').val(email);
								$("#nama_pelanggan").val(user_name);
							}
						},
						response: function(event, ui) {
							if (!(ui.content.length)) {
									$('#id_pelanggan').val('');
									$('#alamat_penagihan').val('');
									$('#email_pelanggan').val('');
									var noResult = { value:"",label:"Tidak ditemukan, klik untuk menambah supplier" };
									ui.content.push(noResult);
							}
						}
					});
			}
		});
	}
	
	function cari_produk(x){
		$('#id_produk_'+x).val('');
		$('#qty_'+x).val('');
		$('#deskripsi_'+x).val('');
		$('#satuan_'+x).val('');
		$('#harga_beli_'+x).val('');
		$('#harga_jual_'+x).val('');
		$('#minimum_'+x).val('');
		$('#jumlah_'+x).val('');
		hitung_all();					 
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/search_produk',
			type: "POST",
			data: {pn_name:$('#nama_produk_'+x).val()},
			success: function(datax) {
				var datax = JSON.parse(datax);

					var list_name = new Array();
					$.each(datax.data, function(i, item){
						var nama_produk = item.nama_produk;
						var id_produk = item.id_produk;
						list_name.push(id_produk+' - '+nama_produk);
					});
					
					$("#nama_produk_"+x).autocomplete({
						source: list_name,
						select: function( event , ui ) {
							if(ui.item.label == 'Produk tidak ditemukan'){
								tambah_product(x);
								$('#id_produk_'+x).val('');
								$('#kuantitas_'+x).val('');
								$('#deskripsi_'+x).val('');
								$('#harga_beli_'+x).val('');
								$('#harga_jual_'+x).val('');
								$('#qty_'+x).val('');
								$('#minimum_'+x).val('');
								$('#jumlah_'+x).val('');
								$('#satuan_'+x).val('');
								hitung_all();
							}else{
								var str = (ui.item.label).split(' - ');
								var index = str[0];
								var id_produk = datax.user_list[index]['id_produk'];
								var nama_produk = datax.user_list[index]['nama_produk'];
								var satuan = datax.user_list[index]['satuan'];
								var deskripsi = datax.user_list[index]['deskripsi'];
								var harga_beli = datax.user_list[index]['harga_beli'];
								var harga_jual = datax.user_list[index]['harga_jual'];
								var stock_minimum = datax.user_list[index]['stock_minimum'];
								$('#id_produk_'+x).val(id_produk);
								$('#kuantitas_'+x).val(1);
								$('#deskripsi_'+x).val(deskripsi);
								$('#harga_beli_'+x).val(curency(harga_beli));
								$('#harga_jual_'+x).val(curency(harga_jual));
								$('#qty_'+x).val(1);
								$('#minimum_'+x).val(curency(stock_minimum));
								$('#jumlah_'+x).val(curency(harga_beli));
								$('#nama_produk_'+x).val(str[1]);
								$('#satuan_'+x).val(satuan);
								hitung_all();
							}
						},
						response: function(event, ui) {
							if (!(ui.content.length)) {
									var noResult = { value:"",label:"Produk tidak ditemukan" };
									ui.content.push(noResult);
							}
						}
					});
					
					if(datax.code != '0'){
						$('#id_produk_'+x).val('');
						$('#kuantitas_'+x).val('');
						$('#harga_satuan_dec_'+x).val('');
						//var jumlah = harga;
						$('#jumlah_'+x).val('');
						$('#jumlah_dec_'+x).val(0);
						$('#satuan_'+x).val('');
						$('#harga_satuan_'+x).val('');
						hitung_all();
					}
			}
		});
	}
	
	function check_produk(x){
		if($('#nama_produk_'+x).val() != '' && $('#kuantitas_'+x).val() == '' && $('#harga_satuan_'+x).val() == ''){
			$('#nama_produk_'+x).val('');
		}
	}
	
	function hitung_all(){
		var counter = $('#counter').val();
		var subtotal = 0;
		
		for(i=1;i<=counter;i++){
			var qty = decimal($('#qty_'+i).val());
			var beli = decimal($('#harga_beli_'+i).val());
			$('#jumlah_'+i).val(curency(beli * qty));
			subtotal = (subtotal*1) + (beli * qty) *1;
		}
		var ppn = decimal($('#ppn').val()) *1;
		var discount = decimal($('#discount').val()) * 1;
		$('#subtotal').val(curency(subtotal));
		
		var total = subtotal+ppn-discount;
		$('#total').val(curency(total))
		
	}
	
	function save_supplier(x){
		var prefix = "";
		if(x == 1){
			prefix = 's_';
		}else if(x == 2){
			prefix = 'n_';
		}else if(x == 3){
			prefix = 'p_';
		}else if(x == 4){
			prefix = 'j_';
		}
		if($('#name_supplier').val() == ''){
			alert('Nama Supplier tidak boleh kosong !');
		}
		
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/save_supplier',
			type: "POST",
			data: {
				title:$('#title_supplier').val(),
				nama:$('#nama_supplier').val(),
				nama_pt:$('#nama_pt_supplier').val(),
				alamat:$('#alamat_supplier').val(),
				catatan:$('#note_supplier').val(),
				email:$('#email_supplier').val(),
				nomor_telpon:$('#phone_supplier').val(),
				fax:$('#fax_supplier').val(),
				website:$('#website_supplier').val(),
				biling_rate:$('#rate_supplier').val(),
				maxsimum_order:$('#maksimum_supplier').val(),
				balance:$('#balance_supplier').val(),
				bussiness_id:$('#bisnis_no_supplier').val(),
			},
			success: function(datax) {
				var datax = JSON.parse(datax);
				if(datax.code == 0){
					var nm = datax.data+' - '+$('#nama_supplier').val();
					$('#nama_pelanggan').val(nm);
					$('#id_pelanggan').val(datax.data);
					$('#email_pelanggan').val($('#email_supplier').val());
					$('#alamat_penagihan').val($('#alamat_supplier').val());
					$('#modal-product').modal('hide');
				}else{
					alert('Gagal simpan Supplier, mohon ulangi kembali !');
				}
			}
		});
	}
</script>
