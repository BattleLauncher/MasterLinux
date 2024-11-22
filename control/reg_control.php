<?php
// Initialize variables and error messages
$firstNameErr = $lastNameErr = $emailErr = $phoneErr = $businessTypeErr = "";
$firstName = $lastName = $email = $phone = $businessType = "";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate First Name (at least 4 letters, only alphabetic characters)
    if (empty($_POST["first-name"])) {
        $firstNameErr = "First name is required.";
    } elseif (strlen($_POST["first-name"]) < 4 || !preg_match("/^[a-zA-Z]+$/", $_POST["first-name"])) {
        $firstNameErr = "First name must be at least 4 letters and contain only alphabetic characters.";
    } else {
        $firstName = htmlspecialchars($_POST["first-name"]);
    }

    // Validate Last Name (at least 4 letters, only alphabetic characters)
    if (empty($_POST["last-name"])) {
        $lastNameErr = "Last name is required.";
    } elseif (strlen($_POST["last-name"]) < 4 || !preg_match("/^[a-zA-Z]+$/", $_POST["last-name"])) {
        $lastNameErr = "Last name must be at least 4 letters and contain only alphabetic characters.";
    } else {
        $lastName = htmlspecialchars($_POST["last-name"]);
    }

    // Validate Email (must contain "aiub.edu")
    if (empty($_POST["email"])) {
        $emailErr = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || strpos($_POST["email"], "@aiub.edu") === false) {
        $emailErr = "Please enter a valid email address with aiub.edu domain.";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    // Validate Phone Number (only numbers)
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required.";
    } elseif (!preg_match("/^[0-9]+$/", $_POST["phone"])) {
        $phoneErr = "Phone number must contain only numbers.";
    } else {
        $phone = htmlspecialchars($_POST["phone"]);
    }

    // Validate Business Type (selection required)
    if (empty($_POST["business_type"])) {
        $businessTypeErr = "Please select a business type.";
    } else {
        $businessType = htmlspecialchars($_POST["business_type"]);
    }

    // If no errors, process the form (e.g., save to database, send an email, etc.)
    if (empty($firstNameErr) && empty($lastNameErr) && empty($emailErr) && empty($phoneErr) && empty($businessTypeErr)) {
        // Simulated successful form submission
        echo "Form submitted successfully!";
        // Further processing logic (e.g., database insertion) goes here
    }
}


// Define the path for the JSON file
$data_folder = '../data/';
$json_file = $data_folder . 'userdata.json';

// Ensure the `data` folder exists
if (!is_dir($data_folder)) {
    mkdir($data_folder, 0777, true);
}

// Initialize an array to hold errors and user data
$errors = [];
$user_data = [];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and collect form data
    $user_data['first_name'] = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $user_data['last_name'] = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $user_data['gender'] = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $user_data['age'] = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $user_data['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $user_data['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $user_data['location'] = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
    $user_data['business_name'] = filter_input(INPUT_POST, 'business_name', FILTER_SANITIZE_STRING);
    $user_data['business_type'] = filter_input(INPUT_POST, 'business_type', FILTER_SANITIZE_STRING);
    $user_data['website_url'] = filter_input(INPUT_POST, 'website_url', FILTER_VALIDATE_URL);
    $user_data['password'] = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $captcha = $_POST['captcha'];

    // Password validation
    if ($user_data['password'] !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Captcha validation
    if ($captcha !== '12345') { // Replace '12345' with dynamic captcha if needed
        $errors[] = "Invalid captcha.";
    }

    // Terms and conditions validation
    if (!isset($_POST['terms'])) {
        $errors[] = "You must agree to the terms and conditions.";
    }

    // If no errors, save data
    if (empty($errors)) {
        // Hash the password before saving
        $user_data['password'] = password_hash($user_data['password'], PASSWORD_DEFAULT);

        // Read existing data from JSON file
        $existing_data = [];
        if (file_exists($json_file)) {
            $existing_data = json_decode(file_get_contents($json_file), true) ?? [];
        }

        // Append new user data
        $existing_data[] = $user_data;

        // Write updated data back to the JSON file
        if (file_put_contents($json_file, json_encode($existing_data, JSON_PRETTY_PRINT))) {
            echo "<p>Data successfully saved.</p>";
        } else {
            echo "<p>Failed to save data.</p>";
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>
