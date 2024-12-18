<?php
include ('../../Controller/formationC.php');
$formationC = new Formationc();
$formationC->deleteFormation($_GET['id_formation']);
header('Location: listFormations.php');
?>
