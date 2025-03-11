<?php
session_start();
require '../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();
    $userController->login();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <script src="../assets/js/validations.js" defer></script>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="loginForm" method="POST" onsubmit="return validateLoginForm()">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <p class="error-message" id="usernameError"></p>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <p class="error-message" id="passwordError"></p>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="registration.php">Register here</a>.</p>
    </div>
</body>
</html>