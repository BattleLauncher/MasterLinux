<?php
session_start();
require_once '../model/model1.php';

// Database connection
$database = new Database();
$db = $database->getConnection();
$customer = new Customer($db);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// If user confirms delete
if (isset($_POST['delete'])) {
    if ($customer->deleteAccount($userId)) {
        // Destroy session and redirect
        session_destroy();
        header("<script>
                setTimeout(function(){
                window.location.href = '../view/login.php';
                        }, 2000);
        </script>");
        exit();
    } else {
        echo "Error: Could not delete account.";
    }
}
?>
