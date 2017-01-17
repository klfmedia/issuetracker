<?php
class Employee extends CI_Model {
	
	//properties of class employee
	private $employee_id;
	private $first_name;
	private $last_name;
	private $email;
	private $phone;
	private $employee_type;
	private $department_id;
	private $photo;
	private $employee_number;
	private $password;
	
	
//getters and setters for class employee
//employee id
	public function getEmployeeId()
	{
		return $this->employee_id;
	}	
	public function setEmployeeId($employee_id)
	{
		$this->employee_id = $employee_id;
	}
	
//employee first name
	public function getFirstName()
	{
		return $this->first_name;
	}
	public function setFirstName($first_name)
	{
		$this->first_name = $first_name;
	}
	
// employee last name
	public function getLastName()
	{
		return $this->last_name;
	}
	public function setLastName($last_name)
	{
		$this->last_name = $last_name;
	}
	
//employee email
	public function getEmail()
	{
		return $this->email;
	}	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
//employee phone number
	public function getPhone()
	{
		return $this->phone;
	}	
	public function setPhone($phone)
	{
		$this->phone = $phone;
	}
	
//employee type (intern, staff, supervisor...)
	public function getType()
	{
		return $this->employee_type;
	}	
	public function setType($employee_type)
	{
		$this->employee_type = $employee_type;
	}
	
//employee department id (id corresponds to Accounting, Developers, Marketing...)
	public function getDepartmentId()
	{
		return $this->department_id;
	}	
	public function setDepartmentId($department_id)
	{
		$this->department_id = $department_id;
	}
	
//employee attachment id  (id corresponds to photo attachment of employee)
	public function getPhoto()
	{
		return $this->photo;
	}
	public function setPhoto($photo)
	{
		$this->photo = $photo;
	}
	
//employee number (unique employee number assigned to all klf employees)
	public function getEmployeeNumber()
	{
		return $this->employee_number;
	}
	public function setEmployeeNumber($employee_number)
	{
		$this->employee_number = $employee_number;
	}
	
//employee password
	public function getPassword()
	{
		return $this->password;
	}
	public function setPassword($password)
	{
		$this->password = $password;
	}
	
	
//Constructors of class employee
 	public function __construct()
	{
 		parent::__construct();
 	}

//Functions of Class employee
//login function for staff members
	public function  login($user, $password )
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM employees where employee_status ='active' AND employee_number = '".$user."' AND password = '".$password."'");
			if (empty($query)) {
				return null;
			}
			foreach ($query->result() as $employee) {
				return $employee;
			} 		
	}


//gets the id of the employee with known employee number
	public function  getId()
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM employees where employee_number = '".$this->employee_number."'");
		foreach ($query->result() as $row) {
			$id=$row->employee_id;
		}
		return $id;
	}

//gets all the properties of the employee whose employee id is known and is already signed in
	public function  getFullProfile()
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM employees where employee_id = ".$this->employee_id); 
		foreach ($query->result() as $row) {
			$this->setFirstName($row->first_name);
			$this->setLastName($row->last_name);
			$this->setEmail($row->email);
			$this->setPhone($row->phone);
			$this->setType($row->employee_type);
			$this->setDepartmentId($row->department_id);
			$this->setPhoto($row->photo);
			$this->setEmployeeNumber($row->employee_number);
			$this->setPassword($row->password);		
		}
	}

//gets all the properties of the employee whose employee id is known and is already signed in
	public function  getRowProfile()
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM employees where employee_id = ".$this->employee_id);
		return $query->row_array();
	}
	
// get locations of all the issues that have been reported
	public function getLocations()
	{
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT location FROM issues");
		return $query->result_array();
	}


//get all the issues reported by a particular employee
	public function getMyIssues()
	{
		$cutoff_date = date("Y-m-d",strtotime('-3 months'));
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name, first_name, last_name FROM issues, issue_log, attachments,employees where
									issues.issue_id = issue_log.issue_id AND issues.issue_id = attachments.issue_id AND employees.employee_id=issues.employee_id AND
									employees.employee_id = '.$this->employee_id.' AND date_reported >="'. $cutoff_date.'"');
		return $query->result_array();
	}
	
