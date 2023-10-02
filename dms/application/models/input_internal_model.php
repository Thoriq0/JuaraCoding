<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_internal_model extends MY_Model {

    function __construct()
	{
		parent::__construct();
	}

    function insert_checklist ($data)
	{
		$this->db->insert('ref_departemen_akses',$data);
		return $this->db->insert_id();
	}
}