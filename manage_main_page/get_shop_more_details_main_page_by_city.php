<?php
	include_once("../php_includes/connection_db.php");
	
	if(isset($_POST['search_city']))
	{
		$search=mysqli_real_escape_string($connect,$_POST['search_city']);
		$query_shop_details="SELECT `id`, `shop_name`, `country`,`government`,`city`, `allowed_products` , `allowed_offers`,`main_page`, `address`,`shop_activity` FROM `shop` WHERE  `city`='{$search}' ";
		// echo $query_shop_details;
		$Shop_activity="";
		$Shop_details=array();
		$perform_query_shop_details=mysqli_query($connect,$query_shop_details);
		while($result_shop_details=mysqli_fetch_assoc($perform_query_shop_details))
		{
			$Shop_id=$result_shop_details['id'];
			$Shop_name=$result_shop_details['shop_name'];
			$Shop_country=$result_shop_details['country'];
			$Shop_government=$result_shop_details['government'];
			$Shop_city=$result_shop_details['city'];
			$Shop_address=$result_shop_details['address'];
			$Shop_allowed_products=$result_shop_details['allowed_products'];
			$Shop_allowed_offers=$result_shop_details['allowed_offers'];
			$main_page=$result_shop_details['main_page'];
			
			$quey_shop_activity="SELECT `activity` FROM `shop_activities` WHERE `shop_id`='".$Shop_id."' ";
            $perform_query_shop_activity=mysqli_query($connect,$quey_shop_activity);
            while($row_activity=mysqli_fetch_assoc($perform_query_shop_activity))
            {
            	$Shop_activity.=$row_activity['activity']." - ";	
            }


			$Shop_details[]=array(
								"id"=>$Shop_id,
								"shop_name"=>$Shop_name,
								"country"=>$Shop_country,
								"government"=>$Shop_government,
								"city"=>$Shop_city,
								"address"=>$Shop_address,
								"shop_activity"=>$Shop_activity,
								"allowed_products"=>$Shop_allowed_products,
								"allowed_offers"=>$Shop_allowed_offers,
								"main_page"=>$main_page
								);	
		}
		


		echo json_encode($Shop_details, JSON_FORCE_OBJECT);
	}

	


?>