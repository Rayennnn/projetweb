<?php
class Formation
{
    private ?int $idFormation = null;
    private ?string $titre = null;
    private ?string $description = null;
    private ?string $categorie = null;
    private ?string $lieu = null;
    private ?string $organisateur = null;
    private ?string $lien = null;
    private ?string $dateDebut = null;
    private ?string $dateFin = null;

    public function __construct($id = null, $titre = null, $desc = null, $cat = null, $lieu = null, $org = null, $lien = null, $debut = null, $fin = null)
    {
        $this->idFormation = $id;
        $this->titre = $titre;
        $this->description = $desc;
        $this->categorie = $cat;
        $this->lieu = $lieu;
        $this->organisateur = $org;
        $this->lien = $lien;
        $this->dateDebut = $debut;
        $this->dateFin = $fin;
    }

    public function getIdFormation() { return $this->idFormation; }
    public function setIdFormation($id) { $this->idFormation = $id; return $this; }

    public function getTitre() { return $this->titre; }
    public function setTitre($titre) { $this->titre = $titre; return $this; }

    public function getDescription() { return $this->description; }
    public function setDescription($desc) { $this->description = $desc; return $this; }

    public function getCategorie() { return $this->categorie; }
    public function setCategorie($cat) { $this->categorie = $cat; return $this; }

    public function getLieu() { return $this->lieu; }
    public function setLieu($lieu) { $this->lieu = $lieu; return $this; }

    public function getOrganisateur() { return $this->organisateur; }
    public function setOrganisateur($org) { $this->organisateur = $org; return $this; }

    public function getLien() { return $this->lien; }
    public function setLien($lien) { $this->lien = $lien; return $this; }

    public function getDateDebut() { return $this->dateDebut; }
    public function setDateDebut($debut) { $this->dateDebut = $debut; return $this; }

    public function getDateFin() { return $this->dateFin; }
    public function setDateFin($fin) { $this->dateFin = $fin; return $this; }
}
?>
