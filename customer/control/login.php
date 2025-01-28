<?php
// Start the session to manage user session
session_start();

// Example: Set user_id after successful login

// Include the database and Login class
require_once '../Database/Database.php';

// Initialize database connection
$db = (new Database())->getConnection();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get user input from the login form
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Validate the input
    if (!empty($email) && !empty($password)) {
        // Create an instance of the Login class
        $login = new Login($db);

        // Attempt to validate credentials
        if ($login->validateCredentials($email, $password)) {
            // Store user data in session variables (assumes validateCredentials sets session)
            $_SESSION['user_id'] = $login->getUserId();
            $_SESSION['first_name'] = $login->getFirstName();

            // Redirect to the dashboard after successful login
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Invalid login credentials. Please try again.";
        }
    } else {
        $error_message = "Please fill in all required fields.";
    }
}
?>