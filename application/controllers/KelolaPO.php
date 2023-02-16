<?php

/**
 *
 * Created at 2022-05-30 14:20:53
 * Updated at
 *
 */

class KelolaPO extends MY_Controller
{

	private $sess_data_auth;

	function __construct()
	{
		parent::__construct();
		$this->sess_data_auth = $this->get_session('auth');
		$this->load->model('M_KelolaPO', 'm_kelolapo');
		$this->load->model('M_Cust', 'm_cust');
		$this->load->model('M_Project', 'm_project');
		$this->load->model('M_Jns_Brg', 'm_jns_brg');
	}


	function index()
	{
		$get_settings = $this->my_model->get_setting();
		$get_ProjId = $this->m_project->gen_ProjectId();
		$jns_brg = $this->m_jns_brg->getAll();
		$data['setting'] = $get_settings;
		$data['proj_id'] = $get_ProjId;
		$data['jns_brg'] = $jns_brg;


		$this->load->view('backend/v_kelolapo', $data);
	}

	function save()
	{
		$save = $this->m_kelolapo->save_multi();

		$r['success'] = $save;

		if ($save) {
			$r['msg'] = 'Data berhasil disimpan';
		} else {
			$r['msg'] = 'Data gagal disimpan';
		}
		die(json_encode($r));
	}

	// end of class
}
