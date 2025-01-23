<?php
session_start();

// Include the database connection and Promote class
require_once '../Database/Database.php';
// Initialize database connection
$database = new Database();
$db = $database->getConnection();

$promote = new Promote($db);

// Array to hold error messages
$errors = [];

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p class='error-message'>You must be logged in to submit a promotion request.</p>";
    exit;
}

// Get the user ID from the session
$userId = $_SESSION['user_id'];

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $businessName = filter_input(INPUT_POST, 'business_name', FILTER_SANITIZE_STRING);
    $promotionDetails = filter_input(INPUT_POST, 'promotion_details', FILTER_SANITIZE_STRING);
    $requestedBudget = filter_input(INPUT_POST, 'requested_budget', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Validate required fields
    if (empty($businessName)) {
        $errors[] = "Business name is required.";
    }
    if (empty($promotionDetails)) {
        $errors[] = "Promotion details are required.";
    }
    if (empty($requestedBudget) || $requestedBudget <= 0) {
        $errors[] = "Requested budget must be a positive number.";
    }

    // If no errors, process the form (e.g., save to database)
    if (empty($errors)) {
        // Prepare data for database
        $data = [
            'id' => $userId,
            'business_name' => $businessName,
            'promotion_details' => $promotionDetails,
            'requested_budget' => $requestedBudget
        ];

        // Attempt to save promotion request
        if ($promote->submitPromotionRequest($data)) {
            echo "<p class='success-message'>Promotion request submitted successfully!</p>";
        } else {
            echo "<p class='error-message'>Unable to submit promotion request. Please try again.</p>";
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p class='error-message'>$error</p>";
        }
    }
}
?>
