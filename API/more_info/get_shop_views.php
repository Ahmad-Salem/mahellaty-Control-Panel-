<?php
	include_once("../../php_includes/connection_db.php");
	if($_POST['do_action']=="get_shop_views")
	{
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);

		if(!empty($shop_id))
		{
			$query_shop_Views="SELECT `id`,`views` FROM `shop` WHERE `id`='{$shop_id}' LIMIT 1;";
			$perform_query_shop_Views=mysqli_query($connect,$query_shop_Views);
			$row_info = mysqli_fetch_assoc($perform_query_shop_Views);
		    
	    	//setting values 
	        $shop_id=$row_info['id'];
	        $shop_Views=$row_info['views'];

      		$shop_info=array(
  			"shop_id"=>$shop_id,
  			"shop_Views"=>$shop_Views
  			);

      		echo json_encode($shop_info,JSON_FORCE_OBJECT);
		}

	}
?>