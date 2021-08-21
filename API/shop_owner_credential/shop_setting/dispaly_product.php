<?php
	include_once("../../../php_includes/connection_db.php");
	
	if($_POST['do_action']=="display_products")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);
	    //getting shop id
	    $shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);


		$List_products=array();
		$product_rec=array();


	    if($perform_query_user_credential)
	    {
	    	if(!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($shop_id))
	    	{
	    		$query_product_details="SELECT `shop`.`user_id`,`products`.`id`, `product_name`, `product_price`, `shop_id`, `product_photo`, `product_description` FROM `products` INNER JOIN `shop` ON `products`.`shop_id`=`shop`.`id` INNER JOIN `users` ON `shop`.`user_id`=`users`.`id` WHERE `shop`.`id`='{$shop_id}' AND `shop`.`user_id`='{$user_id}' LIMIT 10";
	    		$perform_query_product_details=mysqli_query($connect,$query_product_details);
	    		while($row_products=mysqli_fetch_assoc($perform_query_product_details))
	    		{
	    			
					$product_id=$row_products['id'];
					$product_name=$row_products['product_name'];
					$product_price=$row_products['product_price'];
					$shop_id=$row_products['shop_id'];
					$product_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/".$user_id."/".$shop_id."/main_p_photo/".$product_id."/".$row_products['product_photo'];
					$product_description=$row_products['product_description'];
					

					$product_rec=array(
						"product_id"=>$product_id,
						"product_price"=>$product_price,
						"product_name"=>$product_name,
						"shop_id"=>$shop_id,
						"product_description"=>$product_description,
						"product_main_photo"=>$product_photo
						);

					array_push($List_products,$product_rec);
	    		}

	    	}else
	    	{
	    		$product_rec=array(
						"product_id"=>$product_id,
						"product_price"=>$product_price,
						"product_name"=>$product_name,
						"shop_id"=>$shop_id,
						"product_description"=>$product_description,
						"user_name"=>$user_name,
						"email"=>$email,
						"photo"=>$photo,
						"address"=>$address,
						"telephone1"=>$telephone1,
						"telephone2"=>$telephone2,
						"product_main_photo"=>$product_photo
						);

					array_push($List_products,$product_rec);

	    	}
	    }else
	    {
	    	$product_rec=array(
						"product_id"=>$product_id,
						"product_price"=>$product_price,
						"product_name"=>$product_name,
						"shop_id"=>$shop_id,
						"product_description"=>$product_description,
						"user_name"=>$user_name,
						"email"=>$email,
						"photo"=>$photo,
						"address"=>$address,
						"telephone1"=>$telephone1,
						"telephone2"=>$telephone2,
						"product_main_photo"=>$product_photo
						);

					array_push($List_products,$product_rec);

	    }
	
		echo json_encode($List_products,JSON_FORCE_OBJECT);

	}
?>