<?php
include 'C:\xampp\htdocs\PROJETWEB\db.php';
include 'C:\xampp\htdocs\PROJETWEB\Model\user.php';

class UserController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

  

    public function createUser($name, $lastName, $email, $password, $role , $statusCompte, $fac, $domaine, $photoName) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (name, last_name, email, password, role, status_compte, fac, domaine, photo) VALUES (?, ?, ?, ?, ?,?, ?, ?, ?)");
        return $stmt->execute([$name, $lastName, $email, $hashedPassword, $role, $statusCompte, $fac, $domaine, $photoName]);
    }
    public function createclient($name, $lastName, $email, $password , $statusCompte, $fac, $domaine, $photoName) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (name, last_name, email, password, role ,status_compte, fac, domaine, photo) VALUES (?, ?, ?, ?, 0,?, ?, ?, ?)");
        return $stmt->execute([$name, $lastName, $email, $hashedPassword ,$statusCompte, $fac, $domaine, $photoName]);
    }

    // Read all users
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM utilisateur");
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($row['id'], $row['name'], $row['last_name'], $row['email'],  null, $row['role'],  $row['status_compte'], $row['photo']  , $row['fac'], $row['domaine'] );
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
    
    public function login($email, $password) {
        // Préparation de la requête pour récupérer l'utilisateur
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Vérification si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {
            // Création de la session pour l'utilisateur connecté
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_last_name'] = $user['last_name']; 
            $_SESSION['photo'] = $user['photo'];
            $_SESSION['status_compte'] = $user['status_compte'];
            $_SESSION['fac'] = $user['fac']; 
            $_SESSION['domaine'] = $user['domaine']; 


    
            // Redirection en fonction du rôle de l'utilisateur
            if ($_SESSION['user_role'] === 1) {
                header("Location: ../../View/BackOffice/profile.php");  // Redirection vers le back-office
            } else {
                header("Location: ../FrontOffice/course.html");  // Redirection vers le front-office
            }
            exit();  // Assurez-vous que le script s'arrête après la redirection
        } else {
            // Redirection en cas d'erreur d'authentification avec un message d'erreur
            header("Location: ../view/login.php?error=1");
            exit();
        }
    }
    
public function logout() {
    session_destroy();
    header("Location: ../FrontOffice/login.php");
}
}

?>
