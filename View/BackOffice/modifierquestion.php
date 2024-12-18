<?php
include('C:/xampp/htdocs/PROJETWEB/Controller/questionC.php');
require_once('C:/xampp/htdocs/PORJETWEB/Model/question.php');
include('C:/xampp/htdocs/PROJETWEB/Controller/reponseC.php');
require_once('C:/xampp/htdocs/PROJETWEB/Model/reponse.php');

// Instantiate the controller
$questionC = new questionC();

// Get the ID of the question
$id = $_GET['id'];

// Fetch the current question details
$question = $questionC->getquestion($id);

// Handle the form submission
if (
    isset($_POST["titre"]) &&
    isset($_POST["id_auteur"]) &&
    isset($_POST["date"]) &&
    isset($_POST["type"])&&
    isset($_POST["ideal_rep"])
) {
    if (
        !empty($_POST["titre"]) &&
        !empty($_POST["id_auteur"]) &&
        !empty($_POST["date"]) &&
        !empty($_POST["type"])&&
        !empty($_POST["ideal_rep"])  
    ) {
        // Create the updated question object
        $updatedQuestion = new question(
            $_POST["titre"],
            $_POST["id_auteur"],
            $_POST["date"],
            $_POST["type"],
            $_POST["ideal_rep"]
        );

        // Update the question
        $questionC->modifierquestion($updatedQuestion, $id);
        header('Location: afficherquestion.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modifier Question</title>
    <!-- Fonts and CSS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
      /* General Reset */
body {
    margin: 0;
    padding: 0;
    font-family: 'Open Sans', sans-serif;
    background-color: #f5f7fa; /* Light background for better contrast */
}

/* Form Container */
.container {
    max-width: 600px;
    margin: 50px auto;
    background: #ffffff; /* White background for the form */
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    border: 1px solid #e0e0e0;
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

input, select {
    width: 100%;
    padding: 12px 15px;
    font-size: 1rem;
    border: 1px solid #d1d3e2;
    border-radius: 8px;
    background-color: #f8f9fc; /* Light gray for input background */
    color: #495057; /* Dark gray for text */
    transition: all 0.3s ease;
}

input:focus, select:focus {
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
    width: 100%;
    padding: 12px;
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
    .container {
        padding: 20px;
        margin: 20px;
    }

    input, select, button {
        font-size: 0.9rem;
        padding: 10px;
    }
}

    </style>

</head>
<body>
    <form method="POST" action="">
        <div class="container">
            <div class="form-group">
                <label for="titre">Titre:</label>
                <input type="text" name="titre" id="titre" class="form-control" 
                    value="<?php echo htmlspecialchars($question['titre']); ?>">
            </div>
            <div class="form-group">
                <label for="id_auteur">Auteur:</label>
                <select name="id_auteur" id="id_auteur" class="form-control">
                    <option value="rima" <?php echo ($question['id_auteur'] == "rima") ? 'selected' : ''; ?>>Rima</option>
                    <option value="fatma" <?php echo ($question['id_auteur'] == "fatma") ? 'selected' : ''; ?>>Fatma</option>
                    <option value="mahmoud" <?php echo ($question['id_auteur'] == "mahmoud") ? 'selected' : ''; ?>>Mahmoud</option>
                    <option value="malek" <?php echo ($question['id_auteur'] == "malek") ? 'selected' : ''; ?>>Malek</option>
                    <option value="rayen" <?php echo ($question['id_auteur'] == "rayen") ? 'selected' : ''; ?>>Rayen</option>
                    <option value="aziz" <?php echo ($question['id_auteur'] == "aziz") ? 'selected' : ''; ?>>Aziz</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" class="form-control" 
                    value="<?php echo htmlspecialchars($question['date']); ?>">
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" name="type" id="type" class="form-control" 
                    value="<?php echo htmlspecialchars($question['type']); ?>">
            </div>
            <div class="form-group">
                <label for="ideal_rep">ideal_reponse:</label>
                <input type="text" name="ideal_rep" id="ideal_rep" class="form-control" 
                    value="<?php echo htmlspecialchars($question['ideal_rep']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </form>
</body>
</html>

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