<div class="row">
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Tanggal Input</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1' value="<?=date("d-M-Y")?>" readonly>
				<input type="hidden" class="form-control" size='1'id="tgl_input" name='tgl_input' value="<?=date("Y-m-d")?>">
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>No. Customer</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1'id="id_customer" name='id_customer' value="[Automatic]" readonly>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Nama Perusahaan</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1' value="" name='perusahaan' id='perusahaan'>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Industri</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1' id="industri" name='industri' value="">
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Contact Person</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1'id="pemesan" name='pemesan' value="">
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Agama</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1' value="" id="agama" name='agama' >
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>No KTP</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1' value="" id="no_ktp" name='no_ktp' >
			</div>
		</div>
	</div>
	<div class="col-md-6"  style="display:none">
		<div class="col-md-6">
			<div class="form-group">
				<label>Status Customer</label>
			</div>
		</div>
		<div class="col-md-6" style="">
			<div class="form-group">
				<select name='sts_cus' id='sts_cus' class="form-control">
					<option value="1" selected>Aktif</option>
					<option value="0">Non-Aktif</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Tittle</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1'id="title" name='title' value="">
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Alamat</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1' value="" id="alamat_cus" name='alamat_cus'>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Kota</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1' value="" id="kota" name='kota'>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Kode Pos</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1'id="kd_pos" name='kd_pos' value="" >
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Nomor Telpon</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1' value="" id="telfon1" name='telfon1'>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Email</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="email" class="form-control" size='1' value="" id="email1" name='email1'>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Nama Bank</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1' value="" id="nm_bank" name='nm_bank'>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>No Account</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1'id="no_account" name='no_account' value="">
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>Cabang Bank</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1' value="" id="cabang" name='cabang'>
			</div>
		</div>
	</div>
	<div class="col-md-6"  style="display:none">
		<div class="col-md-6">
			<div class="form-group">
				<label>Sts Transver</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<select id="sts_trv" name='sts_trv' class="form-control">
					<option value="Y" selected>Yes</option>
					<option value="N">No</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			<div class="form-group">
				<label>NPWP</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" class="form-control" size='1' value="" id="npwp" name='npwp'> 
			</div>
		</div>
	</div>
	<div class="col-md-6" style="display:none">
		<div class="col-md-6">
			<div class="form-group">
				<label>Sales</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<select class="form-control" size='1'id="sales" name='sales'>
					<option value="0">Pilih Sales</option>
				<?php
					if($data_salesman > 0){
						foreach($data_salesman as $row1){
							echo "<option value='".$row1->nosales."+^".$row1->nama."'>".$row1->nama."</option>";
						}
					}
				?>
				</select>
			</div>
		</div>
	</div>
</div>