<?php
include_once '../../controller/repsuggestionC.php';
include_once '../../model/repsuggestion.php';

$error = "";
$success = "";
$reponseC = new ReponseSuggestionC();

if (isset($_POST["reponse"]) && isset($_POST["date_reponse"]) && isset($_POST["id_suggestion"])) {
    if (!empty($_POST["reponse"]) && !empty($_POST["date_reponse"]) && !empty($_POST["id_suggestion"])) {
        $reponse = new ReponseSuggestion(
            null,
            $_POST["reponse"],
            $_POST["date_reponse"],
            $_POST["id_suggestion"]
        );

        if ($reponseC->addReponse($reponse)) {
            $success = "Réponse ajoutée avec succès.";
            header('Location: listrepsuggestion.php');
            exit();
        } else {
            $error = "Erreur lors de l'ajout de la réponse.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Réponse</title>
    <link rel="stylesheet" href="../css/backoffice.css?v=1.0">
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
            <h1>Ajouter une Réponse</h1>
        </div>

        <div class="form-container">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form id="addReponseSuggestionForm" method="POST" action="">
                <div class="form-group">
                    <label for="reponse">Réponse</label>
                    <textarea class="form-control" name="reponse" id="reponse"></textarea>
                </div>

                <div class="form-group">
                    <label for="date_reponse">Date de Réponse</label>
                    <input type="date" class="form-control" name="date_reponse" id="date_reponse" >
                </div>

                <div class="form-group">
                    <label for="id_suggestion">ID Suggestion</label>
                    <input type="text" class="form-control" name="id_suggestion" id="id_suggestion" >
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Ajouter
                </button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('addReponseSuggestionForm').addEventListener('submit', function(event) {
            const reponse = document.getElementById('reponse').value.trim();
            const dateReponse = document.getElementById('date_reponse').value.trim();
            const idSuggestion = document.getElementById('id_suggestion').value.trim();

            // Validate 'Réponse' field
            if (!reponse) {
                alert('Veuillez entrer une réponse.');
                event.preventDefault();
            }
            // Validate 'Date de Réponse' field
            else if (!dateReponse) {
                alert('Veuillez entrer une date de réponse.');
                event.preventDefault();
            }
            // Validate 'ID Suggestion' field (check if it’s a number)
            else if (!idSuggestion || isNaN(idSuggestion)) {
                alert('Veuillez entrer un ID de suggestion valide.');
                event.preventDefault();
            }
        });
    </script>

</body>
</html>
