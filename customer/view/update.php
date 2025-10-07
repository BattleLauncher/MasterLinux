
<?php 
require_once "../control/update.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="../CSS/update.css">
  <title>Update Profile</title>
</head>
<body>
  <a class="back-btn" href="profile.php">Back to Profile</a>
  <div class="container">
    <center><h1 class="form-title">Update Profile</h1></center>
    <form method="post" action="../control/update.php" novalidate>

      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="fname" id="fname" 
               value="<?php echo htmlspecialchars($userData['frist_name']); ?>" required>
        <label for="fname">First Name</label>
      </div>

      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="lname" id="lname" 
               value="<?php echo htmlspecialchars($userData['last_name']); ?>" required>
        <label for="lname">Last Name</label>
      </div>

      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="gmail" id="gmail" 
               value="<?php echo htmlspecialchars($userData['gmail']); ?>" required>
        <label for="gmail">Email</label>
      </div>

      <div class="input-group">
        <i class="fas fa-phone"></i>
        <input type="tel" name="phone" id="phone" 
               value="<?php echo htmlspecialchars($userData['phone']); ?>">
        <label for="phone">Contact Number</label>
      </div>

      <div class="input-group">
        <i class="fas fa-tag"></i>
        <input type="text" name="bname" id="bname" 
               value="<?php echo htmlspecialchars($userData['Buissness_name']); ?>">
        <label for="bname">Business Name</label>
      </div>

      <div class="select-group">
        <i class="fas fa-building"></i>
        <select name="btype" id="btype" required>
          <option value="E-commerce" <?php if($userData['type']=="E-commerce") echo "selected"; ?>>E-commerce</option>
          <option value="manufacturer" <?php if($userData['type']=="manufacturer") echo "selected"; ?>>Manufacturer</option>
          <option value="service" <?php if($userData['type']=="service") echo "selected"; ?>>Service</option>
          <option value="others" <?php if($userData['type']=="others") echo "selected"; ?>>Others</option>
        </select>
      </div>

      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Leave blank to keep current password">
        <label for="password">Password</label>
      </div>

      <input type="submit" class="btn" value="Update Profile" name="update">
    </form>
  </div>
</body>
</html>