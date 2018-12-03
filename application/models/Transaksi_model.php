<?php 
	class Transaksi_model extends CI_Model{
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
		
		public function user($search=null, $id=null, $cabang=null){
			$where = "";
			$limit = "";
			if(!empty($search)){
				$where = " and (upper(nama_customer) like '%".strtoupper($search)."%' or id_customer like '%".$search."%')";
				$limit = " limit 0,10";
			}
			if(isset($id)){
				$where = " and id='$id'";
			}
			$cabang_2= "";
			if(isset($cabang) && $cabang != 'all'){
				$cabang_2= " and cabang='$cabang'";
			}else if(isset($cabang) && $cabang == 'all'){
				$cabang_2= "";
			}else{
				$cabang = $this->session->userdata('pn_wilayah');
				$cabang_2= " and cabang='$cabang'";
			}
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "select * from dk_customer where perusahaan='$perusahaan'$cabang_2 $where order by nama_customer $limit";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function search_produk($search){
			$where = "";
			$limit = "";
			if(!empty($search)){
				$where = " and (upper(nama_produk) like '%".strtoupper($search)."%' or id_produk like '%".$search."%')";
				$limit = "limit 0,10";
			}
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "select * from dk_produk where status = '1' and perusahaan='$perusahaan' and (cabang='$cabang' || all_cabang='Y') $where order by nama_produk $limit";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function search_invoice($search=null){
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$where = "";
			if($search){
				$where = "and upper(a.nomor_invoice) like '%".strtoupper($search)."%'";
			}
			$query 	= "
			SELECT
				a.*, a.jumlah_bayar - sum(if(a.nomor_transaksi = b.nomor_transaksi, b.jumlah_bayar,0)) as tagihan
			FROM
				dk_transaksi a
			left join dk_pembayaran b on a.nomor_transaksi = b.nomor_transaksi
			where a.perusahaan='$perusahaan' and a.cabang='$cabang' and a.status='1' $where 
			GROUP BY a.nomor_transaksi order by SUBSTR(a.nomor_invoice,4) *1 limit 0,10";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function search_transaksi($search=null){
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$where = "";
			if($search){
				$where = "and upper(a.nomor_transaksi) like '%".strtoupper($search)."%'";
			}
			$query 	= "
			SELECT
				a.*, a.jumlah_bayar - sum(if(a.nomor_transaksi = b.nomor_transaksi, b.jumlah_bayar,0)) as tagihan
			FROM
				dk_transaksi a
			left join dk_pembayaran b on a.nomor_transaksi = b.nomor_transaksi
			where a.perusahaan='$perusahaan' and a.cabang='$cabang' and a.status='1' $where 
			GROUP BY a.nomor_transaksi order by SUBSTR(a.nomor_invoice,4) *1 limit 0,10";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function account_list($pembiayaan=false){
			$where ="";
			if($pembiayaan){
				$where =" and (account_num like '2%' || account_num like '5%' || account_num like '6%' || account_num like '7%' || account_num like '8%')";
			}
			
			$perusahaan = $this->session->userdata('perusahaan');
			$query 	= "select account_num, account_name from dk_account where status = '0' and perusahaan = '$perusahaan' $where";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
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
			$query 	= "
			SELECT
				a.*, md5(a.id) as id_inv, md5(a.id_pelanggan) as id_pelanggan_dec, a.jumlah_bayar - sum(if(a.nomor_transaksi = b.nomor_transaksi, b.jumlah_bayar,0)) as tagihan
			FROM
				dk_transaksi a
			left join dk_pembayaran b on a.nomor_transaksi = b.nomor_transaksi
			where a.perusahaan='$perusahaan' and a.cabang='$cabang' $date $sts $admin
			GROUP BY a.nomor_transaksi order by SUBSTR(a.tanggal_transaksi,2) *1
			";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
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
		
		public function detail_transaksi($id = null){
			$query 	= "select * from dk_transaksi_detail where id_ref = '$id' order by tanggal_transaksi desc";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function bank_list($id = null){
			$where = "";
			if(!empty($id)){
				$where = " and account_num = '$id'";
			}
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "select * from dk_account where account_type='Current Assets' $where";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function data_invoice_pelanggan($id = null){
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "SELECT
				a.*, a.jumlah_bayar - sum(if(a.nomor_transaksi = b.nomor_transaksi, b.jumlah_bayar,0)) as tagihan
			FROM
				dk_transaksi a
			left join dk_pembayaran b on a.nomor_transaksi = b.nomor_transaksi
			where a.perusahaan='$perusahaan' and a.cabang='$cabang' and a.status='1' 
			GROUP BY a.nomor_transaksi order by SUBSTR(a.nomor_invoice,4) *1";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function save($id = null){
			$this->db->trans_begin();
			//0 penjulan langsung / lunas -> print
			//1 invoice -> bayar
			//2 sales order estimate (accepted) -> create invoice
			//3 sales order estimate (pending)  -> waiting
			
			if($this->input->post('nomor_transaksi') == ''){
				$nomor_transaksi = counter('c_sales');
			}else{
				$nomor_transaksi = $this->input->post('nomor_transaksi');
				
			}
			
			$query 	= "select nomor_transaksi from dk_transaksi where perusahaan='".$this->session->userdata('perusahaan')."' and cabang ='".$this->session->userdata('pn_wilayah')."' and nomor_transaksi = '".$nomor_transaksi."'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return '-1';
			}else{
				$inv_no = "";
				$tipe_transaksi = $this->input->post('tipe_transaksi');
				if($tipe_transaksi == 0){
					$tgl_inv = date("Y-m-d");
					$sts = 0;
				}else if($tipe_transaksi == 1){
					$tgl_inv = date("Y-m-d", strtotime(str_replace('/','-',$this->input->post('tanggal_invoice'))));
					$sts = 1;
					$inv_no = counter('c_inv');
					add_counter('c_inv');
				}else if($tipe_transaksi == 2){
					$tgl_inv = "";
					$sts = 3;
				}
				
				$nm_pelanggan = $this->input->post('nama_pelanggan');
				if($nm_pelanggan != ''){
					$nm = explode(' - ',$nm_pelanggan);
					if(count($nm) > 1){
						$nm_pelanggan = $nm[1];
					}
				}
				add_counter('c_sales');
				
				$data1 = array(
							'discount'			=> str_replace(',','',$this->input->post('discount')),
							'nama_pelanggan'	=> $nm_pelanggan,
							'id_pelanggan'		=> $this->input->post('id_pelanggan'),
							'email'				=> $this->input->post('email_pelanggan'),
							'no_ref'			=> $this->input->post('no_referensi'),
							'alamat_tagih'		=> $this->input->post('alamat_penagihan'),
							'nomor_transaksi'	=> $nomor_transaksi,
							'metode_pembayaran' => $this->input->post('metode_pembayaran'),
							'user'				=> $this->session->userdata('pn_id'),
							'cabang'			=> $this->session->userdata('pn_wilayah'),
							'perusahaan'		=> $this->session->userdata('perusahaan'),
							'akun_tujuan'		=> $this->input->post('tujuan'),
							'nomor_faktur'		=> $this->input->post('nomor_faktur'),
							'pesan'				=> $this->input->post('pesan'),
							'top'				=> $this->input->post('top'),
							'tanggal_invoice'	=> $tgl_inv,
							'nomor_invoice'		=> $inv_no,
							'tanggal_transaksi'	=> $tgl_transaksi = date('Y-m-d H:i:s'),
							'status'			=> $sts,
						);
				$this->db->insert('dk_transaksi',$data1);
				$id_ref = $this->db->insert_id();
				
				
				$transaksi = $this->input->post('transaksi');
				$sub = 0;
				$ppn = 0;
				$item = 0;
				foreach($transaksi as $row){
					$nm_produk = explode(' - ',$row['nama_produk']);
					$data = array(
						'nama_produk'		=> $nm_produk[1],
						'id_produk'			=> $row['id_produk'],
						'deskripsi'			=> $row['deskripsi'],
						'kuantitas'			=> $row['kuantitas'],
						'satuan'			=> $row['satuan'],
						'harga_satuan'		=> $row['harga_satuan_dec'],
						'pajak'				=> round(($row['pajak']/100)*$row['kuantitas']*$row['harga_satuan_dec']),
						'jumlah'			=> $row['jumlah_dec'],
						'id_ref'			=> $id_ref,
						'user'				=> $this->session->userdata('pn_id'),
						'cabang'			=> $this->session->userdata('pn_wilayah'),
						'perusahaan'		=> $this->session->userdata('perusahaan'),
						'tanggal_transaksi'	=> $tgl_transaksi,
						'status'			=> 0,
					);
					$sub += $row['jumlah_dec'];
					$ppn += $row['pajak'];
					$item++;
					$this->db->insert('dk_transaksi_detail',$data);
				}
				
				$data2 = array(
							'jumlah_bayar' => ($jumlah_bayar = $sub-(str_replace(',','',$this->input->post('discount')))),
							'jumlah_item' => $item,
							'jumlah_pajak' => $ppn,
							'sub_total' => $sub,
						);
				$this->db->where('id',$id_ref);
				$this->db->update('dk_transaksi',$data2);
				
				
				if($tipe_transaksi != 2 || $tipe_transaksi != 3){
				
					$data1['deskripsi'] 	= $this->input->post('deskripsi_termin');
					$data1['nomor_termin'] 	= $this->input->post('termin_ke');
					$data1['jumlah_bayar'] 	= str_replace(',','',$this->input->post('jumlah_termin'));
					$data1['create_date'] = date('Y-m-d H:i:s');
					$this->db->insert('dk_invoice',$data1);
					
					$ak_cred = '4-1110';//revenue - penjualan
					$ak_deb = '1-1111';//kas
					
					if($this->input->post('tujuan') != ''){
						$ak_deb = $this->input->post('tujuan');
					}
					
					if($tipe_transaksi == 1){
						$ak_cred = '4-1110';//revenue - penjualan
						$ak_deb = '1-1320';//piutang usaha - penjualan
					}
					
					$debit = array(
									'no_akun_debit'		=> $ak_deb,
									'nama_akun_debit'	=> account_name($ak_deb),
									'no_akun_credit'	=> $ak_cred,
									'nama_akun_credit'	=> account_name($ak_cred),
									'tanggal'			=> date('Y-m-d H:i:s'),
									'no_bukti'			=> $nomor_transaksi,
									'keterangan'		=> 'Penjualan',
									'type'				=> 'Debit',
									'jumlah_debit'		=> $jumlah_bayar,
									'jumlah_credit'		=> $jumlah_bayar,
									'user'				=> $this->session->userdata('pn_id'),
									'cabang'			=> $this->session->userdata('pn_wilayah'),
									'perusahaan'		=> $this->session->userdata('perusahaan'),
									'create_date'		=> date("Y-m-d H:i:s"),
									'status'			=> 0,
									'no_ref'			=> $id_ref,
								);
					$this->db->insert('dk_jurnal',$debit);
				}
				
				if($tipe_transaksi == 0){
					$data = array(
									'jumlah_bayar'			=> $jumlah_bayar,
									'id_customer'			=> $this->input->post('id_pelanggan'),
									'ref_transaksi'			=> $id_ref,
									'metode_pembayaran'		=> 'Cash',
									'tanggal_bayar'			=> date('Y-m-d'),
									'referensi_pembayaran'	=> $this->input->post('no_referensi'),
									'nomor_transaksi'		=> $nomor_transaksi,
									'debit'					=> $ak_deb,
									'nm_debit'				=> account_name($ak_deb),
									'credit'				=> $ak_cred,
									'nm_credit'				=> account_name($ak_cred),
									'create_date'			=> date("Y-m-d H:i:s"),
									'user'					=> $this->session->userdata('pn_id'),
									'cabang'				=> $this->session->userdata('pn_wilayah'),
									'perusahaan'			=> $this->session->userdata('perusahaan'),
								);
					$this->db->insert('dk_pembayaran',$data);
				}
			
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
		
		public function save_invoice_preview($id = null){
			$this->db->trans_begin();
			//0 penjulan langsung / lunas -> print
			//1 invoice -> bayar
			//2 sales order estimate (accepted) -> create invoice
			//3 sales order estimate (pending)  -> waiting
			
			if($this->input->post('nomor_transaksi') == ''){
				$nomor_transaksi = counter('c_sales');
			}else{
				$nomor_transaksi = $this->input->post('nomor_transaksi');
				
			}
			
			$query 	= "select nomor_transaksi from dk_transaksi_preview where perusahaan='".$this->session->userdata('perusahaan')."' and cabang ='".$this->session->userdata('pn_wilayah')."' and nomor_transaksi = '".$nomor_transaksi."'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return '-1';
			}else{
				$inv_no = "";
				$tipe_transaksi = $this->input->post('tipe_transaksi');
				if($tipe_transaksi == 0){
					$tgl_inv = date("Y-m-d");
					$sts = 0;
				}else if($tipe_transaksi == 1){
					$tgl_inv = date("Y-m-d", strtotime(str_replace('/','-',$this->input->post('tanggal_invoice'))));
					$sts = 1;
					$inv_no = counter('c_inv');
				}else if($tipe_transaksi == 2){
					$tgl_inv = "";
					$sts = 3;
				}
				
				$nm_pelanggan = $this->input->post('nama_pelanggan');
				if($nm_pelanggan != ''){
					$nm = explode(' - ',$nm_pelanggan);
					if(count($nm) > 1){
						$nm_pelanggan = $nm[1];
					}
				}
				
				$data1 = array(
							'discount'			=> str_replace(',','',$this->input->post('discount')),
							'nama_pelanggan'	=> $nm_pelanggan,
							'id_pelanggan'		=> $this->input->post('id_pelanggan'),
							'email'				=> $this->input->post('email_pelanggan'),
							'no_ref'			=> $this->input->post('no_referensi'),
							'alamat_tagih'		=> $this->input->post('alamat_penagihan'),
							'nomor_transaksi'	=> $nomor_transaksi,
							'metode_pembayaran' => $this->input->post('metode_pembayaran'),
							'user'				=> $this->session->userdata('pn_id'),
							'cabang'			=> $this->session->userdata('pn_wilayah'),
							'perusahaan'		=> $this->session->userdata('perusahaan'),
							'akun_tujuan'		=> $this->input->post('tujuan'),
							'nomor_faktur'		=> $this->input->post('nomor_faktur'),
							'pesan'				=> $this->input->post('pesan'),
							'top'				=> $this->input->post('top'),
							'tanggal_invoice'	=> $tgl_inv,
							'nomor_invoice'		=> $inv_no,
							'tanggal_transaksi'	=> $tgl_transaksi = date('Y-m-d H:i:s'),
							'status'			=> $sts,
						);
				$this->db->insert('dk_transaksi_preview',$data1);
				$id_ref = $this->db->insert_id();
				
				$transaksi = $this->input->post('transaksi');
				$sub = 0;
				$ppn = 0;
				$item = 0;
				foreach($transaksi as $row){
					$nm_produk = explode(' - ',$row['nama_produk']);
					$data = array(
						'nama_produk'		=> $nm_produk[1],
						'id_produk'			=> $row['id_produk'],
						'deskripsi'			=> $row['deskripsi'],
						'kuantitas'			=> $row['kuantitas'],
						'satuan'			=> $row['satuan'],
						'harga_satuan'		=> $row['harga_satuan_dec'],
						'pajak'				=> round(($row['pajak']/100)*$row['kuantitas']*$row['harga_satuan_dec']),
						'jumlah'			=> $row['jumlah_dec'],
						'id_ref'			=> $id_ref,
						'user'				=> $this->session->userdata('pn_id'),
						'cabang'			=> $this->session->userdata('pn_wilayah'),
						'perusahaan'		=> $this->session->userdata('perusahaan'),
						'tanggal_transaksi'	=> $tgl_transaksi,
						'status'			=> 0,
					);
					$sub += $row['jumlah_dec'];
					$ppn += $row['pajak'];
					$item++;
					$this->db->insert('dk_transaksi_detail_preview',$data);
				}
				
				$data2 = array(
							'jumlah_bayar' => ($jumlah_bayar = $sub-(str_replace(',','',$this->input->post('discount')))),
							'jumlah_item' => $item,
							'jumlah_pajak' => $ppn,
							'sub_total' => $sub,
						);
				$this->db->where('id',$id_ref);
				$this->db->update('dk_transaksi_preview',$data2);
				
				
				if($tipe_transaksi != 2 || $tipe_transaksi != 3){
					
					$data1['deskripsi'] 	= $this->input->post('deskripsi_termin');
					$data1['nomor_termin'] 	= $this->input->post('termin_ke');
					$data1['jumlah_bayar'] 	= str_replace(',','',$this->input->post('jumlah_termin'));
					$data1['create_date'] = date('Y-m-d H:i:s');
					$this->db->insert('dk_invoice_preview',$data1);
				}
			
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
		
		function save_bayar(){
			$this->db->trans_begin();
			$transaksi = $this->input->post('transaksi');
			$id_temp="";
			
			foreach($transaksi as $row){
				if($this->input->post('metode_pembayaran') == 'cash'){
					$row['nm_debit'] = '1-1111';
				}
				
				$perusahaan = $this->session->userdata('perusahaan');
				$cabang = $this->session->userdata('pn_wilayah');
				$query 	= "
				SELECT
					a.jumlah_bayar - sum(if(a.nomor_transaksi = b.nomor_transaksi, b.jumlah_bayar,0)) as tagihan
				FROM
					dk_transaksi a
				left join dk_pembayaran b on a.nomor_transaksi = b.nomor_transaksi
				where a.perusahaan='$perusahaan' and a.cabang='$cabang' and a.status='1' and a.nomor_transaksi = '".$row['nomor_transaksi']."' 
				GROUP BY a.nomor_transaksi order by SUBSTR(a.nomor_invoice,4) *1";
				$q 		= $this->db->query($query);
				if($q->num_rows() > 0){
					$ret = $q->result();
					if(str_replace(',','',$row['bayar']) >= $ret[0]->tagihan){
						$this->db->query("update dk_transaksi set status='0' where nomor_transaksi='".$row['nomor_transaksi']."' and perusahaan='".$this->session->userdata('perusahaan')."' and cabang ='".$this->session->userdata('pn_wilayah')."'");
					}
				}else{
					$this->db->query("update dk_transaksi set status='0' where nomor_transaksi='".$row['nomor_transaksi']."' and perusahaan='".$this->session->userdata('perusahaan')."' and cabang ='".$this->session->userdata('pn_wilayah')."' and jumlah_bayar <= '".str_replace(',','',$row['bayar'])."'"); 
				}
				
				
				$data = array(
								'pesan'					=> $this->input->post('pesan'),
								'jumlah_bayar'			=> str_replace(',','',$row['bayar']),
								'id_customer'			=> $row['id_customer'],
								'ref_transaksi'			=> "",
								'metode_pembayaran'		=> $this->input->post('metode_pembayaran'),
								'tanggal_bayar'			=> date("Y-m-d",strtotime(str_replace('/','-',$this->input->post('tanggal_bayar')))),
								'referensi_pembayaran'	=> $row['referensi_pembayaran'],
								'nomor_transaksi'		=> $row['nomor_transaksi'],
								'debit'					=> $row['nm_debit'],
								'nm_debit'				=> account_name($row['nm_debit']),
								'credit'				=> '1-1320',
								'nm_credit'				=> account_name('1-1320'),
								'create_date'			=> date("Y-m-d H:i:s"),
								'user'					=> $this->session->userdata('pn_id'),
								'cabang'				=> $this->session->userdata('pn_wilayah'),
								'perusahaan'			=> $this->session->userdata('perusahaan'),
							);
				$this->db->insert('dk_pembayaran',$data);
				$id = $this->db->insert_id();
				$id_temp .= $id."%";
				
				$debit = array(
								'no_akun_debit'		=> $row['nm_debit'],
								'nama_akun_debit'	=> account_name($row['nm_debit']),
								'no_akun_credit'	=> '1-1320',
								'nama_akun_credit'	=> account_name('1-1320'),
								'tanggal'			=> date('Y-m-d H:i:s'),
								'no_bukti'			=> $row['nomor_transaksi'],
								'keterangan'		=> 'Penjualan',
								'type'				=> 'Debit',
								'jumlah_debit'		=> str_replace(',','',$row['bayar']),
								'jumlah_credit'		=> str_replace(',','',$row['bayar']),
								'user'				=> $this->session->userdata('pn_id'),
								'cabang'			=> $this->session->userdata('pn_wilayah'),
								'perusahaan'		=> $this->session->userdata('perusahaan'),
								'create_date'		=> date("Y-m-d H:i:s"),
								'status'			=> 0,
								'no_ref'			=> $row['referensi_pembayaran'],
							);
				$this->db->insert('dk_jurnal',$debit);
			}
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return array('name'=>date("ymdHis")."_".$row['nomor_transaksi'],'id'=>$id_temp);
			}
		}
		
		
		public function save_invoice($id = null){
			$this->db->trans_begin();
			//0 penjulan langsung / lunas -> print
			//1 invoice -> bayar
			//2 sales order estimate (accepted) -> create invoice
			//3 sales order estimate (pending)  -> waiting
			$inv_no = "";
			$tipe_transaksi = $this->input->post('tipe_transaksi');
			if($tipe_transaksi == 0){
				$tgl_inv = date("Y-m-d");
				$sts = 0;
			}else if($tipe_transaksi == 1){
				$tgl_inv = date("Y-m-d", strtotime(str_replace('/','-',$this->input->post('tanggal_invoice'))));
				$sts = 1;
				$inv_no = counter('c_inv');
				add_counter('c_inv');
			}else if($tipe_transaksi == 2){
				$tgl_inv = "";
				$sts = 3;
			}
			
			$nm_pelanggan = $this->input->post('nama_pelanggan');
			if($nm_pelanggan != ''){
				$nm = explode(' - ',$nm_pelanggan);
				if(count($nm) > 1){
					$nm_pelanggan = $nm[1];
				}
			}
			
			$data1 = array(
						'discount'			=> str_replace(',','',$this->input->post('discount')),
						'nama_pelanggan'	=> $nm_pelanggan,
						'email'				=> $this->input->post('email_pelanggan'),
						'no_ref'			=> $this->input->post('no_referensi'),
						'alamat_tagih'		=> $this->input->post('alamat_penagihan'),
						'metode_pembayaran' => $this->input->post('metode_pembayaran'),
						'user'				=> $this->session->userdata('pn_id'),
						'cabang'			=> $this->session->userdata('pn_wilayah'),
						'perusahaan'		=> $this->session->userdata('perusahaan'),
						'akun_tujuan'		=> $this->input->post('tujuan'),
						'nomor_faktur'		=> $this->input->post('nomor_faktur'),
						'pesan'				=> $this->input->post('pesan'),
						'top'				=> $this->input->post('top'),
						'tanggal_invoice'	=> $tgl_inv,
						'nomor_invoice'		=> $inv_no,
						'status'			=> $sts,
					);
			$this->db->where('id',$this->input->post('id_transaksi'));
			$this->db->update('dk_transaksi',$data1);
			$id_ref = $this->input->post('id_transaksi');
			
					
			$data1['deskripsi'] 	= $this->input->post('deskripsi_termin');
			$data1['nomor_termin'] 	= $this->input->post('termin_ke');
			$data1['jumlah_bayar'] 	= $this->input->post('jumlah_termin');
			$data1['create_date'] 	= date('Y-m-d H:i:s');
			$this->db->insert('dk_invoice',$data1);
			
			
			$transaksi = $this->input->post('transaksi');
			$sub = 0;
			$ppn = 0;
			$item = 0;
			$this->db->query("delete from dk_transaksi_detail where id_ref='".$id_ref."'");
			foreach($transaksi as $row){
				$nm_produk = explode(' - ',$row['nama_produk']);
				$data = array(
					'nama_produk'		=> $nm_produk[1],
					'id_produk'			=> $row['id_produk'],
					'deskripsi'			=> $row['deskripsi'],
					'kuantitas'			=> $row['kuantitas'],
					'satuan'			=> $row['satuan'],
					'harga_satuan'		=> $row['harga_satuan_dec'],
					'pajak'				=> round(($row['pajak']/100)*$row['kuantitas']*$row['harga_satuan_dec']),
					'jumlah'			=> $row['jumlah_dec'],
					'id_ref'			=> $id_ref,
					'user'				=> $this->session->userdata('pn_id'),
					'cabang'			=> $this->session->userdata('pn_wilayah'),
					'perusahaan'		=> $this->session->userdata('perusahaan'),
					'tanggal_transaksi'	=> date('Y-m-d H:i:s'),
					'status'			=> 0,
				);
				$sub += $row['jumlah_dec'];
				$ppn += $row['pajak'];
				$item++;
				$this->db->insert('dk_transaksi_detail',$data);
			}
			
			$data2 = array(
						'jumlah_bayar' => ($jumlah_bayar = $sub-(str_replace(',','',$this->input->post('discount')))),
						'jumlah_item' => $item,
						'jumlah_pajak' => $ppn,
						'sub_total' => $sub,
					);
			$this->db->where('id',$id_ref);
			$this->db->update('dk_transaksi',$data2);
			
			
			if($tipe_transaksi != 2 || $tipe_transaksi != 3){
			
				$invoice = $this->input->post('tanggal_invoice');
				
				$ak_cred = '4-1110';//revenue - penjualan
				$ak_deb = '1-1111';//kas
				
				if($this->input->post('tujuan') != ''){
					$ak_deb = $this->input->post('tujuan');
				}
				
				if($tipe_transaksi == 1){
					$ak_cred = '4-1110';//revenue - penjualan
					$ak_deb = '1-1320';//piutang usaha - penjualan
				}
				
				$debit = array(
								'no_akun_debit'		=> $ak_deb,
								'nama_akun_debit'	=> account_name($ak_deb),
								'no_akun_credit'	=> $ak_cred,
								'nama_akun_credit'	=> account_name($ak_cred),
								'tanggal'			=> date('Y-m-d H:i:s'),
								'no_bukti'			=> $this->input->post('nomor_transaksi'),
								'keterangan'		=> 'Penjualan',
								'type'				=> 'Debit',
								'jumlah_debit'		=> $jumlah_bayar,
								'jumlah_credit'		=> $jumlah_bayar,
								'user'				=> $this->session->userdata('pn_id'),
								'cabang'			=> $this->session->userdata('pn_wilayah'),
								'perusahaan'		=> $this->session->userdata('perusahaan'),
								'create_date'		=> date("Y-m-d H:i:s"),
								'status'			=> 0,
								'no_ref'			=> $id_ref,
							);
				$this->db->insert('dk_jurnal',$debit);
			}
			
			if($tipe_transaksi == 0){
				$data = array(
								'id_customer'			=> $this->input->post('id_pelanggan'),
								'ref_transaksi'			=> $id_ref,
								'metode_pembayaran'		=> 'Cash',
								'tanggal_bayar'			=> date('Y-m-d'),
								'referensi_pembayaran'	=> $this->input->post('no_referensi'),
								'debit'					=> $ak_deb,
								'nm_debit'				=> account_name($ak_deb),
								'credit'				=> $ak_cred,
								'nm_credit'				=> account_name($ak_cred),
								'create_date'			=> date("Y-m-d H:i:s"),
								'user'					=> $this->session->userdata('pn_id'),
								'cabang'				=> $this->session->userdata('pn_wilayah'),
								'perusahaan'			=> $this->session->userdata('perusahaan'),
							);
				$this->db->insert('dk_pembayaran',$data);
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
		
		public function save_id_lampiran($name=null,$id=null){
			$this->db->trans_begin();
			$this->db->where('id',$id);
			$this->db->update('dk_transaksi',array('lampiran'=>$name));
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return $id;
			}
		}
		
		public function save_bukti_bayar($name=null,$id=null){
			$this->db->trans_begin();
			$id = explode('%',$id);
			foreach($id as $row){
				if($row != ''){
					$this->db->where('id',$row);
					$this->db->update('dk_pembayaran',array('foto'=>$name));
				}
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
		
		public function save_jurnal($name=null,$id=null){
			$this->db->trans_begin();
			
			$transaksi = $this->input->post('transaksi');
			foreach($transaksi as $row){
				$debit = array(
								'no_akun_debit'			=> $row['akun_debet'],
								'nama_akun_debit'		=> account_name($row['akun_debet']),
								'no_akun_credit'		=> $row['akun_kredit'],
								'nama_akun_credit'		=> account_name($row['akun_kredit']),
								'tanggal'				=> date("Y-m-d H:i:s",strtotime(str_replace('/','-',$row['tanggal']))),
								'no_bukti'				=> $row['no_bukti'],
								'create_date'			=> date("Y-m-d H:i:s"),
								'keterangan'			=> $row['deskripsi'],
								'jumlah_debit'			=> str_replace(',','',$row['debet']),
								'jumlah_credit'			=> str_replace(',','',$row['kredit']),
								'user'					=> $this->session->userdata('pn_id'),
								'cabang'				=> $this->session->userdata('pn_wilayah'),
								'perusahaan'			=> $this->session->userdata('perusahaan'),
								'create_date'			=> date("Y-m-d H:i:s"),
								'status'				=> 0,
							);
				$this->db->insert('dk_jurnal',$debit);
			}
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return true;
			}
		}
		
		public function dataInvoice($id=null,$sv=null,$preview="", $no_termin=null,$mode=null){
			$prev = "";
			if($preview == 'yes'){
				$prev = "_preview";
			}
			$query 	= "select a.id as id_transaksi, a.email as email_pelanggan,a.*, b.*, c.*, d.logo, d.nama_perusahaan, d.nomor_telfon telfon_perusahaan, d.email as email_perusahaan, d.no_fax fax_perusahaan, d.alamat alamat_perusahaan, d.fullname, d.no_bank1, d.no_bank2, d.atasnama_bank1, d.atasnama_bank2, d.bank1, d.bank2 from dk_transaksi".$prev." as a right join dk_transaksi_detail".$prev." as b on a.id = b.id_ref left join dk_customer c on a.id_pelanggan = id_customer left join dk_company d on a.perusahaan = d.id where md5(a.id) = '$id' and a.id_pelanggan != ''";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				
				$ret = $q->result();
				if($mode == null){
					$row = $ret[0];
					
					$q_inv = $this->db->query("select * from dk_invoice".$prev." where nomor_termin='$no_termin' and nomor_transaksi='".$row->nomor_transaksi."' and perusahaan='".$this->session->userdata('perusahaan')."' and cabang='".$this->session->userdata('pn_wilayah')."'");
					$ret[0]->detail = array();
					if($q_inv->num_rows() > 0){
						$ret[0]->detail = $q_inv->result();
					}
				}
				return $ret;
			}else{
				return 0;
			}
		}
		
		public function dataTermin($id){
			$query 	= "select a.id as id_transaksi, a.email as email_pelanggan,a.*, b.*, c.*, d.logo, d.nama_perusahaan, d.nomor_telfon telfon_perusahaan, d.email as email_perusahaan, d.no_fax fax_perusahaan, d.alamat alamat_perusahaan, d.fullname, d.no_bank1, d.no_bank2, d.atasnama_bank1, d.atasnama_bank2, d.bank1, d.bank2 from dk_transaksi as a right join dk_transaksi_detail as b on a.id = b.id_ref left join dk_customer c on a.id_pelanggan = id_customer left join dk_company d on a.perusahaan = d.id where md5(a.id) = '$id' and a.id_pelanggan != ''";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function item_type(){
			$query 	= "select * from dk_tipe_item where perusahaan='".$this->session->userdata('perusahaan')."'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function save_tipe_item($post=array()){
			$this->db->trans_begin();
			$post['perusahaan'] = $this->session->userdata('perusahaan');
			$this->db->insert('dk_tipe_item',$post);
			$id_ref = $this->db->insert_id();
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return $id_ref;
			}
		}
		
		public function load_supplier($post){
			$where = "";
			$query 	= "select id, nama from dk_supplier where perusahaan='".$this->session->userdata('perusahaan')."' $where order by nama";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function save_supplier($post=array()){
			$this->db->trans_begin();
			$post['perusahaan'] = $this->session->userdata('perusahaan');
			$post['user'] = $this->session->userdata('pn_id');
			$post['create_date'] = date("Y-m-d H:i:s");
			$this->db->insert('dk_supplier',$post);
			$id_ref = $this->db->insert_id();
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return $id_ref;
			}
		}
		
		public function account_name($post){
			$where = "";
			$query 	= "select id, account_type, account_num, account_name from dk_account where perusahaan='".$this->session->userdata('perusahaan')."' and account_type='Income' order by account_name";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function save_account($post=array()){
			$this->db->trans_begin();
			$post['perusahaan'] = $this->session->userdata('perusahaan');
			$post['user'] = $this->session->userdata('pn_id');
			$post['create_date'] = date("Y-m-d H:i:s");
			
			$query 	= "select account_num from dk_account where perusahaan='".$this->session->userdata('perusahaan')."' and account_num='".$post['account_num']."' and account_name='".$post['account_name']."' order by account_name";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->insert('dk_account',$post);
				$id_ref = $this->db->insert_id();
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
		
		public function account_name_sales($post){
			$where = "";
			$query 	= "select id, account_type, account_num, account_name from dk_account where perusahaan='".$this->session->userdata('perusahaan')."' and account_type='Cost of Sales' order by account_name";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function save_account_sales($post=array()){
			$this->db->trans_begin();
			$post['perusahaan'] = $this->session->userdata('perusahaan');
			$post['user'] = $this->session->userdata('pn_id');
			$post['create_date'] = date("Y-m-d H:i:s");
			
			$query 	= "select account_num from dk_account where perusahaan='".$this->session->userdata('perusahaan')."' and account_num='".$post['account_num']."' and account_name='".$post['account_name']."' order by account_name";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->insert('dk_account',$post);
				$id_ref = $this->db->insert_id();
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
		
		public function save_produk($post=array()){
			$this->db->trans_begin();
			if($post['category'] == 1){
				
			}
			$post['perusahaan'] = $this->session->userdata('perusahaan');
			$post['cabang'] = $this->session->userdata('pn_wilayah');
			$post['user'] = $this->session->userdata('pn_id');
			$post['create_date'] = date("Y-m-d H:i:s");
			$paket_produk = '';
			if(isset($post['paket_produk'])){
				$paket_produk = $post['paket_produk'];
			}
			unset($post['paket_produk']);
			$post['harga_jual'] = str_replace(',','',$post['harga_jual']);
			$post['harga_beli'] = str_replace(',','',$post['harga_beli']);
			$post['stock_awal'] = str_replace(',','',$post['stock_awal']);
			$post['stock_minimum'] = str_replace(',','',$post['stock_minimum']);
			$post['tanggal_diterima'] = date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_diterima'])));
			$post['id_produk'] = counter('c_paket');
			$this->db->insert('dk_produk',$post);
			$id_ref = $this->db->insert_id();
			
			if(empty($paket_produk)){
				$data = array(
							'tanggal'			=> date('Y-m-d',strtotime(str_replace('/','-',$post['tanggal_diterima']))),
							'keterangan'		=> "Pembelian Produk",
							'no_akun_debit'		=> $post['account_sales'],
							'nama_akun_debit'	=>  account_name($post['account_sales']),
							'no_akun_credit'	=>  account_name('1-1111'),
							'nama_akun_credit'	=> '1-1111',
							'jumlah_debit'		=> $post['harga_beli'] * $post['stock_awal'],
							'jumlah_credit'		=> $post['harga_beli'] * $post['stock_awal'],
							'user'				=> $this->session->userdata('pn_id'),
							'status'			=> 0,
							'cabang'			=> $this->session->userdata('pn_wilayah'),
							'perusahaan'		=> $this->session->userdata('perusahaan'),
							'create_date'		=> date("Y-m-d H:i:s")
						);
				$this->db->insert('dk_jurnal',$data);
			}
			
			if($paket_produk != ''){
				foreach($paket_produk as $row){
					$data = array(
									'id_produk' => $row,
									'id_paket' => $id_ref,
									'user' => $this->session->userdata('pn_id'),
									'create_date' => date("Y-m-d H:i:s"),
									'status' => 0,
									'perusahaan' => $this->session->userdata('perusahaan')
								);
					$this->db->insert('dk_produk_detail',$data);
				}
			}
			add_counter('c_paket');
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return $post['id_produk'];
			}
		}
		
		public function save_foto($name=null,$id=null){
			$this->db->trans_begin();
			$this->db->where('id_produk',$id);
			$this->db->update('dk_produk',array('foto'=>$name));
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return $id;
			}
		}
		
		public function change_status($post=array()){
			$this->db->trans_begin();
			$this->db->where('id',$post['id']);
			$this->db->update('dk_transaksi',array('status'=>$post['status'],'jumlah_termin'=>$post['jumlah_termin']));
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				
				return true;
			}
		}
		
		public function detail_transaksi_header($post=array()){
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "select a.id, a.nama_pelanggan, a.id_pelanggan, a.tanggal_transaksi, a.jumlah_bayar, a.status, a.nomor_invoice, a.pesan, a.lampiran from dk_transaksi a where a.id = '".$post['id']."' and a.perusahaan='$perusahaan'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$ret = $q->result();
				return $ret[0];
			}else{
				return 0;
			}
		}
		
		public function detail_transaksi_pembayaran($id){
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "select b.tanggal_bayar, b.referensi_pembayaran, b.metode_pembayaran, b.nm_debit, b.debit from dk_pembayaran b where b.ref_transaksi = '$id' and b.perusahaan='$perusahaan'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function createInvoice($id){
				
			$perusahaan = $this->session->userdata('perusahaan');
			$query 	= "select * from dk_transaksi where md5(id) = '$id' and perusahaan='$perusahaan' and status ='2'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$ret =  $q->result();
				foreach($ret as $row){
					$inv_no = counter('c_inv');
					add_counter('c_inv');
					
					$query 	= "update dk_transaksi set nomor_invoice = '".$inv_no."', top='2', status='1', tanggal_invoice='".date("Y-m-d")."' where md5(id) = '$id' and perusahaan='$perusahaan'";
					$q 		= $this->db->query($query);
				
					$ak_cred = '4-1110';//revenue - penjualan
					$ak_deb = '1-1320';//piutang usaha - penjualan
					
					$debit = array(
									'no_akun_debit'		=> $ak_deb,
									'nama_akun_debit'	=> account_name($ak_deb),
									'no_akun_credit'	=> $ak_cred,
									'nama_akun_credit'	=> account_name($ak_cred),
									'tanggal'			=> date('Y-m-d H:i:s'),
									'no_bukti'			=> $row->no_ref,
									'keterangan'		=> 'Penjualan',
									'jumlah_debit'		=> $row->jumlah_bayar,
									'jumlah_credit'		=> $row->jumlah_bayar,
									'user'				=> $this->session->userdata('pn_id'),
									'cabang'			=> $this->session->userdata('pn_wilayah'),
									'perusahaan'		=> $this->session->userdata('perusahaan'),
									'create_date'		=> date("Y-m-d H:i:s"),
									'status'			=> 0,
									'no_ref'			=> $row->id,
								);
					$this->db->insert('dk_jurnal',$debit);
				}
				
				
			}else{
				return 0;
			}
		}
		
		function load_invoice($id){
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "
			SELECT
				a.*, a.jumlah_bayar - sum(if(a.nomor_transaksi = b.nomor_transaksi, b.jumlah_bayar,0)) as tagihan
			FROM
				dk_transaksi a
			left join dk_pembayaran b on a.nomor_transaksi = b.nomor_transaksi
			where a.perusahaan='$perusahaan' and a.cabang='$cabang' and a.status='1' and md5(a.id_pelanggan) = '$id' 
			GROUP BY a.nomor_transaksi order by SUBSTR(a.nomor_invoice,4) *1";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
	}