<?php
require_once 'config.php';

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
    try {

        $check_stmt = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $check_stmt->execute([
            ':id' => $id,
        ]);

        $existing_comment = $check_stmt->fetch(PDO::FETCH_ASSOC);

        if (!$existing_comment) {
            die('Comment not found or you do not have permission to update.');
        }

        $stmt = $pdo->prepare('
      UPDATE comments 
      SET 
        username = :username, 
        job = :job, 
        type = :type, 
        comment = :comment, 
        stars = :stars 
      WHERE id = :id AND email = :email
    ');

        $stmt->execute([
            ':username' => $username,
            ':job' => $job,
            ':type' => $type,
            ':comment' => $comment,
            ':stars' => $stars,
            ':id' => $id,
            ':email' => $email
        ]);

        echo "Comment updated successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method!";
}
