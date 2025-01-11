<?php
// View/deleteAccount.php
require_once '../control/delete.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h2>Delete Account</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Enter your email" required><br><br>
        <button type="submit" name="delete">Delete Account</button>
    </form>
</body>
</html>
