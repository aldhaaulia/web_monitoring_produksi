<?php

/**
 *
 * Created at 2022-06-02 19:17:55
 * Updated at
 *
 */

class M_Laporan extends MY_Model {
	private $table_customer = 'tm_customer';
    private $table_barang = 'tm_barang';
    private $table_project = 'tm_project';
	private $table_status_produksi = 'tm_status_produksi';
    // public $

    function __construct() {
		parent::__construct();
	}

    function save($dataPost){
        $this->db->status_produksi_begin();

		$this->db->insert($this->table_status_produksi, $dataPost);

    }

	function edit($dataPost){
		$this->db->status_produksi_begin();

	}

	function monitoring_getByid($id) {
		$is_success = false;
		$new_data = array();
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

	function monitoring_list() {

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
	// end of class
}
