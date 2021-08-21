<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['user_id']))
	{

	
		$user_id=mysqli_real_escape_string($connect,$_POST['user_id']);
		$query_user_active="UPDATE `normal_user` SET `activated`='0' WHERE `id`='{$user_id}' LIMIT 1";
		$perform_query_user_active=mysqli_query($connect,$query_user_active);
		if($perform_query_user_active)
		{
			//true
			echo "تم  إلغاءتفعيل الحساب بنجاح";
		}else
		{
			//false
			echo "حدث خطا أثناء تفعيل الحساب";

		}
	}
?>