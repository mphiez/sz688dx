<?php $this->load->view('header');?>
	<style>
		.input-group-addon{
			cursor:pointer;
		}
		.fa-trash:hover{
			color:red;
		}
	</style>
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
            <div class="box-header" style="padding:0px">
            <!-- /.box-header -->
            <div class="box-body">
				<form enctype="multipart/form-data" id="submit">
					<div class="col-md-12">
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label>Nomor Akun / Nama Akun</label>
								<input type="text" id="no_akun" class="form-control" value="1-1111 - Kas" placeholder="" onkeyup="return cari_produk()">
								<input type="hidden" id="id_account" value="1-1111">
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label>Cabang</label>
								<?php $admin = cek_admin();?>
								<select class="form-control" class="" id="cabang" onchange="return load_ledger()">
										
									<?php
										if($admin == ''){
											?>
												<option value="all">- Semua Cabang - </option>
											<?php
										}
										foreach($cabang as $row){
											if($admin == ''){
												?>
													<option value="<?php echo $row->cabang?>"><?php echo $row->nm_cabang?></option>
												<?php
											}else if($row->cabang == $this->session->userdata('pn_wilayah')){
												?>
													<option value="<?php echo $row->cabang?>"><?php echo $row->nm_cabang?></option>
												<?php
											}
											
										}
									?>
									
								</select>
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label class="col-md-12">Month Periode</label>
								<div class="col-sm-6">
									<select class="form-control" id="year" onchange="return load_ledger()">
										<?php 
										for($i=date('Y');$i>=2000;$i--){
											?>
											<option value="<?php echo $i;?>" <?php if($i==date('Y')){echo "selected";}?>>
												<?php echo $i;?>
											</option>
											<?php
										}
										?>
									</select>
								</div>
								<div class="col-sm-6">
									<select class="form-control" id="month" onchange="return load_ledger()">
										<?php 
										$bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','Setember','Oktober','November','Desember');
										for($i=1;$i<=12;$i++){
											?>
											<option value="<?php echo $i;?>" <?php if($i==(date('m')*1)){echo "selected";}?>>
												<?php echo $bulan[$i];?>
											</option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<table class="table table-hover table-strips" id="example1">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>No Bukti</th>
									<th>Uraian Transaksi</th>
									<th>Debet</th>
									<th>Kredit</th>
									<th>Saldo</th>
								</tr>
							</thead>
							<tbody id="ledger">
							</tbody>
						</table>
					</div>
				</form>
            </div>
        </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<script>
	load_ledger();
	function load_ledger(account_num = null){
		if(account_num){
			account_num = account_num;
		}else{
			account_num = $('#id_account').val();
		}
		$("#example1").dataTable({
			"processing": true,
			//"serverSide": true,
			"ajax": {
				"url": "<?php echo base_url()?>index.php/laporan/load_ledger",
				"type": "POST",
				data: {
					acnum : account_num,
					year : $('#year').val(),
					month : $('#month').val(),
					cabang : $('#cabang').val()
				},
			},
			"destroy": true,
			"oLanguage": {
				"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
			},
			"aoColumns": [
				{ "data": "tanggal"},
				{ "data": "no_bukti"},
				{ "data": "keterangan"},
				{ "data": "debit"},
				{ "data": "credit"},
				{ "data": "saldo"}
			],
			"order": [[ 0, "asc" ]],
		});
	}
	
	function cari_produk(x){
		$.ajax({
			url: '<?php echo base_url()?>index.php/laporan/search_akun',
			type: "POST",
			data: {accno:$('#no_akun').val()},
			success: function(datax) {
				var datax = JSON.parse(datax);

					var list_name = new Array();
					$.each(datax.data, function(i, item){
						var account_num = item.account_num;
						var account_name = item.account_name;
						list_name.push(account_num+' - '+account_name);
					});
					$("#no_akun").autocomplete({
						source: list_name,
						select: function( event , ui ) {
							if(ui.item.label == 'Account tidak ditemukan'){
								
							}else{
								var str = (ui.item.label).split(' - ');
								var index = str[0];
								var account_num = datax.user_list[index]['account_num'];
								load_ledger(account_num);
							}
						},
						response: function(event, ui) {
							if (!(ui.content.length)) {
									var noResult = { value:"",label:"Account tidak ditemukan" };
									ui.content.push(noResult);
							}
						}
					});
					
					if(datax.code != '0'){

					}
			}
		});
	}
</script>
