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
				<h1 class="page-header" style="width:250px;float:left;">Daftar Pengeluaran</h1>
				
				<ul class="navbar-right" style="float:right;margin-right: 0px;list-style: none;">
					<li class="dropdown">
						<a class="dropdown-toggle btn btn-success" data-toggle="dropdown" href="#" style="padding: 5px 15px;margin-top:15px;">
							<i class="fa fa-shopping-cart fa-fw"></i> Tambah Pengeluaran <i class="fa fa-caret-down"></i> 
						</a>
						<ul class="dropdown-menu dropdown-messages">
							<li class="divider"></li>
							<li>
								<a href="<?php echo base_url()?>index.php/expenses/produk_baru">
									Tambah Produk
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="<?php echo base_url()?>index.php/expenses/purchase_order">
									Purchase Order
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="<?php echo base_url()?>index.php/expenses/bayar_pembelian">
									Bayar Pembelian
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="<?php echo base_url()?>index.php/expenses/buat_pengeluaran">
									Buat Pengeluaran
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
			<div class="col-sm-2 col-md-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-list fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"  id="all">0</div>
								<div>Semua Pengeluaran</div>
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
			<div class="col-sm-2 col-md-2">
				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-check fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge" id="paid">0</div>
								<div>Pembelian Produk Baru</div>
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
			<div class="col-sm-2 col-md-2">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-file fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge" id="invoice">0</div>
								<div>Tambah Stock</div>
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
			<div class="col-sm-2 col-md-2">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge" id="terminate">0</div>
								<div>Belum Dibayar</div>
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
			<div class="col-sm-2 col-md-2">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-shopping-cart fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge" id="sales_order">0</div>
								<div>Pengeluaran Lain</div>
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
			<div class="col-sm-2 col-md-2">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-close fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge" id="reject">0</div>
								<div>Pengeluaran Batal</div>
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
									<?php $nm_table = array('Tanggal','No. Ref','No. Transaksi','Cabang','Pengeluaran','Metode','Lampiran','Pesan','Subtotal','PPN','Diskon','Total Bayar','Sisa Bayar','Action');
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
							  <th>Pengeluaran</th>
							  <th>Metode</th>
							  <th>Lampiran</th>
							  <th>Pesan</th>
							  <th>Subtotal</th>
							  <th>PPN</th>
							  <th>Diskon</th>
							  <th>Total Bayar</th>
							  <th>Sisa Bayar</th>
							  <th>Status Barang</th>
							  <th>Action</th>
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
	url: '<?php echo base_url()?>index.php/expenses/load_list_sum',
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
	
	$(document).ready(function() {
		var table = $("#example").DataTable({
				"processing": true,
				"ajax": {
					"url": "<?php echo base_url()?>index.php/expenses/load_list",
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
							return '<a href="#" onclick="return detail(&#39;'+row.id+'&#39;)">'+row.tanggal_diterima+'</a>';
						}
					},
					{ "data": "nomor_referensi"},
					{ "data": "nomor_transaksi"},
					{ "data": "cabang"},
					{ "data": "nama_pengeluaran"},
					{ "data": "metode_pembayaran"},
					{
						render: function (data, type, row, meta) {
							var lampiran = "";
							if(row.lampiran){
								lampiran = '<a href="<?php base_url()?>/gambar_barang/'+row.lampiran+'"><i class="fa fa-paperclip"></a></a>';
							}
							return lampiran;
						}
					},
					{ "data": "deskripsi"},
					{ "data": "subtotal"},
					{ "data": "ppn"},
					{ "data": "diskon"},
					{ "data": "total_bayar"},
					{ "data": "sisa_bayar"},
					{
						render: function (data, type, row, meta) {						
							
								var sts = "UnComplete";
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
										'<li class="divider"></li>'+
										'<li>'+
											'<a href="<?php echo base_url()?>index.php/expenses/barang?id='+row.id_expenses+'" >'+
												'Create Pengeluaran'+
											'</a>'+
										'</li>'+
									'</ul>';
								'</ul>';
								
								
							return inv;
						}
					},
					{
						render: function (data, type, row, meta) {						
							if(row.sisa_bayar == 0){
								var sts = "Paid";
								var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">'+
								'<li class="dropdown">'+
									'<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;">'+
										'<span class="pull-left">'+sts+'</span> <i style="color:green;" class="fa fa-caret-down pull-right"></i> '+
									'</a>'+
									'<ul class="dropdown-menu dropdown-messages">'+
										'<li>'+
											'<a href="#" onclick="return detail('+row.id+')">'+
												'Detail Order'+
											'</a>'+
										'</li>';
							}else{
								var sts = "Pay";
								var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;position: absolute;">'+
								'<li class="dropdown">'+
									'<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;">'+
										'<span class="pull-left">'+sts+'</span> <i style="color:green;" class="fa fa-caret-down pull-right"></i> '+
									'</a>'+
									'<ul class="dropdown-menu dropdown-messages">'+
										'<li>'+
											'<a href="#" onclick="return detail('+row.id+')">'+
												'Detail Order'+
											'</a>'+
										'</li>'+
										'<li class="divider"></li>'+
										'<li>'+
											'<a href="<?php echo base_url()?>index.php/expenses/pay?id='+row.id_expenses+'" target="blank">'+
												'Create Payment'+
											'</a>'+
										'</li>'+
									'</ul>';
								'</ul>';
							}
								
								
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