<?php
// Inclure le contrôleur des questions
require_once "../../Controller/questionC.php";

// Vérifier si la requête est en POST et contient une valeur de recherche
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_value'])) {
    // Sécuriser la valeur de recherche
    $search_value = htmlspecialchars($_POST['search_value']);

    // Créer une instance du contrôleur
    $questionC = new questionC();

    // Effectuer la recherche
    $results = $questionC->recherche($search_value);

    // Générer les lignes du tableau
    if (!empty($results)) {
        foreach ($results as $question) {
            echo "<tr>";
            echo "<td class='text-center'>" . htmlspecialchars($question['id']) . "</td>";
            echo "<td class='text-center'>" . htmlspecialchars($question['titre']) . "</td>";
            echo "<td class='text-center'>" . htmlspecialchars($question['id_auteur']) . "</td>";
            echo "<td class='text-center'>" . htmlspecialchars($question['date']) . "</td>";
            echo "<td class='text-center'>" . htmlspecialchars($question['type']) . "</td>";
            echo "<td class='text-center'>" . htmlspecialchars($question['ideal_rep']) . "</td>";
            echo "<td class='text-center'>";
            echo "<button class='btn btn-primary' onclick=\"window.location.href='modifierquestion.php?id=" . htmlspecialchars($question['id']) . "'\">";
            echo "<i class='fas fa-pencil-alt'></i> ✏️</button>";
            echo "<button class='btn btn-danger rounded-circle btn-icon' onclick=\"window.location.href='supprimerquestion.php?id=" . htmlspecialchars($question['id']) . "'\">";
            echo "<i class='fas fa-trash-alt'></i> 🗑️</button>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        // Aucune correspondance trouvée
        echo "<tr><td colspan='6' class='text-center'>Aucune question trouvée.</td></tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>Requête invalide.</td></tr>";
}
?>