<?php
// Database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$database = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $Password=htmlspecialchars($_POST['password']);

    // Insert data into the database
    $sql = "INSERT INTO customer (first_name, last_name, gender, age, email, phone, location, business_name, business_type, website_url,password) 
            VALUES ('$first_name', '$last_name', '$gender', '$age', '$email', '$phone', '$location', '$business_name', '$business_type', '$website_url','$Password')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>New record created successfully</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Fetch data from customer table
$sql = "SELECT first_name, last_name, gender, age, email, phone, location, business_name, business_type, website_url FROM customer";
$result = $conn->query($sql);
?>