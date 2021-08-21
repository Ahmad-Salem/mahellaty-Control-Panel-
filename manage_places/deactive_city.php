<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['city_id']))
	{

	
		$city_id=mysqli_real_escape_string($connect,$_POST['city_id']);
		$query_city_deactive="UPDATE `cities` SET `activation`='0' WHERE `id`='{$city_id}' LIMIT 1";
		$perform_query_city_deactive=mysqli_query($connect,$query_city_deactive);
		if($perform_query_city_deactive)
		{
			//true
			echo "تم  إلغاءتفعيل المدينه بنجاح";
		}else
		{
			//false
			echo "حدث خطا أثناء تفعيل المدينه";

		}
	}
?>