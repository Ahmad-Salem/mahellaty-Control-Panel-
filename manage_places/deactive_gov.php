<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['gov_id']))
	{

	
		$gov_id=mysqli_real_escape_string($connect,$_POST['gov_id']);
		$query_gov_deactive="UPDATE `government` SET `activation`='0' WHERE `id`='{$gov_id}' LIMIT 1";
		$perform_query_gov_deactive=mysqli_query($connect,$query_gov_deactive);
		if($perform_query_gov_deactive)
		{
			//true
			echo "تم  إلغاءتفعيل المحافظة بنجاح";
		}else
		{
			//false
			echo "حدث خطا أثناء تفعيل المحافظة";

		}
	}
?>