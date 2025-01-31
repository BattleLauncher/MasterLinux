<?php

include('../model/profile_model.php');
$gobj = new GetData();
$gconobj = $gobj->connection();
if(isset($_SESSION))
{
$data = $gobj->get_profiledata($gconobj, 'admin', $_SESSION['id']);
if ($data->num_rows > 0)
{
    $row = $data->fetch_assoc();
    $_SESSION['id']= $row['add_id'];
    $_SESSION['name']= $row['add_name'];
    $_SESSION['email']= $row['add_email'];
    $_SESSION['number']= $row['add_number'];
    $_SESSION['role']= $row['add_role'];
    $_SESSION['gender']= $row['add_gender'];
    $_SESSION['dob']= $row['add_DOB'];
    $_SESSION['nid']= $row['add_nationald'];
    $_SESSION['joindate']= $row['add_joinDate'];
    $_SESSION['starttime']= $row['add_startT'];
    $_SESSION['endtime']= $row['add_endTime'];
    $_SESSION['referby']= $row['add_referBy'];
    $_SESSION['pp']= $row['add_pp'];
} 
else 
{
    echo 'Faild to get data';
}


if(isset($_POST['edit']))
{
    header('location: ../view/editprofile_view.php');
}
else if(isset($_POST['delete']))
{
    
    if($gobj->delete($gconobj, 'admin', $_SESSION['id']))
    {
        session_unset();
        session_destroy();
        header('location: ../view/Registration.php');
    }
    else
    {
        echo "Error: " . $gobj->error;
        
    }

}
}

?>