<?php

/**
 *
 * Created at 2022-05-30 11:13:27
 * Updated at
 *
 */

class C_Register extends CI_Controller {
	private $path_upload_file = './assets/Backend/uploads/';
	function __construct() {
		parent::__construct();
		$this->load->model('Auth/M_Register', 'm_register');
	}


	function index() {
		$this->load->view('auth/v_register');
	}

	function proses_register() {

		return $this->m_register->register_save();
	}

	function unduh($file) {

		if ($file == 'biodata') {
			$file_biodata = $this->path_upload_file . 'biodata/index.html';
			force_download($file_biodata, NULL);
		}
	}

	// end of class
}
