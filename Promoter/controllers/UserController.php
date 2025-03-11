<?php
require_once '../includes/session.php'; // Include session management
require_once '../models/db.php';
require_once '../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->userModel = new UserModel($db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Registration logic here
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $reenter_password = trim($_POST['reenter_pass']);
            $full_name = trim($_POST['fullName']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $location = trim($_POST['location']);
            $social_media_platform = trim($_POST['socialMediaPlatform']);
            $social_media_handle = trim($_POST['socialMediaHandle']);
            $follower_range = trim($_POST['followerRange']);
            $profile_picture = $_FILES['profilePicture']['name'];
            $bio = trim($_POST['bio']);

            $errors = [];

            // Validation Rules
            if (empty($username)) {
                $errors[] = "Username is required.";
            }
            if (empty($password)) {
                $errors[] = "Password is required.";
            }
            if ($password !== $reenter_password) {
                $errors[] = "Passwords do not match.";
            }
            if (empty($full_name)) {
                $errors[] = "Full name is required.";
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Valid email is required.";
            }
            if (empty($phone) || !is_numeric($phone)) {
                $errors[] = "Phone number must be numeric.";
            }
            if (empty($location)) {
                $errors[] = "Location is required.";
            }
            if (empty($social_media_platform)) {
                $errors[] = "Social media platform is required.";
            }
            if (empty($social_media_handle)) {
                $errors[] = "Social media handle is required.";
            }
            if (empty($follower_range)) {
                $errors[] = "Follower range is required.";
            }
            if ($_FILES['profilePicture']['error'] === UPLOAD_ERR_NO_FILE) {
                $errors[] = "Profile picture is required.";
            } else {
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($_FILES["profilePicture"]["name"]);
                move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file);
            }

            if (empty($errors)) {
                $this->userModel->register($username, $password, $full_name, $email, $phone, $location, $social_media_platform, $social_media_handle, $follower_range, $profile_picture, $bio);
                echo "Registration successful!";
            } else {
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $user = $this->userModel->login($username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                // Redirect to dashboard after successful login
                header("Location: ../views/promoter_dashboard.php");
                exit;
            } else {
                echo "Invalid username or password.";
            }
        }
    }
}
?>