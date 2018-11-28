<?php $this->load->view('header');?>
	<style>
		.huge{
			font-size:18px;
		}
		
		
		.dropdown-menu
		{
			position:absolute;
			z-index:4000 !important
		}
	</style>
   <div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header" style="width:250px;float:left;">Daftar Transaksi</h1>
				
				<ul class="navbar-right" style="float:right;margin-right: 0px;list-style: none;">
					<li class="dropdown">
						<a class="dropdown-toggle btn btn-success" data-toggle="dropdown" href="#" style="padding: 5px 15px;margin-top:15px;">
							<i class="fa fa-shopping-cart fa-fw"></i> Transaksi Baru <i class="fa fa-caret-down"></i> 
						</a>
						<ul class="dropdown-menu dropdown-messages">
							<li class="divider"></li>
							<li>
								<a href="<?php echo base_url()?>index.php/transaksi/input">
									Penjualan Langsung
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="<?php echo base_url()?>index.php/transaksi/create_invoice">
									Invoice Penjualan
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="<?php echo base_url()?>index.php/transaksi/create_order">
									Order Penjualan
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="<?php echo base_url()?>index.php/transaksi/buat_pembayaran">
									Pembayaran
								</a>
							</li>
						</ul>
						<!-- /.dropdown-messages -->
					</li>
				</ul>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-list fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"  id="all">0</div>
								<div>Semua Penjualan</div>
							</div>
						</div>
					</div>
					<a href="#" onclick="return load('','')">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-2 col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-check fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge" id="paid">0</div>
								<div>Sudah Dibayar</div>
							</div>
						</div>
					</div>
					<a href="#" onclick="return load('','0')">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-2 col-md-6">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-file fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge" id="invoice">0</div>
								<div>Dalam Penagihan</div>
							</div>
						</div>
					</div>
					<a href="#" onclick="return load('','1')">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-2 col-md-6">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge" id="terminate">0</div>
								<div>Order Diterima</div>
							</div>
						</div>
					</div>
					<a href="#" onclick="return load('','2')">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-2 col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-shopping-cart fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge" id="sales_order"></div>
								<div>Order Penjualan</div>
							</div>
						</div>
					</div>
					<a href="#" onclick="return load('','3')">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-2 col-md-6">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-close fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge" id="reject">0</div>
								<div>Order Dibatalkan</div>
							</div>
						</div>
					</div>
					<a href="#" onclick="return load('','4')">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				
				<div class="panel panel-default">
					<div class="panel-heading">
						Penjualan <span id="range">Dalam Satu Tahun Terakhir</span>
						<input type="hidden" id="range_type" value="Y">
						<ul class="navbar-right" style="float:right;margin-right: 0px;list-style: none;">
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;margin-top:15px;">
									<i class="fa fa-calendar"></i> Semua <i class="fa fa-caret-down"></i> 
								</a>
								<ul class="dropdown-menu dropdown-messages">
									<li>
										<a href="#" onclick="return load('D')">
											Hari Ini
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="#" onclick="return load('W')">
											Satu Minggu Terakhir
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="#" onclick="return load('M')">
											Satu Bulan Terakhir
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="#"  onclick="return load('M2')"">
											Dua Bulan Terakhir
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="#"  onclick="return load('Y')">
											Satu Tahun Terakhir
										</a>
									</li>
								</ul>
								<!-- /.dropdown-messages -->
							</li>
						</ul>
					</div>
					<div class="panel-body">
					  <table class="table table-bordered table-hover dataTable" id="example">
						<thead>
							<tr>
							  <th></th>
							  <th>Tanggal</th>
							  <th>No. Ref.</th>
							  <th>Cabang</th>
							  <th>Nama Pelanggan</th>
							  <th>No. Transaksi</th>
							  <th>Lampiran</th>
							  <th>Pesan</th>
							  <th>Total</th>
							  <th>Status/Action</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					  </table>
					</div>
				</div>
			</div>
		</div>
    </div>
	<div id="modal-detail" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-lg" style="width: 900px;" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Detail Transaksi</h4>
		  </div>
		  <div class="modal-body" style="max-height:400px">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6">
						<div class="form-group">
							<label>Nama Customer :</label>
							<div>
								<span id="cust_name"></span>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ID Customer :</label>
							<div>
								<span id="cust_id"></span>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Tanggal Transaksi :</label>
							<div>
								<span id="tanggal_transaksi"></span>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Jumlah Transaksi :</label>
							<div>
								<span ><h3 id="jumlah_transaksi"></h3></span>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Status Transaksi :</label>
							<div>
								<span id="status_transaksi"></span>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Nomor Invoice :</label>
							<div>
								<span id="nomor_invoice"></span>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Lampiran :</label>
							<div>
								<span id="lampiran"></span>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Pesan :</label>
							<div>
								<span id="pesan"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<table class="table table-bordered table-hover dataTable" id="detail_table">
						<thead>
							<tr>
							  <th>Tanggal</th>
							  <th>Kasir</th>
							  <th>Cabang</th>
							  <th>Id Produk</th>
							  <th>Nama Produk</th>
							  <th>Deskripsi</th>
							  <th>Qty</th>
							  <th>Satuan</th>
							  <th>Harga Satuan</th>
							  <th>Pajak</th>
							  <th>Jumlah</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		  </div>
		  <div class="modal-footer" id="field_add">
			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  </div>
		</div>
	  </div>
	</div>
	<div id="modal-ubah-status" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Ubah Status Order Penjualan</h4>
		  </div>
		  <div class="modal-body" style="max-height:400px">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Nomor Transaksi</label>
						<input type="text" id="nomor_transaksi" value="" class="form-control" readonly>
						<input type="hidden" id="id_order" value="" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Nama Pelanggan</label>
						<input type="text" id="nama_pelanggan" value="" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Nomor Referensi</label>
						<input type="text" id="no_ref" value="" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Status</label>
						<select id="status" class="form-control chosen-select">
							<option value="2">Accept</option>
							<option value="3">Waiting</option>
							<option value="4">Reject</option>
						</select>
					</div>
				</div>
			</div>
		  </div>
		  <div class="modal-footer" id="field_add">
			<button class="btn btn-success" onclick="return do_change()" id="btn_add">Simpan</button><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  </div>
		</div>
	  </div>
	</div>
	</section>
