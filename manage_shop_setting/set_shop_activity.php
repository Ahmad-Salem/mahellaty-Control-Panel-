<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['shop_id'])&&isset($_POST['shop_activity']))
	{

		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
		$shop_activity=mysqli_real_escape_string($connect,$_POST['shop_activity']);
		$query_set_shop_activity="INSERT INTO `shop_activities`(`shop_id`, `activity`) VALUES ('{$shop_id}','{$shop_activity}')";
		$perform_query_set_shop_activity=mysqli_query($connect,$query_set_shop_activity);
		if($perform_query_set_shop_activity)
		{
			//true
			echo "تم إضافة النشاط للمحل";
		}else
		{
			//false
			echo "حدث مشكلة اثناء إضافة النشاط للمحل.";

		}
	}
?>