<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
	if(isset($_POST['shop_id'])&& isset($_POST['product_id']))
	{
	
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
		$product_id=mysqli_real_escape_string($connect,$_POST['product_id']);
		$query_delete_product="DELETE FROM `products_list_text` WHERE `id`='{$product_id}' AND `shop_id`='{$shop_id}' LIMIT 1";
		

		$perform_query_delete_product=mysqli_query($connect,$query_delete_product);
	
		
		if($perform_query_delete_product)
		{
			//sucess

			

			echo "تم خدف المنتج بنجاح";


		}else
		{
			//fail
			echo "حدث خطا أثناء حذف المنتج";

		}
	}	
?>