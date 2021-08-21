$(document).ready(function(){
	/*validation*/
	$("#Error_product_Name").hide();
	$("#Error_product_price").hide();
	$("#Error_main_product_photo").hide();
	$("#Error_product_photos").hide();
	$("#Error_product_description").hide();

	var Error_product_Name=false;
	var Error_product_price=false;
	var Error_main_product_photo=false;
	var Error_product_photos=false;
	var Error_product_description=false;


	$("#edit_product").focusout(function(){
        // alert("name");
        check_product_name();
	});
	$("#edit_product_price").focusout(function(){
        // alert("name");
        edit_product_price();
	});
	$('#edit_main_product_photo').on('change', function() {
        // alert("photo");
        ValidateFileUpload_update();
    });
    $('#edit_products_photo').on('change', function() {
        // alert("photo");
        var files = $("#edit_products_photo")[0].files;
			
		for (var i = 0; i < files.length; i++)
			{ 
				ValidateFileUpload_rest_photos_update(files[i].name);
			}

			$("#product_images").html(files.length+"");
        
    });
    $("#p_desc").focusout(function(){
        // alert("name");
        edit_product_description();
	});
    
    $("#edit_shop_submit").submit(function(){
		
		Error_product_Name=false;
		Error_product_price=false;
		Error_main_product_photo=false;
		Error_product_photos=false;
		Error_product_description=false;		
        
		//function call
        check_product_name();
        edit_product_price();
        

        edit_product_description();
            

       if(Error_product_Name==false&&Error_product_price==false&&Error_product_description==false)
       {
       		return true;
       }else
       {
       		return false;
       } 


	});

    function check_product_name()
    {
        
         
        var product_name_length=$("#edit_product").val().length;
        var product_name=$("#edit_product").val();
		if(product_name_length<3 || product_name_length>20)
		{
			$("#Error_product_Name").html("* يجب أن يكون أسم المنتج ما بين ال 3 إلي 20 حرف");
			$("#Error_product_Name").show();
			Error_product_Name=true;
		}else if(isNaN(product_name)==false)
        {
            $("#Error_product_Name").html("* أسم المنتج غير صحيح");
			$("#Error_product_Name").show();
			Error_product_Name=true;
        }else if(isNaN(product_name[0])==false)    
        {
          $("#Error_product_Name").html("* أسم المنتج لا يبدء برقم");
			$("#Error_product_Name").show();
			Error_product_Name=true;  
        }
        else{
                $("#Error_product_Name").hide();
         }
			
    }


    function edit_product_price()
    {
        var product_price=$("#edit_product_price").val();
        var isNumber2 = !/\D/.test(product_price);
		if(product_price=='')
		{
			$("#Error_product_price").html("من فضلك أدخل سعر المنتج.");
			$("#Error_product_price").show();
			Error_product_price=true;
		}else if(isNumber2==false)
		{
			$("#Error_product_price").html("سعر المنتج غير صحصيح.");
			$("#Error_product_price").show();
			Error_product_price=true;
		}else{
			$("#Error_product_price").hide();
		}
    }

    function ValidateFileUpload_update()
    {       
        var fuData = document.getElementById('edit_main_product_photo');
        var FileUploadPath = fuData.value;

        //To check if user upload any file
                if (FileUploadPath == '') {
                   $("#Error_main_product_photo").html("من فضلك أختر صورة");
			       $("#Error_main_product_photo").show();
			       Error_main_product_photo=true;
                } else {
                    var Extension = FileUploadPath.substring(
                            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

        //The file uploaded is an image

        if ( Extension == "png" || Extension == "jpeg" || Extension == "jpg") 
        {
            $("#Error_main_product_photo").hide();
                
        } 

        //The file upload is NOT an image
        else {
                   $("#Error_main_product_photo").html("هذه الامتدات المسموح بها  PNG, JPG and JPEG");
			       $("#Error_main_product_photo").show();
			       Error_main_product_photo=true;            
                    }
                }
    }

    function ValidateFileUpload_rest_photos_update(filesvalue)
    {
        var FileUploadPath = filesvalue;

        //To check if user upload any file
                if (FileUploadPath == '') {
                   $("#Error_product_photos").html("من فضلك أختر صورة");
			       $("#Error_product_photos").show();
			       Error_product_photos=true;
                } else {
                    var Extension = FileUploadPath.substring(
                            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

        //The file uploaded is an image

        if ( Extension == "png" || Extension == "jpeg" || Extension == "jpg") 
        {
            $("#Error_product_photos").hide();
                
        } 

        //The file upload is NOT an image
        else {
                   $("#Error_product_photos").html("هذه الامتدات المسموح بها  PNG, JPG and JPEG");
			       $("#Error_product_photos").show();
			       Error_product_photos=true;            
                    }
                }
    }


    function edit_product_description()
    {
        var product_des=$("#p_desc").val();

		if(product_des=='')
		{
			$("#Error_product_description").html("من فضلك أضف وصفا للمنتج.");
			$("#Error_product_description").show();
			Error_product_description=true;
		}else{
			$("#Error_product_description").hide();
		}
    }




});