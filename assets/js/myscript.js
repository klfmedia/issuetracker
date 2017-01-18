
//================ used by issues.php view ========================//
//toggles between showing or hiding issues on user's page
	function viewIssues()
	{
		document.getElementById("issuesTable").style.display = "table";
	}

	function viewDisplay()
	{
		document.getElementById("currentView").value = "";
		document.getElementById("currentView").value = "";  
	}

//changes to list view
	function toggleListView() 
	{
		document.getElementById("listView").style.display = "table";
		document.getElementById("pictureView").style.display = "none";
		document.getElementById("currentView").value = "listView";
	}

//changes to icon view
	function toggleImageView() 
	{
		document.getElementById("listView").style.display = "none";
		document.getElementById("pictureView").style.display = "block";
		document.getElementById("currentView").value = "iconView";
	}
	
//* /verifies view type and displays accordingly
	/* function issuesDisplay()
	{
	   var view_type= document.getElementById("myView").value;
	   if(view_type=="listView") {
		   toggleListView() 
		}
	   else{
			toggleImageView()
		}
	} */
 

//================ used by login.php view ========================//
//clears message if user starts entering login info
	function clearMessage()
	{
		document.getElementById("message").innerHTML = "";
		document.getElementById("message2").innerHTML = "";
	}

	function adminSignIn()
	{
		document.getElementById("loginBox").style.display = "none";
		document.getElementById("adminBox").style.display = "block";
	}

	function userSignIn()
	{
		document.getElementById("loginBox").style.display ="block"; 
		document.getElementById("adminBox").style.display = "none";
	}
	
	
//================ used by newissue.php view ========================//
//Toggle between adding a new location or selecting a loca5tion that exists in database 
	function specifyIfNewLocation()
	{
		var location = document.getElementById("issueLocation").value;
		if(location == "other"){
			document.getElementById("newLocationEntry").style.display = "block";
		}
		else{
			document.getElementById("newLocationEntry").style.display = "none";
		}	
	}

//================ used by profileview.php view ========================//

//prepares form to edit administrative information of employee
	function editSecureInfo(){
		var x = document.getElementsByClassName("secureInfo");
		var y = document.getElementsByClassName("displayInfo");
		
		for (var i = 0; i < x.length; i++) {
			x[i].style.display = "block";
		}		
		for (var i = 0; i < y.length; i++) {
			y[i].style.display = "none";
		}
		document.getElementById("adminCancel").style.display = "inline";
		document.getElementById("adminSubmit").style.display = "inline";
		document.getElementById("adminEdit").style.display = "none";
		document.getElementById("btnBackToEmployees").style.display = "none";
		document.getElementById("setAdmin").style.display = "none";
		document.getElementById("adminSuspend").style.display = "none";
	}

//returns back to basic profile display and hides edit of administrative information
	function cancelSecureEdit(){
		var x = document.getElementsByClassName("secureInfo");
		var y = document.getElementsByClassName("displayInfo");
		for (var i = 0; i < x.length; i++) {
			x[i].style.display = "none";
		}		
		for (var i = 0; i < y.length; i++) {
			y[i].style.display = "block";
		}	
		document.getElementById("adminSubmit").style.display = "none";
		document.getElementById("adminEdit").style.display = "inline";
		document.getElementById("adminCancel").style.display = "none";
		document.getElementById("btnBackToEmployees").style.display = "inline";
		document.getElementById("setAdmin").style.display = "inline";
		document.getElementById("adminSuspend").style.display = "inline";	
	}


//================ used by profile.php view ========================//
//Toggle between views if user wants to change profile picture or not 
	function changeProfilePicture() {
		document.getElementById("picturebox").style.display = "block";
	}

//Toggle between views if user wants to change profile picture or not 
	function cancelPicUpload() {
		document.getElementById("picturebox").style.display = "none";
	}

//Toggle between views if user wants to change password or not 
	function editPassword() {
		document.getElementById("passwordEntry").style.display = "block";
		document.getElementById("oldPass").required = true;
		document.getElementById("newPass").required = true;	
	}

//checks if both passowrds are correct during password creation 
	function comparePasswords() {
		var pass1 = document.getElementById("newpass").value;
		var pass2 = document.getElementById("newpass2").value;
		if(pass1==pass2) {
			return true;
		}
		document.getElementById("textResponse").innerHTML = "New passwords do not match";
		return false;
	}

