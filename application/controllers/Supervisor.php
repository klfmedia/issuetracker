<?php
class Supervisor extends CI_Controller
{
//close an open issue (by rejection or resolving it)
	public function activeIssue()
	{
		$act=$_GET['act'];
		$issue_id = $_GET['issue_id'];
		$data['id']=$issue_id;
		$this->issueDetails();
		$this->load->model('issue');
		$case= new Issue();
		$case->setIssueId($issue_id);
		$issue_status= $case->getIssueStatus();
		$status = $issue_status["status"];
		
		if ($status=="resolved") {
			
			$data["alert_title"]="Resolved Issue";
			$data["alert_message"]="This issue has already been resolved";
			$data["alert"]="failure";
			$this->load->view("alert",$data);
		}
		elseif ($status=="rejected") {
			
			$data["alert_title"]="Rejected Issue";
			$data["alert_message"]="This issue has already been rejected";
			$data["alert"]="failure";
			$this->load->view("alert",$data);
		}
		
		else {
			$data["alert_title"]="Are you Sure?";
			if ($act=="reject") {
				$data["alert_message"]="A rejected issue cannot be modified";
				$data["alert"]="reject";
				$this->load->view("alert",$data);
			}
			else if ($act=="resolve") {
				$data["alert_message"]="A closed issue cannot be modified";
				$data["alert"]="resolved";
				$this->load->view("alert",$data);
			}	
		}
	}

//reject a reported issue
	public function rejectIssue()
	{
		$this->load->model('issue');
		$case= new Issue();	
		$issue_id=$_GET["issue_id"];
		$case->setIssueId($issue_id);
		$data['issue_id'] = $issue_id;
		$case->rejectCurrentIssue();
		$this->issueDetails();
		$data["alert_title"]="Rejection!";
		$data["alert_message"]="Issue Iss$issue_id  has been rejected.";
		$data["alert"]="success";
		$this->load->view("alert",$data);
	}

//Assign an issueto a technician	
	public function assignIssue()
	{			
		$this->load->model('issue');
		$this->load->model('technician');
		$case= new Issue();
		$issue_id=$_GET["issue_id"];
		$case->setIssueId($issue_id);
		$issue_status= $case->getIssueStatus();
		$status = $issue_status["status"];
		$this->issueDetails();
		
		if ($status=="resolved") {
				
			$data["alert_title"]="Resolved Issue";
			$data["alert_message"]="This issue has already been resolved";
			$data["alert"]="failure";
			$this->load->view("alert",$data);
		}
		elseif ($status=="rejected") {
				
			$data["alert_title"]="Rejected Issue";
			$data["alert_message"]="This issue has already been rejected";
			$data["alert"]="failure";
			$this->load->view("alert",$data);
		}
		
		elseif ($status=="in progress") {
		
			$data["alert_title"]="Assigned Issue";
			$data["alert_message"]="Do you want to reassign this issue?";
			$data["alert"]="reassign";
			$data['id']=$issue_id;
			$data["tech_id"] = $_GET["techassigned"];
			$this->load->view("alert",$data);
		}
		
		else {
			$data['issue_id'] = $issue_id;
			$tech_id = ($_GET["techassigned"]);
			$tech_name = $this->technician->getTechnicianName($tech_id);
			$case->assignCurrentIssue($tech_id);
			$data["alert_title"]="Tech Assigned!";
			$data["alert_message"]=ucwords($tech_name).' has been assigned to Issue Iss'.$issue_id;
			$data["alert"]="success";
			$this->load->view("alert",$data);	
		}
	}
//Reassign an issue to a different technician
	public function reassignIssue()
	{
			
		$this->load->model('issue');
		$this->load->model('technician');
		$case= new Issue();
		$issue_id=$_GET["issue_id"];
		$case->setIssueId($issue_id);
		$this->issueDetails();
		$data['issue_id'] = $issue_id;
		$tech_id = ($_GET["tech_id"]);
		$tech_name = $this->technician->getTechnicianName($tech_id);
		$case->assignCurrentIssue($tech_id);
	
		$data["alert_title"]="Tech Assigned!";
		$data["alert_message"]= 'Issue Iss '.$issue_id.' has been reassigned to '. ucwords($tech_name).'.' ;
		$data["alert"]="success";
		$this->load->view("alert",$data);
	}
//Mark an issue as resolved
	public function issueResolved()
	{
		$this->load->model('issue');
		$case= new Issue();
		$issue_id=$_GET["issue_id"];
		$case->setIssueId($issue_id);
		$data['issue_id'] = $issue_id;
		$case->currentIssueResolved();
		$this->issueDetails();
		$data["alert_title"]="Issue Closed!";
		$data["alert_message"]="Issue Iss$issue_id has been resolved.";
		$data["alert"]="success";
		$this->load->view("alert",$data);
	}
	
//create new technician without assigning task 
	public function manageTech()
	{
		session_start();
		$this->load->model('Technician');
		$new_tech = new Technician();
		$new_tech->setName($this->input->post('techname'));
		$new_tech->setSpeciality($this->input->post('speciality'));
		$new_tech->setCompany($this->input->post('company'));
		$new_tech->setPhone($this->input->post('phone'));
		$tech_id=$this->input->post('techid');
		$data["alert"]="success";
		if (empty($tech_id)) {
			$new_tech->addTechnician();
			$data["alert_title"]="Technician Added!";
			$data["alert_message"]= ucwords($new_tech->getName()).' has been added to list of technicians.';
		}
		else {
			$new_tech->setTechId($tech_id);
			$new_tech->editTechnician();
			$data["alert_title"]="Technician Added!";
			$data["alert_message"]= 'Technician '. ucwords($new_tech->getName()).' has been updated.';	
		}
		$pge=1;
		if (isset($_POST["page"])) {
			$pge= $_POST["page"];
		}	
		$str = ($pge*5)-5;
		$this->load->model("Admin");
		$techs = $this->Admin->viewTechnicians($str);
		$data["all_techs"] = $techs;
		$data["page_number"] = $pge;
		$all_techs = $this->Admin->getTechnicians();
		$nbr=ceil(count($all_techs)/5);
		$data["nb"] = $nbr;
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Technicians' => 'http://localhost/issuetracker/index.php/supervisor/technicians');
		$this->adminData($crumbs);
		$this->load->view("technicians", $data);
		$this->load->view("alert",$data);
	}
	
// displays prompt to confirm deleting technician
	public function deleteTech()
	{
		$this->load->model("Technician");
		$current_tech = new Technician();
		$tech_id = $_GET["techid"];
		$current_tech->setTechId($tech_id);
		$jobs=$current_tech->getTechnicianJobs();
		$data["id"]=$tech_id;
		
		if (count($jobs)>0) {
			$data["alert_message"]="Technicians assigned to tasks cannot be deleted! ";
			$data["alert"]="failure";
			$data["alert_title"]="Assigned Technician";
		}
		else{
			$data["alert_message"]="Technician will be deleted from all records";
			$data["alert"]="delete_tech";
			$data["alert_title"]="Delete Technician";
		}
		
		$this->technicians();
		$this->load->view("alert",$data);
	}
	
//delete technician after confirmation
	public function dropTech()
	{
		$this->load->model('Technician');
		$new_tech = new Technician();
		$tech_id=$_GET["tech_id"];
		$tech_name=$new_tech->getTechnicianName($tech_id);
		$new_tech->setTechId($tech_id);
		$new_tech->deleteTechnician();
		$data["alert_message"]='Technician '.$tech_name.' has been deleted from all records';
		$data["alert"]="success";
		$data["alert_title"]="Technician Deleted";
		$this->technicians();
		$this->load->view("alert",$data);
	}
	
//create new technician and assign task
	public function newTechAssigned()
	{
		$this->load->model('Technician');
		$this->load->model('issue');
		$new_tech = new Technician();
		$new_tech->setName($_POST['techname']);
		$new_tech->setSpeciality($_POST['specialization']);
		$new_tech->setPhone($_POST['phone']);
		$new_tech->setCompany($_POST['company']);
		$result = $new_tech->addTechnician();
		$case= new Issue();
		$case->setIssueId($_POST['issue_id']);
		$data['issue_id'] = $_POST['issue_id'];
		$case->assignCurrentIssue($result["tech_id"]);
		$this->issueDetails();	
		$data["alert_title"]="New Tech Assigned!";
		$data["alert_message"]='New Techician '.ucwords($new_tech->getName()).' has been assigned to Issue Iss'.$case->getIssueId();
		$data["alert"]="success";
		$this->load->view("alert",$data);
	}
	
//redirect to page for new employee creation
	public function newEmployee()
	{
		session_start();
		$this->load->model('Admin');
		$boss= new Admin();
		$all_departments = $boss->getAllDepartments();
		$data["departments"] = $all_departments;
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Employees' => 'http://localhost/issuetracker/index.php/supervisor/employees',
				'Add Employee' => 'http://localhost/issuetracker/index.php/supervisor/newemployee');
		$this->adminData($crumbs);
		$this->load->view("newemployee",$data);
	}
	
	
