<?php 
session_start(); 

// Redirect if not logged in
if (!isset($_SESSION['promoter_id'])) {
    header("Location: login.php");
    exit();
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promoter Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="../css/profile.css">
</head>
<body>

<header class="header">
  <nav class="navbar">
    <ul>
      <a href="#">Home</a>
      <a href="#">About</a>
    </ul>
  </nav>
</header>

<section id="dashboard-section" class="container">
  <div class="container dashboard-container" id="dashboard">

    <!-- Welcome message -->
    <h2 class="profile-title" id="welcome-msg">
      Welcome, <?php echo htmlspecialchars($_SESSION['promoter_name']); ?>!
    </h2>

    <!-- Logout button -->
    <a href="login.php" class="logout-btn" id="logout-btn">
      <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>

    <!-- Update profile button -->
    <a href="update.php" class="update-btn" id="update-btn">
      <i class="fas fa-user-edit"></i> Update Profile
    </a>
        <!-- Request button top-right -->
            <a href="request.php" class="delete-btn" id="delete-btn">
             <i class="fa-solid fa-bell"></i>Request</a>

    <!-- Profile table -->
    <div class="profile-table-wrapper">
      <table class="profile-table" id="profile-table">
        <tr class="profile-row">
          <th class="profile-label">Full Name</th>
          <td class="profile-value"><?php echo htmlspecialchars($_SESSION['promoter_name']); ?></td>
        </tr>
        <tr class="profile-row">
          <th class="profile-label">Gmail</th>
          <td class="profile-value"><?php echo htmlspecialchars($_SESSION['promoter_gmail']); ?></td>
        </tr>
        <tr class="profile-row">
          <th class="profile-label">Phone</th>
          <td class="profile-value"><?php echo htmlspecialchars($_SESSION['promoter_phone']); ?></td>
        </tr>
        <tr class="profile-row">
          <th class="profile-label">Followers</th>
          <td class="profile-value"><?php echo htmlspecialchars($_SESSION['promoter_followers']); ?></td>
        </tr>
        <tr class="profile-row">
          <th class="profile-label">Platform</th>
          <td class="profile-value"><?php echo htmlspecialchars($_SESSION['promoter_platform']); ?></td>
        </tr>
      </table>
    </div>
  </div>
</section>

</body>
</html>
