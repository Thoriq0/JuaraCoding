<?php

/**
 * This application is licensed under GNU General Public License version 3
 * Developers:
 * Syauqi Fuadi ( xfuadi@gmail.com )
 * Arie Nugraha ( dicarve@gmail.com )
 *
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	private $data_per_page = 100;
	/**
	 * Controller class constructor
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		// $this->load->library(array('auth'));

		$this->load->helper(array('form', 'url'));
		$this->load->library(array('auth', 'template','session'));

		if(!$this->session->username && $this->uri->segment(2)!='login') {
			redirect('/home/login', 'refresh');
		}
	}

	public function index()
	{
		if ($this->auth->is_logged_in() == false) {
			$this->login();
		} else {
			// redirect('home/search');
			redirect('homes');
		}
	}
	
	public function login()
	{
	
			
		if ($this->auth->is_logged_in() == false) {
			
			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			$this->form_validation->set_error_delimiters(' <span style="color:#FF0000">', '</span>');

			if ($this->form_validation->run() == FALSE) {
				
				$data['title'] = 'Login Form | Dika';
				$this->load->view('login_baru', $data);
			} else {

				$username = $this->input->post('username');
				$password = $this->input->post('password');
				
				if ($this->auth->active_session($username) == false) {
					
					$data['title'] = 'Login Form | DIKA';
					$data['login_info'] = "User sudah login di tempat lain..!";
					//Load View
					$this->load->view('login_baru', $data);
				} else {
					
					$success = $this->auth->do_login($username, $password);
					
					if ($success) {

							$log = array(
								'username' => $this->session->userdata('username'),
								'message' => 'login sukses',
								'action'  => 'login',
								'from_url' => 'http://' . $_SERVER['HTTP_HOST'], //.$_SERVER['PHP_SELF'],
								'from_ip' => $_SERVER["REMOTE_ADDR"]
							);
							$this->db->insert('user_logs', $log);

							// redirect to dashboard
							redirect('homes');

					} else {
						
						$data['title'] = 'DIKA | DOKUMEN';
						$data['login_info'] = "Wrong username or password!";

						//insert user activity to database
						$log = array(
							'username' => $username,
							'message' => 'login gagal',
							'action'  => 'login',
							'from_url' => 'http://' . $_SERVER['HTTP_HOST'], //.$_SERVER['PHP_SELF'],
							'from_ip' => $_SERVER["REMOTE_ADDR"]
						);
						$this->db->insert('user_logs', $log);

						//Load View
						$this->load->view('login_baru', $data);
					}
				}
			}
		} else {
			
			redirect('homes');
		}
	}
	
	public function login_old()
	{
		if ($this->auth->is_logged_in() == false) {
			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			$this->form_validation->set_error_delimiters(' <span style="color:#FF0000">', '</span>');

			if ($this->form_validation->run() == FALSE) {
				$data['title'] = 'Login Form | Dika';
				$this->load->view('login_baru', $data);
			} else {
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$success = $this->auth->do_login($username, $password);



				if ($success) {
					$q = "SELECT * FROM master_user WHERE username='$username'";
					$user = $this->db->query($q)->row();

					if ($user) {
						$_SESSION['username'] = $username;
						$_SESSION['id_user'] = $user->id;
						$_SESSION['tipe'] = $user->tipe;
						$_SESSION['akses_klas'] = $user->akses_klas;
						$_SESSION['departemen'] = $user->departemen;
						$_SESSION['tingkat_akses'] = $user->tingkat_akses;
						$_SESSION['akses_modul'] = json_decode($user->akses_modul, true);
						$_SESSION['menu_master'] = false;

						$log = array(
							'username' => $this->session->userdata('username'),
							'message' => 'login sukses',
							'action'  => 'login',
							'from_url' => 'http://' . $_SERVER['HTTP_HOST'], //.$_SERVER['PHP_SELF'],
							'from_ip' => $_SERVER["REMOTE_ADDR"]
						);
						$this->db->insert('user_logs', $log);

						// redirect to dashboard
						redirect('');
					} 
					// else {
					// 	$this->session->set_flashdata('erorlogin', 'Username atau password yang anda masukkan salah');
					// 	redirect('/home/login', 'refresh');
					// }
				
					//insert user activity to database

				} else {
					$data['title'] = 'DIKA | DOKUMEN';
					$data['login_info'] = "Wrong username or password!";

					//insert user activity to database
					$log = array(
						'username' => $username,
						'message' => 'login gagal',
						'action'  => 'login',
						'from_url' => 'http://' . $_SERVER['HTTP_HOST'], //.$_SERVER['PHP_SELF'],
						'from_ip' => $_SERVER["REMOTE_ADDR"]
					);
					$this->db->insert('user_logs', $log);

					//Load View
					$this->load->view('login_baru', $data);
				}
			}
		} else {
			redirect('homes');
		}
	}

	function logout()
	{
		if ($this->auth->is_logged_in() == true) {
			// jika dia memang sudah login, destroy session
			$this->auth->do_logout();

			//insert user activity to database
			$log = array(
				'username' => $this->session->userdata('username'),
				'message' => 'logout sukses',
				'action'  => 'logout',
				'from_url' => 'http://' . $_SERVER['HTTP_HOST'], //.$_SERVER['PHP_SELF'],
				'from_ip' => $_SERVER["REMOTE_ADDR"]
			);
			$this->db->insert('user_logs', $log);
			// jika dia memang sudah login, destroy session
			$this->auth->do_logout();									  
		}
		// larikan ke halaman login
		redirect('');
	}


	public function search($offset = 0)
	{
		$qq = $this->src(true); //print_r($qq); die();
		$q = $qq[0]; // var_dump($q); die();
		$data['src'] = $qq[2];

		//echo $q;
		$q2 = $qq[1];
		$q .= " LIMIT $this->data_per_page ";

		$data['current_page'] = 1;
		if ($offset >= $this->data_per_page) {
			$data['current_page'] = floor(($offset + $this->data_per_page) / $this->data_per_page);
		}
		/*
		if ($page<2) {
			$offset = 0;
		} else {
			$offset = ($page*$this->data_per_page)-$this->data_per_page;
		}
		*/
		if ($offset > 0) $q .= "OFFSET $offset";
		//echo($q); die();

		$hsl = $this->db->query($q);
		$data['data'] = $hsl->result_array();

		$jmldata = $this->db->query($q2)->row()->jmldata;
		$data['jml'] = $jmldata;

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
		$config['base_url'] = site_url('/home/search/');
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
		$data['pages'] = $this->pagination->create_links();

		$this->template->set('title', 'Data Arsip');
		$this->template->load('template', 'data_arsip', $data);

		// $this->__output('main',$data);
	}

	protected function __sanitizeString($str)
	{
		// return filter_var($this->__sanitizeString( $str),FILTER_SANITIZE_STRING);
		//return $this->db->escape($this->__sanitizeString( $str));
		//return $this->db->escape(filter_var($str,FILTER_SANITIZE_STRING));
		return html_purify($str);
	}

	protected function src($srcdata = false)
	{
		// simple search
		$katakunci = $this->__sanitizeString($this->input->get('katakunci'));
		// advanced search
		$noarsip = $this->__sanitizeString($this->input->get('noarsip'));
		$tanggal = $this->__sanitizeString($this->input->get('tanggal'));
		$uraian = $this->__sanitizeString($this->input->get('uraian'));
		$ket = $this->__sanitizeString($this->input->get('ket'));
		$kode = $this->__sanitizeString($this->input->get('kode'));
		$retensi = $this->__sanitizeString($this->input->get('retensi'));
		$penc = $this->__sanitizeString($this->input->get('penc'));
		$peng = $this->__sanitizeString($this->input->get('peng'));
		$lok = $this->__sanitizeString($this->input->get('lok'));
		$med = $this->__sanitizeString($this->input->get('med'));
		$nobox = $this->__sanitizeString($this->input->get('nobox'));

		$w = array();
		$klas = array();
		if ($katakunci) {
			// simple search
			$w[] = " noarsip like '%" . $katakunci . "%'";
			$w[] = " uraian like '%" . $katakunci . "%'";
			$w[] = " nobox like '%" . $katakunci . "%'";
		} else {
			// advanced search
			if ($noarsip != "") {
				$w[] = " noarsip like '%" . $noarsip . "%'";
			}
			if ($tanggal != "") {
				$w[] = " tanggal like '%" . $tanggal . "%'";
			}
			if ($kode != "" && $kode != "all") {
				//$w[] = " a.kode like '".$kode."%'";
				$klas[] = $kode;
			}
			if ($ket != "" && $ket != "all") {
				$w[] = " ket='" . $ket . "'";
			}
			if ($uraian != "") {
				$w[] = " uraian like '%" . $uraian . "%'";
			}
			if ($retensi != "" && $retensi != "all") {
				if ($retensi == "sudah") {
					$w[] = " DATE_ADD(a.tanggal,INTERVAL k.retensi YEAR) < CURDATE()";
				} else {
					$w[] = " DATE_ADD(a.tanggal,INTERVAL k.retensi YEAR) > CURDATE()";
				}
			}
			if ($penc != "" && $penc != "all") {
				$w[] = " pencipta ='" . $penc . "'";
			}
			if ($peng != "" && $peng != "all") {
				$w[] = " unit_pengolah ='" . $peng . "'";
			}
			if ($lok != "" && $lok != "all") {
				$w[] = " lokasi ='" . $lok . "'";
			}
			if ($med != "" && $med != "all") {
				$w[] = " media ='" . $med . "'";
			}
			if ($nobox != "") {
				$w[] = " nobox like '%" . $nobox . "%'";
			}
		}

		$q = "select * from internal_dokumen  ";

		$q_count = "SELECT COUNT(*) AS jmldata FROM internal_dokumen";
		if ($_SESSION['akses_klas'] != '') {
			$k = explode(',', $_SESSION['akses_klas']);
			$k = array_filter($k);
			sort($k);
			if (count($k) > 0) {
				$klas = array_merge($klas, $k);
			}
		}
		/*
		if(count($klas)>0) {
			$w[] = " k.kode regexp '".implode('|',$klas)."'";
		}
		*/

		//var_dump($w); die();
		if ($katakunci) {
			$q .= " WHERE" . implode(" OR ", $w);
			$q_count .= " WHERE" . implode(" OR ", $w);
			$src = array("noarsip" => $katakunci, "tanggal" => '', "uraian" => $katakunci, "ket" => '', "kode" => '', "retensi" => '', "penc" => '', "peng" => '', "lok" => '', "med" => '', "nobox" => $nobox);
			$qq = array($q, $q_count, $src);
			return $qq;
		} else {
			if (count($w) > 0) {
				$q .= " WHERE" . implode(" AND ", $w);
				$q_count .= " WHERE" . implode(" AND ", $w);
			}
		}

		if (!$katakunci && $srcdata) {
			$src = array("noarsip" => $noarsip, "tanggal" => $tanggal, "uraian" => $uraian, "ket" => $ket, "kode" => $kode, "retensi" => $retensi, "penc" => $penc, "peng" => $peng, "lok" => $lok, "med" => $med, "nobox" => $nobox);
			return array($q, $q_count, $src);
		} else {
			$src = array("Kata kunci" => $katakunci);
			return array($q, $q_count, $src);
		}
	}


	public function view($id)
	{
		$q = "SELECT a.*,p.nama_pencipta,p2.nama_pengolah,k.nama,k.kode nama_kode,l.nama_lokasi,m.nama_media,
			DATE_ADD(a.tanggal,INTERVAL k.retensi YEAR) AS b,
			(IF(DATE_ADD(a.tanggal,INTERVAL k.retensi YEAR)<CURDATE(),'sudah','belum')) AS f
			FROM data_arsip a
			LEFT JOIN master_pencipta p ON p.id=a.pencipta
			LEFT JOIN master_pengolah p2 ON p2.id=a.unit_pengolah
			LEFT JOIN master_kode k ON k.id=a.kode
			LEFT JOIN master_lokasi l ON l.id=a.lokasi
			LEFT JOIN master_media m ON m.id=a.media
			WHERE a.id=$id";
		$data = $this->db->query($q)->row_array();



		// $this->__output('varsip',$data);

		$this->template->set('title', 'View');
		$this->template->load('template', 'varsip_baru', $data);
	}


	public function dl()
  {
  	$q = $this->src();
  	$hsl = $this->db->query($q[0]);
		$data = $hsl->result_array();
  	$this->load->library('excel');
  	//activate worksheet number 1
  	$this->excel->setActiveSheetIndex(0);
  	//name the worksheet
  	//$this->excel->getActiveSheet()->setTitle('test worksheet');
  	//set cell A1 content with some text
  	$this->excel->getActiveSheet()->setCellValue('A1', 'Data Arsip');
  	//change the font size
  	$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
  	//make the font become bold
  	$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
  	//merge cell A1 until D1
  	$this->excel->getActiveSheet()->mergeCells('A1:D1');
  	//set aligment to center for that merged cell (A1 to D1)
  	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, 'No.');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 2, 'No.Arsip');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, 2, 'Tanggal');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, 2, 'Kode Klasifikasi');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, 2, 'Uraian');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, 2, 'Pencipta');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, 2, 'Pengolah');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, 2, 'Media');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, 2, 'Lokasi');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, 2, 'Ket');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, 2, 'Jumlah');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(11, 2, 'No.Box');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(12, 2, 'Retensi');

  	$row=3;
  	$redblock = array('fill' => array(
  		'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array('rgb' => 'FF0000')));
	$no=1;
  	foreach($data as $d) {
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $no);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $d['noarsip']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $d['tanggal']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $d['nama_kode']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $d['uraian']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $d['nama_pencipta']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $d['nama_pengolah']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $d['nama_media']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $d['nama_lokasi']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $d['ket']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $d['jumlah']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $d['nobox']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $d['b']);
  	  if($d['f']=='sudah') {
  	      $this->excel->getActiveSheet()->getStyleByColumnAndRow(12, $row)->applyFromArray($redblock);
  	  }
		$row++;
		$no++;
  	}

  	$filename='Data Arsip Arteri-'.getdate()[0].'.xls'; //save our workbook as this file name
  	header('Content-Type: application/vnd.ms-excel'); //mime type
  	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
  	header('Cache-Control: max-age=0'); //no cache
  	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
  	$objWriter->save('php://output');
  }
}
