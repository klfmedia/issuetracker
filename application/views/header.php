	<?php 


	 if(!isset($_SESSION)){
		session_start();
	}
	 ?>
	 <!DOCTYPE html>
	<html> 
	<head>
	<title>www.issuetracker.com</title>
	 <link rel="stylesheet" href="../../assets/css/styles.css">
	 <script src="../../assets/js/myscript.js"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	   <!-- SweetAlert includes-->
	 <script src="../../assets/js/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../assets/css/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="../../assets/css/alertstyles.css">
	<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>

	<script type="text/javascript">

	$(document).ready(function(){
		$("#lstview").click(function(){
			
			$.ajax({
				  type: "POST",
				  url: 'http://localhost/issuetracker/index.php/start/lists',  		  
				}) 	
		});
	});

	$(document).ready(function(){
		$("#imgview").click(function(){
			
			$.ajax({
				  type: "POST",
				  url: 'http://localhost/issuetracker/index.php/start/icons',  		  
				}) 	
		});
	});


	</script>


	</head>
	<!-- HEADER SECTION -->
	 <body class = "bodywrap" onload="headerDisplay(); viewDisplay();"> 
	<?php 
	if(!isset($_SESSION)){
		session_start();
	}
	$direct = "staff/home";
	if(!isset($_SESSION["userid"])){
		$direct = "start/index";
	}
	?>
		  <!-- NAVIGATION BAR -->
		 <div class="subMenu" id="menu"> 
			
			<!-- logo wrapper -->
			<div class="navbar-left">
			  <a id="sTop" href="./../<?php echo $direct?>">
				<h1 class="klfLogo">
				  <span>KLF MEDIA</span>
				</h1>
			  </a>
			</div>
		  <div class="navbarTitle">
		  <h2>Issue Tracker</h2>
	  </div>
		<img class = "photo" src="../../assets/images/<?php echo $photo;?>"/>
			<!-- Collect the nav links, forms, and other content for toggling -->
			  <a id="headerProfile"  href="../staff/myprofile" class="popup" onmouseenter="viewProfilePopUp()" onmouseleave="viewProfilePopUp()"
	 style="width:40px; height:40px;float:left;margin-right:20px;margin-top:60px; float:right">
	<img  src="../../assets/images/profileicon.png" />
	 <span class="popuptext" id="viewProfile">View Profile</span>
	</a>
			  
		  <a id="headerLogOut"  class = "popup" href="./../start/logout" onclick="startView()"
		  onmouseenter="logOutPopUp()" onmouseleave="logOutPopUp()">
		   <img src="../../assets/images/logout.png?>"/>
			<span class="popuptext" style="bottom:25%; left:25%"  id="signOut"> Log Out</span>
		   </a>
		</div>
		<!-- END NAVIGATION BAR --> 
	   <!-- END HEADER SECTION -->
	   
