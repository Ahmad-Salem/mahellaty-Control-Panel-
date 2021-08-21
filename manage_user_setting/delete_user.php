<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	include_once("../php_includes/deletedir.php");
	include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
	if(isset($_POST['account_id']))
	{
		$account_id=$_POST['account_id'];

		$query_get_shop_ids="SELECT `id` FROM `shop` WHERE `user_id`='{$account_id}'";
		$perform_query_get_shop_ids=mysqli_query($connect,$query_get_shop_ids);
		while($shop_ids_rows=mysqli_fetch_assoc($perform_query_get_shop_ids))
		{
			//delete shop
			$shop_id=$shop_ids_rows['id'];
			$query_product_ids="SELECT `p_id` FROM `product_photos` INNER JOIN `products` ON `products`.`id` = `product_photos`.`p_id` WHERE `products`.`shop_id`='{$shop_id}'";
			$perform_query_product_ids=mysqli_query($connect,$query_product_ids);
			while($product_ids_rows=mysqli_fetch_assoc($perform_query_product_ids));
			{
				//delete products photos
				$query_delete_product_photos="DELETE FROM `product_photos` WHERE `p_id`='".$product_ids_rows['p_id']."'";
				$perform_query_delete_product_photos=mysqli_query($connect,$query_delete_product_photos);

			}

			//delete process
			$query_delete_shop="DELETE FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
			$query_delete_products="DELETE FROM `products` WHERE `shop_id`='{$shop_id}' ";
			$query_delete_offers="DELETE FROM `offers` WHERE `shop_id`='{$shop_id}' ";
			$perform_query_delete_shop=mysqli_query($connect,$query_delete_shop);
			$perform_query_delete_products=mysqli_query($connect,$query_delete_products);
			$perform_query_delete_offers=mysqli_query($connect,$query_delete_offers);
			
		}

		


		$query_delete_msg="DELETE FROM `contact_us` WHERE `owner_id`='{$account_id}'";
		$perform_query_delete_msg=mysqli_query($connect,$query_delete_msg);
		$query_delete_user="DELETE FROM `users` WHERE `id`='{$account_id}' LIMIT 1";
		$perform_query_delete_user=mysqli_query($connect,$query_delete_user);
		if($perform_query_delete_user)
		{
			//sucess
			$path='../images/users/'.$account_id;
			deleteDirectory($path);
			echo "تم خدف المستخدم بنجاح";

		}else
		{
			//fail
			echo "حدث خطا أثناء حذف المستخدم";

		}
	}	
?>