//creates new employee 
	public function saveEmployee()
	{
		$this->load->model('Employee');
		$staff= new Employee();
		$staff->setFirstName($this->input->post('firstName'));
		$staff->setLastName($this->input->post('lastName'));
		$staff->setEmail($this->input->post('email'));
		$staff->setPhone($this->input->post('phone'));
		$staff->setEmployeeNumber($this->input->post('employeeNumber'));
		$staff->setPassword($this->input->post('password'));
		$staff->setDepartmentId($this->input->post('department'));
		$staff->setType($this->input->post('employeeType'));
		$name = $staff->getFirstName(). " ".$staff->getLastName();
		$staff->createEmployee();
		$this->employees();
		$data["alert_title"]=" New Employee!";
		$data["alert_message"]='New Employee '.ucwords($name).' has been created.';
		$data["alert"]="success";
		$this->load->view("alert",$data);
	}
	
//Modify technician details	
	public function modifyTech()
	{
		session_start();
		$pge=1;
		if (isset($_GET["page"])) {
			$pge= $_GET["page"];
		}
		$str = ($pge*5)-5;
		$this->load->model("Admin");
		$view_techs = $this->Admin->getTechnicians();
		$techs = $this->Admin->viewTechnicians($str);
		$data["all_techs"] = $techs;
		$tech_id = $_GET["techid"];
		$data["modify_id"] = $tech_id;
		$data["page_number"] = $pge;
		//$all_techs = $this->Admin->getTechnicians();
		$nbr=ceil(count($view_techs)/5);
		$data["nb"] = $nbr;
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Technicians' => 'http://localhost/issuetracker/index.php/supervisor/technicians',
				'Update' => '#');
		$this->adminData($crumbs);
		$this->load->view("technicians", $data);	
	}
	
	//Modify technician details
	public function techJobs()
	{
		session_start();
		$pge=1;
		if (isset($_GET["page"])) {
			$pge= $_GET["page"];
		}
		$str = ($pge*5)-5;
		$this->load->model("Admin");
		$this->load->model("Technician");
		$current_tech = new Technician();
	
		
		$view_techs = $this->Admin->getTechnicians();
		$techs = $this->Admin->viewTechnicians($str);
		$data["all_techs"] = $techs;
		$tech_id = $_GET["techid"];
		$current_tech->setTechId($tech_id);
		$jobs = $current_tech->getTechnicianJobs();
		$nbr=ceil(count($view_techs)/5);
		$data["nb"] = $nbr;
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Technicians' => 'http://localhost/issuetracker/index.php/supervisor/technicians',
				'Tasks' => '#');
		$this->adminData($crumbs);
		$tech_name = $current_tech->getTechnicianName($tech_id);
		$data["tech_name"] = $tech_name;
		$data["page_number"] = $pge;
		
		if (count($jobs)>0) {
			$data["tech_jobs"] = $jobs;
			$data["tech_tasks"] = "true";
			$this->load->view("technicians", $data);
		}
		else{
			$data["alert_message"]='Technician '.ucwords($tech_name) .' currently has no tasks! ';
			$data["alert"]="info";
			$data["alert_title"]="UnAssigned Technician";
			$this->load->view("technicians", $data);
			$this->load->view("alert",$data);
		}
		
		
		//$all_techs = $this->Admin->getTechnicians();
		
		
	
		
	}
	
