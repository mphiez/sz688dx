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
	}
	public function index(){
		$this->view();
	}
	public function view(){
		$data['judul']				= "Buat Jurnal";
		$this->load->view('expenses/v_list_expenses',$data);
	}
	
	function load_list(){
$range = $this->input->post('range');
		$status = $this->input->post('status');
		$datax = $this->transaksi_model->load_list($range,$status);
		if($datax){
			$temp = array();
			foreach($datax as $row){
				$row->detail = $this->transaksi_model->load_list_invoice($row->nomor_transaksi);
				$row->tagihan = number_format($row->jumlah_bayar - $row->byr);
				$row->sisa_tagihan = number_format($row->jumlah_bayar - $row->inv);
				$row->jumlah_bayar = number_format($row->jumlah_bayar);
				$row->jumlah_item = number_format($row->jumlah_item);
				$row->jumlah_pajak = number_format($row->jumlah_pajak);
				$row->sub_total = number_format($row->sub_total);
				$row->discount = number_format($row->discount);
				
				if($row->tipe_transaksi == 0){
					$row->tagihan = 0;
					$row->sisa_tagihan = 0;
				}
				
				array_push($temp, $row);
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
		$id = $this->input->post('id');
		$datax = $this->expenses_model->load_list_sum($id);
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
}