<?php
	include_once("../../../php_includes/connection_db.php");
	
	if($_POST['do_action']=="display_shops")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);

	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);
	    
	    $List_shops=array();
		$shop_rec=array();	
	    
	    if($perform_query_user_credential)
	    {
	    	if(!empty($user_id)&&!empty($Email)&&!empty($password))
		    {
		    	//display shop information
		    	$query_display_shops="SELECT `id`, `shop_name`, `country`, `address`, `description`, `user_id`, `photo`, `shop_activity`, `lat`, `log`, `allowed_products`, `allowed_offers`, `government`, `city` FROM `shop` WHERE `user_id`='{$user_id}' LIMIT 20";
		    	$perform_query_display_shops=mysqli_query($connect,$query_display_shops);
		    	while($row_shops=mysqli_fetch_assoc($perform_query_display_shops))
		    	{
		    		$shop_id=$row_shops['id'];
		    		$shop_name=$row_shops['shop_name'];
		    		$shop_country=$row_shops['country'];
		    		$shop_address=$row_shops['address'];
		    		$shop_description=$row_shops['description'];
		    		$user_id=$row_shops['user_id'];
		    		$shop_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$user_id}/{$shop_id}/".$row_shops['photo'];
		    		$shop_activity=$row_shops['shop_activity'];
		    		$shop_lat=$row_shops['lat'];
		    		$shop_log=$row_shops['log'];
		    		$shop_allowed_products=$row_shops['allowed_products'];
		    		$shop_allowed_offers=$row_shops['allowed_offers'];
		    		$shop_government=$row_shops['government'];
		    		$shop_city=$row_shops['city'];
		    		
		    		$shop_rec=array(
	    			"shop_flag"=>"1",
					"shop_id"=>$shop_id,
					"shop_name"=>$shop_name,
					"shop_country"=>$shop_country,
					"shop_address"=>$shop_address,
					"shop_description"=>$shop_description,
					"user_id"=>$user_id,
					"shop_photo"=>$shop_photo,
					"shop_activity"=>$shop_activity,
					"shop_lat"=>$shop_lat,
					"shop_log"=>$shop_log,
					"shop_allowed_products"=>$shop_allowed_products,
					"shop_allowed_offers"=>$shop_allowed_offers,
					"shop_government"=>$shop_government,
					"shop_city"=>$shop_city
					);
					
					array_push($List_shops,$shop_rec);


		    	}
		    }else
		    {
		    	$shop_rec=array(
	    			"shop_flag"=>"0",
					"shop_id"=>null,
					"shop_name"=>null,
					"shop_country"=>null,
					"shop_address"=>null,
					"shop_description"=>null,
					"user_id"=>null,
					"shop_photo"=>null,
					"shop_activity"=>null,
					"shop_lat"=>null,
					"shop_log"=>null,
					"shop_allowed_products"=>null,
					"shop_allowed_offers"=>null,
					"shop_government"=>null,
					"shop_city"=>null
					);
					
					array_push($List_shops,$shop_rec);
		    }
	    }else
	    {
	    	$shop_rec=array(
	    			"shop_flag"=>"0",
					"shop_id"=>null,
					"shop_name"=>null,
					"shop_country"=>null,
					"shop_address"=>null,
					"shop_description"=>null,
					"user_id"=>null,
					"shop_photo"=>null,
					"shop_activity"=>null,
					"shop_lat"=>null,
					"shop_log"=>null,
					"shop_allowed_products"=>null,
					"shop_allowed_offers"=>null,
					"shop_government"=>null,
					"shop_city"=>null
					);
					
					array_push($List_shops,$shop_rec);
	    }

	    echo json_encode($List_shops,JSON_FORCE_OBJECT);
	    
	}
?>