<?php
	include_once("../../../php_includes/connection_db.php");
	include_once("../../../php_includes/funtions.php");
    	
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

    	

		//image
    	$fileName =$_POST['image_shop'];
		$ext= "jpg";//get uploaded file extention


	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);
			    
	    
		$shop_rec=array();	
	    
	    if($perform_query_user_credential)
	    {
			if(!empty($user_id)&&!empty($shop_id)&&!empty($Email)&&!empty($password)&&!empty($fileName))
		    {
		    	//delete old picture
				$query_photo_name="SELECT `photo` FROM `shop` WHERE `user_id`='{$user_id}' AND `id`='{$shop_id}' LIMIT 1";
				$perform_query_photo_name=mysqli_query($connect,$query_photo_name);
				if($perform_query_photo_name)
				{
					
					$shop_row_photo=mysqli_fetch_assoc($perform_query_photo_name);
					$photo_name=$shop_row_photo['photo'];
					$path="../../../images/users/{$user_id}/{$shop_id}/{$photo_name}";
					// echo $path;
					unlink($path);
					
					
				}else
				{
					//error
					$message="أختر صورة من فضلك.";
					$shop_rec=array(
						"shop_flag_main_photo"=>"0",
						"message"=>$message
						);
				}


				$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
	    		//perfrom query
	    		$query_edit_shop="UPDATE `shop` SET `photo`='{$uploaded_name}' WHERE `id`='{$shop_id}' LIMIT 1";
	    		$perfrom_query_edit_shop=mysqli_query($connect,$query_edit_shop);
	    		if($perfrom_query_edit_shop)
	    		{

	    			if (!file_exists("../../../images/users/$user_id/$shop_id")) {
						mkdir("../../../images/users/$user_id/$shop_id", 0755);
						}

					$kaboom = explode(".", $fileName); // Split file name into an array using the dot
					$fileExt = end($kaboom); // Now target the last array element to get the file extension	

					//image error handling
					if (!$fileTmpLoc) 
					{ 
						// if file not chosen
					    $message="أختر صورة من فضلك.";
						@unlink($fileTmpLoc); 
						$shop_rec=array(
							"shop_flag_main_photo"=>"0",
							"message"=>$message
							);
					}
					 else if($fileSize > 5242880) 
					 { 
					 	// if file size is larger than 5 Megabytes
					    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
						@unlink($fileTmpLoc); 
						$shop_rec=array(
							"shop_flag_main_photo"=>"0",
							"message"=>$message
							);

					} 
					else if (!preg_match("/.(jpeg|jpg|png)$/i", $fileName) )
					 {
					    
					    // This condition is only if you wish to allow uploading of specific file types    
					    $message="يجب ان تكون الصورة بهذه الامتدادات .jpg,jpeg or .png.";
						@unlink($fileTmpLoc); 
						$shop_rec=array(
							"shop_flag_main_photo"=>"0",
							"message"=>$message
							);
					} 
					else if ($fileErrorMsg == 1)
					 { 
					 	// if file upload error key is equal to 1
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						@unlink($fileTmpLoc); 
						$shop_rec=array(
							"shop_flag_main_photo"=>"0",
							"message"=>$message
							);
					}

					$moveResult = file_put_contents("../../../images/users/$user_id/$shop_id/$uploaded_name",base64_decode($fileName));
					// Check to make sure the move result is true before continuing
					if ($moveResult != true) {
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					    @unlink($fileTmpLoc); 
						$shop_rec=array(
							"shop_flag_main_photo"=>"0",
							"message"=>$message
							);
					}

					//successful process
					//success message will be redirected
					$message="تم تعديل صورة المحل بنجاح";
	    			@unlink($fileTmpLoc); 
					$shop_rec=array(
						"shop_flag_main_photo"=>"1",
						"message"=>$message
						);

	    		}else
	    		{
	    			$message="أختر صورة من فضلك.";
					$shop_rec=array(
						"shop_flag_main_photo"=>"0",
						"message"=>$message
						);
	    		}
		    }else
		    {
		    	//error
				$message="أختر صورة من فضلك.";
				$shop_rec=array(
					"shop_flag_main_photo"=>"0",
					"message"=>$message
					);
		    }
		}else
		{
			//error
			$message="أختر صورة من فضلك.";
			$shop_rec=array(
				"shop_flag_main_photo"=>"0",
				"message"=>$message
				);
		}
		
		echo json_encode($shop_rec,JSON_FORCE_OBJECT);
	}
?>	