<?php $this->load->view('footer');?>
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
load('Y');
$(".chosen-select").chosen({no_results_text: "Tidak Ditemukan", width: "100%"}); 

$.ajax({
	url: '<?php echo base_url()?>index.php/transaksi/load_list_sum',
	type: "POST",
	data: {
		range:$('#range_type').val(),status:status
	},
	success: function(datax) {
		var datax = JSON.parse(datax);
		$('#all').text('0');
		$('#paid').text('0');
		$('#invoice').text('0');
		$('#terminate').text('0');
		$('#sales_order').text('0');
		$('#reject').text('0');
		if(datax.code == 0){
			$.each(datax.data,function(i, item){
				if(item.status=='all'){
					$('#all').text(item.total);
				}else if(item.status=='0'){
					$('#paid').text(item.total);
				}else if(item.status=='1'){
					$('#invoice').text(item.total);
				}else if(item.status=='2'){
					$('#terminate').text(item.total);
				}else if(item.status=='3'){
					$('#sales_order').text(item.total);
				}else if(item.status=='4'){
					$('#reject').text(item.total);
				}
			});
		}
	}
});
function load(x='', status=''){
	if(x == 'W'){
		$('#range_type').val(x);
		$('#range').text('Dalam Satu Minggu Terakhir');
	}else if(x == 'M'){
		$('#range_type').val(x);
		$('#range').text('Dalam Satu Bulan Terakhir');
	}else if(x == 'M2'){
		$('#range_type').val(x);
		$('#range').text('Dalam Dua Bulan Terakhir');
	}else if(x == 'Y'){
		$('#range_type').val(x);
		$('#range').text('Dalam Satu Tahun Terakhir');
	}else if(x == 'D'){
		$('#range_type').val(x);
		$('#range').text('Hari Ini');
	}
	
	
	$("#example").dataTable({
			"processing": true,
			"scrollX":true,
			"ajax": {
				"url": "<?php echo base_url()?>index.php/transaksi/load_list",
				"type": "POST",
				data: {range:$('#range_type').val(),status:status},
			},
			"destroy": true,
			"oLanguage": {
				"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
			},
			"aoColumns": [
				{
					render: function (data, type, row, meta) {
						var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">'+
							'<li class="dropdown">'+
								'<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;">'+
									' <i style="color:black;" class="fa fa-caret-down"></i> '+
								'</a>'+
								'<ul class="dropdown-menu dropdown-messages" style="right: auto !important;">'+
									'<li>'+
										'<a href="#" onclick="return detail(&#39;'+row.id+'&#39;)">'+
											'Detail'+
										'</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="#">'+
											'Kirim Kembali Email'+
										'</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="#">'+
											'Print Invoice'+
										'</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="#">'+
											'Kirim Pengingat'+
										'</a>'+
									'</li>'+
								'</ul>'+
							'</li>'+
						'</ul>';
						return inv;
					}
				},
				{ "data": "tanggal_transaksi"},
				{ "data": "no_ref"},
				{ "data": "cabang"},
				{
					render: function (data, type, row, meta) {
						return '<a href="#" onclick="return detail_customer(&#39;'+row.id_pelanggan+'&#39;)">'+row.nama_pelanggan+'</a>';
					}
				},
				{ "data": "nomor_transaksi"},
				{
					render: function (data, type, row, meta) {
						var lampiran = "";
						if(row.lampiran){
							lampiran = '<a href="<?php base_url()?>/gambar_barang/'+row.lampiran+'"><i class="fa fa-paperclip"></a></a>';
						}
						return lampiran;
					}
				},
				{ "data": "pesan"},
				{ "data": "jumlah_bayar"},
				{
					render: function (data, type, row, meta) {
						if(row.status == 0){
							var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">';
							var sts = "Paid";
						}else if(row.status == 1){
							var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">';
							var sts = "Invoice";
						}else if(row.status == 2){
							var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">';
							var sts = "Terminate";
						}else if(row.status == 3){
							var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">';
							var sts = "Sales Order";
						}else if(row.status == 4){
							var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">';
							var sts = "Reject";
						}
							
							inv = inv+'<li class="dropdown">'+
								'<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;">'+
									'<span class="pull-left">'+sts+'</span> <i style="color:green;" class="fa fa-caret-down pull-right"></i> '+
								'</a>'+
								'<ul class="dropdown-menu dropdown-messages">'+
									'<li>'+
										'<a href="#" onclick="return detail('+row.id+')">'+
											'Detail Order'+
										'</a>'+
									'</li>';
							if(row.status == 0){
								inv = inv+'<li class="divider"></li>'+
									'<li>'+
										'<a href="#">'+
											'Print Order'+
										'</a>'+
									'</li>';
							}
							if(row.status == 1){
								inv = inv+'<li class="divider"></li>'+
									'<li>'+
										'<a href="#">'+
											'Print Order'+
										'</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="<?php echo base_url()?>index.php/transaksi/buat_pembayaran?id='+row.id_pelanggan_dec+'">'+
											'Buat Pembayaran'+
										'</a>'+
									'</li>';
							}
							
							if(row.status == 2){
								inv = inv+'<li class="divider"></li>'+
									'<li>'+
										'<a href="#">'+
											'Print Order'+
										'</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="#" onclick="return create_invoice(&#39;'+row.id_inv+'&#39;,1)">'+
											'Buat Invoice'+
										'</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="#"  onclick="return create_invoice(&#39;'+row.id_inv+'&#39;,2)">'+
											'Buat Invoice & kirim Email'+
										'</a>'+
									'</li>';
							}
							
							if(row.status == 3){
								inv = inv+'<li class="divider"></li>'+
									'<li>'+
										'<a href="#">'+
											'Print Order'+
										'</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="#" onclick="return change_status(&#39;'+row.id+'&#39;,&#39;'+row.nama_pelanggan+'&#39;,&#39;'+row.no_ref+'&#39;,&#39;'+row.status+'&#39;,&#39;'+row.nomor_transaksi+'&#39;)">'+
											'Ubah status'+
										'</a>'+
									'</li>';
							}
							
							if(row.status == 4){
								inv = inv+'<li class="divider"></li>'+
									'<li>'+
										'<a href="#">'+
											'Print Order'+
										'</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="#" onclick="return change_status(&#39;'+row.id+'&#39;,&#39;'+row.nama_pelanggan+'&#39;,&#39;'+row.no_ref+'&#39;,&#39;'+row.status+'&#39;,&#39;'+row.nomor_transaksi+'&#39;)">'+
											'Ubah status'+
										'</a>'+
									'</li>';
							}
									
									
								inv = inv+'</ul>'+
							'</li>'+
						'</ul>';
						return inv;
					}
				}
			],
			"order": [[ 0, "desc" ]],
		});
}

