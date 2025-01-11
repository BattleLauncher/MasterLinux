<?php
require_once '../Database/Database.php'; // Include the Database class

// Instantiate the Database class to create the database connection
$db = new Database(); // Assuming the class is named 'Database' and this is how it is initialized

// Ensure the database connection is established
if (!$db->conn) {
    die("Database connection failed: " . $db->conn->connect_error); // Display connection error
}

// Fetch user data from the database
$sql = "SELECT id, first_name, last_name, email, phone, location, business_name, business_type FROM customer";

// Execute the query and check for errors
$result = $db->conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error executing query: " . $db->conn->error); // Display query execution error
}

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Proceed to output the data in the view
} else {
    echo "No users found.";
}
?>
