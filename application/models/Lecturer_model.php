<?php
/**
*
*/
class Lecturer_model extends CI_MODEL
{
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'lecturers';
	}
	public function get_lecturers()
	{
		$this->db->select('*' );
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_lecturer($id)
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
	public function add($data)
	{
		$this->db->insert($this->table, $data);
	}

	public function delete($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	public function remove_allocation($course_id, $lecturer_id)
	{
		$this->db->select('*');
		$this->db->from('course_allocations');
		$this->db->where('course_id', $course_id);
		$this->db->where('lecturer_id', $lecturer_id);
		$this->db->delete("course_allocations");
	}

	public function allocate($data)
	{
		$this->db->insert("course_allocations", $data);
	}
	public function get_course_allocation_list($id)
	{		
		$this->db->select('*');
		$this->db->from("course_allocations");
		$this->db->where('course_id', $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function check_if_allocated($course_id, $lecturer_id)
	{
		$this->db->select('*');
		$this->db->from('course_allocations');
		$this->db->where('course_id', $course_id);
		$this->db->where('lecturer_id', $lecturer_id);
		$result =  $this->db->count_all_results();
		if ($result >= 1) {
			return True;
		} else {
			return false;
		}
		
	}

	public function get_user_name($email)
	{
		$this->db->select('title, last_name, first_name');
		$this->db->from($this->table);
		$this->db->where('email', $email);

		$query = $this->db->get()->row();

		return trim($query->title. '.'  . ' ' . $query->last_name . " " . $query->first_name );
				
	}

	public function check_if_id_exists($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row(); 
	}

	public function check_if_groupcode_exists($code)
	{
		$this->db->select('*');
		$this->db->from('lecturer_results');
		$this->db->where('group_code', $code);
		$query = $this->db->get();
		return $query->row(); 
	}




	
}

