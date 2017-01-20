

<h2 style="float:left;margin-left:260px; margin-top:70px">Technicians</h2>	
	<a id="btnaddtech" onclick="newTechCreation()" class="popup" onmouseenter="addTechnicianPopUp()" onmouseleave="addTechnicianPopUp()"
	style="width:60px; height:60px;float:right;margin:45px 1px; margin-right:260px;">
	
	<img src="../../assets/images/addtechicon.png" />
	
	 <span class="popuptext" id="addNewTechnician">Add Technician</span>

</a>
<h4 style="float:right;margin-top:80px">Add Technician </h4>
	<div  class="container"  class="issuesTable" style="text-align:center;width:80%; ">
	
	<div style="min-height:200px" >
	<table class="issuesTable" style="margin:5px auto;width:70%">
	<tr>
	<th>Name of Technician </th><th>Speciality</th><th>Company</th><th>Phone</th><th>Action</th>
	</tr>

	<!-- //Loops to display all technicians -->
	<?php
	$next_page= $page_number+1;
	$previous_page = $page_number-1;
	$tech_name; $speciality;$phone;
	foreach ($all_techs as $tech)
	{
		if (!empty($modify_id) && $modify_id==$tech["technician_id"]) {
			$tech_name=$tech["tech_name"]; $speciality=$tech["speciality"];$phone=$tech["phone"];$company=$tech["company"];
			echo'<tr style="background-color:red"><td>'.ucwords($tech["tech_name"]).'</td><td>'.ucwords($tech["speciality"]).
			'</td><td>'.ucwords($tech["company"]).
			'</td><td>'.$tech["phone"].'</td><td style="color:white"><a style="color:white">| Delete |</a> <a style="color:white">| Modify </a> </td>
		</tr>';
		}
		else{
			echo'<tr><td>'.ucwords($tech["tech_name"]).'</td><td>'.ucwords($tech["speciality"]).
			'</td><td>'.ucwords($tech["company"]).'</td><td>'.$tech["phone"].'</td><td>
			<a href="../supervisor/techjobs?techid='.$tech["technician_id"].'&&page='.$page_number.'">&nbsp; Jobs &nbsp; |</a>
			<a href="../supervisor/deletetech?techid='.$tech["technician_id"].'&&page='.$page_number.'">|&nbsp; Delete &nbsp; |</a> 
			<a href="../supervisor/modifytech?techid='.$tech["technician_id"].'&&page='.$page_number.'">| &nbsp; Modify &nbsp;</a> </td>
			</tr>';
		}

	}


	?>

	</table></div><br/>
	<?php 
	echo'<ul class="pagination">';
	if($previous_page!=0) {
		echo'<li><a href="../supervisor/technicians?page='.$previous_page.'">&#x25C4;</a></li>';
	}
	// echo $page_number;
		for ($pg =1; $pg<=$nb; $pg++) {
			if ($page_number==$pg)
			{
				echo'<li><a class="active" href="../supervisor/technicians?page='.$pg.'">'.$pg.'</a></li>';;
			}
			else{
				echo'<li><a href="../supervisor/technicians?page='.$pg.'">'.$pg.'</a></li>';
			}
		}
	    if($next_page<=$nb) {
			echo'<li><a href="../supervisor/technicians?page='.$next_page.'">&#x25BA;</a></li> </ul>';
	    }
		?>

	<br/>

	<div class = "popUpDiv" id="createTech" style = "<?php if (empty($modify_id)) {
		echo'display:none';
	}?>" ><br/><br/>
	<div  class="manageTech">
	<?php if (empty($modify_id)) {
		echo'<h2>Add Technician</h2>';
		}
		else{
			echo'<h2>Modify Technician</h2>';
		}
	?>
	<br/><br/>
	<form action="../Supervisor/managetech" method = "post">
	<table class="popUpTable" style ="" ><tr>
	<td>Name of Technician  </td><td>
	<input class="techInput" type="text" name="techname" 
	<?php if (!empty($tech_name)) {
		echo'value = "'.$tech_name.'"';
	}?>

	 placeholder="e.g. Jackie Chan" required/></td>
	</tr><tr>
	<td>Speciality :</td><td>
	 <input class="techInput" type="text" name="speciality"
	 <?php if (!empty($speciality)) {
		echo'value = "'.$speciality.'"';
	}?>
	   placeholder="e.g. Telecommunications" required/></td>
	</tr><tr>
	<td> Company: </td><td><input class="techInput" type="text" name="company" 
	<?php if (!empty($company)) {
		echo'value = "'.$company.'"';
	}?>
	 placeholder="e.g. Videotron" required/></td> 
	</tr>
	<tr>
	<td>Phone Number : </td><td><input class="techInput" type="text" name="phone" 
	<?php if (!empty($phone)) {
		echo'value = "'.$phone.'"';
	}?>
	placeholder="e.g. 514-111-2222" required
	pattern="^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$" title=" (555)-555-5555, 
				555-555-5555 or +1-555-532-3455"/></td>
	</tr>
	</table><br/><br/>
	<input  type="hidden" name= "page" value=<?php echo $page_number?>/>
	<input class="techInput" type="hidden" name= "techid" <?php if (!empty($modify_id)) {
		echo'value = "'.$modify_id.'"';
	}?>/>
	<p style="text-align:right; margin:30px 40px">
	
	<a href="../supervisor/technicians?page=<?php echo $page_number?>" >
	<input class= "cancelButton" type="button" value="Cancel" onclick="cancelTechCreation()"/></a>
	<input class= "myButton"  type="submit" value="Submit"/>
	</p>
	</form>
	</div>

	</div>
	
	
	
	
	
	
	
	
	<div class = "popUpDiv" id="techJobs" style = "<?php if (empty($tech_tasks) || $tech_tasks!="true") {
		echo'display:none';
	}?>" ><br/><br/>
	<div  class="manageTech" style="width:50%;">
	<br/><br/><h3><?php echo ucwords($tech_name);?> Jobs</h3><br/><br/>
	<table class="issuesTable" id="techJobs" style="margin:5px auto;width:85%">
	
	<tr><th>Issue Number </th><th>Issue Name</th><th>Issue Location</th><th>Date Assigned</th></tr>
	<?php 
	foreach ($tech_jobs as $tasks) {
		echo'<tr><td>  Ref#00'.$tasks["issue_id"].'</td><td>'.ucwords($tasks["issue_name"]).
			'</td><td>'.ucwords($tasks["location"]).'</td><td>'.$tasks["date_assigned"].'</td>';		
	}	
	?>	
	</table><br/><br/>
	<input  type="hidden" name= "page" value=<?php echo $page_number?>/>
	<input class="techInput" type="hidden" name= "techid" <?php if (!empty($modify_id)) {
																	echo'value = "'.$modify_id.'"';
																}?>/>
	<p style="text-align:right; margin:30px 40px">
	<a href="../supervisor/technicians?page=<?php echo $page_number?>" >
	<input class= "cancelButton" type="button" value="Return" onclick="cancelTechCreation()"/></a>
	</p>

	</div>

	</div>
	
	
	
	
	
	
	
	<a style="vertical-align:bottom;clear:both;float:right;margin:15px 140px "  href="../staff/home">
		 Back to home page<img style="width:25px; height:15px" src="../../assets/images/returnicon.png"/></a>

	</div>
