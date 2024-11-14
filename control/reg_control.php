<?php
// Initialize variables and error messages
$nameErr = $emailErr = $phoneErr = $businessTypeErr = "";
$name = $email = $phone = $businessType = "";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name (at least 4 characters)
    if (empty($_POST["name"]) || strlen($_POST["name"]) < 4) {
        $nameErr = "Name should be at least 4 characters long.";
    } else {
        $name = htmlspecialchars($_POST["name"]);
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
        $businessType = $_POST["business_type"];
    }

    // If no errors, process the form (e.g., save to database, send an email, etc.)
    if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($businessTypeErr)) {
        // Process form data (for example, save to database)
        // echo "Form submitted successfully!";
    }
}
?>