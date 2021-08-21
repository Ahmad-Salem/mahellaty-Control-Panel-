<?php
	include_once("../../php_includes/connection_db.php");

	if($_POST['do_action']=="get_notification_list")
	{
		
		$user_id=mysqli_real_escape_string($connect,$_POST['user_id']);
		
		if(!empty($user_id))
		{
			$query_noti="SELECT notification.`id` as `n_id`,`date`, `order_id`, `shop_id`, `notification_details` FROM `notification` INNER JOIN `shop` on notification.shop_id = shop.id WHERE shop.user_id='{$user_id}'";
			$perform_query_noti=mysqli_query($connect,$query_noti);
			// echo $query_shops;
			$List_noti=array();
			$noti_rec=array();
			
			while($row_noti=mysqli_fetch_assoc($perform_query_noti))
			{

				//all shops here
				$n_id=$row_noti['n_id'];
				$order_id=$row_noti['order_id'];
				$date=$row_noti['date'];
				$shop_id=$row_noti['shop_id'];
				$notification_details=$row_noti['notification_details'];
				


				$noti_rec=array(
					"n_id"=>$n_id,
					"order_id"=>$order_id,
					"date"=>$date,
					"notification_details"=>$notification_details,
					"shop_id"=>$shop_id
					
					);



				array_push($List_noti,$noti_rec);

				



				

			}
			
			echo json_encode(unique_multidim_array($List_noti,"n_id"),JSON_FORCE_OBJECT);
		}
	}


	/**************************************************************************/
	/********* generate unique items **************************************************/
	function unique_multidim_array($array, $key) { 
    $temp_array = array(); 
    $i = 0; 
    $key_array = array(); 
    
    foreach($array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $temp_array[$i] = $val; 
        } 
        $i++; 
    } 
    return $temp_array; 
} 
	/**************************************************************************/
?>