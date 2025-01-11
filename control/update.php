<?php
require_once '../Database/Database.php';

// Handle the update operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $gender = htmlspecialchars($_POST['gender']);
    $age = (int)$_POST['age'];
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $location = htmlspecialchars($_POST['location']);
    $business_name = htmlspecialchars($_POST['business_name']);
    $business_type = htmlspecialchars($_POST['business_type']);
    $website_url = htmlspecialchars($_POST['website_url']);
    $password = $_POST['password'];

    // Start SQL query with or without password update
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash password securely
        $sql = "UPDATE customer 
                SET first_name=?, last_name=?, gender=?, age=?, email=?, phone=?, location=?, business_name=?, business_type=?, website_url=?, password=? 
                WHERE id=?";
    } else {
        $sql = "UPDATE customer 
                SET first_name=?, last_name=?, gender=?, age=?, email=?, phone=?, location=?, business_name=?, business_type=?, website_url=? 
                WHERE id=?";
    }

    if ($stmt = $conn->prepare($sql)) {
        if (!empty($password)) {
            $stmt->bind_param("sssiissssssi", $first_name, $last_name, $gender, $age, $email, $phone, $location, $business_name, $business_type, $website_url, $hashed_password, $id);
        } else {
            $stmt->bind_param("sssiisssssi", $first_name, $last_name, $gender, $age, $email, $phone, $location, $business_name, $business_type, $website_url, $id);
        }

        if ($stmt->execute()) {
            echo "<p>Record updated successfully.</p>";
        } else {
            echo "<p>Error updating record: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// Fetch data for the form if user is found
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM customer WHERE id=?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            echo "<p>User not found.</p>";
            exit;
        }

        $stmt->close();
    }
}
?>
