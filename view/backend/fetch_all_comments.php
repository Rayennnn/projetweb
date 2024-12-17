<?php
require_once 'db_connect.php';
include '../../controller/CommentController.php';
$commentController = new CommentController($pdo);
$commentController->fetchAll();

