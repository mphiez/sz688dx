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
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
				<form action="<?=base_url()?>index.php/master/save_paket" method="post">
					<table class="table table-bordered table-hover">
						<tr>
							<td><b>ID Produk</b></td>
							<td><input type="text" name="id_paket" class='form-control' id="id_paket" value="[Automatic]" readonly></td>
							<td><b>Nama Produk</b></td>
							<td><input type="text" name="nm_paket" class='form-control' id="nm_paket" value=""></td>
						</tr>
						<tr>
							<td><b>Type Produk</b></td>
							<td>
								<select name="type_paket" id="type_paket" class='form-control'>
									<option value="satuan">Satuan</option>
									<option value="Paket">Paket</option>
								</select>
							</td>
							<td><b>Harga Produk</b></td>
							<td><input type="text" name="harga" class='form-control money' id="harga" onkeypress="return isNumber(event)" value=""></td>
						</tr>
						<tr>
							<td><b>Status</b></td>
							<td>
								<select name="sts" id="sts" class='form-control'>
									<option value="1">Aktif</option>
									<option value="0">Non-Aktif</option>
								<select></td>
							<td><b>Note</b></td>
							<td><textarea name="note" id="note" class='form-control'></textarea></td>
						</tr>
						<tr>
							<td><b>All Cabang</b></td>
							<td>
								<select name="all_cab" id="all_cab" class='form-control'>
									<option value="N">Tidak</option>
									<option value="Y">Ya</option>
								<select></td>
							<td></td>
							<td></td>
						</tr>
					</table>
					<table width="100%" class="table table-bordered table-hover" id="pilih_paket">
						<thead>
						<tr>
							<th style="text-align:center;background-color:lightblue">Nama Item</th>
							<th style="text-align:center;background-color:lightblue">Deskripsi</th>
							<th style="text-align:center;background-color:lightblue">Type Item</th>
							<th style="text-align:center;background-color:lightblue">Jumlah Item</th>
							<th style="text-align:center;background-color:lightblue">Harga Satuan</th>
						</tr>
						</thead>
						<input type="hidden" value="1" id="counter">
						<tbody id="table-body">
							<tr id="tr_1">
								<td>
									<div class="input-group">
										<div class="input-group-addon" onclick="return delete_produk(1)">
											<i class="fa fa-trash"></i>
										</div>
										<input type="text" id="nama_produk_1" onkeyup="return cari_produk(1)" class="form-control">
										<input type="hidden" id="id_produk_1" class="form-control">
									</div>
								</td>
								<td>
									<input type="text" id="deskripsi_1" class="form-control" readonly>
								</td>
								<td>
									<input type="text" id="type_1" class="form-control" readonly>
								</td>
								<td><input type="text" id="jumlah_item_1" class="form-control"></td>
								<td>
									<input type="text" id="jumlah_1" class="form-control" readonly>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td>
									<button type="button" class="btn btn-success" onclick="return add_product()"><i class="fa fa-plus"></i> Tambah Produk</button>
								</td>
								<td colspan="3">
								</td>
								<td>
									<button type="button" class="btn btn-success pull-right" onclick="return save()"><i class="fa fa-save"></i> Simpan</button>
								</td>
							</tr>
						</tfoot>
					</table>
				</form>
            </div>
        </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<link rel="stylesheet" href="<?=base_url()?>dist/jquery-ui.css">
