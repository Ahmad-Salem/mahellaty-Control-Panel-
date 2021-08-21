<?php
	include_once("../../php_includes/connection_db.php");
	if($_POST['do_action']=="get_user_info")
	{
		$user_id=mysqli_real_escape_string($connect,$_POST['user_id']);

		if(!empty($user_id))
		{
			$query_user_info="SELECT `id`, `user_name`, `email`, `photo`, `telephone1`, `telephone2`, `address` FROM `users` WHERE `id`='{$user_id}' LIMIT 1;";
			$perform_query_user_info=mysqli_query($connect,$query_user_info);
			$row_info = mysqli_fetch_assoc($perform_query_user_info);
		    
	    	//setting values 
	        $user_id=$row_info['id'];
	        $user_user_name=$row_info['user_name'];
	        $user_email=$row_info['email'];
	        $user_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/{$user_id}/".$row_info['photo'];
	        $user_telephone1=$row_info['telephone1'];
	        $user_telephone2=$row_info['telephone2'];
	        $user_address=$row_info['address'];


      		$login_info=array(
  			"user_id"=>$user_id,
  			"user_name"=>$user_user_name,
  			"user_email"=>$user_email,
  			"user_photo"=>$user_photo,
  			"user_telephone1"=>$user_telephone1,
  			"user_telephone2"=>$user_telephone2,
  			"user_address"=>$user_address,
  			);

      		echo json_encode($login_info,JSON_FORCE_OBJECT);
		}

	}
?>