<?php
require_once 'Database.php';

// Initialize variables and error messages
$errors = [];
$user_data = [];
$data_folder = '../data/';
$json_file = $data_folder . 'userdata.json';

// Ensure the `data` folder exists
if (!is_dir($data_folder)) {
    mkdir($data_folder, 0777, true);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $user_data['first_name'] = filter_input(INPUT_POST, 'first-name', FILTER_SANITIZE_STRING);
    if (empty($user_data['first_name']) || strlen($user_data['first_name']) < 4 || !preg_match("/^[a-zA-Z]+$/", $user_data['first_name'])) {
        $errors[] = "First name must be at least 4 letters and contain only alphabetic characters.";
    }

    $user_data['last_name'] = filter_input(INPUT_POST, 'last-name', FILTER_SANITIZE_STRING);
    if (empty($user_data['last_name']) || strlen($user_data['last_name']) < 4 || !preg_match("/^[a-zA-Z]+$/", $user_data['last_name'])) {
        $errors[] = "Last name must be at least 4 letters and contain only alphabetic characters.";
    }

    $user_data['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if (empty($user_data['email']) || strpos($user_data['email'], "@aiub.edu") === false) {
        $errors[] = "Please enter a valid email address with aiub.edu domain.";
    }

    $user_data['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    if (empty($user_data['phone']) || !preg_match("/^[0-9]+$/", $user_data['phone'])) {
        $errors[] = "Phone number must contain only numbers.";
    }

    $user_data['business_type'] = filter_input(INPUT_POST, 'business_type', FILTER_SANITIZE_STRING);
    if (empty($user_data['business_type'])) {
        $errors[] = "Please select a business type.";
    }

    $user_data['password'] = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($user_data['password'] !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    $captcha = $_POST['captcha'];
    if ($captcha !== '12345') { // Replace with dynamic captcha validation if needed
        $errors[] = "Invalid captcha.";
    }

    if (!isset($_POST['terms'])) {
        $errors[] = "You must agree to the terms and conditions.";
    }

    // If no errors, save data
    if (empty($errors)) {
        // Read existing data from JSON file
        $existing_data = [];
        if (file_exists($json_file)) {
            $existing_data = json_decode(file_get_contents($json_file), true) ?? [];
        }

        // Append new user data
        $existing_data[] = $user_data;

        // Write updated data back to the JSON file
        if (file_put_contents($json_file, json_encode($existing_data, JSON_PRETTY_PRINT))) {
            echo "<p style='color:green;'>Data successfully saved.</p>";
        } else {
            echo "<p style='color:red;'>Failed to save data.</p>";
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>
