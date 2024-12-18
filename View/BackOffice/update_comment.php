<?php
require_once 'db_connect.php';
include '../../controller/CommentController.php';
$commentController = new CommentController($pdo);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $username = $data['username'] ?? '';
    $job = $data['job'] ?? '';
    $email = $data['email'] ?? '';
    $type = $data['type'] ?? '';
    $comment = $data['comment'] ?? '';
    $stars = $data['stars'] ?? 0;
    $id = $data['id'] ?? null;

    if (empty($id)) {
        die('Error!');
    }
    $commentController->updateComment($id,$username,$email,$job,$type,$comment,$stars);
} else {
    echo "Invalid request method!";
}
