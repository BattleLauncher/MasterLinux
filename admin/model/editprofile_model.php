<?php
class data_update
{
    function connection()
    {
        $DBHostname = "localhost";
        $DBUsername = "root";
        $DBPassword = "";
        $DBname = "database";
        $connectionObject = new mysqli($DBHostname, $DBUsername, $DBPassword, $DBname);
        
        if ($connectionObject->connect_error) {
            echo "Error connecting to DB: " . $connectionObject->error;
        }
        return $connectionObject;
    }

    function update_admin($conobj, $id,$mail, $password, $number,  $startT, $endTime, $pp)
    {
        if (!$conobj->connect_error) 
        {
            $update = "UPDATE Admin 
           SET add_email = '$mail', add_password = '$password', add_number = '$number', 
               add_startT = '$startT', add_endTime = '$endTime', add_pp = '$pp'
           WHERE add_id = '$id'";  

        
            if ($conobj->query($update)) 
            {
            } 
            else 
            {
                echo "Failed to update. Error: " . $conobj->error;
            }
        } 
        else 
        {
            echo $conobj->error;
        }
    }
    
}
?>