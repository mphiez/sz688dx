<!-- 
----------------------------------- README --------------------------------

sv = 1 // halaman 1 invoice berupa deskripsi, halaman 2 berupa sales order
sv = 2 // halaman 1 invoice berupa list penjualan
sv = 3 // halaman 1 invoice berupa deskripsi
sv = 4 // halaman 1 hanya sales order

-->

<link rel="stylesheet" href="<?=base_url()?>font-awesome-4.7.0/css/font-awesome.css">
<?php
	if($data_spj > 0){
		$jumlah = 0;
		
		foreach($data_spj as $row){
			$logo = base_url()."/assets/".$row->logo;
			$nama_perusahaan 	= $row->nama_perusahaan;
			$alamat_perusahaan 	= $row->alamat_perusahaan;
			$telfon_perusahaan 	= $row->nomor_telpon_perusahaan;
			$email_perusahaan 	= $row->email_perusahaan;
			$fax_perusahaan 	= $row->fax_perusahaan;
			$id_pelanggan 		= $row->id_pelanggan;
			$jumlah_termin 		= $row->jumlah_termin;
			$nama_customer 		= $row->nama_customer;
			$alamat 			= $row->alamat_customer;
			$nomor_telfon 		= $row->nomor_telfon_customer;
			$fax_cust 			= $row->fax_customer;
			$email 				= $row->email_customer;
			$jumlah 			+= $row->jumlah;
			$discount 			= $row->discount;
			$top 				= $row->top;
			$fullname 			= $row->fullname;
			$nomor_transaksi 	= $row->nomor_transaksi;
			$tanggal_transaksi 	= $row->tanggal_transaksi;
			$tgl_transaksi_header = $row->tgl_transaksi_header;
			
			$nomor_faktur 		= $row->nomor_faktur;
			
			$atasnama_bank1 	= $row->atasnama_bank1;
			$atasnama_bank2 	= $row->atasnama_bank2;
			$no_bank1 			= $row->no_bank1;
			$no_bank2 			= $row->no_bank2;
			$bank1 				= $row->bank1;
			$bank2 				= $row->bank2;
			$ship_name 			= $row->ship_to_name;
			$ship_address 		= $row->ship_address;
			$ship_phone 		= $row->ship_phone;
			$ship_email 		= $row->ship_email;
			$nomor_invoice 		= $row->nomor_invoice;
			$id_spj 		= $row->id_spj;
			
			
		}
		
		if(!empty($data_spj[0]->detail)){
				foreach($data_spj[0]->detail as $row){
					$tanggal_invoice = $row->tanggal_invoice;
					$nomor_invoice = $row->nomor_invoice;
				}
		}
		$grand = $jumlah - $discount;
		$discount_1 = $discount;
		$jumlah_1 = $jumlah;
		$grand_1 = $grand;
	
?>
<style type="text/css">
@page {
	margin-top: 0.5cm;
	margin-bottom: 0.5cm;
    margin-left: 1cm;
    margin-right: 1cm;
}
.font{
	font-family: verdana,arial,sans-serif,tahoma;
	font-size:14px;
}

.fontheader{
	font-family: verdana,arial,sans-serif;
	font-size:14px;
}
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family:tahoma;
	font-size:11px;
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family: verdana,arial,sans-serif;
	font-size:10px;
}
table.gridtable-head td {
	border-width: 0px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family: verdana,arial,sans-serif;
	font-size:10px;
}

table.gridtable2 {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: thin;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable2 th {
	border-width: thin;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family:tahoma;
	font-size:11px;
}
table.gridtable2 td {
	border-width: 0px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family: verdana,arial,sans-serif;
	font-size:10px;
}
table.bordered td {
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family:tahoma;
	font-size:11px;
}
table.bordered th {
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family:tahoma;
	font-size:11px;
}
.aa {
	font-size: 10px;
	color:red;
	margin-top:5px;
}

.button_print{
	border:1px solid lightgray;
	padding : 3px 5px;
	border-radius:2px;
	//background-color:lightgray;
	cursor:pointer;
	float:right;
}

/* .button_print:hover{
	background-color:lightblue;
} */

.btn-info {
    background-color: #00c0ef;
	border-color: #00acd6;
}
.btn {
    border-radius: 3px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent;
}

.btn:hover {
	background:#07a1c6;
}

.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
	text-decoration: none;
	color:white;
}

