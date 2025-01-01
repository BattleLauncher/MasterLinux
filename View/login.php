<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <section class="login-form">
        <div class="container">
            <fieldset>
                <legend><h1>Login to Your Account</h1></legend>
                <p>Please login to access your account.</p>

                <!-- Login Form -->
                <form action="login.php" method="POST">
                    <fieldset>
                        <legend>Login Credentials</legend>
                        <table>
                            <tr>
                                <td><label for="email">Email Address:</label></td>
                                <td><input type="email" id="email" name="email" placeholder="Enter your email" required></td>
                            </tr>
                            <tr>
                                <td><label for="password">Password:</label></td>
                                <td><input type="password" id="password" name="password" placeholder="Enter your password" required></td>
                            </tr>
                        </table>
                    </fieldset>

                    <!-- Captcha and Remember Me Section -->
                    <table>
                        <tr>
                            <td><label for="captcha">Captcha: <span>12345</span></label></td>
                            <td><input type="text" id="captcha" name="captcha" placeholder="Enter the code" required></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="remember-me">
                                    <input type="checkbox" id="remember-me" name="remember-me">
                                    <label for="remember-me">Remember me</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left;">
                                <button type="submit" class="btn-login">Login</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <p class="register-link">Don't have an account? <a href="registration.php">Sign Up</a></p>
            </fieldset>
        </div>
    </section>
</body>
</html>
