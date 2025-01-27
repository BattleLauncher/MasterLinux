<?php
session_start();
require_once '../Database/Database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    exit("<p class='error-message'>You must be logged in to submit a promotion request.</p>");
}

// Process the form if it is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $promotionDetails = filter_input(INPUT_POST, 'promotion_details', FILTER_SANITIZE_STRING);
    $requestedBudget = filter_input(INPUT_POST, 'requested_budget', FILTER_VALIDATE_FLOAT);

    // Validate inputs
    if (!empty($promotionDetails) && $requestedBudget && $requestedBudget > 0) {
        try {
            // Initialize database connection and promote object
            $database = new Database();
            $db = $database->getConnection();
            $promote = new Promote($db);

            // Add the logged-in user's ID to the data
            $userId = $_SESSION['user_id']; // Correctly set user ID
            $data = [
                'promotion_details' => $promotionDetails,
                'requested_budget' => $requestedBudget,
            ];

            // Attempt to submit the promotion request
            if ($promote->submitPromotionRequest($data, $userId)) { // Pass $userId
                echo "<p class='success-message'>Promotion request submitted successfully!</p>";
            } else {
                echo "<p class='error-message'>Unable to submit promotion request. Please try again.</p>";
            }
        } catch (Exception $e) {
            echo "<p class='error-message'>An error occurred: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p class='error-message'>Please provide valid promotion details and a positive budget.</p>";
    }
}
?>
