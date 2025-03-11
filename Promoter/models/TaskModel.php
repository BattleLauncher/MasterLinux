<?php
class TaskModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTasks() {
        $query = "SELECT * FROM tasks WHERE status = 'pending'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function assignTask($task_id, $promoter_id) {
        $query = "INSERT INTO task_assignments (task_id, promoter_id, approval_status, completion_status) VALUES (?, ?, 'pending', 'in_progress')";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $task_id);
        $stmt->bindParam(2, $promoter_id);
        $stmt->execute();
    }
}
?>