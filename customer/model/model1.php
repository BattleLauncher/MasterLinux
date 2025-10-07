<?php
class Database {
    private $host = "localhost";
    private $db_name = "data store"; 
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

    // Insert new customer (Sign Up)
    public function insertCustomer($data) {
        $query = "INSERT INTO {$this->table_name} 
                  (frist_name, last_name, gmail, phone, Buissness_name, type, password) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            return "Prepare failed: " . $this->conn->error;
        }

        $stmt->bind_param(
            "sssssss", 
            $data['frist_name'], 
            $data['last_name'], 
            $data['gmail'], 
            $data['phone'], 
            $data['Buissness_name'], 
            $data['type'], 
            $data['password']
        );

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $error = $stmt->error;
            $stmt->close();
            return "Error: " . $error;
        }
    }

    // Update customer
    public function updateCustomer($id, $data) {
        if (!empty($data['password'])) {
            $query = "UPDATE {$this->table_name} 
                      SET frist_name=?, last_name=?, gmail=?, phone=?, Buissness_name=?, type=?, password=? 
                      WHERE id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param(
                "sssssssi", 
                $data['frist_name'], 
                $data['last_name'], 
                $data['gmail'], 
                $data['phone'], 
                $data['Buissness_name'], 
                $data['type'], 
                $data['password'], 
                $id
            );
        } else {
            $query = "UPDATE {$this->table_name} 
                      SET frist_name=?, last_name=?, gmail=?, phone=?, Buissness_name=?, type=? 
                      WHERE id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param(
                "ssssssi", 
                $data['frist_name'], 
                $data['last_name'], 
                $data['gmail'], 
                $data['phone'], 
                $data['Buissness_name'], 
                $data['type'], 
                $id
            );
        }
        return $stmt->execute();
    }

    // Delete account by user ID
    public function deleteAccount($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

class Login {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Validate login credentials
    public function validateCredentials($gmail, $password) {
        $query = "SELECT id, frist_name, last_name, gmail, Buissness_name, type, password 
                  FROM customer 
                  WHERE gmail = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $gmail);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && $user['password'] === $password) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fname']   = $user['frist_name'];
            $_SESSION['lname']   = $user['last_name'];
            $_SESSION['gmail']   = $user['gmail'];
            $_SESSION['bname']   = $user['Buissness_name'];
            $_SESSION['btype']   = $user['type'];
            $_SESSION['logged_in'] = true;

            return true;
        }
        return false;
    }

    public function getUserByGmail($gmail) {
        $query = "SELECT * FROM customer WHERE gmail = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $gmail);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
