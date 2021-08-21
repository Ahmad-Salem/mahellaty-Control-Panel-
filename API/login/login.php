<?php
	include_once("../../php_includes/connection_db.php");
	include_once("../../php_includes/funtions.php");
	
	if( $_POST['do_action']=="login_normal" )
	{
		if(!empty($_POST['email'])&&!empty($_POST['password']))
		{
			$login_info=array();
		    //getting email 
		    $Email=mysqli_real_escape_string($connect, $_POST['email']);
			//getting password
		    $password=mysqli_real_escape_string($connect,$_POST['password']);
		    
		    //check email exists 
		    $query_email_check="SELECT `id`, `user_name`, `email`, `password`, `photo`, `user_type`, `status`, `gender`, `telephone1`, `telephone2`, `address`, `code_activation`, `activated` FROM `users` WHERE `email`='$Email'  LIMIT 1";
		    $perform_query_email_check=mysqli_query($connect,$query_email_check);
		   	$row = mysqli_fetch_assoc($perform_query_email_check);
		    $check_email=mysqli_num_rows($perform_query_email_check);

		    if($check_email>0)
		    {
		    	
		    	//setting values 
		        $user_id=$row['id'];
		        $user_user_name=$row['user_name'];
		        $user_type=$row['user_type'];
		        $user_email=$row['email'];
		        $user_password=$row['password'];
		        $user_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$user_id}/".$row['photo'];
		        $user_status=$row['status'];
		        $user_gender=$row['gender'];
		        $user_telephone1=$row['telephone1'];
		        $user_telephone2=$row['telephone2'];
		        $user_address=$row['address'];
		        $user_code_activation=$row['code_activation'];
		        $user_activated=$row['activated'];



		        //setting password
		        $hashed_password=cryptPass($user_password);
		        
		        if(crypt($password, $hashed_password) == $hashed_password )
		        {
		        	
				        
		            
		            if($user_activated=="1")
		            {
		          		$login_info=array(
		          			"login_flag"=>"a",
		          			"user_id"=>$user_id,
		          			"user_user_name"=>$user_user_name,
		          			"user_type"=>$user_type,
		          			"user_email"=>$user_email,
		          			"user_password"=>$user_password,
		          			"user_photo"=>$user_photo,
		          			"user_status"=>$user_status,
		          			"user_gender"=>$user_gender,
		          			"user_telephone1"=>$user_telephone1,
		          			"user_telephone2"=>$user_telephone2,
		          			"user_address"=>$user_address,
		          			"user_code_activation"=>$user_code_activation,
		          			"user_activated"=>$user_activated,
		          			"message"=>"تم تسجيل الدخول بنجاح."
		          			);

		    	       

		        
		        		
		            }else if($user_activated=="0"){
		            	$login_info=array(
		          			"login_flag"=>"b",
		          			"user_id"=>$user_id,
		          			"user_user_name"=>$user_user_name,
		          			"user_type"=>$user_type,
		          			"user_email"=>$user_email,
		          			"user_password"=>$user_password,
		          			"user_photo"=>$user_photo,
		          			"user_status"=>$user_status,
		          			"user_gender"=>$user_gender,
		          			"user_telephone1"=>$user_telephone1,
		          			"user_telephone2"=>$user_telephone2,
		          			"user_address"=>$user_address,
		          			"user_code_activation"=>$user_code_activation,
		          			"user_activated"=>$user_activated,
		          			"message"=>"يجب كتابة كود التفعيل"
		          			);

		            }else
		            {

		         		$login_info=array(
		          			"login_flag"=>"c",
		          			"user_id"=>null,
		          			"user_user_name"=>null,
		          			"user_type"=>null,
		          			"user_email"=>null,
		          			"user_password"=>null,
		          			"user_photo"=>null,
		          			"user_status"=>null,
		          			"user_gender"=>null,
		          			"user_telephone1"=>null,
		          			"user_telephone2"=>null,
		          			"user_address"=>null,
		          			"user_code_activation"=>null,
		          			"user_activated"=>null,
		          			"message"=>"البريد الألكتروني أو كلمة المرور خطأ."
		          			);
	   	
		            }
		            
		 			
		        }else
		        {
		            $login_info=array(
		          			"login_flag"=>"c",
		          			"user_id"=>null,
		          			"user_user_name"=>null,
		          			"user_type"=>null,
		          			"user_email"=>null,
		          			"user_password"=>null,
		          			"user_photo"=>null,
		          			"user_status"=>null,
		          			"user_gender"=>null,
		          			"user_telephone1"=>null,
		          			"user_telephone2"=>null,
		          			"user_address"=>null,
		          			"user_code_activation"=>null,
		          			"user_activated"=>null,
		          			"message"=>"البريد الألكتروني أو كلمة المرور خطأ."
		          			);

		            
		        }
		    }else
		    {
		        $login_info=array(
		          			"login_flag"=>"c",
		          			"user_id"=>null,
		          			"user_user_name"=>null,
		          			"user_type"=>null,
		          			"user_email"=>null,
		          			"user_password"=>null,
		          			"user_photo"=>null,
		          			"user_status"=>null,
		          			"user_gender"=>null,
		          			"user_telephone1"=>null,
		          			"user_telephone2"=>null,
		          			"user_address"=>null,
		          			"user_code_activation"=>null,
		          			"user_activated"=>null,
		          			"message"=>"البريد الألكتروني أو كلمة المرور خطأ."
		          			);
		    }
		}else
		{
			$login_info=array(
		          			"login_flag"=>"c",
		          			"user_id"=>null,
		          			"user_user_name"=>null,
		          			"user_type"=>null,
		          			"user_email"=>null,
		          			"user_password"=>null,
		          			"user_photo"=>null,
		          			"user_status"=>null,
		          			"user_gender"=>null,
		          			"user_telephone1"=>null,
		          			"user_telephone2"=>null,
		          			"user_address"=>null,
		          			"user_code_activation"=>null,
		          			"user_activated"=>null,
		          			"message"=>"البريد الألكتروني أو كلمة المرور خطأ."
		          			);
		}

		


	    echo json_encode($login_info,JSON_FORCE_OBJECT);
	}
?>