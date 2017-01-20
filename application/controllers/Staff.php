<?php
class Staff extends CI_Controller {

//calls header and footer for display as well as page to fill in new issue.
	public function newIssue()
	{	session_start();
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'New Issue' => '#');
		
		$this->staffData($crumbs);
		$this->load->model('Employee');
		$staff=new Employee();
		$all_locations = $staff->getLocations();
		$data["locations"] = $all_locations;
		$this->load->view("newissue", $data);
	}
	
//Creates issue object required by function in Model class to insert new record in database
	public function saveIssue()
	{
		$errors= array();
		$file_name = $_FILES['attachment']['name'];
		//check if any file is attached to reported issue and insert it into database
		if ($file_name!="") {
			$file_size =$_FILES['attachment']['size'];
			$file_tmp =$_FILES['attachment']['tmp_name'];
			$file_type=$_FILES['attachment']['type'];
			$tmp = (explode('.',$_FILES['attachment']['name']));	
			$file_ext=strtolower(end($tmp));		
			$extensions= array("jpeg","jpg","png");
			if(in_array($file_ext,$extensions)=== false) {
				$errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			if($file_size > 2097152) {
				$errors[]='File size should be 2MB or smaller';
				}
		}	
		if(empty($errors)==true) {
			session_start();
			$this->load->model('Issue');
			$this->load->model('Employee');
			$staff = new Employee();
			$new_issue = new Issue();
			$new_issue->setIssueName( strtolower($this->input->post('issuename')));
			$location = $this->input->post('issueLocation');
			if($location =='other') {
				$new_issue->setLocation(strtolower($this->input->post('newLocation')));
			}
			else {
					$new_issue->setLocation(strtolower($location));
			}			
			$new_issue->setDescription($this->input->post('description'));
			$new_issue->setPriority($this->input->post('priority'));
			$new_issue->setEmployeeId( $_SESSION['userid']);
			$tester = $new_issue->createIssue();
			$new_issue->createIssueLog($tester['id']);
			$new_issue->setIssueId($tester['id']);		
			if ($file_name!="") {
				$new_issue->uploadFile($file_name);
				move_uploaded_file($file_tmp,"./assets/images/".$file_name);
			}
			else{$new_issue->uploadFile("issue.jpg");}
			//$this->staffDisplay($crumbs);
			$this->issues();
			$data["alert_title"]= "Issue Reported!";
			$data["alert_message"]='Your Issue has been reported';
			$data["alert"]="success";
			$this->load->view("alert",$data);
		}
		else {
			$this->newIssue();
			$data["alert_title"]= "Upload Failed!";
			$data["alert_message"]=$errors[0];
			$data["alert"]="failure";
			$this->load->view("alert",$data);
		}		
	}
	
//gets reported issues and displays all or those roported by user
	public function issues()
	{
		if(!isset($_SESSION)){
			session_start();
		}
		
		
		$pge=1;
		if (isset($_GET["page"])) {
			$pge= $_GET["page"];
		}
		$str = ($pge*8)-8;
		$sel_issues;
		$this->load->model('Employee');
		$staff = new Employee();
		
		$staff->setEmployeeId($_SESSION['userid']);
		if (isset($_GET["all"]) && $_GET["all"]=="true") {
			$my_issues = $staff->getAllIssues();
			$sel_issues=$staff->viewAllIssues($str);
			$data['all'] = "true";
			$data["search"]="all";
			$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
			'Issues' => 'http://localhost/issuetracker/index.php/supervisor/issues',
			'All' => 'http://localhost/issuetracker/index.php/supervisor/issues');
		}
		else {
			$my_issues = $staff->getMyIssues();
			$sel_issues=$staff->viewMyIssues($str);
			$data["search"]="mine";
			$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
					'Issues' => 'http://localhost/issuetracker/index.php/supervisor/issues',
					'My Issues' => 'http://localhost/issuetracker/index.php/staff/issues?all=false');
		}
		$this->staffDisplay($crumbs);
		$nbr=ceil(count($my_issues)/8);
		$data['nb']=$nbr;
		$data['page_number'] = $pge;
		$data['issues'] = $sel_issues;
		$data['user'] = "staff";
		$this->load->view("allissues", $data);
	}
	
	
