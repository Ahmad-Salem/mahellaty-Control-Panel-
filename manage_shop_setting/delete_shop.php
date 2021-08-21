<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	include_once("../php_includes/deletedir.php");
	include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");

	if(isset($_POST['shop_id']))
	{
		$shop_id=mysqli_real_escape_string($connect, $_POST['shop_id']);
		
		/**** getting user id *****/
		$query_get_user_id="SELECT  `user_id` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
		$perform_query_get_user_id=mysqli_query($connect,$query_get_user_id);
		$row_user_id=mysqli_fetch_assoc($perform_query_get_user_id);
		$user_id=$row_user_id['user_id'];
		/***************************/
	
		// $query_product_ids="SELECT `p_id` FROM `product_photos` INNER JOIN `products` ON `products`.`id` = `product_photos`.`p_id` WHERE `products`.`shop_id`='{$shop_id}'";
		// $perform_query_product_ids=mysqli_query($connect,$query_product_ids);
		// while($product_ids_rows=mysqli_fetch_assoc($perform_query_product_ids));
		// {
		// 	//delete products photos
		// 	$query_delete_product_photos="DELETE FROM `product_photos` WHERE `p_id`='".$product_ids_rows['p_id']."'";
		// 	$perform_query_delete_product_photos=mysqli_query($connect,$query_delete_product_photos);

		// }

		//delete process
		$query_delete_shop="DELETE FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
		// echo $query_delete_shop;
		$query_delete_products="DELETE FROM `products` WHERE `shop_id`='{$shop_id}' ";
		$query_delete_offers="DELETE FROM `offers` WHERE `shop_id`='{$shop_id}' ";

		$perform_query_delete_shop=mysqli_query($connect,$query_delete_shop);
		$perform_query_delete_products=mysqli_query($connect,$query_delete_products);
		$perform_query_delete_offers=mysqli_query($connect,$query_delete_offers);
		if($perform_query_delete_shop && $perform_query_delete_products && $perform_query_delete_offers)
		{
			//sucess
			if($user_id!=""&&$shop_id!="")
			{
				$path='../images/users/'.$user_id.'/'.$shop_id;
				deleteDirectory($path);	
			}
			
			echo "تم خدف المستخدم بنجاح";

		}else
		{
			//fail
			echo "حدث خطا أثناء حذف المستخدم";

		}
	}	
?>