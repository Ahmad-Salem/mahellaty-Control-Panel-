<?php
	include_once("../php_includes/connection_db.php");
	

	if(isset($_POST['search']))
	{
		$search=mysqli_real_escape_string($connect,$_POST['search']);
		$query_person_details="SELECT `id`, `user_name`, `email`, `gender`, `photo`, `user_type`,`activated` FROM `users` WHERE `user_name` LIKE '{$search}%' OR `user_name` LIKE '%{$search}' OR `user_name` LIKE '%{$search}%'";
		$perform_query_person_details=mysqli_query($connect,$query_person_details);
		while($result_p_details=mysqli_fetch_assoc($perform_query_person_details))
		{
			$Account_id=$result_p_details['id'];
			$Account_user_name=$result_p_details['user_name'];
			$Account_email=$result_p_details['email'];
			$Account_photo=$result_p_details['photo'];
			$Account_gender=$result_p_details['gender'];
			$Account_user_type=$result_p_details['user_type'];
			$Account_activated=$result_p_details['activated'];
			


			$person_account_details[]=array(
								"id"=>$Account_id,
								"name"=>$Account_user_name,
								"email"=>$Account_email,
								"photo"=>$Account_photo,
								"user_type"=>$Account_user_type,
								"gender"=>$Account_gender,
								"activated"=>$Account_activated
								);	
		}
		


		echo json_encode($person_account_details, JSON_FORCE_OBJECT);
	}

	


?>