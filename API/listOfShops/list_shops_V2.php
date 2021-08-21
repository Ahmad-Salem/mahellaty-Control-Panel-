<?php
	include_once("../../php_includes/connection_db.php");

	if($_POST['do_action']=="get_shops_list")
	{
		$country=mysqli_real_escape_string($connect,$_POST['country']);
		$government=mysqli_real_escape_string($connect,$_POST['government']);
		$city=mysqli_real_escape_string($connect,$_POST['city']);
		$shop_activity=mysqli_real_escape_string($connect,$_POST['shop_activity']);
		
		if(!empty($country)&&!empty($government)&&!empty($city)&&!empty($shop_activity))
		{
			$query_shops="SELECT `id`, `shop_name`, `country`, `address`, `description`, `user_id`, `photo`, `shop_activity`, `lat`, `log`, `allowed_products`, `allowed_offers`, `government`, `city` FROM `shop` WHERE `country`='{$country}' AND `government`='{$government}' AND `city`='{$city}' AND `approve`='1' ";
			$perform_query_shops=mysqli_query($connect,$query_shops);
			// echo $query_shops;
			$List_shops=array();
			$shop_rec=array();

			while($row_shops=mysqli_fetch_assoc($perform_query_shops))
			{

				if($shop_activity=="all")
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

				}else if($shop_activity=="returants")
				{
					//resturants here 
					/*****************************************************/
					$query_get_shops_activity="SELECT  `activity` FROM `shop_activities` WHERE `shop_id`='".$row_shops['id']."'";
					$perform_query_get_shops_activity=mysqli_query($connect,$query_get_shops_activity);

					// echo "".$query_get_shops_activity;

					while($rows_shops_activity=mysqli_fetch_assoc($perform_query_get_shops_activity))
					{
						if($rows_shops_activity['activity']=="مطاعم"||$rows_shops_activity['activity']==" العاب أطفال"||$rows_shops_activity['activity']=="حلويات")
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

							if(sizeof($List_shops)==0)
							{
								//push here allowed
									array_push($List_shops,$shop_rec);
							}else
							{
								for($i=0;$i<sizeof($List_shops);$i++)
								{
								
									if($List_shops[$i]["shop_id"]!=$shop_id)
									{
										//push here allowed
										array_push($List_shops,$shop_rec);
									}
								}
							}
							
							
									
						}else
						{
							
						}
					}
					/*****************************************************************************/
				}else if($shop_activity=="electronics")
				{
					//electornics here
					/*****************************************************/
					$query_get_shops_activity="SELECT  `activity` FROM `shop_activities` WHERE `shop_id`='".$row_shops['id']."'";
					$perform_query_get_shops_activity=mysqli_query($connect,$query_get_shops_activity);

					// echo "".$query_get_shops_activity;

					while($rows_shops_activity=mysqli_fetch_assoc($perform_query_get_shops_activity))
					{
						if($rows_shops_activity['activity']=="الموبايلات"||$rows_shops_activity['activity']=="إلكترونيات وكمبيوترات"||$rows_shops_activity['activity']=="أجهزة كهربية وإلكترونية"||$rows_shops_activity['activity']=="أدوات كهربية")
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

							if(sizeof($List_shops)==0)
							{
								//push here allowed
									array_push($List_shops,$shop_rec);
							}else
							{
								for($i=0;$i<sizeof($List_shops);$i++)
								{
								
									if($List_shops[$i]["shop_id"]!=$shop_id)
									{
										//push here allowed
										array_push($List_shops,$shop_rec);
									}
								}
							}
							
							
									
						}else
						{
							
						}
					}
					/*****************************************************************************/
				}else if($shop_activity=="carpets")
				{
					//carpets here
					/*****************************************************/
					$query_get_shops_activity="SELECT  `activity` FROM `shop_activities` WHERE `shop_id`='".$row_shops['id']."'";
					$perform_query_get_shops_activity=mysqli_query($connect,$query_get_shops_activity);

					// echo "".$query_get_shops_activity;

					while($rows_shops_activity=mysqli_fetch_assoc($perform_query_get_shops_activity))
					{
						if($rows_shops_activity['activity']=="أقمشة"||$rows_shops_activity['activity']=="سجاد ومفروشات")
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

							if(sizeof($List_shops)==0)
							{
								//push here allowed
									array_push($List_shops,$shop_rec);
							}else
							{
								for($i=0;$i<sizeof($List_shops);$i++)
								{
								
									if($List_shops[$i]["shop_id"]!=$shop_id)
									{
										//push here allowed
										array_push($List_shops,$shop_rec);
									}
								}
							}
							
							
									
						}else
						{
							
						}
					}
					/*****************************************************************************/

				}else if($shop_activity=="clothes")
				{
					//clothes here
					/*****************************************************/
					$query_get_shops_activity="SELECT  `activity` FROM `shop_activities` WHERE `shop_id`='".$row_shops['id']."'";
					$perform_query_get_shops_activity=mysqli_query($connect,$query_get_shops_activity);

					// echo "".$query_get_shops_activity;

					while($rows_shops_activity=mysqli_fetch_assoc($perform_query_get_shops_activity))
					{
						if($rows_shops_activity['activity']=="ملابس أطفال"||$rows_shops_activity['activity']=="ملابس رجالي"||$rows_shops_activity['activity']=="ملابس حريمي"||$rows_shops_activity['activity']=="أحذية رجالي"||$rows_shops_activity['activity']=="أحذية حريمي"||$rows_shops_activity['activity']==""||$rows_shops_activity['activity']==""||$rows_shops_activity['activity']=="")
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

							if(sizeof($List_shops)==0)
							{
								//push here allowed
									array_push($List_shops,$shop_rec);
							}else
							{
								for($i=0;$i<sizeof($List_shops);$i++)
								{
								
									if($List_shops[$i]["shop_id"]!=$shop_id)
									{
										//push here allowed
										array_push($List_shops,$shop_rec);
									}
								}
							}
							
							
									
						}else
						{
							
						}
					}
					/*****************************************************************************/
					
				}

				



				

			}
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