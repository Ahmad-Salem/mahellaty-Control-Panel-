<?php
	include_once("../../php_includes/connection_db.php");
	if($_POST['do_action']=="get_Search_list")
	{
		$country=mysqli_real_escape_string($connect,$_POST['country']);
		$government=mysqli_real_escape_string($connect,$_POST['government']);
		$city=mysqli_real_escape_string($connect,$_POST['city']);
		$search=mysqli_real_escape_string($connect,$_POST['search']);

		// $shop_activity=mysqli_real_escape_string($connect,$_POST['shop_activity']);
		
		if(!empty($country)&&!empty($government)&&!empty($city)&&!empty($search))
		{
			$query_shops="SELECT `id`, `shop_name`, `country`, `address`, `description`, `user_id`, `photo`, `shop_activity`, `lat`, `log`, `allowed_products`, `allowed_offers`, `government`, `city` FROM `shop` WHERE (`country`='{$country}' AND `government`='{$government}' AND `city`='{$city}' AND `approve`='1') AND (`shop_name` LIKE '{$search}%' || `shop_name` LIKE '%{$search}%' || `shop_name` LIKE '%{$search}') LIMIT 15";
			
			$query_offers="SELECT `offers`.`id`as 'of_id',`users`.`user_name`,`users`.`email`,`users`.`address`,`users`.`telephone1`,`users`.`telephone2`,`users`.`photo`,`shop`.`user_id`, `offer_name`, `offer_description`, `offer_photo`, `shop_id` FROM `offers` INNER JOIN `shop` ON `offers`.`shop_id`=`shop`.`id` INNER JOIN `users` ON `users`.`id`=`shop`.`user_id` WHERE (`shop`.`country`='{$country}' AND `shop`.`government`='{$government}' AND `shop`.`city`='{$city}' AND `shop`.`approve`='1') AND (`offer_name` LIKE '{$search}%' || `offer_name` LIKE '%{$search}%' || `offer_name` LIKE '%{$search}') LIMIT 15";

			$query_products="SELECT `products`.`id` as `p_id`,`users`.`user_name`,`users`.`email`,`users`.`address`,`users`.`telephone1`,`users`.`telephone2`,`users`.`photo`,`shop`.`user_id`, `product_name`, `product_price`, `shop_id`, `product_photo`, `product_description` FROM `products` INNER JOIN `shop` ON `products`.`shop_id`=`shop`.`id` INNER JOIN `users` ON `users`.`id`=`shop`.`user_id`   WHERE (`shop`.`country`='{$country}' AND `shop`.`government`='{$government}' AND `shop`.`city`='{$city}' AND `shop`.`approve`='1') AND (`product_name` LIKE '{$search}%' || `product_name` LIKE '%{$search}%' || `product_name` LIKE '%{$search}' )LIMIT 15";


			$perform_query_shops=mysqli_query($connect,$query_shops);
			$perform_query_offers=mysqli_query($connect,$query_offers);
			$perform_query_products=mysqli_query($connect,$query_products);
			// echo $query_shops;
			$List_search=array();
			$product_rec=array();
			$offer_rec=array();
			$shop_rec=array();

			//product list
			while($row_products=mysqli_fetch_assoc($perform_query_products))
			{

					
					//all shops here
					$type="product";
					$product_id=$row_products['p_id'];
					$product_name=$row_products['product_name'];
					$product_price=$row_products['product_price'];
					$shop_id=$row_products['shop_id'];
					$user_id=$row_products['user_id'];
					$product_description=$row_products['product_description'];
					
					$product_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$user_id}/{$shop_id}/main_p_photo/".$product_id."/".$row_products['product_photo'];
					
					$user_name=$row_products['user_name'];
					$email=$row_products['email'];
					$user_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$user_id}/".$row_products['photo'];
					$user_address=$row_products['address'];
					$telephone1=$row_products['telephone1'];
					$telephone2=$row_products['telephone2'];

					$product_rec=array(
						"type"=>$type,
						"product_id"=>$product_id,
						"product_name"=>$product_name,
						"product_price"=>$product_price,
						"shop_id"=>$shop_id,
						"user_id"=>$user_id,
						"product_description"=>$product_description,
						"product_photo"=>$product_photo,
						"user_name"=>$user_name,
						"email"=>$email,
						"user_photo"=>$user_photo,
						"user_address"=>$user_address,
						"telephone1"=>$telephone1,
						"telephone2"=>$telephone2
						
						);



					array_push($List_search,$product_rec);

			

			}
			//offers list
			while($row_offers=mysqli_fetch_assoc($perform_query_offers))
			{

					
					//all shops here
					$type="offer";
					$offer_id=$row_offers['of_id'];
					$offer_name=$row_offers['offer_name'];
					$offer_description=$row_offers['offer_description'];
					$shop_id=$row_offers['shop_id'];
					$user_id=$row_offers['user_id'];
					$offer_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$user_id}/{$shop_id}/offers/".$offer_id."/".$row_offers['offer_photo'];
					
					$user_name=$row_offers['user_name'];
					$email=$row_offers['email'];
					$user_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$user_id}/".$row_offers['photo'];
					$user_address=$row_offers['address'];
					$telephone1=$row_offers['telephone1'];
					$telephone2=$row_offers['telephone2'];
					
					$offer_rec=array(
						"type"=>$type,
						"offer_id"=>$offer_id,
						"offer_name"=>$offer_name,
						"offer_description"=>$offer_description,
						"shop_id"=>$shop_id,
						"user_id"=>$user_id,
						"offer_photo"=>$offer_photo,
						"user_name"=>$user_name,
						"email"=>$email,
						"user_photo"=>$user_photo,
						"user_address"=>$user_address,
						"telephone1"=>$telephone1,
						"telephone2"=>$telephone2
						);



					array_push($List_search,$offer_rec);

			

			}
			//shop list
			while($row_shops=mysqli_fetch_assoc($perform_query_shops))
			{

				
					//all shops here
					$type="shop";
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
						"type"=>$type,
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



					array_push($List_search,$shop_rec);

			

			}

			// echo json_encode($List_shops,JSON_FORCE_OBJECT);
			// echo json_encode(unique_multidim_array($List_search,"shop_id"),JSON_FORCE_OBJECT);


			$list_suffled=shuffle_assoc($List_search);
			$list_unordered=array();
			foreach($list_suffled as $key)
			{
				
				array_push($list_unordered,$key);
			}
			echo json_encode($list_unordered,JSON_FORCE_OBJECT);



		}
	}


	/**************************************************************************/
	
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