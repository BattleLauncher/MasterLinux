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
        'password' => '',
        'profile_picture' => '' // Fixed missing comma here
    ];
}

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
    $password = $_POST['password']; 

    // Handle profile picture upload
    $profilePicture = $userData['profile_picture']; // Default to existing profile picture
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/profile_pictures/';
        $uploadFile = $uploadDir . basename($_FILES['profile_pic']['name']);
        $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        // Validate file type
        if (in_array($fileType, ['jpg', 'jpeg'])) {
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadFile)) {
                $profilePicture = basename($_FILES['profile_pic']['name']); // Save file name for DB
            } else {
                echo "Error uploading profile picture.";
                exit();
            }
        } else {
            echo "Invalid file type for profile picture.";
            exit();
        }
    }

    // Update user data in the database
    $query = "UPDATE customer 
              SET first_name = :first_name, last_name = :last_name, email = :email, 
                  phone = :phone, location = :location, business_name = :business_name, 
                  business_type = :business_type, password = :password, profile_picture = :profile_picture 
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
    $stmt->bindParam(':profile_picture', $profilePicture);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
}
?>
