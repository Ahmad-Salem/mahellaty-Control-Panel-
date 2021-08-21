<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	include_once("../php_includes/deletedir.php");
	include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
	if(isset($_POST['advetisement_no']))
	{
		$advertisement_id=mysqli_real_escape_string($connect,$_POST['advetisement_no']);
		
		$query_delete_addvertisement="DELETE FROM `advertisement` WHERE `id`='{$advertisement_id}' LIMIT 1";
		
		$perform_query_delete_addvertisement=mysqli_query($connect,$query_delete_addvertisement);
		
		if($perform_query_delete_addvertisement)
		{
			//sucess

			$path1="../images/advertisement/{$advertisement_id}";
    		deleteDirectory($path1);
			
			echo "تم خدف الأعلان  بنجاح";


		}else
		{
			//fail
			echo "حدث خطا أثناء حذف الأعلان";

		}
	}	
?>