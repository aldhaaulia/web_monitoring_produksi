<?php

/**
 *
 * Created at 2022-06-09 12:58:50
 * Updated at
 *
 */

class MY_Model extends CI_Model {
	private $table_setting = 'tm_settings';

	function __construct() {
		parent::__construct();
	}

	function get_setting() {
		$new_data = array();

		$this->db->select('*');
		$this->db->from($this->table_setting);
		$get = $this->db->get();

		if ($get) {
			$data = $get->result_array();
			if (!empty($data)) {
				$path_logo = base_url().'assets/Frontend/uploads/logo/';
				$path_about = base_url().'assets/Frontend/uploads/about/';

				foreach ($data as $key => $val) {

					if($val['name'] == 'school_logo'){
						$school_logo = $val['value'];
						$val['value'] = $path_logo.$school_logo;
					}

					if($val['name'] == 'about_school_image'){
						$about_school_image = $val['value'];
						$val['value'] = $path_about.$about_school_image;
					}

					$new_data[] = $val;
				}
			}
		}


		// print_r($new_data);exit;

		if(!empty($new_data)){
			$new_data = array_column($new_data, 'value', 'name');
		}

		return $new_data;
	}

	// end of class
}
