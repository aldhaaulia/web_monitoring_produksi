<?php

/**
 *
 * Created at 2022-06-09 11:43:45
 * Updated at
 *
 */

class M_Landing extends MY_Model
{
	private $table_slider = 'tm_slider';
	function __construct()
	{
		parent::__construct();
	}

	function searchProj($str)
	{
		$new_data = array();

		$this->db->select("a.id AS id_project, a.kd_proj, b.kd_cust AS kd_cust, b.nama AS nama_cust, c.nama AS submiter, c.user_dir as dir, DATE_FORMAT(a.date_project, '%d-%m-%Y') AS date");
		$this->db->from('tr_project a');
		$this->db->join('tm_customer b', 'b.id=a.id_cust', 'left');
		$this->db->join('tm_akun c', 'c.id_akun=a.created_by', 'left');
		$this->db->where('a.kd_proj', $str);
		$query = $this->db->get();

		if ($query) {
			$data = $query->result_array();

			if (!empty($data)) {
				$data = $data[0];
				// $tgl_date =  $data['date_project'];

				// $data['date_project'] = date('d-m-Y', strtotime($tgl_date));

				$new_data = $data;
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
						$val['doc'] = '  <a style="color:blue" data-toggle="modal" data-target="#berkasModal" id="imgView" data-item="' . $file_poto . '" href="#berkasModal">' . $file_poto . '</a>';
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


	function getDtlById($id)
	{
		$data = array();
		$new_data = array();

		$this->db->select('a.id_proj_dtl AS id_proj_dtl,
        c.jenis_barang AS jenis_barang,
        d.nama AS nama_barang,
        a.ukuran,
        a.warna,
        a.keterangan,
		a.stat_produksi,
        e.jenis_pekerjaan AS status_produksi,
        a.file_poto,
        a.pengecekan AS stat_pengecekan,
        a.tgl_update,
        a.tgl_create, 
        ifnull(a.tgl_update, a.tgl_create) AS last_update');
		$this->db->from('tr_project_dtl a');
		$this->db->join('tr_project b', 'b.id = a.id_proj', 'left');
		$this->db->join('tm_jenis_barang c', 'c.id = a.id_jenis_barang', 'left');
		$this->db->join('tm_barang d', 'd.id = a.id_brg', 'left');
		$this->db->join('tm_status_produksi e', 'e.id = a.stat_produksi', 'left');
		$this->db->where('a.id_proj_dtl', $id);
		$query = $this->db->get();

		if ($query) {
			$data = $query->result_array();

			if (!empty($data)) {
				$data = $data[0];

				$stat_cek = $data['stat_pengecekan'];
				$tgl_date =  $data['last_update'];
				$tgl_create =  $data['tgl_create'];
				$file_poto = $data['file_poto'];

				$data['date_project'] = date('d-m-Y', strtotime($tgl_date));
				$data['date_create'] = date('d-m-Y', strtotime($tgl_create));

				if (!($stat_cek == null)) {
					if ($stat_cek == 0) {
						$stat = 'Belum Dicek';
					} elseif ($stat_cek == '2') {
						$stat = 'Perbaikan';
					} else {
						$stat = 'Sesuai';
					}
				} else {
					$stat = 'Masih Dalam Pengerjaan';
				}

				$data['stat'] = $stat;


				$new_data[] = $data;
			}
		}

		return $new_data[0];
	}

	// end of class
}
