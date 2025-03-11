<?php
class PaymentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTotalIncome($promoter_id) {
        $query = "SELECT SUM(amount) AS total_income FROM payments JOIN task_assignments ON payments.assignment_id = task_assignments.id WHERE task_assignments.promoter_id = ? AND payments.payment_status = 'paid'";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $promoter_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_income'] ?? 0;
    }

    public function markPaymentAsPaid($assignment_id, $amount) {
        $query = "INSERT INTO payments (assignment_id, amount, payment_status, paid_at) VALUES (?, ?, 'paid', NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $assignment_id);
        $stmt->bindParam(2, $amount);
        $stmt->execute();
    }
}
?>