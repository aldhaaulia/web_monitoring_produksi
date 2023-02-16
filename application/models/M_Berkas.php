<?php

/**
 *
 * Created at 2022-06-02 19:17:55
 * Updated at
 *
 */

class M_Berkas extends CI_Model {
	private $table = 'tr_verifikasi';
	private $table_z = 'tm_profile';
	private $table_akun = 'tm_akun';
	private $path_upload_file = './assets/Backend/uploads/';

	function __construct() {
		parent::__construct();

		$this->sess_auth = $this->session->userdata('auth');
		// for current user only
		$this->upload_file_path_ = $this->path_upload_file . '/' . $this->sess_auth['user_dir'] . '/';
	}

	public function getTable() {

		# declare variable

		$new_data  = array();
		$old_data  = array();
		$base_data = array();
		$other_data = array();
		$is_other  = false;

		$select        = '*';
		$tbl_query     = '';
		$joinTable     = array();
		$joinCond      = array();
		$column_search = array();
		$column_order  = array();
		$where         = array();
		$group         = array();
		$order         = array();
		$is_json       = true;
		$is_serverside = false;


		# set variable
		$select    = 'a.id_verifikasi, a.id_profile, a.nama_submiter, a.nama_siswa, a.nisn_siswa, a.no_registrasi, a.status_verifikasi, a.tgl_lahir, b.nama_profile, b.nik_profile';
		$tbl_query = $this->table . ' as a';
		$joinTable = array(
			$this->table_profile . ' as b' => 'a.id_profile = b.id_profile',
		);
		$joinCond  = array('left');
		$column_search = array();
		$column_order  = array();
		$where = array(
			// 'a.is_deleted' => '0'
		);
		$group = array();
		$order = array();

		// if ($this->role_id != 1) {
		// 	$where['a.level !='] = 1;
		// }

		// set false if serverside is true
		$is_json = false;
		$is_serverside = true;

		$data = $this->salz_datatable->get_datatables(
			$select,
			$tbl_query,
			$joinTable,
			$joinCond,
			$column_search,
			$column_order,
			$where,
			$group,
			$order,
			$is_json
		);

		foreach ($data['data'] as $row) {
			$ro = $row;
			$ro = json_encode($ro);

			$ro = str_replace('"', "'", $ro);
			$status_verifikasi = $row['status_verifikasi'];


			$txt_status_cond = '';

			if ($status_verifikasi == '1') {
				$txt_status = 'Review';
				$txt_status_cond = 'bg-info';
			} elseif ($status_verifikasi == '2') {
				$txt_status = 'Approved';
				$txt_status_cond = 'bg-success';
			} elseif ($status_verifikasi == '3') {
				$txt_status = 'Rejected';
				$txt_status_cond = 'bg-danger';
			}

			$txt_status_ = '<span class="badge '.$txt_status_cond.'">';

			$txt_status = $txt_status_ . $txt_status.'</span>';


			$row['act'] = '';

			// $judul_delete = 'Username: <b>' . $row['username'] . '</b>, Apikey: <b>' . $row['apikey'] . '</b>';

			// $status_cond = 2;
			// if ($status_verifikasi == '1') {
			// update to approved
			$row['act'] .= "<div class='btn-group'><a class='btn btn-info btn-flat' href='javascript:void(0);' title='Ubah status' onclick=\"popUpMdl({id:'" . $row['id_verifikasi'] . "', no_registrasi:'" . $row['no_registrasi'] . "', status_verifikasi:'" . $row['status_verifikasi'] . "'});\"> <i class='fas fa-question'></i></span></div>";

			// 	$row['act'] .= "<div class='btn-group'><a class='btn btn-success btn-flat' href='javascript:void(0);' title='Ubah status jadi approve' onclick=\"set_status({id:'" . $row['id_verifikasi'] . "', status: '2'});\"> <i class='fas fa-check'></i></span></div>";

			// } else {
			// 	// update to reject
			// 	$row['act'] .= "<div class='btn-group'><a class='btn btn-danger btn-flat' href='javascript:void(0);' title='Ubah status jadi reject' onclick=\"set_status({id:'" . $row['id_verifikasi'] . "', status: '3'});\"> <i class='fas fa-times'></i></span></div>";
			// }

			// $row['act'] .= "<div class='btn-group'><a class='btn btn-warning btn-flat' href='backend/berkas/berkas_unduh/".$row['id_verifikasi']."' title='Unduh Berkas' download> <i class='fas fa-download'></i></span></div>";

			$row['act'] .= "<div class='btn-group'><a class='btn btn-warning btn-flat' href='javascript:void(0);' title='Unduh Berkas' onclick=\"unduh_berkas('" . $row['id_verifikasi'] . "');\"> <i class='fas fa-download'></i></span></div>";


			// $row['act'] .= "<div class='btn-group'><a class='btn' href='javascript:void(0);' title='Edit Data' onclick=\"popOut('mdladd','Edit data',".$ro.");\"> <i class='fa fa-pencil' style='color: blue;'></i></span></div>";


			// $row['act'] .= "<div class='btn-group'><a class='btn' href='javascript:void(0);' title='Hapus Data' onclick=\"popDelete('mdldel',{id:'" . $row['id'] . "',judul:'" . $judul_delete . "'});\"><i class='fa fa-close' style='color: red;'></i></span></div>";

			$row['status_verifikasi'] = $txt_status;

			$old_data[] = $row;
		}

		unset($data['data']);
		$data['data'] = $old_data;

		$new_data = $data;


		// end of if statement
		if ($is_serverside == true) {
			if ($is_other == true) {
				$new_data['other'] = $other_data;
				die(json_encode($new_data));
			} else {
				die(json_encode($new_data));
			}
		} elseif ($is_other == true) {
			die(json_encode(array('data' => $new_data, 'other' => $other_data)));
		} else {
			die(json_encode(array('data' => $new_data)));
		}
	}

