<?php
	include_once("../../../php_includes/connection_db.php");
	
	if($_POST['do_action']=="edit_product")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);
	    //getting shop id
	    $shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
	    //getting the product _id
	    $product_id=mysqli_real_escape_string($connect,$_POST['product_id']);


	    $product_name=mysqli_real_escape_string($connect,$_POST['add_product_name']);
    	$product_price=mysqli_real_escape_string($connect,$_POST['add_product_price']);
    	$product_description=mysqli_real_escape_string($connect,$_POST['product_description']);
    
	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);


		$product_rec=array();


	    if($perform_query_user_credential)
	    {
	    	if(!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($shop_id)&&!empty($product_name)&&!empty($product_price)&&!empty($product_description))
	    	{
	 			$query_edit_product="UPDATE `products` SET `product_name`='{$product_name}',`product_price`='{$product_price}',`product_description`='{$product_description}' WHERE `id`='{$product_id}' AND `shop_id`='{$shop_id}' LIMIT 1";
	 			$perform_query_edit_product=mysqli_query($connect,$query_edit_product);
	 			if($perform_query_edit_product)
	 			{
	 				$message="تم تعديل بيانات  المنتج بنجاح.";
	 				$product_rec=array(
	 					"product_flag"=>"1",
	 					"message"=>$message
	 					);
	 			}else
	 			{
	 				$message="حدث خطأ أثناء تعديل بيانات المنتج.";
	 				$product_rec=array(
	 					"product_flag"=>"0",
	 					"message"=>$message
	 					);
	 			}					   		
	    	}else
	    	{
	    		$message="حدث خطأ أثناء تعديل بيانات المنتج.";
 				$product_rec=array(
 					"product_flag"=>"0",
 					"message"=>$message
 					);
	    	}
	    }else
	    {
	    	$message="حدث خطأ أثناء تعديل بيانات المنتج.";
			$product_rec=array(
				"product_flag"=>"0",
				"message"=>$message
				);
	    }

	    echo json_encode($product_rec,JSON_FORCE_OBJECT);
    }
?>    