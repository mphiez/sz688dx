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
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Daftar Pembelian Barang</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Daftar Pembelian Outstanding <span id="desc_category">Dalam Pemesanan </span>
					<ul class="navbar-right" style="float:right;margin-right: 0px;list-style: none;">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;margin-top:15px;">
								<i class="fa fa-list"></i> Status Pembelian <i class="fa fa-caret-down"></i> 
							</a>
							<ul class="dropdown-menu dropdown-messages">
								<li>
									<a href="#" onclick="return load()">
										Tampilkan Semua
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#"  onclick="return load('Item Stock')">
										Dalam Pemesanan
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#" onclick="return load('Item Non-Stock')">
										Belum Dibayar
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#" onclick="return load('Item Paket')">
										Belum Diterima
									</a>
								</li>
							</ul>
							<!-- /.dropdown-messages -->
						</li>
					</ul>
					<ul class="navbar-right" style="float:right;margin-right: 0px;list-style: none;">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" onclick="return create()" href="#" style="padding: 5px 15px;margin-top:15px;">
								<i class="fa fa-plus" style="color:red"></i> Tambah Pembelian 
							</a>
							<!-- /.dropdown-messages -->
						</li>
					</ul>
				</div>
				<div class="panel-body">
				  <table class="table table-bordered table-hover " id="example1">
					<thead>
						<tr>
							<th></th>
							<th width="5%">Tanggal</th>
							<th>Nomor Transaksi</th>
							<th>Nomor Invoice</th>
							<th>Supplier</th>
							<th>Referensi</th>
							<th>Deskripsi</th>
							<th>Satuan</th>
							<th>Total Bayar</th>
							<th>Jatuh Tempo</th>
							<th>Tanggal Bayar</th>
							<th>Tanggal Diterima</th>
							<th>Status</th>
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
<?php $this->load->view('footer');?>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
	load();
	function load(param = ''){	
		$('#desc_category').text('Dalam Pemesanan');
		if(param != ''){
			$('#desc_category').text(param);
		}
		$("#example1").dataTable({
			"processing": true,
			"scrollX":true,
			"ajax": {
				"url": "<?php echo base_url()?>index.php/master/get_list_pembelian",
				"type": "POST",
				data: {param:'<?php echo $this->input->get('stat')?>'},
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
										'<a href="<?php echo base_url()?>index.php/master/update_produk/'+row.id_produk+'" onclick="return edit(&#39;'+row.id+'&#39;)"><i class="fa fa-pencil"></i> Update</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="<?php echo base_url()?>index.php/master/update_produk/'+row.id_produk+'" onclick="return edit(&#39;'+row.id+'&#39;)"><i class="fa fa-search"></i> Detail</a>'+
									'</li>'+
								'</ul>'+
							'</li>'+
						'</ul>';
						return inv;
					}
				},
				{ "data": "create_date"},
				{ "data": "nomor_transaksi"},
				{ "data": "nomor_invoice"},
				{ "data": "nomor_referensi"},
				{ "data": "supplier"},
				{ "data": "deskripsi"},
				{ "data": "satuan"},
				{ "data": "total_bayar"},
				{ "data": "tanggal_jatuh_tempo_bayar"},
				{ "data": "tanggal_bayar"},
				{ "data": "tanggal_diterima"},
				{ "data": "status_paket"}
			],
			"order": [[ 0, "asc" ]],
		});
	}
</script>