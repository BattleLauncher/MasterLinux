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
                  (id, first_name, last_name, gender, age, email, phone, location, business_name, business_type, password, profile_picture) 
                  VALUES (:id, :first_name, :last_name, :gender, :age, :email, :phone, :location, :business_name, :business_type, :password, :profile_picture)";
    
        $stmt = $this->conn->prepare($query);
    
        // Bind data
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":first_name", $data['first_name']);
        $stmt->bindParam(":last_name", $data['last_name']);
        $stmt->bindParam(":gender", $data['gender']);
        $stmt->bindParam(":age", $data['age']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":phone", $data['phone']);
        $stmt->bindParam(":location", $data['location']);
        $stmt->bindParam(":business_name", $data['business_name']);
        $stmt->bindParam(":business_type", $data['business_type']);
        $stmt->bindParam(":password", $data['password']);
        $stmt->bindParam(":profile_picture", $data['profile_picture']);
    
        return $stmt->execute();
    }
    

    // Method to delete a customer by ID
    public function deleteCustomer($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bindValue(1, $id, PDO::PARAM_INT); // Corrected bind_param to bindValue
            if ($stmt->execute()) {
                return true;
            }
        }
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

function updateUser($userId, $firstName, $lastName, $email, $phone, $location, $businessName, $businessType, $password, $profilePicture, $conn) {
    // Update query including the profile picture
    $query = "UPDATE customer 
              SET first_name = :first_name, 
                  last_name = :last_name, 
                  email = :email, 
                  phone = :phone, 
                  location = :location, 
                  business_name = :business_name, 
                  business_type = :business_type, 
                  password = :password";

    // Only update profile_picture if a new one is provided
    if (!empty($profilePicture)) {
        $query .= ", profile_picture = :profile_picture";
    }

    $query .= " WHERE id = :id";

    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(":first_name", $firstName);
    $stmt->bindParam(":last_name", $lastName);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":location", $location);
    $stmt->bindParam(":business_name", $businessName);
    $stmt->bindParam(":business_type", $businessType);
    $stmt->bindParam(":password", $password);

    // Bind profile picture if it's not empty
    if (!empty($profilePicture)) {
        $stmt->bindParam(":profile_picture", $profilePicture);
    }

    $stmt->bindParam(":id", $userId, PDO::PARAM_INT);

    // Execute and return success status
    return $stmt->execute();
}



class Promote {
    private $conn;
    private $table_name = "customer";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function submitPromotionRequest($data, $userId) {
        // Check for required fields
        if (!isset($data['promotion_details'], $data['requested_budget'], $userId)) {
            return false;
        }
    
        // Prepare the query
        $query = "UPDATE {$this->table_name} 
        SET promotion_details = :promotion_details, 
            requested_budget = :requested_budget 
        WHERE id = :user_id";

        $stmt = $this->conn->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':promotion_details', $data['promotion_details']);
        $stmt->bindParam(':requested_budget', $data['requested_budget']);
        $stmt->bindParam(':user_id', $userId);
    
        // Execute the query and check if it was successful
        if ($stmt->execute()) {
            return true;
        } else {
            // If query fails, output error details
            echo "<p class='error-message'>Error: " . implode(", ", $stmt->errorInfo()) . "</p>";
            return false;
        }
    }
    
    
}

?>