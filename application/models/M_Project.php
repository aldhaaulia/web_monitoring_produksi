<?php

/**
 *
 * Created at 2022-06-02 19:17:55
 * Updated at
 *
 */

class M_Project extends CI_Model
{
    private $_table = "tr_project";
    private $table_jenis = 'tm_project_dtl';
    private $path_upload_file = './assets/Backend/uploads';
    function __construct()
    {
        parent::__construct();
        $this->sess_auth = $this->session->userdata('auth');
        // for current user only
        $this->upload_file_path_ = $this->path_upload_file . '/' . $this->sess_auth['user_dir'] . '/';
    }

    function getAll()
    {
        $new_data = array();

        $this->db->select('a.id AS id_project, a.kd_proj, b.nama AS nama_cust, c.nama AS submiter, a.tgl_create');
        $this->db->from('tr_project a');
        $this->db->join('tm_customer b', 'b.id=a.id_cust', 'left');
        $this->db->join('tm_akun c', 'c.id_akun=a.created_by', 'left');
        $this->db->order_by('a.id', 'asc');
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

        $this->db->select('a.id AS id_project, a.kd_proj, b.kd_cust AS kd_cust, b.nama AS nama_cust, c.nama AS submiter, a.date_project');
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

    function searchProj($str)
    {
        $new_data = array();

        $this->db->select('a.id AS id_project, a.kd_proj, b.kd_cust AS kd_cust, b.nama AS nama_cust, c.nama AS submiter, c.user_dir as dir, a.date_project');
        $this->db->from('tr_project a');
        $this->db->join('tm_customer b', 'b.id=a.id_cust', 'left');
        $this->db->join('tm_akun c', 'c.id_akun=a.created_by', 'left');
        $this->db->like('kd_proj', $str);
        $this->db->or_like('b.nama', $str);
        $query = $this->db->get();

        if ($query) {
            $data = $query->result_array();

            if (!empty($data)) {
                foreach ($data as $key => $val) {
                    $tgl_date =  $val['date_project'];

                    $val['date_project'] = date('d-m-Y', strtotime($tgl_date));

                    $new_data[] = $val;
                }
            }
        }

        return $new_data;
    }

    function getProjectDtl($id)
    {
        $data = array();
        $new_data = array();

        $this->db->select('a.id_proj_dtl AS id_proj_dtl,
        a.id_proj AS id_proj,
        b.kd_proj AS kd_proj,
        c.jenis_barang AS jenis_barang,
        d.nama AS nama_barang,
        a.ukuran,
        a.warna,
        a.keterangan,
        e.jenis_pekerjaan AS status_produksi,
        a.file_poto,
        a.pengecekan AS stat_pengecekan,
        e.bobot as progress,
        a.tgl_update,
        a.tgl_create, 
        ifnull(a.tgl_update, a.tgl_create) AS last_update');
        $this->db->from('tr_project_dtl a');
        $this->db->join('tr_project b', 'b.id = a.id_proj', 'left');
        $this->db->join('tm_jenis_barang c', 'c.id = a.id_jenis_barang', 'left');
        $this->db->join('tm_barang d', 'd.id = a.id_brg', 'left');
        $this->db->join('tm_status_produksi e', 'e.id = a.stat_produksi', 'left');
        $this->db->where('a.id_proj', $id);
        $query = $this->db->get();

        if ($query) {
            $data = $query->result_array();

            if (!empty($data)) {
                $no = 1;
                foreach ($data as $key => $val) {

                    $stat_cek = $val['stat_pengecekan'];
                    $tgl_date =  $val['last_update'];
                    $file_poto = $val['file_poto'];

                    $val['act'] = '';
                    $val['no'] = $no;

                    $val['date_project'] = date('d-m-Y', strtotime($tgl_date));

                    if (!($stat_cek == null)) {
                        if ($stat_cek == 0) {
                            $stat = 'Belum Dicek';
                            $modal = 'cekDtlModal';
                            $id = 'edtCekProject';
                        } elseif ($stat_cek == '2') {
                            $stat = 'Perbaikan';
                            $modal = 'cekDtlModal';
                            $id = 'edtCekProject';
                        } else {
                            $stat = 'Sesuai';
                            $modal = 'cekDtlModal';
                            $id = 'edtCekProject';
                        }
                    } else {
                        $stat = 'Masih Dalam Pengerjaan';
                        $modal = 'editDtlModal';
                        $id = 'edtDtlProject';
                    }

                    if (!($file_poto == '-')) {
                        $val['doc'] = '  <a data-toggle="modal" data-target="#berkasModal" id="imgView" data-item="' . $file_poto . '" href="#berkasModal">' . $file_poto . '</a>';
                    } else {
                        $val['doc'] = $file_poto;
                    }
                    // $val['doc'] = $file_poto;

                    $val['stat'] = $stat;
                    $val['act'] .= '  <button data-toggle="modal" data-target="#' . $modal . '" id="' . $id . '" data-item="' . $val['id_proj_dtl'] . '" data-text="' . $val['status_produksi'] . '" data-proj="' . $val['id_proj'] . '" type="button" class="btn btn-warning">Edit</button>';

                    $new_data[] = $val;

                    $no++;
                }
            }
        }

        return $new_data;
    }

    function getprogress($id)
    {
        $this->db->select('SUM(b.bobot) AS progress');
        $this->db->from('tr_project_dtl a');
        $this->db->join('tm_status_produksi b', 'b.id = a.stat_produksi', 'left');
        $this->db->where('a.id_proj', $id);
        $query1 = $this->db->get();

        $totalbobot =  $query1->row('progress');

        $this->db->select('COUNT(id_proj_dtl) AS total_data');
        $this->db->from('tr_project_dtl ');
        $this->db->where('id_proj', $id);
        $query2 = $this->db->get();

        $totaldata =  $query2->row('total_data');

        @$progress = ($totalbobot / $totaldata);

        return $progress;
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

    function get_stat_pengerjaan()
    {
        return $this->db->get('tm_status_produksi')->result_array();
    }

    function updateStatProd()
    {
        $id_proj_dtl = $this->input->post('id_project_dtl');
        $stat_produksi = $this->input->post('stat_produksi');
        date_default_timezone_set("Asia/Jakarta");
        $update_date = date('Y-m-d H:i:s');

        if ($stat_produksi == 6) {
            $pengecekan = 0;
        } else {
            $pengecekan = null;
        }

        $data = array(
            'stat_produksi' => $stat_produksi,
            'tgl_update' => $update_date,
            'pengecekan' => $pengecekan,
        );

        $where = array(
            'id_proj_dtl' => $id_proj_dtl
        );

        if (isset($_FILES['foto'])) {
            $nameShort = 'poto_';
            // $file_path = $this->path_upload_file . '/poto/';
            $config_upload = array(
                // 'upload_path' => $file_path
            );

            $uploadData = $this->uploadsData('foto', $config_upload, $nameShort);

            $res_uploadData = $uploadData['data'];

            if ($uploadData['success']) {
                // $where = array('name' => 'file_poto');

                // $dataSave['value'] = $res_uploadData['filename'];
                // $dataSave['tgl_update'] = $tgl_now;

                // $this->db->update($this->table_detail, $dataSave, $where);
                $data['file_poto'] = $res_uploadData['filename'];
            } else {
                // error
            }
        }

        return $this->db->update('tr_project_dtl', $data, $where);
    }

    function updateCek()
    {
        $id_proj_dtl = $this->input->post('id_project_dtl');
        $pengecekan = $this->input->post('stat_pengecekan');
        date_default_timezone_set("Asia/Jakarta");
        $update_date = date('Y-m-d H:i:s');

        $data = array(
            'pengecekan' => $pengecekan,
            'tgl_update' => $update_date,
        );

        $where = array(
            'id_proj_dtl' => $id_proj_dtl
        );

        return $this->db->update('tr_project_dtl', $data, $where);
    }

    function getLaporan()
    {
        $new_data = array();
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        $query = $this->db->query('SELECT a.id AS id_project, a.kd_proj, b.kd_cust, b.nama AS nama_cust, c.nama AS submiter, DATE_FORMAT(a.date_project, "%d-%m-%Y") as date_project, DATE_FORMAT(a.tgl_create, "%d-%m-%Y") as tgl_create, COUNT(d.id_proj) AS jml_item FROM tr_project AS a LEFT JOIN tm_customer AS b ON b.id = a.id_cust LEFT JOIN tm_akun AS c ON c.id_akun = a.created_by INNER JOIN tr_project_dtl AS d ON d.id_proj = a.id WHERE DATE_FORMAT(a.tgl_create, "%Y-%m-%d") BETWEEN "' . $from_date . '" AND "' . $to_date . '" GROUP BY d.id_proj');

        $data = $query->result_array();
        $no = 1;
        foreach ($data as $key => $val) {
            // $tgl_date =  $val['date_project'];

            // $val['date_project'] = date('d-m-Y', strtotime($tgl_date));
            $val['no'] = $no;

            $new_data[] = $val;
            $no++;
        }

        return $new_data;
    }

    private function uploadsData($inputpostName, $config = array(), $nameShort = '')
    {

        $new_namez = $_FILES[$inputpostName]['name'];
        $new_name  = $nameShort . microtime(true) . '.' . substr(strtolower(strrchr($new_namez, ".")), 1);
        // $configz['file_name'] = $new_name;
        $configz = array(
            'file_name'     => $new_name,
            'upload_path'   => $this->path_upload_file,
            // 'allowed_types' => 'gif|jpg|jpeg|png|bmp|pdf|doc',
            // 'encrypt_name' => true,
            'allowed_types' => '*',
            'max_size'      => '3000000',
            'remove_spaces' => true,
        );

        if (!empty($config)) {
            foreach ($config as $key => $value) {
                $configz[$key] = $value;
            }
        }


        $mkdir_path = $configz['upload_path'];

        // if(!file_exists($mkdir_path)){
        //     @mkdir($mkdir_path, 0755, TRUE);
        //     @chmod($mkdir_path, 0755);
        // }

        if (!is_dir($mkdir_path)) {
            // check directory is exist
            // create recursive directory
            // 0755 => without public write
            // 0777 => with public write

            @mkdir($mkdir_path, 0777, true);
        }

        // }

        $this->upload->initialize($configz);

        if (!$this->upload->do_upload($inputpostName)) {
            $error = $this->upload->display_errors();
            return array('success' => false, 'data' => $error);
        } else {
            $dataUpload = $this->upload->data();
            $data = array(
                'filename' => $dataUpload['file_name'],
                'filetype' => $dataUpload['file_type'],
                'filesize' => $dataUpload['file_size'],
            );

            return array('success' => true, 'data' => $data);
        }
    }


    // end of class
}
