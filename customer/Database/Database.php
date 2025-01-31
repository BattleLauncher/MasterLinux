<?php
class Database {
    private $host = "localhost";
    private $db_name = "database";
    private $username = "root";
    private $password = "";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

class Customer {
    private $conn;
    private $table_name = "customer";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insertCustomer($data) {
        $query = "INSERT INTO " . $this->table_name . " (id, first_name, last_name, gender, age, email, phone, location, business_name, business_type, password, profile_picture) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isssisssssss", $data['id'], $data['first_name'], $data['last_name'], $data['gender'], $data['age'], $data['email'], $data['phone'], $data['location'], $data['business_name'], $data['business_type'], $data['password'], $data['profile_picture']);
        return $stmt->execute();
    }

    public function deleteCustomer($email) {
        $query = "DELETE FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        return $stmt->execute();
    }
}

class Login {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function validateCredentials($email, $password) {
        $query = "SELECT id, first_name, email, password FROM customer WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && $password === $user['password']) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            return true;
        }
        return false;
    }
}

class Promote {
    private $conn;
    private $table_name = "customer";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function submitPromotionRequest($data, $userId) {
        $query = "UPDATE {$this->table_name} SET promotion_details = ?, requested_budget = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $data['promotion_details'], $data['requested_budget'], $userId);
        return $stmt->execute();
    }
}

?>
