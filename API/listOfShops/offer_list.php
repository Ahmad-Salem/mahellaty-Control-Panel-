<?php
	include_once("../../php_includes/connection_db.php");
	if($_POST['do_action']=="get_offers_list")
	{
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
		if(!empty($shop_id))
		{
			$query_offer_list="SELECT `users`.`id` as `u_id`,`users`.`user_name`,`users`.`email`,`users`.`photo`,`users`.`address`,`users`.`telephone1`,`users`.`telephone2`,`offers`.`id`, `offer_name`, `offer_description`, `offer_photo`, `shop_id` FROM `offers` INNER JOIN `shop` ON `offers`.`shop_id`=`shop`.`id`  INNER JOIN `users` ON `shop`.`user_id`=`users`.`id`  WHERE `shop`.`id`='{$shop_id}' LIMIT 10";
			$perform_query_offer_list=mysqli_query($connect,$query_offer_list);

			$List_offers=array();
			$offer_rec=array();
			while($row_offers=mysqli_fetch_assoc($perform_query_offer_list))
			{

				$user_id=$row_offers['u_id'];
				$user_name=$row_offers['user_name'];
				$email=$row_offers['email'];
				$photo="http://www.ma7laty.com/images/users/".$user_id."/".$row_offers['photo'];
				$address=$row_offers['address'];
				$telephone1=$row_offers['telephone1'];
				$telephone2=$row_offers['telephone2'];	
				$offer_id=$row_offers['id'];
				$offer_name=$row_offers['offer_name'];
				$offer_description=$row_offers['offer_description'];
				$shop_id=$row_offers['shop_id'];
				$offer_photo="http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/users/".$user_id."/".$shop_id."/offers/".$offer_id."/".$row_offers['offer_photo'];
				

				$offer_rec=array(
					"offer_id"=>$offer_id,
					"offer_name"=>$offer_name,
					"offer_description"=>$offer_description,
					"offer_photo"=>$offer_photo,
					"user_name"=>$user_name,
					"email"=>$email,
					"photo"=>$photo,
					"address"=>$address,
					"telephone1"=>$telephone1,
					"telephone2"=>$telephone2
					);


				array_push($List_offers,$offer_rec);
			}

			echo json_encode($List_offers,JSON_FORCE_OBJECT);
		}
	}
?>