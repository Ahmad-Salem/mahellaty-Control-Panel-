<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	

	if(isset($_POST['search']))
	{
		$search=mysqli_real_escape_string($connect,$_POST['search']);
		
		$query_offer_details="SELECT `offers`.`id`, `offer_name`, `offer_description`, `offer_photo`,`user_id`,`shop_id`, `offers`.`main_page`, `from_date`, `to_date` FROM `offers` INNER JOIN `shop` ON `offers`.`shop_id`=`shop`.`id`  WHERE  `offer_name` LIKE '%{$search}' OR `offer_name` LIKE '{$search}%' OR `offer_name` LIKE '%{$search}%' ";

		$perform_query_offer_details=mysqli_query($connect,$query_offer_details);
		while($result_offer_details=mysqli_fetch_assoc($perform_query_offer_details))
		{
			$offer_id=$result_offer_details['id'];
			$offer_name=$result_offer_details['offer_name'];
			$offer_photo=$result_offer_details['offer_photo'];
			$offer_description=$result_offer_details['offer_description'];
			$shop_id=$result_offer_details['shop_id'];
			$main_page=$result_offer_details['main_page'];
			$user_id=$result_offer_details['user_id'];
			$from_date=$result_offer_details['from_date'];
			$to_date=$result_offer_details['to_date'];
			
			


			$offer_details[]=array(
								"id"=>$offer_id,
								"offer_name"=>$offer_name,
								"offer_photo"=>$offer_photo,
								"offer_description"=>$offer_description,
								"shop_id"=>$shop_id,
								"user_id"=>$user_id,
								"main_page"=>$main_page,
								"from_date"=>$from_date,
								"to_date"=>$to_date
								);	
		}
		


		echo json_encode($offer_details, JSON_FORCE_OBJECT);
	}

	


?>