function detail(x){
	$('#cust_name').text('');
	$('#cust_name').text('');
	$('#tanggal_transaksi').text('');
	$('#jumlah_transaksi').text('');
	$('#status_transaksi').text('');
	$('#nomor_invoice').text('');
	$('#lampiran').text('');
	$('#pesan').text('');
	$.ajax({
		url: '<?php echo base_url()?>index.php/transaksi/detail_transaksi_header',
		type: "POST",
		data: {
			id 				: x,
		},
		success: function(datax) {
			var datax = JSON.parse(datax);
			if(datax.code == 0){
				$('#cust_name').text(datax.data.nama_pelanggan);
				$('#cust_name').text(datax.data.id_pelanggan);
				$('#tanggal_transaksi').text(datax.data.tanggal_transaksi);
				$('#jumlah_transaksi').text("Rp. "+datax.data.jumlah_bayar);
				$('#status_transaksi').text(datax.data.status);
				$('#nomor_invoice').text(datax.data.nomor_invoice);
				$('#lampiran').text(datax.data.lampiran);
				$('#pesan').text(datax.data.pesan);
			}
		}
	});
	
	$("#detail_table").dataTable({
		"processing": true,
		"scrollX":true,
		"ajax": {
			"url": "<?php echo base_url()?>index.php/transaksi/detail_transaksi",
			"type": "POST",
			data: {id : x},
		},
		"destroy": true,
		"oLanguage": {
			"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
		},
		"aoColumns": [
			{ "data": "tanggal_transaksi"},
			{ "data": "user"},
			{ "data": "cabang"},
			{ "data": "id_produk"},
			{ "data": "nama_produk"},
			{ "data": "deskripsi"},
			{ "data": "kuantitas"},
			{ "data": "satuan"},
			{ "data": "harga_satuan"},
			{ "data": "pajak"},
			{ "data": "jumlah"},
		],
		"order": [[ 0, "desc" ]],
	});
	$('#modal-detail').modal();
}

