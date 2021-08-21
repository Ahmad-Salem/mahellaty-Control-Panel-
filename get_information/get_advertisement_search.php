<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	

	if(isset($_POST['search']))
	{
		$search=mysqli_real_escape_string($connect,$_POST['search']);
		$query_advertisement_details="SELECT `id`, `advertisement_title`, `advertisement_description`, `advertisement_photo` , `government` FROM `advertisement` WHERE  `advertisement_title` LIKE '%{$search}' OR `advertisement_title` LIKE '{$search}%' OR `advertisement_title` LIKE '%{$search}%' ";
		$perform_query_advertisement_details=mysqli_query($connect,$query_advertisement_details);
		while($result_advertisement_details=mysqli_fetch_assoc($perform_query_advertisement_details))
		{
			$advertisement_id=$result_advertisement_details['id'];
			$advertisement_title=$result_advertisement_details['advertisement_title'];
			$advertisement_photo=$result_advertisement_details['advertisement_photo'];
			$advertisement_description=$result_advertisement_details['advertisement_description'];
			$advertisement_government=$result_advertisement_details['government'];
			
			


			$advertisement_details[]=array(
								"advertisement_id"=>$advertisement_id,
								"advertisement_title"=>$advertisement_title,
								"advertisement_photo"=>$advertisement_photo,
								"advertisement_description"=>$advertisement_description,
								"advertisement_government"=>$advertisement_government,								
								);	

		}
		


		echo json_encode($advertisement_details, JSON_FORCE_OBJECT);
	}

	


?>