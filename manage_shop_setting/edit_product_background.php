<?php
	session_start();
    include_once("../php_includes/connection_db.php");
    include_once("../php_includes/deletedir.php");
    include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
	if(isset($_POST['login_sub']))
    {
    	$product_name=mysqli_real_escape_string($connect,$_POST['edit_product_name']);
    	$product_price=mysqli_real_escape_string($connect,$_POST['edit_product_price']);
    	$product_description=mysqli_real_escape_string($connect,$_POST['product_description']);
    	$main_photo=$_FILES["edit_main_product_photo"]["name"];
    	$rest_photos_no=$_FILES['edit_products_photo']["name"][0];
    	$product_id=mysqli_real_escape_string($connect,$_POST['product_no']);
    	$shop_id=mysqli_real_escape_string($connect,$_POST['shop_no']);
    	/**** getting user id *****/
		$query_get_user_id="SELECT  `user_id` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
		$perform_query_get_user_id=mysqli_query($connect,$query_get_user_id);
		$row_user_id=mysqli_fetch_assoc($perform_query_get_user_id);
		$user_id=$row_user_id['user_id'];
		/***************************/

    
    	if(!empty($product_name)&&!empty($product_price)&&!empty($product_description)&&empty($main_photo)&&empty($rest_photos_no)&& preg_match('/^[0-9]*$/', $shop_id)&& preg_match('/^[0-9]*$/', $product_id))
    	{
    		$query_product_update1="UPDATE `products` SET `product_name`='{$product_name}',`product_price`='{$product_price}',`product_description`='{$product_description}' WHERE `id`='{$product_id}' AND `shop_id`='{$shop_id}' LIMIT 1";
    		$perfrom_query_product_update1=mysqli_query($connect,$query_product_update1);
    		if($perfrom_query_product_update1)
    		{
    			//successfull
    			$_SESSION['Success_update_product_check']="true";
		    	$message="تمت تعديل المنتج بنجاح.";
				$_SESSION['message_update_product']=$message; 
		    	header("location: edit_product.php?s_no={$shop_id}&p_no={$product_id}&&u_id={$user_id}");

    		}else
    		{
    			//error in query execution
    			$_SESSION['Success_update_product_check']="false";
			    $message="حدث خطا اثناء تعديل المنتج.";
				$_SESSION['message_update_product']=$message;
			    header("location: edit_product.php?s_no={$shop_id}&p_no={$product_id}&&u_id={$user_id}");

    		}
    		
    	}else if(!empty($product_name)&&!empty($product_price)&&!empty($product_description)&&!empty($main_photo)&&empty($rest_photos_no)&& preg_match('/^[0-9]*$/', $shop_id)&& preg_match('/^[0-9]*$/', $product_id))
    	{
    		
    		//image
	    	$fileName = $_FILES["edit_main_product_photo"]["name"]; // The file name
			$fileTmpLoc = $_FILES["edit_main_product_photo"]["tmp_name"]; // File in the PHP tmp folder
			$fileType = $_FILES["edit_main_product_photo"]["type"]; // The type of file it is
			$fileSize = $_FILES["edit_main_product_photo"]["size"]; // File size in bytes
			$fileErrorMsg = $_FILES["edit_main_product_photo"]["error"]; // 0 = false | 1 = true
			$ext_main= end(explode('.',$fileName));//get uploaded file extention
			$uploaded_name_main=date("hisa").''.md5(rand()).'.'.$ext_main;


    		$query_product_update2="UPDATE `products` SET `product_name`='{$product_name}',`product_photo`='{$uploaded_name_main}',`product_price`='{$product_price}',`product_description`='{$product_description}' WHERE `id`='{$product_id}' AND `shop_id`='{$shop_id}' LIMIT 1";
    		$perfrom_query_product_update2=mysqli_query($connect,$query_product_update2);
    		$path="../images/users/$user_id/$shop_id/main_p_photo/$product_id";
			deleteDirectory($path);		
    		// echo $query_product_update2;
    		if($perfrom_query_product_update2)
    		{
    			//successful in quey execution q2
    			


				/* check if there's an error with image */
					
					if (!file_exists("../images/users/$user_id/$shop_id/main_p_photo/$product_id")) {
							mkdir("../images/users/$user_id/$shop_id/main_p_photo/$product_id", 0755);
						}

					$kaboom = explode(".", $fileName); // Split file name into an array using the dot
					$fileExt = end($kaboom); // Now target the last array element to get the file extension	

					//image error handling
					if (!$fileTmpLoc) 
					{ 
						// if file not chosen
					    $_SESSION['Success_update_product_check']="false";
					    $message="أختر صورة من فضلك.";
						$_SESSION['message_update_product']=$message;
						header("location: edit_product.php?s_no={$shop_id}&p_no={$product_id}&&u_id={$user_id}");
					}
					 else if($fileSize > 5242880) 
					 { 
					 	// if file size is larger than 5 Megabytes
					    $_SESSION['Success_update_product_check']="false";
					    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
						$_SESSION['message_update_product']=$message;
						unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						header("location: edit_product.php?s_no={$shop_id}&p_no={$product_id}&&u_id={$user_id}");

					} 
					else if (!preg_match("/.(jpg|png|jpeg)$/i", $fileName) )
					 {
					    
					    // This condition is only if you wish to allow uploading of specific file types    
					    $_SESSION['Success_update_product_check']="false";
					    $message="يجب ان تكون الصورة بهذه الامتدادات .jpg, jpeg or .png.";
						$_SESSION['message_update_product']=$message;
						unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						header("location: edit_product.php?s_no={$shop_id}&p_no={$product_id}&&u_id={$user_id}");
					} 
					else if ($fileErrorMsg == 1)
					 { 
					 	// if file upload error key is equal to 1
					    $_SESSION['Success_update_product_check']="false";
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$_SESSION['message_update_product']=$message;
					    header("location: edit_product.php?s_no={$shop_id}&p_no={$product_id}&&u_id={$user_id}");
					}

					$moveResult = move_uploaded_file($fileTmpLoc, "../images/users/$user_id/$shop_id/main_p_photo/$product_id/$uploaded_name_main");
					// Check to make sure the move result is true before continuing
					if ($moveResult != true) {
					    $_SESSION['Success_update_product_check']="false";
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$_SESSION['message_update_product']=$message;
					    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					    header("location: edit_product.php?s_no={$shop_id}&p_no={$product_id}&&u_id={$user_id}");
					}


					
					$_SESSION['Success_update_product_check']="true";
			    	$message="تمت تعديل المنتج بنجاح.";
					$_SESSION['message_update_product']=$message; 
					 unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			    	header("location: edit_product.php?s_no={$shop_id}&p_no={$product_id}&&u_id={$user_id}");


    		}else
    		{
    			//error query
    			$_SESSION['Success_update_product_check']="false";
			    $message="حدث خطا اثناء تعديل المنتج حاول مرة اخري.";
				$_SESSION['message_update_product']=$message;
			    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			    header("location: edit_product.php?s_no={$shop_id}&p_no={$product_id}&&u_id={$user_id}");
    		}




    	
    	}else
    	{
    		//error
    		$_SESSION['Success_update_product_check']="false";
		    $message="حدث خطا اثناء تعديل المنتج حاول مرة اخري.";
			$_SESSION['message_update_product']=$message;
		    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		    header("location: edit_product.php?s_no={$shop_id}&p_no={$product_id}&&u_id={$user_id}");
    	}

    }else
    {
    	//error
		$_SESSION['Success_update_product_check']="false";
	    $message="حدث خطا اثناء تعديل المنتج حاول مرة اخري.";
		$_SESSION['message_update_product']=$message;
	    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	    header("location: edit_product.php?s_no={$shop_id}&p_no={$product_id}&&u_id={$user_id}");
    }
?>