<?php
/**
 * This application is licensed under GNU General Public License version 3
 * Developers:
 * Syauqi Fuadi ( xfuadi@gmail.com )
 * Arie Nugraha ( dicarve@gmail.com )
 *
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Admin2 extends CI_Controller
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
        $this->load->library(array('table','template'));
        $this->load->helper(array('form', 'url', 'html'));
		$this->load->model('Admin_model');
        // $this->load->model($this->model, '', TRUE);

        if (!$this->session->tipe == 'admin') {
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
        $data["unitpengolah"] = $this->Admin_model->get_data('master_pengolah','nama_pengolah');
        $data["lokasi"] = $this->Admin_model->get_data('master_lokasi','nama_lokasi');
        $data["media"] = $this->Admin_model->get_data('master_media','nama_media');
        $data["tingkat"] = $this->Admin_model->get_data('ref_tingkat_akses','id');
		$data["template"] = $this->Admin_model->get_template_where_kategori('id','internal');
		$data["user"] = $this->Admin_model->get_data('master_user','departemen');
		 
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
        $data["departemen"] = $this->Admin_model->get_data('master_departemen','nama_departemen');
        $data["user"] = $this->Admin_model->get_data('master_user','departemen');
        /*$data["unitpengolah"] = $this->Admin_model->get_data('master_pengolah','nama_pengolah');
        $data["kode"] = $this->Admin_model->get_data('master_kode','kode');
        $data["lokasi"] = $this->Admin_model->get_data('master_lokasi','nama_lokasi');
        $data["media"] = $this->Admin_model->get_data('master_media','nama_media');
        $data["tingkat"] = $this->Admin_model->get_data('ref_tingkat_akses','akses');
        $data["kode"] = $this->masterlist("kode");
        $data["departemen"] = $this->masterlist("departemen");
        $data["unitpengolah"] = $this->masterlist("unitpengolah");
        $data["lokasi"] = $this->masterlist("lokasi");
        $data["media"] = $this->masterlist("media");*/
        $data["title"] = "Tambah Arsip";

        
        // $this->__output('entri1', $data);

        $this->template->set('title', 'Entri Data');
		$this->template->load('template', 'input_external_doc', $data);
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
        if (!$this->upload->do_upload('file')) {
            echo "error";
            echo $this->upload->display_errors();
            echo $config['upload_path'];
            die();
        } else {
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
                'no_dokumen' =>$this->input->post('nodok'),
                'no_perijinan' => $this->input->post('noijin'),
                'nama_perijinan' => $this->input->post('namaijin'),
                'tgl_terbit' =>$this->input->post('tgl_terbit'),
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
            );


            $this->db->insert('eksternal_dokumen', $data_insert);

            $doc_id = $this->db->insert_id();
            

            // $data['message'] = "<b> Data Saved <b>";
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success show m-b-0">
                    <span class="close" data-dismiss="alert">&times;</span>
                        <b>Data berhasil di saved!</b>
                    </span>
                </div>'
            );

            redirect('admin/list_external_dokumen');

            /*$q = sprintf("INSERT INTO data_arsip (noarsip,tanggal,uraian,kode,ket,nobox,file,jumlah,pencipta,unit_pengolah,lokasi,media,tgl_input,username,status)
			VALUES ('%s','%s','%s','%s','%s','%s','%s','%d',%d,%d,%d,%d,now(),'%s','%s')",
            $noarsip, $tanggal, $uraian, $kode, $ket, $nobox, $file, $jumlah, $pencipta, $unitpengolah, $lokasi, $media, $_SESSION['username'], $status);
            $hsl = $this->db->query($q);
            $q = "SELECT LAST_INSERT_ID() as vid;";
            $hsl = $this->db->query($q);
            $row = $hsl->row_array();
            $v = $row['vid'];
            redirect('/home/view/' . $v, 'refresh'); */
        }
    }
	
	public function add_internal_dokumen()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')) {
            echo "error";
            echo $this->upload->display_errors();
            echo $config['upload_path'];
            die();
        } else {
            $datafile = $this->upload->data();
            //$file = $datafile['full_path'];
            $file_name = $datafile['file_name'];
            // var_dump($file_name);
			$tgl_dokumen = $this->__sanitizeString($this->input->post('tgl_dok'));
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

         
            $dateInput = $this->input->post('tgl_dok');
            $newDate = date("Y-m-d", strtotime($dateInput));
            


            $data_insert = array(
                'tgl_dokumen' => $newDate,
                'group_dokumen' => $this->input->post('group'),
                'no_dokumen' =>$this->input->post('no_dok'),
                'nama_dokumen' => $this->input->post('nama_dok'),
                'owner_dokumen' =>$this->input->post('deskripsi'),
                'deskripsi' => $this->input->post('owner'),
                'jumlah' => $this->input->post('jumlah'),
                'lokasi' => $this->input->post('lokasi'),
                'media' => $this->input->post('media'),
                'file' => $file,
				'tgl_input' => $newDate,
                'username' => $_SESSION['username'],
                'is_status' => $this->input->post('status'),
                'is_share' => $this->input->post('share'),
            );

            $this->db->insert('internal_dokumen', $data_insert);

            $doc_id = $this->db->insert_id();
            // redirect('/home/view/', 'refresh');

            $jml_dep = count($this->input->post('optmenu'));
            // $nama_tingkat = count($this->input->post('tingkat'));
            $nama_dep = $this->input->post('optmenu');

			
            for($i=0 ; $i < $jml_du ; $i++){
                $departemen_nama = explode("-",$du[$i]);
                $data_insert2 = array(
                    'id_dokumen' =>$doc_id,
                    'departemen' => $departemen_nama[0],
                    'user' => $departemen_nama[1],
                );
                $this->db->insert('ref_user_akses', $data_insert2);
            }
            
            
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success show m-b-0">
                    <span class="close" data-dismiss="alert">&times;</span>
                        <b>Data berhasil di saved!</b>
                    </span>
                </div>'
            );

            redirect('admin/list_internal_dokumen');

            // $q = sprintf("INSERT INTO internal_dokumen (tgl_dokumen,group_dokumen,no_dokumen,nama_dokumen,owner_dokumen,deskripsi ,jumlah,lokasi,media,file,tgl_input,username,is_status,is_share)
			// VALUES ('%s','%s','%s','%s','%s','%s','%s','%d',%d,%d,%d,%d,now(),'%s','%s')",
            // $tgl_dokumen, $group, $no_dokumen, $nama_dokumen, $deskripsi, $owner, $departemen, $tingkat, $lokasi, $media, $jumlah, $share, $_SESSION['username'], $status);
            // $hsl = $this->db->query($q);
            // $q = "SELECT LAST_INSERT_ID() as vid;";
            // $hsl = $this->db->query($q);
            // $row = $hsl->row_array();
            // $v = $row['vid'];
            // redirect('/home/view/' . $v, 'refresh'); 
        }
    }

    public function view($id){
        $data['doc'] = $this->Admin_model->getDataDoc($id);
        $data['data_departemen'] = $this->Admin_model->dataById('ref_departemen_akses','ref_departemen_akses.id_dokumen',$id);
        $data['tingkat_akses'] = $this->Admin_model->dataById('ref_dokumen_tingkat_akses','ref_dokumen_tingkat_akses.id_dokumen',$id);
		// $this->__output('varsip',$data);
        // echo"print";
        // cekvar($data);
        // die();

		$this->template->set('title', 'View');
		$this->template->load('template', 'vinternal_doc', $data);
    }

    public function viewExternal($id){
        $data['doc'] = $this->Admin_model->getDataDocExternal($id);
        $data['media'] = $this->Admin_model->dataById('master_media','master_media.id',$id);
        // $this->__output('varsip',$data);
        // echo"print";
        // cekvar($data);
        // die();

        $this->template->set('title', 'View');
        $this->template->load('template', 'vexternal_doc', $data);
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
            $row["kode"] = $this->Admin_model->get_data('master_kode','kode');
            $row["departemen"] = $this->Admin_model->get_data('master_departemen','nama_departemen');
            $row["unitpengolah"] = $this->Admin_model->get_data('master_pengolah','nama_pengolah');
            $row["lokasi"] = $this->Admin_model->get_data('master_lokasi','nama_lokasi');
            $row["media"] = $this->Admin_model->get_data('master_media','nama_media');
            $row["akses"] = $this->Admin_model->get_data('ref_tingkat_akses','akses');
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
            
            $row["nama_media"] = $this->Admin_model->get_data('master_media','nama_media');
            
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
    /**
     * Process input data from archive edit form
     *
     */
    public function edit($id)
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
            $q = "SELECT file FROM data_arsip WHERE id=$id";
            $d = $this->db->query($q)->row_array()['file'];
            $file = $d;
        }

        $nama_dep = $this->input->post('departemen');
        $nama_akses = $this->input->post('tingkat');

        

        $data_insert = array(
            'tgl_dokumen' => $this->input->post('tgl_dok'),
            'group_dokumen' => $this->input->post('group'),
            'no_dokumen' =>$this->input->post('no_dok'),
            'nama_dokumen' => $this->input->post('nama_dok'),
            'owner_dokumen' =>$this->input->post('owner'),
            'deskripsi' => $this->input->post('deskripsi'),
            'jumlah' => $this->input->post('jumlah'),
            'lokasi' => $this->input->post('lokasi'),
            'media' => $this->input->post('media'),
            'file' => $file,
            'username' => $_SESSION['username'],
            'is_status' => $this->input->post('status'),
            'is_share' => $this->input->post('share'),
        );

        $this->Admin_model->update_data($id,'internal_dokumen',$data_insert);
        // $this->{$this->model}->update($data_insert ,$id);

        // $data_delete_depart = array(
        //     'id_dokumen'	=> $id,
        // );
        $id_dokumen= $id;
        // echo "PRINT";
        // // cekvar($nama_dep);
        // cekvar($id_dokumen);
        // die();
        // $this->Admin_model->delete_checklist($data_delete_depart, 'ref_departemen_akses');
        $this->Admin_model->delete_checklist('ref_departemen_akses', $id_dokumen);

        $data_delete_akses = array(
            'id_dokumen'	=> $id,
        );
        // $this->Admin_model->delete_checklist($data_delete_akses,'ref_dokumen_tingkat_akses');
        $this->Admin_model->delete_checklist('ref_dokumen_tingkat_akses',$id_dokumen);

        foreach ($nama_dep as $nd) {
            $data_verification_depart = array(
                'id_dokumen'	=> $id,
                'id_departemen'	=> $nd
            );
            // $this->Admin_model->insert_checklist($data_verification_depart,'ref_departemen_akses');
            $this->Admin_model->insert_checklist('ref_departemen_akses',$data_verification_depart);
        }

        foreach ($nama_akses as $na) {
            $data_verification_akses = array(
                'id_dokumen'	=> $id,
                'id_tingkat_akses'	=> $na
            );
            // $this->Admin_model->insert_checklist($data_verification_akses,'ref_dokumen_tingkat_akses');
            $this->Admin_model->insert_checklist('ref_dokumen_tingkat_akses',$data_verification_akses);
        }


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
            'no_dokumen' =>$this->input->post('nodok'),
            'no_perijinan' => $this->input->post('noijin'),
            'nama_perijinan' => $this->input->post('namaijin'),
            'tgl_terbit' =>$this->input->post('tgl_terbit'),
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
        );

        $this->Admin_model->update_data($id,'eksternal_dokumen',$data_insert);
        // $this->{$this->model}->update($data_insert ,$id);


        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success show m-b-0">
                <span class="close" data-dismiss="alert">&times;</span>
                    <b>Data berhasil di update!</b>
                </span>
            </div>'
        );

        redirect('admin/list_external_dokumen');

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
        $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE media=%d", $id);
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
		$data["tingkat"] = $this->Admin_model->get_data('ref_tingkat_akses','akses');
		
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
		$katakunci=$this->__sanitizeString($this->input->get('katakunci'));
		// advanced search
  		$noarsip=$this->__sanitizeString($this->input->get('noarsip'));
		$tanggal=$this->__sanitizeString($this->input->get('tanggal'));
		$uraian=$this->__sanitizeString($this->input->get('uraian'));
		$ket=$this->__sanitizeString($this->input->get('ket'));
		$kode=$this->__sanitizeString($this->input->get('kode'));
		$retensi=$this->__sanitizeString($this->input->get('retensi'));
		$penc=$this->__sanitizeString($this->input->get('penc'));
		$peng=$this->__sanitizeString($this->input->get('peng'));
		$lok=$this->__sanitizeString($this->input->get('lok'));
		$med=$this->__sanitizeString($this->input->get('med'));
		$nobox=$this->__sanitizeString($this->input->get('nobox'));

		$w = array();
		$klas = array();
		if ($katakunci) {
		  // simple search
		  $w[] = " noarsip like '%".$katakunci."%'";
		  $w[] = " uraian like '%".$katakunci."%'";
		  $w[] = " nobox like '%".$katakunci."%'";
		} else {
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
		}

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
			$src = array("noarsip"=>$katakunci,"tanggal"=>'',"uraian"=>$katakunci,"ket"=>'',"kode"=>'',"retensi"=>'',"penc"=>'',"peng"=>'',"lok"=>'',"med"=>'',"nobox"=>$nobox);
			$qq = array($q, $q_count, $src);
			return $qq;
		} else {
			if(count($w) > 0) {
				$q .= " WHERE".implode(" AND ",$w);
				$q_count .= " WHERE".implode(" AND ",$w);
			}
		}

    if(!$katakunci && $srcdata) {
      $src = array("noarsip"=>$noarsip,"tanggal"=>$tanggal,"uraian"=>$uraian,"ket"=>$ket,"kode"=>$kode,"retensi"=>$retensi,"penc"=>$penc,"peng"=>$peng,"lok"=>$lok,"med"=>$med,"nobox"=>$nobox);
      return array($q, $q_count, $src);
    } else {
		$src = array("Kata kunci"=>$katakunci);
      return array($q, $q_count, $src);
    }
	}
	
	
	
	
	public function list_internal_dokumen($offset=0)
	{
		$name = $this->session->userdata('username');
		$departemen = $this->session->userdata('departemen');
		$takses = $this->session->userdata('tingkat_akses');
     

		$this->load->library('pagination');
		// $config['base_url'] = site_url('/home/search/');
		$config['base_url'] = site_url('/admin/list_internal_dokumen');
        $jmldata = $this->Admin_model->countAllByDepAkses('internal_dokumen',$departemen, $takses);
        // echo 'test';
        // cekvar($jmldata);
        // die();
      
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

        $data['start'] = $this->uri->segment(3) ? $this->uri->segment(3) + 1 : 0;
        // $data['start'] = $this->uri->segment(3);
        $data['jml'] = $this->Admin_model->countAllByDepAkses('internal_dokumen','departemen',$departemen,'tingkat_akses',$takses);
        // $data['data'] = $this->Admin_model->getDoc('internal_dokumen',$config['per_page'], $data['start']);
        $data['data'] = $this->Admin_model->getLimitByDepAkses('internal_dokumen','departemen',$departemen,'tingkat_akses',$takses, $config['per_page'], $data['start']);

		$this->pagination->initialize($config);


		$data['pages']=$this->pagination->create_links();

        $this->template->set('title', 'Data Dokumen');
		$this->template->load('template', 'data_dokumen', $data);

		// $this->__output('main',$data);
	}
	
