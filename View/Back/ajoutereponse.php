<?php
include('C:/xampp/htdocs/Quiz/Controller/questionC.php');
require_once('C:/xampp/htdocs/Quiz/Model/question.php');
include('C:/xampp/htdocs/Quiz/Controller/reponseC.php');
require_once('C:/xampp/htdocs/Quiz/Model/reponse.php');



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
        $reponse = new reponse($_POST["id_user"], $_POST["date"], $_POST["id_question"], $_POST["choix_rp"]);

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
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="id_user" class="form-control-label">ID User</label>
                      <input class="form-control" type="text" name="id_user" required>
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
                </div>
                <hr class="horizontal dark">
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </main>
</body>
</html>
