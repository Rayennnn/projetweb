<?php
require_once 'config.php';

try {
  $stmt = $pdo->query('SELECT * FROM comments');
  $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $answers_stmt = $pdo->prepare('SELECT * FROM answers WHERE comment_id = :comment_id');

  foreach ($comments as &$comment) {
    $answers_stmt->execute([':comment_id' => $comment['id']]);
    $comment['answers'] = $answers_stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  echo json_encode($comments);
} catch (PDOException $e) {
  echo json_encode([]);
}
