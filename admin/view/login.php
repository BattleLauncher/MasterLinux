<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <!-- Linking External CSS -->
        <link rel="stylesheet" type="text/css" href="../css/logincss.css">
    </head>
    <body>

        <form method="POST" onsubmit="return validLogin()">
            <h2>Welcome to promoting company</h2>
            <h3 id="ids">Please log in to access your account</h3><br>
            <table>
                <tr>
                    <td class="title">Email:</td>
                    <td><input type="text" id="email" name="email" class="input"></td> 
                </tr>
                <tr>
                    <td></td>
                    <td id="emailError" class="error"></td>
                </tr>
                <tr>
                    <td class="title">Password:</td>
                    <td><input type="password" id="password" name="password" class="input"></td>
                </tr>
                <tr>
                    <td></td>
                    <td id="passwordError" class="error"></td>
                </tr>
            </table>
            
            <button type="submit" name="login" id="login" class="login">Login</button>
            <button type="submit"  name="signup" id="signup" class="signup">Signup</button>
        </form>

    </body>
</html>

<?php
    include('../control/login_control.php');
?>
