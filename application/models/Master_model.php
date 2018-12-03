<?php 
	class Master_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function getList(){
			$perusahaan = $this->session->userdata("perusahaan");
			$query	= "select account_num, account_name, if(status='0','Used', 'Not Used') as status from dk_account where perusahaan='$perusahaan' order by account_num";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query;
			}else{
				return 0;
			}
		}
		
		public function getListKaryawan(){		
			$perusahaan = $this->session->userdata("perusahaan");
			$query	= "select pn_name, pn_id, pn_jabatan, pn_wilayah, alamat, foto, no_hp, email, if(pn_akses='1','Used', 'Not Used') as status from dk_user where perusahaan='$perusahaan' order by pn_name";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query;
			}else{
				return 0;
			}
		}
		
		public function getListPaket($param=null){		
			$where = "";
			if($param){
				$where = "where category = '$param'";
			}
			$query	= "select *, if(status='1','Used', 'Not Used') as status_paket from dk_produk $where order by nama_produk";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function getListPaketDetail($id=null){		
			$where = "";
			if($id){
				$where = "where id_produk = '$id'";
			}
			$query	= "select * from dk_produk_detail $where order by nama_produk";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_list_pembelian($id=null){		
			$where = "";
			if($id){
				$where = "where status = '$id'";
			}
			$query	= "select * from dk_pembelian_produk $where order by substr(nomor_transaksi,2)";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function add($data = array()){		
			$this->db->trans_begin();
			$perusahaan = $this->session->userdata("perusahaan");
			$data = array(
							'account_num'	=> str_replace(' ','',$data['account_num']),
							'account_name'	=> $data['account_name'],
							'status'		=> $data['status'],
							'create_date'	=> date("Y-m-d H:i:s"),
							'perusahaan'	=> $perusahaan,
						);
			$this->db->where('account_num',str_replace(' ','',$data['account_num']));
			$q = $this->db->get('dk_account');

			if ( $q->num_rows() > 0 ) 
			{
				return array('code'=>2,'data'=>null);
			}else{
				$id = $this->db->insert('dk_account', $data);
				$id_ref = $this->db->insert_id();
				
				$data2 = array(
							'account_num'	=> str_replace(' ','',$data['account_num']),
							'account_name'	=> $data['account_name'],
							'status'		=> $data['status'],
							'user'			=> $this->session->userdata("pn_id"),
							'periode'		=> date("Ym")."01",
							'saldo'			=> $data['saldo'],
							'create_date'	=> date("Y-m-d H:i:s"),
							'perusahaan'	=> $perusahaan,
						);
				$id = $this->db->insert('dk_saldo_awal', $data2);
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					return array('code'=>1,'data'=>null);
				}else{
					$this->db->trans_commit();
					return array('code'=>0,'data'=>$id_ref);
					
				}
			}
		}
		
		public function add_customer($data = array()){		
			$this->db->trans_begin();
			$data['saldo'] = str_replace(',','',$data['saldo']);
			$perusahaan = $this->session->userdata("perusahaan");
			$data['perusahaan'] = $perusahaan;
			$data['cabang'] = $this->session->userdata('pn_wilayah');
			$data['user'] = $this->session->userdata('pn_id');
			$data['create_date'] = date('Y-m-d H:i:s');
			$data['id_customer'] = $id_paket = counter('c_customer',$this->session->userdata('pn_wilayah'));
			$id = $this->db->insert('dk_customer', $data);
			$id_ref = $this->db->insert_id();
			add_counter('c_customer',$this->session->userdata('pn_wilayah'));
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return array('code'=>1,'data'=>null);
			}else{
				$this->db->trans_commit();
				return array('code'=>0,'data'=>$id_paket);
				
			}
		}
		
		public function update($data = array()){		
			$this->db->trans_begin();
			$id = $this->db->where('id_customer', $data['id_customer']);
			$id = $this->db->update('dk_account', $data);
			$id_ref = $this->db->insert_id();

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return $data['account_num'];
				
			}
		}
		
		public function update_customer($data = array()){
			$this->db->trans_begin();
			$data['saldo'] = str_replace(',','',$data['saldo']);
			$perusahaan = $this->session->userdata("perusahaan");
			$this->db->where('id_customer', $data['id_customer']);
			$this->db->where('perusahaan', $perusahaan);
			$this->db->update('dk_customer',$data);
			
			//echo $this->db->last_query();exit;

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return $data['id_customer'];
				
			}
		}
		
		public function delete_row($data = array()){		
			$this->db->trans_begin();
			$data2 = array('status' => 1);
			$this->db->where('account_num',$data['account_num']);
			$this->db->update('dk_account',$data2);

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return $data['account_num'];
				
			}
		}
		
		public function delete_customer($data = array()){		
			$this->db->trans_begin();
			$data2 = array('status' => 1);
			$this->db->where('id',$data['id_customer']);
			$this->db->update('dk_customer',$data2);

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return $data['id_customer'];
				
			}
		}
		
		public function search_item($search){
			$where = "";
			if(!empty($search)){
				$where = " and (UPPER(nama_item) like '%".strtoupper($search)."%' or id = '".$search."')";
			}
			$perusahaan = $this->session->userdata('perusahaan');
			$cabang = $this->session->userdata('pn_wilayah');
			$query 	= "select * from dk_stock where status = '0' and perusahaan='$perusahaan' and cabang='$cabang' $where order by nama_item limit 0,10";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function save($id = null){
			$this->db->trans_begin();
			$data1 = array(
						'id_produk'			=> ($id_paket = counter('c_paket',$this->session->userdata('pn_wilayah'))),
						'nama_produk'		=> $this->input->post('nm_paket'),
						'satuan'			=> $this->input->post('type_paket'),
						'harga'				=> str_replace(',','',$this->input->post('harga')),
						'status'			=> $this->input->post('sts'),
						'all_cabang'		=> $this->input->post('all_cab'),
						'deskripsi' 		=> $this->input->post('note'),
						'user' 				=> $this->session->userdata('pn_id'),
						'cabang' 			=> $this->session->userdata('pn_wilayah'),
						'perusahaan' 		=> $this->session->userdata('perusahaan'),
						'create_date' 		=> date("Y-m-d H:i:s"),
					);
			$this->db->insert('dk_produk',$data1);
			$id_ref = $this->db->insert_id();
			
			$transaksi = $this->input->post('transaksi');
			foreach($transaksi as $row){
				$nm_produk = explode(' - ',$row['nama_produk']);
				if(count($nm_produk) > 1){
					$nm = $nm_produk[1];
				}else{
					$nm = $row['nama_produk'];
				}
				$data = array(
					'nama_produk'		=> $nm,
					'id_item'			=> $row['id_produk'],
					'id_produk'			=> $id_paket,
					'deskripsi'			=> $row['deskripsi'],
					'type'				=> $row['type'],
					'jumlah_item'		=> $row['jumlah_item'],
					'harga'				=> str_replace(',','',$row['harga']),
					'user'				=> $this->session->userdata('pn_id'),
					'cabang'			=> $this->session->userdata('pn_wilayah'),
					'perusahaan' 		=> $this->session->userdata('perusahaan'),
					'create_date'		=> date('Y-m-d H:i:s'),
					'status'			=> 0,
				);
				$this->db->insert('dk_produk_detail',$data);
			}
			$id_cab = $this->session->userdata('pn_wilayah');
			add_counter('c_paket',$this->session->userdata('pn_wilayah'));
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return $id_ref;
			}
		}
		
		public function save_edit($id = null){
			$this->db->trans_begin();
			$data1 = array(
						'id_produk'			=> ($id_paket = $this->input->post('id_paket')),
						'nama_produk'		=> $this->input->post('nm_paket'),
						'satuan'			=> $this->input->post('type_paket'),
						'harga'				=> str_replace(',','',$this->input->post('harga')),
						'status'			=> $this->input->post('sts'),
						'all_cabang'		=> $this->input->post('all_cab'),
						'deskripsi' 		=> $this->input->post('note'),
						'user' 				=> $this->session->userdata('pn_id'),
						'cabang' 			=> $this->session->userdata('pn_wilayah'),
						'cabang' 			=> $this->session->userdata('pn_wilayah'),
						'perusahaan' 		=> $this->session->userdata('perusahaan'),
						'create_date' 		=> date("Y-m-d H:i:s"),
					);
			$this->db->where('id_produk',$id_paket);
			$this->db->update('dk_produk',$data1);
			
			$transaksi = $this->input->post('transaksi');
			
			$this->db->where('id_produk',$id_paket);
			$this->db->delete('dk_produk_detail');
			
			foreach($transaksi as $row){
				$nm_produk = explode(' - ',$row['nama_produk']);
				if(count($nm_produk) > 1){
					$nm = $nm_produk[1];
				}else{
					$nm = $row['nama_produk'];
				}
				$data = array(
					'nama_produk'		=> $nm,
					'id_item'			=> $row['id_produk'],
					'id_produk'			=> $id_paket,
					'deskripsi'			=> $row['deskripsi'],
					'type'				=> $row['type'],
					'jumlah_item'		=> $row['jumlah_item'],
					'harga'				=> str_replace(',','',$row['harga']),
					'user'				=> $this->session->userdata('pn_id'),
					'cabang'			=> $this->session->userdata('pn_wilayah'),
					'perusahaan' 		=> $this->session->userdata('perusahaan'),
					'create_date'		=> date('Y-m-d H:i:s'),
					'status'			=> 0,
				);
				$this->db->insert('dk_produk_detail',$data);
			}
			$id_cab = $this->session->userdata('pn_wilayah');
			add_counter('c_paket',$this->session->userdata('pn_wilayah'));
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return $id_paket;
			}
		}
	}
	
?>