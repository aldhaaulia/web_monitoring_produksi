<?php

/**
 *
 * Created at 2022-05-30 14:20:53
 * Updated at
 *
 */

class jenis_barang extends MY_Controller
{

    private $sess_data_auth;

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Jns_Brg', 'm_jns_brg');
    }

    public function save()
    {
        $nama = $this->input->post('jenis_new');
        // $kd_cust = $this->m_cust->gen_kode();
        date_default_timezone_set("Asia/Jakarta");
        $create_date = date('Y-m-d H:i:s');

        $data = array(
            'jenis_barang' => $nama,
            'create_date' => $create_date
        );

        $save = $this->m_jns_brg->save($data);
        if ($save) {
            $data['success'] = true;
            $data['msg'] = "Simpan Data Berhasil";
        } else {
            $data['success'] = false;
            $data['msg'] = "Gagal Menyimpan Data";
        }

        die(json_encode($data));
    }

    function search_Jns()
    {
        $q = $this->input->post('q');
        $cust = $this->m_jns_brg->searchJns($q);

        if (!empty($cust)) {
            $r['success'] = 'true';
            $r['data'] = $cust;
        } else {
            $r['success'] = 'false';
            $r['msg'] = 'Data Kosong';
        }


        die(json_encode($r));
    }

    // end of class
}
