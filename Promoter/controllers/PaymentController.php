<?php
require_once '../models/db.php';
require_once '../models/PaymentModel.php';

class PaymentController {
    private $paymentModel;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->paymentModel = new PaymentModel($db);
    }

    // Calculate total income for a promoter
    public function getTotalIncome() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $promoter_id = trim($_GET['promoter_id']);

            $errors = [];

            if (empty($promoter_id) || !is_numeric($promoter_id)) {
                $errors[] = "Invalid promoter ID.";
            }

            if (empty($errors)) {
                $total_income = $this->paymentModel->getTotalIncome($promoter_id);
                echo "Total Income: $" . number_format($total_income, 2);
            } else {
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
        }
    }

    // Mark a payment as paid
    public function markPaymentAsPaid() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $assignment_id = trim($_POST['assignment_id']);
            $amount = trim($_POST['amount']);

            $errors = [];

            if (empty($assignment_id) || !is_numeric($assignment_id)) {
                $errors[] = "Invalid assignment ID.";
            }
            if (empty($amount) || !is_numeric($amount) || $amount <= 0) {
                $errors[] = "Invalid payment amount.";
            }

            if (empty($errors)) {
                $this->paymentModel->markPaymentAsPaid($assignment_id, $amount);
                echo "Payment marked as paid successfully!";
            } else {
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
        }
    }
}
?>