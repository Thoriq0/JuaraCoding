<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
	private $model = 'User_model';

	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library(array('template', 'form_validation'));
		$this->load->model($this->model);
		error_reporting(0);
	}

    public function check_old_password()
    {
		$id = $this->session->userdata('id_user');
		$old_pass_db = $this->{$this->model}->dataFieldById('master_user','password','id',$id);
    	$old_db = $old_pass_db->password;
    	$old = $this->input->post('old_password'); 
    	
        if (md5($old,$old_db)){
            return true;
        } else {
            $this->form_validation->set_message("check_old_password", "Wrong Password");
            return false;
        }
    }

	function change_password()
	{
		
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|callback_check_old_password');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
		// min_length[6]
		$this->form_validation->set_rules('password_conf', 'Password Confirmation', 'trim|required|matches[new_password]');
		$this->form_validation->set_error_delimiters(' <span style="color:#FF0000">', '</span>');
		
		$id = $this->session->userdata('id_user');
		$old_pass_db = $this->{$this->model}->dataFieldById('master_user','password','id',$id);
		
    	$old_db = $old_pass_db->password;
    	$old = $this->input->post('old_password'); 
    	
        
		if ($this->form_validation->run() == FALSE) {
			$this->template->set('title','Change Password');
			$this->template->load('template', 'change_password');
		} else {
			
			$data_update = array(
				'password' => md5($this->input->post('new_password')),
			);

			$this->{$this->model}->new_password($data_update, $id);
			
				// $this->session->set_userdata('password_change', '1');
				// window.location.href='/dokumen';
				// redirect to home
				// redirect('');
				echo "<script>
				alert('Sukses, password berhasil diubah.');
				
				window.location.href= '". base_url()."/home/logout';
				</script>";

		}
	
	}
}