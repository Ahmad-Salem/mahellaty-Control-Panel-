<?php
	include_once("../php_includes/connection_db.php");
	

	if(isset($_POST['search']))
	{
		$search=mysqli_real_escape_string($connect,$_POST['search']);
		if($search=="NotActive")
		{
			$query_person_details="SELECT `id`, `phone_number`, `activated`, `activation_code` FROM `normal_user` WHERE `activated`='0' ";
		}else if($search=="Active")
		{
			$query_person_details="SELECT `id`, `phone_number`, `activated`, `activation_code` FROM `normal_user` WHERE `activated`='1' ";
		}else
		{
			$query_person_details="SELECT `id`, `phone_number`, `activated`, `activation_code` FROM `normal_user`  ";
		}
		
		$perform_query_person_details=mysqli_query($connect,$query_person_details);
		while($result_p_details=mysqli_fetch_assoc($perform_query_person_details))
		{
			$Account_id=$result_p_details['id'];
			$Account_phone_number=$result_p_details['phone_number'];
			$Account_activated=$result_p_details['activated'];
			$Account_activation_code=$result_p_details['activation_code'];
			
			


			$person_account_details[]=array(
								"id"=>$Account_id,
								"phone_number"=>$Account_phone_number,
								"activated"=>$Account_activated,
								"activation_code"=>$Account_activation_code
								);	
		}
		


		echo json_encode($person_account_details, JSON_FORCE_OBJECT);
	}

	


?>