//loads profile data for current administration	
	public function adminData($crumbs)
	{	
		if(!isset($_SESSION)) {
			session_start();
		}
		$data=$crumbs;
		$this->load->model('Admin');
		$boss= new Admin();
		$boss->setEmployeeId($_SESSION["userid"]);
		$boss->getFullProfile();
		$this->load->library("globalmethods");
		$data["greeting"]=$this->globalmethods->greetings();
		$data["name"] = $boss->getFirstName()." ".$boss->getLastName();
		$data["photo"] = $boss->getPhoto();
		$this->load->view("header",$data);
		$this->load->view("footer");
	}

//displays tables of reported issues
	public function issues()
	{
		$this->load->model('Admin');
		$boss= new Admin();
		$this->load->library("globalmethods");
		
		//crumbs
		session_start();
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Issues' => 'http://localhost/issuetracker/index.php/supervisor/issues');
		$this->adminData($crumbs);
		//$this->load->view("header");	
		$data=$this->getDisplayData("issues");
		$data["all"]="true";
		$data["search"]="all";
		$_SESSION["issues"]="all";
		$this->load->view("allissues", $data);
	}
	
//displays tables for technicians
	public function technicians()
	{
		session_start();
		$this->load->model('Admin');
		$boss= new Admin();
		$this->load->library("globalmethods");
		$data=$this->globalmethods->greetings();
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Technicians' => 'http://localhost/issuetracker/index.php/supervisor/technicians',);
		$this->adminData($crumbs);
		$data=$this->getDisplayData("technicians");
		$data["tech_tasks"]="hide";
		$this->load->view("technicians", $data);
	}
	
