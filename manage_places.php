<?php
    session_start();
    include_once("php_includes/connection_db.php");
    include_once("php_includes/funtions.php");
    check_login("login/login.php","يجب أن تسجل الدخول أولا");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- for arabic language -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                            <li><a href="manage_contact_us.php"><i class="fa fa-bell "></i> <span>إدارة التواصل</span></a></li>
                            <li class="active"><a href="manage_places.php"><i class="fa fa-bell "></i> <span>إدارة الأماكن</span></a></li>
                            <li><a href="manage_services.php"><i class="fa fa-bell "></i> <span>إدارة الخدمات</span></a></li>
                            <li><a href="manage_orders.php"><i class="fa fa-bell "></i> <span>إدارة الطلبات</span></a></li>
                            <li><a href="manage_normal_users.php"><i class="fa fa-bell "></i> <span>إدارة المستخدمين العاديين</span></a></li>
                        </ul>
                    </div>
                    <hr/>
                </div>
                 
                <!-- start section statistics -->
                <div class="left_content">
                    
                    <h4>لوحة تحكم محلاتي<span>/&nbsp;&nbsp;إدارة الأماكن</span> </h4>
                        
                       
                   
                      <!-- Table -->
                      <table class="table table-bordered statistic_tbl" id="statistic_tbl_shop">
                          <tbody>
                              <tr class="active">
                                <td>رقم المسلسل</td>
                                <td>المحافظة</td>
                                <td>التفعيل</td>  
                                <td>المدينة</td>
                                <td>التفعيل</td>
                              </tr>
                              <?php
                                $query_get_gov="SELECT `id`, `gov_name`, `activation` FROM `government`";
                                $perform_query_get_gov=mysqli_query($connect,$query_get_gov);
                                while($gov_row=mysqli_fetch_assoc($perform_query_get_gov))
                                {

                                    echo "<tr>";
                                    echo "<td>".$gov_row['id']."</td>";
                                    echo "<td>".$gov_row['gov_name']."</td>";

                                    echo "<input type='hidden' class='gov_no' value='".$gov_row['id']."'/>";
                                    

                                    if($gov_row['activation']=="1")
                                      {
                                        echo "<td><input type=\"checkbox\" class=\"active\"  checked /><input type=\"hidden\" value=\"".$gov_row['id']."\" class=\"city_no\"/></td>";  
                                      }else
                                      {
                                        echo "<td><input type=\"checkbox\"  class=\"active\" /><input type=\"hidden\" value=\"".$gov_row['id']."\" class=\"city_no\"/></td>";
                                      }



                                    // echo "<td>".$gov_row['activation']."</td>"; 
                                    echo "<td colspan=\"2\">";
                                    


                                    $query_get_city="SELECT `id` as `c_id`, `city_name`, `activation` FROM `cities` WHERE `gov_id`='".$gov_row['id']."'";
                                    $perform_query_get_city=mysqli_query($connect,$query_get_city);
                                    while($city_row=mysqli_fetch_assoc($perform_query_get_city))
                                    {

                                         echo "<table class=\"table table-bordered statistic_tbl\">";
                                         echo "<tr>";
                                         echo "<td>".$city_row['city_name']."</td>";
                                         echo "</tr>";
                                         echo "<tr>";

                                         echo "<input type='hidden' class='city_no' value='".$city_row['c_id']."'/>";
                                    
                                         if($gov_row['activation']=='0')
                                         {
                                            //disable checkboxes
                                            if($city_row['activation']=="1")
                                              {
                                                echo "<td><input type=\"checkbox\" disabled  class=\"active\"  checked /><input type=\"hidden\" value=\"".$city_row['c_id']."\" class=\"city_no_disabled\"/></td>";  
                                              }else
                                              {
                                                echo "<td><input type=\"checkbox\"  disabled class=\"active\" /><input type=\"hidden\" value=\"".$city_row['c_id']."\" class=\"city_no_disabled\"/></td>";
                                              }
                                         }else
                                         {
                                            //enable checkboxes
                                            if($city_row['activation']=="1")
                                              {
                                                echo "<td><input type=\"checkbox\"   class=\"active_city\"  checked /><input type=\"hidden\" value=\"".$city_row['c_id']."\" class=\"city_no\"/></td>";  
                                              }else
                                              {
                                                echo "<td><input type=\"checkbox\"   class=\"active_city\" /><input type=\"hidden\" value=\"".$city_row['c_id']."\" class=\"city_no\"/></td>";
                                              }

                                         }
                                        
                                         // echo "<td>".$city_row['activation']."</td>";
                                         

                                         echo "</tr>";
                                         echo "</table>";
                                                
                                                
                                            
                                    }

                                    echo "</td>";
                                    echo "</tr>";
                                }
                              ?>
                              
                             
                          </tbody>
                          
                      </table>
                   

                </div>
            <!-- end section statistics -->
             
            
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


        <!-- start active gov --->
        <script type="text/javascript">
            $('.active').change(function() {
                    // this will contain a reference to the checkbox   
                    var row_id=$(this).parent().siblings('.gov_no').val();
                    // alert(row_id+"");            
                      if (this.checked) {
                    // the checkbox is now checked
                    if(confirm("هل انت متاكد من تفعيل هذه المحافظة ؟")==true)
                          {
                            
                            

                             active_gov(row_id); 

                          }else
                          {
                  alert("لم يتم تفعيل المحافظة.");                        
                          }
                    
                }else
                {
                  deactive_gov(row_id);
                }
            });


            function active_gov(row_id)
            {
              
              // Create our XMLHttpRequest object
                  var hr = new XMLHttpRequest();
                  // Create some variables we need to send to our PHP file    
                  var row_id=row_id;
                  var url = "manage_places/active_gov.php";
                  var vars = "gov_id="+row_id;

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

            function deactive_gov(row_id)
            {
              
              // Create our XMLHttpRequest object
                  var hr = new XMLHttpRequest();
                  // Create some variables we need to send to our PHP file    
                  var row_id=row_id;
                  var url = "manage_places/deactive_gov.php";
                  var vars = "gov_id="+row_id;

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
        <!-- end active gov --->
        <!-- start active cities --->
        <script type="text/javascript">
            $('.active_city').change(function() {
                    // this will contain a reference to the checkbox   
                    var row_id=$(this).parent().siblings('.city_no').val();
                    // alert(row_id+"");            
                      if (this.checked) {
                    // the checkbox is now checked
                    if(confirm("هل انت متاكد من تفعيل هذه المدينة ؟")==true)
                          {
                            
                            

                             active_city(row_id); 

                          }else
                          {
                  alert("لم يتم تفعيل المدينه.");                        
                          }
                    
                }else
                {
                  deactive_city(row_id);
                }
            });


            function active_city(row_id)
            {
              
              // Create our XMLHttpRequest object
                  var hr = new XMLHttpRequest();
                  // Create some variables we need to send to our PHP file    
                  var row_id=row_id;
                  var url = "manage_places/active_city.php";
                  var vars = "city_id="+row_id;

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

            function deactive_city(row_id)
            {
              
              // Create our XMLHttpRequest object
                  var hr = new XMLHttpRequest();
                  // Create some variables we need to send to our PHP file    
                  var row_id=row_id;
                  var url = "manage_places/deactive_city.php";
                  var vars = "city_id="+row_id;

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
        <!-- end active cities --->

    </body>
</html>