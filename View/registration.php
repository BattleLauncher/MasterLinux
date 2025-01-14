<?php 
require_once '../control/reg_control.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/registration.css">
    <title>Create Startup Account</title>
</head>
<body>
    <section class="registration-form">
        <div class="container">
            <h1>Create Your Startup Account</h1>
            <p>Join our platform to promote and increase your sales.</p>
            
            <form action="registration.php" method="post" enctype="multipart/form-data">

                <!-- Personal Information Section -->
                <fieldset>
                    <legend>Personal Information</legend>
                    <div class="form-group">
                        <label for="first-name">First Name:</label>
                        <input type="text" id="first-name" name="first-name" required>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name:</label>
                        <input type="text" id="last-name" name="last-name" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select id="gender" name="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" id="age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" required>
                    </div>
                </fieldset>

                <!-- Business Information Section -->
                <fieldset>
                    <legend>Business Information</legend>
                    <div class="form-group">
                        <label for="business-name">Business Name:</label>
                        <input type="text" id="business-name" name="business-name" required>
                    </div>
                    <div class="form-group">
                        <label for="business-type">Business Type:</label>
                        <select id="business-type" name="business-type" required>
                            <option value="ecommerce">E-commerce</option>
                            <option value="manufacturer">Product Manufacturer</option>
                            <option value="service">Service Provider</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </fieldset>

                <!-- Password Section -->
                <fieldset>
                    <legend>Password Setup</legend>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password:</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                </fieldset>
                <div class="form-group">
                <b>
                    <input type="checkbox" id="terms" name="terms" required>
                    I agree to the Terms and Conditions
                </b>
            </div>


                <div class="form-group">
                    <button type="submit" class="btn-register">Submit</button>
                </div>
            </form>

            <p class="login-link">Already have an account? <a href="login.php">Login</a></p>

            <div class="footer-links">
                <a href="#">Privacy Policy</a> | 
                <a href="#">Terms of Service</a> | 
                <a href="#">Help Center</a>
            </div>
        </div>
    </section>
</body>
</html>