//display tables for employees
	public function employees(){
		session_start();
		$this->load->model('Admin');
		$boss= new Admin();
		$this->load->library("globalmethods");
		$data["greeting"]=$this->globalmethods->greetings();
		
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Employees' => 'http://localhost/issuetracker/index.php/supervisor/employees');
		
		$this->adminData($crumbs);	
		//$data["page_number"]=$_GET["page"];
		$data=$this->getDisplayData("employees");
		$this->load->view("employees", $data);	
	}
	
//displays tables for administrators
	public function administrators()
	{
		session_start();
		$this->load->model('Admin');
		$boss= new Admin();
		$this->load->library("globalmethods");
		$data=$this->globalmethods->greetings();
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Administrators' => 'http://localhost/issuetracker/index.php/supervisor/administrators');
		$this->adminData($crumbs);
		$data=$this->getDisplayData("administration");
		$this->load->view("administrators", $data);
	}
	
//displays tables for inactive employees
	public function inactiveStaff()
	{
		session_start();
		$this->load->model('Admin');
		$boss= new Admin();
		$this->load->library("globalmethods");
		$data=$this->globalmethods->greetings();
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Inactive Staff' => '#'	);
		$this->adminData($crumbs);
		$data=$this->getDisplayData("inactive");
		$this->load->view("inactiveemployees", $data);
	}
	
// prompt for staff suspension 
	public function suspendStaff()
	{
		$data["alert_message"]="Employee will be suspended from website";
		$data["alert"]="suspend_staff";
		$data["alert_title"]="Deactivate Employee";
		$data["id"]=$_GET["id"];
		$this->employees();
		$this->load->view("alert",$data);
	}
	
//deactivate Employee profile after confirmation
	public function deactivateStaff()
	{
		$this->load->model('Employee');
		$staff= new Employee();
		$staff_id=$_GET["id"];
		$staff->setEmployeeId($staff_id);
		$staff->deactivateEmployee();	
		$data["alert_message"]='Employee has been suspended from all activities';
		$data["alert"]="success";
		$data["alert_title"]="Employee Deactivated";
		$this->employees();
		$this->load->view("alert",$data);
	}
	
//prompt activation for inactive profile 
	public function activeStaff()
	{
		$data["alert_message"]="Employee will be reactivated ";
		$data["alert"]="active_staff";
		$data["alert_title"]="Activate Employee";
		$data["id"]=$_GET["id"];
		$this->inactiveStaff();
		$this->load->view("alert",$data);
	}
	
//Reactivate Employee profile after confirmation
	public function activateStaff()
	{
		$this->load->model('Employee');
		$staff= new Employee();
		$staff_id=$_GET["id"];
		$staff->setEmployeeId($staff_id);
		$staff->activateEmployee();
		$data["alert_message"]='Employee has been reactivated ';
		$data["alert"]="success";
		$data["alert_title"]="Employee DReactivated";
		$this->employees();
		$this->load->view("alert",$data);
	}
	
//prompt to delete outdated issues
	public function expiredIssues()
	{
		session_start();
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Outdated Issues' => 'http://localhost/issuetracker/index.php/supervisor/outdatedissues');
		$this->adminData($crumbs);
		$this->load->view("admininfo");
		$this->load->library("globalmethods");
		$data=$this->globalmethods->randomQuote();
		$this->load->view("quotes", $data);
		$data["alert_message"]="All Closed Issues Older than 3 months will be deleted ";
		$data["alert"]="oldIssues";
		$data["alert_title"]="Outdated Issues";
		$this->load->view("alert",$data);
	}

