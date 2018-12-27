<?php 
	class Produk_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		function data_keluar($id){
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "SELECT
							c.kuantitas ak, a.kuantitas ab, a.*, d.nomor_transaksi, d.id_pelanggan, d.ship_email, d.ship_to_name, d.ship_phone, d.ship_address, d.pesan
						FROM
							dk_transaksi_detail a
						LEFT JOIN (
							SELECT
								b.id_barang as id_produk,
								sum(b.qty) AS kuantitas
							FROM
								dk_stock_keluar b
							WHERE
								md5(b.transaksi) = '$id'
							AND b.perusahaan = '$perusahaan'
							AND b.cabang = '$cabang'
							GROUP BY
							b.id_barang
						) c ON a.id_produk = c.id_produk
						LEFT JOIN dk_transaksi d on d.id = a.id_ref
						WHERE
							a.perusahaan = '$perusahaan'
						AND a.cabang = '$cabang'
						AND md5(a.id_ref) = '$id'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		function data_spj($id){
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "SELECT
							e.id_customer, e.nama_customer, e.nomor_telfon as nomor_telpon_customer, e.email as email_customer, e.alamat as alamat_customer, e.fax_cust as fax_customer, d.logo, d.nama_perusahaan, d.alamat as alamat_perusahaan, d.nomor_telfon as nomor_telpon_perusahaan,d.email as email_perusahaan, d.no_fax as fax_perusahaan, c.alamat, c.email, c.nomor_telpon, c.fax, b.nomor_transaksi, b.nomor_invoice, b.id_pelanggan, b.ship_to_name, b.ship_address, b.ship_email, b.ship_phone, a.*
						FROM
							dk_stock_keluar a
						left join
							dk_transaksi b on a.transaksi=b.id and a.perusahaan=b.perusahaan
						left join
							dk_cabang c on c.cabang=a.cabang and a.perusahaan=c.perusahaan
						left join
							dk_company d on d.id=a.perusahaan
						left join
							dk_customer e on e.id_customer=b.id_pelanggan and a.perusahaan=e.perusahaan
						WHERE
							a.perusahaan = '$perusahaan'
						AND a.cabang = '$cabang'
						AND c.cabang = '$cabang'
						AND md5(a.id_spj) = '$id'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		function stock_out($id){
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "SELECT
							b.nama_produk, b.id_produk, sum(b.kuantitas) as total_beli, a.total, a.id_spj
						FROM
							dk_transaksi_detail b
						LEFT JOIN
							(select id_barang, id_spj, sum(qty) total, cabang, perusahaan from dk_stock_keluar where md5(transaksi) = '$id' group by id_barang) a on a.id_barang = b.id_produk
						WHERE
							a.perusahaan = '$perusahaan'
						AND a.cabang = '$cabang'
						AND a.cabang = b.cabang
						AND a.perusahaan = b.perusahaan
						AND md5(b.id_ref) = '$id'
						group by b.id_produk
						order by nama_produk asc
						";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		function save_keluar($post= array()){
			$this->db->trans_begin();
			$spj = counter('c_spj');
			add_counter('c_spj');
			foreach($post['transaksi'] as $data){
				$data['created'] 		= date('Y-m-d H:i:s');
				$data['id_spj'] 		= $spj;
				$data['user'] 			= $this->session->userdata('pn_id');
				$data['perusahaan'] 	= $this->session->userdata('perusahaan');
				$data['cabang'] 		= $this->session->userdata('pn_wilayah');
				$this->db->insert('dk_stock_keluar',$data);
				
				
				
				$q_stock	= "select category, stock_awal from dk_produk where perusahaan='".$this->session->userdata('perusahaan')."' and cabang ='".$this->session->userdata('pn_wilayah')."' and id_produk = '".$data['id_barang']."'";
						
				$q_stock 		= $this->db->query($q_stock);
				if($q_stock->num_rows() > 0){
					$ret = $q_stock->result();
					foreach($ret as $rows){
						if($rows->category == 'Item Stock' && $rows->stock_awal > $data['qty']){
							$this->db->query("update dk_produk set stock_awal=stock_awal-".$data['qty']." where perusahaan='".$this->session->userdata('perusahaan')."' and cabang ='".$this->session->userdata('pn_wilayah')."' and id_produk = '".$data['id_barang']."'");
						}
					}
					
					
					
					
				}else{
					$this->db->trans_rollback();
					
					return array(
								"status"=> '-2',
								"data"=> "",
								"info"=> $data['nama_barang']
							);
				}
			}
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return array(
								"status"=> '0',
								"data"=> $spj,
								"info"=> $data['nama_barang']
							);
			}
		}
	}