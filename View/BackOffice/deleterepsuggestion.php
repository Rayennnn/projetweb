<?php
include_once 'C:\xampp\htdocs\PROJETWEB\controller\repsuggestionC.php';

// Vérifie si l'ID est fourni dans l'URL
if (isset($_GET["id"])) {
    $reponseC = new ReponseSuggestionC();

    // Appelle la méthode pour supprimer la réponse
    $reponseC->deleteReponse($_GET["id"]);

    // Redirige vers la page de liste après suppression
    header('Location: listereponsesug.php');
    exit();
} else {
    // Si aucun ID n'est fourni, redirige avec un message ou gère l'erreur
    echo "Erreur : aucun ID fourni pour la suppression.";
}
?>
