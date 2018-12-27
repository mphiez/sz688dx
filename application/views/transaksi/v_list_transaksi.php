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
						<ul class="navbar-right" style="float:right;margin-right: 0px;list-style: none;">
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;margin-top:15px;">
									<i class="fa fa-list"></i> Columns <i class="fa fa-caret-down"></i> 
								</a>
								<ul class="dropdown-menu dropdown-messages">
									<?php $nm_table = array(
											array('nm'		=> 'Tanggal','default'	=> 'Y'),
											array('nm'		=> 'No. Ref','default'	=> 'N'),
											array('nm'		=> 'Cabang','default'	=> 'N'),
											array('nm'		=> 'No. Transaksi','default'	=> 'N'),
											array('nm'		=> 'Invoice','default'	=> 'N'),
											array('nm'		=> 'Pesan','default'	=> 'N'),
											array('nm'		=> 'Total','default'	=> 'N'),
											array('nm'		=> 'Sisa Tagihan','default'	=> 'N'),
											array('nm'		=> 'Sisa Bayar','default'	=> 'N'),
											array('nm'		=> 'Pengiriman Barang','default'	=> 'Y'),
											array('nm'		=> 'Action', 'default'	=> 'Y')
										);
										$i= 0;
										$n= 0;
										foreach($nm_table as $row){
											$i++;
											$def = '';
											if($row['default'] == 'Y'){
												$def = 'disabled';
											}
										?>
									<li style="padding:3px 15px;">
										<label>
										<input type="checkbox" <?php echo $def?> checked id="<?php echo $i;?>" data-column="<?php echo $n;?>" class="toggle-vis columns"> <?php echo $row['nm']?>
										</label>
									</li>
									<?php 
										$n++;
									} ?>
								</ul>
								<!-- /.dropdown-messages -->
							</li>
						</ul>
					</div>
					<div class="panel-body table-responsive">
					  <table class="table table-bordered table-hover dataTable" id="example">
						<thead>
							<tr>
							  <th>Tanggal</th>
							  <th>No. Ref.</th>
							  <th>Cabang</th>
							  <th>Nama Pelanggan</th>
							  <th>No. Transaksi</th>
							  <th>Invoice&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
							  <th>Pesan</th>
							  <th>Total</th>
							  <th>Sisa Tagihan</th>
							  <th>Sisa Bayar</th>
							  <th>Pengiriman Barang</th>
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
	<div id="modal-detail-produk" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Ubah Status Order Penjualan</h4>
		  </div>
		  <div class="modal-body" style="max-height:400px">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-hover dataTable" id="detail_table_stock">
						<thead>
							<tr>
							  <th>ID Produk</th>
							  <th>Nama Barang</th>
							  <th>Total Keluar</th>
							  <th>Total Pembelian</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		  </div>
		  <div class="modal-footer" id="field_add">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
						<select id="status" onchange="return show_termin()" class="form-control chosen-select">
							<option value="2">Accept</option>
							<option value="3">Waiting</option>
							<option value="4">Reject</option>
						</select>
					</div>
				</div>
			</div>
		  </div>
		  <div class="modal-footer" id="field_add">
			<button class="btn btn-success" onclick="return do_change()" id="btn_add">Simpan</button><button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		  </div>
		</div>
	  </div>
	</div>
	<div id="modal-reject" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Reject Invoice</h4>
		  </div>
		  <div class="modal-body" style="max-height:400px">
			<div class="row">
				<div class="col-md-12">
					<p>Apa Anda yakin untuk mereject Invoice <b id="id_inv_text"></b></p>
					<input type="hidden" id="id_inv_val" value="">
					<input type="hidden" id="id_trans" value="">
				</div>
			</div>
		  </div>
		  <div class="modal-footer" id="field_add">
			<button class="btn btn-danger" onclick="return do_reject()" id="btn_add">Reject</button><button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		  </div>
		</div>
	  </div>
	</div>
	<div id="modal-detail-invoice" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Detail Invoice</h4>
		  </div>
		  <div class="modal-body">
			<div class="row table-responsive" style="max-height:75vh">
				<div class="col-md-12" id="body-invoice">
					
				</div>
			</div>
		  </div>
		  <div class="modal-footer" id="field_add">
			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  </div>
		</div>
	  </div>
	</div>
	<div id="modal-print" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Ubah Status Order Penjualan</h4>
		  </div>
		  <div class="modal-body" style="max-height:400px">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-strips">
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

function decimal(x=''){
	if(x == ''){
		x = 0;
	}
	return x.toString().replace(/[^0-9.-]+/g,"");
}

