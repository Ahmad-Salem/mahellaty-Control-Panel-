<?php
	session_start();
	include_once("../php_includes/connection_db.php");
	include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
	if(isset($_POST['login_sub']))
	{
		$shop_name=mysqli_real_escape_string($connect, $_POST['edit_shop_name']);
    	$shop_address=mysqli_real_escape_string($connect, $_POST['edit_shop_address']);
    	
    	//image
    	@$fileName = $_FILES["image_shop"]["name"]; // The file name
		@$fileTmpLoc = $_FILES["image_shop"]["tmp_name"]; // File in the PHP tmp folder
		@$fileType = $_FILES["image_shop"]["type"]; // The type of file it is
		@$fileSize = $_FILES["image_shop"]["size"]; // File size in bytes
		@$fileErrorMsg = $_FILES["image_shop"]["error"]; // 0 = false | 1 = true
		@$ext= end(explode('.',$_FILES["image_shop"]["name"]));//get uploaded file extention


    	$shop_country=mysqli_real_escape_string($connect,$_POST['country']);
    	$shop_activity=mysqli_real_escape_string($connect,$_POST['shop_activity']);
    	$shop_description=mysqli_real_escape_string($connect, $_POST['shop_description']);
    	$shop_latitude=mysqli_real_escape_string($connect, $_POST['latitude_name']);
    	$shop_longitude=mysqli_real_escape_string($connect, $_POST['longitude_name']);
    	$shop_allowed_products=mysqli_real_escape_string($connect, $_POST['allowed_product']);
    	$shop_allowed_offers=mysqli_real_escape_string($connect, $_POST['allowed_offer']);
    	$shop_government=mysqli_real_escape_string($connect, $_POST['government']);
    	$shop_city=mysqli_real_escape_string($connect, $_POST['city']);

    	$shop_id=mysqli_real_escape_string($connect,$_POST['shop_unique']);
    	/**** getting the user id from database *****/
		$query_get_user_id="SELECT  `user_id` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
		$perform_query_get_user_id=mysqli_query($connect,$query_get_user_id);
		$row_user_id=mysqli_fetch_assoc($perform_query_get_user_id);
		$user_id=$row_user_id['user_id'];
		/**************************************************/
    	if($shop_id=='')
    	{
    		header("location: ../manage_shops.php");
    	}
    	//testline
    	// echo $shop_city.'<br/>'.$shop_government.'<br/>'.$shop_country.'<br/>'.$shop_activity; 	
    	if(!empty($user_id) && !empty($shop_government) && !empty($shop_city) && !empty($shop_name) && !empty($shop_address) && !empty($shop_country) && !empty($shop_activity) && !empty($shop_description) && !empty($shop_latitude) && !empty($shop_longitude) && !empty($shop_latitude) && !empty($shop_longitude) && !empty($shop_allowed_products) && !empty($shop_allowed_products) && !empty($shop_allowed_offers) && !empty($shop_allowed_offers))
    	{
    		
    		// echo $shop_latitude.'********'.$shop_longitude;
    		if($fileName!=null)
	    	{

	    		//delete old picture
				$query_photo_name="SELECT `photo` FROM `shop` WHERE `user_id`='{$user_id}' AND `id`='{$shop_id}' LIMIT 1";
				$perform_query_photo_name=mysqli_query($connect,$query_photo_name);
				if($perform_query_photo_name)
				{
					
					$shop_row_photo=mysqli_fetch_assoc($perform_query_photo_name);
					$photo_name=$shop_row_photo['photo'];
					$path="../images/users/{$user_id}/{$shop_id}/{$photo_name}";
					// echo $path;
					unlink($path);
					
					
				}else
				{
					//error
					$_SESSION['Success_edit_shop_check']="false";
				    $message="أختر صورة من فضلك.";
					$_SESSION['message_shop_edit']=$message;
					header("location: edit_shop.php?s_id=".$shop_id."");
				}

				$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
	    		//perfrom query
	    		$query_edit_shop="UPDATE `shop` SET `shop_name`='{$shop_name}',`country`='{$shop_country}', `government`='{$shop_government}' , `city`='{$shop_city}' ,`address`='{$shop_address}',`description`='{$shop_description}',`user_id`='{$user_id}',`photo`='{$uploaded_name}',`shop_activity`='{$shop_activity}',`lat`='{$shop_latitude}',`log`='{$shop_longitude}',`allowed_products`='{$shop_allowed_products}' , `allowed_offers`='{$shop_allowed_offers}' WHERE `id`='{$shop_id}' LIMIT 1";
	    		$perfrom_query_edit_shop=mysqli_query($connect,$query_edit_shop);
	    		if($perfrom_query_edit_shop)
	    		{
	    			if (!file_exists("../images/users/$user_id/$shop_id")) {
						mkdir("../images/users/$user_id/$shop_id", 0755);
						}

					$kaboom = explode(".", $fileName); // Split file name into an array using the dot
					$fileExt = end($kaboom); // Now target the last array element to get the file extension	

					//image error handling
					if (!$fileTmpLoc) 
					{ 
						// if file not chosen
					    $_SESSION['Success_edit_shop_check']="false";
					    $message="أختر صورة من فضلك.";
						$_SESSION['message_shop_edit']=$message;
						header("location: edit_shop.php?s_id=".$shop_id."");
					}
					 else if($fileSize > 5242880) 
					 { 
					 	// if file size is larger than 5 Megabytes
					    $_SESSION['Success_edit_shop_check']="false";
					    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
						$_SESSION['message_shop_edit']=$message;
						unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						header("location: edit_shop.php?s_id=".$shop_id."");

					} 
					else if (!preg_match("/.(jpeg|jpg|png)$/i", $fileName) )
					 {
					    
					    // This condition is only if you wish to allow uploading of specific file types    
					    $_SESSION['Success_edit_shop_check']="false";
					    $message="يجب ان تكون الصورة بهذه الامتدادات .jpg,jpeg or .png.";
						$_SESSION['message_shop_edit']=$message;
						unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						header("location: edit_shop.php?s_id=".$shop_id."");
					} 
					else if ($fileErrorMsg == 1)
					 { 
					 	// if file upload error key is equal to 1
					    $_SESSION['Success_edit_shop_check']="false";
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$_SESSION['message_shop_edit']=$message;
					    header("location: edit_shop.php?s_id=".$shop_id."");
					}

					$moveResult = move_uploaded_file($fileTmpLoc, "../images/users/$user_id/$shop_id/$uploaded_name");
					// Check to make sure the move result is true before continuing
					if ($moveResult != true) {
					    $_SESSION['Success_edit_shop_check']="false";
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$_SESSION['message_shop_edit']=$message;
					    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					    header("location: edit_shop.php?s_id=".$shop_id."");
					}

					//successful process
					//success message will be redirected
					$_SESSION['Success_edit_shop_check']="true";
			    	$message="تمت تعديل بيانات  المحل بنجاح.";
					$_SESSION['message_shop_edit']=$message;
					@unlink($fileTmpLoc); 
			    	header("location: edit_shop.php?s_id=".$shop_id."");

	    		}else
	    		{
	    			//error
		    		$_SESSION['Success_edit_shop_check']="false";
				    $message="حدث خطا  حاول مرة اخري.";
					$_SESSION['message_shop_edit']=$message;
					@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					header("location: edit_shop.php?s_id=".$shop_id."");
	    		}
	    	}else
	    	{
	    		//perfrom query
	    		$query_edit_shop="UPDATE `shop` SET `shop_name`='{$shop_name}',`country`='{$shop_country}', `government`='{$shop_government}' , `city`='{$shop_city}' , `address`='{$shop_address}',`description`='{$shop_description}',`user_id`='{$user_id}',`shop_activity`='{$shop_activity}',`lat`='{$shop_latitude}',`log`='$shop_longitude',`allowed_products`='{$shop_allowed_products}' ,`allowed_offers`='{$shop_allowed_offers}' WHERE `id`='{$shop_id}' LIMIT 1";
	    		// echo $query_edit_shop;
	    		$perfrom_query_edit_shop=mysqli_query($connect,$query_edit_shop);
	    		if($perfrom_query_edit_shop)
	    		{
	    			//successfull updation process
	    			//success message will be redirected
					$_SESSION['Success_edit_shop_check']="true";
			    	$message="تمت تعديل بيانات  المحل بنجاح.";
					$_SESSION['message_shop_edit']=$message;
					@unlink($fileTmpLoc); 
			    	header("location: edit_shop.php?s_id=".$shop_id."");
	    		}else
	    		{
	    			//error
	    			$_SESSION['Success_edit_shop_check']="false";
				    $message="حدث خطا  حاول مرة اخري.";
					$_SESSION['message_shop_edit']=$message;
					@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					header("location: edit_shop.php?s_id=".$shop_id."");
	    		}
	    	}
    	}else
    	{
    		//error
    		$_SESSION['Success_edit_shop_check']="false";
		    $message="حدث خطا  حاول مرة اخري.";
			$_SESSION['message_shop_edit']=$message;
			@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			header("location: edit_shop.php?s_id=".$shop_id."");
    	}
    	
	}else
	{
		//error
		$_SESSION['Success_edit_shop_check']="false";
	    $message="حدث خطا  حاول مرة اخري.";
		$_SESSION['message_shop_edit']=$message;
		@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		header("location: edit_shop.php?s_id=".$shop_id."");
	}
?>