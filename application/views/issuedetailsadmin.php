
<div  id = "adminActions" style="text-align:center; clear:right;">
	<a href="../supervisor/activeissue?act=reject&&issue_id=<?php echo $details['issue_id'];?>">
		<input id="btnReject" class= "myButton" type="button" value="Reject" style="float:right"/>
	</a>
	<input class= "myButton" id="btnAssignTech" type="button" value="Assign" style="float:right" onclick="techAssignment()"/>
	<a href="../supervisor/activeissue?act=resolve&&issue_id=<?php echo $details['issue_id'];?>">
		<input id="btnResolve" class= "myButton"  type="button" value="Resolved" style="float:right"/>
	</a>
	<br/><br/>

	<form action="../Supervisor/assignissue" method = "get">
	<p id= "selectTech" style="display:none" onchange="chosenTech()"> Select Technician :
		<select id="techassigned" name="techassigned">
			<?php
			 foreach ($all_techs as $tech) {
					echo '<option value = "'.$tech["technician_id"].'">'.$tech["tech_name"].'</option>';
				}
			?>
			<option value = "newtech">New Technician</option>
		</select>
		<input type="hidden" name="issue_id" value="<?php echo $details['issue_id'];?>" />
		<input class= "myButton" id="assignTech" type="submit" value="Assign"/>
		<input class= "cancelButton" id="cancelTech" type="button" value="Cancel" onclick = "cancelAssignment()"/>
	</p>
	</form>


	<div  id="addNewTech" class = "popUpDiv">
		<div class = "manageTech" >
			<h2>Add Technician</h2>
			<form action="../Supervisor/newtechassigned" method = "get"><?php $all="true"?>
			<table class="popUpTable" style = margin-top:5px ><tr>
				<td>Name of Technician/Company : </td><td><input type="text" name="techname"  placeholder="e.g. Jack Jones" required/></td>
				</tr><tr>
				<td>Speciality :</td><td> <input type="text" name="specialization"  placeholder="e.g. Telecommunications" required/></td>
				</tr><tr>
				<td>Company : </td><td><input type="text" name="phone"  placeholder="e.g. Videotron" required/></td>
				</tr><tr>
				<td>Phone Number : </td><td><input type="text" name="phone"  placeholder="e.g. 514-111-2222" required/></td>
				</tr>
			</table>
			 <input type="hidden" name="issue_id" value="<?php echo $details['issue_id'];?>" />
			<input class= "myButton" type="submit" value="Assign New Technician"/>
			</form>
		</div>
	</div>

</div>