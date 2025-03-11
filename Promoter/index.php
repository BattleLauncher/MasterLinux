<?php
require './includes/session.php';

if (SessionManager::isLoggedIn()) {
    // Redirect to dashboard if logged in
    header("Location: views/promoter_dashboard.php");
    exit;
} else {
    // Redirect to login page if not logged in
    header("Location: views/login.php");
    exit;
}
?>