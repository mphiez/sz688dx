<?php 
	class Order_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function get_pajak_jual(){
			$query 	= "select * from j_pajak where type = '1'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function get_list_customer($key){
			$query 	= "select id, nama_pemesan, nama_perusahaan from j_master_customer where id like '%$key%' or nama_pemesan like '%$key%' or nama_perusahaan like '%$key%' order by nama_pemesan";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function load_list_product($key){
			$query 	= "select id, nm_barang from j_master_barang where id like '%$key%' or nm_barang like '%$key%' order by nm_barang";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function get_data_customer($id){
			$query 	= "select *, (SELECT sum(total - bayar) FROM j_trans_header WHERE id_pelanggan = '$id') AS sisa_tagihan from j_master_customer where id = '$id'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function get_data_product($id){
			$query 	= "select * from j_master_barang where id = '$id'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function load_list(){
			$query 	= "select * from j_trans_header";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return null;
			}
		}
		
		public function load_summary(){
			$query 	= 'SELECT
						SUM(

							IF (trans_type = "SELL", total, 0)
						) AS sell,
						SUM(

							IF (trans_type = "BUY", total, 0)
						) AS buy,
						(
								SUM(

									IF (trans_type = "SELL", total, 0)
								) - SUM(

									IF (trans_type = "BUY", total, 0)
								)
						) AS total,
						
					SUM(

							IF (trans_type = "SELL", bayar, 0)
						) AS amount,

					SUM(

							IF (trans_type = "BUY", bayar, 0)
						) AS spend
					FROM
						j_trans_header';
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return null;
			}
		}
		
		public function insert_header($header = null,$detail = null, $tran = null){
			$this->db->trans_begin();
			$header['input_by'] = $this->session->userdata('pn_name');
			$header['input_date'] = date('Y-m-d');
			$header['trans_type'] = $tran;
			$this->db->insert('j_trans_header',$header);
			$id = $this->db->insert_id();
			
			for($i = 0; $i < count($detail['harga']); $i++){
				$data = array(
					'id_header' => $id,
					'id_produk' => $detail['id'][$i],
					'nama_produk' => $detail['nama'][$i],
					'deskripsi' => null,
					'kuantitas' => $detail['qty'][$i],
					'satuan' => $detail['satuan'][$i],
					'harga' => $detail['harga'][$i],
					'diskon' => $detail['diskon'][$i],
					'ppn' => $detail['pajak'][$i],
					'jumlah' => $detail['total'][$i],
					'input_date' => date('Y-m-d'),
					'input_by' => $this->session->userdata('pn_name'),
					'tanggal_transaksi' => $header['tanggal_transaksi']
				);
				$this->db->insert('j_trans_detail',$data);
			}
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				$data = array();
				$data['code'] = 1;
				$data['info'] = 'Transaksi Gagal';
			}else{
				$this->db->trans_commit();
				$data = array();
				$data['code'] = 0;
				$data['info'] = 'Transaksi Berhasil';
			}
			return $data;
		}
		
		public function get_detail($id){
			$query = $this->db->query("select * from j_trans_detail where id_header = '$id'");
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return null;
			}
		}
	}