function change_status(id, cus, ref, stat, nomor_transaksi){
	$('#id_order').val(id);
	$('#nama_pelanggan').val(cus);
	$('#no_ref').val(ref);
	$('#status').val(stat);
	$('#nomor_transaksi').val(nomor_transaksi);
	$("#status").trigger("chosen:updated");
	$('#modal-ubah-status').modal();
}

function create_invoice(id, mode){
	
	//window.open('<?php echo base_url()?>index.php/transaksi/invoice?inv='+id+'&mode='+mode);
	/* setTimeout(function() {
		load();
	}, 2000); */
	
	location.replace('<?php echo base_url()?>index.php/transaksi/buat_invoice?inv='+id+'&mode='+mode);
}

function do_change(){
	$.ajax({
		url: '<?php echo base_url()?>index.php/transaksi/change_status',
		type: "POST",
		data: {
			status 			: $('#status').val(),
			id 				: $('#id_order').val(),
		},
		success: function(datax) {
			var datax = JSON.parse(datax);
			if(datax.code == 0){
				load();
				$('#modal-ubah-status').modal('hide');
				alert('Update status berhasil !');
			}else{
				alert('Update status gagal !');
			}
		}
	});
}

function detail_customer(x){
	
	$("#detail_table").dataTable({
		"processing": true,
		"scrollX":true,
		"ajax": {
			"url": "<?php echo base_url()?>index.php/transaksi/detail_transaksi",
			"type": "POST",
			data: {id : x},
		},
		"destroy": true,
		"oLanguage": {
			"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
		},
		"aoColumns": [
			{ "data": "tanggal_transaksi"},
			{ "data": "user"},
			{ "data": "cabang"},
			{ "data": "id_produk"},
			{ "data": "nama_produk"},
			{ "data": "deskripsi"},
			{ "data": "kuantitas"},
			{ "data": "satuan"},
			{ "data": "harga_satuan"},
			{ "data": "pajak"},
			{ "data": "jumlah"},
		],
		"order": [[ 0, "desc" ]],
	});
	$('#modal-detail').modal();
}

</script>