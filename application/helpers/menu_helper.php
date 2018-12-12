<?php 
	function tampil_menu($pn_jabatan,$active,$sub_ac){
		$CI =& get_instance();
		$CI->load->model('menu_model');
		$CI->load->model('all_model');
		$menu_utama = $CI->menu_model->m_get_menu_utama($pn_jabatan);
		if($menu_utama > 0){
			foreach ($menu_utama as $row){
				$url 		= $row->url;
				$id_menu 	= $row->id_menu;
				$nama_menu 	= $row->nm_menu;
				$urutan 	= $row->urutan;
				$img 		= $row->img;
				$sub_menu = $CI->menu_model->m_get_submenu($pn_jabatan,$id_menu);
				if($active == $url){
					$akt = "class='active'";
				}else{
					$akt = "";
				}
				if($sub_menu >0){
					$url = "#";
				}else{
					$url = base_url().'index.php/'.$url;
				}				
				echo "<li $akt>
					<a href='$url'>
					<i class='fa fa-$img'></i> <span>".$nama_menu."</span>
					<span class='pull-right-container'>";
					if($sub_menu >0){
						echo "<i class='fa fa-angle-left pull-right'></i>";
					}
					echo "</span>
					</a>";
					if($sub_menu >0){
						foreach($sub_menu as $row_sub){
							$url_sub	= $row_sub->url;
							$ex_sub		= explode('/',$url_sub);
							if($sub_ac == $ex_sub[1]){
								$act_sub = "class='active'";
							}else{
								$act_sub = "";
							}
							$nama_sub	= $row_sub->nm_menu;
							echo "<ul class='nav nav-second-level'>
								<li $act_sub><a href='".base_url()."index.php/".$url_sub."'><i class='fa fa-circle-o'></i> ".$nama_sub."</a></li>
							</ul>";
						}
					}	
				echo "</li>";
			}
		}
	}
	
	function tampil_menu_top($pn_jabatan,$active,$sub_ac){
		$CI =& get_instance();
		$CI->load->model('menu_model');
		$CI->load->model('all_model');
		$menu_utama = $CI->menu_model->m_get_menu_utama_top($pn_jabatan);
		if($menu_utama > 0){
			foreach ($menu_utama as $row){
				$url 		= $row->url;
				$id_menu 	= $row->id_menu;
				$nama_menu 	= $row->nm_menu;
				$urutan 	= $row->urutan;
				$img 		= $row->img;
				$sub_menu = $CI->menu_model->m_get_submenu($pn_jabatan,$id_menu);
				if($active == $url){
					$akt = "active";
				}else{
					$akt = "";
				}
				if($sub_menu >0){
					$url = "#";
					$drop = "dropdown";
					$dropx = "class='dropdown-toggle' data-toggle='dropdown'";
				}else{
					$url = base_url().'index.php/'.$url;
					$drop = "";
					$dropx = "";
				}
				
				
				
				echo "<li class='$drop $akt'>
				  <a href='$url' $dropx>".$nama_menu;
					if($sub_menu >0){
						echo "<i class='caret'></i>";
					}
				  echo "</a>";
				  if($sub_menu >0){
					echo "<ul class='dropdown-menu' role='menu'>";
					foreach($sub_menu as $row_sub){
						$url_sub	= $row_sub->url;
						$ex_sub		= explode('/',$url_sub);
						if($sub_ac == $ex_sub[1]){
							$act_sub = "class='active'";
						}else{
							$act_sub = "";
						}
						$nama_sub	= $row_sub->nm_menu;
						echo "<li $act_sub><a href='".base_url()."index.php/".$url_sub."'><i class='fa fa-circle-o'></i>".$nama_sub."</a></li>";
					}
					echo "</ul>";
				  }
				  echo "</li>";
			}
		}
	}
	
	function tampil_menu_category($pn_jabatan,$active,$sub_ac){
		$CI =& get_instance();
		$CI->load->model('menu_model');
		$CI->load->model('all_model');
		$menu_utama = $CI->menu_model->m_get_menu_utama_list($pn_jabatan);
		echo "<ul class='dropdown-menu' role='menu' style='width:950px'>";
			echo "<div class='row'>";
			echo "<div class='col-md-12 table-responsive' style='padding: 0px 30px 0px 30px;height:350px;'>";
				$j = 0;
				$x2 = '';
				if($menu_utama > 0){
					foreach ($menu_utama as $row){
						$j++;
						if($row->id_menu != 1){
						//echo "<div class='col-md-4'>";
						$url 		= $row->url;
						$id_menu 	= $row->id_menu;
						$nama_menu 	= $row->nm_menu;
						$urutan 	= $row->urutan;
						$img 		= $row->img;
						$sub_menu = $CI->menu_model->m_get_submenu($pn_jabatan,$id_menu);
						//echo $CI->db->last_query();exit;
						if($active == $url){
							$akt = "active";
						}else{
							$akt = "";
						}
						if($sub_menu >0){
							$url = "#";
							$drop = "dropdown";
							$dropx = "class='dropdown-toggle' data-toggle='dropdown'";
						}else{
							$url = base_url().'index.php/'.$url;
							$drop = "";
							$dropx = "";
						}
						//----------------------------------------
								if($sub_menu >0){
									foreach($sub_menu as $row_sub){
										$url_sub	= $row_sub->url;
										$ex_sub		= explode('/',$url_sub);
										if($sub_ac == $ex_sub[1]){
											$act_sub = "class='active'";
										}else{
											$act_sub = "";
										}
										$nama_sub	= $row_sub->nm_menu;
										$x = "<div class='col-md-12 item-small'><li $act_sub><a href='".base_url()."index.php/".$url_sub."'><i class='fa fa-circle-o'></i><span class='dropdown-span'>".$nama_sub."</span></a></li></div>";
										
										$x2 = $x2.''.$x;
									}
								  }
								  
								echo "<div class='col-md-4'><li class='category-header'><a href='#/'><i class='fa fa-pencil'></i><span class='dropdown-span'>".$nama_menu."</span></a></li>".$x2."</div>";
								$x2 = '';
								if($j == 3 || $j == 6 || $j == 9 || $j == 12 || $j == 15){
									echo "<div class='col-md-12'></div>";
								}
						
						
						//----------------------------------------
						//echo "</div>";
						}
					}	
				}
					echo "</div>";
				echo "</div>";
			echo "</ul>";
	}
	
	function cek_read($pn_jabatan=null,$active=null,$sub_ac=null){
		$CI =& get_instance();
		$CI->load->model('menu_model');
		if(!empty($active) and !empty($sub_ac)){
			$read = $CI->menu_model->m_get_menu_akses($pn_jabatan,$active,$sub_ac);
			/* $val = $read;
			if($val == 1){
				echo "masuk";
				$read = 'N';
			}
			echo $read; */
		}else if($active == 'dashboard' || $active == 'main'){
			$read = 'Y';
		}else{
			$read = 'N';
		}
		
		
		if($read == 'Y'){
			echo "<script>console.log('$read');</script>";
		}else{
			echo "<script>
				document.getElementById('body-inside').innerHTML = '<label style=&#39;text-align:center;&#39;><h3><b>Forbidden</b>, Cannot Access Page</h3></label>';
				console.log('$read');
			</script>";
		}
	}
	
	function check_akun(){
		$CI =& get_instance();
		$CI->load->model('menu_model');
		$read = $CI->menu_model->check_akun();
		if($read){
			return array(
					'status_akun' => $read->status_akun,
					'verify_date' => $read->verify_date,
				);
		}
		return false;
	}
	
	function check_valid(){
		$CI =& get_instance();
		$CI->load->model('menu_model');
		$read = $CI->menu_model->check_akun();
		if($read){
			if(((date("Y-m-d",strtotime("+1 month", strtotime($read->verify_date)))) > date("Y-m-d")) && $read->status_akun != 1){
				echo "<script>console.log('-ok-');</script>";
			}else{
				echo "<script>
					document.getElementById('btn_all').style.display = 'none';
					console.log('$read');
				</script>";
			}
		}
		return false;
	}
	
	function Terbilang($x)
	{
	  $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	  if ($x < 12)
		return " " . $abil[$x];
	  elseif ($x < 20)
		return Terbilang($x - 10) . "belas";
	  elseif ($x < 100)
		return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
	  elseif ($x < 200)
		return " seratus" . Terbilang($x - 100);
	  elseif ($x < 1000)
		return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
	  elseif ($x < 2000)
		return " seribu" . Terbilang($x - 1000);
	  elseif ($x < 1000000)
		return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
	  elseif ($x < 1000000000)
		return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
	  elseif ($x < 1000000000000)
		return Terbilang($x / 1000000000) . " Milyar" . Terbilang($x % 1000000000);
	}
	
	function Terbilang_kapital($x)
	{
	  $abil = array("", "SATU", "DUA", "TIGA", "EMPAT", "LIMA", "ENAM", "TUJUH", "DELAPAN", "SEMBILAN", "SEPULUH", "SEBELAS");
	  if ($x < 12)
		return " " . $abil[$x];
	  elseif ($x < 20)
		return Terbilang($x - 10) . "BELAS";
	  elseif ($x < 100)
		return Terbilang($x / 10) . " PULUH" . Terbilang($x % 10);
	  elseif ($x < 200)
		return " seratus" . Terbilang($x - 100);
	  elseif ($x < 1000)
		return Terbilang($x / 100) . " RATUS" . Terbilang($x % 100);
	  elseif ($x < 2000)
		return " seribu" . Terbilang($x - 1000);
	  elseif ($x < 1000000)
		return Terbilang($x / 1000) . " RIBU" . Terbilang($x % 1000);
	  elseif ($x < 1000000000)
		return Terbilang($x / 1000000) . " JUTA" . Terbilang($x % 1000000);
	  elseif ($x < 1000000000000)
		return Terbilang($x / 1000000000) . " MILYAR" . Terbilang($x % 1000000000);
	}
	
	function Terbilang_inggris($n) {
  if ($n < 0) return 'minus ' . terbilang(-$n);
  else if ($n < 10) {
    switch ($n) {
      case 0: return 'Zero';
      case 1: return 'One';
      case 2: return 'Two';
      case 3: return 'Three';
      case 4: return 'Four';
      case 5: return 'Five';
      case 6: return 'Six';
      case 7: return 'Seven';
      case 8: return 'Eight';
      case 9: return 'Nine';
    }
  }
  else if ($n < 100) {
    $kepala = floor($n/10);
    $sisa = $n % 10;
    if ($kepala == 1) {
      if ($sisa == 0) return 'Ten';
      else if ($sisa == 1) return 'Eleven';
      else if ($sisa == 2) return 'Twelve';
      else if ($sisa == 3) return 'Thirteen';
      else if ($sisa == 5) return 'Fifteen';
      else if ($sisa == 8) return 'Eighteen';
      else return Terbilang_inggris($sisa) . 'teen';
    }
    else if ($kepala == 2) $hasil = 'Twenty';
    else if ($kepala == 3) $hasil = 'Thirty';
    else if ($kepala == 5) $hasil = 'Fifty';
    else if ($kepala == 8) $hasil = 'Eighty';
    else $hasil = Terbilang_inggris($kepala) . 'ty';
  }
  else if ($n < 1000) {
    $kepala = floor($n/100);
    $sisa = $n % 100;
    $hasil = Terbilang_inggris($kepala) . ' Hundred';
  }
  else if ($n < 1000000) {
    $kepala = floor($n/1000);
    $sisa = $n % 1000;
    $hasil = Terbilang_inggris($kepala) . ' Thousand';
  }
  else if ($n < 1000000000) {
    $kepala = floor($n/1000000);
    $sisa = $n % 1000000;
    $hasil = Terbilang_inggris($kepala) . ' Million';
  }
  else if ($n < 1000000000000) {
    $kepala = floor($n/1000000000);
    $sisa = $n % 1000000000;
    $hasil = Terbilang_inggris($kepala) . ' Billion';
  }
  else return false;

  if ($sisa > 0) $hasil .= ' ' . Terbilang_inggris($sisa);
  return $hasil;
}
	function nm_bulan($bln){
		$bulan = array('','Januari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$nm_bulan = $bulan[$bln];
		return $nm_bulan;
	}
	
	function to_decimal($num){
		return str_replace('_','',str_replace(',','',($num)));
	}
	
	function to_number($num){
		return number_format($num);
	}
	
	function account_name($account_num){
		$CI =& get_instance();
		$CI->load->model('menu_model');
		return $CI->menu_model->m_get_account_name($account_num);
	}
	
	function saldo_awal($account_num = null, $periode = null, $cabang=null){
		$CI =& get_instance();
		$CI->load->model('menu_model');
		return $CI->menu_model->m_get_saldo_awal($account_num, $periode, $cabang);
	}
	
	function generate(){
		return substr(md5(microtime()),rand(0,26),30);
	}
	
	function counter($x, $cab=null){
		$CI =& get_instance();
		$CI->load->model('menu_model');
		$id_kategori = $CI->menu_model->get_counter($x,$cab);
		$p = "p_".substr($x,2);
		if($id_kategori->num_rows() > 0){
			$ret	= $id_kategori->result();
			$id		= $ret[0]->$x;
			$prefix	= $ret[0]->$p;
			$cab	= $ret[0]->cabang;
			$per	= $ret[0]->perusahaan;
		}else{
			$id = 1;
		}
		$kd_barang = $id+1;
		if(strlen($kd_barang)==1){
			$kdadd		= "00000";
		}else if(strlen($kd_barang)==2){
			$kdadd		= "0000";
		}else if(strlen($kd_barang)==3){
			$kdadd		= "000";
		}else if(strlen($kd_barang)==4){
			$kdadd		= "00";
		}else if(strlen($kd_barang)==5){
			$kdadd		= "0";
		}else{
			$kdadd		= "0";
		}
		$thnbln			= date("ymd");
		return $id = $prefix.$cab.'-'.$kdadd.$kd_barang;
	}
	
	function add_counter($x, $cab=null){
		$CI =& get_instance();
		$CI->load->model('menu_model');
		$CI->menu_model->add_counter($x,$cab);
	}
	
	function cek_admin(){
		$CI =& get_instance();
		$CI->load->model('menu_model');
		$admin = $CI->menu_model->cek_admin();
		if($admin->nm_jabatan == 'Admin'){
			return "";
		}else{
			return "and cabang='".$admin->id."'";
		}
	}
	
?>
