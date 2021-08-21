<?php
	include_once("../../../php_includes/connection_db.php");
	include_once("../../../php_includes/funtions.php");
    include_once("../../../php_includes/deletedir.php");
	if($_POST['do_action']=="edit_rest_product_photo")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);
	    //getting the shop id
	    $shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
	    //getting the offer id
	    $product_id=mysqli_real_escape_string($connect,$_POST['product_id']);

	    	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);
			    
	    
		$product_rec=array();	
	    //number of photo
		$number_of_photos=mysqli_real_escape_string($connect,$_POST['number_of_photos']);
		$product_photos=json_decode($_POST['product_photos']);

		// Number of uploaded files
		$num_files = $number_of_photos;			
		

	    if($perform_query_user_credential)
	    {

			if(!empty($user_id)&&!empty($shop_id)&&!empty($product_id)&&!empty($Email)&&!empty($password)&&$num_files>0)
		    {

	    		
	    		$path="../../../images/users/$user_id/$shop_id/p_photos/$product_id";
				deleteDirectory($path);		
    			//successful query execution
    			//delete existing photos
    			$query_delete_exsisting_photo_products="DELETE FROM `product_photos` WHERE `p_id`='{$product_id}'";
    			$perform_query_delete_exsisting_photo_products=mysqli_query($connect,$query_delete_exsisting_photo_products);
    			if($perform_query_delete_exsisting_photo_products)
    			{
    				$ext_rest=array();
		        	$uploaded_name_rest=array();	
		    		/** loop through the array of files ***/
			        for($i=0; $i < $num_files;$i++)
			        {
			        	$ext_rest[$i]= "jpg";//get uploaded file extention
						$uploaded_name_rest[$i]=date("hisa").''.md5(rand()).'.'.$ext_rest[$i];
			            $query_addtional_photo="INSERT INTO `product_photos`(`p_id`, `photo_name`) VALUES ('$product_id','".$uploaded_name_rest[$i]."')";
			           	$perform_query_addtional_photo=mysqli_query($connect,$query_addtional_photo);
			           	if($perform_query_addtional_photo)
			           	{
			           		//sucessful

			           		/* check if there's an error with image */
							
							if (!file_exists("../../../images/users/$user_id/$shop_id/p_photos/$product_id")) {
									mkdir("../../../images/users/$user_id/$shop_id/p_photos/$product_id", 0755);
								}

							$kaboom = explode(".", $fileName_rest); // Split file name into an array using the dot
							$fileExt_rest = end($kaboom); // Now target the last array element to get the file extension	

							//image error handling
							if (!$fileTmpLoc_rest) 
							{ 
								// if file not chosen
							    $message="أختر صورة من فضلك.";
								$product_rec=array(
									"product_photo_rest_flage"=>"0",
									"message"=>$message
									);
							}
							 else if($fileSize_rest > 5242880) 
							 { 
							 	// if file size is larger than 5 Megabytes
							    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
								@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
								$product_rec=array(
									"product_photo_rest_flage"=>"0",
									"message"=>$message
									);

							} 
							else if (!preg_match("/.(jpg|png|jpeg)$/i", $fileName_rest) )
							 {
							    
							    // This condition is only if you wish to allow uploading of specific file types    
							    $message="يجب ان تكون الصورة بهذه الامتدادات .jpg, jpeg or .png.";
								@unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
								$product_rec=array(
									"product_photo_rest_flage"=>"0",
									"message"=>$message
									);
							} 
							else if ($fileErrorMsg_rest == 1)
							 { 
							 	// if file upload error key is equal to 1
							    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
								$product_rec=array(
									"product_photo_rest_flage"=>"0",
									"message"=>$message
									);
							}

							
							if($i==0){
								$moveResult_rest =file_put_contents("../../../images/users/$user_id/$shop_id/p_photos/$product_id/".$uploaded_name_rest[$i],base64_decode($product_photos->photo0));								
							}else if($i==1)
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
									"product_photo_rest_flage"=>"0",
									"message"=>$message
									);
							}




			           	}else
			           	{
			           		//error query
			    			$message="حدث خطا اثناء تعديل المنتج حاول مرة اخري.";
							@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						    $product_rec=array(
									"product_photo_rest_flage"=>"0",
									"message"=>$message
									);
			           	}
			        	

			        }

			        //sucessful updating
			        $message="تمت تعديل المنتج بنجاح.";
					@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			    	$product_rec=array(
									"product_photo_rest_flage"=>"1",
									"message"=>$message
									);
    			


				}else
			    {
			    	//error query
	    			$message="حدث خطا اثناء تعديل المنتج حاول مرة اخري.";
					@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				    $product_rec=array(
							"product_photo_rest_flage"=>"0",
							"message"=>$message
							);
			    }    	
		    }else
		    {
		    	//error query
    			$message="حدث خطا اثناء تعديل المنتج حاول مرة اخري.";
				@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			    $product_rec=array(
						"product_photo_rest_flage"=>"0",
						"message"=>$message
						);
		    }
		}else
		{
			//error query
			$message="حدث خطا اثناء تعديل المنتج حاول مرة اخري.";
			@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		    $product_rec=array(
					"product_photo_rest_flage"=>"0",
					"message"=>$message
					);
		}

		echo json_encode($product_rec,JSON_FORCE_OBJECT);
	}

?>