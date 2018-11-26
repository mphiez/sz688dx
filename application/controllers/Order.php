<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {
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
		$data['judul']				= "Buat Penjualan";
		$data['data_pajak']			= $this->order_model->get_pajak();
		$this->load->view('order/penjualan/v_input_penjualan',$data);
	}
	
	public function buy(){
		$data['judul']				= "Buat Pembelian";
		$data['trans']				= "BUY";
		$data['data_pajak']			= $this->order_model->get_pajak_jual();
		$this->load->view('order/v_input_penjualan',$data);
	}
	
	public function sell(){
		$data['judul']				= "Buat Penjualan";
		$data['trans']				= "SELL";
		$data['data_pajak']			= $this->order_model->get_pajak_jual();
		$this->load->view('order/v_input_penjualan',$data);
	}
	
	public function sell_current(){
		$data['judul']				= "Buat Penjualan";
		$data['data_pajak']			= $this->order_model->get_pajak_jual();
		$this->load->view('order/v_input_penjualan',$data);
	}
	
	public function purchases(){
		$data['judul']				= "Purchase Transaction List";
		$data['show']				= "BUY";
		$this->load->view('order/v_list',$data);
	}
	
	public function sales(){
		$data['judul']				= "Sales Transaction List";
		$data['show']				= "SELL";
		$this->load->view('order/v_list',$data);
	}
	
	
	public function list_transaction(){
		$data['judul']				= "List Transaction";
		$data['show']				= "all";
		$this->load->view('order/v_list',$data);
	}
	
	public function load_list_customer(){
		$key		= $this->input->post('key');
		$data	= $this->order_model->get_list_customer($key);
		$val = array();
		if($data > 0){
			foreach($data as $row){
				$x = ''.$row->id.' - '.$row->nama_perusahaan."(".$row->nama_pemesan.")";
				array_push($val,$x);
			}
		}
		$datax['data'] = $val;
		echo json_encode($datax);
	}
	
	public function load_list_product(){
		$key		= $this->input->post('key');
		$data	= $this->order_model->load_list_product($key);
		$val = array();
		if($data > 0){
			foreach($data as $row){
				$x = ''.$row->id.' - '.$row->nm_barang;
				array_push($val,$x);
			}
		}
		$datax['data'] = $val;
		echo json_encode($datax);
	}
	
	public function load_data_customer(){
		$id		= $this->input->post('id_pelanggan');
		$data	= $this->order_model->get_data_customer($id);
		$val = array();
		if($data > 0){
			foreach($data as $row){
				array_push($val,$row);
			}
		}
		$datax['data'] = $val;
		echo json_encode($datax);
	}
	
	public function load_data_product(){
		$id		= $this->input->post('id_product');
		$data	= $this->order_model->get_data_product($id);
		$val = array();
		if($data > 0){
			foreach($data as $row){
				array_push($val,$row);
			}
		}
		$datax['data'] = $val;
		echo json_encode($datax);
	}
	
	public function save(){
		$post = $this->input->post();
		$this->do_save($post);
	}
	
	private function do_save($post = null){
		$data = $this->order_model->insert_header($post['data']['header'],$post['data']['detail'],$post['data']['transaction']);
		echo json_encode($data);
	}
	
	public function get_form_customer(){
		$data['no_cust']	= $this->master_model->get_id_cust();
		$data['data_salesman']	= $this->master_model->get_salesman();
		$this->load->view('order/form_customer');
	}
	
	public function load_list(){
		$data = $this->order_model->load_list();
		$val = array();
		foreach($data as $row){
			$row->tanggal_transaksi = date('d-m-Y',strtotime($row->tanggal_transaksi));
			$row->subtotal = number_format($row->subtotal);
			$row->ppn = number_format($row->ppn);
			$row->diskon = number_format($row->diskon);
			$row->total = number_format($row->total);
			$row->bayar = number_format($row->bayar);
			array_push($val,$row);
		}
		$datax['data'] = $val;
		echo json_encode($datax);
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
		//$array =  (array) $datadsd;
		//$array = json_decode(json_encode($datadsd), true);
		$json_data = json_encode((array) $datadsd);
		echo $json_data;
		//echo json_encode($val);
		
		/* $array =  (array) $datadsd;
		print_r($array); */
	}
	
	public function tes_csv(){
		$data['judul']				= "List Transaction";
		$data['show']				= "all";
		$data['list'] = $this->order_model->load_list();
		$this->load->view('tes',$data);
	}
	
	public function get_detail(){
		$data = $this->order_model->get_detail($this->input->post('id'));
		echo json_encode($data);
	}
}