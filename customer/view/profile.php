<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<link rel="stylesheet" href="../CSS/pro.css">
</head>
<body>
<header class="header">
    <nav class="navbar">
        <ul>
            <a href="#">Home</a>
            <a href="#">About</a>
        </ul>
    </nav>
    <form action="#" class="searchbar">
        <input type="text" placeholder="Search...">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
</header>

<section id="profile-section">
    <div class="container profile-container" id="profile">

        <!-- Welcome message -->
        <h2 class="profile-title" id="welcome-msg">
            Welcome, <?php echo htmlspecialchars($_SESSION['fname'].' '.$_SESSION['lname']); ?>!
        </h2>

        <!-- Extra description text -->
        <p class="profile-subtext">
            This is your personal profile dashboard. Here you can review your information, 
            update details when needed, or delete your account if you no longer wish to keep it.
        </p>

        <!-- Action buttons -->
        <div class="action-buttons">
            <a href="update.php" class="update-btn" id="update-btn">
              <i class="fas fa-user-edit"></i> Update Profile</a>
            <a href="delete.php" class="delete-btn" id="delete-btn">
              <i class="fa-solid fa-trash"></i> Delete Profile</a>
            <a href="login.php" class="logout-btn" id="logout-btn">
              <i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>

        <!-- Table wrapper -->
        <div class="profile-table-wrapper">
            <table class="profile-table" id="profile-table">
                <tr class="profile-row">
                    <th class="profile-label">Full Name</th>
                    <td class="profile-value">
                        <?php echo htmlspecialchars($_SESSION['fname'] . " " . $_SESSION['lname']); ?>
                    </td>
                </tr>
                <tr class="profile-row">
                    <th class="profile-label">Email</th>
                    <td class="profile-value">
                        <?php echo htmlspecialchars($_SESSION['gmail']); ?>
                    </td>
                </tr>
                <tr class="profile-row">
                    <th class="profile-label">Business</th>
                    <td class="profile-value">
                        <?php echo htmlspecialchars($_SESSION['bname']); ?>
                    </td>
                </tr>
                <tr class="profile-row">
                    <th class="profile-label">Type</th>
                    <td class="profile-value">
                        <?php echo htmlspecialchars($_SESSION['btype']); ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</section>
</body>
</html>
