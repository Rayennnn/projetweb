<?php

class Comment {
    private ?string $email;
    private ?string $username;
    private ?string $job;
    private ?string $type;
    private ?string $comment;
    private ?int $stars;
 
    // Constructor
    public function __construct(?string $email, ?string $username, ?string $job, ?string $type, ?string $comment, ?int $stars) {
        $this->email = $email;
        $this->username = $username;
        $this->job = $job;
        $this->type = $type;
        $this->comment = $comment;
        $this->stars = $stars;

    }

    // Getters and Setters

    public function getEmail(): ?int {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function setUsername(?string $username): void {
        $this->username = $username;
    }

    public function getJob(): ?string {
        return $this->job;
    }

    public function setJob(?string $job): void {
        $this->job = $job;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $type): void {
        $this->type = $type;
    }

    public function getComment(): ?string {
        return $this->comment;
    }

    public function setComment(?string $comment): void {
        $this->comment = $comment;
    }

    public function getStars(): ?int {
        return $this->stars;
    }

    public function setStars(int $stars): void {
        $this->stars = $stars;
    }
}

?>
