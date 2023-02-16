<?php

/**
 *
 * Created at 2022-05-30 14:20:53
 * Updated at
 *
 */

class User extends MY_Controller
{

    private $sess_data_auth;

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_User', 'm_user');
    }

    function index()
    {
        $get_settings = $this->my_model->get_setting();
        // $data['setting'] = $get_settings;
        $data['user'] = $this->m_user->getAll();
        $data['role'] = $this->m_user->getRole();

        $this->load->view('backend/v_user_management', $data);
    }

    public function resetPassword()
    {
        $id_akun = $this->input->post('id_akun');
        $password = $this->input->post('new_password');
        $new_password = md5($password);

        // print_r($password);

        if ($password == '') {
            $data['success'] = false;
            $data['msg'] = "Password Tidak Boleh Kosong";
        } else {
            $save = $this->m_user->changePassword($id_akun, $new_password);
            if ($save) {
                $data['success'] = true;
                $data['msg'] = "Password Berhasil Diubah";
            } else {
                $data['success'] = false;
                $data['msg'] = "Gagal Mengubah Password";
            }
        }

        die(json_encode($data));
    }

    public function saveUser()
    {
        $save = $this->m_user->save();
        if ($save) {
            $data['success'] = true;
            $data['msg'] = "Simpan Data Berhasil";
        } else {
            $data['success'] = false;
            $data['msg'] = "Gagal Menyimpan Data";
        }

        die(json_encode($data));
    }

    public function delete()
    {
        $id = $this->input->post('id_akun');

        $delete = $this->m_user->delete($id);
        if ($delete) {
            $data['success'] = true;
            $data['msg'] = "Simpan Data Berhasil";
        } else {
            $data['success'] = false;
            $data['msg'] = "Gagal Menyimpan Data";
        }

        die(json_encode($data));
    }

    // end of class
}
