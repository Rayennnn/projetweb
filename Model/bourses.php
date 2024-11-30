<?php

class Bourse
{
    private $id;
    private $nom_bourse;
    private $description;
    private $organisme;
    private $date_limite;
    private $age_limite;
    private $niveau_etude;
    private $pays;
    private $lien;
    private $image;

    // Getters
    public function getId() { return $this->id; }
    public function getNomBourse() { return $this->nom_bourse; }
    public function getDescription() { return $this->description; }
    public function getOrganisme() { return $this->organisme; }
    public function getDateLimite() { return $this->date_limite; }
    public function getAgeLimite() { return $this->age_limite; }
    public function getNiveauEtude() { return $this->niveau_etude; }
    public function getPays() { return $this->pays; }
    public function getLien() { return $this->lien; }
    public function getImage() { return $this->image; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setNomBourse($nom_bourse) { $this->nom_bourse = $nom_bourse; }
    public function setDescription($description) { $this->description = $description; }
    public function setOrganisme($organisme) { $this->organisme = $organisme; }
    public function setDateLimite($date_limite) { $this->date_limite = $date_limite; }
    public function setAgeLimite($age_limite) { $this->age_limite = $age_limite; }
    public function setNiveauEtude($niveau_etude) { $this->niveau_etude = $niveau_etude; }
    public function setPays($pays) { $this->pays = $pays; }
    public function setLien($lien) { $this->lien = $lien; }
    public function setImage($image) { $this->image = $image; }
}




?>