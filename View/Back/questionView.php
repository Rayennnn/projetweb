<?php
include "../../Controller/questionC.php";


$questionC=new questionC();
$liste_questions=$questionC->affichequestion();

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
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" target="_blank">
        <img src="assets/img/psychoz.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Psychoz</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="afficherevent.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Gestion evenements</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Liste evenements</h6>
              <div class="position-absolute top-3 start-50 translate-middle-x">
                <button type="button" class="btn btn-primary">
                  <a href="ajouterevent.php" class="text-light">Ajouter evenements</a>
                </button>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">ID</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15 ">nom_event</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15 ">type_event</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">date_event</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">lieu_event</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">id_salle</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach($liste_evenements as $event){
                      ?>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $event['id_event']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $event['nom_event']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $event['type_event']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $event['date_event']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $event['lieu_event']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $event['id_salle']; ?></span>
                      </td>
                      <td class="align-middle">
                        <button class="btn bg-gradient-dark mb-0">
                        <a  class="text-light" href="modifierevent.php?id_event=<?PHP echo $event['id_event']; ?>" role="button"><i class="fas fa-pencil-alt " aria-hidden="true"> Modifier</i></a>
                        </button>
                        <button class="btn bg-gradient-dark mb-0">
                          <a href="supprimerevent.php?id_event=<?PHP echo $event['id_event']; ?>" class="text-danger"><i class="far fa-trash-alt"></i></a>
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
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>liste des salles</h6>
              <div class="position-absolute top-3 start-50 translate-middle-x">
                <button type="button" class="btn btn-primary">
                  <a href="ajoutesalle.php" class="text-light">Ajouter salle</a>
                </button>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">id</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">nom</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">capacite</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">adresse</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">disponibilite</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach($liste_salles as $salles){
                      ?>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $salles['id_salle']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $salles['nom_salle']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $salles['capacite_salle']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $salles['dispo_salle']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $salles['ad_salle']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $salles['dispo_salle']; ?></span>
                    </td>
                      <td class="align-middle">
                        <button class="btn bg-gradient-dark mb-0">
                        <a  class="text-light" href="modifiersalle.php?id_evt=<?PHP echo $salles['id_salle']; ?>" role="button"><i class="fas fa-pencil-alt " aria-hidden="true"> Modifier</i></a>
                        </button>
                        <button class="btn bg-gradient-dark mb-0">
                          <a href="supprimesalle.php?id_event=<?PHP echo $salles['id_salle']; ?>" class="text-danger"><i class="far fa-trash-alt"></i></a>
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