<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	include_once("../php_includes/deletedir.php");
	include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
	if(isset($_POST['shop_id'])&& isset($_POST['product_id'])&&isset($_SESSION['user_id']))
	{
		$shop_id=$_POST['shop_id'];
		$product_id=$_POST['product_id'];
		/**** getting user id *****/
		$query_get_user_id="SELECT  `user_id` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
		$perform_query_get_user_id=mysqli_query($connect,$query_get_user_id);
		$row_user_id=mysqli_fetch_assoc($perform_query_get_user_id);
		$user_id=$row_user_id['user_id'];
		/***************************/
		
		$query_delete_product="DELETE FROM `products` WHERE `id`='{$product_id}' AND `shop_id`='{$shop_id}' LIMIT 1";
		$query_delete_product_photo="DELETE FROM `product_photos` WHERE `p_id`='{$product_id}' ";

		$perform_query_delete_product=mysqli_query($connect,$query_delete_product);
		$perform_query_delete_product_photo=mysqli_query($connect,$query_delete_product_photo);
		
		if($perform_query_delete_product&&$perform_query_delete_product_photo)
		{
			//sucess
			if($user_id!=""&&$shop_id!=""&&$product_id!="")
			{
				$path1="../images/users/$user_id/$shop_id/main_p_photo/$product_id";
	    		$path2="../images/users/$user_id/$shop_id/p_photos/$product_id";
				deleteDirectory($path1);
				deleteDirectory($path2);
	
			}
			
			echo "تم خدف المنتج بنجاح";


		}else
		{
			//fail
			echo "حدث خطا أثناء حذف المنتج";

		}
	}	
?>