<?php
require_once 'db.php';

class User {
    private $db;

    public function __construct() {
        $this->db = connect();
    }

    public function create($data) {
        if (!isset($data['name'], $data['email'], $data['password'])) {
            return false;
        }

        $name = $data['name'];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':name' => $name, ':email' => $email, ':password' => $password]);
    }

    public function update($id, $data) {
        if (!isset($data['name'], $data['email'])) {
            return false;
        }

        $name = $data['name'];
        $email = $data['email'];

        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':name' => $name, ':email' => $email, ':id' => $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([':id' => $id]);

        if ($result) {
            error_log("User with ID $id successfully deleted.");
        } else {
            error_log("Failed to delete user with ID $id.");
        }

        return $result;
    }

    public function get($id) {
        if (!is_numeric($id)) {
            return false;
        }
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

}
?>
