<?php
	include_once("../../php_includes/connection_db.php");

	if($_POST['do_action']=="get_shops_list")
	{
		$country=mysqli_real_escape_string($connect,$_POST['country']);
		$government=mysqli_real_escape_string($connect,$_POST['government']);
		$city=mysqli_real_escape_string($connect,$_POST['city']);
		$shop_activity=mysqli_real_escape_string($connect,$_POST['shop_activity']);
		
		//deifing the limit
		$limit=mysqli_real_escape_string($connect,$_POST['limit_records']);
		$limit = isset($limit) ? $limit : 5;
		//deifing the page number
		$page=mysqli_real_escape_string($connect,$_POST['page']);
		$page = isset($page) ? $page : 1;
		//definig the start number
		$start = ($page - 1) * $limit;
		$flag=0;

		if(!empty($country)&&!empty($government)&&!empty($city)&&!empty($shop_activity)&&!empty($limit)&&!empty($page))
		{
			$List_shops=array();
			$shop_rec=array();

			if($shop_activity=="all")
				{
			
					$query_shops="SELECT `id`, `shop_name`, `country`, `address`, `description`, `user_id`, `photo`, `shop_activity`, `lat`, `log`, `allowed_products`, `allowed_offers`, `government`, `city` FROM `shop` WHERE `country`='{$country}' AND `government`='{$government}' AND `city`='{$city}' AND `approve`='1' LIMIT $start, $limit";
					$perform_query_shops=mysqli_query($connect,$query_shops);
					// echo $query_shops;
					
					while($row_shops=mysqli_fetch_assoc($perform_query_shops))
					{

				
						//all shops here
						$shop_id=$row_shops['id'];
						$shop_name=$row_shops['shop_name'];
						$shop_country=$row_shops['country'];
						$shop_address=$row_shops['address'];
						$shop_description=$row_shops['description'];
						$shop_user_id=$row_shops['user_id'];
						$shop_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$shop_user_id}/{$shop_id}/".$row_shops['photo'];
						$shop_shop_activity=$row_shops['shop_activity'];
						$shop_lat=$row_shops['lat'];
						$shop_log=$row_shops['log'];
						$shop_allowed_product=$row_shops['allowed_products'];
						$shop_allowed_offers=$row_shops['allowed_offers'];
						$shop_government=$row_shops['government'];
						$shop_city=$row_shops['city'];

						$shop_rec=array(
							"shop_id"=>$shop_id,
							"shop_name"=>$shop_name,
							"shop_country"=>$shop_country,
							"shop_address"=>$shop_address,
							"shop_description"=>$shop_description,
							"shop_user_id"=>$shop_user_id,
							"shop_photo"=>$shop_photo,
							"shop_shop_activity"=>$shop_shop_activity,
							"shop_lat"=>$shop_lat,
							"shop_log"=>$shop_log,
							"shop_allowed_product"=>$shop_allowed_product,
							"shop_allowed_offers"=>$shop_allowed_offers,
							"shop_government"=>$shop_government,
							"shop_city"=>$shop_city
							);

						array_push($List_shops,$shop_rec);
					}
						

				}else if($shop_activity=="returants")
				{
					//resturants here 
					/*****************************************************/
					$query_shops_returants="SELECT `shop`.`id` as `s_id`, `shop_name`, `country`, `address`, `description`, `user_id`, `photo`, `shop_activity`, `lat`, `log`, `allowed_products`, `allowed_offers`, `government`, `city` FROM `shop` INNER JOIN `shop_activities` ON `shop`.`id`= `shop_activities`.`shop_id` WHERE `country`='{$country}' AND `government`='{$government}' AND `city`='{$city}' AND `approve`='1' AND (`shop_activities`.`activity`='مطاعم' ||`shop_activities`.`activity`='حلويات' ) LIMIT $start, $limit";

					$perform_query_shops_returants=mysqli_query($connect,$query_shops_returants);

					
					

					while($rows_shops_res=mysqli_fetch_assoc($perform_query_shops_returants))
					{
						
							//all shops here
							$shop_id=$rows_shops_res['s_id'];
							$shop_name=$rows_shops_res['shop_name'];
							$shop_country=$rows_shops_res['country'];
							$shop_address=$rows_shops_res['address'];
							$shop_description=$rows_shops_res['description'];
							$shop_user_id=$rows_shops_res['user_id'];
							$shop_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$shop_user_id}/{$shop_id}/".$rows_shops_res['photo'];
							$shop_shop_activity=$rows_shops_res['shop_activity'];
							$shop_lat=$rows_shops_res['lat'];
							$shop_log=$rows_shops_res['log'];
							$shop_allowed_product=$rows_shops_res['allowed_products'];
							$shop_allowed_offers=$rows_shops_res['allowed_offers'];
							$shop_government=$rows_shops_res['government'];
							$shop_city=$rows_shops_res['city'];

							$shop_rec=array(
								"shop_id"=>$shop_id,
								"shop_name"=>$shop_name,
								"shop_country"=>$shop_country,
								"shop_address"=>$shop_address,
								"shop_description"=>$shop_description,
								"shop_user_id"=>$shop_user_id,
								"shop_photo"=>$shop_photo,
								"shop_shop_activity"=>$shop_shop_activity,
								"shop_lat"=>$shop_lat,
								"shop_log"=>$shop_log,
								"shop_allowed_product"=>$shop_allowed_product,
								"shop_allowed_offers"=>$shop_allowed_offers,
								"shop_government"=>$shop_government,
								"shop_city"=>$shop_city
								);

						
								//push here allowed
								array_push($List_shops,$shop_rec);
							
							
							
									
						
					}
					/*****************************************************************************/
				}else if($shop_activity=="electronics")
				{
					//rows_shops_electronics here 
					/*****************************************************/
					$query_shops_electronics="SELECT `shop`.`id` as `s_id`, `shop_name`, `country`, `address`, `description`, `user_id`, `photo`, `shop_activity`, `lat`, `log`, `allowed_products`, `allowed_offers`, `government`, `city` FROM `shop` INNER JOIN `shop_activities` ON `shop`.`id`= `shop_activities`.`shop_id` WHERE `country`='{$country}' AND `government`='{$government}' AND `city`='{$city}' AND `approve`='1' AND (`shop_activities`.`activity`='الموبايلات' ||`shop_activities`.`activity`='إلكترونيات وكمبيوترات'|| `shop_activities`.`activity`='أجهزة كهربية وإلكترونية'|| `shop_activities`.`activity`='أدوات كهربية') LIMIT $start, $limit";

					$perform_query_shops_electronics=mysqli_query($connect,$query_shops_electronics);

					
					

					while($rows_shops_electronics=mysqli_fetch_assoc($perform_query_shops_electronics))
					{
						
							//all shops here
							$shop_id=$rows_shops_electronics['s_id'];
							$shop_name=$rows_shops_electronics['shop_name'];
							$shop_country=$rows_shops_electronics['country'];
							$shop_address=$rows_shops_electronics['address'];
							$shop_description=$rows_shops_electronics['description'];
							$shop_user_id=$rows_shops_electronics['user_id'];
							$shop_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$shop_user_id}/{$shop_id}/".$rows_shops_electronics['photo'];
							$shop_shop_activity=$rows_shops_electronics['shop_activity'];
							$shop_lat=$rows_shops_electronics['lat'];
							$shop_log=$rows_shops_electronics['log'];
							$shop_allowed_product=$rows_shops_electronics['allowed_products'];
							$shop_allowed_offers=$rows_shops_electronics['allowed_offers'];
							$shop_government=$rows_shops_electronics['government'];
							$shop_city=$rows_shops_electronics['city'];

							$shop_rec=array(
								"shop_id"=>$shop_id,
								"shop_name"=>$shop_name,
								"shop_country"=>$shop_country,
								"shop_address"=>$shop_address,
								"shop_description"=>$shop_description,
								"shop_user_id"=>$shop_user_id,
								"shop_photo"=>$shop_photo,
								"shop_shop_activity"=>$shop_shop_activity,
								"shop_lat"=>$shop_lat,
								"shop_log"=>$shop_log,
								"shop_allowed_product"=>$shop_allowed_product,
								"shop_allowed_offers"=>$shop_allowed_offers,
								"shop_government"=>$shop_government,
								"shop_city"=>$shop_city
								);

						
								//push here allowed
								array_push($List_shops,$shop_rec);
							
							
							
									
						
					}
					/*****************************************************************************/
				}else if($shop_activity=="carpets")
				{
					//carpets here
					/*****************************************************/
					$query_shops_carpets="SELECT `shop`.`id` as `s_id`, `shop_name`, `country`, `address`, `description`, `user_id`, `photo`, `shop_activity`, `lat`, `log`, `allowed_products`, `allowed_offers`, `government`, `city` FROM `shop` INNER JOIN `shop_activities` ON `shop`.`id`= `shop_activities`.`shop_id` WHERE `country`='{$country}' AND `government`='{$government}' AND `city`='{$city}' AND `approve`='1' AND (`shop_activities`.`activity`='أقمشة' ||`shop_activities`.`activity`='سجاد ومفروشات') LIMIT $start, $limit";

					$perform_query_shops_carpets=mysqli_query($connect,$query_shops_carpets);

					
					

					while($rows_shops_carpets=mysqli_fetch_assoc($perform_query_shops_carpets))
					{
						
							//all shops here
							$shop_id=$rows_shops_carpets['s_id'];
							$shop_name=$rows_shops_carpets['shop_name'];
							$shop_country=$rows_shops_carpets['country'];
							$shop_address=$rows_shops_carpets['address'];
							$shop_description=$rows_shops_carpets['description'];
							$shop_user_id=$rows_shops_carpets['user_id'];
							$shop_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$shop_user_id}/{$shop_id}/".$rows_shops_carpets['photo'];
							$shop_shop_activity=$rows_shops_carpets['shop_activity'];
							$shop_lat=$rows_shops_carpets['lat'];
							$shop_log=$rows_shops_carpets['log'];
							$shop_allowed_product=$rows_shops_carpets['allowed_products'];
							$shop_allowed_offers=$rows_shops_carpets['allowed_offers'];
							$shop_government=$rows_shops_carpets['government'];
							$shop_city=$rows_shops_carpets['city'];

							$shop_rec=array(
								"shop_id"=>$shop_id,
								"shop_name"=>$shop_name,
								"shop_country"=>$shop_country,
								"shop_address"=>$shop_address,
								"shop_description"=>$shop_description,
								"shop_user_id"=>$shop_user_id,
								"shop_photo"=>$shop_photo,
								"shop_shop_activity"=>$shop_shop_activity,
								"shop_lat"=>$shop_lat,
								"shop_log"=>$shop_log,
								"shop_allowed_product"=>$shop_allowed_product,
								"shop_allowed_offers"=>$shop_allowed_offers,
								"shop_government"=>$shop_government,
								"shop_city"=>$shop_city
								);

						
								//push here allowed
								array_push($List_shops,$shop_rec);
							
							
							
									
						
					}
						
					/*****************************************************************************/

				}else if($shop_activity=="clothes")
				{
					//clothes here
					/*****************************************************/
					$query_shops_clothes="SELECT `shop`.`id` as `s_id`, `shop_name`, `country`, `address`, `description`, `user_id`, `photo`, `shop_activity`, `lat`, `log`, `allowed_products`, `allowed_offers`, `government`, `city` FROM `shop` INNER JOIN `shop_activities` ON `shop`.`id`= `shop_activities`.`shop_id` WHERE `country`='{$country}' AND `government`='{$government}' AND `city`='{$city}' AND `approve`='1' AND (`shop_activities`.`activity`='ملابس أطفال' ||`shop_activities`.`activity`='ملابس رجالي' ||`shop_activities`.`activity`='ملابس حريمي' ||`shop_activities`.`activity`='أحذية رجالي'||`shop_activities`.`activity`='أحذية حريمي' ) LIMIT $start, $limit";

					$perform_query_shops_clothes=mysqli_query($connect,$query_shops_clothes);

					
					

					while($rows_shops_clothes=mysqli_fetch_assoc($perform_query_shops_clothes))
					{
						
							//all shops here
							$shop_id=$rows_shops_clothes['s_id'];
							$shop_name=$rows_shops_clothes['shop_name'];
							$shop_country=$rows_shops_clothes['country'];
							$shop_address=$rows_shops_clothes['address'];
							$shop_description=$rows_shops_clothes['description'];
							$shop_user_id=$rows_shops_clothes['user_id'];
							$shop_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$shop_user_id}/{$shop_id}/".$rows_shops_clothes['photo'];
							$shop_shop_activity=$rows_shops_clothes['shop_activity'];
							$shop_lat=$rows_shops_clothes['lat'];
							$shop_log=$rows_shops_clothes['log'];
							$shop_allowed_product=$rows_shops_clothes['allowed_products'];
							$shop_allowed_offers=$rows_shops_clothes['allowed_offers'];
							$shop_government=$rows_shops_clothes['government'];
							$shop_city=$rows_shops_clothes['city'];

							$shop_rec=array(
								"shop_id"=>$shop_id,
								"shop_name"=>$shop_name,
								"shop_country"=>$shop_country,
								"shop_address"=>$shop_address,
								"shop_description"=>$shop_description,
								"shop_user_id"=>$shop_user_id,
								"shop_photo"=>$shop_photo,
								"shop_shop_activity"=>$shop_shop_activity,
								"shop_lat"=>$shop_lat,
								"shop_log"=>$shop_log,
								"shop_allowed_product"=>$shop_allowed_product,
								"shop_allowed_offers"=>$shop_allowed_offers,
								"shop_government"=>$shop_government,
								"shop_city"=>$shop_city
								);

						
								//push here allowed
								array_push($List_shops,$shop_rec);
							
							
							
									
						
					}
					
					/*****************************************************************************/
					
				

				



				

			}
			
			// echo json_encode(unique_multidim_array($List_shops,"shop_id"),JSON_FORCE_OBJECT);
			$list=unique_multidim_array($List_shops,"shop_id");
			$list_suffled=shuffle_assoc($list);
			$list_unordered=array();
			foreach($list_suffled as $key)
			{
				
				array_push($list_unordered,$key);
			}
			echo json_encode($list_unordered,JSON_FORCE_OBJECT);
		}
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