<?php $this->load->view('header');?>
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
								<a href="#">
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
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-comments fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">26</div>
								<div>New Comments!</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">12</div>
								<div>New Tasks!</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-shopping-cart fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">124</div>
								<div>New Orders!</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-support fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">13</div>
								<div>Support Tickets!</div>
							</div>
						</div>
					</div>
					<a href="#">
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
						Semua Penjualan 
						<ul class="navbar-right" style="float:right;margin-right: 0px;list-style: none;">
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;margin-top:15px;">
									<i class="fa fa-calendar"></i> Semua <i class="fa fa-caret-down"></i> 
								</a>
								<ul class="dropdown-menu dropdown-messages">
									<li>
										<a href="#">
											Satu Minggu Terakhir
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="#">
											Satu Bulan Terakhir
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="<?php echo base_url()?>index.php/transaksi/input">
											Dua Bulan Terakhir
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="#">
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
						<tbody id=>
							
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
					<div class="form-group">
						<>
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
						<label>Nomor Order</label>
						<input type="text" id="id_order" value="" class="form-control" readonly>
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
load();
$(".chosen-select").chosen({no_results_text: "Tidak Ditemukan", width: "100%"}); 
function load(){	
	$("#example").dataTable({
			"processing": true,
			"scrollX":true,
			"ajax": {
				"url": "<?php echo base_url()?>index.php/transaksi/load_list",
				"type": "POST",
				data: {},
			},
			"destroy": true,
			"oLanguage": {
				"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
			},
			"aoColumns": [
				{
					render: function (data, type, row, meta) {
						var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;">'+
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
							var inv = '<a href="#" style="color:blue;">Print</a><ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;">';
						}else if(row.status == 1){
							var inv = '<a href="#" style="color:orange;">Bayar</a><ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;">';
						}else if(row.status == 2){
							var inv = '<a href="#" style="color:green;">Invoice</a><ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;">';
						}else if(row.status == 3){
							var inv = '<a href="#" style="color:purple;" onclick="return change_status(&#39;'+row.id+'&#39;,&#39;'+row.nama_pelanggan+'&#39;,&#39;'+row.no_ref+'&#39;,&#39;'+row.status+'&#39;)">Waiting</a><ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;">';
						}else if(row.status == 4){
							var inv = '<a href="#" style="color:red;" onclick="return change_status(&#39;'+row.id+'&#39;,&#39;'+row.nama_pelanggan+'&#39;,&#39;'+row.no_ref+'&#39;,&#39;'+row.status+'&#39;)">Reject</a><ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;">';
						}
							
							inv = inv+'<li class="dropdown">'+
								'<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;">'+
									' <i style="color:green;" class="fa fa-caret-down"></i> '+
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
										'<a href="#">'+
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
										'<a href="#">'+
											'Buat Invoice'+
										'</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="#">'+
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
										'<a href="#" onclick="return change_status(&#39;'+row.id+'&#39;,&#39;'+row.nama_pelanggan+'&#39;,&#39;'+row.no_ref+'&#39;,&#39;'+row.status+'&#39;)">'+
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
										'<a href="#" onclick="return change_status(&#39;'+row.id+'&#39;,&#39;'+row.nama_pelanggan+'&#39;,&#39;'+row.no_ref+'&#39;,&#39;'+row.status+'&#39;)">'+
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

function change_status(id, cus, ref, stat){
	$('#id_order').val(id);
	$('#nama_pelanggan').val(cus);
	$('#no_ref').val(ref);
	$('#status').val(stat);
	$("#status").trigger("chosen:updated");
	$('#modal-ubah-status').modal();
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