<?php
	session_start();
    include_once("../../php_includes/connection_db.php");
    include_once("../../php_includes/funtions.php");	

    if($_POST['do_action']=="register")
    {
    	$user_name=mysqli_real_escape_string($connect, $_POST['user_name']);
    	$email=mysqli_real_escape_string($connect, $_POST['email']);
    	$password=mysqli_real_escape_string($connect, $_POST['password']);
    	$user_job=mysqli_real_escape_string($connect, $_POST['user_job']);
    	$user_status=mysqli_real_escape_string($connect, $_POST['user_status']);
    	$user_gender=mysqli_real_escape_string($connect, $_POST['user_gender']);
    	$user_title=mysqli_real_escape_string($connect, $_POST['user_title']);
    	$telephone1=mysqli_real_escape_string($connect, $_POST['telephone1']);
    	$telephone2=mysqli_real_escape_string($connect, $_POST['telephone2']);
    	$activation_code=generateRandomString();


    	
		$fileName = $_POST["user_photo"]; // The file name
		$ext="jpg";
		$Reg_info=array();

		if(!empty($user_name)&&!empty($email)&&!empty($password)&&!empty($user_job)&&!empty($user_status)&&!empty($user_gender)&&
			!empty($user_title)&&!empty($telephone1)&&!empty($telephone2)&&!empty($fileName)&&!empty($activation_code))
		{
		
			//check if the user already
			$query_check_user_exist="SELECT `id` FROM `users` WHERE `email`='$email'  LIMIT 1";
			$perform_query_check_user_exist=mysqli_query($connect,$query_check_user_exist);
			$check_email=mysqli_num_rows($perform_query_check_user_exist);
			if($check_email==0)
			{
				$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
				$query_add_user="INSERT INTO `users`(`user_name`, `email`, `password`, `photo`, `user_type`, `status`, `gender`,  `address` ,`telephone1`, `telephone2`,`code_activation`) 	VALUES ('{$user_name}','{$email}','{$password}','{$uploaded_name}','{$user_job}','{$user_status}','{$user_gender}','{$user_title}','{$telephone1}','{$telephone2}','{$activation_code}')";	
				// echo $query_add_user;
				$perform_query_add_user=mysqli_query($connect,$query_add_user);
				$user_id=mysqli_insert_id($connect);	
				if($perform_query_add_user)
					{
						//success

						/* check if there's an error with image */
						$folder_name=$user_id;
						if (!file_exists("../../images/users/$folder_name")) {
								mkdir("../../images/users/$folder_name", 0755);
							}

						$kaboom = explode(".", $fileName); // Split file name into an array using the dot
						$fileExt = end($kaboom); // Now target the last array element to get the file extension	

						//image error handling
						if (!$fileTmpLoc) 
						{ 
							// if file not chosen
						    $message="أختر صورة من فضلك.";
							
							$Reg_info=array(
								"reg_flag"=>"0",
								"message"=>$message
								);

						}
						 else if($fileSize > 5242880) 
						 { 
						 	// if file size is larger than 5 Megabytes
						    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
							$Reg_info=array(
								"reg_flag"=>"0",
								"message"=>$message
								);

						} 
						else if (!preg_match("/.(jpeg|jpg|png)$/i", $fileName) )
						 {
						    
						    // This condition is only if you wish to allow uploading of specific file types
						    $message="يجب ان تكون الصورة بهذه الامتدادات .jpeg, .jpg, or .png.";
							$Reg_info=array(
								"reg_flag"=>"0",
								"message"=>$message
								);
						} 
						else if ($fileErrorMsg == 1)
						 { 
						 	// if file upload error key is equal to 1
						    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						    $Reg_info=array(
								"reg_flag"=>"0",
								"message"=>$message
								);
						}

						$moveResult = file_put_contents("../../images/users/$folder_name/$uploaded_name",base64_decode($fileName));
						// Check to make sure the move result is true before continuing
						if ($moveResult != true) {
						    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						    $Reg_info=array(
								"reg_flag"=>"0",
								"message"=>$message
								);
						}


						//success message will be redirected
				    	$message="تمت إضافة المستخدم بنجاح.";
				    	$Reg_info=array(
								"reg_flag"=>"1",
								"message"=>$message
								);
				    	// mail with activation code 

				    	$ToEmail=$email;
						$header='Activation Code';
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
						                <h3>كود التفعيل:</h3>
						                <p>لتفعيل الحساب الخاص بكم ادخل الكود التالي&nbsp;:&nbsp;&nbsp;<span>{$activation_code}</span></p>
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
						//error query
					    $message="حدث خطا اثناء رفع البيانات حاول مرة اخري.";
						$Reg_info=array(
								"reg_flag"=>"0",
								"message"=>$message
								);
					}	
			}else
			{
				//error query
			    $message="هذا المستخدم موجود بالفعل.";
				$Reg_info=array(
						"reg_flag"=>"0",
						"message"=>$message
						);
			}
			
		}else{
			//error empty values
		    $message="حدث خطا اثناء رفع البيانات حاول مرة اخري.123";
			$Reg_info=array(
							"reg_flag"=>"0",
							"message"=>$message
							);
		}

		echo json_encode($Reg_info,JSON_FORCE_OBJECT);
    }
?>