//prepares form to edit basic information of employee
	function editBasicInfo(){
		var x = document.getElementsByClassName("basicInfo");
		var y = document.getElementsByClassName("myInfo");
		for (var i = 0; i < x.length; i++) {
			x[i].style.display = "block";
		}		
		for (var i = 0; i < y.length; i++) {
			y[i].style.display = "none";
		}
		document.getElementById("btncancel").style.display = "inline";
		document.getElementById("btnsubmit").style.display = "inline";
		document.getElementById("btnedit").style.display = "none";
		document.getElementById("changePasswordButton").style.display = "inline";
		document.getElementById("exitProfile").style.display = "none";
	}

//returns back to basic info display and hides edit form
	function cancelEditProfile(){
		var x = document.getElementsByClassName("basicInfo");
		var y = document.getElementsByClassName("myInfo");
			for (var i = 0; i < x.length; i++) {
			x[i].style.display = "none";
		}		
		for (var i = 0; i < y.length; i++) {
			y[i].style.display = "block";
		}	
		document.getElementById("btnsubmit").style.display = "none";
		document.getElementById("btnedit").style.display = "inline";
		document.getElementById("btncancel").style.display = "none";
		document.getElementById("changePasswordButton").style.display = "none";
		document.getElementById("passwordEntry").style.display = "none";
		document.getElementById("exitProfile").style.display = "block";
		document.getElementById("oldPass").required = false;
		document.getElementById("newPass").required = false;
		clearTextResponse()
	}

//checks if old password is correct
	function checkPassword()
	{
	   var passwd = document.getElementById("oldPass").value;
	   var actual = document.getElementById("myPass").value;
		if (passwd==actual)	{
			document.getElementById("passwordEntry").style.display="table";
			document.getElementById("verifyOldPass").style.display="none";
		}
		else {
			document.getElementById("textResponse").innerHTML = "Wrong Password Entered";
			document.getElementById("oldPass").value = "";
		}
	}

//clears displayed message (if any) and input text for old password
	function clearTextResponse()
	{
		document.getElementById("textResponse").innerHTML = "";
		document.getElementById("oldPass").value = "";
	}

//clears displayed message (if any) and input text for old password
	function clearNewPasswordEntries()
	{
		document.getElementById("textResponse").innerHTML = "";
		document.getElementById("newpass").value = "";
		document.getElementById("newpass2").value = "";
	}

//cancels update of password and returns to profile
	function cancelPasswordUpdate()
	{
		document.getElementById("verifyOldPass").style.display = "block";
		document.getElementById("passwordEntry").style.display = "none";
		document.getElementById("newpassword").style.display = "none";
		document.getElementById("oldPass").value="";
		document.getElementById("newpass").value="";
		document.getElementById("newpass2").value="";
		document.getElementById("textResponse").innerHTML ="";
	}

//clickable image to upload profile pic
	$(function ()
	{
	  $("#closeButton").click(function () {
	    $("#pictureUpload").css("display", "block");
	  });
	});



//================ used by issuedetailsadmin.php view ========================//
//Toggle between views for assigning tech by administration 

	function techAssignment()
	{
		var status = document.getElementById("issuestatus").value;
		
		if(status=="rejected" || status=="resolved"){
			swal( status+" Issue", "This issue has already been "+status, "error"); 
		}
		else{
			document.getElementById("selectTech").style.display = "block";
			document.getElementById("cancelTech").style.display = "inline";
			document.getElementById("assignTech").style.display = "inline";
			document.getElementById("btnAssignTech").style.display = "none";
			document.getElementById("btnResolve").style.display = "none";
			document.getElementById("btnReject").style.display = "none";
			document.getElementById("btnBackToIssues").style.display = "none";
			chosenTech();
		}
	}

// toggles between adding new tech and assinging to existing tech
	function chosenTech()
	{
		var selected_tech = document.getElementById("techassigned").value;
		if(selected_tech =="newtech") {
			document.getElementById("addNewTech").style.display = "block";
			document.getElementById("assignTech").style.display = "none";
		}
		else {	
			document.getElementById("addNewTech").style.display = "none";
			document.getElementById("assignTech").style.display = "inline";
		}
	}
