<?php
// View/deleteAccount.php
require_once '../control/delete.php'; // Ensure the path is correct

// Initialize the error message
$error_message = $error_message ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css"> <!-- Link to your CSS file -->
    <title>Delete Account</title>
</head>
<body>
    <section class="delete-account-form">
        <div class="container">
            <form method="POST" action="delete.php">
                <fieldset class="delete-fieldset">
                    <legend><h2>Delete Account</h2></legend>
                    
                    <!-- Display Error Message -->
                    <?php if (!empty($error_message)): ?>
                        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
                    <?php endif; ?>

                    <!-- Form Fields -->
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <button type="submit" name="delete" class="btn-delete">Delete Account</button>
                </fieldset>
            </form>
            
            <p>Changed your mind? <a href="login.php">Log in here</a>.</p>
        </div>
    </section>
</body>
</html>
