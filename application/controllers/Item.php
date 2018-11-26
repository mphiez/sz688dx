<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends CI_Controller {
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
		$data['judul']				= "Item Produk";
		//$data['data_pajak']			= $this->order_model->get_pajak();
		$this->load->view('items/product_item',$data);
	}
	
	public function category(){
		$data['judul']				= "Item Produk";
		//$data['data_pajak']			= $this->order_model->get_pajak();
		$this->load->view('items/product_item_side',$data);
	}
	
	public function product(){
		$data['judul']				= "Item Produk";
		//$data['data_pajak']			= $this->order_model->get_pajak();
		$this->load->view('items/product_item',$data);
	}
	
	public function all(){
		$data['judul']				= "Item Produk";
		//$data['data_pajak']			= $this->order_model->get_pajak();
		$this->load->view('items/product_all_item',$data);
	}
	
	public function detail(){
		$data['judul']				= "Item Produk";
		//$data['data_pajak']			= $this->order_model->get_pajak();
		$this->load->view('items/product_detail',$data);
	}
	
	public function button(){
		$data['judul']				= "Item Produk";
		//$data['data_pajak']			= $this->order_model->get_pajak();
		$this->load->view('items/button',$data);
	}
}