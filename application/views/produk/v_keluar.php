<?php $this->load->view('header');?>
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
	</style>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Penyerahan Produk dan Jasa</h1>
			</div>
		</div>
        <div class="row">
			<?php if($data_produk > 0){
			?>
			<div class="col-md-12">
				<div class="col-sm-6 col-md-3">
					<div class="form-group" >
						<label>Nomor Transaksi</label>
						<?php echo counter('c_spj');?>
						<input type="text" id="nomor_faktur" class="form-control" readonly value="<?php echo $data_produk[0]->nomor_transaksi;?>">
					</div>
				</div>
			</div>
			<div class="col-md-12">
			
				<div class="col-sm-6 col-md-3">
					<div class="form-group" id="tujuan">
						<label>Nama Pelanggan</label>
						<input type="text" id="nomor_faktur" class="form-control" readonly value="<?php echo $data_produk[0]->ship_to_name;?>">
					</div>
				</div>
				<div class="col-sm-6 col-md-3" id="top_inv">
					<div class="form-group">
						<label>ID Pelanggan</label>
						<input type="text" id="nomor_faktur" class="form-control" readonly value="<?php echo $data_produk[0]->id_pelanggan;?>">
					</div>
				</div>
				<div class="col-sm-6 col-md-3" id="top_inv">
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" id="nomor_faktur" class="form-control" readonly value="<?php echo $data_produk[0]->ship_address;?>">
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-sm-6 col-md-3" id="top_inv">
					<div class="form-group">
						<label>Nomor Telpon</label>
						<input type="text" id="nomor_faktur" class="form-control" readonly value="<?php echo $data_produk[0]->ship_phone;?>">
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group" id="tujuan">
						<label>Email</label>
						<input type="text" id="nomor_faktur" class="form-control" readonly value="<?php echo $data_produk[0]->ship_email;?>">
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group">
						<label>Pesan</label>
						<input type="text" id="nomor_faktur" class="form-control" readonly value="<?php echo $data_produk[0]->pesan;?>">
					</div>
				</div>
			</div>
			<?php }?>
			<div class="col-xs-12">
				<form enctype="multipart/form-data" id="submit">
					<div class="col-md-12">
						<table class="table table-hover table-strips">
							<thead>
								<tr>
									<th width="28%">Nama Produk</th>
									<th width="15%">Deskripsi</th>
									<th width="7%">Satuan</th>
									<th width="12%">Kuantitas</th>
								</tr>
							</thead>
							<tbody id="produk">
								<input type="hidden" id="counter" class="form-control" value="<?php echo count($data_produk)?>">
								<?php if($data_produk > 0){
									$i = 0;
									foreach($data_produk as $row){
										$i++;
										if($row->ak < $row->ab){
									?>
								<tr id="produk_<?php echo $i?>">
									<td>
										<div class="input-group">
											<div class="input-group-addon" onclick="return delete_paket(<?php echo $i?>)">
												<i class="fa fa-trash"></i>
											</div>
											<input type="text" id="nama_produk_<?php echo $i?>" class="form-control" readonly value="<?php echo $row->nama_produk?>">
											<input type="hidden" id="id_produk_<?php echo $i?>" class="form-control" value="<?php echo $row->id_produk?>">
											<input type="hidden" id="id_<?php echo $i?>" class="form-control" value="<?php echo $row->id_ref?>">
										</div>
									</td>
									<td><textarea style="height: 33px;" id="deskripsi_<?php echo $i?>" class="form-control" value="<?php echo $row->deskripsi?>"></textarea></td>
									<td><input type="text" id="satuan_<?php echo $i?>" class="form-control" readonly value="<?php echo $row->satuan?>"></td>
									<td>
										<input type="text" id="kuantitas_<?php echo $i?>" onkeyup="return check_qty(<?php echo $i?>)" class="form-control money" value="<?php echo $row->ab - $row->ak?>">
										<input type="hidden" id="kuantitas_max_<?php echo $i?>" class="form-control" value="<?php echo $row->ab - $row->ak?>">
									</td>
								</tr>
									<?php } } }?>
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
				</form>
			</div>
		</div>
	</div>
	<div id="modal-print-sales" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Detail Invoice</h4>
		  </div>
		  <div class="modal-body">
			<div class="row table-responsive" style="max-height:75vh">
				<div class="col-md-12" id="body-invoice">
					<p><h3>Nomor Transaksi Anda : <span id="no_transaksi"></span></h3></p>
					<p>Silahkan melakukan pencetakan transaksi</p>
				</div>
			</div>
		  </div>
		  <div class="modal-footer" id="field_print">
			
		  </div>
		</div>
	  </div>
	</div>
</div>
<?php $this->load->view('footer');?>
<script>
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
	
	$('#submit').submit(function(e){
		var counter = $('#counter').val();
		var transaksi = new Array();
		if($('#metode_pembayaran').val() != "cash" && $('#tujuan_transfer').val() == ""){
			alert("Silahkan pilih tujuan pembayaran !");
			return false;
		}
		
		
		document.getElementById('btn_save').innerHTML = '<span class="btn btn-success pull-right"><i class="fa fa-spinner"></i> Simpan</span>';
		
		for(i=1;i<=counter;i++){
			var temp = {
				nama_barang	:$('#nama_produk_'+i).val(),
				id_barang	:$('#id_produk_'+i).val(),
				deskripsi	:$('#deskripsi_'+i).val(),
				qty	:$('#kuantitas_'+i).val(),
				transaksi	:$('#id_'+i).val()
			}
			if($('#kuantitas_'+i).val() > 0 && $('#id_produk_'+i).val() != ''){
				transaksi.push(temp);
			}
		}
		
		if(transaksi.length > 0){
			$.ajax({
				url: '<?php echo base_url()?>index.php/produk/save_keluar',
				type: "POST",
				data: {
					transaksi 			: transaksi
				},
				success: function(datax) {
					var datax = JSON.parse(datax);
					if(datax.code == 0){
						$('#field_print').empty();
						$('#field_print').append('<a class="btn btn-info" target="blank" href="<?php echo base_url()?>index.php/produk/print_spj?id='+datax.data+'">Print</a><a  class="btn btn-default" href="<?php echo base_url()?>index.php/transaksi">Tutup</a>');
						
						$('#modal-print-sales').modal();
					}else if(datax.code == 2){
						alert('Simpan gagal, stock '+datax.info+' tidak cukup !');
					}else{
						alert('Simpan gagal !');
					}
					document.getElementById('btn_save').innerHTML = '<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>';
				}
			});
		}else{
			document.getElementById('btn_save').innerHTML = '<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>';
			alert('Tidak ada transaksi !');
			$('#invoice_status').val(0);
		}
		return false;
	});
	
	function check_qty(x){
		var qty = decimal($('#kuantitas_'+x).val()) *1;
		var max = decimal($('#kuantitas_max_'+x).val()) *1;
		var max_cur = $('#kuantitas_max_'+x).val();
		if(qty > max){
			alert('Kuantitas tidak boleh lebih besar dari jumlah yang seharusnya dikirim !');
			$('#kuantitas_'+x).val((max_cur));
		}
	}
	
	
	
	function delete_paket(x){
		$('#produk_'+x).css('display','none');
		$('#deskripsi_'+x).val('');
		$('#satuan_'+x).val('');
		$('#kuantitas_'+x).val('');
	}
</script>
