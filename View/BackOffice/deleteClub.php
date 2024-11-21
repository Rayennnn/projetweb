<?php
include ('../../Controller/clubC.php');
$clubC = new Clubc();
$clubC->DeleteClub($_GET['id_club']);
header('Location: listClubs.php');




?>