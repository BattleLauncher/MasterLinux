<?php
require_once '../Database/Database.php'; // Ensure the path is correct
session_start();

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $email = $_SESSION['email']; // Email from session

    // Create a database object and get the connection
    $database = new Database();
    $db = $database->getConnection();
    
    // Instantiate the Customer object
    $customer = new Customer($db);
    
    // Attempt to delete the customer by email
    if ($customer->deleteCustomer($email)) {
        session_destroy(); // Destroy the session
        header("Location: login.php"); // Redirect to login page
        exit;
    } else {
        $error_message = "Error: Unable to delete account. Please try again.";
    }
}
?>
