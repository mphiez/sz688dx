<?php $this->load->view('header');?>
<style>
	#modal-create{
		padding-right:0px !Important;
	}
	.fa-5x{
		color:lightblue;
	}
	
	.ui-autocomplete
	{
		position:absolute;
		cursor:default;
		z-index:4000 !important
	}
	
	.product_item{
		color: #fff;
		background: #3d8be3;
		border: 2px solid #7590d1;
		padding: 15px;
		border-radius: 50%;
	}
	
	.product_item_1{
		color: #fff;
		background: #337ab7;
		border: 2px solid lightgray;
		padding: 15px;
		border-radius: 50%;
	}
	
	.product_item_2{
		color: #fff;
		background: #5cb85c;
		border: 2px solid lightgray;
		padding: 15px;
		border-radius: 50%;
	}
	
	.product_item_3{
		color: #fff;
		background: #f0ad4e;
		border: 2px solid lightgray;
		padding: 15px;
		border-radius: 50%;
	}
	
	.product_item_4{
		color: #fff;
		background: #d9534f;
		border: 2px solid lightgray;
		padding: 15px;
		border-radius: 50%;
	}
	.desc{
		font-size:11px;
	}
	.chosen-drop .chosen-results li.no-results{
		cursor:pointer;
	}
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Produk Dan Jasa</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa  fa-calendar-check-o  fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right" style="min-height:100px">
							<div class="huge">26</div>
							<div>Jumlah Item Dibawah Minimal</div>
						</div>
					</div>
				</div>
				<a href="#" onclick="load('runout')">
					<div class="panel-footer">
						<span class="pull-left">Lihat Detail</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-recycle fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right" style="min-height:100px">
							<div class="huge">12</div>
							<div>Barang Belum Dibayar</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url()?>index.php/master/produk_manajemen?stat=1">
					<div class="panel-footer">
						<span class="pull-left">Lihat detail</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-shopping-cart fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right" style="min-height:100px">
							<div class="huge">124</div>
							<div>Barang Belum Diterima</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url()?>index.php/master/produk_manajemen?stat=2">
					<div class="panel-footer">
						<span class="pull-left">Lihat detail</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa  fa-hand-stop-o fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right" style="min-height:100px">
							<div class="huge">13</div>
							<div>Barang Dalam Pemesanan</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url()?>index.php/master/produk_manajemen?stat=3">
					<div class="panel-footer">
						<span class="pull-left">Lihat detail</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Daftar <span id="desc_category">Semua Produk Dan Jasa </span>
					<ul class="navbar-right" style="float:right;margin-right: 0px;list-style: none;">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;margin-top:15px;">
								<i class="fa fa-list"></i> Kategori Item <i class="fa fa-caret-down"></i> 
							</a>
							<ul class="dropdown-menu dropdown-messages">
								<li>
									<a href="#" onclick="return load()">
										Tampilkan Semua
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#"  onclick="return load('Item Stock')">
										Item Stock
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#" onclick="return load('Item Non-Stock')">
										Item Non-Stock
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#" onclick="return load('Item Paket')">
										Item Paket
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#" onclick="return load('Item Jasa')">
										Item Jasa
									</a>
								</li>
							</ul>
							<!-- /.dropdown-messages -->
						</li>
					</ul>
					<ul class="navbar-right" style="float:right;margin-right: 0px;list-style: none;">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" onclick="return create()" href="#" style="padding: 5px 15px;margin-top:15px;">
								<i class="fa fa-plus" style="color:red"></i> Tambah Produk Dan Jasa 
							</a>
							<!-- /.dropdown-messages -->
						</li>
					</ul>
				</div>
				<div class="panel-body">
				  <table class="table table-bordered table-hover " id="example1">
					<thead>
						<tr>
						  <th></th>
						  <th width="5%">ID Produk</th>
						  <th>Nama Produk</th>
						  <th>Kategori Produk</th>
						  <th>Deskripsi</th>
						  <th>Satuan</th>
						  <th>Harga Jual</th>
						  <th>Harga Beli</th>
						  <th>Stock</th>
						  <th>Status</th>
						  <th style='min-width:100px'>Foto</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				  </table>
				</div>
			</div>
		</div>
	</div>
	<div id="modal-product" class="modal fade" tabindex="-1" role="dialog" style="padding-right:0px">
	  <div class="modal-dialog modal-lg pull-right" style="margin:0px;height: 100%;width:450px;background:white" role="document">
		<div class="modal-content" style="height:100%">
			<form enctype="multipart/form-data" id="submit_produk">
		  <div class="modal-header" style="height:10vh;background:#337ab7;color:white">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title modal-success">Produk Baru</h4>
		  </div>
		  <div class="modal-body" style="max-height:400px;max-height:80vh;overflow:scroll">
				
				<div class="row" id="mainPanel">
					<div class="col-lg-12" style="height: 120px;cursor:pointer" onclick="return produk_option(1)">
						<div class="col-md-3"><i class="fa fa-calendar-check-o fa-4x product_item_1"></i></div>
						<div class="col-md-8">
							<p><b>Tambah Item Stok</b></p>
							<p class="desc">Tambah Item Stok adalah penambahan item Produk yang akan di jual dan akan mengurangi persediaan ketika produk/item terjual sesuai dengan jumlah yang terjual</p>
						</div>
					</div>
					<div class="col-lg-12"  style="height: 120px;cursor:pointer" onclick="return produk_option(2)">
						<div class="col-md-3"><i class="fa fa-recycle fa-4x product_item_2"></i></div>
						<div class="col-md-8">
							<p><b>Tambah Item Non-Stok</b></p>
							<p class="desc">Tambah Item Non-Stok adalah penambahan item Produk yang akan di jual dan tidak akan mengurangi persediaan ketika produk/item terjual sesuai dengan jumlah yang terjual</p>
						</div>
					</div>
					<div class="col-lg-12"  style="height: 120px;cursor:pointer" onclick="return produk_option(3)">
						<div class="col-md-3"><i class="fa fa-shopping-cart fa-4x product_item_3"></i></div>
						<div class="col-md-8">
							<p><b>Tambah Item Paket</b></p>
							<p class="desc">Tambah Item Paket adalah penambahan item Produk berupa kumpulan dari beberapa item dalam satu paket penjualan</p>
						</div>
					</div>
					<div class="col-lg-12"  style="height: 120px;cursor:pointer" onclick="return produk_option(4)">
						<div class="col-md-3"><i class="fa fa-hand-stop-o fa-4x product_item_4"></i></div>
						<div class="col-md-8">
							<p><b>Tambah Item Jasa</b></p>
							<p  class="desc">Tambah Item Jasa adalah penambahan item Produk berupa jasa atau service yang diberikan kepada pihak pengguna atau pelanggan</p>
						</div>
					</div>
				</div>
				<div class="row">
					<input type="hidden" value="" id="nomor_item_produk">
					<input type="hidden" value="" id="category_produk">
					<div class="col-md-12" id="panel1">
						<div class="col-md-12">
							<a href="#" onclick="return hide_produk(1)" class="pull-right"><i class="fa fa-angle-left"></i> Back</a>
						</div>
						<div class="form-group">
							<label>Tipe Produk</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="Item Stock" readonly id="s_tipe_produk">
							</div>
						</div>
						<div class="form-group">
							<label>Nama Item</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="" id="s_nama_item">
								<input type="hidden" class="form-control form-control-sm " value="" id="s_id_produk">
								<input type="hidden" class="form-control form-control-sm " value="" id="s_id">
							</div>
						</div>
						<div class="form-group col-md-4" style="padding-left:0px">
							<label>Satuan</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="" id="s_satuan_item">
							</div>
						</div>
						<div class="form-group col-md-8" style="padding-right:0px">
							<label>Foto</label>
							<div>
								<input type="file" class="form-control form-control-sm " name="s_foto" value="" id="s_foto">
							</div>
						</div>
						<div class="form-group" id="s_tipe_item_select">
							<label>Tipe Item</label>
							<div>
								<div class="input-group">
									<select type="text" id="s_tipe_item" class="form-control chosen-select">
										<option value=""></option>
									</select>
									<div class="input-group-addon" title="Tambah Item" onclick="return tipe_item(1)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="s_add_tipe_item" style="display:none;padding-left:0px;border:1px solid lightgray;border-radius:3px;background:antiquewhite;padding:10px 5px;">
							<div class="col-md-12">
								<label class="col-md-6">Tambah Tipe Item </label>
								<label class="col-md-6"><a href="#" onclick="return hide_s_item(1)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label class="col-md-2">Nama</label>
									<div class="col-md-7">
										<input type="text" class="form-control form-control-sm " value="" id="s_name_tipe_item">
									</div>
									<div class="col-md-2">
										<button  type="button" class="btn btn-success" id="s_save_type_item" type="button" onclick="return save_type_item(1)"><i class="fa fa-save"></i> Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-left:0px">
							<label>Harga Beli</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="s_harga_beli">
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-right:0px">
							<label>Harga Jual</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="s_harga_jual">
							</div>
						</div>
						<div  class="form-group" id="s_add_account_field">
							<label>Akun Penjualan</label>
							<div>
								<div class="input-group">
									<select type="text" id="s_account_penjualan" class="form-control chosen-select2">
									
									</select>
									<div class="input-group-addon" title="Tambah Akun" onclick="return add_account(1)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="s_add_account" style="display:none;padding-left:0px;border:1px solid lightgray;border-radius:3px;background:antiquewhite;padding:10px 5px;">
							<div class="col-md-12">
								<label class="col-md-6">Tambah Akun Penjualan </label>
								<label class="col-md-6"><a href="#" onclick="return hide_account(1)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nomor Akun</label>
									<div class="col-md-4" style="padding-left:0px">
										<input type="text" class="form-control form-control-sm " value="" id="s_nomor_account">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nama Akun</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="s_nama_account">
										<input type="hidden" class="form-control form-control-sm " value="Income" id="s_tipe_account">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<button  type="button"class="btn btn-success" id="s_save_type_item"  type="button" onclick="return save_account(1)"><i class="fa fa-save"></i> Save</button>
									</div>
								</div>
							</div>
						</div>
						<div  class="form-group" id="s_add_account_field_sales">
							<label>Akun Pembelian</label>
							<div>
								<div class="input-group">
									<select type="text" id="s_account_penjualan_sales" class="form-control chosen-select2">
									
									</select>
									<div class="input-group-addon" title="Tambah Akun Pembelian" onclick="return add_account_sales(1)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="s_add_account_sales" style="display:none;padding-left:0px;border:1px solid lightgray;border-radius:3px;background:antiquewhite;padding:10px 5px;">
							<div class="col-md-12">
								<label class="col-md-6">Tambah Akun Pembelian </label>
								<label class="col-md-6"><a href="#" onclick="return hide_account_sales(1)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nomor Akun</label>
									<div class="col-md-4" style="padding-left:0px">
										<input type="text" class="form-control form-control-sm " value="" id="s_nomor_account_sales">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nama Akun</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="s_nama_account_sales">
										<input type="hidden" class="form-control form-control-sm " value="Cost of Sales" id="s_tipe_account_sales">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<button  type="button"class="btn btn-success" id="s_save_type_item" type="button" onclick="return save_account_sales(1)"><i class="fa fa-save"></i> Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-left:0px">
							<label>Jumlah Stock</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="s_stock_awal">
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-right:0px">
							<label>Minimal Stock</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="s_minimal_stock">
							</div>
						</div>
						<div class="form-group">
							<label>Tanggal Diterima</label>
							<div>
								<input type="text" class="form-control form-control-sm date" value="" id="s_tanggal_terima">
							</div>
						</div>
						<div class="form-group">
							<label>Supplier</label>
							<div>
								<div class="input-group">
									<select type="text" id="s_supplier" class="form-control chosen-select">
									
									</select>
									<div class="input-group-addon" title="add supplier" onclick="return add_supplier(1)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Deskripsi</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="" id="s_deskripsi">
							</div>
						</div>
						<div class="form-group">
							<br>
						</div>
					</div>
					<div class="col-md-12" id="panel2">
						<div class="col-md-12">
							<a href="#" onclick="return hide_produk(2)" class="pull-right"><i class="fa fa-angle-left"></i> Back</a>
						</div>
						<div class="form-group">
							<label>Tipe Produk</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="Item Non-Stock" readonly id="n_tipe_produk">
							</div>
						</div>
						<div class="form-group">
							<label>Nama Item</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="" id="n_nama_item">
								<input type="hidden" class="form-control form-control-sm " value="" id="n_id_produk">
								<input type="hidden" class="form-control form-control-sm " value="" id="n_id">
							</div>
						</div>
						<div class="form-group col-md-4" style="padding-left:0px">
							<label>Satuan</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="" id="n_satuan_item">
							</div>
						</div>
						<div class="form-group col-md-8" style="padding-right:0px">
							<label>Foto</label>
							<div>
								<input type="file" class="form-control form-control-sm " value="" name="n_foto" id="n_foto">
							</div>
						</div>
						<div class="form-group" id="n_tipe_item_select">
							<label>Tipe Item</label>
							<div>
								<div class="input-group">
									<select type="text" id="n_tipe_item" class="form-control chosen-select">
										<option value=""></option>
									</select>
									<div class="input-group-addon" title="Tambah Item" onclick="return tipe_item(2)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="n_add_tipe_item" style="display:none;padding-left:0px;border:1px solid lightgray;border-radius:3px;background:antiquewhite;padding:10px 5px;">
							<div class="col-md-12">
								<label class="col-md-6">Tambah Tipe Item </label>
								<label class="col-md-6"><a href="#" onclick="return hide_s_item(2)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label class="col-md-2">Nama</label>
									<div class="col-md-7">
										<input type="text" class="form-control form-control-sm " value="" id="n_name_tipe_item">
									</div>
									<div class="col-md-2">
										<button  type="button"class="btn btn-success" id="n_save_type_item" onclick="return save_type_item(2)"><i class="fa fa-save"></i> Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-left:0px">
							<label>Harga Beli</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="n_harga_beli">
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-right:0px">
							<label>Harga Jual</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="n_harga_jual">
							</div>
						</div>
						<div class="form-group" id="n_add_account_field">
							<label>Akun Penjualan</label>
							<div>
								<div class="input-group">
									<select type="text" id="n_account_penjualan" class="form-control chosen-select2">
									
									</select>
									<div class="input-group-addon" title="add Akun" onclick="return add_account(2)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="n_add_account" style="display:none;padding-left:0px;border:1px solid lightgray;border-radius:3px;background:antiquewhite;padding:10px 5px;">
							<div class="col-md-12">
								<label class="col-md-6">Tambah Akun Penjualan </label>
								<label class="col-md-6"><a href="#" onclick="return hide_account(2)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nomor Akun</label>
									<div class="col-md-4" style="padding-left:0px">
										<input type="text" class="form-control form-control-sm " value="" id="n_nomor_account">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nama Akun</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="n_nama_account">
										<input type="hidden" class="form-control form-control-sm " value="Income" id="n_tipe_account">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<button  type="button"class="btn btn-success" id="n_save_type_item" onclick="return save_account(2)"><i class="fa fa-save"></i> Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group" id="n_add_account_field_sales">
							<label>Akun Pembelian</label>
							<div>
								<div class="input-group">
									<select type="text" id="n_account_penjualan_sales" class="form-control chosen-select2">
									
									</select>
									<div class="input-group-addon" title="Tambah Akun Pembelian" onclick="return add_account_sales(2)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="n_add_account_sales" style="display:none;padding-left:0px;border:1px solid lightgray;border-radius:3px;background:antiquewhite;padding:10px 5px;">
							<div class="col-md-12">
								<label class="col-md-6">Tambah Akun Pembelian </label>
								<label class="col-md-6"><a href="#" onclick="return hide_account_sales(2)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nomor Akun</label>
									<div class="col-md-4" style="padding-left:0px">
										<input type="text" class="form-control form-control-sm " value="" id="n_nomor_account_sales">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nama Akun</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="n_nama_account_sales">
										<input type="hidden" class="form-control form-control-sm " value="Cost of Sales" id="s_tipe_account_sales">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<button  type="button"class="btn btn-success" onclick="return save_account_sales(2)"><i class="fa fa-save"></i> Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-left:0px;display:none">
							<label>Jumlah Stock</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="n_stock_awal">
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-right:0px;display:none">
							<label>Minimal Stock</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="n_minimal_stock">
							</div>
						</div>
						<div class="form-group">
							<label>Tanggal Diterima</label>
							<div>
								<input type="text" class="form-control form-control-sm date" value="" id="n_tanggal_terima">
							</div>
						</div>
						<div class="form-group">
							<label>Supplier</label>
							<div>
								<div class="input-group">
									<select id="n_supplier" class="form-control chosen-select">
									
									</select>
									<div class="input-group-addon" title="add supplier" onclick="return add_supplier(2)" style="color: green;">
											<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Deskripsi</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="" id="n_deskripsi">
							</div>
						</div>
						<div class="form-group">
							<br>
						</div>
					</div>
					<div class="col-md-12" id="panel3">
						<div class="col-md-12">
							<a href="#" onclick="return hide_produk(3)" class="pull-right"><i class="fa fa-angle-left"></i> Back</a>
						</div>
						<div class="form-group">
							<label>Tipe Produk</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="Item Paket" readonly id="p_tipe_produk">
							</div>
						</div>
						<div class="form-group">
							<label>Nama Paket</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="" id="p_nama_item">
								<input type="hidden" class="form-control form-control-sm " value="" id="p_id_produk">
								<input type="hidden" class="form-control form-control-sm " value="" id="p_id">
							</div>
						</div>
						<div class="form-group" style="padding-right:0px;">
							<label>Pilih Produk</label>
							<div>
								<table class="table table-strips">
									<thead>
										<tr>
											<th>Nama Produk</th>
											<th>Qty</th>
										</tr>
									</thead>
									<input type="hidden" id="counter" value="1">
									<tbody id="produk_paket">
										<tr id="paket_1">
											<td>
												<div class="input-group">
													<div class="input-group-addon" onclick="return delete_paket(1)">
														<i class="fa fa-trash"></i>
													</div>
													<input type="text" class="form-control" id="nama_paket_1" onchange="check_produk(1)" onkeyup="return pilih_paket(1)">
													<input type="hidden" class="form-control" id="id_paket_1">
												</div>
											</td>
											<td>
												<input type="text" class="form-control money" id="qty_paket_1" onkeyup="check_qty(1)">
											</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2"><button class="btn btn-success" type="button" onclick="return tambah_paket()"><i class="fa fa-plus"></i> Tambah</button></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
						<div class="form-group" style="padding-right:0px;display:none">
							<label>Satuan</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="" id="p_satuan_item">
							</div>
						</div>
						<div class="form-group col-md-8" style="padding-right:0px;display:none">
							<label>Foto</label>
							<div>
								<input type="file" class="form-control form-control-sm " value="" name="p_foto" id="p_foto">
							</div>
						</div>
						<div class="form-group" id="p_tipe_item_select">
							<label>Tipe Paket</label>
							<div>
								<div class="input-group">
									<select type="text" id="p_tipe_item" class="form-control chosen-select">
										<option value=""></option>
									</select>
									<div class="input-group-addon" title="Tambah Tipe Paket" onclick="return tipe_item(3)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="p_add_tipe_item" style="display:none;padding-left:0px;border:1px solid lightgray;border-radius:3px;background:antiquewhite;padding:10px 5px;">
							<div class="col-md-12">
								<label class="col-md-6">Tambah Tipe Paket </label>
								<label class="col-md-6"><a href="#" onclick="return hide_s_item(3)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label class="col-md-2">Nama</label>
									<div class="col-md-7">
										<input type="text" class="form-control form-control-sm " value="" id="p_name_tipe_item">
									</div>
									<div class="col-md-2">
										<button  type="button"class="btn btn-success" id="p_save_type_item" onclick="return save_type_item(3)"><i class="fa fa-save"></i> Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-left:0px;display:none">
							<label>Harga Beli</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="p_harga_beli">
							</div>
						</div>
						<div class="form-group">
							<label>Harga Jual</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="p_harga_jual">
							</div>
						</div>
						<div class="form-group" id="p_add_account_field">
							<label>Akun Penjualan</label>
							<div>
								<div class="input-group">
									<select type="text" id="p_account_penjualan" class="form-control chosen-select2">
									
									</select>
									<div class="input-group-addon" title="tambah akun" onclick="return add_account(3)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="p_add_account" style="display:none;padding-left:0px;border:1px solid lightgray;border-radius:3px;background:antiquewhite;padding:10px 5px;">
							<div class="col-md-12">
								<label class="col-md-6">Tambah Akun Penjualan</label>
								<label class="col-md-6"><a href="#" onclick="return hide_account(3)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nomor Akun</label>
									<div class="col-md-4" style="padding-left:0px">
										<input type="text" class="form-control form-control-sm " value="" id="p_nomor_account">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nama Akun</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="p_nama_account">
										<input type="hidden" class="form-control form-control-sm " value="Income" id="p_tipe_account">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<button  type="button"class="btn btn-success" id="p_save_type_item" onclick="return save_account(3)"><i class="fa fa-save"></i> Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group" id="p_add_account_field_sales">
							<label>Akun Pembelian</label>
							<div>
								<div class="input-group">
									<select type="text" id="p_account_penjualan_sales" class="form-control chosen-select2">
									
									</select>
									<div class="input-group-addon" title="Tambah Akun Pembelian" onclick="return add_account_sales(3)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="p_add_account_sales" style="display:none;padding-left:0px;border:1px solid lightgray;border-radius:3px;background:antiquewhite;padding:10px 5px;">
							<div class="col-md-12">
								<label class="col-md-6">Tambah Akun Pembelian </label>
								<label class="col-md-6"><a href="#" onclick="return hide_account_sales(3)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nomor Akun</label>
									<div class="col-md-4" style="padding-left:0px">
										<input type="text" class="form-control form-control-sm " value="" id="p_nomor_account_sales">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nama Akun</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="p_nama_account_sales">
										<input type="hidden" class="form-control form-control-sm " value="Cost of Sales" id="s_tipe_account_sales">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<button  type="button"class="btn btn-success" onclick="return save_account_sales(3)"><i class="fa fa-save"></i> Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-left:0px;display:none">
							<label>Jumlah Stock</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="p_stock_awal">
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-right:0px;display:none">
							<label>Minimal Stock</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="p_minimal_stock">
							</div>
						</div>
						<div class="form-group" style="display:none">
							<label>Tanggal Diterima</label>
							<div>
								<input type="text" class="form-control form-control-sm date" value="" id="p_tanggal_terima">
							</div>
						</div>
						<div class="form-group">
							<label>Supplier</label>
							<div>
								<div class="input-group">
									<select id="p_supplier" class="form-control chosen-select">
									
									</select>
									<div class="input-group-addon" title="add supplier" onclick="return add_supplier(3)" style="color: green;">
												<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Deskripsi</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="" id="p_deskripsi">
							</div>
						</div>
						<div class="form-group">
							<br>
						</div>
					</div>
					<div class="col-md-12" id="panel4">
						<div class="col-md-12">
							<a href="#" onclick="return hide_produk(4)" class="pull-right"><i class="fa fa-angle-left"></i> Back</a>
						</div>
						<div class="form-group">
							<label>Tipe Produk</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="Item Jasa" readonly id="j_tipe_produk">
							</div>
						</div>
						<div class="form-group">
							<label>Nama Jasa</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="" id="j_nama_item">
								<input type="hidden" class="form-control form-control-sm " value="" id="j_id_produk">
								<input type="hidden" class="form-control form-control-sm " value="" id="j_id">
							</div>
						</div>
						<div class="form-group col-md-4" style="padding-left:0px;display:none">
							<label>Satuan</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="" id="j_satuan_item">
							</div>
						</div>
						<div class="form-group col-md-8" style="padding-right:0px;display:none">
							<label>Foto</label>
							<div>
								<input type="file" class="form-control form-control-sm " value="" name="j_foto" id="j_foto">
							</div>
						</div>
						<div class="form-group" id="j_tipe_item_select">
							<label>Tipe Jasa</label>
							<div>
								<div class="input-group">
									<select type="text" id="j_tipe_item" class="form-control chosen-select">
										<option value=""></option>
									</select>
									<div class="input-group-addon" title="Tambah Tipe Jasa" onclick="return tipe_item(4)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="j_add_tipe_item" style="display:none;padding-left:0px;border:1px solid lightgray;border-radius:3px;background:antiquewhite;padding:10px 5px;">
							<div class="col-md-12">
								<label class="col-md-6">Tambah Tipe Jasa </label>
								<label class="col-md-6"><a href="#" onclick="return hide_s_item(4)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label class="col-md-2">Nama</label>
									<div class="col-md-7">
										<input type="text" class="form-control form-control-sm " value="" id="j_name_tipe_item">
									</div>
									<div class="col-md-2">
										<button  type="button"class="btn btn-success" id="j_save_type_item" onclick="return save_type_item(4)"><i class="fa fa-save"></i> Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-left:0px;display:none">
							<label>Harga Beli</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="j_harga_beli">
							</div>
						</div>
						<div class="form-group col-md-12" style="padding-right:0px;padding-left:0px">
							<label>Harga Jasa</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="j_harga_jual">
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-left:0px;display:none">
							<label>Jumlah Stock</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="j_stock_awal">
							</div>
						</div>
						<div class="form-group col-md-6" style="padding-right:0px;display:none">
							<label>Minimal Stock</label>
							<div>
								<input type="text" class="form-control form-control-sm money" value="" id="j_minimal_stock">
							</div>
						</div>
						<div class="form-group" style="padding-right:0px;display:none">
							<label>Tanggal Diterima</label>
							<div>
								<input type="text" class="form-control form-control-sm date" value="" id="j_tanggal_terima">
							</div>
						</div>
						<div class="form-group" id="j_add_account_field">
							<label>Akun Penjualan</label>
							<div class="input-group">
								<select type="text" id="j_account_penjualan" class="form-control chosen-select">
								
								</select>
								<div class="input-group-addon" title="Tambah akun" onclick="return add_account(4)" style="color: green;">
									<i class="fa fa-plus"></i>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="j_add_account" style="display:none;padding-left:0px;border:1px solid lightgray;border-radius:3px;background:antiquewhite;padding:10px 5px;">
							<div class="col-md-12">
								<label class="col-md-6">Tambah Akun Penjualan </label>
								<label class="col-md-6"><a href="#" onclick="return hide_account(4)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nomor Akun</label>
									<div class="col-md-4" style="padding-left:0px">
										<input type="text" class="form-control form-control-sm " value="" id="j_nomor_account">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nama Akun</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="j_nama_account">
										<input type="hidden" class="form-control form-control-sm " value="Income" id="j_tipe_account">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<button  type="button"class="btn btn-success" id="j_save_type_item" onclick="return save_account(4)"><i class="fa fa-save"></i> Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group" style="display:none" id="j_add_account_field_sales">
							<label>Akun Pembelian</label>
							<div>
								<div class="input-group">
									<select type="text" id="j_account_penjualan_sales" class="form-control chosen-select">
									
									</select>
									<div class="input-group-addon" title="Tambah Akun Pembelian" onclick="return add_account_sales(4)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" id="j_add_account_sales" style="display:none;padding-left:0px;border:1px solid lightgray;border-radius:3px;background:antiquewhite;padding:10px 5px;">
							<div class="col-md-12">
								<label class="col-md-6">Tambah Akun Pembelian </label>
								<label class="col-md-6"><a href="#" onclick="return hide_account_sales(4)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nomor Akun</label>
									<div class="col-md-4" style="padding-left:0px">
										<input type="text" class="form-control form-control-sm " value="" id="j_nomor_account_sales">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-12" style="padding-left:0px">Nama Akun</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="j_nama_account_sales">
										<input type="hidden" class="form-control form-control-sm " value="Cost of Sales" id="s_tipe_account_sales">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<button  type="button"class="btn btn-success" onclick="return save_account_sales(4)"><i class="fa fa-save"></i> Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group" style="padding-right:0px;display:none">
							<label>Supplier</label>
							<div>
								<div class="input-group">
									<select id="j_supplier" class="form-control chosen-select">
									
									</select>
									<div class="input-group-addon" title="add supplier" onclick="return add_supplier(4)" style="color: green;">
										<i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Deskripsi</label>
							<div>
								<input type="text" class="form-control form-control-sm " value="" id="j_deskripsi">
							</div>
						</div>
						<div class="form-group">
							<br>
						</div>
					</div>
					<div class="col-md-12" id="panel5">
						<div class="col-md-12">
								<label class="col-md-6">Tambah Supplier Baru</label>
								<label class="col-md-6" id="hide_supplier"><a href="#" onclick="return hide_s_supplier(1)" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a></label>
							</div>
							<div class="col-md-12" style="padding-top:15px;margin-top:5px; border-top:1px solid lightgray">
								<div class="form-group">
									<label>Title</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="title_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Nama Supplier</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="nama_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Nama Perusahaan</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="nama_pt_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="alamat_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Catatan</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="note_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Email</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="email_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Nomor Telpon</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="phone_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Fax</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="fax_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Website</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="website_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Rata - Rata Order</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="rate_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Maksimum Order</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="maksimum_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Saldo Awal</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="balance_supplier">
									</div>
								</div>
								<div class="form-group">
									<label>Nomor Bisnis</label>
									<div>
										<input type="text" class="form-control form-control-sm " value="" id="bisnis_no_supplier">
									</div>
								</div>
								<div class="form-group" id="btn_save_supplier">
									<button  type="button"class="btn btn-success" id="s_save_type_item" type="button" onclick="return save_supplier(1)"><i class="fa fa-save"></i> Save</button>
								</div>
							</div>
					</div>
				</div>
				<br>
				
		  </div>
		  <div class="modal-footer" id="field_add_supplier" style="position: fixed;background: #337ab7;bottom: 0;right: 0;height:10vh;width: 100%;border-top: 1px solid lightgray;">
			<button type="button" onclick="return save_produk()" class="btn btn-success" id="btn_add"><i class="fa fa-save"></i> Simpan</button><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
