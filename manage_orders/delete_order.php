<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	include_once("../php_includes/deletedir.php");
	include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
	if(isset($_POST['account_id']))
	{
		$account_id=$_POST['account_id'];

		


		$query_delete_msg="DELETE FROM `order_details` WHERE `order_id`='{$account_id}'";
		$perform_query_delete_msg=mysqli_query($connect,$query_delete_msg);
		$query_delete_user="DELETE FROM `orders` WHERE `id`='{$account_id}' LIMIT 1";
		$perform_query_delete_user=mysqli_query($connect,$query_delete_user);
		if($perform_query_delete_user)
		{
			//sucess
			$path='../images/users/'.$account_id;
			deleteDirectory($path);
			echo "تم خدف الطلب بنجاح";

		}else
		{
			//fail
			echo "حدث خطا أثناء حذف الطلب";

		}
	}	
?>