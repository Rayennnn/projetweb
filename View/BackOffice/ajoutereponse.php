<?php
include('C:/xampp/htdocs/PROJETWEB/Controller/questionC.php');
require_once('C:/xampp/htdocs/PROJETWEB/Model/question.php');
include('C:/xampp/htdocs/PROJETWEB/Controller/reponseC.php');
require_once('C:/xampp/htdocs/PORJETWEB/Model/reponse.php');




$questionC = new questionC();
$questions = $questionC->afficherQuestions();
$reponseC = new reponseC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["id_user"]) && !empty($_POST["id_user"]) &&
        isset($_POST["date"]) && !empty($_POST["date"]) &&
        isset($_POST["id_question"]) && !empty($_POST["id_question"]) &&
        isset($_POST["choix_rp"]) && !empty($_POST["choix_rp"])
    ) {
        $reponse = new reponse($_POST["id_user"], $_POST["date"], $_POST["id_question"], $_POST["choix_rp"],$_POST["score"]);

        $reponseC = new reponseC();
        $reponseC->ajoutereponse($reponse);

        header('refresh:0;url=affichereponse.php');
        exit(); 
    } else {
        echo "Please fill out all required fields.";
    }
}
?>
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ajoutreponse</title>
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
    color: #ffffff;
    background-color: #4e73df;
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

<body>
  <main class="main-content position-relative border-radius-lg">
    <form method="POST" action="">
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">Ajouter une réponse</p>
                  <button class="btn btn-primary btn-sm ms-auto" type="submit">Ajouter</button>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Informations Réponses</p>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="id_user">User :</label>
    <select id="id_user" name="id_user" class="input-field">
      <option value="">-- Sélectionnez un auteur --</option>
      <option value="rima">Rima</option>
      <option value="fatma">Fatma</option>
      <option value="mahmoud">Mahmoud</option>
      <option value="malek">Malek</option>
      <option value="rayen">Rayen</option>
      <option value="aziz">Aziz</option>
    </select>
    <span id="id_user-error" class="error-message"></span>
    <br><br>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="date" class="form-control-label">Date (YYYY-MM-DD)</label>
                      <input class="form-control" type="date" name="date" required>
                    </div>
                  </div>
                  <div class="col-md-6">
    <div class="form-group">
        <label for="id_question" class="form-control-label">Question</label>
        <select class="form-control" name="id_question" required>
            <option value="">Sélectionnez une question</option>
            <?php
            foreach ($questions as $question) {
                echo '<option value="' . htmlspecialchars($question['id']) . '">' . htmlspecialchars($question['titre']) . '</option>';
            }
            ?>
        </select>
    </div>
</div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="choix_rp" class="form-control-label">Choix Réponse</label>
                      <input class="form-control" type="text" name="choix_rp" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="score" class="form-control-label">score</label>
                      <input class="form-control" type="text" name="score" required>
                    </div>
                  </div>
                </div>
                <hr class="horizontal dark">
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </main>
  <script>
  function checkInput() {
    const id_user = document.getElementById("id_user");
    const date = document.getElementById("date");
    const id_question = document.getElementById("id_question");
    const choix_rp = document.getElementById("choix_rp");

    let isValid = true;

    // Effacer les erreurs précédentes
    clearErrors();

    // Valider 'id_user' (doit être un nombre entier positif)
    const idUserRegex = /^[0-9]+$/;
    if (id_user.value.trim().length === 0) {
      showError('id_user-error', "Le champ 'ID Utilisateur' est obligatoire.");
      id_user.classList.add('error');
      isValid = false;
    } else if (!idUserRegex.test(id_user.value.trim())) {
      showError('id_user-error', "L'ID Utilisateur doit être un nombre entier positif.");
      id_user.classList.add('error');
      isValid = false;
    }

    // Valider 'date' (doit correspondre au format YYYY-MM-DD)
    const dateRegex = /^\d{4}-\d{2}-\d{2}$/; // Format date: YYYY-MM-DD
    if (date.value.trim().length === 0) {
      showError('date-error', "Le champ 'Date' est obligatoire.");
      date.classList.add('error');
      isValid = false;
    } else if (!dateRegex.test(date.value.trim())) {
      showError('date-error', "Le champ 'Date' doit être au format YYYY-MM-DD.");
      date.classList.add('error');
      isValid = false;
    } else {
      // Vérification de la validité de la date (si nécessaire)
      const dateObj = new Date(date.value.trim());
      if (isNaN(dateObj.getTime())) {
        showError('date-error', "La date spécifiée est invalide.");
        date.classList.add('error');
        isValid = false;
      }
    }

    // Valider 'id_question' (doit être un nombre entier positif)
    if (id_question.value.trim().length === 0) {
      showError('id_question-error', "Le champ 'ID Question' est obligatoire.");
      id_question.classList.add('error');
      isValid = false;
    } else if (!idUserRegex.test(id_question.value.trim())) {
      showError('id_question-error', "L'ID Question doit être un nombre entier positif.");
      id_question.classList.add('error');
      isValid = false;
    }

    // Valider 'choix_rp' (maximum 255 caractères, sans caractères spéciaux)
    if (choix_rp.value.trim().length === 0) {
      showError('choix_rp-error', "Le champ 'Choix Réponse' est obligatoire.");
      choix_rp.classList.add('error');
      isValid = false;
    } else if (choix_rp.value.trim().length > 255) {
      showError('choix_rp-error', "Le champ 'Choix Réponse' ne peut pas dépasser 255 caractères.");
      choix_rp.classList.add('error');
      isValid = false;
    } else {
      const specialCharsRegex = /[!@#$%^&*(),.?":{}|<>]/;
      if (specialCharsRegex.test(choix_rp.value.trim())) {
        showError('choix_rp-error', "Le champ 'Choix Réponse' ne doit pas contenir de caractères spéciaux.");
        choix_rp.classList.add('error');
        isValid = false;
      }
    }

    return isValid; // Si 'isValid' est false, le formulaire ne sera pas soumis
  }

  // Affichage des messages d'erreur
  function showError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    errorElement.textContent = message;
  }

  // Effacer les erreurs de validation
  function clearErrors() {
    const errorElements = document.querySelectorAll('.error-message');
    errorElements.forEach(el => el.textContent = "");
    const inputFields = document.querySelectorAll('.input-field');
    inputFields.forEach(field => field.classList.remove('error'));
  }
</script>
</body>
</html>