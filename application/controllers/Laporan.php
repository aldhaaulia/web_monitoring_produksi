<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
{

	private $sess_data_auth;

	function __construct()
	{
		parent::__construct();
		$this->sess_data_auth = $this->get_session('auth');
		$this->load->model('M_Laporan', 'm_laporan');
		$this->load->helper('url');
	}

	function index()
	{
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;

		$this->load->view('backend/v_laporan', $data);
	}
}
