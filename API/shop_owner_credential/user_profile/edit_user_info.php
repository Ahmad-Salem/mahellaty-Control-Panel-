<?php
	include_once("../../../php_includes/connection_db.php");
	include_once("../../../php_includes/funtions.php");
    
    if($_POST['do_action']=="update_user_info")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);
	
	    //getting user information
	    $user_name=mysqli_real_escape_string($connect,$_POST['user_name']);
	    $gender=mysqli_real_escape_string($connect,$_POST['gender']);
     	$telephone1=mysqli_real_escape_string($connect,$_POST['telephone1']);
     	$telephone2=mysqli_real_escape_string($connect,$_POST['telephone2']);
 	 	$address=mysqli_real_escape_string($connect,$_POST['address']);

	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);
			    
	    
		$user_info_rec=array();	
	    
	    if($perform_query_user_credential)
	    {

			if(!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($user_name)&&!empty($telephone1)&&!empty($telephone2)&&!empty($address)&&!empty($gender))
		    {
		    	$query_user_update="UPDATE `users` SET `password`='{$password}' ,`user_name`='{$user_name}',`gender`='{$gender}',`telephone1`='{$telephone1}',`telephone2`='{$telephone2}',`address`='{$address}' WHERE `id`='{$user_id}' LIMIT 1";
		    	$perform_query_user_update=mysqli_query($connect,$query_user_update);
		    	if($perform_query_user_update)
		    	{
		    		$message="تم تعديل البيانات بنجاح.";
		    		$user_info_rec=array(
		    			"user_flag"=>"1",
		    			"message"=>$message
		    			);

		    	}else{
		    		$message="حدث خطأ أثناء تعدل المنتج.";
		    		$user_info_rec=array(
		    			"user_flag"=>"0",
		    			"message"=>$message
		    			);
		    	}
		    }else{

		    	$message="حدث خطأ أثناء تعدل المنتج.";
	    		$user_info_rec=array(
	    			"user_flag"=>"0",
	    			"message"=>$message
	    			);
		    }
		}else
		{
			$message="حدث خطأ أثناء تعدل المنتج.";
    		$user_info_rec=array(
    			"user_flag"=>"0",
    			"message"=>$message
    			);
		}

		echo json_encode($user_info_rec,JSON_FORCE_OBJECT);
	}
?>