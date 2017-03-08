<?php 
/**
* 
*/
class Activity_model extends CI_MODEL
{
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'activities';
	}

	public function get_activities_default()
	{
		$this->db->limit(100);
		$this->db->select('*');
		$this->db->from('sms_request_responses');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();		
		return $query->result();;
	}

	public function get_user_activities()
	{
		$this->db->select('*');
		$this->db->from('sms_request_responses');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();		
		return $query->result();;
	}

	public function add($data)
	{
		 $this->db->insert($this->table, $data);
	}

	public function count()
	{
		return $this->db->count_all('courses');
	}
	
}