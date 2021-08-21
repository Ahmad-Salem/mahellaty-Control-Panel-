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
                            <li><a href="manage_users.php"><i class="fa fa-bell "></i> <span>إدارة المستخدمين</span></a></li>
                            <li><a href="manage_shops.php"><i class="fa fa-bell "></i> <span>إدارة المحلات</span></a></li>
                            <li><a href="manage_main_page.php"><i class="fa fa-bell "></i> <span>إدارة الصفحة الرئيسية App</span></a></li>
                            <li><a href="manage_advertisement.php"><i class="fa fa-bell "></i> <span>إدارة الأعلانات الرئيسية</span></a></li>
                            <li><a href="manage_advertisement_paid.php"><i class="fa fa-bell "></i> <span>إدارة الأعلانات الممولة</span></a></li>
                            <li class="active"><a href="manage_contact_us.php"><i class="fa fa-bell "></i> <span>إدارة التواصل</span></a></li>
                            <li><a href="manage_places.php"><i class="fa fa-bell "></i> <span>إدارة الأماكن</span></a></li>
                            <li><a href="manage_services.php"><i class="fa fa-bell "></i> <span>إدارة الخدمات</span></a></li>
                            <li><a href="manage_orders.php"><i class="fa fa-bell "></i> <span>إدارة الطلبات</span></a></li>
                            <li><a href="manage_normal_users.php"><i class="fa fa-bell "></i> <span>إدارة المستخدمين العاديين</span></a></li>
                        </ul>
                    </div>
                    <hr/>
                </div>
                <div class="left_content">
                    
                    <h4>لوحة تحكم محلاتي<span>/&nbsp;&nbsp;إدارة المنتجات</span> </h4>
                    
                   
                      <!-- Table -->
                      <table class="table table-bordered statistic_tbl">
                          <tbody>
                              <tr class="active">
                                <td>رقم المسلسل</td>
                                <td>عنوان الرسالة</td>
                                <td>موضوع الرسالة</td>
                                <td>صاحب الرسالة</td>
                                <td>الصلاحيات</td>
                              </tr>
                              <?php
                                //query
                                $query_message_display="SELECT  `contact_us`.`id` as `con_id`, `users`.`id` as `u_id`,`msg_title`, `msg_body`, `owner_id`, `date`, `user_name` FROM `contact_us` INNER JOIN `users` ON `contact_us`.`owner_id`=`users`.`id`";
                                $perform_query_message_display=mysqli_query($connect,$query_message_display);
                                while($message_row=mysqli_fetch_assoc($perform_query_message_display))
                                {

                                    echo "<tr>";
                                    echo "<td>".$message_row['con_id']."</td>";
                                    echo "<td>".$message_row['msg_title']."</td>";
                                    echo "<td>".$message_row['msg_body']."</td>";
                                    echo "<input type='hidden' class='user_id' value='".$message_row['u_id']."'/>";
                                    echo "<td class=\"message_owner\"><a href=\"#\">".$message_row['user_name']."</a></td>";
                                    echo "<input type='hidden' class='msg_id' value='".$message_row['con_id']."'/>";
                                    echo "<td>
                                    <i class=\"fa fa-trash-o delete_msg\"></i>
                                    </td>";
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
    



        <!-- start more user details -->
        <script type="text/javascript">
            $(".message_owner").click(function(){
                var user_id=$(this).siblings(".user_id").val();     
                get_person_details(user_id);
                $('#Message_user').modal('show');   
            });
            
            
            
            function get_person_details(user_id)
            {
                // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                var user_id=user_id;
                var url = "get_information/get_more_user_details.php";
                var vars = "user_id="+user_id;

                hr.open("POST", url, true);

                // Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {

                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;

                    var jArraygetpersondetails=return_data;

                    console.log(jArraygetpersondetails);
                    if(jArraygetpersondetails!=null)
                    {
                        jArraygetpersondetails=JSON.parse(jArraygetpersondetails);  
                        console.log(jArraygetpersondetails);
                        $(".fading_opacity .mod_dio .mod_con .users .content").html('');
                        $.each( jArraygetpersondetails, function( key, value ){

                            

                            if(value.tel1=='')
                            {
                                var tele1="Null";
                            }else
                            {
                                var tele1=value.tel1;
                            }

                            if(value.tel2=='')
                            {
                                var tele2="Null";
                            }else
                            {
                                var tele2=value.tel2;
                            }


                            //person
                            $(".fading_opacity .mod_dio .mod_con .users .content").append("<h4 class=\"text-center\">تفاصيل المستخدم </h4><p><span>اسم المستخدم:</span>&nbsp;&nbsp;"+value.user_name+"</p><p><span>البريد الألكتروني:</span>&nbsp;&nbsp;"+value.email+"</p><p><span>كلمة المرور:</span>&nbsp;&nbsp;"+value.password+"</p><p><span>الصورة:</span>&nbsp;&nbsp;<img src=\""+value.photo+"\" title=\""+value.user_name+"\"/></p><p><span>الوظيفة:</span>&nbsp;&nbsp;"+value.user_type+"</p><p><span>الحالة:</span>&nbsp;&nbsp;"+value.status+"</p><p><span>النوع:</span>&nbsp;&nbsp;"+value.gender+"</p><p><span>رقم تليفون 1:</span>&nbsp;&nbsp;"+value.tel1+"</p><p><span>رقم تليفون 2:</span>&nbsp;&nbsp;"+value.tel2+"</p><p><span>العنوان :</span>&nbsp;&nbsp;"+value.address+"</p><p><span>المحلات التابعة للمستخدم:</span>&nbsp;&nbsp;");
                            $(".fading_opacity .mod_dio .mod_con .users .content").append(value.shop_name+"</p>");


                        });

                    }else{
                        $(".fading_opacity .mod_dio .mod_con .users .content").html('<h3 style=\'color:#ff0000;\'>Something Going Wrong ....</h3>');
                    }



                }else{
                    //alert("i'm working");
                }
                }
                // Send the data to PHP now... and wait for response to update the status div
                hr.send(vars); // Actually execute the request

            }

        </script>
        <!-- end more user details -->

        <!-- start delete message -->
        <script type="text/javascript">
            $('.delete_msg').click(function(){
                $(this).parent().parent().hide();
               
                var msg_id = $(this).parent().siblings('.msg_id').val();
                var user_id = $(this).parent().siblings('.user_id').val();
                
                if(confirm("هل أنت متاكد ؟")==true)
                {
                    // alert("oki");
                    delete_message(msg_id,user_id);
                }else
                {
                    alert("لم يتم حذف المستخدم.");
                }
                
            });

            function delete_message(msg_id,user_id)
            {

                // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file
                var shop_id=shop_id;
                var url = "manage_contact_us/delete_message.php";
                var vars = "msg_id="+msg_id+"&user_id="+user_id;

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

        </script>
        <!-- end delete message -->

    </body>
</html>