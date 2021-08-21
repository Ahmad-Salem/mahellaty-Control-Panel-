<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['service_id']))
	{

	
		$service_id=mysqli_real_escape_string($connect,$_POST['service_id']);
		$query_service_active="UPDATE `services` SET `service_status`='1' WHERE `id`='{$service_id}' LIMIT 1";
		$perform_query_service_active=mysqli_query($connect,$query_service_active);
		if($perform_query_service_active)
		{
			//true
			echo "تم تفعيل الخدمة بنجاح";
		}else
		{
			//false
			echo "لم يتم تفعيل الخدمة";

		}
	}
?>