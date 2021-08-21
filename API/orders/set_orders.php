<?php
	include_once("../../php_includes/connection_db.php");
	if(@$_POST['do_action']=="get_orders")
	{

		
		
		$order_user_phone_number=mysqli_real_escape_string($connect,$_POST['order_user_phone_number']);
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
		$order_details=$_POST['order_details'];
		$order_user_lat=mysqli_real_escape_string($connect,$_POST['order_user_lat']);
		$order_user_log=mysqli_real_escape_string($connect,$_POST['order_user_log']);
		

		
		$order_details=json_decode($order_details,true);
		
		/********demo***/
		// [{"product_id":"1","product_type":"photo"},{"product_id":"2","product_type":"text"},{"product_id":"3","product_type":"photo"}]
		$order_rec=array();

		if(!empty($order_user_phone_number)&&!empty($shop_id)&&!empty($order_details)&&!empty($order_user_lat)&&!empty($order_user_log))
		{


	    	$query_user_order="INSERT INTO `orders`(`user_phone_number`, `shop_id`, `user_lat`, `user_log`) VALUES ('{$order_user_phone_number}','{$shop_id}','{$order_user_lat}','${order_user_log}')";
	   		$perform_query_user_order=mysqli_query($connect,$query_user_order);

	   		if($perform_query_user_order)
	   		{
	   			$order_id=mysqli_insert_id($connect);
	   			$query_user_order_noti="INSERT INTO `notification`(`order_id`, `shop_id`, `notification_details`) VALUES ('{$order_id}','{$shop_id}','لديك طلب')";
	   			$perform_query_user_order_noti=mysqli_query($connect,$query_user_order_noti);

	   			for($i=0;$i<sizeof($order_details);$i++)
				{
					// echo $order_details[$i]["product_id"].',';
					// echo $order_details[$i]["product_type"].'<br/>';

					$query_user_order_details="INSERT INTO `order_details`(`order_id`, `shop_id`, `product_id`, `product_type`) VALUES ('{$order_id}','{$shop_id}','".$order_details[$i]["product_id"]."','".$order_details[$i]["product_type"]."')";

	   				$perform_query_user_details=mysqli_query($connect,$query_user_order_details);
				}

				$message="تم رفع طلبك بنجاح";
				$order_rec=array(
					"add_order_flag"=>"0",
					"message"=>$message
					);


	   		}else
	   		{
	   			$message="حدث خطا أثناء طلبك";
				$order_rec=array(
					"add_order_flag"=>"0",
					"message"=>$message
					);
	   		}
	   		



			

		}else
		{
			$message="حدث خطا أثناء طلبك";
			$order_rec=array(
				"add_order_flag"=>"0",
				"message"=>$message
				);
		}

		
		
		

	
	echo json_encode($order_rec,JSON_FORCE_OBJECT);

	}
?>