<?php
include "../../Controller/reponseC.php";

// Instantiate the controller
$reponseC = new reponseC();


$id = $_GET['id'];


$reponse = $reponseC->getreponse($id);

// Handle the form submission
if (
    isset($_POST["id_user"]) &&
    isset($_POST["date"]) &&
    isset($_POST["id_question"]) &&
    isset($_POST["choix_rp"])
) {
    if (
        !empty($_POST["id_user"]) &&
        !empty($_POST["date"]) &&
        !empty($_POST["id_question"]) &&
        !empty($_POST["choix_rp"])
    ) {
         
        $updatedReponse = new reponse(
            $_POST["id_user"],
            $_POST["date"],
            $_POST["id_question"],
            $_POST["choix_rp"]
        );

         
        $reponseC->modifiereponse($updatedReponse, $id);
        header('Location: affichereponse.php');
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
            <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Question </label>
                    <input class="form-control" type="text" value="<?php echo $reponse['id_question']; ?>" name="id_question">
                  </div>
                </div>
            <div class="form-group">
                <label for="type">Choix:</label>
                <input type="text" name="choix_rp" id="choix_rp" class="form-control" 
                    value="<?php echo htmlspecialchars($reponse['choix_rp']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </form>
</body>
</html>

  </main>
</body>
</html>