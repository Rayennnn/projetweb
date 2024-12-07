<?php
require_once 'CommentModel.php';

class CommentController {
    private $model;

    public function __construct($pdo) {
        $this->model = new CommentModel($pdo);
    }

    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        $response = ['status' => 'error', 'message' => 'Invalid Request'];

        if ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($this->model->createComment($data)) {
                $response = ['status' => 'success', 'message' => 'Comment added successfully'];
            }
        } elseif ($method === 'DELETE') {
            $comment_id = $_GET['comment_id'] ?? null;
            if ($comment_id && $this->model->deleteComment($comment_id)) {
                $response = ['status' => 'success', 'message' => 'Comment deleted successfully'];
            }
        }

        echo json_encode($response);
    }
}
?>
