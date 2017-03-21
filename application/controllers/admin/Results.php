
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Results extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
		 	redirect('welcome');
		}
		if ($this->session->userdata('user_type') != 'admin') {
		 	redirect('welcome');
		}		
	}			
	
	public function index()
	{
			//Load template
		$data['index'] = '100';
		$data['results'] = $this->result_model->get_results_admin($data['index']);
		$data['courses'] = $this->course_model->get_courses();
		$data['count'] = $this->result_model->count_admin();
		
		$data['main'] = "admin/results/index";
		$this->load->view('admin/layout/main', $data);
	}
	public function add()
	{
		$data['courses'] = $this->course_model->get_courses();
		$data['semesters'] = $this->semester_model->get_semesters();
		$data['sessions'] = $this->academic_session_model->get_academic_sessions();
		
		$this->form_validation->set_rules('matric', 'matric', 'trim|required');
		$this->form_validation->set_rules('course', 'course', 'trim|required');
		$this->form_validation->set_rules('semester', 'semester', 'trim|required');
		$this->form_validation->set_rules('assessment', 'assessment', 'trim|required');
		$this->form_validation->set_rules('exam_score', 'Exam Score', 'trim|required');
		$this->form_validation->set_rules('adjusted_mark', 'adjusted_mark', 'trim|required');
		$this->form_validation->set_rules('session', 'session', 'trim|required');
		$this->form_validation->set_rules('remark', 'remark', 'trim|required');
		$this->form_validation->set_rules('course_lecturer1', 'course lecturer1', 'trim|required');
		$this->form_validation->set_rules('chief_examiner', 'chief_examiner', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$data['main'] = "admin/results/add";
			$this->load->view('admin/layout/main', $data);
		} else {
			$data  = array(
				'matric' => $this->input->post('matric'),
				'course' => $this->input->post('course'),
				'course_code' => $this->course_model->get_course_code($this->input->post('course')),
				'semester'	 => $this->input->post('semester'),
				'semester_name' => $this->semester_model->get_semester_name($this->input->post('semester')),
				'assessment' => $this->input->post('assessment'),
				'exam_score' => $this->input->post('exam_score'),
				'adjusted_mark' => $this->input->post('adjusted_mark'),
				'session' => $this->input->post('session'),
				'session_name' => $this->academic_session_model->get_session_name($this->input->post('session')),
				'remark' => $this->input->post('remark'),
				'course_lecturer1' => $this->input->post('course_lecturer1'),
				'course_lecturer2' => $this->input->post('course_lecturer2'),
				'course_lecturer3' => $this->input->post('course_lecturer3'),
				'course_lecturer4' => $this->input->post('course_lecturer4'),
				'chief_examiner' => $this->input->post('chief_examiner')
				);

			//insert results
			$this->result_model->add_admin($data);
			$result = $this->course_model->get_course($this->input->post('course'));
			$data  = array(
				'resource_id' => $this->db->insert_id(),
				'type' => 'result',
				'action' => 'added',
				'user_id' => $this->session->userdata('user_id'),
				'message' => 'A new result  was added('. $result->code . ' for student - '.  $data['matric'] .')'
				);
			//Insert Activivty
			$this->activity_model->add($data);
			//Set Message
			$this->session->set_flashdata('success', 'Result has been added');
			redirect('admin/results','refresh');
		}
		
	}
	public function edit($id = 0)
	{
		if ($this->result_model->check_if_id_exists_admin($id) == NULL) {
			$data['main'] = 'admin/error';
			$this->load->view('admin/layout/main', $data);
		} else {
			$data['result'] = $this->result_model->get_result_admin($id);
			$data['courses'] = $this->course_model->get_courses();
			$data['semesters'] = $this->semester_model->get_semesters();
			$data['sessions'] = $this->academic_session_model->get_academic_sessions();
					//var_dump($data['results']);var_dump($data['groups']);die();
			$this->form_validation->set_rules('matric', 'matric', 'trim|required');
			$this->form_validation->set_rules('course', 'course', 'trim|required');
			$this->form_validation->set_rules('semester', 'semester', 'trim|required');
			$this->form_validation->set_rules('assessment', 'assessment', 'trim|required');
			$this->form_validation->set_rules('exam_score', 'exam_score', 'trim|required');
			$this->form_validation->set_rules('adjusted_mark', 'adjusted_mark', 'trim|required');
			$this->form_validation->set_rules('session', 'session', 'trim|required');
			$this->form_validation->set_rules('remark', 'remark', 'trim|required');
			$this->form_validation->set_rules('course_lecturer1', 'course lecturer1', 'trim|required');
			$this->form_validation->set_rules('chief_examiner', 'chief_examiner', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				//getcurrent subject
				$data['result'] = $this->result_model->get_result_admin($id);
				//var_dump($data['result']); die();
				$data['main'] = "admin/results/edit";
				$this->load->view('admin/layout/main', $data);
			} else {
				$data  = array(
					'matric' => $this->input->post('matric'),
					'course' => $this->input->post('course'),
					'course_code' => $this->course_model->get_course_code($this->input->post('course')),
					'semester'	 => $this->input->post('semester'),
					'semester_name' => $this->semester_model->get_semester_name($this->input->post('semester')),
					'assessment' => $this->input->post('assessment'),
					'exam_score' => $this->input->post('exam_score'),
					'adjusted_mark' => $this->input->post('adjusted_mark'),
					'session' => $this->input->post('session'),
					'session_name' => $this->academic_session_model->get_session_name($this->input->post('session')),
					'remark' => $this->input->post('remark'),
					'course_lecturer1' => $this->input->post('course_lecturer1'),
					'course_lecturer2' => $this->input->post('course_lecturer2'),
					'course_lecturer3' => $this->input->post('course_lecturer3'),
					'course_lecturer4' => $this->input->post('course_lecturer4'),
					'chief_examiner' => $this->input->post('chief_examiner')
					);

				//update result
				$this->result_model->update_admin($id, $data);
				$data  = array(
					'resource_id' => $id,
					'type' => 'result',
					'action' => 'updated',
					'user_id' => $this->session->userdata('user_id'),
					'message' => 'Result was updated',
					);
				//Insert Activivty
				$this->activity_model->add($data);
				//Set Message
				$this->session->set_flashdata('success', 'Result has been updated');
				redirect('admin/results','refresh');
			}
		}
	}
	public function detail($id)
	{
		if ($this->result_model->check_if_id_exists_admin($id) == NULL) {
			$data['main'] = 'admin/error';
			$this->load->view('admin/layout/main', $data);
		} else {
			//Load template
			$data['result'] = $this->result_model->get_result_admin($id);
			$data['main'] = "admin/results/detail";
			$this->load->view('admin/layout/main', $data);
		}
	}
	public function delete($id = 0)
	{
		if ($this->result_model->check_if_id_exists_admin($id) == NULL) {
			$data['main'] = 'admin/error';
			$this->load->view('admin/layout/main', $data);
		} else {
			//$name = $this->result_model->get_result();
			$this->result_model->delete_admin($id);
			$data  = array(
					'resource_id' => $id,
					'type' => 'result',
					'action' => 'Deleted',
					'user_id' => $this->session->userdata('user_id'),
					'message' => 'result was deleted',
					);
				//Insert Activivty
				$this->activity_model->add($data);
				//Set Message
				$this->session->set_flashdata('success', 'Result has been deleted');
				redirect('admin/results','refresh');
		}
	}
	public function search()
	{
		if (!isset($_POST['result'])){
			redirect('admin/results/index','refresh');
		}
		
		$data['results'] = null;
		$data['index'] = "All";
		$this->form_validation->set_rules('result', 'result', 'trim|required|differs[0]');
		// $this->form_validation->set_rules('search_param', 'Search parameter', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			// var_dump($data); die();
			$data['main'] = "admin/results/index";
			$this->load->view('admin/layout/main', $data);
		} else {
			$data  = array(
				'result' => $this->input->post('result'),
				'search_param' => $this->input->post('search_param')
				 );
			
			$data['count'] = $this->result_model->count_admin();
			//insert result
			$data['index'] = "All";
			$data['results'] = $this->result_model->search_admin($data['result'], $data['search_param']);
			$data['main'] = "admin/results/index";
			$this->load->view('admin/layout/main', $data);
			
		}
		
	}
	public function paginate()
	{
		if(isset($_POST['result'])){
		
			$this->form_validation->set_rules('result', 'result', 'trim|required');
			$data['index'] = "All";
			// $this->form_validation->set_rules('search_param', 'Search parameter', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['main'] = "admin/results/index";
				$this->load->view('admin/layout/main', $data);
			} else {
				$data  = array(
					'result' => $this->input->post('result')
					 );
				
				$data['count'] = $this->result_model->count_admin();	
				$data['index'] = $data['result'];
				$data['results'] = $this->result_model->paginate_admin($data['result']);
				$data['main'] = "admin/results/index";
				$this->load->view('admin/layout/main', $data);
				
			}
		} else {
			redirect('admin/results/index','refresh');
		}
	}
		
}