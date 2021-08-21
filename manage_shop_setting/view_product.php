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
      	 <div class="more_view_product_info">
            <br/><br/>
            <?php
                if(isset($_GET['p_no'])&&isset($_GET['s_no'])&&isset($_GET['u_id']))
                {
                    $product_id=$_GET['p_no'];
                    $shop_id=$_GET['s_no'];
                    $user_id=$_GET['u_id'];
                    $query_details="SELECT `product_name`,`product_price`,`product_photo`,`product_description`,`shop`.`shop_name`,`shop`.`address`,`shop`.`country`,`users`.`user_name`,`users`.`telephone1`,`users`.`telephone2` FROM `products` INNER JOIN `shop` on `shop`.`id`= `products`.`shop_id` INNER JOIN `users` ON `users`.`id`=`shop`.`user_id` WHERE `products`.`id`='{$product_id}' AND `shop`.`id`='{$shop_id}' AND `users`.`id`='{$user_id}' LIMIT 1";
                    $perform_query_details=mysqli_query($connect,$query_details);
                    $row_details=mysqli_fetch_assoc($perform_query_details);    
                
                
            ?>
            <h4 class="text-center"><?php echo $row_details['product_name'];?></h4>
            <?php
                $query_product_images="SELECT  `photo_name` FROM `product_photos` WHERE `p_id`='{$product_id}' ";
                $perform_query_product_images=mysqli_query($connect,$query_product_images);
                $number_of_images=mysqli_num_rows($perform_query_product_images);
                
                echo "<!-- start carousel -->";
    
                echo "<div id=\"myslide\" class=\"carousel slide hidden-xs hidden-sm\" data-ride=\"carousel\">";
                echo "<!-- Indicators -->";
                echo "<ol class=\"carousel-indicators\">";
                echo "<li data-target=\"#myslide\" data-slide-to=\"0\" class=\"active\"></li>";
                for ($i=1; $i <= $number_of_images; $i++) 
                {
                    echo "<li data-target=\"#myslide\" data-slide-to=\"$i\" ></li>";
                } 
                
                echo "</ol>";

                echo "<!-- Wrapper for slides -->";
                echo "<div class=\"carousel-inner\" role=\"listbox\">";
                    
                echo "<div class=\"item active\">";
                echo "<img src=\"../images/users/{$user_id}/{$shop_id}/main_p_photo/{$product_id}/".$row_details['product_photo']."\" width=\"1920\" height=\"600\"  alt=\"pic1\">";
                echo "</div>";
                while($row_p_images=mysqli_fetch_assoc($perform_query_product_images))
                {
                    echo "<div class=\"item\">";
                    echo "<img src=\"../images/users/{$user_id}/{$shop_id}/p_photos/{$product_id}/".$row_p_images['photo_name']."\" width=\"1920\" height=\"600\"  alt=\"pic1\">";
                    echo "</div>";   
                }  
                
                    

                echo "</div>";
              
                echo "<!-- Controls -->";
                echo "<a class=\"left carousel-control\" href=\"#myslide\" role=\"button\" data-slide=\"prev\">";
                echo "<i class=\"fa fa-arrow-circle-left fa-3x\"></i>";
                echo "<span class=\"sr-only\">Previous</span>";
                echo "</a>";
                echo "<a class=\"right carousel-control\" href=\"#myslide\" role=\"button\" data-slide=\"next\">";
                echo "<i class=\"fa fa-arrow-circle-right fa-3x\"></i>";
                echo "<span class=\"sr-only\">Next</span>";
                echo "</a>";
                echo "</div>";
         
                echo "<!-- End carousel -->";
    
                
            ?>
            
            <h4 class="text-center">تفاصيل المنتج</h4>
            <p><span>أسم المنتج &nbsp;:&nbsp;&nbsp;</span><?php echo $row_details["product_name"];?></p>
            <p><span>سعر المنتج &nbsp;:&nbsp;&nbsp;</span><?php echo $row_details["product_price"];?></p>
            <p><span>وصف المنتج &nbsp;:&nbsp;&nbsp;</span><?php echo $row_details["product_description"];?></p>
            <p><span>اسم المحل &nbsp;:&nbsp;&nbsp;</span><?php echo $row_details["shop_name"];?></p>
            <p><span>عنوان المحل &nbsp;:&nbsp;&nbsp;</span><?php echo $row_details["address"];?></p>
            <p><span>الدولة &nbsp;:&nbsp;&nbsp;</span><?php echo $row_details["country"];?></p>
            <p><span>اسم صاحب المحل &nbsp;:&nbsp;&nbsp;</span><?php echo $row_details["user_name"];?></p>
            <p><span>رقم تليفون صاحب المحل &nbsp;:&nbsp;&nbsp;</span><?php echo $row_details["telephone1"]." / ".$row_details["telephone2"];?></p>
            <?php 
                }
                else
                    {
                        echo "<h4 class=\"text-center\">حدث خطا في تحميل البيانات.</h4>";
                    }?>
            <br/><br/>
         </div>
            
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
        <script src="../javascript/index.js"></script>
        
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