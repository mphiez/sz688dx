<?php $this->load->view('header');?>
	<style>
		#modal-create{
			padding-right:0px !Important;
		}
		.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
			background-color: #fff !important;
			opacity: 1;
		}
		.hover_inv:hover{
			background:#f8f8f8;
		}
	</style>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Buat Pembayaran</h1>
			</div>
		</div>
		<?php if($data_invoice > 0){
			foreach($data_invoice as $row){
				$id_pelanggan 		= $row->id_pelanggan;
				$nama_pelanggan 		= $row->nama_pelanggan;
				$email 				= $row->email;
				$id_pelanggan 		= $row->id_pelanggan;
				$alamat_tagih 		= $row->alamat_tagih;
				$nomor_invoice 		= $row->nomor_invoice;
				$jumlah_bayar 		= number_format($row->tagihan);
				$nomor_transaksi 	= $row->nomor_transaksi;
				$tanggal_transaksi 	= date("d/m/Y",strtotime($row->tanggal_transaksi));
			}
			
		?>
        <div class="row">
			<div class="col-xs-12">
				<form enctype="multipart/form-data" id="submit">
					<div class="col-md-12" <?php if($load_data == 0){echo "style='display:none'";}?>>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Nama Pelanggan</label>
								<input type="hidden" id="id_pelanggan" value="<?php echo $id_pelanggan?>">
								<input type="hidden" id="tipe_transaksi" value="0">
								<input type="hidden" id="counter" value="<?php echo count($data_pelanggan)?>">
								<input type="text" id="nama_pelanggan"  onkeyup="return cari_pelanggan()" value="<?php echo $nama_pelanggan?>" class="form-control" placeholder="[Auto]">
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Email</label>
								<input type="text" id="email_pelanggan" class="form-control" value="<?php echo $email?>">
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Alamat Penagihan</label>
								<textarea id="alamat_penagihan" class="form-control" ><?php echo $alamat_tagih?></textarea>
							</div>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="col-sm-6 col-md-3">
							<div class="form-group" >
								<label>Tanggal Pembayaran</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="tanggal_transaksi" readonly class="form-control date" value="<?php echo $tanggal_transaksi?>">
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-3">
							<div class="form-group" >
								<label>No Referensi</label>
								<input type="text" id="no_referensi" class="form-control moneydec">
							</div>
						</div>
						<div class="col-sm-6 col-md-3" style="display:none">
							<div class="form-group">
								<label>Nomor Transaksi</label>
								<div class="input-group">
									<?php $id_transaksi = counter('c_sales')?>
									<input type="text" id="nomor_transaksi" class="form-control" placeholder="[Auto]" value="<?php echo $nomor_transaksi?>">
									<div class="input-group-addon">
										<input type="checkbox" id="transaksi_otomatis" checked onclick="return auto_transaksi()"> Auto
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"  style="display:none;">
							<div class="form-group" >
								<label>Tanggal Invoice</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="tanggal_invoice" class="form-control date" value="">
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"  style="display:none;">
							<div class="form-group">
								<label>Term Of Payment (Hari)</label>
								<select id="top" class="form-control">
									<option value="10">NET 10</option>
									<option value="15">NET 15</option>
									<option value="30">NET 30</option>
								</select>
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
						<div class="col-sm-6 col-md-3" style="display:none;">
							<div class="form-group">
								<label>Nomor Faktur Pajak</label>
								<input type="text" id="nomor_faktur" class="form-control" placeholder="[Auto]">
							</div>
						</div>
					</div>
					<div class="col-md-12" <?php if($load_data == 0){echo "style='display:none'";}?>>
						<div class="col-sm-6 col-md-6">
							<div class="form-group">
								<label>Invoice Berlangsung</label>
								<ul class="navbar" style="margin-right: 0px;list-style: none;">
									<li class="dropdown">
										<a class="dropdown-toggle btn btn-success" data-toggle="dropdown" href="#" style="padding: 5px 15px;margin-top:15px;">
											<i class="fa fa-shopping-cart fa-fw"></i> Outstanding Invoice <i class="fa fa-caret-down"></i>
										</a>
										<ul class="dropdown-menu dropdown-messages">
											<?php if($data_pelanggan > 0){
												$i = 1;
											foreach($data_pelanggan as $row){
												if($nomor_invoice != $row->nomor_invoice){
												$i++;
											?>
											<li class="divider"></li>
											<li>
												<div class="form-group col-md-12 hover_inv" onclick="return select_invoice(<?php echo $i?>);" style="padding: 5px 3px;margin-bottom:2px;">
													<div class="col-md-1"><input type="checkbox" id="id_invoice_<?php echo $i?>" onclick="return select_invoice(<?php echo $i?>);"></div>
													<label class="col-md-8"><?php echo $row->nomor_invoice?></label>
												</div>
											</li>
											<?php } } }?>
										</ul>
									</li>
									<i style="color:red">Silahkan klik tombol Outstanding Invoice, untuk pilih invoice dari <b><?php echo $nama_pelanggan?> </b></i>
								</ul>
								
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<table class="table table-hover table-strips">
							<thead>
								<tr>
									<th width="20%">Nomor Transaksi</th>
									<th width="20%">Nomor Invoice</th>
									<th width="20%">Nomor Referensi</th>
									<th width="20%">Total Tagihan</th>
									<th width="20%">Jumlah Pembayaran</th>
								</tr>
							</thead>
							<tbody id="produk">
								<tr id="produk_1">
									<td>
										<input type="text" id="no_transaksi_1" value="<?php echo $nomor_transaksi?>" class="form-control">
										<input type="hidden" id="id_cust_1" value="<?php echo $id_pelanggan?>" class="form-control">
										<input type="hidden" id="pay_this_1" value="1" class="form-control">
									</td>
									<td>
										<input type="text" id="no_invoice_1" readonly value="<?php echo $nomor_invoice?>" class="form-control">
									</td>
									<td>
										<input type="text" id="referensi_pembayaran_1" class="form-control">
									</td>
									<td>
										<input type="text" id="jumlah_1"  value="<?php echo $jumlah_bayar?>" class="form-control" readonly>
									</td>
									<td>
										<input type="text" id="bayar_1" value="<?php echo $jumlah_bayar?>" class="form-control money" onkeyup="return check_payment(1)">
									</td>
								</tr>
								<?php if($data_pelanggan > 0){
										$i = 1;
									foreach($data_pelanggan as $row){
										if($nomor_invoice != $row->nomor_invoice){
										$i++;
									?>
									<tr id="produk_<?php echo $i?>" style="display:none">
										<td>
											<input type="text" id="no_transaksi_<?php echo $i?>" value="<?php echo $row->nomor_transaksi?>" class="form-control">
											<input type="hidden" id="id_cust_<?php echo $i?>" value="<?php echo $row->id_pelanggan?>" class="form-control">
											<input type="hidden" id="pay_this_<?php echo $i?>" value="0" class="form-control">
										</td>
										<td>
											<input type="text" class="form-control" id="no_invoice_<?php echo $i?>" readonly value="<?php echo $row->nomor_invoice?>">
										</td>
										<td>
											<input type="text" id="referensi_pembayaran_<?php echo $i?>" class="form-control">
										</td>
										<td>
											<input type="text" id="jumlah_<?php echo $i?>"  value="<?php echo number_format($row->tagihan)?>" class="form-control" readonly>
										</td>
										<td>
											<input type="text" id="bayar_<?php echo $i?>" value="<?php echo number_format($row->tagihan)?>" class="form-control money" onkeyup="return check_payment(<?php echo $i?>)">
										</td>
									</tr>
								<?php } } }?>
							</tbody>
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
							<div class="form-group  pull-right" style="display:none">
								<span>Subtotal</span>
								<div class="input-group">
									<input type="text" id="subtotal" readonly class="form-control">
								</div>
							</div>
							<div class="form-group pull-right" style="display:none">
								<span>Potongan</span>
								<div class="input-group">
									<input type="text" id="discount" onkeyup="return hitung_all()" class="form-control money" >
								</div>
							</div>
							<div class="form-group pull-right" style="display:none">
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
				</form>
			</div>
		</div>
		<?php }?>
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
	
	function select_invoice(x){
		if ($('#id_invoice_'+x).is(':checked')) {
			$('#produk_'+x).css('display','');
			$('#pay_this_'+x).val('1');
			//$("#id_invoice_"+x).attr("checked", false);
		}else{
			$('#produk_'+x).css('display','none');
			$('#pay_this_'+x).val('0');
			//$("#id_invoice_"+x).attr("checked", true);
		}
	}
	
	function decimal(x=''){
		if(x == ''){
			x = 0;
		}
		return x.toString().replace(/[^0-9.-]+/g,"");
	}
	
	$('.date').datepicker({
		format: "dd/mm/yyyy",
		autoclose: true,
	});
	
	function check_payment(x){
		if(decimal($('#bayar_'+x).val()) *1 > decimal($('#jumlah_'+x).val()) *1){
			alert('Pembayaran tidak boleh lebih besar dari total tagihan');
			$('#bayar_'+x).val($('#jumlah_'+x).val());
		}
	}
	
	$(".chosen-select").chosen({no_results_text: "Tidak Ditemukan, klik di sini untuk menambahkan", width: "100%"}); 
	
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
				referensi_pembayaran	:$('#referensi_pembayaran_'+i).val(),
				no_invoice				:$('#no_invoice_'+i).val(),
				nomor_transaksi			:$('#no_transaksi_'+i).val(),
				total					:$('#jumlah_'+i).val(),
				id_customer				:$('#id_cust_'+i).val(),
				bayar					:$('#bayar_'+i).val(),
			}
			if($('#no_invoice_'+i).val() != '' && $('#no_transaksi_'+i).val() != '' && decimal($('#bayar_'+i).val())*1 > 0 && $('#pay_this_'+i).val() == 1){
				transaksi.push(temp);
			}
		}
		
		if(transaksi.length > 0){
			$.ajax({
				url: '<?php echo base_url()?>index.php/transaksi/save_bayar',
				type: "POST",
				data: {
					no_referensi		: $('#no_referensi').val(),
					metode_pembayaran	: $('#metode_pembayaran').val(),
					tanggal_bayar		: $('#tanggal_transaksi').val(),
					nm_debit 			: $('#tujuan_transfer').val(),
					pesan 				: $('#tujuan_transfer').val(),
					transaksi			: transaksi
				},
				success: function(datax) {
					var datax = JSON.parse(datax);
					if(datax.code == 0 && $('#image_file').val() != ''){
						var formData = new FormData();
						formData.append('file', $('input[type=file]')[0].files[0]);
						$.ajax({
							url:'<?php echo base_url()?>index.php/transaksi/save_bukti_bayar?mp='+datax.data.name+'&id='+(datax.data.id),
							type:"post",
							data:  formData,
							processData:false,
							contentType:false,
							cache:false,
							async:false,
							success: function(data){
								alert('Pembayaran berhasil');
								location.replace('<?php echo base_url()?>index.php/transaksi');
							  
							}
						});
					}else if(datax.code == 1){
						alert('Simpan gagal !');
					}else{
						alert('Pembayaran berhasil !');
						location.replace('<?php echo base_url()?>index.php/transaksi');
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
	
	function add_product(){
		var num = $('#counter').val();
		num++;
		$('#produk').append('<tr id="produk_'+num+'">'+
									'<td>'+
										'<div class="input-group">'+
											'<div class="input-group-addon" onclick="return delete_produk('+num+')">'+
												'<i class="fa fa-trash"></i>'+
											'</div>'+
											'<input type="text" id="no_invoice_'+num+'" onkeyup="return cari_invoice('+num+')" onchange="return check_produk('+num+')" class="form-control">'+
										'</div>'+
									'</td>'+
									'<td>'+
										'<input type="text" id="no_transaksi_'+num+'" onkeyup="return cari_transaksi('+num+')" class="form-control">'+
										'<input type="hidden" id="id_cust_'+num+'" class="form-control">'+
									'</td>'+
									'<td>'+
										'<input type="text" id="referensi_pembayaran_'+num+'" class="form-control" readonly>'+
									'</td>'+
									'<td>'+
										'<input type="text" id="jumlah_'+num+'" class="form-control" readonly>'+
									'</td>'+
									'<td>'+
										'<input type="text" id="bayar_'+num+'" class="form-control money" onkeyup="return check_payment('+num+')">'+
									'</td>'+
								'</tr>');
		$('#counter').val(num);
		$(".chosen-select").chosen({no_results_text: "Tidak Ditemukan, klik di sini untuk menambahkan", width: "100%"}); 
	}
	
	function tujuan(){
		if($('#metode_pembayaran').val() == 'cash'){
			$('#tujuan_transfer').val('');
			$('#tujuan_transfer').attr('disabled','disabled');
		}else{
			$('#tujuan_transfer').removeAttr('disabled');
		}
	}
	
	function delete_produk(x){
		document.getElementById('produk_'+x+'').style.display = "none";
		$('#id_produk_'+x).val('');
		$('#kuantitas_'+x).val('');
		//var jumlah = harga;
		$('#jumlah_'+x).val('');
		$('#jumlah_dec_'+x).val(0);
		$('#satuan_'+x).val('');
		$('#harga_satuan_'+x).val('');
		$('#harga_satuan_dec_'+x).val('');
	}
	
	function cari_invoice(x){
		$('#no_transaksi_'+x).val('');
		$('#jumlah_'+x).val('');
		$('#bayar_'+x).val('');
		$('#id_cust_'+x).val('');
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/search_invoice',
			type: "POST",
			data: {pn_name:$('#no_invoice_'+x).val()},
			success: function(datax) {
				if($("#no_invoice_"+x).val() == ''){
					$('#no_invoice_'+x).val('');
				}
				var datax = JSON.parse(datax);
					var list_name = new Array();
					$.each(datax.data, function(i, item){
						var pn_id = item.nomor_invoice;
						
						var temp_name = pn_id;
						list_name.push(temp_name);
					});
					$('#no_invoice_'+x).autocomplete({
						source: list_name,
						select: function( event , ui ) {
							if(ui.item.label == 'Tidak ditemukan'){
								$('#no_invoice_'+x).val('');
								$('#no_transaksi_'+x).val('');
								$('#jumlah_'+x).val('');
								$('#bayar_'+x).val('');
								$('#id_cust_'+x).val('');
							}else{
								var str = (ui.item.label).split(' -');
								var index = str[0];
								var nomor_invoice = datax.user_list[index]['nomor_invoice'];
								var nomor_transaksi = datax.user_list[index]['nomor_transaksi'];
								var sub_total = datax.user_list[index]['sub_total'];
								var jumlah_pajak = datax.user_list[index]['jumlah_pajak'];
								var discount = datax.user_list[index]['discount'];
								var jumlah_bayar = datax.user_list[index]['tagihan'];
								var id_customer = datax.user_list[index]['id_pelanggan'];
								$('#no_invoice_'+x).val(nomor_invoice);
								$('#no_transaksi_'+x).val(nomor_transaksi);
								$('#jumlah_'+x).val(curency(jumlah_bayar));
								$('#bayar_'+x).val(curency(jumlah_bayar));
								$('#id_cust_'+x).val(id_customer);
							}
						},
						response: function(event, ui) {
							if (!(ui.content.length)) {
									$('#no_transaksi_'+x).val('');
									$('#jumlah_'+x).val('');
									$('#bayar_'+x).val('');
									$('#id_cust_'+x).val('');
									var noResult = { value:"",label:"Tidak ditemukan" };
									ui.content.push(noResult);
							}
						}
					});
			}
		});
	}
	
	function cari_transaksi(x){
		$('#no_invoice_'+x).val('');
		$('#jumlah_'+x).val('');
		$('#bayar_'+x).val('');
		$('#id_cust_'+x).val('');
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/search_transaksi',
			type: "POST",
			data: {pn_name:$('#no_transaksi_'+x).val()},
			success: function(datax) {
				if($("#no_transaksi_"+x).val() == ''){
					$('#no_transaksi_'+x).val('');
				}
				var datax = JSON.parse(datax);
					var list_name = new Array();
					$.each(datax.data, function(i, item){
						var pn_id = item.nomor_transaksi;
						
						var temp_name = pn_id;
						list_name.push(temp_name);
					});
					$('#no_transaksi_'+x).autocomplete({
						source: list_name,
						select: function( event , ui ) {
							if(ui.item.label == 'Tidak ditemukan'){
								$('#no_invoice_'+x).val('');
								$('#no_transaksi_'+x).val('');
								$('#jumlah_'+x).val('');
								$('#bayar_'+x).val('');
								$('#id_cust_'+x).val('');
							}else{
								var str = (ui.item.label).split(' -');
								var index = str[0];
								var nomor_invoice = datax.user_list[index]['nomor_invoice'];
								var nomor_transaksi = datax.user_list[index]['nomor_transaksi'];
								var sub_total = datax.user_list[index]['sub_total'];
								var jumlah_pajak = datax.user_list[index]['jumlah_pajak'];
								var discount = datax.user_list[index]['discount'];
								var jumlah_bayar = datax.user_list[index]['tagihan'];
								var id_customer = datax.user_list[index]['id_pelanggan'];
								$('#no_invoice_'+x).val(nomor_invoice);
								$('#no_transaksi_'+x).val(nomor_transaksi);
								$('#jumlah_'+x).val(curency(jumlah_bayar));
								$('#bayar_'+x).val(curency(jumlah_bayar));
								$('#id_cust_'+x).val(id_customer);
							}
						},
						response: function(event, ui) {
							if (!(ui.content.length)) {
									$('#no_invoice_'+x).val('');
									$('#jumlah_'+x).val('');
									$('#bayar_'+x).val('');
									$('#id_cust_'+x).val('');
									var noResult = { value:"",label:"Tidak ditemukan" };
									ui.content.push(noResult);
							}
						}
					});
			}
		});
	}
	
	function check_produk(x){
		if($('#jumlah_'+x).val() != '' && ($('#no_invoice_'+x).val() == '' || $('#no_transaksi_'+x).val() == '')){
			$('#no_invoice_'+x).val('');
			$('#no_transaksi_'+x).val('');
			$('#jumlah_'+x).val('');
			$('#ppn_'+x).val('');
			$('#diskon_'+x).val('');
			$('#jumlah_'+x).val('');
			$('#id_cust_'+x).val('');
		}
	}
</script>
