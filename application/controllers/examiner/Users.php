<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('logged_in')) {	
			$notification_unread = 	$this->notification_model->get_notifications_unread($this->session->userdata('user_name'));
			
			$notification = $this->notification_model->count_viewed($this->session->userdata('user_name'));
			$notification_data  = array(
				'notification_count' => $notification,
				'notification_unread' => $notification_unread

			);
			//set notification session data
			$this->session->set_userdata($notification_data);
	   }		
		
	}
	
	public function index()
	{
		
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome');
		} else {
			if ($this->session->userdata('user_type')!= 'examiner') {
			redirect('welcome');
		 }

		}

		//Load template
		$data['users'] = $this->user_model->get_users();
		$data['groups'] = $this->usergroup_model->get_usergroups();
		//var_dump($data['users']);die();

		$data['main'] = "examiner/users/index";
		$this->load->view('examiner/layout/main', $data);
	}
	
	public function add()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome');
		} else {
			if ($this->session->userdata('user_type')!= 'examiner') {
			redirect('welcome');
		 }
		}

		$data['groups'] = $this->usergroup_model->get_usergroups();

		$this->form_validation->set_rules('phonenumber', 'Phonenumber', 'trim|required');
		// $this->form_validation->set_rules('user_name', 'User name', 'trim|required');				
		$this->form_validation->set_rules('last_name', 'last_name', 'trim|required');
		$this->form_validation->set_rules('first_name', 'first_name', 'trim|required');
		$this->form_validation->set_rules('other_names', 'other_names', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|callback_email_check');
		$this->form_validation->set_rules('password', 'password', 'trim|alpha_numeric|min_length[4]|max_length[10]|required');
		$this->form_validation->set_rules('user_group', 'User group', 'trim|required|greater_than[0]');

		$this->form_validation->set_message('greater_than', 'Please select a usergroup.');
		$this->form_validation->set_message('alpha_numeric', 'Password must be alpha numeric character between 4 to 10 characters long.');
		$this->form_validation->set_message('required', ' %s is requred.');

		if ($this->form_validation->run() == FALSE) {
			$data['main'] = "examiner/users/add";
			$this->load->view('examiner/layout/main', $data);
		} else {
			$data  = array(
				'phonenumber' => $this->input->post('phonenumber'),
				'user_name' => strtolower($this->input->post('email')),
				'last_name' 		=> $this->input->post('last_name'),
				'first_name'		=> $this->input->post('first_name'),
				'other_names'		=> $this->input->post('other_names'),
				'email'				=> $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'user_group' => $this->input->post('user_group'),
				'password_plain' => $this->input->post('password')
				);

			//var_dump($this->usergroup_model->get_usergroup_name($data['user_group'])); die();

			if($this->usergroup_model->get_usergroup_name($data['user_group']) == "lecturer"){
				
				if($this->user_model->check_lecurer_email_exists(strtolower(trim($data['user_name']))) == false){					
					$this->session->set_flashdata('error', '<strong>'. $this->input->post('email').'</strong>  is not associated with any registered lecturer');
					redirect('examiner/users/add');
				}
			}
			//insert user
			$this->user_model->add($data);
			$data  = array(
				'resource_id' => $this->db->insert_id(),
				'type' => 'User',
				'action' => 'added',
				'user_id' => $this->session->userdata('user_id'),
				'message' => 'A new user was added (' .$data['email'].')',
				);
			//Insert Activivty
			$this->activity_model->add($data);
			//Set Message
			$this->session->set_flashdata('success', 'User has been added');
			redirect('examiner/users','refresh');
		}
		
	}
	public function edit($id = 0)
	{
		//$this->user_model->check_if_id_exist();
		if ($this->user_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'examiner/error';
			$this->load->view('examiner/layout/main', $data);
		} else {

			if (!$this->session->userdata('logged_in')) {
				redirect('welcome');
			} else {
				if ($this->session->userdata('user_type')!= 'examiner') {
				redirect('welcome');
			 }
			}

			$data['user'] = $this->user_model->get_user($id);
			$data['groups'] = $this->usergroup_model->get_usergroups();

			

			$this->form_validation->set_rules('phonenumber', 'phonenumber', 'trim|required');				
			$this->form_validation->set_rules('last_name', 'last_name', 'trim|required');
			$this->form_validation->set_rules('first_name', 'first_name', 'trim|required');
			$this->form_validation->set_rules('other_names', 'other_names', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required');
			// $this->form_validation->set_rules('user_name', 'user_name', 'trim|required');
			$this->form_validation->set_rules('password', 'password', 'trim|required');
			$this->form_validation->set_rules('user_group', 'user_group', 'trim|required|greater_than[0]');

			if ($this->form_validation->run() == FALSE) {

				//getcurrent subject
				$data['user'] = $this->user_model->get_user($id);
				$data['main'] = "examiner/users/edit";
				$this->load->view('examiner/layout/main', $data);
			} else {
				$data  = array(
					'phonenumber' => $this->input->post('phonenumber'),
					'last_name' 		=> $this->input->post('last_name'),
					'first_name'		=> $this->input->post('first_name'),
					'other_names'		=> $this->input->post('other_names'),
					'email'				=> $this->input->post('email'),
					'user_name' => $this->input->post('email'),
					'password' => md5($this->input->post('password')),
					'user_group' => $this->input->post('user_group'),
					'password_plain' =>  $this->input->post('password')
					);



				if($this->usergroup_model->get_usergroup_name($data['user_group']) == "lecturer"){
					
					if($this->user_model->check_lecurer_email_exists(strtolower(trim($data['user_name']))) == false){					
						$this->session->set_flashdata('error', '<strong>'. $this->input->post('email').'</strong>  is not associated with any registered lecturer');
						redirect('examiner/users/edit/'.$id);
					}
				}
				//update user
				$this->user_model->update($id, $data);
				$data  = array(
					'resource_id' => $id,
					'type' => 'user',
					'action' => 'updated',
					'user_id' => $this->session->userdata('user_id'),
					'message' => ' user was updated',
					);
				//Insert Activivty
				$this->activity_model->add($data);
				//Set User
				$this->session->set_flashdata('success', 'User has been updated');
				redirect('examiner/users','refresh');
			}
		}
	}
	public function detail($id = 0)
	{
		if ($this->user_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'examiner/error';
			$this->load->view('examiner/layout/main', $data);

		} else {

			if (!$this->session->userdata('logged_in')) {
				redirect('welcome');
			} else {
				if ($this->session->userdata('user_type')!= 'examiner') {
				redirect('welcome');
			 }
			}
				//Load template
			$data['user'] = $this->user_model->get_user($id);

			$data['main'] = "examiner/users/detail";
			$this->load->view('examiner/layout/main', $data);
		}
	}
	public function delete($id = 0)
	{
		if ($this->user_model->check_if_id_exists($id) == NULL) {
			$this->load->view('examiner/error');

		} else {
			if (!$this->session->userdata('logged_in')) {
				redirect('welcome');
			} else {
				if ($this->session->userdata('user_type')!= 'examiner') {
				redirect('welcome');
			 }

			}

			//$name = $this->user_model->get_user();
			$this->user_model->delete($id);
			$data  = array(
					'resource_id' => $id, 
					'type' => 'user',
					'action' => 'Deleted',
					'user_id' => $this->session->userdata('user_id'),
					'message' => 'User was deleted',
					);
				//Insert Activivty
				$this->activity_model->add($data);
				//Set Message
				$this->session->set_flashdata('success', 'User has been deleted');
				redirect('examiner/users','refresh');
		}
	}

	public function suspend($id = 0)
	{
		if ($this->user_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'examiner/error';
			$this->load->view('examiner/layout/main', $data);

		} else {
			if (!$this->session->userdata('logged_in')) {
				redirect('welcome');
			} else {
				if ($this->session->userdata('user_type')!= 'examiner') {
				redirect('welcome');
			 }

			}

		$admin_email =$this->user_model->get_admin_email($id);
		$data  = array(
			'status' => false
					);
			//suspend user
			$this->user_model->suspend_account($id, $data);
			$data  = array(
					'resource_id' => $id, 
					'type' => 'user',
					'action' => 'suspended',
					'user_id' => $this->session->userdata('user_id'),
					'message' =>  $admin_email .' has been suspended by the Chief Examiner',
					);
				//Insert Activivty
				$this->activity_model->add($data);
				//Set Message
				$this->session->set_flashdata('success', 'User account has been suspended');
				redirect('examiner/users','refresh');
			}
	}

	public function activate($id = 0)
	{
		if ($this->user_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'examiner/error';
			$this->load->view('examiner/layout/main', $data);

		} else {

			if (!$this->session->userdata('logged_in')) {
				redirect('welcome');
			} else {
				if ($this->session->userdata('user_type')!= 'examiner') {
				redirect('welcome');
			 }

			}

		$admin_email =$this->user_model->get_admin_email($id);
		$data  = array(
			'status' => true
					);
			//suspend user
			$this->user_model->activate_account($id, $data);
			$data  = array(
					'resource_id' => $id, 
					'type' => 'user',
					'action' => 'suspended',
					'user_id' => $this->session->userdata('user_id'),
					'message' =>  $admin_email .' has been activated by the Chief Examiner',
					);
				//Insert Activivty
				$this->activity_model->add($data);
				//Set Message
				$this->session->set_flashdata('success', 'User account has been activated');
				redirect('examiner/users','refresh');
		}
	}

	public function email_check($email)
    {
        if ($this->user_model->check_email_exists(trim($email)) == true)
        {
                $this->form_validation->set_message('email_check', 'The {field} ' .' <strong>'. $email.'</strong>'. ' already Exists');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
    }

}