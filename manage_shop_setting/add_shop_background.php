<?php
	session_start();
    include_once("../php_includes/connection_db.php");
    include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");

    if(isset($_POST['login_sub']))
    {
    	$shop_name=mysqli_real_escape_string($connect, $_POST['add_shop_name']);
    	$shop_address=mysqli_real_escape_string($connect, $_POST['add_address']);
    	
    	//image
    	$fileName = $_FILES["image_shop"]["name"]; // The file name
		$fileTmpLoc = $_FILES["image_shop"]["tmp_name"]; // File in the PHP tmp folder
		$fileType = $_FILES["image_shop"]["type"]; // The type of file it is
		$fileSize = $_FILES["image_shop"]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES["image_shop"]["error"]; // 0 = false | 1 = true
		$temp=explode('.',$_FILES["image_shop"]["name"]);
		$ext= end($temp);//get uploaded file extention


    	$shop_country=mysqli_real_escape_string($connect, $_POST['country']);
    	$shop_activity=mysqli_real_escape_string($connect, $_POST['shop_activity']);
    	$shop_description=mysqli_real_escape_string($connect, $_POST['shop_description']);
    	$shop_latitude=mysqli_real_escape_string($connect, $_POST['latitude_name']);
    	$shop_longitude=mysqli_real_escape_string($connect, $_POST['longitude_name']);
    	$shop_government=mysqli_real_escape_string($connect, $_POST['government']);
    	$shop_city=mysqli_real_escape_string($connect, $_POST['city']);

    	if(!empty($shop_government) && !empty($shop_city) &&!empty($shop_name) && !empty($shop_address) && !empty($fileName) && !empty($shop_country) && !empty($shop_activity) && !empty($shop_description) && !empty($shop_latitude) && !empty($shop_longitude) && !empty($shop_latitude) && !empty($shop_longitude))
    	{
    		
    		// echo $_SESSION['user_id'];
    		$user_id=$_SESSION['user_id'];
    		$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
    		$query_add_shop="INSERT INTO `shop`( `shop_name`, `country`, `address`, `description`, `user_id`, `photo`, `shop_activity`, `lat`, `log`, `government`, `city`) VALUES ('{$shop_name}','{$shop_country}','{$shop_address}','{$shop_description}','{$user_id}','{$uploaded_name}','{$shop_activity}','{$shop_latitude}','{$shop_longitude}','{$shop_government}','{$shop_city}')";
    		$perform_query_add_shop=mysqli_query($connect,$query_add_shop);
    		$shop_id=mysqli_insert_id($connect);
    		if($perform_query_add_shop)
    		{
    			//sucess
    			/* check if there's an error with image */
				
				if (!file_exists("../images/users/$user_id/$shop_id")) {
						mkdir("../images/users/$user_id/$shop_id", 0755);
					}

				$kaboom = explode(".", $fileName); // Split file name into an array using the dot
				$fileExt = end($kaboom); // Now target the last array element to get the file extension	

				//image error handling
				if (!$fileTmpLoc) 
				{ 
					// if file not chosen
				    $_SESSION['Success_shop_check']="false";
				    $message="أختر صورة من فضلك.";
					$_SESSION['message_shop']=$message;
					header("location: add_shop.php");
				}
				 else if($fileSize > 5242880) 
				 { 
				 	// if file size is larger than 5 Megabytes
				    $_SESSION['Success_shop_check']="false";
				    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
					$_SESSION['message_shop']=$message;
					unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					header("location: add_shop.php");

				} 
				else if (!preg_match("/.(jpg|png|jpeg)$/i", $fileName) )
				 {
				    
				    // This condition is only if you wish to allow uploading of specific file types    
				    $_SESSION['Success_shop_check']="false";
				    $message="يجب ان تكون الصورة بهذه الامتدادات .jpg,jpeg or .png.";
					$_SESSION['message_shop']=$message;
					unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					header("location: add_shop.php");
				} 
				else if ($fileErrorMsg == 1)
				 { 
				 	// if file upload error key is equal to 1
				    $_SESSION['Success_shop_check']="false";
				    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					$_SESSION['message_shop']=$message;
				    header("location: add_shop.php");
				}

				$moveResult = move_uploaded_file($fileTmpLoc, "../images/users/$user_id/$shop_id/$uploaded_name");
				// Check to make sure the move result is true before continuing
				echo $moveResult;
				if ($moveResult != true) {
				    $_SESSION['Success_shop_check']="false";
				    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					$_SESSION['message_shop']=$message;
				    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				    header("location: add_shop.php");
				}else
				{
					//success message will be redirected
					$_SESSION['Success_shop_check']="true";
			    	$message="تمت إضافة المحل بنجاح.";
					$_SESSION['message_shop']=$message;
					unlink($fileTmpLoc); 
			    	header("location: add_shop.php");
	
				}
	
				
    		}else
    		{
    			//error in performing query
    			//error query
				$_SESSION['Success_shop_check']="false";
			    $message="حدث خطا اثناء رفع البيانات حاول مرة اخري.";
				$_SESSION['message_shop']=$message;
				@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				header("location: add_shop.php");
    		}

    	}else
    	{
    		$_SESSION['Success_shop_check']="false";
		    $message="حدث خطا  حاول مرة اخري.";
			$_SESSION['message_shop']=$message;
			@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			header("location: add_shop.php");
    	}

    }else
    {
    	$_SESSION['Success_shop_check']="false";
	    $message="حدث خطا  حاول مرة اخري.";
		$_SESSION['message_shop']=$message;
		@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		header("location: add_shop.php");
    }
?>