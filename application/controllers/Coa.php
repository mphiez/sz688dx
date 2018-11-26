<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coa extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('master_model');
		$this->load->model('transaksi_model');
		$this->load->model('menu_model');
		$this->load->model('laporan_model');
		$this->load->model('custom_model');
		$this->load->model('order_model');
		$this->load->helper('menu');
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	public function result(){
		$result = array(
			'code' => 0,
			'guide' => '',
			'info' => 'ok',
			'data' => array()
		);
		return $result;
	}
	
	public function index(){
		$this->list_account();
	}
	
	public function list_account(){
		$data['judul'] 			= "Daftar Akun";
		$this->load->view('master/account/v_list_account',$data);
	}
	
	public function get_account(){
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$data	= $this->master_model->getList();

		$val = array();

		$result = $this->result();
		$result['data'] = $data->result();
		
		echo json_encode($result);
		exit();
	}
}