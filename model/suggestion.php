<?php
class Suggestion {
    private $id_suggestion;
    private $contenu;
    private $date_soumission;
    private $statut;
    private $type_feedback;
    private $id_utilisateur;

    public function __construct($id_suggestion, $contenu, $date_soumission, $statut, $type_feedback, $id_utilisateur) {
        $this->id_suggestion = $id_suggestion;
        $this->contenu = $contenu;
        $this->date_soumission = $date_soumission;
        $this->statut = $statut;
        $this->type_feedback = $type_feedback;
        $this->id_utilisateur = $id_utilisateur;
    }

    // Getters
    public function getIdSuggestion() { return $this->id_suggestion; }
    public function getContenu() { return $this->contenu; }
    public function getDateSoumission() { return $this->date_soumission; }
    public function getStatut() { return $this->statut; }
    public function getTypeFeedback() { return $this->type_feedback; }
    public function getIdUtilisateur() { return $this->id_utilisateur; }

    // Setters
    public function setIdSuggestion($id) { $this->id_suggestion = $id; }
    public function setContenu($contenu) { $this->contenu = $contenu; }
    public function setDateSoumission($date) { $this->date_soumission = $date; }
    public function setStatut($statut) { $this->statut = $statut; }
    public function setTypeFeedback($type) { $this->type_feedback = $type; }
    public function setIdUtilisateur($id) { $this->id_utilisateur = $id; }
}
?>
