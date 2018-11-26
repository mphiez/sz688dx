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
			<div class="box-body">
			  <a href="<?=base_url()?>index.php/setup/add_user" class="btn btn-warning btn-sm">Tambah Karyawan <i class="fa fa-plus"></i>
			  </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable" id="example">
				<thead>
					<tr>
					  <th>ID Karyawan</th>
					  <th>Nama Karyawan</th>
					  <th>Jabatan</th>
					  <th>Cabang</th>
					  <th>Alamat</th>
					  <th>No HP</th>
					  <th>Email</th>
					  <th>Status</th>
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
	</section>
<?php $this->load->view('footer');?>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
	load();
	function load(){	
		$("#example").dataTable({
			"processing": true,
			"ajax": {
				"url": "<?php echo base_url()?>index.php/master/get_karywan",
				"type": "POST",
				data: {},
			},
			"destroy": true,
			"oLanguage": {
				"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
			},
			
			"aoColumns": [
				{ "data": "pn_id"},
				{ "data": "pn_name"},
				{ "data": "pn_jabatan"},
				{ "data": "pn_wilayah"},
				{ "data": "alamat"},
				{ "data": "no_hp"},
				{ "data": "email"},
				{ "data": "status"},
				{
					render: function (data, type, row, meta) {
						return '<a href="<?php echo base_url()?>index.php/setup/edit_profile/'+row.pn_id+'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Update</button>';
					}
				}
			],
			"order": [[ 0, "asc" ]],
		});
	}
</script>