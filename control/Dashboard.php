<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection
require_once '../Database/Database.php';

// Create a database connection
$database = new Database();
$db = $database->getConnection();

// Fetch user data
$query = "SELECT * FROM customer WHERE id = :id LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user data is retrieved successfully
if ($user) {
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $email = $user['email'];
    $phone = $user['phone'];
    $location = $user['location'];
    $business_name = $user['business_name'];
    $business_type = $user['business_type'];
} else {
    echo "User data not found.";
    exit();
}
?>