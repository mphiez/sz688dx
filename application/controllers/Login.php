<?php if(!defined('BASEPATH')) exit('No directed script access allowed');
class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('all_model');
	}
	public function index(){
		if(isset($this->error_massage)){
			$bytes = 16;
			$token = bin2hex(openssl_random_pseudo_bytes($bytes));
			$this->session->set_userdata(array('token' => $token ));
			$data = array(
			   'message' => $this->error_massage,
			   'token' => $token
			);
		}
		else {
			$bytes = 16;
			$token = bin2hex(openssl_random_pseudo_bytes($bytes));
			$this->session->set_userdata(array('token' => $token ));
			$data = array(
			   'message' => '',
			   'token' => $token
			);
		}
		$this->load->view('viewLogin', $data);
	}
	
	function login_check(){
		$data = array(
			'pn_uname' => $this->input->post('pn_name'),
			'pn_pass' => md5($this->input->post('pn_pass'))
		);
		$token 			= $this->input->post('token');
		$token_verify 	= $this->session->userdata('token');
		$query = $this->login_model->check_login($data);
		//echo $this->db->last_query();exit;
		if($query->num_rows() > 0 && $token == $token_verify){
			$row = $query->row();
			$data = array(
				'pn_id' 	=> $row->pn_id,
				'pn_uname' 	=> $row->pn_uname,
				'pn_name' 	=> $row->pn_name,
				'pn_jabatan'=> $row->pn_jabatan,
				'pn_wilayah'=> $row->pn_wilayah,
				'pn_akses'	=> $row->pn_akses,
				'marketing'	=> $row->sts_marketing,
				'perusahaan'=> $row->perusahaan,
				'judul'		=> 'AMS Neuron - Acountan Managment System',
				'logged_in' => TRUE
			);  
			$this->session->set_userdata($data);
			$this->all_model->log_login($row->pn_id,$row->pn_uname,$row->pn_jabatan,$row->pn_wilayah);
			redirect('main');
		}
		else{
			$this->error_massage = 'Wrong email or password!';
			$this->index();
		}
	}
		
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}