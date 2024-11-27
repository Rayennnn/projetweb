<?php
include "../../Controller/reponseC.php";

$reponseC=new reponseC();

$id=$_GET['id'];

if(isset($id)){
    $reponseC->supprimereponse($id);
    header('refresh:0;url=affichereponse.php');
}


?>