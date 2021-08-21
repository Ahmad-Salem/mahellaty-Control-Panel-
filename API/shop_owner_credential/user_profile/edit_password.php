<?php
	include_once("../../../php_includes/connection_db.php");
	include_once("../../../php_includes/funtions.php");
    
    if($_POST['do_action']=="edit_password")
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
	    		$query_update_password="UPDATE  `users` SET `password`='{$password}' WHERE `id`='{$user_id}' LIMIT 1";
	    		$perform_query_update_password=mysqli_query($connect,$perform_query_update_password);
	    		if($perform_query_update_password)
	    		{
	    			$messge="كلمة المرور صحيحة.";
	    			$user_info_rec=array(
	    				"user_pass_flage"=>"1",
	    				"message"=>$messge
	    				);
		    		// mail with activation code 

			    	$ToEmail=$email;
					$header='Password Updated.';
					$message_email="
						<html dir=\"rtl\" lang=\"ar\">
					    <head>
					        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
					        <title>Ma7laty</title>
					        <link href=\"https://fonts.googleapis.com/css?family=Cairo:300\" rel=\"stylesheet\">
					        <style type=\"text/css\">
					        body {font-family: 'Cairo', sans-serif;  margin: 0; padding: 0; min-width: 100%!important; direction: rtl; text-align:right;}
					        .content {width: 80%; max-width: 600px; margin:0px auto;background-color: #fafafa;}
					        .content .header{background-color: #00838f;padding:10px;}
					        .content .header .inside_header{width: 64px; margin: 0 auto;}  
					        .content .header img{width: 64px;height: 64px;}
					        .content .body{padding-right: 10px; color:#00838f;text-align:right;direction:rtl;}
					        .content .body p{font-weight: bolder;text-align:right;direction:rtl;}
					        .content .body span{color: blue; text-decoration: underline;text-align:right;direction:rtl;}
					        .content .footer{background-color: #00838f;padding: 10px;} 
					        .content .footer h4{text-align: center; color:#fff;}  
					        </style>
					    </head>
					    <body >
					        <div class=\"content\">
					            <div class=\"header\">
					            	<div class=\"inside_header\">
					            		<img src=\"http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/default_images/logo.png\" title=\"ma7alty\"/>
					            	</div>
					            </div>
					            <div class=\"body\">
					                <h3>تم تغير كلمة المرور الخاصة بكم بنجاح</h3>
					                <p>أرقام خدمة العملاء&nbsp;:&nbsp;&nbsp;<span>01002111402&nbsp;,&nbsp;01010100789&nbsp;,&nbsp;01019649797</span></p>
					                <p>مع تحيات إدارة محلاتي</p>
						                
					            </div>
					            <div class=\"footer\"><h4>جميع الحقوق محفوظة لدي محلاتي 2018</h4></div>    
					        </div>
					        
					    </body>
					</html>";

					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// Additional headers
					$headers .= 'From: ma7laty@ma7laty.com' . "\r\n";
					$headers .= 'Cc: ' . "\r\n";
					$headers .= 'Bcc: ' . "\r\n";

					mail($ToEmail,$header,$message_email,$headers);

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
	    }else{
	    	$messge="كلمة المرور غير صحيحة.";
			$user_info_rec=array(
				"user_pass_flage"=>"0",
				"message"=>$messge
				);
	    }

	    echo json_encode($user_info_rec,JSON_FORCE_OBJECT);
	}
?>