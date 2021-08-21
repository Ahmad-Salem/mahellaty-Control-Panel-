<?php
	
    include_once("../php_includes/connection_db.php");

	if(isset($_POST['user_id']))
	{
		$user_id=$_POST['user_id'];
		$query_user_details="SELECT `user_name`, `email`, `password`, `users`.`photo`, `user_type`, `status`, `gender`,`telephone1`,`telephone2`,`users`.`address`,`code_activation` FROM `users`  WHERE `users`.`id`='{$user_id}' LIMIT 1 ";
		$perform_query_user_details=mysqli_query($connect,$query_user_details);
		$result_u_details=mysqli_fetch_assoc($perform_query_user_details);
		
		$Account_name=$result_u_details['user_name'];
		$Account_email=$result_u_details['email'];
		$Account_password=$result_u_details['password'];
		$Account_photo=$result_u_details['photo'];
		$Account_user_type=$result_u_details['user_type'];
		$Account_status=$result_u_details['status'];
		$Account_gender=$result_u_details['gender'];
		$Account_telephone1=$result_u_details['telephone1'];
		$Account_telephone2=$result_u_details['telephone2'];
		$Account_address=$result_u_details['address'];
		$Account_code_activation=$result_u_details['code_activation'];
		
		
		if($Account_photo=='')
		{
			if($Account_gender=='male')
			{	
				$image="images/default_images/default-person.jpg";
			}else if($Account_gender=='female'){
				$image="images/default_images/user_profile_female.jpg";
			}

		}else{
			
			//link to real image 
            $image="images/users/{$user_id}/{$Account_photo}";
		}


        $shop_names=array();
        $shop_name_string="";
        $query_shop_name="SELECT `id`, `shop_name` FROM `shop` WHERE `user_id`='{$user_id}'";
        $perform_shop_name=mysqli_query($connect,$query_shop_name);
        while($result_u_shop=mysqli_fetch_assoc($perform_shop_name))
        {
            array_push($shop_names,$result_u_shop['shop_name']);

        }
        
        
        for($i=0;$i<count($shop_names);$i++)
        {
             $shop_name_string.=$shop_names[$i]." - ";
        }
        
        
//        print_r($shop_names);
		$user_account_details[]=array(
							"user_name"=>$Account_name,
							"email"=>$Account_email,
							"password"=>$Account_password,
							"photo"=>$image,
							"user_type"=>$Account_user_type,
							"status"=>$Account_status,
							"gender"=>$Account_gender,
                            "shop_name"=>$shop_name_string,   
                            "shop_id"=>'',   
							"tel1"=>$Account_telephone1,
							"tel2"=>$Account_telephone2,
							"address"=>$Account_address,
							"code_activation"=>$Account_code_activation
							);


		echo json_encode($user_account_details, JSON_FORCE_OBJECT);
	}

	


?>