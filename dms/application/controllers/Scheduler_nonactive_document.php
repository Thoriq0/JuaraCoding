<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Scheduler_nonactive_document extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->database();
		$this->load->model('announcement_model');
	}

	function index()
	{
		$idDokumenNonactiveExternalToday = $this->announcement_model->getdataNonactiveExternal()->result();
        $idDokumenNonactivePerizinanToday = $this->announcement_model->getdataNonactivePerizinan()->result();
        $idDokumenNonactiveInternalToday = $this->announcement_model->getdataNonactiveInternal()->result();

		foreach($idDokumenNonactiveExternalToday as $dokumenExternalId ){
            $this->announcement_model->updateDokumenRow('eksternal_dokumen',array('id'=>$dokumenExternalId->id),array('is_status'=>0));
        }

        foreach($idDokumenNonactivePerizinanToday as $dokumenPerizinanId ){
            $this->announcement_model->updateDokumenRow('eksternal_dokumen',array('id'=>$dokumenPerizinanId->id),array('is_status'=>0));
        }

        foreach($idDokumenNonactiveInternalToday as $dokumenInternalId ){
            $this->announcement_model->updateDokumenRow('internal_dokumen',array('id'=>$dokumenInternalId->id),array('is_status'=>0));
        }

		echo json_encode(array("status" => 'ok'));
        redirect('homes');
		

	}

}