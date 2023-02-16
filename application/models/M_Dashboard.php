<?php

/**
 *
 * Created at 2022-06-02 19:17:55
 * Updated at
 *
 */

class M_Dashboard extends MY_Model {
    
    private $table_customer = 'tm_customer';
    private $table_barang = 'tm_barang';
	private $_table = "tm_jenis_barang";
    private $table_project = 'tm_project';
    private $table_transaksi = 'tr_transaksi';
    // public $

    function __construct() {
		parent::__construct();
	}

    function save($dataPost){
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

	function getCustomerName(){
	
	}

	function getProjectId(){
		
	}

    
	// end of class
}
