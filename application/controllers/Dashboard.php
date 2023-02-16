<?php

/**
 *
 * Created at 2022-05-25 10:57:05
 * Updated at
 *
 */

class Dashboard extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Project', 'm_project');
		$this->load->library('Pdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
	}

	function index()
	{
		$get_settings = $this->my_model->get_setting();
		$data['setting'] = $get_settings;
		$data['project'] = $this->m_project->getAll();

		$this->load->view('backend/v_dashboard', $data);
	}

	public function get_ById($id)
	{
		$data["project"] = $this->m_project->getById($id);
		$data["project_dtl"] = $this->m_project->getProjectDtl($id);

		$this->load->view("backend/v_detailproject", $data);
	}

	public function updateDtl()
	{
		$save = $this->m_project->updateStatProd();
		if ($save) {
			$data['success'] = true;
			$data['msg'] = "Simpan Data Berhasil";
		} else {
			$data['success'] = false;
			$data['msg'] = "Gagal Menyimpan Data";
		}

		die(json_encode($data));
	}

	public function updateCek()
	{
		$save = $this->m_project->updateCek();
		if ($save) {
			$data['success'] = true;
			$data['msg'] = "Simpan Data Berhasil";
		} else {
			$data['success'] = false;
			$data['msg'] = "Gagal Menyimpan Data";
		}

		die(json_encode($data));
	}

	function getLaporan()
	{
		$get = $this->m_project->getLaporan();
		if (!empty($get)) {
			$data['success'] = true;
			$data['msg'] = "Data Tersedia";
			$data['data'] = $get;
		} else {
			$data['success'] = false;
			$data['msg'] = "Data Kosong";
		}

		die(json_encode($data));
	}

	function cetakLaporan()
	{

		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');

		$sess_data = $this->session->userdata('auth');
		$nama_user  = $sess_data['nama'];
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('d-m-Y');


		$data = array(
			'nama' => $nama_user,
			'tanggal' => $tanggal,
			'from_date' => $from_date,
			'to_date' => $to_date,
			'transaksi' => $this->m_project->getLaporan()
		);

		$this->load->view('backend/cetak_laporan', $data);
	}

	function cetakProject()
	{

		$id = $this->input->post('id_proj');

		$sess_data = $this->session->userdata('auth');
		$nama_user  = $sess_data['nama'];
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('d-m-Y');

		// $data["project"] = $this->m_project->getById($id);
		// $data["project_dtl"] = $this->m_project->getProjectDtl($id);
		// $data["stat_kerja"] = $this->m_project->get_stat_pengerjaan();


		$data = array(
			'nama' => $nama_user,
			'tanggal' => $tanggal,
			'project' => $this->m_project->getById($id),
			'detail' => $this->m_project->getProjectDtl($id)
		);

		$this->load->view('backend/cetak_laporan_project', $data);
		// $this->load->view('backend/cetak_laporan_project');
	}

	// end of class
}
