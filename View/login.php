<?php
// Include the PHP validation script from the 'control' folder
require_once '../control/login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Login to Your Account</title>
</head>
<body>
    <section class="login-form">
        <div class="container">
            <fieldset>
                <legend><h1>Login to Your Account</h1></legend>
                <p>Welcome back! Please login to access your account and manage your business.</p>

                <!-- Begin login form -->
                <form action="login.php" method="post">

                    <!-- Login Credentials Section -->
                    <fieldset>
                        <legend>Login Information</legend>
                        <table>
                            <tr>
                                <td><label for="email">Email Address:</label></td>
                                <td><input type="email" id="email" name="email" placeholder="Enter your email address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required></td>
                            </tr>
                            <tr>
                                <td><label for="password">Password:</label></td>
                                <td><input type="password" id="password" name="password" placeholder="Enter your password" required></td>
                            </tr>
                        </table>
                    </fieldset>

                    <!-- Captcha (Optional) -->
                    <table>
                        <tr>
                            <td><label for="captcha">Captcha: <span>12345</span></label></td>
                            <td><input type="text" id="captcha" name="captcha" placeholder="Enter the code" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left;">
                                <button type="submit" class="btn-login">Login</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <p class="register-link">Don't have an account? <a href="registration.php">Register</a></p>
            </fieldset>
        </div>
    </section>
</body>
</html>
