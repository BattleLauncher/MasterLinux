<?php
session_start();
require '../controllers/TaskController.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$promoter_id = $_SESSION['user_id'];

// Fetch task details based on task ID
if (!isset($_GET['task_id']) || empty($_GET['task_id'])) {
    header("Location: promoter_dashboard.php");
    exit;
}

$task_id = $_GET['task_id'];
$taskController = new TaskController();

// Fetch the task details from the database
$query = "SELECT * FROM tasks WHERE id = ?";
$stmt = $taskController->taskModel->db->prepare($query);
$stmt->bindParam(1, $task_id);
$stmt->execute();
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    header("Location: promoter_dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <link rel="stylesheet" href="../assets/css/task_details.css">
    <script src="../assets/js/scripts.js" defer></script>
</head>
<body>
    <div class="task-details-container">
        <h2>Task Details</h2>
        <div class="task-info">
            <p><strong>Title:</strong> <?php echo htmlspecialchars($task['title']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($task['description']); ?></p>
            <p><strong>Price:</strong> $<?php echo number_format($task['price'], 2); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($task['status']); ?></p>
        </div>

        <h3>Request Approval</h3>
        <form method="POST" action="../controllers/TaskController.php" onsubmit="return confirm('Are you sure you want to request approval for this task?');">
            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
            <input type="hidden" name="promoter_id" value="<?php echo $promoter_id; ?>">
            <button type="submit" name="assign_task">Request Approval</button>
        </form>

        <p><a href="promoter_dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>