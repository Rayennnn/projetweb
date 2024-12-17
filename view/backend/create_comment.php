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
  $stars = 0;


  if (empty($username) || empty($job) || empty($email) || empty($type) || empty($comment)) {
    die('All fields are required!');
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email address!');
  }

  $commentController->createComment($email,$username,$job,$type,$comment,$stars);
} else {
  echo "Invalid request method!";
}


ini_set('display_errors', 1);
error_reporting(E_ALL);
