<?php
	include_once("../../php_includes/connection_db.php");
	if($_POST['do_action']=="get_shop_owner_phones")
	{
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
		if(!empty($shop_id))
		{
			$query_telephone_list="SELECT `users`.`telephone1` as `tele1`,`users`.`telephone2` as `tele2` from `users` INNER JOIN `shop` ON `users`.`id`=`shop`.`user_id` WHERE `shop`.`id`='{$shop_id}' LIMIT 1";
			$perform_query_offer_list=mysqli_query($connect,$query_telephone_list);
			$row_shop=mysqli_fetch_assoc($perform_query_offer_list);
			$List_offers=array(
				"telephone1"=>$row_shop['tele1'],
				"telephone2"=>$row_shop['tele2']
				
			);
			


			echo json_encode($List_offers,JSON_FORCE_OBJECT);
		}
	}
?>