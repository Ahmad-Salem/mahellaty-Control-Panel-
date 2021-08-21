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
                            <li class="active"><a href="index.php"><i class="fa fa-bell "></i> <span>لوحة تحكم محلاتي</span></a></li>
                            <li><a href="manage_users.php"><i class="fa fa-bell "></i> <span>إدارة المستخدمين</span></a></li>
                            <li><a href="manage_shops.php"><i class="fa fa-bell "></i> <span>إدارة المحلات</span></a></li>
                            <li><a href="manage_main_page.php"><i class="fa fa-bell "></i> <span>إدارة الصفحة الرئيسية App</span></a></li>
                            <li><a href="manage_advertisement.php"><i class="fa fa-bell "></i> <span>إدارة الأعلانات الرئيسية</span></a></li>
                            <li><a href="manage_advertisement_paid.php"><i class="fa fa-bell "></i> <span>إدارة الأعلانات الممولة</span></a></li>
                            <li><a href="manage_contact_us.php"><i class="fa fa-bell "></i> <span>إدارة التواصل</span></a></li>
                            <li><a href="manage_places.php"><i class="fa fa-bell "></i> <span>إدارة الأماكن</span></a></li>
                            <li><a href="manage_services.php"><i class="fa fa-bell "></i> <span>إدارة الخدمات</span></a></li>
                            <li><a href="manage_orders.php"><i class="fa fa-bell "></i> <span>إدارة الطلبات</span></a></li>
                            <li><a href="manage_normal_users.php"><i class="fa fa-bell "></i> <span>إدارة المستخدمين العاديين</span></a></li>
                        </ul>
                    </div>
                    <hr/>
                </div>
                 
                <!-- start section statistics -->
                <section class="statistics text-center">
                    <div class="data">
                        <div class="container">
                            <h2 class="h1 wow fadeInDown" data-wow-duration="2s" data-wow-offset="200">الأحصائيات الرئيسية لدينا</h2>
                            <div class="row">
                                <div class="col-md-4 col-sm-3">
                                    <div class="stats wow fadeInLeft" data-wow-duration="2s" data-wow-offset="200">
                                        <i class="fa fa-users fa-5x"></i>
                                        <p>
                                          <?php
                                          $query_users_count="SELECT `id` FROM `users`";
                                          $query_user_count_perform=mysqli_query($connect,$query_users_count);
                                          $user_number=mysqli_num_rows($query_user_count_perform);
                                          echo "{$user_number}";
                                          ?>
                                        </p>
                                        <span>عدد المستخدمين</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-3">
                                    <div class="stats wow fadeInLeft" data-wow-duration="2s" data-wow-offset="200">
                                        <i class="fa fa-users fa-5x"></i>
                                        <p>
                                          <?php
                                          $query_offers_count="SELECT `id` FROM `offers`";
                                          $query_offers_count_perform=mysqli_query($connect,$query_offers_count);
                                          $offers_number=mysqli_num_rows($query_offers_count_perform);
                                          echo "{$offers_number}";
                                          ?>
                                        </p>
                                        <span>عدد العروض</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-3">
                                    <div class="stats wow fadeInUp" data-wow-duration="2s" data-wow-offset="200">
                                        <i class="fa fa-comments fa-5x"></i>
                                        <p>
                                          <?php
                                          $query_shops_count="SELECT `id` FROM `shop`";
                                          $query_shops_count_perform=mysqli_query($connect,$query_shops_count);
                                          $shops_number=mysqli_num_rows($query_shops_count_perform);
                                          echo "{$shops_number}";
                                          ?>
                                        </p>
                                        <span>عدد المحلات</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-3">
                                    <div class="stats wow fadeInUp" data-wow-duration="2s" data-wow-offset="200">
                                        <i class="fa fa-suitcase fa-5x"></i>
                                        <p>
                                          <?php
                                          $query_product_count="SELECT `id` FROM `products`";
                                          $query_product_count_perform=mysqli_query($connect,$query_product_count);
                                          $product_number=mysqli_num_rows($query_product_count_perform);
                                          echo "{$product_number}";
                                          ?>
                                        </p>
                                        <span>عدد المنتجات</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-3">
                                    <div class="stats wow fadeInRight" data-wow-duration="2s" data-wow-offset="200">
                                        <i class="fa fa-support fa-5x"></i>
                                        <p>
                                          <?php
                                          $query_advertisement_count="SELECT `id` FROM `advertisement`";
                                          $query_advertisement_count_perform=mysqli_query($connect,$query_advertisement_count);
                                          $advertisement_number=mysqli_num_rows($query_advertisement_count_perform);
                                          echo "{$advertisement_number}";
                                          ?>
                                        </p>
                                        <span>عدد الاعلانات</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-3">
                                    <div class="stats wow fadeInRight" data-wow-duration="2s" data-wow-offset="200">
                                        <i class="fa fa-envelope fa-5x"></i>
                                        <p>
                                          <?php
                                          $query_msg_count="SELECT `id` FROM `advertisement`";
                                          $query_msg_count_perform=mysqli_query($connect,$query_msg_count);
                                          $msg_number=mysqli_num_rows($query_msg_count_perform);
                                          echo "{$msg_number}";
                                          ?>
                                        </p>
                                        <span>عدد الرسائل</span>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </section>
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
    </body>
</html>