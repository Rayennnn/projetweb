<?php
include 'C:\xampp\htdocs\parcouri\db.php';
include 'C:\xampp\htdocs\parcouri\Controller\usercontroller.php';

$controller = new UserController($pdo);

$controller->logout();
?>