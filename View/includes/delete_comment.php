<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $comment_id = $data['comment_id'];
    if (!$comment_id) {
        echo "Invalid request method!";

    }
    try {
        $pdo->beginTransaction();
        $sql = "DELETE FROM answers WHERE comment_id = :comment_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        $stmt->execute();
        $sql = "DELETE FROM comments WHERE id = :comment_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        $stmt->execute();
        $pdo->commit();
        echo json_encode(['status' => 'success', 'message' => 'Comment and its answers deleted successfully']);
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete comment and answers: ' . $e->getMessage()]);
    }
} else {
    echo "Invalid request method!";
}
