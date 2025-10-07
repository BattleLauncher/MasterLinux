<?php
session_start();
session_destroy();
header("../view/login.php"); // or back to your signin page
exit();
