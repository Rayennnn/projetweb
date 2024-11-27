<?php

include '../../model/repsuggestion.php';
include '../../controller/repsuggestionC.php';

$reponseC = new ReponseSuggestionC();
$reponse = null;

// Récupérer les détails de la réponse pour pré-remplir le formulaire
if (isset($_GET['id'])) {
    $reponse = $reponseC->showReponse($_GET['id']);
}

// Gérer la soumission du formulaire pour la mise à jour
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $updatedReponse = new ReponseSuggestion(
        $_POST['id_rep_sugges'],
        $_POST['reponse'],
        $_POST['date_reponse'],
        $_POST['id_suggestion']
    );

    $reponseC->updateReponse($updatedReponse, $_POST['id_rep_sugges']);
    header('Location: listrepsuggestion.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour une réponse</title>
    <link rel="stylesheet" href="../css/backoffice.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Dashboard</h2>
        </div>
        <div class="sidebar-menu">
            <a href="listrepsuggestion.php">
                <i class="fas fa-list"></i> Liste des réponses
            </a>
            <a href="addrepsuggestion.php">
                <i class="fas fa-plus"></i> Ajouter une réponse
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="page-header">
            <h1>Mettre à jour une réponse</h1>
        </div>

        <div class="form-container">
            <form method="POST" action="" class="form-content">
                <input type="hidden" name="id_rep_sugges" value="<?= $reponse['id_rep_sugges'] ?>">
                
                <div class="form-group">
                    <label for="reponse">Réponse</label>
                    <textarea 
                        name="reponse" 
                        id="reponse" 
                        class="form-control" 
                        rows="5" 
                        required
                    ><?= htmlspecialchars($reponse['reponse']); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="date_reponse">Date de réponse</label>
                    <input 
                        type="date" 
                        name="date_reponse" 
                        id="date_reponse" 
                        class="form-control" 
                        value="<?= $reponse['date_reponse']; ?>" 
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="id_suggestion">ID Suggestion</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        value="<?= $reponse['id_suggestion']; ?>" 
                        readonly
                    >
                    <input 
                        type="hidden" 
                        name="id_suggestion" 
                        value="<?= $reponse['id_suggestion']; ?>"
                    >
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="listrepsuggestion.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
