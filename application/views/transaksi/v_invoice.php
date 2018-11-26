<?php
	if($data_invoice > 0){
		$jumlah = 0;
		foreach($data_invoice as $row){
			$logo = base_url()."/assets/".$row->logo;
			$nama_perusahaan = $row->nama_perusahaan;
			$alamat_perusahaan = $row->alamat_perusahaan;
			$telfon_perusahaan = $row->telfon_perusahaan;
			$email_perusahaan = $row->email_perusahaan;
			$fax_perusahaan = $row->fax_perusahaan;
			$tanggal_invoice = $row->tanggal_invoice;
			$nomor_invoice = $row->nomor_invoice;
			$id_pelanggan = $row->id_pelanggan;
			$nama_customer = $row->nama_customer;
			$alamat = $row->alamat;
			$nomor_telfon = $row->nomor_telfon;
			$fax_cust = $row->fax_cust;
			$email = $row->email;
			$jumlah += $row->jumlah;
			$discount = $row->discount;
			$top = $row->top;
			$fullname = $row->fullname;
			
			$nomor_faktur = $row->nomor_faktur;
			
			$atasnama_bank1 = $row->atasnama_bank1;
			$atasnama_bank2 = $row->atasnama_bank2;
			$no_bank1 = $row->no_bank1;
			$no_bank2 = $row->no_bank2;
			$bank1 = $row->bank1;
			$bank2 = $row->bank2;
		}
		$grand = $jumlah - $discount;
	
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
</style>
	<table width="100%" class="gridtable-head"  width='100%'>
		<tr>
			<td colspan="4"><img src="<?php echo $logo;?>" height="80px" style="margin-top:20px"></td>
			<td align="right"  colspan="4" class="font"><h1>INVOICE</h1></td>
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
			<td width="15%">
				<p><span style="text-align:left">Date</span></p>
				<p><span style="text-align:left">Invoice No.</span></p>
				<p><span style="text-align:left">Customer ID.</span></p>
				<p><span style="text-align:left">Nomor Faktur</span></p>
			</td>
			<td align="right"  width="15%">
				<p><span style="text-align:right"><?php echo date("d/m/y",strtotime($tanggal_invoice))?></span></p>
				<p><span style="text-align:right"><?php echo $nomor_invoice?></span></p>
				<p><span style="text-align:right"><?php echo $id_pelanggan?></span></p>
				<p><span style="text-align:right"><?php echo $nomor_faktur?></span></p>
			</td>
		</tr>
		<tr>
			<td align="left" width="10%">
				<b>Bill To</b>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			</td>
			<td align="left" width="2%">
				<b>:</b>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			</td>
			<td align="left" colspan="6" width="50%">
				<h3><?php echo $nama_customer?></h3>
				<p><span><?php echo $alamat?></span></p>
				<p><span>Tel. <?php echo $nomor_telfon?></span></p>
				<p><span>Fax. <?php echo $fax_cust?></span></p>
				<p><span>Email <?php echo $email?></span></p>
			</td>
		</tr>
	</table>
	<table width="100%" class="gridtable">
		
		<tr class="bg-gray disabled color-palette">
			<td align="center" width="5%"  style="background-color:#d2d6de"><b>No<br></b></td>
			<td align="center" colspan="3"  style="background-color:#d2d6de"><b>Keterangan<br></b></td>
			<td align="center" width="10%"  style="background-color:#d2d6de"><b>Kuantitas<br></b></td>
			<td align="center" width="10%"  style="background-color:#d2d6de"><b>Harga Satuan<br></b></td>
			<td align="center" width="10%"  style="background-color:#d2d6de"><b>PPN<br></b></td>
			<td align="center" width="13%"  style="background-color:#d2d6de"><b>Jumlah<br></b></td>
		</tr>
		<?php $no = 1;
		foreach($data_invoice as $row){
			
		?>
		
		<tr>
			<td width="5%" ><?php echo $no?></td>
			<td align="center" colspan="3"><?php echo $row->nama_produk?></td>
			<td align="center" width="13%"><?php echo $row->kuantitas?></td>
			<td align="right" width="13%"><?=number_format($row->harga_satuan,0,'.','.')?></td>
			<td align="right" width="13%"><?=number_format($row->pajak,0,'.','.')?></td>
			<td align="right" width="13%"><?=number_format($row->jumlah,0,'.','.')?></td>
			
		</tr>
		<?php $no++; }?>
		<tr>
			<td align="center" width="50%" colspan="4">
			<b>Jatuh Tempo Pembayaran : <?php echo date("d F Y",strtotime("+".$top." days",strtotime($tanggal_invoice)));?><br>
			(Payment Due Date : <?=date("F d, Y",strtotime("+".$top." days",strtotime($tanggal_invoice)));?></b>
			</td>
			<td width="33%" colspan="3">Harga Jual / Penggantian (Sales Price / Replacement)</td>
			<td width="17%" align="right">Rp. <?=number_format($jumlah,0,'.','.')?></td>
		</tr>
		
		<tr>
			<td width="50%" rowspan="2" colspan="4">
			<i>
			NOTE: Apabila Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak menilai adanya
			ketidaksesuaian dengan isi invoice, harap diajukan dalam kurun waktu 7 (tujuh) hari kerja
			dihitung sejak diterimanya invoice oleh customer. Setelah masa tersebut invoice ini dianggap
			disetujui.
			</i>
			</td>
			<td colspan="3">Potongan Harga (Discount) / Denda (Penalty)</td>
			<td align="right">Rp. <?=number_format($discount,0,'.','.')?></td>
		</tr>
		<tr>
			<td colspan="3">Total Tagihan (Total Invoice)</td>
			<td align="right">Rp. <?=number_format($grand,0,'.','.')?></td>
		</tr>
		<tr>
			<td width="100%" colspan="8" align="center">#<?=Terbilang($grand)?> Rupiah<br>#<?=Terbilang_inggris($grand)?> Rupiah</td>
		</tr>
		<tr>
			<td width="100%" colspan="8" align="center">
			Pembayaran dilakukan melalui :
			<br>Bank <?=$bank1;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank <?=$bank2?><br>atau&nbsp;&nbsp;&nbsp;&nbsp;
			<br>Nomor : <?=$no_bank1?> a.n <?=$atasnama_bank1?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor : <?=$no_bank2?> a.n <?=$atasnama_bank2?></td>
		</tr>
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
	<?php }else{
		echo "NO DATA FOUND !";
	}?>