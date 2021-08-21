<?php
    session_start();
    include_once("../php_includes/connection_db.php");

    /*setting user status*/ 
    $user_id=$_SESSION['user_id'];
    //set activated to zero
    $query_activated="UPDATE `users` SET `status`='offline' WHERE id='{$user_id}' LIMIT 1";
    $perform_query_activated=mysqli_query($connect,$query_activated);
    if($perform_query_activated)
    {
        //correct 
        //destroy sessions
        $_SESSION['user_id']=null;
        $_SESSION['user_name']=null;
        $_SESSION['user_type']=null;
        $_SESSION['email']=null;
        $_SESSION['password']=null;
        session_destroy();

        

        header("location: ../login/login.php");

    }else
    {
        //false
        $message="حدث خطأ أثناء تسجيل الخروج ";
        $_SESSION['msg_error']=$message;
        header("location: ../index.php");
    }

    
?>