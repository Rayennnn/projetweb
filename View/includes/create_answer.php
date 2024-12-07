<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  $answer = $data['answer'] ?? '';
  $comment_id = $data['comment_id'] ?? '';

  try {
    $stmt = $pdo->prepare('INSERT INTO answers (answer, comment_id) VALUES (:answer, :comment_id)');
    $stmt->execute([
      ':answer' => $answer,
      ':comment_id' => $comment_id,
    ]);
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
} else {
  echo "Invalid request method!";
}