function show_termin(){
	$('#j_termin').css('display','none');
	if($('#status').val() == 2){
		$('#j_termin').css('display','');
	}
}

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
	
	
	var table = $("#example").DataTable({
			"processing": true,
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
				{ "data": "tanggal_transaksi"},
				{ "data": "no_ref"},
				{ "data": "nm_cabang"},
				{
					render: function (data, type, row, meta) {
						return '<div id="td_h_'+row.id+'"><a href="#" onclick="return detail_customer(&#39;'+row.id_pelanggan+'&#39;)">'+row.nama_pelanggan+'</a></div>';
					}
				},
				{ "data": "nomor_transaksi"},
				{
					render: function (data, type, row, meta) {
						var inv = "";
						var margin = 0;
						$.each(row.detail, function(i, item){
							if(item.nomor_invoice){
								if(item.status == 1){
									var color = "red";
								}else if(item.status == 0){
									var color = "green";
								}
								inv += '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;margin-top:'+margin+'px;">'+
									'<li class="dropdown">'+
										'<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="margin: 5px 15px;font-size:12px">'+
											' <i style="color:black;float:left" class="fa fa-caret-down"></i>&nbsp;&nbsp;&nbsp;<span style="color:'+color+';float:left;margin-top:-3px">&nbsp&nbsp'+item.nomor_invoice+'</span>'+
										'</a>'+
										'<ul class="dropdown-menu dropdown-messages" style="right: auto !important;">'+
											'<li>'+
												'<a href="#" onclick="return detail_invoice(&#39;'+row.id_inv+'&#39;,&#39;'+item.type_invoice+'&#39;,&#39;'+item.nomor_termin+'&#39;)">'+
													'Detail Invoice'+
												'</a>'+
											'</li>';
											
											if(item.status == 1){
												inv +='<li class="divider"></li>'+
												'<li>'+
													'<a href="<?php echo base_url()?>index.php/transaksi/pembayaran?id='+row.id_inv+'&inv='+item.nomor_invoice+'">'+
														'Bayar Invoice'+
													'</a>'+
												'</li>'+
												'<li class="divider"></li>'+
												'<li>'+
													'<a href="#">'+
														'Recreate Invoice'+
													'</a>'+
												'</li>'+
												'<li class="divider"></li>'+
												'<li>'+
													'<a href="#" onclick="return reject_invoice(&#39;'+row.id_inv+'&#39;,&#39;'+item.nomor_invoice+'&#39;);">'+
														'Reject Invoice'+
													'</a>'+
												'</li>';
											}
											
										inv +='</ul>'+
									'</li>'+
								'</ul>';
								margin += 20;
							}
						});
						$('#td_h_'+row.id).css('height',margin+'px');
						return inv;
					}
				},
				{ "data": "pesan"},
				{ "data": "jumlah_bayar"},
				
				{ "data": "sisa_tagihan"},
				{ "data": "tagihan"},
				{
					render: function (data, type, row, meta) {
						var stock = "";
						if(row.status_stock == 'Uncompleted'){
							stock = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">'+
										'<li class="dropdown">'+
											'<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="margin: 5px 15px;font-size:12px">'+
												' <i style="color:black;float:left" class="fa fa-caret-down"></i>&nbsp;&nbsp;&nbsp;<span style="color:blue;float:left;margin-top:-3px">&nbsp&nbsp'+row.status_stock+'</span>'+
											'</a>'+
											'<ul class="dropdown-menu dropdown-messages" style="right: auto !important;">'+
												'<li>'+
													'<a href="<?php echo base_url()?>index.php/produk/keluar?id='+row.id_inv+'">'+
														'Create Pengeluaran'+
													'</a>'+
												'</li>'+
												'<li class="divider"></li>'+
												'<li>'+
													'<a href="#" onclick="return detail_in(&#39;'+row.id_inv+'&#39;)">'+
														'History Pengeluaran'+
													'</a>'+
												'</li>'+
											'</ul>'+
										'</li>'+
									'</ul>';
						}else{
							stock = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">'+
										'<li class="dropdown">'+
											'<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="margin: 5px 15px;font-size:12px">'+
												' <i style="color:black;float:left" class="fa fa-caret-down"></i>&nbsp;&nbsp;&nbsp;<span style="color:orange;float:left;margin-top:-3px">&nbsp&nbsp'+row.status_stock+'</span>'+
											'</a>'+
											'<ul class="dropdown-menu dropdown-messages" style="right: auto !important;">'+
												'<li>'+
													'<a href="#" onclick="return detail_in(&#39;'+row.id_inv+'&#39;)">'+
														'History Pengeluaran'+
													'</a>'+
												'</li>'+
											'</ul>'+
										'</li>'+
									'</ul>';
											
						}
						return stock;
					}
				},
				{
					render: function (data, type, row, meta) {
						var sts_transaksi = row.status;
						if(row.status == 1 && (decimal(row.sisa_tagihan)*1) > 0){
							sts_transaksi = 2;
						}
						
						
						if(sts_transaksi == 0){
							var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">';
							var sts = "Paid";
						}else if(sts_transaksi == 1){
							var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">';
							var sts = "Invoice";
						}else if(sts_transaksi == 2){
							var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">';
							if(row.status == 1 && sts_transaksi == 2){
								var sts = "On Invoice";
							}else{
								var sts = "Terminate";
							}
							
						}else if(sts_transaksi == 3){
							var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">';
							var sts = "Sales Order";
						}else if(sts_transaksi == 4){
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
									
							var sv = 4;
							if(row.tipe_transaksi == 0){
								sv = 5;
							}
							if(sts_transaksi == 0){//paid
								inv = inv+'<li class="divider"></li>'+
									'<li>'+
										'<a href="<?php echo base_url()?>index.php/transaksi/invoice_detail?inv='+row.id_inv+'&sv='+sv+'&preview=no&no_termin=0" target="blank">'+
											'Print Order'+
										'</a>'+
									'</li>';
							}
							if(sts_transaksi == 1){//invoice
								inv = inv+'<li class="divider"></li>'+
									'<li>'+
										'<a href="<?php echo base_url()?>index.php/transaksi/invoice_detail?inv='+row.id_inv+'&sv='+sv+'&preview=no&no_termin=0" target="blank">'+
											'Print Order'+
										'</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="<?php echo base_url()?>index.php/transaksi/pembayaran?id='+row.id_inv+'">'+
											'Buat Pembayaran'+
										'</a>'+
									'</li>';
							}
							
							if(sts_transaksi == 2){//terminate
								inv = inv+'<li class="divider"></li>'+
									'<li>'+
										'<a href="<?php echo base_url()?>index.php/transaksi/invoice_detail?inv='+row.id_inv+'&sv='+sv+'&preview=no&no_termin=0" target="blank">'+
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
							
							if(sts_transaksi == 3){//sales order
								inv = inv+'<li class="divider"></li>'+
									'<li>'+
										'<a href="<?php echo base_url()?>index.php/transaksi/invoice_detail?inv='+row.id_inv+'&sv='+sv+'&preview=no&no_termin=0" target="blank">'+
											'Print Order'+
										'</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="#" onclick="return change_status(&#39;'+row.id+'&#39;,&#39;'+row.nama_pelanggan+'&#39;,&#39;'+row.no_ref+'&#39;,&#39;'+sts_transaksi+'&#39;,&#39;'+row.nomor_transaksi+'&#39;)">'+
											'Ubah status'+
										'</a>'+
									'</li>';
							}
							
							if(sts_transaksi == 4){//reject
								inv = inv+'<li class="divider"></li>'+
									'<li>'+
										'<a href="<?php echo base_url()?>index.php/transaksi/invoice_detail?inv='+row.id_inv+'&sv='+sv+'&preview=no&no_termin=0" target="blank">'+
											'Print Order'+
										'</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="#" onclick="return change_status(&#39;'+row.id+'&#39;,&#39;'+row.nama_pelanggan+'&#39;,&#39;'+row.no_ref+'&#39;,&#39;'+sts_transaksi+'&#39;,&#39;'+row.nomor_transaksi+'&#39;)">'+
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
		
		$('.toggle-vis').on( 'change', function (e) {
			
			e.preventDefault();
			// Get the column API object
			var column = table.column( $(this).attr('data-column') );
	 
			// Toggle the visibility
			column.visible( ! column.visible() );
			$('#example').css('width', '100%'); 
		} );
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

function detail_in(x){	
	$("#detail_table_stock").dataTable({
		"processing": true,
		"scrollX":true,
		"ajax": {
			"url": "<?php echo base_url()?>index.php/produk/stock_out",
			"type": "POST",
			data: {id : x},
		},
		"destroy": true,
		"oLanguage": {
			"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
		},
		"aoColumns": [
			{ "data": "id_produk"},
			{ "data": "nama_produk"},
			{ "data": "total"},
			{ "data": "total_beli"},
		],
		"order": [[ 0, "desc" ]],
	});
	$('#modal-detail-produk').modal();
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
	
	location.replace('<?php echo base_url()?>index.php/transaksi/buat_invoice?inv='+id+'&mode='+mode);
}

function reject_invoice(id, invoice){
	$('#id_trans').val(id);
	$('#id_inv_val').val(invoice);
	$('#id_inv_text').text(invoice);
	$('#modal-reject').modal();
}

function detail_invoice(id_inv=null,type_invoice=1,nomor_termin=null){
	$.ajax({
		url: '<?php echo base_url()?>index.php/transaksi/invoice_detail?inv='+id_inv+'&sv='+type_invoice+'&preview=no&no_termin='+nomor_termin,
		type: "GET",
		data: {},
		success: function(datax) {
			$('#body-invoice').empty();
			document.getElementById('body-invoice').innerHTML = datax;
			$('#modal-detail-invoice').modal();
		}
	});
}

function do_reject(){
	$.ajax({
		url: '<?php echo base_url()?>index.php/transaksi/do_reject',
		type: "POST",
		data: {
			nomor_invoice 	: $('#id_inv_val').val(),
			id 				: $('#id_trans').val(),
		},
		success: function(datax) {
			var datax = JSON.parse(datax);
			if(datax.code == 0){
				load();
				$('#modal-reject').modal('hide');
				alert('Reject berhasil !');
			}else{
				load();
				alert('Reject gagal !');
			}
		}
	});
}

function do_change(){
	$.ajax({
		url: '<?php echo base_url()?>index.php/transaksi/change_status',
		type: "POST",
		data: {
			jumlah_termin	: 1,
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