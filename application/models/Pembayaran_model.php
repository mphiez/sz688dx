<?php 
	class Pembayaran_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function save_jurnal($name=null,$id=null){
			$this->db->trans_begin();
			
			$transaksi = $this->input->post('transaksi');
			foreach($transaksi as $row){
				$debit = array(
								'no_akun_debit'			=> $row['akun_debet'],
								'nama_akun_debit'		=> account_name($row['akun_debet']),
								'no_akun_credit'		=> '1-1111',
								'nama_akun_credit'		=> account_name('1-1111'),
								'tanggal'				=> date("Y-m-d H:i:s",strtotime($row['tanggal'])),
								'no_bukti'				=> $row['no_bukti'],
								'keterangan'			=> $row['deskripsi'],
								'jumlah_debit'			=> str_replace(',','',$row['debet']),
								'jumlah_credit'			=> str_replace(',','',$row['debet']),
								'user'					=> $this->session->userdata('pn_name'),
								'cabang'				=> $this->session->userdata('pn_wilayah'),
								'perusahaan'			=> $this->session->userdata('perusahaan'),
								'status'				=> 0,
								'ppn'					=> $row['ppn'],
							);
				$this->db->insert('dk_jurnal',$debit);
			}
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return true;
			}
		}
		
		public function save_pembayaran_bank($name=null,$id=null){
			$this->db->trans_begin();
			
			$transaksi = $this->input->post('transaksi');
			foreach($transaksi as $row){
				$debit = array(
								'no_akun_debit'			=> $row['akun_debet'],
								'nama_akun_debit'		=> account_name($row['akun_debet']),
								'no_akun_credit'		=> '1-1111',
								'nama_akun_credit'		=> account_name($row['akun_bank']),
								'tanggal'				=> date("Y-m-d H:i:s",strtotime($row['tanggal'])),
								'no_bukti'				=> $row['no_bukti'],
								'keterangan'			=> $row['deskripsi'],
								'jumlah_debit'			=> str_replace(',','',$row['debet']),
								'jumlah_credit'			=> str_replace(',','',$row['debet']),
								'user'					=> $this->session->userdata('pn_name'),
								'cabang'				=> $this->session->userdata('pn_wilayah'),
								'perusahaan'			=> $this->session->userdata('perusahaan'),
								'create_date'			=> date("Y-m-d H:i:s"),
								'ppn'					=> $row['ppn'],
								'status'				=> 0,
							);
				$this->db->insert('dk_jurnal',$debit);
			}
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return true;
			}
		}
		
		public function bank_list($id = null){
			$query 	= "select * from dk_account where SUBSTR(account_num,1,3) = '1-1'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
	}