protected function src_external($srcdata=false)
  {
        // simple search
        $katakunci=$this->__sanitizeString($this->input->get('katakunci'));
        // advanced search
        $noarsip=$this->__sanitizeString($this->input->get('noarsip'));
        $tanggal=$this->__sanitizeString($this->input->get('tanggal'));
        $uraian=$this->__sanitizeString($this->input->get('uraian'));
        $ket=$this->__sanitizeString($this->input->get('ket'));
        $kode=$this->__sanitizeString($this->input->get('kode'));
        $retensi=$this->__sanitizeString($this->input->get('retensi'));
        $penc=$this->__sanitizeString($this->input->get('penc'));
        $peng=$this->__sanitizeString($this->input->get('peng'));
        $lok=$this->__sanitizeString($this->input->get('lok'));
        $med=$this->__sanitizeString($this->input->get('med'));
        $nobox=$this->__sanitizeString($this->input->get('nobox'));

        $w = array();
        $klas = array();
        if ($katakunci) {
          // simple search
          $w[] = " noarsip like '%".$katakunci."%'";
          $w[] = " uraian like '%".$katakunci."%'";
          $w[] = " nobox like '%".$katakunci."%'";
        } else {
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
        }

        $q = "select * from eksternal_dokumen  ";

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
            $src = array("noarsip"=>$katakunci,"tanggal"=>'',"uraian"=>$katakunci,"ket"=>'',"kode"=>'',"retensi"=>'',"penc"=>'',"peng"=>'',"lok"=>'',"med"=>'',"nobox"=>$nobox);
            $qq = array($q, $q_count, $src);
            return $qq;
        } else {
            if(count($w) > 0) {
                $q .= " WHERE".implode(" AND ",$w);
                $q_count .= " WHERE".implode(" AND ",$w);
            }
        }

    if(!$katakunci && $srcdata) {
      $src = array("noarsip"=>$noarsip,"tanggal"=>$tanggal,"uraian"=>$uraian,"ket"=>$ket,"kode"=>$kode,"retensi"=>$retensi,"penc"=>$penc,"peng"=>$peng,"lok"=>$lok,"med"=>$med,"nobox"=>$nobox);
      return array($q, $q_count, $src);
    } else {
        $src = array("Kata kunci"=>$katakunci);
      return array($q, $q_count, $src);
    }
    }

    public function list_external_dokumen($offset=0)
    {
        $qq = $this->src_external(true); //print_r($qq); die();
        $q = $qq[0]; // var_dump($q); die();
        $data['src']=$qq[2];

        // echo $q;
        $q2 = $qq[1];
        $q .= " LIMIT $this->data_per_page ";

        $data['current_page'] = 1;
        if ($offset>=$this->data_per_page) {
            $data['current_page'] = floor(($offset+$this->data_per_page)/$this->data_per_page);
        }
        
        /*
        if ($page<2) {
            $offset = 0;
        } else {
            $offset = ($page*$this->data_per_page)-$this->data_per_page;
        }
        */
        
        if ($offset>0) $q .= "OFFSET $offset";
        //echo($q); die();

        $hsl = $this->db->query($q);
        $data['data'] = $hsl->result_array();

        $jmldata = $this->db->query($q2)->row()->jmldata;
        $data['jml']=$jmldata;

        $data['nama_media'] = $this->Admin_model->get_data('master_media','nama_media');
        
        /*
        $q = "select distinct ket from internal_dokumen order by ket asc";
        $hsl = $this->db->query($q);
        $data['ket'] = $hsl->result_array();
        $q = "select kode,nama from master_kode order by kode asc";
        $hsl = $this->db->query($q);
        $data['kode'] = $hsl->result_array();
        $q = "select * from master_pencipta order by nama_pencipta asc";
        $hsl = $this->db->query($q);
        $data['penc'] = $hsl->result_array();
        $q = "select * from master_pengolah order by nama_pengolah asc";
        $hsl = $this->db->query($q);
        $data['peng'] = $hsl->result_array();
        $q = "select * from master_lokasi order by nama_lokasi asc";
        $hsl = $this->db->query($q);
        $data['lok'] = $hsl->result_array();
        $q = "select * from master_media order by nama_media asc";
        $hsl = $this->db->query($q);
        $data['med'] = $hsl->result_array();
        */

        $this->load->library('pagination');
        // $config['base_url'] = site_url('/home/search/');
        $config['base_url'] = site_url('/admin/list_external_dokumen/');
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
        $this->pagination->initialize($config);
        $data['pages']=$this->pagination->create_links();

        $this->template->set('title', 'Data Dokumen');
        $this->template->load('template', 'data_dokumen_external', $data);

        // $this->__output('main',$data);
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
        $q .= " ORDER BY akses ASC";
        $hsl = $this->db->query($q);
        $data['peng'] = $hsl->result_array();
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
        $q = sprintf("UPDATE ref_tingkat_akses SET akses='%s'", $nama);
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
            redirect('/admin2/template', 'refresh');
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
            redirect('/admin2/template', 'refresh');
            echo json_encode(array('status' => 'success'));
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

    public function reloadtemp()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM ref_template_no_surat ";
        if ($katakunci) {
            $q .= ' WHERE nama_template LIKE \'%' . $katakunci . '%\' OR format_no_surat LIKE \'%' . $katakunci . '%\'  OR departemen LIKE \'%' . $katakunci . '%\'  ';
        }
        $q .= " ORDER BY id ASC";
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