/* //delete outdated issues after confirmation
	public function deleteOldIssues()
	{
		$this->load->model('Issue');
		$oldIssues= new Issue();
		$info=$oldIssues->deleteOutdatedIssues();
		print_r($info);
		$data["alert_message"]='Employee has been reactivated ';
		$data["alert"]="success";
		$data["alert_title"]="Employee DReactivated";
	} */
	
//prompt to confirm delete of inactiver profile
	public function deleteStaff()
	{
		$data["alert_message"]="Employee will be deleted from all records permanently";
		$data["alert"]="delete_staff";
		$data["alert_title"]="Delete Employee";
		$data["id"]=$_GET["id"];
		$this->inactiveStaff();
		$this->load->view("alert",$data);
	}

//delete inactive Employee after confirmation
	public function dropStaff()
	{
		$this->load->model('Employee');
		$staff= new Employee();
		$staff_id=$_GET["id"];
		$staff->setEmployeeId($staff_id);
		$staff->deleteEmployee();
		$data["alert_message"]='Employee has been deleted from all records';
		$data["alert"]="success";
		$data["alert_title"]="Employee Deleted";
		$this->inactiveStaff();
		$this->load->view("alert",$data);
	}
	
//prompt to assign staff as administrator
	public function assignAdmin()
	{
		$data["alert_message"]="Employee will now perform administrative actions";
		$data["alert"]="setAdmin";
		$data["alert_title"]="Assign as Administration";
		$data["id"]=$_GET["id"];
		$this->staffDetails();
		$this->load->view("alert",$data);
	}
	
//assign Employee as Administration after confirmation
	public function assignAsAdmin()
	{
		$this->load->model('Employee');
		$staff= new Employee();
		$staff_id=$_GET["id"];
		$staff->setEmployeeId($staff_id);
		$staff->setAdminStatus();
		$data["alert_message"]='Employee has been given Administration status';
		$data["alert"]="success";
		$data["alert_title"]="New Administrator";
		$this->employees();
		$this->load->view("alert",$data);
	}
	
//prompt to revoke administrative status
	public function revokeAdmin()
	{
		$data["alert_message"]="Employee will no more perform administrative actions";
		$data["alert"]="dropAdmin";
		$data["alert_title"]="Revoke Administration Status";
		$data["id"]=$_GET["id"];
		$this->staffDetails();
		$this->load->view("alert",$data);
	}
	
//Revoke Administrative status of Employee after confirmation
	public function revokeAdminStatus()
	{
		$this->load->model('Employee');
		$staff= new Employee();
		$staff_id=$_GET["id"];
		$staff->setEmployeeId($staff_id);
		$staff->getFullProfile();
		if ($staff->getType()=="boss") {
			$data["alert_message"]='You are not authorized to perform this action';
			$data["alert"]="failure";
			$data["alert_title"]=" Not Authorized";
			$this->administrators();
			$this->load->view("alert",$data);
		}
		else{
			$staff->dropAdminStatus();
			$data["alert_message"]='Administration status of employee has been revoked';
			$data["alert"]="success";
			$data["alert_title"]=" Administrator Suspended";
			$this->employees();
			$this->load->view("alert",$data);
		}
	}
	
//gets the data to display as well as the page to display
	public function getDisplayData($reference)
	{
		$this->load->model('Admin');
		$boss= new Admin();
		$pge=1;
		if (isset($_GET["page"])) {
			$pge= $_GET["page"];
		}
		if($reference =="technicians") {
			$str = ($pge*5)-5;
			$technicians = $boss->viewTechnicians($str);
			$all_techs = $boss->getTechnicians();	
			$nbr=ceil(count($all_techs)/5);	
			$data["all_techs"] = $technicians;
		}
		elseif($reference =="employees") {
			$str = ($pge*5)-5;
			$employees = $boss->viewEmployees($str);
			$all_employees = $boss->viewAllEmployees();
			$nbr=ceil(count($all_employees)/5);
			$data["employee"] = $employees;
		}
		elseif($reference =="inactive") {
			$str = ($pge*5)-5;
			$employees = $boss->viewInactiveEmployees($str);
			$all_employees = $boss->viewAllInactiveEmployees();
			$nbr=ceil(count($all_employees)/5);
			$data["employee"] = $employees;
		}
		elseif($reference =="administration") {
			$str = ($pge*5)-5;
			$employees = $boss->viewAdmin($str);
			$all_employees = $boss->viewAllAdmin();
			$nbr=ceil(count($all_employees)/5);
			$data["employee"] = $employees;
		}
		elseif($reference =="issues") {
			$str = ($pge*8)-8;
			$issues = $boss->viewAllIssues($str);
			$all_issues = $boss->getAllIssues();
			$nbr=ceil(count($all_issues)/8);
			$data["issues"] = $issues;
			$data["user"] = "admin";
		}
		$data['nb']=$nbr;
		$data['page_number'] = $pge;
		return $data;
	}
	
