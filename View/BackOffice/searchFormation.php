<?php
// Inclusion des fichiers nécessaires
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/clubs.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/clubC.php');
 // Contrôleur pour gérer les clubs et formations

// Initialisation du contrôleur
$clubC = new ClubC();

// Vérifier si un club a été sélectionné
$formations = [];
if (isset($_GET['id_club']) && !empty($_GET['id_club'])) {
    $id_club = intval($_GET['id_club']);
    // Récupérer les formations du club sélectionné
    $formations = $clubC->afficherFormations($id_club);
}

// Récupérer tous les clubs pour remplir le menu déroulant
$clubs = $clubC->getAllClubs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher des Formations</title>
</head>
<body>
    <h1>Rechercher des Formations par Club</h1>

    <!-- Formulaire de sélection d'un club -->
    <form method="GET" action="searchFormation.php">
        <label for="id_club">Sélectionnez un club :</label>
        <select name="id_club" id="id_club">
            <option value="">-- Choisissez un club --</option>
            <?php
            // Remplir le menu déroulant avec les clubs
            foreach ($clubs as $club) {
                $selected = (isset($id_club) && $id_club == $club['id_club']) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($club['id_club']) . '" ' . $selected . '>' . htmlspecialchars($club['nom_club']) . '</option>';
            }
            ?>
        </select>
        <button type="submit">Rechercher</button>
    </form>

    <!-- Affichage des formations -->
    <?php if (!empty($formations)): ?>
        <h2>Formations disponibles pour le club sélectionné :</h2>
        <ul>
            <?php foreach ($formations as $formation): ?>
                <li>
                    <strong><?php echo htmlspecialchars($formation['nom_formation']); ?></strong><br>
                    <?php echo htmlspecialchars($formation['description_formation']); ?><br>
                    Organisme : <?php echo htmlspecialchars($formation['organisme']); ?><br>
                    Prix : <?php echo htmlspecialchars($formation['prix']); ?> TND<br>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif (isset($id_club)): ?>
        <p>Aucune formation trouvée pour ce club.</p>
    <?php endif; ?>
</body>
</html>
