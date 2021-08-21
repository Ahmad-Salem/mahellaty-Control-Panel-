<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['shop_id']))
	{

	
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
		$query_active_shop="UPDATE `shop` SET `approve`='1' WHERE `id`='{$shop_id}' LIMIT 1";
		$perform_query_active_shop=mysqli_query($connect,$query_active_shop);
		if($perform_query_active_shop)
		{
			//true
			echo "تم تفعيل المحل بنجاح";
		}else
		{
			//false
			echo "لم يتم تفعيل المحل";

		}
	}
?>