<?php
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['search_city']))
	{
		$search=mysqli_real_escape_string($connect,$_POST['search_city']);
		$query_shop_details="SELECT `id`, `shop_name`, `user_id`, `country`, `government` , `city` ,`address`, `user_id`, `shop_activity`, `allowed_products`, `allowed_offers`,`approve` FROM `shop` WHERE `city`='{$search}' ";
		// echo $query_shop_details;
		$perform_query_shop_details=mysqli_query($connect,$query_shop_details);
		while($result_shop_details=mysqli_fetch_assoc($perform_query_shop_details))
		{
			$Shop_id=$result_shop_details['id'];
			$Shop_name=$result_shop_details['shop_name'];
			$Shop_country=$result_shop_details['country'];
			$Shop_government=$result_shop_details['government'];
			$Shop_city=$result_shop_details['city'];
			$Shop_address=$result_shop_details['address'];
			$Shop_Onwer=$result_shop_details['user_id'];
			$Shop_activity=$result_shop_details['shop_activity'];
			$Shop_allowed_products=$result_shop_details['allowed_products'];
			$Shop_allowed_offers=$result_shop_details['allowed_offers'];
			$Shop_approve=$result_shop_details['approve'];
			$Shop_user_id=$result_shop_details['user_id'];


			$Shop_details[]=array(
								"id"=>$Shop_id,
								"shop_name"=>$Shop_name,
								"country"=>$Shop_country,
								"government"=>$Shop_government,
								"city"=>$Shop_city,
								"address"=>$Shop_address,
								"user_id"=>$Shop_Onwer,
								"shop_activity"=>$Shop_activity,
								"allowed_products"=>$Shop_allowed_products,
								"allowed_offers"=>$Shop_allowed_offers,
								"approve"=>$Shop_approve,
								"user_id"=>$Shop_user_id
								);	
		}
		


		echo json_encode($Shop_details, JSON_FORCE_OBJECT);
	}

	


?>