<?php
	include_once("../../../php_includes/connection_db.php");
	include_once("../../../php_includes/deletedir.php");
	include_once("../../../php_includes/funtions.php");
	if($_POST['do_action']=="delete_products")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);
	    //getting shop id 
	    $shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
	    //getting the product id
	    $product_id=mysqli_real_escape_string($connect,$_POST['product_id']);

	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);
	    
	    $delete_products_answer=array();
		if($perform_query_user_credential)
	    {
	    	if(!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($shop_id)&&!empty($product_id))
		    {
		    	$query_delete_product="DELETE FROM `products` WHERE `id`='{$product_id}' AND `shop_id`='{$shop_id}' LIMIT 1";
				$query_delete_product_photo="DELETE FROM `product_photos` WHERE `p_id`='{$product_id}' ";

				$perform_query_delete_product=mysqli_query($connect,$query_delete_product);
				$perform_query_delete_product_photo=mysqli_query($connect,$query_delete_product_photo);
				if($perform_query_delete_product&&$perform_query_delete_product_photo)
				{
					//sucess

					$path1="../../../images/users/$user_id/$shop_id/main_p_photo/$product_id";
		    		$path2="../../../images/users/$user_id/$shop_id/p_photos/$product_id";
					deleteDirectory($path1);
					deleteDirectory($path2);

					$message="تم خدف المنتج بنجاح";
		    		$delete_products_answer=array(
		    			"delete_product_flag"=>"1",
		    			"message"=>$message,
		    			);
				}else
				{
					$message="حدث خطا أثناء حذف المنتج";
		    		$delete_products_answer=array(
		    			"delete_product_flag"=>"0",
		    			"message"=>$message,
		    			);
				}	
		    }else
		    {
		    	$message="حدث خطا أثناء حذف المنتج";
	    		$delete_products_answer=array(
	    			"delete_product_flag"=>"0",
	    			"message"=>$message,
	    			);
		    }
		}else
		{
			$message="حدث خطا أثناء حذف المنتج";
    		$delete_products_answer=array(
    			"delete_product_flag"=>"0",
    			"message"=>$message,
    			);
		}
		echo json_encode($delete_products_answer,JSON_FORCE_OBJECT);	
	}
?>