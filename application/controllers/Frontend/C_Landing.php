<?php

/**
 *
 * Created at 2022-05-24 15:48:23
 * Updated at
 *
 */

class C_Landing extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Landing', 'm_landing');
	}

	function index()
	{
		$data = array();

		// $data['slider'] = $get_slider;
		// $data['setting'] = $get_settings;

		// print_r($data);exit;

		$this->load->view('Frontend/v_index', $data);
	}

	function get_proj()
	{
		$q = $this->input->post('proj_code');
		// $q = 'PROJ-2022001';
		$proj = $this->m_landing->searchProj($q);

		if (!empty($proj)) {
			$r['success'] = true;
			$r['data'] = $proj;
		} else {
			$r['success'] = false;
			$r['msg'] = 'Data Kosong';
		}


		die(json_encode($r));
	}

	function get_ProjDtl()
	{
		$id = $this->input->post('id');
		$proj = $this->m_landing->getProjectDtl($id);

		if (!empty($proj)) {
			$r['success'] = true;
			$r['data'] = $proj;
		} else {
			$r['success'] = false;
			$r['msg'] = 'Data Kosong';
		}

		die(json_encode($r));
	}

	function get_DtlById()
	{
		$id = $this->input->post('id');
		// $id = '1';
		$proj = $this->m_landing->getDtlById($id);

		if (!empty($proj)) {
			$r['success'] = true;
			$r['data'] = $proj;
		} else {
			$r['success'] = false;
			$r['msg'] = 'Data Kosong';
		}

		die(json_encode($r));
	}

	// end of class
}
