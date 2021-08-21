<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
	if(isset($_POST['msg_id'])&& isset($_POST['user_id']))
	{
		$msg_id=mysqli_real_escape_string($connect,$_POST['msg_id']);
		$user_id=mysqli_real_escape_string($connect,$_POST['user_id']);
		
		$query_delete_message="DELETE FROM `contact_us` WHERE `id`='{$msg_id}' AND `owner_id`='{$user_id}' LIMIT 1";
		
		$perform_query_delete_message=mysqli_query($connect,$query_delete_message);
		
		if($perform_query_delete_message)
		{
			//sucess
			echo "تم خدف الرسالة  بنجاح";


		}else
		{
			//fail
			echo "حدث خطا أثناء حذف الرسالة";

		}
	}	
?>