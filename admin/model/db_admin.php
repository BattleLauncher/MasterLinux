<?php
class data_insert
{
    function connection()
    {
        $DBHostname = "localhost";
        $DBUsername = "root";
        $DBPassword = "";
        $DBname = "mydatabase";
        
        $connectionObject = new mysqli($DBHostname, $DBUsername, $DBPassword, $DBname);
        
        if ($connectionObject->connect_error) {
            die("Error connecting to DB: " . $connectionObject->connect_error);
        } else {
            echo "Connected Successfully<br>";
        }

        return $connectionObject;  // Return the connection object
    }

    function insert_admin($conobj, $name, $mail, $password, $number, $role, $gender, $nationald, $dob, $joinDate, $startT, $endTime, $referBy, $notification, $lang, $pp)
    {
        if (!$conobj) {
            die("Database connection is not established.");
        }

        $insert = "INSERT INTO Admin (
            add_name, add_email, add_password, add_number, add_role, add_gender, add_nationald,
            add_DOB, add_joinDate, add_startT, add_endTime, add_referBy,
            add_notification, add_lang, add_pp
        ) VALUES (
            '$name', '$mail', '$password', '$number', '$role', '$gender', '$nationald', 
            '$dob', '$joinDate', '$startT', '$endTime', '$referBy', 
            '$notification', '$lang', '$pp'
        )";
    
        if ($conobj->query($insert)) {
            echo "Account created successfully.";
        } else {
            echo "Failed to insert. Error: " . $conobj->error;
        }
    }
}

?>
