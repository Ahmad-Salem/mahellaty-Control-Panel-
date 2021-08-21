<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	

	if(isset($_POST['search'])&&isset($_POST['shop_no']))
	{
		$search=mysqli_real_escape_string($connect,$_POST['search']);
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_no']);
		
		$query_offer_details="SELECT `id`, `offer_name`, `offer_description`, `offer_photo`, `shop_id` FROM `offers` WHERE `shop_id`='{$shop_id}' AND `offer_name` LIKE '%{$search}' OR `offer_name` LIKE '{$search}%' OR `offer_name` LIKE '%{$search}%' ";
		$perform_query_offer_details=mysqli_query($connect,$query_offer_details);
		while($result_offer_details=mysqli_fetch_assoc($perform_query_offer_details))
		{
			$offer_id=$result_offer_details['id'];
			$offer_name=$result_offer_details['offer_name'];
			$offer_photo=$result_offer_details['offer_photo'];
			$offer_description=$result_offer_details['offer_description'];
			$shop_id=$result_offer_details['shop_id'];
			/**** getting user id *****/
			$query_get_user_id="SELECT  `user_id` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
			$perform_query_get_user_id=mysqli_query($connect,$query_get_user_id);
			$row_user_id=mysqli_fetch_assoc($perform_query_get_user_id);
			$user_id=$row_user_id['user_id'];
			/***************************/


			$offer_details[]=array(
								"offer_id"=>$offer_id,
								"offer_name"=>$offer_name,
								"offer_photo"=>$offer_photo,
								"offer_description"=>$offer_description,
								"shop_id"=>$shop_id,
								"user_id"=>$user_id
								);	
		}
		


		echo json_encode($offer_details, JSON_FORCE_OBJECT);
	}

	


?>