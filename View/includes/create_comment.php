<?php
require_once 'db_connect.php';


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
  

  try {
    $stmt = $pdo->prepare('INSERT INTO comments (email, username, job, type, comment, stars) VALUES (:email, :username, :job, :type, :comment, :stars)');
    $stmt->execute([
      ':email' => $email,
      ':username' => $username,
      ':job' => $job,
      ':type' => $type,
      ':comment' => $comment,
      ':stars' => $stars,
    ]);
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
} else {
  echo "Invalid request method!";
}


ini_set('display_errors', 1);
error_reporting(E_ALL);
