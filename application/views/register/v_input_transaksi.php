<?php $this->load->view('header');?>
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
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Nama Pelanggan</label>
								<input type="text" id="nama_pelanggan" class="form-control" placeholder="[Auto]">
								<!--<input type="hidden" id="id_pelanggan">-->
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Email</label>
								<input type="text" id="email_pelanggan" class="form-control">
							</div>
						</div>
						<div class="col-sm-12 col-md-3">
							<div class="form-group" >
								<label>No Referensi</label>
								<input type="text" id="no_referensi" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Alamat Penagihan</label>
								<textarea id="alamat_penagihan" class="form-control" ></textarea>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group" >
								<label>Tanggal Transaksi</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="tanggal_transaksi" class="form-control" value="<?php echo date('d/m/Y')?>">
								</div>
							</div>
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
						<div class="col-sm-12 col-md-3">
							<div class="form-group">
								<label>Nomor Transaksi</label>
								<input type="text" id="nomor_transaksi" class="form-control" placeholder="[Auto]">
							</div>
							<div class="form-group" id="tujuan" style="display:none">
								<label>Tujuan</label>
								<select id="tujuan_transfer" class="form-control">
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
					</div>
					<div class="col-md-12">
						<table class="table table-hover table-strips">
							<thead>
								<tr>
									<th width="28%">Nama Produk</th>
									<th width="15%">Deskripsi</th>
									<th width="12%">Kuantitas</th>
									<th width="7%">Satuan</th>
									<th width="10%">Harga Satuan</th>
									<th width="10%">Pajak</th>
									<th width="22%">Jumlah</th>
								</tr>
							</thead>
							<tbody id="produk">
								<tr id="produk_1">
									<td>
										<div class="input-group">
											<div class="input-group-addon" onclick="return delete_produk(1)">
												<i class="fa fa-trash"></i>
											</div>
											<input type="text" id="nama_produk_1" onkeyup="return cari_produk(1)" class="form-control">
											<input type="hidden" id="id_produk_1" class="form-control">
											<input type="hidden" id="counter" class="form-control" value="2">
										</div>
									</td>
									<td><textarea style="height: 33px;" id="deskripsi_1" class="form-control"></textarea></td>
									<td>
										<div class="input-group">
											<div class="input-group-addon" style="padding: 5px;">
												<button type="button" onclick="return min_item(1)">-</button>
											</div>
											<input type="text" id="kuantitas_1" onkeyup="return hitung_item(1)" class="form-control">
											<div class="input-group-addon" style="padding: 5px;">
												<button type="button" onclick="return add_item(1)">+</button>
											</div>
										</div>
									</td>
									<td><input type="text" id="satuan_1" class="form-control" readonly></td>
									<td>
										<input type="text" id="harga_satuan_1" class="form-control" readonly>
										<input type="hidden" id="harga_satuan_dec_1" class="form-control" readonly>
									</td>
									<td><input type="text" id="pajak_1" class="form-control"></td>
									<td>
										<input type="text" id="jumlah_1" class="form-control" readonly>
										<input type="hidden" id="jumlah_dec_1" value="0" class="form-control" readonly>
									</td>
								</tr>
								<tr id="produk_2">
									<td>
										<div class="input-group">
											<div class="input-group-addon" onclick="return delete_produk(2)">
												<i class="fa fa-trash"></i>
											</div>
											<input type="text" id="nama_produk_2" onkeyup="return cari_produk(2)" class="form-control">
											<input type="hidden" id="id_produk_2" class="form-control">
										</div>
									</td>
									<td><textarea style="height: 33px;" id="deskripsi_2" class="form-control"></textarea></td>
									<td>
										<div class="input-group">
											<div class="input-group-addon" style="padding: 5px;">
												<button type="button" onclick="return min_item(2)">-</button>
											</div>
											<input type="text" id="kuantitas_2" onkeyup="return hitung_item(1)" class="form-control">
											<div class="input-group-addon" style="padding: 5px;">
												<button type="button" onclick="return add_item(2)">+</button>
											</div>
										</div>
									</td>
									<td><input type="text" id="satuan_2" class="form-control" readonly></td>
									<td>
										<input type="text" id="harga_satuan_2" class="form-control" readonly>
										<input type="hidden" id="harga_satuan_dec_2" class="form-control" readonly>
									</td>
									<td><input type="text" id="pajak_2" class="form-control"></td>
									<td>
										<input type="text" id="jumlah_2" class="form-control" readonly>
										<input type="hidden" id="jumlah_dec_2" value="0" class="form-control" readonly>
									</td>
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
					</div>
					
					<div class="col-md-12 ">
					<hr>
						<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
						<!--<button type="button" class="btn btn-danger pull-right"><i class="fa fa-close"></i> Batal</button>-->
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
	$('#submit').submit(function(e){
		var counter = $('#counter').val();
		var transaksi = new Array();
		for(i=1;i<=counter;i++){
			var temp = {
				nama_produk	:$('#nama_produk_'+i).val(),
				id_produk	:$('#id_produk_'+i).val(),
				deskripsi	:$('#deskripsi_'+i).val(),
				kuantitas	:$('#kuantitas_'+i).val(),
				satuan		:$('#satuan_'+i).val(),
				harga_satuan_dec:$('#harga_satuan_dec_'+i).val(),
				pajak		:$('#pajak_'+i).val(),
				jumlah_dec	:$('#jumlah_dec_'+i).val(),
			}
			if($('#jumlah_dec_'+i).val() != 0 && $('#id_produk_'+i).val() != ''){
				transaksi.push(temp);
			}
		}
		//console.log($('#image_file').val());return false;
		if(transaksi.length > 0){
			$.ajax({
				url: '<?php echo base_url()?>index.php/transaksi/save',
				type: "POST",
				data: {
					discount			: $('#discount').val(),
					nama_pelanggan		: $('#nama_pelanggan').val(),
					email_pelanggan		: $('#email_pelanggan').val(),
					no_referensi		: $('#no_referensi').val(),
					alamat_penagihan	: $('#alamat_penagihan').val(),
					tanggal_transaksi	: $('#tanggal_transaksi').val(),
					nomor_transaksi		: $('#nomor_transaksi').val(),
					metode_pembayaran	: $('#metode_pembayaran').val(),
					tujuan				: $('#tujuan_transfer').val(),
					pesan				: $('#pesan').val(),
					lampiran			: $('#lampiran').val(),
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
							  location.replace('<?php echo base_url()?>index.php/transaksi/input');
							}
						});
					}else if(datax.code == 1){
						alert('Simpan gagal !');
					}else{
						alert('Transaksi berhasil !');
						location.replace('<?php echo base_url()?>index.php/transaksi/input');
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
										'<input type="text" id="nama_produk_'+num+'" onkeyup="return cari_produk('+num+')" class="form-control">'+
										'<input type="hidden" id="id_produk_'+num+'" class="form-control">'+
									'</div>'+
								'</td>'+
								'<td><textarea style="height: 33px;" id="deskripsi_'+num+'" class="form-control"></textarea></td>'+
								'<td>'+
									'<div class="input-group">'+
										'<div class="input-group-addon" style="padding: 5px;">'+
											'<button type="button" onclick="return min_item('+num+')">-</button>'+
										'</div>'+
										'<input type="text" id="kuantitas_'+num+'" onkeyup="return hitung_item(1)" class="form-control">'+
										'<div class="input-group-addon" style="padding: 5px;">'+
											'<button type="button" onclick="return add_item('+num+')">+</button>'+
										'</div>'+
									'</div>'+
								'</td>'+
								'<td><input type="text" id="satuan_'+num+'" class="form-control" readonly></td>'+
								'<td>'+
									'<input type="text" id="harga_satuan_'+num+'" class="form-control" readonly>'+
									'<input type="hidden" id="harga_satuan_dec_'+num+'" class="form-control" readonly>'+
								'</td>'+
								'<td><input type="text" id="pajak_'+num+'" class="form-control"></td>'+
								'<td>'+
									'<input type="text" id="jumlah_'+num+'" class="form-control" readonly>'+
									'<input type="hidden" id="jumlah_dec_'+num+'" value="0" class="form-control" readonly>'+
								'</td>'+
							'</tr>');
		$('#counter').val(num);
	}
	
	function tujuan(){
		if($('#metode_pembayaran').val() == 'cash'){
			document.getElementById('tujuan').style.display = "none";
			$('#tujuan_transfer').val('cash');
		}else{
			document.getElementById('tujuan').style.display = "";
		}
		hitung_all();
	}
	
	function min_item(x){
		var jum = $('#kuantitas_'+x).val();
		var harga = $('#harga_satuan_dec_'+x).val();
		var qty = jum;
		if(jum > 1){
			qty = (jum*1)-1;
			$('#kuantitas_'+x).val(qty);
		}
		var total = qty * harga;
		if(total > 0){
			$.ajax({
				url: '<?php echo base_url()?>index.php/transaksi/number',
				type: "POST",
				data: {total:total},
				success: function(datax) {
					$('#jumlah_'+x).val(datax);
					$('#jumlah_dec_'+x).val(total);
					hitung_all();
				}
			});
		}
	}
	
	function add_item(x){
		var jum = $('#kuantitas_'+x).val();
		var harga = $('#harga_satuan_dec_'+x).val();
		var qty = (jum*1)+1;
		$('#kuantitas_'+x).val(qty);
		var total = qty * harga;
		if(total > 0){
			$.ajax({
				url: '<?php echo base_url()?>index.php/transaksi/number',
				type: "POST",
				data: {total:total},
				success: function(datax) {
					$('#jumlah_'+x).val(datax);
					$('#jumlah_dec_'+x).val(total);
					hitung_all();
				}
			});
		}
		
	}
	
	function hitung_item(x){
		var jum = $('#kuantitas_'+x).val();
		var harga = $('#harga_satuan_dec_'+x).val();
		var qty = jum;
		$('#kuantitas_'+x).val(qty);
		var total = qty * harga;
		if(total > 0){
			$.ajax({
				url: '<?php echo base_url()?>index.php/transaksi/number',
				type: "POST",
				data: {total:total},
				success: function(datax) {
					$('#jumlah_'+x).val(datax);
					$('#jumlah_dec_'+x).val(total);
					hitung_all();
				}
			});
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
		hitung_all();
		hitung_all();
	}
	
	function cari_pelanggan(x){
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/search_user',
			type: "POST",
			data: {pn_name:$('#nama_pelanggan').val()},
			success: function(datax) {
				var datax = JSON.parse(datax);
					var list_name = new Array();
					$.each(datax.data, function(i, item){
						var pn_id = item.id_customer;
						var pn_name = item.nama_customer;
						var alamat = item.alamat;
						if(alamat != null){
							alamat = (item.alamat).substring(0,20);
						}
						
						var temp_name = pn_id+' - '+pn_name+' - '+alamat;
						list_name.push(temp_name);
					});
					$("#nama_pelanggan").autocomplete({
						source: list_name,
						select: function( event , ui ) {
							if(ui.item.label == 'Tidak ditemukan, klik untuk menambah user'){
								$('#modal-user').modal();
							}else{
								/* var str = (ui.item.label).split(' -');
								var index = str[0];
								var user_id = datax.user_list[index]['id_customer'];
								var user_name = datax.user_list[index]['nama_customer'];
								var alamat = datax.user_list[index]['alamat'];
								var no_hp = datax.user_list[index]['nomor_telfon'];
								$('#user_id').val(user_id);
								$('#user_name').val(str[1]);
								$('#no_hp').val(no_hp);
								$('#alamat').val(alamat); */
							}
						},
						response: function(event, ui) {
							if (!(ui.content.length)) {
									var noResult = { value:"",label:"Tidak ditemukan, klik untuk menambah user" };
									ui.content.push(noResult);
							}
						}
					});
			}
		});
	}
	
	function cari_produk(x){
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
								$('#id_produk_'+x).val('');
								$('#kuantitas_'+x).val('');
								//var jumlah = harga;
								$('#jumlah_'+x).val('');
								$('#jumlah_dec_'+x).val(0);
								$('#satuan_'+x).val('');
								$('#harga_satuan_'+x).val('');
								$('#harga_satuan_dec_'+x).val('');
								hitung_all();
							}else{
								var str = (ui.item.label).split(' - ');
								var index = str[0];
								var id_produk = datax.user_list[index]['id_produk'];
								var nama_produk = datax.user_list[index]['nama_produk'];
								var satuan = datax.user_list[index]['satuan'];
								var harga = datax.user_list[index]['harga'];
								var harga_dec = datax.user_list[index]['harga_dec'];
								$('#id_produk_'+x).val(id_produk);
								$('#kuantitas_'+x).val(1);
								var jumlah = harga_dec;
								$('#jumlah_'+x).val(jumlah);
								$('#jumlah_dec_'+x).val(harga);
								$('#nama_produk_'+x).val(str[1]);
								$('#satuan_'+x).val(satuan);
								$('#harga_satuan_'+x).val(harga_dec);
								$('#harga_satuan_dec_'+x).val(harga);
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
	
	
	function hitung_all(){
		console.log($('#discount').val());
		var counter = $('#counter').val();
		var subtotal = 0;
		
		for(i=1;i<=counter;i++){
			console.log($('#jumlah_dec_'+i).val());
			subtotal = (subtotal*1) + ($('#jumlah_dec_'+i).val()) *1;
		}
		
		
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/number',
			type: "POST",
			data: {total:subtotal},
			success: function(datax) {
				$('#subtotal').val(datax);
			}
		});
		if(subtotal > 0){
			$.ajax({
				url: '<?php echo base_url()?>index.php/transaksi/decimal',
				type: "POST",
				data: {total : $('#discount').val()},
				success: function(datax) {
					var total = subtotal-datax;
					$.ajax({
						url: '<?php echo base_url()?>index.php/transaksi/number',
						type: "POST",
						data: {total:total},
						success: function(datax) {
							$('#total').val(datax);
						}
					});
				}
			});
		}else{
			$('#subtotal').val(0);
			$('#total').val(0);
		}
		
	}
</script>
