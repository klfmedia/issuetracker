

<!-- 	<a id="btnaduser" href= "../supervisor/newemployee" class="popup" onmouseenter="addEmployeePopUp()" onmouseleave="addEmployeePopUp()"
	style="width:40px; height:40px;float:left;margin:25px 150px;"> -->
<!-- 	<img  src="../../assets/images/addusericon.png" /> -->
<!-- 	<span class="popuptext" id="addNewEmployee">Add Employee</span> -->
<!-- 	</a> -->

<h2 style="float:left;margin-left:150px; margin-top:70px">Employees</h2>	
<a id="btnadduser" href= "../supervisor/newemployee" class="popup" onmouseenter="addEmployeePopUp()" onmouseleave="addEmployeePopUp()"
	style="width:60px; height:60px;float:right;margin:45px 1px; margin-right:150px;">
	<img src="../../assets/images/addtechicon.png" />
	 <span class="popuptext" id="addNewEmployee">Add Employee</span>
</a>
<h4 style="float:right;margin-top:80px">Add Employee </h4>
	<div class="container" id="myEmployees" style="display:block; text-align:center;">
	<div style="min-height:200px" ><br/>
	<table class="issuesTable" style="margin:1px auto;">
	<tr>
	<th>Employee Number</th><th>Name</th><th>Email</th><th>Phone</th><th>Employee Type</th><th>Department</th><th>Action</th>
	</tr>
	<!-- //Loops and attaches all issues to table displayed to employee at sign in -->
	<?php
	$next_page= $page_number+1;
	$previous_page = $page_number-1;

	foreach ($employee as $worker) {
		echo'<tr><td>'.strtoupper($worker["employee_number"]).'</td><td>'.ucwords($worker["first_name"]). ' '
		.ucwords($worker["last_name"]).'</td><td>'.$worker["email"].'</td><td>'.$worker["phone"].'</td><td>'.
		ucwords($worker["employee_type"]).'</td><td>'.ucwords($worker["department_name"]).'</td><td>
		<a href="../Supervisor/staffdetails?id='.$worker["employee_id"].'&&page='.$page_number.'">View Profile</a></td>
		</tr>';
	}
	?>
	</table></div><br/>
	<?php 
	echo'<ul class="pagination">';
	if($previous_page!=0) {
		echo'<li><a href="../supervisor/employees?page='.$previous_page.'">&#x25C4;</a></li>'; 
	}
	for ($pg =1; $pg<=$nb; $pg++){
		if ($page_number==$pg) {
			echo'<li><a class="active" href="../supervisor/employees?page='.$pg.'">'.$pg.'</a></li>';;
		}
		else{
			echo'<li><a href="../supervisor/employees?page='.$pg.'">'.$pg.'</a></li>';
		}
	}
	if($next_page<=$nb)	{
		echo'<li><a href="../supervisor/employees?page='.$next_page.'">&#x25BA;</a></li> </ul>'; 
	}
	?>
	<br/>
	
	<a  id="btnBackToEmployees" style="vertical-align:bottom;clear:both;float:right;margin:15px "  href="../staff/home">
		 Back to previous page<img style="width:25px; height:15px" src="../../assets/images/returnicon.png"/></a>

	</div>