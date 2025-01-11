<?php  
require_once '../Database/Database.php'; 

// Initialize error messages
$errors = [];

// ------------------------
// Registration Section
// ------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Sanitize and validate inputs
    $first_name = filter_input(INPUT_POST, 'first-name', FILTER_SANITIZE_STRING);
    if (empty($first_name) || strlen($first_name) < 4 || !preg_match("/^[a-zA-Z]+$/", $first_name)) {
        $errors[] = "First name must be at least 4 letters and contain only alphabetic characters.";
    }

    $last_name = filter_input(INPUT_POST, 'last-name', FILTER_SANITIZE_STRING);
    if (empty($last_name) || strlen($last_name) < 4 || !preg_match("/^[a-zA-Z]+$/", $last_name)) {
        $errors[] = "Last name must be at least 4 letters and contain only alphabetic characters.";
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if (empty($email) || strpos($email, "@gmail.com") === false) {
        $errors[] = "Please enter a valid email address with gmail.com domain.";
    }

    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    if (empty($phone) || !preg_match("/^[0-9]{11}$/", $phone)) {
        $errors[] = "Phone number must be exactly 11 digits long and contain only numbers.";
    }

    $business_type = filter_input(INPUT_POST, 'business_type', FILTER_SANITIZE_STRING);
    if (empty($business_type)) {
        $errors[] = "Please select a business type.";
    }

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
        $errors[] = "Password must be at least 8 characters long, contain one uppercase letter, and one number.";
    }

    $captcha = $_POST['captcha'];
    if ($captcha !== '12345') { // Replace with dynamic captcha validation
        $errors[] = "Invalid captcha.";
    }

    if (!isset($_POST['terms'])) {
        $errors[] = "You must agree to the terms and conditions.";
    }

    // If no errors, proceed with database insertion
    if (empty($errors)) {
        try {
            $db = new Database();

            // Prepare data for insertion
            $stmt = $db->conn->prepare(
                "INSERT INTO customer (first_name, last_name, email, phone, business_type, password) 
                 VALUES (?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone, $business_type, $password);

            if ($stmt->execute()) {
                echo "Registration successful! Please log in.";
                header("refresh:3;url=login.php");
                exit;
            } else {
                throw new Exception("Failed to register user.");
            }
        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>
