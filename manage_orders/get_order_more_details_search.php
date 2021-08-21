<?php
	include_once("../php_includes/connection_db.php");
	

	if(isset($_POST['search']))
	{
		$search=mysqli_real_escape_string($connect,$_POST['search']);
		$query_person_details="SELECT orders.`id`, users.user_name,`shop_name`,user_phone_number, `date`, `checked` FROM `orders` INNER JOIN`order_details` ON orders.id=order_details.order_id INNER JOIN `shop` ON order_details.shop_id=shop.id INNER JOIN users ON shop.user_id=users.id  WHERE shop.city='{$search}' ";
		
		$perform_query_person_details=mysqli_query($connect,$query_person_details);
		while($result_p_details=mysqli_fetch_assoc($perform_query_person_details))
		{
			$Order_id=$result_p_details['id'];
			$Order_shop_user_name=$result_p_details['user_name'];
			$Order_shop_name=$result_p_details['shop_name'];
			$Order_phone_number=$result_p_details['user_phone_number'];
			$Order_date=$result_p_details['date'];
			$Order_checked=$result_p_details['checked'];
			
			


			$person_account_details[]=array(
								"order_id"=>$Order_id,
								"shop_user_name"=>$Order_shop_user_name,
								"shop_name"=>$Order_shop_name,
								"phone_number"=>$Order_phone_number,
								"date"=>$Order_date,
								"checked"=>$Order_checked
								);	
		}
		


		echo json_encode($person_account_details, JSON_FORCE_OBJECT);
	}

	


?>