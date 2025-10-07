<?php
  require_once '../control/customer.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Customer Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/customer.css">
<!-- Font Awesome for back icon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="page-container">
  <h1>Customer Management</h1>
  <p class="description">Manage all registered customers. You can add new customers or remove existing ones from the system.</p>

  <!-- Back Button -->
  <a class="back-btn" href="profile.php">Back to Profile</a>

  <!-- Insert Form -->
  <form method="POST" action="">
      <h3>Add New Customer</h3>
      <input type="text" name="frist_name" placeholder="First Name" required>
      <input type="text" name="last_name" placeholder="Last Name" required>
      <input type="email" name="gmail" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Phone" required>
      <input type="text" name="Buissness_name" placeholder="Business Name" required>
      <select name="type" required>
        <option value="">Select Type</option>
        <option value="Retail">Retail</option>
        <option value="Wholesale">Wholesale</option>
        <option value="Other">Other</option>
      </select>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="add_customer">Add Customer</button>
  </form>

  <!-- Customer Table -->
  <table>
    <tr>
      <th>ID</th>
      <th>First</th>
      <th>Last</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Business</th>
      <th>Type</th>
      <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['Id']; ?></td>
        <td><?php echo htmlspecialchars($row['frist_name']); ?></td>
        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
        <td><?php echo htmlspecialchars($row['gmail']); ?></td>
        <td><?php echo htmlspecialchars($row['phone']); ?></td>
        <td><?php echo htmlspecialchars($row['Buissness_name']); ?></td>
        <td><?php echo htmlspecialchars($row['type']); ?></td>
        <td>
          <a class="delete-btn" href="customer.php?delete=<?php echo $row['Id']; ?>" onclick="return confirm('Delete this customer?');">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>
