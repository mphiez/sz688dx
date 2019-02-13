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
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				
				<div class="panel panel-default">
					<div class="panel-heading">
						Penjualan <span id="range">Dalam Satu Tahun Terakhir</span>
						<input type="hidden" id="range_type" value="Y">
						<input type="hidden" id="status_type" value="">
						<ul class="navbar-right" style="float:right;margin-right: 0px;list-style: none;">
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;margin-top:15px;">
									<i class="fa fa-calendar"></i> Status <i class="fa fa-caret-down"></i> 
								</a>
								<ul class="dropdown-menu dropdown-messages">
									<li>
										<a href="#" onclick="return load('','')">
											Semua
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="#" onclick="return load('','Completed')">
											Complete
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="#" onclick="return load('','Uncompleted')">
											UnComplete
										</a>
									</li>
								</ul>
							</li>
						</ul>
						<ul class="navbar-right" style="float:right;margin-right: 0px;list-style: none;">
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;margin-top:15px;">
									<i class="fa fa-calendar"></i> Periode <i class="fa fa-caret-down"></i> 
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
											Minggu Ini
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="#" onclick="return load('M')">
											Bulan Ini
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="#"  onclick="return load('M2')">
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
											array('nm'		=> 'Nama Pelanggan','default'	=> 'N'),
											array('nm'		=> 'No. Transaksi','default'	=> 'N'),
											array('nm'		=> 'Pesan','default'	=> 'N'),
											array('nm'		=> 'Pengiriman Barang','default'	=> 'Y')
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
							  <th>Pesan</th>
							  <th>Pengiriman Barang</th>
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
	if(x == ''){
		x = $('#range_type').val();
	}
	
	if(x == 'W'){
		$('#range_type').val(x);
		$('#range').text('Dalam Minggu Ini');
	}else if(x == 'M'){
		$('#range_type').val(x);
		$('#range').text('Dalam Bulan Ini');
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

	
	$('#status_type').val(status);
	
	if(status == 'Completed'){
		$('#status_in').text('Status Complete');
	}else if(status == 'Uncompleted'){
		$('#status_in').text('Status UnComplete');
	}else{
		$('#status_in').text('');
	}
	
	
	var table = $("#example").DataTable({
			"processing": true,
			"ajax": {
				"url": "<?php echo base_url()?>index.php/transaksi/load_list",
				"type": "POST",
				data: {range : x, status : status},
			},
			"destroy": true,
			"oLanguage": {
				"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
			},
			"aoColumns": [
				{ "data": "tanggal_transaksi"},
				{ "data": "no_ref"},
				{ "data": "nm_cabang"},
				{ "data": "nama_pelanggan"},
				{ "data": "nomor_transaksi"},
				{ "data": "pesan"},
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
													'<a href="<?php echo base_url()?>index.php/produk/keluar?id='+row.id_inv+'&fm=1">'+
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
</script>