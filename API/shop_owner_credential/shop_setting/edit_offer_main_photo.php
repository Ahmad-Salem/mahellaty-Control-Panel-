<?php
	include_once("../../../php_includes/connection_db.php");
	include_once("../../../php_includes/funtions.php");
    include_once("../../../php_includes/deletedir.php");
	
	if($_POST['do_action']=="edit_main_offer_photo")
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
	    $offer_id=mysqli_real_escape_string($connect,$_POST['offer_id']);
	    

    	//image
    	$fileName =$_POST['image_shop'];
		$ext= "jpg";//get uploaded file extention




	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);
			    
	    
		$offer_rec=array();	
	    
	    if($perform_query_user_credential)
	    {
			if(!empty($user_id)&&!empty($shop_id)&&!empty($offer_id)&&!empty($Email)&&!empty($password)&&!empty($fileName))
		    {
		    	$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
				//query update 
				$query_update_offer1="UPDATE `offers` SET `offer_photo`='{$uploaded_name}' WHERE `shop_id`='{$shop_id}' AND id='{$offer_id}' LIMIT 1";
				$path="../../../images/users/$user_id/$shop_id/offers/$offer_id";
				deleteDirectory($path);
				$perfrom_query_update_offer1=mysqli_query($connect,$query_update_offer1);
				if($perfrom_query_update_offer1)
				{
					//sucess
	    			/* check if there's an error with image */
					
					if (!file_exists("../../../images/users/$user_id/$shop_id/offers/$offer_id")) {
							mkdir("../../../images/users/$user_id/$shop_id/offers/$offer_id", 0755);
						}

					$kaboom = explode(".", $fileName); // Split file name into an array using the dot
					$fileExt = end($kaboom); // Now target the last array element to get the file extension	

					//image error handling
					if (!$fileTmpLoc) 
					{ 
						// if file not chosen
					    $message="أختر صورة من فضلك.";
						$offer_rec=array(
						"offer_edit_flage"=>"0",
						"message"=>$message
						);
					}
					 else if($fileSize > 5242880) 
					 { 
					 	// if file size is larger than 5 Megabytes
					    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
						$offer_rec=array(
						"offer_edit_flage"=>"0",
						"message"=>$message
						);

					} 
					else if (!preg_match("/.(jpg|png|jpeg)$/i", $fileName) )
					 {
					    
					    // This condition is only if you wish to allow uploading of specific file types    
					    $message="يجب ان تكون الصورة بهذه الامتدادات .jpg,jpeg or .png.";
					    $offer_rec=array(
						"offer_edit_flage"=>"0",
						"message"=>$message
						);
					} 
					else if ($fileErrorMsg == 1)
					 { 
					 	// if file upload error key is equal to 1
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					    $offer_rec=array(
						"offer_edit_flage"=>"0",
						"message"=>$message
						);
						
					}

					
					$moveResult = file_put_contents("../../../images/users/$user_id/$shop_id/offers/$offer_id/$uploaded_name",base64_decode($fileName));
					// Check to make sure the move result is true before continuing
					if ($moveResult != true) {
					    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						$offer_rec=array(
						"offer_edit_flage"=>"0",
						"message"=>$message
						);
					}

					//success message will be redirected
					$message="تمت إضافة العرض بنجاح.";
					@unlink($fileTmpLoc); 
			    	$offer_rec=array(
						"offer_edit_flage"=>"1",
						"message"=>$message
						);
				}else
				{
					$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						$offer_rec=array(
						"offer_edit_flage"=>"0",
						"message"=>$message
						);
				}
				
		    }else{

		    	$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						$offer_rec=array(
						"offer_edit_flage"=>"0",
						"message"=>$message
						);
		    }
		}else{

			$message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
						$offer_rec=array(
						"offer_edit_flage"=>"0",
						"message"=>$message
						);
		}

		echo json_encode($offer_rec,JSON_FORCE_OBJECT);
	}
?>