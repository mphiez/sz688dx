<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configurasi extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('configurasi_model');
		$this->load->model('laporan_model');
		$this->load->helper('menu');
		$this->load->model('master_model');
	}
	
	public function account(){
		$data['account'] 	= $this->configurasi_model->load_account();
		$data['type'] 		= $this->configurasi_model->load_type();
		$data['category'] 	= $this->configurasi_model->load_category();
		$this->load->view('configurasi/v_account',$data);
	}
	
	public function generate_saldo_awal(){
		$year 		= date('Y');
		$month 		= date("m");
		if(date('d') == '01'){
			$periodes 	= date("Ym",strtotime($year."-".$month."-01"));
			$year 		= date("Y",strtotime('-1 month',strtotime($year."-".$month."-01")));
			$month 		= date("m",strtotime('-1 month',strtotime($year."-".$month."-01")));
		}else{
			$periodes 	= date("Ym",strtotime('+1 month',strtotime($year."-".$month."-01")));
		}
		
		$periodex 	= $periodes."01";
		
		$data_perusahaan = $this->laporan_model->get_perusahaan();
		foreach($data_perusahaan as $per){
			$data_cabang = $this->laporan_model->get_cabang($per->id);
			foreach($data_cabang as $cab){
				$data_account = $this->laporan_model->get_account($per->id, $cab->id, $periodex);
				foreach($data_account as $acc){
					$sal = $this->hitung_saldo_akhir($acc->account_num, $cab->id, $year, $month, $per->id);
					
						$data = array(
										'account_num'		=> $acc->account_num,
										'account_name'		=> account_name($acc->account_num),
										'status'			=> 0,
										'user'				=> 1,
										'keterangan'		=> 'Automatic',
										'periode'			=> $periodex,
										'saldo'				=> $sal*1,
										'create_date'		=> date("Y-m-d H:i:s"),
										'perusahaan'		=> $per->id,
										'cabang'			=> $cab->id
									);
						$this->laporan_model->insert_saldo($data);
				}
			}
		}
		
	}
	
	public function hitung_saldo_akhir($acnum,$cabang,$year,$month, $perusahaan){
		$periode = date("Y-m",strtotime($year."-".$month."-01"));
		$periodes = date("Ymd",strtotime($year."-".$month."-01"));
		if(empty($acnum)){
			$acnum = '1-1111';
		}
		$datax			= $this->laporan_model->bukubesar($acnum, $cabang, $periode, $perusahaan);
		if($datax > 0){
			$saldo = saldo_awal($acnum, $periodes, $cabang);
			
			$saldo_akhir = 0;
			$temp = array();
			$type_akun = substr($acnum,0,1);
			foreach($datax as $row){
				
				if($row->no_akun_debit == $acnum){
					$row->credit	= '0';
					$row->debit	= $row->jumlah_debit;
				}else{
					$row->credit	= $row->jumlah_credit;
					$row->debit	= '0';
				}
				if($type_akun == '1' || $type_akun == '5'){
					$row->saldo = ($saldo + $row->debit - $row->credit);
				}else{
					$row->saldo = ($saldo - $row->debit + $row->credit);
				}
				$row->credit	= number_format($row->credit);
				$row->debit		= number_format($row->debit);
				$saldo = $row->saldo;
				$row->saldo = number_format($row->saldo);
			}
			return $saldo;
			
		}else{
			return $saldo = saldo_awal($acnum, $periodes, $cabang);
		}
		echo json_encode($return);
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
	
	public function save_account(){
		$result = $this->result();
		$post = $this->input->post();
		if($data = $this->configurasi_model->save_account($post)){
			$return['code'] = 0;
		}else{
			$return['code'] = 1;
		}
		echo json_encode($return);
	}
}