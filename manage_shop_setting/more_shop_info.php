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
      	 <div class="more_shop_info">
            <br/><br/>
            <?php
                //getting all shop information
                $shop_id=$_GET['s_id'];
                $user_id=$_GET['u_id'];

                $query_shop_information="SELECT  `shop_name`, `user_name`, `allowed_products` ,`country`, `shop`.`address`, `description`, `shop`.`photo` as `s_photo`, `shop_activity`, `lat`, `log` FROM `shop` INNER JOIN `users` on `shop`.`user_id`=`users`.`id` WHERE `shop`.id='{$shop_id}' AND `users`.`id`='{$user_id}' LIMIT 1";
                $perfom_query_shop_information=mysqli_query($connect,$query_shop_information);
                while($shop_row=mysqli_fetch_assoc($perfom_query_shop_information))
                {
                    echo "<h4 class=\"text-center\">".$shop_row['shop_name']."</h4>";
                    echo "<br/>";
                    if($shop_row['s_photo'] !='')
                    {
                        //link to shop image
                        echo "<img src=\"../images/users/{$user_id}/{$shop_id}/".$shop_row['s_photo']."\" title=\"shop photo\"/>";    
                    }else
                    {
                        //default link
                        echo "<img src=\"../images/default_images/store.jpg\" title=\"shop photo\"/>";
                    }
                    
                    echo "<br/><br/>";
                    echo "<hr/>";
                    echo "<h4 class=\"text-center\">معلومات عن المحل</h4>";
                    echo "<p><span>عنوان المحل &nbsp;: &nbsp;&nbsp;</span> ".$shop_row['address']."</p>";
                    echo "<p><span>وصف المحل &nbsp;: &nbsp;&nbsp;</span> ".$shop_row['description']."</p>"; 
                    echo "<p><span>الدولة &nbsp;: &nbsp;&nbsp;</span> ".$shop_row['country']."</p>";
                    echo "<p><span>نشاط صاحب المحل &nbsp;: &nbsp;&nbsp;</span> ".$shop_row['shop_activity']."</p>";
                    echo "<p><span>خط العرض &nbsp;: &nbsp;&nbsp;</span> &nbsp;".$shop_row['lat']." درجة.</p>";
                    echo "<p><span>خط الطول &nbsp;: &nbsp;&nbsp;</span> ".$shop_row['log']." درجة.</p>";
                    echo "<p><span>عدد المنتجات المسموح بها &nbsp;: &nbsp;&nbsp;</span> ".$shop_row['allowed_products']." منتجات.</p>";
                    echo "<p><span>أسم صاحب المحل &nbsp;: &nbsp;&nbsp;</span> ".$shop_row['user_name']."</p>";
                    echo "<p><span>عروض المحل &nbsp;: &nbsp;&nbsp;</span> <a href=\"view_offers.php?sid={$shop_id}&u_id={$user_id}\">مشاهدة العروض التي داخل المحل</a></p>";
                }
            ?>
            
            <br/><br/>
            <hr/>
            <div class="shop_adding_product">
                <a href="add_product.php?s_id=<?php echo $_GET['s_id'];?>">إضافة منتج داخل المحل</a>

            </div>
            <div class="shop_adding_product" id="product_list">
                <a >عرض قائمة المنتجات</a>
                
            </div>
            <hr/>
            <h4 class="text-center">المنتجات التي بداخل المحل</h4>
            <div class="box">
                         
                 <div class="filter">
                     <input type="text" id="search_product" name="search_shop" placeholder="أبحث باسم المنتج ...">
                     <input type="hidden"  id="shop_no" value="<?php echo $_GET['s_id'];?>"/>    
                 </div>  
            </div> 
            <div class="row prod_cont" id="product">
                                    
                <?php 
                    if (isset($shop_id))
                    {
                        $query_shop_product_details="SELECT `id`, `product_name`, `product_price`, `product_photo`, `shop_id` , `product_description` FROM `products` WHERE `shop_id`='{$shop_id}'";
                        $perform_query_shop_product_details=mysqli_query($connect,$query_shop_product_details);
                        if(mysqli_num_rows($perform_query_shop_product_details)<=0)
                        {
                            echo "<h4 class=\"text-center\">لا يوجد منتجات تم تسجيلها داخل هذا المحل</h4>";
                        }else
                        {
                            $user_id=$_GET['u_id'];
                            while($row_shop_product=mysqli_fetch_assoc($perform_query_shop_product_details))
                            {
                                
                                echo "<div class=\"col-md-4\">";
                                echo "<div class=\"product\">";
                                echo "<img src=\"../images/users/{$user_id}/{$shop_id}/main_p_photo/".$row_shop_product['id']."/".$row_shop_product['product_photo']."\" title=\"product\">";
                                echo "<hr/>";
                                echo "<div class=\"links\"><a href=\"#\" class=\"delete_product\"><i class=\"fa fa-trash-o fa-lg\"></i></a><a href=\"edit_product.php?s_no=".$shop_id."&p_no=".$row_shop_product['id']."&&u_id=".$user_id."\"><i class=\"fa fa-edit fa-lg\"></i></a></div>";
                                echo "<hr/>";
                                echo "<p><span>اسم المنتج&nbsp;: &nbsp;&nbsp;".$row_shop_product['product_name']."</span></p>";
                                echo "<p><span>سعر المنتج&nbsp;: &nbsp;&nbsp;".$row_shop_product['product_price']."&nbsp; جنيه مصري</span></p>";
                                echo "<p><span>وصف المنتج&nbsp;: &nbsp;&nbsp;".$row_shop_product['product_description']."</span></p>";
                                echo "<br/>";
                                echo "<input type=\"hidden\" class=\"product_number\" value=\"".$row_shop_product['id']."\"/> ";
                                echo "<input type=\"hidden\" class=\"shop_number\" value=\"".$row_shop_product['shop_id']."\"/> ";
                                echo "<input type=\"hidden\" class=\"a_number\" value=\"".$user_id."\"/> ";
                                echo "<a href=\"view_product.php?s_no=".$shop_id."&p_no=".$row_shop_product['id']."&&u_id=".$user_id."\"  class=\"anchor_more\">عرض المزيد</a>";
                                echo "<br/><br/>";
                                echo "</div>";
                                echo "</div>";


                            }    
                        }
                        
                    }
                ?>
                

            </div>
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

        <!-- pop up of display products model -->
        <!-- Modal -->
        <div class="modal fade fading_opacity" id="Message_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="modal-dialog mod_dio" role="document">

            <div class="modal-content mod_con">

              <div class="modal-body mod_body">
                <h4 class="text-center">
                    <h4 class="text-center">قائمة المنتجات</h4>
                    <h6 class="text-center"><a>إضافة منتج</a></h6>



                    <form class="form-inline" style="margin-right: 49px;margin-bottom: 20px;">  
                      <div class="form-group mb-2">
                        <label for="staticEmail2" class="sr-only">Email</label>
                       <input type="text" class="form-control" id="product_name" placeholder="أسم المنتج">
                      </div>
                      <div class="form-group mx-sm-3 mb-2">
                        <label for="inputPassword2" class="sr-only">Password</label>
                        <input type="number" min="0" class="form-control" id="product_price" placeholder="سعر المنتج">
                      </div>
                      <input type="hidden" class="shop_number" value="<?php echo $shop_id;?>"/>
                      <button type="button" id="add_product" class="btn btn-primary mb-2">إضافة المنتج</button>
                    </form>





                    <?php
                        $query_get_product_list="SELECT `id`, `shop_id`, `product_name`, `product_price` FROM `products_list_text` WHERE `shop_id`='{$shop_id}' ";
                        $peform_query_get_product_list=mysqli_query($connect,$query_get_product_list);
                        echo "<ul class=\"list-group\">";
                        while($row_product=mysqli_fetch_assoc($peform_query_get_product_list))
                        {

                            echo"<li class=\"list-group-item\"><span>".$row_product['product_name']."</span>

                            <a style=\"float:left; margin-right:5px; color:#333;\" class=\"delete_product_list_text\"><i class=\"fa fa-trash-o fa-lg\"></i></a>
                            <input type=\"hidden\" class=\"product_number\" value=\"".$row_product['id']."\"/>
                            <input type=\"hidden\" class=\"shop_number\" value=\"".$row_product['shop_id']."\"/>
                            <a  style=\"float:left;display:none; margin-right:5px; color:#333;\" class=\"delete_product\"><i class=\"fa fa-edit fa-lg\"></i></a>

                            <strong style=\"float:left;\">جنيه</strong>

                            <span style=\"float:left;margin-left:5px;\">".$row_product['product_price']."</span>&nbsp;

                                

                            </li>";
                      
                    
                        }
                        echo "</ul>";

                    ?>

                    
                </h4> 

              </div>

              <div class="modal-body mod_body cansel">
                <h4 class="text-center h5" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;&nbsp;إلغاء</h4>

              </div>

            </div>
          </div>
        </div>

        <!-- the end of pop up of display products model -->
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="../javascript/jquery-2.1.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../javascript/bootstrap.min.js"></script>
        <!-- My plugin js       -->
        <script src="../javascript/index.js"></script>
        <script src="../javascript/jquery.nicescroll.min.js"></script>
    	
    	<!-- start logout script-->
        <script type="text/javascript">
        $(document).ready(function(){
            $("#logout").click(function(){
                $('#Message_logout').modal('show');   
            });
            $("#product_list").click(function(){
                $('#Message_product').modal('show');   
            });
             
        });
       </script>
        <!-- end logout script-->
        <script type="text/javascript">

            function get_product_search(search,shop_no)
            {
                

                // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                var search=search;
                var shop_no=shop_no;
                var url = "../get_information/get_product_search.php";
                var vars = "search="+search+"&shop_no="+shop_no;

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
                        
                        $("#product").html('');
                       
                        var stringHtml="";
                        $.each( jArraygetpersondetails_search, function( key, value ){

                            
                            stringHtml+="<div class=\"col-md-4\">";
                            stringHtml+="<div class=\"product\">";
                            stringHtml+="<img src=\"../images/users/<?php echo $_SESSION['user_id'];?>/"+shop_no+"/main_p_photo/"+value.id+"/"+value.product_photo+"\" title=\"product\">";
                            stringHtml+="<hr/>";
                            stringHtml+="<div class=\"links\"><a href=\"#\" class=\"delete_product\"><i class=\"fa fa-trash-o fa-lg\"></i></a><a href=\"edit_product.php?s_no="+shop_no+"&p_no="+value.id+"\"><i class=\"fa fa-edit fa-lg\"></i></a></div>";
                            stringHtml+="<hr/>";
                            stringHtml+="<p><span>اسم المنتج&nbsp;: &nbsp;&nbsp;"+value.product_name+"</span></p>";
                            stringHtml+="<p><span>سعر المنتج&nbsp;: &nbsp;&nbsp;"+value.product_price+"&nbsp; جنيه مصري</span></p>";
                            stringHtml+="<p><span>وصف المنتج&nbsp;: &nbsp;&nbsp;"+value.product_description+"</span></p>";
                            stringHtml+="<br/>";
                            stringHtml+="<input type=\"hidden\" class=\"product_number\" value=\""+value.id+"\"/> ";
                            stringHtml+="<input type=\"hidden\" class=\"shop_number\" value=\""+shop_no+"\"/> ";
                            stringHtml+="<input type=\"hidden\" class=\"a_number\" value=\""+value.user_id+"\"/> ";
                            stringHtml+="<a href=\"view_product.php?s_no="+shop_no+"&p_no="+value.id+"\"  class=\"anchor_more\">عرض المزيد</a>";
                            stringHtml+="<br/><br/>";
                            stringHtml+="</div>";
                            stringHtml+="</div>";
                            
                        

                        });

                        $("#product").append(stringHtml);
                        // console.log(stringHtml);

                        

                        //for delete shops
                        $('.delete_product').click(function(){
                

                            var product_number=$(this).parent().siblings('.product_number').val();
                            var shop_number=$(this).parent().siblings('.shop_number').val();
                            var a_number=$(".a_number").val();
                            // alert(product_number+shop_number+a_number);
                            
                            if(confirm("هل أنت متاكد ؟")==true)
                            {
                                $(this).parent().parent().hide();
                                // nice scroll 
                                
                                $("html,body").animate({scrollTop:800}, 1000);
                                
                                //delete this product
                                delete_product(product_number,shop_number,a_number);

                            }else
                            {
                                alert("لم يتم حذف المستخدم.");
                            }
                            
                        });


                        
                                   
                    }else{
                            $("#product").html("<h4 class=\"text-center\">لا يوجد منتجات بهذا الأسم داخل هذا المحل</h4>");
                    }



                }else{
                    $("#product").html("<h4 class=\"text-center\">لا يوجد منتجات بهذا الأسم داخل هذا المحل</h4>");
                    }

                }
                // Send the data to PHP now... and wait for response to update the status div
                hr.send(vars); // Actually execute the request

            }       



            $("#search_product").on("keyup",function(){
                var search=$(this).val();
                var shop_no=$("#shop_no").val();
                // alert(search);
                // alert(shop_no);
                get_product_search(search,shop_no);
            });
        </script>
    
        <script type="text/javascript">
        $(".product").niceScroll();
        $("#product").niceScroll();
        
        function delete_product(product_number,shop_number,a_number)
        {
            // Create our XMLHttpRequest object
            var hr = new XMLHttpRequest();
            // Create some variables we need to send to our PHP file
            var shop_id=shop_number;
            var url = "delete_product.php";
            var vars = "shop_id="+shop_id+"&product_id="+product_number+"&user_id="+a_number;
            // alert(vars);
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

        $('.delete_product').click(function(){
                

                var product_number=$(this).parent().siblings('.product_number').val();
                var shop_number=$(this).parent().siblings('.shop_number').val();
                var a_number=$(".a_number").val();
                // alert(product_number+shop_number+a_number);
                
                if(confirm("هل أنت متاكد ؟")==true)
                {
                    $(this).parent().parent().hide();
                    // nice scroll 
                    
                    $("html,body").animate({scrollTop:800}, 1000);
                    
                    //delete this product
                    delete_product(product_number,shop_number,a_number);

                }else
                {
                    alert("لم يتم حذف المستخدم.");
                }
                
            });


        </script>


        <script type="text/javascript">
            
            // delete product list text
            //for delete shops
            $('.delete_product_list_text').click(function(){
    

                var product_number=$(this).siblings('.product_number').val();
                var shop_number=$(this).siblings('.shop_number').val();
                
                // alert(product_number+shop_number);
                
                if(confirm("هل أنت متاكد ؟")==true)
                {
                    $(this).parent().hide();
                    // nice scroll 
                    
                    $("html,body").animate({scrollTop:800}, 1000);
                    
                    //delete this product
                    delete_product_text(product_number,shop_number);

                }else
                {
                    alert("لم يتم حذف المنتج.");
                }
                
            });


            function delete_product_text(product_number,shop_number)
        {
            // Create our XMLHttpRequest object
            var hr = new XMLHttpRequest();
            // Create some variables we need to send to our PHP file
            var shop_id=shop_number;
            var url = "delete_product_text.php";
            var vars = "shop_id="+shop_id+"&product_id="+product_number;
            // alert(vars);
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

        <script type="text/javascript">
            
            $("#add_product").click(function(){
                // adding new product
                var product_name=$("#product_name").val();
                var product_price=$("#product_price").val();  
                var shop_number=$(this).siblings('.shop_number').val();
                
                if(product_name!=""&&product_price!=""&&shop_number!="")
                {
                    add_product_text(shop_number,product_name,product_price);
              
                }else
                {
                    //error empty values
                    alert("يجب إدخال جميع القيم...");
                }
              

            });
            
              function add_product_text(shop_id,product_name,product_price)
                {
                    // Create our XMLHttpRequest object
                    var hr = new XMLHttpRequest();
                    // Create some variables we need to send to our PHP file
            
                    var url = "add_product_text.php";
                    var vars = "shop_id="+shop_id+"&product_name="+product_name+"&product_price="+product_price;
                    // alert(vars);
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
    </body>
</html>