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
		$request_message = "";
		$sms_text = "";
		
		//check if the response message/body is not empty
		if($request !=  null){

			//convert the json response message to an object
			$request_message = json_decode($request);

			//get the text property from the result object of the response message
			$sms_text = $request_message->results[0]->text;
			var_dump($sms_text);
		}
		
		$this->process_sms_request($sms_text);	
		
	}
	
	public function process_sms_request($sms_text)
	{
		$input_array = 	explode(",", $sms_text);
		$keyword = $input_array[0];
		$phonenumber = "55555";
		$system_number = "08178376272";
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
			$item = 'Matric'. ' : '.$item->matric . ' -  Score '.' : ' .$item->course_code. ' ('. $item->score . ')';
			return $item;
		} else {
			return "No result found";
		}
		
	}
	public function check_all_results($matric, $semester, $session)
	{
		
	$items = $this->sms_model->get_all_results($matric, $semester, $session);
	
	if ($items) {
		$matric = "";
		$results = "";
		foreach ($items as $item) {
			//var_dump($item); die();
				$matric = $item->matric;
				$results .= $item->course_code.'('. $item->score. ')'.', ';
		}
		return $matric. ' : ' .$results;
		} else {
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
		//var_dump($to. "====== ". $text); die();
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
							// 	var_dump($err)	; die();
				// 	return "error";
		// }
		echo $text;
		
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