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
	

}
