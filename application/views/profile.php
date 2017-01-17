
	<a id="btnedit" onclick = "editBasicInfo()" class="popup" onmouseenter="editBasicInfoPopUp()" onmouseleave="editBasicInfoPopUp()"
	style="width:40px; height:40px;float:left; margin:50px 110px; margin-bottom:0">
		<img  src="../../assets/images/editicon.png" />
		<span class="popuptext" id="editProfile">Edit Profile</span>
	</a>

	<div class="container" style="text-align:justify;padding:0;width:95%;">

		<br/>
		<div class="profile_photo" style="float:left;border:1px solid blue;">
			<img src="../../assets/images/<?php echo $credentials['photo']?>"/>

			<a id="btnProfilePicture" class="popup" onclick = "changeProfilePicture()" onmouseenter="changeProfilePicturePopUp()" onmouseleave="changeProfilePicturePopUp()"
			 style="height:30px; width:30px;float:right;position:relative; bottom:45px; right:10px;border-radius:15px;" >
			<img id="closeButton" src="../../assets/images/photoicon.png"  style="border-radius:15px;"/>
			<span class="popuptext" id="uploadPhoto">Change Profile Picture</span>
			</a>
		</div>

		<h1 style="text-align:center; color:red; "> </h1>
		<form action="../staff/updateprofile" method="post">



		<table class="profileTable" style="margin-top:1px;"><tr>
			<td>First Name</td><td>
			  <input class="myInfo" type="text" readonly value="<?php echo ucfirst($credentials['first_name']);?>" />
			 <input class="basicInfo" style="background-color:#D8D8D8" type="text" name="firstname" value=" <?php echo ucfirst($credentials['first_name']);?>" required /></td>
			<td>Email :</td><td>

			<input class="myInfo" type="text" readonly value="<?php echo $credentials['email'];?>"  />
			<input class="basicInfo" style="background-color:#D8D8D8" type="text" name="email" value="<?php echo $credentials['email'];?>" required />

			</td>
			</tr>
			<tr>
			<td>Last Name :</td><td>

			<input class="myInfo"type="text" readonly value="<?php echo ucfirst($credentials['last_name']);?>"  />
			<input class="basicInfo" style="background-color:#D8D8D8"type="text" name="lastname" value="<?php echo ucfirst($credentials['last_name']);?>" required />
			</td>
			<td>Phone :</td><td>
			<input class="myInfo" readonly type="text" value="<?php echo $credentials['phone'];?>"  />
			<input class="basicInfo" style="background-color:#D8D8D8" type="text" name="phone" value="<?php echo $credentials['phone'];?>" required /></td>
			</tr>

			<tr>
			<td>Department :</td><td>


			<?php 
			if ($credentials['employee_type']=="administration" || $credentials['employee_type']=="boss"){
				echo'<select class="basicInfo" style="background-color:#D8D8D8"  name="department"style="width:310px">';
					foreach ($departments as $dept){
						if ($dept['department_name']==$department ) {
							echo '<option value = "'.$dept['department_id'].'" selected="selected">'.ucfirst($dept['department_name']).'</option>';
						}
						else{	
							echo '<option value = "'.$dept['department_id'].'">'.ucfirst($dept['department_name']).'</option>';
						}
					}
				echo '</select><input class="myInfo" readonly type="text" name="department" value="'.ucwords($department).'" />';
			}
			else{
				echo '<input  type="text" readonly name="department" value="'.ucwords($department).'" />';
			} 
			?>
			</td>
			<td>Employee Number :</td><td>
			<?php 
			if ($credentials['employee_type']=="administration" || $credentials['employee_type']=="boss") {
				echo'<input class="basicInfo" style="background-color:#D8D8D8" type="text" name="employee_number" value="'. $credentials["employee_number"].'" required />'.
					'<input class="myInfo" readonly type="text"  value="'. $credentials["employee_number"].'" />';
			}
			else {
				echo'<input  type="text" readonly name="employee_number" value="'. $credentials["employee_number"].'" required />';
			}
			?>
			</td></tr>
		</table>
		<br/>
		<input id="changePasswordButton" type="button" class="myButton" value="Change Password"  onclick="editPassword()"
		style="float:left; margin-left:30px; margin-top:10px;background-color:white;border:0;color:grey;text-align:left;display:none"/>
		<input type="hidden" id="myPass" name="myPass" value="<?php echo $credentials['password'];?>"/>
		<table id="passwordEntry" class="profileTable" style="margin:0;clear:both;margin-bottom:20px">
			<tr>
			<td> Old Password</td>
			<td>
			<input type="password"  style="background-color:#D8D8D8" name="oldPass" id="oldPass" placeholder="old password" onfocus="clearTextResponse()"/>

			</td>
			<td style="padding: 0 27px; "> New Password</td>
			<td>
			<input  type="password"  style="background-color:#D8D8D8" id="newPass" name="newPass" placeholder="new password" onfocus="checkPassword()"/>

			</td>
			</tr>
		</table>

		<br/><br/> <br/> <br/>
		<p id = "textResponse" style = "color:red">
		</p> 
		<input style=" clear:both;float:right;margin:10px;margin-right:70px" class="myButton" id="btnsubmit" type="submit" value="Update" />
		<input style="float:right;margin:10px" class="cancelButton" id="btncancel" type="button" value="Cancel" onclick = "cancelEditProfile()" />
		</form>
		</div>
		<div class="changePicture" style="display:none; position:relative; bottom:400px">
			<form action="../staff/uploadpicture" method="POST" enctype="multipart/form-data">
			<p style="text-align:center; color:red; ">
			<input id="changePicture" class="myButton" type="button" onclick="showUpload()"value="Change Profile Picture"  /></p>
			<p id = "pictureUpload" style="text-align:center; margin:5px;display:none">
					 <input  class="myButton" type="file" name="image" />
					 <input class="myButton" type="submit"/>
			</p>
			</form>
		</div>
		<br/>
		<a id="exitProfile" style="vertical-align:bottom;clear:both;float:right;margin:15px 120px "  href="../staff/home">
		 Back to Home Page<img style="width:25px; height:15px" src="../../assets/images/returnicon.png"/></a>
		 


		<div id="picturebox" class="popUpDiv">
		<div class="manageTech" style="text-align:center; padding:30px">
			 <h3>Change Profile Picture</h3>
			<form action="../staff/uploadpicture" method="POST" enctype="multipart/form-data">

			<p id = "pictureUpload" style="text-align:center; margin:50px auto ;">
					 <input style="border:2px ridge gray"class="" type="file" name="image" required/>
					 
			</p>
			<input style="" class="cancelButton" type="button" value="Cancel" onclick = "cancelPicUpload()" />
			<input class="myButton" type="submit" value="Upload"/>
			
			</form>
		</div>
	</div>
