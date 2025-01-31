<?php
session_unset(); // Unset session variables
session_destroy(); // Destroy the session

header("Location: ../view/login.php"); // Correct syntax for redirect
exit(); // Ensure script stops execution after redirection
?>