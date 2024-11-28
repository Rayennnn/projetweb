<?php

class Formation
{
    // Déclaration des attributs privés
    private ?int $id_formation = null; // Peut être null si non spécifié
    private ?string $nom_formation = null;
    private ?string $description = null;
    private ?string $organisme = null;
    private ?int $prix = null;
    private ?string $image = null; // Remplacé de logo à image
    private ?string $lien = null;
    private ?int $id_club = null; // ID de club pour la clé étrangère

    // Constructeur pour initialiser les attributs
    public function __construct(
        ?int $id_formation = null,
        ?string $nom_formation = null,
        ?string $description = null,
        ?string $organisme = null,
        ?int $prix = null,
        ?string $image = null, // Remplacé de logo à image
        ?string $lien = null,
        ?int $id_club = null
    ) {
        $this->id_formation = $id_formation;
        $this->nom_formation = $nom_formation;
        $this->description = $description;
        $this->organisme = $organisme;
        $this->prix = $prix;
        $this->image = $image; // Remplacé de logo à image
        $this->lien = $lien;
        $this->id_club = $id_club;
    }

    // Getters et setters pour chaque attribut

    public function getIdFormation(): ?int
    {
        return $this->id_formation;
    }

    public function setIdFormation(?int $id_formation): self
    {
        $this->id_formation = $id_formation;
        return $this;
    }

    public function getNomFormation(): ?string
    {
        return $this->nom_formation;
    }

    public function setNomFormation(?string $nom_formation): self
    {
        $this->nom_formation = $nom_formation;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getOrganisme(): ?string
    {
        return $this->organisme;
    }

    public function setOrganisme(?string $organisme): self
    {
        $this->organisme = $organisme;
        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    public function getImage(): ?string // Remplacé de logo à image
    {
        return $this->image; // Remplacé de logo à image
    }

    public function setImage(?string $image): self // Remplacé de logo à image
    {
        $this->image = $image; // Remplacé de logo à image
        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(?string $lien): self
    {
        $this->lien = $lien;
        return $this;
    }

    public function getIdClub(): ?int
    {
        return $this->id_club;
    }

    public function setIdClub(?int $id_club): self
    {
        $this->id_club = $id_club;
        return $this;
    }
}

?>
