				<form>
				<div class="col-lg-12">
					<div class="form-group  col-lg-6"  id="c_user_id">
					  <label class="control-label" for="inputSuccess">Nama Barang</label>
					  <input type="text" class="form-control" id="nm_barang" name='nm_barang' placeholder="Masukan Nama Barang " value="">
					</div>
					<div class="form-group  col-lg-6"  id="c_user_name">
					  <label class="control-label" for="inputSuccess">Supplier</label>
					  <select class="form-control" id="supplier" name='supplier'>
						<?php
							echo "<option value='0'>Pilih Supplier</option>";
							foreach($list_supplier as $row){
								echo "<option value='".$row->id."+^".$row->nm_supplier."'>".$row->nm_supplier."</option>";
							}
						?>
					  </select>
					</div>
					<div class="form-group  col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess">Merek</label>
					  <input type="text" class="form-control" id="asal" name='asal' placeholder="Masukan Merek" value="">
					</div>
					<div class="form-group  col-lg-6"  id="c_password">
					  <label class="control-label" for="inputSuccess">Detail (maksimal 255 karakter)</label>
					  <input type="text" class="form-control" id="detail" name='detail' placeholder="Masukan Detail " value="">
					</div>
					<div class="form-group  col-lg-6"  id="c_jabatan">
					  <label class="control-label" for="inputSuccess">Jumlah Barang Kondisi Bagus</label>
					  <input type="text" class="form-control" id="bagus"  name='bagus' placeholder="Jumlah barang Bagus" value="0">
					</div>
					<div class="form-group  col-lg-6"  id="c_new_password">
					  <label class="control-label" for="inputSuccess">Jumlah Barang Kondisi Sedang</label>
					  <input type="text" class="form-control"  id="sedang" name='sedang' value="0" placeholder="0">
					</div>
					<div class="form-group  col-lg-6"  id="c_jabatan">
					  <label class="control-label" for="inputSuccess">Jumlah Barang Kondisi Jelek</label>
					  <input type="text" class="form-control" id="jelek"  name='jelek' placeholder=" " value="0">
					</div>
					<div class="form-group  col-lg-6"  id="c_password">
					  <label class="control-label" for="inputSuccess">Harga</label>
					  <input type="text" class="form-control" id="harga_prod"  name='harga_prod' placeholder="Masukan harga " value="0">
					</div>
					<div class="form-group  col-lg-6"  id="c_">
					  <label class="control-label" for="inputSuccess">Cabang</label>
					  <select class="form-control" id="pn_wilayah" name='pn_wilayah'>
						<?php
							echo "<option value='0'>Pilih Cabang</option>";
							foreach($list_cabang as $row2){
								echo "<option value='".$row2->id."+^".$row2->nm_cabang."'>".$row2->nm_cabang."</option>";
							}
						?>
					  </select>
					</div>
					<div class="form-group  col-lg-6">
					  <label class="control-label" for="inputSuccess">Status</label>
					  <select class="form-control" id="pn_akses" name='pn_akses'>
						<option value='0'>Non-Aktif</option>
						<option value='1' selected>Aktif</option>
					  </select>
					</div>
					<div class="form-group  col-lg-6">
						<label class="control-label" for="inputSuccess">Upload Gambar</label>
						 <input type="file" class="form-control" id="filefoto" name='filefoto'>
					</div>
				</div>
				</form>