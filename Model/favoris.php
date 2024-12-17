<?php

class Favoris
{
    // Déclaration des attributs privés
    private ?int $id = null;
    private ?int $user_id = null;
    private ?string $type = null; // ENUM('club', 'formation')
    private ?int $item_id = null;

    // Constructeur pour initialiser les attributs
    public function __construct(
        ?int $id = null,
        ?int $user_id = null,
        ?string $type = null,
        ?int $item_id = null
    ) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->type = $type;
        $this->item_id = $item_id;
    }

    // Getters et setters pour chaque attribut

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        if (!in_array($type, ['club', 'formation'])) {
            throw new InvalidArgumentException("Type must be 'club' or 'formation'.");
        }
        $this->type = $type;
        return $this;
    }

    public function getItemId(): ?int
    {
        return $this->item_id;
    }

    public function setItemId(?int $item_id): self
    {
        $this->item_id = $item_id;
        return $this;
    }
}

?>
