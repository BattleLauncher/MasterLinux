<?php
session_start();
require_once '../model/model.php'; // Customer class is inside this file

// Ensure only admin is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Create DB connection
$database = new Database();
$db = $database->getConnection();

// Create Customer instance
$customerObj = new Customer($db);

// Handle Insert
if (isset($_POST['add_customer'])) {
    $data = [
        'frist_name'     => trim($_POST['frist_name']),
        'last_name'      => trim($_POST['last_name']),
        'gmail'          => trim($_POST['gmail']),
        'phone'          => trim($_POST['phone']),
        'Buissness_name' => trim($_POST['Buissness_name']),
        'type'           => trim($_POST['type']),
        'password'       => trim($_POST['password'])
    ];

    $customerObj->insertCustomer($data);
    header("Location: customer.php"); // prevent form resubmission
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $customerObj->deleteAccount($id);
    header("Location: customer.php");
    exit();
}

// Fetch All Customers
$result = $db->query("SELECT * FROM customer ORDER BY id DESC");
?>