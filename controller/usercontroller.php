<?php
include 'C:\xampp\htdocs\parcouri\db.php';
include 'C:\xampp\htdocs\parcouri\model\user.php';

class UserController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new user
    public function createUser($name, $lastName, $email, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $lastName, $email, $hashedPassword, $role]);
    }

    // Read all users
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM utilisateur");
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($row['id'], $row['name'], $row['last_name'], $row['email'], null, $row['role']);
        }
        return $users;
    }

    // Read a single user by ID
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User($row['id'], $row['name'], $row['last_name'], $row['email'], null, $row['role']);
        }
        return null;
    }

    // Update an existing user
    public function updateUser($id, $name, $lastName, $email, $role) {
        $stmt = $this->pdo->prepare("UPDATE utilisateur SET name = ?, last_name = ?, email = ?, role = ? WHERE id = ?");
        return $stmt->execute([$name, $lastName, $email, $role, $id]);
    }

    // Delete a user
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM utilisateur WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
