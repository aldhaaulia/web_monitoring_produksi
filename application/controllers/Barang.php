<?php

/**
 *
 * Created at 2022-05-30 14:20:53
 * Updated at
 *
 */

class Barang extends MY_Controller
{

    private $sess_data_auth;

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Barang', 'm_barang');
    }

    function get_Barang()
    {
        $brg = $this->m_barang->getAll();

        if (!empty($brg)) {
            $r['success'] = 'true';
            $r['data'] = $brg;
        } else {
            $r['success'] = 'false';
            $r['msg'] = 'Data Kosong';
        }


        die(json_encode($r));
    }

    function search_Barang()
    {
        $q = $this->input->post('q');
        $brg = $this->m_barang->searchbarang($q);

        if (!empty($brg)) {
            $r['success'] = 'true';
            $r['data'] = $brg;
        } else {
            $r['success'] = 'false';
            $r['msg'] = 'Data Kosong';
        }


        die(json_encode($r));
    }

    public function save()
    {
        $nama = $this->input->post('brg_new');
        // $kd_cust = $this->m_cust->gen_kode();
        date_default_timezone_set("Asia/Jakarta");
        $create_date = date('Y-m-d H:i:s');

        $data = array(
            // 'kd_cust' => $kd_cust,
            'nama' => $nama,
            'create_date' => $create_date
        );

        $save = $this->m_barang->save($data);
        if ($save) {
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
