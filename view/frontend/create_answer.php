<?php
require_once 'db_connect.php';

include '../../controller/AnswerController.php';
$answerController = new AnswerController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  $answer = $data['answer'] ?? '';
  $comment_id = $data['comment_id'] ?? '';
  $answerController->createAnswer($answer,$comment_id);
  
} else {
  echo "Invalid request method!";
}
