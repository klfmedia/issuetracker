


	<a id="btnaddtech" onclick="newTechCreation()" class="popup" onmouseenter="addTechnicianPopUp()" onmouseleave="addTechnicianPopUp()"
	style="width:40px; height:40px;float:left;margin:45px 280px;">
	<img  src="../../assets/images/addtechicon.png" />
	 <span class="popuptext" id="addNewTechnician">Add Technician</span>
	</a>


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
			<a href="../supervisor/deletetech?techid='.$tech["technician_id"].'&&page='.$page_number.'">&nbsp; Delete &nbsp; |</a> 
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
	placeholder="e.g. 514-111-2222" required/></td>
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
	<a style="vertical-align:bottom;clear:both;float:right;margin:15px "  href="../staff/home">
		 Back to home page<img style="width:25px; height:15px" src="../../assets/images/returnicon.png"/></a>

	</div>
