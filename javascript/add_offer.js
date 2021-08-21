$(document).ready(function(){
	/*validation*/
	$("#Error_offer_name").hide();
	$("#Error_offer_photo").hide();
	$("#Error_offer_description").hide();
	$("#Error_advertisement_duration_from").hide();
	$("#Error_advertisement_duration_to").hide();
	$("#Error_offer_kind").hide();
	

	var Error_offer_name=false;
	var Error_offer_photo=false;
	var Error_offer_description=false;
	var Error_advertisement_duration_from=false;
	var Error_advertisement_duration_to=false;
	var Error_offer_kind=false;
	


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

	$("#add_advertisement_duration_from").focusout(function(){

		check_advertisement_duration_from();
	});

	$("#add_advertisement_duration_to").focusout(function(){

		check_advertisement_duration_to();
	});

	$("#add_offer_kind").focusout(function(){

		add_offer_kind();
	});

	$("#add_offer_submit").submit(function(){

		Error_offer_name=false;
		Error_offer_photo=false;
		Error_offer_description=false;
		Error_advertisement_cost=false;
		Error_advertisement_duration_from=false;
		Error_offer_kind=false;
		
		check_offer_name();
		ValidateFileUpload_update();
		add_offer_description();
		check_advertisement_duration_from();
		check_advertisement_duration_to();
		add_offer_kind();

		if(Error_offer_kind==false&&Error_advertisement_cost==false&&Error_advertisement_duration_from==false&&Error_offer_name==false&&Error_offer_photo==false&&Error_offer_description==false)
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
                   $("#Error_offer_photo").html("من فضلك أختر صورة");
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



	function check_advertisement_duration_from()
    {
        
        var advertisement_duration=$("#add_advertisement_duration_from").val();
        var advertisement_duration_length=$("#add_advertisement_duration_from").val().length;
        if(advertisement_duration_length==0)
        {
        	$("#Error_advertisement_duration_from").html("من فضلك أدخل تاريخ بداية العرض .");
			$("#Error_advertisement_duration_from").show();
			Error_advertisement_duration_from=true;
        }
        else{
                $("#Error_advertisement_duration_from").hide();
            } 
        
			
    }

    function check_advertisement_duration_to()
    {
        
        var advertisement_duration=$("#add_advertisement_duration_to").val();
        var advertisement_duration_length=$("#add_advertisement_duration_to").val().length;
        if(advertisement_duration_length==0)
        {
        	$("#Error_advertisement_duration_to").html("من فضلك أدخل تاريخ نهاية العرض.");
			$("#Error_advertisement_duration_to").show();
			Error_advertisement_duration_to=true;
        }
        else{
                $("#Error_advertisement_duration_to").hide();
            } 
        
			
    }


    function add_offer_kind()
    {
        var offer_kind=$("#add_offer_kind").val();

		if(offer_kind==null)
		{
			$("#Error_offer_kind").html("أأختر نوع العرض");
			$("#Error_offer_kind").show();
			Error_offer_kind=true;
		}else{
			$("#Error_offer_kind").hide();
		}
    }

});