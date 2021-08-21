<?php
    function cryptPass($input,$round=9)
    {
        $salt="";
        $saltChars=array_merge(range('A','Z'),range('a','z'),range(0,9));

        for($i=0;$i<22;$i++)
        {
            $salt .=$saltChars[array_rand($saltChars)];	
        }

        return crypt($input,sprintf('$2y$%02d$',$round).$salt);
    }

    function force_logout($path,$message)
    {
        $_SESSION['user_id']=null;
        $_SESSION['user_name']=null;
        $_SESSION['user_type']=null;
        $_SESSION['email']=null;
        $_SESSION['password']=null;
        $_SESSION['Message_login']=$message;            
        header("location: {$path}");
    }

    function check_login($path,$message)
    {
        $user_id=$_SESSION['user_id'];
        $user_user_name=$_SESSION['user_name'];
        $user_type=$_SESSION['user_type'];
        $user_email=$_SESSION['email'];
        $user_password=$_SESSION['password'];

        if(empty($user_id)||empty($user_user_name)||empty($user_type)||empty($user_email)||empty($user_password))
        {
            $_SESSION['user_id']=null;
            $_SESSION['user_name']=null;
            $_SESSION['user_type']=null;
            $_SESSION['email']=null;
            $_SESSION['password']=null;
            $_SESSION['Message_login']=$message;            
            header("location: {$path}");
        }


    }


    
function generateRandomString() 
{
    $length = 14;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>