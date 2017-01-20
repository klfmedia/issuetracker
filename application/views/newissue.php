	<div class="popUpDiv" style="height:100%">
		<div class="manageTech" style="background-color:#D8D8D8 ;">
			<h3 style="text-align:center; margin:20px; "> NEW ISSUE </h3>
			<form action="../staff/saveIssue" method ='post' enctype="multipart/form-data">
			<table id="newIssueTable"  style="margin:35px auto;"><tr>
				<td>Issue Name</td><td><input  type="text" name="issuename"  placeholder="issue name" required/></td>
				</tr>

				<tr><td>
				Priority</td><td>
				<select name = "priority" required>
					<option value = "">Select Issue Priority</option>
					<option value = "low">Low</option>
					<option value = "medium">Medium</option>
					<option value = "high">High</option>
					<option value = "urgent">Urgent</option>
				</select>

				</td>
				</tr>



				<tr><td>Location </td><td>
				<select 
					 id= "issueLocation" name="issueLocation" onchange = "specifyIfNewLocation()" required>
					 <option value = "">Select Issue Location</option>
				<?php 

				foreach ($locations as $location){
					echo '<option value = "'.$location['location'].'">'.$location['location']."</option>";
				}
				echo '<option value = "other">Other</option>';

				?>
				</select>
				<p id = "newLocationEntry" style="display:none; margin-left:50px;margin-top:5px;">Specify
				<input  type="text" name="newLocation"  style="width:250px" placeholder="enter location" />
				</p>
				</td>

				</tr>
				<tr><td>
				Attachments</td><td>
				 <input type="file" name="attachment" />
				</td> </tr><tr><td style="vertical-align:top;">
				Description
				</td>
				<td >

				<textarea placeholder="Describe your issue here..."
				 style=" resize:none; width:360px; height:150px;margin-left:40px;border:0" name="description" rows="5" cols="40" required></textarea>
				</td>
				</tr>
			</table>
			<p style="text-align:right; margin:10px 35px;">
			<a href="../staff/home" > <input class="cancelButton" type="button" value="Cancel"  />
			</a><input class="popButton"  type="submit" value="Save Issue"  /></p>
			</form>
		</div>
	</div>

