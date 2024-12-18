<?php

class ReplyModel {
    private $db;

    public function __construct() {
        // Connect to the database
        $this->db = new PDO('mysql:host=localhost;dbname=baseprojet(2)', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Save a reply to the database
    public function saveReply($commentId, $name, $email, $replyText) {
        $query = "INSERT INTO replies (comment_id, name, email, reply_text, created_at) VALUES (:comment_id, :name, :email, :reply_text, NOW())";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':comment_id' => $commentId,
            ':name' => $name,
            ':email' => $email,
            ':reply_text' => $replyText
        ]);
    }

    // Retrieve replies for a specific comment
    public function getRepliesByCommentId($commentId) {
        $query = "SELECT * FROM replies WHERE comment_id = :comment_id ORDER BY created_at ASC";
        $stmt = $this->db->prepare($query);

        $stmt->execute([':comment_id' => $commentId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
