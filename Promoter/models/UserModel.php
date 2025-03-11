<?php
class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $password, $full_name, $email, $phone, $location, $social_media_platform, $social_media_handle, $follower_range, $profile_picture, $bio) {
        $query = "INSERT INTO users (username, password, full_name, email, phone, location, social_media_platform, social_media_handle, follower_range, profile_picture, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3, $full_name);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $phone);
        $stmt->bindParam(6, $location);
        $stmt->bindParam(7, $social_media_platform);
        $stmt->bindParam(8, $social_media_handle);
        $stmt->bindParam(9, $follower_range);
        $stmt->bindParam(10, $profile_picture);
        $stmt->bindParam(11, $bio);
        $stmt->execute();
    }

    public function login($username, $password) {
        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>