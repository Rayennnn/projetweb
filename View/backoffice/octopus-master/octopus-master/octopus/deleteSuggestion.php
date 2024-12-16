<?php
include_once 'C:\xampp\htdocs\projetweb\controller\suggestionC.php';

$suggestionC = new SuggestionC();
$suggestionC->deleteSuggestion($_GET["id"]);
header('location: listesuggestion.php');
exit();
?>