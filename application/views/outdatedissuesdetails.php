<div class="container" style="padding:1px 10px;width:95%;margin-bottom:0px;">
	
	<h2 style="float:left;position:relative; top:-30px;">Outdated Issue Details</h2>
	<h3 style="clear:both;float:left;margin:0">Issue Name: <span><?php echo ucwords($details["issue_name"]);?> </span></h3>
	<span style="float:right;margin-right:20px"> Ref #00<?php echo $issue_id ?> </span>
	<table style="clear:both;margin-top:90px ;width:100%">
		<tr>
		 <td rowspan="5" style="padding:0;width:325px;"> 
		 <div id="singlePictureDisplay" class="issueAttachments" style="float:left;">
		<?php
		
			echo '<img  src="../../assets/images/'.$issueImage.'" style="width:100%; height:100%">';
		
		$page_number=1;
		if (isset($_GET["page"])) {
			$page_number=$_GET["page"];
		}
		?>
		</div>
		 <td colspan="4">Description <br/>
		<textarea readonly style="width:100%;  resize: none; border:0"><?php echo ucfirst($details["description"])?> 
		</textarea>
		  </td>
		 </tr>
		<tr>
		<td>Location:<span><?php echo ucfirst($details["location"])?></span></td>
		<td>Date Logged: <span><?php echo $details['date_reported']?></span></td>
		<td>Assigned On:<span><?php echo $details['date_assigned']?></span></td>
		<td>Issue Closed:<span><?php echo $details['date_closed']?></span></td>
		</tr>
		<tr>
		 <td colspan="4"> Assigned To:<span>
		 <?php echo ucfirst($details["tech_name"]).' - '.ucfirst($details["speciality"]).' ('.ucfirst($details["company"]).')' ?></span></td>
		</tr>
		<tr>
		  <td colspan="4">Reported By:<span><?php echo ucwords($details["first_name"]." ".$details["last_name"])?></span></td>
			</tr><tr><td colspan="4"> 
			</td>
			
		</tr>

	</table>
	<a style="clear:both;position:relative;bottom:-100px; right:10px;float:right; " href="../supervisor/outdatedissues?page=<?php echo $page_number?>">
		 Back to previous page<img style="width:25px; height:20px" src="../../assets/images/returnicon.png"/></a>

</div>
