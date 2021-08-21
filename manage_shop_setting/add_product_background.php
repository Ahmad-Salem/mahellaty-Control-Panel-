	<?php
	session_start();
    include_once("../php_includes/connection_db.php");
    include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
	if(isset($_POST['login_sub']))
    {
 
    	$shop_id=mysqli_real_escape_string($connect,$_POST['shop_no']);
	    $query_allowed_product="SELECT  `allowed_products` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
	    $perform_query_allowed_product=mysqli_query($connect,$query_allowed_product);
	    $product_row=mysqli_fetch_assoc($perform_query_allowed_product);

	    $query_allowed_product2="SELECT  `id` FROM `products` WHERE `shop_id`='{$shop_id}' LIMIT 1";
	    $perform_query_allowed_product2=mysqli_query($connect,$query_allowed_product2);
	    $allowed_product=mysqli_num_rows($perform_query_allowed_product2);
	    /**** getting user id *****/
		$query_get_user_id="SELECT  `user_id` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
		$perform_query_get_user_id=mysqli_query($connect,$query_get_user_id);
		$row_user_id=mysqli_fetch_assoc($perform_query_get_user_id);
		$user_id=$row_user_id['user_id'];
		/***************************/


	    if($allowed_product <= $product_row['allowed_products'])
	    {
	       	$product_name=mysqli_real_escape_string($connect,$_POST['add_product_name']);
	    	$product_price=mysqli_real_escape_string($connect,$_POST['add_product_price']);
	    	$product_description=mysqli_real_escape_string($connect,$_POST['product_description']);
	    	
	    	//image
	    	$fileName = $_FILES["add_main_product_photo"]["name"]; // The file name
			$fileTmpLoc = $_FILES["add_main_product_photo"]["tmp_name"]; // File in the PHP tmp folder
			$fileType = $_FILES["add_main_product_photo"]["type"]; // The type of file it is
			$fileSize = $_FILES["add_main_product_photo"]["size"]; // File size in bytes
			$fileErrorMsg = $_FILES["add_main_product_photo"]["error"]; // 0 = false | 1 = true
			$ext_main= end(explode('.',$fileName));//get uploaded file extention
			$uploaded_name_main=date("hisa").''.md5(rand()).'.'.$ext_main;
			
			// echo $user_id;
			// echo $_FILES['add_products_photo']['name'][0];
			// echo $_FILES['add_products_photo']['name'][1];
			// echo $_FILES['add_products_photo']['name'][2];

				// !empty($_FILES['add_products_photo']['tmp_name'][0])
			if(!empty($product_name)&& preg_match('/^[0-9]*$/', $shop_id) && preg_match('/^[0-9]*$/', $product_price) && !empty($fileName)&& !empty($product_description))
			{

				
				$query_add_product_info="INSERT INTO `products`( `product_name`, `product_price`, `shop_id`, `product_photo`, `product_description`) VALUES ('{$product_name}','{$product_price}','{$shop_id}','{$uploaded_name_main}','{$product_description}')";
				$perform_query_add_product_info=mysqli_query($connect,$query_add_product_info);
				$product_id=mysqli_insert_id($connect);
				
				if($perform_query_add_product_info)
				{


					/* check if there's an error with image */
					
					if (!file_exists("../images/users/{$user_id}/{$shop_id}/main_p_photo/{$product_id}")) {
							mkdir("../images/users/{$user_id}/{$shop_id}/main_p_photo/{$product_id}", 0755 , true);
						}

					$kaboom = explode(".", $fileName); // Split file name into an array using the dot
					$fileExt = end($kaboom); // Now target the last array element to get the file extension	

					//image error handling
					if (!$fileTmpLoc) 
					{ 
						// if file not chosen
					    $_SESSION['Success_product_check']="false";
					    $message="أختر صورة من فضلك.";
						$_SESSION['message_product']=$message;
						header("location: add_product.phps_id={$shop_id}");
					}
					 else if($fileSize > 5242880) 
					 { 
					 	// if file size is larger than 5 Megabytes
					    $_SESSION['Success_product_check']="false";
					    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
						$_SESSION['message_product']=$message;
						unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						header("location: add_product.phps_id={$shop_id}");

					} 
					else if (!preg_match("/.(jpg|png|jpeg)$/i", $fileName) )
					 {
					    
					    // This condition is only if you wish to allow uploading of specific file types    
					    $_SESSION['Success_product_check']="false";
					    $message="يجب ان تكون الصورة بهذه الامتدادات .jpg, jpeg or .png.";
						$_SESSION['message_product']=$message;
						unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						header("location: add_product.phps_id={$shop_id}");
					} 
					else if ($fileErrorMsg == 1)
					 { 
					 	// if file upload error key is equal to 1
					    $_SESSION['Success_product_check']="false";
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$_SESSION['message_product']=$message;
					    header("location: add_product.phps_id={$shop_id}");
					}

					$moveResult = move_uploaded_file($fileTmpLoc, "../images/users/$user_id/$shop_id/main_p_photo/$product_id/$uploaded_name_main");
					// Check to make sure the move result is true before continuing
					if ($moveResult != true) {
					    $_SESSION['Success_product_check']="false";
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$_SESSION['message_product']=$message;
					    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					    header("location: add_product.phps_id={$shop_id}");
					}


					// Number of uploaded files
		    		// $num_files = count($_FILES['add_products_photo']['tmp_name']);	
		    		// echo $num_files;
		    		
		    		// echo $product_name.' / '.$product_price.' / '.$product_description.' / '.$shop_id.' / '.$fileName.' / ';
		    		/** loop through the array of files ***/
			        // $ext_rest=array();
			        // $uploaded_name_rest=array();
			   //      for($i=0; $i < $num_files;$i++)
			   //      {
			   //      	$fileName_rest = $_FILES["add_products_photo"]["name"][$i]; // The file name
			   //          $fileTmpLoc_rest = $_FILES["add_products_photo"]["tmp_name"][$i]; // File in the PHP tmp folder
			   //          $fileType_rest = $_FILES["add_products_photo"]["type"][$i]; // The type of file it is
			   //          $fileSize_rest = $_FILES["add_products_photo"]["size"][$i]; // File size in bytes
			   //          $fileErrorMsg_rest = $_FILES["add_products_photo"]["error"][$i]; // 0 = false | 1 = true
			   //          $ext_rest[$i]= end(explode('.',$fileName_rest));//get uploaded file extention
						// $uploaded_name_rest[$i]=date("hisa").''.md5(rand()).'.'.$ext_rest[$i];
			   //         	$query_addtional_photo="INSERT INTO `product_photos`(`p_id`, `photo_name`) VALUES ('$product_id','".$uploaded_name_rest[$i]."')";
			   //         	$perform_query_addtional_photo=mysqli_query($connect,$query_addtional_photo);
			   //         	if($perform_query_addtional_photo)
			   //         	{
			           		
				        	
				  //           /* check if there's an error with image */
						
						// 	if (!file_exists("../images/users/$user_id/$shop_id/p_photos/$product_id")) {
						// 			mkdir("../images/users/$user_id/$shop_id/p_photos/$product_id", 0755 ,true);
						// 		}

						// 	$kaboom = explode(".", $fileName_rest); // Split file name into an array using the dot
						// 	$fileExt_rest = end($kaboom); // Now target the last array element to get the file extension	

						// 	//image error handling
						// 	if (!$fileTmpLoc_rest) 
						// 	{ 
						// 		// if file not chosen
						// 	    $_SESSION['Success_product_check']="false";
						// 	    $message="أختر صورة من فضلك.";
						// 		$_SESSION['message_product']=$message;
						// 		header("location: add_product.php?s_id={$shop_id}");
						// 	}
						// 	 else if($fileSize_rest > 5242880) 
						// 	 { 
						// 	 	// if file size is larger than 5 Megabytes
						// 	    $_SESSION['Success_product_check']="false";
						// 	    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
						// 		$_SESSION['message_product']=$message;
						// 		unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						// 		header("location: add_product.php?s_id={$shop_id}");

						// 	} 
						// 	else if (!preg_match("/.(jpeg|jpg|png)$/i", $fileName_rest) )
						// 	 {
							    
						// 	    // This condition is only if you wish to allow uploading of specific file types    
						// 	    $_SESSION['Success_product_check']="false";
						// 	    $message="يجب ان تكون الصورة بهذه الامتدادات .jpeg, .jpg, or .png.";
						// 		$_SESSION['message_product']=$message;
						// 		@unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
						// 		header("location: add_product.php?s_id={$shop_id}");
						// 	} 
						// 	else if ($fileErrorMsg_rest == 1)
						// 	 { 
						// 	 	// if file upload error key is equal to 1
						// 	    $_SESSION['Success_product_check']="false";
						// 	    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						// 		$_SESSION['message_product']=$message;
						// 	    header("location: add_product.php?s_id={$shop_id}");
						// 	}

						// 	$moveResult_rest = move_uploaded_file($fileTmpLoc_rest, "../images/users/$user_id/$shop_id/p_photos/$product_id/".$uploaded_name_rest[$i]);
						// 	// Check to make sure the move result is true before continuing
						// 	if ($moveResult_rest != true) {
						// 	    $_SESSION['Success_product_check']="false";
						// 	    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						// 		$_SESSION['message_product']=$message;
						// 	    @unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
						// 	    header("location: add_product.php?s_id={$shop_id}");
						// 	}



			   //         	}else
			   //         	{
			   //         		//error
			   //         		$_SESSION['Success_product_check']="false";
						//     $message="حدث خطا اثناء إضافة المنتج حاول مرة اخري.";
						// 	$_SESSION['message_product']=$message;
						//     @unlink($fileTmpLoc_rest); // Remove the uploaded file from the PHP temp folder
						//     header("location: add_product.php?s_id={$shop_id}");
			   //         	}
			            
			   //      }

			        //success message will be redirected
					$_SESSION['Success_product_check']="true";
			    	$message="تمت إضافة المنتج بنجاح.";
					$_SESSION['message_product']=$message;
					@unlink($fileTmpLoc); 
			    	header("location: add_product.php?s_id={$shop_id}");



		
				}else
				{
					//error
					$_SESSION['Success_product_check']="false";
				    $message="حدث خطا اثناء إضافة المنتج حاول مرة اخري.";
					$_SESSION['message_product']=$message;
				    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				    header("location: add_product.php?s_id={$shop_id}");

				}

				

			
			}else
			{
				//error
				$_SESSION['Success_product_check']="false";
			    $message="حدث خطا اثناء إضافة المنتج حاول مرة اخري.";
				$_SESSION['message_product']=$message;
			    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			    header("location: add_product.php?s_id={$shop_id}");

				
			}




	    

	    }else
	    {

	    	//allowed product message
	    	$_SESSION['Success_product_check']="false";
		    $message="لقد تجاوزت عدد المنتجات المسموح بها";
			$_SESSION['message_product']=$message;
		    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		    header("location: add_product.php?s_id={$shop_id}");
	    }


    }else
	    {
	    	//error
	    	$_SESSION['Success_product_check']="false";
		    $message="حدث خطا اثناء إضافة المنتج حاول مرة اخري.";
			$_SESSION['message_product']=$message;
		    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		    header("location: add_product.php?s_id={$shop_id}");


	    }
?>