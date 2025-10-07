<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <title>Sign Up</title>
</head>
<body>
  <div class="container">
    <center><h1 class="form-title">Sign Up</h1></center>
    <form method="post" action="../control/registration.php" novalidate>

      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="fname" id="fname" placeholder=" " required>
        <label for="fname">First Name</label>
      </div>

      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="lname" id="lname" placeholder=" " required>
        <label for="lname">Last Name</label>
      </div>

      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="gmail" id="gmail" placeholder=" " required>
        <label for="gmail">Gmail</label>
      </div>

      <div class="input-group">
        <i class="fas fa-phone"></i>
        <input type="tel" name="phone" id="phone" placeholder=" " required>
        <label for="phone">Contact Number</label>
      </div>

      <div class="input-group">
        <i class="fas fa-tag"></i>
        <input type="text" name="bname" id="bname" placeholder=" " required>
        <label for="bname">Business Name</label>
      </div>

      <div class="select-group">
        <i class="fas fa-building"></i>
        <select name="btype" id="btype" required>
          <option value="" disabled selected hidden></option>
          <option value="E-commerce">E-commerce</option>
          <option value="manufacturer">Manufacturer</option>
          <option value="service">Service</option>
          <option value="others">Others</option>
        </select>
      </div>

      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder=" " required>
        <label for="password">Password</label>
      </div>

      <input type="submit" class="btn" value="Signup" name="signup">
    </form>

    <div class="links">
      <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
  </div>

  <!-- Include your JavaScript at the end of the body -->
  <script src="../control/script.js"></script>
</body>
</html>
