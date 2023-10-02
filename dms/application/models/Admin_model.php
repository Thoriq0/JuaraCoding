<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_data($table, $order){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function get_akses(){
        $this->db->select('*');
        $this->db->from('ref_tingkat_akses');
		$this->db->group_by('akses');
        $this->db->order_by('akses','ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dataById($table,$table_id,$id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($table_id,$id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dataById2($table,$where){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dataByIdDoc($table,$table_id,$id){
        $this->db->select();
        // $this->db->distinct('ref_departemen_akses.id_departemen');
        $this->db->from($table);
        $this->db->where($table_id,$id);
        $this->db->group_by('departemen');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dataAksesDoc($fielddoc,$idDoc,$fieldakses,$idakses){
        $this->db->select('*');
        $this->db->from('ref_departemen_akses');
        $this->db->where($fielddoc,$idDoc);
        $this->db->where($fieldakses,$idakses);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function countAll($table){
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get()->num_rows();
        return $query;
    }

    public function getDataByDepAkses($table,$dept,$deptname, $akses, $aksesname){
        $this->db->select('internal_dokumen.*, ref_departemen_akses.departemen as docdept');
        $this->db->from($table);
        $this->db->join('ref_departemen_akses','ref_departemen_akses.id_dokumen = internal_dokumen.id');
        $this->db->where('ref_departemen_akses.departemen',$deptname);
        $this->db->where('ref_departemen_akses.tingkat_akses',$aksesname);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function countAllByDepAkses($table,$deptname,$aksesname){
        $this->db->select('internal_dokumen.*, ref_akses_internal_dokumen.departemen as docdept');
        $this->db->from($table);
        $this->db->join('ref_akses_internal_dokumen','ref_akses_internal_dokumen.id_dokumen = internal_dokumen.id');
        $this->db->where('ref_akses_internal_dokumen.id_departemen',$deptname);
        $this->db->where('ref_akses_internal_dokumen.id_tingkat_akses',$aksesname);
        $query = $this->db->get()->num_rows();
        return $query;
    }
	
	public function getCountInternal(){
        $this->db->select('id');
        $this->db->from('internal_dokumen');
        $query = $this->db->get()->num_rows();
        return $query;
    }
	
	public function getCountEksternal(){
        $this->db->select('id');
        $this->db->from('eksternal_dokumen');
		$this->db->where('template !=','Perizinan');
        $query = $this->db->get()->num_rows();
        return $query;
    }
	
	public function getCountIzin(){
        $this->db->select('id');
        $this->db->from('eksternal_dokumen');
		$this->db->where('template =','Perizinan');
        $query = $this->db->get()->num_rows();
        return $query;
    }
	

    public function getLimitByDepAkses($table,$deptname,$aksesname,$limit,$start){
        $this->db->select('internal_dokumen.*, ref_akses_internal_dokumen.departemen as docdept, ref_akses_internal_dokumen.tingkat_akses as docakses');
        $this->db->from($table);
        $this->db->join('ref_akses_internal_dokumen','ref_akses_internal_dokumen.id_dokumen = internal_dokumen.id');
        $this->db->where('ref_akses_internal_dokumen.id_departemen',$deptname);
        $this->db->where('ref_akses_internal_dokumen.id_tingkat_akses',$aksesname);
        $this->db->limit($limit,$start);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function countAllByDepAksesWhere($table,$deptname,$aksesname,$no= null,$nama = null, $dept_id = null){
        $this->db->select('internal_dokumen.*, ref_akses_internal_dokumen.departemen as docdept');
        $this->db->from($table);
        $this->db->join('ref_akses_internal_dokumen','ref_akses_internal_dokumen.id_dokumen = internal_dokumen.id');
        $this->db->where('ref_akses_internal_dokumen.id_departemen',$deptname);
        $this->db->where('ref_akses_internal_dokumen.id_tingkat_akses',$aksesname);
        if(!empty($no))$this->db->like('internal_dokumen.no_dokumen',$no);
		if(!empty($nama))$this->db->like('internal_dokumen.nama_dokumen',$nama);
        if(!empty($dept_id))$this->db->where('internal_dokumen.id_departemen',$dept_id);
        $query = $this->db->get()->num_rows();
        return $query;
    }
	
	/*
    public function getLimitByDepAksesWhere($table,$deptname,$aksesname,$limit,$start,$no= null,$nama = null,$dept_id = null){
        $this->db->select('internal_dokumen.*, ref_akses_internal_dokumen.departemen as docdept, ref_akses_internal_dokumen.tingkat_akses as docakses');
        $this->db->from($table);
        $this->db->join('ref_akses_internal_dokumen','ref_akses_internal_dokumen.id_dokumen = internal_dokumen.id');
        $this->db->where('ref_akses_internal_dokumen.id_departemen',$deptname);
        $this->db->where('ref_akses_internal_dokumen.id_tingkat_akses',$aksesname);
        if(!empty($no))$this->db->like('internal_dokumen.no_dokumen',$no);
		if(!empty($nama))$this->db->like('internal_dokumen.nama_dokumen',$nama);
        if(!empty($dept_id))$this->db->where('internal_dokumen.id_departemen',$dept_id);
        $this->db->limit($limit,$start);
        $query = $this->db->get()->result_array();
        return $query;
    }
	*/
	
	public function _query_getLimitByDepAksesWhere($deptname,$aksesname,$no,$nama,$dept_id,$file_exist){

        $column_order = array(null,'a.no_dokumen'); 
        $column_search = array('a.no_dokumen', 'a.nama_dokumen', 'a.group_dokumen', 'a.tgl_dokumen', 'a.tgl_input'); //field yang diizin untuk pencarian 
        $order = array('a.tgl_input' => 'DESC'); // default order

        $this->db->select('a.*, b.departemen as docdept, b.tingkat_akses as docakses,c.nama');
        $this->db->from('internal_dokumen a');
        $this->db->join('ref_akses_internal_dokumen b','b.id_dokumen = a.id','left');
        $this->db->join('master_user c','c.nik = a.username','left');
        
        if($this->session->userdata('tipe')=='admin'){
            $this->db->group_by('a.id');
        }else{
            $this->db->where('b.id_departemen',$deptname);
            // $this->db->where('internal_dokumen.id_departemen',$deptname);
            $this->db->where('b.id_tingkat_akses',$aksesname);
        }
        if(!empty($no))$this->db->like('a.no_dokumen',$no);
        if(!empty($nama))$this->db->like('a.nama_dokumen',$nama);
        if(!empty($dept_id))$this->db->where('a.id_departemen',$dept_id);
        if(!empty($file_exist) && $file_exist==1){
            $this->db->where('a.file !=','');
        }elseif(!empty($file_exist) && $file_exist==2){
            $this->db->where('a.file','');
        }
        
        $i = 0;
        foreach ($column_search as $item) // looping awal
        {
            if (isset($_POST['search']['value'])) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) { // looping awal
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function getLimitByDepAksesWhere($deptname,$aksesname,$no,$nama,$dept_id,$file_exist){
        $this->_query_getLimitByDepAksesWhere($deptname,$aksesname,$no,$nama,$dept_id,$file_exist);
        if (isset($_POST['length']) && $_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query;
    }
	
    function count_filtered_getLimitByDepAksesWhere($deptname,$aksesname,$no,$nama,$dept_id,$file_exist)
    {
        $this->_query_getLimitByDepAksesWhere($deptname,$aksesname,$no,$nama,$dept_id,$file_exist);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getDoc($table,$limit, $start){
       return $this->db->get($table, $limit, $start)->result_array();

    }

    public function getDataDoc($id){
        $this->db->select('internal_dokumen.*');
        // $this->db->distinct('internal_dokumen');
        $this->db->from('internal_dokumen');
        // $this->db->join('master_lokasi','master_lokasi.id = internal_dokumen.lokasi');
        // $this->db->join('master_media','master_media.id = internal_dokumen.media');
        // $this->db->join('ref_departemen_akses','ref_departemen_akses.id_dokumen = internal_dokumen.id');
        // $this->db->join('ref_dokumen_tingkat_akses','ref_dokumen_tingkat_akses.id_dokumen = internal_dokumen.id');
        // $this->db->group_by("internal_dokumen.id"); 
        $this->db->where('internal_dokumen.id',$id);
        $query = $this->db->get();
        // return $query;
        return $query->row_array();
    }

    public function getDataDocExternal($id){
        $this->db->select('eksternal_dokumen.*');
        // $this->db->distinct('internal_dokumen');
        $this->db->from('eksternal_dokumen');
        // $this->db->join('master_media','master_media.id = eksternal_dokumen.media');
        // $this->db->join('ref_departemen_akses','ref_departemen_akses.id_dokumen = internal_dokumen.id');
        // $this->db->join('ref_dokumen_tingkat_akses','ref_dokumen_tingkat_akses.id_dokumen = internal_dokumen.id');
        // $this->db->group_by("internal_dokumen.id"); 
        $this->db->where('eksternal_dokumen.id',$id);
        $query = $this->db->get();
        // return $query;
        return $query->row_array();
    }

    public function joinData($id){
        $this->db->select('internal_dokumen.*, ref_departemen_akses.departemen as nama_depar');
        // $this->db->distinct('internal_dokumen');
        $this->db->from('internal_dokumen');
        $this->db->join('ref_departemen_akses','ref_departemen_akses.id_dokumen = internal_dokumen.id');
        // $this->db->join('ref_dokumen_tingkat_akses','ref_dokumen_tingkat_akses.id_dokumen = internal_dokumen.id');
        // $this->db->group_by("internal_dokumen.id"); 
        $this->db->where('internal_dokumen.id',$id);
        $query = $this->db->get();
        // return $query;
        return $query->row_array();
        // return $query->result_array();
    }

    public function dataUser($id){
        // cekvar($id);
        $this->db->select('ref_akses_eksternal_dokumen.*,master_user.nama as nama_user, master_user.email as email, eksternal_dokumen.*');
        // $this->db->distinct('internal_dokumen');
        $this->db->from('ref_akses_eksternal_dokumen');
        $this->db->join('master_user','master_user.nama = ref_akses_eksternal_dokumen.user');
        $this->db->join('eksternal_dokumen','eksternal_dokumen.id = ref_akses_eksternal_dokumen.id_dokumen');
        // $this->db->group_by("internal_dokumen.id"); 
        $this->db->where('ref_akses_eksternal_dokumen.id_dokumen',$id);
        $query = $this->db->get();
        // return $query;
        return $query->result_array();
    }

    function tambah($table, $data){
        $this->db->insert($table, $data);
        return TRUE;
    }

    function del_data($id,$table){
        $this->db->where('id', $id);
        $this->db->delete($table);
    }

    function update_data($id, $table, $data){
        $this->db->where('id',$id);
		$this->db->update($table,$data);
    }

    function insert_checklist ($table,$data)
	{
		$this->db->insert($table,$data);
		// return $this->db->insert_id();
        return TRUE;
	}

    // function checkChecklistDept($table, $fieldOne, $fieldTwo, $idOne, $idTwo){
    //     $this->db->select('*');
    //     $this->db->from($table);
    //     $this->db->where($fieldOne,$idOne);
    //     $this->db->where($fieldTwo,$idTwo);
    //     $query = $this->db->get()->num_rows();
    //     return $query;
    // }

    // function checkChecklistAkses($table, $fieldOne, $fieldTwo, $fieldThree, $idOne, $idTwo, $idThree){
    //     $this->db->select('*');
    //     $this->db->from($table);
    //     $this->db->where($fieldOne,$idOne);
    //     $this->db->where($fieldTwo,$idTwo);
    //     $this->db->where($fieldThree,$idThree);
    //     $query = $this->db->get()->num_rows();
    //     return $query;
    // }

    function delete_checklist ($table, $data)
	{	
		$this->db->where('id_dokumen',$data);
		$this->db->delete($table);
        // $this->db->delete($table, array('id_dokumen' => $data));
	}


    public function get_template_where_kategori($order, $where){
        $this->db->select('*');
        $this->db->from('ref_template_no_surat');
        $this->db->where('kategori',$where);
        $this->db->order_by($order,'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataByFieldName($table, $fieldname){
        $this->db->select($fieldname);
        $this->db->from($table);        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataByFieldNameOrder($table,$fieldname,$fieldorder,$order){
        $this->db->select($fieldname);
        $this->db->from($table);
        $this->db->order_by($fieldorder,$order);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataByFieldNameExceptId($table, $fieldname, $id){
        $this->db->select($fieldname);
        $this->db->from($table);
        $this->db->where_not_in('id', $id);        
        $query = $this->db->get();
        return $query->result_array();
    }

    function getActionById($id){
        $this->db->from('master_action');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result_array();
    }
	
	function dataDokumen($field,$table,$limit,$start,$katakunci = null,$bulan = null,$dept_id = null){
        $this->db->select($field);
        $this->db->from($table);
        if(!empty($katakunci))$this->db->where('no_dokumen',$katakunci);
        if(!empty($dept_id))$this->db->where('id_departemen',$dept_id);
        if(!empty($bulan)){
            $dateNow = date('Y-m-d');
            $dateSoon = date('Y-m-d', strtotime('+'.$bulan.' days', strtotime($dateNow)));
            $tgl_sekarang = $dateNow;
            $sampai_tgl = $dateSoon;
            $this->db->where(" tgl_berlaku BETWEEN ' ". $tgl_sekarang ." ' AND ' ". $sampai_tgl ." ' ");
        }
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        return $query;
    }
	
    /*function dataDokumenExt($field,$table,$no = null,$nama = null,$dept_id = null,$limit = null,$start = null/*,$bulan = null*){
        $this->db->select($field);
        $this->db->from($table);
        if(!empty($no))$this->db->like('no_dokumen',$no);
        if(!empty($nama))$this->db->like('nama_perijinan',$nama);
        if(!empty($dept_id))$this->db->where('id_departemen',$dept_id);
        /*if(!empty($bulan)){
            $dateNow = date('Y-m-d');
            $dateSoon = date('Y-m-d', strtotime('+'.$bulan.' days', strtotime($dateNow)));
            $tgl_sekarang = $dateNow;
            $sampai_tgl = $dateSoon;
            $this->db->where(" tgl_berlaku BETWEEN ' ". $tgl_sekarang ." ' AND ' ". $sampai_tgl ." ' ");
			
        }*
		$this->db->where(" template <> 'Perizinan'");
        if(!empty($limit)||!empty($start))$this->db->limit($limit,$start);
        $query = $this->db->get();
        return $query;
    }*/

    function _query_dataDokumenExt($no,$nama,$dept_id,$file_exist){

        $column_order = array(null,'ext.no_dokumen'); 
        $column_search = array('ext.no_dokumen', 'ext.nama_perijinan', 'ext.nama_klien', 'ext.publish_by', 'ext.owner_name', 'ext.tim_terkait'); //field yang diizin untuk pencarian 
        $order = array('ext.create_date' => 'DESC'); // default order

        $this->db->select('ext.*,c.nama');
        $this->db->from('eksternal_dokumen ext');
        $this->db->join('ref_akses_eksternal_dokumen','ref_akses_eksternal_dokumen.id_dokumen = ext.id','left');
        $this->db->join('master_user c','c.nik = ext.create_by','left');
		
        if($this->session->userdata('tipe')=='admin'){
            $this->db->group_by('ext.id');
        }else{
            // $this->db->where('ref_akses_eksternal_dokumen.departemen',$this->session->userdata('division'));
            $this->db->where('ref_akses_eksternal_dokumen.departemen',$this->session->userdata('departemen'));
            $this->db->where('ref_akses_eksternal_dokumen.user',$this->session->userdata('nik'));
        }
        if(!empty($no))$this->db->like('ext.no_dokumen',$no);
        if(!empty($nama))$this->db->like('ext.nama_perijinan',$nama);
        if(!empty($dept_id))$this->db->where('ext.id_departemen',$dept_id);
        if(!empty($file_exist) && $file_exist==1){
            $this->db->where('ext.file !=','');
        }elseif(!empty($file_exist) && $file_exist==2){
            $this->db->where('ext.file','');
        }
        /*if(!empty($bulan)){
            $dateNow = date('Y-m-d');
            $dateSoon = date('Y-m-d', strtotime('+'.$bulan.' days', strtotime($dateNow)));
            $tgl_sekarang = $dateNow;
            $sampai_tgl = $dateSoon;
            $this->db->where(" tgl_berlaku BETWEEN ' ". $tgl_sekarang ." ' AND ' ". $sampai_tgl ." ' ");
            
        }*/
        $this->db->where(" ext.template <> 'Perizinan'");
		
        $i = 0;
        foreach ($column_search as $item) // looping awal
        {
            if (isset($_POST['search']['value'])) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) { // looping awal
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $this->db->order_by(key($order), $order[key($order)]);
        }
        
    }

    public function dataDokumenExt($no,$nama,$dept_id,$file_exist){
        $this->_query_dataDokumenExt($no,$nama,$dept_id,$file_exist);
		
        if (isset($_POST['length']) && $_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query;
    }

    function count_filtered_dataDokumenExt($no,$nama,$dept_id,$file_exist)
    {
        $this->_query_dataDokumenExt($no,$nama,$dept_id,$file_exist);
        $query = $this->db->get();
        return $query->num_rows();
    }

	/*function dataDokumenIzin($field,$table,$no = null,$nama = null,$dept_id = null,$limit = null,$start = null/*,$bulan = null*){
        $this->db->select($field);
        $this->db->from($table);
        if(!empty($no))$this->db->like('no_perijinan',$no);
        if(!empty($nama))$this->db->like('nama_perijinan',$nama);
        if(!empty($dept_id))$this->db->where('id_departemen',$dept_id);
        /*if(!empty($bulan)){
            $dateNow = date('Y-m-d');
            $dateSoon = date('Y-m-d', strtotime('+'.$bulan.' days', strtotime($dateNow)));
            $tgl_sekarang = $dateNow;
            $sampai_tgl = $dateSoon;
            $this->db->where(" tgl_berlaku BETWEEN ' ". $tgl_sekarang ." ' AND ' ". $sampai_tgl ." ' ");
        }*
		$this->db->where(" template = 'Perizinan'");
        if(!empty($limit)||!empty($start))$this->db->limit($limit,$start);
        $query = $this->db->get();
        return $query;
    }*/

    function _query_dataDokumenIzin($no = null,$nama = null,$dept_id = null,$file_exist){

        $column_order = array(null,'ext.no_perijinan'); 
        $column_search = array('ext.no_perijinan', 'ext.nama_perijinan', 'ext.publish_by', 'ext.owner_name', 'ext.tim_terkait'); //field yang diizin untuk pencarian 
        $order = array('ext.create_date' => 'DESC'); // default order

        $this->db->select('ext.*,c.nama');
        $this->db->from('eksternal_dokumen ext');
        $this->db->join('ref_akses_eksternal_dokumen','ref_akses_eksternal_dokumen.id_dokumen = ext.id','left');
        $this->db->join('master_user c','c.nik = ext.create_by','left');

        if($this->session->userdata('tipe')=='admin'){
            $this->db->group_by('ext.id');
        }else{
            // $this->db->where('ref_akses_eksternal_dokumen.departemen',$this->session->userdata('division'));
            $this->db->where('ref_akses_eksternal_dokumen.departemen',$this->session->userdata('departemen'));
            $this->db->where('ref_akses_eksternal_dokumen.user',$this->session->userdata('nik'));
        }
        if(!empty($no))$this->db->like('ext.no_perijinan',$no);
        if(!empty($nama))$this->db->like('ext.nama_perijinan',$nama);
        if(!empty($dept_id))$this->db->where('ext.id_departemen',$dept_id);
        if(!empty($file_exist) && $file_exist==1){
            $this->db->where('ext.file !=','');
        }elseif(!empty($file_exist) && $file_exist==2){
            $this->db->where('ext.file','');
        }
        /*if(!empty($bulan)){
            $dateNow = date('Y-m-d');
            $dateSoon = date('Y-m-d', strtotime('+'.$bulan.' days', strtotime($dateNow)));
            $tgl_sekarang = $dateNow;
            $sampai_tgl = $dateSoon;
            $this->db->where(" tgl_berlaku BETWEEN ' ". $tgl_sekarang ." ' AND ' ". $sampai_tgl ." ' ");
            
        }*/
        $this->db->where(" ext.template = 'Perizinan'");

        $i = 0;
        foreach ($column_search as $item) // looping awal
        {
            if (isset($_POST['search']['value'])) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) { // looping awal
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $this->db->order_by(key($order), $order[key($order)]);
        }
        
    }

    public function dataDokumenIzin($no = null,$nama = null,$dept_id = null,$file_exist){
        $this->_query_dataDokumenIzin($no,$nama,$dept_id,$file_exist);
        if (isset($_POST['length']) && $_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query;
    }

    function count_filtered_dataDokumenIzin($no = null,$nama = null,$dept_id = null,$file_exist)
    {
        $this->_query_dataDokumenIzin($no,$nama,$dept_id,$file_exist);
        $query = $this->db->get();
        return $query->num_rows();
    }
}