<?php
class CommentModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createComment($data) {
        $stmt = $this->pdo->prepare('INSERT INTO comments (email, username, job, type, comment, stars) VALUES (:email, :username, :job, :type, :comment, :stars)');
        return $stmt->execute($data);
    }

    public function deleteComment($comment_id) {
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare('DELETE FROM answers WHERE comment_id = :comment_id');
            $stmt->execute([':comment_id' => $comment_id]);
            $stmt = $this->pdo->prepare('DELETE FROM comments WHERE id = :comment_id');
            $stmt->execute([':comment_id' => $comment_id]);
            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}
?>
