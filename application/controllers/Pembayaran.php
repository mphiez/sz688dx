<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembayaran extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('transaksi_model');
		$this->load->model('pembayaran_model');
		$this->load->helper('menu');
		$this->load->model('master_model');
	}
	
	public function index(){
		$data['judul']				= "Buat Penjualan";
		$this->load->view('order/penjualan/v_input_penjualan',$data);
	}
	
	public function input(){
		$data['judul']				= "Buat Pembayaran Biaya";
		$data['account_list'] 		= $this->transaksi_model->account_list(true);
		$data['bank'] 				= $this->pembayaran_model->bank_list();
		$this->load->view('pembayaran/v_input_pembayaran',$data);
	}
	
	public function bank(){
		$data['judul']				= "Buat Pembayaran Bank";
		$data['account_list'] 		= $this->transaksi_model->account_list(true);
		$data['bank'] 		= $this->transaksi_model->bank_list();
		$this->load->view('pembayaran/v_input_pembayaran_bank',$data);
	}
	
	public function save_pembayaran(){
		$post = $this->input->post();
		$datax = $this->pembayaran_model->save_jurnal($post);
		if($datax){
			$return = array(
				'data' => $datax,
				'code' => 0
			);
			
		}else{
			$return = array(
				'data' => $datax,
				'code' => 1
			);
		}
		echo json_encode($return);
	}
	
	public function save_pembayaran_bank(){
		$post = $this->input->post();
		$datax = $this->pembayaran_model->save_pembayaran_bank($post);
		if($datax){
			$return = array(
				'data' => $datax,
				'code' => 0
			);
			
		}else{
			$return = array(
				'data' => $datax,
				'code' => 1
			);
		}
		echo json_encode($return);
	}
}