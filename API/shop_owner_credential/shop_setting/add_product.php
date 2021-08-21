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

		//number of photo
		$number_of_photos=mysqli_real_escape_string($connect,$_POST['number_of_photos']);
		$product_photos=json_decode($_POST['product_photos']);

    	//image
    	$fileName =$product_photos->photo0;  // The file name
		
		$ext_main= "jpg";//get uploaded file extention
		
		$uploaded_name_main=date("hisa").''.md5(rand()).'.'.$ext_main;
		
		$product_rec=array();
		   


	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);


		$product_rec=array();


	    if($perform_query_user_credential)
	    {
	    	if(!empty($product_photos)&&!empty($number_of_photos)&&!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($shop_id)&&!empty($product_name)&&!empty($product_price)&&!empty($product_description))
	    	{
	    		$query_allowed_product="SELECT  `allowed_products` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
			    $perform_query_allowed_product=mysqli_query($connect,$query_allowed_product);
			    $product_row=mysqli_fetch_assoc($perform_query_allowed_product);

			    $query_allowed_product2="SELECT  `id` FROM `products` WHERE `shop_id`='{$shop_id}' LIMIT 1";
			    $perform_query_allowed_product2=mysqli_query($connect,$query_allowed_product2);
			    $allowed_product=mysqli_num_rows($perform_query_allowed_product2);
	    	
			    if($allowed_product <= $product_row['allowed_products'])
			    {
			    	if(!empty($product_photos->photo1))
					{
						$query_add_product_info="INSERT INTO `products`( `product_name`, `product_price`, `shop_id`, `product_photo`, `product_description`) VALUES ('{$product_name}','{$product_price}','{$shop_id}','{$uploaded_name_main}','{$product_description}')";
						$perform_query_add_product_info=mysqli_query($connect,$query_add_product_info);
						$product_id=mysqli_insert_id($connect);
						
						if($perform_query_add_product_info)
						{
							/* check if there's an error with image */
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
							    $message="يجب ان تكون الصورة بهذه الامتدادات .jpg, jpeg or .png.";
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
								$product_rec=array(
							    	"product_flag"=>"0",
							    	"message"=>$message
							    	);
							}
											
							$moveResult =file_put_contents("../../../images/users/$user_id/$shop_id/main_p_photo/$product_id/$uploaded_name_main",base64_decode($fileName));
							// Check to make sure the move result is true before continuing
							if ($moveResult != true) {
							    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
								@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
							    $product_rec=array(
							    	"product_flag"=>"0",
							    	"message"=>$message
							    	);
							}


							// Number of uploaded files
				    		$num_files = $number_of_photos;	
				    		
				    		// echo $product_name.' / '.$product_price.' / '.$product_description.' / '.$shop_id.' / '.$fileName.' / ';
				    		/** loop through the array of files ***/
					        $temp2=array();
					        $ext_rest=array();
					        $uploaded_name_rest=array();
					        for($i=1; $i < $num_files;$i++)
					        {
					        	$ext_rest[$i]= "jpg";//get uploaded file extention
								$uploaded_name_rest[$i]=date("hisa").''.md5(rand()).'.'.$ext_rest[$i];
					           	$query_addtional_photo="INSERT INTO `product_photos`(`p_id`, `photo_name`) VALUES ('$product_id','".$uploaded_name_rest[$i]."')";
					           	$perform_query_addtional_photo=mysqli_query($connect,$query_addtional_photo);
					           	if($perform_query_addtional_photo)
					           	{
					           		
						        	
						            /* check if there's an error with image */
								
									if (!file_exists("../../../images/users/$user_id/$shop_id/p_photos/$product_id")) {
											mkdir("../../../images/users/$user_id/$shop_id/p_photos/$product_id", 0755 ,true);
										}

									$kaboom = explode(".", $fileName_rest); // Split file name into an array using the dot
									$fileExt_rest = end($kaboom); // Now target the last array element to get the file extension	

									//image error handling
									if (!$fileTmpLoc_rest) 
									{ 
										// if file not chosen
									    $message="أختر صورة من فضلك.";
										$product_rec=array(
									    	"product_flag"=>"0",
									    	"message"=>$message
									    	);	
									}
									 else if($fileSize_rest > 5242880) 
									 { 
									 	// if file size is larger than 5 Megabytes
									    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
										@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
										$product_rec=array(
									    	"product_flag"=>"0",
									    	"message"=>$message
									    	);
									} 
									else if (!preg_match("/.(jpeg|jpg|png)$/i", $fileName_rest) )
									 {
									    
									    // This condition is only if you wish to allow uploading of specific file types    
									    $message="يجب ان تكون الصورة بهذه الامتدادات .jpeg, .jpg, or .png.";
										@unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
										$product_rec=array(
									    	"product_flag"=>"0",
									    	"message"=>$message
									    	);
									} 
									else if ($fileErrorMsg_rest == 1)
									 { 
									 	// if file upload error key is equal to 1
									    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
										$product_rec=array(
									    	"product_flag"=>"0",
									    	"message"=>$message
									    	);
									}


									if($i==1)
									{

										$moveResult_rest =file_put_contents("../../../images/users/$user_id/$shop_id/p_photos/$product_id/".$uploaded_name_rest[$i],base64_decode($product_photos->photo1));
									}else if($i==2)
									{

										$moveResult_rest =file_put_contents("../../../images/users/$user_id/$shop_id/p_photos/$product_id/".$uploaded_name_rest[$i],base64_decode($product_photos->photo2));
									}else if($i==3)
									{
										
										$moveResult_rest =file_put_contents("../../../images/users/$user_id/$shop_id/p_photos/$product_id/".$uploaded_name_rest[$i],base64_decode($product_photos->photo3));					
									}else if($i==4)
									{
										
										$moveResult_rest =file_put_contents("../../../images/users/$user_id/$shop_id/p_photos/$product_id/".$uploaded_name_rest[$i],base64_decode($product_photos->photo4));										
									}else if($i==5)
									{
										
										$moveResult_rest =file_put_contents("../../../images/users/$user_id/$shop_id/p_photos/$product_id/".$uploaded_name_rest[$i],base64_decode($product_photos->photo5));								
									}

														
									// Check to make sure the move result is true before continuing
									if ($moveResult_rest != true) {
									    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
										@unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
									    $product_rec=array(
									    	"product_flag"=>"0",
									    	"message"=>$message
									    	);
									}



					           	}else
					           	{
					           		//error
					           		$message="حدث خطا اثناء إضافة المنتج حاول مرة اخري.";
									@unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
								    $product_rec=array(
								    	"product_flag"=>"0",
								    	"message"=>$message
								    	);
					           	}
					            
					        }

					        //success message will be redirected
					        $message="تم إضافة النتج بنجاح.";
							@unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
						    $product_rec=array(
						    	"product_flag"=>"1",
						    	"message"=>$message
						    	);	

						}else
						{
							//error
			           		$message="حدث خطا اثناء إضافة المنتج حاول مرة اخري.";
							@unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
						    $product_rec=array(
						    	"product_flag"=>"0",
						    	"message"=>$message
						    	);
						}
					}else
					{
						//error
		           		$message="حدث خطا اثناء إضافة المنتج حاول مرة اخري.";
						@unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
					    $product_rec=array(
					    	"product_flag"=>"0",
					    	"message"=>$message
					    	);
					}


		    	}else
		    	{
		    		//number of allowed products
	           		$message="لقد تجاوزت عدد العروض التي يمكنك إضافتها لأضافة المزيد أتصل بخدمة العملاء.";
					@unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
				    $product_rec=array(
				    	"product_flag"=>"0",
				    	"message"=>$message
				    	);
		    	}
	    	}else
	    	{
	    		//error
           		$message="حدث خطا اثناء إضافة المنتج حاول مرة اخري.";
				@unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
			    $product_rec=array(
			    	"product_flag"=>"0",
			    	"message"=>$message
			    	);
	    	}
		
	}else{
		//error
   		$message="حدث خطا اثناء إضافة المنتج حاول مرة اخري.";
		@unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
	    $product_rec=array(
	    	"product_flag"=>"0",
	    	"message"=>$message
	    	);
	}
	echo json_encode($product_rec,JSON_FORCE_OBJECT);
}
?>