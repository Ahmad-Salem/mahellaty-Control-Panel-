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


	$("#add_name").focusout(function(){
        // alert("name");
        check_user_name();
	});
	$("#add_Email").focusout(function(){
        // alert("name");
        check_add_user_email();
	});
	$("#add_pass").focusout(function(){
        // alert("pass");
        check_add_user_password();
	});
	$('#add_photo').on('change', function() {
        // alert("photo");
        ValidateFileUpload_update();
    });
	$("#add_user_type").focusout(function(){
        // alert("type");
        add_user_type();
	});
	$("#add_status").focusout(function(){
        // alert("status");
        add_user_status();
	});
	$("#add_gender").focusout(function(){
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


	$("#add_user_submit").submit(function(){
		
        
		Error_Name=false;
		Error_Email=false;
		Error_Pass=false;
		Error_photo=false;
		Error_user_type=false;
		Error_status=false;
		Error_gender=false;
		Error_address=false;
		Error_tele1=false;
		Error_tele2=false;

		check_user_name();
		check_add_user_email();
		check_add_user_password();
		ValidateFileUpload_update();
		add_user_type();
		add_user_status();
		add_user_gender();
		add_user_Address();
		add_telephone1();
		add_telephone2();
		
		 if(Error_Name==false && Error_Email==false && Error_Pass==false && Error_photo==false && Error_user_type==false && Error_status==false && Error_gender==false
		 	&& Error_address==false && Error_tele1==false && Error_tele2==false)
		 {
		 	return true;
		 }else{
		 	return false;
		 }

	});


	function check_user_name()
    {
        
         
        var user_name_length=$("#add_name").val().length;
        var user_name=$("#add_name").val();
		if(user_name_length<3 || user_name_length>20)
		{
			$("#Error_Name").html("* ?????? ???? ???????? ?????????? ???? ?????? ???? 3 ?????? 20 ??????");
			$("#Error_Name").show();
			Error_Name=true;
		}else if(isNaN(user_name)==false)
        {
            $("#Error_Name").html("* ?????????? ?????? ????????");
			$("#Error_Name").show();
			Error_Name=true;
        }else if(isNaN(user_name[0])==false)    
        {
          $("#Error_Name").html("* ?????????? ???? ???????? ????????");
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
        if(pattern.test($("#add_Email").val()))
            {
                $("#Error_Email").hide();
            }else{
                $("#Error_Email").html("* ???????????? ?????????????????????? ?????? ????????");
                $("#Error_Email").show();
                Error_Email=true;			
            }
    }
    
    function check_add_user_password()
    {
        	var password_length=$("#add_pass").val().length;
            if(password_length<8)
                {
                    $("#Error_Pass").html("* ?????? ???? ???????? ???????? ???????????? ?????? ?????????? ???????????? ???????? ");
                    $("#Error_Pass").show();
                    Error_Pass=true;
                }else{
                    $("#Error_Pass").hide();

                }

    }

    function ValidateFileUpload_update()
    {       
        var fuData = document.getElementById('add_photo');
        var FileUploadPath = fuData.value;

        //To check if user upload any file
                if (FileUploadPath == '') {
                   $("#Error_photo").html("???? ???????? ???????? ????????");
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
                   $("#Error_photo").html("?????? ???????????????? ?????????????? ?????? GIF, PNG, JPG, JPEG and BMP.");
			       $("#Error_photo").show();
			       Error_photo=true;            
                    }
                }
    }

    function add_user_type()
    {
        var user_type=$("#add_user_type").val();

		if(user_type==null)
		{
			$("#Error_user_type").html("???????? ??????????????.");
			$("#Error_user_type").show();
			Error_user_type=true;
		}else{
			$("#Error_user_type").hide();
		}
    }

    function add_user_status()
    {
        var status=$("#add_status").val();

		if(status==null)
		{
			$("#Error_status").html("???????? ????????????.");
			$("#Error_status").show();
			Error_status=true;
		}else{
			$("#Error_status").hide();
		}
    }


    function add_user_gender()
    {
        var gender=$("#add_gender").val();

		if(gender==null)
		{
			$("#Error_gender").html("???????? ??????????.");
			$("#Error_gender").show();
			Error_gender=true;
		}else{
			$("#Error_gender").hide();
		}
    }

    function add_user_Address()
    {
        var user_address=$("#add_address").val();
       
        if(isNaN(user_address))
            {   
                $("#Error_address").hide();
            }else if(user_address==""){
                 $("#Error_address").html("?????????? ?????? ????????.");
			     $("#Error_address").show();
			     Error_address=true;
            }else{
            	 $("#Error_address").html("?????????? ?????? ????????.");
			     $("#Error_address").show();
			     Error_address=true;
            }
    }

    function add_telephone1()
    {
        var user_telephone1=$("#add_tele1").val();
        var user_telephone1_length=$("#add_tele1").val().length;
        if(isNaN(user_telephone1)==true)
            {
                 $("#Error_tele1").html("?????? ???????????? ?????? ????????.");
			     $("#Error_tele1").show();
			     Error_tele1=true; 
            }else if(user_telephone1_length<10 || user_telephone1_length>12)
            {
                $("#Error_tele1").html("?????? ?????? ???????????????? ?????? ????????.");
			     $("#Error_tele1").show();
			     Error_tele1=true;
            }else{
                $("#Error_tele1").hide();
            }
    }

    function add_telephone2()
    {
        var user_telephone2=$("#add_tele2").val();
        var user_telephone2_length=$("#add_tele2").val().length;
        if(isNaN(user_telephone2)==true)
            {
                 $("#Error_tele2").html("?????? ???????????? ?????? ????????.");
			     $("#Error_tele2").show();
			     Error_tele1=true; 
            }else if(user_telephone2_length<10 || user_telephone2_length>12)
            {
                $("#Error_tele2").html("?????? ?????? ???????????????? ?????? ????????.");
			     $("#Error_tele2").show();
			     Error_tele2=true;
            }else{
                $("#Error_tele2").hide();
            }
    }

});