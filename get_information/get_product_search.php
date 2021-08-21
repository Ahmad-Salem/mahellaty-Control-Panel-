<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	

	if(isset($_POST['search'])&&isset($_POST['shop_no']))
	{
		$search=mysqli_real_escape_string($connect,$_POST['search']);
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_no']);
		$query_product_details="SELECT `id`, `product_name`, `product_price`, `product_photo`, `product_description` FROM `products` WHERE `shop_id`='{$shop_id}' AND `product_name` LIKE '%{$search}' OR `product_name` LIKE '{$search}%' OR `product_name` LIKE '%{$search}%' ";
		$perform_query_product_details=mysqli_query($connect,$query_product_details);
		while($result_product_details=mysqli_fetch_assoc($perform_query_product_details))
		{
			$product_id=$result_product_details['id'];
			$product_name=$result_product_details['product_name'];
			$product_price=$result_product_details['product_price'];
			$product_photo=$result_product_details['product_photo'];
			$product_description=$result_product_details['product_description'];
			
			


			$product_details[]=array(
								"id"=>$product_id,
								"product_name"=>$product_name,
								"product_price"=>$product_price,
								"product_photo"=>$product_photo,
								"product_description"=>$product_description,
								"user_id"=>$_SESSION['user_id']
								
								);	
		}
		


		echo json_encode($product_details, JSON_FORCE_OBJECT);
	}

	


?>