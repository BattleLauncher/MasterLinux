<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "mydatabase";
    public $conn; // Public connection property for external access

    // Constructor to establish the database connection
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Check for connection errors
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Insert a new record into a specified table
    public function insert($table, $data) {
        // Build the SQL query dynamically
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $values = array_values($data);

        // Prepare the SQL statement
        $stmt = $this->conn->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");

        if (!$stmt) {
            die("Failed to prepare statement: " . $this->conn->error);
        }

        // Dynamically bind parameters
        $types = str_repeat("s", count($values)); // Assuming all values are strings
        $stmt->bind_param($types, ...$values);

        // Execute the query and return the result
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            die("Insert failed: " . $stmt->error);
        }
    }
}
?>