	function berkas_save($dataPost) {
		// insert data transaksi berkas
		$is_success = false;

		if (isset($_FILES['file_berkas'])) {
			$nameShort = 'berkas_';
			// $file_path = $this->path_upload_file.'/'.$this->sess_auth['user_dir'].'/';
			$config_upload = array(
				// 'upload_path' =>$file_path
			);

			$uploadData0 = $this->uploadsData('file_berkas', $config_upload, $nameShort);

			$res_uploadData0 = $uploadData0['data'];

			if ($uploadData0['success']) {
				$dataPost['file_berkas'] = $res_uploadData0['filename'];
			} else {
				// error
			}
		}

		if (isset($_FILES['file_akta_kelahiran'])) {
			$nameShort = 'akta_';
			// $file_path = $this->path_upload_file.'/'.$this->sess_auth['user_dir'].'/';
			$config_upload = array(
				// 'upload_path' =>$file_path
			);

			$uploadData1 = $this->uploadsData('file_akta_kelahiran', $config_upload, $nameShort);

			$res_uploadData1 = $uploadData1['data'];

			if ($uploadData1['success']) {
				$dataPost['file_akta'] = $res_uploadData1['filename'];
			} else {
				// error
			}
		}

		if (isset($_FILES['file_kartu_keluarga'])) {
			$nameShort = 'kk_';
			// $file_path = $this->path_upload_file.'/'.$this->sess_auth['user_dir'].'/';
			$config_upload = array(
				// 'upload_path' =>$file_path
			);

			$uploadData2 = $this->uploadsData('file_kartu_keluarga', $config_upload, $nameShort);

			$res_uploadData2 = $uploadData2['data'];

			if ($uploadData2['success']) {
				$dataPost['file_kk'] = $res_uploadData2['filename'];
			} else {
				// error
			}
		}

		if (isset($_FILES['file_raport'])) {
			$nameShort = 'raport_';
			// $file_path = $this->path_upload_file.'/'.$this->sess_auth['user_dir'].'/';
			$config_upload = array(
				// 'upload_path' =>$file_path
			);

			$uploadData3 = $this->uploadsData('file_raport', $config_upload, $nameShort);

			$res_uploadData3 = $uploadData3['data'];

			if ($uploadData3['success']) {
				$dataPost['file_raport'] = $res_uploadData3['filename'];
			} else {
				// error
			}
		}

		if (isset($_FILES['file_ijazah'])) {
			$nameShort = 'ijazah_';
			// $file_path = $this->path_upload_file.'/'.$this->sess_auth['user_dir'].'/';
			$config_upload = array(
				// 'upload_path' =>$file_path
			);

			$uploadData4 = $this->uploadsData('file_ijazah', $config_upload, $nameShort);

			$res_uploadData4 = $uploadData4['data'];

			if ($uploadData4['success']) {
				$dataPost['file_ijazah'] = $res_uploadData4['filename'];
			} else {
				// error
			}
		}


		$this->db->trans_begin();

		$this->db->insert($this->table, $dataPost);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$is_success = false;
		} else {
			$this->db->trans_commit();
			$is_success = true;
		}
		return $is_success;
	}


	function berkas_update($dataPost, $where) {
		$this->db->trans_begin();

		$this->db->update($this->table, $dataPost, $where);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$is_success = false;
		} else {
			$this->db->trans_commit();
			$is_success = true;
		}
		return $is_success;
	}

	function gen_noRegistrasi() {
		$tahun_now = date('Y');

		$this->db->select("IFNULL( max( SUBSTR( a.no_registrasi, 5, 99 )), 0 )+1 AS no_reg");
		$this->db->from($this->table . ' as a');
		$this->db->where('SUBSTR( a.no_registrasi, 1, 4 ) =', $tahun_now);
		$get = $this->db->get();

		$no_reg = 1;
		if ($get) {
			$data = $get->result_array();
			if ($data) {
				$data = $data[0];
				$no_reg = $data['no_reg'];
			}
		}
		return $tahun_now . $no_reg;
	}

	function berkas_unduh($id_verifikasi) {
		$path_file = $this->path_upload_file . '/';
		// $path_file = $this->upload_file_path_;
		$filename_download = $this->sess_auth['user_dir'] . '.zip';

		$this->db->select("a.id_verifikasi, a.id_profile, a.nama_submiter, a.nama_siswa, a.nisn_siswa, a.no_registrasi, a.file_berkas, a.file_akta, a.file_kk, a.file_raport, a.file_ijazah, a.status_verifikasi, a.tgl_lahir, c.user_dir");
		$this->db->from($this->table . ' as a');
		$this->db->join($this->table_profile . ' as b', 'a.id_profile = b.id_profile', 'inner');
		$this->db->join($this->table_akun . ' as c', 'b.id_akun = c.id_akun', 'inner');
		$this->db->where('a.id_verifikasi', $id_verifikasi);
		$get = $this->db->get();

		if ($get) {
			$data = $get->result_array();
			if (!empty($data)) {
				$temp_data = $data[0];
				$no_registrasi = $temp_data['no_registrasi'];
				$user_dir = $temp_data['user_dir'];

				$path_file .= $user_dir . '/';

				$filename_download = $no_registrasi . '_' . $user_dir . '.zip';

				$file_berkas = $temp_data['file_berkas'];
				$file_akta = $temp_data['file_akta'];
				$file_kk = $temp_data['file_kk'];
				$file_raport = $temp_data['file_raport'];
				$file_ijazah = $temp_data['file_ijazah'];

				// clear cache zip
				$this->zip->clear_data();

				if (!empty($file_berkas)) {
					$this->zip->read_file($path_file . $file_berkas);
				}

				if (!empty($file_akta)) {
					$this->zip->read_file($path_file . $file_akta);
				}

				if (!empty($file_kk)) {
					$this->zip->read_file($path_file . $file_kk);
				}

				if (!empty($file_raport)) {
					$this->zip->read_file($path_file . $file_raport);
				}

				if (!empty($file_ijazah)) {
					$this->zip->read_file($path_file . $file_ijazah);
				}

				// compress zip to highest
				$this->zip->compression_level = 9;
				$this->zip->download($filename_download);
			}
		}
	}


	function check_isSubmitted($id_profile, $is_return_data = false) {
		$is_submitted = false;
		$r = array('success' => $is_submitted, 'data' => array());

		$this->db->select("a.id_verifikasi, a.status_verifikasi, a.no_registrasi");
		$this->db->from($this->table . ' as a');
		$this->db->where('id_profile', $id_profile);
		$this->db->order_by('a.id_verifikasi', 'DESC');
		$this->db->limit(1);

		$get = $this->db->get();

		if ($get) {
			$data = $get->result_array();
			if (!empty($data)) {
				$is_submitted = true;
				$r = array('success' => $is_submitted, 'data' => $data[0]);
			}
		}
		return $r;
	}




	private function uploadsData($inputpostName, $config = array(), $nameShort = '') {

		$new_namez = $_FILES[$inputpostName]['name'];
		$new_name  = $nameShort . microtime(true) . '.' . substr(strtolower(strrchr($new_namez, ".")), 1);
		// $configz['file_name'] = $new_name;
		$configz = array(
			'file_name'     => $new_name,
			'upload_path'   => $this->upload_file_path_,
			// 'allowed_types' => 'gif|jpg|jpeg|png|bmp|pdf',
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
