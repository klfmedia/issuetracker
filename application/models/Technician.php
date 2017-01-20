<?php

class Technician extends CI_Model{

	private $technician_id;
	private $name;
	private $speciality;
	private $company;
	private $phone;
	
	
	//getters and setters for class Technician
	//technician id
	public function getTechId()
	{
		return $this->technician_id;
	}
	public function setTechId($technician_id)
	{
		$this->technician_id = $technician_id;
	}

	//Technician name or company
	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
	}
	
	//Technician speciality
	public function getSpeciality()
	{
		return $this->speciality;
	}
	public function setSpeciality($speciality)
	{
		$this->speciality = $speciality;
	}
	
	//technician id
	public function getCompany()
	{
		return $this->company;
	}
	public function setCompany($company)
	{
		$this->company = $company;
	}
	
	
	//Technician phone number
	public function getPhone()
	{
		return $this->phone;
	}
	public function setPhone($phone)
	{
		$this->phone = $phone;
	}
	
	//Constructors for class Technician
	public function __construct()
	{
		parent::__construct();
	}

	
	
//add a new technician to database
	public function addTechnician()
	{
		$this->load->database();
		$info = $this->db->query("INSERT INTO technicians (tech_name, speciality, phone,company)
				values('$this->name', '$this->speciality', '$this->phone','$this->company')");
		if($info)
		{
			$sql=$this->db->query("SELECT MAX(technician_id) as tech_id FROM technicians");
			return $sql->row_array();
		}
	}
	
//update technician information in database
	public function editTechnician()
	{
		$this->load->database();
		$info = $this->db->query("UPDATE  technicians SET tech_name = '$this->name', speciality = '$this->speciality',
				phone = '$this->phone', company = '$this->company' WHERE technician_id =". $this->technician_id);		
		return $info;
	}
	
//Delete technician information in database
	public function deleteTechnician()
	{
		$this->load->database();
		$info = $this->db->query("DELETE FROM technicians WHERE technician_id =". $this->technician_id);
		return $info;
	}
	
//get technician name from id
	public function getTechnicianName($id)
	{
		$this->load->database();
		$info = $this->db->query("SELECT * FROM technicians WHERE technician_id =". $id);
		$result=$info->row_array();
		return $result["tech_name"];
	}
	
	//get technician name from id
	public function getTechnicianJobs()
	{
		$this->load->database();
		$info = $this->db->query("SELECT issues.issue_name, issues.issue_id, location, date_assigned
				FROM issues, issue_log WHERE issues.issue_id = issue_log.issue_id
				AND technician_id =".$this->technician_id);
		return $info->result_array();
	}

}
