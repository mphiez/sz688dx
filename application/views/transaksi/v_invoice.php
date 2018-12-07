<!-- 
----------------------------------- README --------------------------------

sv = 1 // halaman 1 invoice berupa deskripsi, halaman 2 berupa sales order
sv = 2 // halaman 1 invoice berupa list penjualan
sv = 3 // halaman 1 invoice berupa deskripsi
sv = 4 // halaman 1 hanya sales order

-->

<link rel="stylesheet" href="<?=base_url()?>font-awesome-4.7.0/css/font-awesome.css">
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
			$id_pelanggan = $row->id_pelanggan;
			$jumlah_termin = $row->jumlah_termin;
			$nama_customer = $row->nama_customer;
			$alamat = $row->alamat;
			$nomor_telfon = $row->nomor_telfon;
			$fax_cust = $row->fax_cust;
			$email = $row->email;
			$jumlah += $row->jumlah;
			$discount = $row->discount;
			$top = $row->top;
			$fullname = $row->fullname;
			$nomor_transaksi = $row->nomor_transaksi;
			$tanggal_transaksi = $row->tanggal_transaksi;
			$tgl_transaksi_header = $row->tgl_transaksi_header;
			
			$nomor_faktur = $row->nomor_faktur;
			
			$atasnama_bank1 = $row->atasnama_bank1;
			$atasnama_bank2 = $row->atasnama_bank2;
			$no_bank1 = $row->no_bank1;
			$no_bank2 = $row->no_bank2;
			$bank1 = $row->bank1;
			$bank2 = $row->bank2;
			
			
		}
		
		if(!empty($data_invoice[0]->detail)){
				foreach($data_invoice[0]->detail as $row){
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




	<?php if($print == 0){
		$inv = $this->input->get('inv');
		$sv = $this->input->get('sv');
		$no_termin = $this->input->get('no_termin');
		?>
		
		<a class="btn btn-info" href="<?php echo base_url()?>index.php/transaksi/invoice?inv=<?php echo $inv;?>&sv=1&preview=no&no_termin=<?php echo $no_termin?>" target="blank" class="button_print" ><i class="fa fa-file"> </i> Invoice & Penjualan .PDF</a>
		
		
		<a class="btn btn-info" href="<?php echo base_url()?>index.php/transaksi/invoice?inv=<?php echo $inv;?>&sv=4&preview=no&no_termin=<?php echo $no_termin?>" target="blank" class="button_print" ><i class="fa fa-file"> </i> Invoice .PDF</a>
		
		
		<a class="btn btn-info" href="<?php echo base_url()?>index.php/transaksi/invoice_print?inv=<?php echo $inv;?>&sv=5&preview=no&no_termin=<?php echo $no_termin?>" target="blank" class="button_print" style=";margin:5px;text-align:center"><i class="fa fa-print"> </i> Print Struk</a>
		
		<a class="btn btn-info" href="<?php echo base_url()?>index.php/transaksi/invoice_print?inv=<?php echo $inv;?>&sv=4&preview=no&no_termin=<?php echo $no_termin?>" target="blank" class="button_print" style="margin:5px;text-align:center"><i class="fa fa-print"> </i> Print Invoice</a>
		
		<a class="btn btn-info" href="<?php echo base_url()?>index.php/transaksi/invoice_print?inv=<?php echo $inv;?>&sv=1&preview=no&no_termin=<?php echo $no_termin?>" target="blank" class="button_print" style="margin:5px;text-align:center"><i class="fa fa-print"> </i> Print Invoice & Penjualan</a>
		<?php
	}
	
	if($this->input->get('sv') != 4 && $this->input->get('sv') != 5){
	?>
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
				<p><span style="text-align:left">Tanggal Invoice</span></p>
				<p><span style="text-align:left">Nomor Invoice</span></p>
				<p><span style="text-align:left">Customer ID.</span></p>
				<p><span style="text-align:left">Nomor Faktur</span></p>
			</td>
			<td align="right"  width="15%">
				<p><span style="text-align:right"><?php echo date("d/m/Y",strtotime($tanggal_invoice))?></span></p>
				<p><span style="text-align:right"><?php echo $nomor_invoice?></span></p>
				<p><span style="text-align:right"><?php echo $id_pelanggan?></span></p>
				<p><span style="text-align:right">&nbsp;<?php echo $nomor_faktur?></span></p>
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
			<td align="left"colspan="8">
				<b>Info Tagihan :</b>
			</td>
		</tr>
	</table>
	<table width="100%" class="gridtable">
		
		<?php if($this->input->get('sv') == 1 || $this->input->get('sv') == 3){?>
			<tr class="bg-gray disabled color-palette">
				<td align="center" width="5%"  style="background-color:#d2d6de"><b>No<br></b></td>
				<td align="center" colspan="3"  style="background-color:#d2d6de"><b>Keterangan<br></b></td>
				<td align="center" width="10%"  style="background-color:#d2d6de"><b>Termin Ke-<br></b></td>
				<td align="center" width="10%"  style="background-color:#d2d6de"><b>Tagihan<br></b></td>
				<td align="center" width="10%"  style="background-color:#d2d6de"><b>PPN<br></b></td>
				<td align="center" width="13%"  style="background-color:#d2d6de"><b>Total Tagihan<br></b></td>
			</tr>
			<?php 
			if(!empty($data_invoice[0]->detail)){
				foreach($data_invoice[0]->detail as $row){
					$deskripsi = $row->deskripsi;
					$total = $row->jumlah_bayar;
					$no_termin = $row->nomor_termin;
					$ppn = 0;
					$tagihan = $row->jumlah_bayar;
					
					$grand = $tagihan;
					$total = $tagihan;
					$jumlah = $tagihan;
					$discount = 0;
				}
			}else{
				$deskripsi = '';
				$total = 0;
				$no_termin = 0;
				$ppn = 0;
				$tagihan = 0;
				
				$grand = $tagihan;
				$total = $tagihan;
				$jumlah = $tagihan;
				$discount = 0;
			}?>
			<tr>
				<td width="5%" >1</td>
				<td align="center" colspan="3"><?php echo $deskripsi?></td>
				<td align="center" width="13%"><?php echo $no_termin;?></td>
				<td align="right" width="13%"><?=number_format($tagihan,0,'.','.')?></td>
				<td align="right" width="13%"><?php echo $ppn;?></td>
				<td align="right" width="13%"><?=number_format($tagihan,0,'.','.')?></td>
				
			</tr>
		<?php }else{
			?>
			<tr class="bg-gray disabled color-palette">
				<td align="center" width="5%"  style="background-color:#d2d6de"><b>No<br></b></td>
				<td align="center" colspan="3"  style="background-color:#d2d6de"><b>Keterangan<br></b></td>
				<td align="center" width="10%"  style="background-color:#d2d6de"><b>Kuantitas<br></b></td>
				<td align="center" width="10%"  style="background-color:#d2d6de"><b>Harga Satuan<br></b></td>
				<td align="center" width="10%"  style="background-color:#d2d6de"><b>PPN<br></b></td>
				<td align="center" width="13%"  style="background-color:#d2d6de"><b>Jumlah<br></b></td>
			</tr>
			<?php
			$no = 1;
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
		<?php $no++; }
		
		}?>
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
	<?php 
	}
	
	if($this->input->get('sv') == 1 || $this->input->get('sv') == 4){?>
	<style>
		.pagebreak { page-break-before: always; }
	</style>
	<?php if($this->input->get('sv') != 4){?>
	<div class="pagebreak"> </div>
	<?php }?>
	<table width="100%" class="gridtable-head"  width='100%'>
		<tr>
			<td colspan="4"><img src="<?php echo $logo;?>" height="80px" style="margin-top:20px"></td>
			<td align="right"  colspan="4" class="font"><h1>SALES</h1></td>
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
				<p><span style="text-align:left">Tanggal Transaksi</span></p>
				<p><span style="text-align:left">Nomor Transaksi</span></p>
				<p><span style="text-align:left">Customer ID.</span></p>
			</td>
			<td align="right"  width="15%">
				<p><span style="text-align:right"><?php echo date("d/m/Y",strtotime($tgl_transaksi_header))?></span></p>
				<p><span style="text-align:right"><?php echo $nomor_transaksi?></span></p>
				<p><span style="text-align:right"><?php echo $id_pelanggan?></span></p>
			</td>
		</tr>
		<tr>
			<td align="left" width="10%">
				<b>Sales To</b>
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
		<tr>
			<td align="left"colspan="8">
			</td>
		</tr>
		<tr>
			<td align="left"colspan="8">
				<b>Daftar Penjualan :</b>
			</td>
		</tr>
	</table>
	<style>
		.border_list {
			border-width: 1px;
			padding: 8px;
			border-style: solid !important;
			border-color: #666666 !important;
			background-color: #ffffff;
			font-family: verdana,arial,sans-serif;
			font-size:10px;
		}
	</style>
	<table width="100%" class="gridtable" style="border: 1px solid gray">
		<tr>
			<tr class="bg-gray disabled color-palette">
				<td align="center" width="5%"  style="background-color:#d2d6de"><b>No<br></b></td>
				<td align="center" colspan="3"  style="background-color:#d2d6de"><b>Keterangan<br></b></td>
				<td align="center" width="10%"  style="background-color:#d2d6de"><b>Kuantitas<br></b></td>
				<td align="center" width="10%"  style="background-color:#d2d6de"><b>Harga Satuan<br></b></td>
				<td align="center" width="10%"  style="background-color:#d2d6de"><b>PPN<br></b></td>
				<td align="center" width="13%"  style="background-color:#d2d6de"><b>Jumlah<br></b></td>
			</tr>
		</tr>
		<?php
			$no = 1;
			foreach($data_invoice as $row){
				
			?>
			<tr>
				<td width="5%" class="border_list"><?php echo $no?></td>
				<td align="center" colspan="3"  class="border_list"><?php echo $row->nama_produk?></td>
				<td align="center" width="13%"  class="border_list"><?php echo $row->kuantitas?></td>
				<td align="right" width="13%"  class="border_list"><?=number_format($row->harga_satuan,0,'.','.')?></td>
				<td align="right" width="13%"  class="border_list" ><?=number_format($row->pajak,0,'.','.')?></td>
				<td align="right" width="13%"  class="border_list"><?=number_format($row->jumlah,0,'.','.')?></td>
				
			</tr>
		<?php $no++; }?>
		<tr>
			<td colspan="6"></td>
			<td align="right" width="13%"  class="border_list">Subtotal</td>
			<td align="right" width="13%"  class="border_list"><?=number_format($jumlah_1,0,'.','.')?></td>
		</tr>
		<tr>
			<td colspan="6"></td>
			<td align="right" width="13%"  class="border_list">Diskon</td>
			<td align="right" width="13%"  class="border_list"><?=number_format($discount_1,0,'.','.')?></td>
		</tr>
		<tr>
			<td colspan="6"></td>
			<td align="right" width="13%"  class="border_list">Grand Total</td>
			<td align="right" width="13%" class="border_list"><?=number_format($grand_1,0,'.','.')?></td>
		</tr>
	</table>
	
	
	<?php }
	
	if($this->input->get('sv') == 5){
	

		echo '<style>.member-detail .team-detail .name h6{ color:#e74c3c;}.member-detail .gallery-sec .layer { background-color: rgba(2, 173, 198, 0.81);}.member-detail .team-detail ul li span{width:70%;}.member-detail .team-detail ul li span.title{width:30%;}.member-detail{ padding:90px 0;}.member-detail .team-detail ul{ }.member-detail .team-detail ul li{  margin: 15px 0 0 0;padding: 0 0 15px 0;float: left;width: 100%;border-bottom: solid 1px #dedede;list-style: none;margin-left: -36px;}.member-detail .team-detail ul li span{ font-size: 12px;float: right;width: 70%;}.member-detail .team-detail ul li span.title{  color: #353535;font-weight: 700;width: 30%;float: left;font-size: 10pt;}.meet-specialists .gallery-sec a { color: #fff; border: solid 1px #fff; padding: 8px 9px; border-radius: 100%; font-size: 16px; position: initial; margin: 0 2px;}.meet-specialists .gallery-sec a:hover { background: #fff;}.meet-specialists .gallery-sec .layer { padding: 50% 0; text-align: center; transition:all .4s ease-in-out;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;}.member-detail .gallery-sec a { color: #fff; border: solid 1px #fff; padding: 8px 9px; border-radius: 100%; font-size: 16px; position: initial; margin: 0 2px;}.member-detail .gallery-sec a:hover { color: #02adc6; background: #fff;}.member-detail .gallery-sec .layer { padding: 42% 0; text-align: center; transition:all .4s ease-in-out;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;}</style>';?>

		<div class="row member-detail" style="width: 400px;border: none;padding: 4px;margin: 8px;">
			<div class="span6">
				<div id="team-detail" class="owl-carousel owl-theme" style="opacity: 1;display: block;">
					<div class="owl-wrapper-outer"><div class="owl-wrapper" style="left: 0px;display: block;"><div class="owl-item" style=""><div class="post item">
						<div class="col-md-12">
							<div class="gallery-sec">		
								<div class="image-hover img-layer-slide-left-right" style="border-bottom: 2px solid #000;">
									<img src="<?php echo $logo;?>" style="max-width: 50%;max-height:80px">		
									<div style="max-width: 50%;float:right;">
										<p style="font-size:10px"><b><?php echo $nama_perusahaan;?><b></p>
										<p style="font-size:10px"><span><?php echo $alamat_perusahaan;?></span><br><span> Telf. <?php echo $telfon_perusahaan?></span></p>
										
									</div>		
								</div>
								<div>
									<p style="font-size:10px"><span><?php echo date("Y-m-d H:i:s")?></p>
									
								</div>
							</div>
						</div>
						<div class="col-md-12" style="">
							<div class="team-detail" style="padding: 0px 0px !important;">
								<table width="100%" class="gridtable" style="border: 1px solid gray">
									<tr>
										<tr class="bg-gray disabled color-palette">
											<td align="center" width="5%"  style="background-color:#d2d6de"><b>No<br></b></td>
											<td align="center" colspan="3"  style="background-color:#d2d6de"><b>Keterangan<br></b></td>
											<td align="center" width="10%"  style="background-color:#d2d6de"><b>Kuantitas<br></b></td>
											<td align="center" width="10%"  style="background-color:#d2d6de"><b>Harga Satuan<br></b></td>
											<td align="center" width="10%"  style="background-color:#d2d6de"><b>PPN<br></b></td>
											<td align="center" width="13%"  style="background-color:#d2d6de"><b>Jumlah<br></b></td>
										</tr>
									</tr>
									<?php
										$no = 1;
										foreach($data_invoice as $row){
											
										?>
										<tr>
											<td width="5%" class="border_list"><?php echo $no?></td>
											<td align="center" colspan="3"  class="border_list"><?php echo $row->nama_produk?></td>
											<td align="center" width="13%"  class="border_list"><?php echo $row->kuantitas?></td>
											<td align="right" width="13%"  class="border_list"><?=number_format($row->harga_satuan,0,'.','.')?></td>
											<td align="right" width="13%"  class="border_list" ><?=number_format($row->pajak,0,'.','.')?></td>
											<td align="right" width="13%"  class="border_list"><?=number_format($row->jumlah,0,'.','.')?></td>
											
										</tr>
									<?php $no++; }?>
									<tr>
										<td colspan="6"></td>
										<td align="right" width="13%"  class="border_list">Subtotal</td>
										<td align="right" width="13%"  class="border_list"><?=number_format($jumlah_1,0,'.','.')?></td>
									</tr>
									<tr>
										<td colspan="6"></td>
										<td align="right" width="13%"  class="border_list">Diskon</td>
										<td align="right" width="13%"  class="border_list"><?=number_format($discount_1,0,'.','.')?></td>
									</tr>
									<tr>
										<td colspan="7" align="right" class="border_list">Total</td>
										<td align="right" width="13%" class="border_list"><?=number_format($grand_1,0,'.','.')?></td>
									</tr>
								</table>
							</div>
						</div>
					</div></div></div></div></div>
			</div>
		</div>
		<!--script language=vbscript> 
			fnPrint()
		</script-->

		<script> 
			window.print();
			//window.close();
		</script>	
		
	<?php	
	}
	?>
	
	
	<?php }else{
		echo "NO DATA FOUND !";
	}?>
	
	<script>
		<?php if($print == 2){ 
			echo "window.print();";
			//echo "window.close()";
		} ?>
	</script>