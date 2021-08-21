<?php
	
    include_once("../php_includes/connection_db.php");

    function  check_in_array($shop_activity,$shop_activities)
    {
    	
    	if (in_array($shop_activity, $shop_activities)) {
		    return "checked";
		}
    }

	if(isset($_POST['shop_id']))
	{
		$shop_activities=array();
		$shop_activity_string="";
		$shop_id=mysqli_real_escape_string($connect,$_POST['shop_id']);
		$query_shop_activities="SELECT `id`, `shop_id`, `activity` FROM `shop_activities` WHERE `shop_id`='{$shop_id}' ";
		$perform_query_shop_activities=mysqli_query($connect,$query_shop_activities);
		while($result_s_activities=mysqli_fetch_assoc($perform_query_shop_activities))
        {
            array_push($shop_activities,$result_s_activities['activity']);

        }
		

        // $out ="sdsad ".check_in_array("ملابس أطفال",$shop_activities);
        // echo "<input type=\"checkbox\" checked name=\"activity_1\">";
        $output="<table style=\"overflow:scroll;\">
        			<input type=\"hidden\" value=\"".$_POST['shop_id']."\" class=\"shop_id\"/>
                    <tr>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("ملابس أطفال",$shop_activities)." name=\"activity_1\">    
                              <input type=\"hidden\" value=\"ملابس أطفال\" class=\"shop_activity\"/>
                              <label>ملابس أطفال</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("ملابس رجالي",$shop_activities)." name=\"activity_2\">  
                              <input type=\"hidden\" value=\"ملابس رجالي\" class=\"shop_activity\"/>
                              <label>ملابس رجالي</label> 
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("ملابس حريمي",$shop_activities)." name=\"activity_3\">    
                              <input type=\"hidden\" value=\"ملابس حريمي\" class=\"shop_activity\"/>
                              <label>ملابس حريمي</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("أحذية رجالي",$shop_activities)." name=\"activity_4\">    
                              <input type=\"hidden\" value=\"أحذية رجالي\" class=\"shop_activity\"/>
                              <label>أحذية رجالي</label>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("أحذية حريمي",$shop_activities)." name=\"activity_5\">    
                              <input type=\"hidden\" value=\"أحذية حريمي\" class=\"shop_activity\"/>
                              <label>أحذية حريمي</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("الموبايلات",$shop_activities)." name=\"activity_6\">    
                              <input type=\"hidden\" value=\"الموبايلات\" class=\"shop_activity\"/>
                              <label>الموبايلات</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("إلكترونيات وكمبيوترات",$shop_activities)." name=\"activity_7\">    
                              <input type=\"hidden\" value=\"إلكترونيات وكمبيوترات\" class=\"shop_activity\"/>
                              <label>إلكترونيات وكمبيوترات</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("سوبر ماركت",$shop_activities)." name=\"activity_8\">    
                              <input type=\"hidden\" value=\"سوبر ماركت\" class=\"shop_activity\"/>
                              <label>سوبر ماركت</label>    
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("أقمشة",$shop_activities)." name=\"activity_9\">    
                              <input type=\"hidden\" value=\"أقمشة\" class=\"shop_activity\"/>
                              <label>أقمشة</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("مطاعم",$shop_activities)." name=\"activity_10\">    
                              <input type=\"hidden\" value=\"مطاعم\" class=\"shop_activity\"/>
                              <label>مطاعم</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("أجهزة كهربية وإلكترونية",$shop_activities)." name=\"activity_11\">    
                              <input type=\"hidden\" value=\"أجهزة كهربية وإلكترونية\" class=\"shop_activity\"/>
                              <label>أجهزة كهربية وإلكترونية</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("العاب أطفال",$shop_activities)." name=\"activity_12\">    
                              <input type=\"hidden\" value=\"العاب أطفال\" class=\"shop_activity\"/>
                              <label>العاب أطفال</label>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("حلويات",$shop_activities)." name=\"activity_13\">    
                              <input type=\"hidden\" value=\"حلويات\" class=\"shop_activity\"/>
                              <label>حلويات</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("خضروات وفاكهة",$shop_activities)." name=\"activity_14\">    
                              <input type=\"hidden\" value=\"خضروات وفاكهة\" class=\"shop_activity\"/>
                              <label>خضروات وفاكهة</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("مستلزمات رجالي",$shop_activities)." name=\"activity_15\">    
                              <input type=\"hidden\" value=\"مستلزمات رجالي\" class=\"shop_activity\"/>
                              <label>مستلزمات رجالي</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("مستلزمات حريمي",$shop_activities)." name=\"activity_16\">    
                              <input type=\"hidden\" value=\"مستلزمات حريمي\" class=\"shop_activity\"/>
                              <label>مستلزمات حريمي</label>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("سجاد ومفروشات",$shop_activities)." name=\"activity_17\">    
                              <input type=\"hidden\" value=\"سجاد ومفروشات\" class=\"shop_activity\"/>
                              <label>سجاد ومفروشات</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("سيراميك ومواد صحية",$shop_activities)." name=\"activity_18\">    
                              <input type=\"hidden\" value=\"سيراميك ومواد صحية\" class=\"shop_activity\"/>
                              <label>سيراميك ومواد صحية</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("شركات السفر والسياحة",$shop_activities)." name=\"activity_19\">    
                              <input type=\"hidden\" value=\"شركات السفر والسياحة\" class=\"shop_activity\"/>
                              <label>شركات السفر والسياحة</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("صيدليات",$shop_activities)." name=\"activity_20\">    
                              <input type=\"hidden\" value=\"صيدليات\" class=\"shop_activity\"/>
                              <label>صيدليات</label>
                            </p>
                        </td>
                    </tr>  
                    <tr>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("محلات عطور وبخور",$shop_activities)." name=\"activity_21\">    
                              <input type=\"hidden\" value=\"محلات عطور وبخور\" class=\"shop_activity\"/>
                              <label>محلات عطور وبخور</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("مكاتب وأدوات مكتبية",$shop_activities)." name=\"activity_22\">    
                              <input type=\"hidden\" value=\"مكاتب وأدوات مكتبية\" class=\"shop_activity\"/>
                              <label>مكاتب وأدوات مكتبية</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("لحوم حمراء وبيضاء",$shop_activities)." name=\"activity_23\">    
                              <input type=\"hidden\" value=\"لحوم حمراء وبيضاء\" class=\"shop_activity\"/>
                              <label>لحوم حمراء وبيضاء</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("مغسلة",$shop_activities)." name=\"activity_24\">    
                              <input type=\"hidden\" value=\"مغسلة\" class=\"shop_activity\"/>
                              <label>مغسلة</label>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("مقاهي",$shop_activities)." name=\"activity_25\">    
                              <input type=\"hidden\" value=\"مقاهي\" class=\"shop_activity\"/>
                              <label>مقاهي</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("مواد تنظيف",$shop_activities)." name=\"activity_26\">    
                              <input type=\"hidden\" value=\"مواد تنظيف\" class=\"shop_activity\"/>
                              <label>مواد تنظيف</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("معدات سيارات",$shop_activities)." name=\"activity_27\">    
                              <input type=\"hidden\" value=\"معدات سيارات\" class=\"shop_activity\"/>
                              <label>معدات سيارات</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("كوافير حريمي",$shop_activities)." name=\"activity_28\">    
                              <input type=\"hidden\" value=\"كوافير حريمي\" class=\"shop_activity\"/>
                              <label>كوافير حريمي</label>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("كوافير رجالي",$shop_activities)." name=\"activity_29\">    
                              <input type=\"hidden\" value=\"كوافير رجالي\" class=\"shop_activity\"/>
                              <label>كوافير رجالي</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("أتيليه رجالي",$shop_activities)." name=\"activity_30\">    
                              <input type=\"hidden\" value=\"أتيليه رجالي\" class=\"shop_activity\"/>
                              <label>أتيليه رجالي</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("أتيليه حريمي",$shop_activities)." name=\"activity_31\">    
                              <input type=\"hidden\" value=\"أتيليه حريمي\" class=\"shop_activity\"/>
                              <label>أتيليه حريمي</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("العطار",$shop_activities)." name=\"activity_32\">    
                              <input type=\"hidden\" value=\"العطار\" class=\"shop_activity\"/>
                              <label>العطار</label>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("أدوات كهربية",$shop_activities)." name=\"activity_33\">    
                              <input type=\"hidden\" value=\"أدوات كهربية\" class=\"shop_activity\"/>
                              <label>أدوات كهربية</label>
                            </p>
                        </td>
                        <td>
                            <p style=\"margin-right:10px;margin-left:10px;\">
                              <input type=\"checkbox\" class=\"activity_all\" ".check_in_array("إستوديوهات وفوتوجرافيك",$shop_activities)." name=\"activity_34\">    
                              <input type=\"hidden\" value=\"إستوديوهات وفوتوجرافيك\" class=\"shop_activity\"/>
                              <label>إستوديوهات وفوتوجرافيك</label>
                            </p>
                        </td>
                        
                    </tr>  
                  </table>
                  ";

		echo $output;
	}

	


