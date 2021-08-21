<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['ad_id']))
	{

		$advertisement_activation[]=array();
		$adver_id=mysqli_real_escape_string($connect,$_POST['ad_id']);
		$query_active_advertisement="UPDATE `advertisement` SET `activated`='1' WHERE `id`='{$adver_id}' LIMIT 1";
		$perform_query_active_advertisement=mysqli_query($connect,$query_active_advertisement);
		if($perform_query_active_advertisement)
		{
			//true
			echo "تم تفعيل الاعلان بنجاح";
		}else
		{
			//false
			echo "لم يتم تفعيل المنتج";

		}
	}
?>