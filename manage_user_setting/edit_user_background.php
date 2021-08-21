<?php
	session_start();
    include_once("../php_includes/connection_db.php");
    include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
  
    if(isset($_POST['login_sub']))
    {
    	$name=mysqli_real_escape_string($connect, $_POST['edit_name']);
    	$email=mysqli_real_escape_string($connect, $_POST['edit_email']);
    	$password=mysqli_real_escape_string($connect, $_POST['edit_password']);
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

		$address=mysqli_real_escape_string($connect,$_POST['edit_adderss']);
		$tele1=mysqli_real_escape_string($connect,$_POST['edit_tel1']);
		$tele2=mysqli_real_escape_string($connect,$_POST['edit_tel2']);
		$user_id=mysqli_real_escape_string($connect,$_POST['user_id']);
		$folder_name=$user_id;
		// echo $fileName;
		// echo $user_id." / ".$name." / ".$email." / ".$fileName." / ".$user_type." / ".$status." / ".$gender." / ".$address." / ".$tele1."/ ".$tele2;
		
		// echo "location: edit_user.php?u_id=".$user_id;
		if(!empty($name)&&!empty($email)&&!empty($password)&&!empty($user_type)&& !empty($user_id)
			&&!empty($status)&&!empty($gender)&&!empty($address)&&!empty($tele1)&&!empty($tele2))
		{
			if($fileName!=null)
			{
				
				//delete old picture
				$query_photo_name="SELECT `photo` FROM `users` WHERE `id`='{$folder_name}' LIMIT 1";
				$perform_query_photo_name=mysqli_query($connect,$query_photo_name);
				if($perform_query_photo_name)
				{
					$user_row_photo=mysqli_fetch_assoc($perform_query_photo_name);
					$photo_name=$user_row_photo['photo'];
					$path="../images/users/{$folder_name}/{$photo_name}";
					unlink($path);
					
					
				}else
				{
					//error
					//error empty values
					$_SESSION['Success_user_check']="false";
				    $message="حدث خطا اثناء رفع البيانات حاول مرة اخري.";
					$_SESSION['message_user']=$message;
					header("location: edit_user.php?u_id=".$user_id);
				}
				$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
				$query_update_user="UPDATE `users` SET  `user_name`='{$name}',`email`='{$email}',`password`='{$password}',`photo`='{$uploaded_name}',`user_type`='{$user_type}',`status`='{$status}',`gender`='{$gender}',`telephone1`='{$tele1}',`telephone2`='{$tele2}',`address`='{$address}' WHERE `id`='{$user_id}' LIMIT 1";
						
			}else
			{
				$query_update_user="UPDATE `users` SET  `user_name`='{$name}',`email`='{$email}',`password`='{$password}',`user_type`='{$user_type}',`status`='{$status}',`gender`='{$gender}',`telephone1`='{$tele1}',`telephone2`='{$tele2}',`address`='{$address}' WHERE `id`='{$user_id}' LIMIT 1";
			}
			
			$perform_query_update_user=mysqli_query($connect,$query_update_user);
			if($perform_query_update_user)
			{
				if($fileName!="")
				{
					/* check if there's an error with image */
					
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
						header("location: edit_user.php?u_id=".$user_id);
					}
					 else if($fileSize > 5242880) 
					 { 
					 	// if file size is larger than 5 Megabytes
					    $_SESSION['Success_user_check']="false";
					    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
						$_SESSION['message_user']=$message;
						unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						header("location: edit_user.php?u_id=".$user_id);

					} 
					else if (!preg_match("/.(jpeg|jpg|png)$/i", $fileName) )
					 {
					    
					    // This condition is only if you wish to allow uploading of specific file types    
					    $_SESSION['Success_user_check']="false";
					    $message="يجب ان تكون الصورة بهذه الامتدادات .jpeg, .jpg, or .png.";
						$_SESSION['message_user']=$message;
						unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						header("location: edit_user.php?u_id=".$user_id);
					} 
					else if ($fileErrorMsg == 1)
					 { 
					 	// if file upload error key is equal to 1
					    $_SESSION['Success_user_check']="false";
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$_SESSION['message_user']=$message;
					    header("location: edit_user.php?u_id=".$user_id);
					}

					$moveResult = move_uploaded_file($fileTmpLoc, "../images/users/$folder_name/$uploaded_name");
					// Check to make sure the move result is true before continuing
					if ($moveResult != true) {
					    $_SESSION['Success_user_check']="false";
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$_SESSION['message_user']=$message;
					    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					    header("location: edit_user.php?u_id=".$user_id);
					}
					@unlink($fileTmpLoc);
				}//end check of photo exists

				//succes
				//success message will be redirected
				$_SESSION['Success_user_check']="true";
		    	$message="تمت تعديل المستخدم بنجاح.";
				$_SESSION['message_user']=$message;
		    	header("location: edit_user.php?u_id=".$user_id);

			}else
			{
				//error
				//error query
				$_SESSION['Success_user_check']="false";
			    $message="حدث خطا اثناء رفع البيانات حاول مرة اخري.";
				$_SESSION['message_pmessage_user_add_photo']=$message;
				unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				header("location: edit_user.php?u_id=".$user_id);
			}

		}else
		{
			//error
			//error empty values
			$_SESSION['Success_user_check']="false";
		    $message="حدث خطا اثناء رفع البيانات حاول مرة اخري.";
			$_SESSION['message_user']=$message;
			header("location: edit_user.php?u_id=".$user_id);
			// echo "not oki";
		}
    }
?>