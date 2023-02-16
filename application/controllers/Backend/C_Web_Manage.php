<?php

/**
 *
 * Created at 2022-06-08 12:18:27
 * Updated at
 *
 */

class C_Web_Manage extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_Web_Manage', 'm_web_manage');
	}

	function index() {
		redirect('login', 'refresh');
	}

	// Slider
	function slider() {
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;

		$this->load->view("backend/web_manage/frontend/v_slider", $data);
	}

	function slider_list() {
		$this->m_web_manage->slider_list();
	}

	function slider_getByid() {
		$id = $this->input->post('id');
		return $this->m_web_manage->slider_getByid($id);
	}

	function slider_save() {
		$tgl_now = date('Y-m-d H:i:s');

		$id = $this->input->post('input_id');
		$title = $this->input->post('input_title');
		$subtitle = $this->input->post('input_subtitle');
		$desc = $this->input->post('input_desc');

		$dataSave = array(
			'title' => $title,
			'subtitle' => $subtitle,
			'desc' => $desc,
		);

		if (!empty($id)) {
			$where = array('id' => $id);
			$dataSave['tgl_update'] = $tgl_now;
			$save = $this->m_web_manage->slider_update($dataSave, $where);
		} else {
			$dataSave['tgl_create'] = $tgl_now;
			$save = $this->m_web_manage->slider_add($dataSave);
		}

		$r['success'] = $save;

		if ($save) {
			$r['msg'] = 'Slider berhasil disimpan';
		} else {
			$r['msg'] = 'Slider gagal disimpan';
		}
		die(json_encode($r));
	}

	function slider_update() {
		$r = array();
		$dataSave = array();
		$tgl_now = date('Y-m-d H:i:s');

		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$dataSave = array(
			'is_active' => $status,
			'tgl_update' => $tgl_now,
		);

		$where = array('id' => $id);

		$save = $this->m_web_manage->slider_update($dataSave, $where);

		$r['success'] = $save;

		if ($save) {
			$r['msg'] = 'Slider berhasil diubah';
		} else {
			$r['msg'] = 'Slider gagal diubah';
		}
		die(json_encode($r));
	}

	// About
	function about() {
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;

		$this->load->view("backend/web_manage/frontend/v_about", $data);
	}

	function about_save() {
		$title = $this->input->post('input_title');
		$desc = $this->input->post('input_desc');

		$dataSave = array(
			'title' => $title,
			'desc' => $desc,
		);

		$save  = $this->m_web_manage->about_update($dataSave);

		$r['success'] = $save;

		if ($save) {
			$r['msg'] = 'About berhasil disimpan';
		} else {
			$r['msg'] = 'About gagal disimpan';
		}
		die(json_encode($r));
	}

	// Contact
	function contact() {
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;

		$this->load->view("backend/web_manage/frontend/v_contact", $data);
	}

	function contact_save() {
		$input_no_telp = $this->input->post('input_no_telp');
		$input_email = $this->input->post('input_email');
		$input_address = $this->input->post('input_address');

		$dataSave = array(
			'no_telp' => $input_no_telp,
			'email' => $input_email,
			'address' => $input_address,
		);

		$save  = $this->m_web_manage->contact_update($dataSave);

		$r['success'] = $save;

		if ($save) {
			$r['msg'] = 'Contact berhasil disimpan';
		} else {
			$r['msg'] = 'Contact gagal disimpan';
		}
		die(json_encode($r));
	}

	// Berkas
	function berkas() {
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;

		$this->load->view("backend/web_manage/backend/v_berkas", $data);
	}

	function berkas_save() {
		$input_review = $this->input->post('input_review');
		$input_approve = $this->input->post('input_approve');
		$input_reject = $this->input->post('input_reject');


		$dataSave = array(
			'review' => $input_review,
			'approve' => $input_approve,
			'reject' => $input_reject,
		);

		$save  = $this->m_web_manage->berkas_update($dataSave);

		$r['success'] = $save;

		if ($save) {
			$r['msg'] = 'Berkas berhasil disimpan';
		} else {
			$r['msg'] = 'Berkas gagal disimpan';
		}
		die(json_encode($r));
	}

	// Web
	function web() {
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;

		$this->load->view("backend/web_manage/backend/v_web", $data);
	}

	function web_save() {
		$input_school_name = $this->input->post('input_school_name');
		$input_school_desc = $this->input->post('input_school_desc');


		$dataSave = array(
			'name' => $input_school_name,
			'desc' => $input_school_desc,
		);

		$save  = $this->m_web_manage->web_update($dataSave);

		$r['success'] = $save;

		if ($save) {
			$r['msg'] = 'Web berhasil disimpan';
		} else {
			$r['msg'] = 'Web gagal disimpan';
		}
		die(json_encode($r));
	}

	// end of class
}
