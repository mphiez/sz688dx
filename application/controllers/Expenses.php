<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expenses extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('transaksi_model');
		$this->load->helper('menu');
		$this->load->model('master_model');
	}
	public function index(){
		$this->view();
	}
	public function view(){
		$data['judul']				= "Buat Jurnal";
		$data['account_list'] 			= $this->transaksi_model->account_list();
		$this->load->view('transaksi/v_input_jurnal',$data);
	}
}