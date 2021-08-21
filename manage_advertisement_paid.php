<?php
    session_start();
    include_once("php_includes/connection_db.php");
    include_once("php_includes/funtions.php");
    check_login("login/login.php","يجب أن تسجل الدخول أولا");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--IE compatibility Meta -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- first mobile meta --> 
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>محلاتي</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <!-- fontawsome  -->
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <!-- My Css style -->
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/pop_up.css" />
        <!-- My Media style -->
        <link  rel="stylesheet" href="css/media.css" />
        
        <!-- [if it ie 9] -->
            <script src="javascript/html5shiv.min.js"></script>
            <script src="javascript/respond.min.js"></script>
        <!-- [end if] -->
        
    </head>
    <body>
        <!-- start section header -->
        <div class="header">
            <div class="container">
                <div class="logo">
                    <i class="fa fa-shopping-basket fa-x3"></i>
                    <span>محلاتي</span>
                </div>
                <div class="settings">
                    <a href="#"><i class="fa fa-bell fa-lg"></i></a>
                    <a href="manage_advertisement_paid/add_advertisement.php"><i class="fa fa-plus fa-lg"></i></a>
                    <a href="#" id="logout">...</a>
                </div>
            </div>
        </div>
        <!-- end section header -->
        <!-- start section body -->
        <div class="clear"></div>
        <div class="body_content">
            
                <div class="right_list">
                    <div class="person_information">
                        <?php 
                        
                            $user_id=$_SESSION['user_id'];
                            $query_name_photo="SELECT `user_name`,`gender`,`photo` FROM `users` WHERE `id`='{$user_id}'";
                            $query_name_photo_perform=mysqli_query($connect,$query_name_photo);
                            $name_photo_row=mysqli_fetch_assoc($query_name_photo_perform); 
                            $user_name=$name_photo_row['user_name'];
                            $user_gender=$name_photo_row['gender'];
                            $user_photo=$name_photo_row['photo'];
                            
                            if($user_photo==null)
                            {
                                //default photo
                                if($user_gender=="male")
                                {
                                    echo "<img src=\"images/default_images/default-person.jpg\" title=\"عبدالله حسن\" />";            
                                }else if($user_gender=="female")
                                {
                                    echo "<img src=\"images/default_images/user_profile_female.jpg\" title=\"عبدالله حسن\" />";
                                }
                            }else
                            {
                                //link to custimized image
                                 echo "<img src=\"images/users/{$user_id}/{$user_photo}\" title=\"عبدالله حسن\" />";
                            }
                            
                            echo "<h4 class=\"text-center\">{$user_name}</h4>";
                        ?>
                    </div>
                    <hr/>
                    <div class="panel_links">
                        <ul class="list-unstyled ">
                            <li><a href="index.php"><i class="fa fa-bell "></i> <span>لوحة تحكم محلاتي</span></a></li>
                            <li><a href="manage_users.php"><i class="fa fa-bell "></i> <span>إدارة المستخدمين</span></a></li>
                            <li><a href="manage_shops.php"><i class="fa fa-bell "></i> <span>إدارة المحلات</span></a></li>
                            <li><a href="manage_main_page.php"><i class="fa fa-bell "></i> <span>إدارة الصفحة الرئيسية App</span></a></li>
                            <li><a href="manage_advertisement.php"><i class="fa fa-bell "></i> <span>إدارة الأعلانات الرئيسية</span></a></li>
                            <li class="active"><a href="manage_advertisement_paid.php"><i class="fa fa-bell "></i> <span>إدارة الأعلانات الممولة</span></a></li>
                            <li><a href="manage_contact_us.php"><i class="fa fa-bell "></i> <span>إدارة التواصل</span></a></li>
                            <li><a href="manage_places.php"><i class="fa fa-bell "></i> <span>إدارة الأماكن</span></a></li>
                            <li><a href="manage_services.php"><i class="fa fa-bell "></i> <span>إدارة الخدمات</span></a></li>
                            <li><a href="manage_orders.php"><i class="fa fa-bell "></i> <span>إدارة الطلبات</span></a></li>
                            <li><a href="manage_normal_users.php"><i class="fa fa-bell "></i> <span>إدارة المستخدمين العاديين</span></a></li>
                        </ul>
                    </div>
                    <hr/>
                </div>
                <div class="left_content">
                    
                    <h4>لوحة تحكم محلاتي<span>/&nbsp;&nbsp;إدارة الأعلانات</span> </h4>
                    
                      <div class="box">
                         
                         <!-- <div class="filter">
                             <input type="text" id="search_advertisement" name="search_shop" placeholder="أبحث باسم الأعلان ...">
                         </div>  --> 
                     </div>  
                      <!-- Table -->
                      <table class="table table-bordered statistic_tbl" id="statistic_tbl_advertisement">
                          <tbody>
                              <tr class="active">
                                <td>رقم المسلسل</td>
                                <td>صورة الأعلان</td>
                                <td>تاريخ بدء الاعلان</td>
                                <td>تاريخ انتهاء الاعلان</td>
                                <td>مدة الاعلان</td>
                                <td>المحافظة و المدينة</td>
                                <td>تكلفة الاعلان</td>
                                <td>تفعيل</td>
                                <td>الصلاحيات</td>
                              </tr>
                              <?php
                              $query_display_advertisement="SELECT `id`, `advertise_photo`, `gov`, `city`, `cost`, `from_date`, `to_date`, `activated` FROM `advertisement_paid` LIMIT 5";
                              $perform_query_display_advertisement=mysqli_query($connect,$query_display_advertisement);
                              while($advertisement_row=mysqli_fetch_assoc($perform_query_display_advertisement))
                              {
                                echo "<tr>";
                                echo "<td>".$advertisement_row['id']."</td>";  
                                echo "<td><img src=\"images/advertisement_paid/".$advertisement_row['id']."/".$advertisement_row['advertise_photo']."\" /></td>";
                                echo "<td>".$advertisement_row['from_date']."</td>";
                                echo "<td>".$advertisement_row['to_date']."</td>";
                                $datetime1 = new DateTime($advertisement_row['from_date']);
								$datetime2 = new DateTime($advertisement_row['to_date']);
								$interval=date_diff($datetime1,$datetime2);
								$days=$interval->format('%a');
                                echo "<td>".$days."يوم</td>";
                                echo "<td>".$advertisement_row['gov']." , ".$advertisement_row['city']."</td>";
                                echo "<td>".$advertisement_row['cost']."</td>";
                                if($advertisement_row['activated']=="1")
                                {
                                	echo "<td><input type=\"checkbox\" class=\"active\"  checked /><input type=\"hidden\" value=\"".$advertisement_row['id']."\" class=\"ad_no\"/></td>";	
                                }else
                                {
                                	echo "<td><input type=\"checkbox\"  class=\"active\" /><input type=\"hidden\" value=\"".$advertisement_row['id']."\" class=\"ad_no\"/></td>";
                                }
                                
                                echo "<td>";
                                echo "<a href=\"manage_advertisement_paid/edit_advertisement.php?ad_id=".$advertisement_row['id']."\">";
                                echo "<i class=\"fa fa-edit\"></i>";
                                echo "</a>";
                                echo "&nbsp;&nbsp;";
                                echo "<i class=\"fa fa-trash-o delete_advertisement\"></i>";
                                echo "</td>";
                                echo "<input type=\"hidden\" class=\"advetisement_no\" value=\"".$advertisement_row['id']."\"/> ";
                                echo "</tr>";  
                              }
                              ?>
                              <!-- start row1-->
                              
                              <!-- end row1-->
                              
                          </tbody>
                          
                      </table>
                   

                </div>
            
        </div>
        <!-- end section body -->
        <div class="clear"></div>
        <!-- start section footer -->
        <div class="footer">
            <h4 class="text-center">جميع الحقوق محفوظة 2017 &copy;</h4>
        </div>
        <!-- end section footer -->
        
        <!-- pop up of logout model -->
        <!-- Modal -->
        <div class="modal fade fading_opacity" id="Message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="modal-dialog mod_dio" role="document">

            <div class="modal-content mod_con">

              <div class="modal-body mod_body">
                <h4 class="text-center">
                    <a href="logout/logout.php">تسجيل الخروج</a>
                    <i class="fa fa-exit"></i>
                </h4> 

              </div>

              <div class="modal-body mod_body cansel">
                <h4 class="text-center h5" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;&nbsp;إلغاء</h4>

              </div>

            </div>
          </div>
        </div>

        <!-- the end of pop up of logout model -->

        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="javascript/jquery-2.1.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="javascript/bootstrap.min.js"></script>
        <!-- My plugin js       -->
        <script src="javascript/jquery.nicescroll.min.js"></script>
        <script src="javascript/index.js"></script>
        <!-- start logout script-->
        <script type="text/javascript">
		$(document).ready(function(){
            $("#logout").click(function(){
                $('#Message').modal('show');   
            });
        	 
		});
	   </script>
        <!-- end logout script-->

        <script type="text/javascript">
        	
        	$('.active').change(function() {
			    // this will contain a reference to the checkbox   
			     var row_id=$(this).siblings('.ad_no').val();
                   
                if (this.checked) {
			        // the checkbox is now checked
			        if(confirm("هل انت متاكد من تفعيل هذا الاعلان؟")==true)
                    {
                       
                       

                    	active_advertisement(row_id); 

                    }else
                    {
						alert("لم يتم تفعيل الاعلان.");                        
                    }
			        
			    }else
			    {
			    	deactive_advertisement(row_id);
			    }
			});

			function active_advertisement(row_id)
			{
				
				// Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                var row_id=row_id;
                var url = "manage_advertisement_paid/active_paid_advertisement.php";
                var vars = "ad_id="+row_id;

                hr.open("POST", url, true);
            
                // Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                
                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {
                
                if(hr.readyState == 4 && hr.status == 200) {
                    	var return_data = hr.responseText;
                    
                		
                    	alert(return_data);

                	}


            	};

            	 hr.send(vars); // Actually execute the request
                
			}

			function deactive_advertisement(row_id)
			{
				
				// Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                var row_id=row_id;
                var url = "manage_advertisement_paid/deactive_paid_advertisement.php";
                var vars = "ad_id="+row_id;

                hr.open("POST", url, true);
            
                // Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                
                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {
                
                if(hr.readyState == 4 && hr.status == 200) {
                    	var return_data = hr.responseText;
                    
                		
                    	alert(return_data);

                	}


            	};

            	 hr.send(vars); // Actually execute the request
                
			}
        </script>


        <!-- start search section -->
        <script type="text/javascript">
        
        function get_advertisement_search(search)
            {
                
                // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                var search=search;
                var url = "get_information/get_advertisement_search.php";
                var vars = "search="+search;

                hr.open("POST", url, true);
            
                // Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                
                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {
                
                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    
                    var jArraygetpersondetails_search=return_data;

                    // console.log(jArraygetpersondetails_search);
                    if(jArraygetpersondetails_search!=null)
                    {
                        jArraygetpersondetails_search=JSON.parse(jArraygetpersondetails_search);    
                        
                        $("#statistic_tbl_advertisement").html('');
                        $("#statistic_tbl_advertisement").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>عنوان الأعلان</td><td>صورة الأعلان</td><td>وصف الأعلان</td><td>المحافظة</td><td>الصلاجيات</td></tr>");

                        var stringHtml="";
                        $.each( jArraygetpersondetails_search, function( key, value ){

                            stringHtml+="<tr>";
                            stringHtml+="<td>"+value.advertisement_id+"</td>";  
                            stringHtml+="<td>"+value.advertisement_title+"</td>";
                            stringHtml+="<td><img src=\"images/advertisement/"+value.advertisement_id+"/"+value.advertisement_photo+"\" title=\""+value.advertisement_title+"\"/></td>";
                            stringHtml+="<td>"+value.advertisement_description+"</td>";
                            stringHtml+="<td>"+value.advertisement_government+"</td>";
                            stringHtml+="<td>";
                            stringHtml+="<a href=\"manage_advertisement/edit_advertisement.php?ad_id="+value.advertisement_id+"\">";
                            stringHtml+="<i class=\"fa fa-edit\"></i>";
                            stringHtml+="</a>";
                            stringHtml+="&nbsp;&nbsp;";
                            stringHtml+="<i class=\"fa fa-trash-o delete_advertisement\"></i>";
                            stringHtml+="</td>";
                            stringHtml+"<input type=\"hidden\" class=\"advetisement_no\" value=\""+value.advertisement_id+"\"/> ";
                            stringHtml+="</tr>";
                            
                        

                        });

                        $("#statistic_tbl_advertisement").append(stringHtml+"</tbody>");

                        

                        //for delete advertisement
                        $('.delete_advertisement').click(function(){
                    

                                var advetisement_no=$(this).parent().siblings('.advetisement_no').val();
                                
                                
                                
                                
                                if(confirm("هل أنت متاكد ؟")==true)
                                {
                                    $(this).parent().parent().hide();
                                    // nice scroll 

                                    //delete this product
                                    delete_advertisement(advetisement_no);

                                }else
                                {
                                    alert("لم يتم حذف الاعلان.");
                                }
                                
                            });
                        
                                   
                    }else{
                            $("#statistic_tbl_advertisement").html("<td colspan='5'><h4 class='text-center' style='color:#ff0000'>حدث خطا أثناء عملية البحث</h4></td>");
                    }



                }else{
                    $("#statistic_tbl_advertisement").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>عنوان الأعلان</td><td>صورة الأعلان</td><td>وصف الأعلان</td><td>الصلاجيات</td></tr>");
                    $("#statistic_tbl_advertisement").append("<tr><td colspan='5'><h4 class='text-center'>لا توجد إعلانات بهذا الأسم</h4></td></tr></tbody>");
                }

                }
                // Send the data to PHP now... and wait for response to update the status div
                hr.send(vars); // Actually execute the request

            }       



            $("#search_advertisement").on("keyup",function(){
                var search=$(this).val();
                // alert(search);
                get_advertisement_search(search);
            });

        </script>
        <!-- end search section -->

        <!--deleting advertisement -->
        <script type="text/javascript">

            function delete_advertisement(advetisement_no)
            {

                // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file
                var advetisement_no=advetisement_no;
                var url = "manage_advertisement_paid/delete_advertisement.php";
                var vars = "advetisement_no="+advetisement_no;

                hr.open("POST", url, true);
            
                // Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                
                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {
                
                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    alert(return_data);  
                    
                }else
                {
                    // alert("i'm not work");
                }
                 };
                // Send the data to PHP now... and wait for response to update the status div
                hr.send(vars); // Actually execute the request

            
            }



            $('.delete_advertisement').click(function(){
                    

                    var advetisement_no=$(this).parent().siblings('.advetisement_no').val();
                    
                    
                    
                    
                    if(confirm("هل أنت متاكد ؟")==true)
                    {
                        $(this).parent().parent().hide();
                        // nice scroll 
                        
                        // alert(advetisement_no);
                        //delete this product
                        delete_advertisement(advetisement_no);

                    }else
                    {
                        alert("لم يتم حذف الاعلان.");
                    }
                    
                });
        </script>
        <!--end deleting advertisement -->
    </body>
</html>