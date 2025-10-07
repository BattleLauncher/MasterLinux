<?php require_once '../control/login.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <title>Login</title>
</head>
<body>
  <div class="container">
    <center><h1 class="form-title">Sign In</h1></center>
    <form method="post" action="../control/login.php" novalidate>
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="gmail" placeholder="Gmail" required>
        <label for="gmail">Gmail</label>
      </div>

      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
        <label for="password">Password</label>

      </div>

      <input type="submit" class="btn" value="Signin" name="signin">
    </form>

    <div class="links">
      <p>Don't have an account? <a href="registration.php">Sign Up</a></p>
    </div>
  </div>
  <script src="../control/script.js"></script>
</body>
</html>
