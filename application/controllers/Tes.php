<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tes extends CI_Controller {
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
		$data['judul']				= "Buat Penjualan";
		$this->load->view('tes/v_input',$data);
	}
}