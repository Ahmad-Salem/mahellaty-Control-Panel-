<?php
	include_once("../../php_includes/connection_db.php");

	if($_POST['do_action']=="get_services_status")
	{
		$serices_id=mysqli_real_escape_string($connect,$_POST['serices_id']);
		
		
		if(!empty($serices_id))
		{

			$query_get_service="SELECT `id`, `service_name`, `service_status` FROM `services` WHERE `id`='{$serices_id}' ";
			$perform_get_services=mysqli_query($connect,$query_get_service);
			if($perform_get_services)
			{
				$row_service=mysqli_fetch_assoc($perform_get_services);
				$gov_info=array(
				"ser_id"=>$row_service['id'],
				"ser_name"=>$row_service['service_name'],
				"ser_status"=>$row_service['service_status']
				);

			}else
			{
				$gov_info=array(
				"ser_id"=>"null",
				"ser_name"=>"null",
				"ser_status"=>"null"
				);
			}
		}


		echo json_encode($gov_info,JSON_FORCE_OBJECT);
	}


?>