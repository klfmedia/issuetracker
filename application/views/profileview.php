
<?php 
	

// 	if ($staffinfo["employee_type"]!="boss") {
		
// 		echo'<a id="adminEdit" onclick = "editSecureInfo()" class="popup" onmouseenter="editSecureInfoPopUp()" onmouseleave="editSecureInfoPopUp()"
// 			style="width:40px; height:40px;float:left;margin:25px 60px;">
// 			<img  src="../../assets/images/editicon.png" />
// 			<span class="popuptext" id="modifyProfile">Modify Profile</span>
// 		</a>';

// 		if ($staffinfo["employee_type"]!="administration") {
// 			echo'<a id="adminSuspend" href="../supervisor/suspendStaff?id='.$staffinfo["employee_id"].'" class="popup" onmouseenter="suspendUserPopUp()" onmouseleave="suspendUserPopUp()"style="width:30px; height:30px;float:left;margin:30px 0px;">
// 				<img  src="../../assets/images/suspendusericon.png" />
// 				<span class="popuptext" id="suspendUser">Suspend User</span>
// 			</a>';
// 		}
// 	}
?>	<h2 style="float:left;margin:10px 35px; margin-top:40px">Employee Details</h2>
	<div class="container" style="text-align:justify;padding:0;width:95%;min-height:500px">


		<?php 
		if ($staffinfo["employee_type"]!="boss") {
			if ($staffinfo["employee_type"]<>"administration") {
				echo'<a href="../supervisor/assignAdmin?id='. $staffinfo["employee_id"].
				'">  <input id="setAdmin"  type="submit" value="Assign as Administration" /></a>';
			}
			else{
					echo'<a href="../supervisor/revokeAdmin?id='. $staffinfo["employee_id"].
					'">  <input id="setAdmin"  type="submit" value="Revoke Admin Status" /></a>';
			}
		}
		?>
		<br/>
		<div class="profile_photo" style="float:left;">
			<img style="height:100%, width:100%" src="../../assets/images/<?php echo $staffinfo['photo']?>"/>
		</div>
		<h1 style="text-align:center; color:red; "> </h1>
		<form action="../supervisor/manageemployee" method="post">
		<input type="hidden" name="staffId" value="<?php echo $staffinfo["employee_id"]?>" />
		<input type="hidden" name="page" value="<?php echo $page_number?>" />
		<table class="profileTable" style="margin-top:10px;"><tr>
			<td>First Name</td><td>
			<input type="text" readonly value="<?php echo ucfirst($staffinfo['first_name']);?> "/>
			   </td>
			<td>Department</td><td>
			<input type="text" readonly class="displayInfo" id="myInfoDept" value= "<?php echo ucfirst($department)?>"/>

			<select class="secureInfo" id="inputDept" style="background-color:#D8D8D8" name="department">

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
				<a id="editDept" onclick = "editDeptField()"  class="editField"  style="float:left;">
				<img  src="../../assets/images/iconedit.png" /></a>
			</td></tr>
			<tr>
			<td>Last Name</td><td>
			<input type="text" readonly value="<?php echo ucfirst($staffinfo['last_name']);?> "/>
			   </td>
			<td> Employee type</td><td>
			<input type="text" readonly class="displayInfo" id="myInfoEmpType" value="<?php echo ucwords($staffinfo['employee_type']);?>"/>
			<input class="secureInfo"   id="inputEmpType" style="background-color:#D8D8D8"  type="text" name="employeeType" value="<?php echo $staffinfo['employee_type'];?>" required />
			<a id="editEmpType" onclick = "editEmpTypeField()"  class="editField"  style="float:left;">
				<img  src="../../assets/images/iconedit.png" /></a>
			</tr><tr>
			<td>Email :</td><td>
			<input type="text" readonly value="<?php echo $staffinfo['email'];?>"/></td>
			<td>Employee Number :</td><td>
			<input class="displayInfo" id="myInfoEmpNbr"  readonly type="text" value="<?php echo ucfirst($staffinfo['employee_number']);?>" />
			<input class="secureInfo" id="inputEmpNbr" style="background-color:#D8D8D8"
			type="text" name="employeeNumber" value="<?php echo $staffinfo['employee_number'];?>" required />
			<a id="editEmpNbr" onclick = "editEmpNbrField()"  class="editField"  style="float:left;">
				<img  src="../../assets/images/iconedit.png" /></a>
			</td></tr><tr>
			<td>Phone :</td><td>
			<input type="text" readonly value="<?php echo ucfirst($staffinfo['phone']);?> "/>
			</td>
			<td>Password :</td><td>
			<input class="displayInfo"  id="myInfoPass" type="text" readonly value="**********"/>
			<input class="secureInfo" id="inputPass" style="background-color:#D8D8D8" type="password" name="password" value="<?php echo $staffinfo['password'];?>" required />
			<a id="editPass" onclick="editPassField()"  class="editField"  style="float:left;">
				<img  src="../../assets/images/iconedit.png" /></a>
			</td></tr>
		</table>
		
		<br/>
		<input id="changePasswordButton" type="button" class="myButton" value="Change Password"  onclick="editPassword()"
		style="float:left; margin-left:30px; margin-top:10px;background-color:white;border:0;color:grey;text-align:left;display:none"/>
		<input type="hidden" id="myPass" name="myPass" value="<?php echo $staffinfo['password'];?>"/>

		
		<p style="float:right;margin:5px 70px">

		<input id="adminCancel" class="cancelButton" type="button" value="Cancel" onclick="cancelSecureEdit()" />
		<input id="adminSubmit" class="myButton" type="submit" value="Update " />
		</p>
		 
		</form>
	<!-- 	<p style="clear:both;text-align:center;">
		<input id="admiCanel" class="myButton" type="button" value="Edit" onclick = "editSecureInfo()"
		style="background: url(../../assets/images/iconedit.png) no-repeat;
		background-position:right; background-size:30px; background-color:green;" />
		<input id="admiCanel" class="cancelButton" type="button" value="Suspend" onclick="cancelSecureEdit()"
		style="background: url(../../assets/images/suspendicon.png) no-repeat;
		background-position:right; background-size:30px; background-color:#ff6666;"/>
		</p> -->
		
		<?php 
	
		echo'<p style="clear:both;text-align:center;">';
		if ($staffinfo["employee_type"]!="boss") {
			
			echo'<a id="adminEdit" onclick = "editSecureInfo()" class="popup" onmouseenter="editSecureInfoPopUp()" onmouseleave="editSecureInfoPopUp()"
				style="height:40px;margin:25px 50px;">
				<input class="myButton" type="button" value="Edit" onclick = "editSecureInfo()"
				style="background: url(../../assets/images/iconedit.png) no-repeat;
				background-position:right; background-size:30px; background-color:green;" />
				<span class="popuptext" id="modifyProfile">Modify Profile</span>
			</a>';
	
			if ($staffinfo["employee_type"]!="administration") {
				echo'<a id="adminSuspend" href="../supervisor/suspendStaff?id='.$staffinfo["employee_id"].'" class="popup" onmouseenter="suspendUserPopUp()" 
					onmouseleave="suspendUserPopUp()"style=" height:40px;margin:25px 50px;">
					<input  class="cancelButton" type="button" value="Suspend" onclick="cancelSecureEdit()"
					style="background: url(../../assets/images/suspendicon.png) no-repeat;
					background-position:right; background-size:30px; background-color:#ff6666;"/>
					<span class="popuptext" id="suspendUser">Suspend User</span>
				</a>';
			}
		}

		
		echo'</p>';
		
		
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
























