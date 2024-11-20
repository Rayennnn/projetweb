<?php
include "../../controller/questionC.php";

$questionC=new questionC();

$id=$_GET['id'];

if(isset($_POST["titre"]) &&
  isset($_POST["id_auteur"]) &&
  isset($_POST["date"]) &&
  isset($_POST["type"])
){
  if (!empty($_POST["titre"]) &&
    !empty($_POST["id_auteur"]) &&
    !empty($_POST["date"]) &&
    !empty($_POST["type"]) 
  ){
  $question=new question($_POST["titre"],$_POST["id_auteur"],$_POST["date"],$_POST["type"]);
  $questionC->modifierquestion($question,$id);
  header('refresh:0;url=afficherquestion.php');
  }
}else{
  echo '<script> alert "missing information"; </script>';
}
?>

<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Rima rassha kbir</title>
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
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" target="_blank">
        <img src="assets/img/psychoz.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Rima rasha kbir</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="afficherutilisateur.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Gestion Questions</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <?php if(isset($id)){
      $question=$questionC->getquestion($id);
    } ?>
<form method="POST" action="">
  <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Modifier Questions</p>
                <button class="btn btn-primary btn-sm ms-auto" type="submit" name="submit" onclick="checkInput() ">Modifier</button>
              </div>
            </div>
            <div class="card-body">
              <p class="text-uppercase text-sm">question Information</p>
              <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">id </label>
                    <input class="form-control" type="text" name="id" value="<?php echo $question['id']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">ID_Auteur</label>
                    <input class="form-control" type="id_auteur" value="<?php echo $question['id_auteur']; ?>" name="id_auteur">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Titre </label>
                    <input class="form-control" type="text" value="<?php echo $question['titre']; ?>" name="titre" >
                  </div>
                </div>
                <div class="col-md-6">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Type </label>
                    <input class="form-control" type="type" value="<?php echo $question['type']; ?>" name="type">
                  </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Date </label>
                    <input class="form-control" type="date" value="<?php echo $question['date']; ?>" name="date">
                  </div>
                </div>
                <div class="col-md-6">
 
  </form>
  <script>

                      
function checkInput() {
  const fileToUpload = document.getElementById("fileToUpload");
  const date = document.getElementById("date");
  const Prix = document.getElementById("Prix");
  const Realisateur = document.getElementById("Realisateur");
  const description = document.getElementById("description");
  const titre = document.getElementById("titre");


if (fileToUpload.value.length === 0) {
  console.log("Input field is empty");
  alert("Please upload image");

} else {
  console.log("Input field is not empty");
}

if (Prix.value.length === 0) {
  console.log("Input field is empty");
  alert("Please enter a Prix in the input field");

} else {
  console.log("Input field is not empty");
}

if (Realisateur.value.length === 0) {
  console.log("Input field is empty");
  alert("Please enter a Realisateur in the input field");

} else {
  console.log("Input field is not empty");
}

if (description.value.length === 0) {
  console.log("Input field is empty");
  alert("Please enter a description in the input field");

} else {
  console.log("Input field is not empty");
}

if (date.value.length === 0) {
  console.log("Input field is empty");
  alert("Please enter a Date in the input field");

} else {
  console.log("Input field is not empty");
}

if (titre.value.length === 0) {
  console.log("Input field is empty");
  alert("Please enter a titre in the input field");

} else {
  console.log("Input field is not empty");
}

}
                
</script>
  </main>
</body>
</html>