<?php
	include_once("../../php_includes/connection_db.php");
	if($_POST['do_action']=="get_places")
	{

		
		
		$query_get_gov="SELECT `id`, `gov_name`, `activation` FROM `government`";
		$perform_query_get_gov=mysqli_query($connect,$query_get_gov);
		$gov_info_array=array();
		$city_info_array=array();
		$gov_info=array();
		$city_info=array();
		while($rows_gov=mysqli_fetch_assoc($perform_query_get_gov))
		{
			$gov_id=$rows_gov['id'];
			$gov_name=$rows_gov['gov_name'];
			$gov_activation=$rows_gov['activation'];
			
			$query_get_city="SELECT `id` as `c_id`,`city_name`, `activation` as `c_activation` FROM `cities` WHERE `gov_id`='{$gov_id}'";
			$perform_query_get_city=mysqli_query($connect,$query_get_city);
			while($rows_city=mysqli_fetch_assoc($perform_query_get_city))
			{
				$city_id=$rows_city['c_id'];
				$city_name=$rows_city['city_name'];
				$city_activation=$rows_city['c_activation'];

				$city_info=array(
				"city_id"=>$city_id,
				"city_name"=>$city_name,
				"c_activation"=>$city_activation,
				"c_gov_id"=>$gov_id
				
				);
				array_push($city_info_array,$city_info);
			}

			$gov_info=array(
				"gov_id"=>$gov_id,
				"gov_name"=>$gov_name,
				"gov_activation"=>$gov_activation,
				"city_info"=>$city_info_array
				);
			array_push($gov_info_array,$gov_info);
		}

	

	
	echo json_encode($gov_info_array,JSON_FORCE_OBJECT);

	}
?>