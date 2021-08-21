<?php
//start session
session_start();
include_once("../php_includes/connection_db.php");
include_once("../php_includes/funtions.php");
if( isset($_POST['login_sub']) )
{
    //getting email 
    $Email=mysqli_real_escape_string($connect, $_POST['email']);
	//getting password
    $password=$_POST['password'];
    
    //query check the validation of the account 
    $query="SELECT `id`,`user_name`, `email`,`user_type`,`password` FROM `users` WHERE `email`='$Email'  LIMIT 1";
//    echo $query;
    $perform_check=mysqli_query($connect,$query);
    $row = mysqli_fetch_assoc($perform_check);
    $check_email=mysqli_num_rows($perform_check);
    
    //check validaty
    if($check_email>0)
    {
        //setting values 
        $user_id=$row['id'];
        $user_user_name=$row['user_name'];
        $user_type=$row['user_type'];
        $user_email=$row['email'];
        $user_password=$row['password'];
        
        //setting password
        $hashed_password=cryptPass($user_password);
        
        if(crypt($password, $hashed_password) == $hashed_password )
        {
            
            //setting the sessions
            $_SESSION['user_id']=$user_id;
            $_SESSION['user_name']=$user_user_name;
            $_SESSION['user_type']=$user_type;
            $_SESSION['email']=$user_email;
            $_SESSION['password']=$user_password;
            
            
            //redirect
            if($user_type=="admin")
            {
                header("location: ../index.php");
            }else if($user_type=="shopowner")
            {
                // header("location: ../index.php");
                //error password
                $message="<div class=\"error_login\">هذا الحساب لا يمتلك الصلاحيات للدخول.</div>";
                $_SESSION['Message_login']=$message;
                header("location: login.php");
            }
            
            
        }else
        {
            //error password
            $message="<div class=\"error_login\">كلمة مرور غير صحيحة</div>";
 			$_SESSION['Message_login']=$message;
 			header("location: login.php");
            
        }
    }else
    {
        //error email
        $message="<div class=\"error_login\">بريد إلكتروني غير صحيح</div>";
        $_SESSION['Message_login']=$message;
        header("location: login.php");
    }
    
    
}else
{
    //error email
    $message="<div class=\"error_login\">بريد إلكتروني غير صحيح</div>";
    $_SESSION['Message_login']=$message;
    header("location: login.php");
}
    
?>