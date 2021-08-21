<?php
	include_once("../../php_includes/connection_db.php");
	

	if($_POST['do_action']=="get_shops")
	{
		
		$city=mysqli_real_escape_string($connect,$_POST['city']);
		$government=mysqli_real_escape_string($connect,$_POST['government']);
		$country=mysqli_real_escape_string($connect,$_POST['country']);

		// $query_get_shops="SELECT `offers`.`id` as `oid`, `offer_name`, `offer_description`, `offer_photo`, `shop_id` FROM `offers` INNER JOIN `shop` ON `shop`.id=`offers`.`shop_id` WHERE `shop`.`government`='{$government}' AND `shop`.`city`='{$city}' AND `shop`.`country`='{$country}' LIMIT 15";
		// echo $query_get_shops;
		if(!empty($city)&&!empty($government))
		{
			
			$query_get_shops="SELECT `users`.`id` as `u_id`, `users`.`user_name` as `u_user_name`, `users`.`email` as `u_email`, `users`.`photo` as `u_photo`, `users`.`telephone1`, `users`.`telephone2`, `users`.`address` as `u_address`, `shop`.`shop_name`,`shop`.`main_page`, `shop`.`address`, `shop`.`description`, `shop`.`user_id`, `shop`.`photo`, `shop`.`lat`, `shop`.`log`, `shop`.`allowed_products`, `shop`.`allowed_offers`,`shop`.`country`, `shop`.`government`, `shop`.`city`, `shop`.`shop_activity`,`shop`.`id` as `shop_id` FROM `shop` INNER JOIN `shop_activities` ON `shop_activities`.`shop_id`=`shop`.`id` INNER JOIN `users` ON `users`.`id`=`shop`.`user_id` WHERE `shop`.`government`='{$government}' AND `shop`.`city`='{$city}' AND `shop`.`country`='{$country}' AND `shop`.`main_page`='1' AND (`shop_activities`.`activity`='ملابس أطفال' OR `shop_activities`.`activity`='ملابس رجالي' OR `shop_activities`.`activity`='ملابس حريمي' OR `shop_activities`.`activity`='أحذية رجالي' OR `shop_activities`.`activity`='أحذية حريمي' OR `shop_activities`.`activity`='العاب أطفال' OR `shop_activities`.`activity`='مستلزمات رجالي' OR `shop_activities`.`activity`='مستلزمات حريمي' ) LIMIT 15";
			// echo $query_get_shops;
			$perform_query_get_shops=mysqli_query($connect,$query_get_shops);
			
			$offers_info=array();
			$offer_info=array();
			
			while($rows_shops=mysqli_fetch_assoc($perform_query_get_shops))
			{

				
					
						
						$offer_shop_id=$rows_shops['shop_id'];
						$offer_shop_country=$rows_shops['country'];
						$offer_shop_gov=$rows_shops['government'];
						$offer_shop_city=$rows_shops['city'];
						$offer_shop_shop_activity=$rows_shops['shop_activity'];

						$offer_shop_name=$rows_shops['shop_name'];
						$offer_shop_address=$rows_shops['address'];
						$offer_shop_description=$rows_shops['description'];
						$offer_shop_user_id=$rows_shops['user_id'];
						$offer_shop_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/".$rows_shops['user_id']."/".$offer_shop_id."/".$rows_shops['photo'];
						$offer_shop_lat=$rows_shops['lat'];
						$offer_shop_log=$rows_shops['log'];
						$offer_shop_allowed_products=$rows_shops['allowed_products'];
						$offer_shop_allowed_offers=$rows_shops['allowed_offers'];

						//setting values 
				        $user_id=$rows_shops['u_id'];
				        $user_user_name=$rows_shops['u_user_name'];
				        $user_email=$rows_shops['u_email'];
				        $user_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$user_id}/".$rows_shops['u_photo'];
				        $user_telephone1=$rows_shops['telephone1'];
				        $user_telephone2=$rows_shops['telephone2'];
				        $user_address=$rows_shops['u_address'];



						$offer_info=array(
					
							"offer_shop_id"=>$offer_shop_id,
							"offer_shop_country"=>$offer_shop_country,
							"offer_shop_gov"=>$offer_shop_gov,
							"offer_shop_city"=>$offer_shop_city,
							"offer_shop_shop_activity"=>$offer_shop_shop_activity,
							
							"offer_shop_name"=>$offer_shop_name,
							"offer_shop_address"=>$offer_shop_address,
							"offer_shop_description"=>$offer_shop_description,
							"offer_shop_user_id"=>$offer_shop_user_id,
							"offer_shop_photo"=>$offer_shop_photo,
							"offer_shop_lat"=>$offer_shop_lat,
							"offer_shop_log"=>$offer_shop_log,
							"offer_shop_allowed_products"=>$offer_shop_allowed_products,
							"offer_shop_allowed_offers"=>$offer_shop_allowed_offers,
							

							"user_id"=>$user_id,
							"user_user_name"=>$user_user_name,
							"user_email"=>$user_email,
							"user_photo"=>$user_photo,
							"user_telephone1"=>$user_telephone1,
							"user_telephone2"=>$user_telephone2,
							"user_address"=>$user_address

							);
						
						/********* pushing process ************/
						array_push($offers_info,$offer_info);

						/*******************end pushing process ************/		
					
				
				


			}

		}
		
		// echo json_encode($offers_info,JSON_FORCE_OBJECT);
		$list=unique_multidim_array($offers_info,"offer_shop_id");
		$list_suffled=shuffle_assoc($list);
		$list_unordered=array();
		foreach($list_suffled as $key)
		{
			
			array_push($list_unordered,$key);
		}
		echo json_encode($list_unordered,JSON_FORCE_OBJECT);
		
	}

/**************************************************************************/
	/********* generate unique items **************************************************/
	function unique_multidim_array($array, $key) { 
    $temp_array = array(); 
    $i = 0; 
    $key_array = array(); 
    
    foreach($array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $temp_array[$i] = $val; 
        } 
        $i++; 
    } 
    return $temp_array; 
} 
	/**************************************************************************/
	/***************** shuffle *********************/
	function shuffle_assoc($list) {
	  if (!is_array($list)) return $list;

	  $keys = array_keys($list);
	  shuffle($keys);
	  $random = array();
	  foreach ($keys as $key)
	    $random[$key] = $list[$key];

	  return $random;
	}
	/***********************************************/
?>