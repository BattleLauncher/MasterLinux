<?php

session_start();
include('../model/login_db.php');
$obj = new loginVerify();
$con = $obj->connection();
if(isset($_POST['login']))
{
    if(empty($_POST['email']))
    {
        echo "<p>Email can not be empty</p>";
    }
    else if(empty($_POST['password']))
    {
        echo "password can not be empty";
    }
    else if(! $obj->get_mail($con, 'admin', $_POST['email']))
    {
        $_SESSION['email'];
        echo 'Email does not exist';
    }
    else if(!$obj->verify_pass($con, 'admin', $_POST['email'], $_POST['password']))
    {
        
        
        echo 'Wrong password';
        session_destroy();
    }
    else
    {
        $result = $obj->verify_pass($con, 'admin', $_POST['email'], $_POST['password']);
        if ($result->num_rows > 0) 
        {
            
            $row = $result->fetch_assoc();
            $_SESSION['id']= $row['add_id'];
            $_SESSION['email']= $row['add_id'];
            header('Location: ../view/profile_view.php');
        } 
    }
}

else if(isset($_POST['signup']))
{
    header('Location:Registration.php');

}