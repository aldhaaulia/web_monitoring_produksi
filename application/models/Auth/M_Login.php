<?php

/**
 *
 * Created at 2022-05-30 15:19:34
 * Updated at
 *
 */

class M_Login extends CI_Model
{

	private $table = 'tm_akun';
	// private $table_profile = 'tm_profile';

	function __construct()
	{
		parent::__construct();
	}

	function proses_login()
	{
		$res_success = false;
		$res_msg = '';

		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));


		// $this->db->select('a.id_akun, b.id_profile, a.nama, a.role, b.nik_profile as nik, a.email, a.user_dir');
		$this->db->select('a.id_akun, a.nama, a.role, a.email, a.user_dir');
		$this->db->from($this->table . ' as a');
		// $this->db->join($this->table_profile . ' as b', 'b.id_akun = a.id_akun', 'inner');
		$this->db->where('a.email', $email);
		$this->db->where('a.password', $password);
		$this->db->where('a.is_active', '1');
		$this->db->limit(1);

		$get = $this->db->get();

		if ($get) {
			$data = $get->result_array();
			if (!empty($data)) {
				$res_success = true;
				$sess_data = array();

				$temp_data = $data[0];
				$sess_data = $temp_data;

				$id_akun = $temp_data['id_akun'];
				$nama_akun = $temp_data['nama'];
				$user_dir = $temp_data['user_dir'];

				if (empty($user_dir)) {
					$user_dir = $this->update_userDir($id_akun, $nama_akun);
					$sess_data['user_dir'] = $user_dir;
				}


				$sess_data['is_login'] = true;

				$this->session->set_userdata('auth', $sess_data);

				$res_msg = 'Berhasil Login';
			} else {
				$res_msg = 'User tidak ditemukan';
			}
		} else {
			$res_msg = 'Error Database!';
		}

		$r = array('success' => $res_success, 'msg' => $res_msg);

		die(json_encode($r));
	}


	function update_userDir($id_user, $namauser)
	{
		$digits = 3;
		$num = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
		$user_dir = 'dir_' . $num . substr(md5($namauser), 0, 12);
		$this->update_user_dir($id_user, $user_dir);
		return $user_dir;
	}

	function update_user_dir($id, $dat)
	{
		$tgl_now = date('Y-m-d H:i:s');

		$assets_path = "assets/Backend";
		$upload_path = "uploads";

		$dir_assets_upload = $assets_path . '/' . $upload_path;
		$dir_assets_upload_ = $dir_assets_upload . "/";

		if (!file_exists($assets_path)) {
			@mkdir($assets_path, 0777);
			@chmod($assets_path, 0777);
		}

		if (!file_exists($dir_assets_upload)) {
			@mkdir($dir_assets_upload, 0777);
			@chmod($dir_assets_upload, 0777);
		}

		if (!file_exists($dir_assets_upload_ . $dat)) {
			@mkdir($dir_assets_upload_ . $dat, 0777);
			@chmod($dir_assets_upload_ . $dat, 0777);
		}

		$ourFileName = $dir_assets_upload_ . $dat . "/index.html";

		@$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
		@fclose($ourFileHandle);


		$dataUpdate = array(
			'user_dir' => $dat,
			'tgl_update' => $tgl_now,
		);

		$where = array(
			'id_akun' => $id
		);

		$this->db->update($this->table, $dataUpdate, $where);
	}

	// end of class
}