//controls staff profile for administration view
	public function staffDetails()
	{
		if(!isset($_SESSION)) {
			session_start();
		}
		if(isset($_GET["page"])) {
			$page_number=$_GET["page"];
		}
		else{
			$page_number=1;
		}
		
		$data["page_number"]=$page_number;
		if ($_SESSION["userid"]==$_GET["id"]) {
			$this->load->model('Employee');
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
					'Profile' => '#');
			$this->load->view("header",$data);
			$this->load->view("profile",$data);
			$this->load->view("footer");
		}
		else{
						
			$this->load->model("Employee");
			$staff = new Employee();
			$staff->setEmployeeId($_GET["id"]);
			$staff->getFullProfile();
			if ($staff->getType()=="administration" || $staff->getType()=="boss"  ){
				$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
						'Administrators' => 'http://localhost/issuetracker/index.php/supervisor/employees',
						'Administrator Details' => '#');
			}
			else{
			$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
					'Employees' => 'http://localhost/issuetracker/index.php/supervisor/employees',
					'Employee Details' => '#');
			}
			$this->adminData($crumbs);
			$staff_info = $staff->getRowProfile();
			$my_dept=  $staff->getDepartment();
			$data["department"] = $my_dept["department_name"];
			$data["staffinfo"] = $staff_info;
			$data["departments"]=$staff->getAllDepartments();
			$this->load->view("profileview",$data);
		}
	}
	
//controls staff profile for administration view
	public function manageEmployee()
	{
		session_start();
		$this->load->model('Employee');
		$staff= new Employee();
		$staff->setEmployeeId($this->input->post('staffId'));
		$staff->getFullProfile();
		$name = $staff->getFirstName(). " ".$staff->getLastName();
		$staff->setEmployeeNumber($this->input->post('employeeNumber'));
		$staff->setPassword($this->input->post('password'));
		$staff->setDepartmentId($this->input->post('department'));
		$staff->setType($this->input->post('employeeType'));
		$staff->updateEmployee();
		$my_dept=  $staff->getDepartment();
		$staff_info = $staff->getRowProfile();
		$data["page_number"]=$this->input->post('page');
		$data["department"] = $my_dept["department_name"];
		$data["staffinfo"] = $staff_info;
		$data["departments"]=$staff->getAllDepartments();
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Employees' => 'http://localhost/issuetracker/index.php/supervisor/employees',
				'Employee Details' => '#');
		$this->adminData($crumbs);
		$this->load->view("profileview",$data);
		$data["alert_title"]="Profile Updated!";
		$data["alert_message"]= ucwords($name).'\'s profile has been updated.';
		$data["alert"]="success";
		$this->load->view("alert",$data);
	}
	

