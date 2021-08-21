<?php
	include_once("../../../php_includes/connection_db.php");
	include_once("../../../php_includes/funtions.php");
    
    if($_POST['do_action']=="check_password")
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
			    
	    
		$user_info_rec=array();	
	    
	    if($perform_query_user_credential)
	    {
	    	if(!empty($user_id)&&!empty($Email)&&!empty($password))
	    	{
	    		$query_check_password="SELECT `password` FROM `users` WHERE `id`='{$user_id}' LIMIT 1";
		    	$perform_query_check_password=mysqli_query($connect,$query_check_password);
		    	if($perform_query_check_password)
		    	{
		    		$row_user=mysqli_fetch_assoc($perform_query_check_password);
		    		if($password==$row_user['password'])
		    		{
		    			$messge="كلمة المرور صحيحة.";
		    			$user_info_rec=array(
		    				"user_pass_flage"=>"1",
		    				"message"=>$messge
		    				);
		    		}else
		    		{
		    			$messge="كلمة المرور غير صحيحة.";
		    			$user_info_rec=array(
		    				"user_pass_flage"=>"0",
		    				"message"=>$messge
		    				);
		    		}
		    		
		    	}else
		    	{
		    		$messge="كلمة المرور غير صحيحة.";
	    			$user_info_rec=array(
	    				"user_pass_flage"=>"0",
	    				"message"=>$messge
	    				);
		    	}
	    	}else
	    	{
	    		$messge="كلمة المرور غير صحيحة.";
    			$user_info_rec=array(
    				"user_pass_flage"=>"0",
    				"message"=>$messge
    				);
	    	}
	    }else
	    {
	    	$messge="كلمة المرور غير صحيحة.";
			$user_info_rec=array(
				"user_pass_flage"=>"0",
				"message"=>$messge
				);
	    }
		echo json_encode($user_info_rec,JSON_FORCE_OBJECT);
	}
?>