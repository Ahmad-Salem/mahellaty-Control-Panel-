<?php
	include_once("../../../php_includes/connection_db.php");
	include_once("../../../php_includes/deletedir.php");
	include_once("../../../php_includes/funtions.php");
	if($_POST['do_action']=="delete_shops")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);
	    //getting shop id 
	    $shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);

	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);
	    
	    $delete_shops_answer=array();
		if($perform_query_user_credential)
	    {
	    	if(!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($shop_id))
		    {
		    	//delete process
				$query_delete_shop="DELETE FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1";
				$query_delete_products="DELETE FROM `products` WHERE `shop_id`='{$shop_id}' ";
				$query_delete_offers="DELETE FROM `offers` WHERE `shop_id`='{$shop_id}' ";

				$perform_query_delete_shop=mysqli_query($connect,$query_delete_shop);
				$perform_query_delete_products=mysqli_query($connect,$query_delete_products);
				$perform_query_delete_offers=mysqli_query($connect,$query_delete_offers);
				if($perform_query_delete_shop&&$perform_query_delete_products&&$perform_query_delete_offers)
		    	{
		    		//sucess
					$path='../../../images/users/'.$user_id.'/'.$shop_id;
					deleteDirectory($path);
		    		$message="تم خذف المحل بنجاح";
		    		$delete_shops_answer=array(
		    			"delete_shop_flag"=>"1",
		    			"message"=>$message,
		    			);
		    	}else
		    	{
		    		$message="حدث خطأ أثناء عملية الحذف.";
		    		$delete_shops_answer=array(
		    			"delete_shop_flag"=>"0",
		    			"message"=>$message,
		    			);
		    	}
		    }
		}else
		{
			$message="حدث خطأ أثناء عملية الحذف.";
    		$delete_shops_answer=array(
    			"delete_shop_flag"=>"0",
    			"message"=>$message,
    			);

		}
		echo json_encode($delete_shops_answer,JSON_FORCE_OBJECT);
	}

?>
