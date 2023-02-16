<?php

/**
 *
 * Created at 2022-05-30 11:24:14
 * Updated at
 *
 */

class M_Register extends CI_Model {
	private $table = 'tm_akun';
	private $table_profile = 'tm_profile';

	function __construct() {
		parent::__construct();
	}

	function register_save() {
		//TODO ADD Save Data to tm_profile

		$tgl_now = date('Y-m-d H:i:s');
		$save = false;

		$nama = $this->input->post('full_name');
		// $nik = $this->input->post('nik');
		$email = $this->input->post('email');
		$password = $this->input->post('pass');
		$password_confirm = $this->input->post('pass_confirm');

		if ($password != $password_confirm) {
			$r = array('success' => false, 'msg' => 'Password tidak sama dengan password konfirmasi');
			die(json_encode($r));
		}

		$password_enc = md5($password);

		$role_int = 3;

		$dataSave1 = array(
			'nama' => $nama,
			'role' => $role_int,
			// 'nik' => $nik,
			'email' => $email,
			'password' => $password_enc,
			'tgl_create' => $tgl_now,
		);

		$dataSave2 = array(
			'id_akun' => $nama,
			'nama_profile' => $nama,
			'email_profile' => $email,
			'tgl_create' => $tgl_now,
		);


		$check_email = $this->check_email($email);

		if ($check_email) {
			$r = array('success' => false, 'msg' => 'Email sudah digunakan');
			die(json_encode($r));
		}

		// $check_nik = $this->check_nik($nik);

		// if ($check_nik) {
		// 	$r = array('success' => false, 'msg' => 'NIK sudah digunakan');
		// 	die(json_encode($r));
		// }

		$this->db->trans_begin();

		$save1 = $this->db->insert($this->table, $dataSave1);

		if ($save1) {
			$id_akun = $this->db->insert_id();
			$dataSave2['id_akun'] = $id_akun;

			$this->db->insert($this->table_profile, $dataSave2);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$save = false;
			} else {
				$this->db->trans_commit();
				$save = true;
			}
		}

		if ($save) {
			$r = array('success' => true, 'msg' => 'Register Berhasil');
		} else {
			$r = array('success' => false, 'msg' => 'Register Gagal');
		}
		die(json_encode($r));
	}

	function update($id) {
		// NOTE not used yet
		$tgl_now = date('Y-m-d H:i:s');

		$nama = $this->input->post('nama');
		// $nik = $this->input->post('nik');
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));

		$role_int = 3;

		$dataSave = array(
			'nama' => $nama,
			'role' => $role_int,
			// 'nik' => $nik,
			'email' => $email,
			'tgl_update' => $tgl_now,
		);


		/* $check_email = $this->check_email($email);

		if ($check_email) {
			$r = array('success' => false, 'msg' => 'Email sudah digunakan');
			die(json_encode($r));
		}

		$check_nik = $this->check_nik($nik);

		if ($check_nik) {
			$r = array('success' => false, 'msg' => 'NIK sudah digunakan');
			die(json_encode($r));
		} */

		$where = array('id_akun' => $id);

		$save = $this->db->update($this->table, $dataSave, $where);

		if ($save) {
			$r = array('success' => true, 'msg' => 'Register Berhasil');
		} else {
			$r = array('success' => false, 'msg' => 'Register Gagal');
		}
		die(json_encode($r));
	}

	function check_email($email) {
		$result = false;

		$this->db->select('id_akun');
		$this->db->from($this->table);
		$this->db->where('email', $email);

		$get = $this->db->get();

		if ($get) {
			$data = $get->result_array();
			if (!empty($data)) {
				$result = true;
			}
		}

		return $result;
	}

	function check_nik($nik) {
		$result = false;

		$this->db->select('id_akun');
		$this->db->from($this->table);
		$this->db->where('nik', $nik);

		$get = $this->db->get();

		if ($get) {
			$data = $get->result_array();
			if (!empty($data)) {
				$result = true;
			}
		}

		return $result;
	}


	// end of class
}
