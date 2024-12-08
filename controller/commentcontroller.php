<?php
require_once 'EventDispatcher.php';
require_once 'EmailNotificationListener.php';
require_once '../model/comment model.php';

class CommentController {
    private $dispatcher;

    public function __construct() {
        $this->dispatcher = new EventDispatcher();

        // Add listener for comment submission
        $this->dispatcher->addListener('comment.submitted', [new EmailNotificationListener(), 'onCommentSubmitted']);
    }

    public function submitComment($commentData) {
        $model = new CommentModel();
        $isSaved = $model->saveComment($commentData['name'], $commentData['email'], $commentData['comment']);

        if ($isSaved) {
            // Dispatch event for comment submission
            $this->dispatcher->dispatch('comment.submitted', $commentData);
        }

        return $isSaved;
    }
}
?>
