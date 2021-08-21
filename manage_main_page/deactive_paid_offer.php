<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['offer_id']))
	{

		$offer_activation[]=array();
		$offer_id=mysqli_real_escape_string($connect,$_POST['offer_id']);
		$query_active_offer="UPDATE `offers` SET `main_page`='0' WHERE `id`='{$offer_id}' LIMIT 1";
		$perform_query_active_offer=mysqli_query($connect,$query_active_offer);
		if($perform_query_active_offer)
		{
			//true
			echo "تم الغاء تفعيل العرض بنجاح";
		}else
		{
			//false
			echo "حدث مشكلة اثناء تفعيل العرض.";

		}

		
	}
?>