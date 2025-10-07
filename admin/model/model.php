<?php
class Database {
    private $host = "localhost";
    private $db_name = "data store";  // your database name
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

/**
 * ================================
 * Super Admin Class
 * ================================
 */
class SuperAdmin {
    private $conn;
    private $table_name = "admin";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function validateLogin($username, $password) {
        $query = "SELECT * FROM {$this->table_name} WHERE username = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();

        if ($admin && $admin['password'] === $password) {
            return $admin;
        }
        return false;
    }
}

/**
 * ================================
 * Customer Class
 * ================================
 */
class Customer {
    private $conn;
    private $table_name = "customer";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insertCustomer($data) {
        $query = "INSERT INTO {$this->table_name} 
                  (frist_name, last_name, gmail, phone, Buissness_name, type, password) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
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
        return $stmt->execute();
    }

    public function updateCustomer($id, $data) {
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
        return $stmt->execute();
    }

    public function deleteAccount($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table_name} WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getAllCustomers() {
        return $this->conn->query("SELECT * FROM {$this->table_name} ORDER BY id DESC");
    }
}

/**
 * ================================
 * Promoter Class
 * ================================
 */
class Promoter {
    private $conn;
    private $table_name = "promoter";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insertPromoter($data) {
        $query = "INSERT INTO {$this->table_name} 
                  (name, phone, gmail, password, followers, platform) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "ssssis",
            $data['name'],
            $data['phone'],
            $data['gmail'],
            $data['password'],
            $data['followers'],
            $data['platform']
        );
        return $stmt->execute();
    }

    public function updatePromoter($id, $data) {
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
        return $stmt->execute();
    }

    public function deletePromoter($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table_name} WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getAllPromoters() {
        return $this->conn->query("SELECT * FROM {$this->table_name} ORDER BY id DESC");
    }
}
?>
