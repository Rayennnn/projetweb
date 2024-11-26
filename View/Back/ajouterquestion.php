<?php
include ('C:/xampp/htdocs/Quiz/Controller/questionC.php');

$questionC = new questionC();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["titre"]) &&
        isset($_POST["id_auteur"]) &&
        isset($_POST["date"]) &&
        isset($_POST["type"])
    ) {
        if (
            !empty($_POST["titre"]) &&
            !empty($_POST["id_auteur"]) &&
            !empty($_POST["date"]) &&
            !empty($_POST["type"])
        ) {
            $question = new question($_POST["titre"], $_POST["id_auteur"], $_POST["date"], $_POST["type"], /*id: $_POST["id"]*/);
            $questionC->ajouterquestion($question);
            header('refresh:0;url=afficherquestion.php');
        }
    } else {
        echo '<script> alert("Missing information"); </script>';
    }
}
?>

<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>webproject</title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <style>
    .error { color: red; font-size: 12px; }
    .input-field { border: 1px solid #ccc; padding: 10px; width: 100%; }
    .input-field.error { border: 1px solid red; }
    .alert { color: red; font-size: 12px; }
  </style>
</head>

<body class="g-sidenav-show bg-primary">
  <main class="main-content position-relative border-radius-lg">
    <form method="POST" action="" onsubmit="return checkInput()">
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">Ajouter questions</p>
                  <button class="btn btn-primary btn-sm ms-auto" type="submit" name="submit">Ajouter question</button>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Question Information</p>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="id" class="form-control-label">Identifiant(uniquement des chiffres)</label>
                      <input class="form-control input-field" type="number" name="id" id="id" />
                      <span id="id-error" class="error"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="titre" class="form-control-label">Titre</label>
                      <input class="form-control input-field" type="text" name="titre" id="titre" />
                      <span id="titre-error" class="error"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="id_auteur">Auteur :</label>
    <select id="id_auteur" name="id_auteur" class="input-field">
      <option value="">-- Sélectionnez un auteur --</option>
      <option value="rima">Rima</option>
      <option value="fatma">Fatma</option>
      <option value="mahmoud">Mahmoud</option>
      <option value="malek">Malek</option>
      <option value="rayen">Rayen</option>
      <option value="aziz">Aziz</option>
    </select>
    <span id="id_auteur-error" class="error-message"></span>
    <br><br>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="date">Date :</label>
    <input type="date" id="date" name="date" class="input-field">
    <span id="date-error" class="error-message"></span>
    <br><br>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="type" class="form-control-label">Type</label>
                      <input class="form-control input-field" type="text" name="type" id="type" maxlength="25" />
                      <span id="type-error" class="error"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </main>

  <script>
    function checkInput() {
      const titre = document.getElementById("titre");
      const id_auteur = document.getElementById("id_auteur");
      const date = document.getElementById("date");
      const id = document.getElementById("id");
      const type = document.getElementById("type");

      let isValid = true;

      // Efface les erreurs précédentes
      clearErrors();

      // Valider 'titre'
      if (titre.value.trim().length === 0) {
        showError('titre-error', "Le champ 'Titre' est obligatoire.");
        titre.classList.add('error');
        isValid = false;
      }

      // Valider 'id_auteur'
      if (id_auteur.value.trim() === "") {
        showError('id_auteur-error', "Veuillez sélectionner un auteur.");
        id_auteur.classList.add('error');
        isValid = false;
      }

      // Valider 'date'
      if (date.value.trim().length === 0) {
        showError('date-error', "Le champ 'Date' est obligatoire.");
        date.classList.add('error');
        isValid = false;
      }

      // Valider 'id' (doit être uniquement des chiffres)
      const idRegex = /^[0-9]+$/; // Regex pour accepter uniquement des chiffres
      if (id.value.trim().length === 0) {
        showError('id-error', "Le champ 'ID' est obligatoire.");
        id.classList.add('error');
        isValid = false;
      } else if (!idRegex.test(id.value)) {
        showError('id-error', "Le champ 'ID' doit contenir uniquement des chiffres.");
        id.classList.add('error');
        isValid = false;
      }

      // Valider 'type' (seulement des lettres, max 25 caractères)
      const typeRegex = /^[A-Za-z]+$/; // Regex pour accepter uniquement des lettres
      if (type.value.trim().length === 0) {
        showError('type-error', "Le champ 'Type' est obligatoire.");
        type.classList.add('error');
        isValid = false;
      } else if (!typeRegex.test(type.value)) {
        showError('type-error', "Le champ 'Type' doit contenir uniquement des lettres.");
        type.classList.add('error');
        isValid = false;
      } else if (type.value.trim().length > 25) {
        showError('type-error', "Le champ 'Type' ne doit pas dépasser 25 caractères.");
        type.classList.add('error');
        isValid = false;
      }

      return isValid; // Si 'isValid' est false, le formulaire ne sera pas soumis
    }

    function showError(elementId, message) {
      const errorElement = document.getElementById(elementId);
      errorElement.textContent = message;
    }

    function clearErrors() {
      const errorElements = document.querySelectorAll('.error-message');
      errorElements.forEach(el => el.textContent = "");
      const inputFields = document.querySelectorAll('.input-field');
      inputFields.forEach(field => field.classList.remove('error'));
    }
  </script>
</body>
</html>