<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('order_model');
		$this->load->helper('menu');
		$this->load->model('master_model');
	}
	
	public function index(){
		$data['judul'] 			= "Dashboard";
		$this->load->view('dashboard/v_dashboard');
	}
	
	public function load_summary(){
		$datadsd = $this->order_model->load_summary();
		$val = array();
		foreach($datadsd as $row){
			$data['sell'] = $row->sell;
			$data['buy'] = $row->buy;
			$data['total'] = $row->total;
			$data['amount'] = $row->amount;
			$data['spend'] = $row->spend;
			array_push($val,$data);
		}

		$json_data = json_encode((array) $datadsd);
		echo $json_data;
	}
	
	public function get_detail(){
		$data = $this->order_model->get_detail($this->input->post('id'));
		echo json_encode($data);
	}
}