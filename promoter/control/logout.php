<?php
session_start();
session_destroy();
header("Location: ../view/login.php"); // redirect to login page
exit();
?>
