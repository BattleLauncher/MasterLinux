<?php
// updateProcess.php
require_once '../Database/Database.php';

// Start session to access session variables
session_start();
// Check if $userData is set and is an array, otherwise set default values
if (!isset($userData) || !is_array($userData)) {
    $userData = [
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'phone' => '',
        'location' => '',
        'business_name' => '',
        'business_type' => '',
        'password' => ''
    ];}
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Initialize the Database class
$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get POST data
    $userId = $_SESSION['user_id']; // User ID from session
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $businessName = $_POST['business_name'];
    $businessType = $_POST['business_type'];
    $password = $_POST['password']; // Don't forget to hash the password before saving it

    // Update user data in the database
    $query = "UPDATE customer 
              SET first_name = :first_name, last_name = :last_name, email = :email, 
                  phone = :phone, location = :location, business_name = :business_name, 
                  business_type = :business_type, password = :password 
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
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    
    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Redirect back to the dashboard with success message
        header("Location: Dashboard.php?message=Profile updated successfully");
        exit();
    } else {
        echo "Error updating profile. Please try again.";
    }
}
?>
