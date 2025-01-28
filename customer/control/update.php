<?php
// Start session to access session variables
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
require_once '../Database/Database.php'; // Ensure the correct path for your Database.php
$database = new Database();
$conn = $database->getConnection();

// Fetch user data from the database
$userId = $_SESSION['user_id'];
$query = "SELECT first_name, last_name, email, phone, location, business_name, business_type, profile_picture, password FROM customer WHERE id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();

$userData = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user data was fetched
if (!$userData) {
    echo "User data not found.";
    exit();
}

// If form is submitted, update the user data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect updated data from the form
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $businessName = $_POST['business_name'];
    $businessType = $_POST['business_type'];
    $password = $_POST['password'];

    // Handle file upload for profile picture
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "../uploads/"; // Ensure this directory exists and is writable
        $profilePicture = $targetDir . basename($_FILES['profile_picture']['name']);
        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicture)) {
            echo "Failed to upload profile picture.";
            exit();
        }
    } else {
        $profilePicture = $userData['profile_picture']; // Retain the existing picture if no new upload
    }

    // Prepare update query
    $query = "UPDATE customer SET 
              first_name = :first_name, 
              last_name = :last_name, 
              email = :email, 
              phone = :phone, 
              location = :location, 
              business_name = :business_name, 
              business_type = :business_type, 
              profile_picture = :profile_picture, 
              password = :password 
              WHERE id = :user_id";

    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':business_name', $businessName);
    $stmt->bindParam(':business_type', $businessType);
    $stmt->bindParam(':profile_picture', $profilePicture);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

    // Execute the query and check for success
    if ($stmt->execute()) {
        // Redirect to dashboard.php after successful update
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Failed to update user data.";
        error_log("Update failed: " . print_r($stmt->errorInfo(), true));
    }
}
?>