</div>
<?php $this->load->view('footer');?>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
	load();
	function load(param = ''){	
		$('#desc_category').text('Semua Produk Dan Jasa');
		if(param != ''){
			$('#desc_category').text(param);
		}
		$("#example1").dataTable({
			"processing": true,
			"scrollX":true,
			"ajax": {
				"url": "<?php echo base_url()?>index.php/master/get_paket",
				"type": "POST",
				data: {param:param},
			},
			"destroy": true,
			"oLanguage": {
				"sProcessing": '<i class="fa fa-spinner fa-pulse"></i> Loading...'
			},
			"aoColumns": [
				{
					render: function (data, type, row, meta) {
						var x = '';
						if(row.category == 'Item Stock'){
							var x = 1;
						}else if(row.category == 'Item Non-Stock'){
							var x = 2;
						}else if(row.category == 'Item Paket'){
							var x = 3;
						}else if(row.category == 'Item Jasa'){
							var x = 4;
						}
						var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;">'+
							'<li class="dropdown">'+
								'<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;">'+
									' <i style="color:black;" class="fa fa-caret-down"></i> '+
								'</a>'+
								'<ul class="dropdown-menu dropdown-messages" style="right: auto !important;">'+
									'<li>'+
										'<a href="#" onclick="return update_produk('+x+',&#39;'+row.id+'&#39;)"><i class="fa fa-pencil"></i> Update</a>'+
									'</li>'+
								'</ul>'+
							'</li>'+
						'</ul>';
						return inv;
					}
				},
				{ "data": "id_produk"},
				{ "data": "nama_produk"},
				{ "data": "category"},
				{ "data": "deskripsi"},
				{ "data": "satuan"},
				{ "data": "harga_jual"},
				{ "data": "harga_beli"},
				{ "data": "stock_awal"},
				{
					render: function (data, type, row, meta) {
						var sts = row.status_paket;
						var inv = '<ul class="navbar-right" style="padding: 0px;margin: 0px;list-style: none;">'+
							'<li class="dropdown">'+
								'<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 5px 15px;">'+
									sts+'&nbsp;<i style="color:black;float:right" class="fa fa-caret-down"></i> '+
								'</a>'+
								'<ul class="dropdown-menu dropdown-messages" style="right: auto !important;">'+
									'<li>'+
										'<a href="#" onclick="return delete_produk(&#39;'+row.id+'&#39;,0)"><i class="fa fa-trash"></i> Used</a>'+
									'</li>'+
									'<li class="divider"></li>'+
									'<li>'+
										'<a href="#" onclick="return delete_produk(&#39;'+row.id+'&#39;,1)"><i class="fa fa-check"></i> Not Used</a>'+
									'</li>'+
								'</ul>'+
							'</li>'+
						'</ul>';
						return inv;
					}
				},
				{
					render: function (data, type, row, meta) {
						var img = row.foto;
						if(row.foto == null){
							img = 'default.jpg';
						}
						return "<img src='<?php echo base_url()?>gambar_barang/"+img+"' height='100px' style='max-width:100px'>";
					}
				}
			],
			"order": [[ 0, "asc" ]],
		});
	}
	
	
	function delete_produk(id,status){
		$.ajax({
			url: '<?php echo base_url()?>index.php/master/delete_produk',
			type: "POST",
			data: {
				id:id,
				status:status
			},
			success: function(datax) {
				var datax = JSON.parse(datax);
				if(datax.ceode == 0){
					alert('Berhasil update status');
					load();
				}else{
					alert('Gagal update status');
					load();
				}
			}
		});
	}
	
	function tambah_paket(){
		var c = $('#counter').val();
		c++;
		$('#produk_paket').append('<tr id="paket_'+c+'">'+
									'<td>'+
										'<div class="input-group">'+
											'<div class="input-group-addon" onclick="return delete_paket('+c+')">'+
												'<i class="fa fa-trash"></i>'+
											'</div>'+
											'<input type="text" class="form-control" id="nama_paket_'+c+'" onchange="check_produk('+c+')" onkeyup="return pilih_paket('+c+')">'+
											'<input type="hidden" class="form-control" id="id_paket_'+c+'">'+
										'</div>'+
									'</td>'+
									'<td>'+
										'<input type="text" class="form-control money" id="qty_paket_'+c+'" onkeyup="check_qty('+c+')">'+
									'</td>'+
								'</tr>');
		$('#counter').val(c);
	}
	
	function check_produk(x){
		if($('#id_paket_'+x).val() == '' && $('#qty_paket_'+x).val() == ''){
			$('#nama_paket_'+x).val('');
			$('#id_paket_'+x).val('');
			$('#qty_paket_'+x).val('');
		}
	}
	
	function delete_paket(x){
		$('#paket_'+x).css('display','none');
		$('#nama_paket_'+x).val('');
		$('#id_paket_'+x).val('');
		$('#qty_paket_'+x).val('');
	}
	
	function pilih_paket(x){
		$('#id_paket_'+x).val('');
		$('#qty_paket_'+x).val('');
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/search_produk',
			type: "POST",
			data: {pn_name:$('#nama_paket_'+x).val(),type:'create_paket'},
			success: function(datax) {
				if($("#nama_produk_"+x).val() == ''){
					$('#nama_paket_'+x).val('');
					$('#id_paket_'+x).val('');
					$('#qty_paket_'+x).val('');
				}
				var datax = JSON.parse(datax);

					var list_name = new Array();
					$.each(datax.data, function(i, item){
						var nama_produk = item.nama_produk;
						var id_produk = item.id_produk;
						list_name.push(id_produk+' - '+nama_produk);
					});
					
					$("#nama_paket_"+x).autocomplete({
						source: list_name,
						select: function( event , ui ) {
							if(ui.item.label == 'Produk tidak ditemukan, Silahkan Tambah produk terlebih dahulu'){
								$('#nama_paket_'+x).val('');
								$('#id_paket_'+x).val('');
								$('#qty_paket_'+x).val('');
							}else{
								var str = (ui.item.label).split(' - ');
								var index = str[0];
								var id_produk = datax.user_list[index]['id_produk'];
								var nama_produk = datax.user_list[index]['nama_produk'];
								$('#nama_paket_'+x).val(nama_produk);
								$('#id_paket_'+x).val(id_produk);
								$('#qty_paket_'+x).val(1);
							}
						},
						response: function(event, ui) {
							if (!(ui.content.length)) {
									var noResult = { value:"",label:"Produk tidak ditemukan, Silahkan Tambah produk terlebih dahulu" };
									ui.content.push(noResult);
							}
						}
					});
					
					if(datax.code != '0'){
						$('#nama_paket_'+x).val('');
						$('#id_paket_'+x).val('');
						$('#qty_paket_'+x).val('');
					}
			}
		});
	}
	
	
	function check_qty(x){
		if((decimal($('#qty_paket_'+x).val())*1 < 1)){
			alert('Quantity minimal 1');
			$('#qty_paket_'+x).val(1);
		}
	}
	
	
	var prefix = "";
	for(x=1;x<=4;x++){
		if(x == 1){
			prefix = 's_';
		}else if(x == 2){
			prefix = 'n_';
		}else if(x == 3){
			prefix = 'p_';
		}else if(x == 4){
			prefix = 'j_';
		}
		$('#'+prefix+'tipe_item').empty();
		$('#'+prefix+'tipe_item').append('<option value="">&nbsp;&nbsp;</option>');
		
		$('#'+prefix+'supplier').empty();
		$('#'+prefix+'supplier').append('<option value="">&nbsp;&nbsp;</option>');
	}
	
	
	$.ajax({
		url: '<?php echo base_url()?>index.php/transaksi/item_type',
		type: "POST",
		data: {},
		success: function(datax) {
			var datax = JSON.parse(datax);
			if(datax.code == 0){
				$.each(datax.data, function(i, item){
						
					if(item.tipe == 'Stock'){
						$('#s_tipe_item').append('<option value="'+item.id+'">'+item.name+'</option>');
					}else if(item.tipe == 'Non-Stock'){
						$('#n_tipe_item').append('<option value="'+item.id+'">'+item.name+'</option>');
					}else if(item.tipe == 'Paket'){
						$('#p_tipe_item').append('<option value="'+item.id+'">'+item.name+'</option>');
					}else if(item.tipe == 'Jasa'){
						$('#j_tipe_item').append('<option value="'+item.id+'">'+item.name+'</option>');
					}
					
				});
			}
			for(x=1;x<=4;x++){
				if(x == 1){
					prefix = 's_';
				}else if(x == 2){
					prefix = 'n_';
				}else if(x == 3){
					prefix = 'p_';
				}else if(x == 4){
					prefix = 'j_';
				}
				$("#"+prefix+"tipe_item").trigger("chosen:updated");
			}
		}
	});
	
	
	
	
	/* $.ajax({
		url: '<?php echo base_url()?>index.php/transaksi/search_produk',
		type: "POST",
		data: {pn_name:$('#nama_produk_'+x).val()},
		success: function(datax) {
			var datax = JSON.parse(datax);
			$('#p_paket_produk').empty();
			if(datax.code == 0){
				$.each(datax.data, function(i, item){
					if(item.category != 'Item Paket'){
						$('#p_paket_produk').append('<option value="'+item.id_produk+'">'+item.nama_produk+'</option>');
					}
				});
				$("#p_paket_produk").trigger("chosen:updated");
			}
		}
	}); */
	
	$.ajax({
		url: '<?php echo base_url()?>index.php/transaksi/supplier',
		type: "POST",
		data: {},
		success: function(datax) {
			var datax = JSON.parse(datax);
			if(datax.code == 0){
				$.each(datax.data, function(i, item){
					for(x=1;x<=4;x++){
						if(x == 1){
							prefix = 's_';
						}else if(x == 2){
							prefix = 'n_';
						}else if(x == 3){
							prefix = 'p_';
						}else if(x == 4){
							prefix = 'j_';
						}
						$('#'+prefix+'supplier').append('<option value="'+item.id+'">'+item.nama+'</option>');
					}
					
				});
			}
			for(x=1;x<=4;x++){
				if(x == 1){
					prefix = 's_';
				}else if(x == 2){
					prefix = 'n_';
				}else if(x == 3){
					prefix = 'p_';
				}else if(x == 4){
					prefix = 'j_';
				}
				$("#"+prefix+"supplier").trigger("chosen:updated");
			}
		}
	});
	
	$.ajax({
		url: '<?php echo base_url()?>index.php/transaksi/account_name',
		type: "POST",
		data: {},
		success: function(datax) {
			var datax = JSON.parse(datax);
			if(datax.code == 0){
				$.each(datax.data, function(i, item){
					for(x=1;x<=4;x++){
						if(x == 1){
							prefix = 's_';
						}else if(x == 2){
							prefix = 'n_';
						}else if(x == 3){
							prefix = 'p_';
						}else if(x == 4){
							prefix = 'j_';
						}
						$('#'+prefix+'account_penjualan').append('<option value="'+item.account_num+'">'+item.account_name+'</option>');
					}
					
				});
			}
			for(x=1;x<=4;x++){
				if(x == 1){
					prefix = 's_';
				}else if(x == 2){
					prefix = 'n_';
				}else if(x == 3){
					prefix = 'p_';
				}else if(x == 4){
					prefix = 'j_';
				}
				$("#"+prefix+"account_penjualan").trigger("chosen:updated");
			}
		}
	});
	
	$.ajax({
		url: '<?php echo base_url()?>index.php/transaksi/account_name_sales',
		type: "POST",
		data: {},
		success: function(datax) {
			var datax = JSON.parse(datax);
			if(datax.code == 0){
				$.each(datax.data, function(i, item){
					for(x=1;x<=4;x++){
						if(x == 1){
							prefix = 's_';
						}else if(x == 2){
							prefix = 'n_';
						}else if(x == 3){
							prefix = 'p_';
						}else if(x == 4){
							prefix = 'j_';
						}
						$('#'+prefix+'account_penjualan_sales').append('<option value="'+item.account_num+'">'+item.account_name+'</option>');
					}
					
				});
			}
			for(x=1;x<=4;x++){
				if(x == 1){
					prefix = 's_';
				}else if(x == 2){
					prefix = 'n_';
				}else if(x == 3){
					prefix = 'p_';
				}else if(x == 4){
					prefix = 'j_';
				}
				$("#"+prefix+"account_penjualan_sales").trigger("chosen:updated");
			}
		}
	});
	
	
	
	function update_produk(x, val){
		$('#modal-product').modal();
		produk_option(x);
		$.ajax({
			url: '<?php echo base_url()?>index.php/master/get_paket',
			type: "POST",
			data: {id:val},
			success: function(datax) {
				var datax = JSON.parse(datax);
				$( ".date" ).datepicker( "option", "disabled", true );
				$.each(datax.data, function(i, item){
					if(x == 1){
						$('#s_id').val(item.id);
						$('#s_id_produk').val(item.id_produk);
						$('#s_nama_item').val(item.nama_produk);
						$('#s_satuan_item').val(item.satuan);
						$('#s_harga_jual').val(item.harga_jual);
						$('#s_deskripsi').val(item.deskripsi);
						$('#s_tipe_item').val(item.tipe_item);
						$('#s_harga_beli').val(item.harga_beli);
						$('#s_stock_awal').val(item.stock_awal);
						$('#s_stock_awal').prop('readonly', true);
						$('#s_minimal_stock').val(item.stock_minimum);
						$('#s_tanggal_terima').val(item.tanggal_diterima);
						$('#s_tanggal_terima').prop('readonly', true);
						$('#s_account_penjualan').val(item.account);
						$('#s_account_penjualan').prop('readonly', true);
						$('#s_account_penjualan').prop('disabled', true).trigger("chosen:updated");
						$('#s_account_penjualan_sales').val(item.account_sales);
						$('#s_account_penjualan_sales').prop('readonly', true);
						$('#s_account_penjualan_sales').prop('disabled', true).trigger("chosen:updated");
						$('#s_supplier').val(item.supplier);
					}else if(x == 2){
						$('#n_id').val(item.id);
						$('#n_id_produk').val(item.id_produk);
						$('#n_nama_item').val(item.nama_produk);
						$('#n_satuan_item').val(item.satuan);
						$('#n_harga_jual').val(item.harga_jual);
						$('#n_deskripsi').val(item.deskripsi);
						$('#n_tipe_item').val(item.tipe_item);
						$('#n_harga_beli').val(item.harga_beli);
						$('#n_stock_awal').val(item.stock_awal);
						$('#n_stock_awal').prop('readonly', true);
						$('#n_minimal_stock').val(item.stock_minimum);
						$('#n_tanggal_terima').val(item.tanggal_diterima);
						$('#n_tanggal_terima').prop('readonly', true);
						$('#n_account_penjualan').val(item.account);
						$('#n_account_penjualan').prop('readonly', true);
						$('#n_account_penjualan').prop('disabled', true).trigger("chosen:updated");
						$('#n_account_penjualan_sales').val(item.account_sales);
						$('#n_account_penjualan_sales').prop('readonly', true);
						$('#n_account_penjualan_sales').prop('disabled', true).trigger("chosen:updated");
						$('#n_supplier').val(item.supplier);
					}else if(x == 3){
						$('#p_id').val(item.id);
						$('#p_id_produk').val(item.id_produk);
						$('#p_nama_item').val(item.nama_produk);
						$('#p_harga_jual').val(item.harga_jual);
						$('#p_deskripsi').val(item.deskripsi);
						$('#p_tipe_item').val(item.tipe_item);
						$('#p_harga_beli').val(item.harga_beli);
						$('#p_stock_awal').val(item.stock_awal);
						$('#p_stock_awal').prop('readonly', true);
						$('#p_minimal_stock').val(item.stock_minimum);
						$('#p_tanggal_terima').val(item.tanggal_diterima);
						$('#p_tanggal_terima').prop('disabled', true).trigger("chosen:updated");
						$('#p_tanggal_terima').prop('readonly', true);
						$('#p_account_penjualan').val(item.account_sales);
						$('#p_account_penjualan').prop('readonly', true);
						$('#p_account_penjualan').prop('disabled', true).trigger("chosen:updated");
						$('#p_account_penjualan_sales').val(item.account);
						$('#p_account_penjualan_sales').prop('readonly', true);
						$('#p_account_penjualan_sales').prop('disabled', true).trigger("chosen:updated");
						$('#p_supplier').val(item.supplier);
						$('#produk_paket').empty();
						$.ajax({
							url: '<?php echo base_url()?>index.php/master/get_paket_detail',
							type: "POST",
							data: {id:item.id},
							success: function(datax2) {
								var datax2 = JSON.parse(datax2);
								var c = 0;
								$.each(datax2.data, function(i2, item2){
									c++;
									$('#produk_paket').append('<tr id="paket_'+c+'">'+
										'<td>'+
											'<div class="input-group">'+
												'<div class="input-group-addon" onclick="return delete_paket('+c+')">'+
													'<i class="fa fa-trash"></i>'+
												'</div>'+
												'<input type="text" class="form-control" id="nama_paket_'+c+'" value="'+item2.id_produk+' - '+item2.nama_produk+'" onchange="check_produk('+c+')" onkeyup="return pilih_paket('+c+')">'+
												'<input type="hidden" class="form-control" value="'+item2.id_produk+'" id="id_paket_'+c+'">'+
											'</div>'+
										'</td>'+
										'<td>'+
											'<input type="text" class="form-control money" id="qty_paket_'+c+'" value="'+item2.qty+'" onkeyup="check_qty('+c+')">'+
										'</td>'+
									'</tr>');
								});
								$('#counter').val(c);
							}
						});
					}else if(x == 4){
						$('#j_id').val(item.id);
						$('#j_id_produk').val(item.id_produk);
						$('#j_nama_item').val(item.nama_produk);
						$('#j_satuan_item').val(item.satuan);
						$('#j_harga_jual').val(item.harga_jual);
						$('#j_deskripsi').val(item.deskripsi);
						$('#j_tipe_item').val(item.tipe_item);
						$('#j_harga_beli').val(item.harga_beli);
						$('#j_stock_awal').val(item.stock_awal);
						$('#j_stock_awal').prop('readonly', true);
						$('#j_minimal_stock').val(item.stock_minimum);
						$('#j_tanggal_terima').val(item.tanggal_diterima);
						$('#j_tanggal_terima').prop('disabled', true).trigger("chosen:updated");
						$('#j_tanggal_terima').prop('readonly', true);
						$('#j_account_penjualan').val(item.account);
						$('#j_account_penjualan').prop('readonly', true);
						$('#j_account_penjualan').prop('disabled', true).trigger("chosen:updated");
						$('#j_account_penjualan_sales').val(item.account_sales);
						$('#j_account_penjualan_sales').prop('readonly', true);
						$('#j_account_penjualan_sales').prop('disabled', true).trigger("chosen:updated");
						$('#j_supplier').val(item.supplier);
					}
				});
				for(x=1;x<=4;x++){
					if(x == 1){
						prefix = 's_';
					}else if(x == 2){
						prefix = 'n_';
					}else if(x == 3){
						prefix = 'p_';
					}else if(x == 4){
						prefix = 'j_';
					}
					$("#"+prefix+"account_penjualan").trigger("chosen:updated");
					$("#"+prefix+"account_penjualan_sales").trigger("chosen:updated");
					$("#"+prefix+"supplier").trigger("chosen:updated");
					$("#"+prefix+"tipe_item").trigger("chosen:updated");
				}
			}
		});
		
	}
	
	function curency(x=''){
		if(x == ''){
			x = 0;
		}
		return x.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
	}
	
	function decimal(x=''){
		if(x == ''){
			x = 0;
		}
		return x.toString().replace(/[^0-9.-]+/g,"");
	}
	
	$('.date').datepicker({
		dateFormat: "dd/mm/yy",
		autoclose: true,
	});
	
	$(".chosen-select").chosen({no_results_text: "Tidak Ditemukan, klik di sini untuk menambahkan", width: "100%"}); 
	$(".chosen-select2").chosen({no_results_text: "Tidak Ditemukan, klik di sini untuk menambahkan", width: "100%"}); 
	
	$("#s_tipe_item_chosen .chosen-drop .chosen-results").click(function(){
		if($("#s_tipe_item_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			tipe_item(1);
		}
	});
	$("#n_tipe_item_chosen .chosen-drop .chosen-results").click(function(){
		if($("#n_tipe_item_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			tipe_item(2);
		}
	});
	$("#p_tipe_item_chosen .chosen-drop .chosen-results").click(function(){
		if($("#p_tipe_item_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			tipe_item(3);
		}
	});
	$("#j_tipe_item_chosen .chosen-drop .chosen-results").click(function(){
		if($("#j_tipe_item_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			tipe_item(4);
		}
	});	
	
	//=============
	
	$("#s_account_penjualan_chosen .chosen-drop .chosen-results").click(function(){
		if($("#s_account_penjualan_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			add_account(1);
		}
	});
	$("#n_account_penjualan_chosen .chosen-drop .chosen-results").click(function(){
		if($("#n_account_penjualan_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			add_account(2);
		}
	});
	$("#p_account_penjualan_chosen .chosen-drop .chosen-results").click(function(){
		if($("#p_account_penjualan_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			add_account(3);
		}
	});
	$("#j_account_penjualan_chosen .chosen-drop .chosen-results").click(function(){
		if($("#j_account_penjualan_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			add_account(4);
		}
	});
	
	
	$("#s_account_penjualan_sales_chosen .chosen-drop .chosen-results").click(function(){
		if($("#s_account_penjualan_sales_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			add_account_sales(1);
		}
	});
	$("#n_account_penjualan_sales_chosen .chosen-drop .chosen-results").click(function(){
		if($("#n_account_penjualan_sales_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			add_account_sales(2);
		}
	});
	$("#p_account_penjualan_sales_chosen .chosen-drop .chosen-results").click(function(){
		if($("#p_account_penjualan_sales_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			add_account_sales(3);
		}
	});
	$("#j_account_penjualan_sales_chosen .chosen-drop .chosen-results").click(function(){
		if($("#j_account_penjualan_sales_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			add_account_sales(4);
		}
	});
	
	
	
	//---------------
	
	
	$("#s_supplier_chosen .chosen-drop .chosen-results").click(function(){
		if($("#s_supplier_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			s_add_supplier(1);
		}
	});
	$("#n_supplier_chosen .chosen-drop .chosen-results").click(function(){
		if($("#n_supplier_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			s_add_supplier(2);
		}
	});
	$("#p_supplier_chosen .chosen-drop .chosen-results").click(function(){
		if($("#p_supplier_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			s_add_supplier(3);
		}
	});
	$("#j_supplier_chosen .chosen-drop .chosen-results").click(function(){
		if($("#j_supplier_chosen .chosen-drop .chosen-results li.no-results").text() != ''){
			s_add_supplier(4);
		}
	});
	
	function add_supplier(x){
		s_add_supplier(x);
	}

	function create(x=null){
		
		for(i=1;i<=4;i++){
			if(i == 1){
				prefix = 's_';
			}else if(i == 2){
				prefix = 'n_';
			}else if(i == 3){
				prefix = 'p_';
			}else if(i == 4){
				prefix = 'j_';
			}
			$('#'+prefix+'minimal_stock').prop('readonly', false);
			$('#'+prefix+'tanggal_terima').prop('readonly', false);
			$('#'+prefix+'stock_awal').prop('readonly', false);
			$('#'+prefix+'account_penjualan').prop('readonly', false);
			$('#'+prefix+'account_penjualan_sales').prop('readonly', false);
			$('#'+prefix+'account_penjualan').prop('disabled', false).trigger("chosen:updated");
			$('#'+prefix+'account_penjualan_sales').prop('disabled', false).trigger("chosen:updated");
			$( ".date" ).datepicker( "option", "disabled", false );
			
		}
		
		
		$('#produk_paket').empty();
		$('#produk_paket').append('<tr id="paket_1">'+
									'<td>'+
										'<div class="input-group">'+
											'<div class="input-group-addon" onclick="return delete_paket(1)">'+
												'<i class="fa fa-trash"></i>'+
											'</div>'+
											'<input type="text" class="form-control" id="nama_paket_1" onchange="check_produk(1)" onkeyup="return pilih_paket(1)">'+
											'<input type="hidden" class="form-control" id="id_paket_1">'+
										'</div>'+
									'</td>'+
									'<td>'+
										'<input type="text" class="form-control money" id="qty_paket_1" onkeyup="check_qty(1)">'+
									'</td>'+
								'</tr>');
		$('#counter').val(1);
		
		$('#field_add_supplier').empty();
		$('#field_add_supplier').append('<button class="btn btn-success" onclick="return save_produk()" id="btn_add"><i class="fa fa-save"></i> Simpan</button><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>');
		
		$('#field_add_supplier').css('display','');
		var nm = $('#nama_produk_'+x).val();
		$("#panel1").slideUp("slow");
		$("#panel2").slideUp("slow");
		$("#panel3").slideUp("slow");
		$("#panel4").slideUp("slow");
		$("#panel5").slideUp("slow");
		$("#mainPanel").slideDown("slow");
		$('#nama_produk_add').val(nm);
		
		$('#modal-product').modal();
	}

	function tipe_item(x){
		var prefix = "";
		if(x == 1){
			prefix = 's_';
		}else if(x == 2){
			prefix = 'n_';
		}else if(x == 3){
			prefix = 'p_';
		}else if(x == 4){
			prefix = 'j_';
		}
		$('#'+prefix+'add_tipe_item').slideToggle();
		$('#'+prefix+'tipe_item_select').slideToggle();
		$('#'+prefix+'minimal_stock').prop('readonly', true);
		$('#'+prefix+'tanggal_terima').prop('readonly', true);
		$('#'+prefix+'account_penjualan').prop('readonly', true);
		$('#'+prefix+'account_penjualan_sales').prop('readonly', true);
		
	}
	
	function hide_s_item(x){
		var prefix = "";
		if(x == 1){
			prefix = 's_';
		}else if(x == 2){
			prefix = 'n_';
		}else if(x == 3){
			prefix = 'p_';
		}else if(x == 4){
			prefix = 'j_';
		}
		$('#'+prefix+'tipe_item').val('');
		$("#"+prefix+"tipe_item").trigger("chosen:updated");
		$('#'+prefix+'add_tipe_item').slideToggle();
		$('#'+prefix+'tipe_item_select').slideToggle();
	}
	
	function save_type_item(x){
		var prefix = "";
		var tipe = "";
		if(x == 1){
			tipe = 'Stock';
			prefix = 's_';
		}else if(x == 2){
			tipe = 'Non-Stock';
			prefix = 'n_';
		}else if(x == 3){
			tipe = 'Paket';
			prefix = 'p_';
		}else if(x == 4){
			tipe = 'Jasa';
			prefix = 'j_';
		}
		if($('#'+prefix+'name_tipe_item').val() == ''){
			alert('Tipe Item tidak boleh kosong !');
		}
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/save_tipe_item',
			type: "POST",
			data: {name:$('#'+prefix+'name_tipe_item').val(), tipe:tipe},
			success: function(datax) {
				var datax = JSON.parse(datax);
				if(datax.code == 0){
					
					$('#'+prefix+'tipe_item').append('<option value="'+datax.data+'">'+$('#'+prefix+'name_tipe_item').val()+'</option>');
					$('#'+prefix+'tipe_item').val(datax.data);
					$("#"+prefix+"tipe_item").trigger("chosen:updated");
					$('#'+prefix+'add_tipe_item').slideToggle();
					$('#'+prefix+'tipe_item_select').slideToggle();
				}else{
					alert('Gagal simpan Tipe Item, mohon ulangi kembali !');
					$('#'+prefix+'tipe_item').val('');
				}
			}
		});
	}
	
	function s_add_supplier(x){
		$('#field_add_supplier').css('display','none');
		$('#hide_supplier').empty();
		$('#hide_supplier').append('<a href="#" onclick="return hide_s_supplier('+x+')" class="pull-right"><i class="fa fa-angle-left"></i> Hide</a>');
		$('#btn_save_supplier').empty();
		$('#btn_save_supplier').append('<button class="btn btn-success" id="s_save_type_item"  type="button" onclick="return save_supplier('+x+')"><i class="fa fa-save"></i> Save</button>');
		$("#panel5").slideToggle();
		$("#panel"+x).slideToggle();
		setTimeout(function() {
			$('#title_supplier').focus();
		}, 1000);
	}
	
	function hide_s_supplier(x){
		$('#field_add_supplier').css('display','');
		var prefix = "";
		if(x == 1){
			prefix = 's_';
		}else if(x == 2){
			prefix = 'n_';
		}else if(x == 3){
			prefix = 'p_';
		}else if(x == 4){
			prefix = 'j_';
		}
		$('#'+prefix+'supplier').val('');
		$("#panel5").slideToggle();
		$("#panel"+x).slideToggle();
	}
	
	function save_supplier(x){
		var prefix = "";
		if(x == 1){
			prefix = 's_';
		}else if(x == 2){
			prefix = 'n_';
		}else if(x == 3){
			prefix = 'p_';
		}else if(x == 4){
			prefix = 'j_';
		}
		if($('#name_supplier').val() == ''){
			alert('Nama Supplier tidak boleh kosong !');
		}
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/save_supplier',
			type: "POST",
			data: {
				title:$('#title_supplier').val(),
				nama:$('#nama_supplier').val(),
				nama_pt:$('#nama_pt_supplier').val(),
				alamat:$('#alamat_supplier').val(),
				catatan:$('#note_supplier').val(),
				email:$('#email_supplier').val(),
				nomor_telpon:$('#phone_supplier').val(),
				fax:$('#fax_supplier').val(),
				website:$('#website_supplier').val(),
				biling_rate:$('#rate_supplier').val(),
				maxsimum_order:$('#maksimum_supplier').val(),
				balance:$('#balance_supplier').val(),
				bussiness_id:$('#bisnis_no_supplier').val(),
			},
			success: function(datax) {
				var datax = JSON.parse(datax);
				if(datax.code == 0){
					$('#field_add_supplier').css('display','');
					for(x2=1;x2<=4;x2++){
						if(x2 == 1){
							prefix2 = 's_';
						}else if(x2 == 2){
							prefix2 = 'n_';
						}else if(x2 == 3){
							prefix2 = 'p_';
						}else if(x2 == 4){
							prefix2 = 'j_';
						}
						$('#'+prefix2+'supplier').append('<option value="'+datax.data+'">'+$('#nama_supplier').val()+'</option>');
						$("#"+prefix2+"supplier").trigger("chosen:updated");
					}
					$("#panel5").slideToggle();
					$("#panel"+x).slideToggle();
					$('#'+prefix+'supplier').val(datax.data);
					$("#"+prefix+"supplier").trigger("chosen:updated");
					
				}else{
					alert('Gagal simpan Supplier, mohon ulangi kembali !');
				}
			}
		});
	}
	
	//------------------------------------
	
	function add_account(x){
		var prefix = "";
		if(x == 1){
			prefix = 's_';
		}else if(x == 2){
			prefix = 'n_';
		}else if(x == 3){
			prefix = 'p_';
		}else if(x == 4){
			prefix = 'j_';
		}
		$("#"+prefix+"add_account_field").slideToggle();
		$("#"+prefix+"add_account").slideToggle();
	}
	
	
	
	function hide_account(x){
		//$('#field_add_supplier').css('display','');
		var prefix = "";
		if(x == 1){
			prefix = 's_';
		}else if(x == 2){
			prefix = 'n_';
		}else if(x == 3){
			prefix = 'p_';
		}else if(x == 4){
			prefix = 'j_';
		}
		$('#'+prefix+'account_penjualan').val('');
		$("#"+prefix+"add_account_field").slideToggle();
		$("#"+prefix+"add_account").slideToggle();
	}
	
	function save_account(x){
		var prefix = "";
		if(x == 1){
			prefix = 's_';
		}else if(x == 2){
			prefix = 'n_';
		}else if(x == 3){
			prefix = 'p_';
		}else if(x == 4){
			prefix = 'j_';
		}
		if($('#'+prefix+'nomor_account').val() == ''){
			alert('Nomor Akun tidak boleh kosong !');
		}else if($('#'+prefix+'nama_account').val() == ''){
			alert('Nama Akun tidak boleh kosong !');
		}
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/save_account',
			type: "POST",
			data: {
				account_num:$('#'+prefix+'nomor_account').val(),
				account_name:$('#'+prefix+'nama_account').val(),
				account_type:$('#'+prefix+'tipe_account').val(),
				status:0,
			},
			success: function(datax) {
				var datax = JSON.parse(datax);
				if(datax.code == 0){
					for(x2=1;x2<=4;x2++){
						if(x2 == 1){
							prefix2 = 's_';
						}else if(x2 == 2){
							prefix2 = 'n_';
						}else if(x2 == 3){
							prefix2 = 'p_';
						}else if(x2 == 4){
							prefix2 = 'j_';
						}
						$('#'+prefix2+'account_penjualan').append('<option value="'+$('#'+prefix+'nomor_account').val()+'">'+$('#'+prefix+'nama_account').val()+'</option>');
						$("#"+prefix2+"account_penjualan").trigger("chosen:updated");
					}
					$("#"+prefix+"add_account_field").slideToggle();
					$("#"+prefix+"add_account").slideToggle();
					$('#'+prefix+'account_penjualan').val($('#'+prefix+'nomor_account').val());
					$("#"+prefix+"account_penjualan").trigger("chosen:updated");
					
				}else{
					alert('Gagal simpan Akun, mohon ulangi kembali !');
				}
			}
		});
	}
	
	
	function add_account_sales(x){
		var prefix = "";
		if(x == 1){
			prefix = 's_';
		}else if(x == 2){
			prefix = 'n_';
		}else if(x == 3){
			prefix = 'p_';
		}else if(x == 4){
			prefix = 'j_';
		}
		$("#"+prefix+"add_account_field_sales").slideToggle();
		$("#"+prefix+"add_account_sales").slideToggle();
	}
	
	
	
	function hide_account_sales(x){
		//$('#field_add_supplier').css('display','');
		var prefix = "";
		if(x == 1){
			prefix = 's_';
		}else if(x == 2){
			prefix = 'n_';
		}else if(x == 3){
			prefix = 'p_';
		}else if(x == 4){
			prefix = 'j_';
		}
		$('#'+prefix+'account_penjualan_sales').val('');
		$("#"+prefix+"add_account_field_sales").slideToggle();
		$("#"+prefix+"add_account_sales").slideToggle();
	}
	
	function save_account_sales(x){
		var prefix = "";
		if(x == 1){
			prefix = 's_';
		}else if(x == 2){
			prefix = 'n_';
		}else if(x == 3){
			prefix = 'p_';
		}else if(x == 4){
			prefix = 'j_';
		}
		if($('#'+prefix+'nomor_account_sales').val() == ''){
			alert('Nomor Akun tidak boleh kosong !');
		}else if($('#'+prefix+'nama_account_sales').val() == ''){
			alert('Nama Akun tidak boleh kosong !');
		}
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/save_account_sales',
			type: "POST",
			data: {
				account_num:$('#'+prefix+'nomor_account_sales').val(),
				account_name:$('#'+prefix+'nama_account_sales').val(),
				account_type:$('#'+prefix+'tipe_account_sales').val(),
				status:0,
			},
			success: function(datax) {
				var datax = JSON.parse(datax);
				if(datax.code == 0){
					for(x2=1;x2<=4;x2++){
						if(x2 == 1){
							prefix2 = 's_';
						}else if(x2 == 2){
							prefix2 = 'n_';
						}else if(x2 == 3){
							prefix2 = 'p_';
						}else if(x2 == 4){
							prefix2 = 'j_';
						}
						$('#'+prefix2+'account_penjualan_sales').append('<option value="'+$('#'+prefix+'nomor_account_sales').val()+'">'+$('#'+prefix+'nama_account_sales').val()+'</option>');
						$("#"+prefix2+"account_penjualan_sales").trigger("chosen:updated");
					}
					$("#"+prefix+"add_account_field_sales").slideToggle();
					$("#"+prefix+"add_account_sales").slideToggle();
					$('#'+prefix+'account_penjualan_sales').val($('#'+prefix+'nomor_account_sales').val());
					$("#"+prefix+"account_penjualan_sales").trigger("chosen:updated");
					
				}else{
					alert('Gagal simpan Akun, mohon ulangi kembali !');
				}
			}
		});
	}
	
	//-----------------------------------------------
	
	function produk_option(x){
		$('#category_produk').val(x);
		
		$("#mainPanel").slideUp();
		$("#panel1").slideUp();
		$("#panel2").slideUp();
		$("#panel3").slideUp();
		$("#panel4").slideUp();
		$("#panel5").slideUp();
		$("#panel"+x).slideToggle();
		
		//stock tambah tipe item
		$("#s_add_tipe_item").slideUp();
		$("#n_add_tipe_item").slideUp();
		$("#p_add_tipe_item").slideUp();
		$("#j_add_tipe_item").slideUp();
	}
	
	function hide_produk(x){
		$("#mainPanel").slideDown();
		$("#panel"+x).slideToggle();
	}
	
	/* function do_add_produk(x=null){
		$('#submit_produk').submit();
	} */
	function save_produk(){
		var category = $('#category_produk').val();		
		var id = $('#nomor_item_produk').val();
		var category = $('#category_produk').val();
		if(category == 1){
			prefix = 's_';
			if($('#s_nama_item').val() == ''){
				alert('Nama Produk Tidak Boleh Kosong');
				return false;
			}else if($('#s_satuan_item').val() == ''){
				alert('Satuan Produk Tidak Boleh Kosong');
				return false;
			}else if($('#s_harga_beli').val() == ''){
				alert('Harga Beli Tidak Boleh Kosong');
				return false;
			}else if($('#s_harga_jual').val() == ''){
				alert('Harga Jual Tidak Boleh Kosong');
				return false;
			}else if($('#s_stock_awal').val() == ''){
				alert('Stock Awal Minimal 1');
				return false;
			}
			
			var data1 = {
				id:$('#s_id').val(),
				id_produk:$('#s_id_produk').val(),
				nama_produk:$('#s_nama_item').val(),
				satuan:$('#s_satuan_item').val(),
				harga_jual:$('#s_harga_jual').val(),
				deskripsi:$('#s_deskripsi').val(),
				status:1,
				category:$('#s_tipe_produk').val(),
				tipe_item:$('#s_tipe_item').val(),
				harga_beli:$('#s_harga_beli').val(),
				stock_awal:$('#s_stock_awal').val(),
				stock_minimum:$('#s_minimal_stock').val(),
				tanggal_diterima:$('#s_tanggal_terima').val(),
				account:$('#s_account_penjualan').val(),
				account_sales:$('#s_account_penjualan_sales').val(),
				supplier:$('#s_supplier').val(),
			}
		}else if(category == 2){
			prefix = 'n_';
			if($('#n_nama_item').val() == ''){
				alert('Nama Produk Tidak Boleh Kosong');
				return false;
			}else if($('#n_satuan_item').val() == ''){
				alert('Satuan Produk Tidak Boleh Kosong');
				return false;
			}else if($('#n_harga_beli').val() == ''){
				alert('Harga Beli Tidak Boleh Kosong');
				return false;
			}else if($('#n_harga_jual').val() == ''){
				alert('Harga Jual Tidak Boleh Kosong');
				return false;
			}
			
			var data1 = {
				id:$('#n_id').val(),
				id_produk:$('#n_id_produk').val(),
				nama_produk:$('#n_nama_item').val(),
				satuan:$('#n_satuan_item').val(),
				harga_jual:$('#n_harga_jual').val(),
				deskripsi:$('#n_deskripsi').val(),
				status:1,
				category:$('#n_tipe_produk').val(),
				tipe_item:$('#n_tipe_item').val(),
				harga_beli:$('#n_harga_beli').val(),
				stock_awal:$('#n_stock_awal').val(),
				stock_minimum:$('#n_minimal_stock').val(),
				tanggal_diterima:$('#n_tanggal_terima').val(),
				account:$('#n_account_penjualan').val(),
				account_sales:$('#n_account_penjualan_sales').val(),
				supplier:$('#n_supplier').val(),
			}
		}else if(category == 3){
			prefix = 'p_';
			if($('#p_nama_item').val() == ''){
				alert('Nama Produk Tidak Boleh Kosong');
				return false;
			}/* else if($('#p_paket_produk').val() == ''){
				alert('Silahkan Pilih Produk');
				return false;
			} */else if($('#p_harga_jual').val() == ''){
				alert('Harga Jual Tidak Boleh Kosong');
				return false;
			}
			
			var paket_produk = new Array();
			for(i=1; i <= $('#counter').val(); i++ ){
				if((decimal($('#qty_paket_'+i).val())*1 > 0) && $('#id_paket_'+i).val() != ''){
					var pkt = {
						'id' : $('#id_paket_'+i).val(),
						'qty' : $('#qty_paket_'+i).val()
					}
					paket_produk.push(pkt);
				}
				
			}
			
			if(paket_produk.length < 1){
				alert('Tidak ada produk yg dipilih, silahkan pilih produk');
				return false;
			}
			
			
			var data1 = {
				id:$('#p_id').val(),
				id_produk:$('#p_id_produk').val(),
				nama_produk:$('#p_nama_item').val(),
				satuan:'Paket',
				harga_jual:$('#p_harga_jual').val(),
				deskripsi:$('#p_deskripsi').val(),
				status:1,
				category:$('#p_tipe_produk').val(),
				tipe_item:$('#p_tipe_item').val(),
				harga_beli:$('#p_harga_beli').val(),
				stock_awal:$('#p_stock_awal').val(),
				stock_minimum:$('#p_minimal_stock').val(),
				tanggal_diterima:$('#p_tanggal_terima').val(),
				account:$('#p_account_penjualan').val(),
				account_sales:$('#p_account_penjualan_sales').val(),
				supplier:$('#p_supplier').val(),
				paket_produk,
			}
		}else if(category == 4){
			prefix = 'j_';
			if($('#j_nama_item').val() == ''){
				alert('Nama Jasa Tidak Boleh Kosong');
				return false;
			}else if($('#j_harga_jual').val() == ''){
				alert('Harga Jasa Tidak Boleh Kosong');
				return false;
			}
			
			var data1 = {
				id:$('#j_id').val(),
				id_produk:$('#j_id_produk').val(),
				nama_produk:$('#j_nama_item').val(),
				satuan:$('#j_satuan_item').val(),
				harga_jual:$('#j_harga_jual').val(),
				deskripsi:$('#j_deskripsi').val(),
				status:1,
				category:$('#j_tipe_produk').val(),
				tipe_item:$('#j_tipe_item').val(),
				harga_beli:$('#j_harga_beli').val(),
				stock_awal:$('#j_stock_awal').val(),
				stock_minimum:$('#j_minimal_stock').val(),
				tanggal_diterima:$('#j_tanggal_terima').val(),
				account:$('#j_account_penjualan').val(),
				account_sales:$('#j_account_penjualan_sales').val(),
				supplier:$('#j_supplier').val(),
			}
		}
		
		
		$.ajax({
			url: '<?php echo base_url()?>index.php/transaksi/save_produk',
			type: "POST",
			data: {
				data1
			},
			success: function(datax) {
				var datax = JSON.parse(datax);
				
				if(category == 1){
					prefix = 's_';
				}else if(category == 2){
					prefix = 'n_';
				}else if(category == 3){
					prefix = 'p_';
				}else if(category == 4){
					prefix = 'j_';
				}
				if(datax.code == 0 && $('#'+prefix+'foto').val() != ''){
					var formData = new FormData();
					formData.append('file', $('input[type=file]')[category-1].files[0]);
					$.ajax({
						url:'<?php echo base_url()?>index.php/transaksi/save_foto?id='+(datax.data),
						type:"post",
						data:  formData,
						processData:false,
						contentType:false,
						cache:false,
						async:false,
						success: function(data2){
							alert('Tambah Produk Berhasil');
						}
					});
					
					for(x2=1;x2<=4;x2++){
						$('#panel'+x2).css('display','none');
					}
					$('#modal-product').modal('hide');
					//$('#p_paket_produk').val('');
					for(x2=1;x2<=4;x2++){
						if(x2 == 1){
							prefix2 = 's_';
						}else if(x2 == 2){
							prefix2 = 'n_';
						}else if(x2 == 3){
							prefix2 = 'p_';
						}else if(x2 == 4){
							prefix2 = 'j_';
						}
						$('#'+prefix2+'id').val('');
						$('#'+prefix2+'id_produk').val('');
						$('#'+prefix2+'nama_item').val('');
						$('#'+prefix2+'satuan_item').val('');
						$('#'+prefix2+'harga_jual').val('');
						$('#'+prefix2+'deskripsi').val('');
						$('#'+prefix2+'tipe_item').val('');
						$('#'+prefix2+'harga_beli').val('');
						$('#'+prefix2+'stock_awal').val('');
						$('#'+prefix2+'minimal_stock').val('');
						$('#'+prefix2+'tanggal_terima').val('');
						$('#'+prefix2+'account_penjualan').val('');
						$('#'+prefix2+'supplier').val('');
						$('#'+prefix2+'foto').val('');
					}
					load();
				}else if(datax.code == 0){
					
					for(x2=1;x2<=4;x2++){
						$('#panel'+x2).css('display','none');
					}
					alert('Tambah Produk Berhasil');
					$('#modal-product').modal('hide');
					//$('#p_paket_produk').val('');
					for(x2=1;x2<=4;x2++){
						if(x2 == 1){
							prefix2 = 's_';
						}else if(x2 == 2){
							prefix2 = 'n_';
						}else if(x2 == 3){
							prefix2 = 'p_';
						}else if(x2 == 4){
							prefix2 = 'j_';
						}
						$('#'+prefix2+'id').val('');
						$('#'+prefix2+'id_produk').val('');
						$('#'+prefix2+'nama_item').val('');
						$('#'+prefix2+'satuan_item').val('');
						$('#'+prefix2+'harga_jual').val('');
						$('#'+prefix2+'deskripsi').val('');
						$('#'+prefix2+'tipe_item').val('');
						$('#'+prefix2+'harga_beli').val('');
						$('#'+prefix2+'stock_awal').val('');
						$('#'+prefix2+'minimal_stock').val('');
						$('#'+prefix2+'tanggal_terima').val('');
						$('#'+prefix2+'account_penjualan').val('');
						$('#'+prefix2+'supplier').val('');
						$('#'+prefix2+'foto').val('');
					}
					load();
				}else{
					alert('Gagal simpan Produk, mohon ulangi kembali !');
					return false;
				}
				
				$('#produk_paket').empty();
				$('#produk_paket').append('<tr id="paket_1">'+
											'<td>'+
												'<div class="input-group">'+
													'<div class="input-group-addon" onclick="return delete_paket(1)">'+
														'<i class="fa fa-trash"></i>'+
													'</div>'+
													'<input type="text" class="form-control" id="nama_paket_1" onchange="check_produk(1)" onkeyup="return pilih_paket(1)">'+
													'<input type="hidden" class="form-control" id="id_paket_1">'+
												'</div>'+
											'</td>'+
											'<td>'+
												'<input type="text" class="form-control money" id="qty_paket_1" onkeyup="check_qty(1)">'+
											'</td>'+
										'</tr>');
				$('#counter').val(1);
			}
		});
		return false;
	}

function edit(x){
	
}
</script>