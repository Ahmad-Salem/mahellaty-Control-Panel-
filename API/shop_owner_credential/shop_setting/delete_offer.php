<?php
	include_once("../../../php_includes/connection_db.php");
	include_once("../../../php_includes/deletedir.php");
	include_once("../../../php_includes/funtions.php");
	if($_POST['do_action']=="delete_offers")
	{

		//user_id
		$user_id=mysqli_real_escape_string($connect, $_POST['id']);
		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		//getting password
	    $password=mysqli_real_escape_string($connect,$_POST['password']);
	    //getting shop id 
	    $shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
	    //getting offer id 
	    $offer_id=mysqli_real_escape_string($connect,$_POST['offer_id']);

	    //check user credential
	    $query_user_credential="SELECT `id` FROM `users` WHERE `id`='{$user_id}' AND `password`='{$password}' AND `email`='{$Email}' LIMIT 1";
	    $perform_query_user_credential=mysqli_query($connect,$query_user_credential);
	    
	    $delete_offers_answer=array();
		if($perform_query_user_credential)
	    {
	    	if(!empty($user_id)&&!empty($Email)&&!empty($password)&&!empty($shop_id)&&!empty($offer_id))
		    {
		    	$query_delete_offer="DELETE FROM `offers` WHERE `shop_id`='{$shop_id}' AND `id`='{$offer_id}' LIMIT 1";
				$perform_query_delete_offer=mysqli_query($connect,$query_delete_offer);
				if($perform_query_delete_offer)
				{
					//sucess
					$path1="../../../images/users/$user_id/$shop_id/offers/$offer_id";
		    		deleteDirectory($path1);

		    		$message="تم خدف العرض بنجاح";
		    		$delete_offers_answer=array(
		    			"delete_offer_flag"=>"1",
		    			"message"=>$message,
		    			);

				}else
				{
					$message="حدث خطا أثناء حذف العرض";
		    		$delete_offers_answer=array(
		    			"delete_offer_flag"=>"0",
		    			"message"=>$message,
		    			);
				}
		    }else
		    {
		    	$message="حدث خطا أثناء حذف العرض";
	    		$delete_offers_answer=array(
	    			"delete_offer_flag"=>"0",
	    			"message"=>$message,
	    			);
		    }
		}else
		{
			$message="حدث خطا أثناء حذف العرض";
    		$delete_offers_answer=array(
    			"delete_offer_flag"=>"0",
    			"message"=>$message,
    			);
		}
		echo json_encode($delete_offers_answer,JSON_FORCE_OBJECT);
	}
?>