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
                <!-- edit_product_background.php -->
                <form action="edit_product_background.php" method="POST" id="edit_shop_submit" enctype="multipart/form-data">
                    <h4 class="text-center">تعديل بيانات المنتج</h4>
                        <br/>
                        <?php
                            if(isset($_GET['s_no'])&&isset($_GET['p_no'])&&isset($_GET['u_id']))
                            {
                                $product_id=$_GET['p_no'];
                                $shop_id=$_GET['s_no'];
                                $user_id=$_GET['u_id'];

                                $query_product_details="SELECT  `product_name`, `product_price`, `shop_id`, `product_photo`, `product_description` FROM `products` WHERE `id`='{$product_id}' AND `shop_id`='{$shop_id}' LIMIT 1";
                                $perform_query_product_details=mysqli_query($connect,$query_product_details);
                                $row_product=mysqli_fetch_assoc($perform_query_product_details);

                            }else
                            {
                                // redirect to logout page 
                            }
                            

                        ?>
                        <input type="text" id="edit_product" placeholder="أدخل أسم المنتج" value="<?php echo $row_product['product_name'];?>" name="edit_product_name" class="input" />
                        <br/><br/>
                        <p class="error" id="Error_product_Name">تعديل كبير يا نجم</p>
                        <input type="number" min="0" id="edit_product_price" value="<?php echo $row_product['product_price'];?>" placeholder="أدخل سعر المنتج بالجنيه المصري"  name="edit_product_price" class="input" />
                        <br/><br/>
                        <p class="error" id="Error_product_price">تعديل كبير يا نجم</p>
                        <div class="main_p_image">
                            <img src="<?php echo "../images/users/{$user_id}/{$shop_id}/main_p_photo/{$product_id}/".$row_product['product_photo']."";?>" title="product main photo"/>
                        </div>
                        <div class="upload_photo_container">
                            
                                <div class="file-input wrapper photo_btn">
                                                       
                                        <input id="edit_main_product_photo" type="file" name="edit_main_product_photo"  class="file-input control" />
                                        <div class="file-input content">
                                            <div class="upload_image_box">
                                            <h5 class="text-center">تعديل الصورة الرئيسية للمنتج</h5>
                                            </div> 
                                        </div>
                                 </div>
                             
                        </div>
                         <p class="waring" id="Error_main_product_photo">خطأ كبير يا نجم</p>
                         <br/>
                         <p class="selected_image text-center hidden" id="product_images">لم يتم تعديل أي صور أخري للمنتجات</p>
                         <div class="main_p_images">
                            <?php
                            /*
                                $query_product_photos="SELECT  `photo_name` FROM `product_photos` WHERE `p_id`='{$product_id}'";
                                $perform_query_product_photos=mysqli_query($connect,$query_product_photos);
                                while($row_product_photos=mysqli_fetch_assoc($perform_query_product_photos))
                                {
                                    echo "<img src=\"../images/users/{$user_id}/{$shop_id}/p_photos/{$product_id}/".$row_product_photos['photo_name']."\" title=\"product  photos\"/>"; 
                                }

                            */
                            ?>
                            
                         </div>
                         <br/>
                         <div class="upload_photo_container hidden">
                            
                                <div class="file-input wrapper photo_btn">
                                                       
                                        <input id="edit_products_photo" type="file" multiple name="edit_products_photo[]"  class="file-input control" />
                                        <div class="file-input  content">
                                            <div class="upload_image_box">
                                            <h4 class="text-center">تعديل الصور ألاخري للمنتج</h4>
                                            </div> 
                                        </div>
                                 </div>
                             
                        </div>
                            <p class="waring" id="Error_product_photos">خطأ كبير يا نجم</p>
                            <br/>
                            <textarea placeholder="تعديل وصف للمنتج..." class="textarea" id="p_desc" name="product_description"><?php echo $row_product['product_description'];?> </textarea>
                            <p class="error" id="Error_product_description">خطأ كبير يا نجم</p>
                            <br/><br/>
                            <input type="hidden" value="<?php echo $_GET['s_no'];?>" name="shop_no"/>
                            <input type="hidden" value="<?php echo $_GET['p_no'];?>" name="product_no"/>
                            <input type="submit" value="تعديل المنتج"  name="login_sub" class="btn_edit_user" />
                                
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
                    <?php if(@$_SESSION['Success_update_product_check']=="true"):?>
                        src="../images/icons/accept.png"
                    <?php else:?>
                        src="../images/icons/cancel.png"
                    <?php endif;?>
                    /><b 
                    <?php if(@$_SESSION['Success_update_product_check']=="true"):?>
                        style="color:#080"
                    <?php else:?>
                        style="color:#ff0000"
                    <?php endif;?>
                    
                    >&nbsp;&nbsp;<?php echo @$_SESSION['message_update_product'];?></b> </h4>
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
    	<script src="../javascript/edit_product.js"></script>
        <!-- start message with error handling -->
        <?php if(@$_SESSION['Success_update_product_check']):?>
        <script type="text/javascript">
            $(document).ready(function(){
                 $('#Message').modal('show');
            });
        </script>
        <?php endif;?>
        <?php @$_SESSION['Success_update_product_check']=null;?>
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