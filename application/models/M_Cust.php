<?php

/**
 *
 * Created at 2022-06-02 19:17:55
 * Updated at
 *
 */

class M_Cust extends CI_Model
{
    private $_table = "tm_customer";

    function __construct()
    {
        parent::__construct();
    }

    function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    function searchCust($str)
    {
        $this->db->select('*');
        $this->db->like('kd_cust', $str);
        $this->db->or_like('nama', $str);
        $query = $this->db->get('tm_customer');
        return $query->result_array();
    }

    function save($dataPost)
    {
        return $this->db->insert($this->_table, $dataPost);
    }

    function gen_kode()
    {
        $tahun_now = date('Y');
        $temp = 'CUST' . $tahun_now;

        $this->db->select("IFNULL( max( SUBSTR( a.kd_cust, 9, 99 )), 0 )+1 AS kode");
        $this->db->from('tm_customer as a');
        $this->db->where("SUBSTR( a.kd_cust, 1, 8 ) ='$temp'");
        $get = $this->db->get();

        $no_reg = 1;
        if ($get) {
            $data = $get->result_array();
            if ($data) {
                $data = $data[0];
                $no_reg = $data['kode'];
            }
        }

        $reg_temp = sprintf("%03s", $no_reg);

        $kode_reg = $temp . $reg_temp;
        return $kode_reg;
    }


    // end of class
}