</style>
	<table width="100%" class="gridtable-head"  width='100%'>
		<tr>
			<td colspan="6"><img src="<?php echo $logo;?>" height="60px"></td>
			<td align="right"  colspan="2" class="font">
				<h1>Surat Perintah Jalan</h1>
				<p><span style="text-align:left">Tanggal Kirim  &nbsp;&nbsp;&nbsp;</span><span style="text-align:right"><?php echo date("d/m/Y")?></span></p>
				<p><span style="text-align:left">Nomor SPJ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style="text-align:right"><?php echo $id_spj?></span></p>
				<p><span style="text-align:left">Customer ID &nbsp;&nbsp;&nbsp;</span><span style="text-align:right"><?php echo $id_pelanggan?></span></p>
			</td>
		</tr>
	</table>
	<hr>
	<table width="100%" class="gridtable-head"  width='100%'>
		<tr>
			<td align="left" colspan="4" width="50%">
				<h3><?php echo $nama_perusahaan;?></h3>
				<p><span><?php echo $alamat_perusahaan;?></span></p>
				<p><span>Telf. <?php echo $telfon_perusahaan?></span></p>
				<p><span>Fax. <?php echo $fax_perusahaan?></span></p>
				<p><span>Email <?php echo $email_perusahaan?></span></p>
			</td>
			<td align="right" colspan="2"></td>
			<td align="left" width="10%">
				<b>Penerima</b>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			</td>
			<td align="left">
				<?php if($ship_address != ''){?>
					<h3><?php echo $ship_name?></h3>
					<p><span><?php echo $ship_address?></span></p>
					<p><span>Tel. <?php echo $ship_phone?></span></p>
					<p><span>Fax. <?php echo $fax_cust?></span></p>
					<p><span>Email. <?php echo $ship_email?></span></p>
				<?php }else{
				?>
					<h3><?php echo $nama_customer?></h3>
					<p><span><?php echo $alamat?></span></p>
					<p><span>Tel. <?php echo $nomor_telfon?></span></p>
					<p><span>Fax. <?php echo $fax_cust?></span></p>
					<p><span>Email. <?php echo $email?></span></p>
				<?php
				}?>
			</td>
		</tr>
	</table>
	<table width="100%" class="gridtable-head"  width='100%'>
		<tr>
			<td align="left" colspan="8">
				<b>Informasi Barang :</b>
			</td>
		</tr>
	</table>
	<table width="100%" class="gridtable">
			<tr class="bg-gray disabled color-palette">
				<td align="center" width="5%"  style="background-color:#d2d6de"><b>No<br></b></td>
				<td align="center" colspan="1"  style="background-color:#d2d6de"><b>ID Barang<br></b></td>
				<td align="center" colspan="1"  style="background-color:#d2d6de"><b>Nama Barang<br></b></td>
				<td align="center" width="10%"  style="background-color:#d2d6de"><b>Deskripsi<br></b></td>
				<td align="center" width="10%"  style="background-color:#d2d6de"><b>Kuantitas<br></b></td>
			</tr>
			<?php
			$no = 1;
			foreach($data_spj as $row){
				
			?>
			<tr>
				<td width="5%" ><?php echo $no?></td>
				<td align="left" colspan="1" width="15%"><?php echo $row->id_barang?></td>
				<td align="left" width="40%"><?php echo $row->nama_barang?></td>
				<td align="left" width="20%"><?=$row->deskripsi?></td>
				<td align="center" width="13%"><?=number_format($row->qty,0,'.','.')?></td>
				
			</tr>
	<?php $no++; } }?>
	</table>
	<table width="100%" class="gridtable2">
		<tr>
			<td align="center" colspan="3">
			</td>
			<td align="center">
			<?=date("d F Y")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		<tr>
			<td align="right" colspan="4" height="100px">
			</td>
		</tr>
		<tr>
			<td colspan="3" width="50%"><i>Print by Staf Finance
			<?=date("d/m/y H:i:s")?></i>
			</td>
			<td align="center"  width="25%">
			( <?php echo $fullname?> )
			</td>
		</tr>
	</table>
	
	<script>
		<?php if($print == 2){ 
			echo "window.print();";
			//echo "window.close()";
		} ?>
	</script>