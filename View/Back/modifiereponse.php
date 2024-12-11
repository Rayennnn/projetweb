<?php
include "../../Controller/reponseC.php";
include "../../Controller/questionC.php";
require_once('C:/xampp/htdocs/Quiz/Model/question.php');
require_once('C:/xampp/htdocs/Quiz/Model/reponse.php');

// Instantiate the controller
$questionC = new questionC();
$questions = $questionC->afficherQuestions();
$reponseC = new reponseC();

// Récupération et validation de l'ID de la réponse
$id_reponse = $_GET['id_reponse'] ?? null;

if ($id_reponse && is_numeric($id_reponse)) {
    // Appel unique à getreponse
    $reponse = $reponseC->getreponse($id_reponse);

    if (!$reponse) {
        echo "Erreur : Réponse non trouvée.";
        exit;
    }
} else {
    echo "Erreur : ID non valide.";
    exit;
}

// Handle the form submission
if (
    isset($_POST["id_user"]) &&
    isset($_POST["date"]) &&
    isset($_POST["id_question"]) &&
    isset($_POST["choix_rp"])&&
    isset($_POST["score"]) 
) {
    if (
        !empty($_POST["id_user"]) &&
        !empty($_POST["date"]) &&
        !empty($_POST["id_question"]) &&
        !empty($_POST["choix_rp"])&&
        !empty($_POST["score"]) 
    ) {
         
        $updatedReponse = new reponse(
            $_POST["id_user"],
            $_POST["date"],
            $_POST["id_question"],
            $_POST["choix_rp"],
            $_POST["score"]
        );

         
        $reponseC->modifiereponse($updatedReponse, $id_reponse);
        header('Location: affichereponse.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modifier Reponse</title>
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
                <label for="id_user">User:</label>
                <select name="id_user" id="id_user" class="form-control">
                    <option value="rima" <?php echo ($reponse['id_user'] == "rima") ? 'selected' : ''; ?>>Rima</option>
                    <option value="fatma" <?php echo ($reponse['id_user'] == "fatma") ? 'selected' : ''; ?>>Fatma</option>
                    <option value="mahmoud" <?php echo ($reponse['id_user'] == "mahmoud") ? 'selected' : ''; ?>>Mahmoud</option>
                    <option value="malek" <?php echo ($reponse['id_user'] == "malek") ? 'selected' : ''; ?>>Malek</option>
                    <option value="rayen" <?php echo ($reponse['id_user'] == "rayen") ? 'selected' : ''; ?>>Rayen</option>
                    <option value="aziz" <?php echo ($reponse['id_user'] == "aziz") ? 'selected' : ''; ?>>Aziz</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" class="form-control" 
                    value="<?php echo htmlspecialchars($reponse['date']); ?>">
            </div>
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
        <div class="form-group">
                <label for="type">Choix:</label>
                <input type="text" name="choix_rp" id="choix_rp" class="form-control" 
                    value="<?php echo htmlspecialchars($reponse['choix_rp']); ?>">
            </div>
            <div class="form-group">
    <label for="score">Score:</label>
    <input type="text" name="score" id="score" class="form-control" 
        value="<?php echo htmlspecialchars($reponse['score']); ?>">
</div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </div>
</div> </div>
    </form>
</body>
</html>

  </main>
  <script>
    function validateForm() {
        // Clear previous errors
        clearErrors();

        // Get form elements
        const id_user = document.getElementById("id_user");
        const id_question = document.getElementById("id_question");
        const date = document.getElementById("date");
        const choix_rp = document.getElementById("choix_rp");

        let isValid = true;

        // Validate ID User
        if (id_user.value.trim() === "") {
            showError(id_user, "Le champ 'ID Utilisateur' est obligatoire.");
            isValid = false;
        } else if (!/^[0-9]+$/.test(id_user.value)) {
            showError(id_user, "L'ID Utilisateur doit être un nombre entier positif.");
            isValid = false;
        }

        // Validate ID Question
        if (id_question.value.trim() === "") {
            showError(id_question, "Le champ 'ID Question' est obligatoire.");
            isValid = false;
        } else if (!/^[0-9]+$/.test(id_question.value)) {
            showError(id_question, "L'ID Question doit être un nombre entier positif.");
            isValid = false;
        }

        // Validate Date
        if (date.value.trim() === "") {
            showError(date, "Le champ 'Date' est obligatoire.");
            isValid = false;
        } else if (!/^\d{4}-\d{2}-\d{2}$/.test(date.value)) {
            showError(date, "La date doit être au format YYYY-MM-DD.");
            isValid = false;
        } else if (isNaN(new Date(date.value).getTime())) {
            showError(date, "La date spécifiée est invalide.");
            isValid = false;
        }

        // Validate Choix Réponse
        if (choix_rp.value.trim() === "") {
            showError(choix_rp, "Le champ 'Choix Réponse' est obligatoire.");
            isValid = false;
        } else if (choix_rp.value.trim().length > 25) {
            showError(choix_rp, "Le champ 'Choix Réponse' ne doit pas dépasser 25 caractères.");
            isValid = false;
        } else if (!/^[a-zA-Z0-9\s]+$/.test(choix_rp.value)) {
            showError(choix_rp, "Le champ 'Choix Réponse' ne doit pas contenir de caractères spéciaux.");
            isValid = false;
        }

        return isValid;
    }

    function showError(element, message) {
        // Highlight the input field with a red border
        element.classList.add("error");

        // Show the error message below the input field
        const errorElement = document.getElementById(`${element.id}-error`);
        if (errorElement) {
            errorElement.textContent = message;
        }
    }

    function clearErrors() {
        // Remove all error messages and reset input field styles
        const errorMessages = document.querySelectorAll(".error-message");
        errorMessages.forEach((error) => (error.textContent = ""));

        const inputFields = document.querySelectorAll(".input-field");
        inputFields.forEach((field) => field.classList.remove("error"));
    }
</script>

</body>
</html>