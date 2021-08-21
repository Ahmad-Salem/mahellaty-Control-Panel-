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
        <script src="../javascript/jquery-2.1.1.min.js"></script>  
        <link rel="stylesheet" href="../css/bootstrap.css" />  
        <script src="../javascript/jquery_ui.js"></script> 
        <link rel="stylesheet" href="../css/jquery_ui.css">
        
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
        
        <!-- datepicker script -->
        <script>  
        
          $(document).ready(function(){  
             $.datepicker.setDefaults({  
                  dateFormat: 'yy-mm-dd'   
             });  
             $(function(){  
                  $("#add_advertisement_duration_from").datepicker();
                  $("#add_advertisement_duration_to").datepicker();   
             });

          });
        </script>
        <!-- datepicker script -->




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
        
            <div class="add_user add_shop">
                
                <?php
                    //query
                    $shop_id=$_GET['sid'];
                    $offer_id=$_GET['o_id'];
                    $user_id=$_GET['u_id'];
                    $query_display_offer="SELECT  `id`,`offer_name`, `offer_description`, `offer_photo`, `shop_id`,`main_page`,`from_date`,`to_date` FROM `offers` WHERE `shop_id`='{$shop_id}' AND `id`='{$offer_id}' LIMIT 1";
                    // echo $query_display_offer;
                    $perform_query_display_offer=mysqli_query($connect,$query_display_offer);
                    $offer_row=mysqli_fetch_assoc($perform_query_display_offer);
                ?>
                <form action="edit_offer_background.php" method="POST" id="add_offer_submit" enctype="multipart/form-data">
                    <h4 class="text-center">تعديل بيانات العرض</h4>
                        
                        <br/>
                        <input type="text" id="add_advertisement_duration_from" value="<?php echo $offer_row['from_date'];?>"  placeholder="تاريخ بداية العرض "  name="add_advertisement_duration_from" class="from_date input form-control" />
                        <br/><br/>
                        <p class="error" id="Error_advertisement_duration_from">خطأ كبير يا نجم</p>
                        
                        <br/>
                        <br/>
                        <input type="text" id="add_advertisement_duration_to" value="<?php echo $offer_row['to_date'];?>"  placeholder="تاريخ انتهاء العرض"  name="add_advertisement_duration_to" class="from_date input form-control" />
                        <br/><br/>
                        <p class="error" id="Error_advertisement_duration_to">خطأ كبير يا نجم</p>
                        
                        <br/>

                        <br/>
                        <!-- country type-->
                          <div class="kind">
                              <select id="add_offer_kind" name="offer_kind" >
                                  <option selected disabled value>نوع العرض </option>
                                  <option value="1" <?php if($offer_row['main_page']=="1"){echo "selected";}?>>عرض علي الصفحة الرئيسيه</option>
                                  <option value="0" <?php if($offer_row['main_page']=="0"){echo "selected";}?>>عرض عادي</option>
                              </select>             
                           </div>
                           <p class="error" id="Error_offer_kind">خطأ كبير يا نجم</p>

                        <br/>


                        <br/>
                        <input type="text" id="edit_offer" value="<?php echo $offer_row['offer_name'];?>" placeholder="أدخل اسم العرض"  name="edit_offer_name" class="input" />
                        <br/><br/>
                        <p class="error" id="Error_offer_name">خطأ كبير يا نجم</p>
                        
                        <div class="upload_photo_container">
                            
                        <div class="file-input wrapper photo_btn">
                                               
                                <input id="add_offer_photo" type="file" name="edit_offer_photo"  class="file-input control" />
                                <div class="file-input content">
                                    <div class="upload_image_box">
                                    <h4 class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;تحميل صورة العرض</h4>
                                    </div> 
                                </div>
                         </div>
                     
                        </div>
                         <p class="warn" id="Error_offer_photo">خطأ كبير يا نجم</p>
                         <img src="<?php echo "../images/users/{$user_id}/{$shop_id}/offers/".$offer_row['id']."/".$offer_row['offer_photo']."";?>" class="preview_offer_img" title="offer"/>
                         
                        <br/>
                        <textarea placeholder="أضف وصفا للعرض..." class="textarea" id="offer_desc" name="offer_description"><?php echo $offer_row['offer_description'];?>
                        </textarea>
                        <p class="error" id="Error_offer_description">خطأ كبير يا نجم</p>
                        <br/><br/>
                        <input type="hidden" value="<?php echo $_GET['sid'];?>" name="shop_no"/>
                        <input type="hidden" value="<?php echo $offer_row['id']?>" name="offer_no"/>
                        <input type="submit" value="تعديل العرض"  name="login_sub" class="btn_edit_user" />
                                
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
                    <?php if(@$_SESSION['Success_offer_check']=="true"):?>
                        src="../images/icons/accept.png"
                    <?php else:?>
                        src="../images/icons/cancel.png"
                    <?php endif;?>
                    /><b 
                    <?php if(@$_SESSION['Success_offer_check']=="true"):?>
                        style="color:#080"
                    <?php else:?>
                        style="color:#ff0000"
                    <?php endif;?>
                    
                    >&nbsp;&nbsp;<?php echo @$_SESSION['message_offer'];?></b> </h4>
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
        <!-- <script src="../javascript/jquery-2.1.1.min.js"></script> -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../javascript/bootstrap.min.js"></script>
        <!-- My plugin js       -->
        <script src="../javascript/jquery.nicescroll.min.js"></script>
        <script src="../javascript/index.js"></script>
        <script src="../javascript/add_offer.js"></script>
        <!-- start message with error handling -->
        <?php if(@$_SESSION['Success_offer_check']):?>
        <script type="text/javascript">
            $(document).ready(function(){
                 $('#Message').modal('show');
            });
        </script>
        <?php endif;?>
        <?php @$_SESSION['Success_offer_check']=null;?>
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