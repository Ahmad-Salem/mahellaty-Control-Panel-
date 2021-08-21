<?php
	include_once("../../php_includes/connection_db.php");
	if($_POST['do_action']=="get_product_list")
	{
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
		if(!empty($shop_id))
		{
			$query_product_list="SELECT `id`, `shop_id`, `product_name`, `product_price` FROM `products_list_text` WHERE `shop_id` = '{$shop_id}' ";
			$perform_query_product_list=mysqli_query($connect,$query_product_list);

			$List_products=array();
			$product_rec=array();

			while($row_products=mysqli_fetch_assoc($perform_query_product_list))
			{

				$product_id=$row_products['id'];
				$shop_id=$row_products['shop_id'];
				$product_name=$row_products['product_name'];
				$product_price=$row_products['product_price'];
				$product_rec=array(
					"product_id"=>$product_id,
					"shop_id"=>$shop_id,
					"product_name"=>$product_name,
					"product_price"=>$product_price
					);

				array_push($List_products,$product_rec);
			}

			echo json_encode($List_products,JSON_FORCE_OBJECT);
		}
	}

?>