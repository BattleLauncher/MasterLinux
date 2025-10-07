<?php
  require_once '../control/promoter.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Promoter Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/promoter.css">

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="page-container">
  <h1>Promoter Management</h1>
  <p class="description">Manage all registered promoters. Add new promoters or remove existing ones from the system.</p>

  <!-- Back Button -->
  <a class="back-btn" href="profile.php"><i class="fa-solid fa-angles-left">Back to Profile</a></i>

  <!-- Insert Form -->
  <form method="POST" action="">
      <h3>Add New Promoter</h3>
      <input type="text" name="name" placeholder="Name" required>
      <input type="text" name="phone" placeholder="Phone" required>
      <input type="email" name="gmail" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="number" name="followers" placeholder="Followers" required>
      <input type="text" name="platform" placeholder="Platform" required>
      <button type="submit" name="add_promoter">Add Promoter</button>
  </form>

  <!-- Promoter Table -->
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Followers</th>
      <th>Platform</th>
      <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['phone']); ?></td>
        <td><?php echo htmlspecialchars($row['gmail']); ?></td>
        <td><?php echo htmlspecialchars($row['followers']); ?></td>
        <td><?php echo htmlspecialchars($row['platform']); ?></td>
        <td>
          <a class="delete-btn" href="promoter.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this promoter?');">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>
