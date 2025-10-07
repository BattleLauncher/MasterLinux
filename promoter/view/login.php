<?php
    require_once '../control/login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>Promoter Login</title>
</head>
<body>
  <div class="container">
    <center><h1 class="form-title">Promoter Login</h1></center>

    <form method="post" action="../control/login.php" novalidate>
      
      <!-- Gmail -->
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="gmail" id="gmail" placeholder=" " required>
        <label for="gmail">Gmail</label>
      </div>

      <!-- Password -->
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder=" " required>
        <label for="password">Password</label>
      </div>

      <!-- Submit -->
      <input type="submit" class="btn" value="Login" name="login">

      <div class="links">
        <p>Don't have an account? <a href="registration.php">Register</a></p>
      </div>
    </form>
  </div>

  <script src="../control/script.js"></script>
</body>
</html>
