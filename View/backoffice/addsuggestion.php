<?php
include '../../controller/suggestionC.php';
include '../../model/suggestion.php';

$error = "";
$success = "";
$suggestionC = new SuggestionC();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ajout de débogage
    var_dump($_POST);  // Pour voir les données reçues

    if (
        isset($_POST["contenu"]) && 
        isset($_POST["type_feedback"]) && 
        isset($_POST["id_utilisateur"]) &&
        !empty($_POST["contenu"]) && 
        !empty($_POST["type_feedback"]) && 
        !empty($_POST["id_utilisateur"])
    ) {
        try {
            $suggestion = new Suggestion(
                null,
                $_POST['contenu'],
                date('Y-m-d'),
                'en attente',
                $_POST['type_feedback'],
                $_POST['id_utilisateur']
            );

            if ($suggestionC->addSuggestion($suggestion)) {
                $success = "Suggestion ajoutée avec succès";
                // Rediriger vers une page de confirmation
                header('Location: ../contact.html');  // Créez cette page
                exit();
            } else {
                $error = "Erreur lors de l'ajout de la suggestion";
            }
        } catch (Exception $e) {
            $error = "Erreur : " . $e->getMessage();
        }
    } else {
        $error = "Veuillez remplir tous les champs obligatoires";
    }
}

// Si c'est une requête AJAX ou si une erreur s'est produite
if (!empty($error)) {
    echo json_encode(['error' => $error]);
} elseif (!empty($success)) {
    echo json_encode(['success' => $success]);
}
?>
