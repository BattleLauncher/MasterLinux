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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content_link = trim($_POST['content_link']);
    $proof_file = $_FILES['proof_file']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["proof_file"]["name"]);

    if (move_uploaded_file($_FILES["proof_file"]["tmp_name"], $target_file)) {
        // Update task assignment status and save proof
        $update_query = "UPDATE task_assignments SET completion_status = 'completed', proof_file = ? WHERE task_id = ? AND promoter_id = ?";
        $stmt = $taskController->taskModel->db->prepare($update_query);
        $stmt->bindParam(1, $proof_file);
        $stmt->bindParam(2, $task_id);
        $stmt->bindParam(3, $promoter_id);
        $stmt->execute();

        echo "<p>Task submission successful!</p>";
    } else {
        echo "<p>Error uploading proof file.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Submission</title>
    <link rel="stylesheet" href="../assets/css/task_submission.css">
    <script src="../assets/js/validations.js" defer></script>
</head>
<body>
    <div class="task-submission-container">
        <h2>Submit Task: <?php echo htmlspecialchars($task['title']); ?></h2>
        <form id="submissionForm" method="POST" enctype="multipart/form-data" onsubmit="return validateSubmissionForm()">
            <div class="form-group">
                <label for="content_link">Promotional Content Link:</label>
                <input type="text" id="content_link" name="content_link">
                <p class="error-message" id="contentLinkError"></p>
            </div>
            <div class="form-group">
                <label for="proof_file">Upload Proof File:</label>
                <input type="file" id="proof_file" name="proof_file">
                <p class="error-message" id="proofFileError"></p>
            </div>
            <button type="submit">Submit Task</button>
        </form>
        <p><a href="promoter_dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>