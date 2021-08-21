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
      	 <div class="add_user add_shop">
                <form action="add_product_background.php" method="POST" id="add_shop_submit" enctype="multipart/form-data">
                    <h4 class="text-center">إضافة بيانات المنتج</h4>
                        <br/>
                        <input type="text" id="add_product" placeholder="أدخل أسم المنتج"  name="add_product_name" class="input" />
                        <br/><br/>
                        <p class="error" id="Error_product_Name">خطأ كبير يا نجم</p>
                        <input type="number" min="0" id="add_product_price" placeholder="أدخل سعر المنتج بالجنيه المصري"  name="add_product_price" class="input" />
                        <br/><br/>
                        <p class="error" id="Error_product_price">خطأ كبير يا نجم</p>
                        
                        <div class="upload_photo_container">
                            
                                <div class="file-input wrapper photo_btn">
                                                       
                                        <input id="add_main_product_photo" type="file" name="add_main_product_photo"  class="file-input control" />
                                        <div class="file-input content">
                                            <div class="upload_image_box">
                                            <h5 class="text-center">تحميل الصورة الرئيسية للمنتج</h5>
                                            </div> 
                                        </div>
                                 </div>
                             
                        </div>
                         <p class="error" id="Error_main_product_photo">خطأ كبير يا نجم</p>
                         <br/>
                         <p class="selected_image text-center hidden" id="product_images">لم يتم أختيار أي صور أخري للمنتجات</p>
                         <div class="upload_photo_container hidden">
                            
                                <div class="file-input wrapper photo_btn">
                                                       
                                        <input id="add_products_photo" type="file" multiple name="add_products_photo[]"  class="file-input control" />
                                        <div class="file-input  content">
                                            <div class="upload_image_box">
                                            <h4 class="text-center">تحميل صور أخري للمنتج</h4>
                                            </div> 
                                        </div>
                                 </div>
                             
                        </div>
                            <p class="error" id="Error_product_photos">خطأ كبير يا نجم</p>
                            <br/>
                            <textarea placeholder="أضف وصفا للمنتج..." class="textarea" id="p_desc" name="product_description"></textarea>
                            <p class="error" id="Error_product_description">خطأ كبير يا نجم</p>
                            <br/><br/>
                            <input type="hidden" value="<?php echo $_GET['s_id'];?>" name="shop_no"/>
                            <input type="submit" value="إضافة المنتج"  name="login_sub" class="btn_edit_user" />
                                
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
                    <?php if(@$_SESSION['Success_product_check']=="true"):?>
                        src="../images/icons/accept.png"
                    <?php else:?>
                        src="../images/icons/cancel.png"
                    <?php endif;?>
                    /><b 
                    <?php if(@$_SESSION['Success_product_check']=="true"):?>
                        style="color:#080"
                    <?php else:?>
                        style="color:#ff0000"
                    <?php endif;?>
                    
                    >&nbsp;&nbsp;<?php echo @$_SESSION['message_product'];?></b> </h4>
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
    	<script src="../javascript/add_product.js"></script>
        <!-- start message with error handling -->
        <?php if(@$_SESSION['Success_product_check']):?>
        <script type="text/javascript">
            $(document).ready(function(){
                 $('#Message').modal('show');
            });
        </script>
        <?php endif;?>
        <?php @$_SESSION['Success_product_check']=null;?>
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