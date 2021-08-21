<?php
	include_once("../../../php_includes/connection_db.php");
	
	if($_POST['do_action']=="edit_shop")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);
	    //getting the shop id
	    $shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);


	    $shop_name=mysqli_real_escape_string($connect, $_POST['add_shop_name']);
    	$shop_address=mysqli_real_escape_string($connect, $_POST['add_address']);
    	$shop_country=mysqli_real_escape_string($connect, $_POST['country']);
    	$shop_activity=mysqli_real_escape_string($connect, $_POST['shop_activity']);
    	$shop_description=mysqli_real_escape_string($connect, $_POST['shop_description']);
    	$shop_latitude=mysqli_real_escape_string($connect, $_POST['latitude_name']);
    	$shop_longitude=mysqli_real_escape_string($connect, $_POST['longitude_name']);
    	$shop_government=mysqli_real_escape_string($connect, $_POST['government']);
    	$shop_city=mysqli_real_escape_string($connect, $_POST['city']);

	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);
	    
	    
		$shop_rec=array();	
	    
	    if($perform_query_user_credential)
	    {
			if(!empty($user_id)&&!empty($shop_id)&&!empty($Email)&&!empty($password)&&!empty($shop_name)&&!empty($shop_address)&&!empty($shop_country)&&!empty($shop_activity)&&!empty($shop_description)&&!empty($shop_longitude)&&!empty($shop_latitude)&&!empty($shop_government)&&!empty($shop_city))
		    {

		    	$query_edit_shop="UPDATE `shop` SET `shop_name`='{$shop_name}',`country`='{$shop_country}', `government`='{$shop_government}' , `city`='{$shop_city}' ,`address`='{$shop_address}',`description`='{$shop_description}',`user_id`='{$user_id}',`shop_activity`='{$shop_activity}',`lat`='{$shop_latitude}',`log`='{$shop_longitude}'WHERE `id`='{$shop_id}' LIMIT 1";
	    		// echo $query_edit_shop;
	    		$perfrom_query_edit_shop=mysqli_query($connect,$query_edit_shop);
	    		if($perfrom_query_edit_shop)
	    		{
		    		//UPDATED SUCCESSFULLY
		    		$message="تمت تعديل المحل بنجاح.";
					
					$shop_rec=array(
							"edit_shop_flag"=>"1",
							"message"=>$message
							);

		    	}else
		    	{
		    		$message="حدث خطأ أثناء تعديل بيانات المحل.";
					
					$shop_rec=array(
							"edit_shop_flag"=>"0",
							"message"=>$message
							);
		    	}
		    }else
		    {
		    	$message="حدث خطأ أثناء تعديل بيانات المحل.";
					
				$shop_rec=array(
						"edit_shop_flag"=>"0",
						"message"=>$message
						);
		    }
		}else
		{
			$message="حدث خطأ أثناء تعديل بيانات المحل.";
					
			$shop_rec=array(
					"edit_shop_flag"=>"0",
					"message"=>$message
					);
		}
		echo json_encode($shop_rec,JSON_FORCE_OBJECT);
    }
?>