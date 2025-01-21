<?php
// View/deleteAccount.php
require_once '../control/Dashboard.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
</head>
<body>
    <section class="dashboard">
        <div class="container">
            <h1>Welcome, <?php echo htmlspecialchars($first_name).' ' . htmlspecialchars($last_name); ?>!</h1>
            <p>Your business: <strong><?php echo htmlspecialchars($business_name); ?></strong></p>
            <p>Your business type: <strong><?php echo htmlspecialchars($business_type); ?></strong></p>

            <h2>Profile Information</h2>
            <table>
                <tr>
                    <th>User ID</th>
                    <td><?php echo htmlspecialchars($id)?></td>
                </tr>
                <tr>
                    <th>Full Name</th>
                    <td><?php echo htmlspecialchars($first_name) . ' ' . htmlspecialchars($last_name); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($email); ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php echo htmlspecialchars($phone); ?></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><?php echo htmlspecialchars($location); ?></td>
                </tr>
            </table>

            <h2>Business Details</h2>
            <table>
                <tr>
                    <th>Business Name</th>
                    <td><?php echo htmlspecialchars($business_name); ?></td>
                </tr>
                <tr>
                    <th>Business Type</th>
                    <td><?php echo htmlspecialchars($business_type); ?></td>
                </tr>
            </table>

            <div>
             <center><p><a href="promote.php" class="btn">Promote</a>  <a href="delete.php?email=<?php echo $email; ?>" class="btn">  Delete Account</a>  <a href="update.php" class="btn">  Edit Profile</a></p><center>
            </div>

            <div class="logout-section">
                <p><a href="login.php" class="btn-logout">Logout</a></p>
            </div>
        </div>
    </section>
</body>
</html>
