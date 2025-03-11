<?php
session_start();
require '../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();
    $userController->register();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../assets/css/registration.css">
    <script src="../assets/js/validations.js" defer></script>
</head>
<body>
    <div class="registration-container">
        <h2>Register as a Promoter</h2>
        <form id="registrationForm" method="POST" enctype="multipart/form-data" onsubmit="return validateRegistrationForm()">
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
            <div class="form-group">
                <label for="reenter_pass">Re-enter Password:</label>
                <input type="password" id="reenter_pass" name="reenter_pass">
                <p class="error-message" id="reenterPassError"></p>
            </div>
            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName">
                <p class="error-message" id="fullNameError"></p>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <p class="error-message" id="emailError"></p>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone">
                <p class="error-message" id="phoneError"></p>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location">
                <p class="error-message" id="locationError"></p>
            </div>
            <div class="form-group">
                <label for="socialMediaPlatform">Social Media Platform:</label>
                <select id="socialMediaPlatform" name="socialMediaPlatform">
                    <option value="">Select Platform</option>
                    <option value="Instagram">Instagram</option>
                    <option value="YouTube">YouTube</option>
                    <option value="TikTok">TikTok</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Twitter">Twitter (X)</option>
                    <option value="Snapchat">Snapchat</option>
                    <option value="Pinterest">Pinterest</option>
                    <option value="Blog/Website">Blog/Website</option>
                    <option value="LinkedIn">LinkedIn</option>
                    <option value="Email Marketing">Email Marketing</option>
                    <option value="WhatsApp">WhatsApp</option>
                    <option value="Other">Other</option>
                </select>
                <p class="error-message" id="socialMediaPlatformError"></p>
            </div>
            <div class="form-group">
                <label for="socialMediaHandle">Social Media Handle:</label>
                <input type="text" id="socialMediaHandle" name="socialMediaHandle">
                <p class="error-message" id="socialMediaHandleError"></p>
            </div>
            <div class="form-group">
                <label for="followerRange">Follower Range:</label>
                <select id="followerRange" name="followerRange">
                    <option value="">Select Range</option>
                    <option value="0-1k">0-1k</option>
                    <option value="1k-10k">1k-10k</option>
                    <option value="10k-50k">10k-50k</option>
                    <option value="50k-100k">50k-100k</option>
                    <option value="100k+">100k+</option>
                </select>
                <p class="error-message" id="followerRangeError"></p>
            </div>
            <div class="form-group">
                <label for="profilePicture">Profile Picture:</label>
                <input type="file" id="profilePicture" name="profilePicture">
                <p class="error-message" id="profilePictureError"></p>
            </div>
            <div class="form-group">
                <label for="bio">Short Bio:</label>
                <textarea id="bio" name="bio" rows="4"></textarea>
                <p class="error-message" id="bioError"></p>
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>