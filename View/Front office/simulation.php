<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulateur d'Éligibilité aux Bourses</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Ajoutez votre fichier CSS ici -->
</head>
<body>
    <div class="container">
        <h1>Simulateur d'Éligibilité aux Bourses</h1>
        <form method="POST" action="">
            <label for="age">Âge :</label>
            <input type="number" id="age" name="age" required>

            <label for="niveau">Niveau d'études :</label>
            <select id="niveau" name="niveau" required>
                <option value="Licence">Licence</option>
                <option value="Master">Master</option>
                <option value="Doctorat">Doctorat</option>
            </select>

            <label for="langue">Compétences linguistiques :</label>
            <select id="langue" name="langue" required>
                <option value="Français">Français</option>
                <option value="Anglais">Anglais</option>
                <option value="Bilingue">Bilingue</option>
            </select>

            <button type="submit">Vérifier l'éligibilité</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $age = intval($_POST['age']);
            $niveau = $_POST['niveau'];
            $langue = $_POST['langue'];

            // Logique d'évaluation de l'éligibilité
            $recommandations = [];

            // Exemple de critères d'éligibilité
            if ($age < 18) {
                $recommandations[] = "Vous devez avoir au moins 18 ans pour postuler à la plupart des bourses.";
            }

            if ($niveau == "Licence" && $age > 25) {
                $recommandations[] = "Les bourses pour les étudiants de Licence sont généralement destinées aux étudiants de moins de 25 ans.";
            }

            if ($niveau == "Master" && $langue != "Bilingue") {
                $recommandations[] = "Pour les programmes de Master, une compétence bilingue est souvent requise.";
            }

            if (empty($recommandations)) {
                echo "<h2>Félicitations ! Vous êtes éligible à plusieurs bourses.</h2>";
            } else {
                echo "<h2>Recommandations :</h2><ul>";
                foreach ($recommandations as $recommandation) {
                    echo "<li>$recommandation</li>";
                }
                echo "</ul>";
            }
        }
        ?>
    </div>
</body>
</html>