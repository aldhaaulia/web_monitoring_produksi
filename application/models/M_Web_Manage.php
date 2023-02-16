<?php

/**
 *
 * Created at 2022-06-08 12:26:21
 * Updated at
 *
 */

class M_Web_Manage extends CI_Model {
	private $path_upload_file = './assets/Frontend/uploads/';

	private $table_slider = 'tm_slider';
	private $table_setting = 'tm_settings';

	function __construct() {
		parent::__construct();
	}

	function slider_getByid($id) {
		$is_success = false;
		$new_data = array();

		$this->db->select('a.id, a.title, a.subtitle, a.`desc`, a.image');
		$this->db->from($this->table_slider . ' as a');
		$this->db->where('a.id', $id);
		$this->db->limit(1);
		$get = $this->db->get();

		if ($get) {
			$data = $get->result_array();
			if (!empty($data)) {
				$is_success = true;
				$new_data = $data[0];
			}
		}

		$r = array('success' => $is_success, 'data' => $new_data);
		die(json_encode($r));
	}

	function slider_list() {

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
		$select    = 'a.*, a.is_active as status';
		$tbl_query = $this->table_slider . ' as a';
		$joinTable = array();
		$joinCond  = array();
		$column_search = array();
		$column_order  = array();
		$where = array(
			// 'a.is_active' => '1'
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

		$path_slider = base_url() . 'assets/Frontend/uploads/slider/';

		foreach ($data['data'] as $row) {
			$ro = $row;

			unset($ro['tgl_create'], $ro['tgl_update']);

			$ro = json_encode($ro);

			$ro = str_replace('"', "'", $ro);
			$status = $row['status'];
			$image = $row['image'];

			if ($status == '1') {
				$txt_status = 'Aktif';
			} else {
				$txt_status = 'Tidak Aktif';
			}

			$row['image'] = '<img class="img-fluid" style="width:100%;" src="' . $path_slider . $image . '">';
			$row['status'] = $txt_status;


			$row['act'] = "<div class='btn-group'>";

			// $judul_delete = 'Username: <b>' . $row['username'] . '</b>, Apikey: <b>' . $row['apikey'] . '</b>';

			$row['act'] .= "<a class='btn btn-warning btn-flat' href='javascript:void(0);' title='Ubah data' onclick=\"popUpMdl({id:'" . $row['id'] . "'});\"> <i class='fas fa-edit'></i></a>";

			if ($status != '1') {
				// update to active
				$row['act'] .= "<a class='btn btn-success btn-flat' href='javascript:void(0);' title='Ubah status jadi aktif' onclick=\"set_status({id:'" . $row['id'] . "', status: '1'});\"> <i class='fas fa-check'></i></a>";
			} else {
				// update to not active
				$row['act'] .= "<a class='btn btn-danger btn-flat' href='javascript:void(0);' title='Ubah status jadi tidak aktif' onclick=\"set_status({id:'" . $row['id'] . "', status: '0'});\"> <i class='fas fa-times'></i></a>";
			}


			$row['act'] .= "</div>";

			// $row['act'] .= "<div class='btn-group'><a class='btn' href='javascript:void(0);' title='Edit Data' onclick=\"popOut('mdladd','Edit data',".$ro.");\"> <i class='fa fa-pencil' style='color: blue;'></i></a></div>";


			// $row['act'] .= "<div class='btn-group'><a class='btn' href='javascript:void(0);' title='Hapus Data' onclick=\"popDelete('mdldel',{id:'" . $row['id'] . "',judul:'" . $judul_delete . "'});\"><i class='fa fa-close' style='color: red;'></i></a></div>";


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

	function slider_add($dataPost) {
		$is_success = false;

		if (isset($_FILES['file_image'])) {
			$nameShort = 'slider_';
			$file_path = $this->path_upload_file . '/slider/';
			$config_upload = array(
				'upload_path' => $file_path
			);

			$uploadData = $this->uploadsData('file_image', $config_upload, $nameShort);

			$res_uploadData = $uploadData['data'];

			if ($uploadData['success']) {
				$dataPost['image'] = $res_uploadData['filename'];
			} else {
				// error
			}
		}

		$this->db->trans_begin();

		$this->db->insert($this->table_slider, $dataPost);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$is_success = false;
		} else {
			$this->db->trans_commit();
			$is_success = true;
		}
		return $is_success;
	}

	function slider_update($dataPost, $where) {

		if (isset($_FILES['file_image'])) {
			$nameShort = 'slider_';
			$file_path = $this->path_upload_file . '/slider/';
			$config_upload = array(
				'upload_path' => $file_path
			);

			$uploadData = $this->uploadsData('file_image', $config_upload, $nameShort);

			$res_uploadData = $uploadData['data'];

			if ($uploadData['success']) {
				$dataPost['image'] = $res_uploadData['filename'];
			} else {
				// error
			}
		}


		$this->db->trans_begin();

		$this->db->update($this->table_slider, $dataPost, $where);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$is_success = false;
		} else {
			$this->db->trans_commit();
			$is_success = true;
		}
		return $is_success;
	}


	function about_update($dataPost) {
		$tgl_now = date('Y-m-d H:i:s');
		$this->db->trans_begin();

		if (isset($dataPost['title'])) {
			$where = array('name' => 'about_school_title');
			$dataSave['value'] = $dataPost['title'];
			$dataSave['tgl_update'] = $tgl_now;

			$this->db->update($this->table_setting, $dataSave, $where);
		}

		if (isset($dataPost['desc'])) {
			$where = array('name' => 'about_school_desc');
			$dataSave['value'] = $dataPost['desc'];
			$dataSave['tgl_update'] = $tgl_now;

			$this->db->update($this->table_setting, $dataSave, $where);
		}

		if (isset($_FILES['file_image'])) {
			$nameShort = 'about_';
			$file_path = $this->path_upload_file . '/about/';
			$config_upload = array(
				'upload_path' => $file_path
			);

			$uploadData = $this->uploadsData('file_image', $config_upload, $nameShort);

			$res_uploadData = $uploadData['data'];

			if ($uploadData['success']) {
				$where = array('name' => 'about_school_image');

				$dataSave['value'] = $res_uploadData['filename'];
				$dataSave['tgl_update'] = $tgl_now;

				$this->db->update($this->table_setting, $dataSave, $where);
			} else {
				// error
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

	function contact_update($dataPost) {
		$tgl_now = date('Y-m-d H:i:s');
		$this->db->trans_begin();

		if (isset($dataPost['no_telp'])) {
			$where = array('name' => 'contact_phone');
			$dataSave['value'] = $dataPost['no_telp'];
			$dataSave['tgl_update'] = $tgl_now;

			$this->db->update($this->table_setting, $dataSave, $where);
		}

		if (isset($dataPost['email'])) {
			$where = array('name' => 'contact_email');
			$dataSave['value'] = $dataPost['email'];
			$dataSave['tgl_update'] = $tgl_now;

			$this->db->update($this->table_setting, $dataSave, $where);
		}

		if (isset($dataPost['address'])) {
			$where = array('name' => 'contact_address');
			$dataSave['value'] = $dataPost['address'];
			$dataSave['tgl_update'] = $tgl_now;

			$this->db->update($this->table_setting, $dataSave, $where);
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

	function berkas_update($dataPost) {
		$tgl_now = date('Y-m-d H:i:s');
		$this->db->trans_begin();

		if (isset($dataPost['approve'])) {
			$where = array('name' => 'berkas_status_approved');
			$dataSave['value'] = $dataPost['approve'];
			$dataSave['tgl_update'] = $tgl_now;

			$this->db->update($this->table_setting, $dataSave, $where);
		}

		if (isset($dataPost['review'])) {
			$where = array('name' => 'berkas_status_review');
			$dataSave['value'] = $dataPost['review'];
			$dataSave['tgl_update'] = $tgl_now;

			$this->db->update($this->table_setting, $dataSave, $where);
		}

		if (isset($dataPost['reject'])) {
			$where = array('name' => 'berkas_status_rejected');
			$dataSave['value'] = $dataPost['reject'];
			$dataSave['tgl_update'] = $tgl_now;

			$this->db->update($this->table_setting, $dataSave, $where);
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

	function web_update($dataPost) {
		$tgl_now = date('Y-m-d H:i:s');
		$this->db->trans_begin();

		if (isset($dataPost['name'])) {
			$where = array('name' => 'school_name');
			$dataSave['value'] = $dataPost['name'];
			$dataSave['tgl_update'] = $tgl_now;

			$this->db->update($this->table_setting, $dataSave, $where);
		}

		if (isset($dataPost['desc'])) {
			$where = array('name' => 'school_desc');
			$dataSave['value'] = $dataPost['desc'];
			$dataSave['tgl_update'] = $tgl_now;

			$this->db->update($this->table_setting, $dataSave, $where);
		}

		if (isset($_FILES['file_image'])) {
			$nameShort = 'logo_';
			$file_path = $this->path_upload_file . '/logo/';
			$config_upload = array(
				'upload_path' => $file_path
			);

			$uploadData = $this->uploadsData('file_image', $config_upload, $nameShort);

			$res_uploadData = $uploadData['data'];

			if ($uploadData['success']) {
				$where = array('name' => 'school_logo');

				$dataSave['value'] = $res_uploadData['filename'];
				$dataSave['tgl_update'] = $tgl_now;

				$this->db->update($this->table_setting, $dataSave, $where);
			} else {
				// error
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

	private function uploadsData($inputpostName, $config = array(), $nameShort = '') {

		$new_namez = $_FILES[$inputpostName]['name'];
		$new_name  = $nameShort . microtime(true) . '.' . substr(strtolower(strrchr($new_namez, ".")), 1);
		// $configz['file_name'] = $new_name;
		$configz = array(
			'file_name'     => $new_name,
			'upload_path'   => $this->path_upload_file,
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
