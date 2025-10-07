<?php
session_start();
require_once '../model/model.php';

$conn = (new Database())->getConnection();

if (isset($_POST['login'])) {
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];

    // Use prepared statement for security
    $stmt = $conn->prepare("SELECT * FROM promoter WHERE gmail = ? LIMIT 1");
    $stmt->bind_param("s", $gmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Plain text password comparison (change to password_verify if hashed)
        if ($row['password'] === $password) {
            $_SESSION['promoter_id'] = $row['id'];
            $_SESSION['promoter_name'] = $row['name'];
            $_SESSION['promoter_gmail'] = $row['gmail'];
            $_SESSION['promoter_phone'] = $row['phone'];
            $_SESSION['promoter_followers'] = $row['followers'];
            $_SESSION['promoter_platform'] = $row['platform'];
            $_SESSION['logged_in'] = true;

            echo "<script>
                    window.location.href='../view/dashboard.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Incorrect password!');
                    window.location.href='../view/login.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Gmail not found!');
                window.location.href='../view/login.php';
              </script>";
    }
}

$conn->close();
?>
