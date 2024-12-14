<?php
// Inclure le contrôleur pour obtenir les suggestions
include_once '../../controller/suggestionC.php';

$suggestionC = new SuggestionC();

// Récupérer les critères de filtre depuis la requête
$type_feedback = isset($_POST['type_feedback']) ? $_POST['type_feedback'] : '';
$statut = isset($_POST['statut']) ? $_POST['statut'] : '';
$date_soumission = isset($_POST['date_soumission']) ? $_POST['date_soumission'] : '';

// Appliquer les filtres si définis, sinon afficher tout
if ($type_feedback || $statut || $date_soumission) {
    $list = $suggestionC->listSuggestionsFiltered($type_feedback, $statut, $date_soumission);
} else {
    $list = $suggestionC->listSuggestions(); // Méthode existante pour tout afficher
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Suggestions</title>
    <link rel="stylesheet" href="../css/backoffice.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Dashboard</h2>
        </div>
        <div class="sidebar-menu">
            <a href="addrepsuggestion.php"><i class="fas fa-plus"></i> Ajouter une réponse</a>
            <a href="listrepsuggestion.php"><i class="fas fa-list"></i> Liste des réponses</a>
            <a href="listSuggestions.php"><i class="fas fa-list"></i> Liste des suggestions et réclamations</a>
            <a href="statistiques.php" class="nav-link"><i class="fas fa-chart-pie"></i>Statistiques</a>
        </div>
    </div>

    <div class="main-content">
        <div class="page-header">
            <h1>Liste des Suggestions et réclamations</h1>
        </div>

        <!-- Barre de filtrage -->
        <form method="POST" action="listSuggestions.php" class="filter-form">
            <div class="form-group">
                <label for="type_feedback">Type de feedback</label>
                <select name="type_feedback" id="type_feedback" class="form-control">
                    <option value="">Tous</option>
                    <option value="reclamation" <?= $type_feedback === 'reclamation' ? 'selected' : '' ?>>Réclamation</option>
                    <option value="suggestion" <?= $type_feedback === 'suggestion' ? 'selected' : '' ?>>Suggestion</option>
                </select>
            </div>
            <div class="form-group">
                <label for="statut">Statut</label>
                <select name="statut" id="statut" class="form-control">
                    <option value="">Tous</option>
                    <option value="en attente" <?= $statut === 'en attente' ? 'selected' : '' ?>>En attente</option>
                    <option value="traitée" <?= $statut === 'traitée' ? 'selected' : '' ?>>Traitée</option>
                    <option value="rejetée" <?= $statut === 'rejetée' ? 'selected' : '' ?>>Rejetée</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date_soumission">Date de soumission</label>
                <input type="date" name="date_soumission" id="date_soumission" class="form-control" value="<?= $date_soumission ?>">
            </div>
            <button type="submit" class="btn btn-primary">Filtrer</button>
            <a href="listSuggestions.php" class="btn btn-reset">Afficher tout</a>
        </form>

        <!-- Table des suggestions -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Contenu</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Type</th>
                        <th>ID Utilisateur</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $suggestion): ?>
                        <tr>
                            <td><?= $suggestion['id_suggestion']; ?></td>
                            <td><?= $suggestion['contenu']; ?></td>
                            <td><?= $suggestion['date_soumission']; ?></td>
                            <td><?= $suggestion['statut']; ?></td>
                            <td><?= $suggestion['type_feedback']; ?></td>
                            <td><?= $suggestion['id_utilisateur']; ?></td>
                            <td>
                                <a href="deleteSuggestion.php?id=<?= $suggestion['id_suggestion']; ?>" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Supprimer
                                </a>
                            </td>
                            <td>
                                <a href="updateSuggestion.php?id=<?= $suggestion['id_suggestion']; ?>" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">Aucune suggestion ou réclamation trouvée.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<style>/* Style pour la barre de filtrage */
      
      

  
.filter-form {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    padding: 14px 20px;
    background-color: #fff;
    border: 1.2px solid #ddd;
    border-radius: 8px;
    margin-bottom: 20px;
    max-width: 1200px; /* Limiter la largeur du formulaire */
    margin: 15 auto; /* Centrer le formulaire */
}

/* Groupes de champs */
.filter-form .form-group {
    display: flex;
    gap: 10px;
    flex-direction: column;
    margin-right: 15px;
    flex-basis: 200px; /* Limiter la largeur des éléments de formulaire */
}

/* Labels des champs */
.filter-form .form-group label {
    margin-bottom: 6px;
    font-size: 16px;
    font-weight: bold;
    color: #333;
}

/* Sélecteurs déroulants */
.filter-form .form-group select {
    padding: 7px 12px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f8f9fa;
    color: #333;
    width: 100%; /* Adapter la largeur */
}

/* Boutons */
.filter-form .btn {
    padding: 10px 18px;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
    margin-top: 10px;
}

.filter-form .btn-primary {
    background-color: #21912b;
    color: #fff;
}

.filter-form .btn-primary:hover {
    background-color: #1c7323;
    transform: scale(1.05);
}

.filter-form .btn-reset {
    background-color: #6c757d;
    color: #fff;
    margin-left: 10px;
}

.filter-form .btn-reset:hover {
    background-color: #5a6268;
    transform: scale(1.05);
}
</style>