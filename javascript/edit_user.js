$(document).ready(function(){
	
	/*validation code*/
	$("#Error_Name").hide();
    $("#Error_Email").hide();
	$("#Error_Pass").hide();
	$("#Error_photo").hide();
	$("#Error_user_type").hide();
	$("#Error_status").hide();
	$("#Error_gender").hide();
	$("#Error_address").hide();
	$("#Error_tele1").hide();
	$("#Error_tele2").hide();

	var Error_Name=false;
    var Error_Email=false;
	var Error_Pass=false;
	var Error_photo=false;
	var Error_user_type=false;
	var Error_status=false;
	var Error_gender=false;
	var Error_address=false;
	var Error_tele1=false;
	var Error_tele2=false;


    $("#edit_name").focusout(function(){
        // alert("name");
        check_edit_user_name();
    });
    $("#edit_email").focusout(function(){
        // alert("name");
        check_add_user_email();
    });
    $("#edit_pass").focusout(function(){
        // alert("pass");
        check_add_user_password();
    });
    $('#update_photo').on('change', function() {
        // alert("photo");
        ValidateFileUpload_update();
    });
    $("#edit_user_type").focusout(function(){
        // alert("type");
        add_user_type();
    });
    $("#edit_status").focusout(function(){
        // alert("status");
        add_user_status();
    });
    $("#edit_gender").focusout(function(){
        // alert("gender");
        add_user_gender();
    });
    $("#add_address").focusout(function(){
        // alert("address");
        add_user_Address();
    });
    $("#add_tele1").focusout(function(){
        // alert("tele1");
        add_telephone1();
    });
    $("#add_tele2").focusout(function(){
        // alert("tele2");
        add_telephone2();
    });


	$("#edit_user_submit").submit(function(){
		
        
		Error_Name=false;
        Error_Email=false;
		Error_Pass=false;
		Error_user_type=false;
		Error_status=false;
		Error_gender=false;
		Error_address=false;
		Error_tele1=false;
		Error_tele2=false;

		check_edit_user_name();
        check_add_user_email();
		check_add_user_password();
		ValidateFileUpload_update();
        add_user_type();
		add_user_status();
		add_user_gender();
		add_user_Address();
		add_telephone1();
		add_telephone2();
		 
         if(Error_Name==false&& Error_Email==false && Error_Pass==false && Error_user_type==false && Error_status==false && Error_gender==false
		 	&& Error_address==false && Error_tele1==false && Error_tele2==false)
		 {
		 	return true;
		 }else{
		 	return false;
		 }

	});

 function check_edit_user_name()
 {
    var user_name_length=$("#edit_name").val().length;
    var user_name=$("#edit_name").val();
    if(user_name_length<3 || user_name_length>20)
    {
        $("#Error_Name").html("* يجب أن يكون الأسم ما بين ال 3 إلي 20 حرف");
        $("#Error_Name").show();
        Error_Name=true;
    }else if(isNaN(user_name)==false)
    {
        $("#Error_Name").html("* الأسم غير صحيح");
        $("#Error_Name").show();
        Error_Name=true;
    }else if(isNaN(user_name[0])==false)    
    {
      $("#Error_Name").html("* الأسم لا يبدء برقم");
        $("#Error_Name").show();
        Error_Name=true;  
    }
    else{
            $("#Error_Name").hide();
     }
 }   
 function check_add_user_email()
    {
        var pattern=new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        if(pattern.test($("#edit_email").val()))
            {
                $("#Error_Email").hide();
            }else{
                $("#Error_Email").html("* البريد اللألكتروني غير صحيح");
                $("#Error_Email").show();
                Error_Email=true;			
            }
    }
    
    function check_add_user_password()
    {
        	var password_length=$("#edit_pass").val().length;
            if(password_length<8)
                {
                    $("#Error_Pass").html("* يجب أن تكون كلمة المرور علي الأقل ثمانية أحرف ");
                    $("#Error_Pass").show();
                    Error_Pass=true;
                }else{
                    $("#Error_Pass").hide();

                }

    }

    function ValidateFileUpload_update()
    {       
        var fuData = document.getElementById('update_photo');
        var FileUploadPath = fuData.value;

        //To check if user upload any file
                if (FileUploadPath == '') {
                   $("#Error_photo").html("لم يتم تغير الصورة الشخصية");
			       $("#Error_photo").show();
			       Error_photo=true;
                } else {
                    var Extension = FileUploadPath.substring(
                            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

        //The file uploaded is an image

        if (Extension == "gif" || Extension == "png" || Extension == "bmp"
                            || Extension == "jpeg" || Extension == "jpg") 
        {
            $("#Error_photo").hide();
                
        } 

        //The file upload is NOT an image
        else {
                   $("#Error_photo").html("هذخ الامتدات المسموح بها GIF, PNG, JPG, JPEG and BMP.");
			       $("#Error_photo").show();
			       Error_photo=true;            
                    }
                }
    }

    function add_user_type()
    {
        var user_type=$("#edit_user_type").val();

		if(user_type==null)
		{
			$("#Error_user_type").html("أختر الوظيفة.");
			$("#Error_user_type").show();
			Error_user_type=true;
		}else{
			$("#Error_user_type").hide();
		}
    }

    function add_user_status()
    {
        var status=$("#edit_status").val();

		if(status==null)
		{
			$("#Error_status").html("أختر الحالة.");
			$("#Error_status").show();
			Error_status=true;
		}else{
			$("#Error_status").hide();
		}
    }


    function add_user_gender()
    {
        var gender=$("#edit_gender").val();

		if(gender==null)
		{
			$("#Error_gender").html("أختر النوع.");
			$("#Error_gender").show();
			Error_gender=true;
		}else{
			$("#Error_gender").hide();
		}
    }

    function add_user_Address()
    {
        var user_address=$("#edit_address").val();
       
        if(isNaN(user_address))
            {   
                $("#Error_address").hide();
            }else if(user_address==""){
                 $("#Error_address").html("عنوان غير صحيح.");
			     $("#Error_address").show();
			     Error_address=true;
            }else{
            	 $("#Error_address").html("عنوان غير صحيح.");
			     $("#Error_address").show();
			     Error_address=true;
            }
    }

    function add_telephone1()
    {
        var user_telephone1=$("#edit_tele1").val();
        var user_telephone1_length=$("#edit_tele1").val().length;
        if(isNaN(user_telephone1)==true)
            {
                 $("#Error_tele1").html("رقم تليفون غير صحيح.");
			     $("#Error_tele1").show();
			     Error_tele1=true; 
            }else if(user_telephone1_length<10 || user_telephone1_length>12)
            {
                $("#Error_tele1").html("طول رقم التليفون غير صحيح.");
			     $("#Error_tele1").show();
			     Error_tele1=true;
            }else{
                $("#Error_tele1").hide();
            }
    }

    function add_telephone2()
    {
        var user_telephone2=$("#edit_tele2").val();
        var user_telephone2_length=$("#edit_tele2").val().length;
        if(isNaN(user_telephone2)==true)
            {
                 $("#Error_tele2").html("رقم تليفون غير صحيح.");
			     $("#Error_tele2").show();
			     Error_tele1=true; 
            }else if(user_telephone2_length<10 || user_telephone2_length>12)
            {
                $("#Error_tele2").html("طول رقم التليفون غير صحيح.");
			     $("#Error_tele2").show();
			     Error_tele2=true;
            }else{
                $("#Error_tele2").hide();
            }
    }


});