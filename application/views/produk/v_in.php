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
		
		.col-md-2 > .panel. > panel-heading{
			min-height: 100px !important;
		}
		
		.dataTables_scroll
		{
			overflow:auto;
		}
	</style>
   <div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header" style="width:250px;float:left;">Daftar Produk Masuk</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Pembelian <span id="range">Dalam Satu Tahun Terakhir</span> <span id="status_in"></span>
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
									<?php $nm_table = array('Tanggal','No. Ref','No. Transaksi','Cabang','Supplier','Status Barang');
										$i= 0;
										$n= 0;
										foreach($nm_table as $row){
											$i++;
										?>
									<li style="padding:3px 15px;">
										<label>
										<input type="checkbox" checked id="<?php echo $i;?>" data-column="<?php echo $n;?>" class="toggle-vis columns"> <?php echo $row?>
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
							  <th>No. Transaksi</th>
							  <th>Cabang</th>
							  <th>Supplier</th>
							  <th>Status Barang</th>
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
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Detail Pembelian</h4>
		  </div>
		  <div class="modal-body">
			<div class="row table-responsive" style="max-height:75vh">
				<div class="col-md-12">
					<div class="form-group">
						<label>Nama Supplier</label>
						<div>
							<input type="text" id="nama_supplier" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label>ID Supplier</label>
						<div>
							<input type="text" id="id_supplier" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label>Tanggal Transaksi</label>
						<div>
							<input type="text" id="tanggal_transaksi" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label>Nomor Transaksi</label>
						<div>
							<input type="text" id="nomor_transaksi2" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label>Nomor invoice / Struk pembelian</label>
						<div>
							<input type="text" id="nomor_invoice" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<label>Daftar Pembelian</label>
					<div class="col-md-12">
						<table class="table table-striped tabel-hover" id="tableDetail">
							<thead>
								<tr>
									<th>Nama Produk</th>
									<th>ID Produk</th>
									<th>Qty</th>
									<th>Harga Beli</th>
									<th>Jumlah</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-12">
					<label>History Barang Masuk</label>
					<div class="col-md-12">
						<table class="table table-striped tabel-hover" id="tableBarang">
							<thead>
								<tr>
									<th>Nama Produk</th>
									<th>ID Produk</th>
									<th>Qty</th>
									<th>Tanggal Masuk</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
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

function curency(x=''){
	if(x == ''){
		x = 0;
	}
	return x.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}

function show_termin(){
	$('#j_termin').css('display','none');
	if($('#status').val() == 2){
		$('#j_termin').css('display','');
	}
}

load('Y');
$(".chosen-select").chosen({no_results_text: "Tidak Ditemukan", width: "100%"}); 

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
	
	
	$(document).ready(function() {
		var table = $("#example").DataTable({
				"processing": true,
				"ajax": {
					"url": "<?php echo base_url()?>index.php/expenses/load_list",
					"type": "POST",
					data: {range : x, status : status},
				},
				"destroy": true,
				"oLanguage": {
					"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
				},
				"aoColumns": [
					{
						render: function (data, type, row, meta) {
							return '<a href="#" onclick="return detail(&#39;'+row.id+'&#39;)">'+row.tanggal_diterima+'</a>';
						}
					},
					{ "data": "nomor_referensi"},
					{ "data": "nomor_transaksi"},
					{ "data": "cabang"},
					{ "data": "supplier"},
					{
						render: function (data, type, row, meta) {						
							if(row.tot_masuk * 1 >= row.tot_beli * 1){
								var sts = "Complete";
								var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">'+
								'<li class="dropdown">'+
									'<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;">'+
										'<span class="pull-left">'+sts+'</span> <i style="color:green;" class="fa fa-caret-down pull-right"></i> '+
									'</a>'+
									'<ul class="dropdown-menu dropdown-messages">'+
										'<li>'+
											'<a href="#" onclick="return detail('+row.id+')">'+
												'Histori Pengeluaran'+
											'</a>'+
										'</li>'+
									'</ul>';
								'</ul>';
							}else{
								var sts = "UnComplete";
								var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">'+
								'<li class="dropdown">'+
									'<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;">'+
										'<span class="pull-left">'+sts+'</span> <i style="color:green;" class="fa fa-caret-down pull-right"></i> '+
									'</a>'+
									'<ul class="dropdown-menu dropdown-messages">'+
										'<li>'+
											'<a href="#" onclick="return detail('+row.id+')">'+
												'Info Barang Masuk'+
											'</a>'+
										'</li>'+
										'<li class="divider"></li>'+
										'<li>'+
											'<a href="<?php echo base_url()?>index.php/expenses/barang?id='+row.id_expenses+'&fm=1" >'+
												'Create Barang masuk'+
											'</a>'+
										'</li>'+
									'</ul>';
								'</ul>';
							}
								
							return inv;
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
		
		});
}

function detail(x){
	$('#nama_supplier').val('');
	$('#id_supplier').val('');
	$('#tanggal_transaksi').val('');
	$('#nomor_transaksi').val('');
	$('#nomor_invoice').val('');
	$.ajax({
		url: '<?php echo base_url()?>index.php/expenses/detail_transaksi',
		type: "POST",
		data: {
			id 				: x,
		},
		success: function(datax) {
			var datax = JSON.parse(datax);
			if(datax.code == 0){
				$.each(datax.data, function(i, item){
					$('#nama_supplier').val(item.supplier);
					$('#id_supplier').val(item.id_supplier);
					$('#tanggal_transaksi').val(item.tanggal_diterima);
					$('#nomor_transaksi2').val(item.nomor_transaksi);
					$('#nomor_invoice').val(item.nomor_invoice);
				});
			}
		}
	});
	
	$("#tableDetail").dataTable({
		"processing": true,
		"scrollX":true,
		"ajax": {
			"url": "<?php echo base_url()?>index.php/expenses/detail_pembelian",
			"type": "POST",
			data: {id : x},
		},
		"destroy": true,
		"oLanguage": {
			"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
		},

		"aoColumns": [
			{ "data": "nama_produk"},
			{ "data": "id_produk"},
			{ "data": "qty"},
			{ "data": "harga_satuan"},
			{ "data": "total"}
		],
		"order": [[ 0, "desc" ]],
	});
	
	$("#tableBarang").dataTable({
		"processing": true,
		"scrollX":true,
		"ajax": {
			"url": "<?php echo base_url()?>index.php/expenses/detail_barang",
			"type": "POST",
			data: {id : x},
		},
		"destroy": true,
		"oLanguage": {
			"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
		},

		"aoColumns": [
			{ "data": "nama_barang"},
			{ "data": "id_barang"},
			{ "data": "qty"},
			{ "data": "tanggal_masuk"}
		],
		"order": [[ 0, "desc" ]],
	});
	$('#modal-detail').modal();
}

</script>