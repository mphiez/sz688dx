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
				<div class="col-md-12">
					<div class="col-md-10">
						<h2><?=$judul?></h2>
					</div>
					<div class="col-md-2">
						<select id="periode" class="form-control">
							<?PHP 
								if($periode > 0){
								foreach($periode as $row){
								?>
									<option value="<?php echo $row->periode;?>"><?php echo $row->periode;?></option>
								<?php
								} }
							?>
						</select>
					</div>
				</div>
				<div class="box-header">
					<div class="box-body table no-padding">
					  <table class="table table-bordered table-hover dataTable" id="example">
						<thead>
							<tr>
							  <th>No. Akun</th>
							  <th>Nama Akun</th>
							  <th>Saldo (Rp.)</th>
							  <th>Keterangan</th>
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
	<div id="modal-detail" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-lg" style="width: 900px;" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Detail Transaksi</h4>
		  </div>
		  <div class="modal-body" style="max-height:400px">
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
		  <div class="modal-footer" id="field_add">
			<button class="btn btn-success" onclick="return do_add()" id="btn_add">Simpan</button><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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
function load(){	
	$("#example").dataTable({
			"processing": true,
			"scrollX":true,
			"ajax": {
				"url": "<?php echo base_url()?>index.php/laporan/load_list",
				"type": "POST",
				data: {periode : $('#periode').val()},
			},
			"destroy": true,
			"oLanguage": {
				"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
			},
			"aoColumns": [
				{ "data": "account_num"},
				{ "data": "account_name"},
				{ "data": "saldo"},
				{ "data": "keterangan"},
				{
					render: function (data, type, row, meta) {
						return '<button class="btn btn-info btn-sm" onclick="return detail(&#39;'+row.id+'&#39;)"><i class="fa fa-pencil"></i> Edit</button>';
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

</script>