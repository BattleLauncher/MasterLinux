<?php
require_once '../control/login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>
    <section class="login-form">
        <div class="container">
            <form action="login.php" method="post">
                <fieldset class="login-fieldset">
                <center><legend><h1>Login</h1></legend></center>
                    <?php if (!empty($error_message)): ?>
                        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn-login">Login</button>
                </fieldset>
            </form>
            <p>Don't have an account? <a href="registration.php">Register here</a>.</p>
        </div>
    </section>
</body>
</html>
