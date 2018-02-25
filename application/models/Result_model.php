<?php
/**
* Results model
*/
class Result_model extends CI_MODEL
{
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'lecturer_results';
		
	}

	// Results moddel for the admin

	public function get_results_admin($index)
	{
		$this->db->select('r.* , c.code as code,  c.title as course, se.name as semester, session.name as session' );
		$this->db->limit($index);		
		$this->db->from('results as r');
		$this->db->join('courses as c', 'r.course = c.id', 'left');
		$this->db->join('semesters as se', 'r.semester = se.id', 'left');
		$this->db->join('academicsessions as session', 'r.session = session.id', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_result_admin($id)
	{
		$this->db->select('r.* , c.code as code,  c.title as course,c.id as course_id,  se.title as semester, se.id as semester_id, session.name as session,session.id as session_id, s.last_name as last_name, s.first_name as first_name, s.other_names as other_names, p.name as program' );
		$this->db->from('results as r');
		$this->db->join('courses as c', 'r.course = c.id', 'left');
		$this->db->join('semesters as se', 'r.semester = se.id', 'left');
		$this->db->join('academicsessions as session', 'r.session = session.id', 'left');
		$this->db->join('students as s', 'r.matric = s.matric', 'left');
		$this->db->join('programs as p', 'p.id = s.program', 'left');
		$this->db->where('r.id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function search_admin($table_column,$parameter)
	{
		
		$this->db->select('r.* , c.code as code,  c.title as course, se.name as semester, session.name as session' );
		$this->db->from('results as r');
		$this->db->join('courses as c', 'r.course = c.id', 'left');
		$this->db->join('semesters as se', 'r.semester = se.id', 'left');
		$this->db->join('academicsessions as session', 'r.session = session.id', 'left');
		$this->db->order_by('r.approved', 'asc');
		$this->db->like($table_column, $parameter);
		$query = $this->db->get()->result();
		return $query;
	}
	public function paginate_admin($limit )
	{
		$this->db->limit($limit);
		$this->db->select('r.* , c.code as code,  c.title as course, se.name as semester, session.name as session' );
		$this->db->from('results as r');
		$this->db->join('courses as c', 'r.course = c.id', 'left');
		$this->db->join('semesters as se', 'r.semester = se.id', 'left');
		$this->db->join('academicsessions as session', 'r.session = session.id', 'left');
		$this->db->order_by('r.approved', 'asc');
		$query = $this->db->get();
		$result = $query->result();
		
		return $result;
	}
	public function count_admin()
	{
		return $this->db->count_all("results");
	}
	public function check_if_id_exists_admin($id)
	{
		$this->db->select('*');
		$this->db->from("results");
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row(); 
	}
	
	public function update_admin($id, $data)
	{
			
		$this->db->where('id', $id);
		$this->db->update("results", $data);
	}
	public function add_admin($data)
	{
		$this->db->insert('results', $data);
	}
	public function delete_admin($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$this->db->delete("results");
	}
	public function temp_insert_batch_CSV_admin($data)
	{
		
		$this->db->insert_batch('temp_results', $data);
		return $this->db->insert_id();
	}
	public function add_batch_admin($data)
	{
		$this->db->insert_batch('results', $data);
	}
	public function get_last_inserted_results_admin($batch_upload_code)
	{
		$this->db->select('r.* , c.code as code,  c.title as course, se.name as semester, session.name as session' );
		$this->db->from('temp_results as r');
		$this->db->join('courses as c', 'r.course = c.id', 'left');
		$this->db->join('semesters as se', 'r.semester = se.id', 'left');
		$this->db->join('academicsessions as session', 'r.session = session.id', 'left');
		$this->db->where('r.batch_upload_code', $batch_upload_code);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_last_inserted_tempresults_admin($batch_upload_code)
	{
		$this->db->select('*' );
		$this->db->from('temp_results as r');
		$this->db->where('r.batch_upload_code', $batch_upload_code);
		$query = $this->db->get();
		return $query->result();
	}
	public function delete_last_inserted_tempresults_admin($batch_upload_code)
	{
		$this->db->select('*' );
		$this->db->from('temp_results');
		$this->db->where('batch_upload_code', $batch_upload_code);
		$this->db->delete('temp_results');
	}
	public function count_last_inserted_tempresults_admin($batch_upload_code)
	{
		$this->db->count_all_results('temp_results');
		$this->db->where('batch_upload_code', $batch_upload_code);
		return $this->db->count_all_results('temp_results');
	}
	public function count_last_inserted_results_admin($batch_upload_code)
	{
		$this->db->count_all_results('results');
		$this->db->where('batch_upload_code', $batch_upload_code);
		return $this->db->count_all_results('results');
	}

	//Results for the admin

	public function get_results($index)
	{
		$this->db->select('r.* , c.code as code,  c.title as course, se.name as semester, session.name as session' );
				$this->db->limit($index);
		$this->db->from('lecturer_results as r');
		$this->db->join('courses as c', 'r.course = c.id', 'left');
		$this->db->join('semesters as se', 'r.semester = se.id', 'left');
		$this->db->join('academicsessions as session', 'r.session = session.id', 'left');
		$this->db->where('r.lecturer_email', $this->session->userdata('user_name'));
		$this->db->order_by('r.approved', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_result($id)
	{
		$this->db->select('r.* , c.code as code,  c.title as course,c.id as course_id,  se.title as semester, se.id as semester_id, session.name as session,session.id as session_id, s.last_name as last_name, s.first_name as first_name, s.other_names as other_names, p.name as program' );
		$this->db->from('lecturer_results as r');
		$this->db->join('courses as c', 'r.course = c.id', 'left');
		$this->db->join('semesters as se', 'r.semester = se.id', 'left');
		$this->db->join('academicsessions as session', 'r.session = session.id', 'left');
		$this->db->join('students as s', 'r.matric = s.matric', 'left');
		$this->db->join('programs as p', 'p.id = s.program', 'left');
		$this->db->where('r.id', $id);
		$this->db->where('r.lecturer_email', $this->session->userdata('user_name'));
		$query = $this->db->get();
		return $query->row();
	}
	public function search($table_column,$parameter)
	{
		
		$this->db->select('r.* , c.code as code,  c.title as course, se.name as semester, session.name as session' );
		$this->db->from('lecturer_results as r');
		$this->db->join('courses as c', 'r.course = c.id', 'left');
		$this->db->join('semesters as se', 'r.semester = se.id', 'left');
		$this->db->join('academicsessions as session', 'r.session = session.id', 'left');
		$this->db->like($table_column, $parameter);
		$this->db->where('r.lecturer_email', $this->session->userdata('user_name'));
		$this->db->order_by('r.approved', 'asc');
		$query = $this->db->get()->result();
		return $query;
	}
	public function paginate($limit )
	{
		$this->db->limit($limit);
		$this->db->select('r.* , c.code as code,  c.title as course, se.name as semester, session.name as session' );
		$this->db->from('lecturer_results as r');
		$this->db->join('courses as c', 'r.course = c.id', 'left');
		$this->db->join('semesters as se', 'r.semester = se.id', 'left');
		$this->db->join('academicsessions as session', 'r.session = session.id', 'left');
		$this->db->where('r.lecturer_email', $this->session->userdata('user_name'));
		$this->db->order_by('r.approved', 'asc');
		$query = $this->db->get();
		$result = $query->result();
		
		return $result;
	}
	public function count()
	{
		$this->db->where('lecturer_email', $this->session->userdata('user_name'));
		$result = $this->db->get('lecturer_results');
		return $result->num_rows();
	}
	public function check_if_id_exists($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update($id, $data)
	{
			
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}
	public function update_count($data_count, $group_code){
		$this->db->where('group_code', $group_code);
		$this->db->update($this->table, $data_count);
	}

	
	public function add($data)
	{
		$this->db->insert('lecturer_results', $data);
	}
	public function add_group_data($group_data)
	{
		$this->db->insert('result_groups', $group_data);
	}
	public function delete($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	public function temp_insert_batch_CSV($data)
	{
		
		$this->db->insert_batch('temp_results', $data);
		return $this->db->insert_id();
	}
	public function add_batch($data)
	{
		
		$this->db->insert_batch('lecturer_results', $data);
	}
	
	public function get_last_inserted_results($batch_upload_code)
	{
		$this->db->select('r.* , c.code as code,  c.title as course, se.name as semester, session.name as session' );
		$this->db->from('temp_results as r');
		$this->db->join('courses as c', 'r.course = c.id', 'left');
		$this->db->join('semesters as se', 'r.semester = se.id', 'left');
		$this->db->join('academicsessions as session', 'r.session = session.id', 'left');
		$this->db->where('r.batch_upload_code', $batch_upload_code);
		$this->db->where('r.lecturer_email', $this->session->userdata('user_name'));
		$query = $this->db->get();
		return $query->result();
	}
	public function get_last_inserted_tempresults($batch_upload_code)
	{
		
		$this->db->select('*' );
		$this->db->from('temp_results as r');
		$this->db->where('r.batch_upload_code', $batch_upload_code);
		$query = $this->db->get();
		return $query->result();
	}
	public function delete_last_inserted_tempresults($batch_upload_code)
	{
		$this->db->select('*' );
		$this->db->from('temp_results');
		$this->db->where('batch_upload_code', $batch_upload_code);
		$this->db->where('lecturer_email', $this->session->userdata('user_name'));
		$this->db->delete('temp_results');
	}
	public function count_last_inserted_tempresults($batch_upload_code)
	{
		$this->db->count_all_results('temp_results');
		$this->db->where('batch_upload_code', $batch_upload_code);
		$this->db->where('lecturer_email', $this->session->userdata('user_name'));
		return $this->db->count_all_results('temp_results');
	}
	public function count_last_inserted_results($batch_upload_code)
	{
		$this->db->count_all_results('results');
		$this->db->where('batch_upload_code', $batch_upload_code);
		$this->db->where('lecturer_email', $this->session->userdata('user_name'));
		return $this->db->count_all_results('lecturer_results');
	}

	public function check_if_result_exists($matric, $course)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('matric', $matric);
		$this->db->where('course', $course);
		$result = $this->db->get()->num_rows();
		if ($result > 0) {
			return true;
		} else {
			return false;
		}		
	}

	public function get_submitted_results()
	{
		$this->db->select('*');
		$this->db->from("result_groups");
		$this->db->order_by('approved', 'asc');
		$query = $this->db->get();
		$results = $query->result();
		return $results;
	}
	public function approve_results($data, $group_code)
	{
		$this->db->trans_start();
		//approve in the lecturers table
		
		$this->db->where('group_code', $group_code);
		$this->db->update($this->table, $data);

		//approve in the result_group table
		$this->db->where('group_code', $group_code);
		$this->db->update("result_groups", $data);


		//copy to results table
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('group_code', $group_code);
		$query = $this->db->get();
		$batch_result =  $query->result_array();

		$this->db->insert_batch('results', $batch_result);

		//delete all results from lecturer_results and result_group
		// $this->db->select('*');
		// $this->db->from('lecturer_results');
		// $this->db->where('group_code', $group_code);
		// $this->db->delete('lecturer_results');


		// $this->db->select('*');
		// $this->db->from('result_groups');
		// $this->db->where('group_code', $group_code);
		// $this->db->delete('result_groups');

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		}
		$this->db->trans_complete();
	}

	public function check_approved()
	 {
	 	$this->db->select("*");
		$this->db->from('result_groups');
		$this->db->where('approved', false);
		$result = $this->db->get()->num_rows();
		if ($result == 0) {
			return true;
		} else {
			return false;
		}
		
		
	 } 
	public function get_group_results($group_code){
		$this->db->select('r.* , c.code as code,  c.title as course, se.name as semester, session.name as session' );
		$this->db->from('lecturer_results as r');
		$this->db->join('courses as c', 'r.course = c.id', 'left');
		$this->db->join('semesters as se', 'r.semester = se.id', 'left');
		$this->db->join('academicsessions as session', 'r.session = session.id', 'left');
		$this->db->where('r.group_code', $group_code);
		$query = $this->db->get();
		
		return $query->result();
	}

	public function get_results_detail($group_code)
	{
		$this->db->select('*' );
		$this->db->from('lecturer_results');
		$this->db->where('group_code', $group_code);
		$query = $this->db->get()->row();
		return $query;
	}

	public function get_results_by_group_code($group_code)
	{
		$this->db->select("*");
		$this->db->from('lecturer_results');
		$this->db->where('group_code', $group_code);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_group_code($id)
	{		
		$this->db->select("*");
		$this->db->from('lecturer_results');
		$this->db->where('id', $id);
		$code = $this->db->get()->row()->group_code;
		
		return $code;
	}

	public function update_count_after_delete($code){


		
		$this->db->count_all_results('lecturer_results');
		$this->db->where('group_code', $code);
		$count =  $this->db->count_all_results('lecturer_results');


		if ($count == 0) {
			$this->db->select('*');
			$this->db->from('result_groups');
			$this->db->where('group_code', $code);
			$this->db->delete("result_groups");

		} 

		$this->db->set('group_count', $count);
		$this->db->where('group_code', $code);
		$this->db->update("lecturer_results");

		$this->db->set('group_count', $count);
		$this->db->where('group_code', $code);
		$this->db->update("result_groups");			
		
	}	

	public function count_uploaded_result($lecturer)
	{
		$this->db->where('lecturer_email', $lecturer);
		return $this->db->count_all_results($this->table);
	}

	public function count_approved_result()
	{
		$this->db->where('approved', false);
		return $this->db->count_all_results('result_groups');
	}
}