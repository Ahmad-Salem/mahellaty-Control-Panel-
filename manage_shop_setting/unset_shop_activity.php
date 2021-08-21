<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['shop_id'])&&isset($_POST['shop_activity']))
	{

		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
		$shop_activity=mysqli_real_escape_string($connect,$_POST['shop_activity']);
		$query_unset_shop_activity="DELETE FROM `shop_activities` WHERE `shop_id`='{$shop_id}' AND `activity`='{$shop_activity}' LIMIT 1";
		$perform_query_unset_shop_activity=mysqli_query($connect,$query_unset_shop_activity);
		if($perform_query_unset_shop_activity)
		{
			//true
			echo "تم خذف نشاط المحل بنجاح";
		}else
		{
			//false
			echo "حدث مشكلة أثناء حذف نشاط المحل.";

		}
	}
?>