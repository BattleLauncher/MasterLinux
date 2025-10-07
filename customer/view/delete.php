<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="stylesheet" href="../CSS/delete.css">
    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Back button -->
    <a class="back-btn" href="profile.php">Back to Profile</a>

    <!-- Delete card -->
    <div class="delete-card">
        <i class="fas fa-exclamation-triangle"></i>
        <h1>Delete Account</h1>
        <p>This action is permanent and cannot be undone. Please be certain before proceeding.</p>
        <form action="../control/delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
            <button type="submit" name="delete" class="btn">Delete My Account</button>
        </form>
    </div>
</body>
</html>
