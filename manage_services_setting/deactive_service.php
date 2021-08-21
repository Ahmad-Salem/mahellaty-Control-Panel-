<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['service_id']))
	{

	
		$service_id=mysqli_real_escape_string($connect,$_POST['service_id']);
		$query_service_deactive="UPDATE `services` SET `service_status`='0' WHERE `id`='{$service_id}' LIMIT 1";
		$perform_query_service_deactive=mysqli_query($connect,$query_service_deactive);
		if($perform_query_service_deactive)
		{
			//true
			echo "تم  إلغاءتفعيل الخدمة بنجاح";
		}else
		{
			//false
			echo "حدث خطا أثناء تفعيل الخدمة";

		}
	}
?>