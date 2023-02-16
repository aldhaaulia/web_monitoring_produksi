<?php

/**
 *
 * Created at 2022-05-30 14:20:53
 * Updated at
 *
 */

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->sess_auth = $this->session->userdata('auth') ?? null ?: null;
    }

    public function index()
    {
        // $check_login = $this->check_session(false);

        // if ($check_login) {
        //     $this->check_session();
        // }

        $redirect_route = 'landing';
        redirect($redirect_route, 'refresh');
    }

    private function check_session($is_redirect = true)
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
