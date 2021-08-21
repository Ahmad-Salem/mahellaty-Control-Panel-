$(document).ready(function(){
	/*validation*/
	$("#Error_advertisement_title").hide();
	$("#Error_advertisement_photo").hide();
	$("#Error_advertisement_description").hide();
	$("#Error_government").hide();
	$("#Error_city").hide();
	$("#Error_advertisement_duration_from").hide();
	$("#Error_advertisement_duration_to").hide();
	$("#Error_advertisement_cost").hide();	

	var Error_advertisement_title=false;
	var Error_advertisement_photo=false;
	var Error_advertisement_description=false;
	var Error_government=false;
	var Error_advertisement_duration_from=false;
	var Error_advertisement_duration_to=false;
	var Error_city=false;
	var Error_advertisement_cost=false;


	$("#add_advertisement_cost").focusout(function(){
        // alert("add_shop");
        check_advertisement_cost();
	});

	$("#add_advertisement").focusout(function(){
        // alert("name");
        check_advertisement_name();
	});
	$('#add_advertisement_photo').on('change', function() {
        // alert("photo");
        ValidateFileUpload_update();
    });
	$("#advertisement_desc").focusout(function(){
        // alert("name");
        add_advertisement_description();
	});

	$("#add_government").focusout(function(){
        // alert("add_shop");
        add_shop_government();
	});


	$("#add_advertisement_duration_from").focusout(function(){

		check_advertisement_duration_from();
	});

	$("#add_advertisement_duration_to").focusout(function(){

		check_advertisement_duration_to();
	});

	$("#add_city").focusout(function(){

		
		add_shop_city();

	});
	$("#add_advertisement_submit").submit(function(){

		Error_advertisement_title=false;
		Error_advertisement_photo=false;
		Error_advertisement_description=false;
		Error_government=false;
		Error_advertisement_duration_from=false;
	    Error_advertisement_duration_to=false;
	    Error_city=false;
	    Error_advertisement_cost=false;
		

		check_advertisement_name();
		ValidateFileUpload_update();
		add_advertisement_description();
		add_shop_government();
		check_advertisement_duration_from();
		check_advertisement_duration_to();
		add_shop_city();
		check_advertisement_cost();
		

		if(Error_advertisement_cost==false&&Error_advertisement_duration_from==false&&Error_advertisement_duration_to==false&&Error_city==false&&Error_advertisement_title==false&&Error_advertisement_photo==false&&Error_advertisement_description==false&&Error_government==false)
		{
			return true;
		}else
		{
			return false;
		}

	});


	function check_advertisement_cost()
    {
        
        var advertisement_cost=$("#add_advertisement_cost").val();
        var advertisement_cost_length=$("#add_advertisement_cost").val().length;
        if(advertisement_cost_length==0)
        {
        		$("#Error_advertisement_cost").html("من فضلك أدخل تكلفة الأعلان.");
			    $("#Error_advertisement_cost").show();
			    Error_advertisement_cost=true;
        }
        else if(isNaN(advertisement_cost)==true)
            {
                 $("#Error_advertisement_cost").html("القيم المدخلة غير صحيحة.");
			     $("#Error_advertisement_cost").show();
			     Error_advertisement_cost=true; 
            }else if(advertisement_cost_length<0 || advertisement_cost_length>6)
            {
                $("#Error_advertisement_cost").html("هذه القيم غير مسموح بها.");
			     $("#Error_advertisement_cost").show();
			     Error_advertisement_cost=true;
            }else{
                $("#Error_advertisement_cost").hide();
            } 
        
			
    }

	function check_advertisement_duration_from()
    {
        
        var advertisement_duration=$("#add_advertisement_duration_from").val();
        var advertisement_duration_length=$("#add_advertisement_duration_from").val().length;
        if(advertisement_duration_length==0)
        {
        	$("#Error_advertisement_duration_from").html("من فضلك أدخل تاريخ بداية الاعلان .");
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
        	$("#Error_advertisement_duration_to").html("من فضلك أدخل تاريخ نهاية الاعلان.");
			$("#Error_advertisement_duration_to").show();
			Error_advertisement_duration_to=true;
        }
        else{
                $("#Error_advertisement_duration_to").hide();
            } 
        
			
    }

	function check_advertisement_name()
    {
        
         
        var advertisement_name_length=$("#add_advertisement").val().length;
        var advertisement_name=$("#add_advertisement").val();
		if(advertisement_name_length<3 || advertisement_name_length>20)
		{
			$("#Error_advertisement_title").html("* يجب أن يكون عنوان الاعلان ما بين ال 3 إلي 20 حرف");
			$("#Error_advertisement_title").show();
			Error_advertisement_title=true;
		}else if(isNaN(advertisement_name)==false)
        {
            $("#Error_advertisement_title").html("* عنوان الاعلان غير صحيح");
			$("#Error_advertisement_title").show();
			Error_advertisement_title=true;
        }else if(isNaN(advertisement_name[0])==false)    
        {
          $("#Error_advertisement_title").html("* اسم العلان لا يبدء برقم");
			$("#Error_advertisement_title").show();
			Error_advertisement_title=true;  
        }
        else{
                $("#Error_advertisement_title").hide();
         }
			
    }

    function ValidateFileUpload_update()
    {       
        var fuData = document.getElementById('add_advertisement_photo');
        var FileUploadPath = fuData.value;

        //To check if user upload any file
                if (FileUploadPath == '') {
                   $("#Error_advertisement_photo").html("من فضلك أختر صورة");
			       $("#Error_advertisement_photo").show();
			       Error_advertisement_photo=true;
                } else {
                    var Extension = FileUploadPath.substring(
                            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

        //The file uploaded is an image

        if ( Extension == "png" || Extension == "jpeg" || Extension == "jpg") 
        {
            $("#Error_advertisement_photo").hide();
                
        } 

        //The file upload is NOT an image
        else {
                   $("#Error_advertisement_photo").html("هذه الامتدات المسموح بها  PNG, JPG and JPEG");
			       $("#Error_advertisement_photo").show();
			       Error_advertisement_photo=true;            
                    }
                }
    }


    function add_advertisement_description()
    {
        var advertisement_desc=$("#advertisement_desc").val();

		if(advertisement_desc=='')
		{
			$("#Error_advertisement_description").html("من فضلك أضف وصفا للاعلان.");
			$("#Error_advertisement_description").show();
			Error_advertisement_description=true;
		}else{
			$("#Error_advertisement_description").hide();
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

});