<script src="<?=base_url()?>plugins/jQuery/jquery-2.2.3.min"></script>
<script src="<?=base_url()?>dist/jquery-ui.js"></script>
<script>
	function save(){
		if($('#nm_paket').val() == ''){
			alert('Silahkan Isi Nama Paket');
			return false;
		}else if($('#harga').val() == '' || $('#harga').val() == 0){
			alert('Silahkan Isi Harga');
			return false;
		}
		var counter = $('#counter').val();
		var transaksi = new Array();
		for(i=1;i<=counter;i++){
			var temp = {
				nama_produk	:$('#nama_produk_'+i).val(),
				id_produk	:$('#id_produk_'+i).val(),
				deskripsi	:$('#deskripsi_'+i).val(),
				type		:$('#type_'+i).val(),
				jumlah_item	:$('#jumlah_item_'+i).val(),
				harga		:$('#jumlah_'+i).val(),
			}
			console.log(temp);
			if($('#id_produk_'+i).val() != '' && $('#nama_produk_'+i).val() != '' && $('#type_'+i).val() != '' && $('#jumlah_'+i).val() != ''){
				transaksi.push(temp);
			}
		}
		
		if(transaksi.length > 0){
			$.ajax({
				url: '<?php echo base_url()?>index.php/master/save_paket',
				type: "POST",
				data: {
					id_paket		: $('#id_paket').val(),
					nm_paket		: $('#nm_paket').val(),
					type_paket		: $('#type_paket').val(),
					harga			: $('#harga').val(),
					sts				: $('#sts').val(),
					all_cab			: $('#all_cab').val(),
					note			: $('#note').val(),
					transaksi 			: transaksi
				},
				success: function(datax) {
					var datax = JSON.parse(datax);
					if(datax.code == 0){
						alert('Create produk berhasil !');
						location.replace('<?php echo base_url()?>index.php/master/buat_produk');
					}else{
						
					}
				}
			});
		}else{
			alert('Tidak ada transaksi !');
		}
		return false;
	}
	
	function add_product(){
		var num = $('#counter').val();
		num++;
		$('#table-body').append('<tr id="tr_'+num+'">'+
								'<td>'+
									'<div class="input-group">'+
										'<div class="input-group-addon" onclick="return delete_produk('+num+')">'+
											'<i class="fa fa-trash"></i>'+
										'</div>'+
										'<input type="text" id="nama_produk_'+num+'" onkeyup="return cari_produk('+num+')" class="form-control">'+
										'<input type="hidden" id="id_produk_'+num+'" class="form-control">'+
									'</div>'+
								'</td>'+
								'<td>'+
									'<input type="text" id="deskripsi_'+num+'" class="form-control" readonly>'+
								'</td>'+
								'<td>'+
									'<input type="text" id="type_'+num+'" class="form-control" readonly>'+
								'</td>'+
								'<td><input type="text" id="jumlah_item_'+num+'" class="form-control"></td>'+
								'<td>'+
									'<input type="text" id="jumlah_'+num+'" class="form-control" readonly>'+
								'</td>'+
							'</tr>');
		$('#counter').val(num);
	}
	
	function delete_produk(x=null){
		
		$('#nama_produk_'+x).val('');
		$('#id_produk_'+x).val('');
		$('#deskripsi_'+x).val('');
		$('#type_'+x).val('');
		$('#jumlah_item_'+x).val('');
		$('#jumlah_'+x).val('');
		
		document.getElementById('tr_'+x).style.display="none";
		
	}
	
	function cari_produk(x=null){
		$.ajax({
			url: '<?php echo base_url()?>index.php/master/search_item',
			type: "POST",
			data: {pn_name:$('#nama_produk_'+x).val()},
			success: function(datax) {
				var datax = JSON.parse(datax);

					var list_name = new Array();
					$.each(datax.data, function(i, item){
						var nama_produk = item.nama_item;
						var id_produk = item.id;
						list_name.push(id_produk+' - '+nama_produk);
					});
					
					$("#nama_produk_"+x).autocomplete({
						source: list_name,
						select: function( event , ui ) {
							if(ui.item.label == 'Item tidak ditemukan'){
								$('#id_produk_'+x).val('');
								$('#deskripsi_'+x).val('');
								$('#type_'+x).val('');
								$('#jumlah_item_'+x).val('');
								$('#jumlah_'+x).val('');
							}else{
								var str = (ui.item.label).split(' - ');
								var index = str[0];
								var id_produk = datax.user_list[index]['id'];
								var deskripsi = datax.user_list[index]['deskripsi'];
								var harga_dec = datax.user_list[index]['harga_dec'];
								var type = datax.user_list[index]['type'];
								$('#id_produk_'+x).val(id_produk);
								$('#deskripsi_'+x).val(deskripsi);
								$('#type_'+x).val(type);
								$('#jumlah_item_'+x).val(1);
								var jumlah = harga_dec;
								$('#jumlah_'+x).val(jumlah);
							}
						},
						response: function(event, ui) {
							if (!(ui.content.length)) {
									var noResult = { value:"",label:"Item tidak ditemukan" };
									ui.content.push(noResult);
							}
						}
					});
					
					if(datax.code != '0'){
						$('#id_produk_'+x).val('');
						$('#deskripsi_'+x).val('');
						$('#type_'+x).val('');
						$('#jumlah_item_'+x).val('');
						$('#jumlah_'+x).val('');
					}
			}
		});
	}
	
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
	$(function() {
    $(".skills").autocomplete({
      source: 'search'
	  });
    });
	function cari_harga(id,id2){
		var barang = $("#skill_"+id).val();
		$.get( "<?= base_url(); ?>index.php/master/cari_harga" , { option : barang, option2 : id2 } , function ( data ) {
			$( '#harga_'+id ) . html (data) ;
		} ) ;
	}
</script>