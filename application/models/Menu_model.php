<?php 
	class Menu_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function m_get_menu_utama($pn_jabatan){
			$perusahaan = $this->session->userdata('perusahaan');
			$query 	= "select a.nm_menu,a.id_menu,a.url,a.img,a.urutan,a.jenis,b.r,b.d,b.u from dk_menu as a join dk_menu_akses as b on a.id_menu = b.id_menu where tampil = 'Y' and parent = '0' and jabatan='$pn_jabatan' and b.r='Y' and b.perusahaan='$perusahaan' ORDER BY urutan ASC";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		
		public function m_get_menu_utama_top($pn_jabatan){
			$perusahaan = $this->session->userdata('perusahaan');
			$query 	= "select a.nm_menu,a.id_menu,a.url,a.img,a.urutan,a.jenis,b.r,b.d,b.u from dk_menu as a join dk_menu_akses as b on a.id_menu = b.id_menu where tampil = 'Y' and parent = '0' and top='Y' and jabatan='$pn_jabatan' and perusahaan='$perusahaan' and b.r='Y' ORDER BY urutan ASC";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		
		public function m_get_menu_utama_list($pn_jabatan){
			$perusahaan = $this->session->userdata('perusahaan');
			$query 	= "select a.nm_menu,a.id_menu,a.url,a.img,a.urutan,a.jenis,b.r,b.d,b.u from dk_menu as a join dk_menu_akses as b on a.id_menu = b.id_menu where tampil = 'Y' and parent = '0' and a.id_menu != '1' and perusahaan='$perusahaan' and jabatan='$pn_jabatan' and b.r='Y' ORDER BY urutan ASC";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		
		public function m_get_submenu($pn_jabatan,$id_menu){
			$perusahaan = $this->session->userdata('perusahaan');
			$query 	= "select a.nm_menu,a.url,a.urutan,a.jenis,b.r,b.d,b.u from dk_menu as a join dk_menu_akses as b on a.id_menu = b.id_menu where tampil = 'Y' and parent = '$id_menu' and jabatan='$pn_jabatan' and b.perusahaan='$perusahaan' and b.r='Y' ORDER BY nm_menu ASC";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		
		public function m_get_menu($parent){
			$query 	= "SELECT *FROM dk_menu WHERE parent='$parent' AND tampil ='Y'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		public function cek_akses($id_menu,$pn_uid){
			$perusahaan = $this->session->userdata('perusahaan');
			$query 	= "SELECT r,u,d FROM dk_menu_akses WHERE id_user='$pn_uid' and perusahaan='$perusahaan' AND id_menu='$id_menu'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$ret 	= $q->row();
				$hasil  = $ret->r;
				return $hasil;
			}else{
				return Null;
			}
		}
		
		function get_daftar(){
			$query	= "select * from dk_menu where parent='0' order by urutan,nm_menu";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_urutan(){
			$query	= "select urutan from dk_menu where parent='0'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function sub_menu($id_menu){
			$query	= "select * from dk_menu where parent='$id_menu'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		//note jangan ada row yg hilang, nanti error. tidak boleh hapus record database menu
		function update_menu(){
			$tampil			= $this->input->post('tampil');
			$id_menu		= $this->input->post('id_menu');
			$nama_urut		= $this->input->post('nama_urut');
			for($i=1;$i<=count($nama_urut);$i++){
				$query	= "update dk_menu set urutan='".$nama_urut[$i]."' where id_menu='".$id_menu[$i]."'";
				$query 	= $this->db->query($query);
			}
			for($i=1;$i<=count($tampil);$i++){
				$query	= "update dk_menu set tampil='".$tampil[$i]."' where id_menu='".$i."'";
				$query 	= $this->db->query($query);
			}
		}
		
		function list_user(){
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select * from dk_user where perusahaan='$perusahaan'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function jabatan(){
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select * from dk_jabatan where sts='1' and perusahaan='$perusahaan'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function cabang(){
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select * from dk_cabang where sts='1' and perusahaan='$perusahaan'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_user($pn_id){
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select * from dk_user where pn_id = '$pn_id' and perusahaan='$perusahaan'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_wilayah($kd_wil){
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select nm_cabang from dk_cabang where id='$kd_wil' and perusahaan='$perusahaan'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->nm_cabang;
			}else{
				return 0;
			}
		}
		
		function get_jabatan($kd_jab){
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select nm_jabatan from dk_jabatan where id='$kd_jab' and perusahaan='$perusahaan'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->nm_jabatan;
			}else{
				return 0;
			}
		}
		
		function proses_edit(){
			$this->db->trans_begin();
			
			$pn_id			= $this->input->post('pn_id');
			$pn_uname		= $this->input->post('pn_uname');
			$pn_name		= $this->input->post('pn_name');
			$pn_pass		= $this->input->post('pn_pass');
			$pn_pass_new	= $this->input->post('pn_pass_new');
			$pn_jabatan		= $this->input->post('pn_jabatan');
			$pn_wilayah		= $this->input->post('pn_wilayah');
			$pn_akses		= $this->input->post('pn_akses');
			$marketing		= $this->input->post('marketing');
			if($pn_pass_new!=""){
				
			}
			
			$data	= array(
						'email'			=> $this->input->post('email'),
						'no_hp'			=> $this->input->post('hp'),
						'alamat'		=> $this->input->post('alamat'),
						'pn_name'		=> $pn_name,
						'pn_pass'		=> md5($pn_pass_new),
						'pn_jabatan'	=> $pn_jabatan,
						'pn_wilayah'	=> $pn_wilayah,
						'pn_akses'		=> $pn_akses,
						'sts_marketing'	=> $marketing,
						'update_date'	=> date("Y-m-d")
						);
			if($pn_pass_new == ""){
				unset($data["pn_pass"]);
			}
		
			$this->db->where('pn_id',$pn_id);
			$this->db->update('dk_user',$data);
			$data2 = array ('nosales'	=> $pn_id,
								'nama' 	=> $pn_name,
								'kategori' => $pn_jabatan
							);
			$this->db->where('nosales',$pn_id);
			$this->db->update('dk_master_salesman',$data2);
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return true;
			}
		}
		
		public function check_user($post = array()){
			$query	= "select pn_uname from dk_user where pn_uname='".$this->input->post('username')."'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		
		function proses_tambah(){
			$this->db->trans_begin();
			$pn_uname		= $this->input->post('pn_uname');
			$pn_name		= $this->input->post('pn_name');
			$pn_pass		= $this->input->post('pn_pass');
			$pn_jabatan		= $this->input->post('pn_jabatan');
			$pn_wilayah		= $this->input->post('pn_wilayah');
			$pn_akses		= $this->input->post('pn_akses');
			$marketing		= $this->input->post('marketing');
			$data	= array(
							'pn_id'			=> ($id = counter('c_user',$pn_wilayah)),
							'pn_uname'		=> $pn_uname,
							'pn_name'		=> $pn_name,
							'pn_pass'		=> md5($pn_pass),
							'pn_jabatan'	=> $pn_jabatan,
							'no_hp'			=> $this->input->post('hp'),
							'email'			=> $this->input->post('email'),
							'alamat'		=> $this->input->post('alamat'),
							'perusahaan'	=> $this->session->userdata('perusahaan'),
							'user'			=> $this->session->userdata('pn_id'),
							'pn_wilayah'	=> $pn_wilayah,
							'pn_akses'		=> $pn_akses,
							'sts_marketing'	=> $marketing,
							'insert_date'	=> date("Y-m-d")
						);
			$this->db->insert('dk_user',$data);
			add_counter('c_user',$pn_wilayah);
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return $id;
			}
		}
		
		function get_menu(){
			$query	= "select * from dk_menu";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_all_menu($id_jab,$id_menu=null){
			$mnu = "";
			if($id_menu){
				$mnu = " and b.id_menu='$id_menu'";
			}
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select b.*, a.nm_menu, a.url from dk_menu a left join dk_menu_akses b on a.id_menu = b.id_menu where b.jabatan='$id_jab' $mnu and b.perusahaan='$perusahaan'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_jabatan2($id_jab){
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select nm_jabatan from dk_jabatan where id='$id_jab' and perusahaan='$perusahaan'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				$res = $query->result();
				return $res[0]->nm_jabatan;
			}else{
				return 0;
			}
		}
		
		function get_mark($id_jab){
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select sts_marketing from dk_user where pn_id='$id_jab' and perusahaan='$perusahaan'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				$res = $query->result();
				return $res[0]->sts_marketing;
			}else{
				return 0;
			}
		}
		
		function proses_menu_akses(){
			$this->db->trans_begin();
			$data = $this->input->post();
			foreach($data['id_menu'] as $row){
				if(isset($data['r'][$row])){
					$r = "Y";
				}else{
					$r = "N";
				}
				
				if(isset($data['u'][$row])){
					$u = "Y";
				}else{
					$u = "N";
				}
				
				if(isset($data['d'][$row])){
					$d = "Y";
				}else{
					$d = "N";
				}
				
				$perusahaan = $this->session->userdata('perusahaan');
				$query	= "select * from dk_menu_akses where jabatan='".$data['jabatan']."' and perusahaan='$perusahaan' and id_menu='$row'";
				$query 	= $this->db->query($query);
				if($query->num_rows() > 0){
					$data2	= array(
							'jabatan'	=> $data['jabatan'],
							'id_menu'	=> $row,
							'perusahaan'	=> $perusahaan,
							'r'			=> $r,
							'u'			=> $u,
							'd'			=> $d
							);
					$this->db->where("id_menu",$row);
					$this->db->where("jabatan",$data['jabatan']);
					$this->db->where("perusahaan",$perusahaan);
					$this->db->update("dk_menu_akses",$data2);
				}else{
					$data3	= array(
							'jabatan'	=> $data['jabatan'],
							'id_menu'	=> $row,
							'perusahaan'	=> $perusahaan,
							'r'			=> $r,
							'u'			=> $u,
							'd'			=> $d
							);
					$this->db->insert("dk_menu_akses",$data3);
				}
				
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
		
		function proses_add_jab(){
			$sts_jab	= $this->input->post('sts_jab');
			$nm_jab		= $this->input->post('nm_jab');
			$q_user		= $this->db->query("select max(id) as id from dk_jabatan");
			$ret 		= $q_user->result();
			$id			= $ret[0]->id + 1;
			$data	= array(
							'id'			=> $id,
							'nm_jabatan'	=> $nm_jab,
							'perusahaan'	=> $this->session->userdata('perusahaan'),
							'sts'			=> $sts_jab
							);
			$this->db->insert("dk_jabatan",$data);
		}
		
		function proses_add_cab(){
			$sts_cab	= $this->input->post('sts_cab');
			$nm_cab		= $this->input->post('nm_cab');
			$perusahaan = $this->session->userdata('perusahaan');
			$q_user		= $this->db->query("select max(cabang) as id from dk_cabang where perusahaan='$perusahaan'");
			$ret 		= $q_user->result();
			$id			= $ret[0]->id + 1;
			$data	= array(
							'cabang'		=> $id,
							'nm_cabang'		=> $nm_cab,
							'perusahaan'	=> $this->session->userdata('perusahaan'),
							'sts'			=> $sts_cab
							);
			$this->db->insert("dk_cabang",$data);
			
			$data2	= array(
							'cabang'		=> $id,
							'perusahaan'	=> $this->session->userdata('perusahaan'),
							);
			$this->db->insert("dk_counter",$data2);
		}
		
		function proses_edit_cab(){
			$data	= array(
							'id'			=> $this->input->post('id_cab_edit'),
							'nm_cabang'		=> $this->input->post('nm_cab_edit'),
							'perusahaan'	=> $this->session->userdata('perusahaan'),
							'sts'			=> $this->input->post('sts_cab_edit')
							);
			$this->db->where("id",$this->input->post('id_cab_edit'));
			$this->db->update("dk_cabang",$data);
		}
		
		function m_get_menu_akses($pn_jabatan=null,$active=null,$sub_ac=null){
			$url = $active."/".$sub_ac;
			if(empty($sub_ac)){
				$url = $active;
			}
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select a.r from dk_menu b left join dk_menu_akses a on a.id_menu = b.id_menu where a.jabatan='$pn_jabatan' and b.url='$url' and a.perusahaan='$perusahaan'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->r;
			}else{
				return false;
			}
		}
		
		function check_akun(){
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select status_akun, verify_date from dk_company where id='$perusahaan'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0];
			}else{
				return 0;
			}
		}
		
		function m_get_account_name($account_num=null){
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select account_name from dk_account where account_num='$account_num' and perusahaan='$perusahaan'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->account_name;
			}else{
				return 0;
			}
		}
		
		function m_get_saldo_awal($account_num=null, $periode = null, $cabang=null){
			$where = "";
			if($periode){
				$where = "and periode = '".$periode."'";
			}
			$cabangs = "and cabang = '$cabang'";
			if($cabang == "all"){
				$cabangs = "";
			}
			$perusahaan = $this->session->userdata('perusahaan');
			$query	= "select sum(saldo) as saldo from dk_saldo_awal where account_num='$account_num' and perusahaan='$perusahaan' $where $cabangs";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->saldo;
			}else{
				return 0;
			}
		}
		
		function get_counter($x, $cab=null){
			$id_cab = $this->session->userdata('pn_wilayah');
			$id_per = $this->session->userdata('perusahaan');
			if($cab){
				$id_cab = $cab;
			}
			if($id_cab == 0){
				$query	= ("select $x,perusahaan, cabang from dk_counter where cabang='0' and perusahaan='$perusahaan' and perusahaan='$id_per'");
			}else{
				$query	= ("select $x,perusahaan, cabang from dk_counter where cabang='$id_cab' and perusahaan='$id_per'");
			}
			return $query 	= $this->db->query($query);
			
		}
		
		function add_counter($x, $cab=null){
			$id_cab = $this->session->userdata('pn_wilayah');
			$id_per = $this->session->userdata('perusahaan');
			if($cab){
				$id_cab = $cab;
			}
			$query	= ("update dk_counter set $x=$x + 1 where cabang='$id_cab' and perusahaan='$id_per'");
		
			
			$query 	= $this->db->query($query);			
		}
		
		function cek_admin(){
			$id_jab = $this->session->userdata('pn_jabatan');
			$query	= "select nm_jabatan from dk_jabatan where id='$id_jab'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				$ret[0]->id = $this->session->userdata('pn_wilayah');
				return $ret[0];
			}else{
				return $this->session->userdata('pn_wilayah');
			}
		}
	}