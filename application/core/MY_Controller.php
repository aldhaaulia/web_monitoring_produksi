<?php

/**
 *
 * Created at 2022-05-31 12:14:03
 * Updated at
 *
 */

class MY_Controller extends CI_Controller
{
    private $sess_auth;
    private $path_logo;
    public function __construct()
    {
        parent::__construct();
        $this->path_logo = base_url() . 'assets/Frontend/uploads/logo/';

        $this->sess_auth = $this->session->userdata('auth') ?? null ?: null;

        $check_login = $this->check_session(false);

        if (!$check_login) {
            $this->check_session();
        }

        $this->load->model('MY_Model', 'my_model');
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

    function set_session($index_session, $data_session)
    {
        $data_session_ = $this->get_session($index_session);

        foreach ($data_session as $key => $val) {
            $data_session_[$key] = $val;
        }

        $this->session->set_userdata($index_session, $data_session_);
    }

    function get_session($sess_name)
    {
        return $this->session->userdata($sess_name);
    }

    public function get_user($id_akun)
    {
        $res_success = false;
        $res_data = array();

        // $this->db->select('a.id_akun, a.nama, a.role, b.nik_profile as nik, a.email, b.id_profile, b.alamat, b.no_telp, b.tempat_lahir, b.tgl_lahir');
        $this->db->select('a.id_akun, a.nama, a.role, a.email');
        $this->db->from('tm_akun as a');
        // $this->db->join('tm_profile as b', 'b.id_akun = a.id_akun', 'inner');
        $this->db->where('a.id_akun', $id_akun);
        $this->db->limit(1);

        $get = $this->db->get();

        if ($get) {
            $data = $get->result_array();
            if (!empty($data)) {
                $res_success = true;
                $res_data = $data[0];
            }
        }

        $r = array('success' => $res_success, 'data' => $res_data);

        return $r;
    }

    // end of class
}
