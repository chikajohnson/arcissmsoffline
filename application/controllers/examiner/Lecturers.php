<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lecturers extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
		 	redirect('welcome');
		}

		if ($this->session->userdata('user_type') != 'examiner') {
		 	redirect('welcome');
		}
		
	}
	
	public function index()
	{
			//Load template
		$data['lecturers'] = $this->lecturer_model->get_lecturers();

		$data['main'] = "examiner/lecturers/index";
		$this->load->view('examiner/layout/main', $data);
	}
	public function add()
	{
		
		$this->form_validation->set_rules('last_name', 'last_name', 'trim|required');
		$this->form_validation->set_rules('first_name', 'first_name', 'trim|required');
		$this->form_validation->set_rules('title', 'title', 'trim|required');
		$this->form_validation->set_rules('phonenumber', 'phonenumber', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$data['main'] = "examiner/lecturers/add";
			$this->load->view('examiner/layout/main', $data);
		} else {
			$data  = array(
				'last_name' => $this->input->post('last_name'),
				'first_name'			 => $this->input->post('first_name'),
				'other_names'			 => $this->input->post('other_names'),
				'title' => $this->input->post('title'),
				'phonenumber'		 => $this->input->post('phonenumber'),
				'email' => $this->input->post('email'),
				);

			//insert lecturer
			$this->lecturer_model->add($data);
			$data  = array(
				'resource_id' => $this->db->insert_id(),
				'type' => 'lecturer',
				'action' => 'added',
				'user_id' 	=>  $this->session->userdata('user_id'),
				'message' => 'A new lecturer  was added(' .$data['last_name'].'-'.$data['first_name'].' - '.$data['title'].')'
				);

			//Insert Activivty
			$this->activity_model->add($data);
			//Set Message
			$this->session->set_flashdata('success', 'A new Lecturer has been added');
			redirect('examiner/lecturers','refresh');
		}
		
	}
	public function edit($id=0)
	{
		if ($this->lecturer_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'examiner/error';
			$this->load->view('examiner/layout/main', $data);
		}
		else{

			$data['lecturer'] = $this->lecturer_model->get_lecturer($id);
			$this->form_validation->set_rules('last_name', 'last_name', 'trim|required');
			$this->form_validation->set_rules('first_name', 'first_name', 'trim|required');
			$this->form_validation->set_rules('title', 'title', 'trim|required');
			$this->form_validation->set_rules('phonenumber', 'phonenumber', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				//getcurrent lecturer
				$data['lecturer'] = $this->lecturer_model->get_lecturer($id);
				
				$data['main'] = "examiner/lecturers/edit";
				$this->load->view('examiner/layout/main', $data);
			} else {
				$data  = array(
					'last_name' => $this->input->post('last_name'),
					'first_name'			 => $this->input->post('first_name'),
					'other_names'			 => $this->input->post('other_names'),
					'title' => $this->input->post('title'),
					'phonenumber'		 => $this->input->post('phonenumber'),
					'email' => $this->input->post('email'),
					);

				//update lecturer
				$this->lecturer_model->update($id, $data);
				$data  = array(
					'resource_id' => $id,
					'type' => 'lecturer',
					'action' => 'updated',
					'user_id' 	=>  $this->session->userdata('user_id'),
					'message' => 'lecturer was updated',
					);
				//Insert Activivty
				$this->activity_model->add($data);
				//Set Message
				$this->session->set_flashdata('success', 'lecturer has been updated');
				redirect('examiner/lecturers','refresh');
			}
		}
	}
	public function detail($id=0)
	{
		if ($this->lecturer_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'examiner/error';
			$this->load->view('examiner/layout/main', $data);
		}
		else{
		//Load template
			$data['lecturer'] = $this->lecturer_model->get_lecturer($id);
			$data['allocated_courses'] = $this->course_model->get_allocated_courses($id);
			
			$data['main'] = "examiner/lecturers/detail";
			$this->load->view('examiner/layout/main', $data);
		}
	}
	public function delete($id=0)
	{
		if ($this->lecturer_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'examiner/error';
			$this->load->view('examiner/layout/main', $data);
		}
		else{
		
			$this->lecturer_model->delete($id);
			$data  = array(
					'resource_id' => $id,
					'type' => 'lecturer',
					'action' => 'Deleted',
					'user_id' 	=>  $this->session->userdata('user_id'),
					'message' => 'lecturer was deleted',
					);
				//Insert Activivty
				$this->activity_model->add($data);
				//Set Message
				$this->session->set_flashdata('success', 'lecturer has been deleted succesfully');
				redirect('examiner/lecturers','refresh');
			}
	}

	public function allocate()
	{
		$data['courses'] = $this->course_model->get_courses();
		$data['lecturers'] = $this->lecturer_model->get_lecturers();
		
			
	
		$this->form_validation->set_rules('course', 'course', 'trim|required|greater_than[0]');
		$this->form_validation->set_rules('lecturer', 'course lecturer', 'trim|required|greater_than[0]');
		$this->form_validation->set_message('greater_than', 'Please select %s.');

		
		if ($this->form_validation->run() == FALSE) {
			$data['main'] = "examiner/lecturers/allocate";
			$this->load->view('examiner/layout/main', $data);
		} else {
			$data  = array(
				'course_id' => $this->input->post('course'),
				'lecturer_id' => $this->input->post('lecturer'),				
				'course_code' => $this->course_model->get_course($this->input->post('course'))->code,	
				'course_title' => $this->course_model->get_course($this->input->post('course'))->title,	
				'lecturer_email' => $this->lecturer_model->get_lecturer($this->input->post('lecturer'))->email,	
				'lecturer_name' => $this->lecturer_model->get_lecturer($this->input->post('lecturer'))->title .' '. $this->lecturer_model->get_lecturer($this->input->post('lecturer'))->last_name .' ' . $this->lecturer_model->get_lecturer($this->input->post('lecturer'))->first_name,					
				);

			if ($this->check_if_allocated($data['course_id'], $data['lecturer_id']) == True) {

				$this->session->set_flashdata('error', $data['course_code']. ' has been allocted to '. $data['lecturer_name']. ' already');
				redirect('examiner/lecturers/allocate');
			} 

			//insert results
			$this->lecturer_model->allocate($data);
			// $result = $this->course_model->get_course($this->input->post('course'));

			$data  = array(
				'resource_id' => $this->db->insert_id(),
				'type' => 'allocation',
				'action' => 'allocated',
				'user_id' => $this->session->userdata('user_id'),
				'message' => $data['course_code'] . ' was allocated to '. $data['lecturer_email']	
				);
			//Insert Activivty
			$this->activity_model->add($data);
				$data['selected'] = '';
				if (isset($_POST['allocate'])) {
					$data['selected'] = $this->input->post('course');
				} else {
					
				}
			//Set Message
			$this->session->set_flashdata('success', 'Course allocation was successful');
			redirect('examiner/lecturers/allocate');
		}
		
	}

	public function redirect_to($value)
	{
		$this->session->set_flashdata('success', 'Removed succesfully');
		redirect("examiner/lecturers/view_list/$value");
	}

	public function view_list($id=0)
	{
		if ($this->course_model->check_if_id_exists($id) == NULL && $id != 0) {
			$data['main'] = 'examiner/error';
			$this->load->view('examiner/layout/main', $data);
		}else{		

			if (isset($_POST['allocation'])) {
						
				$data['code'] = $this->input->post('allocation');		
					
			}else{
				if ($id == 0) {
					$data['code'] = 2;
				} else {
					$data['code'] = $id;
				}
								
			}
			
			$data['courses'] = $this->course_model->get_courses();
			$data['course_detail'] = $this->course_model->get_course($data['code']);
			$data['allocations'] = $this->lecturer_model->get_course_allocation_list($data['code']);

			//var_dump($data['course_detail']); die();

			$data['main'] = "examiner/lecturers/allocation_list";
			$this->load->view('examiner/layout/main', $data);
		}
	}

	public function remove($course_id, $lecturer_id)
	{
		$this->lecturer_model->remove_allocation($course_id, $lecturer_id);
		$this->redirect_to($course_id);


	}

	public function check_if_allocated($course_id, $lecturer_id)
	{


		return $this->lecturer_model->check_if_allocated($course_id, $lecturer_id);
	}
	
}