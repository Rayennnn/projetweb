<?php
class Suggestion {
    private $id_suggestion;
    private $contenu;
    private $date_soumission;
    private $statut;
    private $type_feedback;
    private $id_utilisateur;
    private $likes;      // Nouvel attribut likes
    private $dislikes;   // Nouvel attribut dislikes

    // Constructeur avec les nouveaux attributs
    public function __construct($id_suggestion, $contenu, $date_soumission, $statut, $type_feedback, $id_utilisateur, $likes = 0, $dislikes = 0) {
        $this->id_suggestion = $id_suggestion;
        $this->contenu = $contenu;
        $this->date_soumission = $date_soumission;
        $this->statut = $statut;
        $this->type_feedback = $type_feedback;
        $this->id_utilisateur = $id_utilisateur;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
    }

    // Getters
    public function getIdSuggestion() { return $this->id_suggestion; }
    public function getContenu() { return $this->contenu; }
    public function getDateSoumission() { return $this->date_soumission; }
    public function getStatut() { return $this->statut; }
    public function getTypeFeedback() { return $this->type_feedback; }
    public function getIdUtilisateur() { return $this->id_utilisateur; }
    public function getLikes() { return $this->likes; }  // Getter pour likes
    public function getDislikes() { return $this->dislikes; }  // Getter pour dislikes

    // Setters
    public function setIdSuggestion($id) { $this->id_suggestion = $id; }
    public function setContenu($contenu) { $this->contenu = $contenu; }
    public function setDateSoumission($date) { $this->date_soumission = $date; }
    public function setStatut($statut) { $this->statut = $statut; }
    public function setTypeFeedback($type) { $this->type_feedback = $type; }
    public function setIdUtilisateur($id) { $this->id_utilisateur = $id; }
    public function setLikes($likes) { $this->likes = $likes; }  // Setter pour likes
    public function setDislikes($dislikes) { $this->dislikes = $dislikes; }  // Setter pour dislikes
}
?>
