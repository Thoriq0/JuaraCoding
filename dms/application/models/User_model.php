<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function new_password($data,$id){
       $this->db->where('id', $id);
       $this->db->update('master_user', $data);
    }

    public function dataFieldById($table,$field,$table_id,$id){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where($table_id,$id);
        $query = $this->db->get();
        return $query->row();
    }
}