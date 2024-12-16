<?php

include_once 'C:\xampp\htdocs\projetweb\model\suggestion.php';
include_once 'C:\xampp\htdocs\projetweb\controller\suggestionC.php';

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $contenu = $_POST['contenu'];
        $type_feedback = $_POST['type_feedback'];
        $mail = $_POST['mail']; // Récupérer l'email soumis par l'utilisateur

        // Création de l'objet suggestion avec l'email
        $suggestion = new Suggestion(
            null,                       // ID de la suggestion (généré automatiquement par la base de données)
            $contenu,                   // Contenu de la suggestion
            date('Y-m-d H:i:s'),        // Date de soumission (actuelle)
            'en attente',               // Statut par défaut
            $type_feedback,             // Type de feedback soumis (suggestion/réclamation)
            $mail                       // Email de l'utilisateur
        );

        // Ajout de la suggestion
        $suggestionC = new SuggestionC();
        $result = $suggestionC->addSuggestion($suggestion);
        
        if ($result) {
            header('Location: /projetweb/view/FrontOffice/online-courses-html-template/contact.html?success=1');
        } else {
            throw new Exception("Erreur lors de l'ajout de la suggestion");
        }
    }
} catch (Exception $e) {
    // Redirection en cas d'erreur
    header('Location: /projetweb/view/FrontOffice/online-courses-html-template/contact.html?error=' . urlencode($e->getMessage()));
}
?>
