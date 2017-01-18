
<?php
	//echo $alert_message;

	if($alert=="failure"){
		echo' <script> swal("'.$alert_title.'", "'.$alert_message.'", "error"); </script>' ;
	}
	else if($alert=="success"){
			echo' <script> swal("'.$alert_title.'", "'.$alert_message.'", "success"); </script>' ;
	}		
	else if($alert=="reject"){
			echo' <script>	swal({
			title: "'.$alert_title.'",
			text: "'.$alert_message.'",
			showCancelButton: true,
			confirmButtonText: "Yes, reject it!",
			cancelButtonText: "No, cancel plx!",
			type: "warning",
			confirmButtonColor: "#DD6B55",
		}, function(){
		
			window.location.href = "../supervisor/rejectissue?issue_id='.$id.'";
		});</script>';
	}
	else if($alert=="delete_tech"){
		echo' <script>	swal({
			title: "'.$alert_title.'",
			text: "'.$alert_message.'",
			showCancelButton: true,
			confirmButtonText: "Yes, Delete!",
			cancelButtonText: "No, cancel plx!",
			type: "warning",
			confirmButtonColor: "#DD6B55",
		}, function(){

			window.location.href = "../supervisor/droptech?tech_id='.$id.'";
		});</script>';
	}
	else if($alert=="delete_staff"){
		echo' <script>	swal({
			title: "'.$alert_title.'",
			text: "'.$alert_message.'",
			showCancelButton: true,
			confirmButtonText: "Yes, Delete!",
			cancelButtonText: "No, cancel plx!",
			type: "warning",
			confirmButtonColor: "#DD6B55",
		}, function(){

			window.location.href = "../supervisor/dropStaff?id='.$id.'";
		});</script>';
	}
	else if($alert=="suspend_staff"){
		echo' <script>	swal({
			title: "'.$alert_title.'",
			text: "'.$alert_message.'",
			showCancelButton: true,
			confirmButtonText: "Yes, Suspend!",
			cancelButtonText: "No, Cancel plx!",
			type: "warning",
			confirmButtonColor: "#DD6B55",
		}, function(){

			window.location.href = "../supervisor/deactivateStaff?id='.$id.'";
		});</script>';
	}

	else if($alert=="active_staff"){
		echo' <script>	swal({
			title: "'.$alert_title.'",
			text: "'.$alert_message.'",
			showCancelButton: true,
			confirmButtonText: "Yes, Activate!",
			cancelButtonText: "No, Cancel plx!",
			type: "warning",
			confirmButtonColor: "#DD6B55",
		}, function(){

			window.location.href = "../supervisor/activateStaff?id='.$id.'";
		});</script>';
	}
	else if($alert=="setAdmin"){
		echo' <script>	swal({
			title: "'.$alert_title.'",
			text: "'.$alert_message.'",
			showCancelButton: true,
			confirmButtonText: "Yes, Assign!",
			cancelButtonText: "No, Cancel plx!",
			type: "warning",
			confirmButtonColor: "#DD6B55",
		}, function(){

			window.location.href = "../supervisor/assignAsAdmin?id='.$id.'";
		});</script>';
	}
	else if($alert=="dropAdmin"){
		echo' <script>	swal({
			title: "'.$alert_title.'",
			text: "'.$alert_message.'",
			showCancelButton: true,
			confirmButtonText: "Yes, Revoke!",
			cancelButtonText: "No, Cancel plx!",
			type: "warning",
			confirmButtonColor: "#DD6B55",
		}, function(){

			window.location.href = "../supervisor/revokeAdminStatus?id='.$id.'";
		});</script>';
	}
	else if($alert=="oldIssues"){
		echo' <script>	swal({
			title: "'.$alert_title.'",
			text: "'.$alert_message.'",
			showCancelButton: true,
			confirmButtonText: "Yes, Revoke!",
			cancelButtonText: "No, Cancel plx!",
			type: "warning",
			confirmButtonColor: "#DD6B55",
		}, function(){

			window.location.href = "../supervisor/deleteOldIssues";
		});</script>';
	}
	else if($alert=="resolved"){
			echo' <script>	swal({
			title: "'.$alert_title.'",
			text: "'.$alert_message.'",
			showCancelButton: true,
			confirmButtonText: "Yes, Close Issue!",
			cancelButtonText: "No, cancel plx!",
			type: "warning",
			confirmButtonColor: "#DD6B55",
		}, function(){
		
			window.location.href = "../supervisor/issueResolved?issue_id='.$id.'";
		});</script>';
		}
		
	else if($alert=="reassign"){
			echo' <script>	swal({
			title: "'.$alert_title.'",
			text: "'.$alert_message.'",
			showCancelButton: true,
			confirmButtonText: "Yes, Reassign Issue!",
			cancelButtonText: "No, Cancel plx!",
			type: "warning",
			confirmButtonColor: "#DD6B55",
		}, function(){
		
			window.location.href = "../supervisor/reassignIssue?issue_id='.$id.'&& tech_id='.$tech_id.'";
		});</script>';
		}
		
	else if($alert=="deleteissues"){
			echo' <script>	swal({
			title: "'.$alert_title.'",
			text: "'.$alert_message.'",
			showCancelButton: true,
			confirmButtonText: "Yes, Delete Issues!",
			cancelButtonText: "No, Cancel plx!",
			type: "warning",
			confirmButtonColor: "#DD6B55",
		}, function(){
		
			window.location.href = "../supervisor/deleteOutdatedIssues";
		});</script>';
		}
		
		
		
	?>

