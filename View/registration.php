<?php
// Include the PHP validation script from the 'control' folder
require_once '../control/reg_control.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Create Startup Account</title>
</head>
<body>
    <section class="registration-form">
        <div class="container">
            <fieldset>
                <legend><h1>Create Your Startup Account</h1></legend>
                <p>Join our platform to promote and increase your sales.</p>

                <!-- Begin form with corrected structure -->
                <form action="registration.php" method="post" enctype="multipart/form-data">

                    <!-- Personal Information Section with Fieldset and Legend -->
                    <fieldset>
                        <legend>Personal Information</legend>
                        <table>
                            <tr>
                                <td><label for="first-name">First Name:</label></td>
                                <td><input type="text" id="first-name" name="first-name" placeholder="Enter your first name" value="<?php echo isset($_POST['first-name']) ? $_POST['first-name'] : ''; ?>" required></td>
                            </tr>
                            <tr>
                                <td><label for="last-name">Last Name:</label></td>
                                <td><input type="text" id="last-name" name="last-name" placeholder="Enter your last name" value="<?php echo isset($_POST['last-name']) ? $_POST['last-name'] : ''; ?>" required></td>
                            </tr>
                            <tr>
                                <td><label for="gender">Gender:</label></td>
                                <td>
                                    <select id="gender" name="gender" required>
                                        <option value="male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                        <option value="female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                        <option value="other" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="age">Age:</label></td>
                                <td><input type="number" id="age" name="age" placeholder="Enter your age" value="<?php echo isset($_POST['age']) ? $_POST['age'] : ''; ?>" required></td>
                            </tr>
                            <tr>
                                <td><label for="email">Email Address:</label></td>
                                <td><input type="email" id="email" name="email" placeholder="Enter your email address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required></td>
                            </tr>
                            <tr>
                                <td><label for="phone">Phone Number:</label></td>
                                <td><input type="tel" id="phone" name="phone" placeholder="Enter your contact number" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" required></td>
                            </tr>
                            <tr>
                                <td><label for="location">Location:</label></td>
                                <td><input type="text" id="location" name="location" placeholder="Enter your business location" value="<?php echo isset($_POST['location']) ? $_POST['location'] : ''; ?>" required></td>
                            </tr>
                        </table>
                    </fieldset>

                    <!-- Business Information Section -->
                    <fieldset>
                        <legend>Business Information</legend>
                        <table>
                            <tr>
                                <td><label for="business-name">Business Name:</label></td>
                                <td><input type="text" id="business-name" name="business-name" placeholder="Enter your startup/business name" value="<?php echo isset($_POST['business-name']) ? $_POST['business-name'] : ''; ?>" required></td>
                            </tr>
                            <tr>
                                <td><label for="business-type">Business Type:</label></td>
                                <td>
                                    <select id="business-type" name="business-type" required>
                                        <option value="ecommerce" <?php echo (isset($_POST['business-type']) && $_POST['business-type'] == 'ecommerce') ? 'selected' : ''; ?>>E-commerce</option>
                                        <option value="manufacturer" <?php echo (isset($_POST['business-type']) && $_POST['business-type'] == 'manufacturer') ? 'selected' : ''; ?>>Product Manufacturer</option>
                                        <option value="service" <?php echo (isset($_POST['business-type']) && $_POST['business-type'] == 'service') ? 'selected' : ''; ?>>Service Provider</option>
                                        <option value="other" <?php echo (isset($_POST['business-type']) && $_POST['business-type'] == 'other') ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="website-url">Website URL (Optional):</label></td>
                                <td><input type="url" id="website-url" name="website-url" placeholder="Enter your website URL (if applicable)" value="<?php echo isset($_POST['website-url']) ? $_POST['website-url'] : ''; ?>"></td>
                            </tr>
                        </table>
                    </fieldset>

                    <!-- Password Section with Fieldset and Legend -->
                    <fieldset>
                        <legend>Password Setup</legend>
                        <table>
                            <tr>
                                <td><label for="password">Password:</label></td>
                                <td><input type="password" id="password" name="password" placeholder="Create a strong password" required></td>
                            </tr>
                            <tr>
                                <td><label for="confirm-password">Confirm Password:</label></td>
                                <td><input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required></td>
                            </tr>
                        </table>
                    </fieldset>
                        
                    <!-- Captcha and Terms -->
                    <table>
                        <tr>
                            <td><label for="captcha">Captcha: <span>12345</span></label></td>
                            <td><input type="text" id="captcha" name="captcha" placeholder="Enter the code" required></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="agreement">
                                    <input type="checkbox" id="terms" name="terms" required>
                                    <label for="terms">I agree to the Terms and Conditions</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left;">
                                <button type="submit" class="btn-register">Submit</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
            </fieldset>

            <!-- Footer Links Section Below the Form -->
            <div class="footer-links">
                <a href="#">Privacy Policy</a> | 
                <a href="#">Terms of Service</a> | 
                <a href="#">Help Center</a>
            </div>
        </div>
    </section>
</body>
</html>
