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

		if(!empty($country)&&!empty($government)&&!empty($city)&&!empty($shop_activity)&&!empty($limit)&&!empty($page))
		{
			$query_shops="SELECT `id`, `shop_name`, `country`, `address`, `description`, `user_id`, `photo`, `shop_activity`, `lat`, `log`, `allowed_products`, `allowed_offers`, `government`, `city` FROM `shop` WHERE `country`='{$country}' AND `government`='{$government}' AND `city`='{$city}' AND `approve`='1' AND `shop_activity`='{$shop_activity}' LIMIT $start, $limit";
			$perform_query_shops=mysqli_query($connect,$query_shops);
			// echo $query_shops;
			$List_shops=array();
			$shop_rec=array();

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

			// echo json_encode($List_shops,JSON_FORCE_OBJECT);
			echo json_encode(unique_multidim_array($List_shops,"shop_id"),JSON_FORCE_OBJECT);
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
?>