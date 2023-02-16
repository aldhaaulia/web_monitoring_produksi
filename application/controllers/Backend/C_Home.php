<?php

/**
 *
 * Created at 2022-05-25 10:57:05
 * Updated at
 *
 */

class C_Home extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Project', 'm_project');
	}

	// function index() {
	// 	$get_settings = $this->my_model->get_setting();
	// 	$data['setting'] = $get_settings;
	// 	$this->load->view('backend/v_admin', $data);
	// }

	function index()
	{
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;
		$data['project'] = $this->m_project->getAll();

		$this->load->view('backend/v_dashboard', $data);
	}

	// end of class
}
