<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <section class="signup-form">
        <div class="container">
            <fieldset>
                <legend><h1>Create Your Account</h1></legend>
                <p>Sign up to join the platform and start promoting your startup.</p>

                <form action="/submit-signup" method="POST">
                    <!-- Personal Information Section -->
                    <fieldset>
                        <legend>Personal Information</legend>
                        <table>
                            <tr>
                                <td><label for="first-name">First Name:</label></td>
                                <td><input type="text" id="first-name" name="first_name" minlength="4" required></td>
                            </tr>
                            <tr>
                                <td><label for="last-name">Last Name:</label></td>
                                <td><input type="text" id="last-name" name="last_name" minlength="4" required></td>
                            </tr>
                            <tr>
                                <td><label for="email">Email:</label></td>
                                <td><input type="email" id="email" name="email" required></td>
                            </tr>
                            <tr>
                                <td><label for="phone">Phone Number:</label></td>
                                <td><input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Enter your 10-digit phone number" required></td>
                            </tr>
                            <tr>
                                <td><label for="password">Password:</label></td>
                                <td><input type="password" id="password" name="password" required></td>
                            </tr>
                            <tr>
                                <td><label for="confirm-password">Confirm Password:</label></td>
                                <td><input type="password" id="confirm-password" name="confirm_password" required></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <!-- Terms and Conditions -->
                    <fieldset>
                        <table>
                            <tr>
                                <td>
                                    <input type="checkbox" id="terms" name="terms" required>
                                    <label for="terms">I agree to the <a href="#">Terms and Conditions</a></label>
                                </td>
                            </tr>
                        </table>
                    </fieldset>

                    <button type="submit">Sign Up</button>
                </form>

                <p>Already have an account? <a href="signin.html">Sign In</a></p>
            </fieldset>
        </div>
    </section>
</body>
</html>
