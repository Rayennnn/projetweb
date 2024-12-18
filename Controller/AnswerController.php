<?php


require_once 'db_connect.php';
class AnswerController
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    function createAnswer(?string $answer,?string $comment_id)
    {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO answers (answer, comment_id) VALUES (:answer, :comment_id)');
            $stmt->execute([
              ':answer' => $answer,
              ':comment_id' => $comment_id,
            ]);
          } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
    } 
}
