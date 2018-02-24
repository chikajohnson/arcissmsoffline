<?php
/**
*  
*/
class Notification_model extends CI_MODEL
{	
	function __construct()
	{
		parent::__construct();
		$this->table = 'notifications';
	}

	public function get_notifications_unread($receiver)
	{
		$this->db->order_by("viewed", "asc");
		$this->db->where('receiver_email', $receiver);
		$this->db->where('viewed', false);		
		$query = $this->db->get($this->table);		
		return $query->result();
	}

	public function get_notifications_by_receiver($receiver)
	{
		$this->db->order_by("viewed", "asc");
		$this->db->where('receiver_email', $receiver);
		$query = $this->db->get($this->table);		
		return $query->result();
	}

	public function get_notifications_by_sender($sender)
	{
		$this->db->order_by("id", "asc");
		$this->db->where('sender', $sender);		
		$query = $this->db->get($this->table);
		return $query->result();
	}
	

	public function get_notification_by_id($id)
	{		
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function search($table_column,$parameter)
	{		
		$this->db->select('*');
		$this->db->like($table_column, $parameter);
		$this->db->from($this->table);
		$query = $this->db->get()->result();
		return $query;
	}
	public function paginate($limit )
	{
		
		$this->db->limit($limit);
		$query = $this->db->get($this->table);
		$result = $query->result();
		
		return $result;
	}

	public function count($receiver)
	{
		$this->db->where('receiver_email', $receiver);
		return $this->db->count_all_results($this->table);
	}

	public function count_viewed($receiver)
	{
		$this->db->where('receiver_email', $receiver);
		$this->db->where('viewed', false);
		return $this->db->count_all_results($this->table);
	}

	//update the notificaton table
	public function viewed($id, $data)
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
		$this->db->delete("notifications");
	}

	public function check_if_id_exists($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row(); 
	}

	
}