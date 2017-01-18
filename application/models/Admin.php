<?php
include_once 'Employee.php';
class Admin extends Employee{
	
//Constructors for class Admin (inherits from class employee)
	public function __construct()
	{
		parent::__construct();

	}
	
//Administrative functions
//function to get all employees in company except the administration 
 public function viewAllEmployees()
	{
		$this->load->database();
		$query = $this->db->query("SELECT employees.*, department_name FROM employees, departments
				WHERE employee_type <> 'administration' AND employee_type <> 'boss' AND employee_status ='active' AND
				employees.department_id = departments.department_id" );
		return $query->result_array();
	}
	
//function to get all employees in company in batches of 5 except the administration
	public function viewEmployees($ref)
	{
		$this->load->database();
		$query = $this->db->query("SELECT employees.*, department_name FROM employees, departments
				WHERE employee_type <> 'administration'AND employee_type <> 'boss' AND employee_status ='active' AND
				employees.department_id = departments.department_id limit $ref, 5" );
		return $query->result_array();
	
	}
	
//function to get all inactive employees in company except the administration
	public function viewAllInactiveEmployees()
	{
		$this->load->database();
		$query = $this->db->query("SELECT employees.*, department_name FROM employees, departments
				WHERE employee_type <> 'administration' AND employee_status ='inactive' AND
				employees.department_id = departments.department_id" );
		return $query->result_array();
	}

//function to get all employees in company in batches of 5 except the administration
	public function viewInactiveEmployees($ref)
	{
		$this->load->database();
		$query = $this->db->query("SELECT employees.*, department_name FROM employees, departments
				WHERE employee_type <> 'administration' AND employee_status ='inactive' AND
				employees.department_id = departments.department_id limit $ref, 5" );
		return $query->result_array();
	}
	
//function to get all administrators in company
	public function viewAllAdmin()
	{
		$this->load->database();
		$query = $this->db->query("SELECT employees.*, department_name FROM employees, departments
				WHERE (employee_type = 'administration'OR employee_type ='boss') AND
				employees.department_id = departments.department_id" );
		return $query->result_array();
	
	}

//function to get all administrators in company in batches of 5
	public function viewAdmin($ref)
	{
		$this->load->database();
		$query = $this->db->query("SELECT employees.*, department_name FROM employees, departments
				WHERE (employee_type = 'administration'OR employee_type ='boss')  AND
				employees.department_id = departments.department_id limit $ref, 5" );
		return $query->result_array();
	
	}
	 
//function to get all technicians in company 
	public function getTechnicians()
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM technicians where technician_id>1");
		return $query->result_array();
	}
	
//function to get all technicians in company in batches of 5
	public function viewTechnicians($ref)
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM technicians where technician_id>1 limit $ref, 5");
		return $query->result_array();
	
	}
	
// get all issues that have been older than 3 months.
	public function getOutdatedIssues()
	{
		$cutoff_date = date("Y-m-d",strtotime('-3 months'));
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name, first_name, last_name FROM issues, issue_log, attachments,employees where
						issues.issue_id = issue_log.issue_id AND issues.issue_id = attachments.issue_id AND employees.employee_id=issues.employee_id
						AND date_reported <"'. $cutoff_date.'"');
		return $query->result_array();
	}
	
// get all issues that have been older than 3 months in batches of 8.
	public function viewOutdatedIssues($ref)
	{
		$cutoff_date = date("Y-m-d",strtotime('-3 months'));
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name, first_name, last_name FROM issues, issue_log, attachments,employees where
						issues.issue_id = issue_log.issue_id AND issues.issue_id = attachments.issue_id AND employees.employee_id=issues.employee_id
						AND date_reported <"'. $cutoff_date.'" limit '.$ref.', 8');
		return $query->result_array();
	}
//function to clear outdated issues Delete issues older than 3 months
	public function deleteOutdatedIssues()
	{
		$cutoff_date = date("Y-m-d",strtotime('-3 months'));
		$this->load->database();
		$info = $this->db->query('DELETE FROM issues WHERE issue_id IN
				( SELECT issue_id FROM issue_log where date_reported < "'.$cutoff_date.'")');
		return $info;
	}
	

}
