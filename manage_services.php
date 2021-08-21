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
                            <li ><a href="manage_users.php"><i class="fa fa-bell "></i> <span>إدارة المستخدمين</span></a></li>
                            <li><a href="manage_shops.php"><i class="fa fa-bell "></i> <span>إدارة المحلات</span></a></li>
                            <li><a href="manage_main_page.php"><i class="fa fa-bell "></i> <span>إدارة الصفحة الرئيسية App</span></a></li>
                            <li><a href="manage_advertisement.php"><i class="fa fa-bell "></i> <span>إدارة الأعلانات الرئيسية</span></a></li>
                            <li><a href="manage_advertisement_paid.php"><i class="fa fa-bell "></i> <span>إدارة الأعلانات الممولة</span></a></li>
                            <li><a href="manage_contact_us.php"><i class="fa fa-bell "></i> <span>إدارة التواصل</span></a></li>
                            <li><a href="manage_places.php"><i class="fa fa-bell "></i> <span>إدارة الأماكن</span></a></li>
                         	<li class="active"><a href="manage_services.php"><i class="fa fa-bell "></i> <span>إدارة الخدمات</span></a></li>
                          <li><a href="manage_orders.php"><i class="fa fa-bell "></i> <span>إدارة الطلبات</span></a></li>
                            <li><a href="manage_normal_users.php"><i class="fa fa-bell "></i> <span>إدارة المستخدمين العاديين</span></a></li>
                        </ul>
                    </div>
                    <hr/>
                </div>
                <div class="left_content">
                    
                    <h4>لوحة تحكم محلاتي<span>/&nbsp;&nbsp;إدارة المستخدمين</span> </h4>
                    
                   
                    
                      <!-- Table -->
                      <table class="table table-bordered statistic_tbl" id="statistic_tbl_user">
                          <tbody>
                              <tr class="active">
                                <td>رقم المسلسل</td>
                                <td>إسم الخدمة</td>
                                <td>حالة  الخدمة</td>
                                
                              </tr>
                              <?php 
                                $query_services="SELECT `id`, `service_name`, `service_status` FROM `services`";
                                $perform_query_services=mysqli_query($connect,$query_services);
                                while($services_row=mysqli_fetch_assoc($perform_query_services))
                                {
                                    
                                    echo "<tr>";
                                    
                                    echo "<td>".$services_row['id']."</td>";
                                    
                                    echo "<td>".$services_row['service_name']."</td>";
                                    
                                    if($services_row['service_status']=="1")
                                      {
                                        echo "<td><input type=\"checkbox\" class=\"active\"  checked /><input type=\"hidden\" value=\"".$services_row['id']."\" class=\"service_no\"/></td>";  
                                      }else
                                      {
                                        echo "<td><input type=\"checkbox\"  class=\"active\" /><input type=\"hidden\" value=\"".$services_row['id']."\" class=\"service_no\"/></td>";
                                      }

                                    
                                    
                                    

                                    
                                    echo "</tr>";
                                }
                              ?>        
                             
                              
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
        
        <!-- pop up of more user details model -->
        <!-- Modal -->
        <div class="modal fade fading_opacity" id="Message_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="modal-dialog mod_dio" role="document">

            <div class="modal-content mod_con">

              <div class="modal-body mod_body users">
                  <div class="content">
                      
                      <h4 class="text-center">تفاصيل المستخدم </h4>
                      <p><span>اسم المستخدم:</span>&nbsp;&nbsp;</p>
                      <p><span>البريد الألكتروني:</span>&nbsp;&nbsp;</p>
                      <p><span>كلمة المرور:</span>&nbsp;&nbsp;</p>
                      <p><span>الصورة:</span>&nbsp;&nbsp;</p>
                      <p><span>الوظيفة:</span>&nbsp;&nbsp;</p>
                      <p><span>الحالة:</span>&nbsp;&nbsp;</p>
                      <p><span>النوع:</span>&nbsp;&nbsp;</p>
                      <p><span>المحلات التابعة للمستخدم:</span>&nbsp;&nbsp;</p>

                  </div>
                  
              </div>

              <div class="modal-body mod_body cansel">
                <h4 class="text-center h5" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;&nbsp;إلغاء</h4>

              </div>

            </div>
          </div>
        </div>

        <!-- the end of pop up of more user details model -->
        
        
                
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
        
       
       

        <!-- active account --->
        <script type="text/javascript">
            $('.active').change(function() {
                    // this will contain a reference to the checkbox   
                    var row_id=$(this).siblings('.service_no').val();
                    // alert(row_id+"");            
                      if (this.checked) {
                    // the checkbox is now checked
                    if(confirm("هل انت متاكد من تفعيل هذا الخدمة")==true)
                          {
                            
                            

                             active_service(row_id); 

                          }else
                          {
                  alert("لم يتم تفعيل الخدمة.");                        
                          }
                    
                }else
                {
                  deactive_service(row_id);
                }
            });


            function active_service(row_id)
            {
              
              // Create our XMLHttpRequest object
                      var hr = new XMLHttpRequest();
                      // Create some variables we need to send to our PHP file    
                      var row_id=row_id;
                      var url = "manage_services_setting/active_service.php";
                      var vars = "service_id="+row_id;

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

            function deactive_service(row_id)
            {
              
              // Create our XMLHttpRequest object
                      var hr = new XMLHttpRequest();
                      // Create some variables we need to send to our PHP file    
                      var row_id=row_id;
                      var url = "manage_services_setting/deactive_service.php";
                      var vars = "service_id="+row_id;

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

    </body>
</html>