<?php
include '../../controller/suggestionC.php';

$suggestionC = new SuggestionC();
$suggestionC->deleteSuggestion($_GET["id"]);
header('location.listSuggestion.php');

?>