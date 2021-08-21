$(document).ready(function(){
	// alert("helloo world");

	/*validation script */
	$("#Error_Shop_Name").hide();
	$("#Error_shop_address").hide();
	$("#Error_photo").hide();
	$("#Error_country").hide();
	$("#Error_activity").hide();
	$("#Error_shop_description").hide();
	$("#Error_lat").hide();
	$("#Error_long").hide();
	$("#Error_allowed_porducts").hide();
	$("#Error_allowed_offers").hide();
	$("#Error_government").hide();
	$("#Error_city").hide();

	var Error_Shop_Name=false;
	var Error_shop_address=false;
	var Error_photo=false;
	var Error_country=false;
	var Error_activity=false;
	var Error_shop_description=false;
	var Error_lat=false;
	var Error_long=false;
	var Error_allowed_porducts=false;
	var Error_allowed_offers=false;
	var Error_government=false;
	var Error_city=false;


	$("#edit_shop_name").focusout(function(){
        // alert("name");
        edit_shop_name();
	});

	$("#edit_shop_address").focusout(function(){
        // alert("name");
        edit_shop_Address();
	});
	$('#edit_photo').on('change', function() {
        // alert("photo");
        ValidateFileUpload_update();
    });
	$("#edit_country").focusout(function(){
        // alert("name");
        edit_shop_country();
	});
	$("#edit_shop_activity").focusout(function(){
        // alert("name");
        edit_shop_activity();
	});
	$("#shop_desc").focusout(function(){
        // alert("name");
        edit_shop_description();
	});
	$("#latitude").focusout(function(){
        // alert("name");
        edit_shop_latitude();
	});
	$("#longitude").focusout(function(){
        // alert("name");
        edit_shop_longitude();
	});
	$("#allowed_product").focusout(function(){
        // alert("name");
        edit_shop_allowed_product();
	});

	$("#allowed_offers").focusout(function(){
        // alert("name");
        edit_shop_allowed_offer();
	});

	$("#add_government").focusout(function(){
        // alert("add_shop");
        add_shop_government();
	});

	$("#add_city").focusout(function(){
        // alert("add_shop");
        add_shop_city();
	});

	$("#edit_user_submit").submit(function(){
		// alert("test submit");

		Error_Shop_Name=false;
		Error_shop_address=false;
		Error_country=false;
		Error_activity=false;
		Error_shop_description=false;
		Error_lat=false;
		Error_long=false;
		Error_allowed_porducts=false;
		Error_allowed_offers=false;
		Error_government=false;
		Error_city=false;

		edit_shop_name();
		edit_shop_Address();
		edit_shop_country();
		edit_shop_activity();
		edit_shop_description();
		edit_shop_latitude();
		edit_shop_longitude();
		edit_shop_allowed_product();
		edit_shop_allowed_offer();
		add_shop_government();
		add_shop_city();

    	if(Error_Shop_Name==false && Error_shop_address==false && Error_country==false && Error_activity==false && Error_shop_description==false && Error_lat==false && Error_long==false && Error_allowed_porducts==false && Error_allowed_offers==false && Error_government==false && Error_city==false)
    	{
    		return true;
    	}else
    	{
    		return false;
    	}
    });


	function edit_shop_name()
    {
        
         
        var shop_name_length=$("#edit_shop_name").val().length;
        var shop_name=$("#edit_shop_name").val();
		if(shop_name_length<3 || shop_name_length>20)
		{
			$("#Error_Shop_Name").html("* يجب أن يكون أسم المحل ما بين ال 3 إلي 20 حرف");
			$("#Error_Shop_Name").show();
			Error_Shop_Name=true;
		}else if(isNaN(shop_name)==false)
        {
            $("#Error_Shop_Name").html("* أسم المحل غير صحيح");
			$("#Error_Shop_Name").show();
			Error_Shop_Name=true;
        }else if(isNaN(shop_name[0])==false)    
        {
          $("#Error_Shop_Name").html("* أسم المحل لا يبدء برقم");
			$("#Error_Shop_Name").show();
			Error_Shop_Name=true;  
        }
        else{
                $("#Error_Shop_Name").hide();
         }
			
    }

    function edit_shop_Address()
    {
        var shop_address=$("#edit_shop_address").val();
       
        if(isNaN(shop_address))
            {   
                $("#Error_shop_address").hide();
            }else if(shop_address==""){
                 $("#Error_shop_address").html("عنوان غير صحيح.");
			     $("#Error_shop_address").show();
			     Error_shop_address=true;
            }else{
            	 $("#Error_shop_address").html("عنوان غير صحيح.");
			     $("#ErError_shop_addressror_address").show();
			     Error_shop_address=true;
            }
    }

    function ValidateFileUpload_update()
    {       
        var fuData = document.getElementById('edit_photo');
        var FileUploadPath = fuData.value;

        //To check if user upload any file
                if (FileUploadPath == '') {
                   $("#Error_photo").html("لم يتم أختيار الصورة");
			       $("#Error_photo").show();
			       Error_photo=true;
                } else {
                    var Extension = FileUploadPath.substring(
                            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

        //The file uploaded is an image

        if ( Extension == "png" || Extension == "jpeg" || Extension == "jpg") 
        {
            $("#Error_photo").hide();
                
        } 

        //The file upload is NOT an image
        else {
                   $("#Error_photo").html("هذه الامتدات المسموح بها  PNG, JPG and JPEG");
			       $("#Error_photo").show();
			       Error_photo=true;            
                    }
                }
    }

    function edit_shop_country()
    {
        var shop_country=$("#add_country").val();

		if(shop_country=='')
		{
			$("#Error_country").html("أختر الدولة.");
			$("#Error_country").show();
			Error_country=true;
		}else{
			$("#Error_country").hide();
		}
    }

    function add_shop_government()
    {
        var shop_government=$("#add_government").val();
        

		if(shop_government==null)
		{
			$("#Error_government").html("أختر المحافظة.");
			$("#Error_government").show();
			Error_government=true;
		}else{
			$("#Error_government").hide();
		}
    }

    function add_shop_city()
    {
        var shop_city=$("#add_city").val();

		if(shop_city==null)
		{
			$("#Error_city").html("أختر المدينة.");
			$("#Error_city").show();
			Error_city=true;
		}else{
			$("#Error_city").hide();
		}
    }


    function edit_shop_activity()
    {
        var shop_activity=$("#add_shop_activity").val();

		if(shop_activity=='')
		{
			$("#Error_activity").html("أختر نشاط المحل.");
			$("#Error_activity").show();
			Error_activity=true;
		}else{
			$("#Error_activity").hide();
		}
    }

    function edit_shop_description()
    {
        var shop_des=$("#s_desc").val();

		if(shop_des=='')
		{
			$("#Error_shop_description").html("من فضلك أضف وصفا للمنتج.");
			$("#Error_shop_description").show();
			Error_shop_description=true;
		}else{
			$("#Error_shop_description").hide();
		}
    }

    function edit_shop_latitude()
    {
        var shop_latitude=$("#latitude").val();
        var isNumber = (shop_latitude.match(/^-?\d*(\.\d+)?$/))
		
		if(shop_latitude=='')
		{
			$("#Error_lat").html("من فضلك أدخل ال latitude.");
			$("#Error_lat").show();
			Error_lat=true;
		}else if(isNumber==false)
		{
			$("#Error_lat").html("ال latitude غير صحيح.");
			$("#Error_lat").show();
			Error_lat=true;
		}else{
			$("#Error_lat").hide();
		}
    }
    function edit_shop_longitude()
    {
        var shop_longitude=$("#longitude").val();
        var isNumber2 = (shop_latitude.match(/^-?\d*(\.\d+)?$/))
		if(shop_longitude=='')
		{
			$("#Error_long").html("من فضلك أدخل ال longitude.");
			$("#Error_long").show();
			Error_long=true;
		}else if(isNumber2==false)
		{
			$("#Error_long").html("ال longitude غير صحيح.");
			$("#Error_long").show();
			Error_long=true;
		}else{
			$("#Error_long").hide();
		}
    }
  //   function edit_shop_latitude()
  //   {
  //       var shop_latitude=$("#latitude").val();
  //       var isNumber = !/\D/.test(shop_latitude);;
		
		// if(shop_latitude=='')
		// {
		// 	$("#Error_lat").html("من فضلك أدخل ال latitude.");
		// 	$("#Error_lat").show();
		// 	Error_lat=true;
		// }else if(isNumber==false)
		// {
		// 	$("#Error_lat").html("ال latitude غير صحيح.");
		// 	$("#Error_lat").show();
		// 	Error_lat=true;
		// }else{
		// 	$("#Error_lat").hide();
		// }
  //   }
  //   function edit_shop_longitude()
  //   {
  //       var shop_longitude=$("#longitude").val();
  //       var isNumber2 = !/\D/.test(shop_longitude);
		// if(shop_longitude=='')
		// {
		// 	$("#Error_long").html("من فضلك أدخل ال longitude.");
		// 	$("#Error_long").show();
		// 	Error_long=true;
		// }else if(isNumber2==false)
		// {
		// 	$("#Error_long").html("ال longitude غير صحيح.");
		// 	$("#Error_long").show();
		// 	Error_long=true;
		// }else{
		// 	$("#Error_long").hide();
		// }
  //   }

    function edit_shop_allowed_product()
    {
        var shop_allowed_product=$("#allowed_product").val();
        var isNumber2 = !/\D/.test(shop_allowed_product);
		if(shop_allowed_product=='')
		{
			$("#Error_allowed_porducts").html("من فضلك أدخل عدد المنتجات المسموح بها.");
			$("#Error_allowed_porducts").show();
			Error_allowed_porducts=true;
		}else if(isNumber2==false)
		{
			$("#Error_allowed_porducts").html("عدد المنتجات المدخلة غير صحيح.");
			$("#Error_allowed_porducts").show();
			Error_allowed_porducts=true;
		}else{
			$("#Error_allowed_porducts").hide();
		}
    }

    function edit_shop_allowed_offer()
    {
        var shop_allowed_product=$("#allowed_offers").val();
        var isNumber2 = !/\D/.test(shop_allowed_product);
		if(shop_allowed_product=='')
		{
			$("#Error_allowed_offers").html("من فضلك أدخل عدد العروض المسموح بها.");
			$("#Error_allowed_offers").show();
			Error_allowed_offers=true;
		}else if(isNumber2==false)
		{
			$("#Error_allowed_offers").html("عدد العروض المدخلة غير صحيح.");
			$("#Error_allowed_offers").show();
			Error_allowed_offers=true;
		}else{
			$("#Error_allowed_offers").hide();
		}
    }


});