<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Controller extends CI_Controller 
{	
	//---------------------------- start Login Code-----------------------
	public function index()
	{
		$this->load->view('login');
	}
	public function login()
	{
		$login_id = $this->input->post('email');
		$password = $this->input->post('pass');		
		$resultdata = $this->main_model->login_process($login_id,$password);
		$record = $resultdata->result();		
		if(count($record) > 0)
		{			
			foreach ($record as $key)
			{
				if($key->password == $password)
				{
					if($key->designation_id == NULL)
					{
						$this->session->set_userdata('admin_name',$key->username);
						$this->session->set_userdata('admin_id',$key->admin_id);	
						$this->session->set_userdata('admin_img',$key->image);
						$this->session->set_userdata('admin_logged_in',TRUE);	
						$this->session->set_userdata('admin_controller','main_controller');
						$this->session->set_flashdata('success', 'Login Success!');	
						redirect('/main_controller/');
					}
					else if($key->designation_id == 2 || $key->designation_id == 3)
					{
						$this->session->set_userdata('username',$key->firstname .' '. $key->lastname);
						$this->session->set_userdata('user_id',$key->emp_id);	
						$this->session->set_userdata('user_img',$key->profile_pic);
						$this->session->set_userdata('logged_in',TRUE);
						$this->session->set_userdata('controller','techteam_controller');	
						$this->session->set_flashdata('success', 'Login Success!');	
						redirect('/techteam_controller/');
					}
					else if($key->designation_id == 4 || $key->designation_id == 5 || $key->designation_id == 6)
					{
						$this->session->set_userdata('username',$key->firstname .' '. $key->lastname);
						$this->session->set_userdata('user_id',$key->emp_id);	
						$this->session->set_userdata('user_img',$key->profile_pic);
						$this->session->set_userdata('logged_in',TRUE);	
						$this->session->set_userdata('controller','pmtl_controller');
						$this->session->set_flashdata('success', 'Login Success!');	
						redirect('/pmtl_controller/');
					}
				}
				else
				{
					$this->session->set_flashdata('error', 'Invalid username or password');
					$this->index();
				}
										
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'Invalid username or password');
			$this->index();
		}
		
	}
	public function logout()
	{
		if(isset($_SESSION['admin_controller']))
		{
			$this->session->unset_userdata('admin_name');
			$this->session->unset_userdata('admin_img');
			$this->session->unset_userdata('admin_id');
			$this->session->unset_userdata('admin_logged_in');
			$this->session->unset_userdata('admin_controller');
		}
		else if(isset($_SESSION['controller']))
		{
			$this->session->unset_userdata('username');			
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('user_img');
			$this->session->unset_userdata('controller');
			$this->session->unset_userdata('logged_in');
		}		
		redirect(base_url('index.php/Login_Controller/index'));
	}

	//---------------------------- end Login Code-----------------------

}