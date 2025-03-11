<?php
require_once '../models/db.php';
require_once '../models/TaskModel.php';

class TaskController {
    private $taskModel;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->taskModel = new TaskModel($db);
    }

    // Fetch all pending tasks for promoters
    public function getTasks() {
        $tasks = $this->taskModel->getTasks();
        return $tasks;
    }

    // Assign a task to a promoter
    public function assignTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task_id = trim($_POST['task_id']);
            $promoter_id = trim($_POST['promoter_id']);

            $errors = [];

            if (empty($task_id) || !is_numeric($task_id)) {
                $errors[] = "Invalid task ID.";
            }
            if (empty($promoter_id) || !is_numeric($promoter_id)) {
                $errors[] = "Invalid promoter ID.";
            }

            if (empty($errors)) {
                $this->taskModel->assignTask($task_id, $promoter_id);
                echo "Task assigned successfully!";
            } else {
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
        }
    }

    // Update task status (e.g., approve or reject)
    public function updateTaskStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $assignment_id = trim($_POST['assignment_id']);
            $status = trim($_POST['status']); // e.g., 'approved', 'rejected'

            $errors = [];

            if (empty($assignment_id) || !is_numeric($assignment_id)) {
                $errors[] = "Invalid assignment ID.";
            }
            if (!in_array($status, ['approved', 'rejected'])) {
                $errors[] = "Invalid status.";
            }

            if (empty($errors)) {
                $query = "UPDATE task_assignments SET approval_status = ? WHERE id = ?";
                $stmt = $this->taskModel->db->prepare($query);
                $stmt->bindParam(1, $status);
                $stmt->bindParam(2, $assignment_id);
                $stmt->execute();
                echo "Task status updated successfully!";
            } else {
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
        }
    }
}
?>