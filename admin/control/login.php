<?php
session_start();
require_once '../model/model.php'; // reuse Database class

$database = new Database();
$db = $database->getConnection();

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM admin WHERE username = ? LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && $admin['password'] === $password) {
        $_SESSION['id'] = $admin['id'];
        $_SESSION['username'] = $admin['username'];
        header("Location: ../view/profile.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}


// Redirect if not logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Handle delete requests
if (isset($_GET['delete_customer'])) {
    $id = intval($_GET['delete_customer']);
    $db->query("DELETE FROM customer WHERE id=$id");
}
if (isset($_GET['delete_promoter'])) {
    $id = intval($_GET['delete_promoter']);
    $db->query("DELETE FROM promoter WHERE id=$id");
}

// Fetch all customers
$customers = $db->query("SELECT * FROM customer");

// Fetch all promoters
$promoters = $db->query("SELECT * FROM promoter");
?>