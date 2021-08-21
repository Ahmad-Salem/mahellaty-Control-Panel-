<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	
	include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
	if(isset($_POST['shop_id'])&& isset($_POST['product_name'])&&isset($_POST['product_price']))
	{
	
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
		$product_name=mysqli_real_escape_string($connect,$_POST['product_name']);
		$product_price=mysqli_real_escape_string($connect,$_POST['product_price']);
		$query_add_product="INSERT INTO `products_list_text`(`shop_id`, `product_name`, `product_price`) VALUES ('{$shop_id}','{$product_name}','{$product_price}')";
		

		$perform_query_add_product=mysqli_query($connect,$query_add_product);
	
		
		if($perform_query_add_product)
		{
			//sucess

			

			echo "تم إضافة المنتج بنجاح";


		}else
		{
			//fail
			echo "حدث خطا أثناء إضافة المنتج";

		}
	}	
?>