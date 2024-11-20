<?php
include "../../Controller/questionC.php";



$questionC=new questionC();
$listequestion=$questionC->affichequestion();

?>


<body class="g-sidenav-show  bg-primary">
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" target="_blank">
        <img src="assets/img/psychoz.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Rima</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
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
  <main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Liste questions</h6>
              <div class="position-absolute top-3 start-50 translate-middle-x">
                <button type="button" class="btn btn-primary">
                  <a href="ajouterquestion.php" class="text-light">Ajouter questions</a>
                </button>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">id</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15 ">titre</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15 ">id_auteur</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">date</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">type</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach($listequestion as $question){
                      ?>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $question['id']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $question['titre']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $question['id_auteur']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $question['date']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $question['type']; ?></span>
                      </td>
                      <td class="align-middle">
                        <button class="btn bg-gradient-dark mb-0">
                        <a  class="text-light" href="modifierquestion.php?id=<?PHP echo $question['id']; ?>" role="button"><i class="fas fa-pencil-alt " aria-hidden="true"> Edit</i></a>
                        </button>
                        <button class="btn bg-gradient-dark mb-0">
                          <a href="supprimerquestion.php?id=<?PHP echo $question['id']; ?>" class="text-danger"><i class="far fa-trash-alt"aria-hidden="true"> Delete</i></a>
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