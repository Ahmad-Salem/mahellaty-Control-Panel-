<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['city_id']))
	{

	
		$city_id=mysqli_real_escape_string($connect,$_POST['city_id']);
		$query_city_active="UPDATE `cities` SET `activation`='1' WHERE `id`='{$city_id}' LIMIT 1";
		$perform_query_city_active=mysqli_query($connect,$query_city_active);
		if($perform_query_city_active)
		{
			//true
			echo "تم تفعيل المدينه بنجاح";
		}else
		{
			//false
			echo "لم يتم تفعيل المدينه";

		}
	}
?>