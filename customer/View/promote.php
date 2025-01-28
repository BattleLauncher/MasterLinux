<?php
require_once '../control/promote.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/promote.css">

    <title>Promotion Request</title>
</head>
<body>
    <h1>Request Promotion for Your Business</h1>

    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form action="promote.php" method="POST">

        <label for="promotion_details">Promotion Details:</label><br>
        <textarea id="promotion_details" name="promotion_details" rows="5" cols="30" required></textarea><br><br>

        <label for="requested_budget">Requested Budget (BDT):</label><br>
        <input type="number" step="5000" id="requested_budget" name="requested_budget" required><br><br>

        <button type="submit">Submit Request</button>
    </form>
</body>
</html>
