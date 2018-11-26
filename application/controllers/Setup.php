<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('menu_model');
		$this->load->helper('menu');
	}
	
	public function index(){
		$this->setup_menu();
		
	}
	public function setup_menu(){
		$data['judul']		= "Daftar Menu";
		$data['data_menu']	= $this->menu_model->get_daftar();
		$data['data_urut']	= $this->menu_model->get_urutan();
		$this->load->view('setup/v_daftar_menu',$data);
	}
	
	public function edit_menu(){
		$this->menu_model->update_menu();
		redirect('setup');
	}
	
	public function setup_akses(){
		$data['judul']			= "Daftar User";
		$data['list_user']		= $this->menu_model->list_user();
		$data['list_jabatan']	= $this->menu_model->jabatan();
		$data['list_cabang']	= $this->menu_model->cabang();
		$this->load->view('setup/v_list_user',$data);
	}
	
	public function edit_profile(){
		$data['judul']		= 'Edit Profile';
		$pn_id				= $this->uri->segment(3);
		$data['data_user']	= $this->menu_model->get_user($pn_id);
		$data['list_jabatan']	= $this->menu_model->jabatan($pn_id);
		$data['list_cabang']	= $this->menu_model->cabang($pn_id);
		$this->load->view('setup/v_edit_profile',$data);
	}
	
	public function proses_edit_profile(){
		$data['data_user']	= $this->menu_model->proses_edit();
		redirect('master/karyawan');
	}
	
	public function add_user(){
		$data['judul']			= 'Add User';
		$data['list_jabatan']	= $this->menu_model->jabatan();
		$data['list_cabang']	= $this->menu_model->cabang();
		$this->load->view('setup/v_add_user',$data);
	}
	
	public function proses_add_user(){
		$data['judul']			= 'Insert User Sukses';
		$pn_id					= $this->menu_model->proses_tambah();
		$data['data_user']		= $this->menu_model->get_user($pn_id);
		$data['list_jabatan']	= $this->menu_model->jabatan($pn_id);
		$data['list_cabang']	= $this->menu_model->cabang($pn_id);
		redirect('master/karyawan');
	}
	
	function check_user(){
		if($this->menu_model->check_user()){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	public function set_menu(){
		$data["judul"]			= "Setup Menu Akses";
		$kd_jab					= $this->uri->segment(3);
		$data['id_jab']			= $this->uri->segment(3);
		$data['data_menu']		= $this->menu_model->get_menu();
		$data['data_jabatan']	= $this->menu_model->get_jabatan($kd_jab);
		$this->load->view('setup/v_set_akses',$data);
	}
	
	public function add_jab(){
		$this->menu_model->proses_add_jab();
		redirect('setup/setup_akses');
	}
	
	public function add_cab(){
		$this->menu_model->proses_add_cab();
		redirect('master/cabang');
	}
	
	public function edit_cab(){
		$this->menu_model->proses_edit_cab();
		redirect('master/cabang');
	}
	
	public function proses_menu_akses(){
		$this->menu_model->proses_menu_akses();
		redirect('setup/setup_akses');
	}
}