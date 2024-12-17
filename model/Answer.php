<?php

class Answer {
    private ?string $answer;
    private ?string $comment_id;
 
    // Constructor
    public function __construct(?string $answer, ?string $comment_id) {
        $this->answer= $answer;
        $this->comment_id = $comment_id;
    }

    // Getters and Setters

    public function getAnswer(): ?int {
        return $this->answer;
    }

    public function setAnswer(?string $answer): void {
        $this->answer = $answer;
    }

    public function getComment_id(): ?string {
        return $this->comment_id;
    }

    public function setComment_id(?string $comment_id): void {
        $this->comment_id = $comment_id;
    }
}

?>
