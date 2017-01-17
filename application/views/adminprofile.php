	<div class="topinfo">
		<h1 style="text-align:center; color:red; "> Welcome <?php echo ucwords($name)?></h1>
		<div class="photo">
			<img src="../../assets/images/<?php echo $photo?>"/>
		</div>
		<div class="divControls">
			<ul>  
				<li><a href="../staff/newissue" >CREATE NEW ISSUE</a></li> 
				<li><a href="../supervisor/viewtables?table=employees" >EMPLOYEES</a></li> 
				<li><a href="../supervisor/viewtables?table=issues" >ISSUES</a></li> 
				<li><a href="../supervisor/viewtables?table=technicians" >TECHNICIANS</a></li>            
			</ul>
		</div>

		<div id="myEmployee" style="display:none">
			<table>
				<tr>
					<th>Employee Number</th><th>Name</th><th>Email</th><th>Phone</th><th>Employee Type</th><th>Department</th><th>Action</th>
				</tr>
				<!-- //Loops and attaches all issues to table displayed to employee at sign in -->
				<?php

				 foreach ($employee as $worker)	{
					echo'<tr><td>'.$worker["employee_number"].'</td><td>'.$worker["first_name"]. ' '.$worker["last_name"].'</td><td>'.$worker["email"].
					'</td><td>'.$worker["phone"].'</td><td>'.$worker["employee_type"].'</td><td>'.$worker["department_name"].'</td><td>
					<a href="../Supervisor/staffdetails?id='.$worker["employee_id"].'">View Profile</a></td>
					</tr>'; 
				 }				 
				?>
			</table>
			<a href= "../supervisor/newemployee"> <input type="button" value="Add Employee"/></a>
		</div>
		<div id="myTechnician" style="text-align:center;width:80%; margin:1px auto; display:none">

			<table style="margin:3px auto;width:100%">
				<tr>
				<th>Technician Name/Company</th><th>Speciality</th><th>Phone</th><th>Action</th>
				</tr>
				<tr>
				<td>Broken chair</td><td>Mullet Room</td><td>24-5-2016</td><td><a>View Jobs</a></td>
				</tr>

				<!-- //Loops and attaches all issues to table displayed to employee at sign in -->
				<?php

				foreach ($all_techs as $tech) {
					if (isset($_GET['modifyId'])&& $_GET['modifyId']==$tech["tech_name"]){
						
						echo'<tr bgcolor="red"><td>'.$tech["tech_name"].'</td><td>'.$tech["speciality"]. '</td><td>'.$tech["phone"].'</td><td>
						<a>View Jobs |</a> <a>| Delete |</a> <a>| Modify </a> </td>
						</tr>';
					}	
					else{
							echo'<tr><td>'.$tech["tech_name"].' - '.$tech["technician_id"].'</td><td>'.$tech["speciality"]. '</td><td>'.$tech["phone"].'</td><td>
							<a>View Jobs |</a> <a>| Delete |</a> <a href="../supervisor/modifytech?techid='.$tech["technician_id"].'">| Modify </a> </td>
							</tr>';
						}
				 }
	 
				?>

			</table>

			<input id ="btnAddTech" type="button" value="Add Technician" onclick="newTechCreation()"/>



			<div id="createTech" style = "border:2px solid blue; display:none" >
				<form action="../Supervisor/newtech" method = "post">
				<table style = margin-top:5px ><tr>
					<td>Name of Technician/Company : </td><td><input type="text" name="techname"  placeholder="e.g. Videotron" required/></td>
					</tr><tr>
					<td>Speciality :</td><td> <input type="text" name="speciality"  placeholder="e.g. Telecommunications" required/></td>
					</tr><tr>
					<td>Phone Number : </td><td><input type="text" name="phone"  placeholder="e.g. 514-111-2222" required/></td>
					</tr>
				</table>
				<input type="submit" value="Submit"/>
				<input type="button" value="Cancel" onclick="cancelTechCreation()"/>
				</form>
			</div>
		</div>


		<div id="myIssue" style="display:none">
		<table>
			<tr>
			<th>Issue Name</th><th>Location</th><th>Date Reported</th><th>Status</th><th>Priotity</th><th>Description</th><th>Action</th>
			</tr>
			<tr>
			<td>Broken chair</td><td>Mullet Room</td><td>24-5-2016</td><td>Pending</td><td>Low</td><td>One leg of chair broken and presents risk</td>
			<td><a href="issue_view.php?id=$issueId">View Details</a></td>
			</tr>

			<!-- //Loops and attaches all issues to table displayed to employee at sign in -->
			<?php

			 foreach ($issues as $item)	{
				echo'<tr><td>'.$item["issue_name"].'</td><td>'.$item["location"].'</td><td>'.$item["date_reported"].
				'</td><td>'.$item["status"].'</td><td>'.$item["priority"].'</td><td>'.
				substr($item["description"],0,30).'...</td><td><a href="../staff/issuedetails?id='.$item["issue_id"].'">View Details</a></td>
				</tr>'; 
			 }

			?>
		</table>

		</div>
	</div>