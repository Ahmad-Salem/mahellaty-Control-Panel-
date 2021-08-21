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
                    <a href="add_offers.php?sid=<?php echo $_GET['sid']; ?>"><i class="fa fa-plus fa-lg"></i></a>
                    <a href="#" id="logout">...</a>
                </div>
            </div>
        </div>
        <!-- end section header -->
        <!-- start section body -->
        <div class="clear"></div>
        <div class="body_content container">
        
            <div class="view_offers add_user more_shop_info">
                <h4 class="text-center">العروض التي بداخل المحل</h4>
                <hr/>
                <div class="box">
                         
                     <div class="filter">
                         <input type="text" id="search_offer" name="search_shop" placeholder="أبحث باسم العرض ...">
                         <input type="hidden"  id="shop_no" value="<?php echo $_GET['sid'];?>"/>    
                     </div>  
                </div> 
                <div class="offers row prod_cont" id="offer">
                    <?php 
                    //query
                    $shop_id=$_GET['sid'];
                    $user_id=$_GET['u_id'];
                    $query_display_offer="SELECT `id`, `offer_name`, `offer_description`, `offer_photo`, `shop_id`, `main_page`, `from_date`, `to_date` FROM `offers` WHERE `shop_id`='{$shop_id}'";
                    $perform_query_display_offer=mysqli_query($connect,$query_display_offer);
                    while($offer_row=mysqli_fetch_assoc($perform_query_display_offer))
                    {
                        echo "<div class=\"col-md-4\">";
                        echo "<div class=\"product\">";
                        echo "<img src=\"../images/users/{$user_id}/{$shop_id}/offers/".$offer_row['id']."/".$offer_row['offer_photo']."\" title=\"offer\">";
                        echo "<hr/>";
                        echo "<div class=\"links\">";
                        echo "<a href=\"#\" class=\"delete_offer\">";
                        echo "<i class=\"fa fa-trash-o fa-lg\"></i>";
                        echo "</a>";
                        echo "<a href=\"edit_offer.php?sid={$shop_id}&&o_id=".$offer_row['id']."&&u_id=".$user_id."\">";
                        echo "<i class=\"fa fa-edit fa-lg\"></i>";
                        echo "</a>";
                        echo "</div>";
                        echo "<hr/>";
                        if($offer_row['main_page']=="1")
                        {
                            echo "<p class=\"offer\"><span>نوع العرض&nbsp;: &nbsp;&nbsp; الصفحة الرئيسيه</span></p>";
                        }else
                        {
                            echo "<p class=\"offer\"><span>نوع العرض&nbsp;: &nbsp;&nbsp; عرض عادي</span></p>";
                        }
                        
                        echo "<p class=\"offer\"><span>تاريخ البدايه&nbsp;: &nbsp;&nbsp; ".$offer_row['from_date']."</span></p>";
                        echo "<p class=\"offer\"><span>تاريخ النهايه&nbsp;: &nbsp;&nbsp; ".$offer_row['to_date']."</span></p>";
                        echo "<p class=\"offer\"><span>أسم العرض&nbsp;: &nbsp;&nbsp; ".$offer_row['offer_name']."</span></p>";
                        echo "<p class=\"offer\"><span>وصف العرض&nbsp;: &nbsp;&nbsp; ".$offer_row['offer_description']."</span></p>";
                        echo "<input type=\"hidden\"/ value=\"{$shop_id}\" class=\"shop_num\">";
                        echo "<input type=\"hidden\"/ value=\"".$offer_row['id']."\" class=\"offer_num\">";
                        echo "</div>";    
                        echo "</div>";    
                    }

                    ?>
                    

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
        <script src="../javascript/jquery-2.1.1.min.js"></script>
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
        <!-- start search script -->
        <script type="text/javascript">
        function get_offer_search(search,shop_no)
            {
                

                // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                var search=search;
                var shop_no=shop_no;
                var url = "../get_information/get_offer_search.php";
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
                        
                        $("#offer").html('');
                       
                        var stringHtml="";
                        $.each( jArraygetpersondetails_search, function( key, value ){

                            stringHtml+="<div class=\"col-md-4\">";
                            stringHtml+="<div class=\"product\">";
                            stringHtml+="<img src=\"../images/users/"+value.user_id+"/"+value.shop_id+"/offers/"+value.offer_id+"/"+value.offer_photo+"\" title=\"offer\">";
                            stringHtml+="<hr/>";
                            stringHtml+="<div class=\"links\">";
                            stringHtml+="<a href=\"#\" class=\"delete_offer\">";
                            stringHtml+="<i class=\"fa fa-trash-o fa-lg\"></i>";
                            stringHtml+="</a>";
                            stringHtml+="<a href=\"edit_offer.php?sid="+value.shop_id+"&&o_id="+value.offer_id+"&&u_id="+value.user_id+"\">";
                            stringHtml+="<i class=\"fa fa-edit fa-lg\"></i>";
                            stringHtml+="</a>";
                            stringHtml+="</div>";
                            stringHtml+="<hr/>";
                            stringHtml+="<p class=\"offer\"><span>اسم العرض&nbsp;: &nbsp;&nbsp; "+value.offer_name+"</span></p>";
                            stringHtml+="<p class=\"offer\"><span>وصف العرض&nbsp;: &nbsp;&nbsp; "+value.offer_description+"</span></p>";
                            stringHtml+="<input type=\"hidden\"/ value=\""+value.shop_id+"\" class=\"shop_num\">";
                            stringHtml+="<input type=\"hidden\"/ value=\""+value.offer_id+"\" class=\"offer_num\">";
                            stringHtml+="</div>";    
                            stringHtml+="</div>";  
                            
                            
                        

                        });

                        $("#offer").append(stringHtml);
                        // console.log(stringHtml);

                        

                        //for delete shops
                        $('.delete_offer').click(function(){
                

                            var shop_number=$(this).parent().siblings('.shop_num').val();
                            var offer_number=$(this).parent().siblings('.offer_num').val();
                            
                            // alert(shop_number+offer_number);
                            
                            if(confirm("هل أنت متاكد ؟")==true)
                            {
                                $(this).parent().parent().hide();
                                // nice scroll 
                                
                                $("html,body").animate({scrollTop:800}, 1000);
                                
                                //delete this product
                                delete_product(shop_number,offer_number);

                            }else
                            {
                                alert("لم يتم حذف العرض.");
                            }
                            
                        });                        
                                   
                    }else{
                            $("#offer").html("<h4 class=\"text-center\">لا يوجد عروض بهذا الأسم داخل هذا المحل</h4>");
                    }



                }else{
                    $("#offer").html("<h4 class=\"text-center\">لا يوجد عروض بهذا الأسم داخل هذا المحل</h4>");
                    }

                }
                // Send the data to PHP now... and wait for response to update the status div
                hr.send(vars); // Actually execute the request

            }       


            $("#search_offer").on("keyup",function(){
                var search=$(this).val();
                var shop_no=$("#shop_no").val();
                // alert(search);
                // alert(shop_no);
                get_offer_search(search,shop_no);
            });
        </script>
        <!-- end search script -->
        <!-- start delete offer script-->
        <script type="text/javascript">
            function delete_product(shop_number,offer_number)
            {
                // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file
                var url = "delete_offer.php";
                var vars = "shop_id="+shop_number+"&offer_id="+offer_number;
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

            $('.delete_offer').click(function(){
                

                var shop_number=$(this).parent().siblings('.shop_num').val();
                var offer_number=$(this).parent().siblings('.offer_num').val();
                
                // alert(shop_number+offer_number);
                
                if(confirm("هل أنت متاكد ؟")==true)
                {
                    $(this).parent().parent().hide();
                    // nice scroll 
                    
                    $("html,body").animate({scrollTop:800}, 1000);
                    
                    //delete this product
                    delete_product(shop_number,offer_number);

                }else
                {
                    alert("لم يتم حذف العرض.");
                }
                
            });

        </script>
        <!-- end delete offer script-->
    
    </body>
</html>