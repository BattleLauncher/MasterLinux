<?php
session_start();
require '../controllers/TaskController.php';
require '../controllers/PaymentController.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$promoter_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Fetch tasks for the promoter
$taskController = new TaskController();
$tasks = $taskController->getTasks();

// Calculate total income for the promoter
$paymentController = new PaymentController();
$total_income = $paymentController->getTotalIncome($promoter_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promoter Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="../assets/js/scripts.js" defer></script>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>Your Total Income: $<?php echo number_format($total_income, 2); ?></p>

        <h3>Available Tasks</h3>
        <table class="task-table">
            <thead>
                <tr>
                    <th>Task Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tasks)): ?>
                    <tr>
                        <td colspan="4">No tasks available at the moment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($task['title']); ?></td>
                            <td><?php echo htmlspecialchars($task['description']); ?></td>
                            <td>$<?php echo number_format($task['price'], 2); ?></td>
                            <td>
                                <form method="POST" action="../controllers/TaskController.php" onsubmit="return confirm('Are you sure you want to request this task?');">
                                    <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                    <input type="hidden" name="promoter_id" value="<?php echo $promoter_id; ?>">
                                    <button type="submit" name="assign_task">Request Task</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>