<?php

/**
 *
 * Created at 2022-06-02 12:08:16
 * Updated at
 *
 */

class M_Profile extends CI_Model {
	private $table = 'tm_profile';
	private $table_akun = 'tm_akun';

	function __construct() {
		parent::__construct();
	}


	function update_profile($dataPost, $id_akun) {
		// Update ke table profile dan akun
		$is_success = false;
		$where = array(
			'id_akun' => $id_akun
		);

		$dataSave1 = array(
			'nama_profile' => $dataPost['input_name'],
			'tempat_lahir' => $dataPost['input_tempat_lahir'],
			'tgl_lahir' => $dataPost['input_tanggal_lahir'],
			'alamat' => $dataPost['input_alamat'],
			'no_telp' => $dataPost['input_no_telp'],
		);
		if (isset($dataPost['input_nik'])) {
			$dataSave1['nik_profile'] = $dataPost['input_nik'];
		}

		$dataSave2 = array(
			'nama' => $dataPost['input_name'],
		);

		$this->db->trans_begin();

		$this->db->update($this->table, $dataSave1, $where);
		$this->db->update($this->table_akun, $dataSave2, $where);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$is_success = false;
		} else {
			$this->db->trans_commit();
			$is_success = true;
		}
		return $is_success;
	}

	// end of class
}
