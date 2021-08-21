<?php
	include_once("../../../php_includes/connection_db.php");
	
	if($_POST['do_action']=="add_offers")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);
	    //getting shop id
	    $shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
	    
	    
	    $offer_name=mysqli_real_escape_string($connect,$_POST['offer_name']);
	    $offer_description=mysqli_real_escape_string($connect,$_POST['offer_description']);

	    //image
    	$fileName =$_POST['image_offer'];
		$ext= "jpg";//get uploaded file extention

	   


	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);


	    $offer_rec=array();	
	    if($perform_query_user_credential)
	    {
	    	if(!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($shop_id)&&!empty($offer_name)&&!empty($offer_description)&&!empty($fileName))
	    	{

	    		$query_allowed_offer="SELECT  `allowed_offers` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
			    $perform_query_allowed_offer=mysqli_query($connect,$query_allowed_offer);
			    $offer_row=mysqli_fetch_assoc($perform_query_allowed_offer);

			    $query_allowed_offer2="SELECT  `id` FROM `offers` WHERE `shop_id`='{$shop_id}' ";
			    $perform_query_allowed_offer2=mysqli_query($connect,$query_allowed_offer2);
			    $allowed_offer=mysqli_num_rows($perform_query_allowed_offer2);


			    if($allowed_offer <= $offer_row['allowed_offers'])
	    		{
	    			$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
					//query
					$query_add_offer="INSERT INTO `offers`(`offer_name`, `offer_description`, `offer_photo`, `shop_id`) VALUES ('{$offer_name}','{$offer_description}','{$uploaded_name}','{$shop_id}')";
					$perform_query_add_offer=mysqli_query($connect,$query_add_offer);
					$offer_id=mysqli_insert_id($connect);
					if($perform_query_add_offer)
					{
						if (!file_exists("../../../images/users/$user_id/$shop_id/offers/$offer_id")) {
							mkdir("../../../images/users/$user_id/$shop_id/offers/$offer_id", 0755 , true);
						}

						$kaboom = explode(".", $fileName); // Split file name into an array using the dot
						$fileExt = end($kaboom); // Now target the last array element to get the file extension	

						//image error handling
						if (!$fileTmpLoc) 
						{ 
							// if file not chosen
						    $message="أختر صورة من فضلك.";
							$offer_rec=array(
							"add_offer_flag"=>"0",
							"message"=>$message
							);
						}
						 else if($fileSize > 5242880) 
						 { 
						 	// if file size is larger than 5 Megabytes
						    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
							@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
							$offer_rec=array(
							"add_offer_flag"=>"0",
							"message"=>$message
							);	

						} 
						else if (!preg_match("/.(jpg|png|jpeg)$/i", $fileName) )
						 {
						    
						    // This condition is only if you wish to allow uploading of specific file types    
						   	$message="يجب ان تكون الصورة بهذه الامتدادات .jpg,jpeg or .png.";
							@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
							$offer_rec=array(
							"add_offer_flag"=>"0",
							"message"=>$message
							);

						} 
						else if ($fileErrorMsg == 1)
						 { 
						 	// if file upload error key is equal to 1
						    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
							header("location: add_offers.php?sid={$shop_id}");
							$offer_rec=array(
							"add_offer_flag"=>"0",
							"message"=>$message
							);
						}


						$moveResult = file_put_contents("../../../images/users/$user_id/$shop_id/offers/$offer_id/$uploaded_name",base64_decode($fileName));
						// Check to make sure the move result is true before continuing
						if ($moveResult != true) {
						    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
							@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						    $offer_rec=array(
							"add_offer_flag"=>"0",
							"message"=>$message
							);

						}

						//success message will be redirected
						$message="تمت إضافة العرض بنجاح.";
						$offer_rec=array(
							"add_offer_flag"=>"1",
							"message"=>$message
							);

					}else
					{
						$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$offer_rec=array(
							"add_offer_flag"=>"0",
							"message"=>$message
							);
						@unlink($fileTmpLoc);
					}
	    		}else
	    		{
	    			$message="غير مسموح لك باضافة المزيد من العروض للمزيد اصت بخدمة العملاء.";
					$offer_rec=array(
						"add_offer_flag"=>"0",
						"message"=>$message
						);
					@unlink($fileTmpLoc);
	    		}
	    	}else
	    	{
    			$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					$offer_rec=array(
						"add_offer_flag"=>"0",
						"message"=>$message
						);
					@unlink($fileTmpLoc);
	    	}
	    }else
	    {
	    	$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
			$offer_rec=array(
				"add_offer_flag"=>"0",
				"message"=>$message
				);
			@unlink($fileTmpLoc);
	    }
	    echo json_encode($offer_rec,JSON_FORCE_OBJECT);
	}
?>	