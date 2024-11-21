<?php
include 'C:\xampp\htdocs\parcouri\db.php';
include 'C:\xampp\htdocs\parcouri\controller\usercontroller.php';

$controller = new UserController($pdo);
$id = $_GET['id'] ?? null;

if ($id && $controller->deleteUser($id)) {
    header("Location: listuser.php");
    exit;
} else {
    echo "Failed to delete user.";
}
?>