//stops process of assinging task to a technician
	function cancelAssignment()
	{
		document.getElementById("addNewTech").style.display = "none";
		document.getElementById("assignTech").style.display = "none";
		document.getElementById("cancelTech").style.display = "none";
		document.getElementById("selectTech").style.display = "none";
		document.getElementById("btnAssignTech").style.display = "inline";
		document.getElementById("btnResolve").style.display = "inline";
		document.getElementById("btnReject").style.display = "inline";
		document.getElementById("btnBackToIssues").style.display = "inline";
	}
	function cancelnewTechAssignment(){
		document.getElementById("addNewTech").style.display = "none";
		document.getElementById("assignTech").style.display = "inline";	
		document.getElementById("techassigned").value="";
	}
	  

//================ used by adminprofile.php view ========================//	  
//redirect
	
	function showEmployees()
	{
		document.getElementById("myEmployees").style.display = "block";
		document.getElementById("myTechnicians").style.display = "none";
		document.getElementById("myIssues").style.display = "none";
	}
	function showTechnicians(){
		document.getElementById("myEmployees").style.display = "none";
		document.getElementById("myTechnicians").style.display = "block";
		document.getElementById("myIssues").style.display = "none";
	}
	function showIssues(){
		document.getElementById("myEmployees").style.display = "none";
		document.getElementById("myTechnicians").style.display = "none";
		document.getElementById("myIssues").style.display = "block";
	}
	
//stops creation of a technician
	function cancelTechCreation(){
		document.getElementById("createTech").style.display = "none";
		document.getElementById("btnAddTech").style.display = "inline";
		document.getElementById("viewOnlyTable").style.display = "table";		
	}
	  
	function newTechCreation()
	{
		document.getElementById("createTech").style.display = "block";
		document.getElementById("btnAddTech").style.display = "none";
		document.getElementById("btnReturn").style.display = "none";
		var x = document.getElementsByClassName("techInput");
		for (var i = 0; i < x.length; i++) {
			x[i].value = "";
		}
		document.getElementById("viewOnlyTable").style.display = "none";
	}


	
	  
	  
	  
//================ Pop ups for icons used in all pages========================//	 
	function changeProfilePicturePopUp() 
	{
		var popup = document.getElementById('uploadPhoto');
		popup.classList.toggle('show');
	}
	function editBasicInfoPopUp() 
	{
		var popup = document.getElementById('editProfile');
		popup.classList.toggle('show');
	}
	function editSecureInfoPopUp() 
	{
		var popup = document.getElementById('modifyProfile');
		popup.classList.toggle('show');
	}
	function logOutPopUp() 
	{
		var popup = document.getElementById('signOut');
		popup.classList.toggle('show');
	}
	function listViewPopUp() 
	{
		var popup = document.getElementById('tableView');
		popup.classList.toggle('show');
	}
	function imageViewPopUp() 
	{
		var popup = document.getElementById('imageView');
		popup.classList.toggle('show');
	}	  
	function addEmployeePopUp() 
	{
		var popup = document.getElementById('addNewEmployee');
		popup.classList.toggle('show');
	}	  
	function addTechnicianPopUp() 
	{
		var popup = document.getElementById('addNewTechnician');
		popup.classList.toggle('show');
	}
	function suspendUserPopUp()
	{
		var popup = document.getElementById('suspendUser');
		popup.classList.toggle('show');
	}
	function viewProfilePopUp() 
	{
		var popup = document.getElementById('viewProfile');
		popup.classList.toggle('show');
	}
	
	function deleteIssuesPopUp() 
	{
		var popup = document.getElementById('issuesBin');
		popup.classList.toggle('show');
	}

//////////////Drop down menu functions for other actions/////////////////
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
	function showSubMenu() 
	{
		document.getElementById("myDropdown").classList.toggle("show");
	}
	function hideSubMenu() 
	{
		document.getElementById("myDropdown").classList.remove("show");
	}

// Close the dropdown if the user clicks outside of it
	window.onclick = function(event) {
	  if (!event.target.matches('.dropbtn')) {

		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
		  var openDropdown = dropdowns[i];
		  if (openDropdown.classList.contains('show')) {
			openDropdown.classList.remove('show');
		  }
		}
	  }
	}
	  
	  
	  
	  
	  