<?php
// Start session only if it hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if not logged in
if (!isset($_SESSION['promoter_id'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/model.php';
$database = new Database();
$db = $database->getConnection();

$promoterId = $_SESSION['promoter_id'];

// Fetch current promoter data
$stmt = $db->prepare("SELECT name, phone, gmail, followers, platform, password FROM promoter WHERE id = ?");
$stmt->bind_param("i", $promoterId);
$stmt->execute();
$userData = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$userData) {
    echo "Promoter not found.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $name       = trim($_POST['name']);
    $phone      = trim($_POST['phone']);
    $gmail      = filter_var($_POST['gmail'], FILTER_SANITIZE_EMAIL);
    $followers  = (int) $_POST['followers'];
    $platform   = trim($_POST['platform']);
    $password   = !empty($_POST['password']) ? $_POST['password'] : $userData['password'];

    $stmt = $db->prepare("UPDATE promoter SET name=?, phone=?, gmail=?, followers=?, platform=?, password=? WHERE id=?");
    $stmt->bind_param("sssissi", $name, $phone, $gmail, $followers, $platform, $password, $promoterId);

    if ($stmt->execute()) {
        $stmt->close();

        // Update session variables
        $_SESSION['promoter_name']      = $name;
        $_SESSION['promoter_gmail']     = $gmail;
        $_SESSION['promoter_phone']     = $phone;
        $_SESSION['promoter_followers'] = $followers;
        $_SESSION['promoter_platform']  = $platform;

        // Redirect to dashboard
        header("Location: ../view/dashboard.php");
        exit();
    } else {
        echo "Update failed: " . $stmt->error;
        $stmt->close();
    }
}
?>
