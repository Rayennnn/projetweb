<?php
// Inclure le contrôleur pour obtenir les suggestions
include_once '../../controller/suggestionC.php';

$suggestionC = new SuggestionC();
$list = $suggestionC->listSuggestions();
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
            <a href="listSuggestions.php"><i class="fas fa-list"></i> Liste des suggestions et reclamtions</a>
            <a href="statistiques.php" class="nav-link"><i class="fas fa-chart-pie"></i>Statistiques</a>
        </div>
        
    </div>

    <div class="main-content">
        <div class="page-header">
            <h1>Liste des Suggestions et reclamations</h1>
        </div>

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
                    <?php foreach($list as $suggestion): ?>
                    <tr>
                        <td><?php echo $suggestion['id_suggestion']; ?></td>
                        <td><?php echo $suggestion['contenu']; ?></td>
                        <td><?php echo $suggestion['date_soumission']; ?></td>
                        <td><?php echo $suggestion['statut']; ?></td>
                        <td><?php echo $suggestion['type_feedback']; ?></td>
                        <td><?php echo $suggestion['id_utilisateur']; ?></td>
                        <td>
                            <a href="deleteSuggestion.php?id=<?php echo $suggestion['id_suggestion']; ?>" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                        </td>
                        <td>
                            <a href="updateSuggestion.php?id=<?php echo $suggestion['id_suggestion']; ?>" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>