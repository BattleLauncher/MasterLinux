<?php
// View/updateForm.php
require_once '../control/update.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
</head>
<body>

<?php if (isset($user)): ?>
    <h2>Update Customer Information</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>" />
        
        <label>First Name:</label><br>
        <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required><br><br>

        <label>Gender:</label><br>
        <input type="text" name="gender" value="<?= htmlspecialchars($user['gender']) ?>" required><br><br>

        <label>Age:</label><br>
        <input type="number" name="age" value="<?= $user['age'] ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required><br><br>

        <label>Location:</label><br>
        <input type="text" name="location" value="<?= htmlspecialchars($user['location']) ?>" required><br><br>

        <label>Business Name:</label><br>
        <input type="text" name="business_name" value="<?= htmlspecialchars($user['business_name']) ?>" required><br><br>

        <label>Business Type:</label><br>
        <input type="text" name="business_type" value="<?= htmlspecialchars($user['business_type']) ?>" required><br><br>

        <label>Website URL:</label><br>
        <input type="url" name="website_url" value="<?= htmlspecialchars($user['website_url']) ?>" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" value="<?= htmlspecialchars($user['password']) ?>" required><br><br>

        <input type="submit" name="update" value="Update">
    </form>
<?php else: ?>
    <p>No user found to update.</p>
<?php endif; ?>

</body>
</html>
