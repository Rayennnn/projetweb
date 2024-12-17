<?php
include ('C:/xampp/htdocs/Quiz/Controller/questionC.php');

$questionC = new questionC();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["titre"]) &&
        isset($_POST["id_auteur"]) &&
        isset($_POST["date"]) &&
        isset($_POST["ideal_rep"]) &&
        isset($_POST["type"])
    ) {
        if (
            !empty($_POST["titre"]) &&
            !empty($_POST["id_auteur"]) &&
            !empty($_POST["date"]) &&
            !empty($_POST["ideal_rep"]) &&
            !empty($_POST["type"])
        ) {
            $question = new question($_POST["titre"], $_POST["id_auteur"], $_POST["date"], $_POST["type"], ideal_rep: $_POST["ideal_rep"]);
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
  <title>ajoutquestion</title>
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
    /* General Reset */
body {
    margin: 0;
    padding: 0;
    font-family: 'Open Sans', sans-serif;
    background-color: #f5f7fa; /* Light background for better contrast */
}

/* Form Container */
.container-fluid {
    max-width: 800px;
    margin: 50px auto;
    padding: 30px;
    background: #ffffff; /* White background for the form */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

/* Card Styling */
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add depth to the card */
}

/* Card Header */
.card-header {
    background-color: #4e73df;
    color: #ffffff;
    border-radius: 10px 10px 0 0;
    padding: 15px;
}

.card-header p {
    font-size: 1.2rem;
    margin: 0;
    font-weight: bold;
}

/* Form Group Styling */
.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #4e73df; /* Stylish color for labels */
}

.input-field, input, select {
    width: 100%;
    padding: 12px 15px;
    font-size: 1rem;
    border: 1px solid #d1d3e2;
    border-radius: 8px;
    background-color: #f8f9fc; /* Light gray for input background */
    color: #495057; /* Dark gray for text */
    transition: all 0.3s ease;
}

.input-field:focus, input:focus, select:focus {
    border-color: #4e73df; /* Add focus color to input borders */
    outline: none;
    box-shadow: 0 0 8px rgba(78, 115, 223, 0.3); /* Blue glow effect */
}

.error {
    border-color: #e74a3b; /* Red border for invalid fields */
}

/* Error Message Styling */
.error-message {
    color: #e74a3b;
    font-size: 0.85rem;
    margin-top: 5px;
}

/* Button Styling */
button {
    padding: 12px 20px;
    font-size: 1rem;
    font-weight: bold;
    color: #4e73df;
    background-color: #ffffff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

button:hover {
    background-color: #3751a5; /* Darker blue on hover */
}

/* Responsive Design */
@media (max-width: 768px) {
    .container-fluid {
        padding: 20px;
    }

    input, select, button {
        font-size: 0.9rem;
        padding: 10px;
    }
}

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
                      <label for="ideal_rep" class="form-control-label">reponse ideal</label>
                      <input class="form-control input-field" type="text" name="ideal_rep" id="ideal_rep" />
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