//calls header and footer for display as well as the view for the details of a reported issue
	public function issueDetails()
	{
		$this->load->model('Issue');
		$this->load->model('Employee');
		$current_user =new Employee();
		if(!isset($_SESSION)) {
			session_start();
		}
		$current_user->setEmployeeId($_SESSION['userid']);
		$current_user->getFullProfile();
		$current_issue = new Issue();
		$current_issue->setIssueId($_GET['id']);
		$issue_details = $current_issue->getIssueDetails();
		$data["greeting"] = $this->greetings();
		$data['all'] = $_GET['all'];
		$data['page_number'] = $_GET['page'];
		$data['issue_id'] = $_GET['id'];
		$data['details'] = $issue_details; 
		$data['issueImage'] = $current_issue->getIssueAttachments();
		$staff = $current_user->getType();
		if ($staff =="administration"||$staff =="boss") {
			$this->load->model('Admin');
			$boss= new Admin();
			$boss->setEmployeeId($_SESSION["userid"]);
			$boss->getFullProfile();
			$data["name"] = $boss->getFirstName()." ".$boss->getLastName();
			$data["photo"] = $boss->getPhoto();
			$data['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
					'Issues' => 'http://localhost/issuetracker/index.php/supervisor/issues',
					'Issue Details' => '#');
			$this->load->view("header",$data);
			$this->load->model('Admin');
			$boss= new Admin();
			$my_techs = $boss->getTechnicians();
			$techs["all_techs"] =  $my_techs; 
			$this->load->view("issuedetails", $data);
			$this->load->view("issuedetailsadmin", $techs);
		}
		else {
			$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
					'Issues' => 'http://localhost/issuetracker/index.php/supervisor/issues',
					'Issue Details' => '#');
			$this->staffData($crumbs);
			$this->load->view("issuedetails", $data);
		}
		
	}
		
//calls header and footer for display and displays the profile of the current user
	public function myProfile()
	{
		$this->load->model('Employee');
		if(!isset($_SESSION)) {
			session_start();
		}
		$current_user = new Employee();
 		$current_user->setEmployeeId($_SESSION['userid']);
 		$current_user->getFullProfile();
 		$my_profile = $current_user->getRowProfile();
 		if ($my_profile["employee_type"]=="administration" ||$my_profile["employee_type"]=="boss"  ) {
 			$this->load->model('Admin');
 			$boss= new Admin();
 			$data["departments"] = $boss->getAllDepartments();
 		}
 		$data['photo'] = $current_user->getPhoto();
 		$data['credentials'] = $my_profile; 	
 		$name= $current_user->getDepartment();
 		$data["department"] =$name["department_name"];
 		$data['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
 				'Profile' => 'http://localhost/issuetracker/index.php/staff/myprofile');
		$this->load->view("header",$data);
		$this->load->view("profile",$data);
		$this->load->view("footer"); 	
	}
	
	
	
//updates password of current user and returns to profile page
/* 	public function changePassword()
	{
		$this->load->model('Employee');
		session_start();
		$current_user = new Employee();
		$current_user->setEmployeeId($_SESSION['userid']);
		$current_user->setPassword( $this->input->post('newpass'));
		$current_user->updatePassword();
		$this->myProfile();	
		$data["alert_title"]="Password Modified!";
		$data["alert_message"]='Your password has been succesfully changed';
		$data["alert"]="success";
		$this->load->view("alert",$data);
	} */
	

//updates password of current user and returns to profile page
	public function updateProfile()
	{
		$this->load->model('Employee');
		if(!isset($_SESSION)) {
			session_start();
		}
		$current_user = new Employee();
		$current_user->setEmployeeId($_SESSION['userid']);
		$current_user->getFullProfile();
		$current_user->setFirstName($this->input->post('firstname'));
		$current_user->setLastName($this->input->post('lastname'));
		$current_user->setPhone( $this->input->post('phone'));
		$current_user->setEmail( $this->input->post('email'));
		if (!empty($_POST["newPass"])) {
			$current_user->setPassword( $this->input->post('newPass'));
		}
		$current_user->updateEmployee();
		$this->myProfile();
		$data["alert_title"]="Profile!";
		$data["alert_message"]='Your Profile has been updated';
		$data["alert"]="success";
		$this->load->view("alert",$data); 
	}
	
	
