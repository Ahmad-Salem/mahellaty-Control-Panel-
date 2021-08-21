$(document).ready(function(){
    
   /*validation code*/
	$("#Error_Name").hide();
	$("#Error_Pass").hide();

   
	var Error_Name=false;
	var Error_Pass=false;

 	$("#admin_name").focusout(function(){
        check_admin_login_name();
	});

 	$("#admin_pass").focusout(function(){
       check_admin_login_password();
	});

	$("#admin_login_submit").submit(function(){
		
        
		 Error_Name=false;
		 Error_Pass=false;

		 check_admin_login_name();
		 check_admin_login_password();

		 if(Error_Name==false && Error_Pass==false)
		 {
		 	return true;
		 }else{
		 	return false;
		 }
	});
    
    
    
    
    
     function check_admin_login_name()
    {
        var pattern=new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        if(pattern.test($("#admin_name").val()))
            {
                $("#Error_Name").hide();
            }else{
                $("#Error_Name").html("* البريد اللألكتروني غير صحيح");
                $("#Error_Name").show();
                Error_Name=true;			
            }
    }
    
    function check_admin_login_password()
    {
        	var password_length=$("#admin_pass").val().length;
            if(password_length<8)
                {
                    $("#Error_Pass").html("* يجب أن تكون كلمة المرور علي الأقل ثمانية أحرف ");
                    $("#Error_Pass").show();
                    Error_Pass=true;
                }else{
                    $("#Error_Pass").hide();

                }

    }

    
    
});