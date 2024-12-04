<?php
// Inclure le contrôleur pour obtenir les réponses
include_once '../../controller/repsuggestionC.php';

$reponseC = new ReponseSuggestionC();
$listReponses = $reponseC->listReponses();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réponses</title>
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
            <h1>Liste des Réponses aux Suggestions</h1>
        </div>

        <div class="table-container">
            <table>
            <thead>
    <tr>
        <th>ID</th>
        <th>Réponse</th>
        <th>Date</th>
        <th>ID Suggestion</th>
        <th>Contenu de la Suggestion</th>
        <th colspan="2"></th>
    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listReponses as $reponse): ?>
                    <tr>
                        <td><?php echo $reponse['id_rep_sugges']; ?></td>
                        <td><?php echo $reponse['reponse']; ?></td>
                        <td><?php echo $reponse['date_reponse']; ?></td>
                        <td><?php echo $reponse['id_suggestion']; ?></td>
                        <td><?php echo $reponse['contenu']; ?></td> <!-- Ajout de la colonne contenu -->
                        <td>
                            <a href="deleterepsuggestion.php?id=<?php echo $reponse['id_rep_sugges']; ?>" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                        </td>
                        <td>
                            <a href="updaterepsuggestion.php?id=<?php echo $reponse['id_rep_sugges']; ?>" class="btn btn-primary">
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
