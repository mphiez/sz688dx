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
			$date ="";
			if($range == "D"){
				$date = "and SUBSTR(a.tanggal_transaksi,1,10) = '".date("Y-m-d")."'";
			}else if($range == "W"){
				$time = date("Y-m-d",strtotime('monday this week'));
				$date = "and SUBSTR(a.tanggal_transaksi,1,10) <= '".date("Y-m-d")."' and SUBSTR(a.tanggal_transaksi,1,10) >= '".$time."'";
			}else if($range == "M"){
				$time = date("Y-m")."-01";
				$date = "and SUBSTR(a.tanggal_transaksi,1,10) <= '".date("Y-m-d")."' and SUBSTR(a.tanggal_transaksi,1,10) >= '".$time."'";
			}else if($range == "M2"){
				$time = date("Y-m-01",strtotime("-1 month",strtotime(date("Y-m-d"))));
				$date = "and SUBSTR(a.tanggal_transaksi,1,10) <= '".date("Y-m-d")."' and SUBSTR(a.tanggal_transaksi,1,10) >= '".$time."'";
			}else if($range == "M2"){
				$time = date("Y")."-01-01";
				$date = "and SUBSTR(a.tanggal_transaksi,1,10) <= '".date("Y-m-d")."' and SUBSTR(a.tanggal_transaksi,1,10) >= '".$time."'";
			}
			
			$sts = "";
			if($status != ''){
				if($status == 0){
					$sts = "and a.status='0'";
				}else if($status == 1){
					$sts = "and a.status='1'";
				}else if($status == 2){
					$sts = "and a.status='2'";
				}else if($status == 3){
					$sts = "and a.status='3'";
				}else if($status == 4){
					$sts = "and a.status='4'";
				}
			} 
			
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$admin = cek_admin();
			
			//tagihan dari definisi ini adalah sisa bayar
			//sisa tagihan
			$query 	= "SELECT
							*
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
						WHERE
							a.perusahaan = '".$this->session->userdata('perusahaan')."'
						AND a.cabang = '".$this->session->userdata('pn_wilayah')."' order by a.tanggal_diterima desc, id desc
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
		
		public function load_list_sum($range=null,$status=null){
			$date ="";
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
			}
			
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$admin = cek_admin();
			$query 	= "select status, count(*) as total from dk_transaksi where perusahaan='$perusahaan' $date $sts $admin group by status";
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
				
			if($post['metode_pembayaran'] == 'cash'){
				$account = '1-1111';
			}else if($post['metode_pembayaran'] == 'hutang'){
				$account = '2-1110';
			}else{
				$account = $post['tujuan_transfer'];
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
							'tipe_pembelian'				=> 1,
							'account_sales'					=> $account_sales,
							);
			
			$this->db->insert('dk_pembelian_produk',$data_prod);
			$id_ref = $this->db->insert_id();
			
			$data_jurnal = array(
							'tanggal'			=> date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_transaksi']))),
							'keterangan'		=> "Pembelian Produk",
							'nomor_transaksi'	=> $id_transaksi,
							'nomor_invoice'		=> $post['nomor_invoice'],
							'no_akun_debit'		=> $post['account_sales'],
							'nama_akun_debit'	=> account_name($post['account_sales']),
							'no_akun_credit'	=> '1-1111',
							'nama_akun_credit'	=> account_name('1-1111'),
							'jumlah_debit'		=> str_replace(',','',$post['total']),
							'jumlah_credit'		=> str_replace(',','',$post['total']),
							'user'				=> $this->session->userdata('pn_id'),
							'status'			=> 0,
							'cabang'			=> $this->session->userdata('pn_wilayah'),
							'perusahaan'		=> $this->session->userdata('perusahaan'),
							'create_date'		=> date("Y-m-d H:i:s")
						);
			$this->db->insert('dk_jurnal',$data_jurnal);
			
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
									'stock_awal'		=> str_replace(',','',$row['qty']),
									'stock_minimum'		=> str_replace(',','',$row['minimum']),
									'tanggal_diterima'	=> date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_transaksi']))),
									'account'			=> $account,
									'supplier'			=> $post['id_pelanggan'],
									'account_sales'		=> $account_sales,
									);
					$this->db->insert('dk_produk',$data_item);
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
					
					/* 
					- update stock_awal disini
					 */
					$this->db->query("update dk_produk set stock_awal = stock_awal+".str_replace(',','',$row['qty'])." where id_produk='".$row['id_produk']."' and cabang='".$this->session->userdata('pn_wilayah')."' and perusahaan='".$this->session->userdata('perusahaan')."'");
					
					$id_produk = $row['id_produk'];
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
	}