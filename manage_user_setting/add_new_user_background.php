<?php
	session_start();
    include_once("../php_includes/connection_db.php");
    include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");

    if(isset($_POST['login_sub']))
    {

    	$name=mysqli_real_escape_string($connect, $_POST['add_name']);
    	$email=mysqli_real_escape_string($connect, $_POST['add_email']);
    	$password=mysqli_real_escape_string($connect, $_POST['add_password']);
    	//image
    	$fileName = $_FILES["image_user"]["name"]; // The file name
		$fileTmpLoc = $_FILES["image_user"]["tmp_name"]; // File in the PHP tmp folder
		$fileType = $_FILES["image_user"]["type"]; // The type of file it is
		$fileSize = $_FILES["image_user"]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES["image_user"]["error"]; // 0 = false | 1 = true
		$ext= end(explode('.',$_FILES["image_user"]["name"]));//get uploaded file extention

		$user_type=preg_replace('#[^a-z ]#i', '', $_POST['user_type']);
		$status=preg_replace('#[^a-z ]#i', '', $_POST['status']);
		$gender=preg_replace('#[^a-z ]#i', '', $_POST['gender']);

		$address=mysqli_real_escape_string($connect,$_POST['address']);
		$tele1=mysqli_real_escape_string($connect,$_POST['tele1']);
		$tele2=mysqli_real_escape_string($connect,$_POST['tele2']);

		// echo $name." / ".$email." / ".$fileName." / ".$user_type." / ".$status." / ".$gender." / ".$address." / ".$tele1." / ".$tele2;

		if(!empty($name)&&!empty($email)&&!empty($password)&&!empty($fileName)&&!empty($user_type)
			&&!empty($status)&&!empty($gender)&&!empty($address)&&!empty($tele1)&&!empty($tele2))
		{
			// echo $name." ".$email." ".$fileName." ".$user_id." ".$user_type." ".$status." ".$gender." ".$address." ".$tele1." ".$tele2;
				$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
				$query_add_user="INSERT INTO `users`(`user_name`, `email`, `password`, `photo`, `user_type`, `status`, `gender`,  `address` ,`telephone1`, `telephone2`) VALUES ('{$name}','{$email}','{$password}','{$uploaded_name}','{$user_type}','{$status}','{$gender}','{$address}','{$tele1}','{$tele2}')";
				$perform_query_add_user=mysqli_query($connect,$query_add_user);
				$user_id=mysqli_insert_id($connect);
				if($perform_query_add_user)
				{
					//success

					/* check if there's an error with image */
					$folder_name=$user_id;
					if (!file_exists("../images/users/$folder_name")) {
							mkdir("../images/users/$folder_name", 0755);
						}

					$kaboom = explode(".", $fileName); // Split file name into an array using the dot
					$fileExt = end($kaboom); // Now target the last array element to get the file extension	

					//image error handling
					if (!$fileTmpLoc) 
					{ 
						// if file not chosen
					    $_SESSION['Success_user_check']="false";
					    $message="أختر صورة من فضلك.";
						$_SESSION['message_user']=$message;
						header("location: add_new_user.php");
					}
					 else if($fileSize > 5242880) 
					 { 
					 	// if file size is larger than 5 Megabytes
					    $_SESSION['Success_user_check']="false";
					    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
						$_SESSION['message_user']=$message;
						unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						header("location: add_new_user.php");

					} 
					else if (!preg_match("/.(jpeg|jpg|png)$/i", $fileName) )
					 {
					    
					    // This condition is only if you wish to allow uploading of specific file types    
					    $_SESSION['Success_user_check']="false";
					    $message="يجب ان تكون الصورة بهذه الامتدادات .jpeg, .jpg, or .png.";
						$_SESSION['message_user']=$message;
						unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						header("location: add_new_user.php");
					} 
					else if ($fileErrorMsg == 1)
					 { 
					 	// if file upload error key is equal to 1
					    $_SESSION['Success_user_check']="false";
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$_SESSION['message_user']=$message;
					    header("location: add_new_user.php");
					}

					$moveResult = move_uploaded_file($fileTmpLoc, "../images/users/$folder_name/$uploaded_name");
					// Check to make sure the move result is true before continuing
					if ($moveResult != true) {
					    $_SESSION['Success_user_check']="false";
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$_SESSION['message_user']=$message;
					    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					    header("location: add_new_user.php");
					}


					//success message will be redirected
					$_SESSION['Success_user_check']="true";
			    	$message="تمت إضافة المستخدم بنجاح.";
					$_SESSION['message_user']=$message;
					unlink($fileTmpLoc); 
			    	header("location: add_new_user.php");

				}else
				{
					//error query
					$_SESSION['Success_user_check']="false";
				    $message="حدث خطا اثناء رفع البيانات حاول مرة اخري.";
					$_SESSION['message_pmessage_user_add_photo']=$message;
					@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					header("location: add_new_user.php");
				}

			
				
			
		}else{
			//error empty values
			$_SESSION['Success_user_check']="false";
		    $message="حدث خطا اثناء رفع البيانات حاول مرة اخري.";
			$_SESSION['message_user']=$message;
			header("location: add_new_user.php");
			// echo "not oki";
		}
    }
?>