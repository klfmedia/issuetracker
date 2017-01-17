	<div class="container" style="margin-top:5px">

		<h2>ADD NEW EMPLOYEE</h2><br/><br/>
		<!-- //Loops and attaches all issues to table displayed to employee at sign in -->
		<form action="../supervisor/saveemployee" method="post">
		<table id="newEmployeeTable"  class="profileTable" style="margin-top:5px;"><tr>
			<td>First Name :</td><td>

			 <input id="firstName" type="text" name="firstName" placeholder = "First Name" required /></td>
			 <td>Last Name :</td><td>

			<input id="lastName"type="text" name="lastName" placeholder = "Last Name"  required /></td>
			</tr>
			<tr>
			<td>Email :</td><td>

			<input id="email" type="text" name="email" placeholder = "employee email" required /></td>
			<td>Phone :</td><td>

			<input id="phone" type="text" name="phone" placeholder = "Phone Number" required /></td>
			</tr>

			<tr>
			<td>Department :</td><td>
			<select name="department">
			<?php 


			foreach ($departments as $dept){
				echo '<option value = "'.$dept['department_id'].'">'.ucfirst($dept['department_name'])."</option>";
			}
			echo '<option value = "other">Other</option>';
			?>
			</select>
			</td>
			<td>Employee Number :</td><td>
			<input id="phone" type="text" name="employeeNumber" placeholder = "Employee Number" required /></td>
			</tr>


			<tr>
			<td>Employee Type :</td><td>
			<input id="phone" type="text" name="employeeType" placeholder = "Employee Type" required /></td>
			<td>Password :</td><td>
			<input id="password" type="text" name="password" placeholder = "Password" required /></td>
			</tr>
			<tr>
			<td colspan=2 style="text-align:right">

			</td>
			<td >
			</td>

			</tr>
		</table>
		<p style="float:right; margin:20px 55px">

		 <a href="../supervisor/employees"> <input class="cancelButton" type="button" value="Cancel"/></a>
		 <input class="myButton" type="submit" value="Save" />
		 </p>
		</form>	

	</div>