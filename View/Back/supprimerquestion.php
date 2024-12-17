<?php
include "../../Controller/questionC.php";

$questionC=new questionC();

$id=$_GET['id'];

if(isset($id)){
    $questionC->supprimerquestion($id);
    header('refresh:0;url=afficherquestion.php');
}

?>