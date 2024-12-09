<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/clubC.php');// Inclure le contrôleur des clubs
$clubC = new Clubc(); // Créer une instance de Clubc

// Vérifiez si l'ID du club est passé en paramètre
if (isset($_GET['id_club'])) {
    $id_club = intval($_GET['id_club']);
    error_log("Incrémentation des clics pour le club ID: " . $_GET['id_club']); // Log pour débogage
    $clubC->incrementClicks($_GET['id_club']);
    header('Location: /PROJETWEB/View/FrontOffice/online-courses-html-template/club-details.php?id=' . $_GET['id_club']);
}

?>