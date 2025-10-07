<?php
require_once '../model/model.php';
session_start();

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

    // Ensure all required fields are provided
    $required_fields = ['name', 'phone', 'gmail', 'followers', 'platform', 'password'];
    $missing_fields = array_diff($required_fields, array_keys($_POST));

    if (empty($missing_fields)) {
        $promoter = new Promoter($db);

        // Trim and sanitize inputs
        $data = [
            'name'      => trim($_POST['name']),
            'phone'     => trim($_POST['phone']),
            'gmail'     => trim($_POST['gmail']),
            'password'  => trim($_POST['password']), // consider password_hash() for security
            'followers' => (int) $_POST['followers'],
            'platform'  => trim($_POST['platform'])
        ];

        $result = $promoter->insertPromoter($data);

        if ($result === true) {
            echo "<center>Signup successful. Redirecting to login...</center>";
            echo "<script>
                    setTimeout(function(){
                        window.location.href = '../view/login.php';
                    }, 2000);
                  </script>";
        } else {
            echo "<center>Signup failed: " . htmlspecialchars($result) . "</center>";
        }

    } else {
        // Some required fields are missing
        echo "<center>Please fill in all required fields.</center>";
        echo "<script>
                setTimeout(function(){
                    window.location.href = '../view/promoter_signup.php';
                }, 2000);
              </script>";
    }
}
?>
