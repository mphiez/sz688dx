<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expenses extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('expenses_model');
		$this->load->helper('menu');
		$this->load->model('master_model');
		$this->load->model('transaksi_model');
	}
	public function index(){
		$this->view();
	}
	
	public function view(){
		$data['judul']				= "Buat Jurnal";
		$this->load->view('expenses/v_list_expenses',$data);
	}
	
	public function produk_baru(){
		$data['judul']				= "Buat Jurnal";
		$data['bank_list'] 			= $this->transaksi_model->bank_list();
		$data['bank_list_sell'] 			= $this->transaksi_model->bank_list_sell();
		$this->load->view('expenses/v_tambah_produk',$data);
	}
	
	public function purchase_order(){
		$data['judul']				= "Buat Jurnal";
		$data['bank_list'] 			= $this->transaksi_model->bank_list();
		$data['bank_list_sell'] 			= $this->transaksi_model->bank_list_sell();
		$this->load->view('expenses/v_purchase_order',$data);
	}
	
	public function pay(){
		$data['judul']				= "Buat Jurnal";
		$id = $this->input->get('id');
		$data['bank_list'] 			= $this->transaksi_model->bank_list();
		$data['bank_list_sell'] 	= $this->transaksi_model->bank_list_sell();
		$data['header'] 			= $this->expenses_model->load_payment($id);
		$this->load->view('expenses/v_create_payment',$data);
	}
	
	public function barang(){
		$data['judul']				= "Buat Jurnal";
		$id = $this->input->get('id');
		$data['bank_list'] 			= $this->transaksi_model->bank_list();
		$data['bank_list_sell'] 	= $this->transaksi_model->bank_list_sell();
		$data['header'] 			= $this->expenses_model->load_payment($id);
		$data['detail'] 			= $this->expenses_model->load_detail($id);
		$this->load->view('expenses/v_barang_masuk',$data);
	}
	
	public function load_list(){
		$range = $this->input->post('range');
		$status = $this->input->post('status');
		$datax = $this->expenses_model->load_list($range,$status);
		if($datax){
			$temp = array();
			foreach($datax as $row){
				
				$row->detail = $this->expenses_model->load_list_invoice($row->nomor_transaksi);
				$row->sisa_bayar = number_format($row->total_bayar - $row->bayar);
				if($row->metode_pembayaran == 'cash'){
					$row->sisa_bayar = 0;
				}
				$row->subtotal = number_format($row->subtotal);
				$row->ppn = number_format($row->ppn);
				$row->id_expenses = md5($row->id);
				$row->total_bayar = number_format($row->total_bayar);
				$row->diskon = number_format($row->diskon);
				
				if($status != ''){
						
					if($status == 'Completed'){
						if($row->tot_masuk >= $row->tot_beli){ //complete
							array_push($temp, $row);
						}
					}else{
						if($row->tot_masuk < $row->tot_beli){ //uncomplete
							array_push($temp, $row);
						}
					}
					 
				}else{
					array_push($temp, $row);
				}
				
			}
			$return = array(
				'data' => $temp,
				'code' => 0
			);
			
		}else{
			$return = array(
				'data' => array(),
				'code' => 1
			);
		}
		echo json_encode($return);
	}
	
	function load_list_sum(){
		$datax = $this->expenses_model->load_list_sum();
		if($datax){
			$return = array(
				'data' => $datax,
				'code' => 0,
				'guid' => 0
			);
			
		}else{
			$return = array(
				'data' => $datax,
				'code' => 1,
				'guid' => 0
			);
		}
		echo json_encode($return);
	}
	
	function search_supplier(){
		$name = $this->input->post('pn_name');
		$datax = $this->expenses_model->search_supplier($name);
		$list = array();
		$temp = array();
		if($datax > 0){
			foreach($datax as $row){
				$list[$row->id_supplier] = $row;
			}
			
			$return = array(
				'data' => $datax,
				'user_list' => $list,
				'code' => 0
			);
			
		}else{
			$return = array(
				'data' => $datax,
				'user_list' => $list,
				'code' => 1
			);
		}
		echo json_encode($return);
	}
	
	public function save(){
		$post = $this->input->post();
		$datax = $this->expenses_model->save($post);
		if($datax){
			if($datax == '-1'){
				$return = array(
					'data' => '',
					'code' => 2,
					'guid' => 0
				);
			}else{
				$return = array(
					'data' => $datax,
					'code' => 0,
					'guid' => md5($datax['id'])
				);
			}
			
		}else{
			$return = array(
				'data' => $datax,
				'code' => 1,
				'guid' => 0
			);
		}
		echo json_encode($return);
	}
	
	public function save_pembayaran(){
		$post = $this->input->post();
		$datax = $this->expenses_model->save_pembayaran($post);
		if($datax){
			if($datax == '-1'){
				$return = array(
					'data' => '',
					'code' => 2,
					'guid' => 0
				);
			}else{
				$return = array(
					'data' => $datax,
					'code' => 0,
					'guid' => md5($datax['id'])
				);
			}
			
		}else{
			$return = array(
				'data' => $datax,
				'code' => 1,
				'guid' => 0
			);
		}
		echo json_encode($return);
	}
	
	public function save_barang(){
		$post = $this->input->post();
		$datax = $this->expenses_model->save_barang($post);
		if($datax){
			if($datax == '-1'){
				$return = array(
					'data' => '',
					'code' => 2,
					'guid' => 0
				);
			}else{
				$return = array(
					'data' => $datax,
					'code' => 0,
					'guid' => md5($datax['id'])
				);
			}
			
		}else{
			$return = array(
				'data' => $datax,
				'code' => 1,
				'guid' => 0
			);
		}
		echo json_encode($return);
	}
	
	public function change_status(){
		$post = $this->input->post();
		$datax = $this->expenses_model->change_status($post);
		if($datax){
			if($datax == '-1'){
				$return = array(
					'data' => '',
					'code' => 2,
					'guid' => 0
				);
			}else{
				$return = array(
					'data' => $datax,
					'code' => 0,
					'guid' => 0
				);
			}
			
		}else{
			$return = array(
				'data' => $datax,
				'code' => 1,
				'guid' => 0
			);
		}
		echo json_encode($return);
	}
	
	public function detail_transaksi(){
		$post = $this->input->post();
		$datax = $this->expenses_model->detail_transaksi($post);
		if($datax){
			$return = array(
				'data' => $datax,
				'code' => 0,
				'guid' => 0
			);
		}else{
			$return = array(
				'data' => $datax,
				'code' => 1,
				'guid' => 0
			);
		}
		echo json_encode($return);
	}
	
	public function detail_pembelian(){
		$post = $this->input->post();
		$datax = $this->expenses_model->detail_pembelian($post);
		if($datax){
			$temp = array();
			foreach($datax as $row){
				$row->harga_satuan = number_format($row->harga_satuan);
				$row->total = number_format($row->total);
				$row->qty = number_format($row->qty);
				array_push($temp, $row);
			}
			$return = array(
				'data' => $temp,
				'code' => 0,
				'guid' => 0
			);
		}else{
			$return = array(
				'data' => array(),
				'code' => 1,
				'guid' => 0
			);
		}
		echo json_encode($return);
	}
	
	public function detail_pembayaran(){
		$post = $this->input->post();
		$datax = $this->expenses_model->detail_pembayaran($post);
		if($datax){
			$temp = array();
			foreach($datax as $row){
				$row->jumlah_bayar = number_format($row->jumlah_bayar);
				array_push($temp, $row);
			}
			$return = array(
				'data' => $temp,
				'code' => 0,
				'guid' => 0
			);
		}else{
			$return = array(
				'data' => array(),
				'code' => 1,
				'guid' => 0
			);
		}
		echo json_encode($return);
	}
	
	public function detail_barang(){
		$post = $this->input->post();
		$datax = $this->expenses_model->detail_barang($post);
		if($datax){
			$temp = array();
			foreach($datax as $row){
				$row->qty = number_format($row->qty);
				array_push($temp, $row);
			}
			$return = array(
				'data' => $temp,
				'code' => 0,
				'guid' => 0
			);
		}else{
			$return = array(
				'data' => array(),
				'code' => 1,
				'guid' => 0
			);
		}
		echo json_encode($return);
	}
}