//loads basic data of current user including menu bar
	public function staffData($crumbs)
	{
		$data=$crumbs;
		$data["greeting"] = $this->greetings();
		$this->load->model('Employee');
		if(!isset($_SESSION)){
			session_start();
		}
		$staff = new Employee();
		$staff->setEmployeeId($_SESSION['userid']);
		$staff->getFullProfile();
		$data['name'] = $staff->getFirstName()." ".$staff->getLastName();
		$data['photo'] = $staff->getPhoto();
		$this->load->view("header",$data);
		 if ($_SESSION["user"]=="administration" || $_SESSION["user"]=="boss") {
			$this->load->view("admininfo");
		}
		else {
			$this->load->view("staffinfo");
		} 
		$this->load->view("footer");
	}
//loads basic data of current user without menu bar
	public function staffDisplay($crumbs)
	{
		$data=$crumbs;
		$data["greeting"] = $this->greetings();
		$this->load->model('Employee');
		if(!isset($_SESSION)){
			session_start();
		}
		$staff = new Employee();
		$staff->setEmployeeId($_SESSION['userid']);
		$staff->getFullProfile();
		$data['name'] = $staff->getFirstName()." ".$staff->getLastName();
		$data['photo'] = $staff->getPhoto();
		$this->load->view("header",$data);
		$this->load->view("footer");
	}
	
	
	
	
//uploads profile picture or picture of issues
	public function uploadPicture()
	{
	 	if(isset($_FILES['image'])) {
			$errors= array();
			$file_name = $_FILES['image']['name'];
			$file_size =$_FILES['image']['size'];
			$file_tmp =$_FILES['image']['tmp_name'];
			$file_type=$_FILES['image']['type'];
			$tmp = (explode('.',$_FILES['image']['name']));
			$file_ext=strtolower(end($tmp));
			$extensions= array("jpeg","jpg","png");
			if(in_array($file_ext,$extensions)=== false){
				$errors[]="Extension not allowed, Please choose a JPEG or PNG file.";
			}
			if($file_size > 2097152){
				$errors[]='File size must be less than 2 MB';
			}
			if(empty($errors)==true){
				$this->load->model("Employee");
				$staff=new Employee();
				session_start();
				$staff->setEmployeeId($_SESSION["userid"]);
				$staff->getFullProfile();
				$newfile=$staff->getPhoto();
				if ($newfile=="staff.png") {
					$newfile=$file_name;
					$staff->setPhoto($file_name);
				}
				move_uploaded_file($file_tmp,"./assets/images/".$newfile);
				$staff->changeProfilePhoto();
				$this->myProfile();
				$data["alert_title"]= "Upload Succesful!";
				$data["alert_message"]="Your profile picture has been updated";
				$data["alert"]="success";
				$this->load->view("alert",$data);
			}
			else {
			 	$this->load->model("Employee");
				$staff=new Employee();
				session_start();
				$staff->setEmployeeId($_SESSION["userid"]);
				$staff->getFullProfile();
				$this->myProfile();
				$data["alert_title"]= "Upload Failed!";
				$data["alert_message"]=$errors[0];
				$data["alert"]="failure";
				$this->load->view("alert",$data);
			}
		}
	}
	


	//display issues of selected page
	public function displayIssue()
	{
		$pge=1;
		if (isset($_GET["page"])) {
			$pge= $_GET["page"];
		}
		$str = ($pge*5)-5;
		$this->load->model("employee");
		$staff = new Employee();
		$query = $this->db->query("SELECT * FROM quotes limit $str,5");
		$my_issues = $staff->getAllIssuess($str);
		$data['page_number'] = $pge;
		$data['issues'] = $my_issues;	
	}
	
	 //display background and greeting message
	public function greetings()
{
		date_default_timezone_set('America/New_York');
		$hrs = date('G');	
		$top_background = 'morning4.jpg';
		$msg = "Mornin' Sunshine!";
		if ($hrs >  6) { $top_background = 'morning2.jpg'; $msg = "Good morning";   }  // After 6am
		if ($hrs > 12) { $top_background = 'sun2.jpg'; $msg = "Good afternoon"; }   // After 12pm
		if ($hrs > 17) { $top_background = 'evening.jpg'; $msg = "Good evening";   }   // After 5pm
		if ($hrs > 22) { $top_background = 'night2.jpg'; $msg = "Go to bed!";     }   // After 10pm
	
		//$data["top_background"]=$top_background;
		$data["greeting"]=$msg;
		return $msg;
	} 
//displays home page with information and random quote
	public function home()
	{
		session_start();
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] );
		$this->staffData($crumbs);
		$this->load->library("globalmethods");
		$data=$this->globalmethods->randomQuote();
		$this->load->view("quotes", $data);
		
		//crumbs
		
		
	}
	

	

	
}
