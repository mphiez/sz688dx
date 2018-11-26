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
	<section class="content">
      <div class="row">
        <div class="col-xs-12">
           <div class="box">
            <div class="box-header">
				<div class="col-md-12">
					<div class="col-sm-12 col-md-4">
						<div class="form-group">
							<label>Cabang</label>
							<?php $admin = cek_admin();?>
							<select class="form-control" class="" id="cabang" onchange="return load()">
									
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
								<select class="form-control" id="year" onchange="return load()">
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
								<select class="form-control" id="month" onchange="return load()">
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
				<div class="box-header col-md-12">
					<div class="box-body table no-padding">
					  <table class="table table-bordered table-hover dataTable" id="example">
						<thead>
							<tr>
							  <th>Tanggal</th>
							  <th>Keterangan</th>
							  <th>Akun Debit</th>
							  <th>Debit</th>
							  <th>Akun Kredit</th>
							  <th>Kredit</th>
							  <th>User</th>
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
				"url": "<?php echo base_url()?>index.php/laporan/load_list_jurnal",
				"type": "POST",
				data: {
						pembayaran : 1,
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
				{ "data": "keterangan"},
				{ "data": "akun_debit"},
				{ "data": "jumlah_debit"},
				{ "data": "akun_credit"},
				{ "data": "jumlah_credit"},
				{ "data": "pn_name"}
			],
			"order": [[ 0, "desc" ]],
		});
}

</script>