<?php
require_once '../Database/Database.php';
session_start(); // Start the session to access session variables

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $email = $_POST['email'];

    // Check if the user is logged in and if the email matches their own
    if (isset($_SESSION['user_email']) && $_SESSION['user_email'] === $email) {
        // Initialize database connection
        $database = new Database();
        $db = $database->getConnection();

        // Initialize Customer object
        $customer = new Customer($db);

        // Attempt to delete the account
        if ($customer->deleteCustomer($email)) {
            echo "<p class='message'>Account successfully deleted.</p>";
            // Optionally, log the user out after deleting their account
            session_destroy();
        } else {
            echo "<p class='message'>Error: Account could not be deleted. Please try again.</p>";
        }
    } else {
        echo "<p class='message'>Error: You can only delete your own account.</p>";
    }
} else {
    echo "<p class='message'>Invalid request.</p>";
}
?>
