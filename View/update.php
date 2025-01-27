<?php
// Include the necessary file where the user data is fetched
require_once '../control/update.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="../CSS/update.css">
</head>
<body>
    <section class="update-profile">
        <div class="container">
            <h1>Edit Profile</h1>
            <form action="update.php" method="post" enctype="multipart/form-data">
                <div class="profile-pic-section">
                    <h3>Current Profile Picture</h3>
                    <img src="<?php echo htmlspecialchars($userData['profile_picture'] ?? '../images/default-profile.png'); ?>" 
                         alt="Profile Picture" 
                         style="width:150px; height:150px; border-radius:50%; border: 1px solid #ccc;">
                </div>
                <div class="form-group">
                    <label for="profile_picture">Upload New Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($userData['first_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($userData['last_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($userData['phone']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($userData['location']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="business_name">Business Name</label>
                    <input type="text" id="business_name" name="business_name" value="<?php echo htmlspecialchars($userData['business_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="business_type">Business Type</label>
                    <input type="text" id="business_type" name="business_type" value="<?php echo htmlspecialchars($userData['business_type']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" value="<?php echo htmlspecialchars($userData['password']); ?>" required>
                </div>
                <button type="submit" class="btn">Update Profile</button>
            </form>
        </div>
    </section>
</body>
</html>
