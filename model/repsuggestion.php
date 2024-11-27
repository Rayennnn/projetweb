<?php
class ReponseSuggestion {
    private $id_rep_sugges;
    private $reponse;
    private $date_reponse;
    private $id_suggestion;

    public function __construct($id_rep_sugges, $reponse, $date_reponse, $id_suggestion) {
        $this->id_rep_sugges = $id_rep_sugges;
        $this->reponse = $reponse;
        $this->date_reponse = $date_reponse;
        $this->id_suggestion = $id_suggestion;
    }

    // Getters
    public function getIdRepSugges() {
        return $this->id_rep_sugges;
    }

    public function getReponse() {
        return $this->reponse;
    }

    public function getDateReponse() {
        return $this->date_reponse;
    }

    public function getIdSuggestion() {
        return $this->id_suggestion;
    }

    // Setters
    public function setReponse($reponse) {
        $this->reponse = $reponse;
    }

    public function setDateReponse($date_reponse) {
        $this->date_reponse = $date_reponse;
    }

    public function setIdSuggestion($id_suggestion) {
        $this->id_suggestion = $id_suggestion;
    }
}
?>
