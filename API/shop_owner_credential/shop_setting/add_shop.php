<?php
	include_once("../../../php_includes/connection_db.php");
	
	if($_POST['do_action']=="add_shops")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);

	    $shop_name=mysqli_real_escape_string($connect, $_POST['add_shop_name']);
    	$shop_address=mysqli_real_escape_string($connect, $_POST['add_address']);
    	
    	//image
    	$fileName =$_POST['image_shop'];
		$ext= "jpg";//get uploaded file extention


    	$shop_country=mysqli_real_escape_string($connect, $_POST['country']);
    	$shop_activity=mysqli_real_escape_string($connect, $_POST['shop_activity']);
    	$shop_description=mysqli_real_escape_string($connect, $_POST['shop_description']);
    	$shop_latitude=mysqli_real_escape_string($connect, $_POST['latitude_name']);
    	$shop_longitude=mysqli_real_escape_string($connect, $_POST['longitude_name']);
    	$shop_government=mysqli_real_escape_string($connect, $_POST['government']);
    	$shop_city=mysqli_real_escape_string($connect, $_POST['city']);


	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);
	    
	    
		$shop_rec=array();	
	    
	    if($perform_query_user_credential)
	    {

	    	if(!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($shop_name)&&!empty($shop_address)&&!empty($fileName)&&!empty($shop_country)&&!empty($shop_activity)&&!empty($shop_description)&&!empty($shop_longitude)&&!empty($shop_latitude)&&!empty($shop_government)&&!empty($shop_city))
		    {
		    	$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
		    	$query_add_shop="INSERT INTO `shop`(`shop_name`, `country`, `address`, `description`, `user_id`, `photo`, `shop_activity`, `lat`, `log`, `government`, `city`) VALUES ('{$shop_name}','{$shop_country}','{$shop_address}','{$shop_description}','{$user_id}','{$uploaded_name}','{$shop_activity}','{$shop_latitude}','{$shop_longitude}','{$shop_government}','{$shop_city}')";
		    	$perform_query_add_shop=mysqli_query($connect,$query_add_shop);
		    	$shop_id=mysqli_insert_id($connect);
		    	if($perform_query_add_shop)
		    	{
		    		
    				//sucess
	    			/* check if there's an error with image */
					
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
						$shop_rec=array(
							"add_shop_flag"=>"0",
							"message"=>$message
							);
					}
					 else if($fileSize > 5242880) 
					 { 
					 	// if file size is larger than 5 Megabytes
					    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
						
						@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						
						$shop_rec=array(
							"add_shop_flag"=>"0",
							"message"=>$message
							);
					}  
					else if ($fileErrorMsg == 1)
					 { 
					 	// if file upload error key is equal to 1
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$shop_rec=array(
							"add_shop_flag"=>"0",
							"message"=>$message
							);
					}

					$moveResult = file_put_contents("../../../images/users/$user_id/$shop_id/$uploaded_name",base64_decode($fileName));
					// Check to make sure the move result is true before continuing
					if ($moveResult != true) {
					    
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						
						@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					    
					    $shop_rec=array(
							"add_shop_flag"=>"0",
							"message"=>$message
							);
					}
		
					//success message will be redirected
					$message="تمت إضافة المحل بنجاح.";
					@unlink($fileTmpLoc);
					$shop_rec=array(
							"add_shop_flag"=>"1",
							"message"=>$message
							);
		    	}else
		    	{
		    		$message="حدث خطأ أثناء رفع المحل.";
					@unlink($fileTmpLoc);
					$shop_rec=array(
							"add_shop_flag"=>"0",
							"message"=>$message
							);
		    	}
		    }else
		    {
		    	$message="حدث خطأ أثناء رفع المحل.";
				@unlink($fileTmpLoc);
				$shop_rec=array(
						"add_shop_flag"=>"0",
						"message"=>$message
						);
		    }
		}else
		{
			$message="حدث خطأ أثناء رفع المحل.";
			@unlink($fileTmpLoc);
			$shop_rec=array(
					"add_shop_flag"=>"0",
					"message"=>$message
					);

		}

		echo json_encode($shop_rec,JSON_FORCE_OBJECT);
	}    
?>