//function to get 5 of my issues
	public function viewMyIssues($ref)
	{
		$cutoff_date = date("Y-m-d",strtotime('-3 months'));
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name, first_name, last_name FROM issues, issue_log, attachments,employees where
										issues.issue_id = issue_log.issue_id AND issues.issue_id = attachments.issue_id AND employees.employee_id=issues.employee_id AND
										employees.employee_id = '.$this->employee_id.' AND date_reported >="'. $cutoff_date.'"limit '. $ref.',8');
		return $query->result_array();
	}
	
// get all issues that have been reported to display to employee.
	public function getAllIssues()
	{
		$cutoff_date = date("Y-m-d",strtotime('-3 months'));
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name, first_name, last_name FROM issues, issue_log, attachments,employees where
						issues.issue_id = issue_log.issue_id AND issues.issue_id = attachments.issue_id AND employees.employee_id=issues.employee_id
						AND date_reported >="'. $cutoff_date.'"');
		return $query->result_array();
	}
	
// get 5 of issues that have been reported to display to employee.
	public function viewAllIssues($ref)
	{
		$cutoff_date = date("Y-m-d",strtotime('-3 months'));
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name, first_name, last_name FROM issues, issue_log, attachments,employees where
									issues.issue_id = issue_log.issue_id AND issues.issue_id = attachments.issue_id AND employees.employee_id=issues.employee_id
									AND date_reported >="'. $cutoff_date.'"limit  '. $ref.',8');
		return $query->result_array();
	}
	
//view all the issues reported at a specified location
	public function getLocationIssues($location)
	{
		$this->load->database();
		$query = $this->db->query('SELECT * FROM issues where location = "'.$location.'"');
		return $query->result_array();
	}

//function to insert new employee into data base
	public function createEmployee()
	{
		$this->load->database();
		$info = $this->db->query("INSERT INTO employees (first_name, last_name, email, phone, department_id, employee_type,employee_number, password)
								values('$this->first_name', '$this->last_name', '$this->email', '$this->phone', $this->department_id,
								'$this->employee_type', '$this->employee_number', '$this->password')");
		return $info;
	}

//function to update  employee information 
	public function updateEmployee()
	{
		$this->load->database();
		$info = $this->db->query("UPDATE employees SET first_name='$this->first_name', last_name = '$this->last_name',
				email= '$this->email', phone='$this->phone', department_id=$this->department_id,
				employee_type='$this->employee_type', photo='$this->photo', password='$this->password' 
				,employee_number = '$this->employee_number'	WHERE employee_id = $this->employee_id");
		return $info;
	}

//change profile picture of employee
	public function changeProfilePhoto()
	{
		$this->load->database();
		$info = $this->db->query("UPDATE employees SET  photo='".$this->photo."' WHERE employee_id = ".$this->employee_id);
		return $info;
	}

//save new password for specific employee
	public function updatePassword()
	{
		$this->load->database();
		$info = $this->db->query("UPDATE employees SET password='$this->password' WHERE employee_id = $this->employee_id");
		return $info;
	}
	
//function to activate employee
	public function activateEmployee()
	{
		$this->load->database();
		$info = $this->db->query("UPDATE employees SET employee_status='active' WHERE employee_id = $this->employee_id");
		return $info;
	}
	
//function to give employee administrative status
	public function setAdminStatus()
	{
		$this->load->database();
		$info = $this->db->query("UPDATE employees SET employee_type='administration' WHERE employee_id = $this->employee_id");
		return $info;
	}

//function to drop  administrative status
	public function dropAdminStatus()
	{
		$this->load->database();
		$info = $this->db->query("UPDATE employees SET employee_type='staff' WHERE employee_id = $this->employee_id");
		return $info;
	}
	
//function to deactivate employee
	public function deactivateEmployee()
	{
		$this->load->database();
		$info = $this->db->query("UPDATE employees SET employee_status='inactive' WHERE employee_id = $this->employee_id");
		return $info;
	}
	
//function to delete employee
	public function deleteEmployee()
	{
		$this->load->database();
		$info = $this->db->query("DELETE FROM employees WHERE employee_id = $this->employee_id");
		return $info;
	}

//function to get department of employee
	public function getDepartment()
	{
		$this->load->database();
		$info = $this->db->query("Select department_name FROM departments WHERE department_id = ". $this->department_id);
		return $info->row_array();
	}

//function to get all departments
	public function getAllDepartments()
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM departments");
		return $query->result_array();
	}

//function to get all departments
	public function getQuote($ref)
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM quotes where ref_quote = ".$ref);
		return $query->row_array();
	}


}
