<?php

class Club
{
    // Déclaration des attributs privés
    private ?int $id_club = null; // Peut être null si non spécifié
    private ?string $nom_club = null;
    private ?string $description = null;
    private ?string $date_creation = null;
    private ?string $categorie = null;
    private ?string $lieu = null;
    private ?string $logo = null;
    private ?string $lien = null;
    private ?int $clicks = null;

    // Constructeur pour initialiser les attributs
    public function __construct(
        ?int $id_club = null,
        ?string $nom_club = null,
        ?string $description = null,
        ?string $date_creation = null,
        ?string $categorie = null,
        ?string $lieu = null,
        ?string $logo = null,
        ?string $lien = null,
        ?int $clicks = null,
    ) {
        $this->id_club = $id_club;
        $this->nom_club = $nom_club;
        $this->description = $description;
        $this->date_creation = $date_creation;
        $this->categorie = $categorie;
        $this->lieu = $lieu;
        $this->logo = $logo;
        $this->lien = $lien;
        $this->clicks = $clicks;
    }

    // Getters et setters pour chaque attribut

    public function getIdClub(): ?int
    {
        return $this->id_club;
    }

    public function setIdClub(?int $id_club): self
    {
        $this->id_club = $id_club;
        return $this;
    }

    public function getNomClub(): ?string
    {
        return $this->nom_club;
    }

    public function setNomClub(?string $nom_club): self
    {
        $this->nom_club = $nom_club;
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

    public function getDateCreation(): ?string
    {
        return $this->date_creation;
    }

    public function setDateCreation(?string $date_creation): self
    {
        $this->date_creation = $date_creation;
        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;
        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;
        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;
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
    public function getClicks(): ?int
    {
        return $this->clicks;
    }
    public function setClicks(?int $clicks): self
    {
        $this->clicks = $clicks;
        return $this;
    }
}
?>
