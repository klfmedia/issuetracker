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
	$colorMine=$colorAssigned=$colorClosed=$colorOpen=$colorAll="transparent";
	if ($search=="mine") {
		$colorMine="#C0C0C0";
	}
	elseif ($search=="assigned") {
		$colorAssigned="#C0C0C0";
	}
	elseif ($search=="closed") {
		$colorClosed="#C0C0C0";
	}
	elseif ($search=="open") {
		$colorOpen="#C0C0C0";
	}
	elseif ($search=="all") {
		$colorAll="#C0C0C0";
	}
	?>


	<div class="issueControls" >
		<ul style="float:left;">
			 <li  style="float:left">Image Log</li>
			 <li><a id="lstview" class="popup" onclick="toggleListView()" style="float:left;margin:2px" onmouseenter="listViewPopUp()" onmouseleave="listViewPopUp()"> 
				  <img  style="float:left; width:20px; height:90%"alt="" src="../../assets/images/listviewicon.jpg"/>
				  <span class="popuptext" id="tableView">List View</span></a>
			 </li> 
			  <li><a id="imgview" class="popup" onclick="toggleImageView()" style="float:left; margin:2px" onmouseenter="imageViewPopUp()" onmouseleave="imageViewPopUp()"> 
				  <img  style="float:left; width:20px; height:90%"alt="" src="../../assets/images/imageicon.jpg"/>
				  <span class="popuptext" id="imageView">Image View</span></a>
			 </li> 
	<?php 
	if ($user!="administration" && $user!="boss") {
		echo'<li><a class="issueHeader" style="background-color:'. $colorMine.'" href="../staff/issues?all=false" >My Issues</a></li>';
	}
	?>
			 <li><a class="issueHeader" style="background-color:<?php echo $colorAssigned?>" href="../supervisor/search?search=assigned" >Assigned</a></li>
			 <li><a class="issueHeader" style="background-color:<?php echo $colorClosed?>" href="../supervisor/search?search=closed"  >Closed</a></li> 
			 <li><a class="issueHeader" style="background-color:<?php echo $colorOpen?>" href="../supervisor/search?search=open" >Open</a></li>   
			 <li><a class="issueHeader" style="background-color:<?php echo $colorAll?>" href="../supervisor/issues" >All</a></li>                  
			
		</ul>
	</div> 

	<?php 
	$all="true";
	if (isset($_GET['all'])) {
		$all=$_GET['all'];
	}
	if ($_SESSION["user"]=="administration" || $_SESSION["user"]=="boss") {
		$all="true";
	}

	echo '<div class ="issueBox">';

	if (count($issues)>0) {
		echo'<div id="pictureView" style="display:'.$icon_display.'; font-family:Times New Roman, Times, serif;">';
		foreach ($issues as $item) {
			echo'<div style="float:left; height:250px;width:230px; border:0; margin:5px 33px; text-align:center;">
				<a href="../staff/issuedetails?id='.$item["issue_id"].'&&all='.$all.'&&page='.$page_number.'">	
				<div style="border:1px solid #C8C8C8;text-align:center;height:210px;position:relative;border-radius:5px">
				<img id="test" style="position:absolute; top:0; left:0;" src="../../assets/images/'.$item["attachment_name"] .'" />
				<p style=" z-index: 100; position: absolute; font-weight: bold; bottom: 5px;left:30px;">
						Date reported: <span>'.$item["date_reported"].'</span><br/>
						Location: <span>'.ucfirst($item["location"]).'</span></p>
				</div></a>
				<span>'.ucwords($item["issue_name"]).'</span><br/>
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
				<a href="../staff/issuedetails?id='.$item["issue_id"].'&&all='.$all.'&&page='.$page_number.'">View Details</a></td>
				</tr>';
			}
			else{
				echo'<tr><td>'.ucwords($item["issue_name"]).'</td><td>'.ucwords($item["location"]).'</td>
				<td>'.$item["date_reported"].'</td><td>'.ucwords($item["status"]).'</td><td>'.ucwords($item["priority"]).'</td><td>'.
						ucfirst(substr($item["description"],0,20)).'...</td><td>
				<a href="../staff/issuedetails?id='.$item["issue_id"].'&&all='.$all.'&&page='.$page_number.'">View Details</a></td>
				</tr>';	
			}
		}
		echo'</table></div><br/>';//}
		echo'<div class="pageDiv">';
		echo'<ul class="pagination">';
		if($previous_page!=0)
		{
			if($filter!="all"){
				echo'<li><a href="../supervisor/search?page='.$previous_page.'&&all='.$all.'&&search='.$filter.'">&#x25C4;</a></li>';
			}
			else{
				echo'<li><a href="../staff/issues?page='.$previous_page.'&&all='.$all.'">&#x25C4;</a></li>';
			}		
		}
		for ($pg =1; $pg<=$nb; $pg++) {
			if ($filter!="all") {
				if ($page_number==$pg) {
					echo'<li><a class="active" href="../supervisor/search?page='.
					$pg.'&&all='.$all.'&&search='.$filter.'">'.$pg.'</a></li>';
				}
				else{
					echo'<li><a href="../supervisor/search?page='.$pg.'&&all='.$all.'&&search='.$filter.'">'.$pg.'</a></li>';
				}
			}
			else{
				if ($page_number==$pg) {
						echo'<li><a class="active" href="../staff/issues?page='.$pg.'&&all='.$all.'">'.$pg.'</a></li>';
				}
				else{
					echo'<li><a href="../staff/issues?page='.$pg.'&&all='.$all.'">'.$pg.'</a></li>';
				}
			}
		}
		if($next_page<=$nb)	{
			if($filter!="all"){
				echo'<li><a href="../supervisor/search?page='.$next_page.'&&all='.$all.'&&search='.$filter.'">&#x25BA;</a></li>';
			}
			else{
				echo'<li><a href="../staff/issues?page='.$next_page.'&&all='.$all.'">&#x25BA;</a></li>';
			}		
		}
		echo '</div>';
	}
	else {
		echo'<h2>SORRY! NO ISSUES REPORTED</h2>';
		echo '<div class ="noIssues">';
		echo '</div>';
	}
	?>
		<br/><br/>

	<a style="vertical-align:bottom;clear:both;float:right;margin:15px "  href="../staff/home">
		 Back to issues page<img style="width:25px; height:15px" src="../../assets/images/returnicon.png"/></a>
	</div>