?>

<script type="text/javascript">


	$(".activity_all").change(function() {
			    // this will contain a reference to the checkbox   
			     var shop_id=$(this).parent().parent().parent().parent().siblings('.shop_id').val();
			     var shop_activity_value=$(this).siblings('.shop_activity').val();

                
                if (this.checked) 
                {
                	//active
                	set_shop_activity(shop_id,shop_activity_value);

                }else
                {
                	//deactive
                	unset_shop_activity(shop_id,shop_activity_value);

                }
            });


	function set_shop_activity(shop_id,shop_activity_value)
	{
		
		// Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var shop_id=shop_id;
        var url = "manage_shop_setting/set_shop_activity.php";
        var vars = "shop_id="+shop_id+"&&shop_activity="+shop_activity_value;

        hr.open("POST", url, true);
    
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
        
        if(hr.readyState == 4 && hr.status == 200) {
            	var return_data = hr.responseText;
            
        		
            	alert(return_data);

        	}


    	};

    	 hr.send(vars); // Actually execute the request
        
	}

	function unset_shop_activity(shop_id,shop_activity_value)
	{
		
		// Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file    
        var shop_id=shop_id;
        var url = "manage_shop_setting/unset_shop_activity.php";
        var vars = "shop_id="+shop_id+"&&shop_activity="+shop_activity_value;

        hr.open("POST", url, true);
    
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
        
        if(hr.readyState == 4 && hr.status == 200) {
            	var return_data = hr.responseText;
            
        		
            	alert(return_data);

        	}


    	};

    	 hr.send(vars); // Actually execute the request
        
	}


</script>