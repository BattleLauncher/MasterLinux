<?php
// Include the database connection file
require_once '../Database/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    // Sanitize user input
    $userId = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
    $businessName = filter_input(INPUT_POST, 'business_name', FILTER_SANITIZE_STRING);
    $promotionDetails = filter_input(INPUT_POST, 'promotion_details', FILTER_SANITIZE_STRING);
    $requestedBudget = filter_input(INPUT_POST, 'requested_budget', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    if ($userId && $businessName && $promotionDetails && $requestedBudget) {
        $query = "INSERT INTO promotion_requests (user_id, business_name, promotion_details, requested_budget, status) 
                  VALUES (:user_id, :business_name, :promotion_details, :requested_budget, 'Pending')";

        $stmt = $db->prepare($query);

        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':business_name', $businessName);
        $stmt->bindParam(':promotion_details', $promotionDetails);
        $stmt->bindParam(':requested_budget', $requestedBudget);

        if ($stmt->execute()) {
            echo "Promotion request submitted successfully.";
        } else {
            echo "Error submitting promotion request.";
        }
    } else {
        echo "Invalid input. Please fill all fields.";
    }
}
?>
