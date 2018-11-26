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
					<div class="box-body table no-padding">
					  <table class="table table-bordered table-hover dataTable" id="example">
						<thead>
							<tr>
							  <th>Tanggal</th>
							  <th>No. Ref.</th>
							  <th>No. Transaksi</th>
							  <th>Cabang</th>
							  <th>Metode</th>
							  <th>Lampiran</th>
							  <th>Pesan</th>
							  <th>Diskon</th>
							  <th>Subtotal</th>
							  <th>Pajak</th>
							  <th>Total</th>
							  <th>Jumlah Item</th>
							  <th>Action</th>
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
						return '<a href="#" onclick="return detail(&#39;'+row.id+'&#39;)">'+row.tanggal_transaksi+'</a>';
					}
				},
				{ "data": "no_ref"},
				{ "data": "cabang"},
				{ "data": "nomor_transaksi"},
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
				{ "data": "pesan"},
				{ "data": "discount"},
				{ "data": "sub_total"},
				{ "data": "jumlah_pajak"},
				{ "data": "jumlah_bayar"},
				{ "data": "jumlah_item"},
				{
					render: function (data, type, row, meta) {
						return '<button class="btn btn-info btn-sm" onclick="return detail(&#39;'+row.id+'&#39;)"><i class="fa fa-list"></i> Detail</button>';
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