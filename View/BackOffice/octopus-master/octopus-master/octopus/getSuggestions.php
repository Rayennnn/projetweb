<?php
include_once 'C:\xampp\htdocs\projetweb\controller\suggestionC.php';

header('Content-Type: application/json');

try {
    // Récupération des paramètres de la page et de la limite
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 2;
    $offset = ($page - 1) * $limit;

    // Création d'une instance de SuggestionC
    $suggestionC = new SuggestionC();
    // Récupération des suggestions pour la page actuelle
    $suggestions = $suggestionC->getSuggestions($limit, $offset);
    // Comptage total des suggestions
    $total = $suggestionC->countSuggestions();

    // Retour des suggestions et du total sous forme de JSON
    echo json_encode(['suggestions' => $suggestions, 'total' => $total]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
