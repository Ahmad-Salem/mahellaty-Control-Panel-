<?php
    session_start();
    include_once("../php_includes/connection_db.php");
    include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
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
        <link href="../css/bootstrap.css" rel="stylesheet"/>
        <!-- fontawsome  -->
        <link rel="stylesheet" href="../css/font-awesome.min.css" />
        <!-- My Css style -->
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/pop_up.css" />
        <!-- My Media style -->
        <link  rel="stylesheet" href="../css/media.css" />
        
        <!-- [if it ie 9] -->
            <script src="../javascript/html5shiv.min.js"></script>
            <script src="../javascript/respond.min.js"></script>
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
        <div class="body_content container">
            <div class="edit_user">
                <?php

                  if($_GET['u_id'])
                  { 
                    $user_id=$_GET['u_id'];
                    $query_user_info="SELECT `user_name`, `email`, `password`, `photo`, `user_type`, `status`, `gender`, `telephone1`, `telephone2`, `address` FROM `users` WHERE `id`='{$user_id}' LIMIT 1";
                    $perform_query_user_info=mysqli_query($connect,$query_user_info);
                    $row_info=mysqli_fetch_assoc($perform_query_user_info);
                  }
                  
                ?>
                <form action="edit_user_background.php" method="POST" id="edit_user_submit" enctype="multipart/form-data">
                    <h4 class="text-center">تعديل بيانات المستخدم</h4>
                        <br/>
                        <input type="text" id="edit_name" placeholder="أدخل أسم المستخدم"  value="<?php echo $row_info['user_name'];?>" name="edit_name" class="input" />
                        <br/>
                        <br/>
                        <p class="error" id="Error_Name">خطأ كبير يا نجم</p>
                        <input type="text" id="edit_email" placeholder="أدخل البريد الألكتروني" value="<?php echo $row_info['email'];?>" name="edit_email" class="input" />
                        <br/><br/>
                        <p class="error" id="Error_Email">خطأ كبير يا نجم</p>
                        <input type="text" id="edit_pass" placeholder="أدخل كلمة المرور"  value="<?php echo $row_info['password'];?>" name="edit_password" class="input" />
                        <br/><br/>
                        <p class="error" id="Error_Pass">خطأ كبير يا نجم</p>
                        
                        <br/>
                        <div class="image_user">
                          <?php
                          if($row_info['photo']=='')
                            {
                              if($row_info['gender']=="male")
                              {
                                echo "<img src=\"../images/default_images/default-person.jpg\" class=\"photo_user\" title=\"".$row_info['user_name']."\" />";
                              }else if($row_info['gender']=="female")
                              {
                                echo "<img src=\"../images/default_images/user_profile_female.jpg\" class=\"photo_user\" title=\"".$row_info['user_name']."\" />";
                              }
                            }else{
                              //link to custom image 
                              echo "<img src=\"../images/users/".$user_id."/".$row_info['photo']."\" class=\"photo_user\" title=\"".$row_info['user_name']."\" />";
                            }

                          ?>
                        </div>
                        
                        <br/>
                        <div class="upload_photo_container">
                            
                                <div class="file-input wrapper photo_btn">
                                                       
                                        <input id="update_photo" type="file" name="image_user"  class="file-input control" />
                                        <div class="file-input content">
                                            <div class="upload_image_box">
                                            <h4 class="text-center">تغير صورة للمستخدم</h4>
                                            </div> 
                                        </div>
                                 </div>
                             
                        </div>
                         <p class="waring" id="Error_photo">لم يتم تغير الصورة الشخصية</p>
                         <!-- person Gender-->
                          <div class="kind">
                              <select id="edit_user_type" name="user_type" >
                                  <option selected disabled value>الوظيفة</option>
                                  <option
                                  <?php if($row_info['user_type']=="admin"):?>
                                     selected
                                  <?php endif;?>
                                   value="admin">مسئول</option>
                                  <option
                                  <?php if($row_info['user_type']=="shopowner"):?>
                                     selected
                                  <?php endif;?>
                                   value="shopowner">صاحب محل</option>
                              </select>             
                           </div>
                           <p class="error" id="Error_user_type">خطأ كبير يا نجم</p>

                           <!-- person Gender-->
                           <div class="kind">
                              <select id="edit_status" name="status" >
                                  <option selected disabled value>الحالة</option>
                                  <option 
                                  <?php if($row_info['status']=="available"):?>
                                     selected
                                  <?php endif;?>
                                  value="available">متاح</option>
                                  <option
                                  <?php if($row_info['status']=="unavailable"):?>
                                     selected
                                  <?php endif;?>
                                   value="unavailable">غير متاح</option>
                              </select>             
                           </div> 
                           <p class="error" id="Error_status">خطأ كبير يا نجم</p>

                           <!-- person Gender-->
                           <div class="kind">
                              <select id="edit_gender" name="gender" >
                                  <option selected disabled value>النوع</option>
                                  <option
                                  <?php if($row_info['gender']=="male"):?>
                                     selected
                                  <?php endif;?> 
                                  value="male">ذكر</option>
                                  <option 
                                  <?php if($row_info['gender']=="female"):?>
                                     selected
                                  <?php endif;?>
                                  value="female">انثي</option>
                              </select>             
                           </div>
                           <p class="error" id="Error_gender">خطأ كبير يا نجم</p>

                            <input type="text" id="edit_address" placeholder="أدخل عنوانك..." value="<?php echo $row_info['address'];?>"  name="edit_adderss" class="input" />
                            <br/><br/>
                            <p class="error" id="Error_address">خطأ كبير يا نجم</p>
                            
                            <input type="text" id="edit_tele1" placeholder="أدخل رقم تليفونك رقم 1" value="<?php echo $row_info['telephone1'];?>" name="edit_tel1" class="input" />
                            <br/><br/>
                            <p class="error" id="Error_tele1">خطأ كبير يا نجم</p>

                            <input type="text" id="edit_tele2" placeholder="أدخل رقم تليفونك رقم 2"  value="<?php echo $row_info['telephone1'];?>" name="edit_tel2" class="input" />
                            <br/><br/>
                            <p class="error" id="Error_tele2">خطأ كبير يا نجم</p>
                            <input type="hidden" name="user_id" value="<?php echo $_GET['u_id'];?>"/>
                            <input type="submit" value="تعديل بيانات المستخدم"  name="login_sub" class="btn_edit_user" />
                            

                </from>
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
                <h4 class="text-center h4"><img 
                    <?php if(@$_SESSION['Success_user_check']=="true"):?>
                        src="../images/icons/accept.png"
                    <?php else:?>
                        src="../images/icons/cancel.png"
                    <?php endif;?>
                    /><b 
                    <?php if(@$_SESSION['Success_user_check']=="true"):?>
                        style="color:#080"
                    <?php else:?>
                        style="color:#ff0000"
                    <?php endif;?>
                    
                    ><?php echo @$_SESSION['message_user'];?></b> </h4>
              </div>

              <div class="modal-body mod_body cansel">
                <h4 class="text-center h5" data-dismiss="modal">إلغاء</h4>
                
              </div>

            </div>
          </div>
        </div>

        <!-- the end of pop up of logout model -->



        <!-- pop up of logout model -->
        <!-- Modal -->
        <div class="modal fade fading_opacity" id="Message_logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="modal-dialog mod_dio" role="document">

            <div class="modal-content mod_con">

              <div class="modal-body mod_body">
                <h4 class="text-center">
                    <a href="../logout/logout.php">تسجيل الخروج</a>
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
        <script src="../javascript/jquery-2.1.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../javascript/bootstrap.min.js"></script>
        <!-- My plugin js       -->
        <script src="../javascript/jquery.nicescroll.min.js"></script>
        <script src="../javascript/index.js"></script>
        <script src="../javascript/edit_user.js"></script>
        <!-- start message with error handling -->
        <?php if(@$_SESSION['Success_user_check']):?>
        <script type="text/javascript">
            $(document).ready(function(){
                 $('#Message').modal('show');
            });
        </script>
        <?php endif;?>
        <?php @$_SESSION['Success_user_check']=null;?>
        <!-- end message with error handling -->
        <!-- start logout script-->
        <script type="text/javascript">
        $(document).ready(function(){
            $("#logout").click(function(){
                $('#Message_logout').modal('show');   
            });
             
        });
       </script>
        <!-- end logout script-->
    </body>
</html>