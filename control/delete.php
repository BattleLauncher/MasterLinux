<?php
require_once '../Database/Database.php'; // Ensure the path is correct
session_start();

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // Sanitize input: assuming ID is an integer
    $id = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_NUMBER_INT);

    // Validate session and ID
    if (isset($_SESSION['email']) && $_SESSION['id'] === $email) {
        // Create a database object and get the connection
        $database = new Database();
        $db = $database->getConnection();
        
        // Instantiate the Customer object
        $customer = new Customer($db);

        // Attempt to delete the customer by ID
        if ($customer->deleteCustomer($email)) {
            // Destroy session and log the user out
            session_destroy();
            header("Location: login.php"); // Redirect after successful deletion
            exit;
        } else {
            $error_message = "Error: Unable to delete account. Please try again.";
        }
    } else {
        $error_message = "Error: You can only delete your own account.";
    }
}
?>
