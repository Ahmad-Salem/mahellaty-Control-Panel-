<?php
	session_start();
    include_once("../php_includes/connection_db.php");
    include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");

    if(isset($_POST['login_sub']))
    {
    	$advertisement_duration_from=$_POST['add_advertisement_duration_from'];
    	$advertisement_duration_to=$_POST['add_advertisement_duration_to'];
    	$advertisement_name=mysqli_real_escape_string($connect, $_POST['add_advertisement_title']);
    	$advertisement_description=mysqli_real_escape_string($connect, $_POST['advertisement_description']);
    	$advertisement_government=mysqli_real_escape_string($connect,$_POST['government']);
    	$advertisement_cost=mysqli_real_escape_string($connect, $_POST['add_advertisement_cost']);
    	$advertisement_city=mysqli_real_escape_string($connect,$_POST['city']);
    	


    	//image
    	$fileName = $_FILES["add_advertisement_photo"]["name"]; // The file name
		$fileTmpLoc = $_FILES["add_advertisement_photo"]["tmp_name"]; // File in the PHP tmp folder
		$fileType = $_FILES["add_advertisement_photo"]["type"]; // The type of file it is
		$fileSize = $_FILES["add_advertisement_photo"]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES["add_advertisement_photo"]["error"]; // 0 = false | 1 = true
		$value=explode('.',$_FILES["add_advertisement_photo"]["name"]);
		$ext= end($value);//get uploaded file extention

		if(!empty($advertisement_cost)&&!empty($advertisement_city)&&!empty($advertisement_duration_to)&&!empty($advertisement_duration_from)&&!empty($advertisement_name)&&!empty($advertisement_description)&&!empty($fileName)&&!empty($advertisement_government))
		{
			
			//query
			$uploaded_name=date("hisa").''.md5(rand()).'.'.$ext;
			$query_add_advertisement="INSERT INTO `advertisement`(`advertisement_title`, `advertisement_description`, `advertisement_photo`, `government`, `city`, `from_date`, `to_date`, `cost`) VALUES ('{$advertisement_name}','{$advertisement_description}','{$uploaded_name}','{$advertisement_government}','{$advertisement_city}','{$advertisement_duration_from}','{$advertisement_duration_to}','{$advertisement_cost}')";
			$perform_query_add_advertisement=mysqli_query($connect,$query_add_advertisement);
			$advertisement_id=mysqli_insert_id($connect);
			if($perform_query_add_advertisement)
			{
				

				//sucess
    			/* check if there's an error with image */
				
				if (!file_exists("../images/advertisement/$advertisement_id")) {
						mkdir("../images/advertisement/$advertisement_id", 0755);
					}

				$kaboom = explode(".", $fileName); // Split file name into an array using the dot
				$fileExt = end($kaboom); // Now target the last array element to get the file extension	

				//image error handling
				if (!$fileTmpLoc) 
				{ 
					// if file not chosen
				    $_SESSION['Success_advertisement_check']="false";
				    $message="أختر صورة من فضلك.";
					$_SESSION['message_advertisement']=$message;
					header("location: add_advertisement.php");
				}
				 else if($fileSize > 5242880) 
				 { 
				 	// if file size is larger than 5 Megabytes
				    $_SESSION['Success_advertisement_check']="false";
				    $message="يجب ان لا يزيد حجم الصورة عن 2 ميجا بايت.";
					$_SESSION['message_advertisement']=$message;
					@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					header("location: add_advertisement.php");

				} 
				else if (!preg_match("/.(jpg|png|jpeg)$/i", $fileName) )
				 {
				    
				    // This condition is only if you wish to allow uploading of specific file types    
				    $_SESSION['Success_advertisement_check']="false";
				    $message="يجب ان تكون الصورة بهذه الامتدادات .jpg,jpeg or .png.";
					$_SESSION['message_advertisement']=$message;
					@unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					header("location: add_advertisement.php");
				} 
				else if ($fileErrorMsg == 1)
				 { 
				 	// if file upload error key is equal to 1
				    $_SESSION['Success_advertisement_check']="false";
				    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					$_SESSION['message_advertisement']=$message;
				    header("location: add_advertisement.php");
				}

				$moveResult = move_uploaded_file($fileTmpLoc, "../images/advertisement/$advertisement_id/$uploaded_name");
				// Check to make sure the move result is true before continuing
				if ($moveResult != true) {
				    $_SESSION['Success_advertisement_check']="false";
				    $message="حدث خطا اثناء معالجة الصورة حاول مرة اخري.";
					$_SESSION['message_advertisement']=$message;
				    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				    header("location: add_advertisement.php");
				}

				//success message will be redirected
				$_SESSION['Success_advertisement_check']="true";
		    	$message="تمت إضافة الأعلان بنجاح.";
				$_SESSION['message_advertisement']=$message;
				@unlink($fileTmpLoc); 
		    	header("location: add_advertisement.php");




			}else
			{
				//error
				$_SESSION['Success_advertisement_check']="false";
			    $message="حدث خطا اثناء إضافة الاعلان حاول مرة أخري.";
				$_SESSION['message_advertisement']=$message;
			    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			    header("location: add_advertisement.php");
		}
		}else
		{
			//error
			$_SESSION['Success_advertisement_check']="false";
		    $message="حدث خطا اثناء إضافة الاعلان حاول مرة أخري.";
			$_SESSION['message_advertisement']=$message;
		    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		    header("location: add_advertisement.php");

		}
    }else
    {
    	$_SESSION['Success_advertisement_check']="false";
	    $message="حدث خطا اثناء إضافة الاعلان حاول مرة أخري.";
		$_SESSION['message_advertisement']=$message;
	    @unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
	    header("location: add_advertisement.php");
    }
?>    