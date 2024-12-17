<?php
require_once 'db_connect.php';
include '../../controller/CommentController.php';
$commentController = new CommentController($pdo);
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])) {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $comment_id = $_GET['id'];

    $commentController->getCommentById($comment_id);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'No comment ID provided'
    ]);
}
