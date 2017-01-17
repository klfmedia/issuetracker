<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GlobalMethods {
	
	protected $CI;
	
	public function __construct(){
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		$this->CI->load->model("Employee");
	
	}

	public function randomQuote()
	{
		$ref= mt_rand(1,25);
		$this->CI->load->model("Employee");	
		$staff=new Employee();
		$result= $staff->getQuote($ref);
		$data["my_quote"] = $result["quote"];
		$data["author"] = $result["author"];
		return $data;
	}
	
//display background and greeting message
	public function greetings()
	{
		date_default_timezone_set('America/New_York');
		$hrs = date('G');
		$top_background = 'morning4.jpg';
		$msg = "Mornin' Sunshine!";
		if ($hrs >=  6) { $msg = "Good morning";   }  // After 6am
		if ($hrs >= 12) { $msg = "Good afternoon"; }   // After 12pm
		if ($hrs >= 16) { $msg = "Good evening";   }   // After 5pm
		if ($hrs >= 22) { $msg = "Go to bed!";     }   // After 10pm
		$data["top_background"]=$top_background;
		$data["greeting"]=$msg;
		return $data;
	}
	
}