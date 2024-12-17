<?php


require_once 'db_connect.php';

class CommentController
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createComment(?string $email,?string $username,?string $job,?string $type,?string $comment,?string $stars)
    {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO comments (email, username, job, type, comment, stars) VALUES (:email, :username, :job, :type, :comment, :stars)');
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
    } 
    public function deleteAllComments()
    {
        try {
		    $sql = "DELETE FROM answers";
		    $stmt = $this->pdo->prepare($sql);
		    $stmt->execute();

		    $sql = "DELETE FROM comments";
		    $stmt = $this->pdo->prepare($sql);
		    $stmt->execute();

		    $this->pdo->commit();
	    
       
        } catch (PDOException $e) {
            $this->pdo->rollBack();

            echo json_encode(['status' => 'error', 'message' => 'Failed to delete comments and answers: ' . $e->getMessage()]);
        }
    } 
    public function deleteComment(?string $comment_id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM answers WHERE comment_id = :comment_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
            $stmt->execute();
            $sql = "DELETE FROM comments WHERE id = :comment_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
            $stmt->execute();
            $this->pdo->commit();
            echo json_encode(['status' => 'success', 'message' => 'Comment and its answers deleted successfully']);
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete comment and answers: ' . $e->getMessage()]);
        }
    } 
    public function updateComment(?string $id, ?string $username,?string $email,?string $job, ?string $type,?string $comment,?int $stars){
        try {

        $check_stmt = $this->pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $check_stmt->execute([
            ':id' => $id,
        ]);

        $existing_comment = $check_stmt->fetch(PDO::FETCH_ASSOC);

        if (!$existing_comment) {
            die('Comment not found or you do not have permission to update.');
        }

        $stmt = $this->pdo->prepare('
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
    }
    public function fetchAll(){
        try {
          $stmt = $this->pdo->query('SELECT * FROM comments');
          $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

          $answers_stmt = $this->pdo->prepare('SELECT * FROM answers WHERE comment_id = :comment_id');

          foreach ($comments as &$comment) {
            $answers_stmt->execute([':comment_id' => $comment['id']]);
            $comment['answers'] = $answers_stmt->fetchAll(PDO::FETCH_ASSOC);
          }
          echo json_encode($comments);
        } catch (PDOException $e) {
          echo json_encode([]);
        }
    }
    public function getCommentById(?string $comment_id){
        try {
            $sql_comment = "SELECT * FROM comments WHERE id = :comment_id";
            $stmt_comment = $this->pdo->prepare($sql_comment);
            $stmt_comment->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
            $stmt_comment->execute();
            $comment = $stmt_comment->fetch(PDO::FETCH_ASSOC);

            $sql_answers = "SELECT * FROM answers WHERE comment_id = :comment_id";
            $stmt_answers = $this->pdo->prepare($sql_answers);
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
    }
}
