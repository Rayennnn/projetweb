<?php

class question {
    private $id=NULL;
    private $titre=NULL;
    private $id_auteur=NULL;
    private $date=NULL;
    private $type=NULL;

    // Constructeur
    public function __construct(string $titre, string $id_auteur, string $date, string $type){
        $this->settitre($titre);
        $this->setid_auteur($id_auteur);
        $this->setdate($date);
        $this->settype($type);
    }

    // Getters et setters
    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getId_auteur() {
        return $this->id_auteur;
    }

    public function getDate() {
        return $this->date;
    }

    public function getType() {
        return $this->type;
    }
    function setid(int $id): void{
        $this->id=$id;
    }

    function settitre(string $titre): void{
        $this->titre=$titre;
    }

    function setid_auteur(string $id_auteur): void{
        $this->id_auteur=$id_auteur;
    }

    function setdate(string $date): void{
        $this->date=$date;
    }

    function settype(string $type): void{
        $this->type=$type;
    }
 

}
?>
