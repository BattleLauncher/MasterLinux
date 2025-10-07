<?php
require_once '../control/registration.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>Promoter Registration</title>
</head>
<body>
  <div class="container">
    <center><h1 class="form-title">Promoter Registration</h1></center>
    
    <form method="post" action="../control/registration.php" novalidate>

        <div class="input-group">
        
      </div>

      <!-- Full Name -->
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="name" id="name" placeholder=" " required>
        <label for="name">Full Name</label>
      </div>

      <!-- Phone -->
      <div class="input-group">
        <i class="fas fa-phone"></i>
        <input type="tel" name="phone" id="phone" placeholder=" " required>
        <label for="phone">Phone Number</label>
      </div>

      <!-- Gmail -->
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="gmail" id="gmail" placeholder=" " required>
        <label for="gmail">Gmail</label>
      </div>

      <!-- Influencer Followers -->
      <div class="input-group">
        <i class="fas fa-users"></i>
        <input type="number" name="followers" id="followers" placeholder=" " required>
        <label for="followers">Number of Followers</label>
      </div>

      <!-- Platform -->
      <div class="select-group">
        <i class="fa-solid fa-cloud"></i>
        <select name="platform" id="platform" required>
          <option value="" disabled selected hidden>Select Platform</option>
          <option value="YouTube">YouTube</option>
          <option value="Facebook">Facebook</option>
          <option value="Instagram">Instagram</option>
        </select>
      </div>

        <!-- Password -->
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder=" " required>
            <label for="password">Password</label>
        </div>

      <!-- Submit -->
      <input type="submit" class="btn" value="Register" name="register">
    </form>

    <div class="links">
      <p>Already registered? <a href="login.php">Login</a></p>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="../control/script.js"></script>
</body>
</html>
