
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Super Admin Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <center><h1 class="form-title">Admin Login</h1></center>

    <div class="input-group">

      </div>

    <form method="post" action="../control/login.php" novalidate>
      
      <div class="input-group">
        <i class="fas fa-user-shield"></i>
        <input type="text" name="username" id="username" placeholder=" " required>
        <label for="username">Username</label>
      </div>

      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder=" " required>
        <label for="password">Password</label>
      </div>

      <input type="submit" class="btn" value="Login" name="login">
    </form>
  </div>
</body>
</html>
