<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring extends MY_Controller
{

	private $sess_data_auth;

	function __construct()
	{
		parent::__construct();
		$this->sess_data_auth = $this->get_session('auth');
		$this->load->model('M_Monitoring', 'm_monitoring');
		$this->load->model('M_Project', 'm_project');
		$this->load->helper('url');
	}


	function index()
	{
		$get_settings = $this->my_model->get_setting();
		$data["stat_kerja"] = $this->m_project->get_stat_pengerjaan();
		$data['setting'] = $get_settings;

		$this->load->view('backend/v_monitoring', $data);
	}

	function search_proj()
	{
		$q = $this->input->post('q');
		$proj = $this->m_project->searchProj($q);

		if (!empty($proj)) {
			$r['success'] = 'true';
			$r['data'] = $proj;
		} else {
			$r['success'] = 'false';
			$r['msg'] = 'Data Kosong';
		}


		die(json_encode($r));
	}

	function get_ProjDtl()
	{
		$id = $this->input->post('id');
		$proj = $this->m_project->getProjectDtl($id);

		if (!empty($proj)) {
			$r['success'] = true;
			$r['data'] = $proj;
		} else {
			$r['success'] = false;
			$r['msg'] = 'Data Kosong';
		}

		die(json_encode($r));
	}

	function save()
	{
		$customer_id = $this->input->post('input_customer_id');
		$customer_name = $this->input->post('input_customer_name');
		$project_id = $this->input->post('input_project_id');
		$project_date = $this->input->post('input_project_date');
		$nama_barang = $this->input->post('input_nama_barang');
		$jenis_barang = $this->input->post('input_jenis_barang');
		$status_produksi = $this->input->post('input_status_produksi');
		$pengecekan = $this->input->post('input_pengecekan');
		$tanggal_update = $this->input->post('input_tanggal_update');
		$dataSave = array(

			'customer_id' => $customer_id,
			'customer_name' => $customer_name,
			'project_id' => $project_id,
			'project_date' => $project_date,
			'nama_barang' => $nama_barang,
			'jenis_barang' => $jenis_barang,
			'status_produksi' => $status_produksi,
			'pengecekan' => $pengecekan,
			'tanggal_update' => $tanggal_update,
		);

		$save = $this->m_monitoring->save($dataSave);

		$r['success'] = $save;

		if ($save) {
			$r['msg'] = 'Data berhasil disimpan';
		} else {
			$r['msg'] = 'Data gagal disimpan';
		}
		die(json_encode($r));
	}

	function uploadgambar()
	{
		$config['upload_path'] = './assets/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$config['max_size'] = 5000;

		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$hasil = $this->upload->data();

		$data = array('nama_file' => $hasil['file_name'], 'ukuran' => $hasil['file_size']);
		$this->db->insert($data);
	}
}
