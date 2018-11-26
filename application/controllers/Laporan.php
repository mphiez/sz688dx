<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('laporan_model');
		$this->load->helper('menu');
		$this->load->model('master_model');
	}
	
	public function index(){
		$this->ledger();
	}
	
	public function ledger(){
		$data['judul']				= "Buku Besar";
		$data['cabang']				= $this->laporan_model->getCabang();
		$this->load->view('laporan/v_ledger',$data);
	}
	
	public function daftar_jurnal(){
		$data['periode']				= $this->laporan_model->getPeriodeJurnal();
		$data['judul']				= "Daftar Jurnal Transaksi";
		$data['cabang']				= $this->laporan_model->getCabang();
		$this->load->view('laporan/v_daftar_jurnal',$data);
	}
	
	public function payment(){
		$data['periode']				= $this->laporan_model->getPeriodeJurnal();
		$data['judul']				= "Daftar Pengeluaran";
		$data['cabang']				= $this->laporan_model->getCabang();
		$this->load->view('laporan/v_payment',$data);
	}
	
	public function load_ledger(){
		$acnum			= $this->input->post('acnum');
		$cabang			= $this->input->post('cabang');
		$year			= $this->input->post('year');
		$month			= $this->input->post('month');
		$periode = date("Y-m",strtotime($year."-".$month."-01"));
		$periodes = date("Ymd",strtotime($year."-".$month."-01"));
		if(empty($acnum)){
			$acnum = '1-1111';
		}
		$datax			= $this->laporan_model->bukubesar($acnum, $cabang, $periode);
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
				array_push($temp,$row);
			}
			
			$result = $this->result();
			$result['data'] = $temp;
			
			echo json_encode($result);
			exit();
			
		}else{
			$result['data'] = array();
			
			echo json_encode($result);
			exit();
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
	
	public function search_akun(){
		$name = $this->input->post('accno');
		$datax = $this->laporan_model->search_akun($name);
		$list = array();
		$temp = array();
		if($datax > 0){
			foreach($datax as $row){
				$list[$row->account_num] = $row;
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
	
	function laba_rugi(){
		$data['cabang']					= $this->laporan_model->getCabang();
		$data['judul']					= "Laba Rugi";
		$this->load->view('laporan/v_laba_rugi_temp',$data);
	}
	
	function load_laba_rugi(){
		$data = $this->input->post();
		$data['pendapatan']				= $this->laporan_model->pendapatan($data);
		$data['hpp']					= $this->laporan_model->hpp($data);
		$data['biaya']					= $this->laporan_model->biaya($data);
		$data['beban_lain']				= $this->laporan_model->beban_lain($data);
		$this->load->view('laporan/v_laba_rugi_load',$data);
	}
	
	function pdf_laba_rugi(){
		$data['pendapatan']				= $this->laporan_model->pendapatan();
		$data['hpp']					= $this->laporan_model->hpp();
		$data['biaya']					= $this->laporan_model->biaya();
		$data['beban_lain']				= $this->laporan_model->beban_lain();
		$html							= $this->load->view('laporan/v_laba_rugi',$data,true);
		$pdfFilePath					= "laba rugi.pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage('P', '', '', '',
				30, // margin_left
				30, // margin right
				20, // margin top
				10, // margin bottom
				10, // margin header
				10); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I");
		
	}
	
	public function saldo_awal(){
		$data['judul']				= "Saldo Awal";
		$data['periode']				= $this->laporan_model->getPeriode();;
		$this->load->view('laporan/v_list_saldo',$data);
	}
	
	public function load_list(){
		$periode = $this->input->post('periode');
		$datax = $this->laporan_model->load_list($periode);
		if($datax){
			$temp = array();
			foreach($datax as $row){
				$row->saldo = number_format($row->saldo);
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
	
	public function load_list_jurnal(){
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$pembayaran = $this->input->post('pembayaran');
		$cabang = $this->input->post('cabang');
		$periode = date("Y-m",strtotime($year."-".$month."-01"));
		$datax = $this->laporan_model->load_list_jurnal($periode, $cabang, $pembayaran);
		if($datax){
			$temp = array();
			foreach($datax as $row){
				$row->jumlah_debit = number_format($row->jumlah_debit);
				$row->jumlah_credit = number_format($row->jumlah_credit);
				$row->akun_debit = ($row->no_akun_debit." - ".$row->nama_akun_debit);
				$row->akun_credit = ($row->no_akun_credit." - ".$row->nama_akun_credit);
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
}