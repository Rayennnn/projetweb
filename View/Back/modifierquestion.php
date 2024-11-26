<?php
include "../../controller/questionC.php";

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
    isset($_POST["type"])
) {
    if (
        !empty($_POST["titre"]) &&
        !empty($_POST["id_auteur"]) &&
        !empty($_POST["date"]) &&
        !empty($_POST["type"])
    ) {
        // Create the updated question object
        $updatedQuestion = new question(
            $_POST["titre"],
            $_POST["id_auteur"],
            $_POST["date"],
            $_POST["type"]
        );

        // Update the question
        $questionC->modifierquestion($updatedQuestion, $id);
        header('Location: afficherquestion.php');
    } else {
        echo '<script> alert("Missing information"); </script>';
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
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </form>
</body>
</html>

  </main>

  <script>
        function validateForm() {
            // Clear previous errors
            clearErrors();

            // Get form elements
            const titre = document.getElementById("titre");
            const id_auteur = document.getElementById("id_auteur");
            const date = document.getElementById("date");
            const type = document.getElementById("type");

            let isValid = true;

            // Validate Titre
            if (titre.value.trim() === "") {
                showError(titre, "Le champ 'Titre' est obligatoire.");
                isValid = false;
            }

            // Validate Auteur
            if (id_auteur.value.trim() === "") {
                showError(id_auteur, "Veuillez sélectionner un auteur.");
                isValid = false;
            }

            // Validate Date
            if (date.value.trim() === "") {
                showError(date, "Le champ 'Date' est obligatoire.");
                isValid = false;
            }

            // Validate Type
            const typeRegex = /^[A-Za-z]+$/; // Only letters
            if (type.value.trim() === "") {
                showError(type, "Le champ 'Type' est obligatoire.");
                isValid = false;
            } else if (!typeRegex.test(type.value)) {
                showError(type, "Le champ 'Type' doit contenir uniquement des lettres.");
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