<?php

/**
 *
 * Created at 2022-05-30 14:30:53
 * Updated at
 *
 */

class C_Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->sess_auth = $this->session->userdata('auth') ?? null ?: null;
		$this->load->model('Auth/M_Login', 'm_login');
	}

	function index() {

		$check_login = $this->check_session(false);

		if ($check_login) {
			$this->check_session();
		}


		$this->load->view('auth/v_login');
	}

	function proses_login() {
		return $this->m_login->proses_login();
	}

	function logout() {
		$this->session->unset_userdata('auth');
		redirect('login', 'refresh');
	}


	public function check_session($is_redirect = true)
    {
        $is_login = false;
        $redirect_route = '';

        if (!empty($this->sess_auth) && $this->sess_auth['is_login']) {
            $redirect_route = 'backend/home';
            $is_login = true;
        } else {
            $redirect_route = 'login';
            $is_login = false;
        }

        if ($is_redirect) {
            redirect($redirect_route, 'refresh');
        } else {
            return $is_login;
        }
    }

	// end of class
}
