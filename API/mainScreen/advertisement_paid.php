<?php
	include_once("../../php_includes/connection_db.php");
	if($_POST['do_action']=="get_ads_paid")
	{

		$government=mysqli_real_escape_string($connect,$_POST['government']);
		$city=mysqli_real_escape_string($connect,$_POST['city']);
		if(!empty($government)&&!empty($city))
		{
			$query_get_ads="SELECT `id`, `advertise_photo`, `gov`, `city`, `from_date`, `to_date`, `activated` FROM `advertisement_paid` WHERE `gov`='{$government}' AND `city`='{$city}' LIMIT 15";
			$perform_query_get_ads=mysqli_query($connect,$query_get_ads);
			$adver_info_array=array();
			$adver_info=array();
			while($rows_ads=mysqli_fetch_assoc($perform_query_get_ads))
			{
				$adver_id=$rows_ads['id'];
				$adver_government=$rows_ads['gov'];
				$adver_city=$rows_ads['city'];
				$adv_image_url="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/advertisement_paid/".$rows_ads['id']."/".$rows_ads['advertise_photo'];
				$adv_activated=$rows_ads['activated'];
				$adv_from_date=$rows_ads['from_date'];
				$adv_to_date=$rows_ads['to_date'];


				$adver_info=array(
					"adver_id"=>$adver_id,
					"adver_government"=>$adver_government,
					"adver_city"=>$adver_city,
					"adver_image_url"=>$adv_image_url,
					"adv_activated"=>$adv_activated,
					"adv_from_date"=>$adv_from_date,
					"adv_to_date"=>$adv_to_date
					);
				array_push($adver_info_array,$adver_info);
			}
	
		}

		
		echo json_encode($adver_info_array,JSON_FORCE_OBJECT);

	}
?>