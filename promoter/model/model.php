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

class Promoter {
    private $conn;
    private $table_name = "promoter";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Insert new promoter
    public function insertPromoter($data) {
        $query = "INSERT INTO {$this->table_name} 
                  (name, phone, gmail, password, followers, platform) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return "Prepare failed: " . $this->conn->error;

        $stmt->bind_param(
            "ssssis", 
            $data['name'], 
            $data['phone'], 
            $data['gmail'], 
            $data['password'], 
            $data['followers'], 
            $data['platform']
        );

        $result = $stmt->execute();
        $stmt->close();
        return $result ? true : "Error: " . $stmt->error;
    }

    // Update promoter
    public function updatePromoter($id, $data) {
        if (!empty($data['password'])) {
            $query = "UPDATE {$this->table_name} 
                      SET name=?, phone=?, gmail=?, password=?, followers=?, platform=? 
                      WHERE id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param(
                "ssssisi", 
                $data['name'], 
                $data['phone'], 
                $data['gmail'], 
                $data['password'], 
                $data['followers'], 
                $data['platform'], 
                $id
            );
        } else {
            $query = "UPDATE {$this->table_name} 
                      SET name=?, phone=?, gmail=?, followers=?, platform=? 
                      WHERE id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param(
                "sssisi", 
                $data['name'], 
                $data['phone'], 
                $data['gmail'], 
                $data['followers'], 
                $data['platform'], 
                $id
            );
        }
        return $stmt->execute();
    }

    // Delete promoter by ID
    public function deletePromoter($id) {
        $query = "DELETE FROM {$this->table_name} WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

class PromoterLogin {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Validate login credentials
    public function validateCredentials($gmail, $password) {
        $query = "SELECT id, name, phone, gmail, password, followers, platform 
                  FROM promoter 
                  WHERE gmail = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $gmail);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && $user['password'] === $password) {
            if (session_status() === PHP_SESSION_NONE) session_start();

            $_SESSION['promoter_id']        = $user['id'];
            $_SESSION['promoter_name']      = $user['name'];
            $_SESSION['promoter_gmail']     = $user['gmail'];
            $_SESSION['promoter_phone']     = $user['phone'];
            $_SESSION['promoter_followers'] = $user['followers'];
            $_SESSION['promoter_platform']  = $user['platform'];
            $_SESSION['logged_in']          = true;

            return true;
        }
        return false;
    }

    public function getPromoterByGmail($gmail) {
        $query = "SELECT * FROM promoter WHERE gmail = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $gmail);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
