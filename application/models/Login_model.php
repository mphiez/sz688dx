<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Login_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		function check_login($data){
			$array = array(
						'pn_uname'=>$data['pn_uname'],
						'pn_pass'=>$data['pn_pass'],
						'pn_akses'=>'1'
					);
			$this->db->where($array);
			$this->db->from('dk_user');
			return $this->db->get();
		}
	}