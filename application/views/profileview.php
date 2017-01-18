
<?php 
	

	if ($staffinfo["employee_type"]!="boss") {
		
		echo'<a id="adminEdit" onclick = "editSecureInfo()" class="popup" onmouseenter="editSecureInfoPopUp()" onmouseleave="editSecureInfoPopUp()"
			style="width:40px; height:40px;float:left;margin:25px 60px;">
			<img  src="../../assets/images/editicon.png" />
			<span class="popuptext" id="modifyProfile">Modify Profile</span>
		</a>';

		if ($staffinfo["employee_type"]!="administration") {
			echo'<a id="adminSuspend" href="../supervisor/suspendStaff?id='.$staffinfo["employee_id"].'" class="popup" onmouseenter="suspendUserPopUp()" onmouseleave="suspendUserPopUp()"style="width:30px; height:30px;float:left;margin:30px 0px;">
				<img  src="../../assets/images/suspendusericon.png" />
				<span class="popuptext" id="suspendUser">Suspend User</span>
			</a>';
		}
	}
?>
	<div class="container" style="text-align:justify;padding:0;width:95%;min-height:500px">

		<?php 
		if ($staffinfo["employee_type"]<>"administration" && $staffinfo["employee_type"]<>"boss" ) {
			echo'<a href="../supervisor/assignAdmin?id='. $staffinfo["employee_id"].
			'">  <input id="setAdmin"  type="submit" value="Assign as Administration" /></a>';
		}
		else{
			echo'<a href="../supervisor/revokeAdmin?id='. $staffinfo["employee_id"].
			'">  <input id="setAdmin"  type="submit" value="Revoke Administration Status" /></a>';
		}
		?>
		<br/>
		<div class="profile_photo" style="float:left;border:1px solid blue;">
			<img style="height:100%, width:100%" src="../../assets/images/<?php echo $staffinfo['photo']?>"/>
		</div>
		<h1 style="text-align:center; color:red; "> </h1>
		<form action="../supervisor/manageemployee" method="post">
		<input type="hidden" name="staffId" value="<?php echo $staffinfo["employee_id"]?>" />
		<table class="profileTable" style="margin-top:10px;"><tr>
			<td>First Name</td><td>
			<input type="text" readonly value="<?php echo ucfirst($staffinfo['first_name']);?> "/>
			   </td>
			<td>Department</td><td>
			<input type="text" readonly class="displayInfo" value= "<?php echo ucfirst($department)?>"/>

			<select class="secureInfo" style="background-color:#D8D8D8" name="department">

				<?php foreach ($departments as $dept){
						if ($dept['department_name']==$department ) 
						{
						echo '<option value = "'.$dept['department_id'].'" selected="selected">'.ucfirst($dept['department_name']).'</option>';
						}
						else{	
							echo '<option value = "'.$dept['department_id'].'">'.ucfirst($dept['department_name']).'</option>';}
							}
						?>
				</select>
			</td></tr>
			<tr>
			<td>Last Name</td><td>
			<input type="text" readonly value="<?php echo ucfirst($staffinfo['last_name']);?> "/>
			   </td>
			<td> Employee type</td><td>
			<input type="text" readonly class="displayInfo" value="<?php echo ucwords($staffinfo['employee_type']);?>"/>
			<input class="secureInfo" style="background-color:#D8D8D8"  type="text" name="employeeType" value="<?php echo $staffinfo['employee_type'];?>" required />
			</tr><tr>
			<td>Email :</td><td>
			<input type="text" readonly value="<?php echo $staffinfo['email'];?>"/></td>
			<td>Employee Number :</td><td>
			<input class="displayInfo" readonly type="text" value="<?php echo ucfirst($staffinfo['employee_number']);?>" />
			<input class="secureInfo" style="background-color:#D8D8D8"
			type="text" name="employeeNumber" value="<?php echo $staffinfo['employee_number'];?>" required />
			</td></tr><tr>
			<td>Phone :</td><td>
			<input type="text" readonly value="<?php echo ucfirst($staffinfo['phone']);?> "/>
			</td>
			<td><span class="secureInfo">Password :</span></td><td>
			<!--  <span class="displayInfo"><?//php echo ucfirst($staffinfo['password']);?></span>-->
			<input class="secureInfo" style="background-color:#D8D8D8" type="password" name="password" value="<?php echo $staffinfo['password'];?>" required />
			</td></tr>
		</table>
		<br/>
		<input id="changePasswordButton" type="button" class="myButton" value="Change Password"  onclick="editPassword()"
		style="float:left; margin-left:30px; margin-top:10px;background-color:white;border:0;color:grey;text-align:left;display:none"/>
		<input type="hidden" id="myPass" name="myPass" value="<?php echo $staffinfo['password'];?>"/>

		<p style="float:right;margin:5px 70px">

		<input id="adminCancel" class="cancelButton" type="button" value="Cancels" onclick="cancelSecureEdit()" />
		<input id="adminSubmit" class="myButton" type="submit" value="Update " />
		</p>
		 
		</form>	
		<?php 
		if ($staffinfo["employee_type"]<>"administration" && $staffinfo["employee_type"]<>"boss" ) {
			echo'<a id="btnBackToEmployees" style="vertical-align:bottom;clear:both;float:right;margin:25px 80px "   href="../supervisor/employees?page='.$page_number.'">
			 Back to previous page<img style="width:25px; height:15px" src="../../assets/images/returnicon.png"/></a>';
		}
		else{
			echo'<a id="btnBackToEmployees" style="vertical-align:bottom;clear:both;float:right;margin:25px 80px "   href="../supervisor/administrators">
			 Back to previous page<img style="width:25px; height:15px" src="../../assets/images/returnicon.png"/></a>';
		}
		?>
	</div>
























