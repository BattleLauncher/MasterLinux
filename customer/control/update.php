<?php
// Start session to access session variables
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
require_once '../Database/Database.php';
$database = new Database();
$conn = $database->getConnection();

// Fetch user data from the database
$userId = $_SESSION['user_id'];
$query = "SELECT first_name, last_name, email, phone, location, business_name, business_type, profile_picture, password FROM customer WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

// Check if user data was fetched
if (!$userData) {
    echo "User data not found.";
    exit();
}

// If form is submitted, update the user data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);
    $businessName = trim($_POST['business_name']);
    $businessType = trim($_POST['business_type']);
    $password = $_POST['password'];

    // Handle file upload for profile picture
    $profilePicture = $userData['profile_picture']; // Default to existing image
    if (!empty($_FILES['profile_picture']['name']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['profile_picture']['tmp_name']);

        if (in_array($fileType, $allowedTypes)) {
            $targetDir = "../uploads/";
            $profilePicture = $targetDir . basename($_FILES['profile_picture']['name']);
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicture);
        } else {
            echo "Invalid image format. Only JPG, PNG, and GIF are allowed.";
            exit();
        }
    }

    // Use the new password only if provided; otherwise, keep the old one
    $updatedPassword = !empty($password) ? $password : $userData['password'];

    // Prepare update query
    $query = "UPDATE customer SET 
              first_name = ?, 
              last_name = ?, 
              email = ?, 
              phone = ?, 
              location = ?, 
              business_name = ?, 
              business_type = ?, 
              profile_picture = ?, 
              password = ? 
              WHERE id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssi", $firstName, $lastName, $email, $phone, $location, $businessName, $businessType, $profilePicture, $updatedPassword, $userId);

    // Execute the query and check for success
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Failed to update user data.";
        error_log("Update failed: " . $stmt->error);
    }
}
?>
