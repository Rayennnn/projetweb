<?php
include "../../Controller/reponseC.php";
$reponseC = new reponseC();
$listereponse = $reponseC->affichereponse();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>

<!-- Basic -->
<meta charset="UTF-8">

<title>Dashboard | JSOFT Themes | JSOFT-Admin</title>
<meta name="keywords" content="HTML5 Admin Template" />
<meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
<meta name="author" content="JSOFT.net">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
<link rel="stylesheet" href="assets/vendor/morris/morris.css" />

<!-- Theme CSS -->
<link rel="stylesheet" href="assets/stylesheets/theme.css" />

<!-- Skin CSS -->
<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

<!-- Head Libs -->
<script src="assets/vendor/modernizr/modernizr.js"></script>


  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>liste Reponses</title>

  <!-- External CSS (Bootstrap, Icons) -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />

  <!-- Custom CSS -->
  <style>
  body {
    background: linear-gradient(135deg, #f7f9fc, #eaf1f8);
    font-family: 'Open Sans', sans-serif;
    margin: 0;
    padding: 0;
  }

  /* Side Navigation */
  .sidenav {
    background-color: #3f72af;
    color: white;
    border-radius: 10px;
    padding: 10px 0;
    position: fixed;
    width: 220px;
    height: 100vh;
  }

  .sidenav-header {
    padding: 20px;
    text-align: center;
    background-color: #2a4d84;
    border-radius: 10px 10px 0 0;
  }

  .sidenav-header .navbar-brand {
    color: #fff;
    font-size: 1.8rem;
    font-weight: bold;
  }

  .navbar-nav {
    padding: 0;
  }

  .navbar-nav .nav-link {
    color: #ddd;
    padding: 15px 20px;
    font-size: 1rem;
    text-transform: uppercase;
    display: block;
    transition: all 0.3s ease;
  }

  .navbar-nav .nav-link:hover {
    background-color: #2a4d84;
    color: #fff;
    border-radius: 5px;
  }

  .navbar-nav .nav-link.active {
    background-color: #4e73df;
    color: #fff;
    border-radius: 5px;
    font-weight: bold;
  }

  /* Main Content */
  .main-content {
    margin-left: 240px;
    padding: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  }

  .card {
    background-color: #fff;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    width: 70%;
    max-width: 900px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .card-header {
    background-color: #4e73df;
    color: #021a30;
    font-size: 2rem;
    font-weight: bold;
    padding: 5px;
    border-radius: 10px 10px 0 0;
    text-align: center; 
  }

  .card-body {
    padding: 20px;
  }

  body {
    background-color: #5666d4; /* Matches the background color */
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.table {
    width: 80%; /* Center the table */
    margin: 20px auto; /* Add spacing around the table */
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-collapse: collapse; /* Remove extra spaces between cells */
    overflow: hidden;
}

.table th, .table td {
    padding: 12px 20px; /* Increase padding for a cleaner look */
    text-align: left; /* Align text to the left */
    font-size: 0.9rem;
}

.table th {
    background-color: #f8f9fc;
    color: #4e73df;
    font-weight: bold;
    text-transform: uppercase;
    border-bottom: 2px solid #e2e6ea;
}

.table tr {
    border-bottom: 1px solid #ddd; /* Add row separators */
}

.table tr:last-child {
    border-bottom: none; /* Remove border for the last row */
}

.table td {
    color: #333; /* Text color for cells */
}

  .btn-icon {
  width: 40px; /* Set width to make buttons circular */
  height: 40px; /* Set height to make buttons circular */
  font-size: 1.2rem; /* Slightly larger emoji size */
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%; /* Make buttons perfectly circular */
  border: none; /* Remove default borders */
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-icon:hover {
  transform: scale(1.1); /* Slight zoom effect on hover */
}
  .btn {
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  .btn-primary {
    background-color: #007bff;
    color: #fff;
  }

  .btn-primary:hover {
    background-color: #0056b3;
    transform: scale(1.05);
  }

  .btn-danger {
    background-color: #e3342f;
    color: #fff;
  }

  .btn-danger:hover {
    background-color: #cc1f1a;
    transform: scale(1.05);
  }

  .btn-add-question {
    background-color: #021a30
    color: #fff;
  }

  .btn-add-question:hover {
    background-color: #343a40;
    transform: scale(1.05);
  }

  /* Position the Add Button */
  .position-absolute {
    position: absolute;
    top: 160px;
    right: 700px;
  }
  </style>

  
</head>
<body class="g-sidenav-show bg-primary">

  <!-- Sidebar -->
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
      <a class="navbar-brand m-0" target="_blank">
        <img src="logo1.PNG" class="navbar-brand-img h-50" alt="logo">
        <span class="ms-1 font-weight-bold">ADMINS</span>
      </a>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Liste des Réponses</h6>
              <div class="position-absolute top-3 start-100 translate-middle-x">
                <button type="button" class="btn btn-add-question" onclick="location.href='ajoutereponse.php'">
                  Ajouter des Réponses
                </button>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>ID Utilisateur</th>
                      <th>Date</th>
                      <th>ID Question</th>
                      <th>Choix RP</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($listereponse as $reponse) {
                      ?>
                      <tr>
                      <td class="text-center"><?php echo $reponse['id_reponse']; ?></td>
                        <td class="text-center"><?php echo $reponse['id_user']; ?></td>
                        <td class="text-center"><?php echo $reponse['date']; ?></td>
                        <td class="text-center"><?php echo $reponse['id_question']; ?></td>
                        <td class="text-center"><?php echo $reponse['choix_rp']; ?></td>
                        <td class="text-center">
                          <button class="btn btn-primary" onclick="window.location.href='modifiereponse.php?id_reponse=<?php echo $reponse['id_reponse']; ?>'">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>Edit✏️
                          </button>
                          <button class="btn btn-danger rounded-circle btn-icon" onclick="window.location.href='supprimereponse.php?id_reponse=<?php echo $reponse['id_reponse']; ?>'">
                            🗑️
                          </button>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>
</html>
