<?php

/**
 *
 * Created at 2022-06-02 19:17:55
 * Updated at
 *
 */

class M_KelolaPO extends CI_Model
{

	private $table_customer = 'tm_customer';
	private $table_barang = 'tm_barang';
	private $table_project = 'tm_project';
	// private $table_transaksi = 'tr_transaksi';
	private $table_transaksi_project = 'tr_project';
	private $table_transaksi_project_detail = 'tr_project_dtl';

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	function save($dataPost)
	{
		$this->db->trans_begin();

		$this->db->insert($this->table_transaksi, $dataPost);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$is_success = false;
		} else {
			$this->db->trans_commit();
			$is_success = true;
		}
		return $is_success;
	}

	function simpan()
	{
		$is_success = false;
		// add tr_project
		$kd_proj = $this->input->post('project_id');
		$id_cust = $this->input->post('id_cust');
		$created_by = $this->session->userdata('auth')['id_akun'];
		date_default_timezone_set("Asia/Jakarta");
		$tgl_create = date('Y-m-d H:i:s');

		$data_project = array(
			'kd_proj' => $kd_proj,
			'id_cust' => $id_cust,
			'created_by' => $created_by,
			'tgl_create' => $tgl_create
		);

		$save = $this->db->insert('tr_project', $data_project);
		$id_project = $this->db->insert_id();

		if ($save) {

			// add tr_project_dtl
			$id_brg = $this->input->post('id_barang');
			$id_jenis_barang = $this->input->post('id_jns_brg');
			$ukuran = $this->input->post('ukuran_barang');
			$warna = $this->input->post('warna_barang');
			$keterangan = $this->input->post('keterangan');
			$stat_produksi = '1';

			$data_project_dtl = array(
				'id_proj' => $id_project,
				'id_brg' => $id_brg,
				'id_jenis_barang' => $id_jenis_barang,
				'ukuran' => $ukuran,
				'warna' => $warna,
				'keterangan' => $keterangan,
				'stat_produksi' => $stat_produksi,
				'tgl_create' => $tgl_create
			);
			$save2 = $this->db->insert('tr_project_dtl', $data_project_dtl);
			if ($save2) {
				$is_success = true;
			}
		}

		return $is_success;
	}

	function save_multi()
	{
		$is_success = false;
		$dataSave = array();
		$dataSave_detail = array();
		// add tr_project

		$kd_proj = $this->input->post('project_id');
		$project_date = $this->input->post('project_date');
		$id_cust = $this->input->post('id_cust');
		$type_work = $this->input->post('input_jenis_pekerjaan');
		$dataset = $this->input->post('detail');


		// save project
		$created_by = $this->session->userdata('auth')['id_akun'];
		$tgl_create = date('Y-m-d H:i:s');

		$dataSave = array(
			'kd_proj' => $kd_proj,
			'id_cust' => $id_cust,
			'type_work' => $type_work,
			'date_project' => $project_date,
			'created_by' => $created_by,
			'tgl_create' => $tgl_create
		);

		$this->db->trans_begin();

		$save = $this->db->insert($this->table_transaksi_project, $dataSave);
		$id_project = $this->db->insert_id();



		// Process Save Multi item
		$data_ = array();

		// convert to object
		// array_push($data_, $dataset);

		// print_r($data_);exit;

		// convert json object to array php
		$dataset_ =  $this->objectToArray($dataset);
		$dataset_ =  $this->parseKeyToArray($dataset_, '__');


		if (!empty($dataset_)) {
			$new_data = array();
			$temp_data = array();
			$pengecekan = null;

			if ($type_work == 1) {
				$stat_produksi = '1';
			} else {
				$stat_produksi = '6';
				$pengecekan = '1';
			}

			$file_poto = '-';

			foreach ($dataset_['id_jns_brg'] as $key => $val) {
				$temp_data[$key] = array(
					'project_id' => $dataset_['project_id'][$key],
					'project_date' => $dataset_['project_date'][$key],
					'id_cust' => $dataset_['id_cust'][$key],

					'id_jns_brg' => $val,
					'id_barang' => $dataset_['id_barang'][$key],
					'ukuran_barang' => $dataset_['ukuran_barang'][$key],
					'warna_barang' => $dataset_['warna_barang'][$key],
					'keterangan' => $dataset_['keterangan'][$key],

				);
			}


			if (!empty($temp_data)) {
				foreach ($temp_data as $key => $val) {
					// $kd_proj = $val['project_id'];
					// $project_date = $val['project_date'];
					// $id_cust = $val['id_cust'];

					$id_jenis_barang = $val['id_jns_brg'];
					$id_barang = $val['id_barang'];
					$ukuran_barang = $val['ukuran_barang'];
					$warna_barang = $val['warna_barang'];
					$keterangan = $val['keterangan'];

					$dataSave_detail[] = array(
						'id_proj' => $id_project,
						'id_jenis_barang' => $id_jenis_barang,
						'id_brg' => $id_barang,
						'ukuran' => $ukuran_barang,
						'warna' => $warna_barang,
						'keterangan' => $keterangan,
						'stat_produksi' => $stat_produksi,
						'file_poto' => $file_poto,
						'pengecekan' => $pengecekan,
						'tgl_create' => $tgl_create
					);
				}
			}

			// print_r($dataSave_detail); exit;
		}

		if ($save) {

			// add tr_project_dtl
			if (!empty($dataSave_detail)) {
				$save2 = $this->db->insert_batch($this->table_transaksi_project_detail, $dataSave_detail);
				if ($save2) {
					$is_success = true;
				}
			}
		}


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$is_success = false;
		} else {
			$this->db->trans_commit();
			$is_success = true;
		}

		return $is_success;
	}


	private function objectToArray($dataJson)
	{
		$data = array();

		foreach ($dataJson as $key => $value) {
			# Remove ' from value
			$value = str_replace("'", '', $value);

			# Set value as array not as array object from json_encode
			$value = (array) json_decode($value, true);

			# Pushing into $old_data
			$data = $value;
		}

		return $data;
	}

	function parseKeyToArray($array, $explode_separator = ";")
	{
		// reff : https://stackoverflow.com/a/37356543/10351006

		$result = array();

		foreach ($array as $path => $value) {
			$temp = &$result;

			foreach (explode($explode_separator, $path) as $key) {
				$temp = &$temp[$key];
			}
			$temp = $value;
		}

		return $result;
	}


	// end of class
}
