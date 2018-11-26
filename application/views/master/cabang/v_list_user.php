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
	<div class="box">
	<div class="box-body">
		<div class="box-body">
		  <div style="margin-left:17px"><h3 class="box-title" >&nbsp;&nbsp;List Cabang</h3></div>
			<a href='#' style="margin-left:17px" onclick="return open_modal2()">
				<button class="btn btn-warning btn-sm">Add Cabang <i class="fa fa-plus"></i></button>
			</a>
			<!-- /.modal ========================================-->
			<form action="<?=base_url()?>index.php/setup/add_cab" method='post'>
				<div class="example-modal">
					<div class="modal" id='myModal2' style="margin-top:100px">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Add Cabang</h4>
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Cabang</label>
							<input type="text" class="form-control" id="nm_cab" name='nm_cab' placeholder="Masukan nama jabatan " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Status Cabang</label>
						  <select name='sts_cab' class="form-control">
							<option value="1"> Aktif</option>
							<option value="0"> Non-Aktif</option>
						  </select>
						  </div>
						  <div class="modal-footer">
							<input type="submit" class="btn btn-primary pull-right" value="Save" onClick="return check2();">
							<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
						  </div>
						</div>
						<!-- /.modal-content -->
					  </div>
					  <!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
				  </div>
			</form>
			<form action="<?=base_url()?>index.php/setup/edit_cab" method='post'>
				<div class="edit-modal">
					<div class="modal" id='myModaledit' style="margin-top:100px">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Edit Cabang</h4>
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Cabang</label>
							<input type="text" class="form-control" id="nm_cab_edit" name='nm_cab_edit' placeholder="Masukan nama jabatan " value="">
							<input type="hidden" class="form-control" id="id_cab_edit" name='id_cab_edit' placeholder="Masukan nama jabatan " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Status Cabang</label>
						  <select name='sts_cab_edit' class="form-control">
							<option value="1"> Aktif</option>
							<option value="0"> Non-Aktif</option>
						  </select>
						  </div>
						  <div class="modal-footer">
							<input type="submit" class="btn btn-primary pull-right" value="Save" onClick="return check3();">
							<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
						  </div>
						</div>
						<!-- /.modal-content -->
					  </div>
					  <!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
				  </div>
				  </form>
	   <!-- /.modal ========================================-->
			  <div class="col-md-12">
				<div class="box box-primary">
				<div class="box-body table-responsive no-padding"><br>
				  <table class="table table-bordered table-hover dataTable example1">
					<thead>
						<tr>
						  <th width='5%'>No</th>
						  <th>Nama Cabang</th>
						  <th>Status</th>
						  <th width='5%'>Option</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=0;
							if($list_cabang > 0){
								foreach($list_cabang as $row3){
								$i++;
								if($row3->sts==1){
									$sts3 = "Aktif";
								}else{
									$sts3 = "Non-Aktif";
								}
						?>
						<tr>
						  <td><?=$i?></td>
						  <td><?=$row3->nm_cabang?></td>
						  <td><?=$sts3?></td>
						  <td><button class='btn btn-primary btn-sm' onclick="return edit_form('<?php echo $row3->id?>','<?php echo $row3->sts?>','<?php echo $row3->nm_cabang;?>')">Edit <i class="fa fa-pencil"></i></a></td>
						</tr>
						<?php
								}
							}
						?>

					</tbody>
				  </table>
				</div>
				<!-- /.box-body -->
			  </div>
			  </div>
			  <!-- /.box -->
			</div>
        </div>
        </div>
      <!-- /.row -->
    </section>
<?php $this->load->view('footer');?>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
  $(function () {
    $(".example1").DataTable();
  });
  
  function open_modal1(){
	$('#myModal').modal('show');
  }
  function open_modal2(){
	$('#myModal2').modal('show');
  }
  function check1(){
	if($("#nm_jab").val() == ''){
		alert('Masukan nama jabatan');
		document.getElementById("nm_jab").focus();
		return false;
	}
}
function check2(){
	if($("#nm_cab").val() == ''){
		alert('Masukan nama cabang');
		document.getElementById("nm_cab").focus();
		return false;
	}
}

function edit_form(x,sts,name){
	$('#myModaledit').modal();
	$('#nm_cab_edit').val(name);
	$('#id_cab_edit').val(x);
	$('#sts_cab_edit').val(sts);
}

function check3(){
	if($("#nm_cab_edit").val() == ''){
		alert('Masukan nama cabang');
		document.getElementById("nm_cab_edit").focus();
		return false;
	}
}
</script>