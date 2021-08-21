<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	include_once("../php_includes/deletedir.php");
	include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
	if(isset($_POST['shop_id'])&& isset($_POST['offer_id']))
	{
		$shop_id=$_POST['shop_id'];
		$offer_id=$_POST['offer_id'];
		/**** getting user id *****/
		$query_get_user_id="SELECT  `user_id` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
		$perform_query_get_user_id=mysqli_query($connect,$query_get_user_id);
		$row_user_id=mysqli_fetch_assoc($perform_query_get_user_id);
		$user_id=$row_user_id['user_id'];
		/***************************/
		
		$query_delete_offer="DELETE FROM `offers` WHERE `shop_id`='{$shop_id}' AND `id`='{$offer_id}' LIMIT 1";
		
		$perform_query_delete_offer=mysqli_query($connect,$query_delete_offer);
		
		if($perform_query_delete_offer)
		{
			//sucess
			if($user_id!=""&&$shop_id!=""&&$offer_id!="")
			{
				$path1="../images/users/$user_id/$shop_id/offers/$offer_id";
    			deleteDirectory($path1);
			}
			
			
			echo "تم خدف العرض بنجاح";


		}else
		{
			//fail
			echo "حدث خطا أثناء حذف العرض";

		}
	}	
?>