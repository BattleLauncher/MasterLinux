<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/profile.css">
  <title>Super Admin Dashboard</title>
  
</head>
<body>
  <div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>You are logged in as <strong>Super Admin</strong>.</p>
    <p class="description">
      From this dashboard, you can manage promoters, customers, and system settings. Use the buttons below to navigate to the respective sections. Make sure to handle administrative actions carefully.
    </p>

    <div class="hr"></div>

    <div class="actions">
      <a href="login.php" class="logout">Logout</a>
      <a href="promoter.php" class="btn">Promoter</a>
      <a href="customer.php" class="btn">Customer</a>
    </div>
  </div>
</body>
</html>
