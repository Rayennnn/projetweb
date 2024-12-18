<?php
include_once 'C:\xampp\htdocs\PROJETWEB\controller\suggestionC.php';

// Récupérer les données JSON envoyées
$data = json_decode(file_get_contents("php://input"), true);
$id_suggestion = $data['id_suggestion'];
$action = $data['action'];

// Créer une instance de SuggestionC
$suggestionC = new SuggestionC();

// Appeler la méthode updateFeedback
$result = $suggestionC->updateFeedback($id_suggestion, $action);

// Retourner le résultat en JSON
echo json_encode($result);
?>
