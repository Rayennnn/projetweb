<?php
require_once 'db_connect.php';

include '../../controller/CommentController.php';
$commentController = new CommentController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $commentController->deleteAllComments();
}
?>
