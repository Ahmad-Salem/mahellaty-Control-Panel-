<?php
	session_start();
    include_once("../../../php_includes/connection_db.php");
    include_once("../../../php_includes/funtions.php");	

    if($_POST['do_action']=="send_activation_code")
	{

		//getting email 
	    $Email=mysqli_real_escape_string($connect, $_POST['email']);
		
	    if(!empty($Email))
	    {
	    	$activation_code_rec=array();
	    	$query_getting_activation_code="SELECT  `code_activation` FROM `users` WHERE `email`='{$Email}'  LIMIT 1";
	    	$perfrom_query_getting_activation_code=mysqli_query($connect,$query_getting_activation_code);
	    	if($perfrom_query_getting_activation_code)
	    	{
	    		$row_activation=mysqli_fetch_assoc($perfrom_query_getting_activation_code);
	    		$activation_code=$row_activation['code_activation'];
	    		$activation_code_rec=array(
						"activation_flag"=>"1"
						);
	    		// mail with activation code 

		    	$ToEmail=$Email;
				$header='Activation Code';
				$message_email="
					<html dir=\"rtl\" lang=\"ar\">
				    <head>
				        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
				        <title>Ma7latCom</title>
				        <link href=\"https://fonts.googleapis.com/css?family=Cairo:300\" rel=\"stylesheet\">
				        <style type=\"text/css\">
				        body {font-family: 'Cairo', sans-serif;  margin: 0; padding: 0; min-width: 100%!important; direction: rtl; text-align:right;}
				        .content {width: 80%; max-width: 600px; margin:0px auto;background-color: #fafafa;}
				        .content .header{background-color: #00838f;padding:10px;}
				        .content .header .inside_header{width: 150px; margin: 0 auto;}  
				        .content .header img{width: 150px;height: 64px;}
				        .content .body{padding-right: 10px; color:#00838f;text-align:right;direction:rtl;}
				        .content .body p{font-weight: bolder;text-align:right;direction:rtl;}
				        .content .body span{color: blue; text-decoration: underline;text-align:right;direction:rtl;}
				        .content .footer{background-color: #00838f;padding: 10px;} 
				        .content .footer h4{text-align: center; color:#fff;}  
				        </style>
				    </head>
				    <body >
				        <div class=\"content\">
				            <div class=\"header\">
				            	<div class=\"inside_header\">
				            		<img src=\"http://ma7latcom.com/59a1cac00edcbfa80c57957dc1e9018a/images/default_images/logo.png\" title=\"ma7alty\"/>
				            	</div>
				            </div>
				            <div class=\"body\">
				                <h3>كود التفعيل:</h3>
				                <p>لتفعيل الحساب الخاص بكم ادخل الكود التالي&nbsp;:&nbsp;&nbsp;<span>{$activation_code}</span></p>
				                <p>أرقام خدمة العملاء&nbsp;:&nbsp;&nbsp;<span>01030442242&nbsp;,&nbsp;01010100789&nbsp;,&nbsp;01019649797</span></p>
				                <p>مع تحيات إدارة محلاتكوم</p>
					                
				            </div>
				            <div class=\"footer\"><h4>جميع الحقوق محفوظة لدي محلاتكوم 2018</h4></div>    
				        </div>
				        
				    </body>
				</html>";

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// Additional headers
				$headers .= 'From: ma7latCom@ma7latCom.com' . "\r\n";
				$headers .= 'Cc: ' . "\r\n";
				$headers .= 'Bcc: ' . "\r\n";

				mail($ToEmail,$header,$message_email,$headers);


	    	}else
	    	{
	    		$activation_code_rec=array(
						"activation_flag"=>"0"
						);
	    	}
	    }else
	    {
	    	//error
	    	$activation_code_rec=array(
						"activation_flag"=>"0"
						);
	    }
	    echo json_encode($activation_code_rec,JSON_FORCE_OBJECT);
	}
?>