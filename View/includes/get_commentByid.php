<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])) {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $comment_id = $_GET['id'];

    try {
        $sql_comment = "SELECT * FROM comments WHERE id = :comment_id";
        $stmt_comment = $pdo->prepare($sql_comment);
        $stmt_comment->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        $stmt_comment->execute();
        $comment = $stmt_comment->fetch(PDO::FETCH_ASSOC);

        $sql_answers = "SELECT * FROM answers WHERE comment_id = :comment_id";
        $stmt_answers = $pdo->prepare($sql_answers);
        $stmt_answers->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        $stmt_answers->execute();
        $answers = $stmt_answers->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'comment' => $comment,
            'answers' => $answers
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to retrieve comment and answers: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'No comment ID provided'
    ]);
}
