<?php
	include_once("../../../php_includes/connection_db.php");
	if($_POST['do_action']=="add_product")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);
	    //getting shop id
	    $shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
	    
	    $product_name=mysqli_real_escape_string($connect,$_POST['add_product_name']);
    	$product_price=mysqli_real_escape_string($connect,$_POST['add_product_price']);
    	$product_description=mysqli_real_escape_string($connect,$_POST['product_description']);

    	//image
    	$fileName =$_POST['product_photo'];
		$ext= "jpg";//get uploaded file extention

		$product_rec=array();	
		//check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);

	    $rowcredential=mysqli_num_rows($perform_query_user_credential);
	    if($rowcredential>0)
	    {
	    	//continue

	    	if(!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($shop_id)&&!empty($product_name)&&!empty($product_price)&&!empty($product_description)&&!empty($fileName))
	    	{
	    		$query_allowed_product="SELECT  `allowed_offers` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
			    $perform_query_allowed_product=mysqli_query($connect,$query_allowed_product);
			    $product_row=mysqli_fetch_assoc($perform_query_allowed_product);

			    $query_allowed_product2="SELECT `id` FROM `products` WHERE `shop_id`='{$shop_id}'";
			    $perform_query_allowed_product2=mysqli_query($connect,$query_allowed_product2);
			    $allowed_product=mysqli_num_rows($perform_query_allowed_product2);

			    if($allowed_product <= $product_row['allowed_offers'])
		    		{
		    			$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
		    			//query
						$query_add_product="INSERT INTO `products`(`product_name`, `product_price`, `shop_id`, `product_photo`, `product_description`) VALUES ('{$product_name}','{$product_price}','{$shop_id}','{$uploaded_name}','{$product_description}')";
						$perform_query_add_product=mysqli_query($connect,$query_add_product);
						$product_id=mysqli_insert_id($connect);

						if($perform_query_add_product)
						{
							if (!file_exists("../../../images/users/{$user_id}/{$shop_id}/main_p_photo/{$product_id}")) {
								mkdir("../../../images/users/{$user_id}/{$shop_id}/main_p_photo/{$product_id}", 0755 , true);
							}

							$kaboom = explode(".", $fileName); // Split file name into an array using the dot
							$fileExt = end($kaboom); // Now target the last array element to get the file extension	

							//image error handling
							if (!$fileTmpLoc) 
							{ 
								// if file not chosen
							    $message="أختر صورة من فضلك.";
								$product_rec=array(
								"product_flag"=>"0",
								"message"=>$message
								);
							}
							 else if($fileSize > 5242880) 
							 { 
							 	// if file size is larger than 5 Megabytes
							    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
								@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
								$product_rec=array(
								"product_flag"=>"0",
								"message"=>$message
								);	

							} 
							else if (!preg_match("/.(jpg|png|jpeg)$/i", $fileName) )
							 {
							    
							    // This condition is only if you wish to allow uploading of specific file types    
							   	$message="يجب ان تكون الصورة بهذه الامتدادات .jpg,jpeg or .png.";
								@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
								$product_rec=array(
								"product_flag"=>"0",
								"message"=>$message
								);

							} 
							else if ($fileErrorMsg == 1)
							 { 
							 	// if file upload error key is equal to 1
							    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
								header("location: add_offers.php?sid={$shop_id}");
								$product_rec=array(
								"product_flag"=>"0",
								"message"=>$message
								);
							}


							$moveResult = file_put_contents("../../../images/users/{$user_id}/{$shop_id}/main_p_photo/{$product_id}/{$uploaded_name}",base64_decode($fileName));
							// Check to make sure the move result is true before continuing
							if ($moveResult != true) {
							    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
								@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
							    $product_rec=array(
								"product_flag"=>"0",
								"message"=>$message
								);

							}

							//success message will be redirected
							$message="تمت إضافة العرض بنجاح.";
							$product_rec=array(
								"product_flag"=>"1",
								"message"=>$message
								);

						}else
						{
							$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
							$product_rec=array(
								"product_flag"=>"0",
								"message"=>$message
								);
							@unlink($fileTmpLoc);
						}



		    		}else
		    		{
		    			//not allowed
		    			$message="غير  مسموح لك بضافة المزيد من المنتجات للمزيد أتصل بخدمة العملاء.";
						$product_rec=array(
							"product_flag"=>"0",
							"message"=>$message
							);
						@unlink($fileTmpLoc);
		    		}
	    	}else
	    	{
	    		//error empty values
	    		$message="حدث خطأ أثناء رفع المنتج.";
				$product_rec=array(
					"product_flag"=>"0",
					"message"=>$message
					);
				@unlink($fileTmpLoc);
	    	}
	    	



	    }else
	    {
	    	//error credential
    		$message="يجب تسجيل الدخول قبل رفع المحل.";
			$product_rec=array(
				"product_flag"=>"0",
				"message"=>$message
				);
			@unlink($fileTmpLoc);
    }
    echo json_encode($product_rec,JSON_FORCE_OBJECT);
    }

?>