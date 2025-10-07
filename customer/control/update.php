<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/model1.php';
$database = new Database();
$db = $database->getConnection();

$userId = $_SESSION['user_id'];

// Fetch current user data
$stmt = $db->prepare("SELECT frist_name, last_name, gmail, phone, Buissness_name, type, password FROM customer WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$userData = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$userData) {
    echo "User not found.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $firstName    = trim($_POST['fname']);
    $lastName     = trim($_POST['lname']);
    $email        = filter_var($_POST['gmail'], FILTER_SANITIZE_EMAIL);
    $phone        = trim($_POST['phone']);
    $businessName = trim($_POST['bname']);
    $businessType = trim($_POST['btype']);
    $password     = !empty($_POST['password']) ? $_POST['password'] : $userData['password'];

    $stmt = $db->prepare("UPDATE customer SET frist_name=?, last_name=?, gmail=?, phone=?, Buissness_name=?, type=?, password=? WHERE id=?");
    $stmt->bind_param("sssssssi", $firstName, $lastName, $email, $phone, $businessName, $businessType, $password, $userId);

    if ($stmt->execute()) {
        $stmt->close();

        // Update session data
        $_SESSION['fname'] = $firstName;
        $_SESSION['lname'] = $lastName;
        $_SESSION['gmail'] = $email;
        $_SESSION['bname'] = $businessName;
        $_SESSION['btype'] = $businessType;

        // Redirect to profile.php
        header("Location: ../view/profile.php");
        exit();
    } else {
        echo "Update failed: " . $stmt->error;
        $stmt->close();
    }
}
?>
