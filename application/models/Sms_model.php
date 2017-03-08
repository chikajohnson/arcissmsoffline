<?php
/**
*
*/
class Sms_model extends CI_MODEL
{
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'messages';
	}

	public function confirm_password_match($matric, $password)
	{
		
		$this->db->select('password');
		$this->db->from('students');
		$this->db->where('matric', $matric);
		$row = $this->db->get()->row();
		if($row && $this->db->count_all_results() == true){
			$retrieved_password = $row->password;
			if($retrieved_password == $password) {
				return true;
			} else {
				return false;
			}
		}		
	}	
	

	public function change_password($matric, $new_password)
	{  
		$this->db->set('password', $new_password);
		$this->db->where('matric', $matric);
		$this->db->update('students');
		return true;
	}

		
	public function get_single_result($matric, $course)
	{
		$this->db->select('r.matric, r.course_code, r.adjusted_mark as score, r.session_name as session' );
		$this->db->from('results as r');	
		$this->db->where('r.matric', $matric);
		$this->db->where('r.course_code', $course);
		$query = $this->db->get()->row();
		return $query;
	}

	public function get_all_results($matric, $semester, $session)
	{

		$this->db->select('r.matric, r.course_code, r.adjusted_mark as score, r.session_name as session');
		$this->db->from('results as r');
		$this->db->where('r.matric', trim($matric));
		$this->db->where('r.semester_name', strtolower(trim($semester)));
		$this->db->where('r.session_name', trim($session));
		$query = $this->db->get();
		return $query->result();

		
	}	

	public function matric_exist($matric)
	{
		$this->db->select('matric');
		$this->db->from('students');
		$this->db->where('matric', $matric);

		$result =  $this->db->count_all_results();
		if ($result >=  1) {
			return True;
		} else {
			return false;
		}
	}

	public function course_exist($code)
	{
		$this->db->select('course_code');
		$this->db->from('results');
		$this->db->where('course_code', $code);

		$result =  $this->db->count_all_results();
		if ($result >=  1) {
			return True;
		} else {
			return false;
		}
	}
	
	public function add($data)
	{
		$this->db->insert('sms_request_responses', $data);
	}

	public function search($table_column,$parameter)
	{
		$this->db->select('*' );
		$this->db->from("sms_request_responses");
		$this->db->like($table_column, $parameter);
		$query = $this->db->get()->result();
		return $query;
	}
	public function paginate($limit )
	{
		$this->db->limit($limit);
		$this->db->select('*' );
		$this->db->from("sms_request_responses");
		$this->db->order_by('id', 'desc');
		$query = $this->db->get()->result();
				
		return $query;
	}

	public function count()
	{
		return $this->db->count_all("sms_request_responses");
	}

		
}