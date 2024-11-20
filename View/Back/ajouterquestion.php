<?php
include ('C:/xampp/htdocs/NEW KHEDMA/Controller/questionC.php');


$questionC=new questionC();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST["titre"]) &&
    isset($_POST["id_auteur"]) &&
    isset($_POST["date"]) &&
    isset($_POST["type"]) 
  ){
    if (
      !empty($_POST["titre"]) &&
      !empty($_POST["id_auteur"]) &&
      !empty($_POST["date"]) &&
      !empty($_POST["type"])
     ) {
      $question = new question( $_POST["titre"], $_POST["id_auteur"], $_POST["date"],$_POST["type"]);
      $questionC->ajouterquestion($question);
      header('refresh:0;url=afficherquestion.php');
    }
  } else {
    echo '<script> alert "missing information"; </script>';
  }
}

?>

<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Psychoz admin</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-primary">
  <main class="main-content position-relative border-radius-lg ">
<form method="POST" action="">
  <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Ajouter questions</p>
                <button class="btn btn-primary btn-sm ms-auto" type="submit" name="submit" onclick="checkInput() ">Ajouter questions</button>
              </div>
            </div>
            <div class="card-body">
              <p class="text-uppercase text-sm">question Information</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Identifiant </label>
                    <input class="form-control" type="number" name="id" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Titre</label>
                    <input class="form-control" type="text" name="titre">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">ID_Auteur</label>
                    <input class="form-control" type="number" name="id_auteur">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Date</label>
                    <input class="form-control" type="text" name="date">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Type</label>
                    <input class="form-control" type="text" name="type">
                  </div>
                </div>
                
            <script>

                      
function checkInput() {
  const titre = document.getElementById("titre");
  const id_auteur = document.getElementById("id_auteur");
  const date = document.getElementById("date");
  const type = document.getElementById("type");



if (titre.value.length === 0) {
  console.log("Input field is empty");
  alert("Please enter a number");

} else {
  console.log("Input field is not empty");
}

if (id_auteur.value.length === 0) {
  console.log("Input field is empty");
  alert("Please enter a number in the input field");

} else {
  console.log("Input field is not empty");
}

if (date.value.length === 0) {
  console.log("Input field is empty");
  alert("Please enter a Realisateur in the input field");

} else {
  console.log("Input field is not empty");
}

if (type.value.length === 0) {
  console.log("Input field is empty");
  alert("Please enter a type in the input field");

} else {
  console.log("Input field is not empty");
}


}

