<?php

/**
 *
 * Created at 2022-05-30 14:20:53
 * Updated at
 *
 */

class Customer extends MY_Controller
{

    private $sess_data_auth;

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Cust', 'm_cust');
    }

    function get_Cust()
    {
        $cust = $this->m_cust->getAll();

        if (!empty($cust)) {
            $r['success'] = 'true';
            $r['data'] = $cust;
        } else {
            $r['success'] = 'false';
            $r['msg'] = 'Data Kosong';
        }

        die(json_encode($r));
    }

    function search_Cust()
    {
        $q = $this->input->post('q');
        $cust = $this->m_cust->searchCust($q);

        if (!empty($cust)) {
            $r['success'] = 'true';
            $r['data'] = $cust;
        } else {
            $r['success'] = 'false';
            $r['msg'] = 'Data Kosong';
        }


        die(json_encode($r));
    }

    public function save()
    {
        $nama = $this->input->post('nama_customer_new');
        $kd_cust = $this->m_cust->gen_kode();
        date_default_timezone_set("Asia/Jakarta");
        $create_date = date('Y-m-d H:i:s');

        $data = array(
            'kd_cust' => $kd_cust,
            'nama' => $nama,
            'create_date' => $create_date
        );

        $save = $this->m_cust->save($data);
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
