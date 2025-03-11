<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class SessionManager {
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public static function getUserRole() {
        return $_SESSION['role'] ?? null;
    }

    public static function logout() {
        session_destroy();
        header("Location: ../views/login.php");
        exit;
    }
}
?>