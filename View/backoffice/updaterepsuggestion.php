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
        <a href="addrepsuggestion.php"><i class="fas fa-plus"></i> Ajouter une réponse</a>
            <a href="listrepsuggestion.php"><i class="fas fa-list"></i> Liste des réponses</a>
            <a href="listSuggestions.php"><i class="fas fa-list"></i> Liste des suggestions et reclamtions</a>
            <a href="statistiques.php" class="nav-link"><i class="fas fa-chart-pie"></i>Statistiques</a>
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
    <style>
    .main-content{
   
   padding: 20px;
   margin-left: 260px; 
   transition: all 0.3s ease;
}

/* En-tête de page */
.page-header {
   background: white;
   padding: 20px;
   border-radius: 10px;
   box-shadow: 0 2px 10px rgba(0,0,0,0.05);
   margin-bottom: 25px;
   display: flex;
   justify-content: space-between;
   align-items: center;
}

.page-header h1 {
   margin: 0;
   font-size: 24px;
   color: var(--text);
   font-weight: 600;
}
.form-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    padding: 25px;
    margin-bottom: 25px;
    width: 1000px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: var(--text);
    font-weight: 500;
}

.form-control {
    width: 90%;
    padding: 10px 15px;
    border: 1px solid var(--border);
    border-radius: 5px;
    font-size: 15px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(52,152,219,0.1);
    outline: none;
}

/* Boutons */
.btn {
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background: var(--accent);
    color: white;
}

.btn-primary:hover {
    background: #2980b9;
}

.btn-secondary {
    background: #95a5a6;
    color: white;
}

.btn-secondary:hover {
    background: #7f8c8d;
}

.btn-danger {
    background: var(--danger);
    color: white;
}

.btn-danger:hover {
    background: #c0392b;
}

/* Alertes */
.alert {
    padding: 15px 20px;
    border-radius: 5px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Badges */
.badge {
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
}

.badge-success {
    background: var(--success);
    color: white;
}

.badge-warning {
    background: var(--warning);
    color: white;
}

.badge-danger {
    background: var(--danger);
    color: white;
}


</style>
    
</body>
</html>
