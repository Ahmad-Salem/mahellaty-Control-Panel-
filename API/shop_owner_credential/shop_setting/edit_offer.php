<?php
	include_once("../../../php_includes/connection_db.php");
	
	if($_POST['do_action']=="edit_offer")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);
	    //getting shop id
	    $shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
	    //getting the offer id
	    $offer_id=mysqli_real_escape_string($connect,$_POST['offer_id']);
	    
	    
	    $offer_name=mysqli_real_escape_string($connect,$_POST['offer_name']);
	    $offer_description=mysqli_real_escape_string($connect,$_POST['offer_description']);



	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);


	    $offer_rec=array();	
	    if($perform_query_user_credential)
	    {
	    	if(!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($shop_id)&&!empty($offer_name)&&!empty($offer_description))
	    	{
	    		$query_edit_offer="UPDATE `offers` SET `offer_name`='{$offer_name}',`offer_description`='{$offer_description}'WHERE `shop_id`='{$shop_id}' AND id='{$offer_id}' LIMIT 1";
				$perform_query_edit_offer=mysqli_query($connect,$query_edit_offer);
				if($perform_query_edit_offer)
				{
					$messgae="تم تعديل بيانات العرض بنجاح.";
					$offer_rec=array(
						"offer_edit_flage"=>"1",
						"message"=>$messgae
						);
				}else
				{
					$messgae="حدث خطأ أثناء تعديل بيانات العرض.";
					$offer_rec=array(
						"offer_edit_flage"=>"0",
						"message"=>$messgae
						);
				}	
	    	}else
	    	{
	    		$messgae="حدث خطأ أثناء تعديل بيانات العرض.";
				$offer_rec=array(
					"offer_edit_flage"=>"0",
					"message"=>$messgae
					);
	    	}
	    }else
	    {
	    	$messgae="حدث خطأ أثناء تعديل بيانات العرض.";
			$offer_rec=array(
				"offer_edit_flage"=>"0",
				"message"=>$messgae
				);
	    }
	    echo json_encode($offer_rec,JSON_FORCE_OBJECT);
	}
?>