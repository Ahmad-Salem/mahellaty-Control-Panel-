$(document).ready(function(){
	/*validation script */
	$("#Error_Shop_Name").hide();
	$("#Error_shop_address").hide();
	$("#Error_photo").hide();
	$("#Error_country").hide();
	$("#Error_activity").hide();
	$("#Error_shop_description").hide();
	$("#Error_lat").hide();
	$("#Error_long").hide();
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
	var Error_government=false;
	var Error_city=false;

	$("#add_shop").focusout(function(){
        // alert("add_shop");
        check_shop_name();
	});	
	$("#add_shop_address").focusout(function(){
        // alert("add_shop_address");
        add_shop_Address();
	});	
	$('#add_photo').on('change', function() {
        // alert("add_photo");
        ValidateFileUpload_update();
    });	
	$("#add_country").focusout(function(){
        // alert("add_country");
        add_shop_country();
	});
	$("#add_shop_activity").focusout(function(){
        // alert("add_country");
        add_shop_activity();
	});	
	$("#s_desc").focusout(function(){
        // alert("s_desc");
        add_shop_description();
	});	
	$("#latitude").focusout(function(){
        // alert("latitude");
        add_shop_latitude();
	});	
	$("#longitude").focusout(function(){
        // alert("longitude");
        add_shop_longitude();
	});	

	$("#add_government").focusout(function(){
        // alert("add_shop");
        add_shop_government();
	});

	$("#add_city").focusout(function(){
        // alert("add_shop");
        add_shop_city();
	});
	$("#add_shop_submit").submit(function(){

		// alert("submit done!!");
		Error_Shop_Name=false;
		Error_shop_address=false;
		Error_photo=false;
		Error_country=false;
		Error_activity=false;
		Error_shop_description=false;
		Error_lat=false;
		Error_long=false;
		Error_government=false;
		Error_city=false;

		check_shop_name();
		add_shop_Address();
		ValidateFileUpload_update();
		add_shop_country();
		add_shop_activity();
		add_shop_description();
		add_shop_latitude();
		add_shop_longitude();
		add_shop_government();
		add_shop_city();

		if(Error_Shop_Name==false && Error_shop_address==false && Error_photo==false && Error_country==false && Error_activity==false && Error_shop_description==false && Error_lat==false && Error_long==false && Error_government==false && Error_city==false)
		{
			return true;
		}else
		{
			return false;
		}



	});

	function check_shop_name()
    {
        
         
        var shop_name_length=$("#add_shop").val().length;
        var shop_name=$("#add_shop").val();
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

    function add_shop_Address()
    {
        var shop_address=$("#add_shop_address").val();
       
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
        var fuData = document.getElementById('add_photo');
        var FileUploadPath = fuData.value;

        //To check if user upload any file
                if (FileUploadPath == '') {
                   $("#Error_photo").html("من فضلك أختر صورة");
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

    function add_shop_country()
    {
        var shop_country=$("#add_country").val();

		if(shop_country==null)
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

    function add_shop_activity()
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

    function add_shop_description()
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
    function add_shop_latitude()
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
    function add_shop_longitude()
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


});