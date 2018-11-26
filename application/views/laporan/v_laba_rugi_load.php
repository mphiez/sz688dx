
					  <table class="table table-bordered table-hover dataTable" id="example">
						<thead>
							<tr style="background: #b6b6b6;color: white;">
							  <th>Keterangan</th>
							  <th>Awal Periode</th>
							  <th>Periode Berjalan</th>
							  <th>Periode Akhir</th>
							</tr>
						</thead>
						<tbody>
							<tr style="background: #e9e9e9;">
							  <th colspan="4">PENDAPATAN</th>
							</tr>
							<?php 
								$periode_awal = 0;
								$periode_berjalan = 0;
								$periode_akhir = 0;
								if(!empty($pendapatan)){
									foreach($pendapatan as $row){
							?>
							<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row->account_name?></td>
								<td><?php echo number_format($row->periode_awal)?></td>
								<td><?php echo number_format($row->periode_berjalan)?></td>
								<td><?php echo number_format($row->periode_akhir)?></td>
							</tr>
								<?php 
								$periode_awal += $row->periode_awal;
								$periode_berjalan += $row->periode_berjalan;
								$periode_akhir += $row->periode_akhir;
								} }?>
							<tr>
								<td style="text-align:center"><b>JUMLAH PENDAPATAN USAHA</b></td>
								<td><b><?php echo number_format($pendapatan_awal = $periode_awal)?></b></td>
								<td><b><?php echo number_format($pendapatan_berjalan = $periode_berjalan)?></b></td>
								<td><b><?php echo number_format($pendapatan_akhir = $periode_akhir)?></b></td>
							</tr>
							<tr style="background: #e9e9e9;">
							  <th colspan="4">HARGA POKOK PENJUALAN</th>
							</tr>
							<?php 
								$periode_awal = 0;
								$periode_berjalan = 0;
								$periode_akhir = 0;
								if(!empty($hpp)){
									foreach($hpp as $row){
							?>
							<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row->account_name?></td>
								<td><?php echo number_format($row->periode_awal)?></td>
								<td><?php echo number_format($row->periode_berjalan)?></td>
								<td><?php echo number_format($row->periode_akhir)?></td>
							</tr>
								<?php 
								$periode_awal += $row->periode_awal;
								$periode_berjalan += $row->periode_berjalan;
								$periode_akhir += $row->periode_akhir;
								} }?>
							<tr>
								<td style="text-align:center"><b>JUMLAH HARGA POKOK PENJUALAN</b></td>
								<td><b><?php echo number_format($periode_awal)?></b></td>
								<td><b><?php echo number_format($periode_berjalan)?></b></td>
								<td><b><?php echo number_format($periode_akhir)?></b></td>
							</tr>
							<tr style="background: #e9e9e9;">
							  <th colspan="4">BIAYA</th>
							</tr>
							<?php
								$periode_awal = 0;
								$periode_berjalan = 0;
								$periode_akhir = 0;
								if(!empty($biaya)){
									foreach($biaya as $row){
										$periode_awal += $row->periode_awal;
										$periode_berjalan += $row->periode_berjalan;
										$periode_akhir += $row->periode_akhir;
									}
								}
							?>
							<tr style="background: #e9e9e9;">
							  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Beban Usaha</b></td>
							  <td><b><?php echo number_format($beban_usaha_awal = $periode_awal);?></b></td>
							  <td><b><?php echo number_format($beban_usaha_berjalan = $periode_berjalan);?></b></td>
							  <td><b><?php echo number_format($beban_usaha_akhir = $periode_akhir);?></b></td>
							</tr>
							<?php 
								$periode_awal = 0;
								$periode_berjalan = 0;
								$periode_akhir = 0;
								if(!empty($biaya)){
									foreach($biaya as $row){
							?>
							<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row->account_name?></td>
								<td><?php echo number_format($row->periode_awal)?></td>
								<td><?php echo number_format($row->periode_berjalan)?></td>
								<td><?php echo number_format($row->periode_akhir)?></td>
							</tr>
								<?php } }?>
							<?php
								$periode_awal = 0;
								$periode_berjalan = 0;
								$periode_akhir = 0;
								if(!empty($beban_lain)){
									foreach($beban_lain as $row){
										$periode_awal += $row->periode_awal;
										$periode_berjalan += $row->periode_berjalan;
										$periode_akhir += $row->periode_akhir;
									}
								}
							?>
							<tr style="background: #e9e9e9;">
							  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Beban (Pendapatan) lain-lain</b></td>
							  <td><b><?php echo number_format($beban_lain_awal = $periode_awal);?></b></td>
							  <td><b><?php echo number_format($beban_lain_berjalan = $periode_berjalan);?></b></td>
							  <td><b><?php echo number_format($beban_lain_akhir = $periode_akhir);?></b></td>
							</tr>
							<?php 
								$periode_awal = 0;
								$periode_berjalan = 0;
								$periode_akhir = 0;
								if(!empty($beban_lain)){
									foreach($beban_lain as $row){
							?>
							<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row->account_name?></td>
								<td><?php echo number_format($row->periode_awal)?></td>
								<td><?php echo number_format($row->periode_berjalan)?></td>
								<td><?php echo number_format($row->periode_akhir)?></td>
							</tr>
								<?php } }?>
								
							<tr>
								<td colspan="4"></td>
							</tr>
							<tr>
								<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JUMLAH BIAYA USAHA</td>
								<td><b><?php echo number_format($jumlah_biaya_awal = $beban_usaha_awal + $beban_lain_awal)?></td>
								<td><b><?php echo number_format($jumlah_biaya_berjalan = $beban_usaha_berjalan + $beban_lain_berjalan)?></td>
								<td><b><?php echo number_format($jumlah_biaya_akhir = $beban_usaha_akhir + $beban_lain_akhir)?></td>
							</tr>
								
							<tr>
								<td colspan="4"></td>
							</tr>
							<tr>
								<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LABA (RUGI) SEBELUM PAJAK - EBT</td>
								<td><b><?php echo number_format($sebelum_pajak_awal = $pendapatan_awal - $jumlah_biaya_awal)?></td>
								<td><b><?php echo number_format($sebelum_pajak_berjalan = $pendapatan_berjalan - $jumlah_biaya_berjalan)?></td>
								<td><b><?php echo number_format($sebelum_pajak_akhir = $pendapatan_akhir - $jumlah_biaya_akhir)?></td>
							</tr>
								
							<tr>
								<td colspan="4"></td>
							</tr>
							<tr>
								<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TAKSIRAN PAJAK PENGHASILAN</td>
								<td><b>
								<?php 
								if($sebelum_pajak_awal < 4800000000){
									echo number_format($pajak_awal = (50/100)*(25/100)*$sebelum_pajak_awal);
								}else{
									echo number_format($pajak_awal = (25/100)*$sebelum_pajak_awal);
								}
								?>
								</td>
								<td><b>
								<?php 
								if($sebelum_pajak_berjalan < 4800000000){
									echo number_format($pajak_berjalan = (50/100)*(25/100)*$sebelum_pajak_berjalan);
								}else{
									echo number_format($pajak_berjalan = (25/100)*$sebelum_pajak_berjalan);
								}
								?>
								</td>
								<td><b><?php echo number_format($pajak_akhir = $pajak_awal + $pajak_berjalan)?></td>
							</tr>
								
							<tr>
								<td colspan="4"></td>
							</tr>
							<tr>
								<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LABA (RUGI) SETELAH PAJAK - EAT</td>
								<td><b><?php echo number_format($sebelum_pajak_awal - $pajak_awal)?></td>
								<td><b><?php echo number_format($sebelum_pajak_berjalan - $pajak_berjalan )?></td>
								<td><b><?php echo number_format($sebelum_pajak_akhir - $pajak_akhir)?></td>
							</tr>
						</tbody>