<?php
require_once 'db_connect.php';

include '../../controller/CommentController.php';
$commentController = new CommentController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $comment_id = $data['comment_id'];
    if (!$comment_id) {
        echo "Invalid request method!";

    }
    $commentController->deleteComment($comment_id);
} else {
    echo "Invalid request method!";
}
