<?php
class GetData
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
    public function get_profiledata($conobj, $table, $id)
    {
        $stmt = $conobj->prepare("SELECT * FROM $table WHERE add_id = $id");

        if (!$stmt) {
            die("Query preparation failed: " . $conobj->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result; 
        } else {
            return false; 
        }
    }
  
    public function delete($conobj, $table, $id)
    {
        $stmt = $conobj->prepare("DELETE FROM $table WHERE add_id = $id");

        if (!$stmt) {
            die("Query preparation failed: " . $conobj->error);
        }
        $stmt->execute();
    }
}


?>