<?php
require_once '../model/model1.php';
session_start();

// Create database connection
$database = new Database();
$db = $database->getConnection();

// Handle SIGN UP
if (isset($_POST['signup'])) {
    // Make sure required POST fields exist
    if (isset($_POST['fname'], $_POST['lname'], $_POST['gmail'], $_POST['phone'], $_POST['bname'], $_POST['btype'], $_POST['password'])) {

        $customer = new Customer($db);

        $profile_pic_name = null; // default if no file uploaded

        // Prepare data for insertion
        $data = [
            'frist_name'     => trim($_POST['fname']),
            'last_name'      => trim($_POST['lname']),
            'gmail'          => trim($_POST['gmail']),
            'phone'          => trim($_POST['phone']),
            'Buissness_name' => trim($_POST['bname']),
            'type'           => trim($_POST['btype']),
            'password'       => trim($_POST['password']), // ideally hash this
        ];

        $result = $customer->insertCustomer($data);

                if ($result === true) {
                echo "<center>Signup successful. Redirecting to login...</center>";
                echo "<script>
                        setTimeout(function(){
                            window.location.href = '../view/login.php';
                        }, 2000);
                    </script>";
            } else {
                echo "Signup failed: " . $result;
            }


    } else {
        echo "Please fill in all required fields.
        <script>
                setTimeout(function(){
                window.location.href = '../view/registration.php';
                    }, 2000);
        </script>";
    }
}
?>
