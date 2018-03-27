<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

	function __construct()
	{
		parent::__construct();	

		if (!$this->session->userdata('logged_in')) {
			redirect('welcome');
	   }

	   if ($this->session->userdata('user_type') != 'lecturer') {
			redirect('welcome');
	   }
	   
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

	public function index($Starting=0)
	{		
		$user = $this->session->userdata('user_name');

		$data['count'] = $this->notification_model->count($user);		
		$data['notifications'] = $this->notification_model->get_notifications_by_receiver($user);
		//var_dump($data); die();
		$data['main'] = "lecturer/notifications/index";
		$this->load->view('lecturer/layout/main', $data);
	}

	
	public function delete($id=0)
	{
		if ($this->notification_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'lecturer/error';
			$this->load->view('lecturer/layout/main', $data);
		} else {

			$this->notification_model->delete($id);

			$data  = array(
					'resource_id' => $id,
					'type' => 'notification',
					'action' => 'Deleted',
					'user_id' => $this->session->userdata('user_id'),
					'message' => ' notification was deleted',
					 );

			//Insert Activivty
			$this->activity_model->add($data);

			//Set Message
			$this->session->set_flashdata('success', 'notification has been deleted');

			redirect('lecturer/notifications','refresh');
		}
	}

	public function detail($id=0)
	{
			//Load template
			//var_dump($id); die();
		if ($this->notification_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'lecturer/error';
			$this->load->view('lecturer/layout/main', $data);
		} else {
			$data['notification'] = $this->notification_model->get_notification_by_id($id);
			$data['notification_count'] = $this->notification_model->count($this->session->userdata("user_name"));

			$viewed_data  = array(
					'viewed' => true
				 );

			$this->notification_model->viewed($id, $viewed_data);	
			


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

			$data['main'] = "lecturer/notifications/detail";
			$this->load->view('lecturer/layout/main', $data);
		}
	}


	public function search()
	{
		if (!isset($_POST['notification'])){
			redirect('lecturer/notifications/index','refresh');
		}
		
		$data['notifications'] = null;
		$data['index'] = "All";

		$this->form_validation->set_rules('notification', 'notification', 'trim|required|differs[0]');

		// $this->form_validation->set_rules('search_param', 'Search parameter', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['main'] = "lecturer/notifications/index";
		$this->load->view('lecturer/layout/main', $data);
		} else {
			$data  = array(
				'notification' => $this->input->post('notification'),
				'search_param' => $this->input->post('search_param')
				 );
			
			$data['count'] = $this->notification_model->count($this->session->userdata('user_name'));

			//insert notification
			$data['index'] = "All";
			$data['notifications'] = $this->notification_model->search($data['notification'], $data['search_param']);
			

			$data['main'] = "lecturer/notifications/index";
			$this->load->view('lecturer/layout/main', $data);			
		}		
	}


	public function paginate()
	{
		if(isset($_POST['notification'])){	
			$this->form_validation->set_rules('notification', 'notification', 'trim|required');

			$data['index'] = "All";

			if ($this->form_validation->run() == FALSE) {
				$data['main'] = "lecturer/notifications/index";
				$this->load->view('lecturer/layout/main', $data);
			} else {
				$data  = array(
					'notification' => $this->input->post('notification')
					 );
				
				$data['count'] = $this->notification_model->count($this->session->userdata('user_name'));	
				$data['index'] = $data['notification'];
				$data['notifications'] = $this->notification_model->paginate($data['notification']);

				$data['main'] = "lecturer/notifications/index";
				$this->load->view('lecturer/layout/main', $data);
				
			}

		} else {
			redirect('lecturer/notifications/index','refresh');
		}
	}
	
}
