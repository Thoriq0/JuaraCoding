<?php
/**
 * This application is licensed under GNU General Public License version 3
 * Developers:
 * Syauqi Fuadi ( xfuadi@gmail.com )
 * Arie Nugraha ( dicarve@gmail.com )
 *
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	private $data_per_page = 20;
    // private $model = 'input_internal_model';
	
    /**
     * Controller class constructor
     *
     */
    private $model = 'Admin_model';
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('auth','table','template'));
        $this->load->helper(array('form', 'url', 'html'));
		$this->load->model('Admin_model');
        // $this->load->model($this->model, '', TRUE);

        /*if (!$this->session->tipe == 'admin') {
            redirect('/home/login', 'refresh');
        }*/
        if (!$this->auth->is_logged_in()) {
            redirect('/home/login', 'refresh');
        }
    }

    /**
     * Method to output complete page with header and footer
     *
     */
    protected function __output($nview, $data = null)
    {
        $this->load->view('header', $data);
        $this->load->view($nview, $data);
        $this->load->view('footer');
    }

    /**
     * Method to sanitize input data
     *
     * @return String
     *
     */
    protected function __sanitizeString($str)
    {
        // return filter_var($this->__sanitizeString($str),FILTER_SANITIZE_STRING);
        // return $this->db->escape($this->__sanitizeString($str));
        // return $this->db->escape(filter_var($str,FILTER_SANITIZE_STRING));
        return html_purify($str);
    }

    /**
     * Method to compile SQL query for master data
     * and return data in array format
     *
     * @return Array
     *
     */
    protected function masterlist($tipe)
    {
        $data;
        switch ($tipe) {
            case "kode":
                $q = "SELECT * FROM master_kode ORDER BY kode ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "departemen":
                $q = "SELECT * FROM master_departemen ORDER BY nama_departemen ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "unitpengolah":
                $q = "SELECT * FROM master_pengolah ORDER BY nama_pengolah ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "lokasi":
                $q = "SELECT * FROM master_lokasi ORDER BY nama_lokasi ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "media":
                $q = "SELECT * FROM master_media ORDER BY nama_media ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
        }
        return $data;
        // return $data;
    }

    /**
     * Show archive entry form
     *
     */
    public function input_internal_doc()
    {
        $data["kode"] = $this->Admin_model->get_data('master_kode','kode');
        $data["departemen"] = $this->Admin_model->get_data('master_departemen','nama_departemen');
        // $data["departemen"] = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalDivision');
        
		
        $data["unitpengolah"] = $this->Admin_model->get_data('master_pengolah','nama_pengolah');
        $data["lokasi"] = $this->Admin_model->get_data('master_lokasi','nama_lokasi');
        $data["media"] = $this->Admin_model->get_data('master_media','nama_media');
        $data["tingkat"] = $this->Admin_model->get_data('ref_tingkat_akses','id');
		 
		$data["template"] = $this->Admin_model->get_template_where_kategori('id','internal');
        $data["no_dokumen"] = $this->Admin_model->getDataByFieldName('internal_dokumen','no_dokumen');
        $data["no_urut"] = $this->Admin_model->getDataByFieldNameOrder('internal_dokumen','no_urut,template','no_urut','asc');
        // $data["departemen"] = $this->masterlist("departemen");
        // $data["unitpengolah"] = $this->masterlist("unitpengolah");
        // $data["lokasi"] = $this->masterlist("lokasi");
        // $data["media"] = $this->masterlist("media");
        $data["title"] = "Tambah Arsip";

        // cekvar($data);
        // die;
        // $this->__output('entri1', $data);

        $this->template->set('title', 'Entri Data');
		$this->template->load('template', 'input_internal_doc', $data);
    }
	
	public function input_external_doc()
    {
        // $data["departemen"] = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalDivision');
        $data["departemen"] = $this->Admin_model->get_data('master_departemen','nama_departemen');
        $data["user"] = $this->Admin_model->get_data('master_user','id');
        $data["media"] = $this->Admin_model->get_data('master_media','nama_media');
        $data["template"] = $this->Admin_model->get_template_where_kategori('id','eksternal');
        $data["no_dokumen"] = $this->Admin_model->getDataByFieldName('eksternal_dokumen','no_dokumen');
        $data["no_urut"] = $this->Admin_model->getDataByFieldNameOrder('eksternal_dokumen','no_urut,template','no_urut','asc');

        $data["title"] = "Tambah Arsip";

        
        // $this->__output('entri1', $data);

        $this->template->set('title', 'Entri Data');
		$this->template->load('template', 'input_external_doc', $data);
    }


    public function input_perizinan()
    {
        // $data["departemen"] = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalDivision');
        $data["departemen"] = $this->Admin_model->get_data('master_departemen','nama_departemen');
        $data["user"] = $this->Admin_model->get_data('master_user','id');
        $data["media"] = $this->Admin_model->get_data('master_media','nama_media');
        $data["template"] = $this->Admin_model->get_template_where_kategori('id','eksternal');
        $data["no_dokumen"] = $this->Admin_model->getDataByFieldName('eksternal_dokumen','no_dokumen');
        $data["no_urut"] = $this->Admin_model->getDataByFieldNameOrder('eksternal_dokumen','no_urut,template','no_urut','asc');

        $data["title"] = "Tambah Arsip";

        
        // $this->__output('entri1', $data);

        $this->template->set('title', 'Entri Data');
		$this->template->load('template', 'input_perizinan', $data);
    }

    /**
     * Process input data from archive entry form
     *
     */
    public function add_external_dokumen()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf|docx|doc';
        $this->load->library('upload', $config);
        /*if (!$this->upload->do_upload('file')) {
            echo "error";
            echo $this->upload->display_errors();
            echo $config['upload_path'];
            die();
        } else {*/
            $this->upload->do_upload('file');
            $datafile = $this->upload->data();
            //$file = $datafile['full_path'];
            $file_name = $datafile['file_name'];
            // var_dump($file_name);
			// $tgl_dokumen = $this->__sanitizeString($this->input->post('tgl_dok'));
            $no_dokumen = $this->__sanitizeString($this->input->post('nodok'));
            $no_ijin = $this->__sanitizeString($this->input->post('noijin'));
            $nama_ijin = $this->__sanitizeString($this->input->post('namaijin'));
            $tgl_terbit = $this->__sanitizeString($this->input->post('tgl_terbit'));
            $diterbitkan = $this->__sanitizeString($this->input->post('diterbitkan'));
            $deskripsi = $this->__sanitizeString($this->input->post('deskripsi'));
            $owner = $this->__sanitizeString($this->input->post('owner'));
            $dibuat = $this->__sanitizeString($this->input->post('dibuat'));
            $tim = $this->__sanitizeString($this->input->post('tim'));
            // $masa = $this->__sanitizeString($this->input->post('masa'));
            // $reminder = $this->__sanitizeString($this->input->post('reminder'));
            $tgl_reminder = $this->__sanitizeString($this->input->post('tgl_reminder'));
			
            $media = $this->__sanitizeString($this->input->post('media'));
            $jumlah = $this->__sanitizeString($this->input->post('jumlah'));

			$file = $file_name;
            
            $is_status = ($this->input->post('is_status')<=date('Y-m-d'))?0:$this->input->post('is_status');

            $data_insert = array(
                // 'tgl_dokumen' => $this->input->post('tgl_dok'),
                'template' => $this->input->post('template'),
                'no_dokumen' =>$this->input->post('nodok'),
                'id_departemen' => $this->session->userdata('departemen'),
                'nama_perijinan' => $this->input->post('nadoc'),
                // 'nama_perijinan' => $this->input->post('namaijin'),
                'nama_klien' => $this->input->post('namaklien'),
                'tgl_terbit' =>$this->input->post('tgl_terbit'),
                'tgl_berlaku' =>$this->input->post('masa'),
                'publish_by' => $this->input->post('diterbitkan'),
                'deskripsi' => $this->input->post('deskripsi'),
                'owner_name' => $this->input->post('owner'),
                'create_name' => $this->input->post('dibuat'),
                'tim_terkait' => $this->input->post('tim'),
                'tgl_reminder' => $this->input->post('tgl_reminder'),
                'media' => $this->input->post('media'),
                'jumlah' => $this->input->post('jumlah'),
                'file' => $file,
                'is_status' => $this->input->post('status'),
                // 'is_status' => $is_status,
                'is_share' => $this->input->post('share'),
                'no_urut' => explode("/",$this->input->post('nodok'))[0],
                'create_by' => $this->session->userdata('nik'),
            );


            $this->db->insert('eksternal_dokumen', $data_insert);
            $doc_id = $this->db->insert_id();

            if(($this->db->affected_rows()>0?true:false)){
                $log = array(
                    'username' => $this->session->userdata('username'),
                    'message' => 'tambah dokumen eksternal sukses',
                    'action'  => $this->Admin_model->getActionById(25)[0]['action'],
                    'from_url' => 'http://' . $_SERVER['HTTP_HOST'],
                    'from_ip' => $_SERVER["REMOTE_ADDR"]
                );
                $this->db->insert('user_logs', $log);
            }else{
                $log = array(
                    'username' => $this->session->userdata('username'),
                    'message' => 'tambah dokumen eksternal gagal',
                    'action'  => $this->Admin_model->getActionById(25)[0]['action'],
                    'from_url' => 'http://' . $_SERVER['HTTP_HOST'],
                    'from_ip' => $_SERVER["REMOTE_ADDR"]
                );
                $this->db->insert('user_logs', $log);
            }

            //insert akses untuk pembuat dokumen
            $this->db->insert('ref_akses_eksternal_dokumen', 
                array(  'id_dokumen' =>$doc_id,
                        'departemen' => $this->session->userdata('departemen'),
                        // 'departemen' => $this->session->userdata('division'),
                        'user' => $this->session->userdata('nik'),
                    )
            );

            if(!empty($this->input->post('du'))){

                $jml_du = count($this->input->post('du'));
                $du = $this->input->post('du');
                // cekvar($jml_du);
                // cekvar($du);

                for($i=0 ; $i < $jml_du ; $i++){
                    // cekvar($du[$i]);
                    $departemen_nama = explode("-",$du[$i]);
                    // cekvar($departemen_nama);
                    // die();
                    $ada = $this->Admin_model->dataById2('ref_akses_eksternal_dokumen',
                                    array(
                                        'id_dokumen' =>$doc_id,
                                        'departemen' => $departemen_nama[0],
                                        'user' => $departemen_nama[1],
                                    )
                            );

                    if($ada){
                        continue;
                    }else{
                        $data_insert2 = array(
                            'id_dokumen' =>$doc_id,
                            'departemen' => $departemen_nama[0],
                            'user' => $departemen_nama[1],
                        );
                        $this->db->insert('ref_akses_eksternal_dokumen', $data_insert2);
                    }
                    
                }
            }

            /*$jml_du = count($this->input->post('du'));
            $du = $this->input->post('du');
            // cekvar($jml_du);
            // cekvar($du);

            for($i=0 ; $i < $jml_du ; $i++){
                // cekvar($du[$i]);
                $departemen_nama = explode("-",$du[$i]);
                // cekvar($departemen_nama);
                // die();
                $data_insert2 = array(
                    'id_dokumen' =>$doc_id,
                    'departemen' => $departemen_nama[0],
                    'user' => $departemen_nama[1],
                );
                $this->db->insert('ref_akses_eksternal_dokumen', $data_insert2);
            }*/

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success show m-b-0">
                    <span class="close" data-dismiss="alert">&times;</span>
                        <b>Data berhasil di saved!</b>
                    </span>
                </div>'
            );

            redirect('admin/list_eksternal_dokumen');

        // }
    }

    public function add_perizinan()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf|docx|doc';
        $this->load->library('upload', $config);
        /*if (!$this->upload->do_upload('file')) {
            echo "error";
            echo $this->upload->display_errors();
            echo $config['upload_path'];
            die();
        } else {*/
            $this->upload->do_upload('file');
            $datafile = $this->upload->data();
            //$file = $datafile['full_path'];
            $file_name = $datafile['file_name'];
            // var_dump($file_name);
			// $tgl_dokumen = $this->__sanitizeString($this->input->post('tgl_dok'));
            $no_dokumen = $this->__sanitizeString($this->input->post('nodok'));
            $no_ijin = $this->__sanitizeString($this->input->post('noijin'));
            $nama_ijin = $this->__sanitizeString($this->input->post('namaijin'));
            $tgl_terbit = $this->__sanitizeString($this->input->post('tgl_terbit'));
            $diterbitkan = $this->__sanitizeString($this->input->post('diterbitkan'));
            $deskripsi = $this->__sanitizeString($this->input->post('deskripsi'));
            $owner = $this->__sanitizeString($this->input->post('owner'));
            $dibuat = $this->__sanitizeString($this->input->post('dibuat'));
            $tim = $this->__sanitizeString($this->input->post('tim'));
            // $masa = $this->__sanitizeString($this->input->post('masa'));
            // $reminder = $this->__sanitizeString($this->input->post('reminder'));
            $tgl_reminder = $this->__sanitizeString($this->input->post('tgl_reminder'));
			
            $media = $this->__sanitizeString($this->input->post('media'));
            $jumlah = $this->__sanitizeString($this->input->post('jumlah'));

			$file = $file_name;
            
            $is_status = $this->__sanitizeString($this->input->post('is_status'));

            $data_insert = array(
                // 'tgl_dokumen' => $this->input->post('tgl_dok'),
                'template' => 'Perizinan', //$this->input->post('template'),
                // 'no_dokumen' =>$this->input->post('nodok'),
                'id_departemen' => $this->session->userdata('departemen'),
                'no_perijinan' => $this->input->post('noijin'),
                'nama_perijinan' => $this->input->post('namaijin'),
                'tgl_terbit' =>$this->input->post('tgl_terbit'),
                'tgl_berlaku' =>$this->input->post('masa'),
                'publish_by' => $this->input->post('diterbitkan'),
                'deskripsi' => $this->input->post('deskripsi'),
                'owner_name' => $this->input->post('owner'),
                'create_name' => $this->input->post('dibuat'),
                'tim_terkait' => $this->input->post('tim'),
                'tgl_reminder' => $this->input->post('tgl_reminder'),
                'media' => $this->input->post('media'),
                'jumlah' => $this->input->post('jumlah'),
                'file' => $file,
                'is_status' => $this->input->post('status'),
                // 'is_status' => $is_status,
                'is_share' => $this->input->post('share'),
                'no_urut' => explode("/",$this->input->post('nodok'))[0],
                'create_by' => $this->session->userdata('nik'),
            );


            $this->db->insert('eksternal_dokumen', $data_insert);

            $doc_id = $this->db->insert_id();
              

            //insert akses untuk pembuat dokumen
            $this->db->insert('ref_akses_eksternal_dokumen', 
                array(  'id_dokumen' =>$doc_id,
                        'departemen' => $this->session->userdata('departemen'),
                        // 'departemen' => $this->session->userdata('division'),
                        'user' => $this->session->userdata('nik'),
                    )
            );

            if($this->input->post('share') && !empty($this->input->post('du'))){

                $jml_du = count($this->input->post('du'));
                $du = $this->input->post('du');
                // cekvar($jml_du);
                // cekvar($du);
                for($i=0 ; $i < $jml_du ; $i++){
                    // cekvar($du[$i]);
                    $departemen_nama = explode("-",$du[$i]);
                    // cekvar($departemen_nama);
                    // die();
                    $ada = $this->Admin_model->dataById2('ref_akses_eksternal_dokumen',
                                    array(
                                        'id_dokumen' =>$doc_id,
                                        'departemen' => $departemen_nama[0],
                                        'user' => $departemen_nama[1],
                                    )
                            );

                    if($ada){
                        continue;
                    }else{
                        $data_insert2 = array(
                            'id_dokumen' =>$doc_id,
                            'departemen' => $departemen_nama[0],
                            'user' => $departemen_nama[1],
                        );
                        $this->db->insert('ref_akses_eksternal_dokumen', $data_insert2);
                    }
                }
            }

            /*$jml_du = count($this->input->post('du'));
            $du = $this->input->post('du');
            // cekvar($jml_du);
            // cekvar($du);

            for($i=0 ; $i < $jml_du ; $i++){
                // cekvar($du[$i]);
                $departemen_nama = explode("-",$du[$i]);
                // cekvar($departemen_nama);
                // die();
                $data_insert2 = array(
                    'id_dokumen' =>$doc_id,
                    'departemen' => $departemen_nama[0],
                    'user' => $departemen_nama[1],
                );
                $this->db->insert('ref_akses_eksternal_dokumen', $data_insert2);
            }*/

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success show m-b-0">
                    <span class="close" data-dismiss="alert">&times;</span>
                        <b>Data berhasil di saved!</b>
                    </span>
                </div>'
            );

            redirect('admin/list_perizinan');
        // }
    }
	
	public function add_internal_dokumen()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $this->load->library('upload', $config);
        /*if (!$this->upload->do_upload('file')) {
            echo "error";
            echo $this->upload->display_errors();
            echo $config['upload_path'];
            die();
        } else {*/
            $this->upload->do_upload('file');
            $datafile = $this->upload->data();
            //$file = $datafile['full_path'];
            $file_name = $datafile['file_name'];
            // var_dump($file_name);
			$tgl_dokumen = $this->__sanitizeString($this->input->post('tgl_dok'));
			$template = $this->__sanitizeString($this->input->post('template'));
			$group = $this->__sanitizeString($this->input->post('group'));
			$no_dokumen = $this->__sanitizeString($this->input->post('no_dok'));
			$nama_dokumen = $this->__sanitizeString($this->input->post('nama_dok'));
			$deskripsi = $this->__sanitizeString($this->input->post('deskripsi'));
			$owner = $this->__sanitizeString($this->input->post('owner'));
			$departemen = $this->input->post('departemen');
			$tingkat = $this->input->post('tingkat');
			// $tingkat = $this->__sanitizeString($this->input->post('tingkat'));
			$lokasi = $this->__sanitizeString($this->input->post('lokasi'));
			$media = $this->__sanitizeString($this->input->post('media'));
			$jumlah = $this->__sanitizeString($this->input->post('jumlah'));
			$share = $this->__sanitizeString($this->input->post('share'));
			$status = $this->__sanitizeString($this->input->post('status'));
			
			$file = $file_name;

            // $data_insert = array(
            //     'tgl_dokumen' => $tgl_dokumen,
            //     'group_dokumen' => $group,
            //     'no_dokumen' => $no_dokumen,
            //     'nama_dokumen' => $nama_dokumen,
            //     'owner_dokumen' => $owner,
            //     'deskripsi' => $deskripsi,
            //     'jumlah' => $jumlah,
            //     'lokasi' => $lokasi,
            //     'media' => $media,
            //     'username' => $_SESSION['username'],
            //     'is_status' => $status,
            //     'is_share' => $share,
            // );  
            // $dateInput = $this->input->post('tgl_dok');
            // $newDate = date("Y-m-d", strtotime($dateInput));
            $is_status = ($this->input->post('is_status')<=date('Y-m-d'))?0:$this->input->post('is_status');

            $data_insert = array(
				'template' => $this->input->post('template'),
                'tgl_dokumen' => $this->input->post('tgl_dok'),
                'group_dokumen' => $this->input->post('group'),
                'no_dokumen' =>$this->input->post('no_dok'),
                'id_departemen' => $this->session->userdata('departemen'),
                'nama_dokumen' => $this->input->post('nama_dok'),
                'owner_dokumen' =>$this->input->post('owner'),
                'deskripsi' => $this->input->post('deskripsi'),
                'jumlah' => $this->input->post('jumlah'),
                'lokasi' => $this->input->post('lokasi'),
                'media' => $this->input->post('media'),
                'file' => $file,
                'username' => $_SESSION['username'],
                'is_status' => $this->input->post('status'),
                // 'is_status' => $is_status,
                'is_share' => $this->input->post('share'),
                'no_urut' => explode("/",$this->input->post('no_dok'))[0],
                'tgl_terbit' =>$this->input->post('tgl_terbit'),
                'tgl_berlaku' =>$this->input->post('masa'),
                'tgl_reminder' => $this->input->post('tgl_reminder'),
            );

            $this->db->insert('internal_dokumen', $data_insert);
            $doc_id = $this->db->insert_id();

            if(($this->db->affected_rows()>0?true:false)){
                $log = array(
                    'username' => $this->session->userdata('username'),
                    'message' => 'tambah dokumen internal sukses',
                    'action'  => $this->Admin_model->getActionById(22)[0]['action'],
                    'from_url' => 'http://' . $_SERVER['HTTP_HOST'],
                    'from_ip' => $_SERVER["REMOTE_ADDR"]
                );
                $this->db->insert('user_logs', $log);
            }else{
                $log = array(
                    'username' => $this->session->userdata('username'),
                    'message' => 'tambah dokumen internal gagal',
                    'action'  => $this->Admin_model->getActionById(22)[0]['action'],
                    'from_url' => 'http://' . $_SERVER['HTTP_HOST'],
                    'from_ip' => $_SERVER["REMOTE_ADDR"]
                );
                $this->db->insert('user_logs', $log);
            }

            // redirect('/home/view/', 'refresh');
            //insert akses untuk pembuat dokumen
                $this->db->insert('ref_akses_internal_dokumen', 
                    array(  'id_dokumen' =>$doc_id,
                            'id_departemen' => $this->session->userdata('departemen'),
                            'departemen' => $this->Admin_model->dataById('master_departemen','id',$this->session->userdata('departemen'))[0]['nama_departemen'],
                            'id_tingkat_akses' => $this->session->userdata('tingkat_akses'),
                            'tingkat_akses' => $this->Admin_model->dataById('ref_tingkat_akses','id',$this->session->userdata('tingkat_akses'))[0]['akses'],
                            /*'id_departemen' => $this->session->userdata('division'),
                            'departemen' => $this->session->userdata('division'),
                            'id_tingkat_akses' => $this->session->userdata('level'),
                            'tingkat_akses' => $this->session->userdata('level'),*/
                        )
                );

            /*$jml_du = count($this->input->post('du'));
            $du = $this->input->post('du');

            for($i=0 ; $i < $jml_du ; $i++){
                $departemen_akses = explode("-",$du[$i]);
                $data_insert2 = array(
                    'id_dokumen' =>$doc_id,
                    'id_departemen' => $departemen_akses[0],
                    'departemen' => $departemen_akses[1],
                    'id_tingkat_akses' => $departemen_akses[2],
                    'tingkat_akses' => $departemen_akses[3],
                );
                $this->db->insert('ref_akses_internal_dokumen', $data_insert2);
            }*/

            if($this->input->post('share') && !empty($this->input->post('du'))){

                $jml_du = count($this->input->post('du'));
                // cekvar($jml_du);
                $du = $this->input->post('du');
                
                for($i=0 ; $i < $jml_du ; $i++){
                    $departemen_akses = explode("-",$du[$i]);

                    $ada = $this->Admin_model->dataById2('ref_akses_internal_dokumen',
                                    array(
                                        'id_dokumen' =>$doc_id,
                                        'id_departemen' => $departemen_akses[0],
                                        'departemen' => $departemen_akses[1],
                                        'id_tingkat_akses' => $departemen_akses[2],
                                        'tingkat_akses' => $departemen_akses[3],
                                    )
                            );

                    if($ada){
                        continue;
                    }else{
                        $data_insert2 = array(
                            'id_dokumen' =>$doc_id,
                            'id_departemen' => $departemen_akses[0],
                            'departemen' => $departemen_akses[1],
                            'id_tingkat_akses' => $departemen_akses[2],
                            'tingkat_akses' => $departemen_akses[3],
                        );
                        $this->db->insert('ref_akses_internal_dokumen', $data_insert2);
                    }
                }
            }

            // $data['message'] = "<b> Data Saved <b>";
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success show m-b-0">
                    <span class="close" data-dismiss="alert">&times;</span>
                        <b>Data berhasil di saved!</b>
                    </span>
                </div>'
            );

            redirect('admin/list_internal_dokumen');
        // }
    }

    public function view($id){
        $data['doc'] = $this->Admin_model->getDataDoc($id);
        $lok = $this->Admin_model->dataById('master_lokasi','master_lokasi.id',$data['doc']['lokasi']);
        $med = $this->Admin_model->dataById('master_media','master_media.id',$data['doc']['media']);
        $data['lokasi_nama'] = (!empty($lok) && $lok[0]['nama_lokasi'])?$lok[0]['nama_lokasi']:'';
        $data['media_nama'] = (!empty($med) && $med[0]['nama_media'])?$med[0]['nama_media']:'';
        // $data['data_departemen'] = $this->Admin_model->dataByIdDoc('ref_departemen_akses','ref_departemen_akses.id_dokumen',$id);
        // $data['data_akses'] = $this->Admin_model->dataAksesDoc('ref_departemen_akses.id_dokumen',$id,'ref_departemen_akses.departemen',$docdept);
        // $data['tingkat_akses'] = $this->Admin_model->dataById('ref_dokumen_tingkat_akses','ref_dokumen_tingkat_akses.id_dokumen',$id);
		// $this->__output('varsip',$data);
        // echo"print";
        // cekvar($docdept);
        // die();

		$this->template->set('title', 'View');
		$this->template->load('template', 'vinternal_doc', $data);
    }

    public function viewExternal($id){
        $data['doc'] = $this->Admin_model->getDataDocExternal($id);
        $med = $this->Admin_model->dataById('master_media','master_media.id',$data['doc']['media']);
        $data['media_nama'] = (!empty($med) && $med[0]['nama_media'])?$med[0]['nama_media']:'';
        // $this->__output('varsip',$data);
        // echo"print";
        // cekvar($data);
        // die();

        $this->template->set('title', 'View');
        $this->template->load('template', 'vexternal_doc', $data);
    }

    public function viewIzin($id){
        $data['doc'] = $this->Admin_model->getDataDocExternal($id);
        $med = $this->Admin_model->dataById('master_media','master_media.id',$data['doc']['media']);
        $data['media_nama'] = (!empty($med) && $med[0]['nama_media'])?$med[0]['nama_media']:'';
        // $this->__output('varsip',$data);
        // echo"print";
        // cekvar($data);
        // die();

        $this->template->set('title', 'View');
        $this->template->load('template', 'vizin_doc', $data);
    }
    /**
     * Edit archive data form
     *
     * @param $id The ID of archive
     *
     */
    public function vedit($id)
    {
        if ($id != "") {
            $q = sprintf("SELECT * FROM internal_dokumen WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            $row = $hsl->row_array();
            $previous = "";
            if (isset($_SERVER['HTTP_REFERER'])) {
                $previous = $_SERVER['HTTP_REFERER'];
                $row['previous'] = $previous;
            }
            // $row['d_departemen'] = $this->Admin_model->dataById('ref_departemen_akses','ref_departemen_akses.id_dokumen',$id);
            // $row['join_data'] = $this->Admin_model->joinData($id);
            // echo "edit";
            // cekvar($row);
            // die();
            // $row["kode2"] = $this->masterlist("kode");
            // $row["pencipta2"] = $this->masterlist("pencipta");
            // $row["unitpengolah2"] = $this->masterlist("unitpengolah");
            // $row["lokasi2"] = $this->masterlist("lokasi");
            // $row["media2"] = $this->masterlist("media");

            // $row["departemen"] = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalDivision');
            $row["departemen"] = $this->Admin_model->get_data('master_departemen','nama_departemen');
            
            // $row["tingkat"] = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalLevel');
            $row["tingkat"] = $this->Admin_model->get_data('ref_tingkat_akses','id');
            
            $row["kode"] = $this->Admin_model->get_data('master_kode','kode');
            $row["unitpengolah"] = $this->Admin_model->get_data('master_pengolah','nama_pengolah');
            $row["lokasi"] = $this->Admin_model->get_data('master_lokasi','nama_lokasi');
            $row["media"] = $this->Admin_model->get_data('master_media','nama_media');
            $row["tplt"] = $this->Admin_model->get_template_where_kategori('id','internal');
            $row["akses_internal"] = $this->Admin_model->dataById('ref_akses_internal_dokumen','id_dokumen', $id);
            $row["x_no_dokumen"] = $this->Admin_model->getDataByFieldNameExceptId('internal_dokumen','no_dokumen',$id);
            $row["title"] = "Ubah Arsip";
            if (count($row) > 0) {
                $this->template->load('template', 'doc_edit', $row);
                // $this->__output('edit1', $row);
            } else {
                redirect('/home/', 'refresh');
            }
        } else {
            redirect('/home/', 'refresh');
        }
    }

    public function veditExternal($id)
    {
        if ($id != "") {
            $q = sprintf("SELECT * FROM eksternal_dokumen WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            $row = $hsl->row_array();
            $previous = "";
            if (isset($_SERVER['HTTP_REFERER'])) {
                $previous = $_SERVER['HTTP_REFERER'];
                $row['previous'] = $previous;
            }else{
                $row['previous'] = $previous;
            }
            // $row['d_departemen'] = $this->Admin_model->dataById('ref_departemen_akses','ref_departemen_akses.id_dokumen',$id);
            // $row['join_data'] = $this->Admin_model->joinData($id);
            // echo "edit";
            // cekvar($row);
            // die();
            // $row["kode2"] = $this->masterlist("kode");
            // $row["pencipta2"] = $this->masterlist("pencipta");
            // $row["unitpengolah2"] = $this->masterlist("unitpengolah");
            // $row["lokasi2"] = $this->masterlist("lokasi");
            // $row["media2"] = $this->masterlist("media");

            // $row["departemen"] = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalDivision');
            $row["departemen"] = $this->Admin_model->get_data('master_departemen','nama_departemen');
            $row["user"] = $this->Admin_model->get_data('master_user','id');
            $row["tplt"] = $this->Admin_model->get_template_where_kategori('id','eksternal');
            $row["nama_media"] = $this->Admin_model->get_data('master_media','nama_media');
            $row["akses_eksternal"] = $this->Admin_model->dataById('ref_akses_eksternal_dokumen','id_dokumen', $id);
            $row["x_no_dokumen"] = $this->Admin_model->getDataByFieldNameExceptId('eksternal_dokumen','no_dokumen',$id);            
            $row["title"] = "Ubah Arsip";
            if (count($row) > 0) {
                $this->template->load('template', 'doc_edit_external', $row);
                // $this->__output('edit1', $row);
            } else {
                redirect('/home/', 'refresh');
            }
        } else {
            redirect('/home/', 'refresh');
        }
    }

    public function veditIzin($id)
    {
        if ($id != "") {
            $q = sprintf("SELECT * FROM eksternal_dokumen WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            $row = $hsl->row_array();
            $previous = "";
            if (isset($_SERVER['HTTP_REFERER'])) {
                $previous = $_SERVER['HTTP_REFERER'];
                $row['previous'] = $previous;
            }else{
                $row['previous'] = $previous;
            }

            // $row["departemen"] = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalDivision');
            $row["departemen"] = $this->Admin_model->get_data('master_departemen','nama_departemen');
            $row["user"] = $this->Admin_model->get_data('master_user','id');
            $row["tplt"] = $this->Admin_model->get_template_where_kategori('id','eksternal');
            $row["nama_media"] = $this->Admin_model->get_data('master_media','nama_media');
            $row["akses_eksternal"] = $this->Admin_model->dataById('ref_akses_eksternal_dokumen','id_dokumen', $id);
            $row["x_no_dokumen"] = $this->Admin_model->getDataByFieldNameExceptId('eksternal_dokumen','no_dokumen',$id);            
            $row["title"] = "Ubah Arsip";
            if (count($row) > 0) {
                $this->template->load('template', 'doc_edit_izin', $row);
                // $this->__output('edit1', $row);
            } else {
                redirect('/home/', 'refresh');
            }
        } else {
            redirect('/home/', 'refresh');
        }
    }
    /**
     * Process input data from archive edit form
     *
     */
    public function edit($id)
    {
		// $this->{$this->model}->config('internal_dokumen', 'id');
        
        $file = "";
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf|docx|doc';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            //$file = $datafile['full_path'];
            $file = $datafile['file_name'];
        } else {
            $q = "SELECT file FROM internal_dokumen WHERE id=$id";
            $d = $this->db->query($q)->row_array()['file'];
            $file = $d;
        }

        $nama_dep = $this->input->post('departemen');
        $nama_akses = $this->input->post('tingkat');

        $data_insert = array(
            'tgl_dokumen' => $this->input->post('tgl_dok'),
            /*'group_dokumen' => $this->input->post('group'),
            'template' => $this->input->post('template'),
            'no_dokumen' =>$this->input->post('no_dok'),*/
            'nama_dokumen' => $this->input->post('nama_dok'),
            'owner_dokumen' =>$this->input->post('owner'),
            'deskripsi' => $this->input->post('deskripsi'),
            'jumlah' => $this->input->post('jumlah'),
            'lokasi' => $this->input->post('lokasi'),
            'media' => $this->input->post('media'),
            'file' => $file,            
            'is_status' => $this->input->post('status'),
            'is_share' => $this->input->post('share'),
            'tgl_terbit' =>$this->input->post('tgl_terbit'),
            'tgl_berlaku' =>$this->input->post('masa'),
            'tgl_reminder' => $this->input->post('tgl_reminder'),
        );

        $this->Admin_model->update_data($id,'internal_dokumen',$data_insert);
        
        $doc_id = $id;
        
        // Sementara hapus yang lama insert baru
        $this->Admin_model->delete_checklist('ref_akses_internal_dokumen', $id);
        
        if($this->session->userdata('tipe')!='admin'){
            //insert akses untuk pembuat dokumen
            $this->db->insert('ref_akses_internal_dokumen', 
                array(  'id_dokumen' =>$doc_id,
                        'id_departemen' => $this->session->userdata('departemen'),
                        'departemen' => $this->Admin_model->dataById('master_departemen','id',$this->session->userdata('departemen'))[0]['nama_departemen'],
                        'id_tingkat_akses' => $this->session->userdata('tingkat_akses'),
                        'tingkat_akses' => $this->Admin_model->dataById('ref_tingkat_akses','id',$this->session->userdata('tingkat_akses'))[0]['akses'],
                        /*'id_departemen' => $this->session->userdata('division'),
                        'departemen' => $this->session->userdata('division'),
                        'id_tingkat_akses' => $this->session->userdata('level'),
                        'tingkat_akses' => $this->session->userdata('level'),*/
                    )
            );
        }

        if($this->input->post('share') && !empty($this->input->post('du'))){

            $jml_du = count($this->input->post('du'));
            // cekvar($jml_du);
            $du = $this->input->post('du');
            
            for($i=0 ; $i < $jml_du ; $i++){
                $departemen_akses = explode("-",$du[$i]);

                $ada = $this->Admin_model->dataById2('ref_akses_internal_dokumen',
                                array(
                                    'id_dokumen' =>$doc_id,
                                    'id_departemen' => $departemen_akses[0],
                                    'departemen' => $departemen_akses[1],
                                    'id_tingkat_akses' => $departemen_akses[2],
                                    'tingkat_akses' => $departemen_akses[3],
                                )
                        );

                if($ada){
                    continue;
                }else{
                    $data_insert2 = array(
                        'id_dokumen' =>$doc_id,
                        'id_departemen' => $departemen_akses[0],
                        'departemen' => $departemen_akses[1],
                        'id_tingkat_akses' => $departemen_akses[2],
                        'tingkat_akses' => $departemen_akses[3],
                    );
                    $this->db->insert('ref_akses_internal_dokumen', $data_insert2);
                }
            }
        }

        /*$jml_du = count($this->input->post('du'));
        $du = $this->input->post('du');
        for($i=0 ; $i < $jml_du ; $i++){
            $departemen_akses = explode("-",$du[$i]);
            $data_insert = array(
                'id_dokumen' =>$doc_id,  
                'id_departemen' => $departemen_akses[0],
                'departemen' => $departemen_akses[1],
                'id_tingkat_akses' => $departemen_akses[2],
                'tingkat_akses' => $departemen_akses[3],
            );
            $this->db->insert('ref_akses_internal_dokumen', $data_insert);
        }*/

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success show m-b-0">
                <span class="close" data-dismiss="alert">&times;</span>
                    <b>Data berhasil di update!</b>
                </span>
            </div>'
        );

        redirect('admin/list_internal_dokumen');

        /* if($previous=="") {
    redirect('/home/view/'.$id, 'refresh');
    }else {
    header('Location: ' . $previous);
    } */
    }

    public function editExternal($id)
    {
        // $this->{$this->model}->config('internal_dokumen', 'id');

        // $noarsip = $this->__sanitizeString($this->input->post('noarsip'));
        // $tanggal = $this->__sanitizeString($this->input->post('tanggal'));
        // $uraian = $this->__sanitizeString($this->input->post('uraian'));
        // $kode = $this->__sanitizeString($this->input->post('kode'));
        // $ket = $this->__sanitizeString($this->input->post('ket'));
        // $pencipta = $this->__sanitizeString($this->input->post('pencipta'));
        // $unitpengolah = $this->__sanitizeString($this->input->post('unitpengolah'));
        // $lokasi = $this->__sanitizeString($this->input->post('lokasi'));
        // $media = $this->__sanitizeString($this->input->post('media'));
        // $nobox = $this->__sanitizeString($this->input->post('nobox'));
        // $jumlah = $this->__sanitizeString($this->input->post('jumlah'));
        // $id = $this->__sanitizeString($this->input->post('id'));
        // $previous = $this->__sanitizeString($this->input->post('previous'));
        
        $file = "";
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf|docx|doc';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            //$file = $datafile['full_path'];
            $file = $datafile['file_name'];
        } else {
            $q = "SELECT file FROM eksternal_dokumen WHERE id=$id";
            $d = $this->db->query($q)->row_array()['file'];
            $file = $d;
        }

        
        $data_insert = array(
            // 'tgl_dokumen' => $this->input->post('tgl_dok'),
            // 'no_dokumen' =>$this->input->post('nodok'),
            'no_perijinan' => $this->input->post('noijin'),
            'nama_perijinan' => $this->input->post('namaijin'),
            'nama_klien' => $this->input->post('namaklien'),
            'tgl_terbit' =>$this->input->post('tgl_terbit'),
            'tgl_berlaku' => $this->input->post('masa'),
            'publish_by' => $this->input->post('diterbitkan'),
            'deskripsi' => $this->input->post('deskripsi'),
            'owner_name' => $this->input->post('owner'),
            'create_name' => $this->input->post('dibuat'),
            'tim_terkait' => $this->input->post('tim'),
            'tgl_reminder' => $this->input->post('tgl_reminder'),
            'media' => $this->input->post('media'),
            'jumlah' => $this->input->post('jumlah'),
            'file' => $file,
            'is_status' => $this->input->post('status'),
            'is_share' => $this->input->post('share'),
        );

        $this->Admin_model->update_data($id,'eksternal_dokumen',$data_insert);
        // $this->{$this->model}->update($data_insert ,$id);

        // Sementara hapus yang lama insert baru
        $this->Admin_model->delete_checklist('ref_akses_eksternal_dokumen', $id);
        
        $doc_id = $id;

        if($this->session->userdata('tipe')!='admin'){
            //insert akses untuk pembuat dokumen
            $this->db->insert('ref_akses_eksternal_dokumen', 
                array(  'id_dokumen' =>$doc_id,
                        // 'departemen' => $this->session->userdata('departemen'),
                        'departemen' => $this->session->userdata('division'),
                        'user' => $this->session->userdata('nik'),
                    )
            );
        }
        
        if(!empty($this->input->post('du'))){

            $jml_du = count($this->input->post('du'));
            $du = $this->input->post('du');
            // cekvar($jml_du);
            // cekvar($du);

            for($i=0 ; $i < $jml_du ; $i++){
                // cekvar($du[$i]);
                $departemen_nama = explode("-",$du[$i]);
                // cekvar($departemen_nama);
                // die();
                $ada = $this->Admin_model->dataById2('ref_akses_eksternal_dokumen',
                                array(
                                    'id_dokumen' =>$doc_id,
                                    'departemen' => $departemen_nama[0],
                                    'user' => $departemen_nama[1],
                                )
                        );

                if($ada){
                    continue;
                }else{
                    $data_insert2 = array(
                        'id_dokumen' =>$doc_id,
                        'departemen' => $departemen_nama[0],
                        'user' => $departemen_nama[1],
                    );
                    $this->db->insert('ref_akses_eksternal_dokumen', $data_insert2);
                }
                
            }
        }

        /*$jml_du = count($this->input->post('du'));
        $du = $this->input->post('du');
        for($i=0 ; $i < $jml_du ; $i++){
            $departemen_nama = explode("-",$du[$i]);
            $data_insert = array(
                'id_dokumen' =>$doc_id,  
                'departemen' => $departemen_nama[0],
                'user' => $departemen_nama[1],
            );
            $this->db->insert('ref_akses_eksternal_dokumen', $data_insert);
        }*/

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success show m-b-0">
                <span class="close" data-dismiss="alert">&times;</span>
                    <b>Data berhasil di update!</b>
                </span>
            </div>'
        );

        redirect('admin/list_eksternal_dokumen');

        /* if($previous=="") {
    redirect('/home/view/'.$id, 'refresh');
    }else {
    header('Location: ' . $previous);
    } */
    }

    public function editIzin($id)
    {
        // $this->{$this->model}->config('internal_dokumen', 'id');

        // $noarsip = $this->__sanitizeString($this->input->post('noarsip'));
        // $tanggal = $this->__sanitizeString($this->input->post('tanggal'));
        // $uraian = $this->__sanitizeString($this->input->post('uraian'));
        // $kode = $this->__sanitizeString($this->input->post('kode'));
        // $ket = $this->__sanitizeString($this->input->post('ket'));
        // $pencipta = $this->__sanitizeString($this->input->post('pencipta'));
        // $unitpengolah = $this->__sanitizeString($this->input->post('unitpengolah'));
        // $lokasi = $this->__sanitizeString($this->input->post('lokasi'));
        // $media = $this->__sanitizeString($this->input->post('media'));
        // $nobox = $this->__sanitizeString($this->input->post('nobox'));
        // $jumlah = $this->__sanitizeString($this->input->post('jumlah'));
        // $id = $this->__sanitizeString($this->input->post('id'));
        // $previous = $this->__sanitizeString($this->input->post('previous'));
        
        $file = "";
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf|docx|doc';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            //$file = $datafile['full_path'];
            $file = $datafile['file_name'];
        } else {
            $q = "SELECT file FROM eksternal_dokumen WHERE id=$id";
            $d = $this->db->query($q)->row_array()['file'];
            $file = $d;
        }

        
        $data_insert = array(
            // 'tgl_dokumen' => $this->input->post('tgl_dok'),
            // 'no_dokumen' =>$this->input->post('nodok'),
            'no_perijinan' => $this->input->post('noijin'),
            'nama_perijinan' => $this->input->post('namaijin'),
            'tgl_terbit' =>$this->input->post('tgl_terbit'),
            'tgl_berlaku' => $this->input->post('masa'),
            'publish_by' => $this->input->post('diterbitkan'),
            'deskripsi' => $this->input->post('deskripsi'),
            'owner_name' => $this->input->post('owner'),
            'create_name' => $this->input->post('dibuat'),
            'tim_terkait' => $this->input->post('tim'),
            'tgl_reminder' => $this->input->post('tgl_reminder'),
            'media' => $this->input->post('media'),
            'jumlah' => $this->input->post('jumlah'),
            'file' => $file,
            'is_status' => $this->input->post('status'),
            'is_share' => $this->input->post('share'),
        );

        $this->Admin_model->update_data($id,'eksternal_dokumen',$data_insert);
        // $this->{$this->model}->update($data_insert ,$id);

        // Sementara hapus yang lama insert baru
        $this->Admin_model->delete_checklist('ref_akses_eksternal_dokumen', $id);

        $doc_id = $id;

        if($this->session->userdata('tipe')!='admin'){
            //insert akses untuk pembuat dokumen
            $this->db->insert('ref_akses_eksternal_dokumen', 
                array(  'id_dokumen' =>$doc_id,
                        // 'departemen' => $this->session->userdata('departemen'),
                        'departemen' => $this->session->userdata('division'),
                        'user' => $this->session->userdata('nik'),
                    )
            );
        }
        
        if(!empty($this->input->post('du'))){

            $jml_du = count($this->input->post('du'));
            $du = $this->input->post('du');
            // cekvar($jml_du);
            // cekvar($du);

            for($i=0 ; $i < $jml_du ; $i++){
                // cekvar($du[$i]);
                $departemen_nama = explode("-",$du[$i]);
                // cekvar($departemen_nama);
                // die();
                $ada = $this->Admin_model->dataById2('ref_akses_eksternal_dokumen',
                                array(
                                    'id_dokumen' =>$doc_id,
                                    'departemen' => $departemen_nama[0],
                                    'user' => $departemen_nama[1],
                                )
                        );

                if($ada){
                    continue;
                }else{
                    $data_insert2 = array(
                        'id_dokumen' =>$doc_id,
                        'departemen' => $departemen_nama[0],
                        'user' => $departemen_nama[1],
                    );
                    $this->db->insert('ref_akses_eksternal_dokumen', $data_insert2);
                }
                
            }
        }

        /*$jml_du = count($this->input->post('du'));
        $du = $this->input->post('du');
        for($i=0 ; $i < $jml_du ; $i++){
            $departemen_nama = explode("-",$du[$i]);
            $data_insert = array(
                'id_dokumen' =>$id,  
                'departemen' => $departemen_nama[0],
                'user' => $departemen_nama[1],
            );
            $this->db->insert('ref_akses_eksternal_dokumen', $data_insert);
        }*/

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success show m-b-0">
                <span class="close" data-dismiss="alert">&times;</span>
                    <b>Data berhasil di update!</b>
                </span>
            </div>'
        );

        redirect('admin/list_perizinan');

        /* if($previous=="") {
    redirect('/home/view/'.$id, 'refresh');
    }else {
    header('Location: ' . $previous);
    } */
    }

    public function delete_data()
    {

        $id = $this->__sanitizeString($this->input->post('id'));
        // echo `<script type="text/javascript">alert('$id a')</script>`;
        echo '<script>alert("Region already added");</script>';
        // $this->db->delete('internal_dokumen', $id); 
        // $this->db->delete('ref_departemen_akses', array('id_dokumen' => $id));
        // $this->db->delete('ref_dokumen_tingkat_akses', array('id_dokumen' => $id));
    }

    /**
     * Delete archive file value in archive record
     *
     */
    public function delfile()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = "SELECT file FROM data_arsip WHERE id=$id";
        $hsl = $this->db->query($q);
        $row = $hsl->row_array()['file'];
        if ($row != "") {
            $alamat = ROOTPATH . "/files/" . $row;
            unlink($alamat);
        }
        $q = sprintf("UPDATE data_arsip SET file=NULL WHERE id=%d", $id);
        $hsl = $this->db->query($q);
    }

    /**
     * Delete archive file
     *
     */
    public function del1()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("SELECT file FROM data_arsip WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        $row = $hsl->row_array()['file'];
        if ($row != "") {
            $alamat = ROOTPATH . "/files/" . $row;
            unlink($alamat);
        }
        $q = sprintf("DELETE FROM data_arsip WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
            redirect('home', 'refresh');
        } else {
            echo '[]';
        }
        exit();
    }

    public function delete_internal_dokumen()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        
        $this->Admin_model->del_data($id,'internal_dokumen');
        
        if(($this->db->affected_rows()>0?true:false)){
            $log = array(
                'username' => $this->session->userdata('username'),
                'message' => 'hapus dokumen internal sukses',
                'action'  => $this->Admin_model->getActionById(31)[0]['action'],
                'from_url' => 'http://' . $_SERVER['HTTP_HOST'],
                'from_ip' => $_SERVER["REMOTE_ADDR"]
            );
            $this->db->insert('user_logs', $log);
            // echo json_encode(array('status' => 'success'));
        }else{
            $log = array(
                'username' => $this->session->userdata('username'),
                'message' => 'hapus dokumen internal gagal',
                'action'  => $this->Admin_model->getActionById(31)[0]['action'],
                'from_url' => 'http://' . $_SERVER['HTTP_HOST'],
                'from_ip' => $_SERVER["REMOTE_ADDR"]
            );
            $this->db->insert('user_logs', $log);
            // echo '[]';
            // echo json_encode(array('status' => 'failed'));
        }

        $this->Admin_model->delete_checklist('ref_akses_internal_dokumen',$id);

        exit();
    }

    public function delete_external_dokumen()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        
        $this->Admin_model->del_data($id,'eksternal_dokumen');

        if(($this->db->affected_rows()>0?true:false)){
            $log = array(
                'username' => $this->session->userdata('username'),
                'message' => 'hapus dokumen internal sukses',
                'action'  => $this->Admin_model->getActionById(27)[0]['action'],
                'from_url' => 'http://' . $_SERVER['HTTP_HOST'],
                'from_ip' => $_SERVER["REMOTE_ADDR"]
            );
            $this->db->insert('user_logs', $log);
            // echo json_encode(array('status' => 'success'));
        }else{
            $log = array(
                'username' => $this->session->userdata('username'),
                'message' => 'hapus dokumen internal gagal',
                'action'  => $this->Admin_model->getActionById(27)[0]['action'],
                'from_url' => 'http://' . $_SERVER['HTTP_HOST'],
                'from_ip' => $_SERVER["REMOTE_ADDR"]
            );
            $this->db->insert('user_logs', $log);
            // echo '[]';
            // echo json_encode(array('status' => 'failed'));
        }

        $this->Admin_model->delete_checklist('ref_akses_eksternal_dokumen',$id);
        
        exit();
    }

    /**
     * Show classification data page
     *
     */
    public function group_documents()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_kode ";
        if ($katakunci) {
            $q .= ' WHERE kode LIKE \'%' . $katakunci . '%\' OR nama LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY kode ASC";
        $hsl = $this->db->query($q);
        $data['user'] = $hsl->result_array();

        //$this->__output('klas', $data);
        $this->template->set('title', 'Data Klasifikasi');
        $this->template->load('template', 'group_documents', $data);
    }

    /**
     * Add classification data and respond in JSON format
     *
     */
    public function addkode()
    {
        $kode = $this->__sanitizeString($this->input->post('kode'));
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $retensi = $this->__sanitizeString($this->input->post('retensi'));
        $q = sprintf("INSERT INTO master_kode (kode,nama,retensi) VALUES ('%s','%s','%s')",
            $kode, $nama, $retensi);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update classification data and respond in JSON format
     *
     */
    public function edkode()
    {
        $kode = $this->__sanitizeString($this->input->post('kode'));
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $retensi = $this->__sanitizeString($this->input->post('retensi'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE master_kode SET kode='%s',nama='%s',retensi='%s' WHERE id=%d",
            $kode, $nama, $retensi, $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete classification data and respond in JSON format
     *
     */
    public function delkode()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan klasifikasi ini
        $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE kode=%d", $id);
        $jml = $this->db->query($q)->row_array()['jml'];
        if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_kode WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
        } else { //ada arsip yng menggunakan, klasifikasi jangan dihapus dulu

        }

    }

    /**
     * Get classification data and respond in JSON format
     *
     */
    public function akode()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("SELECT * FROM master_kode WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for classification data
     *
     */
    public function reloadkode()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_kode ";
        if ($katakunci) {
            $q .= ' WHERE kode LIKE \'%' . $katakunci . '%\' OR nama LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY kode ASC";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vkode' id='vkode'>
			<thead>
				<th>Kode</th>
				<th>Nama</th>
				<th>Retensi</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $u['kode'] . "</td>";
                echo "<td>" . $u['nama'] . "</td>";
                echo "<td>" . $u['retensi'] . " Tahun</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editkode\" class='edkode' href='#' id='" . $u['id'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delkode\" class='delkode' href='#' id='" . $u['id'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
    }

    /**
     * Show archive author/creator data page
     *
     */
    public function departemen()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_departemen ";
        if ($katakunci) {
            $q .= ' WHERE nama_departemen LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_departemen ASC";
        $hsl = $this->db->query($q);
        $data['penc'] = $hsl->result_array();
        //$this->__output('pencipt  a', $data);
        $this->template->set('title', 'Data Pencipta Arsip');
        $this->template->load('template', 'departemen', $data);
    }

    /**
     * Add archive creator data and respond in JSON format
     *
     */
    public function add_departemen()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $q = sprintf("INSERT INTO master_departemen (nama_departemen) VALUES ('%s')", $nama);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update archive creator data and respond in JSON format
     *
     */
    public function edit_departemen()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE master_departemen SET nama_departemen='%s' WHERE id=%d", $nama, $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete archive creator data and respond in JSON format
     *
     */
    public function delete_departemen()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan pencipta ini
        $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE pencipta=%d", $id);
        $jml = $this->db->query($q)->row_array()['jml'];
        if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_departemen WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
        } else {

        }
    }

    /**
     * Get archive creator data and respond in JSON format
     *
     */
    public function apenc()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("SELECT * FROM master_pencipta WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for archive creator
     *
     */
    public function reloadpenc()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_pencipta ";
        if ($katakunci) {
            $q .= ' WHERE nama_pencipta LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_pencipta ASC";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vpenc' id='vpenc'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Nama</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $u['nama_pencipta'] . "</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editpenc\" class='edpenc' href='#' id='" . $u['id'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delpenc\" class='delpenc' href='#' id='" . $u['id'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
    }

    /**
     * Show archival unit/manager data page
     *
     */
    public function pengolah()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_pengolah ";
        if ($katakunci) {
            $q .= ' WHERE nama_pengolah LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_pengolah ASC";
        $hsl = $this->db->query($q);
        $data['peng'] = $hsl->result_array();
        //$this->__output('pengolah', $data);
        $this->template->set('title', 'Data Unit Pengolah');
        $this->template->load('template', 'pengolah', $data);
    }

    /**
     * Add archival unit data and respond in JSON format
     *
     */
    public function addpeng()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $q = sprintf("INSERT INTO master_pengolah (nama_pengolah) VALUES ('%s')", $nama);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update archival unit data and respond in JSON format
     *
     */
    public function edpeng()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE master_pengolah SET nama_pengolah='%s'", $nama);
        $q .= " WHERE id=$id";
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete archival unit data and respond in JSON format
     *
     */
    public function delpeng()
    {
        
        echo '<script>alert("Message")</script>';
        // $id = $this->__sanitizeString($this->input->post('id'));
        // //cek dulu apakah ada arsip yang menggunakan unit pengolah ini
        // $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE unit_pengolah=%d", $id);
        // $jml = $this->db->query($q)->row_array()['jml'];
        // if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
        //     $q = sprintf("DELETE FROM master_pengolah WHERE id=%d", $id);
        //     $hsl = $this->db->query($q);
        //     if ($hsl) {
        //         echo json_encode(array('status' => 'success'));
        //     } else {
        //         echo '[]';
        //     }
        //     exit();
        // } else {

        // }
    }

    /**
     * Get archival unit data and respond in JSON format
     *
     */
    public function apeng()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("SELECT * FROM master_pengolah WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for archival unit data
     *
     */
    public function reloadpeng()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_pengolah ";
        if ($katakunci) {
            $q .= ' WHERE nama_pengolah LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_pengolah ASC";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vpeng' id='vpeng'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Nama</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $u['nama_pengolah'] . "</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editpeng\" class='edpeng' href='#' id='" . $u['id'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delpeng\" class='delpeng' href='#' id='" . $u['id'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
    }

    /**
     * Show archive location data page
     *
     */
    public function lokasi()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_lokasi ";
        if ($katakunci) {
            $q .= ' WHERE nama_lokasi LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_lokasi ASC";
        $hsl = $this->db->query($q);
        $data['lok'] = $hsl->result_array();
        //$this->__output('lokasi', $data);
        $this->template->set('title', 'Data Lokasi');
        $this->template->load('template', 'lokasi', $data);
    }

    /**
     * Add archive location data and respond in JSON format
     *
     */
    public function addlok()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $q = sprintf("INSERT INTO master_lokasi (nama_lokasi) VALUES ('%s')", $nama);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update archive location data and respond in JSON format
     *
     */
    public function edlok()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE master_lokasi SET nama_lokasi='%s' WHERE id=%d", $nama, $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete archive location data and respond in JSON format
     *
     */
    public function dellok()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan lokasi ini
        $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE lokasi=%d", $id);
        $jml = $this->db->query($q)->row_array()['jml'];
        if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_lokasi WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
        } else {

        }
    }

    /**
     * Get archive location data and respond in JSON format
     *
     */
    public function alok()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = "SELECT * FROM master_lokasi WHERE id=$id";
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for location data
     *
     */
    public function reloadlok()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_lokasi ";
        if ($katakunci) {
            $q .= ' WHERE nama_lokasi LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_lokasi ASC";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vlok' id='vlok'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Nama</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $u['nama_lokasi'] . "</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editlok\" class='edlok' href='#' id='" . $u['id'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#dellok\" class='dellok' href='#' id='" . $u['id'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
    }

    /**
     * Show media data page
     *
     */
    public function media()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_media ";
        if ($katakunci) {
            $q .= ' WHERE nama_media LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_media ASC";
        $hsl = $this->db->query($q);
        $data['med'] = $hsl->result_array();
        //$this->__output('media', $data);
        $this->template->set('title', 'Data Media');
        $this->template->load('template', 'media', $data);
    }

    /**
     * Add media data and respond in JSON format
     *
     */
    public function addmed()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $q = sprintf("INSERT INTO master_media (nama_media) VALUES ('%s')", $nama);
        $hsl = $this->db->query($q);
        if ($hsl) {
            redirect('/admin/media', 'refresh');
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update media data and respond in JSON format
     *
     */
    public function edmed()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE master_media SET nama_media='%s' WHERE id=%d", $nama, $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            redirect('/admin/media', 'refresh');
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete media data and respond in JSON format
     *
     */
    public function delmed()
    {
		
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan media ini
        $q = sprintf("SELECT count(id) jml FROM internal_dokumen WHERE media=%d", $id);

        $jml = $this->db->query($q)->row_array()['jml'];
		
        if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus

            $q = sprintf("DELETE FROM master_media WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                redirect('/admin/media', 'refresh');
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
        } else {
			
        }
    }

    /**
     * Get media data and respond in JSON format
     *
     */
    public function amed()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = "SELECT * FROM master_media WHERE id=$id";
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for media data
     *
     */
    public function reloadmed()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_media ";
        if ($katakunci) {
            $q .= ' WHERE nama_media LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_media ASC";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vmed' id='vmed'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Nama</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $u['nama_media'] . "</td>";
                echo "<td><a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#editmed\" class='edmed' href='#' id='" . $u['id'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#delmed\" class='delmed' href='#' id='" . $u['id'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }

    }

    /**
     * Show user data page
     *
     */
    public function vuser()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_user  ";
        if ($katakunci) {
            $q .= ' WHERE username LIKE \'%' . $katakunci . '%\' OR tipe LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY id DESC";
        $hsl = $this->db->query($q);
        $data['user'] = $hsl->result_array();
		$data["departemen"] = $this->masterlist("departemen");
		$data["tingkat"] = $this->Admin_model->get_data('ref_tingkat_akses','departemen');
		
        //$this->__output('vuser', $data);
        $this->template->set('title', 'Data User');
        $this->template->load('template', 'vuser', $data);
    }

    /**
     * Check for user data and respond in JSON format
     *
     */
    public function cekuser()
    {
        $username = $this->__sanitizeString($this->input->post('username'));
        $q = "SELECT username FROM master_user WHERE username='$username'";
        $hsl = $this->db->query($q)->row_array();
        if ($hsl['username'] == $username) {
            echo json_encode(array('msg' => 'error'));
        } else {
            echo json_encode(array('msg' => 'ok'));
        }
    }    

    /**
     * Add user data and respond in JSON format
     *
     */
    public function adduser()
    {
        $password_str = $this->input->post('password');
        $conf_password_str = $this->input->post('conf_password');
        if ($password_str !== $conf_password_str) {
            echo json_encode(array('status' => 'error', 'pesan' => 'PASSWORD_UNMATCH'));
            exit();
        }
		
		$nik = $this->__sanitizeString($this->input->post('nik'));
		$nama = $this->__sanitizeString($this->input->post('nama'));
		$departemen = $this->__sanitizeString($this->input->post('departemen'));
		$tingkat = $this->__sanitizeString($this->input->post('tingkat'));
        $username = $this->__sanitizeString($this->input->post('username'));
        $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $tipe = $this->__sanitizeString($this->input->post('tipe'));
        $email = $this->__sanitizeString($this->input->post('email'));
        $akses_klas = $this->__sanitizeString($this->input->post('akses_klas'));
        $akses_modul = json_encode($this->input->post('modul'));
        
        $q = sprintf("INSERT INTO master_user (nik, nama, departemen, tingkat_akses, username,password,tipe,akses_klas,akses_modul,email) VALUES ('%s','%s','%s','%s', '%s','%s','%s','%s','%s','%s')",
            $nik,$nama,$departemen,$tingkat,$username, $password, $tipe, $akses_klas, $akses_modul,$email);
        $hsl = $this->db->query($q);
		
        if ($hsl) {
            echo json_encode(array('status' => 'success', 'pesan' => 'PASSWORD_MATCH'));
            redirect('/admin/vuser', 'refresh');
            exit();
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update user data and respond in JSON format
     *
     */
    public function edituser()
    {
        $username = $this->__sanitizeString($this->input->post('username'));
        $password = "";
        if ($this->input->post('password') != "") {
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        }
        $email = $this->__sanitizeString($this->input->post('email'));
        $tipe = $this->__sanitizeString($this->input->post('tipe'));
        $akses_klas = $this->__sanitizeString($this->input->post('akses_klas'));
        $akses_modul = json_encode($this->input->post('modul'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE master_user SET username='%s'", $username);
        if ($password != "") {
            $q .= sprintf(",password='%s'", $password);
        }

        $q .= sprintf(", email='%s',tipe='%s',akses_klas='%s',akses_modul='%s' WHERE id=%d",$email,$tipe, $akses_klas, $akses_modul, $id, $email);
        $hsl = $this->db->query($q);
        if ($hsl) {
            redirect('/admin/vuser', 'refresh');
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete user data and respond in JSON format
     *
     */
    public function deluser()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("DELETE FROM master_user WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            redirect('/admin/vuser', 'refresh');
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Get user data in JSON format
     *
     */
    public function auser()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("SELECT * FROM master_user WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for user data
     *
     */
    public function reloaduser()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_user ";
        if ($katakunci) {
            $q .= ' WHERE username LIKE \'%' . $katakunci . '%\' OR tipe LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY username ASC";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vuser' id='vuser'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Username</th>
				<th>Akses Klasifikasi</th>
				<th>Akses Modul</th>
				<th>Tipe</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $u['username'] . "</td>";
                echo "<td>" . $u['akses_klas'] . "</td>";
                echo "<td>";
                $mm = $u['akses_modul'];
                if ($mm != "") {
                    $mm = json_decode($mm);
                    if ($mm) {
                        foreach ($mm as $key => $val) {
                            echo $key . ",";
                        }
                    }
                }
                echo "</td>";
                echo "<td>" . $u['tipe'] . "</td>";
                echo "<td><a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#edituser\" class='eduser' href='#' id='" . $u['id'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#deluser\" class='deluser' href='#' id='" . $u['id'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
    }
	 protected function src($srcdata=false)
  {
        
        // simple search
        //$katakunci=$this->__sanitizeString($this->input->get('katakunci'));
		// advanced search
        /*$noarsip=$this->__sanitizeString($this->input->get('noarsip'));
		$tanggal=$this->__sanitizeString($this->input->get('tanggal'));
		$uraian=$this->__sanitizeString($this->input->get('uraian'));
		$ket=$this->__sanitizeString($this->input->get('ket'));
		$kode=$this->__sanitizeString($this->input->get('kode'));
		$retensi=$this->__sanitizeString($this->input->get('retensi'));
		$penc=$this->__sanitizeString($this->input->get('penc'));
		$peng=$this->__sanitizeString($this->input->get('peng'));
		$lok=$this->__sanitizeString($this->input->get('lok'));
		$med=$this->__sanitizeString($this->input->get('med'));
		$nobox=$this->__sanitizeString($this->input->get('nobox'));*/

		$w = array();
		$klas = array();
		if ($katakunci) {
		  // simple search
		  $w[] = " no_dokumen like '%".$katakunci."%'";
          /*$w[] = " noarsip like '%".$katakunci."%'";
		  $w[] = " uraian like '%".$katakunci."%'";
		  $w[] = " nobox like '%".$katakunci."%'";*/
		} /*else {
			// advanced search
			if($noarsip!="") {
				$w[] = " noarsip like '%".$noarsip."%'";
			}
			if($tanggal!="") {
				$w[] = " tanggal like '%".$tanggal."%'";
			}
			if($kode!="" && $kode!="all") {
				//$w[] = " a.kode like '".$kode."%'";
				$klas[] = $kode;
			}
			if($ket!="" && $ket!="all") {
				$w[] = " ket='".$ket."'";
			}
			if($uraian!="") {
				$w[] = " uraian like '%".$uraian."%'";
			}
			if($retensi!="" && $retensi!="all") {
				if($retensi=="sudah") {
					$w[] = " DATE_ADD(a.tanggal,INTERVAL k.retensi YEAR) < CURDATE()";
				}else {
					$w[] = " DATE_ADD(a.tanggal,INTERVAL k.retensi YEAR) > CURDATE()";
				}
			}
			if($penc!="" && $penc!="all") {
				$w[] = " pencipta ='".$penc."'";
			}
			if($peng!="" && $peng!="all") {
				$w[] = " unit_pengolah ='".$peng."'";
			}
			if($lok!="" && $lok!="all") {
				$w[] = " lokasi ='".$lok."'";
			}
			if($med!="" && $med!="all") {
				$w[] = " media ='".$med."'";
			}
			if($nobox!="") {
				$w[] = " nobox like '%".$nobox."%'";
			}
		}*/

		$q = "select * from internal_dokumen  ";
        
		$q_count = "SELECT COUNT(*) AS jmldata FROM internal_dokumen";
        

		if($_SESSION['akses_klas']!='') {
			$k = explode(',',$_SESSION['akses_klas']);
			$k = array_filter($k);
			sort($k);
			if(count($k)>0) {
				$klas=array_merge($klas,$k);
			}
		}
		/*
		if(count($klas)>0) {
			$w[] = " k.kode regexp '".implode('|',$klas)."'";
		}
		*/
		
		//var_dump($w); die();
		if ($katakunci) {
			$q .= " WHERE".implode(" OR ",$w);
			$q_count .= " WHERE".implode(" OR ",$w);
			$src = array("no_dokumen"=>$katakunci/*"noarsip"=>$katakunci,"tanggal"=>'',"uraian"=>$katakunci,"ket"=>'',"kode"=>'',"retensi"=>'',"penc"=>'',"peng"=>'',"lok"=>'',"med"=>'',"nobox"=>$nobox*/);
			$qq = array($q, $q_count, $src);
			return $qq;
		} else {
			if(count($w) > 0) {
				$q .= " WHERE".implode(" AND ",$w);
				$q_count .= " WHERE".implode(" AND ",$w);
			}
		}

    if(!$katakunci && $srcdata) {
      $src = array(/*"noarsip"=>$noarsip,"tanggal"=>$tanggal,"uraian"=>$uraian,"ket"=>$ket,"kode"=>$kode,"retensi"=>$retensi,"penc"=>$penc,"peng"=>$peng,"lok"=>$lok,"med"=>$med,"nobox"=>$nobox*/);
      return array($q, $q_count, $src);
    } else {
		$src = array("Kata kunci"=>$katakunci);
      return array($q, $q_count, $src);
    }
	}
	
	public function list_internal_dokumen()
    {

        $data['deptID'] = $this->Admin_model->get_data('master_departemen','nama_departemen');
		
        //$data['deptID'] = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalDivision');
		
        // cekvar($data['deptID']);
        

        $this->template->set('title', 'Data Dokumen');
        $this->template->load('template', 'list_internal_dokumen',$data);
    }
	
	public function get_list_internal_dokumen()
    {
        $name = $this->session->userdata('username');
        $departemen = $this->session->userdata('departemen');
        $takses = $this->session->userdata('tingkat_akses');
        
        $nodokint= $this->__sanitizeString($this->input->post('nodokint'));
        $nama= $this->__sanitizeString($this->input->post('nama'));
        $dept_id= $this->__sanitizeString($this->input->post('dept_id'));
        $file_exist= $this->__sanitizeString($this->input->post('file_exist'));
        
        if(isset($_POST['start'])){
            $no = $_POST['start'];
        }else{
            $no = 0;
        }

        $query = $this->Admin_model->getLimitByDepAksesWhere($departemen,$takses,$nodokint,$nama,$dept_id,$file_exist);
        $data       = array();


        $deptID = $this->Admin_model->get_data('master_departemen','nama_departemen');
        //$deptID = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalDivision');
        

        foreach($query->result() as $row) {
            $namaDept = '';
            if(!empty($deptID)){
                if ($row->id_departemen!='') {
                    
                        foreach ($deptID as $d) {
                            if ($row->id_departemen==$d['id']) {
                                $namaDept =  $d['nama_departemen'];
                            }
                        }
                    
                }else{
                    $namaDept = "-";
                }
            }else{
                $namaDept = "-";
            }

            $status1 = '';
            if($row->is_status=="1") {
                $status1 = "Aktif";
            }else {
                $status1 = "Tidak Aktif";
            }

            $status2 = '';
            if($row->is_share=="1") {
                $status2 = "Ya";
            }else {
                $status2 = "Tidak";
            }
            
            $ketersedian_file = (strlen($row->file)>0)?"Ada":"Belum Ada";
            // $user_detail = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/user_detail?sales_code='.$row->create_by);
            // $create_by = (is_object($user_detail))?$user_detail->Name:'';
            $create_by = $row->nama;
            if($this->session->userdata('tipe')=='admin'){
                $data[] = array(
                    ++$no,
                    $row->no_dokumen,
                    $row->nama_dokumen,
                    $namaDept,
                    $row->tgl_dokumen,
                    $row->tgl_input,
                    $ketersedian_file,
                    $row->group_dokumen,
                    $status1,
                    $status2,
                    $create_by, 

                    "<td><a href='".site_url('admin/view/'.$row->id.'')."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>
                        &nbsp
                        <a href='".site_url('/admin/vedit/'.$row->id.'')."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
                        </td>",
                    
                    //<a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#deldata\" class='deldata' href='#' id='".$row->id."'><span class='btn btn-xs btn-danger'><i class='fa fa-md fa-trash' ></i> Delete</span></a>
                );     
            }elseif($row->is_share == "1"){
                $actionButton = '';
                if($this->session->userdata('nik')==$row->username/*$row->create_by*/){
                    $actionButton = 
                    "<td><a href='".site_url('admin/view/'.$row->id.'')."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>
                        &nbsp
                        <a href='".site_url('/admin/vedit/'.$row->id.'')."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
                        </td>";
                }else{
                    $actionButton = 
                    "<td><a href='".site_url('admin/view/'.$row->id.'')."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>";
                }

                $data[] = array(
                    ++$no,
                    $row->no_dokumen,
                    $row->nama_dokumen,
                    $namaDept,
                    $row->tgl_dokumen,
                    $row->tgl_input,
                    $ketersedian_file,
                    $row->group_dokumen,
                    $status1,
                    $status2,
                    $create_by, 

                    $actionButton,
                    
                    //<a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#deldata\" class='deldata' href='#' id='".$row->id."'><span class='btn btn-xs btn-danger'><i class='fa fa-md fa-trash' ></i> Delete</span></a>
                );    
            }elseif($this->session->userdata('nik')==$row->username/*$row->create_by*/){
                $data[] = array(
                    ++$no,
                    $row->no_dokumen,
                    $row->nama_dokumen,
                    $namaDept,
                    $row->tgl_dokumen,
                    $row->tgl_input,
                    $ketersedian_file,
                    $row->group_dokumen,
                    $status1,
                    $status2,
                    $create_by, 

                    "<td><a href='".site_url('admin/view/'.$row->id.'')."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>
                        &nbsp
                        <a href='".site_url('/admin/vedit/'.$row->id.'')."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
                        </td>",
                    
                    //<a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#deldata\" class='deldata' href='#' id='".$row->id."'><span class='btn btn-xs btn-danger'><i class='fa fa-md fa-trash' ></i> Delete</span></a>
                );     
            }else{
                continue;
            }
            
        }

        // $count = count($data);
        $count = $this->Admin_model->count_filtered_getLimitByDepAksesWhere($departemen,$takses,$nodokint,$nama,$dept_id,$file_exist);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);

        
    }
	
	
	public function list_internal_dokumen_old($offset=0)
	{
        $name = $this->session->userdata('username');
        $departemen = $this->session->userdata('departemen');
        $takses = $this->session->userdata('tingkat_akses');

        $no= $this->__sanitizeString($this->input->get('no'));
		$nama= $this->__sanitizeString($this->input->get('nama'));
        $dept_id= $this->__sanitizeString($this->input->get('dept_id'));

        $jmldata = $this->Admin_model->countAllByDepAksesWhere('internal_dokumen',$departemen,$takses,$no,$nama,$dept_id);

        $data['deptID'] = $this->Admin_model->get_data('master_departemen','nama_departemen');
        
        $data['jml'] = $jmldata;

		$this->load->library('pagination');
		// $config['base_url'] = site_url('/home/search/');
		$config['base_url'] = site_url('/admin/list_internal_dokumen');
		$config['reuse_query_string'] = true;
		$config['total_rows'] = $jmldata;
		$config['per_page'] = $this->data_per_page;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript: void(0)" disabled>';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';

        // $dataDoc = $this->Admin_model->getDataByDepAkses('internal_dokumen','departemen',$departemen,'tingkat_akses',$takses);

        $data['start'] = $this->uri->segment(3) ? $this->uri->segment(3) + 1 : 0;

        $data['data'] = $this->Admin_model->getLimitByDepAksesWhere('internal_dokumen',$departemen,$takses, $config['per_page'], $data['start'],$no,$nama,$dept_id);
		
        // $data['data'] = $this->Admin_model->getDoc('internal_dokumen',$config['per_page'], $data['start']);
        
		$this->pagination->initialize($config);


		$data['pages']=$this->pagination->create_links();

        $this->template->set('title', 'Data Dokumen');
		$this->template->load('template', 'list_internal_dokumen', $data);

		// $this->__output('main',$data);
	}
	
    protected function src_external($srcdata=false)
    {
        $katakunci=$this->__sanitizeString($this->input->get('katakunci'));
        $bulan = $this->__sanitizeString($this->input->get('bulan'));
        $dept_id = $this->__sanitizeString($this->input->get('dept_id'));
            // if(!$katakunci && $srcdata){
            //     cekvar($bulan);
            // }
        // if()

        $w = array();
        $klas = array();
        if($katakunci){
          $w[] = " no_dokumen like '%".$katakunci."%'";
        } else {
            if($bulan!="" || $dept_id!="") {
                $dateNow = date('Y-m-d');
                $dateSoon = date('Y-m-d', strtotime('+'.$bulan.' days', strtotime($dateNow)));
                $tgl_sekarang = $dateNow;
                $sampai_tgl = $dateSoon;
                // $w[] = " tanggal like '%".$bulan."%'";
                $w[] = " tgl_berlaku BETWEEN '" . $tgl_sekarang . "' AND '" . $sampai_tgl . "'";

                $w[] = " id_departemen = '".$dept_id."' ";
            }
        }

        

        // $q = "SELECT * FROM eksternal_dokumen WHERE tgl_berlaku BETWEEN '" . $tgl_sekarang . "' AND '" . $sampai_tgl . "'";

        $q = "select * from eksternal_dokumen";

        $q_count = "SELECT COUNT(*) AS jmldata FROM eksternal_dokumen";
        if($_SESSION['akses_klas']!='') {
            $k = explode(',',$_SESSION['akses_klas']);
            $k = array_filter($k);
            sort($k);
            if(count($k)>0) {
                $klas=array_merge($klas,$k);
            }
        }
        /*
        if(count($klas)>0) {
            $w[] = " k.kode regexp '".implode('|',$klas)."'";
        }
        */
        
        //var_dump($w); die();
        if ($katakunci) {
            $q .= " WHERE".implode(" OR ",$w);
            $q_count .= " WHERE".implode(" OR ",$w);
            $src =  array(
                        "tgl_berlaku"=>$bulan,
                        "id_departemen"=>$dept_id,
                    );
            $qq = array($q, $q_count, $src);
            return $qq;
        } else {
            if(count($w) > 0) {
                $q .= " WHERE".implode(" AND ",$w);
                $q_count .= " WHERE".implode(" AND ",$w);
            }
        }

        if(!$katakunci && $srcdata) {
            $src =  array(
                        "tgl_berlaku"=>$bulan,
                        "id_departemen"=>$dept_id,
                    );
            return array($q, $q_count);
            } else {
                $src = array("Kata kunci"=>$katakunci);
            return array($q, $q_count, $src);
            }
        // cekvar($bulan);
        // if($bulan )
    }

    public function list_eksternal_dokumen()// pagination belum beres
    {   
        $data['deptID'] = $this->Admin_model->get_data('master_departemen','nama_departemen');
        // $data['deptID'] = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalDivision');

        $this->template->set('title', 'Data Dokumen');
        $this->template->load('template', 'list_eksternal_dokumen', $data);

    }

    public function get_list_eksternal_dokumen()
    {

        $nodokext= $this->__sanitizeString($this->input->post('nodokext'));
        $nama= $this->__sanitizeString($this->input->post('nama'));
        $dept_id= $this->__sanitizeString($this->input->post('dept_id'));
        $file_exist= $this->__sanitizeString($this->input->post('file_exist'));

        $query = $this->Admin_model->dataDokumenExt($nodokext,$nama,$dept_id,$file_exist);
        
        $data       = array();
        
        $deptID = $this->Admin_model->get_data('master_departemen','nama_departemen');
        // $deptID = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalDivision');

        // $start = $_POST['start'];
        $no = 0;

        foreach($query->result() as $row) {
            $namaDept = '';
            if(!empty($deptID)){
                if ($row->id_departemen!='') {
                    foreach ($deptID as $d) {
                        if ($row->id_departemen==$d['id']) {
                            $namaDept =  $d['nama_departemen'];
                        }
                        /*if ($row->id_departemen==$d->Division) {
                            $namaDept =  $d->Division;
                        }*/
                    }
                }else{
                    $namaDept = "-";
                }
            }else{
                $namaDept = "-";
            }

            $status1 = '';
            if($row->is_status=="1") {
                $status1 = "Aktif";
            }else {
                $status1 = "Tidak Aktif";
            }
            
            $status2 = '';
            if($row->is_share=="1") {
                $status2 = "Ya";
            }else {
                $status2 = "Tidak";
            }

            /*
            $nama_media = $this->Admin_model->get_data('master_media','nama_media');
            $media = '';
            foreach($nama_media as $nm){
                if($nm['id']==$a['media']){
                    $media "<td>".$nm['nama_media']."</td>";
                }
            }*/

            /*
            $file = '';
            if($row->file=="") {
                $file = "<td></td>";
            }else {
                $file = "<td><a href='".base_url('files/'.$a['file'])."' target='_blank'><span class='glyphicon glyphicon-save' aria-hidden='true'></span></a></td>";
            }*/
            $ketersedian_file = (strlen($row->file)>0)?"Ada":"Belum Ada";

            // $create_by = (!empty($this->Admin_model->dataById('master_user','nik',$row->create_by)[0]['nama']))?$this->Admin_model->dataById('master_user','nik',$row->create_by)[0]['nama']:'';
            /*$user_detail = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/user_detail?sales_code='.$row->create_by);
            $create_by = (is_object($user_detail))?$user_detail->Name:'';*/
            $create_by = $row->nama;

            if($this->session->userdata('tipe')=='admin'){
                $data[] = array(
                    "<td><input type='checkbox' class='getId[]' id='idcheck' name='getId[]' value='".$row->id."'/></td>",
                    ++$no,
                    // $row->tgl_dokumen,
                    $row->no_dokumen,
                    //$row->no_perijinan,
                    $row->nama_perijinan,
                    $row->nama_klien,
                    $namaDept,
                    //date('d/m/Y',strtotime($row->tgl_terbit)),
                    $row->publish_by,
                    //$row->deskripsi,
                    $row->owner_name,
                    $ketersedian_file,
                    //$row->create_name,
                    $row->tim_terkait,
                    date('d/m/Y',strtotime($row->tgl_berlaku)),
                    date('d/m/Y',strtotime($row->tgl_reminder)),
                    //$media,
                    //$row->jumlah,
                    //$row->file,
                    
                    $status1,                           
                    $status2,                           
                    /*
                    $row->tanggal,
                    $row->nama_kode,
                    $row->uraian,
                    $row->ket,
                    $file,
                    
                    $row->jumlah,
                    $row->nobox,
                    */
                    $create_by,
                   
                    "<td><a href='".site_url('admin/viewExternal/'.$row->id.'')."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>
                        &nbsp
                        <a href='".site_url('/admin/veditExternal/'.$row->id.'')."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
                        </td>",
                );
            }elseif($row->is_share == "1"){
                $actionButton = '';
                
                if($this->session->userdata('nik')==$row->create_by){
                    $actionButton = 
                    "<td><a href='".site_url('admin/viewExternal/'.$row->id.'')."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>
                        &nbsp
                        <a href='".site_url('/admin/veditExternal/'.$row->id.'')."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
                        </td>";
                }else{
                    $actionButton = 
                    "<td><a href='".site_url('admin/viewExternal/'.$row->id.'')."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>";
                }

                $data[] = array(
                    "<td><input type='checkbox' class='getId[]' id='idcheck' name='getId[]' value='".$row->id."'/></td>",
                    ++$no,
                    // $row->tgl_dokumen,
                    $row->no_dokumen,
                    //$row->no_perijinan,
                    $row->nama_perijinan,
                    $row->nama_klien,
                    $namaDept,
                    //date('d/m/Y',strtotime($row->tgl_terbit)),
                    $row->publish_by,
                    //$row->deskripsi,
                    $row->owner_name,
                    $ketersedian_file,
                    //$row->create_name,
                    $row->tim_terkait,
                    date('d/m/Y',strtotime($row->tgl_berlaku)),
                    date('d/m/Y',strtotime($row->tgl_reminder)),
                    //$media,
                    //$row->jumlah,
                    //$row->file,
                    
                    $status1,                           
                    $status2,                           
                    /*
                    $row->tanggal,
                    $row->nama_kode,
                    $row->uraian,
                    $row->ket,
                    $file,
                    
                    $row->jumlah,
                    $row->nobox,
                    */
                    $create_by,
                   
                    $actionButton,
                );
            }elseif($this->session->userdata('nik')==$row->create_by){
                $data[] = array(
                    "<td><input type='checkbox' class='getId[]' id='idcheck' name='getId[]' value='".$row->id."'/></td>",
                    ++$no,
                    // $row->tgl_dokumen,
                    $row->no_dokumen,
                    //$row->no_perijinan,
                    $row->nama_perijinan,
                    $row->nama_klien,
                    $namaDept,
                    //date('d/m/Y',strtotime($row->tgl_terbit)),
                    $row->publish_by,
                    //$row->deskripsi,
                    $row->owner_name,
                    $ketersedian_file,
                    //$row->create_name,
                    $row->tim_terkait,
                    date('d/m/Y',strtotime($row->tgl_berlaku)),
                    date('d/m/Y',strtotime($row->tgl_reminder)),
                    //$media,
                    //$row->jumlah,
                    //$row->file,
                    
                    $status1,                           
                    $status2,                           
                    /*
                    $row->tanggal,
                    $row->nama_kode,
                    $row->uraian,
                    $row->ket,
                    $file,
                    
                    $row->jumlah,
                    $row->nobox,
                    */
                    $create_by,
                   
                    "<td><a href='".site_url('admin/viewExternal/'.$row->id.'')."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>
                        &nbsp
                        <a href='".site_url('/admin/veditExternal/'.$row->id.'')."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
                        </td>",
                );
            }else{
                continue;
            }

        }

        // $count = count($data);
        $count = $this->Admin_model->count_filtered_dataDokumenExt($nodokext,$nama,$dept_id,$file_exist);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
        
    }

    public function list_eksternal_dokumen_old($offset=0)// pagination belum beres
    {
        $no=$this->__sanitizeString($this->input->get('no'));
        $nama = $this->__sanitizeString($this->input->get('nama'));
        $dept_id = $this->__sanitizeString($this->input->get('dept_id'));

        $data['current_page'] = 1;
        
        if ($offset>=$this->data_per_page) {
            $data['current_page'] = floor(($offset+$this->data_per_page)/$this->data_per_page);
        }

        // $hsl = $this->Admin_model->dataDokumenExt('*','eksternal_dokumen',$no,$nama,$dept_id,$this->data_per_page,$offset);
        $hsl = $this->Admin_model->dataDokumenExt('*','eksternal_dokumen',$no,$nama,$dept_id);
		
        $data['data'] = $hsl->result_array();


        $data['deptID'] = $this->Admin_model->get_data('master_departemen','nama_departemen');

        $jmldata = $hsl->num_rows();
        $data['jml']=$jmldata;

        $data['nama_media'] = $this->Admin_model->get_data('master_media','nama_media');
        
        $this->load->library('pagination');
        $config['base_url'] = site_url('/admin/list_eksternal_dokumen/');
        $config['reuse_query_string'] = true;
        $config['total_rows'] = $jmldata;
        // $config['per_page'] = $this->data_per_page;
        $config['per_page'] = $jmldata;
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript: void(0)" disabled>';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>'; 
        $config['first_tag_close'] = '</li>'; 
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="pagination pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->pagination->initialize($config);
        $data['pages']=$this->pagination->create_links();

        $this->template->set('title', 'Data Dokumen');
        $this->template->load('template', 'list_eksternal_dokumen', $data);

    }

    public function list_perizinan()// pagination belum beres
    {   
        $data['deptID'] = $this->Admin_model->get_data('master_departemen','nama_departemen');
        // $data['deptID'] = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalDivision');
        
        $this->template->set('title', 'Data Dokumen');
        $this->template->load('template', 'list_perizinan', $data);

    }

    public function get_list_perizinan()
    {

        $nodokizin= $this->__sanitizeString($this->input->post('nodokizin'));
        $nama= $this->__sanitizeString($this->input->post('nama'));
        $dept_id= $this->__sanitizeString($this->input->post('dept_id'));
        $file_exist= $this->__sanitizeString($this->input->post('file_exist'));

        $query = $this->Admin_model->dataDokumenIzin($nodokizin,$nama,$dept_id,$file_exist);
        
        $data       = array();
        
        $deptID = $this->Admin_model->get_data('master_departemen','nama_departemen');
        // $deptID = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/operationalDivision');
        
        // $start = $_POST['start'];
        $no = 0;

        foreach($query->result() as $row) {
            $namaDept = '';
            if(!empty($deptID)){
                if ($row->id_departemen!='') {
                    foreach ($deptID as $d) {
                        if ($row->id_departemen==$d['id']) {
                            $namaDept =  $d['nama_departemen'];
                        }
                        /*if ($row->id_departemen==$d->Division) {
                            $namaDept =  $d->Division;
                        }*/
                    }
                }else{
                    $namaDept = "-";
                }
            }else{
                $namaDept = "-";
            }

            $status1 = '';
            if($row->is_status=="1") {
                $status1 = "Aktif";
            }else {
                $status1 = "Tidak Aktif";
            }

            $status2 = '';
            if($row->is_share=="1") {
                $status2 = "Ya";
            }else {
                $status2 = "Tidak";
            }
            
            /*
            $nama_media = $this->Admin_model->get_data('master_media','nama_media');
            $media = '';
            foreach($nama_media as $nm){
                if($nm['id']==$a['media']){
                    $media "<td>".$nm['nama_media']."</td>";
                }
            }*/

            /*
            $file = '';
            if($row->file=="") {
                $file = "<td></td>";
            }else {
                $file = "<td><a href='".base_url('files/'.$a['file'])."' target='_blank'><span class='glyphicon glyphicon-save' aria-hidden='true'></span></a></td>";
            }*/
            $ketersedian_file = (strlen($row->file)>0)?"Ada":"Belum Ada";

            //$create_by = (!empty($this->Admin_model->dataById('master_user','nik',$row->create_by)[0]['nama']))?$this->Admin_model->dataById('master_user','nik',$row->create_by)[0]['nama']:'';
            /*$user_detail = $this->api_getData('https://dev.ptdika.com/rest-api/api/user/user_detail?sales_code='.$row->create_by);
            $create_by = (is_object($user_detail))?$user_detail->Name:'';*/
            $create_by = $row->nama;

            if($this->session->userdata('tipe')=='admin'){
                $data[] = array(
                    "<td><input type='checkbox' class='getId[]' id='idcheck' name='getId[]' value='".$row->id."'/></td>",
                    ++$no,
                    // $row->tgl_dokumen,
                    $row->no_perijinan,
                    //$row->no_perijinan,
                    $row->nama_perijinan,
                    $namaDept,
                    //date('d/m/Y',strtotime($row->tgl_terbit)),
                    $row->publish_by,
                    //$row->deskripsi,
                    $row->owner_name,
                    $ketersedian_file,
                    //$row->create_name,
                    $row->tim_terkait,
                    date('d/m/Y',strtotime($row->tgl_berlaku)),
                    date('d/m/Y',strtotime($row->tgl_reminder)),
                    //$media,
                    //$row->jumlah,
                    //$row->file,
                    
                    $status1,                           
                    $status2,                           
                    /*
                    $row->tanggal,
                    $row->nama_kode,
                    $row->uraian,
                    $row->ket,
                    $file,
                    
                    $row->jumlah,
                    $row->nobox,
                    */
                    $create_by,
                   
                    "<td><a href='".site_url('admin/viewIzin/'.$row->id.'')."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>
                        &nbsp
                        <a href='".site_url('/admin/veditIzin/'.$row->id.'')."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
                        </td>",
                );
            }elseif($row->is_share == "1"){

                $actionButton = '';
                
                if($this->session->userdata('nik')==$row->create_by){
                    $actionButton = 
                    "<td><a href='".site_url('admin/viewIzin/'.$row->id.'')."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>
                        &nbsp
                        <a href='".site_url('/admin/veditIzin/'.$row->id.'')."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
                        </td>";
                }else{
                    $actionButton = 
                    "<td><a href='".site_url('admin/viewIzin/'.$row->id.'')."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>";
                }
                
                $data[] = array(
                    "<td><input type='checkbox' class='getId[]' id='idcheck' name='getId[]' value='".$row->id."'/></td>",
                    ++$no,
                    // $row->tgl_dokumen,
                    $row->no_perijinan,
                    //$row->no_perijinan,
                    $row->nama_perijinan,
                    $namaDept,
                    //date('d/m/Y',strtotime($row->tgl_terbit)),
                    $row->publish_by,
                    //$row->deskripsi,
                    $row->owner_name,
                    $ketersedian_file,
                    //$row->create_name,
                    $row->tim_terkait,
                    date('d/m/Y',strtotime($row->tgl_berlaku)),
                    date('d/m/Y',strtotime($row->tgl_reminder)),
                    //$media,
                    //$row->jumlah,
                    //$row->file,
                    
                    $status1,                           
                    $status2,                           
                    /*
                    $row->tanggal,
                    $row->nama_kode,
                    $row->uraian,
                    $row->ket,
                    $file,
                    
                    $row->jumlah,
                    $row->nobox,
                    */
                    $create_by,
                   
                    $actionButton,
                );
            }elseif($this->session->userdata('nik')==$row->create_by){
                $data[] = array(
                    "<td><input type='checkbox' class='getId[]' id='idcheck' name='getId[]' value='".$row->id."'/></td>",
                    ++$no,
                    // $row->tgl_dokumen,
                    $row->no_perijinan,
                    //$row->no_perijinan,
                    $row->nama_perijinan,
                    $namaDept,
                    //date('d/m/Y',strtotime($row->tgl_terbit)),
                    $row->publish_by,
                    //$row->deskripsi,
                    $row->owner_name,
                    $ketersedian_file,
                    //$row->create_name,
                    $row->tim_terkait,
                    date('d/m/Y',strtotime($row->tgl_berlaku)),
                    date('d/m/Y',strtotime($row->tgl_reminder)),
                    //$media,
                    //$row->jumlah,
                    //$row->file,
                    
                    $status1,                           
                    $status2,                           
                    /*
                    $row->tanggal,
                    $row->nama_kode,
                    $row->uraian,
                    $row->ket,
                    $file,
                    
                    $row->jumlah,
                    $row->nobox,
                    */
                    $create_by,
                   
                    "<td><a href='".site_url('admin/viewIzin/'.$row->id.'')."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>
                        &nbsp
                        <a href='".site_url('/admin/veditIzin/'.$row->id.'')."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
                        </td>",
                );
            }else{
                continue;
            }

        }

        // $count = count($data);
        $count = $this->Admin_model->count_filtered_dataDokumenIzin($nodokizin,$nama,$dept_id,$file_exist);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
        
    }

	public function list_perizinan_old($offset=0)// pagination belum beres
    {
        $no=$this->__sanitizeString($this->input->get('no'));
        $nama = $this->__sanitizeString($this->input->get('nama'));
        $dept_id = $this->__sanitizeString($this->input->get('dept_id'));

        $data['current_page'] = 1;
        
        if ($offset>=$this->data_per_page) {
            $data['current_page'] = floor(($offset+$this->data_per_page)/$this->data_per_page);
        }

        // $hsl = $this->Admin_model->dataDokumenIzin('*','eksternal_dokumen',$this->data_per_page,$offset,$no,$nama,$dept_id);
        $hsl = $this->Admin_model->dataDokumenIzin('*','eksternal_dokumen',$no,$nama,$dept_id);
		
        $data['data'] = $hsl->result_array();

        $data['deptID'] = $this->Admin_model->get_data('master_departemen','nama_departemen');

        $jmldata = $hsl->num_rows();
        $data['jml']=$jmldata;

        $data['nama_media'] = $this->Admin_model->get_data('master_media','nama_media');
        
        $this->load->library('pagination');
        $config['base_url'] = site_url('/admin/list_perizinan/');
        $config['reuse_query_string'] = true;
        $config['total_rows'] = $jmldata;
        // $config['per_page'] = $this->data_per_page;
        $config['per_page'] = $jmldata;
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript: void(0)" disabled>';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>'; 
        $config['first_tag_close'] = '</li>'; 
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="pagination pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->pagination->initialize($config);
        $data['pages']=$this->pagination->create_links();

        $this->template->set('title', 'Data Dokumen');
        $this->template->load('template', 'list_perizinan', $data);

    }
	

    public function send_email(){
		
        $id = count($this->input->post('getId'));
        $idName = $this->input->post('getId');
        // cekvar($idName);
        // if($idName[0] == "on"){
        //     cekvar('oke bro');
        // } else {
        //     cekvar('oke');
        // }
      
        for($i=0 ; $i < $id ; $i++){
            // $nama = explode("-",$idName[$i]);    
            // $int_value = (int)$nama;
            $namaId = $idName[$i];
            // cekvar($namaId);
            $data = $this->Admin_model->dataUser((int)$namaId);
            // cekvar($data);
            // die();
            $countData = count($data);
            // cekvar($countData);

            // die();
            $no = 0;          
            
            for ($j=0; $j < $countData; $j++) { 
                # code...
                // $no = $data[$j] + 0;
                // var_dump($no);
                $dataJ = $data[$j]['email'];
                //     $subj = "TEST".$dataJ;
                // $message = "HELLOW BRO";
                $no_dokumen = $data[$j]['no_dokumen'];
                $no_perijinan = $data[$j]['no_perijinan'];
                $publish_by = $data[$j]['publish_by'];
                $keterangan = $data[$j]['deskripsi'];
                $m_berlaku = $data[$j]['tgl_berlaku'];
                $nama_perijinan = $data[$j]['nama_perijinan'];
            
                $subj = "DATA DOKUMEN EKSTERNAL YANG PERLU DIFOLLOW UP
                    " . $dataJ;
                $message = 
                '
                <table border="1" width="70%">
                <tr style="background-color:yellow;">
                <td align="center"><b>NO</b></td>
                <td align="center"><b>NO DOKUMEN</b></td>
                <td align="center"><b>NO PERIJINAN</b></td>
                <td align="center"><b>NAMA PERIJINAN</b></td>
                <td align="center"><b>KETERANGAN</b></td>
                <td align="center"><b>DITERBITKAN OLEH</b></td>
                <td align="center"><b>MASA BERLAKU</b></td>
                </tr>

                <tr>
                <td>' . ++$no . '</td>
                <td>' . $no_dokumen . '</td>
                <td>' . $no_perijinan. '</td>
                <td>' . $nama_perijinan. '</td>
                <td>' . $keterangan. '</td>
                <td>' . $publish_by. '</td>
                <td>' . $m_berlaku. '</td>
                </tr>

                </table>';
                // echo $dataJ;
                // var_dump($dataJ);
                // var_dump($dataJ);
                $this->send_emailTo($dataJ,$subj,$message);

                // die();
            }
            
        // die();
            
        };
    }


    public function send_emailTo($to, $subj, $message)
	{
		$this->load->library('email');
		//$this->config->load('setting');
		$config['mailtype'] = "html";
		$this->email->initialize($config);
		$this->email->from('support@ptdika.com', 'PT Danamas Insan Kreasi Andalan');
		$this->email->to($to);
		// $this->email->bcc('mukhamad.winanto@ptdika.com');
		$this->email->subject($subj);
		// $this->email->attach($attachment);
		$this->email->message($message);
		
        if ($this->email->send()) {
            echo "berhasil dikirim";
            // echo 'Your Email has successfully been sent.';
            // cekvar('nice');
        } else {
            show_error($this->email->print_debugger());
        }

	}
    
	
    /**
     * Export/import data page
     *
     */
    public function import()
    {
        //$this->__output('import');
        $this->template->set('title', 'Import Data');
        $this->template->load('template', 'import');
    }

    /**
     * Show tingkat akses data page
     *
     */

     public function tingkat_akses(){
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM ref_tingkat_akses ";
        if ($katakunci) {
            $q .= ' WHERE akses LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY departemen ASC";
        $hsl = $this->db->query($q);
        $data['peng'] = $hsl->result_array();
		$data["departemen"] = $this->masterlist("departemen");
        //$this->__output('pengolah', $data);
        $this->template->set('title', 'Data Tingkat Akses');
        $this->template->load('template', 'takses', $data);
     }

     public function takses()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("SELECT * FROM ref_tingkat_akses WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    public function addtaskes()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        // $data['data'] = $this->Admin_model->tambah('ref_tingkat_akses',$nama);
        // echo "datas";
        // cekvar($data);
        // die;
        $q = sprintf("INSERT INTO ref_tingkat_akses (akses) VALUES ('%s')", $nama);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
        
        // $this->session->set_flashdata(
        //     'message',
        //     '<div class="alert alert-success show m-b-0">
        //         <span class="close" data-dismiss="alert">&times;</span>
        //             <b>Data berhasil di saved!</b>
        //         </span>
        //     </div>'
        // );

        // redirect('admin/tingkat_akses');

    }

    public function edittaskes()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $departemen = $this->__sanitizeString($this->input->post('departemen'));
        $q = sprintf("UPDATE ref_tingkat_akses SET akses='%s', departemen='%s'", $nama, $departemen);
        $q .= " WHERE id=$id";
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    public function deltaskes()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $this->Admin_model->del_data($id,'ref_tingkat_akses');
        // $q = sprintf("DELETE FROM ref_tingkat_akses WHERE id=%d", $id);
        // $hsl = $this->db->query($q);
        //     if ($hsl) {
        //         echo json_encode(array('status' => 'success'));
        //     } else {
        //         echo '[]';
        //     }
        redirect('admin/tingkat_akses', 'refresh');
        // exit();
        
    }

	 /**
     * Master Template
     */
    public function template(){
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM ref_template_no_surat ";
        if ($katakunci) {
            $q .= ' WHERE nama_template LIKE \'%' . $katakunci . '%\' OR format_no_surat LIKE \'%' . $katakunci . '%\'  OR departemen LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY id ASC";
        $hsl = $this->db->query($q);

        $d = "SELECT * FROM master_departemen";
        $d .= " ORDER BY nama_departemen ASC";
        $dd = $this->db->query($d); 
        $data['peng'] = $hsl->result_array();
        $data['dept'] = $dd->result_array();
        //$this->__output('pengolah', $data);
        $this->template->set('title', 'Data Master Template');
        $this->template->load('template', 'mtemplate', $data);
     }

     public function mtemplate()
     {
         $id = $this->__sanitizeString($this->input->post('id'));
         $q = sprintf("SELECT * FROM ref_template_no_surat WHERE id=%d", $id);
         $hsl = $this->db->query($q);
         $row = $hsl->row_array();
         if ($row) { 
             echo json_encode($row);
             
         } else {
             echo '[]';
         }
         exit();
     }

     public function addmtemplate()
    {
		$kategori = $this->__sanitizeString($this->input->post('kategori'));
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $format_no = $this->__sanitizeString($this->input->post('nomor'));
        $dept = $this->__sanitizeString($this->input->post('departemen'));
        // $data['data'] = $this->Admin_model->tambah('ref_tingkat_akses',$nama);
        // echo "datas";
        // cekvar($data);
        // die;
        $q = sprintf("INSERT INTO ref_template_no_surat (kategori,nama_template, format_no_surat, departemen )
                      VALUES ('%s','%s', '%s', '%s')", $kategori,$nama, $format_no, $dept);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
            redirect('/admin/template', 'refresh');
            exit();
        } else {
            echo '[]';
        }
        exit();
        // redirect('/admin2/template', 'refresh');
        
     
    }

    public function editmtemplate()
    {
		$kategori = $this->__sanitizeString($this->input->post('kategori'));
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $format_no = $this->__sanitizeString($this->input->post('nomor'));
        $dept = $this->__sanitizeString($this->input->post('departemen'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE ref_template_no_surat SET kategori='%s',nama_template='%s', format_no_surat='%s', departemen='%s'",$kategori, $nama, $format_no, $dept );
        $q .= " WHERE id=$id";
        $hsl = $this->db->query($q);
        if ($hsl) {
           
            echo json_encode(array('status' => 'success'));
            redirect('/admin/template', 'refresh');
        } else {
            echo '[]';
        }
        exit();
    }

    public function delmtemplate()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $this->Admin_model->del_data($id,'ref_template_no_surat');
        // $q = sprintf("DELETE FROM ref_tingkat_akses WHERE id=%d", $id);
        // $hsl = $this->db->query($q);
        //     if ($hsl) {
        //         echo json_encode(array('status' => 'success'));
        //     } else {
        //         echo '[]';
        //     }
        redirect('admin/template', 'refresh');
        // exit();
        
    }

    /**
     * Export data to Excel file
     *
     */
    public function exportdata()
    {
        include 'dbimexport.php';
        $db_config = array(
            'dbtype' => "MYSQL",
            'host' => $this->db->hostname,
            'database' => $this->db->database,
            'user' => $this->db->username,
            'password' => $this->db->password,
        );
        $dbimexport = new dbimexport($db_config);
        $dbimexport->download_path = "";
        $dbimexport->download = true;
        $dbimexport->file_name = "backup_data_" . date("Y-m-d_H-i-s");
        $dbimexport->export();
    }

    

    /**
     * Import data from Excel file
     *
     */
    public function importdata()
    {
        if ($_FILES["up_file"]["name"]) {
            $source = $_FILES["up_file"]["tmp_name"];
            $this->load->library('excel');
            $read = PHPExcel_IOFactory::createReaderForFile($source);
            $read->setReadDataOnly(true);
            $excel = $read->load($source);
            $sheets = $read->listWorksheetNames($source); //baca semua sheet yang ada
            foreach ($sheets as $sheet) {
                $_sheet = $excel->setActiveSheetIndexByName($sheet); //Kunci sheetnye biar kagak lepas :-p
                $maxRow = $_sheet->getHighestRow();
                $maxCol = $_sheet->getHighestColumn();
                $field = array();
                $sql = array();
                $AllCol = range('A', $maxCol);
                //echo implode(",", $AllCol);
                foreach ($AllCol as $key => $coloumn) {
                    $field[$key] = $this->__sanitizeString($_sheet->getCell($coloumn . '2')->getCalculatedValue()); //Kolom pertama sebagai field list pada table
                }
                for ($i = 3; $i <= $maxRow; $i++) {
                    foreach ($AllCol as $k => $coloumn) {
                        $sql[$field[$k]] = $this->__sanitizeString($_sheet->getCell($coloumn . $i)->getCalculatedValue());
                    }
                    $noarsip = (isset($sql['No.Arsip']) ? $sql['No.Arsip'] : "");
                    $tanggal = (isset($sql['Tanggal']) ? $sql['Tanggal'] : "");
                    $uraian = (isset($sql['Uraian']) ? $sql['Uraian'] : "");
                    $id_kode = "";
                    $ket = (isset($sql['Ket']) ? $sql['Ket'] : "");
                    $nobox = (isset($sql['No.Box']) ? $sql['No.Box'] : "");
                    $file = "";
                    $jumlah = (isset($sql['Jumlah']) ? $sql['Jumlah'] : "");
                    $id_penc = "";
                    $id_peng = "";
                    $id_lok = "";
                    $id_med = "";
                    $user = (isset($sql['username']) ? $sql['username'] : "");
                    if (isset($sql["Kode Klasifikasi"]) && $sql["Kode Klasifikasi"] != "") {
                        $s = $sql["Kode Klasifikasi"];
                        $this->db->where('kode', $s);
                        $kode = $this->db->get('master_kode')->result_array();
                        if (count($kode) > 0) {
                            $id_kode = $kode[0]['id'];
                        } else {
                            $q = "insert ignore into master_kode (kode) values('$s');";
                            $this->db->query($q);
                            $id_kode = $this->db->insert_id();
                        }
                        $sql["Kode Klasifikasi"] = $id_kode;
                    }
                    if (isset($sql["Pencipta"]) && $sql["Pencipta"] != "") {
                        $s = $sql["Pencipta"];
                        $this->db->where('nama_pencipta', $s);
                        $kode = $this->db->get('master_pencipta')->result_array();
                        if (count($kode) > 0) {
                            $id_penc = $kode[0]['id'];
                        } else {
                            $q = "insert ignore into master_pencipta (nama_pencipta) values('$s');";
                            $this->db->query($q);
                            $id_penc = $this->db->insert_id();
                        }
                        $sql["Pencipta"] = $id_penc;
                    }
                    if (isset($sql["Pengolah"]) && $sql["Pengolah"] != "") {
                        $s = $sql["Pengolah"];
                        $this->db->where('nama_pengolah', $s);
                        $kode = $this->db->get('master_pengolah')->result_array();
                        if (count($kode) > 0) {
                            $id_peng = $kode[0]['id'];
                        } else {
                            $q = "insert ignore into master_pengolah (nama_pengolah) values('$s');";
                            $this->db->query($q);
                            $id_peng = $this->db->insert_id();
                        }
                        $sql["Pengolah"] = $id_peng;
                    }
                    if (isset($sql["Media"]) && $sql["Media"] != "") {
                        $s = $sql["Media"];
                        $this->db->where('nama_media', $s);
                        $kode = $this->db->get('master_media')->result_array();
                        if (count($kode) > 0) {
                            $id_med = $kode[0]['id'];
                        } else {
                            $q = "insert ignore into master_media (nama_media) values('$s');";
                            $this->db->query($q);
                            $id_med = $this->db->insert_id();
                        }
                        $sql["Media"] = $id_med;
                    }
                    if (isset($sql["Lokasi"]) && $sql["Lokasi"] != "") {
                        $s = $sql["Lokasi"];
                        $this->db->where('nama_lokasi', $s);
                        $kode = $this->db->get('master_lokasi')->result_array();
                        if (count($kode) > 0) {
                            $id_lok = $kode[0]['id'];
                        } else {
                            $q = "insert ignore into master_lokasi (nama_lokasi) values('$s');";
                            $this->db->query($q);
                            $id_lok = $this->db->insert_id();
                        }
                        $sql["Lokasi"] = $id_lok;
                    }
                    //echo "<pre>" . var_dump($sql) . "</pre>";
                    $q = sprintf("INSERT IGNORE INTO data_arsip (noarsip,tanggal,uraian,kode,ket,nobox,file,jumlah,pencipta,unit_pengolah,lokasi,media,tgl_input,username)
			        VALUES ('%s','%s','%s','%s','%s','%s','%s','%d',%d,%d,%d,%d,now(),'%s')",
                        $noarsip,
                        $tanggal,
                        $uraian,
                        $id_kode,
                        $ket,
                        $nobox,
                        $file,
                        $jumlah,
                        $id_penc,
                        $id_peng,
                        $id_lok,
                        $id_med,
                        $user);
                    //echo $q . "<br/>";
                    $this->db->query($q);
                }
            }

            $this->session->set_flashdata('zz', "Data berhasil diimport");
            redirect('/admin/import', 'refresh');
        } else {
            $this->session->set_flashdata('zz', "Tidak ada file yang diupload");
            redirect('/admin/import', 'refresh');
        }
    }

    

}
