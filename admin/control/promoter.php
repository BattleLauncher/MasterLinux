<?php
session_start();
require_once '../model/model.php'; // Promoter class is inside this file

// Ensure only admin is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Create DB connection
$database = new Database();
$db = $database->getConnection();

// Create Promoter instance
$promoterObj = new Promoter($db);

// Handle Insert
if (isset($_POST['add_promoter'])) {
    $data = [
        'name'      => trim($_POST['name']),
        'phone'     => trim($_POST['phone']),
        'gmail'     => trim($_POST['gmail']),
        'password'  => trim($_POST['password']),
        'followers' => intval($_POST['followers']),
        'platform'  => trim($_POST['platform'])
    ];

    $promoterObj->insertPromoter($data);
    header("Location: promoter.php"); // prevent form resubmission
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $promoterObj->deletePromoter($id);
    header("Location: promoter.php");
    exit();
}

// Fetch All Promoters
$result = $db->query("SELECT * FROM promoter ORDER BY id DESC");
?>