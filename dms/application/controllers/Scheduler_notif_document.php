<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Scheduler_notif_document extends Nologin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->database();
		$this->load->model('announcement_model');
	}

	/*function index()
	{
		$ttlhbd = 0;
		$ttltgr = 0;

		$data = $this->announcement_model->getdata()->result();
		foreach ($data as $row) {
			if ($row->Schedule == "daily-birthday") {
				$kalimat = $row->Announcement_Description;
				$dataemp = $this->announcement_model->getdataemployeebirthday($row->Employee_ID)->result();

				foreach ($dataemp as $rowemp) {
					$temukan = array('$Name', '$NIK');
					$ganti_dengan = array($rowemp->Name, $rowemp->NIK);
					$kalimat_baru = str_replace($temukan, $ganti_dengan, $kalimat);
					$data['card'] = $row->Card;
					$data['deskripsi'] = $kalimat_baru;
					$data['category'] = $row->Subject_Email;
					
					if ($rowemp->Email_Dika) {
						$ttlhbd = $ttlhbd + 1;
						$message = $this->load->view('send_email_view', $data, true);
						$this->send_email($rowemp->Email_Dika, $row->Subject_Email, $message);
						//$this->send_email('sdm@ptdika.com', $row->Subject_Email, $message);
					}
				}
			}	

			if ($row->Schedule == "daily-trigger" && $row->Schedule_bln . "-" . $row->Schedule_tgl == date('m-d')) {
				$kalimat = $row->Announcement_Description;
				$dataemp = $this->announcement_model->getdataemployee($row->Employee_ID)->result();
				foreach ($dataemp as $rowemp) {
					if ($rowemp->Email_Dika) {
						$ttltgr = $ttltgr + 1;
						$temukan = array('$Name', '$NIK');
						$ganti_dengan = array($rowemp->Name, $rowemp->NIK);
						$kalimat_baru = str_replace($temukan, $ganti_dengan, $kalimat);
						$data['card'] = $row->Card;
						$data['deskripsi'] = $kalimat_baru;
						$data['category'] = $row->Announcement_Description;
						$message = $this->load->view('send_email_view', $data, true);
						$this->send_email($rowemp->Email_Dika, $row->Subject_Email, $message);
					}
				}
			}
		}
		echo json_encode(array("status" => 'ok', "ttlhbd" => $ttlhbd, "ttltgr" => $ttltgr));
	}*/
	
	function index()
	{
		$idDokumenReminderToday = $this->announcement_model->getdataReminder()->result();
        $idDokumenReminderToday2 = $this->announcement_model->getdataReminder2()->result();
		
		foreach($idDokumenReminderToday as $namaId ){

            // cekvar($namaId);
            $data = $this->announcement_model->dataUser($namaId->id);
            // cekdb();`
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
            
                $subj = "Test Scheduler_notif_document
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
                if(!empty($dataJ)){
                    $this->send_emailTo($dataJ,$subj,$message);
                }else{
                    continue;
                }

                // die();
            }
            
        // die();
            
        }

        foreach($idDokumenReminderToday2 as $namaId2 ){

            // cekvar($namaId);
            $data = $this->announcement_model->dataUser2($namaId2->id);
            // cekdb();`
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
                $no_perijinan = $data[$j]['nama_dokumen'];
                
            
                $subj = "Test Scheduler_notif_document
                    " . $dataJ;
                $message = 
                '
                <table border="1" width="70%">
                <tr style="background-color:yellow;">
                <td align="center"><b>NO</b></td>
                <td align="center"><b>NO DOKUMEN</b></td>
                <td align="center"><b>Nama Dokumen</b></td>            
                </tr>

                <tr>
                <td>' . ++$no . '</td>
                <td>' . $no_dokumen . '</td>
                <td>' . $nama_dokumen. '</td>                
                </tr>

                </table>';
                // echo $dataJ;
                // var_dump($dataJ);
                // var_dump($dataJ);
                if(!empty($dataJ)){
                    $this->send_emailTo($dataJ,$subj,$message);
                }else{
                    continue;
                }

                // die();
            }
            
        // die();
            
        }
		echo json_encode(array("status" => 'ok'));
        redirect('homes');

	}

	private function send_email($to, $subj, $message)
	{
		$this->load->library('email');
		//$this->config->load('setting');
		$config['mailtype'] = "html";
		$this->email->initialize($config);
		$this->email->from('support@ptdika.com', 'PT.DIKA');
		$this->email->to($to);
		$this->email->cc('sdm@ptdika.com');								
		$this->email->subject($subj);
		// $this->email->attach($attachment);
		$this->email->message($message);
		$this->email->send();
		$this->email->clear(true);
		/*if($this->email->send()){
			echo "Email berhasil dikirim";
		}
		else{
			$this->email->print_debugger();
		}*/
	}
}
