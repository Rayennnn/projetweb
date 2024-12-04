<?php
include '../../controller/suggestionC.php';

$suggestionC = new SuggestionC();
$suggestionC->deleteSuggestion($_GET["id"]);
header('location: listSuggestions.php');
exit();
?>