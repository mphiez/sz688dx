<?php 
	class Profile_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function load_message(){
			$query 	= "select * from tbl_comment where view = '0' and private = '0'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function load_message_all(){
			$sid = $this->session->userdata('pn_id');
			$where = "and user_id = '$sid'";
			
			if($sid == '1002'){
				$where = "";
			}
			$query 	= "select * from tbl_comment where parent is null $where order by private, view desc";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function load_message_all_detail($id = null){
			$query 	= "select * from tbl_comment where parent = '$id'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return array();
			}
		}
		
		public function new_message(){
			$sid = $this->session->userdata('pn_id');
			if($sid){
				$where = "and to = '$sid'";
			}else{
				$where = "";
			}
			
			if($sid == '1002'){
				$where = "";
			}
			$query 	= "select * from tbl_comment where done != '1' $where order by datetime desc";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function your_post(){
			$sid = $this->session->userdata('pn_id');
			$where = "and user_id = '$sid'";
			
			if($sid == '1002'){
				$where = "";
			}
			$query 	= "select * from tbl_comment where view = '1'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function save($param){
			$this->db->insert('tbl_comment',($param));
		}
	}