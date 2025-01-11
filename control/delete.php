<?php
session_start();
require_once '../Database/Database.php';

if (!isset($_SESSION['user_email'])) {
    header('Location: login.php');
    exit;
}

$data_folder = '../data/';
$json_file = $data_folder . 'userdata.json';

$users = json_decode(file_get_contents($json_file), true);
$email = $_POST['email'] ?? '';

foreach ($users as $index => $u) {
    if ($u['email'] === $email) {
        unset($users[$index]);
        file_put_contents($json_file, json_encode(array_values($users), JSON_PRETTY_PRINT));
        session_destroy();
        echo "Account deleted successfully!";
        header('refresh:2;url=login.php');
        exit;
    }
}

echo "Failed to delete the account.";
?>
