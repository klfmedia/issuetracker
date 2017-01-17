<?php
class Issue extends CI_Model{
	
	//properties of class issues
	private $issue_id;
	private $issue_name;
	private $location;
	private $description;
	private $employee_id;
	private $status;
	private $priority;
	//private $date_reported;

	//getters and setters for class employee
	//issue id
	public function getIssueId()
	{
		return $this->issue_id;
	}
	public function setIssueId($issue_id)
	{
		$this->issue_id = $issue_id;
	}

	//issue name
	public function getIssueName()
	{
		return $this->issue_name;
	}
	public function setIssueName($issue_name)
	{
		$this->issue_name = $issue_name;
	}
	
	//issue location
	public function getLocation()
	{
		return $this->location;
	}
	public function setLocation($location)
	{
		$this->location = $location;
	}
	
	//issue description
	public function getDescription()
	{
		return $this->description;
	}
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	//employee id
	public function getEmployeeId()
	{
		return $this->employee_id;
	}
	public function setEmployeeId($employee_id)
	{
		$this->employee_id = $employee_id;
	}
	
	//issue status
	public function getStatus()
	{
		return $this->status;
	}
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	//issue priority
	public function getPriority()
	{
		return $this->priority;
	}
	public function setPriority($priority)
	{
		$this->priority = $priority;
	}
	

//Constructors of class issues
	public function __construct()
	{
		parent::__construct();
	}

//Functions of Class Issues
// get all issues that have been reported to display when employee signs in.
	public function getIssues()
	{		
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name FROM issues, issue_log, attachments where 
									issues.issue_id = issue_log.issue_id AND issues.issue_id = attachments.issue_id');
		return $query->result_array();
	}
	
// get all  issues that have been reported by their status.
	public function getIssuesByStatus()
	{
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name, first_name, last_name 
									FROM issues, issue_log, attachments,employees where	issues.issue_id = issue_log.issue_id AND 
									issues.issue_id = attachments.issue_id AND issues.employee_id = employees.employee_id AND status = "'.$this->status.'"');
		return $query->result_array();
	}
	
// get all  issues that have been reported by their status.
	public function viewIssuesByStatus($ref)
	{
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name, first_name, last_name 
				FROM issues, issue_log, attachments, employees where issues.issue_id = issue_log.issue_id AND issues.issue_id = attachments.issue_id
				AND issues.employee_id = employees.employee_id	AND status = "'.$this->status.'" limit '.$ref.', 8');
		return $query->result_array();
	}
	
// get open  issues (pending issues and assigned issues)
	public function getOpenIssues()
	{
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name, first_name, last_name
									FROM issues, issue_log, attachments, employees where issues.issue_id = issue_log.issue_id AND 
									issues.issue_id = attachments.issue_id 	AND issues.employee_id = employees.employee_id AND (status = "pending" OR status="in progress")');
		return $query->result_array();
	}
	
// view max 8 issues per page
	public function viewOpenIssues($ref)
	{
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name, first_name, last_name
									FROM issues, issue_log, attachments, employees where issues.issue_id = issue_log.issue_id AND issues.issue_id = attachments.issue_id 
									AND issues.employee_id = employees.employee_id	AND (status = "pending" OR status="in progress") limit '.$ref.', 8');
		return $query->result_array();
	}
	
	
// get closed  issues (resolved issues and rejected issues)
	public function getClosedIssues()
	{
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name, first_name, last_name
									FROM issues, issue_log, attachments, employees where issues.issue_id = issue_log.issue_id AND issues.issue_id = attachments.issue_id 
									AND issues.employee_id = employees.employee_id	AND (status = "rejected" OR status="resolved")');
		return $query->result_array();
	}
	
// view max 8 issues per page
	public function viewClosedIssues($ref)
	{
		$this->load->database();
		$query = $this->db->query('SELECT issues.*, date_reported, attachment_name, first_name, last_name
							FROM issues, issue_log, attachments, employees where issues.issue_id = issue_log.issue_id AND issues.issue_id = attachments.issue_id
							AND issues.employee_id = employees.employee_id	AND (status = "rejected" OR status="resolved") limit '.$ref.', 8');
		return $query->result_array();
	}
	
// get issues that have been reported according to their priority
	public function getIssuesByPriority($priority)
	{
		$this->load->database();
		$query = $this->db->query('SELECT * FROM issues WHERE priority = "'.$priority.'"');
		return $query->result_array();
	}	
	
// get attachments belonging to a specific issue
	public function getIssueAttachments()
	{
		$this->load->database();
		$query = $this->db->query('SELECT * FROM attachments WHERE issue_id = '.$this->issue_id);
		foreach ($query->result() as $row){
		
			return $row->attachment_name;;
		}
		
	}
		
	
//get all the details of a particular reported issue with known id
	public function getIssueById($id)
	{
		$this->load->database();
		$query = $this->db->query('SELECT * FROM issues where issue_id ='.$id);
		$one_issue = new Issue();
		foreach ($query->result() as $row) {
			$one_issue->issue_id = $row->issue_id;
			$one_issue->issue_name = $row->issue_name;
			$one_issue->location = $row->location;
			$one_issue->description = $row->description;
			$one_issue->description = $row->description;
			$one_issue->employee_id = $row->employee_id;
			$one_issue->priority = $row->priority;
		}
		return $one_issue;
	}

//insert attachments concerning reported issue in database if any is present.
	public function uploadFile($filename)
	{
		$this->load->database();
		$info = $this->db->query("INSERT INTO attachments (attachment_name, issue_id) values('$filename', $this->issue_id)");
		return $info;
	}
	
//function to insert new issue into data base
	public function createIssue()
	{
		$this->load->database();
		$info = $this->db->query("INSERT INTO issues (issue_name, location, description, employee_id, priority)
								values('$this->issue_name', '$this->location', '$this->description', $this->employee_id, '$this->priority')");
		if($info) {
			$sql=$this->db->query("SELECT MAX(issue_id) as id FROM issues");
			return $sql->row_array();
		}
	}

//function create issuelog for 
	public function createIssueLog($issue_id)
	{
		$current_date = date("Y-m-d");
		$info = $this->db->query("INSERT INTO issue_log (issue_id, date_reported  ) values($issue_id, '$current_date')");
		return $info;
	}	

//function to get all the details of a specific issue;
	public function getIssueDetails()
	{
		$this->load->database();
		$query = $this->db->query("SELECT issues.issue_id, issue_name, date_reported, location, status, priority, description, 
									date_assigned, date_closed,	first_name, last_name, tech_name, speciality, company 
									FROM issues, issue_log, employees, technicians
									WHERE  issues.issue_id = $this->issue_id AND issues.employee_id = employees.employee_id
									AND issues.issue_id = issue_log.issue_id AND issue_log.technician_id = technicians.technician_id");
		return $query->row_array(); 
	}
	//function to get all the status of a specific issue;
	public function getIssueStatus()
	{
		$this->load->database();
		$query = $this->db->query("SELECT status FROM issues WHERE  issues.issue_id = $this->issue_id");
		return $query->row_array();
	}
	
	
//function to reject issue 
	public function rejectCurrentIssue()
	{
		$this->load->database();
		$info = $this->db->query("UPDATE issues SET status = 'rejected' WHERE issue_id = ".$this->issue_id);
		$current_date = date("Y-m-d");
		$this->db->query("UPDATE issue_log SET date_closed='".$current_date."' WHERE issue_id = ".$this->issue_id);
		return $info;
	}
		
//function to assign issue to technician
	public function assignCurrentIssue($tech_id)
	{
		$this->load->database();
		$info = $this->db->query("UPDATE issues SET status = 'in progress' WHERE issue_id = ".$this->issue_id);
		$current_date = date("Y-m-d");
		$this->db->query('UPDATE issue_log SET date_assigned="'.$current_date.'", technician_id = '.$tech_id.
							' WHERE issue_id = '.$this->issue_id);
		return $info;
	}
	
//function to mark issue as resolved / completed
	public function currentIssueResolved()
	{
		$this->load->database();
		$info = $this->db->query("UPDATE issues SET status = 'resolved' WHERE issue_id = ".$this->issue_id);
		$current_date = date("Y-m-d");
		$this->db->query("UPDATE issue_log SET date_closed='".$current_date."'WHERE issue_id = ".$this->issue_id);
		return $info;
	}

//Delete issues older than 3 months
	public function deleteOutdatedIssues()
	{
		$cutoff_date = date("Y-m-d",strtotime('-3 months'));
		$this->load->database();
		$info = $this->db->query("DELETE FROM issue_log, issues WHERE issues.issue_id = issue_log.issue_id
				AND date_reported < $cutoff_date");
		return $info;
	}
	
	
	
	
	
	
	
}