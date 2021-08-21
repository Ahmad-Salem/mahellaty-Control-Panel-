<?php
	include_once("../../php_includes/connection_db.php");
	if($_POST['do_action']=="get_product_list")
	{
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
		if(!empty($shop_id))
		{
			$query_product_list="SELECT `shop`.`user_id`,`users`.`user_name`,`users`.`email`,`users`.`photo`,`users`.`address`,`users`.`telephone1`,`users`.`telephone2`,`products`.`id`, `product_name`, `product_price`, `shop_id`, `product_photo`, `product_description` FROM `products` INNER JOIN `shop` ON `products`.`shop_id`=`shop`.`id` INNER JOIN `users` ON `shop`.`user_id`=`users`.`id` WHERE `shop`.`id`='{$shop_id}' LIMIT 10";
			$perform_query_product_list=mysqli_query($connect,$query_product_list);

			$List_products=array();
			$product_rec=array();
			

			while($row_products=mysqli_fetch_assoc($perform_query_product_list))
			{

				$user_id=$row_products['user_id'];
				$user_name=$row_products['user_name'];
				$email=$row_products['email'];
				$photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/".$user_id."/".$row_products['photo'];
				$address=$row_products['address'];
				$telephone1=$row_products['telephone1'];
				$telephone2=$row_products['telephone2'];
				
				$product_id=$row_products['id'];
				$product_name=$row_products['product_name'];
				$product_price=$row_products['product_price'];
				$shop_id=$row_products['shop_id'];
				$product_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/".$user_id."/".$shop_id."/main_p_photo/".$product_id."/".$row_products['product_photo'];
				$product_description=$row_products['product_description'];
				// $product_rest_photos=$product_photo;
				
				// $query_product_rest_photos="SELECT   `photo_name` FROM `product_photos` WHERE `p_id`='{$product_id}'";
				// $perform_query_product_rest_photos=mysqli_query($connect,$query_product_rest_photos);
				// while($row_rest_photos=mysqli_fetch_assoc($perform_query_product_rest_photos))
				// {
				// 	$product_rest_photos.=",http://www.ma7laty.com/d6efc460da8c2c8727d4f7a900188782/images/users/".$user_id."/".$shop_id."/p_photos/".$product_id."/".$row_rest_photos['photo_name'];
				// }

				$product_rec=array(
					"product_id"=>$product_id,
					"product_price"=>$product_price,
					"product_name"=>$product_name,
					"shop_id"=>$shop_id,
					"product_description"=>$product_description,
					"user_name"=>$user_name,
					"email"=>$email,
					"photo"=>$photo,
					"product_main_photo"=>$product_photo,
					"address"=>$address,
					"telephone1"=>$telephone1,
					"telephone2"=>$telephone2
					);

				array_push($List_products,$product_rec);
			}

			echo json_encode($List_products,JSON_FORCE_OBJECT);
		}
	}
?>