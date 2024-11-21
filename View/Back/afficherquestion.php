<?php
include "../../Controller/questionC.php";
$questionC = new questionC();
$listequestion = $questionC->affichequestion();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Panel - Manage Questions</title>

  <!-- External CSS (Bootstrap, Icons) -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />

  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f7f7f7;
      font-family: 'Open Sans', sans-serif;
      margin: 0;
      padding: 0;
    }

    /* Side Navigation */
    .sidenav {
      background-color: #3f72af;
      color: white;
      border-radius: 10px;
    }

    .sidenav-header {
      padding: 20px;
      text-align: center;
      background-color: #2a4d84;
      border-radius: 10px 10px 0 0;
    }

    .sidenav-header .navbar-brand {
      color: #fff;
      font-size: 1.5rem;
      font-weight: bold;
    }

    .navbar-nav .nav-link {
      color: #ddd;
      padding: 10px 20px;
      font-size: 1rem;
      text-transform: uppercase;
    }

    .navbar-nav .nav-link:hover {
      background-color: #2a4d84;
      color: #fff;
    }

    .navbar-nav .nav-link.active {
      background-color: #4e73df;
      color: #fff;
    }

    /* Main Content */
    .main-content {
      margin-left: 220px;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .card {
      background-color: #fff;
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      background-color: #4e73df;
      color: #fff;
      font-size: 1.2rem;
      font-weight: bold;
      padding: 15px;
      border-radius: 10px 10px 0 0;
    }

    .card-body {
      padding: 20px;
    }

    .table {
      width: 100%;
      margin-bottom: 1rem;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
      padding: 15px;
      text-align: center;
      vertical-align: middle;
      font-size: 1rem;
    }

    .table th {
      background-color: #f8f9fc;
      color: #4e73df;
      text-transform: uppercase;
      font-weight: bold;
    }

    .table td {
      background-color: #fff;
      color: #555;
    }

    .table tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .table tr:hover {
      background-color: #f1f1f1;
    }

    .btn-primary {
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 15px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .btn-danger {
      background-color: #e3342f;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 15px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
      background-color: #cc1f1a;
    }

    /* Add button styles for the 'Add Questions' button */
    .btn-add-question {
      background-color: #4e73df;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-add-question:hover {
      background-color: #2a4d84;
    }

    .position-absolute {
      position: absolute;
      top: 15px;
      right: 30px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 10px;
      }

      .card-header {
        font-size: 1rem;
      }

      .table th, .table td {
        font-size: 0.9rem;
      }
    }

    @media (max-width: 480px) {
      .table th, .table td {
        padding: 10px;
      }
    }

  </style>
</head>
<body class="g-sidenav-show bg-primary">

  <!-- Sidebar -->
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
      <a class="navbar-brand m-0" target="_blank">
        <img src="/view/front/assets/img/logo.png" class="navbar-brand-img h-100" alt="logo">
        <span class="ms-1 font-weight-bold">parcouri</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="afficherquestion.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Gestion questions</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Liste des Questions</h6>
              <div class="position-absolute top-3 start-50 translate-middle-x">
                <button type="button" class="btn btn-add-question">
                  <a href="ajouterquestion.php" class="text-light">Ajouter des Questions</a>
                </button>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>titre</th>
                      <th>id_auteur</th>
                      <th>date</th>
                      <th>type</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($listequestion as $question) {
                      ?>
                      <tr>
                        <td class="text-center"><?php echo $question['id']; ?></td>
                        <td class="text-center"><?php echo $question['titre']; ?></td>
                        <td class="text-center"><?php echo $question['id_auteur']; ?></td>
                        <td class="text-center"><?php echo $question['date']; ?></td>
                        <td class="text-center"><?php echo $question['type']; ?></td>
                        <td class="text-center">
                          <button class="btn btn-primary">
                            <a href="modifierquestion.php?id=<?PHP echo $question['id']; ?>" class="text-light"><i class="fas fa-pencil-alt" aria-hidden="true"> Edit</i></a>
                          </button>
                          <button class="btn btn-danger">
                            <a href="supprimerquestion.php?id=<?PHP echo $question['id']; ?>" class="text-light"><i class="far fa-trash-alt" aria-hidden="true"> Delete</i></a>
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
