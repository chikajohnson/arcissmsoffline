<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
			//echo "You are here sir"; die();
		
	} 

	public function test()
	{
		//echo "You are here sir";

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.infobip.com/sms/1/inbox/reports",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 300,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_HTTPHEADER => array(
		    "accept: application/json",
		    "authorization: Basic VGFyYkluYzpUZXN0MTIzNA=="
		  ),
		));

		$response = curl_exec($curl);
		//var_dump($response); 
		if($response == null || $response == ""){
			//{"results":[],"messageCount":0,"pendingMessageCount":0}

			$results = $response["results"];
			if($results == "" || $results == null){
				echo "I have no result for you";
			}
		}
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
	}
}