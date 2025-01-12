<?php

require_once '../Database/Database.php';
// Initialize variables for error messages
$emailErr = $passwordErr = $captchaErr = "";

// Initialize variables to store form data (in case of errors, we'll retain the input)
$email = $password = $captcha = "";

// Define a correct captcha for validation (you can update this as per your requirement)
$correctCaptcha = "12345";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate email address
    if (empty($_POST["email"])) {
        $emailErr = "Email is required.";
    } else {
        // Sanitize and validate email
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format.";
        }
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required.";
    } else {
        $password = $_POST["password"];
    }

    // Validate captcha
    if (empty($_POST["captcha"])) {
        $captchaErr = "Captcha is required.";
    } else {
        $captcha = $_POST["captcha"];
        if ($captcha != $correctCaptcha) {
            $captchaErr = "Incorrect captcha.";
        }
    }

    // If no errors, proceed with further actions (e.g., database check)
    if (empty($emailErr) && empty($passwordErr) && empty($captchaErr)) {
        // Here, you would usually query the database to check if the email and password are correct
        // For simplicity, we assume login is successful if the email and password are correct.

        // Example validation (replace with actual database check)
        $storedPassword = "password123"; // Example password, this should come from your database

        if ($password == $storedPassword) {
            // Redirect to the dashboard or another page upon successful login
            header("Location: dashboard.php");
            exit();
        } else {
            $passwordErr = "Incorrect email or password.";
        }
    }
}
?>