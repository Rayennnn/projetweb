<?php
include "../../controller/questionC.php";
include "../../controller/reponseC.php";



$reponseC=new reponseC();
$liste_reponses=$reponceC->afficherreponse();


?>


          

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>list answers</h6>
              <div class="position-absolute top-3 start-50 translate-middle-x">
              <form action="" method="POST">
    <input type="text" name="search1" placeholder="search rooms...">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-search"></i>
      </button>
      <input type="submit" name="show_all" value="Show All" class="btn btn-primary">
      <button type="button" class="btn btn-primary">
                  <a href="ajoutereponse.php" class="text-light">Add</a>
    </form>

              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">id</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">id_user</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">Date</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">iq_quuestion</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15">choix_rp</th>
                      <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-15"></th>
                    </tr>
                  </thead>
                  <?php
$db = config::getConnexion();


if (isset($_GET['tri'])) {
  $tri = $_GET['tri'];
  if ($tri == 'dispo_salle') {
    $query = "SELECT * FROM reponses ORDER BY (dispo_salle='oui') DESC, (dispo_salle='non') DESC";
  } elseif ($tri == 'capacite_salle') {
    $query = "SELECT * FROM reponses ORDER BY capacite_salle ASC";
  }
  $liste_reponses = $db->query($query)->fetchAll();
} elseif(isset($_POST['search1'])) {
  $search1 = $_POST['search1'];
  $query = "SELECT * FROM reponses WHERE idLIKE '%$search1%' OR nom_salle LIKE '%$search1%' OR ad_salle LIKE '%$search1%' OR dispo_salle LIKE '%$search1%' OR capacite_salle LIKE '%$search1%' OR id_salle LIKE '$search1%' OR nom_salle LIKE '$search1%' OR ad_salle LIKE '$search1%' OR dispo_salle LIKE '$search1%' OR capacite_salle LIKE '$search1%'";
  $liste_reponses = $db->query($query)->fetchAll();
} else {
  $query = "SELECT * FROM reponses";
  $liste_reponses = $db->query($query)->fetchAll();
}
?>

<form action="" method="get">
  <select name="tri" onchange="this.form.submit()">
    <option value="">Trier par :</option>
    <option value="dispo_salle" <?php if (isset($_GET['tri']) && $_GET['tri'] == 'dispo_salle') echo 'selected'; ?>>Disponibilité</option>
    <option value="capacite_salle" <?php if (isset($_GET['tri']) && $_GET['tri'] == 'capacite_salle') echo 'selected'; ?>>Capacité</option>
  </select>
</form>
<?php
echo "<br>";

?>
            <tbody>
                    <?php 
                    foreach($liste_reponses as $reponses){
                      ?>
                      <td class="align-middle text-center">
                       <span class="text-secondary text-xs font-weight-bold"><?php echo ($reponses['id']); ?></span>
                     </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $reponses['id_user']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $reponses['date']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $reponses['iq_question']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $reponses['choix_rp']; ?></span>
                    </td>
                      <td class="align-middle">
                        <button class="btn bg-gradient-dark mb-0">
                        <a  class="text-light" href="modifiereponse.php?id=<?PHP echo $reponses['id']; ?>" role="button"><i class="fas fa-pencil-alt " aria-hidden="true"> Modifier</i></a>
                        </button>
                        <button class="btn bg-gradient-dark mb-0">
                          <a href="supprimereponse.php?id=<?PHP echo $reponses['id']; ?>" class="text-danger"><i class="far fa-trash-alt"></i></a>
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