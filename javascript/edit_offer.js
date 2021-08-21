$(document).ready(function(){
	/*validation*/
	$("#Error_offer_name").hide();
	$("#Error_offer_photo").hide();
	$("#Error_offer_description").hide();

	var Error_offer_name=false;
	var Error_offer_photo=false;
	var Error_offer_description=false;


	$("#add_offer").focusout(function(){
        // alert("name");
        check_offer_name();
	});
	$('#add_offer_photo').on('change', function() {
        // alert("photo");
        ValidateFileUpload_update();
    });
	$("#offer_desc").focusout(function(){
        // alert("name");
        add_offer_description();
	});

	$("#add_offer_submit").submit(function(){

		Error_offer_name=false;
		Error_offer_photo=false;
		Error_offer_description=false;
		
		check_offer_name();
		ValidateFileUpload_update();
		add_offer_description();

		if(Error_offer_name==false&&Error_offer_description==false)
		{
			return true;
		}else
		{
			return false;
		}

	});

	function check_offer_name()
    {
        
         
        var offer_name_length=$("#add_offer").val().length;
        var offer_name=$("#add_offer").val();
		if(offer_name_length<3 || offer_name_length>20)
		{
			$("#Error_offer_name").html("* يجب أن يكون أسم العرض ما بين ال 3 إلي 20 حرف");
			$("#Error_offer_name").show();
			Error_offer_name=true;
		}else if(isNaN(offer_name)==false)
        {
            $("#Error_offer_name").html("* أسم العرض غير صحيح");
			$("#Error_offer_name").show();
			Error_offer_name=true;
        }else if(isNaN(offer_name[0])==false)    
        {
          $("#Error_offer_name").html("* أسم العرض لا يبدء برقم");
			$("#Error_offer_name").show();
			Error_offer_name=true;  
        }
        else{
                $("#Error_offer_name").hide();
         }
			
    }

    function ValidateFileUpload_update()
    {       
        var fuData = document.getElementById('add_offer_photo');
        var FileUploadPath = fuData.value;

        //To check if user upload any file
                if (FileUploadPath == '') {
                   $("#Error_offer_photo").html("لم يتم تغير صورة");
			       $("#Error_offer_photo").show();
			       Error_offer_photo=true;
                } else {
                    var Extension = FileUploadPath.substring(
                            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

        //The file uploaded is an image

        if ( Extension == "png" || Extension == "jpeg" || Extension == "jpg") 
        {
            $("#Error_offer_photo").hide();
                
        } 

        //The file upload is NOT an image
        else {
                   $("#Error_offer_photo").html("هذه الامتدات المسموح بها  PNG, JPG and JPEG");
			       $("#Error_offer_photo").show();
			       Error_offer_photo=true;            
                    }
                }
    }


    function add_offer_description()
    {
        var offer_des=$("#offer_desc").val();

		if(offer_des=='')
		{
			$("#Error_offer_description").html("من فضلك أضف وصفا للعرض.");
			$("#Error_offer_description").show();
			Error_offer_description=true;
		}else{
			$("#Error_offer_description").hide();
		}
    }

});