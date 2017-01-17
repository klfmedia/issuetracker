
<!DOCTYPE html>
<html>
<head>
	<title>www.issuetracker.com</title>
	 <link rel="stylesheet" href="../../assets/css/styles.css">
	 	 <link rel="stylesheet" href="./../assets/css/styles.css">
	 <script src="../../assets/js/myscript.js"></script>
</head>
 <body  style="background-color:white">
		 <div class="subMenu" id="menu">
			<div class="navbar-left">
			  <a id="sTop">
				<h1 class="klfLogo">
				  <span>KLF MEDIA</span>
				</h1>
			  </a>
			</div>
			<div class="navbar-right">
			  <h2 style="color:gray">Issue Tracker </h2>
			 </div>
		</div>
	   <div><br/>

	  <div style="width:30%; margin-top:150px; height:50%; border:0; color:grey" id="loginBox">
		  <h2 style="text-align:center; color:gray; ">Login</h2><br/><br/>
		<form action="../start/login" method="post">

		 <div style="border:0; border-bottom:1px solid gray; width:350px; margin:30px auto;padding-bottom:3px;text-align:justify;">
		  <input style="border:0; width:250px; font-weight:bold" type="text" name="username" placeholder="e.g. klfaa1111" required onfocus="clearMessage()"
		  oninvalid="this.setCustomValidity('Employee number of form klfxx1111 needed')" oninput="setCustomValidity('')"></div>
		 
			<div style="border:0; border-bottom:1px solid gray; width:350px; margin:30px auto;padding-bottom:3px;text-align:justify;">
				<input style="border:0; width:250px" type="text" name="password"  placeholder="password" required oninvalid="this.setCustomValidity('Password is required')"
				oninput="setCustomValidity('')">
				 <h6 style="float:right">Forgot?</h6>
			</div>
		   
			 <div style="border:0; width:350px; margin:30px auto;padding-bottom:3px;text-align:justify;">
				<h6>Stay logged in?</h6>
			 </div><br/><br/>
		 
		 
		  <input class="myButton" type="submit" value="Login"/>

		</form>
		<p id = "message" style = "color:red">
		<?php
		 if(!empty($message)){
			echo $message;
		}
		?></p>
	</div>


	</div>
		 
	<div class="footer"> &copy; 2017 KLF Media Inc</div>
</body>
</html>
	
	