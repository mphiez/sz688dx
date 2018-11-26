<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('all_model');
		$this->load->model('order_model');
		$this->load->helper('menu');
	}
	
	public function index(){
		$data['judul'] = "Dashboard";
		$this->load->view('dashboard/v_dashboard',$data);
	}
}