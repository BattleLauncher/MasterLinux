<?php
require_once '../model/model1.php';
session_start();

// Create database connection
$database = new Database();
$db = $database->getConnection();

// Handle SIGN IN
if (isset($_POST['signin'])) {
    $login = new Login($db);

    $gmail    = trim($_POST['gmail']);
    $password = trim($_POST['password']);

    if ($login->validateCredentials($gmail, $password)) {
        // ✅ validateCredentials() already sets session values
        header("Location: ../view/profile.php");
        exit();
    } else {
        echo "<center>Invalid Gmail or password and Try again.....</center>
        <script>
                setTimeout(function(){
                window.location.href = '../view/login.php';
                        }, 2000);
        </script>";
    }
}
?>
        