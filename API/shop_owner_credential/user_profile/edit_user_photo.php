<?php
	include_once("../../../php_includes/connection_db.php");
	include_once("../../../php_includes/funtions.php");
    
    if($_POST['do_action']=="update_user_info")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);

	    //image
    	 //image
    	$fileName =$_POST['image_profile'];
		$ext= "jpg";//get uploaded file extention

	   
	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);
			    
	    
		$user_info_rec=array();	
	    
	    if($perform_query_user_credential)
	    {

			if(!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($fileName))
		    {

		    	//delete old picture
				$query_photo_name="SELECT `photo` FROM `users` WHERE `id`='{$user_id}' LIMIT 1";
				$perform_query_photo_name=mysqli_query($connect,$query_photo_name);
				if($perform_query_photo_name)
				{
					$user_row_photo=mysqli_fetch_assoc($perform_query_photo_name);
					$photo_name=$user_row_photo['photo'];
					$path="../../../images/users/{$user_id}/{$photo_name}";
					unlink($path);
					

					$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
					$query_update_user="UPDATE `users` SET  `photo`='{$uploaded_name}' WHERE `id`='{$user_id}' LIMIT 1";
					$perform_query_update_user=mysqli_query($connect,$query_update_user);
					if($perform_query_update_user)
					{
						/* check if there's an error with image */
						
						if (!file_exists("../../../images/users/$user_id")) {
								mkdir("../../../images/users/$user_id", 0755);
							}

						$kaboom = explode(".", $fileName); // Split file name into an array using the dot
						$fileExt = end($kaboom); // Now target the last array element to get the file extension	

						//image error handling
						if (@!$fileTmpLoc) 
						{ 
							// if file not chosen
						    $message="أختر صورة من فضلك.";
							$user_info_rec=array(
								"user_photo_flag"=>"0",
								"message"=>$message
								);
						}
						 else if($fileSize > 5242880) 
						 { 
						 	// if file size is larger than 5 Megabytes
						    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
							@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
							
							$user_info_rec=array(
								"user_photo_flag"=>"0",
								"message"=>$message
								);

						} 
						else if (!preg_match("/.(jpeg|jpg|png)$/i", $fileName) )
						 {
						    
						    // This condition is only if you wish to allow uploading of specific file types    
						    $message="يجب ان تكون الصورة بهذه الامتدادات .jpeg, .jpg, or .png.";
							@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
							$user_info_rec=array(
								"user_photo_flag"=>"0",
								"message"=>$message
								);
						} 
						else if ($fileErrorMsg == 1)
						 { 
						 	// if file upload error key is equal to 1
						    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
							$user_info_rec=array(
								"user_photo_flag"=>"0",
								"message"=>$message
								);
						}


						$moveResult = file_put_contents("../../../images/users/$user_id/$uploaded_name",base64_decode($fileName));
						// Check to make sure the move result is true before continuing
						if ($moveResult != true) {
						    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
							@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						    $user_info_rec=array(
								"user_photo_flag"=>"0",
								"message"=>$message
								);
						}
						@unlink($fileTmpLoc);
					}//end check of photo exists

					//succes
					//success message will be redirected
					$message="تمت تعديل المستخدم بنجاح.";
					$user_info_rec=array(
						"user_photo_flag"=>"1",
						"message"=>$message,
						"img_url"=>"http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/$user_id/$uploaded_name"
						);
					}else
					{
						$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
						$user_info_rec=array(
								"user_photo_flag"=>"0",
								"message"=>$message
								);
					}
				}else
				{
					//error
					//error empty values
					$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					$user_info_rec=array(
							"user_photo_flag"=>"0",
							"message"=>$message
							);
				}


			}else{
				$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
				$user_info_rec=array(
						"user_photo_flag"=>"0",
						"message"=>$message
						);
			}

		

		echo json_encode($user_info_rec,JSON_FORCE_OBJECT);
	}

?>