<?php
include_once '../../config.php';
include_once '../../model/suggestion.php';
include_once '../../controller/suggestionC.php';

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Création de l'objet suggestion
        $suggestion = new Suggestion(
            null,
            $_POST['contenu'],
            date('Y-m-d H:i:s'),
            'en attente',
            $_POST['type_feedback'],
            $_POST['id_utilisateur']
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
    header('Location: /projetweb/view/FrontOffice/online-courses-html-template/contact.html?error=' . urlencode($e->getMessage()));
}
?>