<?php
session_start();
require_once "../model/model.php";

// Redirect if not logged in
if (!isset($_SESSION['promoter_id'])) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$promoterId = $_SESSION['promoter_id'];

// Fetch requests for this promoter
$query = "SELECT c.frist_name, c.last_name, r.message, r.created_at, r.status
          FROM promoter_request r
          JOIN customer c ON r.customer_id = c.id
          WHERE r.promoter_id = ?
          ORDER BY r.created_at DESC";

$stmt = $db->prepare($query);
$stmt->bind_param("i", $promoterId);
$stmt->execute();
$requests = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Requests</title>
  <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
  <header class="header">
    <nav class="navbar">
      <ul>
        <a href="dashboard.php">Dashboard</a>
        <a href="requests.php">Requests</a>
        <a href="logout.php">Logout</a>
      </ul>
    </nav>
  </header>

  <section class="container">
    <h2>Customer Requests</h2>

    <?php if ($requests->num_rows > 0): ?>
      <ul class="request-list">
        <?php while($row = $requests->fetch_assoc()): ?>
          <li>
            <strong><?php echo htmlspecialchars($row['frist_name']." ".$row['last_name']); ?></strong>
            requested promotion.<br>
            <em><?php echo htmlspecialchars($row['message']); ?></em><br>
            <small>Requested at: <?php echo $row['created_at']; ?></small><br>
            <span>Status: <b><?php echo ucfirst($row['status']); ?></b></span>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p>No new requests.</p>
    <?php endif; ?>
  </section>
</body>
</html>
