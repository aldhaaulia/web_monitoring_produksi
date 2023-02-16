<?php

/**
 *
 * Created at 2022-06-02 13:40:20
 * Updated at
 *
 */

class C_Monitoring extends MY_Controller {
	private $sess_data_auth;

	function __construct() {
		parent::__construct();
		$this->load->model('M_Monitoring', 'm_monitoring');
		$this->sess_data_auth = $this->get_session('auth');
	}

	function index() {
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;

		$id_akun  = $this->sess_data_auth['id_akun'];
		$id_profile  = $this->sess_data_auth['id_profile'];
		$id_role  = $this->sess_data_auth['role'];

		$new_data = array();

		if ($id_role == 3) {
			// jika siswa

			$cek_submitted = $this->m_berkas->check_isSubmitted($id_profile);
			$is_show_download_button = false;

			if ($cek_submitted['success']) {
				// form view berkas
				$temp_data = $cek_submitted['data'];
				$id_verifikasi = $temp_data['id_verifikasi'];
				$status_verifikasi = $temp_data['status_verifikasi'];
				$no_registrasi = $temp_data['no_registrasi'];
				$status_verifikasi_txt = '';

				if ($status_verifikasi == 1) {
					// review
					$status_verifikasi_txt = 'Berkas sedang di verifikasi';
				} else if ($status_verifikasi == 2) {
					// approve
					$status_verifikasi_txt = 'Berkas sudah di verifikasi';
					$is_show_download_button = true;
				} else if ($status_verifikasi == 3) {
					// reject
					$status_verifikasi_txt = $data['setting']['berkas_status_rejected'];
				}

				$data['is_show_download_button'] = $is_show_download_button;
				$data['id_verifikasi'] = $id_verifikasi;
				$data['status_verifikasi'] = $status_verifikasi_txt;
				$data['no_registrasi'] = $no_registrasi;

				$this->load->view('backend/berkas/v_berkas_view', $data);
			} else {
				// form upload berkas
				$this->load->view('backend/berkas/v_berkas_form', $data);
			}
		} else {
			$this->load->view('backend/berkas/v_berkas_list', $data);
		}
	}


	function result() {
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;

		$id_profile  = $this->sess_data_auth['id_profile'];
		$cek_submitted = $this->m_berkas->check_isSubmitted($id_profile);

		// print_r($cek_submitted);exit;

		if ($cek_submitted['success']) {
			// form view berkas
			$temp_data = $cek_submitted['data'];
			$status_verifikasi = $temp_data['status_verifikasi'];
			$status_verifikasi_txt = '';

			if ($status_verifikasi == 1) {
				// review
				$status_verifikasi_txt = $data['setting']['berkas_status_review'];
			} else if ($status_verifikasi == 2) {
				// approve
				$status_verifikasi_txt = $data['setting']['berkas_status_approved'];
			} else if ($status_verifikasi == 3) {
				// reject
				$status_verifikasi_txt = $data['setting']['berkas_status_rejected'];
			}

			$data['status_verifikasi'] = $status_verifikasi_txt;

			$this->load->view('backend/berkas/v_berkas_view', $data);
		} else {
			// form upload berkas
			$this->load->view('backend/berkas/v_berkas_form', $data);
		}
	}

	function index_frm_cmhs() {
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;

		// index form mahasiswa
		$this->load->view('backend/berkas/v_berkas_form', $data);
	}


	function getList() {
		$this->m_berkas->getTable();
	}


	function berkas_save() {
		$r = array();
		$dataSave = array();
		$tgl_now = date('Y-m-d H:i:s');

		$id_akun  = $this->sess_data_auth['id_akun'];
		$id_profile  = $this->sess_data_auth['id_profile'];

		$input_name_submitter = $this->input->post('input_name_submitter');
		$input_name = $this->input->post('input_name');
		$input_NISN = $this->input->post('input_NISN');
		$input_tanggal_lahir = $this->input->post('input_tanggal_lahir');
		$no_registrasi = $this->m_berkas->gen_noRegistrasi();

		$dataSave = array(
			'id_profile' => $id_profile,
			'nama_submiter' => $input_name_submitter,
			'nama_siswa' => $input_name,
			'nisn_siswa' => $input_NISN,
			'tgl_lahir' => $input_tanggal_lahir,
			'no_registrasi' => $no_registrasi,
			'tgl_create' => $tgl_now,
		);


		$save = $this->m_berkas->berkas_save($dataSave);

		$r['success'] = $save;

		if ($save) {
			$r['msg'] = 'Berkas berhasil disimpan';
		} else {
			$r['msg'] = 'Berkas gagal disimpan';
		}
		die(json_encode($r));
	}

	function berkas_update() {
		$r = array();
		$dataSave = array();
		$tgl_now = date('Y-m-d H:i:s');

		$id_verifikasi = $this->input->post('id');
		$status = $this->input->post('status');

		$dataSave = array(
			'status_verifikasi' => $status,
			'tgl_update' => $tgl_now,
		);

		$where = array('id_verifikasi' => $id_verifikasi);

		$save = $this->m_berkas->berkas_update($dataSave, $where);

		$r['success'] = $save;

		if ($save) {
			$r['msg'] = 'Berkas berhasil diubah';
		} else {
			$r['msg'] = 'Berkas gagal diubah';
		}
		die(json_encode($r));
	}

	function berkas_unduh($id_verifikasi) {
		// if(!empty($id_verifikasi_)){
		// 	$id_verifikasi = $id_verifikasi_;
		// }
		$this->m_berkas->berkas_unduh($id_verifikasi);
	}

	// end of class
}
