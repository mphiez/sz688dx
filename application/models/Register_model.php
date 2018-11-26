<?php 
	class Register_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function save($post = array(),$gen=null){
			$this->db->trans_begin();
			$data1 = array(
						'nama_perusahaan'	=> $post->company,
						'fullname'			=> $post->fullname,
						'email'				=> $post->email,
						'alamat'			=> $post->address,
						'username' 			=> $post->username,
						'status' 			=> 1,
						'register_code' 	=> $gen,
						'status_akun'		=> '1',
						'verify_date'		=> date("Y-m-d H:i:s"),
						'create_date' 		=> date("Y-m-d H:i:s"),
					);
			$this->db->insert('dk_company',$data1);
			$id_ref = $this->db->insert_id();
			
			$data2 = array(
							'nm_jabatan'	=> 'Admin',
							'sts'			=> '1',
							'perusahaan'	=> $id_ref,
						);
			
			$this->db->insert('dk_jabatan',$data2);
			$id_jab = $this->db->insert_id();
			
			$data3 = array(
							'nm_cabang'		=> $post->address,
							'sts'			=> '1',
							'perusahaan'	=> $id_ref,
							'cabang'		=> 1,
						);
			$this->db->insert('dk_cabang',$data3);
			$id_cab = $this->db->insert_id();
			
			$data4 = array(
							'cabang'		=> 1,
							'perusahaan'	=> $id_ref,
						);
			$this->db->insert('dk_counter',$data4);

			$data5 = array(
							'pn_id'			=> "1".date("ymdHis"),
							'pn_uname'		=> $post->username,
							'pn_name'		=> $post->fullname,
							'pn_pass'		=> md5($post->password),
							'pn_jabatan'	=> $id_jab,
							'pn_akses'		=> '1',
							'pn_wilayah'	=> 1,
							'insert_date'	=> date("Y-m-d H:i:s"),
							'alamat'		=> $post->address,
							'email'			=> $post->email,
							'perusahaan'	=> $id_ref,
						);
			$this->db->insert('dk_user',$data5);
			
			$query2	= "select *, $id_jab as jabatan, $id_ref as perusahaan from dk_menu_akses_master";
			$query2	= $this->db->query($query2);
			if($query2->num_rows() > 0){
				$res2 = $query2->result();
				foreach($res2 as $row){
					$data = array(
									'jabatan'		=> $row->jabatan,
									'perusahaan'	=> $row->perusahaan,
									'id_menu'		=> $row->id_menu,
									'r'				=> $row->r,
									'u'				=> $row->u,
									'd'				=> $row->d,
								);
					$this->db->insert('dk_menu_akses',$data);
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
		
		public function check_user($post = array()){
			$query	= "select pn_uname from dk_user where pn_uname='".$post->username."'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		
		public function check_email($post = array()){
			$query	= "select email from dk_user where email='".$post->email."'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		
		public function verify($post = array()){
			// pas register
			//1. create jabatan (admin) untuk pt itu
			//2. cabang 0 untuk cabang (pusat)
			//3. counter
			//4. create user admin -> register (status non aktif) -> verify (status aktif)
			// pas verify
			//5. create menu akses
			//6. create akun
			// pas awal ngebuka halaman
			//7. saldo awal
			
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select a.id as perusahaan, b.id as jabatan  from dk_company as a left join dk_jabatan as b on a.id = b.perusahaan where a.register_code = '".$post['reg_code']."' and a.status='1'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				$this->db->trans_begin();
				
				$res = $query->result();
				$perusahaan = $res[0]->perusahaan;
				$jabatan =  $res[0]->jabatan;
				
				$data = array(
								'r'				=> 'Y',
								'u'				=> 'Y',
								'd'				=> 'Y',
							);
				$this->db->where('jabatan',$jabatan);
				$this->db->where('perusahaan',$perusahaan);
				$this->db->update('dk_menu_akses',$data);
				
				$datareg = array(
								'status_akun'	=> '1',
								'verify_date'	=> date("Y-m-d H:i:s")
							);
				
				$this->db->where('id',$perusahaan);
				$this->db->update('dk_company',$datareg);
				
				$query2	= "select *, $jabatan as jabatan, $perusahaan as perusahaan from dk_account_master";
				$query2	= $this->db->query($query2);
				if($query2->num_rows() > 0){
					$res2 = $query2->result();
					foreach($res2 as $row){
						$data = array(
										'account_num'	=> $row->account_num,
										'account_name'	=> $row->account_name,
										'status'		=> $row->status,
										'account_type'	=> $row->account_type,
										'create_date'	=> date("Y-m-d H:i:s"),
										'perusahaan'	=> $row->perusahaan,
									);
						$this->db->insert('dk_account',$data);
					}
				}
				$query 	= $this->db->query("update dk_company set status='0' where register_code = '".$post['reg_code']."' and status='1'");
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					return false;
				}else{
					$this->db->trans_commit();
					return true;
				}
			}else{
				return false;
			}
			
		}
	}