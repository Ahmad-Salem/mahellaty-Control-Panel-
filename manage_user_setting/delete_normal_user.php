<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	include_once("../php_includes/deletedir.php");
	include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
	if(isset($_POST['account_id']))
	{
		$account_id=$_POST['account_id'];

		
		$query_delete_user="DELETE FROM `normal_user` WHERE `id`='{$account_id}' LIMIT 1";
		$perform_query_delete_user=mysqli_query($connect,$query_delete_user);
		if($perform_query_delete_user)
		{
			
			echo "تم خدف المستخدم بنجاح";

		}else
		{
			//fail
			echo "حدث خطا أثناء حذف المستخدم";

		}
	}	
?>