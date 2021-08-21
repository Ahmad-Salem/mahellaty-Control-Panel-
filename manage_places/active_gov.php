<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['gov_id']))
	{

	
		$gov_id=mysqli_real_escape_string($connect,$_POST['gov_id']);
		$query_gov_active="UPDATE `government` SET `activation`='1' WHERE `id`='{$gov_id}' LIMIT 1";
		$perform_query_gov_active=mysqli_query($connect,$query_gov_active);
		if($perform_query_gov_active)
		{
			//true
			echo "تم تفعيل المحافظة بنجاح";
		}else
		{
			//false
			echo "لم يتم تفعيل المحافظة";

		}
	}
?>