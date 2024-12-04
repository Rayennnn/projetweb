<?php

include '../../model/suggestion.php';
include '../../controller/suggestionC.php';


$suggestionC = new SuggestionC();
$suggestion = null;

// Get the suggestion details to pre-fill the form
if (isset($_GET['id'])) {
    $suggestion = $suggestionC->showSuggestion($_GET['id']);
}

// Handle form submission for updating the suggestion
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $updatedSuggestion = new Suggestion(
        $_POST['id_suggestion'],
        $_POST['contenu'],
        null, // Date non modifiée
        $_POST['statut'],
        $_POST['type_feedback'],
        $_POST['id_utilisateur']
    );

    $suggestionC->updateSuggestion($updatedSuggestion, $_POST['id_suggestion']);
    header('Location: listSuggestions.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour une suggestion</title>
    <link rel="stylesheet" href="../css/backoffice.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Dashboard</h2>
        </div>
        <div class="sidebar-menu">
            <a href="listSuggestions.php">
                <i class="fas fa-list"></i> Liste des suggestions
            </a>
            <a href="addsuggestion.php">
                <i class="fas fa-plus"></i> Ajouter une suggestion
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="page-header">
            <h1>Mettre à jour une suggestion</h1>
        </div>

        <div class="form-container">
            <form method="POST" action="" class="form-content">
                <input type="hidden" name="id_suggestion" value="<?= htmlspecialchars($suggestion['id_suggestion']); ?>">

                <div class="form-group">
                    <label for="contenu">Contenu</label>
                    <textarea name="contenu" id="contenu" class="form-control" rows="5"><?= htmlspecialchars($suggestion['contenu']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="type_feedback">Type de feedback</label>
                    <select name="type_feedback" id="type_feedback" class="form-control">
                        <option value="reclamation" <?= $suggestion['type_feedback'] === 'reclamation' ? 'selected' : '' ?>>Réclamation</option>
                        <option value="suggestion" <?= $suggestion['type_feedback'] === 'suggestion' ? 'selected' : '' ?>>Suggestion</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="statut">Statut</label>
                    <select name="statut" id="statut" class="form-control">
                        <option value="en attente" <?= $suggestion['statut'] === 'en attente' ? 'selected' : '' ?>>En attente</option>
                        <option value="traitée" <?= $suggestion['statut'] === 'traitée' ? 'selected' : '' ?>>Traitée</option>
                        <option value="rejetée" <?= $suggestion['statut'] === 'rejetée' ? 'selected' : '' ?>>Rejetée</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_utilisateur">ID Utilisateur</label>
                    <input type="hidden" name="id_utilisateur" value="<?= htmlspecialchars($suggestion['id_utilisateur']); ?>">
                    <input type="text" class="form-control" value="<?= htmlspecialchars($suggestion['id_utilisateur']); ?>" readonly>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="listSuggestions.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('updateSuggestionForm').addEventListener('submit', function(event) {
            const contenu = document.getElementById('contenu').value.trim();
            const typeFeedback = document.getElementById('type_feedback').value;
            const statut = document.getElementById('statut').value;

            // Validate 'Contenu' field (should not be empty)
            if (!contenu) {
                alert('Veuillez entrer le contenu.');
                event.preventDefault();
            }
            // Validate 'Type de feedback' field (should not be empty)
            else if (!typeFeedback) {
                alert('Veuillez sélectionner un type de feedback.');
                event.preventDefault();
            }
            // Validate 'Statut' field (should not be empty)
            else if (!statut) {
                alert('Veuillez sélectionner un statut.');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
