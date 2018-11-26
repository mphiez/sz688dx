<?php $this->load->view('header');?>
	<style>
		.new_rows{
			padding:30px 0px 30px 0px !important;
		}
		
		.ui-autocomplete{
			border-radius:5px;
			background-color:#f4fdff;
			border-color:#b9cce8;
			!important;
		}
		
		.sub_resume{
			font-weight: 100 !important;
		}
		
		.min_label{
			padding-left : 50px;
		}
	</style>
    <section class="content-header">
	  <div class="title">
		Transaksi
      <div>
    </section>
    <section class="content-header">
	  <h1>
       <?=$judul?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$judul?></li>
      </ol>
    </section>
	<section class="content">
		<div class="box box-default">
			<div class="box-body">
				<div class="row new_rows">
					<div class="col-md-4">
						<div class="form-group">
							<label>Pilih Transaksi</label>
							<select class="form-control" name="jenis" id="jenis">
								<option value="">Tampilkan Semua</option>
								<option value="1">Transaksi Selesai</option>
								<option value="2">Transaksi Dalam Proses</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Awal Tanggal Transaksi</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control datepickerx1" id="awal" name="awal" type="text" value="<?=date('Y-m-d',strtotime('-1 month',strtotime(date('Y-m-d'))))?>">
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Akhir Tanggal Transaksi</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control datepickerx1" id="akhir" name="akhir" type="text" value="<?=date('Y-m-d')?>">
							</div>
						</div>
					</div>
				</div>
				<div class="row new_rows">
					<div class="col-md-12">
						<input type="hidden" id="rows" value="0">
						<div class="col-md-12 column table-responsive" style="width: 100% !important;">
							<table class="table table-bordered table-hover dataTable" id="dataTables-example">
								<thead>
									<tr>
										<th width="25%">Pelanggan</th>
										<th width="10%">Tanggal</th>
										<th width="10%">Alamat</th>
										<th width="10%">No. Ref</th>
										<th width="8%">Subtotal</th>
										<th width="8%">Diskon</th>
										<th width="8%">PPN</th>
										<th width="8%">Total</th>
										<th width="8%">Bayar</th>
										<th width="8%">Detail</th>
									</tr>
								</thead>
								<tbody id="tambah_data">
									
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row new_rows">
							<div class="col-md-4">
								
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<label>Total Sales</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label id="sell">Rp. </label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="sub_resume min_label">Total Amount</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="sub_resume" id="amount">Rp. </label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="sub_resume min_label">Account Receiveable</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="sub_resume" id="ar">Rp. </label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label>Total Purchase</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label id="buy">Rp. </label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="sub_resume min_label">Total Spend</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="sub_resume" id="spent">Rp. </label>
										</div>
									</div>
									<div class="col-md-12">
									
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="sub_resume min_label">Account Payment</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="sub_resume" id="ap">Rp. </label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label>Laba Rugi</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label id="laba_rugi">Rp. </label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<div class="modal fade" id="myModalInfofaied" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Simpan History Gagal</h4>
		  </div>
		  <div class="modal-body">
			<div class="kontenInfo" id="kontenInfo">
				Kolomnya Diisi Semua Makanya >:0
			</div>
		  </div>
		  <div class="modal-footer">
			<a href="<?php echo base_url(); ?>index.php/pecel" data-dismiss="modal" class="btn btn-warning">Ok</a>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Simpan History Gagal</h4>
		  </div>
		  <div class="modal-body">
			<div class="kontenInfo" id="kontenInfo">
				Kolomnya Diisi Semua Makanya >:0
			</div>
		  </div>
		  <div class="modal-footer">
			<a href="<?php echo base_url(); ?>index.php/pecel" data-dismiss="modal" class="btn btn-warning">Ok</a>
		  </div>
		</div>
	  </div>
	</div>
<?php $this->load->view('footer');?>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?=base_url()?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/js/bootstrap-clockpicker.min.js"></script>
<script>
	$('.datepickerx1').datepicker({
		//format: "dd-mm-yyyy",
		format: "yyyy-mm-dd",
		autoclose: true,
	});
	
	$('#dataTables-example').dataTable( {
	"processing": true,
	//"serverSide": true,
	"ajax": {
		"url":"<?php echo base_url()?>index.php/order/load_list",
		"type":"POST",
		"dataType": "json",
		"data" : {"awal": $('#awal').val(), "akhir":$('#akhir').val(), "type":$('#type').val()}
	},
	"columns": [
		{ "data": "nama_pelanggan" },
		{ "data": "tanggal_transaksi" },
		{ "data": "alamat_penagihan" },
		{ "data": "no_refrensi" },
		{ "data": "subtotal" },
		{ "data": "diskon" },
		{ "data": "ppn" },
		{ "data": "total" },
		{ "data": "bayar" },
		{
			sortable: false,
			"render": function ( data, type, full, meta ) {
				
				var ahref = full.id;
				return "<button class='btn btn-primary' onclick='return view_detail("+ahref+")'>Detail</button>";
			}
		},
	],
	"order": [[ 1, "asc" ]],
} );

$.ajax({
	url: '<?php echo base_url()?>index.php/order/load_summary',
	type: "POST",
	success: function(data) {
		var data = data.replace("[", "");
		var datax = data.replace("]", "");
		var data = JSON.parse(datax);
		$('#total').append();		
		$('#sell').append(to_rupiah(data.sell));		
		$('#amount').append(to_rupiah(data.amount));	
		var ar = data.sell-data.amount;
		$('#ar').append(to_rupiah(ar));
		$('#buy').append(to_rupiah(data.buy));
		$('#spent').append(to_rupiah(data.spend));
		var ap = data.buy-data.spend;
		$('#ap').append(to_rupiah(ap));
		var laba = data.sell - data.buy;
		$('#laba_rugi').append(to_rupiah(laba));
		
	}
});

	function to_rupiah(strx){
		var str = strx+'';
		var angka = str.split(".");
		if(angka.length == 1){
			return convertToRupiah(str);
		}else{
			var temp = angka[1];
			return convertToRupiah(angka[0])+ ','+temp[0];
		}
	}
	
	function convertToRupiah(angka)
	{
		var rupiah = '';		
		var angkarev = angka.toString().split('').reverse().join('');
		for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
		return rupiah.split('',rupiah.length-1).reverse().join('');
	}

function view_detail(id){
	$('#modal_detail').modal();
	
	$.ajax({
		url: '<?php echo base_url()?>index.php/order/get_detail',
		type: "POST",
		data : {"id": id},
		success: function(data) {
			var data = data.replace("[", "");
			var datax = data.replace("]", "");
			//var data = JSON.parse(datax);
			console.log(datax);
		}
	});
}
</script>