
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
	<p id= "selectTech" style="display:none" onchange="chosenTech()">
		<select  required id="techassigned" name="techassigned" 
		style="width:200px; height:50px; background-color:#D8D8D8 ;border:0;      
   		 border-radius:5px; padding-left:10px;" >
			 <option value = "">Select a Technician!</option>
			<?php
			
			 foreach ($all_techs as $tech) {
					echo '<option value = "'.$tech["technician_id"].'">'.$tech["tech_name"].'</option>';
				}
			?>
			<option value = "newtech">New Technician</option>
		</select>
		<input type="hidden" name="issue_id" value="<?php echo $details['issue_id'];?>" />
		<input type="hidden" id="issuestatus" value="<?php echo $details['status'];?>" />
		<input class= "myButton" id="assignTech" type="submit" value="Assign"/>
		<input class= "cancelButton" id="cancelTech" type="button" value="Cancel" onclick = "cancelAssignment()"/>
	</p>
	</form>


	<div  id="addNewTech" class = "popUpDiv">
		<div class = "manageTech" style="" >
			<h2>Assign New Technician</h2>
				<br/><br/>
			<form action="../Supervisor/newtechassigned" method ="post"><?php $all="true"?>
			<table class="popUpTable" style = "" ><tr>
				<td>Name of Technician : </td><td><input type="text" name="techname"  placeholder="e.g. Jack Jones" required/></td>
				</tr><tr>
				<td>Speciality :</td><td> <input  class="techInput"  type="text" name="specialization"  placeholder="e.g. Telecommunications" required/></td>
				</tr><tr>
				<td>Company : </td><td><input   class="techInput" type="text" name="company"  placeholder="e.g. Videotron" required/></td>
				</tr><tr>
				<td>Phone Number : </td><td><input type="text" name="phone"  placeholder="e.g. 514-111-2222" required
				pattern="^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$" title=" (555)-555-5555, 
				555-555-5555 or +1-555-532-3455"/></td>
				</tr>
			</table><br/><br/>
			 <input type="hidden" name="issue_id" value="<?php echo $details['issue_id'];?>" />
			 <p style="text-align:right; margin:30px 40px">
	
				<input class= "cancelButton" type="button" value="Cancel" onclick="cancelnewTechAssignment()"/>
				<input class= "myButton" type="submit" value="Assign New"/>
			</p>
			
			</form>
		</div>
	</div>

</div>