<?php 
class my404 extends CI_Controller 
{
    public function __construct() 
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
        $this->output->set_status_header('404'); 
        //$data['content'] = 'error_404'; // View name 
        $this->load->view('error_404');//loading in my template 
    } 
} 
   