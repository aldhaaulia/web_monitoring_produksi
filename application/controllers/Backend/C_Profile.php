<?php

/**
 *
 * Created at 2022-05-30 14:10:39
 * Updated at
 *
 */

class C_Profile extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('M_Profile', 'm_profile');
	}


	function index() {
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;

		$sess_data = $this->get_session('auth');
		$id_akun  = $sess_data['id_akun'];
		$new_data = array();

		$data_profile = $this->get_user($id_akun);

		if ($data_profile['success']) {
			$new_data = $data_profile['data'];
		} else {
			$new_data = array(
				'nama' => '',
				'tempat_lahir' => '',
				'tgl_lahir' => '',
				'nik' => '',
				'alamat' => '',
				'email' => '',
				'no_telp' => '',
			);
		}

		$data['profile'] = $new_data;

		$this->load->view('backend/v_profile', $data);
	}

	function update() {
		$r = array();

		$sess_data = $this->get_session('auth');
		$id_akun  = $sess_data['id_akun'];

		$input_name = $this->input->post('input_name');
		$input_tempat_lahir = $this->input->post('input_tempat_lahir');
		$input_tanggal_lahir = $this->input->post('input_tanggal_lahir');
		$input_alamat = $this->input->post('input_alamat');
		$input_no_telp = $this->input->post('input_no_telp');
		$input_nik = $this->input->post('input_nik');

		$dataSave = array(
			'input_name' => $input_name,
			'input_tempat_lahir' => $input_tempat_lahir,
			'input_tanggal_lahir' => $input_tanggal_lahir,
			'input_alamat' => $input_alamat,
			'input_no_telp' => $input_no_telp,
			'input_nik' => $input_nik,
		);

		$save = $this->m_profile->update_profile($dataSave, $id_akun);

		$r['success'] = $save;

		if ($save) {

			$data_session = array(
				'nama' => $input_name,
			);

			$this->set_session('auth', $data_session);

			$r['msg'] = 'Profile berhasil diubah';
		} else {
			$r['msg'] = 'Profile gagal diubah';
		}
		die(json_encode($r));
	}

	// end of class
}
