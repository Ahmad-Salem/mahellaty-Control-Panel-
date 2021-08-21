<?php
	include_once("../../../php_includes/connection_db.php");
	
	if($_POST['do_action']=="display_offers")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);
	    //getting shop id
	    $shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);


	    $List_offers=array();
		$offer_rec=array();	
	    if($perform_query_user_credential)
	    {
	    	if(!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($shop_id))
	    	{
	    		//getting offers info 
		    	$query_offers="SELECT `id`, `offer_name`, `offer_description`, `offer_photo`, `shop_id` FROM `offers` WHERE `shop_id`='$shop_id' limit 10";
		    	$perform_query_offers=mysqli_query($connect,$query_offers);
		    	while($offer_row=mysqli_fetch_assoc($perform_query_offers))
		    	{
		    		$offer_id=$offer_row['id'];
		    		$offer_name=$offer_row['offer_name'];
		    		$offer_description=$offer_row['offer_description'];
		    		$offer_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$user_id}/{$shop_id}/offers/{$offer_id}/".$offer_row['offer_photo'];
		    		$shop_id=$offer_row['shop_id'];
		    		
		    		$offer_rec=array(
		    			"offer_flag"=>"1",
		    			"offer_id"=>$offer_id,
		    			"offer_name"=>$offer_name,
		    			"offer_description"=>$offer_description,
		    			"offer_photo"=>$offer_photo,
		    			"shop_id"=>$shop_id,
		    			);
		    		array_push($List_offers,$offer_rec);
		    		
		    	}

	    	}else
	    	{
	    		$offer_rec=array(
	    			"offer_flag"=>"0",
	    			"offer_id"=>$offer_id,
	    			"offer_name"=>$offer_name,
	    			"offer_description"=>$offer_description,
	    			"offer_photo"=>$offer_photo,
	    			"shop_id"=>$shop_id,
	    			);
	    		array_push($List_offers,$offer_rec);		
	    	}
	    	

	    }else
	    {
	    	$offer_rec=array(
	    			"offer_flag"=>"0",
	    			"offer_id"=>$offer_id,
	    			"offer_name"=>$offer_name,
	    			"offer_description"=>$offer_description,
	    			"offer_photo"=>$offer_photo,
	    			"shop_id"=>$shop_id,
	    			);
	    	array_push($List_offers,$offer_rec);
	    }

	    echo json_encode($List_offers,JSON_FORCE_OBJECT);

	}    
?>