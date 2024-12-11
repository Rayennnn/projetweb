<?php

class question {
    private $id=NULL;
    private $titre=NULL;
    private $id_auteur=NULL;
    private $date=NULL;
    private $type=NULL;

    private $ideal_rep=NULL;

    // Constructeur
    public function __construct(string $titre, string $id_auteur, string $date, string $type, string $ideal_rep) {
        $this->settitre($titre);
        $this->setid_auteur($id_auteur);
        $this->setdate($date);
        $this->settype($type);
        $this->setideal_rep($ideal_rep);
    }

    // Getters et setters
    public function getId() {
        return $this->id;
    }
    public function getIdeal_rep(){
        return $this->ideal_rep;
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
    function setideal_rep(string $ideal_rep): void{
        $this->ideal_rep=$ideal_rep;
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
