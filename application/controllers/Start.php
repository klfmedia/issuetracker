<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Start extends CI_Controller {

//View on entering website, loads login page for access as well as header and footer
	public function index()
	{
		$this->load->view("login");		
	}

	//function to login
	public function login()
	{
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$user =$_POST['username'];
			$passwd = $_POST['password'];
			$this->load->model('Employee');
			$result = $this->Employee->login($user,$passwd);	
		}	
		if ($result=="") {
			$data["message"]= "Access denied!<br/> Password or username incorrect";
			$this->load->view("login",$data);
		}
		else {
			$this->load->library("globalmethods");
			$data=$this->globalmethods->greetings();
			$this->load->model('Issue');
			$issues= $this->Issue->getIssues();
			if(!isset($_SESSION)){
				session_start();
			}	
			$_SESSION["userid"] = $result->employee_id;
			$_SESSION["user"] = $result->employee_type;
			$_SESSION["views"]="listView";
			$_SESSION["issues"]="all";
			$data['name'] = $result->first_name;
			$data['photo'] = $result->photo;
			$data['issues'] = $issues;
			$data["login"] = "logged";
			$this->load->view("header",$data);
			if ($result->employee_type=="administration" || $result->employee_type=="boss") {
				$this->load->view("admininfo",$data);
			}
			else {
				$this->load->view("staffinfo",$data);
			}
				
			$data=$this->globalmethods->randomquote();
			$this->load->view("quotes",$data);
			$this->load->view("footer");		
		}
	}
		
//logs out and goes back to home page
	public function logOut()
	{
		session_start();
		session_unset();
		session_destroy();
		$this->index();
	}
	
///called by ajax to change view
	public function icons(){
		session_start();
		$_SESSION["views"]="imageView";
	}
	public function lists(){
		session_start();
		$_SESSION["views"]="listView";
	}
	
	
	
}