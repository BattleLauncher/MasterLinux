<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>
    <section class="signin-form">
        <div class="container">
            <fieldset>
                <legend><h1>Sign In</h1></legend>
                <p>Enter your credentials to access your account.</p>

                <form action="/submit-signin" method="POST">
                    <table>
                        <tr>
                            <td><label for="email">Email:</label></td>
                            <td><input type="email" id="email" name="email" required></td>
                        </tr>
                        <tr>
                            <td><label for="password">Password:</label></td>
                            <td><input type="password" id="password" name="password" required></td>
                        </tr>
                    </table>

                    <button type="submit">Sign In</button>
                </form>

                <p>Don't have an account? <a href="signup.html">Sign Up</a></p>
            </fieldset>
        </div>
    </section>
</body>
</html>
