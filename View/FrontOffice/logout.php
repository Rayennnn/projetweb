<?php
include 'C:\xampp\htdocs\PROJETWEB\db.php';
include 'C:\xampp\htdocs\PROJETWEB\Controller\usercontroller.php';

$controller = new UserController($pdo);

$controller->logout();
?>