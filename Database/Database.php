<?php
class Database {
    private $host = "localhost";
    private $db_name = "mydatabase";
    private $username = "root"; // Update with your DB username
    private $password = "";    // Update with your DB password
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
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
        $query = "INSERT INTO " . $this->table_name . " 
                  (id,first_name, last_name, gender, age, email, phone, location, business_name, business_type, password) 
                  VALUES (:id,:first_name, :last_name, :gender, :age, :email, :phone, :location, :business_name, :business_type, :password)";
    
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam("id", $data['id']);
        $stmt->bindParam(":first_name", $data['first_name']);
        $stmt->bindParam(":last_name", $data['last_name']);
        $stmt->bindParam(":gender", $data['gender']);
        $stmt->bindParam(":age", $data['age']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":phone", $data['phone']);
        $stmt->bindParam(":location", $data['location']);
        $stmt->bindParam(":business_name", $data['business_name']);
        $stmt->bindParam(":business_type", $data['business_type']);
        $stmt->bindParam(":password", $data['password']); // Storing plain text password
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Method to delete a customer by ID
    public function deleteCustomer($id) {
        // Prepare DELETE query
        $query = "DELETE FROM " . $this->table_name. " WHERE id = ?";
        
        // Prepare the statement
        if ($stmt = $this->conn->prepare($query)) {
            // Bind the ID parameter
            $stmt->bind_param("i", $id);

            // Execute the query
            if ($stmt->execute()) {
                // Return true if successful
                return true;
            }
        }
        // Return false if the query execution fails
        return false;
    }
    
}

class Login {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to validate user credentials
    public function validateCredentials($email, $password) {
        $query = "SELECT id, first_name, email, password FROM customer WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            return true;
        }
        return false;
    }

    public function getUserId() {
        if (isset($_SESSION['user_id'])) {
            return $_SESSION['user_id'];
        }
        return null;
    }

    public function getFirstName() {
        if (isset($_SESSION['first_name'])) {
            return $_SESSION['first_name'];
        }
        return null;
    }
}

function getUserData($userId, $conn) {
    $stmt = $conn->prepare("SELECT * FROM customer WHERE id = :id");
    $stmt->bindParam(":id", $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUser($userId, $firstName, $lastName, $email, $phone, $location, $businessName, $businessType, $password, $conn) {
    $query = "UPDATE customer SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, 
              location = :location, business_name = :business_name, business_type = :business_type, password = :password 
              WHERE id = :id";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":first_name", $firstName);
    $stmt->bindParam(":last_name", $lastName);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":location", $location);
    $stmt->bindParam(":business_name", $businessName);
    $stmt->bindParam(":business_type", $businessType);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":id", $userId);

    return $stmt->execute();
}

class Promote {
    private $conn;
    private $table_name = "promotion_requests";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Submit a new promotion request
    public function submitPromotionRequest($data) {
        // Check if all required fields are present
        if (!isset($data['user_id'], $data['business_name'], $data['promotion_details'], $data['requested_budget'])) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " 
                  (id, business_name, promotion_details, requested_budget, status) 
                  VALUES (:id, :business_name, :promotion_details, :requested_budget, 'Pending')";

        $stmt = $this->conn->prepare($query);

        try {
            // Bind parameters
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $stmt->bindParam(':business_name', $data['business_name'], PDO::PARAM_STR);
            $stmt->bindParam(':promotion_details', $data['promotion_details'], PDO::PARAM_STR);
            $stmt->bindParam(':requested_budget', $data['requested_budget'], PDO::PARAM_STR);

            // Execute the statement
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            // Log or handle the error as needed
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
}
?>