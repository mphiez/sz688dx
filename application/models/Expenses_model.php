<?php 
	class Expenses_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function get_pajak_jual(){
			$this->db->trans_begin();
			
			$data['create_date'] = date("Y-m-d H:i:s");

			$id = $this->db->insert('dk_account', $data);

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return $id;
			}
		}
		
		public function load_list($range=null,$status=null){
			$date = "and SUBSTR(a.tanggal_diterima,1,10) <= '".date("Y-m-d")."' and SUBSTR(a.tanggal_diterima,1,10) >= '".date("Y-m-d",strtotime('-1 year', strtotime(date("Y-m-d"))))."'";
			if($range == "D"){
				$date = "and SUBSTR(a.tanggal_diterima,1,10) = '".date("Y-m-d")."'";
			}else if($range == "W"){
				$time = date("Y-m-d",strtotime('monday this week'));
				$date = "and SUBSTR(a.tanggal_diterima,1,10) <= '".date("Y-m-d")."' and SUBSTR(a.tanggal_diterima,1,10) >= '".$time."'";
			}else if($range == "M"){
				$time = date("Y-m")."-01";
				$date = "and SUBSTR(a.tanggal_diterima,1,10) <= '".date("Y-m-d")."' and SUBSTR(a.tanggal_diterima,1,10) >= '".$time."'";
			}else if($range == "M2"){
				$time = date("Y-m-01",strtotime("-1 month",strtotime(date("Y-m-d"))));
				$date = "and SUBSTR(a.tanggal_diterima,1,10) <= '".date("Y-m-d")."' and SUBSTR(a.tanggal_diterima,1,10) >= '".$time."'";
			}else if($range == "M2"){
				$time = date("Y")."-01-01";
				$date = "and SUBSTR(a.tanggal_diterima,1,10) <= '".date("Y-m-d")."' and SUBSTR(a.tanggal_diterima,1,10) >= '".$time."'";
			}
			
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$admin = cek_admin();
			
			//tagihan dari definisi ini adalah sisa bayar
			//sisa tagihan 
			$query 	= "SELECT
							a.*,
							f.bayar,
							h.tot_masuk,
							j.tot_beli
						FROM
							dk_pembelian_produk a
						LEFT JOIN (
							SELECT
							d.nomor_transaksi, sum(d.jumlah_bayar) bayar
							FROM 
								dk_pembayaran d
							WHERE
								d.perusahaan = '".$this->session->userdata('perusahaan')."'
							AND d.cabang = '".$this->session->userdata('pn_wilayah')."'
							and d.tipe_bayar = 2
							GROUP BY d.nomor_transaksi
						) f on f.nomor_transaksi = a.nomor_transaksi
						left join (
							select 
								sum(g.qty) as tot_masuk,
								g.transaksi
							from dk_stock_masuk g
							WHERE
								g.perusahaan = '".$this->session->userdata('perusahaan')."'
							AND g.cabang = '".$this->session->userdata('pn_wilayah')."'
							group by transaksi
						) h on h.transaksi = a.nomor_transaksi
						left join (
							select 
								sum(i.qty) as tot_beli,
								i.nomor_transaksi
							from dk_pembelian_produk_detail i
							WHERE
								i.perusahaan = '".$this->session->userdata('perusahaan')."'
							AND i.cabang = '".$this->session->userdata('pn_wilayah')."'
							group by nomor_transaksi
						) j on j.nomor_transaksi = a.nomor_transaksi
						WHERE
							a.perusahaan = '".$this->session->userdata('perusahaan')."'
						AND a.cabang = '".$this->session->userdata('pn_wilayah')."' 
						$date
						order by a.tanggal_diterima desc, id desc
			";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		function load_list_invoice($id){
			$q 		= $this->db->query("select no_invoice from dk_pembayaran where nomor_transaksi='$id' and perusahaan='".$this->session->userdata('perusahaan')."' and cabang='".$this->session->userdata('pn_wilayah')."' and tipe_bayar = 2");
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return array();
			}
		}
		
		public function load_list_sum(){
			/* $date ="";
			if($range == "D"){
				$date = "and SUBSTR(tanggal_transaksi,1,10) = '".date("Y-m-d")."'";
			}else if($range == "W"){
				$time = date("Y-m-d",strtotime('monday this week'));
				$date = "and SUBSTR(tanggal_transaksi,1,10) <= '".date("Y-m-d")."' and SUBSTR(tanggal_transaksi,1,10) >= '".$time."'";
			}else if($range == "M"){
				$time = date("Y-m")."-01";
				$date = "and SUBSTR(tanggal_transaksi,1,10) <= '".date("Y-m-d")."' and SUBSTR(tanggal_transaksi,1,10) >= '".$time."'";
			}else if($range == "M2"){
				$time = date("Y-m-01",strtotime("-1 month",strtotime(date("Y-m-d"))));
				$date = "and SUBSTR(tanggal_transaksi,1,10) <= '".date("Y-m-d")."' and SUBSTR(tanggal_transaksi,1,10) >= '".$time."'";
			}else if($range == "M2"){
				$time = date("Y")."-01-01";
				$date = "and SUBSTR(tanggal_transaksi,1,10) <= '".date("Y-m-d")."' and SUBSTR(tanggal_transaksi,1,10) >= '".$time."'";
			}
			
			$sts = "";
			if($status != ''){
				if($status == 0){
					$sts = "and status='0'";
				}else if($status == 1){
					$sts = "and status='1'";
				}else if($status == 2){
					$sts = "and status='2'";
				}else if($status == 3){
					$sts = "and status='3'";
				}else if($status == 4){
					$sts = "and status='4'";
				}
			} */
			
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$admin = cek_admin();
			$query 	= "select status, count(*) as total from dk_pembelian_produk where perusahaan='$perusahaan' $date $sts $admin group by status";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function search_supplier($search=null, $id=null, $cabang=null){
			$where = "";
			$limit = "";
			if(!empty($search)){
				$where = " and (upper(nama) like '%".strtoupper($search)."%' or id_supplier like '%".$search."%')";
				$limit = " limit 0,10";
			}
			if(isset($id)){
				$where = " and id='$id'";
			}
			
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "select * from dk_supplier where perusahaan='$perusahaan' $where order by nama $limit";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function load_payment($id){
			$where = "";
			if(isset($id)){
				$where = " and md5(id) ='$id'";
			}
			
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "SELECT
									a.id_supplier,
									a.email,
									a.nomor_referensi,
									a.alamat,
									a.tanggal_diterima,
									a.nomor_transaksi,
									a.nomor_invoice,
									a.metode_pembayaran,
									a.akun_pembayaran,
									a.account_sales,
									a.akun_pembayaran,
									a.top,
									b.nama,
									a.subtotal,
									a.ppn,
									a.total_bayar,
									a.diskon,
									a.deskripsi,
									c.bayar
								FROM
									dk_pembelian_produk a
									LEFT JOIN dk_supplier b on a.id_supplier = b.id_supplier and a.perusahaan=b.perusahaan
									left join (SELECT
											sum(jumlah_bayar) AS bayar,
											nomor_transaksi
										FROM
											dk_pembayaran
										WHERE
											perusahaan = '1'
										AND tipe_bayar = '2'
										GROUP BY
											nomor_transaksi
									) c on c.nomor_transaksi = a.nomor_transaksi
								WHERE
									a.perusahaan = '$perusahaan'
								AND md5(a.id) = '$id'
								limit 1";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function load_detail($id){
			$where = "";
			if(isset($id)){
				$where = " and md5(id) ='$id'";
			}
			
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "SELECT
									c.sudah_masuk,
									b.id,
									a.*
								FROM
									dk_pembelian_produk_detail a
								LEFT JOIN dk_pembelian_produk b ON a.nomor_transaksi = b.nomor_transaksi
								AND a.perusahaan = b.perusahaan
								LEFT JOIN (
									SELECT
										transaksi,
										id_barang as id_produk,
										sum(qty) sudah_masuk
									FROM
										dk_stock_masuk
									WHERE
										perusahaan = '$perusahaan'
									AND cabang = '$cabang'
									GROUP BY
										transaksi,
										id_barang
								) c ON c.transaksi = a.nomor_transaksi
								AND c.id_produk = a.id_produk
								WHERE
									MD5(b.id) = '$id'
								AND a.perusahaan = '$perusahaan'
								AND a.cabang = '$cabang'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function save($id = null){
			$post = $this->input->post();
			if($post['nomor_transaksi'] == ''){
				$id_transaksi = counter('c_expenses');
				add_counter('c_expenses');
			}else{
				$perusahaan = $this->session->userdata('perusahaan');
				$cabang = $this->session->userdata('pn_wilayah');
				$query 	= "select * from dk_pembelian_produk where perusahaan='$perusahaan' and cabang='$cabang' and nomor_transaksi='".$post['nomor_transaksi']."'";
				$q 		= $this->db->query($query);
				if($q->num_rows() > 0){
					$this->db->trans_rollback();
					return '-1';
				}else{
					$id_transaksi = $post['nomor_transaksi'];
				}
			}
			
			$this->db->trans_begin();
			
			$post['perusahaan'] = $this->session->userdata('perusahaan');
			$post['cabang'] = $this->session->userdata('pn_wilayah');
			/* 
			bikin dulu transaksi header
			 */
			
			$account_sales = $post['tujuan_transfer_jual'];
				
			if($post['metode_pembayaran'] == 'cash' && $post['tipe_transaksi'] == 0){
				$account = '1-1111';
			}else if($post['metode_pembayaran'] == 'hutang' || $post['tipe_transaksi'] == 1){
				$account = '2-1110';
			}else{
				$account = $post['tujuan'];
			}
			
			
			$nm_p = explode(' - ',$post['nama_pelanggan']);
			if(count($nm_p) > 1){
				$nm_p = $nm_p[1];
			}else{
				$nm_p = $post['nama_pelanggan'];
			}
			
			$data_prod = array(
							'nomor_transaksi'				=> $id_transaksi,
							'nomor_invoice'					=> $post['nomor_invoice'],
							'nomor_referensi'				=> $post['no_referensi'],
							'id_supplier'					=> $post['id_pelanggan'],
							'supplier'						=> $nm_p,
							'ppn'							=> str_replace(',','',$post['ppn']),
							'subtotal'						=> str_replace(',','',$post['subtotal']),
							'total_bayar'					=> str_replace(',','',$post['total']),
							'email'							=> $post['email_pelanggan'],
							'alamat'						=> $post['alamat_penagihan'],
							'tanggal_jatuh_tempo_bayar'		=> date('Y-m-d', strtotime('+'.$post['top']." days",strtotime(date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_transaksi'])))))),
							'metode_pembayaran'				=> $post['metode_pembayaran'],
							'akun_pembayaran'				=> $account,
							'deskripsi'						=> $post['pesan'],
							'diskon'						=> $post['discount'],
							'tanggal_invoice'				=> date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_transaksi']))),
							'create_date'					=> date("Y-m-d H:i:s"),
							'user'							=> $this->session->userdata('pn_id'),
							'perusahaan'					=> $post['perusahaan'],
							'cabang'						=> $post['cabang'],
							'expedisi'						=> $post['cabang'],
							'top'							=> $post['top'],
							'tanggal_diterima'				=> date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_transaksi']))),
							'status'						=> 1,
							'tanggal_bayar'					=> 1,
							'nama_pengeluaran'				=> 'Pembelian Produk',
							'tipe_pembelian'				=> $post['tipe_transaksi'],
							'account_sales'					=> $account_sales,
							);
			
			$this->db->insert('dk_pembelian_produk',$data_prod);
			$id_ref = $this->db->insert_id();
			
			if($post['tipe_transaksi'] == '0'){//0 pembelian langsung
				$data_jurnal = array(
								'tanggal'			=> date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_transaksi']))),
								'keterangan'		=> "Pembelian Produk",
								'nomor_transaksi'	=> $id_transaksi,
								'nomor_invoice'		=> $post['nomor_invoice'],
								'no_akun_debit'		=> $post['account_sales'],
								'nama_akun_debit'	=> account_name($post['account_sales']),
								'no_akun_credit'	=> $account,
								'nama_akun_credit'	=> account_name($account),
								'jumlah_debit'		=> str_replace(',','',$post['total']),
								'jumlah_credit'		=> str_replace(',','',$post['total']),
								'user'				=> $this->session->userdata('pn_id'),
								'status'			=> 0,
								'cabang'			=> $this->session->userdata('pn_wilayah'),
								'perusahaan'		=> $this->session->userdata('perusahaan'),
								'create_date'		=> date("Y-m-d H:i:s")
							);
				$this->db->insert('dk_jurnal',$data_jurnal);
				
				//masukan pembayaran jika pembayaran dengan cash/debit/credit saat pembelian
				if($post['metode_pembayaran'] != 'hutang'){
					$data = array(
								'id_customer' 			=> $nm_p,
								'credit' 				=> $account, 
								'jumlah_bayar' 			=> str_replace(',','',$post['total']),
								'metode_pembayaran'		=> $post['metode_pembayaran'],
								'tanggal_bayar'     	=> date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_transaksi']))),
								'referensi_pembayaran' 	=> $post['no_referensi'],
								'debit'                	=> $post['account_sales'],
								'nm_debit'             	=> account_name($post['account_sales']),
								'create_date'           => date('Y-m-d H:i:s'),
								'user'             		=> $this->session->userdata('pn_id'),
								'cabang'             	=> $this->session->userdata('pn_wilayah'),
								'perusahaan'            => $this->session->userdata('perusahaan'),
								'pesan'             	=> $post['pesan'],
								'tipe_bayar'            => 2,
								'no_invoice'            => $post['nomor_invoice'],
								'nomor_transaksi'       => $id_transaksi,
								'ref_transaksi'         => $post['no_referensi'],
								'nm_credit'             => account_name($account),
							);
							
					$this->db->insert('dk_pembayaran',$data);
				}
				
			}
			
			foreach($post['transaksi'] as $row){
				$nm = explode(' - ',$row['nama_produk']);
				if(count($nm) > 1){
					$nm = $nm[1];
				}else{
					$nm = $row['nama_produk'];
				}
				
				if($row['id_produk'] == ''){
					$id_produk = counter('c_paket');
					add_counter('c_paket');
					/* 
					create produk
					stock_awal = 0 untuk barang baru, setelah masuk barang maka update jumlahnya
					 */
					 
					$data_item = array(
									'id_produk'			=> $id_produk,
									'nama_produk'		=> $nm,
									'satuan'			=> $row['satuan'],
									'harga_jual'		=> str_replace(',','',$row['harga_jual']),
									'deskripsi'			=> $row['deskripsi'],
									'user'				=> $this->session->userdata('pn_id'),
									'perusahaan'		=> $post['perusahaan'],
									'cabang'			=> $post['cabang'],
									'create_date'		=> date("Y-m-d H:i:s"),
									'status'			=> 1,
									'category'			=> 'Item Stock',
									'harga_beli'		=> str_replace(',','',$row['harga_satuan']),
									'stock_awal'		=> 0,
									'stock_minimum'		=> str_replace(',','',$row['minimum']),
									'tanggal_diterima'	=> date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_transaksi']))),
									'account'			=> $account,
									'supplier'			=> $post['id_pelanggan'],
									'account_sales'		=> $account_sales,
									);
					$this->db->insert('dk_produk',$data_item);
					$sts = 'New';
				}else{
					/* 
					update produk
					- jangan update stock_awal disini
					 */
					 
					$id_produk = $row['id_produk'];
					$data_item = array(
									'id_produk'			=> $id_produk,
									'nama_produk'		=> $nm,
									'satuan'			=> $row['satuan'],
									'harga_jual'		=> str_replace(',','',$row['harga_jual']),
									'deskripsi'			=> $row['deskripsi'],
									'user'				=> $this->session->userdata('pn_id'),
									'perusahaan'		=> $post['perusahaan'],
									'cabang'			=> $post['cabang'],
									'create_date'		=> date("Y-m-d H:i:s"),
									'category'			=> 'Item Stock',
									'harga_beli'		=> str_replace(',','',$row['harga_satuan']),
									'stock_minimum'		=> str_replace(',','',$row['minimum']),
									'tanggal_diterima'	=> date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_transaksi']))),
									'account'			=> $account,
									'supplier'			=> $post['id_pelanggan'],
									'account_sales'		=> $account_sales,
									);
					$this->db->where('cabang',$this->session->userdata('pn_wilayah'));
					$this->db->where('perusahaan',$this->session->userdata('perusahaan'));
					$this->db->where('id_produk',$row['id_produk']);
					$this->db->update('dk_produk',$data_item);
					
					$id_produk = $row['id_produk'];
					$sts = 'Add';
				}
				
				$data_beli = array(
									'id_produk'			=> $id_produk,
									'nama_produk'		=> $nm,
									'nomor_transaksi'	=> $id_transaksi,
									'nomor_invoice'		=> $post['nomor_invoice'],
									'qty'				=> str_replace(',','',$row['qty']),
									'harga_satuan'		=> str_replace(',','',$row['harga_satuan']),
									'total'				=> str_replace(',','',$row['total']),
									'user'				=> $this->session->userdata('pn_id'),
									'perusahaan'		=> $post['perusahaan'],
									'cabang'			=> $post['cabang'],
									'create_date'		=> date("Y-m-d H:i:s"),
									'deskripsi'			=> $row['deskripsi'],
									'satuan'			=> $row['satuan'],
									'sts_produk'		=> $sts,
								);
				$this->db->insert('dk_pembelian_produk_detail',$data_beli);
			}
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return $id_ref;
			}
		}
		
		public function save_pembayaran ($post){
			$this->db->trans_begin();
			
			if ($post['metode_pembayaran']=="cash"){
				$credit="1-1111";
				$debit=$post["debit"];
			} else {
				$credit=$post['tujuan_transfer'];
				$debit=$post["debit"];
			}
			
			$data = array(
						'id_customer' 			=> $post['id_customer'],
						'credit' 				=> $credit, 
						'metode_pembayaran'		=> $post['metode_pembayaran'],
						'tanggal_bayar'     	=> date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_bayar']))),
						'jumlah_bayar'      	=> str_replace(',','',$post['jumlah_bayar']),
						'referensi_pembayaran' 	=> $post['referensi_bayar'],
						'debit'                	=> $debit,
						'nm_debit'             	=> account_name($debit),
						'create_date'           => date('Y-m-d H:i:s'),
						'user'             		=> $this->session->userdata('pn_id'),
						'cabang'             	=> $this->session->userdata('pn_wilayah'),
						'perusahaan'            => $this->session->userdata('perusahaan'),
						'foto'             		=> '',
						'pesan'             	=> $post['deskripsi'],
						'tipe_bayar'            => $post['tipe_bayar'],
						'no_invoice'            => $post['no_invoice'],
						'nomor_transaksi'       => $post['nomor_transaksi'],
						'ref_transaksi'         => $post['ref_transaksi'],
						'nm_credit'             => account_name($credit),
					);
					
			$this->db->insert('dk_pembayaran',$data);
			$id = $this->db->insert_id('dk_pembayaran',$data);;
			
			
			$data = array(
						'tanggal'               => date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_bayar']))),
						'nomor_invoice'			=> $post['no_invoice'],
						'nomor_transaksi'		=> $post['nomor_transaksi'],
						'no_bukti'				=> $post['referensi_bayar'],
						'keterangan'			=> $post['deskripsi'],
						'no_akun_debit'			=> $debit,
						'nama_akun_debit'		=> account_name($debit),
						'no_akun_credit'		=> $credit,
						'nama_akun_credit'		=> account_name($credit),
						'jumlah_debit'			=> str_replace(',','',$post['jumlah_bayar']),
						'jumlah_credit'			=> str_replace(',','',$post['jumlah_bayar']),
						'user'					=> $this->session->userdata('pn_id'),
						'status'				=> 0,
						'no_ref'				=> $post['referensi_bayar'],
						'cabang'				=> $this->session->userdata('pn_wilayah'),
						'ppn'					=> str_replace(',','',$post['ppn']),
						'perusahaan'			=> $this->session->userdata('perusahaan'),
						'create_date'			=> date('Y-m-d H:i:s'),
			);
			
			$this->db->insert('dk_jurnal',$data);
			
			if(str_replace(',','',$post['jumlah_bayar']) >= str_replace(',','',$post['sisa_bayar'])){
				$this->db->where('nomor_transaksi', $post['nomor_transaksi']);
				$this->db->where('perusahaan', $this->session->userdata('perusahaan'));
				$this->db->update('dk_pembelian_produk', array('tipe_pembelian'=>0));
			}
			
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return $id;
			}
		}
		
		public function save_barang ($post){
			$this->db->trans_begin();
			
			foreach($post['data'] as $row){
				$data = array(
				
							'id_barang'             => $row['id_barang'],
							'nama_barang'			=> $row['nama_barang'],
							'qty'					=> str_replace(',','',$row['qty']),
							'deskripsi'    			=> $row['deskripsi'],
							'created'				=> date('Y-m-d H:i:s'),
							'user'					=> $this->session->userdata('pn_id'),
							'perusahaan'			=> $this->session->userdata('perusahaan'),
							'cabang'				=> $this->session->userdata('pn_wilayah'),
							'transaksi'				=> $post['transaksi'],
							'invoice'				=> $post['invoice'],
							'tanggal_masuk'			=> date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_masuk']))),
							
							
				);
				
				$this->db->insert('dk_stock_masuk',$data);
				$id = $this->db->insert_id();
				
				/* 
				- update stock_awal disini
				 */
				$this->db->query("update dk_produk set stock_awal = stock_awal+".str_replace(',','',$row['qty'])." where id_produk='".$row['id_barang']."' and cabang='".$this->session->userdata('pn_wilayah')."' and perusahaan='".$this->session->userdata('perusahaan')."'");
			}
			
			
			
			
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return 1;
			}
		}
		
		public function change_status($post2){
			//masukan ke jurnal sebagai account payment jika PO accepted
			if($post2['status'] == 2){
				$q 		= $this->db->query("select * from dk_pembelian_produk where id='".$post2['id']."'");
				if($q->num_rows() > 0){
					foreach($q->result() as $post){
						$data_jurnal = array(
										'tanggal'			=> date('Y-m-d',strtotime(str_replace('/','-',$post->tanggal_diterima))),
										'keterangan'		=> "Pembelian Produk",
										'nomor_transaksi'	=> $post->nomor_transaksi,
										'nomor_invoice'		=> $post->nomor_invoice,
										'no_akun_debit'		=> '5-1110',
										'nama_akun_debit'	=> account_name('5-1110'),
										'no_akun_credit'	=> '2-1110',
										'nama_akun_credit'	=> account_name('2-1110'),
										'jumlah_debit'		=> str_replace(',','',$post->total_bayar),
										'jumlah_credit'		=> str_replace(',','',$post->total_bayar),
										'user'				=> $this->session->userdata('pn_id'),
										'status'			=> 0,
										'cabang'			=> $this->session->userdata('pn_wilayah'),
										'perusahaan'		=> $this->session->userdata('perusahaan'),
										'create_date'		=> date("Y-m-d H:i:s")
									);
						$this->db->insert('dk_jurnal',$data_jurnal);
					}
					
				}else{
					$this->db->trans_rollback();
					return '-1';
				}
			}
			
			//ubah status di tabel pembelian
			$this->db->where('id', $post2['id']);
			$this->db->update('dk_pembelian_produk', array('tipe_pembelian'=>$post2['status'], 'nomor_invoice'=> $post2['nomor_invoice']));
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return $post2['id'];
			}
		}
		
		public function detail_transaksi($post=array()){
			$q 		= $this->db->query("select * from dk_pembelian_produk where id='".$post['id']."'");
			if($q->num_rows() > 0){
				return $q->result();
			}
						
		}
		
		public function detail_pembelian($post=array()){
			$q 		= $this->db->query("select a.* from dk_pembelian_produk_detail a left join dk_pembelian_produk b on a.nomor_transaksi=b.nomor_transaksi where b.id='".$post['id']."' and a.perusahaan='".$this->session->userdata('perusahaan')."'");
			if($q->num_rows() > 0){
				return $q->result();
			}
						
		}
		
		public function detail_pembayaran($post=array()){
			$q 		= $this->db->query("select a.tanggal_bayar, a.jumlah_bayar, a.nm_credit from dk_pembayaran a left join dk_pembelian_produk b on a.nomor_transaksi=b.nomor_transaksi where b.id='".$post['id']."' and a.perusahaan='".$this->session->userdata('perusahaan')."'");
			if($q->num_rows() > 0){
				return $q->result();
			}
						
		}
		
		public function detail_barang($post=array()){
			$q 		= $this->db->query("select a.* from dk_stock_masuk a left join dk_pembelian_produk b on a.transaksi=b.nomor_transaksi where b.id='".$post['id']."' and a.perusahaan='".$this->session->userdata('perusahaan')."'");
			if($q->num_rows() > 0){
				return $q->result();
			}
						
		}
	}