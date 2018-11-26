<?php $this->load->view('header');?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Produk Dan Jasa</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa  fa-calendar-check-o  fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">26</div>
							<div>Jumlah Item Stock</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">Buat Item Stock</span>
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
							<i class="fa fa-recycle fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">12</div>
							<div>Jumlah Item Non-Stock</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">Buat Item Non-stock</span>
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
							<div>Jumlah Item Paket</div>
						</div>
					</div>
				</div>
				<a href="<?=base_url()?>index.php/master/buat_produk">
					<div class="panel-footer">
						<span class="pull-left">Buat Item Paket</span>
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
							<i class="fa  fa-hand-stop-o fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">13</div>
							<div>Jumlah Item Jasa</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">Buat Item Jasa</span>
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
					Daftar Semua Produk Dan Jasa 
					<ul class="navbar-right" style="float:right;margin-right: 0px;list-style: none;">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;margin-top:15px;">
								<i class="fa fa-list"></i> Kategori Item <i class="fa fa-caret-down"></i> 
							</a>
							<ul class="dropdown-menu dropdown-messages">
								<li>
									<a href="#">
										Tampilkan Semua
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#">
										Item Stock
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#">
										Item Non-Stock
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?php echo base_url()?>index.php/transaksi/input">
										Item Paket
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#">
										Item Jasa
									</a>
								</li>
							</ul>
							<!-- /.dropdown-messages -->
						</li>
					</ul>
				</div>
				<div class="panel-body">
				  <table class="table table-bordered table-hover " id="example1">
					<thead>
						<tr>
						  <th></th>
						  <th width="5%">ID Produk</th>
						  <th>Nama Produk</th>
						  <th>Deskripsi</th>
						  <th>Satuan</th>
						  <th>Harga</th>
						  <th>Jumlah Stock</th>
						  <th>Status</th>
						  <th>Semua Cabang</th>
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
  function load(){	
	$("#example1").dataTable({
		"processing": true,
		"ajax": {
			"url": "<?php echo base_url()?>index.php/master/get_paket",
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
			{ "data": "id_produk"},
			{ "data": "nama_produk"},
			{ "data": "deskripsi"},
			{ "data": "satuan"},
			{ "data": "harga"},
			{ "data": "status_paket"},
			{ "data": "status_paket"},
			{ "data": "all_cabang"}
		],
		"order": [[ 0, "asc" ]],
	});
}

function edit(x){
	
}
</script>