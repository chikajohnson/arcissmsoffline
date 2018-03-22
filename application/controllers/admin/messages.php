<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Messages extends CI_Controller {
	
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
		$data['messages'] = $this->message_model->get_messages();
		$data['main'] = "admin/messages/index";
		$this->load->view('admin/layout/main', $data);
	}
	public function add()
	{
		// var_dump($this->session->userdata('user_id')); die();
		$data['message_types'] = $this->message_type_model->get_message_types();
		$data['sessions'] = $this->academic_session_model->get_academic_sessions();
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('message_type', 'Message type',  'trim|required|greater_than[0]');
		$this->form_validation->set_message('greater_than', 'Please select %s.');
		if ($this->form_validation->run() == FALSE) {
			$data['main'] = "admin/messages/add";
			$this->load->view('admin/layout/main', $data);
		} else {
			$data  = array(
				'title' => $this->input->post('title'),
				'message' => $this->input->post('message'),
				'message_type' => $this->input->post('message_type'),
				'sent'		 => 0,
				'admin' => $this->session->userdata('user_id')
				// 'sent_time'=> $this->input->post('admin')
				);
			//insert message
			$this->message_model->add($data);

			$data  = array(
				'resource_id' => $this->db->insert_id(),
				'type' => 'message',
				'action' => 'added',
				'user_id' => $this->session->userdata('user_id'),
				'message' => 'A new message  was added by '. $this->session->userdata('user_id'),
				);
			//Insert Activivty
			$this->activity_model->add($data);
			
			//Set Message
			$this->session->set_flashdata('success', 'Message has been added');
			redirect('admin/messages','refresh');
		}
		
	}
	public function edit($id = 0)
	{
		if ($this->message_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'admin/error';
			$this->load->view('admin/layout/main', $data);
		} else {
			$data['message_types'] = $this->message_type_model->get_message_types();
			$data['sessions'] = $this->academic_session_model->get_academic_sessions();
			$this->form_validation->set_rules('message_type', 'Message type', 'trim|required');
			$this->form_validation->set_rules('message', 'Message', 'trim|required');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('message_type', 'Message type',  'trim|required|greater_than[0]');
			$this->form_validation->set_message('greater_than', 'Please select %s.');
			$data['message'] = $this->message_model->get_message($id);
			if ($this->form_validation->run() == FALSE) {
				//getcurrent subject
				
				$data['main'] = "admin/messages/edit";
				$this->load->view('admin/layout/main', $data);
			} else {
				$data  = array(
					'title' => $this->input->post('title'),
					'message' => $this->input->post('message'),
						'message_type'	=> $this->input->post('message_type')
					// 'sent_time'=> $this->input->post('admin')
				);
				//update message
				$this->message_model->update($id, $data);
				$data  = array(
					'resource_id' => $id,
					'type' => 'message',
					'action' => 'updated',
					'user_id' => $this->session->userdata('user_id'),
					'message' => 'message was updated',
					);
				//Insert Activivty
				$this->activity_model->add($data);
				//Set Message
				$this->session->set_flashdata('success', 'Message has been updated');
				redirect('admin/messages','refresh');
			}
		}
	}
	public function detail($id = 0)
	{
		if ($this->message_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'admin/error';
			$this->load->view('admin/layout/main', $data);
		} else {
			//Load template
		$data['message'] = $this->message_model->get_message($id);
		$data['main'] = "admin/messages/detail";
		$this->load->view('admin/layout/main', $data);
		}
	}
	public function delete($id = 0)
	{
		if ($this->message_model->check_if_id_exists($id) == NULL) {
			$this->load->view('admin/error');
		} else {
			//$name = $this->message_model->get_message();
			$this->message_model->delete($id);
			$data  = array(
					'resource_id' => $id,
					'type' => 'message',
					'action' => 'Deleted',
					'user_id' => $this->session->userdata('user_id'),
					'message' => 'message was deleted',
					);
				//Insert Activivty
				$this->activity_model->add($data);
				//Set Message
				$this->session->set_flashdata('success', 'Message has been deleted');
				redirect('admin/messages','refresh');
		}
	}
	public function send($id = 0)
	{
		if ($this->message_model->check_if_id_exists($id) == NULL) {
			$data['main'] = 'admin/error';
			$this->load->view('admin/layout/main', $data);
		} else {
			//Load template
			$data['message_types'] = $this->message_type_model->get_message_types();
			$data['message'] = $this->message_model->get_message($id);
			$data['sessions'] = $this->academic_session_model->get_academic_sessions();
			$data['courses'] = $this->course_model->get_courses();
			// var_dump($data['courses']); die();
			
			$title = $this->input->post('title');
			$message = $this->input->post('message');
			$message_radio = $this->input->post('message_radio');
			$academic_session =  $this->input->post('academic_session');
			$phonenumbers =  $this->input->post('phonenumbers');
			$course =  $this->input->post('course');
					
			$message_radio = $this->input->post('message_radio');
			if ($_SERVER["REQUEST_METHOD"] == "GET") {
				$data['main'] = "admin/messages/send";
				$this->load->view('admin/layout/main', $data);
			} 
			elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
			
				if ($message_radio == "all") {
					$this->form_validation->set_rules('academic_session', 'Academic session', 'trim|required|greater_than[0]');	
					$this->form_validation->set_message('greater_than', 'Please select %s of recipients.');
					$this->form_validation->set_rules('course', 'Course', 'trim|required|greater_than[0]');	
					// $this->form_validation->set_message('greater_than', 'Please select Course.');	
	
					if ($this->form_validation->run() == FALSE) {
						$data['main'] = "admin/messages/send";
						$this->load->view('admin/layout/main', $data);
					} else{
						$numbers = $this->core_model->get_phonenumbers($academic_session, $course);
						
						if(count($numbers) <= 0){
							$this->session->set_flashdata('error', 'No student registered for <b>'. $this->course_model->get_course($course)->code. ' - '. $this->course_model->get_course($course)->title.'</b> in the <b>' .  $this->academic_session_model->get_academic_session($academic_session)->name.   '</b> session.');
							redirect('admin/messages/send/'.$id,'refresh');
							
						}
						
						$message_count = 0;
						foreach ($numbers as $number) {

							if(!is_null($number)){
								$response =  $this->send_message($number, $message);								
								if ($response != 101){
									$this->session->set_flashdata('err_response', ' An Error occured while sending the message');
									redirect('admin/messages','refresh');
								}								
								$message_count++;
							}				
						}


					//update sent status
					$update_sms  = array(
					'sent' => 1
					);
					//update message
					$this->message_model->update($id, $update_sms);

					//Set user activity data
					$data  = array(
						'resource_id' => $id,
						'type' => 'message',
						'action' => 'updated',
						'user_id' => $this->session->userdata('user_id'),
						'message' => $message_count . ' message(s) were sent',
					);
					//Insert user Activivty
					$this->activity_model->add($data);
						$this->session->set_flashdata('success', $message_count . ' messages has been sent');
						redirect('admin/messages','refresh');
					}
			}
			elseif ($message_radio == "custom") {
						//var_dump($phonenumbers); die();
					
					$this->form_validation->set_rules('phonenumbers', 'Phonenumber', 'trim|required');	
					
					if ($this->form_validation->run() == FALSE) {
						
						$data['main'] = "admin/messages/send";
						$this->load->view('admin/layout/main', $data);
					} else{
						$numbers = explode(",", $phonenumbers);
						
						$message_count = 0;
						foreach ($numbers as $number) {
							if(!is_null(trim($number))){
								$response =  $this->send_message($number, $message);
								if ($response != 101){
									$this->session->set_flashdata('err_response', ' An Error occured while sending the message');
									redirect('admin/messages','refresh');
								}
								$message_count++;
							}				
						}

					//update sent status
					$update_sms  = array(
					'sent' => 1
					);
					//update message
					$this->message_model->update($id, $update_sms);
					//Set user activity data
					$data  = array(
						'resource_id' => $id,
						'type' => 'message',
						'action' => 'updated',
						'user_id' => $this->session->userdata('user_id'),
						'message' => $message_count . ' message(s) were sent',
					);
					//Insert user Activivty
					$this->activity_model->add($data);
						$this->session->set_flashdata('success', $message_count . ' messages has been sent');
						redirect('admin/messages','refresh');
					}					
				}
			}
		}
		
	}
	
	public function send_message($to, $text)
	{	
		$curl = curl_init();

		//cloudsms setup information
		 $userid =11984581;
		 $password = 'chikodili';
		 $type =  0;
		 $destination   = urlencode($to);
		 $sender      = "ARCISSMS";
		 $message = urlencode($text);
		  
		
		curl_setopt_array($curl, array(
		CURLOPT_URL =>  "http://developers.cloudsms.com.ng/api.php?userid=$userid&password=$password&type=$type&destination=$destination&sender=$sender&message=$message",
		
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",		
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;


		// //var_dump($to. "====== ". $text); die();
		// $curl = curl_init();
		// $header = array("Content-Type:application/json", "Accept:application/json", "authorization: Basic VGFyYkluYzpUZXN0MTIzNA==");
		// $postUrl = "https://api.infobip.com/sms/1/text/single";
		// $from = "ARCISSMS";
		// $post_fields = "{ \"from\":\"$from \", \"to\":[ \"$to\"], \"text\":\"$text\" }";
		// curl_setopt($curl, CURLOPT_URL, $postUrl);
		// curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		// curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
		// curl_setopt($curl, CURLOPT_MAXREDIRS, 2);
		// curl_setopt($curl, CURLOPT_POST, 1);
		// curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
		// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		// $response = curl_exec($curl);
		// $err = curl_error($curl);
		// curl_close($curl);
		// if ($err) {	
		// 	return "error";
		// } 
		
	}
}