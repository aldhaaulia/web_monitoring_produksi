<?php

/**
 *
 * Created at 2022-06-02 19:17:55
 * Updated at
 *
 */

class M_Report extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getAll()
    {
        $new_data = array();

        $this->db->select('a.id AS id_project, a.kd_proj, b.nama AS nama_cust, c.nama AS submiter, a.tgl_create');
        $this->db->from('tr_project a');
        $this->db->join('tm_customer b', 'b.id=a.id_cust', 'left');
        $this->db->join('tm_akun c', 'c.id_akun=a.created_by', 'left');
        $query = $this->db->get();

        if ($query) {
            $data = $query->result_array();

            foreach ($data as $key => $val) {
                $id = $val['id_project'];

                $val['progres'] = $this->getprogress($id);

                $new_data[] = $val;
            }
        }

        return $new_data;
    }

    public function getById($id)
    {
        // $where = array('id_project' => $id);

        $this->db->select('a.id AS id_project, a.kd_proj, b.nama AS nama_cust, c.nama AS submiter, a.date_project');
        $this->db->from('tr_project a');
        $this->db->join('tm_customer b', 'b.id=a.id_cust', 'left');
        $this->db->join('tm_akun c', 'c.id_akun=a.created_by', 'left');
        $this->db->where('a.id', $id);
        $query = $this->db->get();

        if ($query) {
            $data = $query->result_array()[0];
        }

        return $data;
    }


    function gen_ProjectId()
    {
        $tahun_now = date('Y');
        $temp = 'PROJ-' . $tahun_now;

        $this->db->select("IFNULL( max( SUBSTR( a.kd_proj, 10, 99 )), 0 )+1 AS kode");
        $this->db->from('tr_project as a');
        $this->db->where("SUBSTR( a.kd_proj, 1, 9 ) ='$temp'");
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

        $kode_reg = 'PROJ-' . $tahun_now . $reg_temp;
        return $kode_reg;
    }

    // SELECT a.id_proj_dtl AS id_proj_dtl, a.id_proj AS id_proj, b.kd_proj AS kd_proj, c.jenis_barang AS jenis_barang, d.nama AS nama_barang, a.ukuran, a.warna, a.keterangan, e.jenis_pekerjaan AS status_produksi, a.tgl_update, a.tgl_create, IFNULL(a.tgl_update, a.tgl_create) AS last_update FROM `tr_project_dtl` AS a LEFT JOIN tr_project AS b ON b.id = a.id_proj LEFT JOIN tm_jenis_barang AS c ON c.id = a.id_jenis_barang LEFT JOIN tm_barang AS d ON d.id = a.id_brg LEFT JOIN tm_status_produksi AS e ON e.id = a.stat_produksi WHERE a.id_proj = 1;

    // end of class
}
