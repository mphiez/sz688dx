<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('produk_model');
		$this->load->helper('menu');
		$this->load->model('master_model');
	}
	
	public function index(){
		$this->keluar();
	}
	
	public function keluar(){
		$data['judul']				= "Buat Penjualan";
		$id = $this->input->get('id');
		$data['data_produk']		= $this->produk_model->data_keluar($id);
		$this->load->view('produk/v_keluar',$data);
	}
	
	public function in(){
		$data['judul']				= "Buat Penjualan";
		$id = $this->input->get('id');
		$this->load->view('produk/v_in',$data);
	}
	
	public function out(){
		$data['judul']				= "Buat Penjualan";
		$id = $this->input->get('id');
		$this->load->view('produk/v_out',$data);
	}
	
	public function print_spj(){
		$id = $this->input->get('id');
		
		$data['data_spj']			= $this->produk_model->data_spj($id);
		$pdfFilePath					= "Spj.pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		$data['mpdf']	= $pdf;
		
		
		$html							= $this->load->view('produk/v_print_spj',$data,true);
		
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage('P', '', '', '',
				10, // margin_left
				20, // margin Left  -
				20, // margin right -
				10, // margin top - 
				10, // margin bottom
				10); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I");
	}
	
	function save_keluar(){
		$post = $this->input->post();
		$datax = $this->produk_model->save_keluar($post);
		if($datax){
			if($datax['status'] == '-2'){
				$return = array(
					'data' => $datax['data'],
					'code' => 2,
					'info' => $datax['info'],
					'guid' => 0
				);
			}else{
				$return = array(
					'data' => md5($datax['data']),
					'code' => 0,
					'info' => $datax['info'],
					'guid' => 0
				);
			}			
		}else{
			$return = array(
				'data' => $datax,
				'code' => 1,
				'info' => '',
				'guid' => 0
			);
		}
		echo json_encode($return);
	}
	
	function stock_out(){
		$post = $this->input->post();
		$datax = $this->produk_model->stock_out($post['id']);
		if($datax){
			$data = array();
			foreach($datax as $row){
				$row->total = number_format($row->total);
				$row->total_beli = number_format($row->total_beli);
				array_push($data, $row);
			}
			$return = array(
				'data' => $data,
				'code' => 0,
				'info' => 'OK',
				'guid' => 0
			);		
		}else{
			$return = array(
				'data' => $datax,
				'code' => 1,
				'info' => '',
				'guid' => 0
			);
		}
		echo json_encode($return);
	}
}