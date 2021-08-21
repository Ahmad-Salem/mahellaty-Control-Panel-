<?php
    session_start();
    //include_once("../php_includes/funtions.php");
    //echo cryptPass("0128193632");
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
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <!-- fontawsome -->
        <link rel="stylesheet" href="../css/font-awesome.min.css"/>
        <!-- My Css style -->
        <link href="../css/style.css" rel="stylesheet">
        <link  href="../css/login_style.css" rel="stylesheet"/>
        <!-- My Media style -->
        <link  rel="stylesheet" href="../css/media.css" />
        <!-- animate.css file required for wow library -->
        <link rel="stylesheet" href="../css/animate.css" />
        <!-- [if it ie 9] -->
            <script src="../javascript/html5shiv.min.js"></script>
            <script src="../javascript/respond.min.js"></script>
        <!-- [end if] -->
        
    </head>
    <body>
        
        <!-- start Breadcrumb -->
        <div class="breadtrumb_holder wow bounceInDown"  style="margin-top: 0px;" data-wow-duration="1s" data-wow-offset="400">
            <div class="container">
                <ol class="breadcrumb">
                      <li><a href="#" class="link">محلاتي</a></li>
                      <li class="active">تسجيل الدخول</li>
                      <li class="hidden"><a href="http://www.ma7laty.com/rahlaty/index.php">.....</a></li>
                </ol>
            </div>    
        </div>
        <!--End Breadcrumb -->
            
        
        <section class="login_admin">
            <div class="containter login_content wow bounceInUp" data-wow-duration="1s" data-wow-offset="400">
                <div class="logo_design">
                    <div class="logo_image"><i class="fa fa-shopping-basket fa-x3 text-center"></i></div>
                    
                    <h4 class="text-center h2">محلاتي</h4>
                </div>
                <div class="login_form" id="admin_login_submit">
                    <form action="login_back.php" method="post">
                        <h4 class="">تسجيل الدخول كمسئول</h4>
                        <br/>
                        <input type="text" id="admin_name" placeholder="أدخل البريد الألكتروني"  name="email" class="input" />
                        <br/><br/>
                        <p class="error" id="Error_Name">خطأ كبير يا نجم</p>
                        <input type="password" id="admin_pass" placeholder="أدخل كلمة المرور"  name="password" class="input" />
                        <br/><br/>
                        <p class="error" id="Error_Pass">خطأ كبير يا نجم</p>
                        <input type="submit" value="تسجيل الدخول"  name="login_sub" class="btn_log" />
                        <a href="#">نسيت كلمة المرور</a>
                    </form>
                    
                </div>
            </div>
            
        </section>
        <!-- end login as administrator-->
        <!-- start login as administrator-->
        <?php 
            if(!empty($_SESSION['Message_login']))
            {
                $message=$_SESSION['Message_login'];
                echo "<div class=\"error_login\">{$message}</div>";
                $_SESSION['Message_login']=null;
            }
        ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="../javascript/jquery-2.1.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../javascript/bootstrap.min.js"></script>
        <!-- nice scroll library -->
        <script src="../javascript/jquery.nicescroll.min.js"></script>
        <!-- My plugin js       -->
        <script src="../javascript/index.js"></script>
        <script src="../javascript/check_login.js"></script>
        <!-- Wow.js library  -->
        <script src="../javascript/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>

        <?php 
        $_SESSION['Message_login']='';
        $_SESSION=null;
        $_COOKIE=null;

        ?>
    </body>
</html>

