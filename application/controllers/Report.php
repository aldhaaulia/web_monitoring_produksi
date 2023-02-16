<?php

/**
 *
 * Created at 2022-05-25 10:57:05
 * Updated at
 *
 */

class Dashboard extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('M_Report', 'm_report');
		$this->load->model('M_Cust', 'm_cust');
		$this->load->model('M_Project', 'm_project');
	}

	function index()
	{
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;
		$data['project'] = $this->m_project->getAll();

		$this->load->view('backend/v_report', $data);
	}

	// end of class
}