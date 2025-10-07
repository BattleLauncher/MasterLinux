<?php
require_once '../control/update.php'; // Make sure this sets $userData
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>Update Profile</title>
</head>
<body>
  <div class="container">
    <center><h1 class="form-title">Update Profile</h1></center>

    <form method="post" action="../control/update.php" enctype="multipart/form-data" novalidate>

      <!-- Full Name -->
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="name" id="name" placeholder=" " 
               value="<?php echo htmlspecialchars($userData['name']); ?>" required>
        <label for="name">Full Name</label>
      </div>

      <!-- Phone -->
      <div class="input-group">
        <i class="fas fa-phone"></i>
        <input type="tel" name="phone" id="phone" placeholder=" " 
               value="<?php echo htmlspecialchars($userData['phone']); ?>" required>
        <label for="phone">Phone Number</label>
      </div>

      <!-- Gmail -->
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="gmail" id="gmail" placeholder=" " 
               value="<?php echo htmlspecialchars($userData['gmail']); ?>" required>
        <label for="gmail">Gmail</label>
      </div>

      <!-- Influencer Followers -->
      <div class="input-group">
        <i class="fas fa-users"></i>
        <input type="number" name="followers" id="followers" placeholder=" " 
               value="<?php echo htmlspecialchars($userData['followers']); ?>" required>
        <label for="followers">Number of Followers</label>
      </div>

      <!-- Platform -->
      <div class="select-group">
        <i class="fa-solid fa-cloud"></i>
        <select name="platform" id="platform" required>
          <option value="" disabled hidden>Select Platform</option>
          <option value="YouTube" <?php if($userData['platform'] == "YouTube") echo "selected"; ?>>YouTube</option>
          <option value="Facebook" <?php if($userData['platform'] == "Facebook") echo "selected"; ?>>Facebook</option>
          <option value="Instagram" <?php if($userData['platform'] == "Instagram") echo "selected"; ?>>Instagram</option>
        </select>
      </div>

      <!-- Password -->
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Leave blank to keep current password">
        <label for="password">Password</label>
      </div>

      <!-- Submit -->
      <input type="submit" class="btn" value="Update Profile" name="update">
    </form>
  </div>

  <script src="../control/script.js"></script>
</body>
</html>
