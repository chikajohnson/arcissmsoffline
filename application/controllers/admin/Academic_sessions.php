<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Academic_sessions extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		if (!$this->session->userdata('logged_in')) {
		 	redirect('welcome');
		}

		if ($this->session->userdata('user_type') != 'admin') {
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
	
	public function index()
	{
			//Load template
		$data['count'] = $this->academic_session_model->count();
		$data['index'] = 'All';
		
		$data['academic_sessions'] = $this->academic_session_model->get_academic_sessions();

		$data['main'] = 'admin/academic_sessions/index';
		$this->load->view('admin/layout/main', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('name', 'name', 'trim|required|callback_session_exist');
		$this->form_validation->set_rules('description', 'description', 'trim|required');
		$this->form_validation->set_rules('session_starts', 'session starts', 'trim|required|callback_check_higher_date['.$this->input->post('session_ends').']');
		$this->form_validation->set_rules('session_ends', 'session ends', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			
			$data['main'] = 'admin/academic_sessions/add';
			$this->load->view('admin/layout/main', $data);
		} else {
			$data  = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
				'session_starts' => $this->input->post('session_starts'),
				'session_ends' => $this->input->post('session_ends')
				 );

			//insert Academic_session
			$this->academic_session_model->add($data);

			$data  = array(
				'resource_id' => $this->db->insert_id(),
				'type' => 'academic_session',
				'action' => 'added',
				'user_id' => $this->session->userdata('user_id'),
				'message' => 'A new academic session was added(' .$data['name'].')'
				 );

			//Insert Activivty
			$this->activity_model->add($data);

			//Set Message
			$this->session->set_flashdata('success', 'Academic session has been added');

			redirect('admin/academic_sessions','refresh');
		}
		
	}

	public function edit($id=0)
	{		
		if ($this->academic_session_model->check_if_id_exists($id) == NULL) {
			
			$data['main'] = 'admin/error';
			$this->load->view('admin/layout/main', $data);
		} else {

			$this->form_validation->set_rules('name', 'name', 'trim|required');
			$this->form_validation->set_rules('description', 'description', 'trim|required');
			$this->form_validation->set_rules('session_starts', 'session_starts', 'trim|required|callback_check_higher_date['.$this->input->post('session_ends').']');
			$this->form_validation->set_rules('session_ends', 'session_ends', 'trim|required');


			if ($this->form_validation->run() == FALSE) {

				//getcurrent session
				$data['academic_session'] = $this->academic_session_model->get_academic_session($id);			

				$data['main'] = 'admin/academic_sessions/edit';
				$this->load->view('admin/layout/main', $data);
			} else {
				$data  = array(
					'name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'session_starts' => $this->input->post('session_starts'),
					'session_ends' => $this->input->post('session_ends')
					 );

				//update academic_session
				$this->academic_session_model->update($id, $data);

				$data  = array(
					'resource_id' => $id,
					'type' => 'academic_session',
					'action' => 'updated',
					'user_id' => $this->session->userdata('user_id'),
					'message' => ' Academic session_model was updated'
					 );

				//Insert Activivty
				$this->activity_model->add($data);

				//Set Message
				$this->session->set_flashdata('success', 'Academic session has been updated');

				redirect('admin/academic_sessions','refresh');
			}
		}
	}

	public function detail($id=0)
	{
			//Load template
		if ($this->academic_session_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'admin/error';
			$this->load->view('admin/layout/main', $data);
		} else {

			$data['session'] = $this->academic_session_model->get_academic_session($id);

			$data['main'] = 'admin/academic_sessions/detail';
			$this->load->view('admin/layout/main', $data);
		}
	}
	public function delete($id=0)
	{
		//$name = $this->academic_session_model->get_study_session();
		if ($this->academic_session_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'admin/error';
			$this->load->view('admin/layout/main', $data);
		} else {

		$this->academic_session_model->delete($id);

		$data  = array(
				'resource_id' => $id,
				'type' => 'academic_session',
				'action' => 'Deleted',
				'user_id' => $this->session->userdata('user_id'),
				'message' => ' Academic session was deleted'
				 );

			//Insert Activivty
			$this->activity_model->add($data);

			//Set Message
			$this->session->set_flashdata('success', 'Academic session has been deleted');

			redirect('admin/academic_sessions','refresh');
		}
	}

	public function search()
	{
		if (!isset($_POST['academic_session'])){

			$data['main'] = 'admin/academic_sessions/index';
			$this->load->view('admin/layout/main', $data);
		}

		$data['academic_sessions'] = null;
		$data['index'] = "All";

		$this->form_validation->set_rules('academic_session', 'academic session', 'trim|required|differs[0]');

		// $this->form_validation->set_rules('search_param', 'Search parameter', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			// var_dump($data); die();

			$data['main'] = 'admin/academic_sessions/index';
			$this->load->view('admin/academic_sessions/index', $data);
		} else {
			$data  = array(
				'academic_session' => $this->input->post('academic_session'),
				'search_param' => $this->input->post('search_param')
				 );
			
			$data['count'] = $this->academic_session_model->count();

			//insert course
			$data['index'] = "All";
			$data['academic_sessions'] = $this->academic_session_model->search($data['academic_session'], $data['search_param']);

			$data['main'] = 'admin/academic_sessions/index';
			$this->load->view('admin/layout/main', $data);

			
		}
		
	}

	public function paginate()
	{
		if(isset($_POST['academic_session'])){
		

			$this->form_validation->set_rules('academic_session', 'academic session', 'trim|required');

			$data['index'] = "All";
			// $this->form_validation->set_rules('search_param', 'Search parameter', 'trim|required');


			if ($this->form_validation->run() == FALSE) {

				$data['main'] = 'admin/academic_sessions/index';
				$this->load->view('admin/layout/main', $data);
			} else {
				$data  = array(
					'academic_session' => $this->input->post('academic_session')
					 );
				
				$data['count'] = $this->academic_session_model->count();	
				$data['index'] = $data['academic_session'];
				$data['academic_sessions'] = $this->academic_session_model->paginate($data['academic_session']);

				$data['main'] = 'admin/academic_sessions/index';
				$this->load->view('admin/layout/main', $data);

				
			}

		} else {
			redirect('admin/academic_sessions/index','refresh');
		}


	}

	public function session_exist($name)
    {		
        if ($this->academic_session_model->session_exist(trim($name)) == true)
        {
                $this->form_validation->set_message('session_exist', 'The {field} ' .' <strong>'. $name.'</strong>'. ' already Exists');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
	}
	
	public function check_higher_date($start_date, $end_date)
    {		
        if (strtotime($start_date) > strtotime($end_date))
        {
                $this->form_validation->set_message('check_higher_date', 'Session Start date must not be greater than Session end date');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
    }
}
