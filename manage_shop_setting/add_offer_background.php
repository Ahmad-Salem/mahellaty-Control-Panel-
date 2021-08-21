<?php
	session_start();
    include_once("../php_includes/connection_db.php");
    include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");

    if(isset($_POST['login_sub']))
    {

    	$shop_id=mysqli_real_escape_string($connect,$_POST['shop_no']);
	    $query_allowed_offer="SELECT  `allowed_offers` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
	    $perform_query_allowed_offer=mysqli_query($connect,$query_allowed_offer);
	    $offer_row=mysqli_fetch_assoc($perform_query_allowed_offer);
	    /**** getting user id *****/
		$query_get_user_id="SELECT  `user_id` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
		$perform_query_get_user_id=mysqli_query($connect,$query_get_user_id);
		$row_user_id=mysqli_fetch_assoc($perform_query_get_user_id);
		$user_id=$row_user_id['user_id'];
		/***************************/
	    $query_allowed_offer2="SELECT  `id` FROM `offers` WHERE `shop_id`='{$shop_id}' LIMIT 1";
	    $perform_query_allowed_offer2=mysqli_query($connect,$query_allowed_offer2);
	    $allowed_offer=mysqli_num_rows($perform_query_allowed_offer2);

	    if($allowed_offer <= $offer_row['allowed_offers'])
	    {
	    	$offer_name=mysqli_real_escape_string($connect, $_POST['add_offer_name']);
	    	$offer_description=mysqli_real_escape_string($connect, $_POST['offer_description']);
	    	$offer_duration_from=$_POST['add_advertisement_duration_from'];
    		$offer_duration_to=$_POST['add_advertisement_duration_to'];
    		$main_page=mysqli_real_escape_string($connect, $_POST['offer_kind']);
    		

	  
	    	

	    	//image
	    	$fileName = $_FILES["add_offer_photo"]["name"]; // The file name
			$fileTmpLoc = $_FILES["add_offer_photo"]["tmp_name"]; // File in the PHP tmp folder
			$fileType = $_FILES["add_offer_photo"]["type"]; // The type of file it is
			$fileSize = $_FILES["add_offer_photo"]["size"]; // File size in bytes
			$fileErrorMsg = $_FILES["add_offer_photo"]["error"]; // 0 = false | 1 = true
			$ext= end(explode('.',$_FILES["add_offer_photo"]["name"]));//get uploaded file extention

			if(!empty($offer_name)&&!empty($offer_description)&&!empty($shop_id)&&!empty($fileName)&&!empty($user_id)&&!empty($offer_duration_from)&&!empty($offer_duration_to)&&!empty($main_page))
			{
				$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
				//query
				$query_add_offer="INSERT INTO `offers`(`offer_name`, `offer_description`, `offer_photo`, `shop_id`, `main_page`, `from_date`, `to_date`) VALUES ('{$offer_name}','{$offer_description}','{$uploaded_name}','{$shop_id}','{$main_page}','{$offer_duration_from}','{$offer_duration_to}')";
				$perform_query_add_offer=mysqli_query($connect,$query_add_offer);
				$offer_id=mysqli_insert_id($connect);
				if($perform_query_add_offer)
				{

					//sucess
	    			/* check if there's an error with image */
					
					if (!file_exists("../images/users/$user_id/$shop_id/offers/$offer_id")) {
							mkdir("../images/users/$user_id/$shop_id/offers/$offer_id", 0755 , true);
						}

					$kaboom = explode(".", $fileName); // Split file name into an array using the dot
					$fileExt = end($kaboom); // Now target the last array element to get the file extension	

					//image error handling
					if (!$fileTmpLoc) 
					{ 
						// if file not chosen
					    $_SESSION['Success_offer_check']="false";
					    $message="أختر صورة من فضلك.";
						$_SESSION['message_offer']=$message;
						header("location: add_offers.php?sid={$shop_id}");
					}
					 else if($fileSize > 5242880) 
					 { 
					 	// if file size is larger than 5 Megabytes
					    $_SESSION['Success_offer_check']="false";
					    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
						$_SESSION['message_offer']=$message;
						@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						header("location: add_offers.php?sid={$shop_id}");

					} 
					else if (!preg_match("/.(jpg|png|jpeg)$/i", $fileName) )
					 {
					    
					    // This condition is only if you wish to allow uploading of specific file types    
					    $_SESSION['Success_offer_check']="false";
					    $message="يجب ان تكون الصورة بهذه الامتدادات .jpg,jpeg or .png.";
						$_SESSION['message_offer']=$message;
						@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						header("location: add_offers.php?sid={$shop_id}");
					} 
					else if ($fileErrorMsg == 1)
					 { 
					 	// if file upload error key is equal to 1
					    $_SESSION['Success_offer_check']="false";
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$_SESSION['message_offer']=$message;
					    header("location: add_offers.php?sid={$shop_id}");
					}

					$moveResult = move_uploaded_file($fileTmpLoc, "../images/users/$user_id/$shop_id/offers/$offer_id/$uploaded_name");
					// Check to make sure the move result is true before continuing
					if ($moveResult != true) {
					    $_SESSION['Success_offer_check']="false";
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$_SESSION['message_offer']=$message;
					    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					    header("location: add_offers.php?sid={$shop_id}");
					}

					//success message will be redirected
					$_SESSION['Success_offer_check']="true";
			    	$message="تمت إضافة العرض بنجاح.";
					$_SESSION['message_offer']=$message;
					@unlink($fileTmpLoc); 
			    	header("location: add_offers.php?sid={$shop_id}");




				}else
				{
					//error
					$_SESSION['Success_offer_check']="false";
				    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					$_SESSION['message_offer']=$message;
				    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				    header("location: add_offers.php?sid={$shop_id}");
			}
			}else
			{
				//error
				$_SESSION['Success_offer_check']="false";
			    $message="حدث خطا اثناء إضافة العرض حاول مرة أخري.";
				$_SESSION['message_offer']=$message;
			    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			    header("location: add_offers.php?sid={$shop_id}");

			}
	    }else
	    {
	    	//error
			$_SESSION['Success_offer_check']="false";
		    $message="لقد تجاوزت عدد العروض التي يمكنك اضافتها.";
			$_SESSION['message_offer']=$message;
		    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		    header("location: add_offers.php?sid={$shop_id}");
	    }

    	
    }else
    {
    	$_SESSION['Success_offer_check']="false";
	    $message="حدث خطا اثناء إضافة العرض حاول مرة أخري.";
		$_SESSION['message_offer']=$message;
	    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	    header("location: add_offers.php?sid={$shop_id}");
    }
?>    