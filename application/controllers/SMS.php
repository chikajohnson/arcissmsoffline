<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SMS extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
	}
	
	public function index()
	{
		$request = array_merge($_GET, $_POST);
		
		$time_received = $request['time_received'];
		$text_message = $request['message'];
		$sender= str_replace('+', '', urlencode($request['from']));
		$system_number = $request['me'];

		
		if($request['message'] !=  null && $request['message'] !=  ""){
			$this->process_sms_request($text_message, $sender, $system_number);
		}else{
			$error_message = "SMS text is empty.";
			$this->send_message($sender, $error_message);
		}
	}
	
	public function process_sms_request($sms_text, $phonenumber, $system_number)
	{
		//phonenumber is the student's phonenumber
		//system number is the phonenumber registered with CloudSMS 
		$input_array = 	explode(",", $sms_text);
		$keyword = $input_array[0];

		switch (strtolower(trim($keyword))){
			case 'result':
				if (count($input_array) == 5) {
					
					$matric = trim($input_array[1]);
					$password = trim($input_array[2]);
					$semester = strtolower(trim($input_array[3]));
					$session = strtolower(trim($input_array[4]));

					if($this->confirm_password($matric, $password) == true && $this->matric_exist($matric)){
						$all_results = $this->check_all_results($matric, $semester, $session);
						$this->send_message($phonenumber, $all_results);
						$this->record_User_activity($keyword, $input_array, $sms_text, $phonenumber, $status="sent");
						return;
					}
					else{
						$error_messaage = "An error has occured. Check message format/content and send again ==== Error 1.";
						$this->send_message($phonenumber, $error_messaage);
						return;
					}
				} else if (count($input_array) == 4) {
					$matric = trim($input_array[1]);
					$password = trim($input_array[2]);
					$course_code = strtolower(trim($input_array[3]));
					if($this->confirm_password($matric, $password) == true && $this->matric_exist($matric) && $this->course_exist($course_code)){
						$single_result = $this->check_single_result($matric, $course_code);
						$this->send_message($phonenumber, $single_result);
						$this->record_User_activity($keyword, $input_array, $sms_text, $phonenumber, $status="sent");
						return;
					}
					else{
						$error_messaage = "An error has occured. Check message format/content and send again.";
						$this->send_message($phonenumber, $error_messaage);
						$this->record_User_activity($keyword, $input_array, $sms_text, $phonenumber, $status="No response Sent");
						return;
						}
				}
				else{
					$error_messaage = "An error has occured. Check message format and send again  ==== Error 3.";
					$this->send_message($phonenumber, $error_messaage);
					$this->record_User_activity($keyword, $input_array, $sms_text, $phonenumber, $status="No response Sent");
					return;
				}
				
				break;
			case 'password':
				if (count($input_array) == 4) {
					$matric = trim($input_array[1]);
					$old_password = trim($input_array[2]);
					$new_password = trim($input_array[3]);
					$password_changed = "Password change successfully";
					
					if($this->confirm_password($matric, $old_password) == true && is_numeric($new_password)){
						if ((strlen($new_password) <= 6) && (strlen($new_password) >= 4)) {
							
							$this->change_user_password($matric, $new_password);
							$this->send_message($phonenumber, $password_changed);
							$this->record_User_activity($keyword, $input_array, $sms_text, $phonenumber, $status="sent");
							return;							

						} else {
							$error_messaage = "Error: Password length must be between 4 and 6 digits.";
							$this->send_message($phonenumber, $error_messaage);							
						}						
						
					}
					else{
						$error_messaage = "password do not match or message not in correct format.";
						$this->send_message($phonenumber, $error_messaage);
						$this->record_User_activity($keyword, $input_array, $sms_text, $phonenumber, $status="No response Sent");
						return;
					}
				}
				else{
					$error_messaage = "An error occured . Check message format and send again.";
					$this->send_message($phonenumber, $error_messaage);
					$this->record_User_activity($keyword, $input_array, $sms_text, $phonenumber, $status="No response Sent");
					return;
				}
				break;
			case 'help':
				$matric = $input_array[1];
				if (count($input_array) == 3) {
					
					if ($this->matric_exist($matric) && strtolower(trim($input_array[2])) == 'result') {
						$message = "Send text in this format - 'result,matric,password,coursecode' to ". $system_number. ' to view the result of a single course.';
						$this->send_message($phonenumber, $message);
						$this->record_User_activity($keyword, $input_array, $sms_text, $phonenumber, $status="sent");
						return;
					}
						else if ($this->matric_exist($matric) && strtolower(trim($input_array[2])) == 'results') {
						$message = "Send text in this format - 'result,matric,password,semester,session' to ". $system_number. ' to view the result of all your courses in a semester';
						$this->send_message($phonenumber, $message);
						$this->record_User_activity($keyword, $input_array, $sms_text, $phonenumber, $status="sent");
						return;
					}
					else if ($this->matric_exist($matric) &&strtolower(trim( $input_array[2])) == 'password') {
										
						$message = "Send text in this format - 'result,matric,old-password,new-password' to ". $system_number. ' to change your password.';
						$this->send_message($phonenumber, $message);
						$this->record_User_activity($keyword, $input_array, $sms_text, $phonenumber, $status="sent");
							return;
					} else {
						$error_message = "An error occured. Check message format and send again.";
						$this->send_message($phonenumber, $error_message);
						$this->record_User_activity($keyword, $input_array, $sms_text, $phonenumber, $status="No response Sent");
						return;
					}
				}
				break;
			default:
				$error_messaage = "Message is not in correct format.";
				$this->send_message($phonenumber, $error_messaage);
				break;
			}
		
	}
	
	
	public function confirm_password($matric, $password)
	{
		return $this->sms_model->confirm_password_match($matric, $password);
	}
	public function change_user_password($matric, $new_password)
	{
		return $this->sms_model->change_password($matric, $new_password);
	}
	
	public function check_single_result($matric, $course)
	{
		$item = $this->sms_model->get_single_result($matric, $course);
		if ($item) {
			$item = 'Matric'. ": ".$item->matric . ",  Course: ". $item->course_fullname. ",  Score: ". $item->score;
			
			return $item;
		} else {
			return "No result found";
		}
		
	}
	public function check_all_results($matric, $semester, $session)
	{
		
		$items = $this->sms_model->get_all_results($matric, $semester, $session);

		if($items){
			$matric = "";
			$results = "";
			foreach ($items as $item) {
				//var_dump($item); die();
				$matric = $item->matric. '('. $item->session. ' Session - '. $item->semester. ' semester)';
				$results .= $item->course_code.'('. $item->score. ')'.', ';
			}
				return $matric . ' : ' . $results;
			} 
			else
			{
				return "No result found.";
			}
	
	}
	public function matric_exist($matric)
	{
		return $this->sms_model->matric_exist($matric);
	}
	public function course_exist($code)
	{
		return $this->sms_model->course_exist($code);
	}
	public function send_message($to, $text)
	{
		$curl = curl_init();

		//cloudsms setup information
		 $userid =11984581;
		 $password = 1234567890;
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


		
		
	}
	public function record_User_activity($keyword, $input_array, $sms_text="NA", $phonenumber=00000, $status)
	{
		
		$data  = array(
			'sms_type' => $keyword,
			'matric' => $input_array[1],
			'sms_message' => $sms_text,
			'phonenumber' =>$phonenumber,
			'status' => $status
			);

		//Insert Activivty
		$this->sms_model->add($data);
	}
}