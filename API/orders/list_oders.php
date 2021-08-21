<?php
	include_once("../../php_includes/connection_db.php");

	if($_POST['do_action']=="get_orders_list")
	{
		
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
		
		if(!empty($shop_id))
		{
			$query_orders="SELECT orders.`id` as `o_id`, `user_phone_number`, `date`, `checked`, `shop_id`, `user_lat`, `user_log` , shop.shop_name FROM `orders` INNER JOIN `shop` ON orders.shop_id=shop.id  WHERE shop.id='{$shop_id}'";
			$perform_query_orders=mysqli_query($connect,$query_orders);
			// echo $query_shops;
			$List_orders=array();
			$order_rec=array();
			$product_rec=array();
			$product_LIST=array();
			while($row_orders=mysqli_fetch_assoc($perform_query_orders))
			{

				//all shops here
				$o_id=$row_orders['o_id'];
				$user_phone_number=$row_orders['user_phone_number'];
				$date=$row_orders['date'];
				$checked=$row_orders['checked'];
				$shop_id=$row_orders['shop_id'];
				$user_lat=$row_orders['user_lat'];
				$user_log=$row_orders['user_log'];
				$shop_name=$row_orders['shop_name'];

				$query_orders_details="SELECT `product_id`, `product_type` FROM `order_details` WHERE order_id='{$o_id}' AND shop_id='{$shop_id}'";
				$perform_query_orders_details=mysqli_query($connect,$query_orders_details);

				while($order_detail=mysqli_fetch_assoc($perform_query_orders_details))
				{
					if($order_detail['product_type']=='text')
					{
						$query_orders_details1="SELECT `product_id`, products_list_text.product_name,products_list_text.product_price,`product_type` FROM `order_details` INNER JOIN products_list_text ON order_details.product_id=products_list_text.id WHERE order_id='{$o_id}' AND order_details.shop_id='{$shop_id}'";
						$perform_query_orders_details1=mysqli_query($connect,$query_orders_details1);
						$order_detail1=mysqli_fetch_assoc($perform_query_orders_details1);
						
						$product_id=$order_detail1['product_id'];
						$product_name=$order_detail1['product_name'];
						$product_price=$order_detail1['product_price'];
						$product_type=$order_detail1['product_type'];
						
						$product_rec=array(
							"product_id"=>$product_id,
							"product_name"=>$product_name,
							"product_price"=>$product_price,
							"product_type"=>$product_type							
							
							);

					}else if($order_detail['product_type']=='photo')
					{
						$query_orders_details2="SELECT `product_id`,products.product_name,products.product_price, `product_type` FROM `order_details` INNER JOIN products ON order_details.product_id=products.id WHERE order_id='{$o_id}' AND order_details.shop_id='{$shop_id}'";
						$perform_query_orders_details2=mysqli_query($connect,$query_orders_details2);
						$order_detail2=mysqli_fetch_assoc($perform_query_orders_details2);
						
						$product_id=$order_detail2['product_id'];
						$product_name=$order_detail2['product_name'];
						$product_price=$order_detail2['product_price'];
						$product_type=$order_detail2['product_type'];
						$product_rec=array(
							"product_id"=>$product_id,
							"product_name"=>$product_name,
							"product_price"=>$product_price,
							"product_type"=>$product_type							
							
							);

					}

					array_push($product_LIST,$product_rec);
				
				}

				$order_rec=array(
					"o_id"=>$o_id,
					"user_phone_number"=>$user_phone_number,
					"date"=>$date,
					"checked"=>$checked,
					"shop_id"=>$shop_id,
					"user_lat"=>$user_lat,
					"user_log"=>$user_log,
					"shop_name"=>$shop_name,
					"products"=>$product_LIST
					
					);



				array_push($List_orders,$order_rec);

				



				

			}
			
			echo json_encode(unique_multidim_array($List_orders,"o_id"),JSON_FORCE_OBJECT);
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