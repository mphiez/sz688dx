<?php 
	class Laporan_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function bukubesar($acnum = null, $cabang = null, $periode=null){
			$qcabang = "and cabang = '$cabang'";
			if($cabang == 'all'){
				$qcabang = "";
			}
			
			$query 	= "select * from dk_jurnal where (no_akun_credit='$acnum' or no_akun_debit='$acnum') $qcabang and tanggal like '%$periode%' order by tanggal";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function getCabang($acnum = null){
			$perusahaan = $this->session->userdata('perusahaan');
			$query 	= "select nm_cabang,cabang from dk_cabang where perusahaan='$perusahaan' order by nm_cabang";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function search_akun($search2){
			$search = explode(' - ',$search2);
			if(count($search)>1){
				$search = $search[1];
			}else if(count($search)>2){
				$search = $search[1]." - ".$search[2];
			}else if(count($search)>3){
				$search = $search[1]." - ".$search[2]." - ".$search[3];
			}else{
				$search = $search2;
			}
			$where = "";
			if(!empty($search)){
				$where = " where (account_num like '%".$search."%' or account_name like '%".$search."%')";
			}
			$perusahaan = $this->session->userdata('perusahaan');
			if(!empty($where)){
				$where .= " and perusahaan ='$perusahaan' ";
			}else{
				$where .= " where perusahaan ='$perusahaan' ";
			}
			
			$query 	= "select account_num, account_name from dk_account $where order by account_name limit 0,10";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function getPeriode(){
			$perusahaan = $this->session->userdata('perusahaan');
			$admin = cek_admin();
			$query 	= "select periode from dk_saldo_awal where perusahaan='$perusahaan' $admin group by periode order by periode";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function getPeriodeJurnal(){
			$perusahaan = $this->session->userdata('perusahaan');
			$admin = cek_admin();
			$query 	= "select SUBSTR(tanggal,1,7) as tgl from dk_jurnal where perusahaan='$perusahaan' $admin group by tgl order by tgl";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function load_list($periode=null){
			$perusahaan = $this->session->userdata('perusahaan');
			$admin = cek_admin();
			$query 	= "select * from dk_saldo_awal where periode = '$periode' and perusahaan='$perusahaan' $admin order by account_num";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function load_list_jurnal($periode=null, $cabang=null, $pembayaran=null){
			$where = "and cabang = '$cabang'";
			if($cabang == 'all'){
				$where = "";
			}
			$perusahaan = $this->session->userdata('perusahaan');
			if(isset($pembayaran)){
				$where .= " and substr(no_akun_credit,1,1) = '1' and (substr(no_akun_debit,1,1) = '2' || substr(no_akun_debit,1,1) = '3' || substr(no_akun_debit,1,1) = '5' || substr(no_akun_debit,1,1) = '6' || substr(no_akun_debit,1,1) = '7' || substr(no_akun_debit,1,1) = '8') ";
			}
			$query 	= "select a.*, b.pn_name from dk_jurnal a left join dk_user b on a.user=b.pn_id where substr(a.tanggal,1,7) = '$periode' and a.perusahaan='$perusahaan' $where order by tanggal";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function pendapatan($data=array()){
			$perusahaan = $this->session->userdata('perusahaan');
			$year			= $data['year'];
			$month			= $data['month'];
			$cabang			= $data['cabang'];
			$periode 		= date("Y-m",strtotime($year."-".$month."-01"));
			if(empty($acnum)){
				$acnum = '1-1111';
			}
			
			$qcabang = "and cabang = '$cabang'";
			if($cabang == 'all'){
				$qcabang = "";
			}
			
			$query 	= "select account_num, account_name from dk_account where account_num like '4-%' and perusahaan='$perusahaan' order by account_num";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$result = $q->result();
				$temp = array();
				foreach($result as $row){
					$row->periode_awal = saldo_awal($row->account_num);
					
					$q_sal	= "select (sum(if(no_akun_debit='".$row->account_num."', jumlah_debit, 0))- sum(if(no_akun_credit='".$row->account_num."', jumlah_credit, 0))) periode_berjalan from dk_jurnal where perusahaan='$perusahaan' and substr(tanggal,1,7) = '$periode' $qcabang";
					$q_sal_res	= $this->db->query($q_sal);
					if($q_sal_res->num_rows() > 0){
						$ret = $q_sal_res->result();
						$row->periode_berjalan = $ret[0]->periode_berjalan * -1;
					}else{
						$row->periode_berjalan = 0;
					}
					$row->periode_akhir = $row->periode_berjalan + $row->periode_awal;
					if($row->periode_berjalan > 0 || $row->periode_awal >0){
						array_push($temp,$row);
					}
				}
				return $temp;
			}else{
				return array();
			}
		}
		
		public function hpp($data=null){
			$perusahaan = $this->session->userdata('perusahaan');
			$year			= $data['year'];
			$month			= $data['month'];
			$cabang			= $data['cabang'];
			$periode 		= date("Y-m",strtotime($year."-".$month."-01"));
			if(empty($acnum)){
				$acnum = '1-1111';
			}
			
			$qcabang = "and cabang = '$cabang'";
			if($cabang == 'all'){
				$qcabang = "";
			}
			
			$query 	= "select account_num, account_name from dk_account where account_num like '5-%'  and perusahaan='$perusahaan' order by account_num";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$result = $q->result();
				$temp = array();
				foreach($result as $row){
					$row->periode_awal = saldo_awal($row->account_num);
					
					$q_sal	= "select (sum(if(no_akun_debit='".$row->account_num."', jumlah_debit, 0))- sum(if(no_akun_credit='".$row->account_num."', jumlah_credit, 0))) periode_berjalan from dk_jurnal where perusahaan='$perusahaan' and substr(tanggal,1,7) = '$periode' $qcabang";
					$q_sal_res	= $this->db->query($q_sal);
					if($q_sal_res->num_rows() > 0){
						$ret = $q_sal_res->result();
						$row->periode_berjalan = $ret[0]->periode_berjalan * 1;
					}else{
						$row->periode_berjalan = 0;
					}
					$row->periode_akhir = $row->periode_berjalan + $row->periode_awal;
					if($row->periode_berjalan > 0 || $row->periode_awal >0){
						array_push($temp,$row);
					}
				}
				return $temp;
			}else{
				return array();
			}
		}
		
		public function biaya($data=array()){
			$perusahaan = $this->session->userdata('perusahaan');
			$year			= $data['year'];
			$month			= $data['month'];
			$cabang			= $data['cabang'];
			$periode 		= date("Y-m",strtotime($year."-".$month."-01"));
			if(empty($acnum)){
				$acnum = '1-1111';
			}
			
			$qcabang = "and cabang = '$cabang'";
			if($cabang == 'all'){
				$qcabang = "";
			}
			
			$query 	= "select account_num, account_name from dk_account where account_num like '6-%'   and perusahaan='$perusahaan' order by account_num";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$result = $q->result();
				$temp = array();
				foreach($result as $row){
					$row->periode_awal = saldo_awal($row->account_num);
					
					$q_sal	= "select (sum(if(no_akun_debit='".$row->account_num."', jumlah_debit, 0))- sum(if(no_akun_credit='".$row->account_num."', jumlah_credit, 0))) periode_berjalan from dk_jurnal where perusahaan='$perusahaan' and substr(tanggal,1,7) = '$periode' $qcabang";
					$q_sal_res	= $this->db->query($q_sal);
					if($q_sal_res->num_rows() > 0){
						$ret = $q_sal_res->result();
						$row->periode_berjalan = $ret[0]->periode_berjalan * 1;
					}else{
						$row->periode_berjalan = 0;
					}
					$row->periode_akhir = $row->periode_berjalan + $row->periode_awal;
					if($row->periode_berjalan > 0 || $row->periode_awal >0){
						array_push($temp,$row);
					}
				}
				return $temp;
			}else{
				return array();
			}
		}
		
		public function beban_lain($data=null){
			$perusahaan = $this->session->userdata('perusahaan');
			$year			= $data['year'];
			$month			= $data['month'];
			$cabang			= $data['cabang'];
			$periode 		= date("Y-m",strtotime($year."-".$month."-01"));
			if(empty($acnum)){
				$acnum = '1-1111';
			}
			
			$qcabang = "and cabang = '$cabang'";
			if($cabang == 'all'){
				$qcabang = "";
			}
			
			$query 	= "select account_num, account_name from dk_account where (account_num like '7-%' or account_num like '8-%')   and perusahaan='$perusahaan' order by account_num";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$result = $q->result();
				$temp = array();
				foreach($result as $row){
					$row->periode_awal = saldo_awal($row->account_num);
					
					$q_sal	= "select (sum(if(no_akun_debit='".$row->account_num."', jumlah_debit, 0))- sum(if(no_akun_credit='".$row->account_num."', jumlah_credit, 0))) periode_berjalan from dk_jurnal where perusahaan='$perusahaan' and substr(tanggal,1,7) = '$periode' $qcabang";
					$q_sal_res	= $this->db->query($q_sal);
					if($q_sal_res->num_rows() > 0){
						$ret = $q_sal_res->result();
						$row->periode_berjalan = $ret[0]->periode_berjalan * 1;
					}else{
						$row->periode_berjalan = 0;
					}
					$row->periode_akhir = $row->periode_berjalan + $row->periode_awal;
					if($row->periode_berjalan > 0 || $row->periode_awal >0){
						array_push($temp,$row);
					}
				}
				return $temp;
			}else{
				return array();
			}
		}
	}