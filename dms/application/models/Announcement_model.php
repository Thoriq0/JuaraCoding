<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Announcement_model extends MY_Model
{

    function __construct()
    {
        parent::__construct();
    }
    function getdataReminder()
    {
        $now = date('Y-m-d');
        $this->db->select('id');
        $this->db->from('eksternal_dokumen');
        $this->db->like('tgl_reminder', $now);
        $query = $this->db->get();
        
        return $query;
    }

    function getdataReminder2()
    {
        $now = date('Y-m-d');
        $this->db->select('id');
        $this->db->from('internal_dokumen');
        $this->db->like('tgl_reminder', $now);
        $query = $this->db->get();
        
        return $query;
    }

    function getdataNonactiveExternal()
    {
        $now = date('Y-m-d');
        $this->db->select('id');
        $this->db->from('eksternal_dokumen');
        $this->db->where(" template <> 'Perizinan'");
        $this->db->where('is_status', 1);
        $this->db->where('tgl_berlaku <=', $now);
        $query = $this->db->get();
        
        return $query;
    }

    function getdataNonactivePerizinan()
    {
        $now = date('Y-m-d');
        $this->db->select('id');
        $this->db->from('eksternal_dokumen');
        $this->db->where(" template = 'Perizinan'");
        $this->db->where('is_status', 1);
        $this->db->where('tgl_berlaku <=', $now);
        $query = $this->db->get();
        
        return $query;
    }

    function getdataNonactiveInternal()
    {
        $now = date('Y-m-d');
        $this->db->select('id');
        $this->db->from('internal_dokumen');
        $this->db->where('is_status', 1);
        $this->db->where('tgl_berlaku <=', $now);
        $query = $this->db->get();
        
        return $query;
    }

    function updateDokumenRow($table,$where,$data){
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function dataUser($id){
        // cekvar($id);
        $this->db->select('ref_akses_eksternal_dokumen.*,master_user.nama as nama_user, master_user.email as email, eksternal_dokumen.*');
        // $this->db->distinct('internal_dokumen');
        $this->db->from('ref_akses_eksternal_dokumen');
        $this->db->join('master_user','master_user.nik = ref_akses_eksternal_dokumen.user');
        $this->db->join('eksternal_dokumen','eksternal_dokumen.id = ref_akses_eksternal_dokumen.id_dokumen');
        // $this->db->group_by("internal_dokumen.id"); 
        $this->db->where('ref_akses_eksternal_dokumen.id_dokumen',$id);
        $query = $this->db->get();
        // return $query;
        return $query->result_array();
    }

    public function dataUser2($id){
        // cekvar($id);
        $this->db->select('ref_akses_internal_dokumen.*,master_user.nama as nama_user, master_user.email as email, internal_dokumen.*');
        // $this->db->distinct('internal_dokumen');
        $this->db->from('ref_akses_internal_dokumen');
        $this->db->join('master_user','master_user.departemen = ref_akses_internal_dokumen.departemen AND master_user.tingkat_akses = ref_akses_internal_dokumen.tingkat_akses');
        $this->db->join('internal_dokumen','internal_dokumen.id = ref_akses_internal_dokumen.id_dokumen');
        // $this->db->group_by("internal_dokumen.id"); 
        $this->db->where('ref_akses_internal_dokumen.id_dokumen',$id);
        $query = $this->db->get();
        // return $query;
        return $query->result_array();
    }
    
    function getdata()
    {
        $this->db->select('*');
        $this->db->from('`db_hrd`.`data_announcement`');
        $this->db->join('`db_hrd`.`ref_announcement_category`', '`db_hrd`.`ref_announcement_category`.`Category` = `db_hrd`.`data_announcement`.`Category`');
        $this->db->where('Schedule !=', 'manual');
        $this->db->where('Is_Publish', '1');
        $query = $this->db->get();
		
        return $query;
        $query->free_result();
    }
    function getdataemployeebirthday($employ)
    {
        $this->db->select('*');
        $this->db->from('`db_hrd`.`data_employee`');
        $this->db->where('Status', 'ACTIVE');
		$this->db->where('Departement', 'Operational - KP');
		
		//prod
		$this->db->like('Date_Of_Birth', '-' . date('m-d'));
        if ($employ != "0") {
            $this->db->where('Employee_ID', $employ);
        }
        $this->db->where('Email_Dika !=', '');
		
		//dev
        //$this->db->like('Name', 'perwira abrianto'); //fujishop80@gmail.com
		// $this->db->like('Name', 'VILLIANO C V'); //villiano.velberg@ptdika.com
		// $this->db->like('Name', 'santi widyawatik'); //santi.widyawatik@ptdika.com
		// $this->db->like('Name', 'ANI ARYANI'); //ani.aryani@ptdika.com
		
		
		
        $query = $this->db->get();
		
        return $query;
        $query->free_result();
    }

    function getdataemployee($employ)
    {
        $this->db->select('*');
        $this->db->from('`db_hrd`.`data_employee`');
        $this->db->where('Status', 'ACTIVE');
        if ($employ != "0") {
            $this->db->where('Employee_ID', $employ);
        }
        $this->db->where('Email_Dika !=', '');
        $this->db->like('Name', 'perwira abrianto');
        $query = $this->db->get();
        return $query;
        $query->free_result();
    }
    function insert($data_insert)
    {
        $this->db->insert('`db_hrd`.`wa_webhook`', $data_insert);
    }
}
