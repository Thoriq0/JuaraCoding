<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();


		$this->load->helper(array('form', 'url'));
		$this->load->library(array('auth', 'template'));
		$this->load->model('Admin_model');

		if(!$this->session->username && $this->uri->segment(2)!='login') {
			redirect('/home/login', 'refresh');
		}
	}

	public function index()
	{
		$jmlh['internal'] 	= $this->Admin_model->getCountInternal();
		$jmlh['eksternal'] 	= $this->Admin_model->getCountEksternal();
		$jmlh['perizinan'] 	= $this->Admin_model->getCountIzin();
		
		$this->template->set('title', 'Home');
		$this->template->load('template', 'home', $jmlh);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */