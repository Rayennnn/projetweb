<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/favorisC.php');

//session_start();
//$user_id = $_SESSION['user_id'];
//$favorisC = new FavorisC();
$user_id =1;
$favorisC = new FavorisC();

// Récupérer les formations favorites avec leurs dates
$dates = $favorisC->getFavoriteFormationDates($user_id);



header('Content-Type: application/json');
echo json_encode($dates);