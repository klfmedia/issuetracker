	<div class="container" id="issueTable" style="text-align:center; padding:10px; width:95%; margin-top:0px; min-height:650px">

	<?php 
	$user=	$_SESSION["user"];
	$issueview= $_SESSION["views"];
	$filter=$_SESSION["issues"];
	if ($issueview=="listView") {
		$list_display="table";
		$icon_display="none";
	}
	else{
		$list_display="none";
		$icon_display="block";
	}
	$next_page= $page_number+1;
	$previous_page = $page_number-1;
	
	if (count($issues)>0) {
		echo'<a href="../supervisor/clearOutdatedIssues" id="emptyTrash" class="popup" 
		 style="margin:2px auto" onmouseenter="deleteIssuesPopUp()" onmouseleave="deleteIssuesPopUp()"> 
				  <img  style="float:left; width:50px; height:90%"alt="" src="../../assets/images/trashicon.jpg"/>
				 <span class="popuptext" id="issuesBin">Delete All Issues</span></a>';
				  

		echo'<div class="issueControls" >
			<ul style="float:left;">
				 <li  style="float:left">Image Log</li>
				 <li><a id="lstview" class="popup" onclick="toggleListView()" style="float:left;margin:2px" onmouseenter="listViewPopUp()" onmouseleave="listViewPopUp()"> 
					  <img  style="float:left; width:20px; height:90%"alt="" src="../../assets/images/listviewicon.jpg"/>
					  <span class="popuptext" id="tableView">List View</span></a>
				 </li> 
				  <li><a id="imgview" class="popup" onclick="toggleImageView()" style="float:left; margin:2px" onmouseenter="imageViewPopUp()" onmouseleave="imageViewPopUp()"> 
					  <img  style="float:left; width:20px; height:90%"alt="" src="../../assets/images/imageicon.jpg"/>
					  <span class="popuptext" id="imageView">Image View</span></a>
				 </li> ';
		echo'</ul></div>';

	
	
	echo '<div class ="issueBox">';

	
		echo'<div id="pictureView" style="display:'.$icon_display.'">';
		foreach ($issues as $item) {
			echo'<div style="float:left; height:250px;width:230px; border:0; margin:5px 33px; text-align:center;">
				<a href="../supervisor/outdatedissuedetails?id='.$item["issue_id"].'&&page='.$page_number.'">	
				<div style="border:1px solid #C8C8C8;text-align:center;height:210px;position:relative;border-radius:5px">
				<img id="test" style="position:absolute; top:0; left:0;" src="../../assets/images/'.$item["attachment_name"] .'" />
				<p style=" z-index: 100; position: absolute; font-weight: bold; bottom: 5px;left:30px;">
						Date reported: <span>'.$item["date_reported"].'</span><br/>
						Location: <span>'.$item["location"].'</span></p>
				</div></a>
				<span>'.$item["issue_name"].'</span><br/>
				<h6>Reported by: <span>'.ucwords($item["first_name"].' '.$item["last_name"]).'</span></h6>
				</div>';
		}
		echo'</div>';
		echo '<table id="listView" class="issuesTable" style="margin-top:5px;display:'.$list_display.'"><tr>';
		echo'<th>Issue Name</th><th>Location</th><th>Date Reported</th><th>Status</th><th>Priority</th><th>Description</th><th>Action</th></tr>';

//<!-- //Loops and attaches all issues to table displayed to employee at sign in -->
		foreach ($issues as $item) {
			if ($item["status"]=="pending") {
				echo'<tr style="font-weight:bold"><td>'.ucwords($item["issue_name"]).'</td><td>'.ucwords($item["location"]).'</td>
				<td>'.$item["date_reported"].'</td><td>'.ucwords($item["status"]).'</td><td>'.ucwords($item["priority"]).'</td><td>'.
				ucfirst(substr($item["description"],0,20)).'...</td><td>
				<a href="../supervisor/outdatedissuedetails?id='.$item["issue_id"].'&&page='.$page_number.'">View Details</a></td>
				</tr>';
			}
			else{
				echo'<tr><td>'.ucwords($item["issue_name"]).'</td><td>'.ucwords($item["location"]).'</td>
				<td>'.$item["date_reported"].'</td><td>'.ucwords($item["status"]).'</td><td>'.ucwords($item["priority"]).'</td><td>'.
						ucfirst(substr($item["description"],0,20)).'...</td><td>
				<a href="../supervisor/outdatedissuedetails?id='.$item["issue_id"].'&&page='.$page_number.'">View Details</a></td>
				</tr>';	
			}
		}
		echo'</table></div><br/>';//}
		echo'<div class="pageDiv">';
		echo'<ul class="pagination">';
		if($previous_page!=0) {
				echo'<li><a href="../supervisor/outdatedIssues?page='.$previous_page.'">&#x25C4;</a></li>';	
		}
		for ($pg =1; $pg<=$nb; $pg++) {
			if ($page_number==$pg) {
					echo'<li><a class="active" href="../supervisor/outdatedIssues?page='.$pg.'">'.$pg.'</a></li>';
			}
			else{
				echo'<li><a href="../supervisor/outdatedIssues?page='.$pg.'">'.$pg.'</a></li>';
			}
		}
		if($next_page<=$nb)	{
				echo'<li><a href="../supervisor/outdatedIssues?page='.$next_page.'">&#x25BA;</a></li>';	
		}
		echo '</div>';
	}
	else {
		echo'<h2 style="margin-top:70px">SORRY! NO OUTDATED ISSUES FOUND </h2>';
		echo '<div class ="noIssues" style="margin-top:100px">';
		echo '</div>';
	}
	?>
		<br/><br/>

	<a style="vertical-align:bottom;clear:both;float:right;margin:15px "  href="../staff/home">
		 Back to previous page<img style="width:25px; height:15px" src="../../assets/images/returnicon.png"/></a>
	</div>



	







