<?php 
	class Configurasi_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function load_account(){		
			$query	= "select * from dk_account_master order by account_num";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function load_type(){		
			$query	= "select * from dk_account_type order by type";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function load_category(){		
			$query	= "select * from dk_account_category order by category";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function save_account($post=array()){	
			$this->db->trans_begin();
			foreach($post['account'] as $row){
				$this->db->where('account_num',$row['account_num']);
				$this->db->update('dk_account_master',$row);
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
	}
?>