<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller {
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
		$this->barang();
	}
	
	public function list_account(){
		$data['judul'] 			= "Daftar Akun";
		$this->load->view('master/account/v_list_account',$data);
	}
	
	public function list_customer(){
		$data['judul'] 			= "Daftar Customer";
		$data['cabang']				= $this->laporan_model->getCabang();
		$this->load->view('master/customer/v_list_customer',$data);
	}
	
	public function get_customer(){
		$id = $this->input->post('id');
		$cabang = $this->input->post('cabang');
		$datax = $this->transaksi_model->user(false,$id, $cabang);
		if($datax){
			$temp = array();
			foreach($datax as $row){
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
	
	public function karyawan(){
		$data['judul'] 			= "Daftar Karyawan";
		$this->load->view('master/salesman/v_daftar_salesman',$data);
	}
	
	public function produk_jasa(){
		$data['judul'] 			= "Daftar Produk";
		$this->load->view('master/paket/v_list_paket',$data);
	}
	
	public function produk_manajemen(){
		$data['judul'] 			= "Daftar Produk";
		$this->load->view('master/paket/v_list_purchase',$data);
	}
	
	public function buat_produk(){
		$data['judul'] 			= "Create Produk";
		$this->load->view('master/paket/v_add_paket',$data);
	}
	
	public function update_produk(){
		$data['judul'] 			= "Update Produk";
		$id = $this->uri->segment(3);
		$data['data_paket']	= $this->master_model->getListPaket($id);
		$data['data_paket_detail']	= $this->master_model->getListPaketDetail($id);
		$this->load->view('master/paket/v_edit_paket',$data);
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
	
	public function get_paket(){
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$param = $this->input->post('param');

		$data	= $this->master_model->getListPaket($param);

		$val = array();
		
		$temp = array();
		if($data > 0){
			foreach($data as $row){
				$row->harga_jual = number_format($row->harga_jual);
				$row->harga_beli = number_format($row->harga_beli);
				array_push($temp,$row);
			}
		}
		$result['data'] = $temp;
		
		echo json_encode($result);
		exit();
	}
	
	public function get_list_pembelian(){
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$param = $this->input->post('param');

		$data	= $this->master_model->get_list_pembelian($param);

		$val = array();
		
		$temp = array();
		if($data > 0){
			foreach($data as $row){
				$row->harga_jual = number_format($row->harga_jual);
				$row->harga_beli = number_format($row->harga_beli);
				array_push($temp,$row);
			}
		}
		$result['data'] = $temp;
		
		echo json_encode($result);
		exit();
	}
	
	public function get_karywan(){
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$data	= $this->master_model->getListKaryawan();

		$val = array();

		$result = $this->result();
		$result['data'] = $data->result();
		
		echo json_encode($result);
		exit();
	}
	
	public function delete_account(){
		
		$post = $this->input->post();
		
		$result = $this->result();
		if($data	= $this->master_model->delete_row($post)){
			$result['info'] = 'delete_ok';
			$result['data'] = $data;
		}else{
			$result['info'] = 'delete_failed';
			$result['code'] = '1';
		}
		
		echo json_encode($result);
		exit();
	}
	
	public function delete_customer(){
		
		$post = $this->input->post();
		
		$result = $this->result();
		if($data	= $this->master_model->delete_customer($post)){
			$result['info'] = 'delete_ok';
			$result['data'] = $data;
		}else{
			$result['info'] = 'delete_failed';
			$result['code'] = '1';
		}
		
		echo json_encode($result);
		exit();
	}
	
	public function add_account(){
		
		$post = $this->input->post();
		
		$result = $this->result();
		$data	= $this->master_model->add($post);
		if($data['code'] == '0'){
			$result['info'] = 'add_ok';
			$result['data'] = $data;
		}else if($data['code'] == '1'){
			$result['info'] = 'add_failed';
			$result['code'] = '1';
		}else if($data['code'] == '2'){
			$result['info'] = 'Existing Account';
			$result['code'] = '2';
		}
		
		echo json_encode($result);
		exit();
	}
	
	public function update_customer(){
		
		$post = $this->input->post();
		
		$result = $this->result();
		$data	= $this->master_model->update_customer($post);
		if($data){
			$result['info'] = 'add_ok';
			$result['data'] = $data;
		}else if($data['code'] == '2'){
			$result['info'] = 'error';
			$result['code'] = '2';
		}
		
		echo json_encode($result);
		exit();
	}
	
	public function add_customer(){
		
		$post = $this->input->post();
		
		$result = $this->result();
		$data	= $this->master_model->add_customer($post);
		if($data['code'] == '0'){
			$result['info'] = 'add_ok';
			$result['data'] = $data;
		}else if($data['code'] == '1'){
			$result['info'] = 'add_failed';
			$result['code'] = '1';
		}else if($data['code'] == '2'){
			$result['info'] = 'Existing Account';
			$result['code'] = '2';
		}
		
		echo json_encode($result);
		exit();
	}
	
	public function update_account(){
		
		$post = $this->input->post();
		
		$result = $this->result();
		if($data	= $this->master_model->update($post)){
			$result['info'] = 'update_ok';
			$result['data'] = $data;
		}else{
			$result['info'] = 'update_failed';
			$result['code'] = '3';
		}
		
		echo json_encode($result);
		exit();
	}
	
	public function cabang(){
		$data['judul']			= "Daftar User";
		$data['list_user']		= $this->menu_model->list_user();
		$data['list_jabatan']	= $this->menu_model->jabatan();
		$data['list_cabang']	= $this->menu_model->cabang();
		$this->load->view('master/cabang/v_list_user',$data);
	}
	
	public function search_item(){
		$name = $this->input->post('pn_name');
		$datax = $this->master_model->search_item($name);
		$list = array();
		$temp = array();
		if($datax > 0){
			foreach($datax as $row){
				$row->harga_dec = number_format($row->harga_item);
				$list[$row->id] = $row;
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
	
	public function save_paket(){
		$post = $this->input->post();
		$datax = $this->master_model->save($post);
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
	
	public function save_paket_edit(){
		$post = $this->input->post();
		$datax = $this->master_model->save_edit($post);
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