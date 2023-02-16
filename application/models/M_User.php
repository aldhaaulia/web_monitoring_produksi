<?php

/**
 *
 * Created at 2022-06-02 19:17:55
 * Updated at
 *
 */

class M_User extends CI_Model
{
    private $_table = "tm_akun";

    function __construct()
    {
        parent::__construct();
    }

    function getAll()
    {
        $this->db->select('a.id_akun as id,
        a.nama as nama,
        b.nama as role,
        a.email as email,
        a.tgl_create as create_date,
        a.tgl_update as update_date');
        $this->db->from('tm_akun a');
        $this->db->join('tm_role b', 'b.id_role = a.role', 'left');

        $query = $this->db->get();

        if ($query) {
            $data = $query->result_array();
        }

        return $data;
    }

    function getRole()
    {
        $query = $this->db->query("SELECT * FROM `tm_role` WHERE id_role <> 1");

        return $query->result_array();
    }

    function save()
    {
        $nama = $this->input->post('nama_user');
        $role = $this->input->post('role');
        $email = $this->input->post('email_user');
        $password = md5($this->input->post('password_user'));

        date_default_timezone_set("Asia/Jakarta");
        $tgl_create = date('Y-m-d H:i:s');

        $data_akun = array(
            'nama' => $nama,
            'role' => $role,
            'email' => $email,
            'password' => $password,
            'tgl_create' => $tgl_create
        );

        return $this->db->insert($this->_table, $data_akun);
    }

    public function changePassword($id, $password)
    {
        $id_akun = $id;
        $newpassword = $password;
        date_default_timezone_set("Asia/Jakarta");
        $tgl_update = date('Y-m-d H:i:s');

        $data_akun = array(
            'password' => $newpassword,
            'tgl_update' => $tgl_update
        );

        $where = array(
            'id_akun' => $id_akun
        );

        return $this->db->update('tm_akun', $data_akun, $where);
    }

    public function delete($id)
    {
        $where = array('id_akun' => $id);

        return $this->db->delete($this->_table, $where);
    }


    // end of class
}