//calls header and footer for display as well as the view for issue details to fill in new issue.
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
		$current_issue->setIssueId($_GET['issue_id']);
		$issue_details = $current_issue->getIssueDetails();
		$data['issue_id'] = $_GET['issue_id'];
		$data['details'] = $issue_details;
		$data['issueImage'] = $current_issue->getIssueAttachments();
		$staff = $current_user->getType();
		$this->adminData($crumbs);
		$this->load->model('Admin');
		$boss= new Admin();
		$my_techs = $boss->getTechnicians();
		$techs["all_techs"] =  $my_techs;
		$this->load->view("issuedetails", $data);
		$this->load->view("issuedetailsadmin", $techs);
	}
	
	//search issues by priority.
	public function search()
	{
		session_start();
		$searchValue=$_GET["search"];
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Issues' => 'http://localhost/issuetracker/index.php/supervisor/issues');
		
	
	
		$pge=1;
		if (isset($_GET["page"])) {
			$pge= $_GET["page"];
		}
		$str = ($pge*8)-8;
		$sel_issues;
		$this->load->model('Employee');
		$this->load->model('issue');
		$an_issue=new Issue();		
		if ($searchValue=="assigned") {
			$an_issue->setStatus("in progress");
			$my_issues = $an_issue->getIssuesByStatus();
			$sel_issues=$an_issue->viewIssuesByStatus($str);
			$data['all'] = "true";
			$_SESSION["issues"]="assigned";
			$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
			'Issues' => 'http://localhost/issuetracker/index.php/supervisor/issues',
			'Assigned' => 'http://localhost/issuetracker/index.php/supervisor/issues?search=assigned');
		}	
		else if ($searchValue=="open") {
			$my_issues = $an_issue->getOpenIssues();
			$sel_issues=$an_issue->viewOpenIssues($str);
			$data['all'] = "true";
			$_SESSION["issues"]="open";
			$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
					'Issues' => 'http://localhost/issuetracker/index.php/supervisor/issues',
					'Open' => 'http://localhost/issuetracker/index.php/supervisor/issues?search=open');
		}
		else if ($searchValue=="closed") {
			$my_issues = $an_issue->getClosedIssues();
			$sel_issues=$an_issue->viewClosedIssues($str);
			$data['all'] = "true";
			$_SESSION["issues"]="closed";
			$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
					'Issues' => 'http://localhost/issuetracker/index.php/supervisor/issues',
					'Closed' => 'http://localhost/issuetracker/index.php/supervisor/issues?search=closed');
		}
		else if ($searchValue=="all") {
			$my_issues = $an_issue->getClosedIssues();
			$sel_issues=$an_issue->viewClosedIssues($str);
			$data['all'] = "true";
			$_SESSION["issues"]="closed";
			
		}
		$this->adminData($crumbs);
		$nbr=ceil(count($my_issues)/8);
		$data["search"]=$searchValue;
		$data['nb']=$nbr;
		$data['page_number'] = $pge;
		$data['issues'] = $sel_issues;
		$data['user'] = "admin";
		$this->load->view("allissues", $data);
	}
	
//displays tables of reported issues
	//prompt to confirm delete of outdated issues
	public function clearOutdatedIssues()
	{
		$data["alert_message"]="Issues will be deleted from all records permanently";
		$data["alert"]="deleteissues";
		$data["alert_title"]="Clear Outdated Issues";
		$this->outdatedIssues();
		$this->load->view("alert",$data);
	}
	
	//delete inactive Employee after confirmation
	public function deleteOutdatedIssues()
	{
		$this->load->model('Admin');
		$boss= new Admin();
		$boss->deleteOutdatedIssues();
		$data["alert_message"]='Outdated Issues have been deleted permanently from the system ';
		$data["alert"]="success";
		$data["alert_title"]="Outdated Issues Deleted";
		$this->outdatedIssues();
		$this->load->view("alert",$data);
	}
	
	public function outdatedIssues()
	{
		$pge=1;
		if (isset($_GET["page"])) {
			$pge= $_GET["page"];
		}
		$str = ($pge*5)-5;
		$this->load->model('Admin');
		$boss= new Admin();
		session_start();
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Outdated Issues' => 'http://localhost/issuetracker/index.php/supervisor/outdatedissues');
		$this->adminData($crumbs);
		//$this->load->view("header");
		$old_issues=$boss->getOutdatedIssues();
		$nbr=ceil(count($old_issues)/8);
		$view_issues=$boss->viewOutdatedIssues($str);
		$data["page_number"] = $pge;
		$data["nb"]=$nbr;
		$data["issues"] = $view_issues;
		$this->load->view("outdatedissues", $data);
	}
	
	//calls header and footer for display as well as the view for outdated issues details 
	public function outdatedIssueDetails()
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
		$data['issue_id'] = $_GET['id'];
		$data['details'] = $issue_details;
		$data['issueImage'] = $current_issue->getIssueAttachments();
		$staff = $current_user->getType();
		$crumbs['breadcrumb'] = array('Home' => $_SESSION["home_url"] ,
				'Outdated Issues' => 'http://localhost/issuetracker/index.php/supervisor/outdatedissues',
				 'Outdated-Issues Details' => '#');
		$this->adminData($crumbs);
		$this->load->model('Admin');
		$boss= new Admin();
		$my_techs = $boss->getTechnicians();
		$techs["all_techs"] =  $my_techs;
		$this->load->view("outdatedissuesdetails", $data);
	}
	
}


