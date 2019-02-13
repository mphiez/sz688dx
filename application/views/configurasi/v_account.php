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
				<h1 class="page-header">Pengembang - Mapping Account</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
  
				<div class="panel panel-default">
					<div class="panel-heading">
						Konfigurasi Account</span>
					</div>
					<div class="panel-body table-responsive">
					  <table class="table table-bordered table-hover dataTable" id="example">
						<thead>
							<tr>
							  <th>Account Num</th>
							  <th>Account Name</th>
							  <th>Type</th>
							  <th>Category</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i = 0;
								foreach($account as $row){
								$i++;?>
							<tr>
								<td width="5%"><input type="text" class="form-control" readonly id="account_num_<?php echo $i?>" value="<?php echo $row->account_num?>"></td>
								<td  width="45%"><input type="text" class="form-control" id="account_name_<?php echo $i?>" value="<?php echo $row->account_name?>"></td>
								<td width="20%">
									<select class="form-control" id="account_type_<?php echo $i?>">
									<option value="">Pilih</option>
									<?php foreach($type as $rtype){
										?>
										<option value="<?php echo $rtype->id?>"><?php echo $rtype->type?></option>
										<?php
									}?>
									</select>
								</td>
								<td width="30%">
									<select class="form-control" id="account_category_<?php echo $i?>">
									<option value="">Pilih</option>
									<?php foreach($category as $rcat){
										?>
										<option value="<?php echo $rcat->id?>"><?php echo $rcat->category?></option>
										<?php
									}?>
									</select>
								</td>
							</tr>
							<?php }?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4"><button class="btn btn-success" onclick="return save_account()">Simpan</button><td>
							</tr>
						</tfoot>
					  </table>
					</div>
				</div>
			</div>
		</div>
    </div>
<?php $this->load->view('footer');?>
<script>
	<?php 
	$i = 0;
	foreach($account as $row){
	$i++;?>
		$('#account_type_<?php echo $i?>').val('<?php echo $row->account_type?>');
		$('#account_category_<?php echo $i?>').val('<?php echo $row->account_category?>');
	<?php }?>
	
	
	function save_account(){
		var account = new Array();
		for(i=1 ; i <= '<?php echo count($account)?>' ; i++){
			var temp = {
				account_num : $('#account_num_'+i).val(),
				account_name : $('#account_name_'+i).val(),
				account_type : $('#account_type_'+i).val(),
				account_category : $('#account_category_'+i).val(),
			}
			account.push(temp);
		}
		$.ajax({
				url: '<?php echo base_url()?>index.php/configurasi/save_account',
				type: "POST",
				data: {account},
				success: function(datax) {
					var datax = JSON.parse(datax);
					if(datax.code == 0){
						alert('berhasil');
					}else{
						alert('gagal');
					}
				}
		});
	}
</script>