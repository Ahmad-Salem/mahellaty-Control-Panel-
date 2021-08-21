<?php
	session_start();
    include_once("../../../php_includes/connection_db.php");
    include_once("../../../php_includes/funtions.php");	

    if($_POST['do_action']=="check_activation")
	{

		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
	    //getting Activation code
	    $activation_code=mysqli_real_escape_string($connect,$_POST['activation_code']);
	    
	  
	    if(!empty($Email)&&!empty($activation_code))
	    {
	    	$check_activation_rec=array();
	    	$query_getting_activation_code="SELECT  `code_activation` FROM `users` WHERE `email`='{$Email}' LIMIT 1";
	    	$perfrom_query_getting_activation_code=mysqli_query($connect,$query_getting_activation_code);
	    	if($perfrom_query_getting_activation_code)
	    	{
	    		$activation_code_db_assoc=mysqli_fetch_assoc($perfrom_query_getting_activation_code);
	    		$activation_code_db=$activation_code_db_assoc['code_activation'];

	    		// echo $activation_code_db;
	    		// echo $activation_code;
	    		

	    		if($activation_code==$activation_code_db)
		    	{

		    		//query to update activation status
		    		$query_check_activation="UPDATE `users` SET `activated`='1' WHERE  `email`='{$Email}' LIMIT 1";
		    		$perform_query_check_activation=mysqli_query($connect,$query_check_activation);
		    		if($perform_query_check_activation)
		    		{
		    			//go to main screen
		    			$message="تم تفعيل الحساب بنجاح.";
						$check_activation_rec=array(
							"check_activation_flag"=>"1",
							"message"=>$message
							);
		    		}else
		    		{
		    			//error
		    			$message="حدث خطأ أثناء تفيل الحساب.";
						$check_activation_rec=array(
							"check_activation_flag"=>"0",
							"message"=>$message
							);

		    		}

		    	}else
		    	{
		    		//error
		    		$message="كود التفيل غير صحيح.";
					$check_activation_rec=array(
						"check_activation_flag"=>"0",
						"message"=>$message
						);		
		    	}
	    	}else
	    	{
	    		//error
	    		$message="حدث خطأ أثناء تفيل الحساب.";
				$check_activation_rec=array(
					"check_activation_flag"=>"0",
					"message"=>$message
					);
	    	}
	    	
	    	
	    }else
	    {
	    	//error
	    	$message="حدث خطأ أثناء تفيل الحساب.";
			$check_activation_rec=array(
				"check_activation_flag"=>"0",
				"message"=>$message
				);
	    }

	    echo json_encode($check_activation_rec,JSON_FORCE_OBJECT);
	}
?>