<?php
include '../Database/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an errors array
    $errors = [];

    // Sanitize and validate first name
    $firstName = filter_input(INPUT_POST, 'first-name', FILTER_SANITIZE_STRING);
    if (empty($firstName)) {
        $errors[] = "First name is required.";
    }

    // Sanitize and validate last name
    $lastName = filter_input(INPUT_POST, 'last-name', FILTER_SANITIZE_STRING);
    if (empty($lastName)) {
        $errors[] = "Last name is required.";
    }

    // Validate gender
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    if (empty($gender) || !in_array($gender, ['male', 'female', 'other'])) {
        $errors[] = "Valid gender is required.";
    }

    // Validate age
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, [
        "options" => ["min_range" => 18, "max_range" => 100]
    ]);
    if ($age === false) {
        $errors[] = "Age must be a valid number between 18 and 100.";
    }

    // Validate email
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if ($email === false) {
        $errors[] = "A valid email address is required.";
    }

    // Validate phone number (10-15 digits)
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    if (!preg_match('/^\d{11}$/', $phone)) {
        $errors[] = "Phone number must be between 11 digits.";
    }

    // Sanitize location
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
    if (empty($location)) {
        $errors[] = "Business location is required.";
    }

    // Sanitize and validate business name
    $businessName = filter_input(INPUT_POST, 'business-name', FILTER_SANITIZE_STRING);
    if (empty($businessName)) {
        $errors[] = "Business name is required.";
    }

    // Validate business type
    $businessType = filter_input(INPUT_POST, 'business-type', FILTER_SANITIZE_STRING);
    if (empty($businessType) || !in_array($businessType, ['ecommerce', 'manufacturer', 'service', 'other'])) {
        $errors[] = "Valid business type is required.";
    }

    // Validate password
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    if (empty($password) || strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    } elseif ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    // Validate terms and conditions checkbox
    if (!isset($_POST['terms'])) {
        $errors[] = "You must agree to the Terms and Conditions.";
    }

// Handle profile picture upload
if (isset($_FILES['profile-picture']) && $_FILES['profile-picture']['error'] == 0) {
    $uploadDir = '../uploads/'; // Directory to store uploaded files

    // Ensure the directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $uploadFile = $uploadDir . basename($_FILES['profile-picture']['name']);

    // Validate file type (e.g., only allow images)
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg'];

    if (!in_array($fileType, $allowedTypes)) {
        $errors[] = "Only JPG and JPEG files are allowed for the profile picture.";
    } else {
        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES['profile-picture']['tmp_name'], $uploadFile)) {
            $profile_picture = $uploadFile; // Store file path in $profile_picture
        } else {
            $errors[] = "Failed to upload profile picture. Please check file permissions.";
        }
    }
} else {
    $profile_picture = null; // Set to null if no file uploaded
}


    // Initialize database and customer objects
    $database = new Database();
    $db = $database->getConnection();

    $customer = new Customer($db);

    // If no errors, process the form (e.g., save to database)
    if (empty($errors)) {
        // Prepare data for database
        $data = [
            'id' => null, // Assuming id is auto-incremented
            'first_name' => $firstName,
            'last_name' => $lastName,
            'gender' => $gender,
            'age' => $age,
            'email' => $email,
            'phone' => $phone,
            'location' => $location,
            'business_name' => $businessName,
            'business_type' => $businessType,
            'password' => $password,
            'profile_picture' => $profile_picture
        ];

        if ($customer->insertCustomer($data)) {
            echo "<p class='success-message'>Customer registered successfully!</p>";
        } else {
            echo "<p class='error-message'>Unable to register customer. Please try again.</p>";
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p class='error-message'>$error</p>";
        }
    }
}
?>
