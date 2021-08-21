<?php
	include_once("../../../php_includes/connection_db.php");
	include_once("../../../php_includes/funtions.php");
    include_once("../../../php_includes/deletedir.php");

	if($_POST['do_action']=="edit_main_product_photo")
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

	   //image
    	$fileName =$_POST['image_shop'];
		$ext= "jpg";//get uploaded file extention

		$uploaded_name_main=date("hisa").''.md5(rand()).'.'.$ext_main;


	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);
			    
	    
		$product_rec=array();	
	    
	    if($perform_query_user_credential)
	    {
			if(!empty($user_id)&&!empty($shop_id)&&!empty($product_id)&&!empty($Email)&&!empty($password)&&!empty($fileName))
		    {

		    	$query_product_update2="UPDATE `products` SET `product_photo`='{$uploaded_name_main}' WHERE `id`='{$product_id}' AND `shop_id`='{$shop_id}' LIMIT 1";
	    		// echo $query_product_update2;
	    		$perfrom_query_product_update2=mysqli_query($connect,$query_product_update2);
	    		$path="../../../images/users/$user_id/$shop_id/main_p_photo/$product_id";
				deleteDirectory($path);
				if($perfrom_query_product_update2)
	    		{
	    			//successful in quey execution q2
	    			/* check if there's an error with image */
					
					if (!file_exists("../../../images/users/$user_id/$shop_id/main_p_photo/$product_id")) {
							mkdir("../../../images/users/$user_id/$shop_id/main_p_photo/$product_id", 0755);
						}

					$kaboom = explode(".", $fileName); // Split file name into an array using the dot
					$fileExt = end($kaboom); // Now target the last array element to get the file extension	

					//image error handling
					if (!$fileTmpLoc) 
					{ 
						// if file not chosen
					    $message="أختر صورة من فضلك.";
						$product_rec=array(
						"product_edit_flage"=>"0",
						"message"=>$message
						);
					}
					 else if($fileSize > 5242880) 
					 { 
					 	// if file size is larger than 5 Megabytes
					    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
						@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						$product_rec=array(
						"product_edit_flage"=>"0",
						"message"=>$message
						);
					

					} 
					else if (!preg_match("/.(jpg|png|jpeg)$/i", $fileName) )
					 {
					    
					    // This condition is only if you wish to allow uploading of specific file types    
					    $message="يجب ان تكون الصورة بهذه الامتدادات .jpg, jpeg or .png.";
						@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						$product_rec=array(
						"product_edit_flage"=>"0",
						"message"=>$message
						);
						
					} 
					else if ($fileErrorMsg == 1)
					 { 
					 	// if file upload error key is equal to 1
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$product_rec=array(
						"product_edit_flage"=>"0",
						"message"=>$message
						);
					
					}

					
					$moveResult = file_put_contents("../../../images/users/$user_id/$shop_id/main_p_photo/$product_id/$uploaded_name_main",base64_decode($fileName));
					// Check to make sure the move result is true before continuing
					if ($moveResult != true) {
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					    $product_rec=array(
						"product_edit_flage"=>"0",
						"message"=>$message
						);
					
					}
					
					//successful updated
					$message="تمت تعديل المنتج بنجاح.";
					@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			    	$product_rec=array(
						"product_edit_flage"=>"1",
						"message"=>$message
						);
					
	
	    		}else
	    		{
	    			$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				    $product_rec=array(
					"product_edit_flage"=>"0",
					"message"=>$message
					);

			}	    		
			}else
			{
				$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
				@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			    $product_rec=array(
				"product_edit_flage"=>"0",
				"message"=>$message
				);
			}
		}else
		{
			$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
			@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		    $product_rec=array(
			"product_edit_flage"=>"0",
			"message"=>$message
			);
		}   
		echo json_encode($product_rec,JSON_FORCE_OBJECT);
	}
?>