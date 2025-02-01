<?php
include('../model/editprofile_model.php');


if (isset($_POST['submit']))
{
    $gobj = new data_update(); // Use the correct class name
    $gconobj = $gobj->connection(); // Get the database connection

    
    
    
     if (empty($_POST['password']) || !preg_match("/[0-9]/", $_POST['password']))
    {
        echo "<p>user name: ".$_POST['username']."<br></p>";
        echo "<p>mail     : ".$_POST['email']."<br></p>";
        echo "<p>Password is required and must contain at least one numeric character</p><br>";
    }
    else if ($_POST['password'] != $_POST['confirm_password']) 
    {
        
        echo "<p>Password and Confirm must be same</p><br>";
    }
    

    else
    {
        if(!empty(basename($_FILES['profile_picture']['name'])))
        {
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif']; // Add WEBP and AVI to allowed extensions
            $file_extension = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));

            if (in_array($file_extension, $allowed_extensions)) 
            {
                $target_dir_pp = '../file/images/';
                $target_file_pp =  $target_dir_pp.$_SESSION['name'].basename($_FILES["profile_picture"]["name"]);
                if(move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file_pp)) 
                {
                    //echo "The file ". basename($_FILES["profile_picture"]["name"])." has been uploaded.";
                }
                else
                {
                    $target_file_pp= '';
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            else
            {
                $target_file_pp= " ";
                //echo "Drop test type must be pdf".'<br>';
            }
            
        }
        else
        {
            $target_file_pp= " ";
        }
        
        $obj = new data_update();
        $conobj = $obj->connection();
        $obj->update_admin(
            $conobj,
            $_SESSION['id'],
            $_POST['email'], 
            $_POST['password'], 
            $_POST['phone_number'],
            $_POST['working_time_start'],
            $_POST['working_time_end'],
            $target_file_pp // Assuming this field is handled properly in your form
        );
        header('../view/admin_profile.php');
    }
    
}
else if(isset($_POST['login']))
{
    header( 'location: login.php');
}
?>