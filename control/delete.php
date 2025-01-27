<?php
require_once '../Database/Database.php'; // Ensure the path is correct
session_start();

$error_message = '';

// Assuming you are checking the session and comparing the email before calling deleteCustomer

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $email = $_SESSION['email']; // Email from session (already logged-in)

    // Check if the logged-in user is attempting to delete their account
    if ($email === $_SESSION['email']) {
        // Create a database object and get the connection
        $database = new Database();
        $db = $database->getConnection();
        
        // Instantiate the Customer object
        $customer = new Customer($db);
        
        // Attempt to delete the customer by email
        if ($customer->deleteCustomer($email)) {
            // If successful, destroy session and redirect to login page
            session_destroy();
            header("Location: login.php");
            exit;
        } else {
            // Show error message if deletion fails
            $error_message = "Error: Unable to delete account. Please try again.";
        }
    } else {
        // Show message if trying to delete another user's account
        $error_message = "You can only delete your own account.";
    }
}

?>